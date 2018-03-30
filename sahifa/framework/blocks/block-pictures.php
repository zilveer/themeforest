<?php

	global $block, $page_builder_id;
	$Cat_ID = $block['id'];
	$posts_num = 10;
	$style = $title ='';
	
	if( !empty($block['title']) )
		$title = $block['title'];
	
	if( !empty($block['style']) )	
		$style = $block['style'];
		
	if($style == 'row') $posts_num = 12;
	
	$args = array(
		'cat'					 => $Cat_ID,
		'posts_per_page'		 => $posts_num,
		'no_found_rows'          => true,
		'ignore_sticky_posts'	 => true
	);


	if( !empty($block['offset']) )	
		$args['offset'] =  $block['offset'];

	$cat_query = new WP_Query( $args ); 

?>
		<section class="cat-box pic-box tie-cat-<?php echo $Cat_ID ?> clear<?php if( $style == 'row' ) echo ' pic-grid'; ?>">
		
		<?php if ( !empty( $title ) ) : ?>
			<div class="cat-box-title">
			<h2><a href="<?php echo get_category_link( $Cat_ID ); ?>"><?php if( function_exists('icl_t') ) echo icl_t( THEME_NAME , 'wpml-'.$page_builder_id.'-'.$block['boxid'] , $title); else echo $title ; ?></a></h2>
				<div class="stripe-line"></div>
			</div>
		<?php endif; ?>
		
			<div class="cat-box-content">
			
				<?php if($cat_query->have_posts()): $count=0; ?>
				<ul>
				<?php while ( $cat_query->have_posts() ) : $cat_query->the_post(); $count ++ ;?>
				<?php if($count == 1 && $style != 'row') : ?>
					<li <?php tie_post_class( 'first-pic' ); ?>>
						<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
							<div class="post-thumbnail">
								<a href="<?php the_permalink(); ?>" class="ttip">
									<?php the_post_thumbnail( 'tie-large' ); ?>
									<span class="fa overlay-icon"></span>
								</a>
							</div><!-- post-thumbnail /-->
						<?php endif; ?>
					</li><!-- .first-pic -->
					<?php else: ?>
					<li <?php tie_post_class(); ?>>
						<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
							<div class="post-thumbnail">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="ttip">
									<?php the_post_thumbnail( 'tie-small' ); ?>
									<span class="fa overlay-icon"></span>
								</a>
							</div><!-- post-thumbnail /-->
						<?php endif; ?>			
					</li>
					<?php endif; ?>
				<?php endwhile;?>
				</ul>
				<div class="clear"></div>
					<?php endif; ?>
			</div><!-- .cat-box-content /-->
		</section>

		<?php wp_reset_query(); ?>