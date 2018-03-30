<?php
	global $block, $page_builder_id, $get_meta;
	
	$title = $pagination = $share = '';

	if( !empty($block['title']) )	
		$title = $block['title'];
	
	if( !empty($block['display']) )	
		$display = $block['display'];
	
	if( !empty($block['pagi']) )	
		$pagination = $block['pagi'];
		
	if( !empty($block['share']) )	
		$share = $block['share'];

	$args = array(
		'ignore_sticky_posts'	 => true
	);

	if( !empty( $block['exclude'] ) )
		$args[ 'category__not_in' ] = $block['exclude'];
		
	if( !empty($block['number']) )	
		$args[ 'posts_per_page' ] = $block['number'];

	if( !empty($block['offset']) )	
		$args[ 'offset' ] =  $block['offset'];

	if ( !empty( $pagination ) ){
	
		$paged   = intval(get_query_var('paged'));
		$paged_2 = intval(get_query_var('page'));
				
		if( empty( $paged ) && !empty( $paged_2 )  ) {
			$paged = intval(get_query_var('page'));
		}
		
		$args[ 'paged' ] = $paged;
	}
	else $args[ 'no_found_rows' ] = true ;
	
	$cat_query = new WP_Query( $args ); 
	?>
		<section class="cat-box recent-box recent-<?php echo $display ?>">
		
		<?php if ( !empty( $title ) ) : ?>
			<div class="cat-box-title">
				<h2><?php if( function_exists('icl_t') ) echo icl_t( THEME_NAME , 'wpml-'.$page_id.'-'.$block['boxid'] , $title); else echo $title ; ?></h2>
				<div class="stripe-line"></div>
			</div>
		<?php endif; ?>
		
			<div class="cat-box-content">
			
				<?php if($cat_query->have_posts()): ?>
				
				
			<?php if( $display == 'blog' ): ?>
			
			
				<?php while ( $cat_query->have_posts() ) : $cat_query->the_post()?>
					<article <?php tie_post_class('item-list'); ?>>
						<h2 class="post-box-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						<?php get_template_part( 'framework/parts/meta-blocks' ); ?>					

							<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
						<div class="post-thumbnail">
							<a href="<?php the_permalink(); ?>" rel="bookmark">
								<?php the_post_thumbnail( 'tie-medium' );   ?>
								<span class="fa overlay-icon"></span>
							</a>
						</div><!-- post-thumbnail /-->
							<?php endif; ?>
									
						<div class="entry">
							<p><?php tie_excerpt() ?></p>
							<a class="more-link" href="<?php the_permalink() ?>"><?php _eti( 'Read More &raquo;' ) ?></a>
						</div>
						<?php if( !empty( $share ) ) get_template_part( 'framework/parts/share' );  // Get Share Button template ?>
						<div class="clear"></div>
					</article><!-- .item-list -->
				<?php endwhile;?>
	
					
					
			<?php elseif( $display == 'masonry' ) :
					$tie_random_id = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5); ?>

				
				<div class="masonry-grid" id="masonry-grid-<?php echo $tie_random_id ?>" >
				<?php while ( $cat_query->have_posts() ) : $cat_query->the_post()?>
					<article <?php tie_post_class('item-list'); ?>>
						<h2 class="post-box-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						<?php get_template_part( 'framework/parts/meta-blocks' ); ?>					

							<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
						<div class="post-thumbnail">
							<a href="<?php the_permalink(); ?>" rel="bookmark">
								<?php the_post_thumbnail( 'tie-large' );   ?>
								<span class="fa overlay-icon"></span>
							</a>
						</div><!-- post-thumbnail /-->
							<?php endif; ?>
									
						<div class="entry">
							<p><?php tie_excerpt_home() ?></p>
							<a class="more-link" href="<?php the_permalink() ?>"><?php _eti( 'Read More &raquo;' ) ?></a>
						</div>
						<?php if( !empty( $share ) ) get_template_part( 'framework/parts/share' );  // Get Share Button template ?>
						<div class="clear"></div>
					</article><!-- .item-list -->
				<?php endwhile;?>
				</div>
				<?php wp_enqueue_script( 'tie-masonry' ); ?>
				<script>
					jQuery(document).ready(function() {
						<?php if( is_rtl() ){ ?>
						
						jQuery.Isotope.prototype._positionAbs = function( x, y ) {
						  return { right: x, top: y };
						};
						var transforms = false;
						<?php }else{ ?>
						var transforms = true;
						<?php } ?>
					
						var $container = jQuery('#masonry-grid-<?php echo $tie_random_id ?>');

						jQuery($container).imagesLoaded(function() {
							$container.isotope({
								itemSelector : '.item-list',
								resizable: false,
								transformsEnabled: transforms,
								animationOptions: {
									duration: 400,
									easing: 'swing',
									queue: false
								},
								masonry: {}
							});
						});
						
						/* Events on Window resize */
						jQuery(window).smartresize(function(){
							$container.isotope();
						});
					
					});
				</script>

					
			
			<?php elseif( $display == 'content' ) : ?>


				<?php while ( $cat_query->have_posts() ) : $cat_query->the_post()?>
					<article <?php tie_post_class('item-list'); ?>>
						<h2 class="post-box-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						<?php get_template_part( 'framework/parts/meta-blocks' ); ?>					

						<div class="entry">
							<?php the_content( __ti( 'Read More &raquo;' ) ); ?>
						</div>
						
						<?php if( !empty( $share ) ) get_template_part( 'framework/parts/share' );  // Get Share Button template ?>
						<div class="clear"></div>
					</article><!-- .item-list -->
				<?php endwhile;?>
	
	
							
			<?php elseif( $display == 'timeline' ) : ?>

					<div class="timeline-contents timeline-archive">
					
					<?php $timeline_time = ''; ?>
					<?php while ( $cat_query->have_posts() ) : $cat_query->the_post()?>

						<?php
						if( ( empty( $timeline_time ) && get_the_time('F, Y') ) || ( !empty( $timeline_time ) && $timeline_time != get_the_time('F, Y')) ){
						
							if( !empty( $timeline_time) ) {
						?>
						
						</ul>
						<div class="clear"></div>
						<?php }
						
							$timeline_time = get_the_time('F, Y');
						?>
					
						<h2 class="timeline-head"><?php echo $timeline_time ?></h2>
						<div class="clear"></div>
						<ul class="timeline">

						<?php } ?>
							
							<li <?php tie_post_class( 'timeline-post' ); ?>>	
								<div class="timeline-content">
									<span class="timeline-date"><?php echo get_the_time('j F') ?></span>
									<h2 class="post-box-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h2>
									
									<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>	
									
									<div class="post-thumbnail">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail('tie-medium');  ?>
											<span class="fa overlay-icon"></span>
										</a>
									</div><!-- post-thumbnail /-->
									
									<?php endif; ?>
										
									<div class="entry">
										<p><?php tie_excerpt() ?></p>
										<a class="more-link" href="<?php the_permalink() ?>"><?php _eti( 'Read More &raquo;' ) ?></a>

									</div>
									<?php if( !empty( $share ) ) get_template_part( 'framework/parts/share' );  // Get Share Button template ?>

								</div>
								<div class="clear"></div>
							</li>
				
					<?php endwhile;?>

						</ul>
						<div class="clear"></div>
					</div><!-- .timeline-contents /-->
	
	
					
			<?php elseif( $display == 'full_thumb' ) : ?>


				<?php while ( $cat_query->have_posts() ) : $cat_query->the_post()?>
					<article <?php tie_post_class('item-list'); ?>>
						<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
						<div class="post-thumbnail single-post-thumb archive-wide-thumb">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( 'slider' ); ?>
								<span class="fa overlay-icon"></span>
							</a>
						</div>
						<div class="clear"></div>
						<?php endif; ?>
		
						<h2 class="post-box-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						<?php get_template_part( 'framework/parts/meta-blocks' ); ?>					

						<div class="entry">
							<p><?php tie_excerpt() ?></p>
							<a class="more-link" href="<?php the_permalink() ?>"><?php _eti( 'Read More &raquo;' ) ?></a>
						</div>
						
						<?php if( !empty( $share ) ) get_template_part( 'framework/parts/share' );  // Get Share Button template ?>
						<div class="clear"></div>
					</article><!-- .item-list -->
				<?php endwhile;?>

												

			<?php else: ?>
				
				
				
				<?php while ( $cat_query->have_posts() ) : $cat_query->the_post()?>
					<div <?php tie_post_class('recent-item'); ?>>
						<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
							<div class="post-thumbnail">
								<a href="<?php the_permalink(); ?>" rel="bookmark">
									<?php the_post_thumbnail( 'tie-medium' ); ?>
									<span class="fa overlay-icon"></span>
								</a>
							</div><!-- post-thumbnail /-->
						<?php endif; ?>			
						<h3 class="post-box-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
						<p class="post-meta">
							<?php if( !empty( $get_meta[ 'box_meta_score'][0] )) tie_get_score(); ?>
							<?php if( !empty( $get_meta[ 'box_meta_date' ][0] )) tie_get_time() ; ?>
						</p>
					</div>
				<?php endwhile;?>
	
					
					
			<?php endif; ?>
			
			
			
				<div class="clear"></div>
			<?php endif; ?>
			
			</div><!-- .cat-box-content /-->
		</section>
		<?php if ( !empty( $pagination ) && empty($block['offset']) &&  $cat_query->max_num_pages > 1){?> <div class="recent-box-pagination"><?php tie_pagenavi($cat_query , $block['number']); ?> </div> <?php } ?>
		<div class="clear"></div>
		<?php wp_reset_query(); ?>