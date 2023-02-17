<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Activity creation/editing form for the mod_vagmap plugin.
 *
 * @package   mod_vagmap
 * @copyright 2023, Vaggarath
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once($CFG->dirroot.'/course/moodleform_mod.php');
require_once($CFG->dirroot.'/mod/vagmap/lib.php');

class mod_vagmap_mod_form extends moodleform_mod {

    function definition() {
        global $CFG, $DB, $OUTPUT, $USER;

        $mform = $this->_form;

        // Adding the "general" fieldset, where all the common settings are shown.
        $mform->addElement('header', 'general', get_string('general', 'form'));

        // Adding the standard "name" field.
        $mform->addElement('text', 'name', get_string('mapname', 'mod_vagmap'), array('size' => '64'));

        if (!empty($CFG->formatstringstriptags)) {
            $mform->setType('name', PARAM_TEXT);
        } else {
            $mform->setType('name', PARAM_CLEANHTML);
        }

        $mform->addRule('name', null, 'required', null, 'client');
        $mform->addRule('name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');
        $mform->addHelpButton('name', 'vagmapname', 'mod_vagmap');

        //add csv for poi : to do later
        // $filemanager_options = array();
        // $filemanager_options['accepted_types'] = 'csv';
        // $filemanager_options['maxbytes'] = 5242880; //5mo
        // $filemanager_options['maxfiles'] = 2;
        // $filemanager_options['mainfile'] = true;

        // $mform->addElement('filemanager', 'files', get_string('selectfiles'), null, $filemanager_options);
        // $mform->addHelpButton('files', 'files', 'mod_vagmap');

        // Adding the standard "intro" and "introformat" fields.
        if ($CFG->branch >= 29) {
            $this->standard_intro_elements();
        } else {
            $this->add_intro_editor();
        }

        // Adding the rest of mod_vagmap settings, spreading all them into this fieldset
        // ... or adding more fieldsets ('header' elements) if needed for better logic.
        $mform->addElement('static', 'label1', 'vagmapsettingsstring');
        $mform->addElement('header', 'vagmapfieldsetstring');

        // Add standard elements.
        $this->standard_coursemodule_elements();

        // Add standard buttons.
        $this->add_action_buttons();
    }
}