<?php

/**
 * Instagrm_Feed_Widget Class
 */
class widget_instagram extends WP_Widget {
	/** constructor */
	//function __construct() {
	//	parent::WP_Widget( /* Base ID */'instagrm_widget', /* Name */'Instagram Widget for WordPress', array( 'description' => 'A widget to display a users instagrm feed' )// );
	//}
	function widget_instagram() {
        $options = array( 'classname' => 'instagram_widget', 'description' => __('Instagram Widget' , 'cosmotheme' ) );
        parent::__construct( 'widget_cosmo_instagram' , _TN_ . ' : ' . __( 'Instagram Widget' , 'cosmotheme' )  , $options );

    }
	/* WP_Widget::widget */
	function widget( $args, $instance ) {
		extract( $args );
		//get widget information to display on page
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		if(isset($instance['user_id'])){
			$user_id = apply_filters( 'widget_title', $instance['user_id'] );	
		}else{
			$user_id = '';
		}
		
		if(isset($instance['access_token'])){
			$access_token = apply_filters( 'widget_title', $instance['access_token'] );
		}else{
			$access_token = '';
		}
		
		if(isset($instance['picture_number'])){
			$picture_number = apply_filters( 'widget_title', $instance['picture_number'] );
		}else{
			$picture_number = 0;
		}
		
		if(isset($instance['link_images'])){
			$picture_size = apply_filters( 'widget_title', $instance['picture_size'] );
		}else{
			$picture_size = 'thumbnail';
		}
		
		if(isset($instance['link_images'])){
			$link_images = apply_filters( 'widget_title', $instance['link_images'] );
		}else{
			$link_images = false;
		}
		
		if(isset($instance['link_images'])){
			$show_likes = apply_filters( 'widget_title', $instance['show_likes'] );
		}else{
			$show_likes = false;
		}

		if(isset($instance['link_images'])){
			$show_caption = apply_filters( 'widget_title', $instance['show_caption'] );
		}else{
			$show_caption = false;	
		}
		
		if(isset($instance['debug_mode'])){
			$debug_mode = apply_filters( 'widget_title', $instance['debug_mode'] );
		}else{
			$debug_mode = false;
		}
		
		echo $before_widget;
		if ( $title ){
			echo $before_title . $title . $after_title;
		};
		
		if($debug_mode){
			
			// Check requirements
        	if (extension_loaded('curl')){
				$curl_ver = curl_version();
				echo '<p>Curl is <b>Enabled</b></p>'; 
				echo '<p>Curl Version Number:<br />'.$curl_ver['version_number'].'</p>';
				echo '<p>User ID:<br />'.$user_id.'</p>'; 
				echo '<p>Access Token:<br /><span style="word-wrap:break-word;width:100px;">'.$access_token.'</span></p>'; 
				$results = $this->get_recent_data($user_id,$access_token);
				echo '<p><b>Results</b>:</p>';  //var_dump($results);
				foreach($results['meta'] as $key => $val){
					echo "<p>".$key.": ".$val."</p>";
				}
			}else{
				echo '<p>Curl is <b>NOT</b> Enabled</p>'; 
			}
			return;
		}
		
		?>
		<style>
			.instagram_likes,.instagram_caption{
				margin-bottom: 0px !important;
			}
			#instagram_widget li{
				margin-bottom: 10px;
			}
		</style>
		<?php
		$results = $this->get_recent_data($user_id,$access_token);
		
