<?php // $Id$
      // A quick way to add lots of questions to a category (and a quiz)

    require_once('../../config.php');
    require_once('locallib.php');

    $category = required_param('category');

    // This script can only be called while editing a quiz

    if (!isset($SESSION->modform)) {
        error('You have used this page incorrectly!');
    } else {
        $modform = $SESSION->modform;
    }

    if (! $category = get_record('quiz_categories', 'id', $category)) {
        error('Course ID is incorrect');
    }

    if (! $course = get_record('course', 'id', $category->course)) {
        error('Course ID is incorrect');
    }

    require_login($course->id);

    if (!isteacher($course->id)) {
        error('Only teachers can use this page!');
    }


/// If data submitted, then process and store.

    if ($form = data_submitted() and confirm_sesskey()) {
        if ($form->randomcreate > 0) {
            $newquestionids = array(); // this will hold the ids of the random questions
            
            // find existing random questions in this category
            $random = RANDOM;
            if ($existingquestions = get_records_select('quiz_questions', "qtype = '$random' AND category = '$category->id'")) {
                // now remove the ones that are already used in this quiz
                if ($questionids = explode(',', $modform->questions)) {
                    foreach ($questionids as $questionid) {
                        unset($existingquestions[$questionid]);
                    }
                }
                // now take as many of these as needed
                $i = 0;
                while (($existingquestion = array_pop($existingquestions)) and ($i < $form->randomcreate)) {
                    if ($existingquestion->questiontext == "$form->recurse") { 
                        // this question has the right recurse property, so use it
                        $newquestionids[] = $existingquestion->id;
                        $i++;
                    }
                }
                $randomcreate = $form->randomcreate - $i; // the number of additional random questions needed.
            } else {
                $randomcreate = $form->randomcreate;
            }

            if ($randomcreate > 0) {

                $question->qtype = RANDOM;
                $question->category = $category->id;
                $question->name = get_string('random', 'quiz') .' ('. $category->name .')';
                $question->questiontext = "$form->recurse"; // we use the questiontext field to store the info 
                                                            // on whether to include questions in subcategories
                $question->image = '';
                $question->defaultgrade = $form->randomgrade;
                for ($i=0; $i<$randomcreate; $i++) {
                    $question->stamp = make_unique_id_code();  // Set the unique code (not to be changed)
                    if (!$newquestionids[] = insert_record('quiz_questions', $question)) {
                        error('Could not insert new random question!');
                    }
                }
            }

            // Add them to the quiz
            if (!empty($modform->questions)) {
                $questionids = explode(',', $modform->questions);
            } else {
                $questionids = array();
            }

            foreach ($newquestionids as $newquestionid) {
                $modform->grades[$newquestionid] = $form->randomgrade;
                $modform->sumgrades += $form->randomgrade;
            }

            $newquestionids = array_merge($questionids, $newquestionids);
            $modform->questions = implode(',', $newquestionids);
            $SESSION->modform = $modform;
            if (!set_field('quiz', 'questions', $modform->questions, 'id', $modform->instance)) {
                error('Could not save question list');
            }
            quiz_questiongrades_update($modform->grades, $modform->instance);
        }
        redirect('edit.php');
    }


/// Otherwise print the form

/// Print headings

    $strquestions = get_string('questions', 'quiz');
    $strpublish = get_string('publish', 'quiz');
    $strdelete = get_string('delete');
    $straction = get_string('action');
    $stradd = get_string('add');
    $strcancel = get_string('cancel');
    $strsavechanges = get_string('savechanges');
    $strbacktoquiz = get_string('backtoquiz', 'quiz');
    $strquizzes = get_string('modulenameplural', 'quiz');
    $streditingquiz = get_string(isset($SESSION->modform->instance) ? 'editingquiz' : 'editquestions', 'quiz');
    $strcreatemultiple = get_string('createmultiple', 'quiz');

    print_header_simple($strcreatemultiple, $strcreatemultiple,
                 "<a href=\"$CFG->wwwroot/mod/quiz/index.php?id=$course->id\">$strquizzes</a>".
                 " -> <a href=\"edit.php\">$streditingquiz</a> -> $strcreatemultiple");


    print_heading_with_help($strcreatemultiple, 'createmultiple', 'quiz');

    if (!$categories = quiz_get_category_menu($course->id, true)) {
        error('No categories!');
    }

    for ($i=1;$i<=100; $i++) {
        $randomcount[$i] = $i;
    }
    for ($i=1;$i<=10; $i++) {
        $gradecount[$i] = $i;
    }
    $options = array();
    $options[0] = get_string('no');
    $options[1] = get_string('yes');

    print_simple_box_start('center', '', $THEME->cellheading);
    echo '<form method="POST" action="multiple.php">';
    echo "<input type=\"hidden\" name=\"sesskey\" value=\"$USER->sesskey\">";
    echo '<table cellpadding="5">';
    echo '<tr><td align="right">';
    print_string('category', 'quiz');
    echo ':</td><td>';
    // choose_from_menu($categories, "category", "$category->id", "");
    quiz_category_select_menu($course->id, true, true, $category->id );
    echo '</tr>';

    echo '<tr><td align="right">';
    print_string('randomcreate', 'quiz');
    echo ':</td><td>';
    choose_from_menu($randomcount, 'randomcreate', '10', '');
    echo '</tr>';

    echo '<tr><td align="right">';
    print_string('defaultgrade', 'quiz');
    echo ':</td><td>';
    choose_from_menu($gradecount, 'randomgrade', '1', '');
    echo '</tr>';

    echo '<tr><td>&nbsp;</td><td>';
    echo ' <input type="hidden" name="category" value="'. $category->id .'" />';
    echo ' <input type="submit" name="save" value="'. get_string('add') .'" />';
    echo '</td></tr>';
    echo '</table>';
    echo '</form>';
    print_simple_box_end();

    print_footer();

?>
