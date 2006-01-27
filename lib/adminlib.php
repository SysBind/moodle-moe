<?php  //
       // 

/**
 * adminlib.php - Contains functions that only administrators will ever need to use
 *
 * @author Martin Dougiamas
 * @version  $Id$
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package moodlecore
 */

/**
 * upgrade_enrol_plugins
 *
 * long description
 *
 * @uses $db
 * @uses $CFG
 * @param string  $return The url to prompt the user to continue to
 * @todo Finish documenting this function
 */ 
function upgrade_enrol_plugins($return) {
    global $CFG, $db;

    if (!$mods = get_list_of_plugins('enrol') ) {
        error('No modules installed!');
    }

    foreach ($mods as $mod) {

        $fullmod = $CFG->dirroot .'/enrol/'. $mod;

        unset($module);

        if ( is_readable($fullmod .'/version.php')) {
            include_once($fullmod .'/version.php');  // defines $module with version etc
        } else {
            continue;                              // Nothing to do.
        }

        if ( is_readable($fullmod .'/db/'. $CFG->dbtype .'.php')) {
            include_once($fullmod .'/db/'. $CFG->dbtype .'.php');  // defines upgrading function
        } else {
            continue;
        }

        if (!isset($module)) {
            continue;
        }

        if (!empty($module->requires)) {
            if ($module->requires > $CFG->version) {
                $info->modulename = $mod;
                $info->moduleversion  = $module->version;
                $info->currentmoodle = $CFG->version;
                $info->requiremoodle = $module->requires;
                notify(get_string('modulerequirementsnotmet', 'error', $info));
                unset($info);
                continue;
            }
        }

        $module->name = $mod;   // The name MUST match the directory

        $moduleversion = 'enrol_'.$mod.'_version';

        if (!isset($CFG->$moduleversion)) {
            set_config($moduleversion, 0);
        }
        
        if ($CFG->$moduleversion == $module->version) {
            // do nothing
        } else if ($CFG->$moduleversion < $module->version) {
            if (empty($updated_modules)) {
                $strmodulesetup  = get_string('modulesetup');
                print_header($strmodulesetup, $strmodulesetup, $strmodulesetup, '', '', false, '&nbsp;', '&nbsp;');
            }
            print_heading($module->name .' module needs upgrading');
            $upgrade_function = $module->name .'_upgrade';
            if (function_exists($upgrade_function)) {
                $db->debug=true;
                if ($upgrade_function($CFG->$moduleversion)) {
                    $db->debug=false;
                    // OK so far, now update the modules record
                    set_config($moduleversion, $module->version);
                    notify(get_string('modulesuccess', '', $module->name), 'notifysuccess');
                    echo '<hr />';
                } else {
                    $db->debug=false;
                    notify('Upgrading '. $module->name .' from '. $CFG->$moduleversion .' to '. $module->version .' FAILED!');
                }
            }
            $updated_modules = true;
        } else {
            error('Version mismatch: '. $module->name .' can\'t downgrade '. $CFG->$moduleversion .' -> '. $module->version .' !');
        }
    }

    if (!empty($updated_modules)) {
        print_continue($return);
        die;
    }
}

/**
 * Find and check all modules and load them up or upgrade them if necessary
 *
 * @uses $db
 * @uses $CFG
 * @param string $return The url to prompt the user to continue to
 * @todo Finish documenting this function
 */ 
