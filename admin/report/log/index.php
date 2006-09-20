<?php // $Id$

    require_once('../../../config.php');
    require_once($CFG->dirroot.'/course/lib.php');
    require_once($CFG->dirroot.'/course/report/log/lib.php');
    require_once($CFG->libdir.'/adminlib.php');

    $adminroot = admin_get_root();

    admin_externalpage_setup('reportlog', $adminroot);

    admin_externalpage_print_header($adminroot);


    $course = get_site();

    print_heading(get_string('chooselogs') .':');

    print_log_selector_form($course);

    echo '<br />';
    print_heading(get_string('chooselivelogs') .':');

    echo '<center><h3>';
    link_to_popup_window('/course/report/log/live.php?id='. $course->id,'livelog', get_string('livelogs'), 500, 800);
    echo '</h3></center>';


    admin_externalpage_print_footer($adminroot);

?>
