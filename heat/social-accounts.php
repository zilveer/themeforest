<?php
$social_accounts = ot_get_option( 'social_accounts' );
// Facebook
if ( ! empty( $social_accounts[0] ) ) :
$facebook_url = ot_get_option( 'facebook_url' );
?>
	<a class="social" href="<?php echo $facebook_url; ?>" target="_blank" rel="nofollow">
		<span id="facebook" class="social-icon"></span>
	</a>
<?php endif; // end if ?>

<?php
// Twitter
if ( ! empty( $social_accounts[1] ) ) :
$twitter_url = ot_get_option( 'twitter_url' );
?>
	<a class="social" href="<?php echo $twitter_url; ?>" target="_blank" rel="nofollow">
		<span id="twitter" class="social-icon"></span>
	</a>
<?php endif; // end if ?>

<?php 
// Google Plus
if ( ! empty( $social_accounts[2] ) ) :
$gplus_url = ot_get_option( 'gplus_url' );
?>
	<a class="social" href="<?php echo $gplus_url; ?>" target="_blank" rel="nofollow">
		<span id="gplus" class="social-icon"></span>
	</a>
<?php endif; // end if ?>

<?php // LinkedIn
if ( ! empty( $social_accounts[3] ) ) :
$linkedin_url = ot_get_option( 'linkedin_url' );
?>
	<a class="social" href="<?php echo $linkedin_url; ?>" target="_blank" rel="nofollow">
		<span id="linkedin" class="social-icon"></span>
	</a>
<?php endif; // end if ?>

<?php // Dribbble
if ( ! empty( $social_accounts[4] ) ) :
$dribbble_url = ot_get_option( 'dribbble_url' );
?>
	<a class="social" href="<?php echo $dribbble_url; ?>" target="_blank" rel="nofollow">
		<span id="dribbble" class="social-icon"></span>
	</a>
<?php endif; // end if ?>

<?php // Pinterest
if ( ! empty( $social_accounts[5] ) ) :
$pinterest_url = ot_get_option( 'pinterest_url' );
?>
	<a class="social" href="<?php echo $pinterest_url; ?>" target="_blank" rel="nofollow">
		<span id="pinterest" class="social-icon"></span>
	</a>
<?php endif; // end if ?>

<?php // Foursquare
if ( ! empty( $social_accounts[6] ) ) :
$foursquare_url = ot_get_option( 'foursquare_url' );
?>
	<a class="social" href="<?php echo $foursquare_url; ?>" target="_blank" rel="nofollow">
		<span id="foursquare" class="social-icon"></span>
	</a>
<?php endif; // end if ?>

<?php // Instagram
if ( ! empty( $social_accounts[7] ) ) :
$instagram_url = ot_get_option( 'instagram_url' );
?>
	<a class="social" href="<?php echo $instagram_url; ?>" target="_blank" rel="nofollow">
		<span id="instagram" class="social-icon"></span>
	</a>
<?php endif; // end if ?>

<?php // Vimeo
if ( ! empty( $social_accounts[8] ) ) :
$vimeo_url = ot_get_option( 'vimeo_url' );
?>
	<a class="social" href="<?php echo $vimeo_url; ?>" target="_blank" rel="nofollow">
		<span id="vimeo" class="social-icon"></span>
	</a>
<?php endif; // end if ?>

<?php // Flickr
if ( ! empty( $social_accounts[9] ) ) :
$flickr_url = ot_get_option( 'flickr_url' );
?>
	<a class="social" href="<?php echo $flickr_url; ?>" target="_blank" rel="nofollow">
		<span id="flickr" class="social-icon"></span>
	</a>
<?php endif; // end if ?>

<?php // GitHub
if ( ! empty( $social_accounts[10] ) ) :
$github_url = ot_get_option( 'github_url' );
?>
	<a class="social" href="<?php echo $github_url; ?>" target="_blank" rel="nofollow">
		<span id="github" class="social-icon"></span>
	</a>
<?php endif; // end if ?>

<?php // Tumblr
if ( ! empty( $social_accounts[11] ) ) :
$tumblr_url = ot_get_option( 'tumblr_url' );
?>
	<a class="social" href="<?php echo $tumblr_url; ?>" target="_blank" rel="nofollow">
		<span id="tumblr" class="social-icon"></span>
	</a>
<?php endif; // end if ?>

<?php // Forrst
if ( ! empty( $social_accounts[12] ) ) :
$forrst_url = ot_get_option( 'forrst_url' );
?>
	<a class="social" href="<?php echo $forrst_url; ?>" target="_blank" rel="nofollow">
		<span id="forrst" class="social-icon"></span>
	</a>
<?php endif; // end if ?>

<?php // Last.fm
if ( ! empty( $social_accounts[13] ) ) :
$lastfm_url = ot_get_option( 'lastfm_url' );
?>
	<a class="social" href="<?php echo $lastfm_url; ?>" target="_blank" rel="nofollow">
		<span id="lastfm" class="social-icon"></span>
	</a>
<?php endif; // end if ?>

<?php // StumbleUpon
if ( ! empty( $social_accounts[14] ) ) :
$stumbleupon_url = ot_get_option( 'stumbleupon_url' );
?>
	<a class="social" href="<?php echo $stumbleupon_url; ?>" target="_blank" rel="nofollow">
		<span id="stumbleupon" class="social-icon"></span>
	</a>
<?php endif; // end if ?>

<?php // 500px
if ( ! empty( $social_accounts[15] ) ) :
$px_url = ot_get_option( 'px_url' );
?>
	<a class="social" href="<?php echo $px_url; ?>" target="_blank" rel="nofollow">
		<span id="px" class="social-icon"></span>
	</a>
<?php endif; // end if ?>

<?php // RSS
if ( ! empty( $social_accounts[16] ) ) :
$feed_url = ot_get_option( 'feed_url' );
?>
	<a class="social" href="<?php echo $feed_url; ?>" target="_blank" rel="nofollow">
		<span id="feed" class="social-icon"></span>
	</a>
<?php endif; // end if ?>

<?php // YouTube
if ( ! empty( $social_accounts[17] ) ) :
$youtube_url = ot_get_option( 'youtube_url' );
?>
	<a class="social" href="<?php echo $youtube_url; ?>" target="_blank" rel="nofollow">
		<span id="youtube" class="social-icon"></span>
	</a>
<?php endif; // end if ?>

<?php // Behance
if ( ! empty( $social_accounts[18] ) ) :
$behance_url = ot_get_option( 'behance_url' );
?>
	<a class="social" href="<?php echo $behance_url; ?>" target="_blank" rel="nofollow">
		<span id="behance" class="social-icon"></span>
	</a>
<?php endif; // end if ?>

<?php // VK
if ( ! empty( $social_accounts[19] ) ) :
$vk_url = ot_get_option( 'vk_url' );
?>
	<a class="social" href="<?php echo $vk_url; ?>" target="_blank" rel="nofollow">
		<span id="vk" class="social-icon"></span>
	</a>
<?php endif; // end if ?>
				