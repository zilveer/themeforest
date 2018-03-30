<?php
/**
 * The template for displaying Search Results pages.
 */
get_header(); 
?>


<section class="main-content col-lg-12 col-md-12 col-sm-12">

<?php  if ( ! have_posts() ) { ?>


    <div class="row defoult-search">
                    	
		<div class="col-lg-12 col-md-12 col-sm-12">
			
			<div class="carousel-heading no-margin">
				<h4><?php printf( __( 'Search Results for: %s', 'homeshop' ), '' . get_search_query() . '' ); ?></h4>
			</div>
			
			<div class="page-content">
  		   
		   <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'homeshop' ); ?></p>
			</div>
                            
		</div>
		  
	</div>
<?php } else 
	{
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

	<div class="row defoult-search">
                    	
		<div class="col-lg-12 col-md-12 col-sm-12">
			
			<div class="carousel-heading">
				<h4><?php printf( __( 'Search Results for: %s', 'homeshop' ), '' . get_search_query() . '' ); ?></h4>
			</div>
			
		</div>	
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
		
		$format = 'standard';
			if(get_post_meta($post->ID,'meta_blogposttype',true) && get_post_meta($post->ID,'meta_blogposttype',true) !=''){
			$format = get_post_meta($post->ID,'meta_blogposttype',true); 
			}
		?>
			
		<div class="col-lg-12 col-md-12 col-sm-12">      	
				<div <?php post_class('blog-item blog3column search-res 11'); ?> >
		   
					<?php if( has_post_thumbnail() ): 
					$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); 
					$type = 'full';
					?>
					<p style="text-align:center; margin: 0;">
					<?php the_post_thumbnail($type); ?>
					</p>
					<?php endif; ?>
				
					<div class="blog-info">
						<h3><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html($title1); ?></a></h3>
						<div class="blog-meta">
							<span class="date"><i class="icons icon-clock"></i> <?php  the_time('d M Y'); ?></span>
							<span class="views"><i class="icons icon-eye-1"></i> <?php echo esc_html($views); ?> <?php _e( 'times', 'homeshop' ); ?></span>
						</div>
						
						<p><?php the_excerpt_max_charlength(40); ?></p>
						
					</div>
					
					<div class="product-actions blog-actions">
						<span class="product-action blog_more">
							<span class="action-wrapper">
								<a href="<?php echo esc_url(get_permalink()); ?>">
								<i class="icons icon-doc-text"></i>
								<span class="action-name"><?php $read_more = get_option('sense_more_text');  echo $read_more; ?></span>
								</a>
							</span>
						</span>
					</div>
		   
		   
				</div>
		  
			</div>	
		<?php 
		endwhile; // End the loop.
		?>
	
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

<?php get_footer(); ?>
