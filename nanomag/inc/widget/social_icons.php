<?php
add_action('widgets_init','jellywp_social_icons');


function jellywp_social_icons(){
		register_widget("jellywp_social_icons_widget");
}

class jellywp_social_icons_widget extends WP_widget{

/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/

	function jellywp_social_icons_widget(){
		$widget_ops = array( 'classname' => 'jellywp_social_icons_widget', 'description' => esc_attr__( 'Social icons widget' , 'nanomag') );
		parent::__construct('jellywp_social_icons_widget', esc_attr__('jellywp: Social icons widget', 'nanomag'), $widget_ops);
	}

/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
	function widget($args,$instance){
	extract($args);
		$title = $instance['title'];
		$facebook = $instance['facebook'];
		$google_plus = $instance['google_plus'];
		$behance = $instance['behance'];
		$vimeo = $instance['vimeo'];
		$youtube = $instance['youtube'];
		$instagram = $instance['instagram'];
		$tumblr_icon = $instance['tumblr_icon'];
		$linkedin = $instance['linkedin'];
		$pinterest = $instance['pinterest'];
		$twitter = $instance['twitter'];
		$blogger = $instance['blogger'];
		$deviantart = $instance['deviantart'];
		$dribble = $instance['dribble'];
		$dropbox = $instance['dropbox'];
		$rss = $instance['rss'];
		$skype = $instance['skype'];
		$stumbleupon = $instance['stumbleupon'];
		$wordpress = $instance['wordpress'];
		$yahoo = $instance['yahoo'];
		$flickr = $instance['flickr'];
		?>
		<div class="widget">

<?php
		if($title) {
			echo $before_title.$title.$after_title;
		}
			?>				
		
			<div class="social_icons_widget">
			<ul class="social-icons-list-widget">
     <?php if($facebook !=''){?> <li><a href="<?php echo esc_url($facebook);?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/facebook.png" alt="<?php esc_attr_e('Facebook', 'nanomag'); ?>"></a></li><?php }?>
     <?php if($google_plus !=''){?><li><a href="<?php echo esc_url($google_plus);?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/google-plus.png" alt="<?php esc_attr_e('Google Plus', 'nanomag'); ?>"></a></li><?php }?>
     <?php if($behance !=''){?><li><a href="<?php echo esc_url($behance);?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/behance.png" alt="<?php esc_attr_e('Behance', 'nanomag'); ?>"></a></li><?php }?>
     <?php if($vimeo !=''){?><li><a href="<?php echo esc_url($vimeo);?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/vimeo.png" alt="<?php esc_attr_e('Vimeo', 'nanomag'); ?>"></a></li><?php }?>
     <?php if($youtube !=''){?><li><a href="<?php echo esc_url($youtube);?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/youtube.png" alt="<?php esc_attr_e('Youtube', 'nanomag'); ?>"></a></li><?php }?>
     <?php if($tumblr_icon !=''){?><li><a href="<?php echo esc_url($tumblr_icon);?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/tumblr.png" alt="<?php esc_attr_e('tumblr', 'nanomag'); ?>"></a></li><?php }?>
     <?php if($instagram !=''){?><li><a href="<?php echo esc_url($instagram);?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/instagram.png" alt="<?php esc_attr_e('Instagram', 'nanomag'); ?>"></a></li><?php }?>
     <?php if($linkedin !=''){?><li><a href="<?php echo esc_url($linkedin);?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/link.png" alt="<?php esc_attr_e('linkedin', 'nanomag'); ?>"></a></li><?php }?>
     <?php if($pinterest !=''){?><li><a href="<?php echo esc_url($pinterest);?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/pin.png" alt="<?php esc_attr_e('Pinterest', 'nanomag'); ?>"></a></li><?php }?>
     <?php if($twitter !=''){?><li><a href="<?php echo esc_url($twitter);?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/twitter.png" alt="<?php esc_attr_e('Twitter', 'nanomag'); ?>"></a></li><?php }?>
    <?php if($blogger !=''){?> <li><a href="<?php echo esc_url($blogger);?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/blogger.png" alt="<?php esc_attr_e('Blogger', 'nanomag'); ?>"></a></li><?php }?>
    <?php if($deviantart !=''){?> <li><a href="<?php echo esc_url($deviantart);?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/d-art.png" alt="<?php esc_attr_e('Deviantart', 'nanomag'); ?>"></a></li><?php }?>
     <?php if($dribble !=''){?><li><a href="<?php echo esc_url($dribble);?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/dribble.png" alt="<?php esc_attr_e('Dribble', 'nanomag'); ?>"></a></li><?php }?>
    <?php if($dropbox !=''){?> <li><a href="<?php echo esc_url($dropbox);?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/dropbox.png" alt="<?php esc_attr_e('Dropbox', 'nanomag'); ?>"></a></li><?php }?>
     <?php if($rss !=''){?><li><a href="<?php echo esc_url($rss);?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/rss.png" alt="<?php esc_attr_e('RSS', 'nanomag'); ?>"></a></li><?php }?>
     <?php if($skype !=''){?><li><a href="<?php echo esc_url($skype);?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/skype.png" alt="<?php esc_attr_e('Skype', 'nanomag'); ?>"></a></li><?php }?>
     <?php if($stumbleupon !=''){?><li><a href="<?php echo esc_url($stumbleupon);?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/stumbleupon.png" alt="<?php esc_attr_e('Stumbleupon', 'nanomag'); ?>"></a></li><?php }?>
    <?php if($wordpress !=''){?> <li><a href="<?php echo esc_url($wordpress);?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/wordpress.png" alt="<?php esc_attr_e('WordPress', 'nanomag'); ?>"></a></li><?php }?>
    <?php if($yahoo !=''){?> <li><a href="<?php echo esc_url($yahoo);?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/yahoo.png" alt="<?php esc_attr_e('Yahoo', 'nanomag'); ?>"></a></li><?php }?>
    <?php if($flickr !=''){?> <li><a href="<?php echo esc_url($flickr);?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/flickr.png" alt="<?php esc_attr_e('flickr', 'nanomag'); ?>"></a></li><?php }?>
     </ul> 
			</div>
		</div>
		<?php
	
	}

/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['facebook'] = $new_instance['facebook'];
		$instance['google_plus'] = $new_instance['google_plus'];
		$instance['behance'] = $new_instance['behance'];
		$instance['vimeo'] = $new_instance['vimeo'];
		$instance['youtube'] = $new_instance['youtube'];
		$instance['tumblr_icon'] = $new_instance['tumblr_icon'];
		$instance['instagram'] = $new_instance['instagram'];
		$instance['linkedin'] = $new_instance['linkedin'];
		$instance['pinterest'] = $new_instance['pinterest'];
		$instance['twitter'] = $new_instance['twitter'];
		$instance['blogger'] = $new_instance['blogger'];
		$instance['deviantart'] = $new_instance['deviantart'];
		$instance['dribble'] = $new_instance['dribble'];
		$instance['dropbox'] = $new_instance['dropbox'];
		$instance['rss'] = $new_instance['rss'];
		$instance['skype'] = $new_instance['skype'];
		$instance['stumbleupon'] = $new_instance['stumbleupon'];
		$instance['wordpress'] = $new_instance['wordpress'];
		$instance['yahoo'] = $new_instance['yahoo'];
		$instance['flickr'] = $new_instance['flickr'];
		
