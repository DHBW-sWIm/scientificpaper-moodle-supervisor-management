<?php

require_once(dirname(dirname(__DIR__)) . '/config.php');
require_once(__DIR__ . '/lib.php');
require_once(__DIR__ . '/locallib.php');

include(__DIR__ . '/view_init.php');

//Get Supervisor ID from URL
$applicantid = optional_param('applicantid', 0, PARAM_INT);

//Delete Supervisor
$table = 'spsupman_applicant';
$params = array('id' => $applicantid);
$applicantid = $DB->get_record($table, $params);

$DB->delete_records($table, $params);

echo $OUTPUT->heading('Der Bewerber wurde erfolgreich gelöscht.');
echo $OUTPUT->heading('Name: ' . $applicantid->firstname . ' ' . $applicantid->lastname);
echo $OUTPUT->heading('Email: ' . $applicantid->email);

echo $OUTPUT->single_button(new moodle_url('/mod/spsupman/view.php', array('id' => $cm->id)),
        'Zurück', $attributes = null);
// Finish the page.
echo $OUTPUT->footer();
