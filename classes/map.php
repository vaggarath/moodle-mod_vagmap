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
 * A drawer based layout for the boost theme.
 *
 * @package   mod_vagmap
 * @copyright 2023 vaggarath
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace mod_vagmap;
defined('MOODLE_INTERNAL') || die();

class map{


    public static function mapInformations(){
        global $DB, $CFG;
        require_once($CFG->libdir . '/behat/lib.php');
        require_once($CFG->dirroot . '/course/lib.php');
        $templatecontext = [
            'regex' => false,
        ];

        return $templatecontext;
    }
}