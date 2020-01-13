<?php

namespace Drupal\rsvp\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'RsvpBlock' block.
 *
 * @Block(
 *  id = "rsvp_block",
 *  admin_label = @Translation("Rsvp block"),
 * )
 */
class RsvpBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $is_authenticated = \Drupal::currentUser()->isAuthenticated();
    $node = \Drupal::routeMatch()->getParameter('node');
    $nid = $node->id();
    $current_path = \Drupal::service('path.current')->getPath();
    $build = [];
    $build['#theme'] = 'rsvp_block';
    $build['#is_authenticated'] = $is_authenticated;
    $build['#current_path'] = $current_path;
    $build['#nid'] = $nid;
    $build['#content'] = 'Implement RsvpBlock.';

    return $build;
  }

}
