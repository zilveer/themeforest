<?php
	global $count2, $block, $page_builder_id ;
	
	$Cat_ID = $block['id'];

	$args = array(
		'cat'					 => $Cat_ID,
		'no_found_rows'          => true,
		'ignore_sticky_posts'	 => true
	);

	if( !empty($block['number']) )
		$args['posts_per_page'] = $block['number'];
		
	if( !empty($block['order']) && $block['order'] == 'rand' )
		$args['orderby'] = 'rand';
	
	if( !empty($block['offset']) )	
		$args['offset'] =  $block['offset'];

	$cat_query = new WP_Query( $args ); 
	$cat_title = get_the_category_by_ID($Cat_ID);
	$count = 0;
	$home_layout = $block['style'];

	
?>
	<?php if( $home_layout == '2c'):  //************** 2C ****************************************************** ?>
		<?php $count2++; ?>
		<section class="cat-box column2 tie-cat-<?php echo $Cat_ID ?> <?php if($count2 == 2) { echo 'last-column'; $count2=0; } ?>">
			<div class="cat-box-title">
				<h2><a href="<?php echo get_category_link( $Cat_ID ); ?>"><?php echo $cat_title ; ?></a></h2>
				<div class="stripe-line"></div>
			</div>
			<div class="cat-box-content">
			
				<?php if($cat_query->have_posts()): ?>
				<ul>
				<?php while ( $cat_query->have_posts() ) : $cat_query->the_post(); $count ++ ;?>
				<?php if($count == 1) : ?>
					<li <?php tie_post_class('first-news'); ?>>
						<div class="inner-content">
						<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && empty( $block['thumb_first'] ) ) : ?>			
							<div class="post-thumbnail">
								<a href="<?php the_permalink(); ?>" rel="bookmark">
									<?php the_post_thumbnail( 'tie-medium' ); ?>
									<span class="fa overlay-icon"></span>
								</a>
							</div><!-- post-thumbnail /-->
						<?php endif; ?>
					
						<h2 class="post-box-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						
							<?php get_template_part( 'framework/parts/meta-blocks' ); ?>
					
							<div class="entry">
								<p><?php tie_excerpt_home() ?></p>
								<a class="more-link" href="<?php the_permalink() ?>"><?php _eti( 'Read More &raquo;' ) ?></a>
							</div>
						</div>
					</li><!-- .first-news -->
					<?php else: ?>
					<li <?php tie_post_class( 'other-news' ); ?>>
						<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && empty( $block['thumb_small'] ) ) : ?>			
							<div class="post-thumbnail">
								<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'tie-small' ); ?><span class="fa overlay-icon"></span></a>
							</div><!-- post-thumbnail /-->
						<?php endif; ?>			
						<h3 class="post-box-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
						<?php get_template_part( 'framework/parts/meta-blocks' ); ?>					
					</li>
					<?php endif; ?>
				<?php endwhile;?>
				</ul>

				<?php endif; ?>
			</div><!-- .cat-box-content /-->
		</section> <!-- Two Columns -->
		
		
	<?php elseif( $home_layout == '1c' ):  //************** 1C ******************************************************  ?>
		<section class="cat-box wide-box tie-cat-<?php echo $Cat_ID ?>">
			<div class="cat-box-title">
				<h2><a href="<?php echo get_category_link( $Cat_ID ); ?>"><?php echo $cat_title ; ?></a></h2>
				<div class="stripe-line"></div>
			</div>
			<div class="cat-box-content">
			
				<?php if($cat_query->have_posts()): ?>
				<ul>
				<?php while ( $cat_query->have_posts() ) : $cat_query->the_post(); $count ++ ;?>
				<?php if($count == 1) : ?>
					<li <?php tie_post_class( 'first-news' ); ?>>
						<div class="inner-content">
						<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && empty( $block['thumb_first'] ) ) : ?>			
							<div class="post-thumbnail">
								<a href="<?php the_permalink(); ?>" rel="bookmark">
									<?php the_post_thumbnail( 'tie-medium' ); ?>
									<span class="fa overlay-icon"></span>
								</a>
							</div><!-- post-thumbnail /-->
						<?php endif; ?>
					
						<h2 class="post-box-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						
							<?php get_template_part( 'framework/parts/meta-blocks' ); ?>					
							<div class="entry">
								<p><?php tie_excerpt_home() ?></p>
								<a class="more-link" href="<?php the_permalink() ?>"><?php _eti( 'Read More &raquo;' ) ?></a>
							</div>
						</div>
					</li><!-- .first-news -->
					<?php else: ?>
					<li <?php tie_post_class( 'other-news' ); ?>>
						<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && empty( $block['thumb_small'] ) ) : ?>			
							<div class="post-thumbnail">
								<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'tie-small' ); ?><span class="fa overlay-icon"></span></a>
							</div><!-- post-thumbnail /-->
						<?php endif; ?>			
						<h3 class="post-box-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
						<?php get_template_part( 'framework/parts/meta-blocks' ); ?>					
					</li>
					<?php endif; ?>
				<?php endwhile;?>
				</ul>
				<div class="clear"></div>

					<?php endif; ?>
			</div><!-- .cat-box-content /-->
		</section><!-- Wide Box -->

	<?php else :   //************** list **********************************************************************************  ?>
		
		<section class="cat-box list-box tie-cat-<?php echo $Cat_ID ?>">
			<div class="cat-box-title">
				<h2><a href="<?php echo get_category_link( $Cat_ID ); ?>"><?php echo $cat_title ; ?></a></h2>
				<div class="stripe-line"></div>
			</div>
			<div class="cat-box-content">
			
				<?php if($cat_query->have_posts()): ?>
				<ul>
				<?php while ( $cat_query->have_posts() ) : $cat_query->the_post(); $count ++ ;?>
				<?php if($count == 1) : ?>
					<li <?php tie_post_class( 'first-news' ); ?>>
						<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && empty( $block['thumb_first'] ) ) : ?>			
							<div class="post-thumbnail">
								<a href="<?php the_permalink(); ?>" rel="bookmark">
									<?php the_post_thumbnail( 'tie-medium' ); ?>
									<span class="fa overlay-icon"></span>
								</a>
							</div><!-- post-thumbnail /-->
						<?php endif; ?>
					
						<h2 class="post-box-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						
							<?php get_template_part( 'framework/parts/meta-blocks' ); ?>					
							<div class="entry">
								<p><?php tie_excerpt_home() ?></p>
								<a class="more-link" href="<?php the_permalink() ?>"><?php _eti( 'Read More &raquo;' ) ?></a>
							</div>
						</li><!-- .first-news -->
					<?php else: ?>
					<li <?php tie_post_class( 'other-news' ); ?>>
						<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && empty( $block['thumb_small'] ) ) : ?>			
							<div class="post-thumbnail">
								<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'tie-small' ); ?><span class="fa overlay-icon"></span></a>
							</div><!-- post-thumbnail /-->
						<?php endif; ?>			
						<h3 class="post-box-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
						<?php get_template_part( 'framework/parts/meta-blocks' ); ?>
					</li>
					<?php endif; ?>
				<?php endwhile;?>
				</ul>
				<div class="clear"></div>

					<?php endif; ?>
			</div><!-- .cat-box-content /-->
		</section><!-- List Box -->

	<?php endif; ?>
	<?php wp_reset_query(); ?>
