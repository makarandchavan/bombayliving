<?php

function contact_category_edit_form_submit(){
    // Disable caching.
    drupal_page_is_cacheable(FALSE);
    header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

    $file_content = file_get_contents('php://input');
    $data = json_decode($file_content, TRUE);
    if(!empty($data)) {
        $_POST = $data;
    }
    if(!empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['email']) && !empty($_POST['subject']) && !empty($_POST['message'])) {
        // Submit contact form programatically.
        $form_state = array();
        $form_state['values']['form_id'] = 'contact_site_form';
        $form_state['values']['cid'] = '1';
        $form_state['values']['mail'] = filter_xss($_POST['email']);
        $form_state['values']['name'] = filter_xss($_POST['fname']) . ' ' . filter_xss($_POST['lname']);
        $form_state['values']['subject'] = filter_xss($_POST['subject']);
        $form_state['values']['message'] = filter_xss($_POST['message']);
        $form_state['values']['op'] = t('Send message');
        form_load_include($form_state, 'inc', 'contact', 'contact.pages');
        $results = drupal_form_submit('contact_site_form', $form_state);
        print json_encode(array('success'));exit;
    }
    else {
        print json_encode(array('error' => array('code' => 406, 'message' => 'Please fill all details.')));
    }
}