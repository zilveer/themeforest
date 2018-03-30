<?php
if (!defined('TFUSE')) exit('Direct access forbidden.');

class TF_RESERVATIONFORM extends TF_TFUSE
{
    public $generalSettingsRow = 'TFUSE_GENOPTIONS_ROW';
    public $_the_class_name = 'RESERVATIONFORM';

    function __construct()
    {
        parent::__construct();
    }

    function __init()
    {
        // Load or not this extension
        if( !$this->load->ext_file_exists($this->_the_class_name, '') )  return;

        require_once(TFUSE_THEME_DIR . '/framework/extensions/' . strtolower($this->_the_class_name) . '/config/constants.php');
        require_once(TFUSE_THEME_DIR . '/framework/extensions/' . strtolower($this->_the_class_name) . '/config/utils.php');
        if ($this->request->isset_GET('page') && $this->request->GET('page') == 'tf_reservation_form' && $this->request->isset_GET('id')) {
            $this->redirect_if_id_invalid($this->request->GET('id'));
        }
        add_action('admin_menu', array($this, 'add_menu'), 20);
        $this->get->ext_config('RESERVATIONFORM', 'base');
        if (is_admin() && $this->request->isset_GET('page') && stripos($this->request->GET('page'), 'tf_reservation') === 0) {
            $this->add_static();
            $this->include->js_enq('tf_reservationform_save', wp_create_nonce('tf_reservationform_save'));
        }
        $this->add_ajax();
        add_action('tf_rf_form_content', array($this, 'tf_rf_forms_setup'));
        add_action('resform_gen_options', array($this, 'resform_general_settings'));
        add_action('tf_reservation', array($this, 'resform_general_settings'));

    }

    function add_ajax()
    {
        $this->ajax->_add_action('tfuse_ajax_reservationform', $this);
    }

    function add_static()
    {
        $this->include->register_type('framework_css', TFUSE . '/static/css');
        $this->include->register_type('selectmenu', get_template_directory() . '/css');
        $this->include->register_type('framework_js', TFUSE . '/static/javascript');
        $this->include->js('popbox.min', 'framework_js');
        $this->include->css('datepicker', 'framework_css', 'tf_head');
        $this->include->register_type('ext_reservationform_css', TFUSE_EXT_DIR . '/' . strtolower($this->_the_class_name) . '/static/css');
        $this->include->register_type('ext_reservationform_js', TFUSE_EXT_DIR . '/' . strtolower($this->_the_class_name) . '/static/js');
        $this->include->css('reservation_form', 'ext_reservationform_css');
        $this->include->js('reservation_form', 'ext_reservationform_js', 'tf_footer', 10, '1.1');
        if(file_exists(TEMPLATEPATH.'/theme_config/extensions/reservationform/options/preview_options.php')){

            $options = $this->get->ext_options($this->_the_class_name, 'preview');
            if(@is_array($options))
                foreach($options as $key=>$option){
                    $this->include->register_type($option['type'].$key,$option['dir'] );
                    $this->include->$option['type']( $option['filename'],$option['type'].$key,'tf_footer',($option['type'] == 'js') ? '20' : '' );
                }


        }
    }

    function add_menu()
    {
        if (function_exists('add_object_page'))
            add_object_page(__('Reservation Forms Settings', 'tfuse'), apply_filters('res_form_top_menu',__('Reservations', 'tfuse')), 'publish_pages', 'tf_reservations_list', array($this, 'list_reservations'));
        else
            add_menu_page(__('Reservation Forms Settings', 'tfuse'), apply_filters('res_form_top_menu',__('Reservations')), 'publish_pages', 'tf_reservations_list', array($this, 'list_reservations'));
        add_submenu_page('tf_reservations_list', apply_filters('res_form_res_list',__('User Reservations', 'tfuse')), apply_filters('res_form_res_list',__('User Reservations', 'tfuse')), 'publish_pages', 'tf_reservations_list', array($this, 'list_reservations'));
        add_submenu_page('tf_reservations_list', apply_filters('res_form_all_forms',__('All Reservation Forms', 'tfuse')), apply_filters('res_form_all_forms',__('All Reservation Forms', 'tfuse')), 'publish_pages', 'tf_reservation_forms_list', array($this, 'list_forms'));
        add_submenu_page('tf_reservations_list', apply_filters('res_form_add_new',__('Add New Form', 'tfuse')), apply_filters('res_form_add_new',__('Add New Form', 'tfuse')), 'publish_pages', 'tf_reservation_form', array($this, 'show_add_form'));
        add_submenu_page('tf_reservations_list', apply_filters('res_form_gen_set',__('General Settings', 'tfuse')), apply_filters('res_form_gen_set',__('General Settings', 'tfuse')), 'publish_pages', 'tf_reservation_forms_gensett', array($this, 'list_gen_options'));

    }

    function list_reservations()
    {
        if($this->request->isset_GET('id')) {
            $this->reservation_details();
            return;
        }
        $forms = get_terms('reservations', array('hide_empty' => 0));
        if($this->request->isset_POST('rsvp_form_select')){
            $form_id = $this->request->POST('rsvp_form_select');
        } elseif($this->request->isset_GET('form_id')) {
            $form_id = $this->request->GET('form_id');
        }
        else{
            $form_id = -1;
        }
        $status = ($this->request->isset_GET('filter')) ? $this->request->GET('filter') : 1;
        $post_statuses = array(1=>'any',2=>'private',3=>'publish',4=>'draft');
        $this->common_html();
        $filter = $post_statuses[$status];
        $posts = array();
        $paged = ($this->request->isset_GET('paged')) ? $this->request->GET('paged') :1;
        if($this->request->isset_GET('s')){
            $post_id = decode_res_id($this->request->GET('s'));
            $posts[] = get_post($post_id);
            $tmp_posts = $posts;
        }
        else
        {
            $args = array(
                'numberposts'   => -1,
                'posts_per_page' => 20,
                'post_type' => 'reservations',
                'paged'=>$paged,
                'post_status' => $filter
            );
            if($form_id != -1) {
                $args['tax_query'] = array(
                    array(
                        'taxonomy'  => 'reservations',
                        'field'     => 'id',
                        'terms'     => array(intval($form_id))
                    )
                );
            }
            $only_for_counting = new WP_Query(array_merge($args, array('posts_per_page'    => -1, 'post_status' => 'any')));
            $tmp_posts = $only_for_counting->posts;
            wp_reset_postdata();
            $query = new WP_Query($args);
            $posts = $query->posts;
            wp_reset_postdata();
        }
        $array_statistic = array(
            'all'       => (isset($only_for_counting->found_posts)) ? $only_for_counting->found_posts : sizeof($tmp_posts),
            'pending'   => 0,
            'approved'  => 0,
            'rejected'  => 0,
        );
        foreach ($tmp_posts as $post) {
            switch($post->post_status)
            {
                case 'private' :
                    $array_statistic['pending'] ++;
                    break;

                case 'publish' :
                    $array_statistic['approved'] ++;
                    break;
                case 'draft' :
                    $array_statistic['rejected'] ++;
                    break;
            }

        }
        if($this->module_tc_view_exists('list_reservations'))
            $this->get_tc_view('list_reservations',array('term_id'  => $form_id, 'posts' => $posts,'forms'=>$forms,'statistic'=>$array_statistic, 'ext_name' => $this->_the_class_name));
        else
            $this->load->ext_view($this->_the_class_name, 'list_reservations', array('term_id'  => $form_id, 'posts' => $posts,'forms'=>$forms,'statistic'=>$array_statistic, 'ext_name' => $this->_the_class_name));

    }
    public function module_tc_view_exists($name_file)
    {
        $child_path =  TFUSE_CHILD_CONFIG.'/extensions/' . strtolower($this->_the_class_name) .  '/views/' .$name_file . '.php';
        $theme_path = TFUSE_CONFIG.'/extensions/' . strtolower($this->_the_class_name) .  '/views/' .$name_file . '.php';
        if(file_exists($child_path))
            return $child_path;
        if (file_exists($theme_path))
            return $theme_path;
        else return FALSE;
    }
    function get_tc_view($__name_file, $__data = NULL, $__return = FALSE){
        $__name_file = strtolower($__name_file);
        $view_path = $this->module_tc_view_exists($__name_file);
        if (!$view_path)
            exit('View not found View -> Theme Config: ' . strtolower($this->_the_class_name) . '/views/' . $__name_file . '.php');
        if ($__data !== NULL && count($__data) > 0)
            foreach ($__data as $__name_var => $_value)
                ${$__name_var} = $_value;
        ob_start();
        require($view_path);
        $buffer = ob_get_clean();
        if ($__return === TRUE)
            return $buffer;
        else
            echo $buffer;
    }
    function add_email_content(){
        $this->common_html();
        $resId = $this->request->GET('id');
        $status = $this->request->GET('status');
        $the_post = get_post($resId);
        $the_post = unserialize($the_post->post_content);
        $the_form = wp_get_post_terms($resId, 'reservations');
        if(count($the_form) == 0){
            $the_form = $the_post['form'];
        } else
            $the_form = unserialize($the_form[0]->description);
        $message = ($status == 1) ? $the_form['confirm_email_template'] : $the_form['reject_email_template'];
        if(trim($message) != ''){
            foreach($the_form['input'] as $input){
                $message = str_replace('['.$input["shortcode"].']',$the_post[TF_THEME_PREFIX.'_'.$input["shortcode"]],$message);
            }
        } else {
            foreach($the_form['input'] as $input){
                $value = (in_array($input['type'],array('date_in','date_out')))?date_i18n(get_option('date_format') ,strtotime($the_post[TF_THEME_PREFIX . '_' . $input['shortcode']])):$the_post[TF_THEME_PREFIX . '_' . $input['shortcode']];
                $message .= '<strong>'. urldecode($input['label']) . ':</strong> '.$value. '<br />';
            }
            $not = ($status == -1)?'rejected':'approved';
            $message .= '<br />Your reservation has been '.$not.'.';
        }
        $options = array(
            'tabs' => array(
                array(
                    'name' => __('Edit email', 'tfuse'),
                    'id' => TF_THEME_PREFIX . 'edit_email',
                    'headings' => array(
                        array(
                            'name' => __('Email Content', 'tfuse'),
                            'id' => 'email_details',
                            'options' => array(
                                array(
                                    'name' => __('Email', 'tfuse'),
                                    'type'=>'textarea',
                                    'desc' => '',
                                    'id' => 'tfuse_rf_email',
                                    'value' => $message,
                                    'properties' =>array(
                                        'rel' => $resId
                                    )
                                )
                            )
                        )
                    )
                )
            )
        );
        foreach($options['tabs'] as $tab){
            $headings = $tab['headings'];
            unset($tab['headings']);
            foreach ($headings as $heading) {
                $options[$tab['id']][$heading['name']] = '';
                foreach($heading['options'] as $option){
                    $options[$tab['id']][$heading['name']] .= $this->interface->meta_box_row_template($option);
                }
            }
        }
        $this->create_form_meta_box($options);
        echo '<a id="tfuse_rf_send_email" class="approve_selected_reservations button">' . __('Send Email', 'tfuse') . '</a>
        <a href="'.get_admin_url().'admin.php?page=tf_reservations_list" class="reject_selected_reservations button reset-button">Cancel</a>';

    }

