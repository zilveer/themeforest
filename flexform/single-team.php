<?php get_header(); ?>

<?php	
	$member_position = get_post_meta($post->ID, 'sf_team_member_position', true);
	$member_email = get_post_meta($post->ID, 'sf_team_member_email', true);
	$member_phone = get_post_meta($post->ID, 'sf_team_member_phone_number', true);
	$member_twitter = get_post_meta($post->ID, 'sf_team_member_twitter', true);
	$member_facebook = get_post_meta($post->ID, 'sf_team_member_facebook', true);
	$member_linkedin = get_post_meta($post->ID, 'sf_team_member_linkedin', true);
	$member_skype = get_post_meta($post->ID, 'sf_team_member_skype', true);
	$member_google_plus = get_post_meta($post->ID, 'sf_team_member_google_plus', true);
	$member_instagram = get_post_meta($post->ID, 'sf_team_member_instagram', true);
	$member_dribbble = get_post_meta($post->ID, 'sf_team_member_dribbble', true);
	$member_image_url = wp_get_attachment_url( get_post_thumbnail_id(), 'full' )
?>

<?php if (have_posts()) : the_post(); ?>
	
	<div class="row">
		<div class="page-heading span12 clearfix alt-bg">
			<h1><?php the_title(); ?></h1>
		</div>
	</div>
	
	<div class="inner-page-wrap clearfix">

		<!-- OPEN article -->
		<article <?php post_class('clearfix '); ?> id="<?php the_ID(); ?>">
			
			<figure class="profile-image-wrap">
				<?php $detail_image = aq_resize( $member_image_url, 440, NULL, true, false); ?>
				
				<?php if ($detail_image) { ?>
					
				<img src="<?php echo $detail_image[0]; ?>" width="<?php echo $detail_image[1]; ?>" height="<?php echo $detail_image[2]; ?>" />
					
				<?php } ?>
			</figure>			
			
			<section class="article-body-wrap">
				<div class="body-text">
					<h4 class="member-position"><?php echo $member_position; ?></h4>
					<?php the_content(); ?>
					<ul class="member-contact">
						<?php if ($member_email) {?><li><span>E:</span> <a href="mailto:<?php echo $member_email; ?>"><?php echo $member_email; ?></a></li><?php } ?>
						<?php if ($member_phone) {?><li><span>P:</span> <?php echo $member_phone; ?></li><?php } ?>
					</ul>
					<ul class="social-icons small">
						<?php if ($member_twitter) {?><li class="twitter"><a href="http://www.twitter.com/<?php echo $member_twitter; ?>" target="_blank">Twitter</a></li><?php } ?>
						<?php if ($member_facebook) {?><li class="facebook"><a href="<?php echo $member_facebook; ?>" target="_blank">Facebook</a></li><?php } ?>
						<?php if ($member_linkedin) {?><li class="linkedin"><a href="<?php echo $member_linkedin; ?>" target="_blank">LinkedIn</a></li><?php } ?>
						<?php if ($member_google_plus) {?><li class="googleplus"><a href="<?php echo $member_google_plus; ?>" target="_blank">Google+</a></li><?php } ?>
						<?php if ($member_skype) {?><li class="skype"><a href="skype:<?php echo $member_skype; ?>" target="_blank">Skype</a></li><?php } ?>
						<?php if ($member_instagram) {?><li class="instagram"><a href="<?php echo $member_instagram; ?>" target="_blank">Instagram</a></li><?php } ?>
						<?php if ($member_dribbble) {?><li class="dribbble"><a href="http://www.dribbble.com/<?php echo $member_dribbble; ?>" target="_blank">Dribbble</a></li><?php } ?>
					</ul>
				</div>
			</section>
		
		<!-- CLOSE article -->
		</article>
		
		<div class="pagination-wrap portfolio-pagination clearfix">
			
			<div class="nav-previous"><?php next_post_link(__('<i class="icon-angle-left"></i> <span class="nav-text">%link</span>', 'swiftframework'), '%title'); ?></div>
			<div class="nav-next"><?php previous_post_link(__('<span class="nav-text">%link</span><i class="icon-angle-right"></i>', 'swiftframework'), '%title'); ?></div>

		</div>
	
	</div>

<?php endif; ?>

<!--// WordPress Hook //-->
<?php get_footer(); ?>