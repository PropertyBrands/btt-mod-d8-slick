<?php

/**
 * @file
 * Contains \Drupal\slick\Plugin\Field\FieldFormatter\SlickSlideshow.
 */

namespace Drupal\slick\Plugin\Field\FieldFormatter;

use Drupal\image\Plugin\Field\FieldFormatter\ImageFormatterBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Url;
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
    $slides = array();
    foreach ($items as $delta => $item) {
      if ($item->entity) {
        $image_uri = $item->entity->getFileUri();
        $slides[] = file_create_url($image_uri);
      }
    }
    $element = array(
      '#theme' => 'slick_slideshow',
      '#config_machine_name' => $this->getSetting('slideshow_settings'),
      '#slides' => $slides
    );
    return \Drupal::service('renderer')->render($element, FALSE);
  }
}