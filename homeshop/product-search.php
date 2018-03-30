<?php
/* Template Name: Custom Search */  
get_header(); 

?>



	<?php if( get_option('sense_sidebar_search_page') == 'left' ) { ?>
	<section class="main-content col-lg-9 col-md-9 col-sm-9 col-lg-push-3 col-md-push-3 col-sm-push-3">
	<?php }
	if( get_option('sense_sidebar_search_page') == 'right' ) { ?>
	<section class="main-content col-lg-9 col-md-9 col-sm-9">
	<?php } ?>
	<?php 
	if( get_option('sense_sidebar_search_page') == '' || get_option('sense_sidebar_search_page') == 'full'  ) { ?>
	<section class="main-content col-lg-12 col-md-12 col-sm-12">
	<?php } ?>
	
	




<?php  if ( ! have_posts() ) { ?>


    <div class="row custom-search">
                    	
		<div class="col-lg-12 col-md-12 col-sm-12">
			
			<div class="carousel-heading no-margin">
				<h4><?php printf( __( 'Search Results for: %s', 'homeshop' ), '' . get_search_query() . '' ); ?></h4>
			</div>
			
			<div class="page-content">
  		   
		   <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'homeshop' ); ?></p>

   
			</div>
                            
		</div>
		  
	</div>


<?php } else {
	$pp = get_option('posts_per_page');
	if ($pp == '') { $pp = 10;};
	if ( !is_archive() && !is_search() ) :
		$query = array(
			'posts_per_page' => $pp,
			'order'    => 'DESC',
			'paged' => ( get_query_var('paged') ? get_query_var('paged') : true ),
			'post_status'     => 'publish'
		  );
		 query_posts($query);
	endif; ?>

	
	
	<div class="row custom-search">
                    	
		<div class="col-lg-12 col-md-12 col-sm-12 custom-search-title">
			
			<div class="carousel-heading">
				<h4><?php printf( __( 'Search Results for: %s', 'homeshop' ), '' . get_search_query() . '' ); ?></h4>
			</div>
			
		</div>	
	
	<?php 
	$type_search = 'list';
	
	if(get_option('sense_product_search_type') && get_option('sense_product_search_type') == 'grid' ) {
		$type_search = 'grid';
	}
	?>
	
<ul class="products <?php echo $type_search; ?>">
		<?php
		while ( have_posts() ) : 
		
		the_post(); 
		
		$title1 = get_the_title();
		if($title1 == '') {
			$title1 = 'No Title';
		}
			
		$views   = get_post_meta(get_the_ID(), "views", true);
		if($views == '') {
		$views   = 0;
		}
		?>
		


<?php wc_get_template_part( 'content', 'product' ); ?>



		
		
		<?php 
		endwhile; // End the loop.
		?>
</ul>	
	
	
	<!-- Pagination -->
		<div class="col-lg-6 col-md-6 col-sm-6" style="clear: both;" >
			<div class="category-results">
				<p>
				<?php
				$paged    = max( 1, $wp_query->get( 'paged' ) );
				$per_page = $wp_query->get( 'posts_per_page' );
				$total    = $wp_query->found_posts;
				$first    = ( $per_page * $paged ) - $per_page + 1;
				$last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );

				if ( 1 == $total ) {
					_e( 'Results the single result', 'homeshop' );
				} elseif ( $total <= $per_page || -1 == $per_page ) {
					printf( __( 'Results 1-%d ', 'homeshop' ), $total );
				} else {
					printf( _x( 'Results %1$d–%2$d of %3$d ', '%1$d = first, %2$d = last, %3$d = total', 'homeshop' ), $first, $last, $total );
				}
				?>
				</p>
			</div>
		</div>
	
	    <div class="col-lg-6 col-md-6 col-sm-6">
			<?php if ( $wp_query->max_num_pages > 1 ) { ?>
				<div class="pagination">
				<?php
				
				$args = array(
					'base' 			=> str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
						'format' 		=> '',
						'current' 		=> max( 1, get_query_var('paged') ),
						'total' 		=> $wp_query->max_num_pages,
						'prev_text' 	=> '<div class="previous"><i class="icons icon-left-dir"></i></div>',
						'next_text' 	=> '<div class="next"><i class="icons icon-right-dir"></i></div>',
						'type'			=> 'plain',
						'end_size'		=> 3,
						'mid_size'		=> 3
				); 
				
					echo paginate_links( $args );
				?>
			    </div>
			<?php } ?>
		</div> 
	
	
	
		  
	</div>
	
	
	
<?php } ?>




</section>
	<!-- /Main Content -->




	<!-- Sidebar -->
	<?php if( get_option('sense_sidebar_search_page') == 'left' ) { ?>
	<aside class="sidebar col-lg-3 col-md-3 col-sm-3  col-lg-pull-9 col-md-pull-9 col-sm-pull-9">
	<?php dynamic_sidebar( 'Shop Product Search' ); ?>
	</aside>
	<?php } ?>
	
	
	<?php if( get_option('sense_sidebar_search_page') == 'right' ) { ?>
	<aside class="sidebar right-sidebar col-lg-3 col-md-3 col-sm-3">
	<?php dynamic_sidebar( 'Shop Product Search' ); ?>
	</aside>
	<?php } ?>

	<!-- /Sidebar -->
	
	



<?php get_footer(); ?>
