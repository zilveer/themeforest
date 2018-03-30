<?php
/*  ----------------------------------------------------------------------------
    Module A
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

	$img_1_width = '1170'; $img_1_height = '427'; $img_2_width = '570'; $img_2_height = '427';

} elseif( $fave_sidebar_position == "right") {
	
	$img_1_width = '770'; $img_1_height = '400'; $img_2_width = '370'; $img_2_height = '277';

} elseif( $fave_sidebar_position == "left" ) {
	
	$img_1_width = '770'; $img_1_height = '400'; $img_2_width = '370'; $img_2_height = '277';
}

?>

<div class="archive archive-a post-archive">
				
	<div class="fave-loop-wrap">
	<div class="fave-post">
	<?php
	$count = 0;

	if( have_posts() ): while ( have_posts() ): the_post();  $count++; ?>

		<!-- ==== start first post ==== -->
		<div id="ID-<?php the_ID(); ?>" <?php post_class('archive-featured-post'); ?> <?php echo fave_get_item_scope(); ?>>
			
			<?php if( has_post_thumbnail() ): ?>
			<div class="featured-image-wrap">
				<?php get_template_part( 'inc/article', 'icon' ); ?>

				<div class="category-label"><?php get_template_part( 'inc/post', 'cats' ); ?></div>
				
				<a href="<?php echo esc_url( get_permalink() ); ?>">
					<img itemprop="image" class="featured-image" src="<?php echo fave_featured_image( get_the_ID(), $img_1_width, $img_1_height , true, true, true ); ?>" width="<?php echo $img_1_width; ?>" height="<?php echo $img_1_height; ?>" alt="<?php the_title(); ?>">
				</a>
			</div><!-- featured-image-wrap -->
			<?php endif; ?>

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
		</div><!-- archive-featured-post -->


	<?php

	if( $count == 1 ) { break; }

	endwhile; endif;

	?>
	
	
	<!-- ==== start all post ==== -->
	
	<div class="row">
		<?php $i = 0; ?>
		<?php if( have_posts() ): while ( have_posts() ): the_post();  $i++; ?> 


		<div id="ID-<?php the_ID(); ?>" <?php post_class('col-lg-6 col-md-6 col-sm-6 col-xs-6'); ?> <?php echo fave_get_item_scope(); ?>>

			<?php if( has_post_thumbnail() ): ?>
			<div class="featured-image-wrap">
				<?php get_template_part( 'inc/article', 'icon' ); ?>

				<div class="category-label"><?php get_template_part( 'inc/post', 'cats' ); ?></div>
				
				<a href="<?php echo esc_url( get_permalink() ); ?>">
					<img itemprop="image" class="featured-image" src="<?php echo fave_featured_image( get_the_ID(), $img_2_width, $img_2_height, true, true, true ); ?>" width="<?php echo $img_2_width; ?>" height="<?php echo $img_2_height; ?>" alt="<?php the_title(); ?>">
				</a>
			</div><!-- featured-image-wrap -->
			<?php endif; ?>

			<article class="post">
				<h2 itemprop="headline" class="post-title module-small-title"><a itemprop="url" href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
				<ul class="list-inline post-meta">
					<?php get_template_part( 'inc/post', 'meta' ); ?>
				</ul><!-- .post-meta -->

				<?php if( $posts_excerpt != 'disable' ) { ?>
				<div class="post-content post-small-content" itemprop="articleBody">
					<p><?php echo fave_clean_excerpt( '115', 'true' ); ?></p>
				</div><!-- post-content -->
				<?php } ?>

			</article><!-- .post -->
		</div><!-- col-lg-6 col-md-6 col-sm-12 col-xs-12 -->

		<?php if( $i == 2 ){ echo '<div class="clearfix"></div>'; $i = 0; } ?>

		<?php endwhile; endif; ?>
		</div><!-- .fave-post -->
		</div><!-- .fave-loop-wrap -->
	</div><!-- .row -->	
	
</div><!-- archive post-archive -->
