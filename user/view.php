<?PHP // $Id$

//  Display profile for a particular user

    require_once("../config.php");
    require_once("../mod/forum/lib.php");
    require_once("lib.php");

    require_variable($id);
    require_variable($course);


    if (! $user = get_record("user", "id", $id) ) {
        error("No such user in this course");
    }

    if (! $course = get_record("course", "id", $course) ) {
        error("No such course id");
    }

    if ($course->category) {
        require_login($course->id);
    }

    add_to_log($course->id, "user", "view", "view.php?id=$user->id&course=$course->id", "$user->id");

    if ($student = get_record("user_students", "userid", $user->id, "course", $course->id)) {
        $user->lastaccess = $student->timeaccess;
    } else if ($teacher = get_record("user_teachers", "userid", $user->id, "course", $course->id)) {
        $user->lastaccess = $teacher->timeaccess;
    }

    $fullname = "$user->firstname $user->lastname";
    $personalprofile = get_string("personalprofile");
    $participants = get_string("participants");

    $loggedinas = "<p class=\"logininfo\">".user_login_string($course, $USER)."</p>";

    if ($course->category) {
        print_header("$personalprofile: $fullname", "$personalprofile: $fullname", 
                     "<a href=\"../course/view.php?id=$course->id\">$course->shortname</a> -> 
                      <a href=\"index.php?id=$course->id\">$participants</a> -> $fullname",
                      "", "", true, "&nbsp;", $loggedinas);
    } else {
        print_header("$course->fullname: $personalprofile: $fullname", "$course->fullname", 
                     "$fullname", "", "", true, "&nbsp;", $loggedinas);
    }

    if ($course->category and ! isguest() ) {
        if (!isstudent($course->id, $user->id) && !isteacher($course->id, $user->id)) {
            print_heading(get_string("notenrolled", "", $fullname));
            print_footer($course);
            die;
        }
    }

    if ($user->deleted) {
        print_heading(get_string("userdeleted"));
    }

    echo "<table width=\"80%\" align=\"center\" border=\"0\" cellpadding=\"1\" cellspacing=\"1\" class=\"userinfobox\">";
    echo "<tr>";
    echo "<td width=\"100\" valign=\"top\" class=\"userinfoboxside\">";
    print_user_picture($user->id, $course->id, $user->picture, true, false, false);
    echo "</td><td width=\"100%\" bgcolor=\"$THEME->cellcontent\" class=\"userinfoboxcontent\">";


    // Print name and edit button across top

    echo "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td nowrap>";
    echo "<h3>$fullname</h3>";
    echo "</td><td align=\"right\">";
    if (empty($USER->id)) {
       $currentuser = false;
    } else {
       $currentuser = ($user->id == $USER->id);
    }
    if (($currentuser and !isguest()) or isadmin()) {
        echo "<p><form action=edit.php method=get>";
        echo "<input type=hidden name=id value=\"$id\">";
        echo "<input type=hidden name=course value=\"$course->id\">";
        echo "<input type=submit value=\"".get_string("editmyprofile")."\">";
        echo "</form></p>";
    }
    echo "</td></tr></table>";


    // Print the description

    if ($user->description) {
        echo "<p>".text_to_html($user->description)."</p><hr>";
    }

    // Print all the little details in a list

    echo "<table border=\"0\" cellpadding=\"5\" cellspacing=\"2\"";

    if ($user->city or $user->country) {
        $countries = get_list_of_countries();
        print_row(get_string("location").":", "$user->city, ".$countries["$user->country"]);
    }

    if (isteacher($course->id)) {
        if ($user->address) {
            print_row(get_string("address").":", "$user->address");
        }
        if ($user->phone1) {
            print_row(get_string("phone").":", "$user->phone1");
        }
        if ($user->phone2) {
            print_row(get_string("phone").":", "$user->phone2");
        }
    }

    if ($user->maildisplay == 1 or ($user->maildisplay == 2 and $course->category) or isteacher($course->id)) {
        print_row(get_string("email").":", obfuscate_mailto($user->email));
    }

    if ($user->url) {
        print_row(get_string("webpage").":", "<a href=\"$user->url\">$user->url</a>");
    }

    if ($user->icq) {
        print_row("icq:","<a href=\"http://web.icq.com/wwp?uin=$user->icq\">$user->icq <img src=\"http://web.icq.com/whitepages/online?icq=$user->icq&img=5\" width=18 height=18 border=0></a>");
    }

    if ($user->lastaccess) {
        $datestring = userdate($user->lastaccess)."&nbsp (".format_time(time() - $user->lastaccess).")";
    } else {
        $datestring = get_string("never");
    }
    print_row(get_string("lastaccess").":", $datestring);

    echo "</table>";

    echo "</td></tr></table>";

    $internalpassword = false;
    if (is_internal_auth()) {
        $internalpassword = "$CFG->wwwroot/login/change_password.php";
    }

//  Print other functions
    echo "<center><table align=center><tr>";
    if ($currentuser and !isguest()) {
        if ($internalpassword) {
            echo "<td nowrap><p><form action=\"$internalpassword\" method=get>";
            echo "<input type=hidden name=id value=\"$course->id\">";
            echo "<input type=submit value=\"".get_string("changepassword")."\">";
            echo "</form></p></td>";
        } else if (strlen($CFG->changepassword) > 1) {
            echo "<td nowrap><p><form action=\"$CFG->changepassword\" method=get>";
            echo "<input type=submit value=\"".get_string("changepassword")."\">";
            echo "</form></p></td>";
        }
    }
    if ($course->category and 
        ((isstudent($course->id) and ($user->id == $USER->id) and !isguest() and $CFG->allowunenroll) or 
        (isteacher($course->id) and isstudent($course->id, $user->id))) ) {
        echo "<td nowrap><p><form action=\"../course/unenrol.php\" method=get>";
        echo "<input type=hidden name=id value=\"$course->id\">";
        echo "<input type=hidden name=user value=\"$user->id\">";
        echo "<input type=submit value=\"".get_string("unenrolme", "", $course->shortname)."\">";
        echo "</form></p></td>";
    }
    if (isteacher($course->id) or ($course->showreports and $USER->id == $user->id)) {
        echo "<td nowrap><p><form action=\"../course/user.php\" method=get>";
        echo "<input type=hidden name=id value=\"$course->id\">";
        echo "<input type=hidden name=user value=\"$user->id\">";
        echo "<input type=submit value=\"".get_string("activityreport")."\">";
        echo "</form></p></td>";
    }
    if (isteacher($course->id) and ($USER->id != $user->id)) {
        echo "<td nowrap><p><form action=\"../course/loginas.php\" method=get>";
        echo "<input type=hidden name=id value=\"$course->id\">";
        echo "<input type=hidden name=user value=\"$user->id\">";
        echo "<input type=submit value=\"".get_string("loginas")."\">";
        echo "</form></p></td>";
    }
    echo "</tr></table></center>\n";

    forum_print_user_discussions($course->id, $user->id);

    print_footer($course);

/// Functions ///////

function print_row($left, $right) {
    echo "<tr><td nowrap align=right><p>$left</td><td align=left><p>$right</p></td></tr>";
}

?>
