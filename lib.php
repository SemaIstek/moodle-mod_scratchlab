<?php

defined('MOODLE_INTERNAL') || die();

/**
 * Creates a new ScratchLab instance.
 */
function scratchlab_add_instance($data, $mform = null) {
    global $DB;

    $data->timecreated = time();

    return $DB->insert_record('scratchlab', $data);
}

/**
 * Updates an existing ScratchLab instance.
 */
function scratchlab_update_instance($data, $mform = null) {
    global $DB;

    $data->timemodified = time();
    $data->id = $data->instance;

    return $DB->update_record('scratchlab', $data);
}

/**
 * Deletes an instance.
 */
function scratchlab_delete_instance($id) {
    global $DB;

    if (!$scratchlab = $DB->get_record('scratchlab', ['id' => $id])) {
        return false;
    }

    $DB->delete_records('scratchlab', ['id' => $scratchlab->id]);

    return true;
}