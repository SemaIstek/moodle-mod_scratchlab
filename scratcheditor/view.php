<?php

require('../../config.php');
require_once($CFG->dirroot . '/mod/scratcheditor/lib.php');

$id = required_param('id', PARAM_INT); // course_module ID

$cm = get_coursemodule_from_id('scratcheditor', $id, 0, false, MUST_EXIST);
$course = get_course($cm->course);

require_login($course, true, $cm);

$PAGE->set_url('/mod/scratcheditor/view.php', ['id' => $cm->id]);
$PAGE->set_title('Scratch Editor');
$PAGE->set_heading($course->fullname);

echo $OUTPUT->header();


$frontendpath = $CFG->dirroot . '/mod/scratcheditor/frontend/index.html';
$frontendurl = $CFG->wwwroot . '/mod/scratcheditor/frontend/index.html?v=' . filemtime($frontendpath);
echo html_writer::tag('iframe', '',
    [
        'src' => $frontendurl,
        'width' => '100%',
        'height' => '800',
        'style' => 'border:none;'
    ]
);

echo $OUTPUT->footer();

