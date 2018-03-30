<?php
class TMM_Mail_Subscription {
    
    public static $slug = 'email_subscriber';
    
    public static function init() {
		add_filter("manage_email_subscriber_posts_columns", array(__CLASS__, "show_edit_columns"));		
	}
    
    public static function admin_init() {
        self::init_meta_boxes();
	}

    public static function init_meta_boxes() {
        add_meta_box("zipcode", __("Zip Code", 'diplomat'), array(__CLASS__, 'zipcode_field'), self::$slug, "normal", "low");
    }

    public static function zipcode_field() {
        global $post;
        $zipcode = get_post_meta($post->ID, 'tmm_zipcode', true);
        ?>
        <input type="hidden" value="1" name="tmm_meta_saving" />
        <input type="text" name="tmm_zipcode" value="<?php echo esc_attr($zipcode); ?>" />
        <?php
    }

    public static function get_string_option($name){       
        switch ($name){
            case 'info_failed_subscription':
                $option = esc_html__('This subscription cant be completed, sorry.', 'diplomat');
                break;
            case 'info_failed_unsubscription':
                $option = esc_html__('Please check the email address.', 'diplomat');
                break;
            case 'subscribe_zip_validation':
                $option = esc_html__('Please check the zip code field.', 'diplomat');
                break;
            default:
	            $option = esc_html(TMM::get_option($name));
                break;
        }
        
        return $option;
    }
    
    public static function save_post($post_id) {

        global $post;
        if (is_object($post)) {
            if (isset($_POST) AND !empty($_POST) AND $post->post_type == self::$slug) {
                update_post_meta($post->ID, "tmm_zipcode", @$_POST["tmm_zipcode"]);
            }
        }

        $slug = 'post';
        $recepient_mails = array();
        $post = get_post($post_id);       
                
        if ( $slug != $post->post_type || $post->post_date != $post->post_modified || wp_is_post_revision($post_id) || $post->post_status=='auto-draft' || $post->post_status=='draft') {
            return;
        }   
        
        $post_title = $post->post_title;
        $post_url = get_permalink($post_id);
        
		$args = array(
                'numberposts' => -1,
                'post_type' => self::$slug,
                'suppress_filters' => false
        );
        
        $subscribers = get_posts($args);        
        
        
        if (!empty($subscribers)){
            foreach ($subscribers as $subscriber){
                $recepient_mails[] = $subscriber->post_title;
            }
        }
                
        if (!empty($recepient_mails)){
            foreach ($recepient_mails as $email){
                $errors = array();
                $subject = self::get_string_option('new_post_subject');
                $unsubscribe_link = site_url().'?action=unsubscribe_request&email='.$email;
                $messagebody = self::get_string_option('new_post_message');
                
                $replacements = array();                
                $replacements['post_title'] = $post_title;
                $replacements['unsubscribe_link'] = $unsubscribe_link;
                $replacements['post_url'] = $post_url;
                $replacements['site_url'] = get_bloginfo('name');
                
                $messagebody = self::prepare_message($messagebody, $replacements);
                $subject = self::prepare_message($subject, $replacements);
                
                $add_post = true;
                self::send_email($email, $subject, $messagebody, $errors, $add_post);
            }
        }    
        
    }
    
    public static function prepare_message($str, $post){
        $replacements=array(
            '%post_title%' => $post['post_title'],	
            '%unsubscribe_url%' => $post['unsubscribe_link'],	
            '%post_url%' => $post['post_url'],        
            '%site_url%' => $post['site_url'],        
            '%n%' => '<br>'
        );
        $str=str_replace(
				array_keys($replacements),
				array_values($replacements),
				$str
		);

        return $str;
    }

    public static function show_edit_columns($columns) {
		$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => esc_html__("Email address", 'diplomat')
		);

