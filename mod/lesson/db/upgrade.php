<?php  //$Id$

// This file keeps track of upgrades to 
// the lesson module
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

function xmldb_lesson_upgrade($oldversion=0) {

    global $CFG, $THEME, $DB;

    $dbman = $DB->get_manager();

    $result = true;

//===== 1.9.0 upgrade line ======//

    if ($result && $oldversion < 2007072201) {

        $table = new xmldb_table('lesson');
        $field = new xmldb_field('usegrademax');
        $field2 = new xmldb_field('usemaxgrade');

    /// Rename lesson->usegrademax to lesson->usemaxgrade. Some old sites can have it incorrect. MDL-13177
        if ($dbman->field_exists($table, $field) && !$dbman->field_exists($table, $field2)) {
        /// Set field specs
            $field->set_attributes(XMLDB_TYPE_INTEGER, '3', null, XMLDB_NOTNULL, null, null, null, '0', 'ongoing');
        /// Launch rename field usegrademax to usemaxgrade
            $result = $result && $dbman->rename_field($table, $field, 'usemaxgrade');
        }
    }

    return $result;
}

?>
