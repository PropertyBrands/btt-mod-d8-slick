<?php

/**
 * @file
 * Contains \Drupal\file\Element\ManagedFile.
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
    return array(
      'pixel_width' => $input['bp_pixels'],
      'settings' => $input['bp_settings'],
    );
  }

  /**
   * Render API callback: Expands the managed_file element type.
   */
  public static function process(&$element, FormStateInterface $form_state, &$complete_form) {
    $element['break_points'] = array(
      '#type' => 'fieldset',
      '#title' => t('Break Points'),
    );

    $element['break_points']['bp_pixels'] = array(
      '#type' => 'textfield',
      '#title' => t('Pixel Width to Break On'),
    );

    $element['break_points']['bp_settings'] = array(
      '#title' => t('Break Point Settings'),
      '#type' => 'select',
      '#options' => SlickSettings::as_options(),
    );

    return $element;
  }

  /**
   * Validate
   */
  public static function validate(&$element, FormStateInterface $form_state, &$complete_form) {
    kpr(func_get_args()); die;
  }

}
