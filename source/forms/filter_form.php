<?php
require_once("$CFG->libdir/formslib.php");

class filter_form extends moodleform {
    //Add elements to form
    public function definition() {
        global $CFG;

        $mform = $this->_form; // Don't forget the underscore!

        $mform->addElement('text', 'lastname', 'Name');
        $mform->setType('lastname', PARAM_NOTAGS);
        //$mform->setDefault('name', '');

        $mform->addElement('text', 'firstname', 'Vorname');
        $mform->setType('firstname', PARAM_NOTAGS);

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);

        $buttonarray=array();
        $buttonarray[] = $mform->createElement('cancel', 'cancelbutton', 'Reset');
        $buttonarray[] = $mform->createElement('submit', 'submitbutton', 'Suchen');
        $mform->addGroup($buttonarray, 'buttonar', '', ' ', false);

    }
}