    function reservation_details()
    {
        $resId = $this->request->GET('id');
        $this->redirect_if_reservation_id_invalid($resId);
        $this->common_html();
        $inputs = $this->get->ext_config('RESERVATIONFORM', 'base');
        $inputs = $inputs['input_types'];
        $post = get_post($resId);
        $the_post = tfuse_unpk($post->post_content);
        $the_form = wp_get_post_terms($resId, 'reservations');
        if(count($the_form) == 0){
            $the_form = $the_post['form'];
        } else
            $the_form = unserialize($the_form[0]->description);
        $post_statuses = array('publish'=>__('Approved', 'tfuse'),'draft'=>'Rejected','private'=>__('Pending', 'tfuse'));
        $options = array(
            'tabs' => array(
                array(
                    'name' => apply_filters('res_details_name',__('Reservation Details', 'tfuse')),
                    'id' => TF_THEME_PREFIX . 'res_details',
                    'headings' => array(
                        array(
                            'name' => __('Details', 'tfuse'),
                            'id' => 'res_details',
                            'options' => array(
                                array(
                                    'name' => __('Status', 'tfuse'),
                                    'type' => 'raw',
                                    'id' =>'',
                                    'html'=>'<div class="rf_post_status_'.$post->post_status.'">'.$post_statuses[$post->post_status].'</div>',
                                    'value'=> '',
                                    'divider'=>true
                                )
                            )
                        )
                    )
                )
            )
        );
        foreach ($the_form['input'] as $key=>$input) {
            if(!isset($the_post[TF_THEME_PREFIX . '_' . $input['shortcode']])) $the_post[TF_THEME_PREFIX . '_' . $input['shortcode']] = '-';
            if($input['type'] == 'res_email')
                $html = '<a  class="res_mailto" href="mailto:'.urldecode($the_post[TF_THEME_PREFIX . '_' . $input['shortcode']]).'">'.urldecode($the_post[TF_THEME_PREFIX . '_' . $input['shortcode']]).'</a>';
            else
                $html = (!in_array($input['type'],array('date_in','date_out')) && $inputs[$input['type']]['name'] == 'Email') ? '<a  class="res_mailto" href="mailto:'.urldecode($the_post[TF_THEME_PREFIX . '_' . $input['shortcode']]).'">'.urldecode($the_post[TF_THEME_PREFIX . '_' . $input['shortcode']]).'</a>':urldecode($the_post[TF_THEME_PREFIX . '_' . $input['shortcode']]);
            $option = array();
            $option['name'] = apply_filters('res_input_name_'.TF_THEME_PREFIX .'_'.$input['shortcode'],__(urldecode($input['label']),'tfuse'));
            $option['desc'] = '';
            $option['id'] = TF_THEME_PREFIX .'_'.$input['shortcode'];
            $option['type'] = 'raw';
            $option['html'] ='<div class="res_det_messages">'.((in_array($input['type'],array('date_in','date_out')))?date_i18n(get_option('date_format') ,strtotime($the_post[TF_THEME_PREFIX . '_' . $input['shortcode']])):urldecode($html) ).'</div>';
            $option['value'] = '';
            end($the_form['input']);
            $k = key($the_form['input']);
            if($k == $key)
                $option['divider'] = true;
            $options['tabs'][0]['headings'][0]['options'][] = $option;
        }
        if(isset($the_post['sent_messages']))
            foreach($the_post['sent_messages'] as $sent_message){
                $option = array();
                $option['name'] = date_i18n(get_option('date_format') ,strtotime($sent_message['date']));
                $option['desc'] = __('Message sent by you to the user that made the reservation', 'tfuse');
                $option['id'] = '';
                $option['type'] = 'raw';
                $option['html'] = '<div class="res_det_messages">'.urldecode($sent_message['message']).'</div>';
                $option['value'] = '';
                $options['tabs'][0]['headings'][0]['options'][] = $option;
            }
        $mess_option = array(
            'name' => __('Message', 'tfuse'),
            'desc' => __('This message will overwrite the message template from form settings', 'tfuse'),
            'id'   => TF_THEME_PREFIX .'_email_message',
            'type' => 'textarea',
            'value' => '',
        );
        $options['tabs'][0]['headings'][0]['options'][] = $mess_option;
        foreach($options['tabs'] as $tab){
            $headings = $tab['headings'];
            unset($tab['headings']);
            foreach ($headings as $heading) {
                $options[$tab['id']][$heading['name']] = '';
                foreach($heading['options'] as $option){
                    $options[$tab['id']][$heading['name']] .= $this->interface->meta_box_row_template($option);
                }
            }
        }
        echo '<div style="clear:both;height:20px;"> </div>';
        $this->create_form_meta_box($options);
        $approve_button = '<a href="#" id="tf_rf_confirm_reservation" class="button">' . __('Approve', 'tfuse') . '</a>';
        $reject_button = ' <a id="tf_rf_reject_reservation" href="#" class="button reset-button">' . __('Reject', 'tfuse') . '</a>';
        $message_button = ' <a id="tf_rf_send_message_reservation" href="#" class="button">' . __('Send message', 'tfuse') . '</a>';
        if(in_array($post->post_status,array('private','draft')))
            echo $approve_button;
        else echo $message_button;
        if(in_array($post->post_status,array('private','publish')))
            echo $reject_button;
        else echo $message_button;

    }

