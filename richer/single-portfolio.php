<?php get_header(); ?>

<?php get_template_part( 'framework/inc/titlebar' ); ?>
	
<div id="page-wrap" class="container portfolio-detail">
	
	<div id="content">
	
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<?php 
		if ( get_post_meta( get_the_ID(), 'richer_portfolio-detaillayout', true ) == "wide" ) {
			get_template_part( 'framework/inc/portfolio/wide' );
		} elseif( get_post_meta( get_the_ID(), 'richer_portfolio-detaillayout', true ) == "sidebyside" ) {
			get_template_part( 'framework/inc/portfolio/sidebyside' );
		} else {
			get_template_part( 'framework/inc/portfolio/sidebyside' );
		}
		?>
		<div class="clear"></div>
		<?php endwhile; endif; ?>
	</div> <!-- end of content -->
</div> <!-- end of page-wrap -->
<?php if( get_post_meta( get_the_ID(), 'richer_portfolio-relatedposts', true ) == 1 ) { 
// Show related Posts Projects specific 
	get_template_part( 'framework/inc/portfolio/related-posts' );?>
	<div class="clear"></div>
<?php } //end related specific ?>

<?php get_footer(); ?>