<?php  // $Id$

///////////////////
/// DESCRIPTION ///
///////////////////

/// QUESTION TYPE CLASS //////////////////

//
// The question type DESCRIPTION is not really a question type
// and it therefore often sticks to some kind of odd behaviour
//

class quiz_description_qtype extends quiz_default_questiontype {

    function name() {
        return 'description';
    }

    function get_question_options(&$question) {
        // No options to be restored for this question type
        return true;
    }

    function save_question_options($question) {
        /// No options to be saved for this question type:
        return true;
    }

    function print_question(&$question, &$state, $number, $cmoptions, $options) {
        print_simple_box_start('center', '90%');
        echo format_text($question->questiontext,
                         $question->questiontextformat,
                         NULL, $cmoptions->course);
        quiz_print_possible_question_image($question, $cmoptions->course);
        if (isteacher($cmoptions->course)) {
            echo '<font size="1">';
            link_to_popup_window ('/question/question.php?id=' . $question->id,
             'editquestion', get_string('edit'), 450, 550, get_string('edit'));
            echo '</font>';
        }
        print_simple_box_end('center', '90%');
    }

    function actual_number_of_questions($question) {
        /// Used for the feature number-of-questions-per-page
        /// to determine the actual number of questions wrapped
        /// by this question.
        /// The question type description is not even a question
        /// in itself so it will return ZERO!
        return 0;
    }

    function grade_responses(&$question, &$state, $cmoptions) {
        $state->raw_grade = 0;
        $state->penalty = 0;
    }

}
//// END OF CLASS ////

//////////////////////////////////////////////////////////////////////////
//// INITIATION - Without this line the question type is not in use... ///
//////////////////////////////////////////////////////////////////////////
$QTYPES[DESCRIPTION]= new quiz_description_qtype();

?>
