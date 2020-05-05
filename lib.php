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
 * Library of interface functions and constants.
 *
 * @package     mod_escapecell
 * @copyright   marc.leconte
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Return if the plugin supports $feature.
 *
 * @param string $feature Constant representing the feature.
 * @return true | null True if the feature is supported, null otherwise.
 */
function escapecell_supports($feature) {
    switch ($feature) {
        case FEATURE_MOD_INTRO:
            return true;
        case FEATURE_BACKUP_MOODLE2:
            return true;
        case FEATURE_COMPLETION_HAS_RULES:
            return true;
        default:
            return null;
    }
}

/**
 * Saves a new instance of the mod_jeux into the database.
 *
 * Given an object containing all the necessary data, (defined by the form
 * in mod_form.php) this function will create a new instance and return the id
 * number of the instance.
 *
 * @param object $moduleinstance An object from the form.
 * @param mod_jeux_mod_form $mform The form.
 * @return int The id of the newly inserted record.
 */
function escapecell_add_instance($moduleinstance, $mform = null) {
    global $DB;
    $moduleinstance->timecreated = time();
    $id = $DB->insert_record('escapecell', $moduleinstance);
    return $id;
}

/**
 * Updates an instance of the mod_jeux in the database.
 *
 * Given an object containing all the necessary data (defined in mod_form.php),
 * this function will update an existing instance with new data.
 *
 * @param object $moduleinstance An object from the form in mod_form.php.
 * @param mod_jeux_mod_form $mform The form.
 * @return bool True if successful, false otherwise.
 */
function escapecell_update_instance($moduleinstance, $mform = null) {
    global $DB;

    $moduleinstance->timemodified = time();
    $moduleinstance->id = $moduleinstance->instance;

    return $DB->update_record('escapecell', $moduleinstance);
}

/**
 * Removes an instance of the mod_jeux from the database.
 *
 * @param int $id Id of the module instance.
 * @return bool True if successful, false on failure.
 */
function escapecell_delete_instance($id) {
    global $DB;

    $exists = $DB->get_record('escapecell', array('id' => $id));
    if (!$exists) {
        return false;
    }
    $DB->delete_records('escapecell', array('id' => $id));
    $DB->delete_records('escapecell_score', array('jeux' => $id));
    return true;
}

/**
 * Adds the reset confirmation elements of the escapecell activity.
 *
 * @param moodleform_mod $mform Form where we add elements.
 */
function escapecell_reset_course_form_definition(&$mform) {
    $mform->addElement('header', 'escapecellheader', get_string('reinit_title', 'escapecell'));
    $mform->addElement('advcheckbox', 'reset_escapecell', get_string('reset_escapecell', 'escapecell'));
}

/**
 * Sets the default values of the elements.
 *
 * @param course $course The course has to be reset.
 */
function escapecell_reset_course_form_defaults($course) {
    return array('reset_escapecell' => 1);
}

/**
 * Carries out the reset according to the data contained in $data.
 *
 * @param stdClass $data set of values for the form.
 */
function escapecell_reset_userdata($data) {
    global $CFG, $DB;
    $status = array();

    if (!empty($data->reset_escapecell)) {
        if ($levels = $DB->get_records('escapecell', array('course' => $data->courseid))) {
            foreach ($levels as $level) {
                $DB->delete_records('escapecell_score', array('jeux' => $level->id));
                $status[] = array('component' => get_string('reinit_title', 'escapecell'),
                          'item' => get_string('remove_entries', 'escapecell'),
                          'error' => false);
            }
        }
    }
    return $status;
}

function escapecell_get_completion_state($course, $cm, $userid, $type) {
    global $DB;

    $moduleinstance = $DB->get_record('escapecell', array('id' => $cm->instance), '*', MUST_EXIST);
    $enreg = $DB->get_record('escapecell_score',
                    ['jeux' => $cm->instance,
                    'userid' => $userid,
                    'niveau' => $moduleinstance->startlevel]);
    return isset($enreg->id);
}

