<?php    
        
$yiw_form_choosen = yiw_get_option( 'contact_form_choosen', '' );

$yiw_options['contact'] = array (         
	    
    /* =================== SIDEBARS =================== */
    'title' => array(    
        array( 	'name' => __('Contact Page Customize', 'yiw'),
        	   	'type' => 'title')
    ),            
    
    'create' => array(    
        array( 'name' => __('Create new', 'yiw'),
        	   'type' => 'section',
			   'effect' => 0),
        array( 'type' => 'open'),   
         
        array( 'name' => __('New contact form.', 'yiw'),
        	   'desc' => __('Add new empty contact form, that you can add into pages or posts. After adding new form, select it on option below and click on "Configure" button to configure it.', 'yiw'),
        	   'id' => 'contact_forms',
        	   'type' => 'text',
        	   'button' => __( 'Add Form', 'yiw' ),
        	   'data' => 'array',
        	   'mode' => 'merge',
        	   'show_value' => false,
			   'std' => ''),	
         
        array( 'name' => __('Configure contact form.', 'yiw'),
        	   'desc' => __('Choose a contact form and save, to configure below your form choosen.', 'yiw'),
        	   'id' => 'contact_form_choosen',
        	   'type' => 'select',
        	   'button' => __( 'Configure', 'yiw' ),
        	   'options' => yiw_get_list_forms(),
			   'std' => '' ),	
         
        array( 'name' => __('Shortcode of form', 'yiw'),
        	   'desc' => __('Copy this and paste into editor of pages or posts. This is the shortcode of contact form choosen on option above.', 'yiw'),
        	   'type' => 'show-text',
			   'text' => yiw_get_contact_form_shortcode() ),	     
         
        array( 'name' => __('Delete forms', 'yiw'),
        	   'desc' => __('Delete the forms that you have already created.', 'yiw'),
        	   'values' => 'contact_forms',
        	   'label' => array( 'Form', 'Forms' ),
        	   'type' => 'sidebar-table'),		     
         
        array( 'name' => __('Add example form.', 'yiw'),
        	   'desc' => __('Add a simple example form, specifing the name.', 'yiw'),
        	   'action' => 'create-contact-form',
        	   'id' => 'name-form',
        	   'type' => 'text',
        	   'button' => __( 'Create Form', 'yiw' ) ),	
        	
        array( 'type' => 'close')
    ),
    
    'configuration' => array(    
        array( 'name' => __('Contact Form Configuration for', 'yiw') . ' ' . $yiw_form_choosen,
        	   'type' => 'section'),
        array( 'type' => 'open'),   
        	
        array( 'name' => __('To', 'yiw'),
        	   'desc' => __('Define the emails witch send the email written by the user. If they are more then one, you can write theme separated by a comma.', 'yiw'),
        	   'id' => 'contact_form_to_' . $yiw_form_choosen,
        	   'type' => 'text',
        	   'std' => get_option( 'admin_email' ) ),
        	
        array( 'name' => __('From Email', 'yiw'),
        	   'desc' => __('Define from what email send the message.', 'yiw'),
        	   'id' => 'contact_form_from_email_' . $yiw_form_choosen,
        	   'type' => 'text',
        	   'std' => get_option( 'admin_email' ) ),
        	
        array( 'name' => __('From Name', 'yiw'),
        	   'desc' => __('Define the name of email that send the message.', 'yiw'),
        	   'id' => 'contact_form_from_name_' . $yiw_form_choosen,
        	   'type' => 'text',
        	   'std' => 'Admin ' . get_bloginfo( 'name' ) ),
        	
        array( 'name' => __('Subject', 'yiw'),
        	   'desc' => __('Define the subject of the email sent to you.', 'yiw'),
        	   'id' => 'contact_form_subject_' . $yiw_form_choosen,
        	   'type' => 'text',
        	   'std' => '' ),                
        	
        array( 'name' => __('Body', 'yiw'),
        	   'desc' => __('Configure the body email that arrives to you. You can add some shortcode, to add some value insert by user on frontend module. The shortcodes are composed with "data_name" that you have insert on each field, on below table, like: %data_name%.<br /><em>HTML is allowed.</em>', 'yiw'),
        	   'id' => 'contact_form_body_' . $yiw_form_choosen,
        	   'type' => 'textarea',
        	   'std' => __( '%message%
               
<small><i>This email is been sent by %name% (email. %email%).</i></small>', 'yiw' ) ),  
        	
        array( 'name' => __('Label Submit Button', 'yiw'),
        	   'desc' => __('Define the label of submit button.', 'yiw'),
        	   'id' => 'contact_form_submit_label_' . $yiw_form_choosen,
        	   'type' => 'text',
        	   'std' => __( 'send message', 'yiw' ) ),            
        	
        array( 'name' => __('Alignment Submit Button', 'yiw'),
        	   'desc' => __('Set the alignment of submit button.', 'yiw'),
        	   'id' => 'contact_form_submit_alignment_' . $yiw_form_choosen,
        	   'type' => 'select',
        	   'options' => array(
			   		'alignleft' => 'left',
			   		'alignright' => 'right',
			   		'aligncenter' => 'center',
			   ),
        	   'std' => 'alignright' ),       
        	
        array( 'name' => __('Message Success', 'yiw'),
        	   'desc' => __('Define the message for success sending.', 'yiw'),
        	   'id' => 'contact_form_success_sending_' . $yiw_form_choosen,
        	   'type' => 'text',
        	   'std' => __( 'Email sent correctly!', 'yiw' ) ),   
        	
        array( 'name' => __('Message Error', 'yiw'),
        	   'desc' => __('Define the message when there is an error on send of email.', 'yiw'),
        	   'id' => 'contact_form_error_sending_' . $yiw_form_choosen,
        	   'type' => 'text',
        	   'std' => __( 'An error has been encountered. Please try again.', 'yiw' ) ),
        array( 'name' => __( 'Enable reCaptcha', 'yiw' ),
               'desc' => __( 'Enable reCaptcha system', 'yiw' ),
               'id' => 'enable_captcha_' . $yiw_form_choosen,
               'type' => 'on-off',
               'std' => 0 ),

        array( 'name' => __( 'reCaptcha public API Key', 'yiw' ),
               'desc' => __( 'Insert the public api key of reCaptcha', 'yiw' ),
               'id' => 'captcha_public_key_' . $yiw_form_choosen,
               'type' => 'text',
               'std' => '',
               'deps' => array(
                   'id' => 'enable_captcha_' . $yiw_form_choosen,
                   'value' => 1
               )),

        array( 'name' => __( 'reCaptcha private API Key', 'yiw' ),
               'desc' => __( 'Insert the private api key of reCaptcha', 'yiw' ),
               'id' => 'captcha_private_key_' . $yiw_form_choosen,
               'type' => 'text',
               'std' => '',
               'deps' => array(
                   'id' => 'enable_captcha_' . $yiw_form_choosen,
                   'value' => 1
               )),
        	
        array( 'type' => 'close')
    ),
	        
    'table-contact' => array(    
        array( 'name' => __('Customize Contact module', 'yiw') . ': ' . $yiw_form_choosen,
        	   'type' => 'section',
			   'effect' => 0,
			   'show-submit' => false),
			   
        array( 'type' => 'open'),  
         
        array( 'id' => 'contact_fields_' . $yiw_form_choosen,
        	   'type' => 'contact-table',
			   'data' => 'array',
			   'mode' => 'merge'),	
        	
        array( 'type' => 'close')
    )        
    /* =================== END SIDEBARS =================== */
 
);                         

if( $yiw_form_choosen == '' OR $yiw_form_choosen == 'none' )
	unset( $yiw_options['contact']['configuration'], $yiw_options['contact']['table-contact'] );  
?>