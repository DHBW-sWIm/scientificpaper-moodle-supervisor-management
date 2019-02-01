<?php

/**
 * Defines backup_spsupervisormanagement_activity_task class
 */

defined('MOODLE_INTERNAL') || die;

require_once($CFG->dirroot . '/mod/spsupervisormanagement/backup/moodle2/backup_spsupervisormanagement_stepslib.php');

/**
 * Provides the steps to perform one complete backup of the spsupervisormanagement instance
 *
 * @package   mod_spsupervisormanagement
 * @category  backup
 * @copyright 2016 Your Name <your@email.address>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class backup_spsupervisormanagement_activity_task extends backup_activity_task {

    /**
     * No specific settings for this activity
     */
    protected function define_my_settings() {
    }

    /**
     * Defines a backup step to store the instance data in the spsupervisormanagement.xml file
     */
    protected function define_my_steps() {
        $this->add_step(new backup_spsupervisormanagement_activity_structure_step('spsupervisormanagement_structure', 'spsupervisormanagement.xml'));
    }

    /**
     * Encodes URLs to the index.php and view.php scripts
     *
     * @param string $content some HTML text that eventually contains URLs to the activity instance scripts
     * @return string the content with the URLs encoded
     */
    static public function encode_content_links($content) {
        global $CFG;

        $base = preg_quote($CFG->wwwroot, '/');

        // Link to the list of spsupervisormanagements.
        $search = '/(' . $base . '\/mod\/spsupervisormanagement\/index.php\?id\=)([0-9]+)/';
        $content = preg_replace($search, '$@spsupervisormanagementINDEX*$2@$', $content);

        // Link to spsupervisormanagement view by moduleid.
        $search = '/(' . $base . '\/mod\/spsupervisormanagement\/view.php\?id\=)([0-9]+)/';
        $content = preg_replace($search, '$@spsupervisormanagementVIEWBYID*$2@$', $content);

        return $content;
    }
}
