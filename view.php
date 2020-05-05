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

// Course_module ID, or.
$id = optional_param('id', 0, PARAM_INT);

// ... module instance id.
$j  = optional_param('j', 0, PARAM_INT);

if ($id) {
    $cm             = get_coursemodule_from_id('escapecell', $id, 0, false, MUST_EXIST);
    $course         = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
    $moduleinstance = $DB->get_record('escapecell', array('id' => $cm->instance), '*', MUST_EXIST);
} else if ($j) {
    $moduleinstance = $DB->get_record('escapecell', array('id' => $n), '*', MUST_EXIST);
    $course         = $DB->get_record('course', array('id' => $moduleinstance->course), '*', MUST_EXIST);
    $cm             = get_coursemodule_from_instance('escapecell', $moduleinstance->id, $course->id, false, MUST_EXIST);
} else {
    print_error(get_string('missingidandcmid', 'mod_escapecell'));
}

require_login($course, true, $cm);

$req = "select * from {escapecell_score} where userid = ? and jeux = ? and niveau = ?";
$result = $DB->get_record_sql($req,
                array($USER->id, $moduleinstance->id, $moduleinstance->startlevel));

$level = $moduleinstance->startlevel;
$urllevel = new \moodle_url('/mod/escapecell/levels/level_'. $level .'/index.php', array("id" => $cm->id));

if (isset($result->niveau)) {
    $modulecontext = context_module::instance($cm->id);
    $PAGE->set_url('/mod/escapecell/view.php', array('id' => $cm->id));
    $PAGE->set_title(format_string($moduleinstance->name));
    $PAGE->set_heading(format_string($course->fullname));
    $PAGE->set_context($modulecontext);
    echo $OUTPUT->header();

    echo "<center>";
    if ($result->score > 0) {
        echo get_string('statelevel', 'mod_escapecell', $result->score);
        echo '<img src="./pix/bonus_' . $result->score . '.png" >';
    } else {
        echo get_string('nobonus', 'mod_escapecell');
    }

    echo '<br/>';
    $url = new \moodle_url('/course/view.php', array('id' => $course->id));
    $label = get_string('cancel');
    $attributes = array('class' => 'btn btn-default attestoodle-button');
    $btncancel = \html_writer::link($url, $label, $attributes);
    echo $btncancel;

    $labelretry = get_string('retry', 'mod_escapecell');
    $btnretry = \html_writer::link($urllevel, $labelretry, $attributes);
    echo "  ". $btnretry;
    echo '</center>';

    echo $OUTPUT->footer();
} else {
    redirect($urllevel);
}