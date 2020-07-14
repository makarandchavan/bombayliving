<?php

function bombayliving_services_resource() {
    $api = array(
      'bombayliving' => array(
        'operations' => array(
          'update' => array(
            'help' => 'Adds user to newsletter list.',
            'file' => array(
              'type' => 'inc',
              'module' => 'bombayliving',
              'name' => 'include/bombayliving.resources',
            ),
            'callback' => 'bombayliving_resource_create',
            'access callback' => '_check_newsletter_subscription',
            'access arguments' => array('update'),
            'access arguments append' => TRUE,
            'args' => array(
              array(
                'name' => 'email',
                'type' => 'string',
                'description' => 'The email address to be subscribed',
                'source' => array('path' => '0'),
                'optional' => FALSE,
              ),
              array(
                'name' => 'uid',
                'type' => 'int',
                'description' => 'Unique identifier for this user',
                'source' => array(
                  'path' => '1'
                ),
                'optional' => TRUE,
                'default value' => 0,
              ),
            ),
          ),
        ),
      ),
    );
    return $api;
  }


  /**
 * [bombayliving_resource_create] definition.
 * Adds user to newsletter listing.
 * @param $email
 *   The email to be subscribed.
 * @return array
 *	The node processed information array.
 */
function bombayliving_resource_create($email, $uid = 0) {
    $form = drupal_get_form('newsletter_manage_subscriptions_form');
    $form_state['values'] = array();
    $form_state['values']['nsid'] = 2;
    $form_state['values']['email'] = $email;
    $form_state['values']['receive_format'] = 'html';

    if(!empty($uid)) {
        $user = user_load($uid);
        $form_state['values']['uid'] = $user->uid;
        $form_state['values']['firstname'] = $user->field_first_name['und'][0]['value'];
        $form_state['values']['lastname'] = $user->field_last_name['und'][0]['value'];
    }

    $subscriber = (object) $form_state['values'];
    if (empty($form_state['values']['nsid'])) {
        unset($subscriber->nsid);
    }
    else {
        $needs_confirm = FALSE;
    }
    if (empty($form_state['values']['uid'])) {
        $subscriber->uid = NULL;
    }

    $subscriber->confirmed = 1;
    $subscriber->confirmation_timestamp = REQUEST_TIME;
    field_attach_submit('newsletter_subscriber', $subscriber, $form, $form_state);
    $status = entity_get_controller('newsletter_subscriber')->save($subscriber);
    if (variable_get('newsletter_send_welcome', FALSE)) {
        newsletter_create()->sendBasic(2, $subscriber->email);
    }
    return (array) $status;
}

function _check_newsletter_subscription($op = 'update') {
    if($op == 'update') {
        return user_access('subscribe newsletters');
    }
}