    /**
     * @ajax
     */
    function ajax_send_multiple_emails()
    {
        if (!tf_current_user_can(array('manage_options'), false))
            die(__('Access denied', 'tfuse'));

        $post_ids = $this->request->POST('resid');
        foreach($post_ids as $post_id)
            $this->ajax_send_email($post_id);
        die;
    }

    /**
     * @ajax
     */
    function ajax_send_email($ph_id = -1)
    {
        if (!tf_current_user_can(array('manage_options'), false))
            die(__('Access denied', 'tfuse'));

        $this->ajax->_verify_nonce('tf_reservationform_save');
        $inputs = $this->get->ext_config($this->_the_class_name, 'base');
        $gen_sett = $this->model->get_forms_gen_options();
        $post_id = $this->request->isset_POST('post_id') ? $this->request->POST('post_id') : $ph_id;
        $message = ($this->request->isset_POST('message') && trim($this->request->POST('message')) != '') ? $this->request->POST('message') : '';
        $status = $this->request->POST('status');
        $the_form = wp_get_post_terms($post_id, 'reservations');
        $the_form = unserialize($the_form[0]->description);
        $the_post = get_post($post_id);
        if(($the_post == 'draft' && $status == -1) || ($the_post == 'publish' && $status == 1 )) return;
        $date_format=get_option('date_format');
        $post = unserialize($the_post->post_content);
        $nr=encode_id($post_id);
        if(trim($message) == '' && $status !=0)
            $message = ($status == 1) ? __(urldecode($the_form['confirm_email_template'] ),'tfuse')
                :__(urldecode($the_form['reject_email_template']),'tfuse');
        if(trim($message) != ''){
            foreach($the_form['input'] as $input){
                $value = (in_array($input['type'],array('date_in','date_out')))?date_i18n($date_format ,strtotime($post[TF_THEME_PREFIX . '_' . $input['shortcode']])):$post[TF_THEME_PREFIX . '_' . $input['shortcode']];
                $message = str_replace('['.$input["shortcode"].']',urldecode($value),$message);
            }
            $message = str_replace('[resnumber]',$nr,$message);
        } else {
            foreach($the_form['input'] as $input){
                $value = (in_array($input['type'],array('date_in','date_out')))?date_i18n($date_format ,strtotime($post[TF_THEME_PREFIX . '_' . $input['shortcode']])):$post[TF_THEME_PREFIX . '_' . $input['shortcode']];
                $message .= '<strong>'. urldecode($input['label']) . ':</strong> '.$value. '<br />';
            }
            $not = ($status == -1)?'rejected':'approved';
            $message .= '<br />Your reservation has been '.$not.'.';
        }

        $email = '';
        foreach($the_form['input'] as $input){
            if($input['type']=='res_email'){
                $email =urldecode($post[TF_THEME_PREFIX.'_'.$input['shortcode']]);
                break;
            }
        }
        $mail_type=(isset($gen_sett['mail_type']))?'send'.ucwords($gen_sett['mail_type']):'sendWpmail';
        $the_form['email_subject'] = urlencode(str_replace('[resnumber]',$nr,urldecode($the_form['email_subject'])));
        $from_emails = explode(',',urldecode($the_form['email_from']));
        $the_form['email_from'] = $from_emails[0];
        $response = $this->$mail_type($gen_sett,$message,$email,$the_form);
        $now = date($date_format);
        $m = array(
            'message' => urlencode($message),
            'date' => $now
        );
        $post['sent_messages'][] = $m;
        $the_post->post_content = serialize($post);
        if($response['error'] == false){
            if($status == 1)
                $the_post->post_status = 'publish';
            elseif($status == -1)
                $the_post->post_status = 'draft';
            wp_update_post($the_post);
        }
        echo json_encode($response);if($this->request->isset_POST('post_id'))die;
    }

    /**
     * @ajax
     */
    function delete_reservations()
    {
        if (!tf_current_user_can(array('manage_options'), false))
            die(__('Access denied', 'tfuse'));

        if (is_array($this->request->POST('resid')))
            foreach ($this->request->POST('resid') as $id)
                wp_delete_post($id, true);
        else wp_delete_post($this->request->POST('resid'), true);
    }

    /**
     * @ajax
     */
    function get_excluded_dates()
    {
        $post_term = get_term_by('id', $this->request->POST('tf_form_id'), 'reservations');
        $form = unserialize($post_term->description);
        $exclude_dates = $form['exclude_dates'];
        foreach ($exclude_dates as $key => $val)
            $exclude_dates[$key] = urldecode($val);
        echo json_encode($exclude_dates);
        die;
    }

    function resform_general_settings()
    {
        $this->common_html();
        if ($this->request->isset_POST('save_gen_options')) {
            $this->save_general_options();
        }
        echo '<div style="clear:both;height:20px;">&nbsp;</div>';
        $options = $this->get_form_gen_options();
        $this->create_form_meta_box($options);
    }

    function list_gen_options()
    {
        $this->load->ext_view($this->_the_class_name, 'general_settings', array('ext_name' => $this->_the_class_name));
    }

    function list_forms()
    {
        $this->common_html();
        $forms = get_terms('reservations', array('hide_empty' => 0));
        foreach ($forms as $key => $form) {
            $forms[$key]->description = unserialize($form->description);
        }
        $this->load->ext_view($this->_the_class_name, 'list_forms', array('forms' => $forms, 'ext_name' => $this->_the_class_name));

    }

    function common_html()
    {
        echo '<div id="tfuse_fields" class="wrap metabox-holder">';
        $this->interface->page_header_info();
    }

    function show_add_form()
    {
        $this->common_html();
        $this->load->ext_view($this->_the_class_name, 'form_setup', array('ext_name' => $this->_the_class_name));
    }

    function tf_rf_forms_setup()
    {
        if ($this->request->isset_POST('save_form') || $this->request->isset_POST('save_messages') || $this->request->isset_POST('save_dates')) {
            $this->save_form();
        }
        echo '<div style="clear:both;height:20px;">&nbsp;</div>';
        $options = $this->get_form_options();
        $this->create_form_meta_box($options);
    }

    /**
     * @ajax
     */
    function ajax_datepicker_row(){
        $values = array('label'=>__('Check Out', 'tfuse'),'width'=>'50','newline'=>false);
        echo json_encode(array( 'html'=>$this->interface->cf_row_template($this->date_in_out('date_out',$values,$this->request->POST('number')))));die;
    }

