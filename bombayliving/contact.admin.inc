<?php

function contact_category_edit_form_submit(){
    if(!empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['email']) && !empty($_POST['subject']) && !empty($_POST['message'])) {
        // Submit contact form programatically.
        $form_state = array();
        $form_state['values']['form_id'] = 'contact_site_form';
        $form_state['values']['cid'] = '1';
        $form_state['values']['mail'] = $_POST['email'];
        $form_state['values']['name'] = $_POST['fname'] . ' ' . $_POST['lname'];
        $form_state['values']['subject'] = $_POST['subject'];
        $form_state['values']['message'] = $_POST['message'];
        $form_state['values']['op'] = t('Send message');
        form_load_include($form_state, 'inc', 'contact', 'contact.pages');
        $results = drupal_form_submit('contact_site_form', $form_state);
        echo "<pre>";var_dump(drupal_form_submit('contact_site_form', $form_state));exit;
        if($results){
            print json_encode(array('success'));exit;
        }
        else {
            print json_encode(array('error' => array('code' => 406, 'message' => 'Some technical issue.')));
        }
    }
    else {
        print json_encode(array('One of the parameters empty'));exit;
    }
}