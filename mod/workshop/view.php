<?php  // $Id: view.php, v1.1 23 Aug 2003

/*************************************************
    ACTIONS handled are:

    allowassessments (for teachers)
    allowboth (for teachers)
    allowsubmissions (for teachers)
    close workshop( for teachers)
    displayfinalgrade (for students)
    notavailable (for students)
    setupassignment (for teachers)
    studentsview
    submitexample 
    teachersview
    
************************************************/

    require("../../config.php");
    require("lib.php");
    require("locallib.php");
	
	require_variable($id);    // Course Module ID

    // get some useful stuff...
    if (! $cm = get_record("course_modules", "id", $id)) {
        error("Course Module ID was incorrect");
    }
    if (! $course = get_record("course", "id", $cm->course)) {
        error("Course is misconfigured");
    }
    if (! $workshop = get_record("workshop", "id", $cm->instance)) {
        error("Course module is incorrect");
    }

    require_login($course->id);

    // ...log activity...
    add_to_log($course->id, "workshop", "view", "view.php?id=$cm->id", $workshop->id, $cm->id);

    $strworkshops = get_string("modulenameplural", "workshop");
    $strworkshop  = get_string("modulename", "workshop");

    // ...display header...
    print_header_simple("$workshop->name", "",
                 "<a href=\"index.php?id=$course->id\">$strworkshops</a> -> $workshop->name", 
                  "", "", true, update_module_button($cm->id, $course->id, $strworkshop), navmenu($course, $cm));

    // ...and if necessary set default action 
    
    optional_variable($action);
    if (isteacher($course->id)) {
		if (empty($action)) { // no action specified, either go straight to elements page else the admin page
			// has the assignment any elements
			if (count_records("workshop_elements", "workshopid", $workshop->id) >= $workshop->nelements) {
				$action = "teachersview";
			}
			else {
    			redirect("assessments.php?action=editelements&id=$cm->id");
			}
		}
	}
	elseif (!isguest()) { // it's a student then
		if (!$cm->visible) {
			notice(get_string("activityiscurrentlyhidden"));
		}
		switch ($workshop->phase) {
			case 0 :
			case 1 : $action = 'notavailable'; break;
			case 2 :
			case 3 :
			case 4 : $action = 'studentsview'; break;
			case 5 : $action = 'displayfinalgrade';
		}
	}
	else { // it's a guest, oh no!
		$action = 'notavailable';
	}
	
	
	/************** allow (peer) assessments only (move to phase 4) (for teachers)**/
	if ($action == 'allowassessments') {

		if (!isteacher($course->id)) {
			error("Only teachers can look at this page");
		}
        
        // move to phase 4
        set_field("workshop", "phase", 4, "id", "$workshop->id");
        add_to_log($course->id, "workshop", "assessments only", "view.php?id=$cm->id", "$workshop->id", $cm->id);
        redirect("view.php?id=$cm->id", get_string("movingtophase", "workshop", 4));
	}
	

	/************** allow both (submissions and assessments) (move to phase 3) (for teachers)**/
	if ($action == 'allowboth') {

		if (!isteacher($course->id)) {
			error("Only teachers can look at this page");
		}

		// move to phase 3
		set_field("workshop", "phase", 3, "id", "$workshop->id");
		add_to_log($course->id, "workshop", "allow both", "view.php?id=$cm->id", "$workshop->id", $cm->id);
		redirect("view.php?id=$cm->id", get_string("movingtophase", "workshop", 3));
	}
	

	/************** allow submissions only (move to phase 2) (for teachers)**/
	if ($action == 'allowsubmissions') {

		if (!isteacher($course->id)) {
			error("Only teachers can look at this page");
		}

        // move to phase 2, check that teacher has made enough submissions
        if (workshop_count_teacher_submissions($workshop) < $workshop->ntassessments) {
            redirect("view.php?id=$cm->id", get_string("notenoughexamplessubmitted", "workshop", 
                        $course->teacher));
		}
		else {
			if ($n = workshop_count_teacher_submissions_for_assessment($workshop, $USER)) {
                notify(get_string("teachersubmissionsforassessment", "workshop", $n));
            }
            set_field("workshop", "phase", 2, "id", "$workshop->id");
			add_to_log($course->id, "workshop", "submissions", "view.php?id=$cm->id", "$workshop->id", $cm->id);
			redirect("view.php?id=$cm->id", get_string("movingtophase", "workshop", 2));
		}
	}
	

	/****************** display final grade (for students) ************************************/
	elseif ($action == 'displayfinalgrade' ) {

	
		// show the final grades as stored in the tables...
		print_heading_with_help(get_string("displayoffinalgrades", "workshop"), "finalgrades", "workshop");
		if ($submissions = workshop_get_user_submissions($workshop, $USER)) { // any submissions from user?
			echo "<center><table border=\"1\" width=\"90%\"><tr>";
			echo "<td><b>".get_string("submissions", "workshop")."</b></td>";
            if ($workshop->wtype) {
                echo "<td align=\"center\"><b>".get_string("assessmentsdone", "workshop")."</b></td>";
                echo "<td align=\"center\"><b>".get_string("gradeforassessments", "workshop")."</b></td>";
            }
			echo "<td align=\"center\"><b>".get_string("teacherassessments", "workshop", 
                        $course->teacher)."</b></td>";
            if ($workshop->wtype) {
                echo "<td align=\"center\"><b>".get_string("studentassessments", "workshop", 
                        $course->student)."</b></td>";
            }
            echo "<td align=\"center\"><b>".get_string("gradeforsubmission", "workshop")."</b></td>";
            echo "<td align=\"center\"><b>".get_string("overallgrade", "workshop")."</b></td></tr>\n";
            $gradinggrade = workshop_gradinggrade($workshop, $USER);
            foreach ($submissions as $submission) {
                $grade = workshop_submission_grade($workshop, $submission);
                echo "<tr><td>".workshop_print_submission_title($workshop, $submission)."</td>\n";
                if ($workshop->wtype) {
                    echo "<td align=\"center\">".workshop_print_user_assessments($workshop, $USER)."</td>";
                    echo "<td align=\"center\">$gradinggrade</td>";
                }
                echo "<td align=\"center\">".workshop_print_submission_assessments($workshop, 
                            $submission, "teacher")."</td>";
                if ($workshop->wtype) {
                    echo "<td align=\"center\">".workshop_print_submission_assessments($workshop, 
                            $submission, "student")."</td>";
                }
                echo "<td align=\"center\">$grade</td>";
                echo "<td align=\"center\">".number_format($gradinggrade + $grade, 1)."</td></tr>\n";
            }
        }
        echo "</table><br clear=\"all\" />\n";
		workshop_print_key($workshop);
        if ($workshop->showleaguetable) {
			workshop_print_league_table($workshop);
		}
	}


	/****************** make final grades available (go to phase 5) (for teachers only)********/
	elseif ($action == 'makefinalgradesavailable') {

		if (!isteacher($course->id)) {
			error("Only teachers can look at this page");
		}

		set_field("workshop", "phase", 5, "id", "$workshop->id");
		add_to_log($course->id, "workshop", "display grades", "view.php?id=$cm->id", "$workshop->id", $cm->id);
		redirect("view.php?id=$cm->id", get_string("movingtophase", "workshop", 5));
	}
	
	
	/****************** assignment not available (for students)***********************/
	elseif ($action == 'notavailable') {
		print_heading(get_string("notavailable", "workshop"));
	}


	/****************** set up assignment (move back to phase 1) (for teachers)***********************/
	elseif ($action == 'setupassignment') {

		if (!isteacher($course->id)) {
			error("Only teachers can look at this page");
		}

		set_field("workshop", "phase", 1, "id", "$workshop->id");
		add_to_log($course->id, "workshop", "set up", "view.php?id=$cm->id", "$workshop->id", $cm->id);
		redirect("view.php?id=$cm->id", get_string("movingtophase", "workshop", 1));
	}
	
	
	/****************** student's view could be in 1 of 4 stages ***********************/
	elseif ($action == 'studentsview') {
        // is a password needed?
		if ($workshop->usepassword) {
			$correctpass = false;
			if (isset($_POST['userpassword'])) {
				if ($workshop->password == md5(trim($_POST['userpassword']))) {
					$USER->workshoploggedin[$workshop->id] = true;
					$correctpass = true;
				}
			} elseif (isset($USER->workshoploggedin[$workshop->id])) {
				$correctpass = true;
			}

			if (!$correctpass) {
				print_simple_box_start("center");
				echo "<form name=\"password\" method=\"post\" action=\"view.php\">\n";
				echo "<input type=\"hidden\" name=\"id\" value=\"$cm->id\" />\n";
				echo "<table cellpadding=\"7px\">";
				if (isset($_POST['userpassword'])) {
					echo "<tr align=\"center\" style='color:#DF041E;'><td>".get_string("wrongpassword", "workshop").
                        "</td></tr>";
				}
				echo "<tr align=\"center\"><td>".get_string("passwordprotectedworkshop", "workshop", $workshop->name).
                    "</td></tr>";
				echo "<tr align=\"center\"><td>".get_string("enterpassword", "workshop").
                    " <input type=\"password\" name=\"userpassword\" /></td></tr>";
						
				echo "<tr align=\"center\"><td>";
				echo "<input type=\"button\" value=\"".get_string("cancel").
                    "\" onclick=\"parent.location='../../course/view.php?id=$course->id';\">  ";
				echo "<input type=\"button\" value=\"".get_string("continue").
                    "\" onclick=\"document.password.submit();\" />";
				echo "</td></tr></table>";
				print_simple_box_end();
				exit();
			}
		}
		workshop_print_assignment_info($workshop);
		// in Stage 1? - are there any teacher's submissions? and...
		// ...has student assessed the required number of the teacher's submissions 
		if ($workshop->ntassessments and (!workshop_test_user_assessments($workshop, $USER))) {
			print_heading(get_string("pleaseassesstheseexamplesfromtheteacher", "workshop", 
                        $course->teacher));
            workshop_list_teacher_submissions($workshop, $USER);
        }
        // in stage 2? - submit own first attempt
        else {
            if ($workshop->ntassessments) { 
                // show assessment the teacher's examples, there may be feedback from teacher
                print_heading(get_string("yourassessmentsofexamplesfromtheteacher", "workshop", 
                            $course->teacher));
                workshop_list_teacher_submissions($workshop, $USER);
            }
            // has user submitted anything yet? (only allowed in phases 2 and 3)
            if (!workshop_get_user_submissions($workshop, $USER)) {
                if ($workshop->phase < 4) {
                    // print upload form
                    print_heading(get_string("submitassignmentusingform", "workshop").":");
                    workshop_print_upload_form($workshop);
                } else {
                    print_heading(get_string("submissionsnolongerallowed", "workshop"));
                }
            }   
            // in stage 3? - grade other student's submissions, resubmit and list all submissions
            else {
                // is self assessment used in this workshop?
                if ($workshop->includeself) {
                    // prints a table if there are any submissions which have not been self assessed yet
                    workshop_list_self_assessments($workshop, $USER);
                }
                // if peer assessments are being done and workshop is in phase 3 then show some  to assess...
                if ($workshop->nsassessments and ($workshop->phase > 2)) {  
                    workshop_list_student_submissions($workshop, $USER);
                }
                // ..and any they have already done (and have gone cold)...
                if (workshop_count_user_assessments($workshop, $USER, "student")) {
                    print_heading(get_string("yourassessments", "workshop"));
                    workshop_list_assessed_submissions($workshop, $USER);
                }
                // list any assessments by teachers
                $timenow = time();
                if (workshop_count_teacher_assessments_by_user($workshop, $USER) and ($timenow > $workshop->releasegrades)) {
                    print_heading(get_string("assessmentsby", "workshop", $course->teachers));
                    workshop_list_teacher_assessments_by_user($workshop, $USER);
                }
                // ... and show peer assessments
                if (workshop_count_peer_assessments($workshop, $USER)) {
                    print_heading(get_string("assessmentsby", "workshop", $course->students));
                    workshop_list_peer_assessments($workshop, $USER);
                }
                // list previous submissions
                print_heading(get_string("submissions", "workshop"));
                workshop_list_user_submissions($workshop, $USER);
                // are resubmissions allowed and the workshop is in submission/assessment phase?
                if ($workshop->resubmit and ($workshop->phase == 3)) {
                    // see if there are any cold assessments of the last submission
                    // if there are then print upload form
                    if ($submissions = workshop_get_user_submissions($workshop, $USER)) {
                        foreach ($submissions as $submission) {
                            $lastsubmission = $submission;
                            break;
                        }
                        $n = 0; // number of cold assessments (not include self assessments)
                        if ($assessments = workshop_get_assessments($lastsubmission)) {
                            foreach ($assessments as $assessment) {
                                if ($assessment->userid <> $USER->id) {
                                    $n++;
                                }
                            }
                        }
                        if ($n) {
                            echo "<hr size=\"1\" noshade=\"noshade\" />";
                            print_heading(get_string("submitrevisedassignment", "workshop").":");
                            workshop_print_upload_form($workshop);
                            echo "<hr size=\"1\" noshade=\"noshade\" />";
                        }
                    }
				}
			}
		}
	}


	/****************** submission of example by teacher only***********************/
	elseif ($action == 'submitexample') {
	
		if (!isteacher($course->id)) {
			error("Only teachers can look at this page");
		}
			
		$strdifference = format_time($workshop->deadline - time());
		if (($workshop->deadline - time()) < 0) {
			$strdifference = "<font color=\"red\">$strdifference</font>";
		}
		$strduedate = userdate($workshop->deadline)." ($strdifference)";
	
		workshop_print_assignment_info($workshop);
		
		// list previous submissions from teacher 
		workshop_list_user_submissions($workshop, $USER);
	
		echo "<hr size=\"1\" noshade=\"noshade\" />";
	
		// print upload form
		print_heading(get_string("submitexampleassignment", "workshop").":");
		workshop_print_upload_form($workshop);
	}


	/****************** teacher's view - display admin page (current phase options) ************/
	elseif ($action == 'teachersview') {

		if (!isteacher($course->id)) {
			error("Only teachers can look at this page");
		}

	    /// Check to see if groups are being used in this workshop
        /// and if so, set $currentgroup to reflect the current group
        $changegroup = isset($_GET['group']) ? $_GET['group'] : -1;  // Group change requested?
        $groupmode = groupmode($course, $cm);   // Groups are being used?
        $currentgroup = get_and_set_current_group($course, $groupmode, $changegroup);
        
        /// Allow the teacher to change groups (for this session)
        if ($groupmode) {
            if ($groups = get_records_menu("groups", "courseid", $course->id, "name ASC", "id,name")) {
                print_group_menu($groups, $groupmode, $currentgroup, "view.php?id=$cm->id");
            }
        }
		
    	print_heading_with_help(get_string("managingassignment", "workshop"), "managing2", "workshop");
		
		workshop_print_assignment_info($workshop);
		
		if ($workshop->wtype < 2) {
            $tabs->names = array("1. ".get_string("phase1", "workshop"), 
                            "2. ".get_string("phase2", "workshop", $course->student), 
                            "3. ".get_string("phase5", "workshop"));
            $tabs->urls = array("view.php?id=$cm->id&amp;action=setupassignment", 
                "view.php?id=$cm->id&amp;action=allowboth",
                "view.php?id=$cm->id&amp;action=makefinalgradesavailable");
        } else {
            $tabs->names = array("1. ".get_string("phase1", "workshop"), 
                            "2. ".get_string("phase2", "workshop", $course->student), 
                            "3. ".get_string("phase3", "workshop", $course->student), 
                            "4. ".get_string("phase4", "workshop", $course->student), 
                            "5. ".get_string("phase5", "workshop"));
            if (isteacheredit($course->id)) {
                $tabs->urls = array("view.php?id=$cm->id&amp;action=setupassignment", 
                    "view.php?id=$cm->id&amp;action=allowsubmissions",
                    "view.php?id=$cm->id&amp;action=allowboth",
                    "view.php?id=$cm->id&amp;action=allowassessments",
                    "view.php?id=$cm->id&amp;action=makefinalgradesavailable");
            } else { 
                // non editing teachers cannot change phase
                $tabs->urls = array("view.php?id=$cm->id", 
                    "view.php?id=$cm->id",
                    "view.php?id=$cm->id",
                    "view.php?id=$cm->id",
                    "view.php?id=$cm->id");
            }
        }
        if ($workshop->phase) { // phase 1 or more
            if ($workshop->wtype < 2) {
                $tabs->highlight = ($workshop->phase - 1) / 2;
            } else {
                $tabs->highlight = $workshop->phase - 1;
            }
        } else {
            $tabs->highlight = 0; // phase is zero
        }
        workshop_print_tabbed_heading($tabs);
        echo "<center>\n";
        switch ($workshop->phase) {
            case 0:
            case 1: // set up assignment
                if ($workshop->nelements) {
                    echo "<br /><b><a href=\"assessments.php?id=$cm->id&amp;action=editelements\">".
                        get_string("amendassessmentelements", "workshop")."</a></b> \n";
                    helpbutton("elements", get_string("amendassessmentelements", "workshop"), "workshop");
                }
                if ($workshop->ntassessments) { 
                    // if teacher examples show submission and assessment links
                    echo "<br /><b><a href=\"view.php?id=$cm->id&amp;action=submitexample\">".
                        get_string("submitexampleassignment", "workshop")."</a></b> \n";
                    helpbutton("submissionofexamples", get_string("submitexampleassignment", "workshop"),
                            "workshop");
                    echo "<br /><b><a href=\"submissions.php?id=$cm->id&amp;action=listforassessmentteacher\">".
                        get_string("teachersubmissionsforassessment", "workshop", 
                                workshop_count_teacher_submissions_for_assessment($workshop, $USER)).
                        "</a></b> \n";
                    helpbutton("assessmentofexamples", get_string("teachersubmissionsforassessment", 
                                "workshop"), "workshop");
                }
                break;

            case 2: // submissions
            case 3: // submissions and assessments
            case 4: // assessments
                if ($workshop->ntassessments) { // if teacher examples show assessment link
                    if ($n = workshop_count_teacher_submissions_for_assessment($workshop, $USER)) {
                        echo "<br /><b><a href=\"submissions.php?id=$cm->id&amp;action=listforassessmentteacher\">".
                            get_string("teachersubmissionsforassessment", "workshop", $n)."</a></b> \n";
                        helpbutton("assessmentofexamples", get_string("teachersubmissionsforassessment", 
                                    "workshop"), "workshop");
                    }
                }
                // only show grading assessments if there are grading grades involved
                if ($workshop->wtype) {
                    echo "<br /><b><a href=\"assessments.php?id=$cm->id&amp;action=gradeallassessments\">".
                        get_string("ungradedassessments", "workshop", 
                        workshop_count_ungraded_assessments($workshop))."</a></b> \n";
                    helpbutton("ungradedassessments", 
                        get_string("ungradedassessments", "workshop"), "workshop");
                }
                // don't show the assessment of student submissions in phase 2 if it's a 5 phase workshop
                if (!(($workshop->phase == 2) and ($workshop->wtype > 1))) {
                    echo "<br /><b><a href=\"submissions.php?id=$cm->id&amp;action=listforassessmentstudent\">".
                        get_string("studentsubmissionsforassessment", "workshop", 
                        workshop_count_student_submissions_for_assessment($workshop, $USER))."</a></b> \n";
                    helpbutton("gradingsubmissions", 
                        get_string("studentsubmissionsforassessment", "workshop"), "workshop");
                }
                print_heading("<a href=\"submissions.php?id=$cm->id&amp;action=displaycurrentgrades\">".
                        get_string("displayofcurrentgrades", "workshop")."</a>");
                break;

            case 5: // Show "Final" Grades
                if ($workshop->ntassessments) { // if teacher examples show assessment link
                    if ($n = workshop_count_teacher_submissions_for_assessment($workshop, $USER)) {
                        echo "<br /><b><a href=\"submissions.php?id=$cm->id&amp;action=listforassessmentteacher\">".
                            get_string("teachersubmissionsforassessment", "workshop", $n)."</a></b> \n";
                        helpbutton("assessmentofexamples", get_string("teachersubmissionsforassessment", 
                                    "workshop"), "workshop");
                    }
                }
                if ($workshop->wtype) {
                    echo "<br /><b><a href=\"assessments.php?id=$cm->id&amp;action=gradeallassessments\">".
                        get_string("ungradedassessments", "workshop", 
                        workshop_count_ungraded_assessments($workshop))."</a></b> \n";
                    helpbutton("ungradedassessments", get_string("ungradedassessments", "workshop"), "workshop");
                }
                echo "<br /><b><a href=\"submissions.php?id=$cm->id&amp;action=listforassessmentstudent\">".
                    get_string("studentsubmissionsforassessment", "workshop", 
                            workshop_count_student_submissions_for_assessment($workshop, $USER))."</a></b> \n";
                helpbutton("gradingsubmissions", 
                        get_string("studentsubmissionsforassessment", "workshop"), "workshop");
                print_heading("<a href=\"submissions.php?id=$cm->id&amp;action=displayfinalgrades\">".
                        get_string("displayoffinalgrades", "workshop")."</a>");
        }
        echo '</center>';
        print_heading("<a href=\"submissions.php?id=$cm->id&amp;action=adminlist\">".
            get_string("administration")."</a>");
    }
    
    
    /*************** no man's land **************************************/
    else {
        error("Fatal Error: Unknown Action: ".$action."\n");
    }

    print_footer($course);
    
?>
