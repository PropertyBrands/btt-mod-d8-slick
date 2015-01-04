<?php

/**
 * @file
 * Contains Drupal\slick\Entity\SlickSettings.
 *
 * This contains our configuration entity class.
 *
 */

namespace Drupal\slick\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines a config entity for Slick slideshow settings.
 *
 * @see: http://kenwheeler.github.io/slick/
 *
 * @ingroup slick
 *
 * @ConfigEntityType(
 *   id = "slick_settings",
 *   label = @Translation("Slideshow Settings"),
 *   admin_permission = "administer slick settings",
 *   handlers = {
 *     "access" = "Drupal\slick\SlickSettingsAccessController",
 *     "list_builder" = "Drupal\slick\Controller\SlickSettingsList",
 *     "form" = {
 *       "add" = "Drupal\slick\Form\SlickSettingsAdd",
 *       "edit" = "Drupal\slick\Form\SlickSettingsEdit",
 *       "delete" = "Drupal\slick\Form\SlickSettingsDelete"
 *     }
 *   },
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label"
 *   },
 *   links = {
 *     "edit-form" = "slick_settings.edit",
 *     "delete-form" = "slick_settings.delete"
 *   }
 * )
 */
class SlickSettings extends ConfigEntityBase {

  /**
   * The slick_settings ID.
   *
   * @var string
   */
  public $id;

  /**
   * The slick_settings UUID.
   *
   * @var string
   */
  public $uuid;

  /**
   * The slick_settings label.
   *
   * @var string
   */
  public $label;

  /**
   * Setting: accessibility
   *
   * Defaults to TRUE
   *
   * @var boolean
   *
   * Enables tabbing and arrow key navigation
   */
  public $accessibility;

  /**
   * Setting: adaptiveHeight
   *
   * Defaults to FALSE
   *
   * @var boolean
   *
   * Enables adaptive height for single slide horizontal carousels.
   */
  public $adaptive_height;

  /**
   * Setting: autoplay
   *
   * Defaults to FALSE
   *
   * @var boolean
   *
   * Enables Autoplay.
   */
  public $autoplay;

  /**
   * Setting: autoplaySpeed
   *
   * Defaults to 3000
   *
   * @var int
   *
   * Autoplay Speed in milliseconds.
   */
  public $autoplay_speed;

  public static function load_multiple(array $eids) {

  }

}
