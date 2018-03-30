<?php
/*
Template Name: Contact
*/
?>
<?php get_header(); ?>
<?php $locations = ot_get_option('map_locations'); ?>
<aside id="contact-map">
	<div class="contact_map google_map" data-map-style="<?php echo ot_get_option('contact_map_style', 1); ?>" data-map-zoom="<?php echo ot_get_option('contact_zoom', 17); ?>" data-map-center-lat="<?php echo ot_get_option('map_center_lat', '59.93815'); ?>" data-map-center-long="<?php echo ot_get_option('map_center_long', '10.76537'); ?>" data-latlong='<?php echo esc_attr(json_encode($locations)); ?>' data-pin-image="<?php echo ot_get_option('map_pin_image', THB_THEME_ROOT. '/assets/img/pin.png'); ?>"></div>
</aside>
<div class="half_section right">
	<?php if (!wp_is_mobile()) { ?><div class="custom_scroll" id="contact_scroll"><?php } ?>
		<div class="row">
			<section class="twelve columns">
			  <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
			  	<article <?php post_class('post'); ?> id="post-<?php the_ID(); ?>">
			  	  <div class="post-content">
			  	    <?php the_content(); ?>
			  	  </div>
			  	</article>
			  <?php endwhile; else : endif; ?>
			</section>
		</div>
	<?php if (!wp_is_mobile()) { ?></div><?php } ?>
</div>
<?php get_footer(); ?>