<?php

require('../../config.php');

$id = required_param('id', PARAM_INT);

$cm = get_coursemodule_from_id('scratchlab', $id, 0, false, MUST_EXIST);
$course = $DB->get_record('course', ['id' => $cm->course], '*', MUST_EXIST);
$scratchlab = $DB->get_record('scratchlab', ['id' => $cm->instance], '*', MUST_EXIST);

require_login($course, true, $cm);

$context = context_module::instance($cm->id);

$PAGE->set_url('/mod/scratchlab/view.php', ['id' => $cm->id]);
$PAGE->set_context($context);
$PAGE->set_title($scratchlab->name);
$PAGE->set_heading($course->fullname);

echo $OUTPUT->header();

echo '
<iframe
    src="/mod/scratchlab/editor/index.html"
    width="100%"
    height="950"
    style="border:none;">
</iframe>
';

echo $OUTPUT->footer();
