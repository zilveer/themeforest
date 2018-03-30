<?php
	global $mr_tailor_theme_options;
	
	if (get_post_meta( $post->ID, 'portfolio_title_meta_box_check', true )) {
		$portfolio_title_option = get_post_meta( $post->ID, 'portfolio_title_meta_box_check', true );
	} else {
		$portfolio_title_option = "on";
	}
	
?>

<?php get_header(); ?>

 <div class="full-width-page page-portfolio-single <?php echo ( (isset($portfolio_title_option)) && ($portfolio_title_option == "on") ) ? 'page-title-shown':'page-title-hidden';?>">
		
    <div id="primary" class="content-area">
	   
		<div id="content" class="site-content" role="main">

			<header class="entry-header entry-header-portfolio-single">
	
				<div class="row">
					<div class="large-10 large-centered columns">
		
						<?php while ( have_posts() ) : the_post(); ?>
    
                            <?php if ( (isset($portfolio_title_option)) && ($portfolio_title_option == "off") ) : ?>
                                <h1 class="entry-title portfolio_item_title"><?php the_title(); ?></h1>
                            <?php endif; ?>
						
						<?php endwhile; // end of the loop. ?>				
						
					</div><!--.large-->
				</div><!--.row-->
	
			</header><!-- .entry-header -->
    
			<div class="entry-content entry-content-portfolio">
				
				<?php while ( have_posts() ) : the_post(); ?>
                	<?php the_content(); ?>
                <?php endwhile; // end of the loop. ?>
				
            </div>

		</div><!-- #content .site-content -->
	
		
		<div class="portfolio_content_nav">
			<?php mr_tailor_content_nav( 'nav-below' ); ?>
		</div>
	
	
	</div><!-- #primary .content-area -->


<?php /*

$terms = get_the_terms( $post->ID, 'portfolio_categories');

if ($terms) {

	$terms_array = array();
	
	foreach ($terms as $term) {
		$terms_array[] = $term->slug;
	}
	
	$args = array(
		'posts_per_page'	=> 5,
		'order_by' 			=> 'rand',
		'post_type' 		=> 'portfolio',
		'post_status' 		=> 'publish',
		'exclude' 			=> $post->ID,
		'tax_query' 		=> array(
							array('taxonomy'	=> 'portfolio_categories',
									'field' 	=> 'slug',
									'terms' 	=> $terms_array
							))
	);
	
	$related = get_posts($args);

}

?>

<?php if (isset($related)) { ?>

	<div class="portfolio-related-container">
		
	<?php foreach( $related as $related_post ) { ?>
		<?php
		
		$related_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($related_post->ID), 'medium' );
		
		?>
		
		<div class="portfolio_related_item">
			<a class="portfolio-related-item-inner hover-effect-link" href="<?php echo get_permalink($related_post->ID); ?>">
				
				<div class="portfolio-related-content hover-effect-content">
					  
					<?php if ($related_thumb[0] != "") : ?>
						<span class="portfolio-related-thumb hover-effect-thumb" style="background-image: url(<?php echo esc_url($related_thumb[0]); ?>)"></span>
					<?php endif; ?>
					
					<h2 class="portfolio-related-title hover-effect-title"><?php echo esc_html($related_post->post_title); ?></h2>
					
					<p class="portfolio-related-categories hover-effect-text">
					   <?php 
						echo strip_tags (
							get_the_term_list( $related_post->ID, 'portfolio_categories', "",", " )
						);
						?>
					</p>
					   
				</div>
				
			</a>
		</div> 
	<?php } ?><!-- endforeach-->
    
	<?php
	
	$related_portfolio_items = count($related);
	
	if ( $related_portfolio_items < 5 ) {
		
		$empty_related_portfolio_items = 5 - $related_portfolio_items;
	
		while ( $empty_related_portfolio_items > 0 ) :
		?>
			<div class="portfolio_related_item item_<?php echo ++$related_portfolio_items; ?>  empty"><span class="hover-effect-link"></span></div>
			
			<?php $empty_related_portfolio_items--; ?>
			
		<?php endwhile; ?>
		
	<?php } ?> <!--endif-->
	
	</div><!--.portfolio-related-container-->
	
<?php } */ ?> <!--endif related-->

</div><!--.full-width-page-->


<?php get_footer(); ?>