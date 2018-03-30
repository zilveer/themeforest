<?php
if(!defined('TFUSE')) exit('Direct access forbidden.');

class TF_CONTACTFORM extends TF_TFUSE
{

    public $_the_class_name = 'CONTACTFORM';
    public $messages;
    public $defined_forms=array();

    function __construct()
    {
        parent::__construct();
    }

    function __init()
    {
        if (!$this->load->ext_file_exists($this->_the_class_name, '')) return;

        $this->defined_forms = $this->model->get_forms();
        if ($this->request->isset_GET('page') && $this->request->GET('page') == 'tf_contact_form' && $this->request->isset_GET('id')) {
            $this->redirect_if_id_invalid($this->request->GET('id'));
        }
        add_action('admin_menu', array($this, 'add_menu'), 20);
        if (is_admin() && $this->request->isset_GET('page') && stripos($this->request->GET('page'), 'tf_contact_form') === 0) {
            $this->add_static();
            $this->include->js_enq('tf_contactform_save', wp_create_nonce('tf_contactform_save'));
        }
        $this->add_ajax();
        add_action('tf_cf_form_content', array($this, 'tf_forms_setup'));
        add_action('gen_options_form', array($this, 'general_settings'));
    }

    function add_ajax()
    {
        $this->ajax->_add_action('tfuse_ajax_contactform', $this);
    }
    function add_static()
    {

        $this->include->register_type( 'selectmenu', get_template_directory() . '/css');
        $this->include->css( 'ui.selectmenu','selectmenu' );
        $this->include->register_type('ext_contactform_css', TFUSE_EXT_DIR . '/' . strtolower($this->_the_class_name) . '/static/css');
        $this->include->register_type('ext_contactform_js', TFUSE_EXT_DIR . '/' . strtolower($this->_the_class_name) . '/static/js');
        $this->include->css('contact_form', 'ext_contactform_css');
        $this->include->js('contact_form', 'ext_contactform_js', 'tf_footer', 10, '1.1');
        if(file_exists(get_template_directory().'/theme_config/extensions/contactform/options/preview_options.php')){

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
        add_object_page(__('Contact Forms Settings', 'tfuse'), __("Contact Forms", 'tfuse'), 'publish_pages', 'tf_contact_forms_list', array($this, 'list_forms'));
        add_submenu_page('tf_contact_forms_list', __('All Contact Forms', 'tfuse'), __('All Contact Forms', 'tfuse'), 'publish_pages', 'tf_contact_forms_list', array($this, 'list_forms'));
        add_submenu_page('tf_contact_forms_list', __('Add New', 'tfuse'), __('Add New', 'tfuse'), 'publish_pages', 'tf_contact_form', array($this, 'show_add_form'));
        add_submenu_page('tf_contact_forms_list', __('General Settings', 'tfuse'), __('General Settings', 'tfuse'), 'publish_pages', 'tf_contact_forms_gensett', array($this, 'list_gen_options'));
    }

    function general_settings()
    {
        $this->common_html();
        if($this->request->isset_POST('save_gen_options')) {
            if(wp_verify_nonce($this->request->POST('form_gensett_nonce'),'form_gensett_nonce_action')) $this->save_general_options();
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
        $forms = $this->defined_forms;
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

    function tf_forms_setup()
    {
        if($this->request->isset_POST('save_form') || $this->request->isset_POST('save_messages')) {
            $this->save_form();
        }
        echo '<div style="clear:both;height:20px;">&nbsp;</div>';
        $options = $this->get_form_options();
        $this->create_form_meta_box($options);
    }

    /**
     * @ajax
     */
    function submitFrontendForm()
    {
        $general_options = $this->model->get_forms_gen_options();
        $tf_cf_formid=$this->request->POST('form_id');
        if($this->request->isset_POST('submit')) {
            $message=(@$general_options['mail_type'] == 'smtp') ? $this->sendSMTP($tf_cf_formid) : $this->sendWpmail($tf_cf_formid);
        }
        echo json_encode($message);die();
    }

    /**
     * @ajax
     */
    function delete_form()
    {
        if (!tf_current_user_can(array('manage_options'), false))
            die('Access denied');

        $forms = $this->defined_forms;
        $formId = $this->request->POST('formid');
        if(is_array($formId)) {
            foreach($formId as $id) unset($forms[$id]);
        } else {
            unset($forms[$formId]);
        }

        $this->model->save_form($forms);
    }

    /**
     * @ajax
     */
    function save_form()
    {
        if (!tf_current_user_can(array('manage_options'), false))
            die('Access denied');

        if(wp_verify_nonce($this->request->POST('form_setup_nonce'),'form_setup_nonce_action'))
        {
            $form_to_save = array();
            if(trim($this->request->POST('tf_cf_formname_input') == ''))
                return ;

            $form_to_save['form_name'] = $this->request->POST('tf_cf_formname_input');
            if(!count($this->request->POST('tf_cf_input')) > 0)
                return ;

            foreach($this->request->POST('tf_cf_input') as $key => $value) {
                $form_to_save['input'][$key]['label'] = $value;
            }
            if ($this->request->POST('menu-item'))
                foreach((array)$this->request->POST('tf_cf_column') as $key => $value) {
                    $form_to_save['input'][$key]['column'] = $value;
                }

            foreach($this->request->POST('tf_cf_input_options_label') as $key => $value) {
                if($this->request->POST('tf_cf_select.'.$key) == 2 || $this->request->POST('tf_cf_select.'.$key) == 4)
                    $form_to_save['input'][$key]['options'] = $value;
            }

            foreach($this->request->POST('tf_cf_input_shortcode') as $key => $value) {
                $form_to_save['input'][$key]['shortcode'] = $value;
            }

            foreach($this->request->POST('tf_cf_select') as $key => $value) {
                $form_to_save['input'][$key]['type'] = $value;
                if($this->request->isset_POST('tf_cf_input_newline_' . $key) && tfuse_parse_boolean($this->request->POST('tf_cf_input_newline_' . $key)))
                    $form_to_save['input'][$key]['newline'] = 1;

                if($this->request->isset_POST('tf_cf_input_required_' . $key) && tfuse_parse_boolean($this->request->POST('tf_cf_input_required_' . $key)))
                    $form_to_save['input'][$key]['required'] = 1;
            }

            foreach($this->request->POST('tf_cf_input_width') as $key => $value) {
                $form_to_save['input'][$key]['width'] = $value;
            }

            $form_to_save['submit_mess'] = (trim($this->request->POST('tf_cf_mess_submit')) == '') ? 'Submit' : $this->request->POST('tf_cf_mess_submit');
            $form_to_save['succes_mess'] = $this->request->POST('tf_cf_succ_mess');
            $form_to_save['fail_mess'] = $this->request->POST('tf_cf_failure_mess');
            $form_to_save['email_template'] = $this->request->POST('tf_cf_email_template');
            $form_to_save['header_message'] = $this->request->POST('tf_cf_heading_text');
            if($this->request->isset_POST('tf_cf_mess_reset'))
            $form_to_save['reset_button'] = $this->request->POST('tf_cf_mess_reset');
            $form_to_save['email_from'] = $this->request->POST('tf_cf_email_from');
            $form_to_save['email_to'] = $this->request->POST('tf_cf_email_to');
            $form_to_save['form_template'] = $this->request->POST('tf_cf_form_template');
            $form_to_save['email_subject'] = $this->request->POST('tf_cf_email_subject');
            $form_to_save['position'] = $this->request->POST('tf_cf_position');
            $form_to_save['required_text'] = $this->request->POST('tf_cf_required_text');

            if($this->request->isset_GET('id')) {
                $this->defined_forms[$this->request->GET('id')] = $form_to_save;
            } else {
                $this->defined_forms[] = $form_to_save;
                $this->model->save_form($this->defined_forms);
                end($this->defined_forms);
                $curr_formId = key($this->defined_forms);
                $pageURL = 'http';
                if($_SERVER['HTTPS'] == 'on') {
                    $pageURL .= 's';
                }
                $pageURL .= '://';
                $pageURL .= $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . '&id=' . $curr_formId;
                header('Location:' . $pageURL);
            }

        } else {
            echo __('Your nonce did not pass verification', 'tfuse');
        }
    }

    function prepare_ajax_data($form_data)
    {
        $form_to_save=array();
        foreach($form_data['types'] as $key => $type) {
            $form_to_save['input'][$key]['type'] = $type;
        }
        unset($form_data['types']);
        foreach($form_data['shortcode'] as $key => $shortcode) {
            $form_to_save['input'][$key]['shortcode'] = $shortcode;
        }
        unset($form_data['shortcode']);
        foreach($form_data['column'] as $key => $column) {
            $form_to_save['input'][$key]['column'] = $column;
        }
        unset($form_data['column']);
        foreach($form_data['labels'] as $key => $label) {
            $form_to_save['input'][$key]['label'] = $label;
        }
        unset($form_data['labels']);
        foreach($form_data['width'] as $key => $width) {
            $form_to_save['input'][$key]['width'] = $width;
        }
        unset($form_data['width']);
        foreach($form_data['required'] as $key => $req) {
            if($req == 1)
                $form_to_save['input'][$key]['required'] = 1;
        }
        unset($form_data['required']);
        foreach($form_data['newline'] as $key => $newl) {
            if($newl == 1)
                $form_to_save['input'][$key]['newline'] = 1;
        }
        unset($form_data['newline']);
        if(isset($form_data['options'])) {
            foreach($form_data['options'] as $key => $options){
                $form_to_save['input'][$key]['options'] = $options;
            }
            unset($form_data['options']);
        }
        $form_to_save = array_merge($form_to_save,$form_data);

        return $form_to_save;
    }

    /**
     * @ajax
     */
    function ajax_save_form()
    {
        if (!tf_current_user_can(array('manage_options'), false))
            die('Access denied');

        $this->ajax->_verify_nonce('tf_contactform_save');
        $defined_forms = $this->defined_forms;
        $form_id = $this->request->POST('get_id');
        $form_data = $this->request->POST('post_data');
        $form_to_save = $this->prepare_ajax_data($form_data);
        unset($defined_forms[$form_id]);
        $defined_forms[$form_id] = $form_to_save;
        $this->defined_forms = $defined_forms;
        $this->model->save_form($this->defined_forms);
        echo json_encode(array('saved' => 1));
        die();
    }

    /**
     * @ajax
     */
    function form_preview()
    {
        if (!tf_current_user_can(array('publish_pages'), false))
            die('Access denied');

        require_once(TFUSE_CONFIG_SHORTCODES . '/shortcodes/contactform.php');
        $_formArray = $this->prepare_ajax_data($this->request->POST('tf_form_'));
        $_COOKIE['form_array'] = serialize($_formArray);
       // $this->request->COOKIE('form_array', serialize($_formArray));
        echo do_shortcode('[tfuse_contactform]');
        die();
    }
    function save_general_options()
    {
        if(wp_verify_nonce($this->request->POST('form_gensett_nonce'),'form_gensett_nonce_action')){
            $gen_options = array('mail_type' => $this->request->POST('tf_cf_mail_type'), 'smtp_host' => $this->request->POST('tf_cf_smtp_host'), 'smtp_user' => $this->request->POST('tf_cf_smtp_user'), 'smtp_pwd' => $this->request->POST('tf_cf_smtp_pwd'), 'smtp_port' => $this->request->POST('tf_cf_smtp_port'), 'secure_conn' => $this->request->POST('tf_cf_secure_conn'));
            $this->model->save_form_gen_options($gen_options);
        } else {
            echo __('Your nonce did not pass verification', 'tfuse');
        }
    }

    function sendSMTP($formid)
    {
        require_once(WPINC . '/class-phpmailer.php');
        $excludedFromPost=array('action','tf_action','form_id','submit');
        $forms = $this->model->get_forms();
        $general_options = $this->model->get_forms_gen_options();
        $form = $forms[$formid];
        $from = str_replace(array('[',']'),'',$form['email_from']);
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
        $mail->From = $form['email_from'];
        $mail->FromName = $form['email_from'];
        $mail->Subject = $form['email_subject'];
        $emails = explode(',',$form['email_to']);
            foreach($emails as $email)
        $mail->AddAddress($email);
        $mail->CharSet="UTF-8";
        $content = $form['email_template'];
        if(trim($content) != '')
        {
            foreach($this->request->POST() as $key => $value) {
                $key     = tf_option_id_without_prefix($key);
                $content = str_replace("[" .$key. "]", $value, $content);
            }
        }
        else
        {
            $content = '';
            foreach($this->request->POST() as $key => $value)
            {
                foreach($form['input'] as $input) {
                    if(!in_array($key,$excludedFromPost) && $key != TF_THEME_PREFIX . '_'){
                        if($key == TF_THEME_PREFIX.'_'.$input['shortcode'])
                            $content .= '<strong>' . $input['label'] . ':</strong> '. $value . '<br />';
                    }
                }
            }
        }
        $mail->Body = $content;
        if(!$mail->send()) {
            return array('mess' => $form['fail_mess'], 'error' => true);
        } else {
            return array('mess' => $form['succes_mess'], 'error' => false);
        }
        $mail->ClearAddresses();
        $mail->ClearAllRecipients();
    }

    function sendWpmail($formId)
    {
        $excludedFromPost=array('action','tf_action','form_id','submit');
        $forms = $this->model->get_forms();
        $form = $forms[$formId];
        $from = str_replace(array('[',']'),'',$form['email_from']);
        if($this->request->isset_POST(TF_THEME_PREFIX.'_'.$from) && filter_var($this->request->POST(TF_THEME_PREFIX.'_'.$from),FILTER_VALIDATE_EMAIL))
            $form['email_from'] = $this->request->POST(TF_THEME_PREFIX.'_'.$from);
        $message = $form['email_template'];
        if(trim($message) != ''){
            foreach($this->request->POST() as $key => $value) {
                $key     = tf_option_id_without_prefix($key);
                $message = str_replace('[' .$key. ']', $value, $message);
            }
        } else {
            $message = '';
            foreach($this->request->POST() as $key => $value) {
                foreach($form['input'] as $input){
                    if(!in_array($key,$excludedFromPost) && $key != TF_THEME_PREFIX . '_'){
                        if($key == TF_THEME_PREFIX . '_' . $input['shortcode'])
                            $message .= '<strong>' . $input['label'] . ':</strong> '. $value . '<br />';
                    }
                }
            }
        }
        $headers = "From:" . $form['email_from'] . "><" . $form['email_from'] . ">";
        add_filter('wp_mail_content_type',create_function('', 'return "text/html";'));
        if(wp_mail($form['email_to'], $form['email_subject'], $message, $headers))
            return array('mess' => $form['succes_mess'], 'error' => false);
        else
            return array('mess' =>$form['fail_mess'], 'error' => true);
    }

    function custom_admin_box_content($post, $args)
    {
        echo apply_filters("{$args['id']}_custom_admin_box_content", $args['args'], $post, $args);

    }

    function create_form_meta_box($options, $accepted_tab_ids = array())
    {
        $admin_meta_boxes =& $options;
        $tabs_header = '<ul>';
        foreach($admin_meta_boxes['tabs'] as $tab) {
            if(count($accepted_tab_ids) > 0 && !in_array($tab['id'], $accepted_tab_ids)) continue;
            $tabs_header .= '<li id="tfusetabheader-' . $tab['id'] . '"><a href="#tfusetab-' . $tab['id'] . '">' . $tab['name'] . '</a></li>';
        }
        $tabs_header .= '</ul>';

        foreach($admin_meta_boxes as $tab => $box) {
            if($tab == 'tabs') continue;
            foreach($box as $heading => $rows) {
                if($heading == "buttons") continue;
                $boxid = sanitize_title($heading);
                add_meta_box($boxid, $heading, array($this, 'custom_admin_box_content'), $tab, 'normal', 'core', $rows);
            }
        }
        echo '<div class="tf_meta_tabs">';
        echo $tabs_header;
        foreach($admin_meta_boxes['tabs'] as $tab) {
            if(count($accepted_tab_ids) > 0 && !in_array($tab['id'], $accepted_tab_ids)) continue;
            echo '<div id="tfusetab-' . $tab['id'] . '">';
            do_meta_boxes($tab['id'], 'normal', null);
            echo $admin_meta_boxes[$tab['id']]['buttons'];
            echo '</div>';
        }
        echo '</div>';
    }

    function get_form_options()
    {
        $forms = $this->defined_forms;
        $id = ($this->request->isset_GET('id')) ? $this->request->GET('id') : false;
        $form = ($id === false) ? false : $forms[$id];
        $admin_meta_boxes = array();
        $add_button = array('name' => '', 'desc' => '', 'id' => 'tf_cf_add_new', 'value' => __('Add new field', 'tfuse'), 'type' => 'button', 'subtype' => 'button', 'properties' => array('class' => 'button cf_add_new'));
        $prev_button = array('name' => '', 'desc' => '', 'id' => 'tf_cf_prev_button', 'value' => __('Preview', 'tfuse'), 'type' => 'button', 'subtype' => 'button', 'properties' => array('class' => 'reset-button cf_form_preview button'));
        $options = $this->get->ext_options($this->_the_class_name, strtolower($this->_the_class_name));
        foreach($options['tabs'] as $tab) {
            if($tab['id'] == 'tf_cf_general_settings') continue;
            $admin_meta_boxes['tabs'][] = $tab;
            $headings = $tab['headings'];
            unset($tab['headings']);
            foreach($headings as $heading) {
                $admin_meta_boxes[$tab['id']][$heading['name']] = '';
                if($heading['id'] == 'form_settings') {
                    $admin_meta_boxes[$tab['id']][$heading['name']] = '';
                    $form_labels = $this->getFormLabels();
                }
                if($id !== false) {
                    if($heading['id'] != 'message_settings' && $heading['id'] != 'form_name') {
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= $this->interface->cf_row_template($form_labels) . '<div class="tfclear divider" style="margin-bottom:0 !important;"></div>';
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= '<ul class="ui-sortable" id="cf_form_elements">';
                    }
                    foreach($form['input'] as $key => $input) {
                        if($tab['id'] == 'tf_cf_messages_settings' || $heading['id'] == 'form_name') continue;
                        $row = array();
                        $row['type'] = $heading['options']['type'];
                        foreach($heading['options'] as $option) {
                            if(!is_array($option)) continue;
                            if($option['id'] == 'tf_cf_input[]') {
                                $option['value'] = str_replace('_', ' ', $input['label']);
                            } elseif($option['id'] == 'tf_cf_select[]') {
                                $option['value'] = $input['type'];
                            }elseif($option['id'] == 'tf_cf_column[]') {
                                $option['value'] = @$input['column'];
                            } elseif($option['id'] == 'tf_cf_input_width[]') {
                                $option['value'] = $input['width'];
                            } elseif($option['id'] == 'tf_cf_input_required') {
                                if($input['type'] == 2 || $input['type'] == 3 || $input['type'] == 4){
                                    $option['properties']['class'] .=' invisible';
                                }
                                $option['id'] .= '_' . $key;
                                if(isset($input['required']))
                                    $option['value'] = ($input['required']) ? 'true' : 'false';
                            } elseif($option['id'] == 'tf_cf_input_newline') {
                                $option['id'] .= '_' . $key;
                                $option['value'] = (isset($input['newline']) && $input['newline']) ? 'true' : 'false';
                            } elseif($option['id'] == 'tf_cf_toggle_show') {
                                if($input['type'] != 2 && $input['type'] != 4) {
                                    $option['id'] .= ' hidden';
                                }
                            }  elseif($option['id'] == 'tf_cf_shortcode_row') {
                                $option['value'] =str_replace('%%code%%','['.$input['shortcode'].']',$option['value']);
                            }

                            if(sizeof($form['input']) == 1) {
                                if($option['type'] == 'delete_row') $option['class'] = 'tf_cf_delete_row_last';
                            }
                            $row[] = $option;
                        }
                        if(isset($input['options']) && sizeof($input['options']) > 0) {
                            $opt = array();
                            $i = 0;
                            foreach($input['options'] as $value) {
                                foreach($heading['options_row'] as $opt_row) {
                                    if($opt_row['id'] == 'tf_cf_input_options_label') {
                                        $opt_row['value'] = str_replace('%%value%%', $value, $opt_row['value']);
                                    }
                                    $opt_row['id'] .= '[' . $key . "][]";
                                    $opt[$i][] = $opt_row;
                                }
                                $i++;
                            }
                        } else {
                            foreach($heading['options_row'] as $opt_row) {
                                $opt_row['id'] .= '[' . $key . '][]';
                                $opt_row['value'] = str_replace('%%value%%', '', $opt_row['value']);
                                $opt[0][] = $opt_row;
                            }
                        }
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= $this->interface->cf_row_template($row, $opt);
                        unset($row);
                        unset($opt);
                    }
                    if($heading['id'] == 'form_settings') {
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= '</ul>';
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= $this->optigen->$add_button['type']($add_button);
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= $this->optigen->$prev_button['type']($prev_button);
                    }
                    foreach($heading['options'] as $option) {
                        if($heading['id'] == 'form_settings') continue;
                        if($option['id'] == 'tf_cf_mess_submit') {
                            $option['value'] = $form['submit_mess'];
                        }
                        if($option['id'] == 'tf_cf_shortcode') {
                            $option['value'] = str_replace('%%form_id%%',$id,$option['value']);
                        }
                        if($option['id'] == 'tf_cf_formname_input') {
                            $option['value'] = $form['form_name'];
                        }
                        if($option['id'] == 'tf_cf_form_template') {
                            $option['value'] = $form['form_template'];
                        }
                        if ($option['id'] == 'tf_cf_heading_text' && isset($form['header_message'])) {
                            $option['value'] = $form['header_message'];
                        }
                        if($option['id'] == 'tf_cf_email_template') {
                            $option['value'] = $form['email_template'];
                        }
                        if($option['id'] == 'tf_cf_mess_reset' && isset($form['reset_button'])) {
                            $option['value'] = $form['reset_button'];
                        }
                        if($option['id'] == 'tf_cf_succ_mess') {
                            $option['value'] = $form['succes_mess'];
                        }
                        if($option['id'] == 'tf_cf_succ_mess') {
                            $option['value'] = $form['succes_mess'];
                        }
                        if($option['id'] == 'tf_cf_required_text') {
                            $option['value'] = $form['required_text'];
                        }
                        if($option['id'] == 'tf_cf_failure_mess') {
                            $option['value'] = $form['fail_mess'];
                        }
                        if($option['id'] == 'tf_cf_email_from') {
                            $option['value'] = $form['email_from'];
                        }
                        if($option['id'] == 'tf_cf_email_to') {
                            $option['value'] = $form['email_to'];
                        }
                        if($option['id'] == 'tf_cf_email_subject') {
                            $option['value'] = $form['email_subject'];
                        }
                        if($option['id'] == 'tf_cf_position') {
                            $option['value'] = $form['position'];
                        }
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= $this->interface->meta_box_row_template($option);
                    }
                } else {
                    if($heading['id'] == 'form_settings') {
                        foreach($heading['options'] as $key => $option) {
                            if(!is_array($option)) continue;
                            if($option['id'] == 'tf_cf_input_required') {
                                $heading['options'][$key]['id'] .= '_0';
                            }
                            if($option['id'] == 'tf_cf_input_newline') {
                                $heading['options'][$key]['id'] .= '_0';
                            }
                            if($option['id'] == 'tf_cf_input_options[]') {
                                $heading['options'][$key]['value'] = '';
                                $heading['options'][$key]['properties']['class'] = str_replace('%%visible%%', 'hidden', $heading['options'][$key]['properties']['class']);
                            }
                            if($option['id'] == 'tf_cf_toggle_show') {
                                $heading['options'][$key]['id'] .= ' hidden';
                            }
                            if($option['id'] == 'tf_cf_shortcode_row') {
                                $heading['options'][$key]['value'] = str_replace('%%code%%','[]',$option['value']);
                            }
                        }
                        foreach($heading['options_row'] as $opt_row) {
                            $opt_row['id'] .= '[0][]';
                            $opt_row['value'] = str_replace('%%value%%', '', $opt_row['value']);
                            $opt[0][] = $opt_row;
                        }
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= $this->interface->cf_row_template($form_labels) . '<div class="tfclear divider" style="margin-bottom:0 !important;"></div>';
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= '<ul class="ui-sortable" id="cf_form_elements">';
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= $this->interface->cf_row_template($heading['options'], $opt);
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= '</ul>';
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= $this->optigen->$add_button['type']($add_button);
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= $this->optigen->$add_button['type']($prev_button);
                    } else {
                        foreach($heading['options'] as $option) {
                            if($option['id'] == 'tf_cf_shortcode') {
                                if(is_array($this->defined_forms) && count($this->defined_forms)>0){
                                    end($this->defined_forms);
                                    $k=key($this->defined_forms);
                                    $k++;
                                } else {
                                    $k=0;
                                }
                                $option['value'] = str_replace('%%form_id%%',$k,$option['value']);
                            }
                            $admin_meta_boxes[$tab['id']][$heading['name']] .= $this->interface->meta_box_row_template($option);
                        }
                    }
                }
            }
            $admin_meta_boxes[$tab['id']]['buttons'] = '';
            foreach($tab['buttons'] as $button) {
                if($button['id'] == 'cf_save_form_button') {
                    if(!$this->request->isset_GET('id')) {
                        $button['value'] = __('Create form', 'tfuse');
                    }
                }
                $admin_meta_boxes[$tab['id']]['buttons'] .= $this->optigen->$button['type']($button);
            }
        }
        return $admin_meta_boxes;
    }

    function get_form_gen_options()
    {
        $admin_meta_boxes = array();
        $gen_options = $this->model->get_forms_gen_options();
        $options = $this->get->ext_options($this->_the_class_name, strtolower($this->_the_class_name));
        $is_smtp = (@$gen_options['mail_type'] == 'smtp') ? true : false;
        foreach($options['tabs'] as $tab) {
            if($tab['id'] == 'add_edit_forms' || $tab['id'] == 'tf_cf_messages_settings') continue;
            foreach($tab['headings'] as $heading) {
                $admin_meta_boxes[$tab['id']][$heading['name']] = '';
                foreach($heading['options'] as $option) {
                    if($gen_options) {
                        if($option['id'] == 'tf_cf_mail_type') {
                            $option['value'] = $gen_options['mail_type'];
                        }
                        if($option['id'] == 'tf_cf_secure_conn') {
                            $option['value'] = $gen_options['secure_conn'];
                        }
                        if($option['id'] == 'tf_cf_smtp_host') {
                            $option['value'] = $gen_options['smtp_host'];
                        }
                        if($option['id'] == 'tf_cf_smtp_port') {
                            $option['value'] = $gen_options['smtp_port'];
                        }
                        if($option['id'] == 'tf_cf_smtp_user') {
                            $option['value'] = $gen_options['smtp_user'];
                        }
                        if($option['id'] == 'tf_cf_smtp_pwd') {
                            $option['value'] = $gen_options['smtp_pwd'];
                        }
                    }
                    if(!$is_smtp && $option['id'] != 'tf_cf_mail_type') {
                        if(isset($option['properties']['class'])) {
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
            foreach($tab['buttons'] as $button) {
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

    function redirect_if_id_invalid($_id){
        if (!isset($this->defined_forms[$_id]))
            wp_redirect(get_admin_url() . 'admin.php?page=tf_contact_forms_list');
    }

}