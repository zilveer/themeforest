<?php
/*  ----------------------------------------------------------------------------
    Category Module C
 */
global $ft_option;
global $pagination_type;
global $sidebar;
global $fave_sidebar_position;
global $posts_excerpt;
global $main_classes;
global $sidebar_classes;
global $fave_container;

if( $fave_sidebar_position == "none" ) {
	$img_1_width = '670'; $img_1_height = '435'; $img_2_width = '370'; $img_2_height = '277';

} elseif( $fave_sidebar_position == "right") {
	
	$img_1_width = '437'; $img_1_height = '284'; $img_2_width = '237'; $img_2_height = '177';

} elseif( $fave_sidebar_position == "left" ) {
	
	$img_1_width = '437'; $img_1_height = '284'; $img_2_width = '237'; $img_2_height = '177';
}

?>


<div class="archive archive-3 post-archive">

	<div class="fave-loop-wrap">
	<div class="fave-post">
	<?php
	$count = 0;

	if( have_posts() ): while ( have_posts() ): the_post();  $count++;  ?> 

		<!-- ==== start first post ==== -->

		<div id="ID-<?php the_ID(); ?>" <?php post_class('archive-featured-post'); ?> <?php echo fave_get_item_scope(); ?>>
			<div class="row">

				<?php if( has_post_thumbnail() ): ?>
				<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
					<div class="featured-image-wrap">
						<?php get_template_part( 'inc/article', 'icon' ); ?>

						<div class="category-label"><?php get_template_part( 'inc/post', 'cats' ); ?></div>
						
						<a href="<?php echo esc_url( get_permalink() ); ?>">
							<img itemprop="image" class="featured-image" src="<?php echo fave_featured_image( get_the_ID(), $img_1_width, $img_1_height , true, true, true ); ?>" width="<?php echo $img_1_width; ?>" height="<?php echo $img_1_height; ?>" alt="<?php the_title(); ?>">
						</a>
					</div><!-- featured-image-wrap -->
				</div><!-- col-lg-7 col-md-7 col-sm-7 col-xs-12 -->
				<?php endif; ?>

				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
					<article class="post">
						
						<h2 itemprop="headline" class="post-title module-big-title"><a itemprop="url" href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
						<ul class="list-inline post-meta">
							<?php get_template_part( 'inc/post', 'meta' ); ?>
						</ul><!-- .post-meta -->
						<?php if( $posts_excerpt != 'disable' ) { ?>
						<div class="post-content post-small-content" itemprop="articleBody">
							<p><?php echo fave_clean_excerpt( '250', 'true' ); ?></p>
						</div><!-- post-content -->
						<?php } ?>

					</article><!-- .post -->
				</div><!-- col-lg-5 col-md-5 col-sm-5 col-xs-12 -->
			</div><!-- row -->
		</div>


	<?php

	if( $count == 1 ) { break; }

	endwhile; endif;
	?>
	
	
	<!-- ==== start all post ==== -->

	<?php if( have_posts() ): while ( have_posts() ): the_post(); ?> 


	<div id="ID-<?php the_ID(); ?>" <?php post_class('row'); ?> <?php echo fave_get_item_scope(); ?>>
		
		<?php if( has_post_thumbnail() ): ?>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
			<div class="featured-image-wrap">
				<?php get_template_part( 'inc/article', 'icon' ); ?>
				<a href="<?php echo esc_url( get_permalink() ); ?>">
					<img itemprop="image" class="featured-image" src="<?php echo fave_featured_image( get_the_ID(), $img_2_width, $img_2_height, true, true, true ); ?>" width="<?php echo $img_2_width; ?>" height="<?php echo $img_2_height; ?>" alt="<?php the_title(); ?>">
				</a>
			</div><!-- featured-image-wrap -->
		</div><!-- col-lg-4 col-md-4 col-sm-4 col-xs-4 -->
		<?php endif; ?>
		
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
			<article class="post">
				<div class="category-label-wrap">
					<div class="category-label"><?php get_template_part( 'inc/post', 'cats' ); ?></div>
				</div><!-- category-label-wrap -->		
				<h2 itemprop="headline" class="post-title module-small-title"><a itemprop="url" href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
				<ul class="list-inline post-meta">
					<?php get_template_part( 'inc/post', 'meta' ); ?>
				</ul><!-- .post-meta -->
				<?php if( $posts_excerpt != 'disable' ) { ?>
				<div class="post-content" itemprop="articleBody">
					<p><?php echo fave_clean_excerpt( '150', 'true' ); ?></p>
				</div><!-- post-content -->
				<?php } ?>
			</article><!-- .module-2-post -->
		</div><!-- col-lg-8 col-md-8 col-sm-8 col-xs-8 -->
	</div>

	<?php endwhile; endif; ?>
	</div><!-- .fave-post -->
</div><!-- .fave-loop-wrap -->

	
</div><!-- archive post-archive -->
