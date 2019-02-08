<?php
require_once("$CFG->libdir/formslib.php");

class show_applicant_form extends moodleform {
    //Add elements to form
    public function definition() {
        global $CFG;
        $mform = $this->_form; // Don't forget the underscore!
        #Start of the Supervisor Promotion Form
        $mform->addElement('header', 'header1', 'Allgemeines');
        #NAME
        $mform->addElement('static', 'lastname', 'Name'); // Add elements to your form
        $mform->setType('lastname', PARAM_NOTAGS);                   //Set type of element
        #VORNAME
        $mform->addElement('static', 'firstname', 'Vorname'); // Add elements to your form
        $mform->setType('firstname', PARAM_NOTAGS);                   //Set type of element
        #TITEL
        $mform->addElement('static', 'title', 'Titel'); // Add elements to your form
        $mform->setType('title', PARAM_NOTAGS);                   //Set type of element
        #GESCHLECHT
        $mform->addElement('static', 'gender', 'Geschlecht');
        #GEBURTSDATUM
        $mform->addElement('static', 'birthdate', 'Geburtsdatum');
        #SPRACHEN
        $mform->addElement('static', 'languages', 'Sprachen'); // Add elements to your form
        $mform->setType('languages', PARAM_NOTAGS);                   //Set type of element
        #FIRMA
        $mform->addElement('static', 'company', 'Unternehmen'); // Add elements to your form
        $mform->setType('company', PARAM_NOTAGS);                   //Set type of element
        #space ---------------------------------------------------------------------------------
        $mform->addElement('static', 'label1', ' ', ' ');
        #STRASSE / HAUSNUMMER
        $mform->addElement('static', 'address', 'Strasse'); // Add elements to your form
        $mform->setType('address', PARAM_NOTAGS);                   //Set type of element
        #ORT
        $mform->addElement('static', 'city', 'Ort'); // Add elements to your form
        $mform->setType('city', PARAM_NOTAGS);                   //Set type of element
        #PLZ
        $mform->addElement('static', 'postalcode', 'PLZ'); // Add elements to your form
        $mform->setType('postalcode', PARAM_NOTAGS);                   //Set type of element
        #TELEFON
        $mform->addElement('static', 'phone', 'Telefon'); // Add elements to your form
        $mform->setType('phone', PARAM_NOTAGS);                   //Set type of element
        #EMAIL
        $mform->addElement('static', 'email', 'E-mail'); // Add elements to your form
        $mform->setType('email', PARAM_NOTAGS);                   //Set type of element
        $mform->addElement('header', 'header5', 'Bankdaten');
        #IBAN
        $mform->addElement('static', 'iban', 'IBAN'); // Add elements to your form
        $mform->setType('iban', PARAM_NOTAGS);                   //Set type of element
        #space ---------------------------------------------------------------------------------
        $mform->addElement('header', 'header3', 'Qualifikation');
        #AUSBILDUNG / STUDIUM
        //fehlt noch in der Datenbank
        $mform->addElement('static', 'studium', 'Studium'); // Add elements to your form
        $mform->setType('studium', PARAM_NOTAGS);                   //Set type of element
        #FACHGEBIETE
        $mform->addElement('static', 'specialisation', 'Fachgebiete'); // Add elements to your form
        $mform->setType('specialisation', PARAM_NOTAGS);                   //Set type of element
        #BETREUUNG VON
        $mform->addElement('static', 'label1', 'Themenbereiche des Betreuers');
        #BETREUUNG BACHELORARBEIT
        $mform->addElement('static', 'checkbox_bachelor', 'Steht der Betreuer für Bachelorarbeiten zur Verfügung?');
        #BETREUUNGSZEITRAUM
        $mform->addElement('static', 'supportperiod', 'Bewertungszeitraum');
        #MAX ANZAHL JAHR
        $mform->addElement('static', 'max_year', 'Max Anzahl Arbeiten pro Jahr');
        #MAX ANZAHL ZEITGLEICH
        $mform->addElement('static', 'max_attime', 'Max Anzahl Arbeiten zeitgleich');
        #space ---------------------------------------------------------------------------------
        $mform->addElement('static', 'label1', ' ', ' ');
        #space ---------------------------------------------------------------------------------
        $mform->addElement('header', 'header6', 'Anmerkungen');

        #Comment
        $mform->addElement('textarea', 'comment', 'Kommentar', 'wrap="virtual" rows="6" cols="40"'); // Add elements to your form
        $mform->setType('comment', PARAM_NOTAGS);                   //Set type of element

        #space ---------------------------------------------------------------------------------
        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
        #space ---------------------------------------------------------------------------------
        $mform->addElement('hidden', 'applicantid');
        $mform->setType('applicantid', PARAM_INT);
        #Bearbeiten
        $buttonarray = array();
        $buttonarray[] = $mform->createElement('cancel', 'cancelbutton', 'Zurück');
        $buttonarray[] = $mform->createElement('submit', 'submitbutton', 'Annehmen');
        $mform->addGroup($buttonarray, 'buttonar', '', ' ', false);

        $mform->setExpanded('header1', true);
        $mform->setExpanded('header3', true);
        $mform->setExpanded('header5', true);
        $mform->setExpanded('header6', true);
    }

}
