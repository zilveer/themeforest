<?php function thb_post( $atts, $content = null ) {
   $atts = vc_map_get_attributes( 'thb_post', $atts );
   extract( $atts );
    
	$args = array(
		'showposts' => $item_count, 
		'nopaging' => 0, 
		'post_type'=>'post', 
		'post_status' => 'publish', 
		'ignore_sticky_posts' => 1,
		'no_found_rows' => true,
		'suppress_filters' => 0
	);
	
	if (!empty($cat)) {
		$cats = explode(',',$cat);
		$args = wp_parse_args( array('category__in' => $cats), $args );	
	}

	$posts = new WP_Query( $args );
 	
 	ob_start();
 	
	if ( $posts->have_posts() ) { ?>
	  <?php switch($columns) {
	  	case 2:
	  		$col = 'medium-6';
	  		break;
	  	case 3:
	  		$col = 'medium-4';
	  		break;
	  	case 4:
	  		$col = 'medium-6 large-3';
	  		break;
	  } ?>
		<?php if ($carousel == "yes") { ?>
			
				<div class="carousel posts owl row" data-columns="<?php echo esc_attr($columns); ?>" data-navigation="true" data-bgcheck="false">				
					
					<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
						<article itemscope itemtype="http://schema.org/BlogPosting" <?php post_class('small-12 post columns'); ?> id="post-<?php the_ID(); ?>" role="article">
							<?php 
								set_query_var( 'masonry', false );
								set_query_var( 'grid', true);
								get_template_part( 'inc/postformats/standard' );
							?>
							<header class="post-title">
								<h2 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
							</header>
							<?php get_template_part( 'inc/postformats/post-meta' ); ?>
							
							<div class="post-content bold-text">
								<?php the_excerpt(); ?>
							</div>
						</article>
					<?php endwhile; // end of the loop. ?>	 
										
				</div>
			
		<?php } else {  ?> 
		<div class="posts row">
		
			<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
				<article itemscope itemtype="http://schema.org/BlogPosting" <?php post_class('small-12 '.$col.' item post columns'); ?> id="post-<?php the_ID(); ?>" role="article">
					<?php 
						set_query_var( 'masonry', false );
						set_query_var( 'grid', true);
						get_template_part( 'inc/postformats/standard' );
					?>
					<header class="post-title">
						<h2 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
					</header>
					<?php get_template_part( 'inc/postformats/post-meta' ); ?>
					
					<div class="post-content bold-text">
						<?php the_excerpt(); ?>
						<a href="<?php the_permalink(); ?>" class="more-link"><?php _e( 'Read More', 'north' ); ?></a>
					</div>
				</article>
			<?php endwhile; // end of the loop. ?>
		 
		</div>
		
		<?php } ?>
	   
	<?php }

   $out = ob_get_contents();
   if (ob_get_contents()) ob_end_clean();
   
   wp_reset_query();
   wp_reset_postdata();
     
  return $out;
}
add_shortcode('thb_post', 'thb_post');