		$i=1;
		echo "<ul id='instagram_widget' class='widget-list'>";
		echo '<div class="widget-delimiter">&nbsp;</div>';
		if(!empty($results['data'])){
			foreach($results['data'] as $item){
				if($picture_number == 0){

					echo sprintf(__('%s Please set the Number of images to show within the widget %s','cosmotheme'),'<strong>', '</strong>');
					break;
				}

				
				echo "<li>";
				echo '<div class="relative">';
				if(!empty($link_images)){
					echo "<a href='".$item['link']."' target='_blank'><img src='".$item['images'][$picture_size]['url']."' alt='".$title." image'/></a>";
				}else{
					echo "<img src='".$item['images'][$picture_size]['url']."' alt=''/>";
				}
				if($show_likes){
					if(!empty($item['likes']['count'])){
						echo "<p class='instagram_likes'>".__('Likes:','cosmotheme')." <span class='likes_count'>".$item['likes']['count']."</span></p>";
					}
				}
				echo '</div>';
				if($show_caption){
					if(!empty($item['caption']['text'])){
						echo "<p class='instagram_caption'>".$item['caption']['text']."</p>";
					}
				}
				echo "</li>";
				if($i == $picture_number){
					echo "</ul>";
					break;
				}else{
					$i++;
				}
			}
		}else{
			echo "<strong>".__('The user currently does not have any images...','cosmotheme')."</strong>";			
		}
		echo $after_widget;
	}

	/* WP_Widget::update */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		//update setting with information form widget form
		$instance['title'] = strip_tags($new_instance['title']);
		
		$instance['access_token'] = strip_tags($new_instance['access_token']);
		$instance['user_id'] = strip_tags($new_instance['user_id']);
		
		
		$instance['picture_number'] = strip_tags($new_instance['picture_number']);
		$instance['picture_size'] = strip_tags($new_instance['picture_size']);
		$instance['link_images'] = strip_tags($new_instance['link_images']);
		
		$instance['show_likes'] = strip_tags($new_instance['show_likes']);
		$instance['show_caption'] = strip_tags($new_instance['show_caption']);
		
		$instance['debug_mode'] = strip_tags($new_instance['debug_mode']);
		
		return $instance;
	}

	/* WP_Widget::form */
	function form( $instance ) {
		if ( $instance ) {
			$title = esc_attr( $instance[ 'title' ] );
			
			if(isset($instance[ 'access_token' ])){
				$access_token = esc_attr( $instance[ 'access_token' ] );	
			}else{
				$access_token = '';
			}
			
			if(isset($instance[ 'user_id' ])){
				$user_id = esc_attr( $instance[ 'user_id' ] );
			}else{
				$user_id = '';
			}
			
			if(isset($instance[ 'picture_number' ])){
				$picture_number = esc_attr( $instance[ 'picture_number' ] );
			}else{
				$picture_number = 4;
			}

			if(isset($instance[ 'picture_size' ])){
				$picture_size = esc_attr( $instance[ 'picture_size' ] );
			}else{
				$picture_size = 'thumbnail';
			}
			
			if(isset($instance[ 'show_likes' ])){
				$show_likes = esc_attr( $instance[ 'show_likes' ] );
			}else{
				$show_likes = false;
			}

			if(isset($instance[ 'show_caption' ])){
				$show_caption = esc_attr( $instance[ 'show_caption' ] );
			}else{
				$show_caption = false;
			}
			
			if(isset($instance[ 'link_images' ])){
				$link_images = esc_attr( $instance[ 'link_images' ] );
			}else{
				$link_images = false;
			}

			
			if(isset($instance[ 'debug_mode' ])){
				$debug_mode = esc_attr( $instance['debug_mode'] );
			}else{
				$debug_mode = false;
			}
			
		}
		else {
			$title = __( 'Title', 'cosmotheme' );
			$username = __( 'Username', 'cosmotheme' );
			$access_token = __( 'Access Token', 'cosmotheme' );
			$user_id = __( 'User ID', 'cosmotheme' );
			$picture_size = 'thumbnail';
			$picture_number = 0;
			$show_likes = false;
			$show_caption = false;
			$link_images = false;
			$debug_mode = false;
		}
		
		
		$client_id = '708d95d99a58482e8bd9122263f994b5';
		$client_secrete = '5221aaadfde544829ae09b552d1df32e';
		$redirect_uri = 'http://cosmothemes.com/instagram/';
		$token_url = 'https://api.instagram.com/oauth/authorize/?client_id='.$client_id.'&redirect_uri='.$redirect_uri.'&response_type=code';


		$picture_sizes = array('thumbnail' => 'Thumbnail', 'low_resolution' => 'Low Resolution','standard_resolution' => 'Standard Resolution');
		?>
		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','cosmotheme'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('user_id'); ?>"><?php _e('User ID:','cosmotheme'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id('user_id'); ?>" name="<?php echo $this->get_field_name('user_id'); ?>" type="text" value="<?php echo $user_id; ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('access_token'); ?>"><?php _e('Access Token:','cosmotheme'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id('access_token'); ?>" name="<?php echo $this->get_field_name('access_token'); ?>" type="text" value="<?php echo $access_token; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('picture_number'); ?>"><?php _e('Number of Images:','cosmotheme'); ?></label> 
			<select id="<?php echo $this->get_field_id('picture_number'); ?>" name="<?php echo $this->get_field_name('picture_number'); ?>">
					<option value="0"><?php _e('Select Number','cosmotheme'); ?></option>
				<?php for($i=1;$i<11;$i++):?>
					<option value="<?php echo $i;?>" <?php if($i == $picture_number){echo 'selected="selected"';};?>><?php echo $i;?></option>
				<?php endfor;?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('picture_size'); ?>"><?php _e('Picture Size:','cosmotheme'); ?></label> 
			<select id="<?php echo $this->get_field_id('picture_size'); ?>" name="<?php echo $this->get_field_name('picture_size'); ?>">
					<?php foreach($picture_sizes as $item => $val):?>
						<option value="<?php echo $item;?>" <?php if($item == $picture_size){echo 'selected="selected"';};?>><?php echo $val;?></option>
					<?php endforeach;?>
			</select>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('link_images'); ?>"><?php _e('Link images to full image:','cosmotheme'); ?></label> 
		<input class="" id="<?php echo $this->get_field_id('link_images'); ?>" name="<?php echo $this->get_field_name('link_images'); ?>" type="checkbox" <?php echo (($link_images)? "CHECKED":''); ?> />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('show_likes'); ?>"><?php _e('Show Likes:','cosmotheme'); ?></label> 
		<input class="" id="<?php echo $this->get_field_id('show_likes'); ?>" name="<?php echo $this->get_field_name('show_likes'); ?>" type="checkbox" <?php echo (($show_likes)? "CHECKED":''); ?> />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('show_caption'); ?>"><?php _e('Show Caption:','cosmotheme'); ?></label> 
		<input class="" id="<?php echo $this->get_field_id('show_caption'); ?>" name="<?php echo $this->get_field_name('show_caption'); ?>" type="checkbox" <?php echo (($show_caption)? "CHECKED":''); ?> />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('debug_mode'); ?>"><?php _e('Debug Mode:','cosmotheme'); ?></label> 
		<input class="" id="<?php echo $this->get_field_id('debug_mode'); ?>" name="<?php echo $this->get_field_name('debug_mode'); ?>" type="checkbox" <?php echo (($debug_mode)? "CHECKED":''); ?> />
		</p>

		<?php
			$token_msg = sprintf(__('If you do not have an ID or access token, please visit %s Get Access token %s to receive a valid token','cosmotheme'),'<a href="'.$token_url.'" target="_blank">', '</a>');
		?>
		<p><?php echo $token_msg; ?></p>
		<?php 
	}
	 
	function get_recent_data($user_id, $access_token){

		$apiurl = "https://api.instagram.com/v1/users/".$user_id."/media/recent/?access_token=".$access_token;

		$response = wp_remote_get( $apiurl, array('sslverify' => false) );
		if(is_wp_error($response)){
			echo $response->get_error_message();
			return;
		}else{
			$data = json_decode( $response['body'], true );	
		}
		

		return $data;
	}

	

} // class Instagrm_Feed_Widget

// register Instagrm widget

?>