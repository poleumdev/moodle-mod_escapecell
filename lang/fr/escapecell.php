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
$string['jeuxname'] = 'Niveau d\'Escape Cell';
$string['modulename_help'] = 'Escape Cell est un jeu de révision sur la biologie';
$string['modulenameplural'] = 'Niveaux d\'Escape Cell';

// String required.
$string['pluginadministration'] = 'Administration de niveau Escape Cell';
$string['jeuxname_help'] = 'Nom du/des niveaux Escape Cell dans le cours';

// Privacy.
$string['privacy:metadata:escapecell_score'] = 'Enregistrement des scores obtenus';
$string['privacy:metadata:escapecell_score:userid'] = 'Identifiant du joueur';
$string['privacy:metadata:escapecell_score:jeux'] = 'Identifiant de l\'instance de l\'activité Escape Cell';
$string['privacy:metadata:escapecell_score:niveau'] = 'Niveau passé par le joueur';
$string['privacy:metadata:escapecell_score:score'] = 'Bonus obtenus dans le niveau';

// Capacity.
$string['escapecell:addinstance'] = 'Ajouter un/des niveau Escape Cell';


$string['leveldone'] = 'Bravo vous avez terminé le niveau {$a}';
$string['gamedone'] = 'Félicitation vous avez terminé le jeu';
$string['reinit_title'] = 'Niveaux d\'Escape Cell';
$string['reset_escapecell'] = 'Supprimer les scores obtenus';
$string['remove_entries'] = 'Suppression des scores';

$string['missingidandcmid'] = 'Paramètres manquants id, cmid';
$string['levelcompleted'] = 'Niveau Terminé';
$string['droppinglevel'] = 'Abandon du niveau';
$string['gamelevels'] = 'Niveaux du Jeux';
$string['startlevel'] = 'Niveau de départ';
$string['endlevel'] = 'Niveau de fin';
$string['imgcompletedactivity'] = 'Image completed activity';
$string['nonewmodules'] = 'Pas de nouveaux modules';

$string['statelevel'] = 'Tu as déjà réalisé ce jeu !<br/>';
$string['nobonus'] = 'Tu as fait ce jeu mais tu peux t\'améliorer !<br/>';
$string['retry'] = 'Réessayer';
$string['improvement'] = 'Vous avez amélioré votre score !';
$string['notenough'] = 'Dommage vous n\'avez pas gagné de bonus !';