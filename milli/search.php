<?php 
	get_header();
	
	global $wp_query;
	$total_results = $wp_query->found_posts;
	( $total_results == '1' ) ? $items = __('Item','ebor_starter') : $items = __('Items','ebor_starter'); 
	$search_intro = sprintf( __('Your Search For:','ebor_starter') . ' %s, ' . __( 'Returned:', 'ebor_starter' ) . ' %s %s ', get_search_query(), $total_results, $items);
	
	get_sidebar();
?>
	
	<section id="content" class="clearfix">
	
		<article>
			<h2 class="article-title"><?php echo $search_intro; ?></h2>
		</article>
		
		<?php 
			if ( have_posts() ) : while ( have_posts() ) : the_post();
				
				get_template_part('loop/content','main');
			
			endwhile;	
			else : 
				
				get_template_part('loop/content','none');
				
			endif;
			
			echo function_exists('ebor_pagination') ? ebor_pagination() : posts_nav_link();
		?>
	
	</section>

<?php	
	get_footer();