<?php
/**
 * VideoTube SubscribeBox Widget
 * Add Subscrib Box Widget in Right sidebar, display the Social Count.
 * @author 		Toan Nguyen
 * @category 	Core
 * @version     1.0.0
 */
if( !defined('ABSPATH') ) exit;
if( !function_exists('Mars_Subscribox_Widget') ){
	function Mars_Subscribox_Widget() {
		register_widget('Mars_Subscribox_Widget_Class');
	}
	add_action('widgets_init', 'Mars_Subscribox_Widget');
}
class Mars_Subscribox_Widget_Class extends WP_Widget{
	
	function __construct(){
		$widget_ops = array( 'classname' => 'mars-subscribox-widget', 'description' => __('VT Social Subscribe Box', 'mars') );
	
		parent::__construct( 'mars-subscribox-widget' , __('VT Social Subscribe Box', 'mars') , $widget_ops);
	}
		
	function widget($args, $instance){
		global $videotube, $post;
		$settings = get_option( 'socialcountplus_settings' );
		$WidgetHTML = null;
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		print  $before_widget;
		if( !empty( $title ) ){
			print $before_title . $title . $after_title;
		}
		
		$socials = array(
			'facebook'	=>	esc_html__('Fans','mars'),
			'twitter'	=>	esc_html__('Followers','mars'),
			'googleplus'	=>	esc_html__('Fans','mars'),
			'soundcloud'	=>	esc_html__('Followers','mars'),
			'youtube'		=>	esc_html__('Subscribers','mars'),
			'instagram'		=>	esc_html__('Followers','mars'),
			'linkedin'		=>	esc_html__('Followers','mars'),
			'pinterest'		=>	esc_html__('Followers','mars'),
			'tumblr'		=>	esc_html__('Followers','mars'),
			'vimeo'			=>	esc_html__('Subscribers','mars')
		);
		
		$socials = apply_filters( 'marstheme_subscriber_widget_socials' , $socials);
		
		foreach ( $socials  as $key=>$value) {
			if( isset( $settings[ $key . '_active'] ) ){
				$icon_class = ( $key == 'googleplus' ) ? 'google-plus' : $key;
				?>
			        <div class="social-counter-item">
			            <a target="_blank" href="<?php print ( isset( $videotube[ $icon_class ] ) ? esc_url( $videotube[ $icon_class ] ) : '#' ) ;?>">
			                <i class="fa fa-<?php print esc_attr( $icon_class );?>"></i>
			                <span class="counter"><?php if( function_exists('get_scp_counter') ): print get_scp_counter( $key ); endif; ?></span>
			                <span class="counter-text"><?php print $value;?></span>
			            </a>
			        </div>
				<?php 
			}
		}
		?>
        <?php if( get_option('users_can_register') ):?>
	        <div class="social-counter-item last subscribe">
	            <a href="#" data-toggle="modal" data-target="#subscrib-modal">
	                <i class="fa fa-rss"></i>
	                <span class="counter"><?php if( function_exists('mars_get_socials_count') ): print mars_get_socials_count('subscriber'); endif; ?></span>
	                <span class="counter-text"><?php _e('Subscribers','mars')?></span>
	            </a>
	        </div>
        
			<!-- Modal -->
			<div class="modal fade" id="subscrib-modal" tabindex="-1" role="dialog" aria-labelledby="subscrib-modal-label" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title" id="subscrib-modal-label"><?php _e('Subscribe','mars');?></h4>
			      </div>
			      <div class="modal-body">
					<form method="post" role="form" action="" name="mars-subscribe-form" id="mars-subscribe-form">
					  <div class="form-group name">
					    <label for="name"><?php _e('Your Name','mars');?></label>
					    <input type="text" class="form-control" id="name">
					  </div>
					  <div class="form-group email">
					    <label for="email"><?php _e('Your Email Address','mars');?></label>
					    <input type="email" class="form-control" id="email">
					  </div>
					  <div class="checkbox">
					    <label>
					      <input name="agree" id="agree" type="checkbox"> <a href="<?php print get_permalink( isset( $videotube['private-policy-id'] ) ? $videotube['private-policy-id'] : null );?>"><?php _e('User Agreement & Privacy Policy','mars');?></a>
					    </label>
					  </div>
					  <?php wp_nonce_field('mars_subscrib_act','mars_subscrib',true,true);?>
					  <button type="submit" class="btn btn-primary"><?php _e('Register','mars');?></button>
					  <input type="hidden" name="submit-label" value="<?php _e('Register','mars');?>">
					  <button type="button" class="btn btn-default" data-dismiss="modal"><?php _e('Close','mars');?></button>
					  <input type="hidden" name="referer" id="referer" value="<?php print $post->ID;?>">
					</form>
			      </div>
			    </div>
			  </div>
			</div>
		<?php endif;?>   
		<?php 
		print $after_widget;
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['video_category'] = strip_tags( $new_instance['video_category'] );
		$instance['video_key'] = strip_tags( $new_instance['video_key'] );
		$instance['video_orderby'] = strip_tags( $new_instance['video_orderby'] );
		$instance['video_order'] = strip_tags( $new_instance['video_order'] );
		$instance['widget_column'] = strip_tags( $new_instance['widget_column'] );
		$instance['video_shows'] = strip_tags( $new_instance['video_shows'] );
		$instance['view_more'] = strip_tags( $new_instance['view_more'] );
		return $instance;		
		
	}
	function form( $instance ){
		$defaults = array( 
			'title' => __('Social Subscribox', 'mars'),
			'columns'	=>	4
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'mars'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>		
	<?php		
	}	
}

