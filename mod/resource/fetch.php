<?php

    require_once("../../config.php");
    require_once("lib.php");
    require_once("../../lib/snoopy/Snoopy.class.inc");
 
    require_variable($id);    // Course Module ID
    require_variable($url);   // url to fetch
    
    if (! $cm = get_record("course_modules", "id", $id)) {
        error("Course Module ID was incorrect");
    }

    if (! $course = get_record("course", "id", $cm->course)) {
        error("Course is misconfigured");
    }

    if (! $resource = get_record("resource", "id", $cm->instance)) {
        error("Resource ID was incorrect");
    }

    $content = resource_fetch_remote_file($cm, $url);
    
    echo format_text($content->results,FORMAT_HTML);
?>