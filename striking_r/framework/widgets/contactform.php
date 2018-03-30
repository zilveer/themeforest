<?php
/**
 * Contact Form Widget Class
 */
if (!class_exists('Theme_Widget_Contact_Form')) {
class Theme_Widget_Contact_Form extends WP_Widget {

	public function __construct(){
		$widget_ops = array('classname' => 'widget_contact_form', 'description' => __( 'Displays a email contact form.', 'theme_admin') );
		parent::__construct('contact_form', THEME_SLUG.' - '.__('Contact Form', 'theme_admin'), $widget_ops);
		
		if ('widgets.php' == basename($_SERVER['PHP_SELF'])) {
			add_action( 'admin_print_scripts', array(&$this, 'add_admin_script') );
		}
		if ( is_active_widget(false, false, $this->id_base) ){
			add_action( 'wp_print_scripts', array(&$this, 'add_script') );
		}
	}
	
	function add_script(){
		wp_enqueue_script( 'jquery-tools-validator');
	}
	function add_admin_script(){
		wp_enqueue_script('init-widget-color',THEME_ADMIN_ASSETS_URI . '/js/init-widget-color.js',array('jquery','jquery-colorinput'));
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Email Us', 'striking-r') : $instance['title'], $instance, $this->id_base);
		$email= $instance['email'];
		$email = str_replace('@','*',$email);
		if(isset($instance['bgColor'])){
			$bgColor = $instance['bgColor']?' style="background-color:'.$instance['bgColor'].'"':'';
		}else{
			$bgColor = '';
		}
		if(isset($instance['textColor'])){
			$textColor = $instance['textColor']?' style="color:'.$instance['textColor'].'"':'';
		}else{
			$textColor = '';
		}
		if(empty($success)){
			$success = __('Your message was successfully sent. <strong>Thank You!</strong>','striking-r');
		}

		echo $before_widget;
		if ( $title)
			echo $before_title . $title . $after_title;
		
		//$action = $include_path.'/sendmail.php';
		$action = esc_url(add_query_arg(array()));
		?>
		<p style="display:none;"><?php _e('Your message was successfully sent. <strong>Thank You!</strong>','striking-r');?></p>
		<form class="contact_form" action="<?php echo $action;?>" method="post" novalidate="novalidate">
			<p><input type="text" required="required" id="contact_name" name="contact_name" class="text_input" value="" size="22" tabindex="21" />
			<label for="contact_name"><?php _e('Name *', 'striking-r'); ?></label></p>
			
			<p><input type="email" required="required" id="contact_email" name="contact_email" class="text_input" value="" size="22" tabindex="22"  />
			<label for="contact_email"><?php _e('Email *', 'striking-r'); ?></label></p>
			
			<p><textarea required="required" name="contact_content" class="textarea" cols="30" rows="5" tabindex="23"></textarea></p>
			
			<p><button type="submit"<?php echo $bgColor;?> class="<?php echo apply_filters( 'theme_css_class', 'button' );?> white"><span<?php echo $textColor;?>><?php _e('Submit', 'striking-r'); ?></span></button></p>
			<input type="hidden" value="<?php echo $email;?>" name="contact_to"/>
			<input type="hidden" value="1" name="theme_contact_form_submit"/>
		</form>
		<?php
		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['email'] = strip_tags($new_instance['email']);
		$instance['bgColor'] = strip_tags($new_instance['bgColor']);
		$instance['textColor'] = strip_tags($new_instance['textColor']);

		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$email = isset($instance['email']) ? esc_attr($instance['email']) :get_bloginfo('admin_email');
		$bgColor = isset($instance['bgColor']) ? esc_attr($instance['bgColor']) : '';
		$textColor = isset($instance['textColor']) ? esc_attr($instance['textColor']) : '';
	?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('Your Email:', 'theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('bgColor'); ?>"><?php _e('Submit Button Background Color:', 'theme_admin'); ?></label>
		<input class="widefat color" style="width:80%" id="<?php echo $this->get_field_id('bgColor'); ?>" name="<?php echo $this->get_field_name('bgColor'); ?>" type="text" data-hex="true" value="<?php echo $bgColor; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('textColor'); ?>"><?php _e('Submit Button Text Color:', 'theme_admin'); ?></label>
		<input class="widefat color" style="width:80%" id="<?php echo $this->get_field_id('textColor'); ?>" name="<?php echo $this->get_field_name('textColor'); ?>" type="text" data-hex="true" value="<?php echo $textColor; ?>" /></p>
<?php
	}
}
}