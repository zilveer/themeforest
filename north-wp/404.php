<?php get_header(); ?>
<?php if (ot_get_option('404-image')) { $image = ot_get_option('404-image'); } else { $image = THB_THEME_ROOT. '/assets/img/404.png'; } ?>
<section class="content404">
	<div class="row">
		<div class="small-12 medium-10 medium-centered large-7 columns text-center">
			<img src="<?php echo esc_url($image); ?>" alt="<?php _e( "Error 404", 'north' ); ?>" class="animation fade-in"/>
			<h3 class="animation fade-in"><?php _e( "WE COULDN'T FIND THE PAGE<br> YOU ARE LOOKING FOR.", 'north' ); ?></h3>
		</div>
  </div>
</section>
<?php get_footer(); ?>