<?php

require_once($CFG->dirroot.'/course/moodleform_mod.php');

class mod_scratchlab_mod_form extends moodleform_mod {

    public function definition() {

        $mform = $this->_form;

        $mform->addElement(
            'text',
            'name',
            get_string('name')
        );

        $mform->setType('name', PARAM_TEXT);

        $this->standard_coursemodule_elements();

        $this->add_action_buttons();
    }
}