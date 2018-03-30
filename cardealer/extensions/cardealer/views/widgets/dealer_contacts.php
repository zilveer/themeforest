<?php
if (!defined('ABSPATH')) exit;

if (is_single()) {

	global $post;
	$user_id = $post->post_author;
	$user_data = get_userdata($user_id);

	if (get_post_type($post->ID) == TMM_Ext_PostType_Car::$slug) {
		?>
		<div class="widget widget_dealers_map">

			<?php if (!empty($instance['title'])): ?>
				<h3 class="widget-title"><?php _e($instance['title'], 'cardealer'); ?></h3>
			<?php endif; ?>

			<ul class="contact-items">
				<?php if (!empty($user_data->nickname) && $instance['show_dealers_name'] == 'true'): ?>
					<li>
						<b><?php _e('Dealer name', 'cardealer'); ?>: </b>
						<span><?php echo esc_html( $user_data->display_name ); ?></span>
					</li>
				<?php endif; ?>
				<?php if (!empty($user_data->first_name) && $instance['show_contact_person'] == 'true'): ?>
					<li>
						<b><?php _e('Contact Person', 'cardealer'); ?>: </b>
						<span><?php echo esc_html( $user_data->first_name . ' ' . $user_data->last_name ); ?></span>
					</li>
				<?php endif; ?>
				<?php if (!empty($user_data->address) && $instance['show_address'] == 'true'): ?>
					<li>
						<b><?php _e('Address', 'cardealer'); ?>: </b>
						<span><?php echo esc_html( $user_data->address ); ?></span>
					</li>
				<?php endif; ?>
				<?php if (!empty($user_data->phone) && $instance['show_phone'] == 'true'): ?>
					<li>
						<b><?php _e('Phone', 'cardealer'); ?>: </b>
						<span><?php echo esc_html( $user_data->phone ); ?></span>
					</li>
				<?php endif; ?>				
				<?php if (!empty($user_data->mobile) && $instance['show_mobile'] == 'true'): ?>
					<li>
						<b><?php _e('Mobile', 'cardealer'); ?>: </b>
						<span><?php echo esc_html( $user_data->mobile ); ?></span>
					</li>
				<?php endif; ?>
				<?php if (!empty($user_data->fax) && $instance['show_fax'] == 'true'): ?>
					<li>
						<b><?php _e('Fax', 'cardealer'); ?>: </b>
						<span><?php echo esc_html( $user_data->fax ); ?></span>
					</li>
				<?php endif; ?>
				<?php if (!empty($user_data->user_email) && $instance['show_email'] == 'true'): ?>
					<li>
						<b><?php _e('Email', 'cardealer'); ?>: </b>
						<span><?php echo sanitize_email( $user_data->user_email ); ?></span>
					</li>
				<?php endif; ?>
				<?php if (!empty($user_data->skype) && $instance['show_skype'] == 'true'): ?>
					<li>
						<b><?php _e('Skype', 'cardealer'); ?>: </b>
						<span><?php echo esc_html( $user_data->skype ); ?></span>
					</li>
				<?php endif; ?>
				<?php if (!empty($user_data->user_url) && $instance['show_url'] == 'true'): ?>
					<li>
						<b><?php _e('Site', 'cardealer'); ?>: </b>
						<span><a target="_blank" href="<?php echo esc_url( $user_data->user_url ); ?>"><?php echo esc_url( $user_data->user_url ); ?></a></span>
					</li>
				<?php endif; ?>

			</ul>

			<div class="clear"></div>

		</div>
		<?php
	}
}

