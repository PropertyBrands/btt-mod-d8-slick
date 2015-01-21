<?php

/**
 * @file
 * Contains \Drupal\slick\Plugin\Field\FieldFormatter\SlickSlideshow.
 */

namespace Drupal\slick\Plugin\Field\FieldFormatter;

use Drupal\image\Plugin\Field\FieldFormatter\ImageFormatterBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\slick\Entity\SlickSettings;


/**
 * Plugin implementation of the 'slick_slideshow' formatter.
 *
 * @FieldFormatter(
 *   id = "slick_slideshow",
 *   label = @Translation("Slick Slideshow"),
 *   field_types = {
 *     "image"
 *   }
 * )
 */
class SlickSlideshow extends ImageFormatterBase {

  /**
   *
   * Because we need to grab the image style in viewElements we will only
   * instantiate this once and store on the object.
   *
   * @var \Drupal\slick\Entity\SlickSettings
   */
  public $slick_settings;

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return array(
      'slideshow_settings' => '',
    );
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $element['slideshow_settings'] = array(
      '#title' => t('Slick Slideshow Settings'),
      '#type' => 'select',
      '#default_value' => $this->getSetting('slideshow_settings'),
      '#options' => SlickSettings::as_options(),
    );

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $setting = $this->getSetting('slideshow_settings');
    $str = !empty($setting) ? $setting : 'none selected';
    $summary[] = t('Using settings: ')  . $str;
    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items) {
    $entity = SlickSettings::load($this->getSetting('slideshow_settings'));
    $this->slick_settings = $entity;
    // Collect cache tags to be added for each item in the field.
    $cache_tags = array();
    if (!empty($entity->slide_image_style)) {
      $image_style = entity_load('image_style', $entity->slide_image_style);
      $cache_tags = $image_style->getCacheTags();
    }
    foreach ($items as $delta => $item) {
      if ($item->entity) {
        if (isset($link_file)) {
          $image_uri = $item->entity->getFileUri();
          $uri = array(
            'path' => file_create_url($image_uri),
            'options' => array(),
          );
        }

        // Extract field item attributes for the theme function, and unset them
        // from the $item so that the field template does not re-render them.
        $item_attributes = $item->_attributes;
        unset($item->_attributes);

        $elements[$delta] = array(
          '#theme' => 'image_formatter',
          '#item' => $item,
          '#item_attributes' => $item_attributes,
          '#image_style' => $entity->slide_image_style,
          '#path' => isset($uri) ? $uri : '',
          '#cache' => array(
            'tags' => $cache_tags,
          ),
        );
      }
    }

    return $elements;
  }

  /**
   * {@inheritdoc}
   */
  public function view(FieldItemListInterface $items) {
    $field = $items->getFieldDefinition();
    $render = array(
      '#theme' => 'slick_slideshow',
      '#slides' => $this->viewElements($items),
      '#slick_settings' => $this->slick_settings,
      '#slideshow_id' => SlickSettings::SLIDESHOW_ID_PREFIX . '_' . $field->field_name,
      '#carousel' => NULL, //@todo
      '#carousel_id' => SlickSettings::SLIDESHOW_ID_PREFIX . '_' . $field->field_name . '_' . SlickSettings::CAROUSEL_SUFFIX,
      '#carousel_settings' => NULL, //@todo
    );
    return $render;
  }

}