    /**
     * @ajax
     */
    function submitFrontendForm()
    {
        $exclude_from_post = array('submit', 'action', 'tf_action', 'form_id');
        $form_id = $this->request->POST('form_id');
        $inputs = $this->get->ext_config($this->_the_class_name, 'base');
        $gen_sett = $this->model->get_forms_gen_options();
        $form = get_term_by('id', $form_id, 'reservations');
        $form = unserialize($form->description);
        $message = '';
        $title = (trim(urldecode($form['reservation_title'])) != '') ? __(urldecode($form['reservation_title']),'tfuse') : __('New Reservation', 'tfuse');
        $post_content = array();
        foreach ($this->request->POST() as $key => $value) {
            $title = str_replace('[' . tf_option_id_without_prefix($key) . ']', $value, $title);
            if (!in_array($key, $exclude_from_post)) {
                $post_content[$key] = urlencode($value);
            }
        }
        $post = array('post_type' => 'reservations', 'post_title' => $title, 'post_status' => 'private', 'post_content' => serialize($post_content));
        $status = wp_insert_post($post, true);
        if($status){

            $nr=encode_id($status);
            if(isset($form['new_res_email_template']) && trim($form['new_res_email_template']) != '')
            {
                $message = urldecode($form['new_res_email_template']);
                $message = str_replace('[resnumber]',$nr,$message);

                foreach($form['input'] as $input){
                    if($this->request->isset_POST(TF_THEME_PREFIX.'_'.$input["shortcode"]))
                        $message = str_replace('['.$input["shortcode"].']',$this->request->POST(TF_THEME_PREFIX.'_'.$input["shortcode"]),$message);
                    else
                        $message = str_replace('['.$input["shortcode"].']','-',$message);
                }

            }
            else {
                foreach($form['input'] as $input){
                    $value = (in_array($input['type'],array('date_in','date_out')))?date_i18n(get_option('date_format') ,strtotime($this->request->POST(TF_THEME_PREFIX . '_' . $input['shortcode']))):$this->request->POST(TF_THEME_PREFIX . '_' . $input['shortcode']);
                    $message .= '<strong>'. urldecode($input['label']) . ':</strong> '.$value. '<br />';
                }

                $message .= '<strong>' . __('Registration number:', 'tfuse') . '</strong>' . $nr. '<br />';
            }
            $email = '';
            foreach($form['input'] as $input){
                if($input['type'] == 'res_email'){
                    $email = $this->request->POST(TF_THEME_PREFIX.'_'.$input['shortcode']);
                    break;
                }
            }
            $t_email =  urldecode($form['email_from']);
            if(strpos($t_email,',') !== FALSE)
            $form['email_from'] = substr($t_email,0,strpos($t_email,','));
            $form['email_subject'] = urlencode(str_replace('[resnumber]',$nr,urldecode($form['email_subject'])));
            $mail_type=($gen_sett['mail_type'])?'send'.ucwords($gen_sett['mail_type']):'sendWpmail';
            $this->$mail_type($gen_sett,$message,$email,$form);
            $form['email_subject'] = __('New Reservation', 'tfuse');

	        //For hortings that do not allow to use external email addresses in the email headers
	        if( !apply_filters('enable_static_email_from', false) )
		        $form['email_from'] = $email;
            $email = $t_email;
            $this->$mail_type($gen_sett,$this->new_reservation_admin_email_content($form,$post_content,$status),$email,$form);
            wp_set_post_terms($status,$form_id, 'reservations', false);
            echo json_encode(array('mess'=>__(urldecode($form['succes_mess']),'tfuse'),'error' => false));
        } else echo json_encode(array('mess'=>__(urldecode($form['fail_mess']),'tfuse'),'error' => true));
        die;
    }
    function new_reservation_admin_email_content($form,$post_content,$nr){
        $content =__('There is a new reservation on ', 'tfuse').get_bloginfo('name');
        if(isset($form['admin_email_template']) && $form['admin_email_template'] != '')
        {
            $content = urldecode($form['admin_email_template']);
            $content = str_replace('[resnumber]',encode_id($nr),$content);
            foreach($post_content as $key=>$value){
                $content = str_replace('['.tf_option_id_without_prefix($key).']',$value,$content);
            }
        }
        else
            foreach($form['input'] as $input){
                if(isset($post_content[TF_THEME_PREFIX.'_'.$input["shortcode"]]))
                    $content .= '<strong>' . __($input['label'],'tfuse') . ':</strong> '. $post_content[TF_THEME_PREFIX.'_'.$input["shortcode"]] . '<br />';
            }
        return urldecode($content);
    }

    /**
     * @ajax
     */
    function delete_form()
    {
        if (!tf_current_user_can(array('manage_options'), false))
            die(__('Access denied', 'tfuse'));

        $form_IDs = (array)$this->request->POST('formid');
        $this->delete_form_terms($form_IDs);
        if(!is_array($form_IDs) || !sizeof($form_IDs)) die();
        foreach($form_IDs as $id)
        {
            wp_delete_term($id, 'reservations');
        }
        die();
    }
    function delete_form_terms($form_ids)
    {
        global $wpdb;
        $where_sql = "$wpdb->terms.term_id = " . $form_ids[0];
        unset($form_ids[0]);
        foreach($form_ids as $id)
        {
            $where_sql .= " or $wpdb->terms.term_id = " . $id;
        }
        $select_query = "SELECT $wpdb->posts.ID FROM $wpdb->posts LEFT JOIN $wpdb->term_relationships ON $wpdb->posts.ID = $wpdb->term_relationships.object_id INNER JOIN $wpdb->terms ON $wpdb->terms.term_id = $wpdb->term_relationships.term_taxonomy_id WHERE " . $where_sql;
        $term_posts = $wpdb->get_results($select_query);
        $where_sql = "";
        foreach($term_posts as $post)
        {
            $where_sql .= $post->ID . ',';
        }
        if($where_sql)
        {
            $where_sql = substr_replace($where_sql ,"",-1);
            $delete_query = "DELETE FROM $wpdb->posts WHERE ID in(" . $where_sql . ")";
            $wpdb->query($delete_query);
        }
    }

    /**
     * @ajax
     */
    function save_form()
    {
        if (!tf_current_user_can(array('manage_options'), false))
            die(__('Access denied', 'tfuse'));

        if($this->input->is_ajax_request()){
            $this->ajax->_verify_nonce('tf_reservationform_save');
            $form_data = $this->request->POST('post_data');
            $form = array();
            $form_data = html_entity_decode($form_data);
            parse_str($form_data,$form);
            $form = stripslashes_deep($form);
        }
        else {
            if (!wp_verify_nonce($this->request->POST('resform_setup_nonce'), 'resform_setup_nonce_action')) {
                echo __("Your nonce did not pass verification", 'tfuse');
                return;
            }
            $form = $this->request->POST();
        }
        $form_to_save = array();
        $form_to_save['form_name'] = urlencode($form['tf_rf_formname_input']);
        foreach ($form['tf_rf_input'] as $key => $value) {
            $form_to_save['input'][$key]['label'] = urlencode($value);
        }

        foreach ($form['tf_rf_input_options_label'] as $key => $value) {
            if ($form['tf_rf_select'][$key] == 'radio' || $form['tf_rf_select'][$key] == 'select' || $form['tf_rf_select'][$key] == 'multicheckbox') {
                if(is_array($value) && !empty($value))
                    foreach($value as $k=>$v)
                $value[$k] = urlencode($v);
                $form_to_save['input'][$key]['options'] = $value;
            }
        }
        foreach ($form['tf_rf_input_shortcode'] as $key => $value) {
            $form_to_save['input'][$key]['shortcode'] = urlencode($value);
        }

        foreach ($form['tf_rf_select'] as $key => $value) {
            $form_to_save['input'][$key]['type'] = $value;
            if (@tfuse_parse_boolean($form['tf_rf_input_newline_' . $key])) {
                $form_to_save['input'][$key]['newline'] = 1;
            }
            if (@tfuse_parse_boolean(@$form['tf_rf_column_' . $key])) {
                $form_to_save['input'][$key]['column'] = 1;
            }
            if (@tfuse_parse_boolean($form['tf_rf_input_required_' . $key])) {
                $form_to_save['input'][$key]['required'] = 1;
            }

        }
        if(isset($form['tf_rf_column']))
            foreach($form['tf_rf_column'] as $key=>$value)
                $form_to_save['input'][$key]['column'] = $value;
        
        if(@$form['tf_rf_exclude_date'])
            foreach ($form['tf_rf_exclude_date'] as $value) {
                $form_to_save['exclude_dates'][] = urlencode($value);
            }
        foreach ($form['tf_rf_input_width'] as $key => $value) {
            $form_to_save['input'][$key]['width'] = urlencode($value);
        }
        $form_to_save['submit_mess']                = (trim($form['tf_rf_mess_submit']) == '') ? 'Submit' : urlencode(@$form['tf_rf_mess_submit']);
        $form_to_save['succes_mess']                = urlencode($form['tf_rf_succ_mess']);
        $form_to_save['fail_mess']                  = urlencode($form['tf_rf_failure_mess']);
        $form_to_save['tf_rf_form_notice']          = urlencode(@$form['tf_rf_form_notice']);
        $form_to_save['confirm_email_template']     = urlencode($form['tf_rf_confirm_email_template']);
        $form_to_save['reject_email_template']      = urlencode($form['tf_rf_reject_email_template']);
        $form_to_save['header_message']             = urlencode($form['tf_rf_heading_text']);
        if(!empty($form['tf_rf_email_from'])) {
            $form_to_save['email_from']             = urlencode($form['tf_rf_email_from']);
        }
        else {
            $form_to_save['email_from']             = get_option('admin_email');
        }
        if(isset($form['tf_rf_mess_reset']))
            $form_to_save['reset_button']           = urlencode($form['tf_rf_mess_reset']);
        if(isset($form['tf_rf_new_res_admin_email_template']))
            $form_to_save['admin_email_template']   = urlencode($form['tf_rf_new_res_admin_email_template']);
        $form_to_save['new_res_email_template']     = urlencode($form['tf_rf_new_res_email_template']);
        $form_to_save['reservation_title']          = urlencode($form['tf_rf_res_title']);
        $form_to_save['position']                   = urlencode(@$form['tf_rf_position']);
        $form_to_save['datepickers_count']          = urlencode(@$form['tf_rf_datepickers_count']);
        $form_to_save['form_template']              = urlencode($form['tf_rf_form_template']);
        $form_to_save['email_subject']              = urlencode($form['tf_rf_email_subject']);
        $form_to_save['required_text']              = urlencode($form['tf_rf_required_text']);
        if($this->input->is_ajax_request()) {
            $form_id = $this->request->POST('get_id');
            wp_update_term( $form_id, 'reservations', array( 'name'  => $form_to_save['form_name'], 'description' => serialize($form_to_save) ) );
            echo json_encode(array('saved' => 1));
            die();
        } else {
            $new_term = wp_insert_term($this->request->POST('tf_rf_formname_input'), 'reservations', array('description' => serialize($form_to_save)));
            $pageURL = 'http';
            if (!empty($_SERVER['HTTPS'])) {
                if ($_SERVER['HTTPS'] == 'on')
                    $pageURL .= "s";
            }

            $pageURL .= "://";
            $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"] . "&id=" . $new_term['term_id'];
            header('Location:' . $pageURL);
        }

    }

