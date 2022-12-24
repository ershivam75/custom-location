<?php

namespace Drupal\custom_location\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;

/**
 * Provides Location settings configuration form.
 */
class LocationSettingsConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'custom_location.location_settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'location_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('custom_location.location_settings');

    $options = [];
    $options = [
      "America/Chicago" => "America/Chicago",
      "America/New_York" => "America/New_York",
      "Asia/Tokyo" => "Asia/Tokyo",
      "Asia/Dubai" => "Asia/Dubai",
      "Asia/Kolkata" => "Asia/Kolkata",
      "Europe/Amsterdam" => "Europe/Amsterdam",
      "Europe/Oslo" => "Europe/Oslo",
      "Europe/London" => "Europe/London",
    ];
    $form['row'] = [
      '#type' => 'container',
      '#attributes' => [
        'class' => ['row'],
      ],
    ];

    $form['row']['country'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Country'),
      '#required' => TRUE,
      '#default_value' => $config->get('country'),
      '#attributes' => [
        'placeholder' => ['Country'],
      ],
      '#prefix' => '<div class="col-md-4">',
      '#suffix' => '</div>',
    ];

    $form['row']['city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('City'),
      '#default_value' => $config->get('city'),
      '#required' => TRUE,
      '#attributes' => [
        'placeholder' => ['City'],
      ],
      '#prefix' => '<div class="col-md-4">',
      '#suffix' => '</div>',
    ];

    $form['row']['timezone'] = [
      '#type' => 'select',
      '#title' => $this->t('Timezone'),
      '#options' => $options,
      '#default_value' => $config->get('timezone'),
      '#validated' => TRUE,
      '#required' => TRUE,
      '#prefix' => '<div class="col-md-4">',
      '#suffix' => '</div>',
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Set configuratins.
    $this->config('custom_location.location_settings')
      ->set('country', $form_state->getValue('country'))
      ->set('city', $form_state->getValue('city'))
      ->set('timezone', $form_state->getValue('timezone'))
      ->save();
  }

}
