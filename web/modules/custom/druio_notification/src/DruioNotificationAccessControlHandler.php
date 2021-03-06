<?php

namespace Drupal\druio_notification;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Access controller for the Druio notification entity.
 *
 * @see \Drupal\druio_notification\Entity\DruioNotification.
 */
class DruioNotificationAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\druio_notification\Entity\DruioNotificationInterface $entity */
    switch ($operation) {
      case 'view':
        if ($entity->user_id->target_id == $account->id()) {
          // If user is owner of notification we check two permissions.
          return AccessResult::allowedIfHasPermissions($account, [
            'view own druio notification entities',
            'view all druio notification entities',
          ], 'OR');
        }
        else {
          return AccessResult::allowedIfHasPermission($account, 'view all druio notification entities');
        }

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit druio notification entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete druio notification entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add druio notification entities');
  }

}
