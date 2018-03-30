<?php
/*
Plugin Name: WordPress Reset
Plugin URI: http://sivel.net/wordpress/wordpress-reset/
Description: Resets the WordPress database back to it's defaults.  Deletes all customizations and content.	Does not modify files only resets the database.
Author: Matt Martz
Version: 1.2
Author URI: http://sivel.net/

		Copyright (c) 2009-2010 Matt Martz (http://sivel.net)
		WordPress Reset is released under the GNU General Public License (GPL)
		http://www.gnu.org/licenses/gpl-2.0.txt
*/

// Only run the code if we are in the admin
if ( is_admin() ) :

class WordPressReset {
	// Set to true by default, this allows the plugin to be automatically reactivated after the reset
	var $auto_reactivate = true;

	// Action/Filter Hooks
	function WordPressReset() {
		add_action('admin_menu', array(&$this, 'add_page'));
		add_action('admin_footer', array(&$this, 'footer'));
		add_action('admin_head', array(&$this, 'head'));
		add_action('init', array(&$this, 'init'));
		add_filter('favorite_actions', array(&$this, 'favorites'), 100);
		add_filter('wp_mail', array(&$this, 'hijack_mail'), 1);
	}

	// favorite_actions filter hook operations
	// While this plugin is active put a link to the reset page in the favorites drop down.
	function favorites($actions) {
		$reset['tools.php?page=wordpress-reset'] = array('WordPress Reset', 'level_10');
		return array_merge($reset, $actions);
	}

	// init action hook operations
	// Checks for wordpress_reset post value and if there deletes all wp tables
	// and performs an install, populating the users previous password also
	function init() {
		global $current_user;
		if ( isset($_POST['wordpress_reset']) && $_POST['wordpress_reset'] == 'true' && isset($_POST['wordpress_reset_confirm']) && $_POST['wordpress_reset_confirm'] == 'reset' ) {
			require_once(ABSPATH . '/wp-admin/includes/upgrade.php');

			$blogname = get_option('blogname');
			$admin_email = get_option('admin_email');
			$blog_public = get_option('blog_public');

			if ( $current_user->user_login != 'admin' )
				$user = get_userdatabylogin('admin');
			if ( ! isset($user) || $user->user_level < 10 )
				$user = $current_user;

			global $wpdb;
			$tables = $wpdb->get_col("SHOW TABLES LIKE '{$wpdb->prefix}%'");
			foreach ($tables as $table) {
				$wpdb->query("DROP TABLE $table");
			}

			$result = wp_install($blogname, $user->user_login, $user->user_email, $blog_public);
			extract($result, EXTR_SKIP);

			$query = $wpdb->prepare("UPDATE $wpdb->users SET user_pass = %s, user_activation_key = '' WHERE ID = %d", $user->user_pass, $user_id);
			$wpdb->query($query);

			$get_user_meta = function_exists('get_user_meta') ? 'get_user_meta' : 'get_usermeta';
			$update_user_meta = function_exists('update_user_meta') ? 'update_user_meta' : 'update_usermeta';

			if ( $get_user_meta($user_id, 'default_password_nag') )
				$update_user_meta($user_id, 'default_password_nag', false);
			if ( $get_user_meta($user_id, $wpdb->prefix . 'default_password_nag') )
				$update_user_meta($user_id, $wpdb->prefix . 'default_password_nag', false);

			if ( $this->auto_reactivate == true )
				update_option('active_plugins', array(plugin_basename(__FILE__)));

			wp_clear_auth_cookie();
			wp_set_auth_cookie($user_id);

			wp_redirect(admin_url() . '?reset');
			exit();
		}

		if ( array_key_exists('reset', $_GET) && stristr($_SERVER['HTTP_REFERER'], 'wordpress-reset') ) {
			$user = get_userdata(1);
			add_action('admin_notices',create_function('$a', 'echo \'<div id="message" class="updated fade"><p><strong>WordPress has been reset back to defaults.  The user "' . $user->user_login . '" was recreated with its previous password.</strong></p></div>\';'));
			do_action('wordpress_reset_post', $user);
		}
	}

	// Overwrite the password, because we actually reset it after this email goes out
	function hijack_mail($args) {
		if ( stristr($args['message'], 'Your new WordPress blog has been successfully set up at') )
			$args['message'] = preg_replace('/Password:.+/', 'Password: Previously specified password', $args['message']);
		return $args;
	}

	// admin_head action hook operations
	// Enqueue jQuery to the head
	function head() {
		wp_enqueue_script('jquery');
	}

	// admin_footer action hook operations
	// Do some jQuery stuff to warn the user before submission
	function footer() {
	?>
	<script type="text/javascript">
	/* <![CDATA[ */
		jQuery('#wordpress_reset_submit').click(function(){
			if ( jQuery('#wordpress_reset_confirm').val() == 'reset' ) {
				var message = 'This action is not reversable.\n\nClicking "OK" will reset your database back to it\'s defaults.  Click "Cancel" to abort.'
				var reset = confirm(message);
				if ( reset ) {
					jQuery('#wordpress_reset_form').submit();
				} else {
					jQuery('#wordpress_reset').val('false');
					return false;
				}
			} else {
				alert('Invalid confirmation word.  Please type the word \'reset\' in the confirmation field.');
				return false;
			}
		});
	/* ]]> */
	</script>	
	<?php
	}

	// admin_menu action hook operations
	// Add the settings page
	function add_page() {
		if ( current_user_can('level_10') && function_exists('add_management_page') ) :
			add_management_page('WordPress Reset', 'WordPress Reset', 'level_10', 'wordpress-reset', array(&$this, 'admin_page'));
		endif;
	}

	// add_option_page callback operations
	// The settings page
	function admin_page() {
		global $current_user;
		if ( isset($_POST['wordpress_reset_confirm']) && $_POST['wordpress_reset_confirm'] != 'reset' )
			echo '<div id="message" class="error fade"><p><strong>Invalid confirmation word.  Please type the word \'reset\' in the confirmation field.</strong></p></div>';
	?>
	<div class="wrap">
		<h2>WordPress Reset</h2>
		<br />
		<form id="wordpress_reset_form" action="" method="post">
			<input id="wordpress_reset" type="hidden" name="wordpress_reset" value="true" />
			Type 'reset' in the confirmation field to confirm the reset and then click the reset button:<br /><br />
			<input id="wordpress_reset_confirm" type="text" name="wordpress_reset_confirm" value="" />&nbsp;&nbsp;<input id="wordpress_reset_submit" type="submit" name="Submit" class="button-primary" value="Reset" /><br /><br />
			<ul>
				<li><strong>After completing this reset you will taken to the dashboard.</strong></li>
<?php
			$admin = get_userdatabylogin('admin');
			if ( ! isset($admin->user_login) || $admin->user_level < 10 ) :
				$user = $current_user;
?>
				<li>The 'admin' user does not exist.  The user '<strong><?php echo $user->user_login; ?></strong>' will be recreated with its current password with user level 10.</li>
			<?php else : ?>
				<li>The '<strong>admin</strong>' user exists and will be recreated with its current password.</li>
			<?php endif; ?>
				<li>This plugin <strong>will<?php echo $this->auto_reactivate ? '</strong> ' : ' not</strong> ';?>be automatically reactivated after the reset.</li>
			</ul>
		</form>
	</div>
	<?php
	}
}

// Instantiate the class
$WordPressReset = new WordPressReset();

// End if for is_admin
endif;
