<?php // You might need to use wp_reset_query(); 
global $post;
$current_post_type = get_post_type( $post );
$terms = get_the_terms( $post->ID , 'portfolio_type' ); 
$term_ids = array_values( wp_list_pluck( $terms,'term_id' ) );
$args = array(
    'posts_per_page' => 3,
    'order' => 'rand',
	'ignore_sticky_posts'   => 1,
    'orderby' => 'ID',
    'post_type' => $current_post_type,
    'post__not_in' => array( $post->ID ),
	
	'tax_query' => array(
	        array(
	            'taxonomy'  => 'portfolio_type',
	            'terms'     => $term_ids,
				'field' => 'id',
	            'operator'  => 'IN'
	        )
	    ),	
);
$count = 1;
$count_2 = 1;
$rel_query = new WP_Query( $args );
if( $rel_query->have_posts() ) : 
?>
<div id="related-portfolio-pro">
	<div class="width-container">
		<h2><?php _e( 'Related Projects', 'progression' ); ?></h2>
		<?php
		    // The Loop
		    while ( $rel_query->have_posts() ) :
		        $rel_query->the_post();
			
				if($count >= 4) { $count = 1; }
		?>
		<div class="grid3column-progression<?php if($count == 3): echo ' lastcolumn-progression'; endif; ?>">
			<?php get_template_part( 'content', 'portfolio'); ?>
		</div>
		<?php $count ++; $count_2++; endwhile; ?>
  <div class="clearfix"></div>
  </div>
</div><!-- #related-portfolio-pro -->
<?php endif;	wp_reset_query(); ?>