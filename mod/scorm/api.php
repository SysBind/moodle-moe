<?php

    require_once("../../config.php");
    require_once('locallib.php');
    
    $id = optional_param('id', '', PARAM_INT);       // Course Module ID, or
    $a = optional_param('a', '', PARAM_INT);         // scorm ID
    $scoid = required_param('scoid', PARAM_INT);     // sco ID
    $mode = optional_param('mode', '', PARAM_ALPHA); // navigation mode
    $attempt = required_param('attempt', PARAM_INT); // new attempt

    if (!empty($id)) {
        if (! $cm = get_coursemodule_from_id('scorm', $id)) {
            print_error("Course Module ID was incorrect");
        }
        if (! $course = $DB->get_record("course", array("id"=>$cm->course))) {
            print_error("Course is misconfigured");
        }
        if (! $scorm = $DB->get_record("scorm", array("id"=>$cm->instance))) {
            print_error("Course module is incorrect");
        }
    } else if (!empty($a)) {
        if (! $scorm = $DB->get_record("scorm", array("id"=>$a))) {
            print_error("Course module is incorrect");
        }
        if (! $course = $DB->get_record("course", array("id"=>$scorm->course))) {
            print_error("Course is misconfigured");
        }
        if (! $cm = get_coursemodule_from_instance("scorm", $scorm->id, $course->id)) {
            print_error("Course Module ID was incorrect");
        }
    } else {
        print_error('A required parameter is missing');
    }

    require_login($course->id, false, $cm);
    
    if ($usertrack=scorm_get_tracks($scoid,$USER->id,$attempt)) {
        if ((isset($usertrack->{'cmi.exit'}) && ($usertrack->{'cmi.exit'} != 'time-out')) || ($scorm->version != "SCORM_1.3")) {
            $userdata = $usertrack;
        } else {
            $userdata->status = '';
            $userdata->score_raw = '';
        }
    } else {
        $userdata->status = '';
        $userdata->score_raw = '';
    }
    $userdata->student_id = $USER->username;
    $userdata->student_name = $USER->lastname .', '. $USER->firstname;
    $userdata->mode = 'normal';
    if (isset($mode)) {
        $userdata->mode = $mode;
    }
    if ($userdata->mode == 'normal') {
        $userdata->credit = 'credit';
    } else {
        $userdata->credit = 'no-credit';
    }    
    if ($scodatas = scorm_get_sco($scoid, SCO_DATA)) {
        foreach ($scodatas as $key => $value) {
            $userdata->$key = $value;
        }
    } else {
        print_error('Sco not found');
    }
    $scorm->version = strtolower(clean_param($scorm->version, PARAM_SAFEDIR));   // Just to be safe
    if (file_exists($CFG->dirroot.'/mod/scorm/datamodels/'.$scorm->version.'.js.php')) {
        include_once($CFG->dirroot.'/mod/scorm/datamodels/'.$scorm->version.'.js.php');
    } else {
        include_once($CFG->dirroot.'/mod/scorm/datamodels/scorm_12.js.php');
    }
?>

var errorCode = "0";
function underscore(str) {
    str = str.replace(/.N/g,".");
    return str.replace(/\./g,"__");
}
