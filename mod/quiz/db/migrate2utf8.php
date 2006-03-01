<?
function migrate2utf8_question_name($recordid){
    global $CFG, $globallang;

/// Some trivial checks
    if (empty($recordid)) {
        log_the_problem_somewhere();
        return false;
    }
    
    $SQL = "SELECT qc.course
           FROM {$CFG->prefix}question_categories qc,
                {$CFG->prefix}question qq
           WHERE qc.id = qq.category
                 AND qq.id = $recordid";

    if (!$quiz = get_record_sql($SQL)) {
        log_the_problem_somewhere();
        return false;
    }

    if (!$quizquestions = get_record('question','id',$recordid)) {
        log_the_problem_somewhere();
        return false;
    }
    if ($globallang) {
        $fromenc = $globallang;
    } else {
        $sitelang   = $CFG->lang;
        $courselang = get_course_lang($quiz->course);  //Non existing!
        $userlang   = get_main_teacher_lang($quiz->course); //N.E.!!

        $fromenc = get_original_encoding($sitelang, $courselang, $userlang);
    }

/// We are going to use textlib facilities
    
/// Convert the text
    if (($fromenc != 'utf-8') && ($fromenc != 'UTF-8')) {
        $result = utfconvert($quizquestions->name, $fromenc);

        $newquizquestion = new object;
        $newquizquestion->id = $recordid;
        $newquizquestion->name = $result;
        update_record('question',$newquizquestion);
    }
/// And finally, just return the converted field
    return $result;
}

function migrate2utf8_question_questiontext($recordid){
    global $CFG, $globallang;

/// Some trivial checks
    if (empty($recordid)) {
        log_the_problem_somewhere();
        return false;
    }

    $SQL = "SELECT qc.course
           FROM {$CFG->prefix}question_categories qc,
                {$CFG->prefix}question qq
           WHERE qc.id = qq.category
                 AND qq.id = $recordid";

    if (!$quiz = get_record_sql($SQL)) {
        log_the_problem_somewhere();
        return false;
    }

    if (!$quizquestions = get_record('question','id',$recordid)) {
        log_the_problem_somewhere();
        return false;
    }

    if ($globallang) {
        $fromenc = $globallang;
    } else {
        $sitelang   = $CFG->lang;
        $courselang = get_course_lang($quiz->course);  //Non existing!
        $userlang   = get_main_teacher_lang($quiz->course); //N.E.!!

        $fromenc = get_original_encoding($sitelang, $courselang, $userlang);
    }

/// We are going to use textlib facilities
    
/// Convert the text
    if (($fromenc != 'utf-8') && ($fromenc != 'UTF-8')) {
        $result = utfconvert($quizquestions->questiontext, $fromenc);

        $newquizquestion = new object;
        $newquizquestion->id = $recordid;
        $newquizquestion->questiontext = $result;
        update_record('question',$newquizquestion);
    }
/// And finally, just return the converted field
    return $result;
}


function migrate2utf8_quiz_numerical_units_unit($recordid){
    global $CFG, $globallang;

/// Some trivial checks
    if (empty($recordid)) {
        log_the_problem_somewhere();
        return false;
    }

    $SQL = "SELECT qc.course
           FROM {$CFG->prefix}question_categories qc,
                {$CFG->prefix}question qq,
                {$CFG->prefix}quiz_numerical_units qnu
           WHERE qc.id = qq.category
                 AND qq.id = qnu.question
                 AND qnu.id =  $recordid";

    if (!$quiz = get_record_sql($SQL)) {
        log_the_problem_somewhere();
        return false;
    }

    if (!$quiznumericalunits = get_record('quiz_numerical_units','id',$recordid)) {
        log_the_problem_somewhere();
        return false;
    }

    if ($globallang) {
        $fromenc = $globallang;
    } else {
        $sitelang   = $CFG->lang;
        $courselang = get_course_lang($quiz->course);  //Non existing!
        $userlang   = get_main_teacher_lang($quiz->course); //N.E.!!

        $fromenc = get_original_encoding($sitelang, $courselang, $userlang);
    }

/// We are going to use textlib facilities
    
/// Convert the text
    if (($fromenc != 'utf-8') && ($fromenc != 'UTF-8')) {
        $result = utfconvert($quiznumericalunits->unit, $fromenc);

        $newquiznumericalunits = new object;
        $newquiznumericalunits->id = $recordid;
        $newquiznumericalunits->unit = $result;
        update_record('quiz_numerical_units',$newquiznumericalunits);
    }
/// And finally, just return the converted field
    return $result;
}

