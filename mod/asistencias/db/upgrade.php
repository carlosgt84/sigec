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
 * Upgrade code for install
 *
 * @package   mod_asistencias
 * @copyright 2012 NetSpot {@link http://www.netspot.com.au}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * upgrade this asistenciasment instance - this function could be skipped but it will be needed later
 * @param int $oldversion The old version of the asistencias module
 * @return bool
 */
function xmldb_asistencias_upgrade($oldversion) {
    global $CFG, $DB;

    $dbman = $DB->get_manager();

    if ($oldversion < 2012051700) {

        // Define field to be added to asistencias.
        $table = new xmldb_table('asistencias');
        $field = new xmldb_field('sendlatenotifications', XMLDB_TYPE_INTEGER, '2', null,
                                 XMLDB_NOTNULL, null, '0', 'sendnotifications');

        // Conditionally launch add field.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Assign savepoint reached.
        upgrade_mod_savepoint(true, 2012051700, 'asistencias');
    }

    // Moodle v2.3.0 release upgrade line.
    // Put any upgrade step following this.

    if ($oldversion < 2012071800) {

        // Define field requiresubmissionstatement to be added to asistencias.
        $table = new xmldb_table('asistencias');
        $field = new xmldb_field('requiresubmissionstatement', XMLDB_TYPE_INTEGER, '2', null,
                                 XMLDB_NOTNULL, null, '0', 'timemodified');

        // Conditionally launch add field requiresubmissionstatement.

        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Assign savepoint reached.
        upgrade_mod_savepoint(true, 2012071800, 'asistencias');
    }

    if ($oldversion < 2012081600) {

        // Define field to be added to asistencias.
        $table = new xmldb_table('asistencias');
        $field = new xmldb_field('completionsubmit', XMLDB_TYPE_INTEGER, '2', null,
                                 XMLDB_NOTNULL, null, '0', 'timemodified');

        // Conditionally launch add field.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Assign savepoint reached.
        upgrade_mod_savepoint(true, 2012081600, 'asistencias');
    }

    // Individual extension dates support.
    if ($oldversion < 2012082100) {

        // Define field cutoffdate to be added to asistencias.
        $table = new xmldb_table('asistencias');
        $field = new xmldb_field('cutoffdate', XMLDB_TYPE_INTEGER, '10', null,
                                 XMLDB_NOTNULL, null, '0', 'completionsubmit');

        // Conditionally launch add field cutoffdate.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }
        // If prevent late is on - set cutoffdate to due date.

        // Now remove the preventlatesubmissions column.
        $field = new xmldb_field('preventlatesubmissions', XMLDB_TYPE_INTEGER, '2', null,
                                 XMLDB_NOTNULL, null, '0', 'nosubmissions');
        if ($dbman->field_exists($table, $field)) {
            // Set the cutoffdate to the duedate if preventlatesubmissions was enabled.
            $sql = 'UPDATE {asistencias} SET cutoffdate = duedate WHERE preventlatesubmissions = 1';
            $DB->execute($sql);

            $dbman->drop_field($table, $field);
        }

        // Define field extensionduedate to be added to asistencias_grades.
        $table = new xmldb_table('asistencias_grades');
        $field = new xmldb_field('extensionduedate', XMLDB_TYPE_INTEGER, '10', null,
                                 XMLDB_NOTNULL, null, '0', 'mailed');

        // Conditionally launch add field extensionduedate.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Assign savepoint reached.
        upgrade_mod_savepoint(true, 2012082100, 'asistencias');
    }

    // Team asistenciasment support.
    if ($oldversion < 2012082300) {

        // Define field to be added to asistencias.
        $table = new xmldb_table('asistencias');
        $field = new xmldb_field('teamsubmission', XMLDB_TYPE_INTEGER, '2', null,
                                 XMLDB_NOTNULL, null, '0', 'cutoffdate');

        // Conditionally launch add field.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }
        $field = new xmldb_field('requireallteammemberssubmit', XMLDB_TYPE_INTEGER, '2', null,
                                 XMLDB_NOTNULL, null, '0', 'teamsubmission');
        // Conditionally launch add field.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }
        $field = new xmldb_field('teamsubmissiongroupingid', XMLDB_TYPE_INTEGER, '10', null,
                                 XMLDB_NOTNULL, null, '0', 'requireallteammemberssubmit');
        // Conditionally launch add field.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }
        $index = new xmldb_index('teamsubmissiongroupingid',
                                 XMLDB_INDEX_NOTUNIQUE,
                                 array('teamsubmissiongroupingid'));
        // Conditionally launch add index.
        if (!$dbman->index_exists($table, $index)) {
            $dbman->add_index($table, $index);
        }
        $table = new xmldb_table('asistencias_submission');
        $field = new xmldb_field('groupid', XMLDB_TYPE_INTEGER, '10', null,
                                 XMLDB_NOTNULL, null, '0', 'status');
        // Conditionally launch add field.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }
        upgrade_mod_savepoint(true, 2012082300, 'asistencias');
    }
    if ($oldversion < 2012082400) {

        // Define table asistencias_user_mapping to be created.
        $table = new xmldb_table('asistencias_user_mapping');

        // Adding fields to table asistencias_user_mapping.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('asistenciasment', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('userid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');

        // Adding keys to table asistencias_user_mapping.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));
        $table->add_key('asistenciasment', XMLDB_KEY_FOREIGN, array('asistenciasment'), 'asistencias', array('id'));
        $table->add_key('user', XMLDB_KEY_FOREIGN, array('userid'), 'user', array('id'));

        // Conditionally launch create table for asistencias_user_mapping.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Define field blindmarking to be added to asistencias.
        $table = new xmldb_table('asistencias');
        $field = new xmldb_field('blindmarking', XMLDB_TYPE_INTEGER, '2', null,
                                 XMLDB_NOTNULL, null, '0', 'teamsubmissiongroupingid');

        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Define field revealidentities to be added to asistencias.
        $table = new xmldb_table('asistencias');
        $field = new xmldb_field('revealidentities', XMLDB_TYPE_INTEGER, '2', null,
                                 XMLDB_NOTNULL, null, '0', 'blindmarking');

        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Assignment savepoint reached.
        upgrade_mod_savepoint(true, 2012082400, 'asistencias');
    }

    // Moodle v2.4.0 release upgrade line.
    // Put any upgrade step following this.

    if ($oldversion < 2013030600) {
        upgrade_set_timeout(60*20);

        // Some asistenciasments (upgraded from 2.2 asistenciasment) have duplicate entries in the asistencias_submission
        // and asistencias_grades tables for a single user. This needs to be cleaned up before we can add the unique indexes
        // below.

        // Only do this cleanup if the attempt number field has not been added to the table yet.
        $table = new xmldb_table('asistencias_submission');
        $field = new xmldb_field('attemptnumber', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0', 'groupid');
        if (!$dbman->field_exists($table, $field)) {
            // OK safe to cleanup duplicates here.

            $sql = 'SELECT asistenciasment, userid, groupid from {asistencias_submission} GROUP BY asistenciasment, userid, groupid HAVING (count(id) > 1)';
            $badrecords = $DB->get_recordset_sql($sql);

            foreach ($badrecords as $badrecord) {
                $params = array('userid'=>$badrecord->userid,
                                'groupid'=>$badrecord->groupid,
                                'asistenciasment'=>$badrecord->asistenciasment);
                $duplicates = $DB->get_records('asistencias_submission', $params, 'timemodified DESC', 'id, timemodified');
                if ($duplicates) {
                    // Take the first (last updated) entry out of the list so it doesn't get deleted.
                    $valid = array_shift($duplicates);
                    $deleteids = array();
                    foreach ($duplicates as $duplicate) {
                        $deleteids[] = $duplicate->id;
                    }

                    list($sqlids, $sqlidparams) = $DB->get_in_or_equal($deleteids);
                    $DB->delete_records_select('asistencias_submission', 'id ' . $sqlids, $sqlidparams);
                }
            }

            $badrecords->close();
        }

        // Same cleanup required for asistencias_grades
        // Only do this cleanup if the attempt number field has not been added to the table yet.
        $table = new xmldb_table('asistencias_grades');
        $field = new xmldb_field('attemptnumber', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0', 'grade');
        if (!$dbman->field_exists($table, $field)) {
            // OK safe to cleanup duplicates here.

            $sql = 'SELECT asistenciasment, userid from {asistencias_grades} GROUP BY asistenciasment, userid HAVING (count(id) > 1)';
            $badrecords = $DB->get_recordset_sql($sql);

            foreach ($badrecords as $badrecord) {
                $params = array('userid'=>$badrecord->userid,
                                'asistenciasment'=>$badrecord->asistenciasment);
                $duplicates = $DB->get_records('asistencias_grades', $params, 'timemodified DESC', 'id, timemodified');
                if ($duplicates) {
                    // Take the first (last updated) entry out of the list so it doesn't get deleted.
                    $valid = array_shift($duplicates);
                    $deleteids = array();
                    foreach ($duplicates as $duplicate) {
                        $deleteids[] = $duplicate->id;
                    }

                    list($sqlids, $sqlidparams) = $DB->get_in_or_equal($deleteids);
                    $DB->delete_records_select('asistencias_grades', 'id ' . $sqlids, $sqlidparams);
                }
            }

            $badrecords->close();
        }

        // Define table asistencias_user_flags to be created.
        $table = new xmldb_table('asistencias_user_flags');

        // Adding fields to table asistencias_user_flags.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('userid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('asistenciasment', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('locked', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('mailed', XMLDB_TYPE_INTEGER, '4', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('extensionduedate', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');

        // Adding keys to table asistencias_user_flags.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));
        $table->add_key('userid', XMLDB_KEY_FOREIGN, array('userid'), 'user', array('id'));
        $table->add_key('asistenciasment', XMLDB_KEY_FOREIGN, array('asistenciasment'), 'asistencias', array('id'));

        // Adding indexes to table asistencias_user_flags.
        $table->add_index('mailed', XMLDB_INDEX_NOTUNIQUE, array('mailed'));

        // Conditionally launch create table for asistencias_user_flags.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);

            // Copy the flags from the old table to the new one.
            $sql = 'INSERT INTO {asistencias_user_flags}
                        (asistenciasment, userid, locked, mailed, extensionduedate)
                    SELECT asistenciasment, userid, locked, mailed, extensionduedate
                    FROM {asistencias_grades}';
            $DB->execute($sql);
        }

        // And delete the old columns.
        // Define index mailed (not unique) to be dropped form asistencias_grades.
        $table = new xmldb_table('asistencias_grades');
        $index = new xmldb_index('mailed', XMLDB_INDEX_NOTUNIQUE, array('mailed'));

        // Conditionally launch drop index mailed.
        if ($dbman->index_exists($table, $index)) {
            $dbman->drop_index($table, $index);
        }

        // Define field locked to be dropped from asistencias_grades.
        $table = new xmldb_table('asistencias_grades');
        $field = new xmldb_field('locked');

        // Conditionally launch drop field locked.
        if ($dbman->field_exists($table, $field)) {
            $dbman->drop_field($table, $field);
        }

        // Define field mailed to be dropped from asistencias_grades.
        $table = new xmldb_table('asistencias_grades');
        $field = new xmldb_field('mailed');

        // Conditionally launch drop field mailed.
        if ($dbman->field_exists($table, $field)) {
            $dbman->drop_field($table, $field);
        }

        // Define field extensionduedate to be dropped from asistencias_grades.
        $table = new xmldb_table('asistencias_grades');
        $field = new xmldb_field('extensionduedate');

        // Conditionally launch drop field extensionduedate.
        if ($dbman->field_exists($table, $field)) {
            $dbman->drop_field($table, $field);
        }

        // Define field attemptreopenmethod to be added to asistencias.
        $table = new xmldb_table('asistencias');
        $field = new xmldb_field('attemptreopenmethod', XMLDB_TYPE_CHAR, '10', null,
                                 XMLDB_NOTNULL, null, 'none', 'revealidentities');

        // Conditionally launch add field attemptreopenmethod.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Define field maxattempts to be added to asistencias.
        $table = new xmldb_table('asistencias');
        $field = new xmldb_field('maxattempts', XMLDB_TYPE_INTEGER, '6', null, XMLDB_NOTNULL, null, '-1', 'attemptreopenmethod');

        // Conditionally launch add field maxattempts.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Define field attemptnumber to be added to asistencias_submission.
        $table = new xmldb_table('asistencias_submission');
        $field = new xmldb_field('attemptnumber', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0', 'groupid');

        // Conditionally launch add field attemptnumber.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Define index attemptnumber (not unique) to be added to asistencias_submission.
        $table = new xmldb_table('asistencias_submission');
        $index = new xmldb_index('attemptnumber', XMLDB_INDEX_NOTUNIQUE, array('attemptnumber'));
        // Conditionally launch add index attemptnumber.
        if (!$dbman->index_exists($table, $index)) {
            $dbman->add_index($table, $index);
        }

        // Define field attemptnumber to be added to asistencias_grades.
        $table = new xmldb_table('asistencias_grades');
        $field = new xmldb_field('attemptnumber', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0', 'grade');

        // Conditionally launch add field attemptnumber.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Define index attemptnumber (not unique) to be added to asistencias_grades.
        $table = new xmldb_table('asistencias_grades');
        $index = new xmldb_index('attemptnumber', XMLDB_INDEX_NOTUNIQUE, array('attemptnumber'));

        // Conditionally launch add index attemptnumber.
        if (!$dbman->index_exists($table, $index)) {
            $dbman->add_index($table, $index);
        }

        // Define index uniqueattemptsubmission (unique) to be added to asistencias_submission.
        $table = new xmldb_table('asistencias_submission');
        $index = new xmldb_index('uniqueattemptsubmission',
                                 XMLDB_INDEX_UNIQUE,
                                 array('asistenciasment', 'userid', 'groupid', 'attemptnumber'));

        // Conditionally launch add index uniqueattempt.
        if (!$dbman->index_exists($table, $index)) {
            $dbman->add_index($table, $index);
        }

        // Define index uniqueattemptgrade (unique) to be added to asistencias_grades.
        $table = new xmldb_table('asistencias_grades');
        $index = new xmldb_index('uniqueattemptgrade', XMLDB_INDEX_UNIQUE, array('asistenciasment', 'userid', 'attemptnumber'));

        // Conditionally launch add index uniqueattempt.
        if (!$dbman->index_exists($table, $index)) {
            $dbman->add_index($table, $index);
        }

        // Module asistencias savepoint reached.
        upgrade_mod_savepoint(true, 2013030600, 'asistencias');
    }

    return true;
}