    function prepare_ajax_data($form_data)
    {
        $form_to_save = array();
        foreach ($form_data['tf_rf_select'] as $key => $type) {
            $form_to_save['input'][$key]['type'] = $type;
            if (@tfuse_parse_boolean($form_data['tf_rf_input_newline_' . $key])) {
                $form_to_save['input'][$key]['newline'] = 1;
            }
            if (@tfuse_parse_boolean($form_data['tf_rf_input_required_' . $key])) {
                $form_to_save['input'][$key]['required'] = 1;
            }
            if (@tfuse_parse_boolean($form_data['tf_rf_column_' . $key])) {
                $form_to_save['input'][$key]['column'] = 1;
            }
        }
        unset($form_data['tf_rf_select']);
        foreach ($form_data['tf_rf_input_shortcode'] as $key => $shortcode) {
            $form_to_save['input'][$key]['shortcode'] = $shortcode;

        }
        unset($form_data['tf_rf_input_shortcode']);
        foreach ($form_data['tf_rf_input'] as $key => $label) {
            $form_to_save['input'][$key]['label'] = urlencode($label);
        }
        unset($form_data['tf_rf_input']);
        foreach ($form_data['tf_rf_input_width'] as $key => $width) {
            $form_to_save['input'][$key]['width'] = $width;
        }
        unset($form_data['tf_rf_input_width']);

        if(isset($form_data['tf_rf_exclude_date'] )){
        foreach ($form_data['tf_rf_exclude_date'] as $key => $exclude_date) {
            $form_to_save['exclude_dates'][$key] = $exclude_date;
        }
        unset($form_data['tf_rf_exclude_date']);
        }
        if (isset($form_data['tf_rf_input_options_label'])) {
            foreach ($form_data['tf_rf_input_options_label'] as $key => $options) {
                $form_to_save['input'][$key]['options'] = $options;
            }
            unset($form_data['tf_rf_input_options_label']);
        }
        $form_to_save['header_message']=urlencode($form_data['tf_rf_heading_text']);
        $form_to_save['reset_button']=urlencode($form_data['tf_rf_mess_reset']);
        $form_to_save['submit_mess']=urlencode($form_data['tf_rf_mess_submit']);
        $form_to_save['tf_rf_form_notice']=@urlencode($form_data['tf_rf_form_notice']);
        $form_to_save['position']=@urlencode($form_data['tf_rf_position']);
        return $form_to_save;
    }

    /**
     * @ajax
     */
    function form_preview()
    {
        if (!tf_current_user_can(array('publish_pages'), false))
            die(__('Access denied', 'tfuse'));

        require_once(TFUSE_CONFIG_SHORTCODES . '/shortcodes/reservationform.php');
        $form_data = $this->request->POST('tf_form_');
        $_form = array();
        parse_str(urldecode($form_data),$_form);
        $_formArray = $this->prepare_ajax_data($_form);
            $form_data = $this->request->POST('tf_form_');
            $_form = array();
            parse_str(urldecode($form_data),$_form);
        $_formArray = $this->prepare_ajax_data($_form);
        $_COOKIE['res_form_array'] = serialize($_formArray);
       // $this->request->COOKIE('res_form_array', serialize($_formArray));
        echo do_shortcode('[tfuse_reservationform]');
        die();
    }

    function save_general_options()
    {
        if (wp_verify_nonce($this->request->POST('res_form_gensett_nonce'), 'res_form_gensett_nonce_action')) {
            $gen_options = array('mail_type' => $this->request->POST('tf_rf_mail_type'), 'smtp_host' => $this->request->POST('tf_rf_smtp_host'), 'smtp_user' => $this->request->POST('tf_rf_smtp_user'), 'smtp_pwd' => $this->request->POST('tf_rf_smtp_pwd'), 'smtp_port' => $this->request->POST('tf_rf_smtp_port'), 'secure_conn' => $this->request->POST('tf_rf_secure_conn'));
            $this->model->save_form_gen_options($gen_options);
        } else {
            echo __("Your nonce did not pass verification", 'tfuse');
        }
    }

    function sendSmtp($general_options,$message,$email,$form)
    {
        require_once ABSPATH.WPINC . '/class-phpmailer.php';
        $from = str_replace(array('[',']'),'',urldecode($form['email_from']));
        if($this->request->isset_POST(TF_THEME_PREFIX.'_'.$from) && filter_var($this->request->POST(TF_THEME_PREFIX.'_'.$from),FILTER_VALIDATE_EMAIL))
            $form['email_from'] = $this->request->POST(TF_THEME_PREFIX.'_'.$from);
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->IsHTML(true);
        $mail->Port = $general_options['smtp_port'];
        $mail->Host = $general_options['smtp_host'];
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = ($general_options['secure_conn'] != 'no') ? $general_options['secure_conn'] : null;
        $mail->Username = $general_options['smtp_user'];
        $mail->Password = $general_options['smtp_pwd'];
        $mail->From = urldecode($form['email_from']);
        $mail->FromName = urldecode($form['email_from']);
        $mail->Subject = urldecode($form['email_subject']);
        $emails = explode(',',$email);
        foreach((array)$emails as $e_mail)
            $mail->AddAddress($e_mail);
        $mail->AddAddress($email);
        $mail->CharSet="UTF-8";
        $mail->Body = $message;
        if (!$mail->send()) {
            return array('mail'=>$email,'error' => true);
        } else {
            return array('mail'=>$email,'error' => false);
        }
        $mail->ClearAddresses();
        $mail->ClearAllRecipients();

    }

    function sendWpmail($general_options,$message,$email,$form)
    {
        $from = str_replace(array('[',']'),'',urldecode($form['email_from']));
        if($this->request->isset_POST(TF_THEME_PREFIX.'_'.$from) && filter_var($this->request->POST(TF_THEME_PREFIX.'_'.$from),FILTER_VALIDATE_EMAIL))
            $form['email_from'] = $this->request->POST(TF_THEME_PREFIX.'_'.$from);
        $headers = "From:" .urldecode($form['email_from']) . "><" . urldecode($form['email_from']) . ">";
        add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
        if (wp_mail($email, urldecode($form['email_subject']), $message, $headers))
            return array('mail'=>$email, 'error' => false);
        else
            return array('mail'=>$email, 'error' => true);
    }

    function custom_admin_box_content($post, $args)
    {
        echo apply_filters("{$args['id']}_custom_admin_box_content", $args['args'], $post, $args);

    }

