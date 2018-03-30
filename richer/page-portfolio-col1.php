<?php
/*
Template Name: Portfolio 1 Column
*/
?>

<?php get_header(); ?>

<?php get_template_part( 'framework/inc/titlebar' ); ?>
	
<div id="page-wrap" class="container portfolio">

	<!-- Content -->
	<div id="content" class="span12">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
		<article class="post" id="post-<?php the_ID(); ?>">
		
			<div class="entry">
				
				<?php the_content(); ?>

				<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>

			</div>

		</article>

		<?php endwhile; endif; ?>
	</div>
	<!-- End: content -->
	
	<?php if(get_post_meta(get_the_ID(), 'richer_show-portfolio-filter',true) == 1) get_template_part('framework/inc/portfolio/folio-filter')?>
	<div class="span12">
		<div id="portfolio-wrap">
			<?php
				global $wp_query;
				$portfolioitems = $options_data['text_portfolioitems_1']; // Get Items per Page Value
				$paged = get_query_var('paged') ? get_query_var('paged') : 1;
				$args = array(
					'post_type' 		=> 'portfolio',
					'posts_per_page' 	=> $portfolioitems,
					'post_status' 		=> 'publish',
					'orderby' 			=> 'date',
					'order' 			=> 'DESC',
					'paged' 			=> $paged
				);
				
				// Only pull from selected Filters if chosen
				$selectedfilters = get_post_meta(get_the_ID(), 'richer_portfoliofilter', false);
				if($selectedfilters && $selectedfilters[0] == 0) {
					unset($selectedfilters[0]);
				}
				if($selectedfilters){
					$args['tax_query'][] = array(
						'taxonomy' 	=> 'portfolio_filter',
						'field' 	=> 'ID',
						'terms' 	=> $selectedfilters
					);
				}
				
				$wp_query = new WP_Query($args);
				
				while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

				<?php $terms = get_the_terms( get_the_ID(), 'portfolio_filter' ); ?>              	
				<div class="<?php if($terms) : foreach ($terms as $term) { echo 'term-'.$term->slug.' '; } endif; ?>portfolio-item portfolio-item-one row">
					
					<?php // Define if Lightbox Link or Not
					static $gallery_id;
					++$gallery_id;

					global $wpdb, $post;
				    $meta = get_post_meta( get_the_ID( ), 'richer_screenshot', false );
				    if ( !is_array( $meta ) )
				    	$meta = ( array ) $meta;
				    if ( !empty( $meta ) ) {
				    	$meta = implode( ',', $meta );
				    	$images = $wpdb->get_col( "
				    	SELECT ID FROM $wpdb->posts
				    	WHERE post_type = 'attachment'
				    	AND ID IN ( $meta )
				    	ORDER BY menu_order ASC
				    	" );
				    }
						
					///// ?>
					<div class="span8">	
					<?php 
					if( get_post_meta( get_the_ID(), 'richer_screenshot', true ) != "" && get_post_meta( get_the_ID( ), 'richer_gridlayout', true ) != "true"){
				    	if(!empty($images)){ 
					    		echo "<script>
									jQuery(window).load(function(){
										jQuery('.portfolio-slider-".$gallery_id."').flexslider({
											animation: 'fade',
											smoothHeight: true,
											controlNav: false,
											directionNav: true,
											touch: true
										});
									});
								</script>";?>		
								<div id="portfolio-slider" class="portfolio-slider-<?php echo $gallery_id; ?> flexslider">
									<ul class="slides">
								   <?php	
								   foreach ( $images as $att ) {
								    		// Get image's source based on size, can be 'thumbnail', 'medium', 'large', 'full' or registed post thumbnails sizes
							    		$src = wp_get_attachment_image_src( $att, 'span8' );
							    		$src2= wp_get_attachment_image_src( $att, 'full');
							    		$src = $src[0];
							    		$src2 = $src2[0];
							    		// Show image
							    		echo "<li><a href='". $src2 . "' rel='prettyPhoto[slides".$gallery_id."]' class='prettyPhoto'><img src='". $src . "' /><div class='overlay'></div></a></li>";
							    	}?>
								   </ul>
						    	</div> 
					    	<?php 
						} 
				    
					} else if ( has_post_thumbnail()) { ?> 
					  		<div class="portfolio-pic"><?php the_post_thumbnail('span8'); ?>
					  			<div class="portfolio-overlay">
	          						<?php echo overlay_link($gallery_id);?>
	          					</div>
					  		</div>
					<?php } else if (get_post_meta( get_the_ID(), 'richer_embed', true ) != '') {  
					    if (get_post_meta( get_the_ID(), 'richer_source', true ) == 'vimeo') {  
					        echo '<div id="portfolio-video"><div><iframe src="//player.vimeo.com/video/'.get_post_meta( get_the_ID(), 'richer_embed', true ).'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="770" height="400" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></div>';  
					    }  
					    else if (get_post_meta( get_the_ID(), 'richer_source', true ) == 'youtube') {  
					        echo '<div id="portfolio-video"><div><iframe width="770" height="400" src="//www.youtube.com/embed/'.get_post_meta( get_the_ID(), 'richer_embed', true ).'?rel=0&showinfo=0&modestbranding=1&hd=1&autohide=1&color=white" frameborder="0" allowfullscreen></iframe></div></div>';  
					    }  
					    else {  
					        echo '<div id="portfolio-video"><div>'.get_post_meta( get_the_ID(), 'richer_embed', true ).'</div></div>';
					    }  
					} else {
						$no_img = wp_get_attachment_image_src( 1300, 'span8', true );
						?>
				  		<div class="portfolio-pic"><img src="<?php echo $no_img[0]; ?>" alt="" />
				  			<div class="portfolio-overlay">
	      						<?php echo overlay_link($gallery_id);?>
	      					</div>
				  		</div>
					<?php }?>
				</div>
				<div class="span4">
					<div class="portfolio-desc">
						<h4 class="title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
						<div class="date"><span><?php echo get_the_time('F j, Y')?></span></div>
				  		<?php the_excerpt(); ?>
				  		<div class="portfolio-tags"><strong><?php _e('Tags', 'richer'); ?>: </strong><?php $taxonomy = strip_tags( get_the_term_list($post->ID, 'portfolio_filter', '', ', ', '') ); echo $taxonomy; ?></div>
				  		<a href="<?php the_permalink() ?>" class="button small default"><?php _e('View Details', 'richer'); ?></a>	
				  	</div>
				 </div>	
				</div> <!-- end of item -->	
			<?php endwhile; ?>
		</div>
	</div>
	<div class="span12">
		<?php if($options_data['check_load_more_btn'] != 1){
				get_template_part( 'framework/inc/nav' );
		} else {
			get_template_part( 'framework/inc/portfolio/nav-folio' );
		} ?>
	</div>
		<?php wp_reset_postdata();?>
</div>


<?php get_footer(); ?>