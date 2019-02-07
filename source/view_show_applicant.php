<?php

require_once(dirname(dirname(__DIR__)) . '/config.php');
require_once(__DIR__ . '/lib.php');
require_once(__DIR__ . '/locallib.php');

include(__DIR__ . '/view_init.php');

//Get Applicant ID from URL
$applicantid = optional_param('applicantid', 0, PARAM_INT);

//Get Supervisor Data
$table = 'spsupman_applicant';
$params = array('id' => $applicantid);
$applicant = $DB->get_record($table, $params);

global $SESSION;

echo $OUTPUT->heading('Details zur Bewerbung');

// Implement form for user
require_once(__DIR__ . '/forms/show_applicant_form.php');

//Form
$mform = new show_applicant_form();
$mform->render();

//Get Data
$data = array('id' => $cm->id);

if ($applicant) {
    $data = array(
            'id' => $cm->id,
            "firstname" => $applicant->firstname,
            "lastname" => $applicant->lastname,
            "title" => $applicant->title,
            "gender" => $applicant->gender,
            "birthdate" => strftime('%d.%m.%Y', $applicant->birthdate),
            "languages" => $applicant->languages,
            "company" => $applicant->company,
            "address" => $applicant->address,
            "city" => $applicant->city,
            "postalcode" => $applicant->postalcode,
            "phone" => $applicant->phone,
            "email" => $applicant->email,
            "iban" => $applicant->iban,
            "specialisation" => $applicant->specialisation,
            "supportperiod" => $applicant->supportperiod,
            "max_year" => $applicant->peryear,
            "max_attime" => $applicant->atthesametime,
            "timecreated" => strftime('%d.%m.%Y', $applicant->timecreated),
            "timemodified" => strftime('%d.%m.%Y', $applicant->timemodified),
    );
}

$mform->set_data($data);

//Form processing and displaying is done here
if ($mform->is_cancelled()) {
    //Remove SESSION data for form
    unset($SESSION->formdata);
    // Redirect to the course main page.
    $returnurl = new moodle_url('/mod/spsupman/view.php', array('id' => $cm->id));
    redirect($returnurl);

    //Handle form cancel operation, if cancel button is present on form
} else if ($fromform = $mform->get_data()) {
    //Handle form successful operation, if button is present on form
    //Save application
    //$table = 'spsupman_supervisors';
    //$record = new stdClass();
    //$record->firstname = $fromform->firstname;
    //$record->lastname = $fromform->lastname;
    //$record->title = $fromform->title;
    //$record->gender = $fromform->gender;
    //$record->birthdate = $fromform->birthdate;
    //$record->languages = $fromform->languages;
    //$record->company = $fromform->company;
    //$record->address = $fromform->address;
    //$record->city = $fromform->city;
    //$record->postalcode = $fromform->postalcode;
    //$record->phone = $fromform->phone;
    //$record->email = $fromform->email;
    //$record->iban = $fromform->iban;
    //// $record->studium=$fromform->studium; FEHLT NOCH IN DER DB!!!
    //$record->specialisation = $fromform->specialisation;
    //$record->topictype = $fromform->specialisation;
    //$record->supportperiod = $fromform->supportperiod;
    //$record->bachelor = '';
    //$record->peryear = $fromform->max_year;
    //$record->atthesametime = $fromform->max_attime;
    //$record->timecreated = time();
    //$record->timemodified = time();
    //$lastinsertid = $DB->insert_record($table, $record, false);
    ////Delete
    //$table = 'spsupman_applicant';
    //$params = array('id' => $applicantid);
    //$DB->delete_records($table, $params);
    //// Redirect to the course result page.
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

// Finish the page.
echo $OUTPUT->footer();
