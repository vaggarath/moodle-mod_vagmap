<?php
defined('MOODLE_INTERNAL') || die();

function xmldb_vagmap_upgrade($oldversion = 2023021602) {
    global $CFG, $THEME, $DB, $OUTPUT;

    $dbman = $DB->get_manager();
    if ($oldversion < 2023021601) {

        // Define table vagmap to be created.
        $table = new xmldb_table('vagmap');

        // Adding fields to table vagmap.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('course', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
        $table->add_field('name', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null);
        $table->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('timemodified', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('intro', XMLDB_TYPE_TEXT, null, null, null, null, null);
        $table->add_field('introformat', XMLDB_TYPE_INTEGER, '4', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('teacher', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null);

        // Adding keys to table vagmap.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
        $table->add_key('fk_course', XMLDB_KEY_FOREIGN, ['course'], 'course', ['id']);

        // Conditionally launch create table for vagmap.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Vagmap savepoint reached.
        upgrade_mod_savepoint(true, 2023021601, 'vagmap');
    }

    if ($oldversion < 2023021603) {

        // Define field mapname to be added to vagmap_mapinfo.
        $table = new xmldb_table('vagmap_mapinfo');
        // $field = new xmldb_field();
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null);
        $table->add_field('mapname', XMLDB_TYPE_CHAR, '100', null, XMLDB_NOTNULL, null, null, 'id');
        $table->add_field('centername', XMLDB_TYPE_CHAR, '255', null, null, null, null, 'mapname');
        $table->add_field('centerlat', XMLDB_TYPE_NUMBER, '10, 3', null, null, null, null, 'centername');
        $table->add_field('centerlong', XMLDB_TYPE_NUMBER, '10, 3', null, null, null, null, 'centerlat');
        $table->add_field('mapinstance', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null, 'centerlong');

        $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
        $table->add_key('fk_mapinstance', XMLDB_KEY_FOREIGN, ['mapinstance'], 'vagmap', ['id']);

        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        upgrade_mod_savepoint(true, 2023021603, 'vagmap');
    }
}