function upgrade_activity_modules($return) {

    global $CFG, $db;

    if (!$mods = get_list_of_plugins('mod') ) {
        error('No modules installed!');
    }

    foreach ($mods as $mod) {

        if ($mod == 'NEWMODULE') {   // Someone has unzipped the template, ignore it
            continue;
        }

        $fullmod = $CFG->dirroot .'/mod/'. $mod;

        unset($module);

        if ( is_readable($fullmod .'/version.php')) {
            include_once($fullmod .'/version.php');  // defines $module with version etc
        } else {
            notify('Module '. $mod .': '. $fullmod .'/version.php was not readable');
            continue;
        }

        if ( is_readable($fullmod .'/db/'. $CFG->dbtype .'.php')) {
            include_once($fullmod .'/db/'. $CFG->dbtype .'.php');  // defines upgrading function
        } else {
            notify('Module '. $mod .': '. $fullmod .'/db/'. $CFG->dbtype .'.php was not readable');
            continue;
        }

        if (!isset($module)) {
            continue;
        }

        if (!empty($module->requires)) {
            if ($module->requires > $CFG->version) {
                $info->modulename = $mod;
                $info->moduleversion  = $module->version;
                $info->currentmoodle = $CFG->version;
                $info->requiremoodle = $module->requires;
                notify(get_string('modulerequirementsnotmet', 'error', $info));
                unset($info);
                continue;
            }
        }

        $module->name = $mod;   // The name MUST match the directory
        
        if ($currmodule = get_record('modules', 'name', $module->name)) {
            if ($currmodule->version == $module->version) {
                // do nothing
            } else if ($currmodule->version < $module->version) {
                if (empty($updated_modules)) {
                    $strmodulesetup  = get_string('modulesetup');
                    print_header($strmodulesetup, $strmodulesetup, $strmodulesetup, '', '', false, '&nbsp;', '&nbsp;');
                }
                print_heading($module->name .' module needs upgrading');
                $upgrade_function = $module->name.'_upgrade';
                if (function_exists($upgrade_function)) {
                    $db->debug=true;
                    if ($upgrade_function($currmodule->version, $module)) {
                        $db->debug=false;
                        // OK so far, now update the modules record
                        $module->id = $currmodule->id;
                        if (! update_record('modules', $module)) {
                            error('Could not update '. $module->name .' record in modules table!');
                        }
                        remove_dir($CFG->dataroot . '/cache', true); // flush cache
                        notify(get_string('modulesuccess', '', $module->name), 'notifysuccess');
                        echo '<hr />';
                    } else {
                        $db->debug=false;
                        notify('Upgrading '. $module->name .' from '. $currmodule->version .' to '. $module->version .' FAILED!');
                    }
                }
                $updated_modules = true;
            } else {
                error('Version mismatch: '. $module->name .' can\'t downgrade '. $currmodule->version .' -> '. $module->version .' !');
            }
    
        } else {    // module not installed yet, so install it
            if (empty($updated_modules)) {
                $strmodulesetup    = get_string('modulesetup');
                print_header($strmodulesetup, $strmodulesetup, $strmodulesetup, '', '', false, '&nbsp;', '&nbsp;');
            }
            print_heading($module->name);
            $updated_modules = true;
            $db->debug = true;
            @set_time_limit(0);  // To allow slow databases to complete the long SQL
            if (modify_database($fullmod .'/db/'. $CFG->dbtype .'.sql')) {
                $db->debug = false;
                if ($module->id = insert_record('modules', $module)) {
                    notify(get_string('modulesuccess', '', $module->name), 'notifysuccess');
                    echo '<hr />';
                } else {
                    error($module->name .' module could not be added to the module list!');
                }
            } else { 
                error($module->name .' tables could NOT be set up successfully!');
            }
        }

    /// Check submodules of this module if necessary

        include_once($fullmod.'/lib.php');  // defines upgrading function

        $submoduleupgrade = $module->name.'_upgrade_submodules';
        if (function_exists($submoduleupgrade)) {
            $submoduleupgrade();
        }


    /// Run any defaults or final code that is necessary for this module

        if ( is_readable($fullmod .'/defaults.php')) {
            // Insert default values for any important configuration variables
            unset($defaults);
            include_once($fullmod .'/defaults.php'); 
            if (!empty($defaults)) {
                foreach ($defaults as $name => $value) {
                    if (!isset($CFG->$name)) {
                        set_config($name, $value);
                    }
                }
            }
        }
    }

    if (!empty($updated_modules)) {
        print_continue($return);
        print_footer();
        die;
    }
}

/** 
 * This function will return FALSE if the lock fails to be set (ie, if it's already locked)
 *
 * @param string  $name ?
 * @param bool  $value ?
 * @param int  $staleafter ?
 * @param bool  $clobberstale ?
 * @todo Finish documenting this function
 */
function set_cron_lock($name,$value=true,$staleafter=7200,$clobberstale=false) {

    if (empty($name)) {
        mtrace("Tried to get a cron lock for a null fieldname");
        return false;
    }

    if (empty($value)) {
        set_config($name,0);
        return true;
    }

    if ($config = get_record('config','name',$name)) {
        if (empty($config->value)) {
            set_config($name,time());
        } else {
            // check for stale.
            if ((time() - $staleafter) > $config->value) {
                mtrace("STALE LOCKFILE FOR $name - was $config->value");
                if (!empty($clobberstale)) {
                    set_config($name,time());
                    return true;
                }
            } else {
                return false; // was not stale - ie, we're ok to still be running.
            }
        }
    }
    else {
        set_config($name,time());
    }
    return true;
}

function print_progress($done, $total, $updatetime=5, $sleeptime=1) {
    static $count;
    static $starttime;
    static $lasttime;

    if (empty($starttime)) {
        $starttime = $lasttime = time();
        $lasttime = $starttime - $updatetime;
        echo '<table width="500" cellpadding="0" cellspacing="0" align="center"><tr><td width="500">';
        echo '<div id="bar" style="border-style:solid;border-width:1px;width:500px;height:50px;">';
        echo '<div id="slider" style="border-style:solid;border-width:1px;height:48px;width:10px;background-color:green;"></div>';
        echo '</div>';
        echo '<div id="text" align="center" style="width:500px;"></div>';
        echo '</td></tr></table>';
        echo '</div>';
    }

    if (!isset($count)) {
        $count = 0;
    }

    $count++;

    $now = time();

    if ($done && (($now - $lasttime) >= $updatetime)) {
        $elapsedtime = $now - $starttime;
        $projectedtime = (int)(((float)$total / (float)$done) * $elapsedtime) - $elapsedtime;
        $percentage = format_float((float)$done / (float)$total, 2);
        $width = (int)(500 * $percentage);

        echo '<script>';
        echo 'document.getElementById("text").innerHTML = "'.$count.' done.  Ending: '.format_time($projectedtime).'";'."\n";
        echo 'document.getElementById("slider").style.width = \''.$width.'px\';'."\n";
        echo '</script>';

        $lasttime = $now;
        sleep($sleeptime);
    }
}
?>
