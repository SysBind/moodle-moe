<?PHP // $Id$

//  Display profile for a particular user

    require_once("../config.php");
    require_once("../mod/forum/lib.php");

    optional_variable($id);
    optional_variable($course);
    optional_variable($enable, "");
    optional_variable($disable, "");

    if (empty($id)) {         // See your own profile by default
        require_login();
        $id = $USER->id;
    }

    if (empty($course)) {     // See it at site level by default
        $course = SITEID;
    }

    if (! $user = get_record("user", "id", $id) ) {
        error("No such user in this course");
    }

    if (! $course = get_record("course", "id", $course) ) {
        error("No such course id");
    }

    if ($course->category) {
        require_login($course->id);
    } else if ($CFG->forcelogin or !empty($CFG->forceloginforprofiles)) {
        if (isguest()) {
            redirect("$CFG->wwwroot/login/index.php");
        }
        require_login();
    }

    add_to_log($course->id, "user", "view", "view.php?id=$user->id&course=$course->id", "$user->id");

    if ($course->id != SITEID) {
        if ($student = get_record("user_students", "userid", $user->id, "course", $course->id)) {
            $user->lastaccess = $student->timeaccess;
        } else if ($teacher = get_record("user_teachers", "userid", $user->id, "course", $course->id)) {
            $user->lastaccess = $teacher->timeaccess;
        }
    }

    $fullname = fullname($user, isteacher($course->id));
    $personalprofile = get_string("personalprofile");
    $participants = get_string("participants");

    if (empty($USER->id)) {
       $currentuser = false;
    } else {
       $currentuser = ($user->id == $USER->id);
    }

    if (groupmode($course) == SEPARATEGROUPS and !isteacheredit($course->id)) {   // Groups must be kept separate
        require_login();

        if (!isteacheredit($course->id, $user->id) and !ismember(mygroupid($course->id), $user->id)) {
            print_header("$personalprofile: ", "$personalprofile: ",
                         "<a href=\"../course/view.php?id=$course->id\">$course->shortname</a> ->
                          <a href=\"index.php?id=$course->id\">$participants</a>",
                          "", "", true, "&nbsp;", navmenu($course));
            error(get_string("groupnotamember"), "../course/view.php?id=$course->id");
        }
    }

    if ($course->id == SITEID and !$currentuser) {  // To reduce possibility of "browsing" userbase at site level
        if (!isteacherinanycourse() and !isteacherinanycourse($user->id) ) {  // Teachers can browse and be browsed at site level
            print_header("$personalprofile: ", "$personalprofile: ",
                          "<a href=\"index.php?id=$course->id\">$participants</a>",
                          "", "", true, "&nbsp;", navmenu($course));
            print_heading(get_string('usernotavailable', 'error'));
            print_footer($course);
            die;
        }
    }


    if ($course->category) {
        print_header("$personalprofile: $fullname", "$personalprofile: $fullname",
                     "<a href=\"../course/view.php?id=$course->id\">$course->shortname</a> ->
                      <a href=\"index.php?id=$course->id\">$participants</a> -> $fullname",
                      "", "", true, "&nbsp;", navmenu($course));
    } else {
        print_header("$course->fullname: $personalprofile: $fullname", "$course->fullname",
                     "$fullname", "", "", true, "&nbsp;", navmenu($course));
    }


    if ($course->category and ! isguest() ) {   // Need to have access to a course to see that info
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
    echo "</td><td width=\"100%\" class=\"userinfoboxcontent\">";


    // Print name and edit button across top

    echo "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td nowrap=\"nowrap\">";
    echo "<h3>$fullname</h3>";
    echo "</td><td align=\"right\">";
    if (($currentuser and !isguest()) or isadmin()) {
        if(empty($CFG->loginhttps)) {
            $wwwroot = $CFG->wwwroot;
        } else {
            $wwwroot = str_replace('http','https',$CFG->wwwroot);
        }
        echo "<form action=\"$wwwroot/user/edit.php\" method=\"get\">";
        echo "<input type=\"hidden\" name=\"id\" value=\"$id\" />";
        echo "<input type=\"hidden\" name=\"course\" value=\"$course->id\" />";
        echo "<input type=\"submit\" value=\"".get_string("editmyprofile")."\" />";
        echo "</form>";
    }
    echo "</td></tr></table>\n\n";


    // Print the description

    if ($user->description) {
        echo format_text($user->description, FORMAT_MOODLE)."<hr />";
    }

    // Print all the little details in a list

    echo "<table border=\"0\" cellpadding=\"5\" cellspacing=\"2\">";

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

    if ($user->maildisplay == 1 or
       ($user->maildisplay == 2 and $course->category and !isguest()) or
       isteacher($course->id)) {

        $emailswitch = '';

        if (isteacheredit($course->id) or $currentuser) {   /// Can use the enable/disable email stuff
            if (!empty($_GET['enable'])) {     /// Recieved a parameter to enable the email address
                set_field('user', 'emailstop', 0, 'id', $user->id);
                $user->emailstop = 0;
            }
            if (!empty($_GET['disable'])) {     /// Recieved a parameter to disable the email address
                set_field('user', 'emailstop', 1, 'id', $user->id);
                $user->emailstop = 1;
            }
        }

        if (isteacheredit($course->id)) {   /// Can use the enable/disable email stuff
            if ($user->emailstop) {
                $switchparam = 'enable';
                $switchtitle = get_string('emaildisable');
                $switchclick = get_string('emailenableclick');
                $switchpix   = 'emailno.gif';
            } else {
                $switchparam = 'disable';
                $switchtitle = get_string('emailenable');
                $switchclick = get_string('emaildisableclick');
                $switchpix   = 'email.gif';
            }
            $emailswitch = "&nbsp<a title=\"$switchclick\" ".
                           "href=\"view.php?id=$user->id&course=$course->id&$switchparam=1\">".
                           "<img border=\"0\" width=11 height=11 src=\"$CFG->pixpath/t/$switchpix\"></a>";

        } else if ($currentuser) {         /// Can only re-enable an email this way
            if ($user->emailstop) {   // Include link that tells how to re-enable their email
                $switchparam = 'enable';
                $switchtitle = get_string('emaildisable');
                $switchclick = get_string('emailenableclick');

                $emailswitch = "&nbsp(<a title=\"$switchclick\" ".
                               "href=\"view.php?id=$user->id&course=$course->id&enable=1\">$switchtitle</a>)";
            }
        }

        print_row(get_string("email").":", obfuscate_mailto($user->email, '', $user->emailstop)."$emailswitch");
    }

    if ($user->url) {
        print_row(get_string("webpage").":", "<a href=\"$user->url\">$user->url</a>");
    }

    if ($user->icq) {
        print_row("ICQ:","<a href=\"http://web.icq.com/wwp?uin=$user->icq\">$user->icq <img src=\"http://web.icq.com/whitepages/online?icq=$user->icq&amp;img=5\" width=\"18\" height=\"18\" border=\"0\" alt=\"\" /></a>");
    }

    if (isteacher($course->id)) {
        if ($mycourses = get_my_courses($user->id)) {
            $courselisting = '';
            foreach ($mycourses as $mycourse) {
                if ($mycourse->visible and $mycourse->category) {
                    $courselisting .= "<a href=\"$CFG->wwwroot/user/view.php?id=$user->id&amp;course=$mycourse->id\">$mycourse->fullname</a>, ";
                }
            }
            print_row(get_string('courses').':', rtrim($courselisting,', '));
        }
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
    if (is_internal_auth() or ( $CFG->{'auth_'.$USER->auth.'_stdchangepassword'} and $CFG->{'auth_'.$USER->auth.'_stdchangepassword'} == 1)) {
        if(empty($CFG->loginhttps)) {
        $internalpassword = "$CFG->wwwroot/login/change_password.php";
        } else {
            $internalpassword = str_replace('http','https',$CFG->wwwroot.'/login/change_password.php');
        }
    }

//  Print other functions
    echo "<center><table align=\"center\"><tr>";
    if ($currentuser and !isguest()) {
        if ($internalpassword ) {
            echo "<td nowrap=\"nowrap\"><form action=\"$internalpassword\" method=\"get\">";
            echo "<input type=\"hidden\" name=\"id\" value=\"$course->id\" />";
            echo "<input type=\"submit\" value=\"".get_string("changepassword")."\" />";
            echo "</form></td>";
        } else if ( strlen($CFG->changepassword) > 1 ) {
            echo "<td nowrap=\"nowrap\"><form action=\"$CFG->changepassword\" method=\"get\">";
            echo "<input type=\"submit\" value=\"".get_string("changepassword")."\" />";
            echo "</form></td>";
        }
    }
    if ($course->category and
        ((isstudent($course->id) and ($user->id == $USER->id) and !isguest() and $CFG->allowunenroll) or
        (isteacheredit($course->id) and isstudent($course->id, $user->id))) ) {
        echo "<td nowrap=\"nowrap\"><form action=\"../course/unenrol.php\" method=\"get\" />";
        echo "<input type=\"hidden\" name=\"id\" value=\"$course->id\" />";
        echo "<input type=\"hidden\" name=\"user\" value=\"$user->id\" />";
        echo "<input type=\"submit\" value=\"".get_string("unenrolme", "", $course->shortname)."\">";
        echo "</form></td>";
    }
    if (isteacher($course->id) or ($course->showreports and $USER->id == $user->id)) {
        echo "<td nowrap=\"nowrap\"><form action=\"../course/user.php\" method=\"get\">";
        echo "<input type=\"hidden\" name=\"id\" value=\"$course->id\" />";
        echo "<input type=\"hidden\" name=\"user\" value=\"$user->id\" />";
        echo "<input type=\"submit\" value=\"".get_string("activityreport")."\" />";
        echo "</form></td>";
    }
    if ((isadmin() and !isadmin($user->id)) or (isteacher($course->id) and ($USER->id != $user->id) and !iscreator($user->id))) {
        echo "<td nowrap=\"nowrap\"><form action=\"../course/loginas.php\" method=\"get\">";
        echo "<input type=\"hidden\" name=\"id\" value=\"$course->id\" />";
        echo "<input type=\"hidden\" name=\"user\" value=\"$user->id\" />";
        echo "<input type=\"submit\" value=\"".get_string("loginas")."\" />";
        echo "</form></td>";
    }
    if (!empty($CFG->messaging)) {
        if ($USER->id == $user->id) {
            if ($countmessages = count_records('message', 'useridto', $user->id)) {
                $messagebuttonname = get_string("messages", "message")."($countmessages)";
            } else {
                $messagebuttonname = get_string("messages", "message");
            }
            echo "<td nowrap=\"nowrap\"><form target=\"message\" action=\"../message/index.php\" method=\"get\">";
            echo "<input type=\"submit\" value=\"$messagebuttonname\" onclick=\"return openpopup('/message/index.php', 'message', 'menubar=0,location=0,scrollbars,status,resizable,width=400,height=500', 0);\" />";
            echo "</form></td>";
        } else {
            echo "<td nowrap=\"nowrap\"><form target=\"message_$user->id\" action=\"../message/user.php\" method=\"get\">";
            echo "<input type=\"hidden\" name=\"id\" value=\"$user->id\" />";
            echo "<input type=\"submit\" value=\"".get_string("sendmessage", "message")."\" onclick=\"return openpopup('/message/user.php?id=$user->id', 'message_$user->id', 'menubar=0,location=0,scrollbars,status,resizable,width=400,height=500', 0);\" />";
            echo "</form></td>";
        }
    }
    echo "<td></td>";
    echo "</tr></table></center>\n";

    $isseparategroups = ($course->groupmode == SEPARATEGROUPS and
                         $course->groupmodeforce and
                         !isteacheredit($course->id));

    $groupid = $isseparategroups ? get_current_group($course->id) : NULL;

    forum_print_user_discussions($course->id, $user->id, $groupid);

    print_footer($course);

/// Functions ///////

function print_row($left, $right) {
    echo "\n<tr><td nowrap=\"nowrap\" align=\"right\" valign=\"top\">$left</td><td align=\"left\" valign=\"top\">$right</td></tr>\n";
}

?>
