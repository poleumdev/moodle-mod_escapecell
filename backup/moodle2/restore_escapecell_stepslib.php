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
 * @package escapecell
 * @copyright 2020
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Define all the restore steps that will be used by the restore_escapecell_activity_task
 */

/**
 * Structure step to restore one escapecell activity
 */
class restore_escapecell_activity_structure_step extends restore_activity_structure_step {

    protected function define_structure() {

        $paths = array();
        // Main dialogue processor can handle legacy data.
        $paths[] = new restore_path_element('escapecell', '/activity/escapecell');

        $userinfo = $this->get_setting_value('userinfo');
        if ($userinfo) {
                $paths[] = new restore_path_element('escapecell_score',
                                                    '/activity/escapecell/escapecell_score');
        }
        // Return the paths wrapped into standard activity structure.
        return $this->prepare_activity_structure($paths);
    }

    protected function process_escapecell($data) {
        global $DB;

        $pluginconfig = get_config('escapecell');

        $data = (object)$data;
        $oldid = $data->id;

        $data->course = $this->get_courseid();
        $newitemid = $DB->insert_record('escapecell', $data);
        $this->apply_activity_instance($newitemid);
    }

    protected function process_escapecell_score($data) {
        global $DB;

        $data = (object)$data;
        $oldid = $data->id;

        $data->jeux = $this->get_new_parentid('escapecell');
        $data->userid = $this->get_mappingid('user', $data->userid);
        $newitemid = $DB->insert_record('escapecell_score', $data);
        $this->set_mapping('escapecell_score', $oldid, $newitemid);
    }


    protected function after_execute() {
        // Add entry related files.
        $this->add_related_files('mod_escapecell', 'intro', null);
    }
}
