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
        //$mform->setDefault('name', '');

        //$mform->addElement('checkbox', 'mysupervisors', 'Nur meine Betreuer anzeigen');

        //$mform->setDefault('name', '');

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);

        $mform->addElement('submit', 'btnSubmit', 'Suchen');

    }

    //Custom validation should be added here
    function validation($data, $files) {
        return array();
    }
}
