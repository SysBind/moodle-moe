<?PHP // $Id$

    require_once("../../config.php");
    require_once("lib.php");

    require_variable($id);   // course module

    if (! $cm = get_record("course_modules", "id", $id)) {
        error("Course Module ID was incorrect");
    }

    if (! $course = get_record("course", "id", $cm->course)) {
        error("Course module is misconfigured");
    }

    require_login($course->id);

    if (!isteacher($course->id)) {
        error("Only teachers can look at this page");
    }

    if (! $journal = get_record("journal", "id", $cm->instance)) {
        error("Course module is incorrect");
    }

    // make some easy ways to access the entries.
    if ( $eee = get_records("journal_entries", "journal", $journal->id)) {
        foreach ($eee as $ee) {
            $entrybyuser[$ee->userid] = $ee;
            $entrybyentry[$ee->id]  = $ee;
        }
        
    } else {
        $entrybyuser = array () ;
        $entrybyentry   = array () ;
    }

    print_header("$course->shortname: Journals", "$course->fullname",
                 "<A HREF=../../course/view.php?id=$course->id>$course->shortname</A> ->
                  <A HREF=index.php?id=$course->id>Journals</A> ->
                  <A HREF=view.php?id=$cm->id>$journal->name</A> -> Responses", "",
                  "", true);

    if ($data = data_submitted()) {
       
        $feedback = array();
        $data = (array)$data;

        // Peel out all the data from variable names.
        foreach ($data as $key => $val) {
            if ($key <> "id") {
                $type = substr($key,0,1);
                $num  = substr($key,1); 
                $feedback[$num][$type] = $val;
            }
        }

        $timenow = time();
        $count = 0;
        foreach ($feedback as $num => $vals) {
            $entry = $entrybyentry[$num];
            // Only update entries where feedback has actually changed.
            if (($vals[r] <> $entry->rating) || ($vals[c] <> addslashes($entry->comment))) {
                $newentry->rating     = $vals[r];
                $newentry->comment    = $vals[c];
                $newentry->teacher    = $USER->id;
                $newentry->timemarked = $timenow;
                $newentry->mailed     = 0;           // Make sure mail goes out (again, even)
                $newentry->id         = $num;
                if (! update_record("journal_entries", $newentry)) {
                    notify("Failed to update the journal feedback for user $entry->userid");
                } else {
                    $count++;
                }
                $entrybyuser[$entry->userid]->rating     = $vals[r];
                $entrybyuser[$entry->userid]->comment    = $vals[c];
                $entrybyuser[$entry->userid]->teacher    = $USER->id;
                $entrybyuser[$entry->userid]->timemarked = $timenow;
            }
        }
        add_to_log($course->id, "journal", "update feedback", "report.php?id=$cm->id", "$count users");
        notify(get_string("feedbackupdated", "journal", "$count"), "green");
    } else {
        add_to_log($course->id, "journal", "view responses", "report.php?id=$cm->id", "$journal->id");
    }


    $teachers = get_course_teachers($course->id);
    if (! $users = get_course_users($course->id)) {
        print_heading(get_string("nousersyet"));

    } else {
        echo "<FORM ACTION=report.php METHOD=post>\n";

        if ($usersdone = journal_get_users_done($journal)) {
            foreach ($usersdone as $user) {
                $entry = $entrybyuser[$user->id];
                journal_print_user_entry($course, $user, $entry, $teachers, $JOURNAL_RATING);
            }
        }

        foreach ($users as $user) {
            if (empty($usersdone[$user->id])) {
                $entry = NULL;
                journal_print_user_entry($course, $user, $entry, $teachers, $JOURNAL_RATING);
            }
        }

        $strsaveallfeedback = get_string("saveallfeedback", "journal");
        echo "<CENTER>";
        echo "<INPUT TYPE=hidden NAME=id VALUE=\"$cm->id\">";
        echo "<INPUT TYPE=submit VALUE=\"$strsaveallfeedback\">";
        echo "</CENTER>";
        echo "</FORM>";
    }
    
    print_footer($course);
 
?>

