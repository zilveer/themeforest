<?php
if ( ! isset( $retro_portfolio_args ) ) {
	$retro_portfolio_args = array(
		'portfolio_id' => $post->ID,
		'post_type' => 'portfolio-' . $post->ID,
		'nopaging' => true
	);
}

$retro_portfolio_query = new WP_Query( $retro_portfolio_args );

if ( ! $retro_portfolio_query->have_posts() )
 	return;
?>

<hr class="top-dashed"> 

<div class="container portfolio" data-id="<?php esc_attr_e( $retro_portfolio_args['portfolio_id'] ); ?>">

	<div class="row clear">
		
		<?php get_template_part( 'section', 'title' ); ?>

	</div><!-- row -->

	<div class="filters">

		<div class="filter-label">Filter by</div>

		<ul class="cats">

			<?php foreach ( get_terms( 'tags-' . $retro_portfolio_args['portfolio_id'] ) as $tag ) : ?>
					
			<li data-slug="<?php esc_attr_e( $tag->slug ); ?>"><span><?php echo $tag->name; ?></span></li>
			
			<?php endforeach; ?>

		</ul>

	</div><!-- filters --> 

	<div class="portfolio-list">
		
		<ul class="row clear">
			
			<?php while ( $retro_portfolio_query->have_posts() ) : ?>
			
				<?php $retro_portfolio_query->the_post(); ?>
				
				<?php get_template_part( 'part', 'item' ); ?>
			
			<?php endwhile; ?>
		
		</ul>

	</div><!-- portfolio-list -->


	<?php if ( is_page_template( 'template-home.php' ) ) : ?>
	
		<div class="more-posts">

			<a href="<?php echo esc_url( get_permalink( $retro_portfolio_args['portfolio_id'] ) ); ?>"><?php _e( 'Browse all', 'openframe' ); ?></a>

		</div>
	
	<?php endif; ?>	                 
		 
</div><!-- container -->

<hr class="bottom-dashed">             

<?php wp_reset_postdata(); ?>