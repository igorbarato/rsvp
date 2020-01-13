<?php

namespace Drupal\rsvp\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityPublishedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the RSVP entity.
 *
 * @ingroup rsvp
 *
 * @ContentEntityType(
 *   id = "rsvp_entity",
 *   label = @Translation("RSVP"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\rsvp\RsvpEntityListBuilder",
 *     "views_data" = "Drupal\rsvp\Entity\RsvpEntityViewsData",
 *     "translation" = "Drupal\rsvp\RsvpEntityTranslationHandler",
 *
 *     "form" = {
 *       "default" = "Drupal\rsvp\Form\RsvpEntityForm",
 *       "add" = "Drupal\rsvp\Form\RsvpEntityForm",
 *       "edit" = "Drupal\rsvp\Form\RsvpEntityForm",
 *       "delete" = "Drupal\rsvp\Form\RsvpEntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\rsvp\RsvpEntityHtmlRouteProvider",
 *     },
 *     "access" = "Drupal\rsvp\RsvpEntityAccessControlHandler",
 *   },
 *   base_table = "rsvp_entity",
 *   data_table = "rsvp_entity_field_data",
 *   translatable = TRUE,
 *   admin_permission = "administer rsvp entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "published" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/rsvp_entity/{rsvp_entity}",
 *     "add-form" = "/rsvp/register",
 *     "edit-form" = "/admin/structure/rsvp_entity/{rsvp_entity}/edit",
 *     "delete-form" = "/admin/structure/rsvp_entity/{rsvp_entity}/delete",
 *     "collection" = "/admin/structure/rsvp_entity",
 *   },
 *   field_ui_base_route = "rsvp_entity.settings"
 * )
 */
class RsvpEntity extends ContentEntityBase implements RsvpEntityInterface {

  use EntityChangedTrait;
  use EntityPublishedTrait;

  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += [
      'user_id' => \Drupal::currentUser()->id(),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('name')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($attendant) {
    $this->set('name', $attendant);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getAttendant() {
    return $this->get('attendant')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setAttendant($attendant) {
    $this->set('attendant', $attendant);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getEventId() {
    return $this->get('event_id')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setEventId($attendant) {
    $this->set('event_id', $attendant);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('user_id')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('user_id')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('user_id', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('user_id', $account->id());
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    // Add the published field.
    $fields += static::publishedBaseFieldDefinitions($entity_type);

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the RSVP entity.'))
      ->setRevisionable(TRUE)
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setTranslatable(TRUE)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'author',
        'weight' => 0,
      ])
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'weight' => 5,
        'settings' => [
          'match_operator' => 'CONTAINS',
          'size' => '60',
          'autocomplete_type' => 'tags',
          'placeholder' => '',
        ],
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the Contact entity.'))
      ->setSettings([
        'max_length' => 255,
        'text_processing' => 0,
      ])
      // Set no default value.
      ->setDefaultValue(NULL)
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -6,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -6,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);


    $fields['attendant'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Attendant'))
      ->setDescription(t('The user ID of attendant on the event.'))
      ->setRevisionable(TRUE)
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setTranslatable(TRUE)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'author',
        'weight' => 0,
      ])
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'weight' => 5,
        'settings' => [
          'match_operator' => 'CONTAINS',
          'size' => '60',
          'autocomplete_type' => 'tags',
          'placeholder' => '',
        ],
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['event_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Event'))
      ->setDescription(t('The event ID.'))
      ->setSetting('target_type', 'node')
      ->setSetting('handler', 'default')
      ->setSetting('handler_settings',['target_bundles'=>['event'=>'event']] )
      ->setDisplayOptions('view', array(
        'label'  => 'hidden',
        'type'   => 'event',
        'weight' => 0,
      ))
      ->setDisplayOptions('form', array(
        'type'     => 'entity_reference_autocomplete',
        'weight'   => 5,
        'settings' => array(
          'match_operator'    => 'CONTAINS',
          'size'              => '60',
          'autocomplete_type' => 'tags',
          'placeholder'       => '',
        ),
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

}
