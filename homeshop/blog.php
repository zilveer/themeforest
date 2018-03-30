<?php
// Template Name: Blog 1 column
?>

<?php
get_header();
 
$sidebar_position_mobile = get_option('sense_settings_sidebar_mobile');
 
$sidebar_id = get_meta_option('custom_sidebar');
$sidebar_position = get_meta_option('sidebar_position_meta_box');

global $page_id; 
$page_id = $post->ID;


$pp = get_option('posts_per_page');
	$query = array(
		'posts_per_page' => $pp,
		'order'    => 'DESC',
		'paged' => ( get_query_var('paged') ? get_query_var('paged') : true ),
		'post_status'     => 'publish'
	  );
	query_posts($query);
?>
   
   
   
   
   
       <?php 
	if( $sidebar_position != 'full'  && $sidebar_position_mobile == 'top' ) {
		if( $sidebar_position == 'left' ) { ?>
		<aside class="sidebar col-lg-3 col-md-3 col-sm-3">
		<?php } if( $sidebar_position == 'right' ) { ?>
		<aside class="sidebar right-sidebar col-lg-3 col-md-3 col-sm-3">
		<?php } ?>
		
		<?php mm_sidebar('blog',$sidebar_id);?>
		</aside>
	<?php } ?>   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   <?php if( $sidebar_position == 'left' ) { ?>
	<section class="main-content s-left col-lg-9 col-md-9 col-sm-9">
	<?php }
	if( $sidebar_position == 'right' ) { ?>
	<section class="main-content col-lg-9 col-md-9 col-sm-9">
	<?php }
	if( $sidebar_position == 'full' ) { ?>
	<section class="main-content col-lg-12 col-md-12 col-sm-12">
	<?php }  ?>
   
   
   <div class="row">
                    	
		<div class="col-lg-12 col-md-12 col-sm-12">
			
			<div class="carousel-heading">
				<h4><?php echo esc_html(get_the_title()); ?></h4>
			</div>
			
		</div>		
  		   
		   <?php if ( have_posts() ) while ( have_posts() ) : the_post(); 
		    $category = get_the_category();
			$num_comments = get_comments_number();
			$format = 'standard';
			if(get_post_meta($post->ID,'meta_blogposttype',true) && get_post_meta($post->ID,'meta_blogposttype',true) !=''){
			$format = get_post_meta($post->ID,'meta_blogposttype',true); 
			}

		    $title1 = get_the_title();
			if($title1 == '') {
			$title1 = 'No Title';
			}
			
			$views   = get_post_meta(get_the_ID(), "views", true);
			if($views == '') {
			$views   = 0;
			}
			
			$read_more = __('Read More', 'homeshop');
			if(get_option('sense_more_text') && get_option('sense_more_text') != '') {
			$read_more = get_option('sense_more_text');  
			}
			
		   ?>
		   
		    <div class="col-lg-12 col-md-12 col-sm-12">      	
				<div <?php post_class('blog-item'); ?> >
		   
					<?php get_template_part( '/postformats/' . $format . '-format' ); ?>
				
					<div class="blog-info">
						<h3><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html($title1); ?></a></h3>
						<div class="blog-meta">
							<span class="date"><i class="icons icon-clock"></i> <?php  the_time('d M Y'); ?></span>
							<span class="cat"><i class="icons icon-tag"></i> <?php echo get_the_category_list( ', ', 'multiple', $post->ID ); ?></span>
							<span class="views"><i class="icons icon-eye-1"></i> <?php echo esc_html($views); ?> <?php _e( 'times', 'homeshop' ); ?></span>
							
							
							
							<div class="rating-box">
								<span><?php _e( 'Rate this item', 'homeshop' ); ?></span>
								<div class="rating readonly-rating" data-score="<?php echo $post->rating; ?>"></div>
								<span>(<?php printf(_n('%d vote', '%d votes', $post->votes, 'homeshop'), $post->votes); ?>)</span>
							</div>
							
						</div>
						
						<p><?php the_excerpt_max_charlength(40); ?></p>
						
					</div>
					
					
					
					<div class="product-actions blog-actions">
						<span class="product-action blog_more">
							<span class="action-wrapper">
								<a href="<?php echo esc_url(get_permalink()); ?>">
								<i class="icons icon-doc-text"></i>
								<span class="action-name"><?php echo $read_more; ?></span>
								</a>
							</span>
						</span>
						<span class="product-action blog_add_comment">
							<span class="action-wrapper">
							    <a href="<?php echo esc_url(get_permalink()); ?>#comment-form">
								<i class="icons icon-pencil-1"></i>
								<span class="action-name"><?php esc_attr_e( 'Add new comment', 'homeshop' ); ?></span>
								</a>
							</span>
						</span>
					</div>
		   
		   
				</div>
		  
			</div>
		   
		   
		   
		   <?php endwhile; ?>
   
			
                            
	
		  
		  
		  
		<!-- Pagination -->
		<div class="col-lg-6 col-md-6 col-sm-6">
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
   

   
   
   
   
    </section>
	<!-- /Main Content -->
   
   
   <?php 
	if( $sidebar_position != 'full'  && $sidebar_position_mobile != 'top' ) {
		if( $sidebar_position == 'left' ) { ?>
		<aside class="sidebar col-lg-3 col-md-3 col-sm-3">
		<?php } if( $sidebar_position == 'right' ) { ?>
		<aside class="sidebar right-sidebar col-lg-3 col-md-3 col-sm-3">
		<?php } ?>
		
		<?php mm_sidebar('blog',$sidebar_id);?>
		</aside>
	<?php } ?>
   
   
   
   

<?php get_footer(); ?>