function migrate2utf8_quiz_match_sub_questiontext($recordid){
    global $CFG, $globallang;

/// Some trivial checks
    if (empty($recordid)) {
        log_the_problem_somewhere();
        return false;
    }

    $SQL = "SELECT qc.course
           FROM {$CFG->prefix}question_categories qc,
                {$CFG->prefix}question qq,
                {$CFG->prefix}quiz_match_sub qms
           WHERE qc.id = qq.category
                 AND qq.id = qms.question
                 AND qms.id = $recordid";

    if (!$quiz = get_record_sql($SQL)) {
        log_the_problem_somewhere();
        return false;
    }

    if (!$quizmatchsub = get_record('quiz_match_sub','id',$recordid)) {
        log_the_problem_somewhere();
        return false;
    }

    if ($globallang) {
        $fromenc = $globallang;
    } else {
        $sitelang   = $CFG->lang;
        $courselang = get_course_lang($quiz->course);  //Non existing!
        $userlang   = get_main_teacher_lang($quiz->course); //N.E.!!

        $fromenc = get_original_encoding($sitelang, $courselang, $userlang);
    }

/// We are going to use textlib facilities
    
/// Convert the text
    if (($fromenc != 'utf-8') && ($fromenc != 'UTF-8')) {
        $result = utfconvert($quizmatchsub->questiontext, $fromenc);

        $newquizmatchsub = new object;
        $newquizmatchsub->id = $recordid;
        $newquizmatchsub->questiontext = $result;
        update_record('quiz_match_sub',$newquizmatchsub);
    }
/// And finally, just return the converted field
    return $result;
}

function migrate2utf8_quiz_match_sub_answertext($recordid){
    global $CFG, $globallang;

/// Some trivial checks
    if (empty($recordid)) {
        log_the_problem_somewhere();
        return false;
    }

    $SQL = "SELECT qc.course
           FROM {$CFG->prefix}question_categories qc,
                {$CFG->prefix}question qq,
                {$CFG->prefix}quiz_match_sub qms
           WHERE qc.id = qq.category
                 AND qq.id = qms.question
                 AND qms.id = $recordid";

    if (!$quiz = get_record_sql($SQL)) {
        log_the_problem_somewhere();
        return false;
    }

    if (!$quizmatchsub = get_record('quiz_match_sub','id',$recordid)) {
        log_the_problem_somewhere();
        return false;
    }

    if ($globallang) {
        $fromenc = $globallang;
    } else {
        $sitelang   = $CFG->lang;
        $courselang = get_course_lang($quiz->course);  //Non existing!
        $userlang   = get_main_teacher_lang($quiz->course); //N.E.!!

        $fromenc = get_original_encoding($sitelang, $courselang, $userlang);
    }

/// We are going to use textlib facilities
    
/// Convert the text
    if (($fromenc != 'utf-8') && ($fromenc != 'UTF-8')) {
        $result = utfconvert($quizmatchsub->answertext, $fromenc);

        $newquizmatchsub = new object;
        $newquizmatchsub->id = $recordid;
        $newquizmatchsub->answertext = $result;
        update_record('quiz_match_sub',$newquizmatchsub);
    }
/// And finally, just return the converted field
    return $result;
}

function migrate2utf8_question_answers_answer($recordid){
    global $CFG, $globallang;

/// Some trivial checks
    if (empty($recordid)) {
        log_the_problem_somewhere();
        return false;
    }

    $SQL = "SELECT qc.course
           FROM {$CFG->prefix}question_categories qc,
                {$CFG->prefix}question qq,
                {$CFG->prefix}question_answers qa
           WHERE qc.id = qq.category
                 AND qq.id = qa.question
                 AND qa.id = $recordid";

    if (!$quiz = get_record_sql($SQL)) {
        log_the_problem_somewhere();
        return false;
    }

    if (!$quizanswer= get_record('question_answers','id',$recordid)) {
        log_the_problem_somewhere();
        return false;
    }

    if ($globallang) {
        $fromenc = $globallang;
    } else {
        $sitelang   = $CFG->lang;
        $courselang = get_course_lang($quiz->course);  //Non existing!
        $userlang   = get_main_teacher_lang($quiz->course); //N.E.!!

        $fromenc = get_original_encoding($sitelang, $courselang, $userlang);
    }

/// We are going to use textlib facilities
    
/// Convert the text
    if (($fromenc != 'utf-8') && ($fromenc != 'UTF-8')) {
        $result = utfconvert($quizanswer->answer, $fromenc);

        $newquizanswer = new object;
        $newquizanswer->id = $recordid;
        $newquizanswer->answer = $result;
        update_record('question_answers',$newquizanswer);
    }
/// And finally, just return the converted field
    return $result;
}

