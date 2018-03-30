<?php

/**
 * User Profile
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

	<?php do_action( 'bbp_template_before_user_profile' ); ?>

	<div id="bbp-user-profile" class="bbp-user-profile">
		<h2 class="entry-title"><?php _e( 'Profile', 'wpdance' ); ?></h2>
		<div class="bbp-user-section">
		
			<div id="bbp-user-avatar">

				<span class='vcard'>
					<a class="url fn n" href="<?php bbp_user_profile_url(); ?>" title="<?php bbp_displayed_user_field( 'display_name' ); ?>" rel="me">
						<?php echo get_avatar( bbp_get_displayed_user_field( 'user_email', 'raw' ), apply_filters( 'bbp_single_user_details_avatar_size', 150 ) ); ?>
					</a>
				</span>
				
				<p class="bbp-user-forum-role"><span class="title"><?php _e( 'Forum Role: ','wpdance' ); ?></span><?php echo bbp_get_user_display_role(); ?></p>
				<p class="bbp-user-topic-count"><span class="title"><?php _e( 'Topics Started: ','wpdance' ); ?></span><?php echo bbp_get_user_topic_count_raw(); ?></p>
				<p class="bbp-user-reply-count"><span class="title"><?php _e( 'Replies Created: ','wpdance' ); ?></span><?php echo bbp_get_user_reply_count_raw(); ?></p>
				
			</div><!-- #author-avatar -->

			<?php if ( bbp_get_displayed_user_field( 'description' ) ) : ?>

				<p class="bbp-user-description"><?php bbp_displayed_user_field( 'description' ); ?></p>

			<?php endif; ?>
			
		</div>
	</div><!-- #bbp-author-topics-started -->

	<?php do_action( 'bbp_template_after_user_profile' ); ?>
