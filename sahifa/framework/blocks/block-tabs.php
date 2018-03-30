<?php
	global $block, $page_builder_id;
	
if( !empty( $block[ 'cat' ] ) ):
	$home_tabs = $block[ 'cat' ];
	?>
	<div class="cat-box-content clear cat-box">
		<div class="cat-tabs-header">
			<ul>
		<?php 		
			foreach ($home_tabs as $cat ) { ?>
				<li><a href="#catab<?php echo $cat; ?>"><?php echo get_the_category_by_ID($cat) ?></a></li>
			<?php } ?>
			</ul>
		</div>
		<?php
			$cat_num = 0;	
			foreach ($home_tabs as $cat ) {
			$count = 0;
			$cat_num ++;

			$args = array(
				'cat'					 => $cat,
				'posts_per_page'		 => 5,
				'no_found_rows'          => true,
				'ignore_sticky_posts'	 => true
			);

			$cat_query = new WP_Query( $args ); ?>
			<div id="catab<?php echo $cat; ?>" class="cat-tabs-wrap cat-tabs-wrap<?php echo $cat_num; ?>">

			<?php if($cat_query->have_posts()): ?>
				<ul>
				<?php while ( $cat_query->have_posts() ) : $cat_query->the_post(); $count ++ ;?>
				<?php if($count == 1) : ?>
					<li <?php tie_post_class('first-news'); ?>>
						<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
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
					<li <?php tie_post_class(); ?>>
						<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
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
			</div>
			<?php } ?>
	</div><!-- #cats-tabs-box /-->
<?php endif; ?>
<?php wp_reset_query(); ?>