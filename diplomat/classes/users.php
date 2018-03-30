<?php
class TMM_Users {

	public function __construct() {
		add_action('show_user_profile', array(__CLASS__, 'show_my_profile_fields'));
		add_action('edit_user_profile', array(__CLASS__, 'show_my_profile_fields'));

		add_action('personal_options_update', array(__CLASS__, 'save_my_profile_fields'));
		add_action('edit_user_profile_update', array(__CLASS__, 'save_my_profile_fields'));
	}

	public static function my_profile_services () {
		return apply_filters('users_profile_services', array(
			'twitter' => __('Twitter', 'diplomat'),
			'facebook' => __('Facebook', 'diplomat'),
			'pinteres' => __('Pinterest', 'diplomat'),
			'rss' => __('Rss', 'diplomat'),
			'gplus' => __('Google Plus', 'diplomat'),
		));
	}

	public function show_my_profile_fields ($user) {
		?>
		<h3><?php esc_html_e('User Social Links', 'diplomat'); ?></h3>

		<?php $services = self::my_profile_services(); ?>

		<?php if (!empty($services)): ?>

			<table class="form-table">
				<?php foreach($services as $meta => $title): ?>
				<tr>
					<th><label for="<?php echo esc_attr($meta) ?>"><?php echo esc_html($title) ?></label></th>
					<td>
						<input type="text" name="<?php echo esc_attr($meta) ?>" id="<?php echo esc_attr($meta) ?>" value="<?php echo esc_attr(get_the_author_meta($meta, $user->ID)); ?>" class="regular-text"/><br/>
						<span class="description"><?php esc_html_e("Please enter your " . $meta . " account", 'diplomat') ?></span>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>

		<?php endif;
	}

	public static function save_my_profile_fields ($user_id) {
		if ( !current_user_can( 'edit_user', $user_id ) ) {
			return false;
		}
		update_user_meta($user_id, 'twitter', $_POST['twitter']);
		update_user_meta($user_id, 'facebook', $_POST['facebook']);
		update_user_meta($user_id, 'pinteres', $_POST['pinteres']);
		update_user_meta($user_id, 'rss', $_POST['rss']);
		update_user_meta($user_id, 'gplus', $_POST['gplus']);
	}

	public static function my_author_social_links ($user_id) { ?>
		<ul class="social-icons">
			<?php if (get_the_author_meta('twitter', $user_id)): ?>
				<li class="twitter"><a target="_blank" href="<?php echo esc_url(get_the_author_meta('twitter', $user_id)); ?>"><?php esc_html_e('Twitter', 'diplomat') ?></a></li>
			<?php endif; ?>
			<?php if (get_the_author_meta('facebook', $user_id)): ?>
				<li class="facebook"><a target="_blank" href="<?php echo esc_url(get_the_author_meta('facebook', $user_id)); ?>"><?php esc_html_e('Facebook', 'diplomat') ?></a></li>
			<?php endif; ?>
			<?php if (get_the_author_meta('pinteres', $user_id)): ?>
				<li class="pinterest"><a target="_blank" href="<?php echo esc_url(get_the_author_meta('pinteres', $user_id)); ?>"><?php esc_html_e('Pinterest', 'diplomat') ?></a></li>
			<?php endif; ?>
			<?php if (get_the_author_meta('rss', $user_id)): ?>
				<li class="rss"><a target="_blank" href="<?php echo esc_url(get_the_author_meta('rss', $user_id)); ?>"><?php esc_html_e('Rss', 'diplomat') ?></a></li>
			<?php endif; ?>
			<?php if (get_the_author_meta('gplus', $user_id)): ?>
				<li class="gplus"><a target="_blank" href="<?php echo esc_url(get_the_author_meta('gplus', $user_id)); ?>"><?php esc_html_e('Google Plus', 'diplomat') ?></a></li>
			<?php endif; ?>
		</ul><!--/ .social-icons-->
		<?php
	}

	public static function send_email($to, $subject, $message, $from = '') {

		if (!$from) {
			$from = get_bloginfo("admin_email");
		}
		/* set headers */
		$headers = 'From: '. $from . "\r\n";

		add_filter('wp_mail_content_type', array(__CLASS__, 'set_html_content_type'));
		add_filter('wp_mail_from_name', array(__CLASS__, 'set_mail_from_name'));

		wp_mail($to, $subject, $message, $headers);

		remove_filter('wp_mail_content_type', array(__CLASS__, 'set_html_content_type'));
		remove_filter('wp_mail_from_name', array(__CLASS__, 'set_mail_from_name'));
	}

	public static function set_mail_from_name($name) {
		return get_option('blogname');
	}

	public static function set_html_content_type() {
		return 'text/html';
	}

}

