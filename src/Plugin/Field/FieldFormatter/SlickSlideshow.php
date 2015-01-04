<?php

/**
 * @file
 * Contains \Drupal\slick\Plugin\Field\FieldFormatter\SlickSlideshow.
 */

namespace Drupal\slick\Plugin\Field\FieldFormatter;

use Drupal\image\Plugin\Field\FieldFormatter\ImageFormatterBase;
use Drupal\image\Entity\ImageStyle;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'image_raw_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "slick_slideshow",
 *   label = @Translation("Slick Slideshow"),
 *   field_types = {
 *     "image"
 *   }
 * )
 */
class SlickSlideshow extends ImageFormatterBase
{

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $options = array();
    $slideshow_settings = entity_load_multiple('slick_settings');
    foreach($slideshow_settings as $k => $v) {
      $options[$k] = $v->label();
    }
    $element['slideshow_settings'] = array(
      '#title' => t('Slick Slideshow Settings'),
      '#type' => 'select',
      '#default_value' => $this->getSetting('slideshow_settings'),
      '#options' => $options,
    );

    print '<pre>';
    print_r($this); print '</pre>';

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary[] = t('Using settings: ' . $this->getSetting('slideshow_settings'));
    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items) {
    $elements = array();
    //print_r($items);
    print '<pre>';
    print_r($this); print '</pre>';
    return $elements;
  }
}