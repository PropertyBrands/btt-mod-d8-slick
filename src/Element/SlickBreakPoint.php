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
      );
    } else {
      return array(
        'pixel_width' => $element['#default_value']['pixel_width'],
        'settings_eid' => $element['#default_value']['settings_eid'],
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
      '#default_value' => $element['#value']['pixel_width'],
    );
    $element['settings_eid'] = array(
      '#title' => t('Break Point Settings'),
      '#type' => 'select',
      '#empty_option' => t('None'),
      '#options' => SlickSettings::as_options(),
      '#default_value' => $element['#value']['settings_eid'],
    );

    return $element;
  }

  /**
   * Validate
   */
  public static function validate(&$element, FormStateInterface $form_state, &$complete_form) {
    $form_state->setValueForElement($element, $element['#value']);
  }

}
