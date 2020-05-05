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
 * Plugin strings are defined here.
 *
 * @package     mod_escapecell
 * @category    string
 * @copyright   marc.leconte
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Escape Cell';
$string['modulename'] = 'Escape Cell';
$string['jeuxname'] = 'Escape Cell level';
$string['modulename_help'] = 'Escape Cell is a review game about the biology';
$string['modulenameplural'] = 'Escape Cell levels';

// String required.
$string['pluginadministration'] = 'Escape Cell Level Administration';
$string['jeuxname_help'] = 'Name of the Escape Cell level in the course';

// Privacy.
$string['privacy:metadata:escapecell_score'] = 'Recording of scores';
$string['privacy:metadata:escapecell_score:userid'] = 'Player ID';
$string['privacy:metadata:escapecell_score:jeux'] = 'Identifier of the instance of the Escape Cell activity';
$string['privacy:metadata:escapecell_score:niveau'] = 'Level passed by the player';
$string['privacy:metadata:escapecell_score:score'] = 'Bonus obtained in the level';

// Capacity.
$string['escapecell:addinstance'] = 'Add an Escape Cell level(s)';


$string['leveldone'] = 'Congratulations on completing the level {$a}';
$string['gamedone'] = 'You smash the game !';
$string['reinit_title'] = 'Escape Cell Levels';
$string['reset_escapecell'] = 'Delete scores';
$string['remove_entries'] = 'Removal of scores';

$string['missingidandcmid'] = 'Missing id and cmid';
$string['levelcompleted'] = 'Level completed';
$string['droppinglevel'] = 'Dropping the level';
$string['gamelevels'] = 'Game Levels';
$string['startlevel'] = 'Start level';
$string['endlevel'] = 'End level';
$string['imgcompletedactivity'] = 'Illustration activité terminée';
$string['nonewmodules'] = 'No new modules';

$string['statelevel'] = '<h3>Congratulations</h3>you got {$a} out of 3 bonuses !<br/>';
$string['nobonus'] = 'You don\'t have a bonus yet !<br/>';
$string['retry'] = 'Retry';
$string['improvement'] = 'You\'ve improved your score !';
$string['notenough'] = 'Too bad you didn\'t win a bonus.';