function migrate2utf8_question_answers_feedback($recordid){
    global $CFG, $globallang;

/// Some trivial checks
    if (empty($recordid)) {
        log_the_problem_somewhere();
        return false;
    }

    $SQL = "SELECT qc.course
           FROM {$CFG->prefix}question_categories qc,
                {$CFG->prefix}question qq,
                {$CFG->prefix}question_answers qa
           WHERE qc.id = qq.category
                 AND qq.id = qa.question
                 AND qa.id = $recordid";

    if (!$quiz = get_record_sql($SQL)) {
        log_the_problem_somewhere();
        return false;
    }

    if (!$quizanswer= get_record('question_answers','id',$recordid)) {
        log_the_problem_somewhere();
        return false;
    }

    if ($globallang) {
        $fromenc = $globallang;
    } else {
        $sitelang   = $CFG->lang;
        $courselang = get_course_lang($quiz->course);  //Non existing!
        $userlang   = get_main_teacher_lang($quiz->course); //N.E.!!

        $fromenc = get_original_encoding($sitelang, $courselang, $userlang);
    }

/// We are going to use textlib facilities
    
/// Convert the text
    if (($fromenc != 'utf-8') && ($fromenc != 'UTF-8')) {
        $result = utfconvert($quizanswer->feedback, $fromenc);

        $newquizanswer = new object;
        $newquizanswer->id = $recordid;
        $newquizanswer->feedback = $result;
        update_record('question_answers',$newquizanswer);
    }
/// And finally, just return the converted field
    return $result;
}





function migrate2utf8_quiz_dataset_definitions_name($recordid){
    global $CFG, $globallang;

/// Some trivial checks
    if (empty($recordid)) {
        log_the_problem_somewhere();
        return false;
    }

    $SQL = "SELECT qc.course
           FROM {$CFG->prefix}question_categories qc,
                {$CFG->prefix}quiz_dataset_definitions qdd
           WHERE qc.id = qdd.category
                 AND qdd.id = $recordid";

    if (!$quiz = get_record_sql($SQL)) {
        log_the_problem_somewhere();
        return false;
    }

    if (!$quizdatasetdefinition = get_record('quiz_dataset_definitions','id',$recordid)) {
        log_the_problem_somewhere();
        return false;
    }

    if ($globallang) {
        $fromenc = $globallang;
    } else {
        $sitelang   = $CFG->lang;
        $courselang = get_course_lang($quiz->course);  //Non existing!
        $userlang   = get_main_teacher_lang($quiz->course); //N.E.!!

        $fromenc = get_original_encoding($sitelang, $courselang, $userlang);
    }

/// We are going to use textlib facilities
    
/// Convert the text
    if (($fromenc != 'utf-8') && ($fromenc != 'UTF-8')) {
        $result = utfconvert($quizdatasetdefinition->name, $fromenc);

        $newquizdatasetdefinition = new object;
        $newquizdatasetdefinition->id = $recordid;
        $newquizdatasetdefinition->name = $result;
        update_record('quiz_dataset_definitions',$newquizdatasetdefinition);
    }
/// And finally, just return the converted field
    return $result;
}

function migrate2utf8_question_categories_name($recordid){
    global $CFG, $globallang;

/// Some trivial checks
    if (empty($recordid)) {
        log_the_problem_somewhere();
        return false;
    }

    $SQL = "SELECT qc.course
           FROM {$CFG->prefix}question_categories qc
           WHERE qc.id = $recordid";

    if (!$quiz = get_record_sql($SQL)) {
        log_the_problem_somewhere();
        return false;
    }

    if (!$quizcategory = get_record('question_categories','id',$recordid)) {
        log_the_problem_somewhere();
        return false;
    }

    if ($globallang) {
        $fromenc = $globallang;
    } else {
        $sitelang   = $CFG->lang;
        $courselang = get_course_lang($quiz->course);  //Non existing!
        $userlang   = get_main_teacher_lang($quiz->course); //N.E.!!

        $fromenc = get_original_encoding($sitelang, $courselang, $userlang);
    }

/// We are going to use textlib facilities
    
/// Convert the text
    if (($fromenc != 'utf-8') && ($fromenc != 'UTF-8')) {
        $result = utfconvert($quizcategory->name, $fromenc);

        $newquizcategory = new object;
        $newquizcategory->id = $recordid;
        $newquizcategory->name = $result;
        update_record('question_categories',$newquizcategory);
    }
/// And finally, just return the converted field
    return $result;
}

