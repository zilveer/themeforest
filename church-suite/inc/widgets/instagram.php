<?php include_once str_replace("\\","/",get_template_directory()).'/inc/init.php';
class WebnusInstagramWidget extends WP_Widget{
	function __construct(){
		$params = array('description'=> 'Your recent posts from instagram will be displayed','name'=> 'Webnus-Instagram');
		parent::__construct('WebnusInstagramWidget', '', $params);
	}
	public function form($instance){
		extract($instance);
		$defaults = array('type' => 'Username',);
		$instance = wp_parse_args((array) $instance, $defaults);
		?>
		<p><label for="<?php echo $this->get_field_id('title') ?>">Title:</label><input type="text"	class="widefat"	id="<?php echo $this->get_field_id('title') ?>"	name="<?php echo $this->get_field_name('title') ?>"	value="<?php if( isset($title) )  echo esc_attr($title); ?>"/></p>
		<p><label for="<?php echo $this->get_field_id('type'); ?>">Recent media published by:</label><select id="<?php echo $this->get_field_id('type'); ?>" name="<?php echo $this->get_field_name('type'); ?>" class="widefat" style="width:100%;"><option <?php if ('Username' == $instance['type']) echo 'selected="selected"'; ?>>Username</option><option <?php if ('Hashtag' == $instance['type']) echo 'selected="selected"'; ?>>Hashtag</option>		</select></p>
		<p><label for="<?php echo $this->get_field_id('username') ?>">Instagram Username/Hashtag:</label><input type="text" class="widefat" id="<?php echo $this->get_field_id('username') ?>" name="<?php echo $this->get_field_name('username') ?>" value="<?php if( isset($username) )  echo esc_attr($username); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('token') ?>">Instagram Access Token:</label><input type="text" class="widefat" id="<?php echo $this->get_field_id('token') ?>" name="<?php echo $this->get_field_name('token') ?>" value="<?php if( isset($token) ) echo esc_attr($token); ?>" /><small>Get the this information <a target="_blank" href="http://www.pinceladasdaweb.com.br/instagram/access-token/">here</a>.</small></p>
		<p><label for="<?php echo $this->get_field_id('count') ?>">Feed Count(Max 20):</label><input type="text" class="widefat" id="<?php echo $this->get_field_id('count') ?>" name="<?php echo $this->get_field_name('count') ?>" value="<?php if( isset($count) )  echo esc_attr($count); ?>" /></p>
	<?php }
	public function widget($args, $instance){
		extract($args);
		extract($instance);
		echo $before_widget;
		if(!empty($title))
			echo $before_title.$title.$after_title; 
		if(!empty($username) && !empty($token) ){ ?>
			<div class="instagram-feed">
			<?php 
			$base_url =  "https://api.instagram.com/v1/". (($type=='Username')? 'users':'tags') ."/search?q=" . $username . "&access_token=" . $token . "&count=1&callback=?";	
			$raw_content = wp_remote_get(esc_url_raw($base_url));
			
			if(!is_wp_error($raw_content)){
				$raw_content = $raw_content['body'];
				$json_insta = json_decode($raw_content);
				$data =(($type=='Username')? 'id':'name');
				if (isset($json_insta->data[0])){
				   $id = $json_insta->data[0]->$data;
				}
				if(!empty($id)){
				$url = "https://api.instagram.com/v1/". (($type=='Username')? 'users':'tags') ."/" . $id  ."/media/recent/?access_token=" . $token . "&count=" . $count . "&callback=?";				
				$raw_content = wp_remote_get(esc_url_raw($url));					
				$output = '';
				if(!is_wp_error($raw_content)){
					$output .= '<ul>';	
					$raw_content = $raw_content['body'];
					$json_insta = json_decode($raw_content);
					if (isset($json_insta->data[0])){
						foreach($json_insta->data as $data){		
							$output .= '<li><a href="'.$data->link.'" target="_blank"><img alt="" src="'.$data->images->thumbnail->url.'"/></a></li>';
						}
					}
					$output .= '</ul>';	
					echo $output;
					}
				}
			}
			else
				echo esc_html__('An error has occoured...','webnus_framework');
			?>
			<div class="clear"></div>
			</div>	 
		<?php } echo $after_widget;
	} 
}
add_action('widgets_init','register_webnus_instagram_widget'); 
function register_webnus_instagram_widget(){
	register_widget('WebnusInstagramWidget');
}