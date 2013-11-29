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
 * Define all the restore steps that will be used by the restore_practicalab_activity_task
 *
 * @package   mod_practicalab
 * @copyright 2012 NetSpot {@link http://www.netspot.com.au}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Define the complete practicalabment structure for restore, with file and id annotations
 *
 * @package   mod_practicalab
 * @copyright 2012 NetSpot {@link http://www.netspot.com.au}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class restore_practicalab_activity_structure_step extends restore_activity_structure_step {

    /**
     * Define the structure of the restore workflow.
     *
     * @return restore_path_element $structure
     */
    protected function define_structure() {

        $paths = array();
        // To know if we are including userinfo.
        $userinfo = $this->get_setting_value('userinfo');

        // Define each element separated.
        $paths[] = new restore_path_element('practicalab', '/activity/practicalab');
        $paths[] = new restore_path_element('practicalab_programacion',
                                               '/activity/practicalab/programaciones/programacion');
        if ($userinfo) {
            $paths[] = new restore_path_element('practicalab_asistencia',
                                               '/activity/practicalab/asistencias/asistencia');
            $submission = new restore_path_element('practicalab_submission',
                                                   '/activity/practicalab/submissions/submission');
            $paths[] = $submission;
            $this->add_subplugin_structure('practicalabsubmission', $submission);
            $grade = new restore_path_element('practicalab_grade', '/activity/practicalab/grades/grade');
            $paths[] = $grade;
            $this->add_subplugin_structure('practicalabfeedback', $grade);
        }
        $paths[] = new restore_path_element('practicalab_plugin_config',
                                            '/activity/practicalab/plugin_configs/plugin_config');

        return $this->prepare_activity_structure($paths);
    }

    /**
     * Process an practicalab restore.
     *
     * @param object $data The data in object form
     * @return void
     */
    protected function process_practicalab($data) {
        global $DB;

        $data = (object)$data;
        $oldid = $data->id;
        $data->course = $this->get_courseid();

        $data->timemodified = $this->apply_date_offset($data->timemodified);
        $data->allowsubmissionsfromdate = $this->apply_date_offset($data->allowsubmissionsfromdate);
        $data->duedate = $this->apply_date_offset($data->duedate);
        if (!empty($data->teamsubmissiongroupingid)) {
            $data->teamsubmissiongroupingid = $this->get_mappingid('grouping',
                                                                   $data->teamsubmissiongroupingid);
        } else {
            $data->teamsubmissiongroupingid = 0;
        }

        if (!isset($data->cutoffdate)) {
            $data->cutoffdate = 0;
        }

        if (!empty($data->preventlatesubmissions)) {
            $data->cutoffdate = $data->duedate;
        } else {
            $data->cutoffdate = $this->apply_date_offset($data->cutoffdate);
        }

        $newitemid = $DB->insert_record('practicalab', $data);

        $this->apply_activity_instance($newitemid);
    }

    protected function process_practicalab_programacion($data) {
        global $DB;
//        print_r($data);

        $data = (object)$data;
        $oldid = $data->id;
        $data->sesionclaseid = $this->get_new_parentid('practicalab');;
        $data->course = $this->get_courseid();
        $data->groupid = $this->get_mappingid('group', $data->groupid);
        
        // insert the sesionclase record
        $newitemid = $DB->insert_record('sesionclase_programacion', $data);
    }

    protected function process_practicalab_asistencia($data) {
        global $DB;
//        print_r($data);

        $data = (object)$data;
        $oldid = $data->id;
        $data->sesionclaseid = $this->get_new_parentid('practicalab');;
        $data->course = $this->get_courseid();
        $data->userid = $this->get_mappingid('user', $data->userid);
        $data->teacher = $this->get_mappingid('user', $data->teacher);
        $data->groupid = $this->get_mappingid('group', $data->groupid);
        
        // insert the sesionclase record
        $newitemid = $DB->insert_record('sesionclase_asistencias', $data);
    }
    
    /**
     * Process a submission restore
     * @param object $data The data in object form
     * @return void
     */
    protected function process_practicalab_submission($data) {
        global $DB;

        $data = (object)$data;
        $oldid = $data->id;

        $data->practicalabment = $this->get_new_parentid('practicalab');

        $data->timemodified = $this->apply_date_offset($data->timemodified);
        $data->timecreated = $this->apply_date_offset($data->timecreated);
        if ($data->userid > 0) {
            $data->userid = $this->get_mappingid('user', $data->userid);
        }
        if (!empty($data->groupid)) {
            $data->groupid = $this->get_mappingid('group', $data->groupid);
        } else {
            $data->groupid = 0;
        }

        $newitemid = $DB->insert_record('practicalab_submission', $data);

        // Note - the old contextid is required in order to be able to restore files stored in
        // sub plugin file areas attached to the submissionid.
        $this->set_mapping('submission', $oldid, $newitemid, false, null, $this->task->get_old_contextid());
    }

    /**
     * Process a user_flags restore
     * @param object $data The data in object form
     * @return void
     */
    protected function process_practicalab_userflags($data) {
        global $DB;

        $data = (object)$data;
        $oldid = $data->id;

        $data->practicalabment = $this->get_new_parentid('practicalab');

        $data->userid = $this->get_mappingid('user', $data->userid);
        if (!empty($data->extensionduedate)) {
            $data->extensionduedate = $this->apply_date_offset($data->extensionduedate);
        } else {
            $data->extensionduedate = 0;
        }
        // Flags mailed and locked need no translation on restore.

        $newitemid = $DB->insert_record('practicalab_user_flags', $data);
    }

    /**
     * Process a grade restore
     * @param object $data The data in object form
     * @return void
     */
    protected function process_practicalab_grade($data) {
        global $DB;

        $data = (object)$data;
        $oldid = $data->id;

        $data->practicalabment = $this->get_new_parentid('practicalab');

        $data->timemodified = $this->apply_date_offset($data->timemodified);
        $data->timecreated = $this->apply_date_offset($data->timecreated);
        $data->userid = $this->get_mappingid('user', $data->userid);
        $data->grader = $this->get_mappingid('user', $data->grader);

        // Handle flags restore to a different table.
        $flags = new stdClass();
        $flags->practicalabment = $this->get_new_parentid('practicalab');
        if (!empty($data->extensionduedate)) {
            $flags->extensionduedate = $this->apply_date_offset($data->extensionduedate);
        }
        if (!empty($data->mailed)) {
            $flags->mailed = $data->mailed;
        }
        if (!empty($data->locked)) {
            $flags->locked = $data->locked;
        }
        $DB->insert_record('practicalab_user_flags', $flags);

        $newitemid = $DB->insert_record('practicalab_grades', $data);

        // Note - the old contextid is required in order to be able to restore files stored in
        // sub plugin file areas attached to the gradeid.
        $this->set_mapping('grade', $oldid, $newitemid, false, null, $this->task->get_old_contextid());
    }

    /**
     * Process a plugin-config restore
     * @param object $data The data in object form
     * @return void
     */
    protected function process_practicalab_plugin_config($data) {
        global $DB;

        $data = (object)$data;
        $oldid = $data->id;

        $data->practicalabment = $this->get_new_parentid('practicalab');

        $newitemid = $DB->insert_record('practicalab_plugin_config', $data);
    }

    /**
     * Once the database tables have been fully restored, restore the files
     * @return void
     */
    protected function after_execute() {
        $this->add_related_files('mod_practicalab', 'intro', null);
    }
}
