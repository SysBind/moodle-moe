<?PHP // $Id$
      // Allows a teacher/admin to login as another user (in stealth mode)

    require_once("../config.php");
    require_once("lib.php");

    require_variable($id);     // course id
    optional_variable($user);   // login as this user
    optional_variable($return); // return to being the real user again

    if (! $course = get_record("course", "id", $id)) {
        error("Course ID was incorrect");
    }

    require_login($course->id);

    if ($return and $USER->realuser) {
        $USER = get_user_info_from_db("id", $USER->realuser);
        $USER->loggedin = true;
        $USER->site = $CFG->wwwroot;
        redirect($_SERVER["HTTP_REFERER"]);
        exit;
    }

    // $user must be defined to go on

    if (!isteacher($course->id)) {
        error("Only teachers can use this page!");
    }

    if ($course->category and !isstudent($course->id, $user) and !isadmin()) {
        error("This student is not in this course!");
    }

    if (iscreator($user)) {
        error("You can not login as this person!");
    }

    // Login as this student and return to course home page.

    $teacher_name = fullname($USER, true);
    $teacher_id   = "$USER->id";

    $USER = get_user_info_from_db("id", $user);
    $USER->loggedin = true;
    $USER->site = $CFG->wwwroot;
    $USER->realuser = $teacher_id;

    set_moodle_cookie($USER->username);
    $student_name = fullname($USER, true);

    add_to_log($course->id, "course", "loginas", "../user/view.php?id=$course->id&user=$user", "$teacher_name -> $student_name");


    $strloginas    = get_string("loginas");
    $strloggedinas = get_string("loggedinas", "", $student_name);

    print_header("$course->fullname: $strloginas $student_name", "$course->fullname", 
                 "<A HREF=\"$CFG->wwwroot/course/view.php?id=$course->id\">$course->shortname</A> -> 
                  $strloginas $student_name");
    notice($strloggedinas, "$CFG->wwwroot/course/view.php?id=$course->id");


?>
