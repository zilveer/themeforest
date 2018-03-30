<?php
/**
 * Plugin Name: BK-Ninja: Login Widget
 * Plugin URI: http://bk-ninja.com
 * Description: Displays login form in sidebar.
 * Version: 1.0
 * Author: BK-Ninja
 * Author URI: http://BK-Ninja.com
 *
 */
/**
 * Add function to widgets_init that'll load our widget.
 */
add_action('widgets_init', 'bk_register_login_widget');

function bk_register_login_widget(){
	register_widget('bk_login');
}

class bk_login extends WP_Widget {
    
/**
 * Widget setup.
 */
	function __construct() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget-login', 'description' => __('Displays login form in sidebar.', 'bkninja') );

		/* Create the widget. */
		parent::__construct( 'bk_login', __('*BK: Widget Login', 'bkninja'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = $instance['title']; 
        $en_lost_pw = $instance['en_lost_pw'];
        $en_register = $instance['en_register'];
        
		echo $before_widget;
        
		?>
			<?php if (is_user_logged_in()) { ?>
            <?php global $current_user;
                get_currentuserinfo();
                $title = sprintf(__( 'Welcome %s','bkninja'),$current_user->display_name) ;
                if ( $title )
		      	echo $before_title . $title . $after_title; ?>
                
            <div class="user-ava"><?php echo get_avatar( $current_user->ID, 60 );?></div>            
            <a href="<?php echo get_edit_user_link(); ?>"><?php _e( 'Profile','bkninja' )?></a>    
            <a href="<?php echo admin_url()?>"><?php _e( 'Dashboard','bkninja' )?></a>
            <a href="<?php echo wp_logout_url($_SERVER['REQUEST_URI'])?>"><?php _e( 'Log Out','bkninja' )?></a>
            <?php } else { ?>
            <?php 
            if ( $title )
			echo $before_title . $title . $after_title;
            $args = array(
                    'echo'           => true,
                    'redirect'       => $_SERVER['REQUEST_URI'], 
                    'form_id'        => 'loginform',
                    'label_username' => __( 'Username','bkninja' ),
                    'label_password' => __( 'Password','bkninja' ),
                    'label_remember' => __( 'Remember Me','bkninja' ),
                    'label_log_in'   => __( 'Log In','bkninja' ),
                    'id_username'    => 'user_login',
                    'id_password'    => 'user_pass',
                    'id_remember'    => 'rememberme',
                    'id_submit'      => 'wp-submit',
                    'remember'       => true,
                    'value_username' => NULL,
                    'value_remember' => false
            ); ?>
            <?php wp_login_form( $args ); ?>
            <?php
        		  if ( get_option('users_can_register') && ($en_register == 'on') ) {
        
        		    	if ( ! is_multisite() ) { ?>
                            <a href="<?php echo site_url( 'wp-login.php?action=register', 'login' ); ?>"><?php _e( 'Register','bkninja' )?></a>         
        				<?php } else { ?>
                            <a href="<?php echo site_url('wp-signup.php', 'login'); ?>"><?php _e( 'Register','bkninja' )?></a>     
        			 <?php	}
        
        		    }
                    
        		  if ( $en_lost_pw == 'on') { ?>
                        <a href="<?php echo wp_lostpassword_url(); ?>"><?php _e( 'Lost Password','bkninja' )?></a>       
        		    <?php }
         
         } ?>
		<?php

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args( (array) $new_instance, $this->default );
		$instance['title'] = strip_tags($new_instance['title']);
        $instance['en_lost_pw'] = $new_instance['en_lost_pw'];
        $instance['en_register'] = $new_instance['en_register'];
		return $instance;
	}

	function form( $instance ) {
        $defaults = array('title' => 'Login','en_lost_pw' => 'on', 'en_register' => 'on');
		$instance = wp_parse_args((array) $instance, $defaults);

?>
		<!-- Title: Text Input -->     
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><strong><?php _e('Title: ','bkninja'); ?></strong></label>
            <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
        
        <p>
        <input class="checkbox" type="checkbox" <?php checked( $instance['en_lost_pw'], 'on' ); ?> id="<?php echo $this->get_field_id( 'en_lost_pw' ); ?>" name="<?php echo $this->get_field_name( 'en_lost_pw' ); ?>" />
        <label for="<?php echo $this->get_field_id( 'en_lost_pw' ); ?>"><?php _e('Enable lost password link', 'bkninja'); ?></label>
		</p>
        
        <p>
        <input class="checkbox" type="checkbox" <?php checked( $instance['en_register'], 'on' ); ?> id="<?php echo $this->get_field_id( 'en_register' ); ?>" name="<?php echo $this->get_field_name( 'en_register' ); ?>" />
        <label for="<?php echo $this->get_field_id( 'en_register' ); ?>"><?php _e('Enable register link', 'bkninja'); ?></label>
		</p>
<?php
	}
}