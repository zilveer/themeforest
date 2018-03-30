<?php 
/**
  * Social Counter Widget
  *
  * @author : VanThemes ( http://www.vanthemes.com )
  * 
  */

add_action('widgets_init','van_social_counter_widget_init');

function van_social_counter_widget_init() {

	register_widget('van_social_counter');

}

class van_social_counter extends WP_Widget {
	function van_social_counter() {

		$options = array( 'classname' => 'social-counter','description' => 'Count of your rss subscribers, Twitter followers, Facebook fans'  );
		$control = array( 'width' => 250, 'height' => 350, 'id_base' => 'social-counter' );
		$this->WP_Widget('social-counter','( '.THEME_NAME .' ) - Social counter',$options,$control);
	
	}
		
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$rss         = $instance['rss'];
		$twitter   = $instance['twitter'];
		$facebook = $instance['facebook'];
		$vimeo       = $instance['vimeo'];
		$youtube   = $instance['youtube'];
		$dribbble  = $instance['dribbble'];
		$gplus       = $instance['gplus'];

		echo "<div class=\"skip-content\">";
			echo $before_widget;
			if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }
				?>
				<div class="socials_counters">
				   	 <ul>
				   	 	<?php if ( $rss ): ?>
							<li class="rss clearfix">
								<a href="<?php echo esc_url( $rss ); ?>" target="_blank">
									<span class="counter-icon"><span class="icon-rss"></span></span>
									<span>Subscribe</span>
									<small>To Rss Feed</small>
								</a>
							</li>		   	 		
				   	 	<?php endif ?>
						<?php if( $twitter ): ?>
							<li class="twitter clearfix">
								<a href="<?php echo esc_url( 'http://www.twitter.com/' . van_get_option('twitter_username') ); ?>" target="_blank">
									<span class="counter-icon"><span class="icon-twitter"></span></span>
									<span><?php van_twitter_followers(); ?></span>
									<small><?php _e("Followers","van") ?></small>
								</a>
							</li>
						<?php endif; ?>
						<?php if ( $facebook ): ?>
							<li class="facebook clearfix">
								<a href="<?php echo esc_url( 'https://www.facebook.com/' . $facebook ); ?>" target="_blank">
									<span class="counter-icon"><span class="icon-facebook"></span></span>
									<span><?php van_facebook_fans($facebook); ?></span>
									<small><?php _e("Fans","van") ?></small>
								</a>
							</li>
						<?php endif; ?>
						<?php if ( $gplus ): ?>
							<li class="gplus clearfix">
								<a href="<?php echo esc_url( 'https://plus.google.com/' . $gplus ); ?>" target="_blank">
									<span class="counter-icon"><span class="icon-gplus"></span></span>
									<span><?php van_gplus_followers($gplus); ?></span>
									<small><?php _e("Followers","van") ?></small>
								</a>
							</li>
						<?php endif; ?>
												
						<?php if ( $youtube ): ?>
							<li class="youtube clearfix">
								<a href="<?php echo esc_url( 'http://www.youtube.com/user/'. $youtube ); ?>" target="_blank">
									<span class="counter-icon"><span class="icon-youtube"></span></span>
									<span><?php van_youtube_subscribers($youtube); ?></span>
									<small><?php _e("Subscribers","van") ?></small>
								</a>
							</li>
						<?php endif; ?>

						<?php if ( $vimeo ): ?>
							<li class="vimeo clearfix">
								<a href="<?php echo esc_url( 'http://vimeo.com/channels/' . $vimeo ); ?>" target="_blank">
									<span class="counter-icon"><span class="icon-vimeo"></span></span>
									<span><?php van_vimeo_subscribers($vimeo); ?></span>
									<small><?php _e("Subscribers","van") ?></small>
								</a>
							</li>
						<?php endif; ?>

						<?php if ( $dribbble ): ?>
							<li class="dribbble clearfix">
								<a href="<?php echo esc_url( 'http://dribbble.com/' . $dribbble ); ?>" target="_blank">
									<span class="counter-icon"><span class="icon-dribbble"></span></span>
									<span><?php van_dribbble_followers($dribbble); ?></span>
									<small><?php _e("Followers","van") ?></small>
								</a>
							</li>
						<?php endif; ?>
				    	</ul>
				    <div class="clear"></div>
				</div>
				<?php 
			echo $after_widget;
		echo "</div><!--.skip-content-->";
	}
	function update( $new_instance, $old_instance ) {
		$instance                    = $old_instance;
		$instance['title']        = strip_tags( $new_instance['title'] );
		$instance['rss'] 	       = strip_tags( $new_instance['rss'] ) ;
		$instance['twitter']    = strip_tags( $new_instance['twitter'] );
		$instance['facebook'] = strip_tags( $new_instance['facebook'] );
		$instance['vimeo']       = strip_tags( $new_instance['vimeo'] );
		$instance['youtube']   = strip_tags( $new_instance['youtube'] );
		$instance['dribbble']  = strip_tags( $new_instance['dribbble'] );
		$instance['gplus']  = strip_tags( $new_instance['gplus'] );
		return $instance;
	}
	
	function form( $instance ) {
		?>
    		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'van'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( isset( $instance['title'] ) ){ echo esc_attr( $instance['title'] ); } ?>"  type="text" class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'rss' ); ?>">Feed URL:</label>
		<input id="<?php echo $this->get_field_id( 'rss' ); ?>" name="<?php echo $this->get_field_name( 'rss' ); ?>" value="<?php if( isset( $instance['rss'] ) ){ echo esc_attr( $instance['rss'] ); } ?>" type="text" class="widefat" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'twitter' ); ?>">Enable twitter followers counter: <small style="color:red;"> ( Please, Make sure that you have set up the <strong>twitter API</strong> settings. From appearance -> <?php echo THEME_NAME; ?> settings -> Twitter Settings )</small></label>
			<input id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="true"  type="checkbox" <?php if( isset( $instance['twitter'] ) &&  $instance['twitter'] ){ echo 'checked="checked"'; } ?> />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'facebook' ); ?>">Facebook page username or id: </label>
			<input id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php if( isset( $instance['facebook'] ) ){ echo esc_attr( $instance['facebook'] ); } ?>" type="text" class="widefat" />
		</p>		
		<p>
			<label for="<?php echo $this->get_field_id( 'gplus' ); ?>">Google+ Page ID: <small>(https://plus.google.com/<span style="color:red;" >+ID</span>)</small></label>
			<input id="<?php echo $this->get_field_id( 'gplus' ); ?>" name="<?php echo $this->get_field_name( 'gplus' ); ?>" value="<?php if( isset( $instance['gplus'] ) ){ echo esc_attr( $instance['gplus'] ); } ?>" type="text" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'vimeo' ); ?>">Vimeo Channel username:</label>
			<input id="<?php echo $this->get_field_id( 'vimeo' ); ?>" name="<?php echo $this->get_field_name( 'vimeo' ); ?>" value="<?php if( isset( $instance['vimeo'] ) ){ echo esc_attr( $instance['vimeo'] ); } ?>" type="text" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'youtube' ); ?>">Youtube Channel username:</label>
			<input id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" value="<?php if( isset( $instance['youtube'] ) ){ echo esc_attr( $instance['youtube'] ); } ?>" type="text" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'dribbble' ); ?>">Dribbble username:</label>
			<input id="<?php echo $this->get_field_id( 'dribbble' ); ?>" name="<?php echo $this->get_field_name( 'dribbble' ); ?>" value="<?php if( isset( $instance['dribbble'] ) ){ echo esc_attr( $instance['dribbble'] ); } ?>" type="text" class="widefat" />
		</p>
   <?php 
	}
}