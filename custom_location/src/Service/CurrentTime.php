<?php

namespace Drupal\custom_location\Service;

use Drupal\Core\Datetime\DrupalDateTime;

/**
 * Defines CurrentTime service.
 */
class CurrentTime {

  /**
   * Get current time according to the configuration settings .
   */
  public function getLocationTime() {

    // Get location details & timezone from configuration settings.
    $config = \Drupal::config('custom_location.location_settings');
    $country = $config->get('country');
    $city = $config->get('city');
    $timezone = $config->get('timezone');

    $now = DrupalDateTime::createFromTimestamp(time());
    $now->setTimezone(new \DateTimeZone($timezone));
    $current_time = $now->format('dS M Y - h:i A');
    $data = [
      "country" => $country,
      "city" => $city,
      "time" => $current_time,
    ];

    return $data;
  }

}
