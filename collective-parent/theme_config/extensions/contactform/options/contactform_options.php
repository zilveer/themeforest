<?php
$cfg['input_types']=array(
                        array(
                            'name'=>__('Text Input','tfuse'),
                            'type'=>'text',
                            'value'=>'',
                            'id'=>TF_THEME_PREFIX.'_%%name%%',
                            'options'=>false
                            ),
                        array(
                            'name'=>__('Text area','tfuse'),
                            'type'=>'textarea',
                            'value'=>'',
                            'id'=>TF_THEME_PREFIX.'_%%name%%',
                            'options'=>false
                             ),

                        array(
                             'name'=>__('Radiobox','tfuse'),
                             'type'=>'radio',
                             'value'=>'',
                             'id'=>TF_THEME_PREFIX."_%%name%%",
                             'options'=>true
                             ),
                        array(
                             'name'=>__('Checkbox','tfuse'),
                             'type'=>'checkbox',
                             'value'=>'',
                             'id'=>TF_THEME_PREFIX."_%%name%%",
                             'options'=>false
                             ),
                         array(
                             'name'=>__('SelectBox','tfuse'),
                             'type'=>'select',
                             'value'=>'',
                             'id'=>TF_THEME_PREFIX."_%%name%%",
                             'options'=>true,
                             'properties'=>array(
                                 'class'=>'select_styled'
                             )
                              ),
                         array(
                             'name'=>__('Email','tfuse'),
                             'type'=>'text',
                             'value'=>'',
                             'id'=>TF_THEME_PREFIX."_%%name%%",
                             'options'=>false
                             ),
                         array(
                              'name'=>__('Captcha','tfuse'),
                              'type'=>'captcha',
                              'value'=>'',
                              'id'=>TF_THEME_PREFIX."_captcha",
                              'options'=>false,
                              'file_name'=>'captcha_gen.php'
                              )
                        );
