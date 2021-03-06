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
 * Duplicates a given course module
 *
 * The script backups and restores a single activity as if it was imported
 * from the same course, using the default import settings. The newly created
 * copy of the activity is then moved right below the original one.
 *
 * @package    core
 * @subpackage course
 * @copyright  2011 David Mudrak <david@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once ('../../config.php');
require_once($CFG->libdir . '/itse/lib.php');

$id = required_param('id', PARAM_INT);
$corte = required_param('corte', PARAM_INT);
$sesskey = required_param('sesskey', PARAM_TEXT);

$PAGE->set_url('/course/cortes/genera_corte_notificacion.php', array(
    'id' => $id,
    'corte' => $corte,
    'sesskey' => $sesskey
));

$course = $DB->get_record('course', array('id' => $id), '*', MUST_EXIST);
$context = context_course::instance($course->id);

require_login($course);
require_sesskey();

if (confirm_sesskey($sesskey))
{

    $PAGE->set_title(get_string('accion_' . $accion, 'format_unidades'));
    $PAGE->set_heading($course->fullname);
    $PAGE->navbar->add(get_string('accion_' . $accion, 'format_unidades'));
    $PAGE->set_pagelayout('incourse');

    echo $OUTPUT->header();
    echo $OUTPUT->notification(get_string('cambioexitoso', 'format_unidades'), 'notifysuccess');
    echo $OUTPUT->continue_button(course_get_url($course));

    echo $OUTPUT->footer();

}
