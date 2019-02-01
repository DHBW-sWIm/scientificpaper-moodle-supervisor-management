<?php

/**
 * Define all the backup steps that will be used by the backup_spsupman_activity_task
 */

defined('MOODLE_INTERNAL') || die;

/**
 * Define the complete spsupman structure for backup, with file and id annotations
 *
 * @package   mod_spsupman
 * @category  backup
 * @copyright 2016 Your Name <your@email.address>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class backup_spsupman_activity_structure_step extends backup_activity_structure_step {

    /**
     * Defines the backup structure of the module
     *
     * @return backup_nested_element
     */
    protected function define_structure() {

        // Get know if we are including userinfo.
        $userinfo = $this->get_setting_value('userinfo');

        // Define the root element describing the spsupman instance.
        $spsupman = new backup_nested_element('spsupman', array('id'), array(
            'name', 'intro', 'introformat', 'grade'));

        // If we had more elements, we would build the tree here.

        // Define data sources.
        $spsupman->set_source_table('spsupman', array('id' => backup::VAR_ACTIVITYID));

        // If we were referring to other tables, we would annotate the relation
        // with the element's annotate_ids() method.

        // Define file annotations (we do not use itemid in this example).
        $spsupman->annotate_files('mod_spsupman', 'intro', null);

        // Return the root element (spsupman), wrapped into standard activity structure.
        return $this->prepare_activity_structure($spsupman);
    }
}