    function create_form_meta_box($options, $accepted_tab_ids = array())
    {
        $admin_meta_boxes = &$options;
        $tabs_header = '<ul>';
        foreach ($admin_meta_boxes['tabs'] as $tab) {
            if (count($accepted_tab_ids) > 0 && !in_array($tab['id'], $accepted_tab_ids)) continue;
            $tabs_header .= '<li id="tfusetabheader-' . $tab['id'] . '"><a href="#tfusetab-' . $tab['id'] . '">' . $tab['name'] . '</a></li>';
        }
        $tabs_header .= '</ul>';

        foreach ($admin_meta_boxes as $tab => $box) {
            if ($tab == 'tabs') continue;
            foreach ($box as $heading => $rows) {
                if ($heading == "buttons") continue;
                $boxid = sanitize_title($heading);
                add_meta_box($boxid, $heading, array($this, 'custom_admin_box_content'), $tab, 'normal', 'core', $rows);
            }
        }
        echo '<div class="tf_meta_tabs">';
        echo $tabs_header;
        foreach ($admin_meta_boxes['tabs'] as $tab) {
            if (count($accepted_tab_ids) > 0 && !in_array($tab['id'], $accepted_tab_ids)) continue;
            echo '<div id="tfusetab-' . $tab['id'] . '">';
            do_meta_boxes($tab['id'], 'normal', null);
            if (isset($admin_meta_boxes[$tab['id']]['buttons']))
                echo $admin_meta_boxes[$tab['id']]['buttons'];
            echo '</div>';
        }
        echo'</div>';
    }
    function urldecode_array(&$value,$key){
        $value = urldecode($value);
    }
    function get_form_options()
    {
        $id = ($this->request->isset_GET('id')) ? $this->request->GET('id') : false;
        $form = get_term_by('id', $id, 'reservations');
        if ($id) {
            $form->description = unserialize($form->description);
        }
        $admin_meta_boxes = array();
        $add_button = array('name' => '', 'desc' => '', 'id' => 'tf_rf_add_new', 'value' => __('Add new field', 'tfuse'), 'type' => 'button', 'subtype' => 'button', 'properties' => array('class' => 'button rf_add_new'));
        $prev_button = array('name' => '', 'desc' => '', 'id' => 'tf_rf_prev_button', 'value' => __('Preview', 'tfuse'), 'type' => 'button', 'subtype' => 'button', 'properties' => array('class' => 'reset-button rf_form_preview button'));
        $options = $this->get->ext_options($this->_the_class_name, strtolower($this->_the_class_name));
        $options = apply_filters('res_form_options_array',$options);
        foreach ($options['tabs'] as $tab) {
            if ($tab['id'] == 'tf_rf_general_settings') continue;
            $admin_meta_boxes['tabs'][] = $tab;
            $headings = $tab['headings'];
            unset($tab['headings']);
            foreach ($headings as $heading) {
                $admin_meta_boxes[$tab['id']][$heading['name']] = '';
                if ($heading['id'] == 'form_settings') {
                    $form_labels = $this->getFormLabels();
                }
                if ($id !== false) {
                    if ($heading['id'] != 'message_settings' && $heading['id'] != 'form_name' && $tab['id'] != 'tf_rf_dates_settings') {
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= $this->interface->cf_row_template($form_labels) . '<div class="tfclear divider" style="margin-bottom:0 !important;"></div>';
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= '<ul class="ui-sortable" id="rf_form_elements">';
                    }
                    if ($heading['id'] == 'tf_rf_dates_toexclude') {
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= '<ul class="ui-sortable" id="rf_excludedates_elements">';
                    }
                    if (!empty($form->description['exclude_dates']))
                        foreach ($form->description['exclude_dates'] as $exclude_date) {
                            if ($tab['id'] == 'tf_rf_messages_settings' || $tab['id'] == 'add_edit_forms') continue;
                            foreach ($heading['options'] as $key => $option) {
                                if(!is_array($option)) continue;
                                if ($option['id'] == 'tf_rf_exclude_date[]') {
                                    $heading['options'][$key]['value'] = urldecode($exclude_date);
                                }
                            }
                            $admin_meta_boxes[$tab['id']][$heading['name']] .= $this->interface->cf_row_template($heading['options']);
                        }
                    foreach ($form->description['input'] as $key => $input) {
                        if ($tab['id'] == 'tf_rf_messages_settings' || $heading['id'] == 'form_name' || $tab['id'] == 'tf_rf_dates_settings') continue;
                        if(in_array($input['type'],array('date_in','date_out'))){
                            $values = array('label'=>urldecode($input['label']),
                                'width'  =>urldecode($input['width']),
                                'newline'=>(isset($input['newline']) && $input['newline']) ? 'true' : 'false',
                                'input'  => $input
                            );
                            $admin_meta_boxes[$tab['id']][$heading['name']] .= $this->interface->cf_row_template($this->date_in_out($input['type'],$values,$key));
                            continue;
                        }
                        if($input['type'] == 'res_email'){
                            $values = array(
                                'label'   =>urldecode($input['label']),
                                'width'   =>urldecode($input['width']),
                                'newline' =>(isset($input['newline']) && $input['newline']) ? 'true' : 'false',
                                'column'  =>(isset($input['column']) && $input['column']) ? 'true' : 'false',
                                'input'   => $input);
                            $admin_meta_boxes[$tab['id']][$heading['name']] .= $this->interface->cf_row_template($this->default_email($values,$key));
                            continue;
                        }
                        $row = array();
                        $row['type'] = $heading['options']['type'];
                        foreach ($heading['options'] as $option) {
                            if(!is_array($option)) continue;
                            if ($option['id'] == 'tf_rf_input[]') {
                                $option['value'] = str_replace('_', ' ', urldecode($input['label']));
                            } elseif ($option['id'] == 'tf_rf_select[]') {

                                $option['value'] = urldecode($input['type']);
                            } elseif($option['id'] == 'tf_rf_column[]') {
                                $option['value'] = @$input['column'];
                            }elseif ($option['id'] == 'tf_rf_input_width[]') {
                                $option['value'] = urldecode($input['width']);
                            } elseif ($option['id'] == 'tf_rf_input_required') {
                                if ($input['type'] == 'radio' || $input['type'] == 'checkbox' || $input['type'] == 'select' || $input['type'] == 'multicheckbox') {
                                    $option['properties']['class'] .= ' invisible';
                                }
                                $option['id'] .= '_' . $key;
                                $option['value'] = (isset($input['required']) && $input['required']) ? 'true' : 'false';
                            } elseif ($option['id'] == 'tf_rf_input_newline') {
                                $option['id'] .= '_' . $key;
                                $option['value'] = (isset($input['newline']) && $input['newline']) ? 'true' : 'false';
                            } elseif ($option['id'] == 'tf_rf_column') {
                                $option['id'] .= '_' . $key;
                                $option['value'] = (isset($input['column']) && $input['column']) ? 'true' : 'false';
                            }elseif ($option['id'] == 'tf_rf_toggle_show') {
                                if ($input['type'] != 'radio' && $input['type'] != 'select' && $input['type'] != 'multicheckbox') {
                                    $option['id'] .= ' hidden';
                                }
                            } elseif ($option['id'] == 'tf_rf_shortcode_row') {
                                $option['value'] = str_replace('%%code%%', '[' . $input['shortcode'] . ']', $option['value']);
                            }

                            if (sizeof($form->description['input']) == 1) {
                                if ($option['type'] == 'delete_row') $option['class'] = 'tf_rf_delete_row_last';
                            }
                            $row[] = $option;
                        }
                        if (isset($input['options']) && $input['options']) {
                            $opt = array();
                            $i = 0;
                            foreach ($input['options'] as $value) {
                                foreach ($heading['options_row'] as $opt_row) {

                                    if ($opt_row['id'] == 'tf_rf_input_options_label') {
                                        $opt_row['value'] = str_replace('%%value%%', urldecode($value), $opt_row['value']);
                                    }
                                    $opt_row['id'] .= '[' . $key . "][]";
                                    $opt[$i][] = $opt_row;
                                }
                                $i++;
                            }
                        } else {
                            foreach ($heading['options_row'] as $opt_row) {
                                $opt_row['id'] .= '[' . $key . '][]';
                                $opt_row['value'] = str_replace('%%value%%', '', $opt_row['value']);
                                $opt[0][] = $opt_row;
                            }
                        }
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= $this->interface->cf_row_template($row, $opt);
                        unset($row);
                        unset($opt);
                    }
                    if ($heading['id'] == 'form_settings') {
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= '</ul>';
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= $this->optigen->$add_button['type']($add_button);
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= $this->optigen->$prev_button['type']($prev_button);
                    }
                    elseif ($heading['id'] == 'tf_rf_dates_toexclude') {
                        $dates_button = $add_button;
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= '</ul>';
                        $dates_button['id'] = 'rf_exclude_new_interval';
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= $this->optigen->$add_button['type']($dates_button);
                    }
                    foreach ($heading['options'] as $option) {
                        if ($heading['id'] == 'form_settings' || $tab['id'] == 'tf_rf_dates_settings' || !is_array($option)) continue;
                        if ($option['id'] == 'tf_rf_mess_submit') {
                            $option['value'] = stripslashes(urldecode($form->description['submit_mess']));
                        }
                        if ($option['id'] == 'tf_rf_shortcode') {
                            $option['value'] = stripslashes(str_replace('%%form_id%%', $id, $option['value']));
                        }
                        if ($option['id'] == 'tf_rf_formname_input') {
                            $option['value'] = stripslashes(urldecode($form->name));
                        }
                        if ($option['id'] == 'tf_rf_heading_text' && isset($form->description['header_message'])) {
                            $option['value'] = stripslashes(urldecode($form->description['header_message']));
                        }
                        if ($option['id'] == 'tf_rf_res_title') {
                            $option['value'] = stripslashes(urldecode($form->description['reservation_title']));
                        }
                        if ($option['id'] == 'tf_rf_position') {
                            $option['value'] = stripslashes(urldecode($form->description['position']));
                        }
                        if ($option['id'] == 'tf_rf_datepickers_count') {
                            $option['value'] = stripslashes(urldecode($form->description['datepickers_count']));
                        }
                        if ($option['id'] == 'tf_rf_new_res_email_template' && isset($form->description['new_res_email_template'])) {
                            $option['value'] = stripslashes(urldecode($form->description['new_res_email_template']));
                        }
                        if($option['id'] == 'tf_rf_mess_reset' && isset($form->description['reset_button'])) {
                            $option['value'] = stripslashes(urldecode($form->description['reset_button']));
                        }
                        if($option['id'] == 'tf_rf_form_notice' && isset($form->description['tf_rf_form_notice'])) {
                            $option['value'] = stripslashes(urldecode($form->description['tf_rf_form_notice']));
                        }
                        if($option['id'] == 'tf_rf_new_res_admin_email_template' && isset($form->description['admin_email_template'])) {
                            $option['value'] = stripslashes(urldecode($form->description['admin_email_template']));
                        }
                        if ($option['id'] == 'tf_rf_form_template') {
                            $option['value'] = stripslashes(urldecode($form->description['form_template']));
                        }
                        if ($option['id'] == 'tf_rf_email_template') {
                            $option['value'] = stripslashes(urldecode($form->description['email_template']));
                        }
                        if ($option['id'] == 'tf_rf_succ_mess') {
                            $option['value'] = stripslashes(urldecode($form->description['succes_mess']));
                        }
                        if ($option['id'] == 'tf_rf_reject_email_template') {
                            $option['value'] = stripslashes(urldecode($form->description['reject_email_template']));
                        }
                        if ($option['id'] == 'tf_rf_confirm_email_template') {
                            $option['value'] = stripslashes(urldecode($form->description['confirm_email_template']));
                        }
                        if ($option['id'] == 'tf_rf_succ_mess') {
                            $option['value'] = stripslashes(urldecode($form->description['succes_mess']));
                        }
                        if ($option['id'] == 'tf_rf_required_text') {
                            $option['value'] = stripslashes(urldecode($form->description['required_text']));
                        }
                        if ($option['id'] == 'tf_rf_failure_mess') {
                            $option['value'] = stripslashes(urldecode($form->description['fail_mess']));
                        }
                        if ($option['id'] == 'tf_rf_email_from') {
                            $option['value'] = stripslashes(urldecode($form->description['email_from']));
                        }
                        if ($option['id'] == 'tf_rf_email_to') {
                            $option['value'] = stripslashes(urldecode($form->description['email_to']));
                        }
                        if ($option['id'] == 'tf_rf_email_subject') {
                            $option['value'] = stripslashes(urldecode($form->description['email_subject']));
                        }
                        if ($option['id'] == 'tf_rf_email_subject') {
                            $option['value'] = stripslashes(urldecode($form->description['email_subject']));
                        }
                        if ($option['id'] == 'tf_rf_exclude_date[]') {
                            $option['value'] = stripslashes(urldecode($form->description['dates_to_exclude']));
                        }
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= $this->interface->meta_box_row_template($option);

                    }
                } else {
                    if ($heading['id'] == 'form_settings') {
                        foreach ($heading['options'] as $key => $option) {
                            if(!is_array($option)) continue;
                            if ($option['id'] == 'tf_rf_input_required') {
                                $heading['options'][$key]['id'] .= '_0';
                            }
                            if ($option['id'] == 'tf_rf_input_newline') {
                                $heading['options'][$key]['id'] .= '_0';
                            }
                            if ($option['id'] == 'tf_rf_column') {
                                $heading['options'][$key]['id'] .= '_0';
                            }
                            if ($option['id'] == 'tf_rf_input_options[]') {
                                $heading['options'][$key]['value'] = '';
                                $heading['options'][$key]['properties']['class'] = str_replace('%%visible%%', 'hidden', $heading['options'][$key]['properties']['class']);
                            }
                            if ($option['id'] == 'tf_rf_toggle_show') {
                                $heading['options'][$key]['id'] .= ' hidden';
                            }
                            if ($option['id'] == 'tf_rf_shortcode_row') {
                                $heading['options'][$key]['value'] = str_replace('%%code%%', '[]', $option['value']);
                            }
                        }
                        foreach ($heading['options_row'] as $opt_row) {
                            $opt_row['id'] .= '[0][]';
                            $opt_row['value'] = str_replace('%%value%%', '', $opt_row['value']);
                            $opt[0][] = $opt_row;
                        }
                        $values = array('label'=>__('Check In', 'tfuse'),'width'=>'50','newline'=>false);
                        $email_values = array('label'=>__('Your Email', 'tfuse'),'width'=>'50','newline'=>false);
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= $this->interface->cf_row_template($form_labels) . '<div class="tfclear divider" style="margin-bottom:0 !important;"></div>';
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= '<ul class="ui-sortable" id="rf_form_elements">';
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= $this->interface->cf_row_template($heading['options'], $opt);
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= $this->interface->cf_row_template($this->date_in_out('date_in',$values,1));
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= $this->interface->cf_row_template($this->default_email($email_values,2));
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= '</ul>';
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= $this->optigen->$add_button['type']($add_button);
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= $this->optigen->$add_button['type']($prev_button);
                    }
                    elseif ($heading['id'] == 'tf_rf_dates_toexclude') {
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= '<ul class="ui-sortable" id="rf_excludedates_elements">';
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= $this->interface->cf_row_template($heading['options']);
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= '</ul>';
                        $add_button['id'] = 'rf_exclude_new_interval';
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= $this->optigen->$add_button['type']($add_button);
                    }
                    else {
                        foreach ($heading['options'] as $option) {
                            if(!is_array($option)) continue;
                            if ($option['id'] == 'tf_rf_shortcode') {

                                $option['value'] = str_replace('%%form_id%%', 0, $option['value']);
                            }
                            $admin_meta_boxes[$tab['id']][$heading['name']] .= $this->interface->meta_box_row_template($option);
                        }
                    }
                }
            }
            $admin_meta_boxes[$tab['id']]['buttons'] = '';
            if (!empty($tab['buttons'])) {
                foreach ($tab['buttons'] as $button) {
                    if ($button['id'] == 'rf_save_form_button') {
                        if (!$this->request->isset_GET('id')) {
                            $button['value'] = __('Create form', 'tfuse');
                        }
                    }
                    $admin_meta_boxes[$tab['id']]['buttons'] .= $this->optigen->$button['type']($button);
                }
            }
        }
        return $admin_meta_boxes;
    }

