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
	$img_2_width = '270'; $img_2_height = '202';

} elseif( $fave_sidebar_position == "right") {
	$img_2_width = '170'; $img_2_height = '127';

} elseif( $fave_sidebar_position == "left" ) {
	$img_2_width = '170'; $img_2_height = '127';
}
?>


<div class="archive archive-4 archive-d-b post-archive">
	
	<div class="fave-loop-wrap">
	
	<?php if( have_posts() ): while ( have_posts() ): the_post(); ?> 

	<div id="ID-<?php the_ID(); ?>" <?php post_class('row fave-post'); ?> <?php echo fave_get_item_scope(); ?>>
		<?php if( has_post_thumbnail() ): ?>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
			<div class="featured-image-wrap">
				<?php get_template_part( 'inc/article', 'icon' ); ?>
				<a href="<?php echo esc_url( get_permalink() ); ?>">
					<img itemprop="image" class="featured-image" src="<?php echo fave_featured_image( get_the_ID(), $img_2_width, $img_2_height, true, true, true ); ?>" width="<?php echo $img_2_width; ?>" height="<?php echo $img_2_height; ?>" alt="<?php the_title(); ?>">
				</a>
			</div><!-- featured-image-wrap -->
		</div><!-- col-lg-3 col-md-3 col-sm-3 col-xs-3 -->
		<?php endif; ?>

		<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
			<article class="post">
				<div class="category-label-wrap">
					<div class="category-label"><?php get_template_part( 'inc/post', 'cats' ); ?></div>
				</div><!-- category-label-wrap -->		
				<h2 itemprop="headline" class="post-title module-big-title"><a itemprop="url" href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
				<?php if( $posts_excerpt != 'disable' ) { ?>
				<div class="post-content" itemprop="articleBody">
					<p><?php echo fave_clean_excerpt( '150', 'true' ); ?></p>
				</div><!-- post-content -->
				<?php } ?>
				<ul class="list-inline post-meta">
					<?php get_template_part( 'inc/post', 'meta' ); ?>
				</ul><!-- .post-meta -->
			</article><!-- .module-2-post -->
		</div><!-- col-lg-9 col-md-9 col-sm-9 col-xs-9 -->
	</div>


	<?php endwhile; endif; ?>
</div><!-- .fave-loop-wrap -->
	
</div><!-- archive post-archive -->