<?php
include_once str_replace("\\","/",get_template_directory()).'/inc/init.php';
class webnus_subscribe_widget extends WP_Widget{
	function __construct(){
		$params = array(
		'description'=> 'Email Subscribe',
		'name'=> 'Webnus - Subscribe'
		);
		parent::__construct('webnus_subscribe_widget', '', $params);
	}
	public function form($instance){
		extract($instance);
		$defaults = array('type' => 'FeedBurner',);
		$instance = wp_parse_args((array) $instance, $defaults);
		?>
		<p><label for="<?php echo $this->get_field_id('title') ?>">Title:</label><input type="text" class="widefat" id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title') ?>" value="<?php if( isset($title) )  echo esc_attr($title); ?>"/></p>
		
		<p><label for="<?php echo $this->get_field_id('type'); ?>">Subscribe Service:</label>
		<select id="<?php echo $this->get_field_id('type'); ?>" name="<?php echo $this->get_field_name('type'); ?>" class="widefat" style="width:100%;">
		<option <?php if('FeedBurner' == $instance['type']) echo 'selected="selected"'; ?>>FeedBurner</option>
		<option <?php if('MailChimp' == $instance['type']) echo 'selected="selected"'; ?>>MailChimp</option>
		</select></p>
		
		<p><label for="<?php echo $this->get_field_id('id') ?>">Feedburner ID:</label>	<input type="text"	class="widefat"	id="<?php echo $this->get_field_id('id') ?>" name="<?php echo $this->get_field_name('id') ?>" value="<?php if( isset($id) )  echo esc_attr($id); ?>"/></p>
		
		<p><label for="<?php echo $this->get_field_id('url') ?>">Mailchimp form action URL:</label>	<input type="text"	class="widefat"	id="<?php echo $this->get_field_id('url') ?>" name="<?php echo $this->get_field_name('url') ?>" value="<?php if( isset($url) )  echo esc_attr($url); ?>"/></p>
		
		
		<p><label for="<?php echo $this->get_field_id('text') ?>">Custom text:</label><textarea class="widefat"	id="<?php echo $this->get_field_id('text') ?>" name="<?php echo $this->get_field_name('text') ?>"
		><?php if( isset($text) )  echo esc_attr($text); ?></textarea></p>
		
		

		<?php 
	}

	public function widget($args, $instance){
		
		extract($args);
		extract($instance);
		
		echo $before_widget;
		if(!empty($title)) echo $before_title.$title.$after_title;

		$feedburner_id = esc_html($id);
		$mailchimp_url = esc_url($url);
		$subscribe_text = esc_html($text);

		if($type =='FeedBurner'){ 
			$email_name='email';
			echo '<form class="widget-subscribe-form" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onSubmit="window.open(\'http://feedburner.google.com/fb/a/mailverify?uri='.$feedburner_id.'\', \'popupwindow\', \'scrollbars=yes,width=550,height=520\');return true"><input type="hidden" value="'.$feedburner_id.'" name="uri"/><input type="hidden" name="loc" value="en_US"/>';
		}else{ 
			$email_name='MERGE0';
			echo '<form class="widget-subscribe-form" action="'.$mailchimp_url.'" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" target="_blank">';
		}
		echo '<p>'.$subscribe_text.'</p><input placeholder="'.__('your email here..','WEBNUS_TEXT_DOMAIN').'" class="widget-subscribe-email" type="text" name="'.$email_name.'"/><button class="widget-subscribe-submit" type="submit">'.__('SUBSCRIBE ','WEBNUS_TEXT_DOMAIN').'</button></form>';

		
$o = new webnus_options();
echo $after_widget;
} 
}

add_action('widgets_init', 'register_webnus_subscribe'); 
function register_webnus_subscribe(){
	
	register_widget('webnus_subscribe_widget');
	
}