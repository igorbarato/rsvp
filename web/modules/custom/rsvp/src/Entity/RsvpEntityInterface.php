<?php

namespace Drupal\rsvp\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining RSVP entities.
 *
 * @ingroup rsvp
 */
interface RsvpEntityInterface extends ContentEntityInterface, EntityChangedInterface, EntityPublishedInterface, EntityOwnerInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  /**
   * Gets the RSVP name.
   *
   * @return string
   *   Name of the RSVP.
   */
  public function getName();

  /**
   * Sets the RSVP name.
   *
   * @param string $name
   *   The RSVP name.
   *
   * @return \Drupal\rsvp\Entity\RsvpEntityInterface
   *   The called RSVP entity.
   */
  public function setName($name);

  /**
   * Gets the RSVP creation timestamp.
   *
   * @return int
   *   Creation timestamp of the RSVP.
   */
  public function getCreatedTime();

  /**
   * Sets the RSVP creation timestamp.
   *
   * @param int $timestamp
   *   The RSVP creation timestamp.
   *
   * @return \Drupal\rsvp\Entity\RsvpEntityInterface
   *   The called RSVP entity.
   */
  public function setCreatedTime($timestamp);

}
