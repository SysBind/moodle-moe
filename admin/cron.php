<?PHP // $Id$

// This script looks through all the module directories for cron.php files
// and runs them.  These files can contain cleanup functions, email functions
// or anything that needs to be run on a regular basis.
//
// This file is best run from cron on the host system (ie outside PHP).
// The script can either be invoked via the web server or via a standalone
// version of PHP compiled for CGI.
//
// The script does not require a valid Moodle login, but has it's own unique
// password, set in ../config.php.  This is passed to this script as a parameter.
// 
// eg   wget -q -O /dev/null 'http://moodle.dougiamas.net/admin/cron.php?p=password'
// or   php /web/moodle/admin/cron.php password

    require("../config.php");

    echo "<PRE>\n";

    if (!isset($p)) {
        $p = $GLOBALS[argv][1];
    }

    if ($p <> $CFG->cronpassword) {
        add_to_log("Error: bad cron password!");
        echo "Error: bad password.\n";
        die;
    }

    $timenow  = time();

//  Run all cron jobs for each module

    if ($mods = get_records_sql("SELECT * FROM modules WHERE cron > 0 AND (($timenow - lastcron) > cron)")) {
        foreach ($mods as $mod) {
            $cronfile = "$CFG->dirroot/mod/$mod->name/cron.php";
            if (file_exists($cronfile)) {
                include($cronfile);
                if (! set_field("modules", "lastcron", $timenow, "id", $mod->id)) {
                    echo "Error: could not update timestamp for $mod->fullname\n";
                }
            }
        }
    }


//  Any system-wide Moodle cron jobs should be run here

    // Clean up users who never confirmed.



    echo "Cron script completed correctly\n";

?>
