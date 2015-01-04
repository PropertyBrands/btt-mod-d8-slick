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
    $entity = SlickSettings::load($variables['config_machine_name']);
    $settings = $entity->get
  }
}