<?php
/**
 * @file slick.pages.inc
 *
 * @ingroup slick
 *
 * Contains theme callbacks for the slick module
 */

use Drupal\slick\Entity\SlickSettings;

function template_preprocess_slick_slideshow(&$variables) {
  kpr($variables);
}