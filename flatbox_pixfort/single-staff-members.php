<?php
/**
 * Template used for displaying single post information
 */

get_header();

the_post();
$facebook_url = rwmb_meta("social_link_facebook");
$twitter_url = rwmb_meta("social_link_twitter");
$googleplus_url = rwmb_meta("social_link_googleplus");
$email_address = rwmb_meta("social_link_email");
if ( (function_exists('has_post_thumbnail')) && has_post_thumbnail() ) :
	$full_image_url = wp_get_attachment_url( get_post_thumbnail_id(), 'full' );
	$thumb_image_url = aq_resize( $full_image_url, 480, 480, true );
else :
	$thumb_image_url = get_template_directory_uri().'/img/staff-member.png';
endif; ?>

</section>
	<div class="flat_pagetop">
		<section id="content" class="container">

		<div class="grid12 col">
			<h1 class="page-title"><?php the_title(); ?></h1>
		</div>


</section>
	</div>
		<section id="content" class="container">
			<p></p>
		<div class="grid6 col staff">
			<div class="thumb half-bottom">
<?php if ( (function_exists('has_post_thumbnail')) && has_post_thumbnail() ) :
			$full_image_url = wp_get_attachment_url( get_post_thumbnail_id(), 'full' );
			if ($staff_image_extend)
				$thumb_image_url = aq_resize( $full_image_url, 580, 280, true );
			else
				$thumb_image_url = aq_resize( $full_image_url, 580, 580, true ); ?>
				<a href="<?php echo $full_image_url; ?>" class="lightbox<?php echo $smof_data['css3_animation_class']; ?>"><img src="<?php echo $thumb_image_url; ?>" class="scale" alt="" /></a>
				<div class="info pattern">
					<a href="<?php echo $full_image_url; ?>" class="button-fullsize"></a>
				</div>
<?php		else:
				if (!empty($staff_image_extend))
					$thumb_image_url = get_template_directory_uri().'/img/staff-members.png';
				else
					$thumb_image_url = get_template_directory_uri().'/img/staff-member.png'; ?>
				<a><img src="<?php echo $thumb_image_url; ?>" class="scale" alt="" /></a>
<?php 	endif; ?>
			</div>
		</div>
		<div class="grid6 col staff">
			<h5 class="float-left bold_title half-bottom"><p></p><?php the_title(); ?></h5>
			<div class="float-right">
<?php if ($facebook_url) : ?>
				<a href="<?php echo $facebook_url; ?>" target="_blank" class="social-link social-facebook <?php echo $smof_data['css3_animation_class']; ?>" data-tip="<?php _e( 'Facebook', 'flatbox' ); ?>"></a>
<?php endif; ?>
<?php if ($twitter_url) : ?>
				<a href="<?php echo $twitter_url; ?>" target="_blank" class="social-link social-twitter <?php echo $smof_data['css3_animation_class']; ?>" data-tip="<?php _e( 'Twitter', 'flatbox' ); ?>"></a>
<?php endif; ?>
<?php if ($googleplus_url) : ?>
				<a href="<?php echo $googleplus_url; ?>" target="_blank" class="social-link social-googleplus <?php echo $smof_data['css3_animation_class']; ?>" data-tip="<?php _e( 'Google+', 'flatbox' ); ?>"></a>
<?php endif; ?>
<?php if ($email_address) : ?>
				<a href="mailto:<?php echo $email_address; ?>" class="social-link social-email <?php echo $smof_data['css3_animation_class']; ?>" data-tip="<?php _e( 'Email', 'flatbox' ); ?>"></a>
<?php endif; ?>
			</div>
			<div class="clear"></div>
			<div class="small_text"><?php the_content(); ?></p>

		</div>
		

<?php get_footer(); ?>