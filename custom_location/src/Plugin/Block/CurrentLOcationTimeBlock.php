<?php

namespace Drupal\custom_location\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\custom_location\Service\CurrentTime;

/**
 * Provides a 'Current Time Block' block.
 *
 * @Block(
 *   id = "current_location_time_block",
 *   admin_label = @Translation("Current Location Time Block")
 * )
 */
class CurrentLOcationTimeBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function getCacheMaxAge() {
    // Set cache to 0.
    return 0;
  }

  /**
   * {@inheritdoc}
   *
   * The return value of the build() method is a renderable array.
   */
  public function build() {
    // Call service using dependency injection.
    $service = \Drupal::getContainer()->get(CurrentTime::class);
    $locationSettings = $service->getLocationTime();

    return [
      '#theme' => 'location_block',
      '#country' => $locationSettings['country'],
      '#city' => $locationSettings['city'],
      '#time' => $locationSettings['time'],
    ];
  }

}
