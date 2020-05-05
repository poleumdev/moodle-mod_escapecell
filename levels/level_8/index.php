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
 * Factice level 8.
 *
 * @package     mod_escapecell
 * @copyright   marc.leconte
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require(__DIR__.'/../../../../config.php');

$cmid = required_param('id', PARAM_INT);

$cm             = get_coursemodule_from_id('escapecell', $cmid, 0, false, MUST_EXIST);
$course         = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
require_course_login($course);
$coursecontext = context_course::instance($course->id);

$PAGE->set_url('/mod/escapecell/level/index.php', array('id' => $cmid));
$PAGE->set_title('Escape Cell Level 8 (factice)');
$PAGE->set_heading('Escape Cell Level 8 (factice)');
$PAGE->set_context($coursecontext);

echo $OUTPUT->header();
echo '<style>
#ScoreForm
{
  display:none;
}
 </style>';

$bonus = random_int(0, 3);
echo '<form id="ScoreForm" name="ScoreForm" action="../../score.php">
  <input type="text" value="'. $bonus .'" id="score" name="score" />
  <input type="text" value="8" id="level" name="level" />';
echo '<input type="text" value="' . $cmid .'" id="cmid" name="cmid"/>';
echo '</form>';
echo '<script type="text/javascript">
        document.ScoreForm.submit();
    </script>';
echo $OUTPUT->footer();
