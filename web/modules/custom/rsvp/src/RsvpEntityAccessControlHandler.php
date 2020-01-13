<?php

namespace Drupal\rsvp;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the RSVP entity.
 *
 * @see \Drupal\rsvp\Entity\RsvpEntity.
 */
class RsvpEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\rsvp\Entity\RsvpEntityInterface $entity */
    dump($operation);

    switch ($operation) {

      case 'view':

        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished rsvp entities');
        }


        return AccessResult::allowedIfHasPermission($account, 'view published rsvp entities');

      case 'update':

        return AccessResult::allowedIfHasPermission($account, 'edit rsvp entities');

      case 'delete':

        return AccessResult::allowedIfHasPermission($account, 'delete rsvp entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add rsvp entities');
  }


}
