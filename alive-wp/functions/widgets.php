<?php
class customLoginWidget extends WP_Widget {

	function customLoginWidget() { // plugin structure:
		$widget_ops = array('classname' => 'customLoginWidget', 'description' => 'Displays a theme-compatible user login form.'); 
		$this->WP_Widget('customLoginWidget', 'Theme Login Widget', $widget_ops);
	}

	
	function widget($args, $instance) { // widget sidebar output
    	extract($args, EXTR_SKIP); 
	    echo $before_widget; // pre-widget code from themes

    	
		//echo '<ul>';
		if (!is_user_logged_in()){ 
		echo $before_title . 'Login' . $after_title; // echo title ?>
		<form id="loginForm" action="<?php echo home_url(); ?>/wp-login.php" method="post">
			<input class="field" type="text" name="log" id="log" value="<?php echo esc_html($user_login) ?>" size="20" />
			<input class="field" type="password" name="pwd" id="pwd" size="20" />
			<input class="button small <?php echo of_get_option('blog_button_color'); ?> " type="submit" name="submit" value="Login" />
    		<p>
       			<label for="rememberme"><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> Remember me</label>
       			<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
    		</p>
		</form>
		<p>
			<?php wp_register( '','', true); ?><br/>
			<a class="external" href="<?php echo home_url(); ?>/wp-login.php?action=lostpassword">Recover password</a>
		</p>
		<?php } else { 
			global $current_user;
      		get_currentuserinfo();
			echo $before_title . 'Welcome, ' . $current_user->display_name . $after_title;?>
				<a class="button small <?php echo of_get_option('blog_button_color'); ?> external" style="margin:5px 0 5px 0;" href="<?php echo wp_logout_url(get_permalink()); ?>">Logout</a><br />
				<a class="button small <?php echo of_get_option('blog_button_color'); ?> external" style="margin:5px 0 5px 0;" href="<?php echo home_url(); ?>/wp-admin/">Admin</a>
			<?php }	
			
		//echo '</ul>';
	    echo $after_widget; // after widget code from themes
	}
}

add_action( 'widgets_init', create_function('', 'return register_widget("customLoginWidget");') ); // register widget ?>