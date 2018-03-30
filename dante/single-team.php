<?php get_header(); ?>

<?php	
	$member_position = sf_get_post_meta($post->ID, 'sf_team_member_position', true);
	$member_email = sf_get_post_meta($post->ID, 'sf_team_member_email', true);
	$member_phone = sf_get_post_meta($post->ID, 'sf_team_member_phone_number', true);
	$member_twitter = sf_get_post_meta($post->ID, 'sf_team_member_twitter', true);
	$member_facebook = sf_get_post_meta($post->ID, 'sf_team_member_facebook', true);
	$member_linkedin = sf_get_post_meta($post->ID, 'sf_team_member_linkedin', true);
	$member_skype = sf_get_post_meta($post->ID, 'sf_team_member_skype', true);
	$member_google_plus = sf_get_post_meta($post->ID, 'sf_team_member_google_plus', true);
	$member_instagram = sf_get_post_meta($post->ID, 'sf_team_member_instagram', true);
	$member_dribbble = sf_get_post_meta($post->ID, 'sf_team_member_dribbble', true);
	$member_xing = sf_get_post_meta($post->ID, 'sf_team_member_xing', true);
	$member_image_url = wp_get_attachment_url( get_post_thumbnail_id(), 'full' );
	$image_alt = esc_attr( sf_get_post_meta( get_post_thumbnail_id() , '_wp_attachment_image_alt', true) );
	
	$same_category_navigation = false;
	if ( isset($options['same_category_navigation']) ) {
		$same_category_navigation = $options['same_category_navigation'];
	}
?>

<div class="container">

	<div class="inner-page-wrap clearfix">
	
		<?php if (have_posts()) : the_post(); ?>
	
			<!-- OPEN article -->
			<article <?php post_class('clearfix '); ?> id="<?php the_ID(); ?>" itemscope itemtype="http://schema.org/Person">
				
				<div class="entry-title" itemprop="name"><?php the_title(); ?></div>
				
				<figure class="profile-image-wrap">
					<?php $detail_image = sf_aq_resize( $member_image_url, 600, NULL, true, false); ?>
					
					<?php if ($detail_image) { ?>
						
					<img itemprop="image" src="<?php echo $detail_image[0]; ?>" width="<?php echo $detail_image[1]; ?>" height="<?php echo $detail_image[2]; ?>" alt="<?php echo $image_alt; ?>" />
						
					<?php } ?>
				</figure>			
				
				<section class="article-body-wrap">
					<div class="body-text">
						<h4 class="member-position" itemscope="jobTitle"><?php echo $member_position; ?></h4>
						<?php the_content(); ?>
						<ul class="member-contact">
							<?php if ($member_email) {?><li><i class="ss-mail"></i><span itemscope="email"><a href="mailto:<?php echo $member_email; ?>"><?php echo $member_email; ?></a></span></li><?php } ?>
							<?php if ($member_phone) {?><li><i class="ss-phone"></i><span itemscope="telephone"><?php echo $member_phone; ?></span></li><?php } ?>
						</ul>
						<ul class="social-icons">
							<?php if ($member_twitter) {?><li class="twitter"><a href="http://www.twitter.com/<?php echo $member_twitter; ?>" target="_blank"><i class="fa-twitter"></i><i class="fa-twitter"></i></a></li><?php } ?>
							<?php if ($member_facebook) {?><li class="facebook"><a href="<?php echo $member_facebook; ?>" target="_blank"><i class="fa-facebook"></i><i class="fa-facebook"></i></a></li><?php } ?>
							<?php if ($member_linkedin) {?><li class="linkedin"><a href="<?php echo $member_linkedin; ?>" target="_blank"><i class="fa-linkedin"></i><i class="fa-linkedin"></i></a></li><?php } ?>
							<?php if ($member_google_plus) {?><li class="googleplus"><a href="<?php echo $member_google_plus; ?>" target="_blank"><i class="fa-google-plus"></i><i class="fa-google-plus"></i></a></li><?php } ?>
							<?php if ($member_skype) {?><li class="skype"><a href="skype:<?php echo $member_skype; ?>" target="_blank"><i class="fa-skype"></i><i class="fa-skype"></i></a></li><?php } ?>
							<?php if ($member_instagram) {?><li class="instagram"><a href="<?php echo $member_instagram; ?>" target="_blank"><i class="fa-instagram"></i><i class="fa-instagram"></i></a></li><?php } ?>
							<?php if ($member_dribbble) {?><li class="dribbble"><a href="http://www.dribbble.com/<?php echo $member_dribbble; ?>" target="_blank"><i class="fa-dribbble"></i><i class="fa-dribbble"></i></a></li><?php } ?>
							<?php if ($member_xing) {?><li class="xing"><a href="<?php echo $member_xing; ?>" target="_blank"><i class="fa-xing"></i><i class="fa-xing"></i></a></li><?php } ?>
						</ul>
					</div>
				</section>
			
			<!-- CLOSE article -->
			</article>
			
			<ul class="post-pagination-wrap curved-bar-styling clearfix">
				<li class="prev"><?php next_post_link('%link', __('<i class="ss-navigateleft"></i> <span class="nav-text">%title</span>', 'swiftframework'), $same_category_navigation, '', 'team-category'); ?></li>
				<li class="next"><?php previous_post_link('%link', __('<span class="nav-text">%title</span><i class="ss-navigateright"></i>', 'swiftframework'), $same_category_navigation, '', 'team-category'); ?></li>
			</ul>
	
		<?php endif; ?>
		
	</div>

</div>

<!--// WordPress Hook //-->
<?php get_footer(); ?>