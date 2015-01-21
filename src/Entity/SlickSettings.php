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
   * The prefix which will be added to slideshow HTML IDs
   *
   * @const string
   */
  const SLIDESHOW_ID_PREFIX = 'slick_slideshow';

  /**
   * The suffix which will be added to slideshow HTML IDs for the sync'd carousel
   *
   * @const string
   */
  const CAROUSEL_SUFFIX = 'carousel';

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
   * Setting: Slide Image Style
   *
   * @var string
   *
   * The machine name of an image style to use for slides
   */
  public $slide_image_style;

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

  /**
   * Setting: arrows
   *
   * Defaults to true
   *
   * @var bool
   *
   * Prev/Next arrows.
   */
  public $arrows;

  /**
   * Setting: asNavFor
   *
   * Defaults to null
   *
   * @var string
   *
   * A CSS selector of another slideshow to sync
   */
  public $as_nav_for;

  /**
   * Setting: carouselNav
   *
   * Defaults to false
   *
   * @var bool
   *
   * A Drupal specific setting for creating a carousel navigation
   */
  public $carousel_nav;

  /**
   * Setting: appendArrows
   *
   * Defaults to $(element)
   *
   * @var string
   *
   * Change where the navigation arrows are attached (Selector, htmlString, Array, Element, jQuery object)
   */
  public $append_arrows;

  /**
   * Setting: prevArrow
   *
   * Defaults to <button type="button" class="slick-prev">Previous</button>
   *
   * @var string
   *
   * Allows you to select a node or customize the HTML for the "Previous" arrow.
   */
  public $prev_arrow;

  /**
   * Setting: nextArrow
   *
   * Defaults to <button type="button" class="slick-next">Next</button>
   *
   * @var string
   *
   * Allows you to select a node or customize the HTML for the "Next" arrow.
   */
  public $next_arrow;

  /**
   * Setting: centerMode
   *
   * Defaults to false
   *
   * @var bool
   *
   * Enables centered view with partial prev/next slides. Use with odd numbered slidesToShow counts.
   */
  public $center_mode;

  /**
   * Setting: centerPadding
   *
   * Defaults to 50px
   *
   * @var string
   *
   * Side padding when in center mode (px or %)
   */
  public $center_padding;

  /**
   * Setting: cssEase
   *
   * Defaults to ease
   *
   * @var string
   *
   * CSS3 Animation Easing
   */
  public $css_ease;

  /**
   * Setting: customPaging
   *
   * Defaults to null
   *
   * @var string (function)
   *
   * Custom paging templates. See source for use example.
   */
  public $custom_paging;

  /**
   * Return as FAPI formatted options
   * @return array
   */
  public static function as_options() {
    $options = array();
    $slideshow_settings = entity_load_multiple('slick_settings');
    foreach($slideshow_settings as $k => $v) {
      $options[$k] = $v->label();
    }
    return $options;
  }
}
