<?php

namespace Drupal\filter_protocols\Form;

use Drupal\Core\Form\ConfigFormBase;

class FilterProtocolsSettingsForm extends ConfigFormBase {

    public function getFormId() {
        return 'filter_protocols_admin_settings';
    }

    public function buildForm(array $form, array &$form_state) {
        $form['protocol'] = array(
            '#type' => 'fieldset',
            '#title' => t('Allowed Protocols'),
        );
        $form['protocol']['protocols'] = array(
            '#type' => 'textfield',
            '#title' => t('Allowed Protocols'),
            '#default_value' => implode(' ',  array('ftp', 'http', 'https', 'irc', 'mailto', 'news', 'nntp', 'rtsp', 'sftp', 'ssh', 'tel', 'telnet', 'webcal')),
            '#size' => 80,
        );


        return parent::buildForm($form, $form_state);
    }

    public function submitForm(array &$form, array &$form_state) {
      $protocols_config = $this->config('system.filter');
      $protocols_config->set('protocols', $form_state['values']['protocols']);

      $protocols_config->save();
        parent::submitForm($form, $form_state);
    }

}

?>
