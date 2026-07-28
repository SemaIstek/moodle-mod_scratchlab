<?php

defined('MOODLE_INTERNAL') || die();

function scratcheditor_add_instance($data, $mform = null) {
    global $DB;

    $record = new stdClass();
    $record->course = $data->course;
    $record->name = $data->name;
    $record->timecreated = time();
    $record->timemodified = time();

    return $DB->insert_record('scratcheditor', $record);
}


function scratcheditor_update_instance($data, $mform = null) {
    global $DB;

    $record = new stdClass();
    $record->id = $data->instance;
    $record->course = $data->course;
    $record->name = $data->name;
    $record->timemodified = time();

    return $DB->update_record('scratcheditor', $record);
}


function scratcheditor_delete_instance($id) {
    global $DB;

    return $DB->delete_records('scratcheditor', ['id' => $id]);
}
