<?php
/*
Template Name: Portfolio 3 Columns
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
	
<?php get_template_part('framework/inc/portfolio/folio-filter')?>
	<div class="span12">
	<div id="portfolio-wrap">
	
		<?php
			global $wp_query;
			$portfolioitems = $options_data['text_portfolioitems_3']; // Get Items per Page Value
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
			<div class="<?php if($terms) : foreach ($terms as $term) { echo 'term-'.$term->slug.' '; } endif; ?>portfolio-item span4 no-margin">
				
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
				<?php 
				if ( has_post_thumbnail()) { ?> 
				  		<div class="portfolio-pic"><?php the_post_thumbnail('span4'); ?>
				  			<div class="portfolio-overlay">
          						<?php echo overlay_link($gallery_id);?>
          					</div>
				  		</div>
				  		<div class="portfolio-title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></div><div class="clear"></div>
				<?php } else if (get_post_meta( get_the_ID(), 'richer_embed', true ) != '') {  
				    if (get_post_meta( get_the_ID(), 'richer_source', true ) == 'vimeo') {  
				        echo '<div id="portfolio-video"><div><iframe src="//player.vimeo.com/video/'.get_post_meta( get_the_ID(), 'richer_embed', true ).'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="470" height="340" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></div>';  
				    	echo '<div class="portfolio-title"><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></div><div class="clear"></div>';
				    }  
				    else if (get_post_meta( get_the_ID(), 'richer_source', true ) == 'youtube') {  
				        echo '<div id="portfolio-video"><div><iframe width="470" height="340" src="//www.youtube.com/embed/'.get_post_meta( get_the_ID(), 'richer_embed', true ).'?rel=0&showinfo=0&modestbranding=1&hd=1&autohide=1&color=white" frameborder="0" allowfullscreen></iframe></div></div>';  
				    	echo '<div class="portfolio-title"><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></div><div class="clear"></div>';
				    }  
				    else {  
				        echo '<div id="portfolio-video"><div>'.get_post_meta( get_the_ID(), 'richer_embed', true ).'</div></div>';
				    	echo '<div class="portfolio-title"><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></div><div class="clear"></div>';
				    }  
				} else {
					$no_img = wp_get_attachment_image_src( 1300, 'span4', true );
					?>
				  		<div class="portfolio-pic"><img src="<?php echo $no_img[0]; ?>" alt="" />
				  			<div class="portfolio-overlay">
          						<?php echo overlay_link($gallery_id);?>
          					</div>
				  		</div>
				  		<div class="portfolio-title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></div><div class="clear"></div>
				<?php }?>
							
			</div> <!-- end of terms -->	
			
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