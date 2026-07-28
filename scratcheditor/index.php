<?php

require('../../config.php');

$id = required_param('id', PARAM_INT); // course id

$course = get_course($id);
require_login($course);

$PAGE->set_url('/mod/scratcheditor/index.php', ['id' => $id]);
$PAGE->set_title('Scratch Editor');
$PAGE->set_heading($course->fullname);

echo $OUTPUT->header();
echo $OUTPUT->heading('Scratch Editor activities');

echo $OUTPUT->footer();