    function get_form_gen_options()
    {
        $admin_meta_boxes = array();
        $gen_options = $this->model->get_forms_gen_options();
        $options = $this->get->ext_options($this->_the_class_name, strtolower($this->_the_class_name));
        $is_smtp = ($gen_options['mail_type'] == 'smtp') ? true : false;
        foreach ($options['tabs'] as $tab) {
            if ($tab['id'] == 'add_edit_forms' || $tab['id'] == 'tf_rf_messages_settings' || $tab['id'] == 'tf_rf_dates_settings') continue;
            foreach ($tab['headings'] as $heading) {
                $admin_meta_boxes[$tab['id']][$heading['name']] = '';
                foreach ($heading['options'] as $option) {
                    if ($gen_options) {
                        if ($option['id'] == 'tf_rf_mail_type') {
                            $option['value'] = $gen_options['mail_type'];
                        }
                        if ($option['id'] == 'tf_rf_secure_conn') {
                            $option['value'] = $gen_options['secure_conn'];
                        }
                        if ($option['id'] == 'tf_rf_smtp_host') {
                            $option['value'] = $gen_options['smtp_host'];
                        }
                        if ($option['id'] == 'tf_rf_smtp_port') {
                            $option['value'] = $gen_options['smtp_port'];
                        }
                        if ($option['id'] == 'tf_rf_smtp_user') {
                            $option['value'] = $gen_options['smtp_user'];
                        }
                        if ($option['id'] == 'tf_rf_smtp_pwd') {
                            $option['value'] = $gen_options['smtp_pwd'];
                        }
                    }
                    if (!$is_smtp && $option['id'] != 'tf_rf_mail_type') {
                        if (isset($option['properties']['class'])) {
                            $option['properties']['class'] .= ' hidden';
                        } else {
                            $option['properties']['class'] = ' hidden';
                        }
                    }
                    $admin_meta_boxes[$tab['id']][$heading['name']] .= $this->interface->meta_box_row_template($option);
                }
            }
            $admin_meta_boxes['tabs'][] = $tab;
            $admin_meta_boxes[$tab['id']]['buttons'] = '';
            foreach ($tab['buttons'] as $button) {
                $admin_meta_boxes[$tab['id']]['buttons'] .= $this->optigen->$button['type']($button);
            }
        }
        return $admin_meta_boxes;
    }

