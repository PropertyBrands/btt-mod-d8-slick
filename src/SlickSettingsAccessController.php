<?php

/**
 * @file
 * Contains \Drupal\slick\SlickSettingsAccessController.
 */

namespace Drupal\slick;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Defines an access controller for the Slideshow Settings entity.
 *
 * We set this class to be the access controller in the entity annotation.
 *
 * @see \Drupal\slick\Entity\SlickSettings
 *
 * @ingroup slick
 */
class SlickSettingsAccessController extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  public function checkAccess(EntityInterface $entity, $operation, $langcode, AccountInterface $account) {
    // The $opereration parameter tells you what sort of operation access is
    // being checked for.
    if ($operation == 'view') {
      return TRUE;
    }
    //@todo - uh, something?
    return parent::checkAccess($entity, $operation, $langcode, $account);
  }

}
