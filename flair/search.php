<?php 
	get_header(); 
	
	global $wp_query;
	$total_results = $wp_query->found_posts;
	( $total_results == '1' ) ? $items = __('Item','flair') : $items = __('Items','flair'); 	
?>
		
<div class="pad90"></div>

<div class="container">
	<div class="row">
		<div class="col-sm-12 col-lg-12">
		
			<h1 class="wow fadeInRightBig" data-wow-duration="2s" data-wow-delay="2s">
				<?php echo get_search_query(); ?>
			</h1>
		
			<div class="lead wow fadeInRightBig" data-wow-duration="2s" data-wow-delay="2s">
				<?php echo sprintf( __('Your Search For','flair') . ': <span class="colour">%s</span>, ' . __( 'returned:', 'flair' ) . ' <span class="colour">%s %s</span> ', get_search_query(), $total_results, $items); ?>
			</div>
		
			<div class="row">
			
				<div class="pad30"></div>
				
				<div class="col-md-8">

					<?php 
						if ( have_posts() ) : while ( have_posts() ) : the_post();
							
							/**
							 * Get blog posts by blog layout.
							 */
							get_template_part('loop/content', 'post');
						
						endwhile;	
						else : 
							
							/**
							 * Display no posts message if none are found.
							 */
							get_template_part('loop/content','none');
							
						endif;
					?>
				
				</div>
				<!--/col-md-8-->
			
				<?php get_sidebar(); ?>
			
			</div>
			<!--/row-->
			
			<?php 
				/**
				 * Post pagination, use ebor_pagination() first and fall back to default
				 */
				echo function_exists('ebor_pagination') ? ebor_pagination() : posts_nav_link();
			?>
			
		</div>
	</div>
</div>
	
<?php 
	get_footer();