<?php
/**
 *	Template Name: Our Staff Page
 *
 * The template for displaying staff memebers
 */

get_header();
the_post();
$subtitle = rwmb_meta("subtitle");
$header_image = rwmb_meta('header_image',array('type' => 'file' ));
$header_bg_color = rwmb_meta('header_bg_color');
?>
</section>
	<?php 
if ( $header_image && count($header_image)>0 ) :
				foreach ( $header_image as $himggg ) :
			  	if (empty($himggg)) break; 
			  	if ( $header_bg_color ) : ?>
					<div class="flat_pagetop" style="color:<?php echo $header_bg_color; ?> !important;background:url(<?php echo $himggg['url'];?>);">
				<?php else : ?>
					<div class="flat_pagetop" style="background:url(<?php echo $himggg['url']; ?>);">
				<?php endif; ?>
<?php break; endforeach;

else :
 ?>
	<div class="flat_pagetop">
<?php endif; ?>
		<section id="content" class="container">

		<div class="grid12 col">
<?php if (!empty($subtitle)) : ?>
			<h1 class="page-title left"><?php the_title(); ?></h1>
			<div class="subtitle">
				<p class="small gray"><?php echo $subtitle; ?></p>
			</div>
			<div class="clear"></div>
<?php else : ?>
			<h1 class="page-title"><?php the_title(); ?></h1>
<?php endif; ?>
		</div>


</section>
	</div>
		<section id="content" class="container">

		<div class="grid12 col">
			<p></p>
			<?php echo content(); ?>

		</div>
<?php
query_posts(array(
	'post_type' => array('staff-members'),
	'post_status' => 'publish',
	'order' => 'ASC',
	'orderby' => 'menu_order',
	'posts_per_page' => -1
));
if (have_posts()) :
	while(have_posts()) :
		the_post();
		$facebook_url = rwmb_meta("social_link_facebook");
		$twitter_url = rwmb_meta("social_link_twitter");
		$googleplus_url = rwmb_meta("social_link_googleplus");
		$email_address = rwmb_meta("social_link_email");
		$staff_image_extend = rwmb_meta("staff_big_image"); ?>
		<div class="<?php if ($staff_image_extend) echo 'grid6'; else echo 'grid3'; ?> col staff">
			<div class="thumb half-bottom<?php echo $smof_data['css3_animation_class']; ?>">
<?php if ( (function_exists('has_post_thumbnail')) && has_post_thumbnail() ) :
			$full_image_url = wp_get_attachment_url( get_post_thumbnail_id(), 'full' );
			if ($staff_image_extend)
				$thumb_image_url = aq_resize( $full_image_url, 580, 280, true );
			else
				$thumb_image_url = aq_resize( $full_image_url, 480, 480, true ); ?>
				<a href="<?php echo $full_image_url; ?>" class="lightbox"><img src="<?php echo $thumb_image_url; ?>" class="scale" alt="" /></a>
				<div class="info pattern">
					<a href="<?php echo $full_image_url; ?>" class="button-fullsize"></a>
				</div>
<?php		else:
				if ($staff_image_extend)
					$thumb_image_url = get_template_directory_uri().'/img/staff-members.png';
				else
					$thumb_image_url = get_template_directory_uri().'/img/staff-member.png'; ?>
				<a><img src="<?php echo $thumb_image_url; ?>" class="scale" alt="" /></a>
<?php 	endif; ?>
			</div>
			<h5 class="float-left bold_title half-bottom"><?php the_title(); ?></h5>
			
			<div class="clear"></div>
			<div class="small_text"><?php the_excerpt(); ?></div>

			<div class="float-left">
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
		

		</div>

<?php endwhile; ?>
		<div class="clear"></div>
		<?php pagination_links(); ?>
<?php
	else:
		get_template_part( 'noresult' );
	endif; ?>

<?php get_footer(); ?>