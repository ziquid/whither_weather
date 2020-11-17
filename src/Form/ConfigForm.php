<?php

namespace Drupal\whither_weather\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ConfigForm.
 */
class ConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'whither_weather.config',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'whither_weather_config_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('whither_weather.config');
    $form['Intro'] = [
      '#type' => 'markup',
      '#markup' => $this->t('The Whither Whether service needs an API Key to proceed.'),
    ];
    $form['api_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('API Key'),
      '#description' => $this->t('The API key from your <a href="https://home.openweathermap.org/api_keys" target="_blank">OpenWeatherMap api_keys page</a>.'),
      '#maxlength' => 64,
      '#size' => 64,
      '#default_value' => $config->get('api_key'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('whither_weather.config')
      ->set('api_key', $form_state->getValue('api_key'))
      ->save();
  }

}
