<?php
/* Template Name: Home */ 
?>
<?php 
get_header();
?>

<div id="main-content" class="main-content home-page <?php echo tm_sidebar_position(); ?> <?php echo tm_page_layout(); ?>">
  <?php
	if ( is_front_page() && templatemela_has_featured_posts() ) {
		// Include the featured content template.
		get_template_part( 'featured-content' );
	}
?>

  <div id="primary" class="content-area">
  <?php if (is_page_template('page-templates/home.php') ) : ?>
				<div id="revolutionslider">
					<div class="revolutionslider-inner">
						<?php if ( in_array( 'revslider/revslider.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) : ?>	
						<?php echo do_shortcode('[rev_slider '.get_option('tmoption_revslider_alias').']'); ?>
						<?php endif; ?>
					</div>
				</div>			
			<?php endif; ?>
    <div id="content" class="site-content" role="main">
      <?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

					// Include the page content template.
					get_template_part( 'content', 'page' ); ?>
      
      <?php endwhile;
			?>
    </div>
    <!-- #content -->
  </div>
  <!-- #primary -->
  <?php get_sidebar(); ?>
</div>
<!-- #main-content -->
<?php get_footer(); ?>
