<?php

/**
 * @file
 * Contains \Drupal\slick\Element\SlickBreakPoint.
 */

namespace Drupal\slick\Element;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element\FormElement;
use Drupal\slick\Entity\SlickSettings;
/**
 * Provides an element
 *
 * @FormElement("slick_break_point")
 */
class SlickBreakPoint extends FormElement {

  /**
   * {@inheritdoc}
   */
  public function getInfo() {
    $class = get_class($this);
    return [
      '#input' => TRUE,
      '#process' => [
        [$class, 'process'],
      ],
      '#element_validate' => [
        [$class, 'validate'],
      ],
      '#theme' => 'slick_break_point',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public static function valueCallback(&$element, $input, FormStateInterface $form_state) {
    if(!empty($input)) {
      return array(
        'pixel_width' => $input['pixel_width'],
        'settings_eid' => $input['settings_eid'],
        'unslick' => $input['unslick'],
      );
    } else {
      return array(
        'pixel_width' => $element['#default_value']['pixel_width'],
        'settings_eid' => $element['#default_value']['settings_eid'],
        'unslick' => $element['#default_value']['unslick'],
      );
    }
  }

  /**
   * Render API callback: creates a SlickBreakPoint element.
   */
  public static function process(&$element, FormStateInterface $form_state, &$complete_form) {
    $element['pixel_width'] = array(
      '#type' => 'textfield',
      '#title' => t('Pixel Width to Break On'),
      '#default_value' => isset($element['#value']['pixel_width'])
        ? $element['#value']['pixel_width']
        : NULL,
    );
    $element['unslick'] = array(
      '#title' => t('Unset Slick Slideshow'),
      '#type' => 'checkbox',
      '#description' => t('This option will override the selection below.'),
      '#default_value' => isset($element['#value']['unslick'])
        ? $element['#value']['unslick']
        : NULL,
    );
    $element['settings_eid'] = array(
      '#title' => t('Break Point Settings'),
      '#type' => 'select',
      '#empty_option' => t('None'),
      '#options' => SlickSettings::as_options(),
      '#default_value' => isset($element['#value']['settings_eid'])
        ? $element['#value']['settings_eid']
        : NULL,
    );

    return $element;
  }

  /**
   * Validate
   */
  public static function validate(&$element, FormStateInterface $form_state, &$complete_form) {
    // @todo
    $form_state->setValueForElement($element, $element['#value']);
  }

}
