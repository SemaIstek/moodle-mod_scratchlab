<?php

require_once($CFG->dirroot . '/course/moodleform_mod.php');

class mod_scratcheditor_mod_form extends moodleform_mod {

    public function definition() {
        $mform = $this->_form;

        // Aktivite adı
        $mform->addElement('text', 'name', get_string('scratcheditorname', 'scratcheditor'));
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', null, 'required', null, 'client');

        $this->standard_coursemodule_elements();
        $this->add_action_buttons();
    }
}
