<?php
/**
 * VideoTube LoginForm Widget
 * Add LoginForm Widget in Right sidebar.
 * @author 		Toan Nguyen
 * @category 	Core
 * @version     1.0.0
 */
if( !defined('ABSPATH') ) exit;
if( !function_exists('Mars_LoginForm_Widget') ){
	function Mars_LoginForm_Widget() {
		register_widget('Mars_LoginForm_Widget_Class');
	}
	add_action('widgets_init', 'Mars_LoginForm_Widget');
}
class Mars_LoginForm_Widget_Class extends WP_Widget{
	
	function __construct(){
		$widget_ops = array( 'classname' => 'mars-loginform-widget', 'description' => __('VT Login/Profile Widget', 'mars') );
	
		parent::__construct( 'mars-loginform-widget' , __('VT Login/Profile Widget', 'mars') , $widget_ops);
	}	
	
	function widget($args, $instance){
		global $videotube, $post;
		$html = null;
		extract( $args );
		$title = apply_filters('widget_title', isset( $instance['title'] ) ? $instance['title'] : null );
		$uploader_url = ( !empty( $instance['uploader_url'] ) && $instance['uploader_url'] != -1 ) ? get_permalink( $instance['uploader_url'] )  : '#';
		$profile_url = ( !empty( $instance['profile_url'] ) && $instance['profile_url'] != -1 ) ? get_permalink( $instance['profile_url'] )  : '#';
		$el_class = !empty( $instance['el_class'] ) ? esc_attr( $instance['el_class'] ) : null;
		$html .=  $before_widget;
		if( !empty( $title ) ){
			$html .= $args['before_title'] . $title . $args['after_title'];
		}
		
		$args = array(
	        'echo'           => false,
	        'form_id'        => 'vt_loginform',
	        'label_username' => __( 'Username','mars' ),
	        'label_password' => __( 'Password','mars' ),
	        'label_remember' => __( 'Remember Me','mars' ),
	        'label_log_in'   => __( 'Log In','mars' ),
	        'id_username'    => 'user_login',
	        'id_password'    => 'user_pass',
	        'id_remember'    => 'rememberme',
	        'id_submit'      => 'wp-submit',
	        'remember'       => true,
	        'value_username' => NULL,
	        'value_remember' => false
		);
		if( ! get_current_user_id() ){
			$html .= '<div class="alert alert-danger" style="display:none;"></div>';
			$html .= wp_login_form( apply_filters( 'mars_loginform_args' , $args) );
			
			if( shortcode_exists( 'wordpress_social_login' ) ){
				$html .= do_shortcode( '[wordpress_social_login]' );
			}

		}
		else{
			$user_data = get_user_by('id', get_current_user_id());
			$html .= '
				<div class="profile-widget-header '.$el_class.'">
					<div class="profile-widget-image">
						<a href="'.get_author_posts_url(get_current_user_id()).'">'.get_avatar( get_current_user_id(), 80 ).'</a>
					</div>					
					<div class="profile-widget-info">
						<h3>'.$user_data->display_name.'</h3>';
						if( $uploader_url != '#' ){
							$html .= '<span class="profile-widget-info-item"><i class="fa fa-cloud"></i> <a href="'.$uploader_url.'">'.__('Upload','mars').'</a></span>';
						}
						$html .= '<span class="profile-widget-info-item"><i class="fa fa-star"></i> <a href="'.get_author_posts_url(get_current_user_id()).'">'.__('Channel','mars').'</a></span>';
						if( $profile_url != '#' ){
							$html .= '<span class="profile-widget-info-item"><i class="fa fa-user"></i> <a href="'.$profile_url.'">'.__('Profile','mars').'</a></span>';
						}
						$html .= '<span class="profile-widget-info-item"><i class="fa fa-sign-out"></i> <a href="'.wp_logout_url( home_url() ).'">'.__('Sign out','mars').'</a></span>
					</div>
				</div>
			';
		}
		$html .= $after_widget;
		print $html;
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['uploader_url'] = strip_tags( $new_instance['uploader_url'] );
		$instance['profile_url'] = strip_tags( $new_instance['profile_url'] );
		return $instance;		
		
	}
	function form( $instance ){
		$defaults = array( 'title' => __('Login Form', 'mars'));
		$instance = wp_parse_args( (array) $instance, $defaults );
		$pages = get_pages(array('showposts'=>-1));
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'mars'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'uploader_url' ); ?>"><?php _e('Uploader URL:', 'mars'); ?></label>
			<?php 
				if( $pages ){
					print '<select id="'.$this->get_field_id( 'uploader_url' ).'" name="'.$this->get_field_name( 'uploader_url' ).'" class="regular-text mars-dropdown">';
					print '<option value="-1">'.__('Choose One ...','mars').'</option>';
					foreach ( $pages as $page ){
						print '<option '.selected($page->ID, $instance['uploader_url']).' value="'.$page->ID.'">'.$page->post_title.'</option>';
					}
					print '</select>';
				}
					
			?>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'profile_url' ); ?>"><?php _e('Profile URL:', 'mars'); ?></label>
			<?php 
				if( $pages ){
					print '<select id="'.$this->get_field_id( 'profile_url' ).'" name="'.$this->get_field_name( 'profile_url' ).'" class="regular-text mars-dropdown">';
					print '<option value="-1">'.__('Choose One ...','mars').'</option>';
					foreach ( $pages as $page ){
						print '<option '.selected($page->ID, $instance['profile_url']).' value="'.$page->ID.'">'.$page->post_title.'</option>';
					}
					print '</select>';
				}
					
			?>
		</p>
	<?php		
	}	
}