		return $columns;
	}
    
    public static function subscribe_request(){
        $data = array();
		parse_str($_REQUEST['values'], $data);
		$errors = array();
        $result = array();
        $email = "";
        $zipcode = "";
        $subject = self::get_string_option('subscribe_subject');
        $messagebody = self::get_string_option('subscribe_message');
        
        if (!is_email($data['subscriber_email'])) {
            $errors['is_errors'] = self::get_string_option('subscribe_mail_validation');
            echo json_encode($errors);
            die();
        }else{
            $email = $data['subscriber_email'];
        }

        if (isset($data['zipcode']) && !ctype_digit($data['zipcode'])){
            $errors['is_errors'] = self::get_string_option('subscribe_zip_validation');
            echo json_encode($errors);
            die();
        }else{
            if (isset($data['zipcode']))
                $zipcode = $data['zipcode'];
        }

        if (empty($errors)){
            
            $args = array(
                'numberposts' => -1,
                'post_type' => self::$slug,
                'suppress_filters' => false
            );
        
            $subscribers = get_posts($args);
            
            foreach ($subscribers as $subscriber){
                if ($subscriber->post_title==$email){
                    $result['info'] = self::get_string_option('info_already_subscribed');
                    echo json_encode($result);
                    die();
                }
            }
            
            $result = self::add_subscriber($email, $zipcode);
        }
        
        $dummy = new TMM_Mail_Subscription_Widget();
        $settings = $dummy->get_settings();
            
        
        $unsubscribe_link = site_url().'?action=unsubscribe_request&email='.$email;
        $replacements = array();       
        $replacements['unsubscribe_link'] = $unsubscribe_link;        
        $replacements['site_url'] = get_bloginfo('name');
        $replacements['post_title'] = '';                
        $replacements['post_url'] = '';
        
        $subject = self::prepare_message($subject, $replacements);
        $messagebody = self::prepare_message($messagebody, $replacements);
        
        self::send_email($email, $subject, $messagebody, $errors);
        echo json_encode($result);
        die();
    }
    
    public static function unsubscribe_request(){
        $email = $_REQUEST['email'];
        $errors = array();

        if (!is_email($email)) {
            $errors['is_errors'] = self::get_string_option('info_failed_unsubscription');
            echo json_encode($errors);
            die();
        }
        if (empty($errors)){
            self::remove_subscriber($email);
        }        
        
    }

    public static function add_subscriber($email, $zipcode){
        $result = array();
        $subscriber = array(
            'post_title' => wp_strip_all_tags($email),                       
            'post_status' => 'publish',  
            'post_type' => self::$slug
        );
        
        $insert = wp_insert_post($subscriber);

        if(!empty($zipcode)){
            update_post_meta($insert, "tmm_zipcode", $zipcode);
        }

        $result["info"] = ($insert!=false) ? self::get_string_option('info_successfully_subscribed') : self::get_string_option('info_failed_subscription');
        return $result; 
    }
    
    public static function remove_subscriber($email){
        $result = array();
        $args = array(
            'numberposts' => -1,
            'post_type' => self::$slug,
            'name' => $email
        );
        $posts = get_posts($args);       
       
        $result["info"] = self::get_string_option('info_failed_unsubscription');
        
        if (!empty($posts)){
            foreach ($posts as $post){
                $delete = wp_delete_post($post->ID, true);                
                
                if ($delete!=false){
                    $result["info"] = self::get_string_option('info_success_unsubscription');
                }
            }
        }
        
        echo json_encode($result);
        die();
    }

    public static function send_email($email, $subject, $messagebody, $errors, $add_post=false){

        $pre_messagebody_info = "";
        $headers = "";
               
        /* check errors */
		if (!empty($errors)) {
			$result['is_errors'] = 1;
			$result['hash'] = md5(time());
			$result['info'] = $errors;
			echo json_encode($result);
			exit;
		}
        
        /* check subject */
		if (empty($subject)) {
			$subject = __("Email from subscribe form", 'diplomat');
		}

		/* set message */
		$after_message = "\r\n<br />--------------------------------------------------------------------------------------------------\r\n<br /> " . __('This mail was sent via', 'diplomat') . " " . site_url() . " " . __('subscribe form', 'diplomat');
		$messagebody = $pre_messagebody_info . nl2br($messagebody) . $after_message;

		/* set admin email  */
		
		$admin_mail = get_bloginfo('admin_email');		

		/* set headers */
		if($admin_mail) {
			$headers .= 'From: '. $admin_mail . "\r\n";
		}

		add_filter('wp_mail_content_type', array(__CLASS__, 'set_html_content_type'));
		add_filter('wp_mail_from_name', array(__CLASS__, 'set_mail_from_name'));

        /* send email */
		if (wp_mail($email, $subject, $messagebody, $headers)) {
			$result["info"] = "success";
		} else {
			$result["info"] = "server_fail";
		}

		remove_filter('wp_mail_content_type', array(__CLASS__, 'set_html_content_type'));
		remove_filter('wp_mail_from_name', array(__CLASS__, 'set_mail_from_name'));

        if ($add_post){
            return;
        }

		$result['hash'] = md5(time());
        
    }

	public static function set_mail_from_name($name) {
		return get_option('blogname');
	}

	public static function set_html_content_type() {
		return 'text/html';
	}
    
}
