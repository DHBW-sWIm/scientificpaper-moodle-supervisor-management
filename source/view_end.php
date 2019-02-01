<?php

require_once(dirname(dirname(__DIR__)) . '/config.php');
require_once(__DIR__ . '/lib.php');
require_once(__DIR__ . '/locallib.php');

include(__DIR__ . '/view_init.php');

// @todo Replace the following lines with you own code.

global $SESSION;

echo $OUTPUT->heading('Result');

echo "Saved entries:" . "\n E-Mail: " . $SESSION->formdata->email . "\n Name: " . $SESSION->formdata->name;

// Implement form for user
require_once(__DIR__ . '/forms/end_form.php');

$mform = new end_form();

$mform->render();

//Form processing and displaying is done here
if ($mform->is_cancelled()) {
    //Handle form cancel operation, if cancel button is present on form
} else if ($fromform = $mform->get_data()) {
    //Handle form successful operation, if button is present on form

    //Remove SESSION data for form
    unset($SESSION->formdata);
    // Redirect to the course main page.
    $returnurl = new moodle_url('/mod/spsupervisormanagement/view.php', array('id' => $cm->id));
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
