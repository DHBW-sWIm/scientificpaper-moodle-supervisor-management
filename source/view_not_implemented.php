<?php

require_once(dirname(dirname(__DIR__)) . '/config.php');
require_once(__DIR__ . '/lib.php');
require_once(__DIR__ . '/locallib.php');

include(__DIR__ . '/view_init.php');

echo $OUTPUT->heading('Noch nicht implementiert.');

echo $OUTPUT->single_button(new moodle_url('/mod/spsupman/view.php', array('id' => $cm->id)),
        'Zurück', $attributes = null);
// Finish the page.
echo $OUTPUT->footer();
