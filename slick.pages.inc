<?php
/**
 * @file slick.pages.inc
 *
 * @ingroup slick
 *
 * Contains theme callbacks for the slick module
 */

use Drupal\slick\Entity\SlickSettings;

function slick_preprocess_slick_slideshow(&$variables) {
  if(!empty($variables['slides']) && !empty($variables['config_machine_name'])) {
    $js_settings = array('slick_slideshow'); // To be used with drupal_add_js later on
    $entity = SlickSettings::load($variables['config_machine_name']);
    $js_settings['slick_slideshow'] = array(
      'autoplay' => $entity->autoplay,
      'autoplaySpeed' => $entity->autoplay_speed,
      'adaptiveHeight' => $entity->adaptive_height,
      'accessibility' => $entity->accessibility,
    );
  }
}