function migrate2utf8_question_categories_info($recordid){
    global $CFG, $globallang;

/// Some trivial checks
    if (empty($recordid)) {
        log_the_problem_somewhere();
        return false;
    }

    $SQL = "SELECT qc.course
           FROM {$CFG->prefix}question_categories qc
           WHERE qc.id = $recordid";

    if (!$quiz = get_record_sql($SQL)) {
        log_the_problem_somewhere();
        return false;
    }

    if (!$quizcategory = get_record('question_categories','id',$recordid)) {
        log_the_problem_somewhere();
        return false;
    }

    if ($globallang) {
        $fromenc = $globallang;
    } else {
        $sitelang   = $CFG->lang;
        $courselang = get_course_lang($quiz->course);  //Non existing!
        $userlang   = get_main_teacher_lang($quiz->course); //N.E.!!

        $fromenc = get_original_encoding($sitelang, $courselang, $userlang);
    }

/// We are going to use textlib facilities
    
/// Convert the text
    if (($fromenc != 'utf-8') && ($fromenc != 'UTF-8')) {
        $result = utfconvert($quizcategory->info, $fromenc);

        $newquizcategory = new object;
        $newquizcategory->id = $recordid;
        $newquizcategory->info = $result;
        update_record('question_categories',$newquizcategory);
    }
/// And finally, just return the converted field

    return $result;
}

function migrate2utf8_quiz_name($recordid){
    global $CFG, $globallang;

/// Some trivial checks
    if (empty($recordid)) {
        log_the_problem_somewhere();
        return false;
    }

    if (!$quiz = get_record('quiz','id',$recordid)) {
        log_the_problem_somewhere();
        return false;
    }

    if ($globallang) {
        $fromenc = $globallang;
    } else {
        $sitelang   = $CFG->lang;
        $courselang = get_course_lang($quiz->course);  //Non existing!
        $userlang   = get_main_teacher_lang($quiz->course); //N.E.!!

        $fromenc = get_original_encoding($sitelang, $courselang, $userlang);
    }

/// We are going to use textlib facilities
    
/// Convert the text
    if (($fromenc != 'utf-8') && ($fromenc != 'UTF-8')) {
        $result = utfconvert($quiz->name, $fromenc);

        $newquiz = new object;
        $newquiz->id = $recordid;
        $newquiz->name = $result;
        update_record('quiz',$newquiz);
    }
/// And finally, just return the converted field
    return $result;
}


function migrate2utf8_quiz_intro($recordid){
    global $CFG, $globallang;

/// Some trivial checks
    if (empty($recordid)) {
        log_the_problem_somewhere();
        return false;
    }

    if (!$quiz = get_record('quiz','id',$recordid)) {
        log_the_problem_somewhere();
        return false;
    }

    if ($globallang) {
        $fromenc = $globallang;
    } else {
        $sitelang   = $CFG->lang;
        $courselang = get_course_lang($quiz->course);  //Non existing!
        $userlang   = get_main_teacher_lang($quiz->course); //N.E.!!

        $fromenc = get_original_encoding($sitelang, $courselang, $userlang);
    }

/// We are going to use textlib facilities
    
/// Convert the text
    if (($fromenc != 'utf-8') && ($fromenc != 'UTF-8')) {
        $result = utfconvert($quiz->intro, $fromenc);

        $newquiz = new object;
        $newquiz->id = $recordid;
        $newquiz->intro = $result;
        update_record('quiz',$newquiz);
    }
/// And finally, just return the converted field
    return $result;
}

function migrate2utf8_quiz_password($recordid){
    global $CFG, $globallang;

/// Some trivial checks
    if (empty($recordid)) {
        log_the_problem_somewhere();
        return false;
    }

    if (!$quiz = get_record('quiz','id',$recordid)) {
        log_the_problem_somewhere();
        return false;
    }

    if ($globallang) {
        $fromenc = $globallang;
    } else {
        $sitelang   = $CFG->lang;
        $courselang = get_course_lang($quiz->course);  //Non existing!
        $userlang   = get_main_teacher_lang($quiz->course); //N.E.!!

        $fromenc = get_original_encoding($sitelang, $courselang, $userlang);
    }

/// We are going to use textlib facilities
    if (($fromenc != 'utf-8') && ($fromenc != 'UTF-8')) {
/// Convert the text
        $result = utfconvert($quiz->password, $fromenc);

        $newquiz = new object;
        $newquiz->id = $recordid;
        $newquiz->password = $result;
        update_record('quiz',$newquiz);
    }
/// And finally, just return the converted field
    return $result;
}
?>