$options_name=array();
foreach($cfg['input_types'] as $value){
    $options_name[]=$value['name'];
}
$form_name =
$options=array(
              'tabs'=>array(
                        array(
                            'name' => __('Add/Edit Forms','tfuse'),
                                        'id' => 'add_edit_forms', #do no t change this ID
                                        'headings' => array (
                                            array(
                                                'name' => __('Form Settings','tfuse'),
                                                'id'=>'form_name',
                                                'options' =>array(
                                                    array('name' => __('Form shortcode','tfuse'),
                                                          'desc' => __('Copy this shortcode to add the form into the page/post','tfuse'),
                                                          'id' => 'tf_cf_shortcode',
                                                          'value'=>'[tfuse_contactform tf_cf_formid="%%form_id%%"]',
                                                          'type'=>'selectable_code',

                                                    ),
                                                    array('name' => __('Form name','tfuse'),
                                                        'desc' => __('The form name will not be displayed to the users. It is for internal use only','tfuse'),
                                                        'type' => 'text',
                                                        'id' => 'tf_cf_formname_input',
                                                        'value' => ''),
                                                    array('name' => __('Email to','tfuse'),
                                                          'desc' => __('The form will be sent to this email address. We recommend you to use an email that you verify often','tfuse'),
                                                          'id' => 'tf_cf_email_to',
                                                          'value'=>get_bloginfo('admin_email'),
                                                          'type'=>'text'),
                                                    array('name' => __('Email subject','tfuse'),
                                                          'desc' => __('This text will appear in the Subject line when you receive an email from this form. Make it short and original for easy identification','tfuse'),
                                                          'id' => 'tf_cf_email_subject',
                                                          'value'=>'',
                                                          'type'=>'text'),
                                                )
                                            ),
                                            array(
                                                'name' => __('Form Content','tfuse'),
                                                'id'=>'form_settings',
                                                'options' => array(
                                                    array('name' => __('Input type','tfuse'),
                                                        'desc' => __('Input type','tfuse'),
                                                        'id' => 'tf_cf_select[]',
                                                        'value'=>0,
                                                        'type'=>'select',
                                                        'properties'=>array(
                                                        'class'=>'medica_inp_select'
                                                         ),
                                                        'options'=>$options_name),
                                                    array('name' => __('Label','tfuse'),
                                                        'desc' => __('Input label','tfuse'),
                                                        'id' => 'tf_cf_input[]',
                                                        'value' => '',
                                                        'properties'=>array(
                                                              'class'=>'cf_input_label'
                                                             ),
                                                        'type' => 'text'),
                                                    array('name'=>__('Width','tfuse'),
                                                          'desc'=>__('fields width','tfuse'),
                                                          'type'=>'text',
                                                          'id'=>'tf_cf_input_width[]',
                                                          'value'=>'50',
                                                          'properties'=>array(
                                                              'class'=>'cf_input_width'
                                                          ),
                                                          'divider'=>true),
                                                    array('name'=>__('Required','tfuse'),
                                                        'desc'=>__('is this field required?','tfuse'),
                                                        'type'=>'checkbox',
                                                        'id'=>'tf_cf_input_required',
                                                        'value'=>'none',
                                                        'properties'=>array(
                                                            'class'=>'cf_input_required'
                                                        ),
                                                        'divider'=>true
                                                         ),
                                                    array('name'=>__('New Line','tfuse'),
                                                        'desc'=>__('show this field in new line','tfuse'),
                                                        'type'=>'checkbox',
                                                        'id'=>'tf_cf_input_newline',
                                                        'value'=>'none',
                                                        'properties'=>array(
                                                            'class'=>'cf_input_newline'
                                                        ),
                                                        'divider'=>true
                                                         ),
                                                    array('name'=>'',
                                                         'desc'=>'',
                                                         'id'=>'tf_cf_shortcode_row',
                                                         'type'=>'selectable_code',
                                                         'value'=>'%%code%%',
                                                         'properties'=>array(
                                                            'class'=> 'shortcode_code'
                                                         ),
                                                         'divider'=>true,
                                                         ),
                                                    array('name'=>'',
                                                         'desc'=>'',
                                                         'id'=>'tf_cf_delete_row',
                                                         'type'=>'raw',
                                                         'class'=>'tf_cf_delete_row',
                                                         'value'=>'',
                                                         'html'=>'<img src="'.tf_extimage($this->ext->contactform->_the_class_name, 'delete.png').'" rel="is_default+default_is_default" class="contactform_delete_input" style="display: none;">',
                                                         'divider'=>true,
                                                         ),
                                                    array('name'=>'',
                                                         'desc'=>'',
                                                         'id'=>'tf_cf_toggle_show',
                                                         'type'=>'raw',
                                                         'class'=>'tf_cf_toggle_show',
                                                         'value'=>'',
                                                         'html'=>'<span class="show_more_less">-Show less</span>',
                                                         'divider'=>true,
                                                         ),
                                                 'type'=>'custom_contactform_row'
                                                ),
                                            'options_row'=>array(
                                                array(
                                                    'name'=>__('Option','tfuse'),
                                                    'desc'=>'',
                                                    'id'=>'tf_cf_input_options_label',
                                                    'type'=>'text',
                                                    'value'=>'%%value%%',
                                                    'properties'=>array(
                                                                'class'=>'tf_cf_input_options_label'
                                                        ),
                                                )
                                            )
                                            ),

                                        ),
                            'buttons'=>array(
                                array(
                                    'type'=>'button',
                                    'id'=>'cf_save_form_button',
                                    'value'=>__('Save Form','tfuse'),
                                    'name'=>'save_form',
                                    'subtype'=>'submit',
                                    'properties'=>array(
                                        'class'=>'button'
                                    )
                                ),
                                array(
                                    'type'=>'button',
                                    'value'=>__('Cancel','tfuse'),
                                    'id'=>'new_form_reset',
                                    'subtype'=>'button',
                                    'name'=>'cf_reset',
                                    'properties'=>array(
                                        'class'=>'reset-button button'
                                    )
                                )
                            )
                        ),
                  array(//Messages settings tab
                      'name'=>__('Messages Settings','tfuse'),
                      'id'=>'tf_cf_messages_settings',
                      'headings'=>array(
                                array(
                                       'name' => __('Messages settings','tfuse'),
                                       'id'=>'message_settings',
                                       'options' => array(
                                           array('name' => __('Form header text','tfuse'),
                                               'desc' => __('The text that appears on the top of the form ','tfuse'),
                                               'id' => 'tf_cf_heading_text',
                                               'value' => 'Please fill in the form below',
                                               'type' => 'text'
                                           ),
                                           array('name' => __('Submit button text','tfuse'),
                                                  'desc' => __('The text that appears on the submit form button ','tfuse'),
                                                  'id' => 'tf_cf_mess_submit',
                                                  'value' => 'Send message',
                                                  'type' => 'text'
                                           ),
                                           array('name' => __('Reset button text','tfuse'),
                                               'desc' => __('The text that appears on the reset form button ','tfuse'),
                                               'id' => 'tf_cf_mess_reset',
                                               'value' => 'reset all fields',
                                               'type' => 'text'
                                           ),
                                           array('name' => __('Success message','tfuse'),
                                                 'desc' => __('This message will be displayed if the form is successfully submitted','tfuse'),
                                                 'id' => 'tf_cf_succ_mess',
                                                 'value'=>'Message sent.We`ll get back to you asap',
                                                 'type'=>'text'),
                                           array('name' => __('Failure message','tfuse'),
                                                 'desc' => __('This message will be displayed if the form failed to be submitted','tfuse'),
                                                 'id' => 'tf_cf_failure_mess',
                                                 'value'=>'Oops something went wrong.Please try again later',
                                                 'type'=>'text'),
                                           array('name' => __('Email from','tfuse'),
                                                 'desc' => __('The form will look like was sent from this address.','tfuse'),
                                                 'id' => 'tf_cf_email_from',
                                                 'value'=>get_bloginfo('admin_email'),
                                                 'type'=>'text'),
                                           array('name' => __('Email template','tfuse'),
                                                 'desc' => __('You can use this to create a nice template for the email you receive. It supports HTML and in order to display one of your form input values you need to copy/paste their shortcode in here.','tfuse'),
                                                 'id' => 'tf_cf_email_template',
                                                 'value'=>'',
                                                 'type'=>'textarea'),
                                           array('name' => __('Form template','tfuse'),
                                                 'desc' => __('This will help you change the structure of your form, control CSS on a specific input and/or add different HTML code above, in between or below your inputs. ','tfuse'),
                                                 'id' => 'tf_cf_form_template',
                                                 'value'=>'<span>[label]</span>
<span>[input]</span>',
                                                 'type'=>'textarea'),
                                           array('name' => __('Required text','tfuse'),
                                                  'desc' => __('This text apears near the inputs that are mandatory to be completed by the user ','tfuse'),
                                                  'id' => 'tf_cf_required_text',
                                                  'value' => '(required)',
                                                  'type' => 'text'
                                           ),





                                         ),
                          ),

                                   ),
                      'buttons'=>array(
                                   array(
                                        'type'=>'button',
                                        'id'=>'cf_save_messages_button',
                                        'value'=>__('Save Messages','tfuse'),
                                        'name'=>'save_messages',
                                        'subtype'=>'submit',
                                        'properties'=>array(
                                                     'class'=>'button'
                                                          )
                                        ),
                                   array(
                                        'type'=>'button',
                                        'value'=>__('Cancel','tfuse'),
                                        'id'=>'messages_reset',
                                        'subtype'=>'button',
                                        'name'=>'cf_reset',
                                        'properties'=>array(
                                        'class'=>'reset-button button'
                                         )
                                     )
                                )
                  ///end of tab
                  ),
                  array(//General settings tab
                      'name'=>"General settings",
                      'id'=>'tf_cf_general_settings',
                      'headings'=>array(
                          array(
                          'id'=>'cf_general_settings',
                          'name'=>__('Email sending options','tfuse'),
                          'options'=>array(//Form fields
                              array(
                                  'name'=>__('Email sending option','tfuse'),
                                  'type'=>'radio',
                                  'id'=>'tf_cf_mail_type',
                                  'value'=>'wpmail',
                                  'options'=>array(
                                    'wpmail'=>'wp-mail',
                                    'smtp'=>'smtp',
                                     ),
                                  'divider'=>true
                              ),
                              array(
                                   'name'=>__('Secure connection','tfuse'),
                                   'type'=>'radio',
                                   'id'=>'tf_cf_secure_conn',
                                   'value'=>'no',
                                   'options'=>array(
                                   'no'=>'No',
                                   'ssl'=>'SSL',
                                   'tls'=>'TLS',
                                   ),
                                   'divider'=>true
                                    ),
                              array('name' => __('SMTP server address','tfuse'),
                                    'desc' => __('SMTP server address','tfuse'),
                                    'id' => 'tf_cf_smtp_host',
                                    'value'=>'',
                                    'type'=>'text'),
                              array('name' => __('Port','tfuse'),
                              'desc' => __('SMTP server port','tfuse'),
                              'id' => 'tf_cf_smtp_port',
                              'value'=>'25',
                              'type'=>'text'),
                              array('name' => __('Username','tfuse'),
                              'desc' => __('Leave blank if authentication not needed','tfuse'),
                              'id' => 'tf_cf_smtp_user',
                              'value'=>'',
                              'type'=>'text'),
                              array('name' => __('Password','tfuse'),
                               'desc' => __('Leave blank if authentication not needed','tfuse'),
                               'id' => 'tf_cf_smtp_pwd',
                               'value'=>'',
                               'type'=>'text'),
                          )
                      )
                          ),
                      'buttons'=>array(
                          array(
                              'type'=>'button',
                              'value'=>__('Save general options','tfuse'),
                              'id'=>'tf_cf_save_gen_options',
                              'name'=>'save_gen_options',
                              'subtype'=>'submit',
                              'properties'=>array(
                                           'class'=>'button'
                                                )
                          ),
                          array(
                              'type'=>'button',
                              'value'=>__('Reset options','tfuse'),
                              'id'=>'gen_options_reset',
                              'name'=>'reset_gen_options',
                              'subtype'=>'button',
                              'properties'=>array(
                                  'class'=>'reset-button button'
                              )
                          )
                      )
                  ),

              ),
);
?>