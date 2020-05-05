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
 * Prints an instance of mod_escapecell.
 *
 * @package     mod_escapecell
 * @copyright   marc.leconte
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require(__DIR__.'/../../config.php');
require_once(__DIR__.'/lib.php');

$score = optional_param('score', -1, PARAM_INT);
$cmid = required_param('cmid', PARAM_INT);
$level = optional_param('level', -1, PARAM_INT);

$cm             = get_coursemodule_from_id('escapecell', $cmid, 0, false, MUST_EXIST);
$course         = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
$moduleinstance = $DB->get_record('escapecell', array('id' => $cm->instance), '*', MUST_EXIST);

require_login($course, true, $cm);
$url = new \moodle_url('/course/view.php', array('id' => $course->id));
if ($level > 9) {
    $level = -1;
}

if ($level != -1 && $score != -1) {
    $record = new \stdClass();
    $record->jeux = $moduleinstance->id;
    $record->userid = $USER->id;
    $record->niveau = $level;

    $enreg = $DB->get_record('escapecell_score',
                    ['jeux' => $record->jeux,
                    'userid' => $record->userid,
                    'niveau' => $record->niveau]);
    // Notification level done !
    $message = get_string('leveldone', 'mod_escapecell', $level);

    if (!isset($enreg->id)) {
        $record->score = $score;
        $gendate = new \DateTime();
        $record->timemodified = $gendate->getTimestamp();
        $DB->insert_record('escapecell_score', $record);
        // Keep default message.
    } else {
        if ($enreg->score < $score) {
            $message = get_string('improvement', 'mod_escapecell');
            $record->score = $score;
            $record->id = $enreg->id;
            $DB->update_record('escapecell_score', $record);
        } else {
            $message = get_string('notenough', 'mod_escapecell');
        }
    }

    $completion = new completion_info($course);
    if ($completion->is_enabled($cm)) {
        $completion->update_state($cm, COMPLETION_COMPLETE);
    }

    redirect($url, $message, null, \core\output\notification::NOTIFY_SUCCESS);
} else {
    // Notification anbandon !
    $message = get_string('droppinglevel', 'mod_escapecell');
    redirect($url, $message, null, \core\output\notification::NOTIFY_ERROR);
}