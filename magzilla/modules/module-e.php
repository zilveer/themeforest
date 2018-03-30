<?php
/*  ----------------------------------------------------------------------------
    Module E
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
	$img_1_width = '1170'; $img_1_height = '550';

} elseif( $fave_sidebar_position == "right") {
	$img_1_width = '770'; $img_1_height = '400';

} elseif( $fave_sidebar_position == "left" ) {
	$img_1_width = '770'; $img_1_height = '400';
}
?>

<div class="fave-loop-wrap">

<?php if( have_posts() ): while ( have_posts() ): the_post(); ?>


	<div id="ID-<?php the_ID(); ?>" <?php post_class('archive-post fave-post'); ?> <?php echo fave_get_item_scope(); ?>>
		
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
	</div>

<?php endwhile; endif; ?>

</div>
