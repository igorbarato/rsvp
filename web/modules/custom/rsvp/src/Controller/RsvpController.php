<?php

namespace Drupal\rsvp\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\AlertCommand;
use Drupal\Core\Ajax\PrependCommand;

class RsvpController extends ControllerBase {

    public function register($nid) {
        $user = \Drupal::currentUser();
        $user_id = $user->id();
        $user_name = $user->getDisplayName();
        $entity = \Drupal::entityTypeManager()
            ->getStorage('rsvp_entity')
            ->create([
                'name' => "Subscription $nid-$user_id",
                'attendant' => $user_id,
                'event_id' => $nid
            ]);
        $entity->save();
        $content = '<div class="view-row">' . $user_name . '</div>';
        $response = new AjaxResponse();
        $response->addCommand(new AlertCommand('Register Complete!'));
        $response->addCommand(new PrependCommand('.view-id-attendants .view-content', $content));
        return $response;
    }

    public function homepage() {
        return [
            '#type' => 'markup',
            '#markup' => 'Homepage'
        ];
    }

}