    function getFormLabels()
    {
        $inputs = $this->get->ext_config($this->_the_class_name, 'base');
        return $inputs['labels'];

    }
    function date_in_out($field,$values,$nr_in_form){
        $datepickers_ids = array('date_in' => 'in', 'date_out' => 'out');
        $datepickers_types = array('date_in' => __('Check In', 'tfuse'), 'date_out' => __('Check Out', 'tfuse'));
        $datepickers =  array(
            array('name' => __('Input type', 'tfuse'),
                  'desc' => '',
                  'id' => 'tf_rf_select[]',
                  'value' => '',
                  'type' => 'select',
                  'value' => '',
                  'properties' => array(
                      'class'=>TF_THEME_PREFIX.'_inp_select medica_inp_select'
                  ),
                  'options' => array(
                      $field => $datepickers_types[$field]
                  )
            ),
            array('name' => __('Label', 'tfuse'),
                  'desc' => __('Input label', 'tfuse'),
                  'id' => 'tf_rf_input[]',
                  'value' => $values['label'],
                  'properties' => array(
                      'class' => 'rf_input_label'
                  ),
                  'type' => 'text'),
            array('name' => __('Width', 'tfuse'),
                  'desc' => __('fields width','tfuse'),
                  'type' => 'text',
                  'id' => 'tf_rf_input_width[]',
                  'value' => $values['width'],
                  'properties' => array(
                      'class' => 'rf_input_width'
                  ),
                  'divider' => true),
            array('name' => __('Required', 'tfuse'),
                  'desc' => __('is this field required?', 'tfuse'),
                  'type' => 'raw',
                  'id' => 'tf_rf_input_required_'.$nr_in_form,
                  'html' => '<div id="datepicker_inputs_required" class="rf_input_required">Yes</div>',
                  'properties' => array(
                      'class' => 'rf_input_required',
                  ),
                  'divider' => true
            ),
            array(
                'name' => __('New Line', 'tfuse'),
                'desc' => '',
                'type' => 'checkbox',
                'id' => 'tf_rf_input_newline_'.$nr_in_form,
                'value' => $values['newline'],
                'properties' => array(
                    'class' => 'rf_input_newline'
                ),
                'divider' => true
            ),
            array('name'=>'',
                  'desc'=>'',
                  'id'=>'tf_cf_shortcode_row',
                  'type'=>'selectable_code',
                  'value'=>'%%code%%',
                  'properties'=>array(
                      'class'=> 'shortcode_code',
                  ),
                  'divider'=>true,
            ),
            array('name' => '',
                  'desc' => '',
                  'id' => 'tf_rf_is_datepicker[]',
                  'type' => 'text',
                  'value' => $datepickers_ids[$field],
                  'divider' => true,
                  'properties' => array(
                      'class'=> 'tfuse_is_datepicker_flag'
                  )
            ),
            'type'=>'custom_reservationform_row'
        );
        return apply_filters('datepickers_res_form',$datepickers,$values);
    }
    function default_email($values,$key){
        $email = array(
            array('name' => __('Input type', 'tfuse'),
                  'desc' => '',
                  'id' => 'tf_rf_select[]',
                  'value' => '',
                  'type' => 'select',
                  'properties' => array(
                      'class'=>TF_THEME_PREFIX.'_inp_select medica_inp_select'
                  ),
                  'options' => array(
                      'res_email' => 'Email'
                  )
            ),
            array('name' => __('Label', 'tfuse'),
                  'desc' => __('Input label', 'tfuse'),
                  'id' => 'tf_rf_input[]',
                  'value' => $values['label'],
                  'properties' => array(
                      'class' => 'rf_input_label'
                  ),
                  'type' => 'text'),
            array('name' => __('Width', 'tfuse'),
                  'desc' => __('fields width', 'tfuse'),
                  'type' => 'text',
                  'id' => 'tf_rf_input_width[]',
                  'value' => $values['width'],
                  'properties' => array(
                      'class' => 'rf_input_width'
                  ),
                  'divider' => true),
            array('name' => __('Required', 'tfuse'),
                  'desc' => __('is this field required?', 'tfuse'),
                  'type' => 'raw',
                  'id' => 'tf_rf_input_required_'.$key,
                  'html' => '<div id="datepicker_inputs_required" class="rf_input_required">Yes</div>',
                  'properties' => array(
                      'class' => 'rf_input_required',
                  ),
                  'divider' => true
            ),
            array(
                'name' => __('New Line', 'tfuse'),
                'desc' => '',
                'type' => 'checkbox',
                'id' => 'tf_rf_input_newline_'.$key,
                'value' => $values['newline'],
                'properties' => array(
                    'class' => 'rf_input_newline'
                ),
                'divider' => true
            ),
            array('name'=>'',
                  'desc'=>'',
                  'id'=>'tf_cf_shortcode_row',
                  'type'=>'selectable_code',
                  'value'=>'%%code%%',
                  'properties'=>array(
                      'class'=> 'shortcode_code',
                  ),
                  'divider'=>true,
            ),
            array('name' => '',
                  'desc' => '',
                  'id' => 'tf_rf_is_datepicker[]',
                  'type' => 'text',
                  'value' => 'email',
                  'divider' => true,
                  'properties' => array(
                      'class'=> 'tfuse_is_datepicker_flag'
                  )
            ),
            'type'=>'custom_reservationform_row'
        );
        return apply_filters('reservationform_email_input_array',$email,$values);
    }
    function redirect_if_id_invalid($_id)
    {
        if (is_null(get_term($_id, 'reservations')))
            wp_redirect(get_admin_url() . 'admin.php?page=tf_reservation_forms_list');
    }
    function redirect_if_reservation_id_invalid($_id)
    {
        if (is_null(get_post($_id)))
            wp_redirect(get_admin_url() . 'admin.php?page=tf_reservations_list');
    }
}