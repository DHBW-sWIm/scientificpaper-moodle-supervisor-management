<?php

require_once(dirname(dirname(__DIR__)) . '/config.php');
require_once(__DIR__ . '/lib.php');
require_once(__DIR__ . '/locallib.php');

include(__DIR__ . '/view_init.php');

//Get Supervisor ID from URL
$supervisor_id = optional_param('supervisorid', 0, PARAM_INT);

//Get Supervisor Data
$table = 'spsupman_supervisors';
$params = array('id' => $supervisor_id);
$supervisor = $DB->get_record($table, $params);

global $SESSION;

echo $OUTPUT->heading('Details');

// Implement form for user
require_once(__DIR__ . '/forms/show_supervisor_form.php');

//Form
$mform = new show_supervisor_form();
$mform->render();

//Get Data
$data = array('id' => $cm->id);

if ($supervisor) {
    $data = array(
            'id' => $cm->id,
            "firstname" => $supervisor->firstname,
            "lastname" => $supervisor->lastname,
            "title" => $supervisor->title,
            "gender" => $supervisor->gender,
            "birthdate" => strftime('%d.%m.%Y', $supervisor->birthdate),
            "languages" => $supervisor->languages,
            "company" => $supervisor->company,
            "address" => $supervisor->address,
            "city" => $supervisor->city,
            "postalcode" => $supervisor->postalcode,
            "phone" => $supervisor->phone,
            "email" => $supervisor->email,
            "iban" => $supervisor->iban,
            "specialisation" => $supervisor->specialisation,
            "supportperiod" => $supervisor->supportperiod,
            "max_year" => $supervisor->peryear,
            "max_attime" => $supervisor->atthesametime,
            "timecreated" => strftime('%d.%m.%Y', $supervisor->timecreated),
            "timemodified" => strftime('%d.%m.%Y', $supervisor->timemodified),
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
    // Redirect to the course result page.
    $returnurl = new moodle_url('/mod/spsupman/view_not_implemented.php', array('id' => $cm->id, 'supervisorid' => $supervisor_id));
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
