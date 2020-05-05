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

defined('MOODLE_INTERNAL') || die;

/**
 * Define all the backup steps that will be used by the backup_escapecell_activity_task
 */
class backup_escapecell_activity_structure_step extends backup_activity_structure_step {
    protected function define_structure() {
        // To know if we are including userinfo.
        $userinfo = $this->get_setting_value('userinfo');

        // Define each element separated.
        $escapecell = new backup_nested_element('escapecell', array('id'),
                                              array('course',
                                                    'name',
                                                    'intro',
                                                    'introformat',
                                                    'startlevel',
                                                    'endlevel',
                                                    'pixend',
                                                    'timecreated',
                                                    'timemodified'));

        $score = new backup_nested_element('escapecell_score', array('id'),
                                                  array('jeux',
                                                        'niveau',
                                                        'userid',
                                                        'score',
                                                        'timemodified'));

        // Build the tree.
        $escapecell->add_child($score);

        // Define sources.
        $escapecell->set_source_table('escapecell', array('id' => backup::VAR_ACTIVITYID));
        // All these source definitions only happen if we are including user info.
        if ($userinfo) {
            $score->set_source_table('escapecell_score', array('jeux' => backup::VAR_PARENTID));
        }

        // Define id annotations.
        $score->annotate_ids('user', 'userid');

        // Define file annotations.

        // Return the root element, wrapped into standard activity structure.
        return $this->prepare_activity_structure($escapecell);
    }
}
