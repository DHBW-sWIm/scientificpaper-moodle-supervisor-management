<?php

require_once(dirname(dirname(__DIR__)) . '/config.php');
require_once(__DIR__ . '/lib.php');
require_once(__DIR__ . '/locallib.php');

include(__DIR__ . '/view_init.php');

// @todo Replace the following lines with you own code.

global $SESSION;

echo $OUTPUT->heading('Betreuerpool Management');

//Such-Funktion
require_once(__DIR__ . '/forms/filter_form.php');

//Such-Form
$mform = new filter_form();
$mform->render();

if ($SESSION->fromform) {
    $mform->set_data($SESSION->fromform);
    //Remove old formdata from SESSION
    //unset($SESSION->fromform);
}

//Form processing and displaying is done here
if ($mform->is_cancelled()) {
    //Handle form cancel operation, if cancel button is present on form
    //Handle form successful operation, if button is present on form
    //Create Filteroptions
    $filteroptions = new stdClass();
    $filteroptions->firstname = '';
    $filteroptions->lastname = '';
    //Push Filteroptions and formdata to the Session
    $SESSION->filteroptions = $filteroptions;
    $SESSION->fromform = $fromform;
    // Redirect with filter options.
    $returnurl = new moodle_url('/mod/spsupman/view.php', array('id' => $cm->id));
    redirect($returnurl);
} else if ($fromform = $mform->get_data()) {
    //Handle form successful operation, if button is present on form
    //Create Filteroptions
    $filteroptions = new stdClass();
    $filteroptions->firstname = $fromform->firstname;
    $filteroptions->lastname = $fromform->lastname;
    //Push Filteroptions and formdata to the Session
    $SESSION->filteroptions = $filteroptions;
    $SESSION->fromform = $fromform;
    // Redirect with filter options.
    $returnurl = new moodle_url('/mod/spsupman/view.php', array('id' => $cm->id));
    redirect($returnurl);
} else {
    // this branch is executed if the form is submitted but the data doesn't validate and the form should be redisplayed
    // or on the first display of the form.
    // Set default data (if any)
    // Required for module not to crash as a course id is always needed
    $formdata = array('id' => $id);
    $mform->set_data($formdata);
    //displays the form
    $mform->display();
}

//Searchfields
$searchfirstname = $SESSION->filteroptions->firstname;
$searchlastname = $SESSION->filteroptions->lastname;

//Supervisor Table
$sql_supervisors = 'SELECT * FROM {spsupman_supervisors}
                 WHERE ' . $DB->sql_like('firstname', ':firstname', false) . ' AND ' .
        $DB->sql_like('lastname', ':lastname', false);
$params_supervisors = array('firstname' => '%' . $searchfirstname . '%', 'lastname' => '%' . $searchlastname . '%');

$supervisors = $DB->get_records_sql($sql_supervisors, $params_supervisors);

$table_supervisors = new html_table();
$table_supervisors->head = array('Name', 'Vorname', 'Titel', 'Email', 'Fachbereich', '', '');
//Für jeden Datensatz
foreach ($supervisors as $supervisor) {
    $id = $supervisor->id;
    $name = $supervisor->lastname;
    $vorname = $supervisor->firstname;
    $titel = $supervisor->title;
    $email = $supervisor->email;
    $fachbereich = $supervisor->topictype;
    //Link zum löschen des Verantwortlichen in foreach-Schleife setzen
    $detailButton =
            $OUTPUT->single_button(new moodle_url('/mod/spsupman/view_show_supervisor.php',
                    array('id' => $cm->id, 'supervisorid' => $id)),
                    'Anzeigen', $attributes = null);
    $deleteSupButton =
            $OUTPUT->single_button(new moodle_url('/mod/spsupman/view_delete_supervisor.php',
                    array('id' => $cm->id, 'supervisorid' => $id)),
                    'Löschen', $attributes = null);
    //Daten zuweisen an HTML-Tabelle
    $table_supervisors->data[] = array($name, $vorname, $titel, $email, $fachbereich, $detailButton, $deleteSupButton);
}
//Tabelle ausgeben
echo $OUTPUT->heading('Übersicht der Betreuer');
echo $OUTPUT->single_button(new moodle_url('/mod/spsupman/view_new_supervisor.php', array('id' => $cm->id)),
        'Betreuer anlegen', $attributes = null);
echo html_writer::table($table_supervisors);

//Applications Table
$sql_applicant = 'SELECT * FROM {spsupman_applicant}
                 WHERE ' . $DB->sql_like('firstname', ':firstname', false) . ' AND ' .
        $DB->sql_like('lastname', ':lastname', false);
$params_applicant = array('firstname' => '%' . $searchfirstname . '%', 'lastname' => '%' . $searchlastname . '%');
$applicants = $DB->get_records_sql($sql_applicant, $params_applicant);

$table_applicants = new html_table();
$table_applicants->head = array('Name', 'Vorname', 'Titel', 'Email', 'Bewerbungseingang', '', '');
//Für jeden Datensatz
foreach ($applicants as $applicant) {
    $id = $applicant->id;
    $name = $applicant->lastname;
    $vorname = $applicant->firstname;
    $titel = $applicant->title;
    $email = $applicant->email;
    $timecreated = $returnValue = strftime('%d.%m.%Y', $applicant->timecreated);
    //Link zum löschen des Verantwortlichen in foreach-Schleife setzen
    $workButton =
            $OUTPUT->single_button(new moodle_url('/mod/spsupman/view_show_applicant.php', array('id' => $cm->id, 'applicantid' => $id)),
                    'Anzeigen', $attributes = null);
    $deleteAppButton =
            $OUTPUT->single_button(new moodle_url('/mod/spsupman/view_delete_applicant.php',
                    array('id' => $cm->id, 'applicantid' => $id)),
                    'Löschen', $attributes = null);
    //Daten zuweisen an HTML-Tabelle
    $table_applicants->data[] = array($name, $vorname, $titel, $email, $timecreated, $workButton, $deleteAppButton);
}
//Tabelle ausgeben
echo $OUTPUT->heading('Übersicht der Bewerber');
echo html_writer::table($table_applicants);

// Finish the page.
echo $OUTPUT->footer();
