<?php

/**
 * Define all the restore steps that will be used by the restore_spsupervisormanagement_activity_task
 */

/**
 * Structure step to restore one spsupervisormanagement activity
 *
 * @package   mod_spsupervisormanagement
 * @category  backup
 * @copyright 2016 Your Name <your@email.address>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class restore_spsupervisormanagement_activity_structure_step extends restore_activity_structure_step {

    /**
     * Defines structure of path elements to be processed during the restore
     *
     * @return array of {@link restore_path_element}
     */
    protected function define_structure() {

        $paths = array();
        $paths[] = new restore_path_element('spsupervisormanagement', '/activity/spsupervisormanagement');

        // Return the paths wrapped into standard activity structure.
        return $this->prepare_activity_structure($paths);
    }

    /**
     * Process the given restore path element data
     *
     * @param array $data parsed element data
     */
    protected function process_spsupervisormanagement($data) {
        global $DB;

        $data = (object) $data;
        $oldid = $data->id;
        $data->course = $this->get_courseid();

        if (empty($data->timecreated)) {
            $data->timecreated = time();
        }

        if (empty($data->timemodified)) {
            $data->timemodified = time();
        }

        if ($data->grade < 0) {
            // Scale found, get mapping.
            $data->grade = -($this->get_mappingid('scale', abs($data->grade)));
        }

        // Create the spsupervisormanagement instance.
        $newitemid = $DB->insert_record('spsupervisormanagement', $data);
        $this->apply_activity_instance($newitemid);
    }

    /**
     * Post-execution actions
     */
    protected function after_execute() {
        // Add spsupervisormanagement related files, no need to match by itemname (just internally handled context).
        $this->add_related_files('mod_spsupervisormanagement', 'intro', null);
    }
}
