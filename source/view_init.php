<?php

// DO NOT TOUCH THIS FILE

$id = optional_param('id', 0, PARAM_INT); // Course_module ID, or
$n = optional_param('n', 0, PARAM_INT);  // ... spsupervisormanagement instance ID - it should be named as the first character of the module.

if ($id) {
    $cm = get_coursemodule_from_id('spsupervisormanagement', $id, 0, false, MUST_EXIST);
    $course = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
    $spsupervisormanagement = $DB->get_record('spsupervisormanagement', array('id' => $cm->instance), '*', MUST_EXIST);
} else if ($n) {
    $spsupervisormanagement = $DB->get_record('spsupervisormanagement', array('id' => $n), '*', MUST_EXIST);
    $course = $DB->get_record('course', array('id' => $spsupervisormanagement->course), '*', MUST_EXIST);
    $cm = get_coursemodule_from_instance('spsupervisormanagement', $spsupervisormanagement->id, $course->id, false, MUST_EXIST);
} else {
    error('You must specify a course_module ID or an instance ID');
}

require_login($course, true, $cm);

$event = \mod_spsupervisormanagement\event\course_module_viewed::create(array(
    'objectid' => $PAGE->cm->instance,
    'context' => $PAGE->context,
));
$event->add_record_snapshot('course', $PAGE->course);
$event->add_record_snapshot($PAGE->cm->modname, $spsupervisormanagement);
$event->trigger();

// Print the page header.

$PAGE->set_url('/mod/spsupervisormanagement/view.php', array('id' => $cm->id));
$PAGE->set_title(format_string($spsupervisormanagement->name));
$PAGE->set_heading(format_string($course->fullname));

// Output starts here.
echo $OUTPUT->header();

// Conditions to show the intro can change to look for own settings or whatever.
if ($spsupervisormanagement->intro) {
    echo $OUTPUT->box(format_module_intro('spsupervisormanagement', $spsupervisormanagement, $cm->id), 'generalbox mod_introbox', 'spsupervisormanagementintro');
}
