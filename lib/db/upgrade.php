<?PHP  //$Id$

// This file keeps track of upgrades to Moodle.
//
// Sometimes, changes between versions involve
// alterations to database structures and other
// major things that may break installations.
//
// The upgrade function in this file will attempt
// to perform all the necessary actions to upgrade
// your older installtion to the current version.
//
// If there's something it cannot do itself, it
// will tell you what you need to do.
//
// The commands in here will all be database-neutral,
// using the methods of database_manager class


function xmldb_main_upgrade($oldversion=0) {
    global $CFG, $THEME, $USER, $DB;

    $result = true;

    $dbman = $DB->get_manager(); // loads ddl manager and xmldb classes

    ////////////////////////////////////////
    ///upgrade supported only from 1.9.x ///
    ////////////////////////////////////////

    if ($result && $oldversion < 2008030700) {

    /// Define index contextid-lowerboundary (not unique) to be dropped form grade_letters
        $table = new xmldb_table('grade_letters');
        $index = new xmldb_index('contextid-lowerboundary', XMLDB_INDEX_NOTUNIQUE, array('contextid', 'lowerboundary'));

    /// Launch drop index contextid-lowerboundary
        $dbman->drop_index($table, $index);

    /// Define index contextid-lowerboundary-letter (unique) to be added to grade_letters
        $table = new xmldb_table('grade_letters');
        $index = new xmldb_index('contextid-lowerboundary-letter', XMLDB_INDEX_UNIQUE, array('contextid', 'lowerboundary', 'letter'));

    /// Launch add index contextid-lowerboundary-letter
        $dbman->add_index($table, $index);

    /// Main savepoint reached
        upgrade_main_savepoint($result, 2008030700);
    }

    if ($result && $oldversion < 2008050100) {
        // Update courses that used weekscss to weeks
        $result = $DB->set_field('course', 'format', 'weeks', array('format' => 'weekscss'));
        upgrade_main_savepoint($result, 2008050100);
    }

    if ($result && $oldversion < 2008050200) {
        // remove unused config options
        unset_config('statsrolesupgraded');
        upgrade_main_savepoint($result, 2008050200);
    }

    if ($result && $oldversion < 2008050700) {
    /// Fix minor problem caused by MDL-5482.
        require_once($CFG->dirroot . '/question/upgrade.php');
        $result = $result && question_fix_random_question_parents();
        upgrade_main_savepoint($result, 2008050700);
    }

    if ($result && $oldversion < 2008051200) {
        // if guest role used as default user role unset it and force admin to choose new setting
        if (!empty($CFG->defaultuserroleid)) {
            if ($role = $DB->get_record('role', array('id'=>$CFG->defaultuserroleid))) {
                if ($guestroles = get_roles_with_capability('moodle/legacy:guest', CAP_ALLOW)) {
                    if (isset($guestroles[$role->id])) {
                        set_config('defaultuserroleid', null);
                        notify('Guest role removed from "Default role for all users" setting, please select another role.', 'notifysuccess');
                    }
                }
            } else {
                set_config('defaultuserroleid', null);
            }
        }
    }

    if ($result && $oldversion < 2008051201) {
        notify('Increasing size of user idnumber field, this may take a while...', 'notifysuccess');

    /// Under MySQL and Postgres... detect old NULL contents and change them by correct empty string. MDL-14859
        if ($CFG->dbfamily == 'mysql' || $CFG->dbfamily == 'postgres') {
            $DB->execute("UPDATE {user} SET idnumber = '' WHERE idnumber IS NULL");
        }

    /// Define index idnumber (not unique) to be dropped form user
        $table = new xmldb_table('user');
        $index = new xmldb_index('idnumber', XMLDB_INDEX_NOTUNIQUE, array('idnumber'));

    /// Launch drop index idnumber
        if ($dbman->index_exists($table, $index)) {
            $dbman->drop_index($table, $index);
        }

    /// Changing precision of field idnumber on table user to (255)
        $table = new xmldb_table('user');
        $field = new xmldb_field('idnumber', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null, null, null, 'password');

    /// Launch change of precision for field idnumber
        $dbman->change_field_precision($table, $field);

    /// Launch add index idnumber again
        $index = new xmldb_index('idnumber', XMLDB_INDEX_NOTUNIQUE, array('idnumber'));
        $dbman->add_index($table, $index);

    /// Main savepoint reached
        upgrade_main_savepoint($result, 2008051201);
    }

    if ($result && $oldversion < 2008051202) {
        $log_action = new object();
        $log_action->module = 'course';
        $log_action->action = 'unenrol';
        $log_action->mtable = 'course';
        $log_action->field  = 'fullname';
        if (!$DB->record_exists('log_display', array('action'=>'unenrol', 'module'=>'course'))) {
            $result = $result && $DB->insert_record('log_display', $log_action);
        }
        upgrade_main_savepoint($result, 2008051202);
    }

    if ($result && $oldversion < 2008051203) {
        $table = new xmldb_table('mnet_enrol_course');
        $field = new xmldb_field('sortorder', XMLDB_TYPE_INTEGER, '10', true, true, null, false, false, 0);
        $dbman->change_field_precision($table, $field);
        upgrade_main_savepoint($result, 2008051203);
    }

    if ($result && $oldversion < 2008063001) {
        // table to be modified
        $table = new xmldb_table('tag_instance');
        // add field
        $field = new xmldb_field('tiuserid');
        if (!$dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, 0, 'itemid');
            $dbman->add_field($table, $field);
        }
        // modify index
        $index = new xmldb_index('itemtype-itemid-tagid');
        $index->set_attributes(XMLDB_INDEX_UNIQUE, array('itemtype', 'itemid', 'tagid'));
        $dbman->drop_index($table, $index);
        $index = new xmldb_index('itemtype-itemid-tagid-tiuserid');
        $index->set_attributes(XMLDB_INDEX_UNIQUE, array('itemtype', 'itemid', 'tagid', 'tiuserid'));
        $dbman->add_index($table, $index);

        /// Main savepoint reached
        upgrade_main_savepoint($result, 2008063001);
    }
    if ($result && $oldversion < 2008063002) {

    /// Define table repository to be created
        $table = new xmldb_table('repository');

    /// Adding fields to table repository
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null, null);
        $table->add_field('repositoryname', XMLDB_TYPE_CHAR, '255', null, null, null, null, null, null);
        $table->add_field('repositorytype', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null, null, null);
        $table->add_field('userid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0');
        $table->add_field('contextid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);
        $table->add_field('username', XMLDB_TYPE_CHAR, '255', null, null, null, null, null, null);
        $table->add_field('password', XMLDB_TYPE_CHAR, '255', null, null, null, null, null, null);
        $table->add_field('data1', XMLDB_TYPE_TEXT, 'big', null, null, null, null, null, null);
        $table->add_field('data2', XMLDB_TYPE_TEXT, 'big', null, null, null, null, null, null);
        $table->add_field('data3', XMLDB_TYPE_TEXT, 'big', null, null, null, null, null, null);
        $table->add_field('data4', XMLDB_TYPE_TEXT, 'big', null, null, null, null, null, null);
        $table->add_field('data5', XMLDB_TYPE_TEXT, 'big', null, null, null, null, null, null);
        $table->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0');
        $table->add_field('timemodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0');

    /// Adding keys to table repository
        $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));

    /// Conditionally launch create table for repository
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

    /// Main savepoint reached
        upgrade_main_savepoint($result, 2008063002);
    }

/*
 * TODO:
 *   drop adodb_logsql table and create a new general sql log table
 *
 */

    return $result;
}


?>
