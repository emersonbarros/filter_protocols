<?php

namespace Drupal\filter_protocols\Form;

use Drupal\Core\Form\ConfigFormBase;

class FilterProtocolsSettingsForm extends ConfigFormBase {

    public function getFormId() {
        return 'filter_protocols_admin_settings';
    }

    public function buildForm(array $form, array &$form_state) {
        

        return parent::buildForm($form, $form_state);
    }

    public function submitForm(array &$form, array &$form_state) {
       
        parent::submitForm($form, $form_state);
    }

}

?>
