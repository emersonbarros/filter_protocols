<?php

namespace Drupal\filter_protocols\Form;

use Drupal\Core\Form\ConfigFormBase;

class FilterProtocolsSettingsForm extends ConfigFormBase {

    public function getFormId() {
        return 'filter_protocols_admin_settings';
    }

    public function buildForm(array $form, array &$form_state) {

        $protocols_config = $this->config('system.filter');

        $form['protocol'] = array(
            '#type' => 'fieldset',
            '#title' => t('Allowed Protocols'),
        );

        $form['protocol']['protocols'] = array(
            '#type' => 'textfield',
            '#title' => t('Allowed Protocols'),
            //'#default_value' => implode(' ', array('ftp', 'http', 'https', 'irc', 'mailto', 'news', 'nntp', 'rtsp', 'sftp', 'ssh', 'tel', 'telnet', 'webcal')),
            '#size' => 80,
            '#value' => implode(' ', $protocols_config->get('protocols')),
        );


        return parent::buildForm($form, $form_state);
    }

    public function submitForm(array &$form, array &$form_state) {
        $protocols_config = $this->config('system.filter');
        $protocols_config->set('protocols', $form_state['values']['protocols']);
 
        $protocols_config->save();
        parent::submitForm($form, $form_state);
    }

    public function validateForm(array &$form, array &$form_state) {
        $protocols = &$form_state['values']['protocols'];
        $protocols = drupal_strtolower(trim($protocols));
        $protocols = preg_split('/[\s]+/', $protocols, 0, PREG_SPLIT_NO_EMPTY);
        $protocols = array_unique($protocols);

        foreach ($protocols as $protocol) {
            if (!preg_match('/^[a-z][\w]*$/', $protocol)) {
                $this->setFormError('', $form_state, t('Invalid protocol %protocol.', array('%protocol' => $protocol)));
            }
        }
        parent::validateForm($form, $form_state);
    }

}

?>