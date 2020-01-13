<?php

/**
 * @file
 * Contains rsvp_entity.page.inc.
 *
 * Page callback for RSVP entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for RSVP templates.
 *
 * Default template: rsvp_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_rsvp_entity(array &$variables) {
  // Fetch RsvpEntity Entity Object.
  $rsvp_entity = $variables['elements']['#rsvp_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
