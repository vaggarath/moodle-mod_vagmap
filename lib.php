<?php

/**
 * Saves a new instance of the mod_vagmap into the database.
 *
 * Given an object containing all the necessary data, (defined by the form
 * in mod_form.php) this function will create a new instance and return the id
 * number of the instance.
 *
 * @param object $moduleinstance An object from the form.
 * @param mod_vagmap_mod_form $mform The form.
 * @return int The id of the newly inserted record.
 */
function vagmap_add_instance($moduleinstance, $mform) {
    global $DB, $USER, $CFG;
    require_once("$CFG->libdir/resourcelib.php");

    $moduleinstance->timecreated = time();
    // $moduleinstance->teacher = $USER->lastname." ".$USER->firstname;

    $cmid = $moduleinstance->id;

    $id = $DB->insert_record('vagmap', $moduleinstance);

    return $id;
}

function vagmap_update_instance($moduleinstance, $mform = null) {
    global $DB, $USER, $CFG;
    require_once("$CFG->libdir/resourcelib.php");
    $moduleinstance = $DB->get_record('vagmap', array('id' => $cm->instance), '*', MUST_EXIST);
    $moduleinstance->timemodified = time();
    $moduleinstance->teacher = $USER->lastname." ".$USER->firstname; //on change le prof si c'en est un autre (utile ?)
    $moduleinstance->id = $moduleinstance->instance;

    if($moduleinstance->files){ //useless to trigger if no files
       vagmap_replace_mainfile($moduleinstance); //do a function to remove last files!
    }

    $completiontimeexpected = !empty($moduleinstance->completionexpected) ? $moduleinstance->completionexpected : null;
    \core_completion\api::update_completion_date_event($cmid, 'resource', $moduleinstance->id, $completiontimeexpected);

    return $DB->update_record('vagmap', $moduleinstance);
}

function vagmap_delete_instance($id) {
    global $DB;

    $exists = $DB->get_record('vagmap', array('id' => $id));
    if (!$exists) {
        return false;
    }

    $DB->delete_records('vagmap', array('id' => $id));

    return true;
}