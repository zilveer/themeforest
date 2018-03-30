<?php 

	global $block, $page_builder_id;
	$cat_id = $block['id'];
	$offset = $title = $lightbox = '';
	
	if( !empty($block['title']) )	
		$title = $block['title'];
	
	if( !empty($block['offset']) )	
		$offset =  $block['offset'];

	if( !empty($block['lightbox']) )	
		$lightbox =  'videos-lightbox';
		
	$count = 0;

	$cat_query = new WP_Query( array(
		'cat' 					 => $cat_id,
		'posts_per_page'		 => 4,
		'offset'				 => $offset,
		'no_found_rows'          => true,
		'ignore_sticky_posts'	 => true,
		'update_post_term_cache' => false,
		'update_post_meta_cache' => false,
		'cache_results'          => false,
		'meta_query' => array(
			array(
				'key' 		=> 'tie_post_head',
				'value' 	=> 'video',
				'compare'	=> '='
			)
		))); 
 ?>
		<section class="cat-box video-box tie-cat-<?php echo $cat_id ?> <?php echo $lightbox ?> clear">
		
		<?php if ( !empty( $title ) ) : ?>
			<div class="cat-box-title">
				<h2><a href="<?php echo get_category_link( $cat_id ); ?>"><?php if( function_exists('icl_t') ) echo icl_t( THEME_NAME , 'wpml-'.$page_builder_id.'-'.$block['boxid'] , $title); else echo $title ; ?></a></h2>
				<div class="stripe-line"></div>
			</div>
		<?php endif; ?>
		
			<div class="cat-box-content">
			
				<?php if($cat_query->have_posts()): ?>
				<ul>
				<?php
				while ( $cat_query->have_posts() ) : $cat_query->the_post();
				$count ++ ;
				
				if( !empty( $block['lightbox']) ){
					$video_link = tie_video_embed();
					$video_lighbox_class 	= ' single-videolighbox';
				}else{
					$video_link = get_permalink();
					$video_lighbox_class 	= '';
				}
				
				?>
				<?php if($count == 1) : ?>
					<li <?php tie_post_class( 'big-video-column' ); ?>>
						<div class="post-thumbnail">
							<a class="ttip<?php echo $video_lighbox_class ?>" href="<?php echo $video_link ?>" title="<?php the_title(); ?>" data-options="width: 768, height: 432" data-title="&lt;a href='<?php the_permalink(); ?>'&gt;<?php the_title(); ?>&lt;/a&gt;"><?php the_post_thumbnail( 'slider' ); ?><span class="fa overlay-icon"></span></a>
						</div><!-- post-thumbnail /-->
					</li><!-- .first-news -->
					<?php else: ?>
					<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
					<li <?php tie_post_class( 'videos-item'.$count ); ?>>
						<div class="post-thumbnail">
							<a class="ttip <?php echo $video_lighbox_class ?>" href="<?php echo $video_link ?>" title="<?php the_title(); ?>" data-options="width: 768, height: 432" data-title="&lt;a href='<?php the_permalink(); ?>'&gt;<?php the_title(); ?>&lt;/a&gt;"><?php the_post_thumbnail( 'tie-medium' ); ?><span class="fa overlay-icon"></span></a>
						</div><!-- post-thumbnail /-->
					</li>
					<?php endif; ?>			
					<?php endif; ?>
				<?php endwhile;?>
				</ul>
				<div class="clear"></div>
				<?php endif; ?>
			</div><!-- .cat-box-content /-->
		</section><!-- Videos Box -->
		<?php wp_reset_query(); ?>