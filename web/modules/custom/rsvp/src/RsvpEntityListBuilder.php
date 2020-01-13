<?php

namespace Drupal\rsvp;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;
use Drupal\Core\Entity;

/**
 * Defines a class to build a listing of RSVP entities.
 *
 * @ingroup rsvp
 */
class RsvpEntityListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('RSVP ID');
    $header['name'] = $this->t('Name');
    $header['email'] = $this->t('Email');
    $header['event'] = $this->t('Event');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var \Drupal\rsvp\Entity\RsvpEntity $entity */
    $event = \Drupal::entityTypeManager()->getStorage('node')->load($entity->event_id->target_id);
    $user = \Drupal::entityTypeManager()->getStorage('user')->load($entity->attendant->target_id);
    $row['id'] = $entity->id();
    $row['name'] = $user->getDisplayName();
    $row['email'] = $user->getEmail();
    $row['event'] = $event->title->value;
    return $row + parent::buildRow($entity);
  }
}
