<?php
/**
 * @file slick.pages.inc
 *
 * @ingroup slick
 *
 * Contains theme callbacks for the slick module
 */

use Drupal\Component\Utility\Unicode;

function template_preprocess_slick_slideshow(&$variables) {
  $config_entity = $variables['slick_settings'];
  $variables['#attached']['library'][] = 'slick/slick';
  $variables['#attached']['library'][] = 'slick/behaviors';
  $variables['#attached']['drupalSettings']['slickSlideshows'][$variables['slideshow_id']] = array(
    'autoplay' => $config_entity->autoplay,
    'autoplaySpeed' => $config_entity->autoplay_speed,
    'accessibility' => $config_entity->accessibility,
    'adaptiveHeight' => $config_entity->adaptive_height,
    'arrows' => $config_entity->arrows,
    'asNavFor' => $config_entity->as_nav_for,
    'carousel_nav' => $config_entity->carousel_nav,
    'appendArrows' => $config_entity->append_arrows,
    'prevArrow' => $config_entity->prev_arrow,
    'nextArrow' => $config_entity->next_arrow,
    'centerMode' => $config_entity->center_mode,
    'centerPadding' => $config_entity->center_padding,
    'cssEase' => $config_entity->css_ease,
    'customPaging' => $config_entity->custom_paging,
    'responsive' => $config_entity->responsive,
  );
}

/**
 * Prepares variables for a lazy loaded image templates.
 *
 * Default template: slick-lazy-image.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - item: An ImageItem object.
 *   - item_attributes: An optional associative array of html attributes to be
 *     placed in the img tag.
 *   - image_style: An optional image style.
 *   - path: An optional array containing the link 'path' and link 'options'.
 */
function template_preprocess_slick_lazy_image(&$variables) {
  if ($variables['image_style']) {
    $variables['image'] = array(
      '#theme' => 'image_style',
      '#style_name' => $variables['image_style'],
    );
  }
  else {
    $variables['image'] = array(
      '#theme' => 'image',
    );
  }
  $variables['image']['#attributes'] = $variables['item_attributes'];

  $item = $variables['item'];

  // Do not output an empty 'title' attribute.
  if (Unicode::strlen($item->title) != 0) {
    $variables['image']['#title'] = $item->title;
  }

  if (($entity = $item->entity) && empty($item->uri)) {
    $variables['image']['#uri'] = $entity->getFileUri();
  }
  else {
    $variables['image']['#uri'] = $item->uri;
  }

  foreach (array('width', 'height', 'alt') as $key) {
    $variables['image']["#$key"] = $item->$key;
  }

  // The link path and link options are both optional, but for the options to be
  // processed, the link path must at least be an empty string.
  // @todo Add support for route names.
  $variables['url'] = NULL;
  if (isset($variables['path']['path'])) {
    $path = $variables['path']['path'];
    $options = isset($variables['path']['options']) ? $variables['path']['options'] : array();
    $variables['url'] = _url($path, $options);
  }
}

function template_preprocess_slick_break_point(&$variables) {
}