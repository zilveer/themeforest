<?php $social_accounts = ot_get_option( 'social_accounts' ); ?>
<?php if ( ! empty( $social_accounts ) ) : ?>
<div class="social-accounts">
<?php endif; // end if ?>
	<?php
	$social_accounts = ot_get_option( 'social_accounts' );
	// Facebook
	if ( ! empty( $social_accounts[0] ) ) :
	$facebook_url = ot_get_option( 'facebook_url' );
	?>
		<a class="social facebook" href="<?php echo esc_url( $facebook_url ); ?>" target="_blank" rel="nofollow">
			<span class="social-icon"></span>
		</a>
	<?php endif; // end if ?>

	<?php
	// Twitter
	if ( ! empty( $social_accounts[1] ) ) :
	$twitter_url = ot_get_option( 'twitter_url' );
	?>
		<a class="social twitter" href="<?php echo esc_url( $twitter_url ); ?>" target="_blank" rel="nofollow">
			<span class="social-icon"></span>
		</a>
	<?php endif; // end if ?>
	
	<?php 
	// Google Plus
	if ( ! empty( $social_accounts[2] ) ) :
	$gplus_url = ot_get_option( 'gplus_url' );
	?>
		<a class="social gplus" href="<?php echo esc_url( $gplus_url ); ?>" target="_blank" rel="nofollow">
			<span class="social-icon"></span>
		</a>
	<?php endif; // end if ?>

	<?php // LinkedIn
	if ( ! empty( $social_accounts[3] ) ) :
	$linkedin_url = ot_get_option( 'linkedin_url' );
	?>
		<a class="social linkedin" href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank" rel="nofollow">
			<span class="social-icon"></span>
		</a>
	<?php endif; // end if ?>
	

	<?php // Pinterest
	if ( ! empty( $social_accounts[4] ) ) :
	$pinterest_url = ot_get_option( 'pinterest_url' );
	?>
		<a class="social pinterest" href="<?php echo esc_url( $pinterest_url ); ?>" target="_blank" rel="nofollow">
			<span class="social-icon"></span>
		</a>
	<?php endif; // end if ?>

	<?php // Instagram
	if ( ! empty( $social_accounts[5] ) ) :
	$instagram_url = ot_get_option( 'instagram_url' );
	?>
		<a class="social instagram" href="<?php echo esc_url( $instagram_url ); ?>" target="_blank" rel="nofollow">
			<span class="social-icon"></span>
		</a>
	<?php endif; // end if ?>

	<?php // Vimeo
	if ( ! empty( $social_accounts[6] ) ) :
	$vimeo_url = ot_get_option( 'vimeo_url' );
	?>
		<a class="social vimeo" href="<?php echo esc_url( $vimeo_url ); ?>" target="_blank" rel="nofollow">
			<span class="social-icon"></span>
		</a>
	<?php endif; // end if ?>

	<?php // Flickr
	if ( ! empty( $social_accounts[7] ) ) :
	$flickr_url = ot_get_option( 'flickr_url' );
	?>
		<a class="social flickr" href="<?php echo esc_url( $flickr_url ); ?>" target="_blank" rel="nofollow">
			<span class="social-icon"></span>
		</a>
	<?php endif; // end if ?>

	<?php // Tumblr
	if ( ! empty( $social_accounts[8] ) ) :
	$tumblr_url = ot_get_option( 'tumblr_url' );
	?>
		<a class="social tumblr" href="<?php echo esc_url( $tumblr_url ); ?>" target="_blank" rel="nofollow">
			<span class="social-icon"></span>
		</a>
	<?php endif; // end if ?>

	<?php // RSS
	if ( ! empty( $social_accounts[9] ) ) :
	$feed_url = ot_get_option( 'feed_url' );
	?>
		<a class="social feed" href="<?php echo esc_url( $feed_url ); ?>" target="_blank" rel="nofollow">
			<span class="social-icon"></span>
		</a>
	<?php endif; // end if ?>

	<?php // YouTube
	if ( ! empty( $social_accounts[10] ) ) :
	$youtube_url = ot_get_option( 'youtube_url' );
	?>
		<a class="social youtube" href="<?php echo esc_url( $youtube_url ); ?>" target="_blank" rel="nofollow">
			<span class="social-icon"></span>
		</a>
	<?php endif; // end if ?>

	<?php // Behance
	if ( ! empty( $social_accounts[11] ) ) :
	$behance_url = ot_get_option( 'behance_url' );
	?>
		<a class="social behance" href="<?php echo esc_url( $behance_url ); ?>" target="_blank" rel="nofollow">
			<span class="social-icon"></span>
		</a>
	<?php endif; // end if ?>
	
	<?php // Dribbble
	if ( ! empty( $social_accounts[12] ) ) :
	$dribbble_url = ot_get_option( 'dribbble_url' );
	?>
		<a class="social dribbble" href="<?php echo esc_url( $dribbble_url ); ?>" target="_blank" rel="nofollow">
			<span class="social-icon"></span>
		</a>
	<?php endif; // end if ?>
<?php if ( ! empty( $social_accounts ) ) : ?>
</div>
<?php endif; // end if ?>

				