		return $instance;
	}



	function form($instance){
		?>
		<?php
			$defaults = array( 'title' => esc_attr__( 'Social Icons' , 'nanomag'), 'facebook' => '#', 'google_plus' => '#', 'behance' => '#', 'vimeo' => '#', 'youtube' => '#', 'tumblr_icon' => '#', 'instagram' => '#', 'linkedin' => '#', 'pinterest' => '#', 'twitter' => '#', 'blogger' => '#', 'deviantart' => '#', 'dribble' => '#', 'dropbox' => '#', 'rss' => '#', 'skype' => '#', 'stumbleupon' => '#', 'wordpress' => '#', 'yahoo' => '#', 'flickr' => '#');
			$instance = wp_parse_args((array) $instance, $defaults); 
		?>
		
        <p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e( 'Title:', 'nanomag'); ?></label>
			<input class="widefat" style="width: 100%;" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>
        
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('facebook')); ?>"><?php esc_attr_e( 'Facebook Url:' , 'nanomag' ); ?></label>
			<input class="widefat" style="width: 100%;" id="<?php echo esc_attr($this->get_field_id('facebook')); ?>" name="<?php echo esc_attr($this->get_field_name('facebook')); ?>" type="text" value="<?php echo esc_attr($instance['facebook']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('google_plus')); ?>"><?php esc_attr_e( 'Google_plus Url:' , 'nanomag' ); ?></label>
			<input class="widefat" style="width: 100%;" id="<?php echo esc_attr($this->get_field_id('google_plus')); ?>" name="<?php echo esc_attr($this->get_field_name('google_plus')); ?>" type="text" value="<?php echo esc_attr($instance['google_plus']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('behance')); ?>"><?php esc_attr_e( 'Behance Url:' , 'nanomag' ); ?></label>
			<input class="widefat" style="width: 100%;" id="<?php echo esc_attr($this->get_field_id('behance')); ?>" name="<?php echo esc_attr($this->get_field_name('behance')); ?>" type="text" value="<?php echo esc_attr($instance['behance']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('vimeo')); ?>"><?php esc_attr_e( 'Vimeo Url:' , 'nanomag' ); ?></label>
			<input class="widefat" style="width: 100%;" id="<?php echo esc_attr($this->get_field_id('vimeo')); ?>" name="<?php echo esc_attr($this->get_field_name('vimeo')); ?>" type="text" value="<?php echo esc_attr($instance['vimeo']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('youtube')); ?>"><?php esc_attr_e( 'Youtube Url:' , 'nanomag' ); ?></label>
			<input class="widefat" style="width: 100%;" id="<?php echo esc_attr($this->get_field_id('youtube')); ?>" name="<?php echo esc_attr($this->get_field_name('youtube')); ?>" type="text" value="<?php echo esc_attr($instance['youtube']); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('tumblr_icon')); ?>"><?php esc_attr_e( 'tumblr Url:' , 'nanomag' ); ?></label>
			<input class="widefat" style="width: 100%;" id="<?php echo esc_attr($this->get_field_id('tumblr_icon')); ?>" name="<?php echo esc_attr($this->get_field_name('tumblr_icon')); ?>" type="text" value="<?php echo esc_attr($instance['tumblr_icon']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('instagram')); ?>"><?php esc_attr_e( 'Instagram Url:' , 'nanomag' ); ?></label>
			<input class="widefat" style="width: 100%;" id="<?php echo esc_attr($this->get_field_id('instagram')); ?>" name="<?php echo esc_attr($this->get_field_name('instagram')); ?>" type="text" value="<?php echo esc_attr($instance['instagram']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('linkedin')); ?>"><?php esc_attr_e( 'Linkedin Url:' , 'nanomag' ); ?></label>
			<input class="widefat" style="width: 100%;" id="<?php echo esc_attr($this->get_field_id('linkedin')); ?>" name="<?php echo esc_attr($this->get_field_name('linkedin')); ?>" type="text" value="<?php echo esc_attr($instance['linkedin']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('pinterest')); ?>"><?php esc_attr_e( 'Pinterest Url:' , 'nanomag' ); ?></label>
			<input class="widefat" style="width: 100%;" id="<?php echo esc_attr($this->get_field_id('pinterest')); ?>" name="<?php echo esc_attr($this->get_field_name('pinterest')); ?>" type="text" value="<?php echo esc_attr($instance['pinterest']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('twitter')); ?>"><?php esc_attr_e( 'Twitter Url:' , 'nanomag' ); ?></label>
			<input class="widefat" style="width: 100%;" id="<?php echo esc_attr($this->get_field_id('twitter')); ?>" name="<?php echo esc_attr($this->get_field_name('twitter')); ?>" type="text" value="<?php echo esc_attr($instance['twitter']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('blogger')); ?>"><?php esc_attr_e( 'Blogger Url:' , 'nanomag' ); ?></label>
			<input class="widefat" style="width: 100%;" id="<?php echo esc_attr($this->get_field_id('blogger')); ?>" name="<?php echo esc_attr($this->get_field_name('blogger')); ?>" type="text" value="<?php echo esc_attr($instance['blogger']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('deviantart')); ?>"><?php esc_attr_e( 'Deviantart Url:' , 'nanomag' ); ?></label>
			<input class="widefat" style="width: 100%;" id="<?php echo esc_attr($this->get_field_id('deviantart')); ?>" name="<?php echo esc_attr($this->get_field_name('deviantart')); ?>" type="text" value="<?php echo esc_attr($instance['deviantart']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('dribble')); ?>"><?php esc_attr_e( 'Dribble Url:' , 'nanomag' ); ?></label>
			<input class="widefat" style="width: 100%;" id="<?php echo esc_attr($this->get_field_id('dribble')); ?>" name="<?php echo esc_attr($this->get_field_name('dribble')); ?>" type="text" value="<?php echo esc_attr($instance['dribble']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('stumbleupon')); ?>"><?php esc_attr_e( 'Stumbleupon Url:' , 'nanomag' ); ?></label>
			<input class="widefat" style="width: 100%;" id="<?php echo esc_attr($this->get_field_id('stumbleupon')); ?>" name="<?php echo esc_attr($this->get_field_name('stumbleupon')); ?>" type="text" value="<?php echo esc_attr($instance['stumbleupon']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('dropbox')); ?>"><?php esc_attr_e( 'Dropbox Url:' , 'nanomag' ); ?></label>
			<input class="widefat" style="width: 100%;" id="<?php echo esc_attr($this->get_field_id('dropbox')); ?>" name="<?php echo esc_attr($this->get_field_name('dropbox')); ?>" type="text" value="<?php echo esc_attr($instance['dropbox']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('rss')); ?>"><?php esc_attr_e( 'RSS Url:' , 'nanomag' ); ?></label>
			<input class="widefat" style="width: 100%;" id="<?php echo esc_attr($this->get_field_id('rss')); ?>" name="<?php echo esc_attr($this->get_field_name('rss')); ?>" type="text" value="<?php echo esc_attr($instance['rss']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('skype')); ?>"><?php esc_attr_e( 'Skype Url:' , 'nanomag' ); ?></label>
			<input class="widefat" style="width: 100%;" id="<?php echo esc_attr($this->get_field_id('skype')); ?>" name="<?php echo esc_attr($this->get_field_name('skype')); ?>" type="text" value="<?php echo esc_attr($instance['skype']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('wordpress')); ?>"><?php esc_attr_e( 'Wordpress Url:' , 'nanomag' ); ?></label>
			<input class="widefat" style="width: 100%;" id="<?php echo esc_attr($this->get_field_id('wordpress')); ?>" name="<?php echo esc_attr($this->get_field_name('wordpress')); ?>" type="text" value="<?php echo esc_attr($instance['wordpress']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('yahoo')); ?>"><?php esc_attr_e( 'Yahoo Url:' , 'nanomag' ); ?></label>
			<input class="widefat" style="width: 100%;" id="<?php echo esc_attr($this->get_field_id('yahoo')); ?>" name="<?php echo esc_attr($this->get_field_name('yahoo')); ?>" type="text" value="<?php echo esc_attr($instance['yahoo']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('flickr')); ?>"><?php esc_attr_e( 'Flickr Url:' , 'nanomag' ); ?></label>
			<input class="widefat" style="width: 100%;" id="<?php echo esc_attr($this->get_field_id('flickr')); ?>" name="<?php echo esc_attr($this->get_field_name('flickr')); ?>" type="text" value="<?php echo esc_attr($instance['flickr']); ?>" />
		</p>
		
		<?php

	}
}
?>