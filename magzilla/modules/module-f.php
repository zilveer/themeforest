<?php
/*  ----------------------------------------------------------------------------
    Category Module D-B
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
	$img_1_width = '770'; $img_1_height = '500'; $fave_excerpt = '560';

} elseif( $fave_sidebar_position == "right") {
	$img_1_width = '770'; $img_1_height = '500'; $fave_excerpt = '125';

} elseif( $fave_sidebar_position == "left" ) {
	$img_1_width = '770'; $img_1_height = '500'; $fave_excerpt = '125';
}

?>

<div class="archive archive-6 post-archive">
	
	<div class="fave-loop-wrap">

	<?php if( have_posts() ): while ( have_posts() ): the_post(); ?>

	<div id="ID-<?php the_ID(); ?>" <?php post_class('archive-post fave-post'); ?> <?php echo fave_get_item_scope(); ?>>
		<div class="row">
			
			<?php if( has_post_thumbnail() ): ?>
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
				<div class="featured-image-wrap">
					<?php get_template_part( 'inc/article', 'icon' ); ?>
					<div class="category-label"><?php get_template_part( 'inc/post', 'cats' ); ?></div>
					<a href="<?php echo esc_url( get_permalink() ); ?>">
						<img itemprop="image" class="featured-image" src="<?php echo fave_featured_image( get_the_ID(), $img_1_width, $img_1_height , true, true, true ); ?>" width="<?php echo $img_1_width; ?>" height="<?php echo $img_1_height; ?>" alt="<?php the_title(); ?>">
					</a>
				</div><!-- featured-image-wrap -->
			</div><!-- col-lg-8 col-md-8 col-sm-8 col-xs-12 -->
			<?php endif; ?>

			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<article class="post">
					<h2 itemprop="headline" class="post-title module-big-title"><a itemprop="url" href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
					<ul class="list-inline post-meta">
                        <?php get_template_part( 'inc/post', 'meta' ); ?>
					</ul><!-- .post-meta -->
					
					<?php if( $posts_excerpt != 'disable' ): ?>
					<div class="post-content post-small-content" itemprop="articleBody">
						<p><?php echo fave_clean_excerpt( $fave_excerpt, 'true' ); ?></p>
					</div><!-- post-content -->
					<?php endif; ?>

				</article><!-- .post -->
			</div><!-- col-lg-4 col-md-4 col-sm-4 col-xs-12 -->
		</div><!-- row -->
	</div>


	<?php endwhile; endif; ?>
	</div>	
	
</div><!-- archive post-archive -->
