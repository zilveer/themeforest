<?php
/*  ----------------------------------------------------------------------------
    Category Module H
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
	$fave_post_class = 'col-lg-4 col-md-4 col-sm-6 col-xs-6 fave-post';

} elseif( $fave_sidebar_position == "right") {
	$fave_post_class = 'col-lg-6 col-md-6 col-sm-6 col-xs-6 fave-post';

} elseif( $fave_sidebar_position == "left" ) {
	$fave_post_class = 'col-lg-6 col-md-6 col-sm-6 col-xs-6 fave-post';
}

?>

<div class="archive archive-h post-archive">
	
	<div class="row">
		<div class="fave-loop-wrap">
			<?php if( have_posts() ): while ( have_posts() ): the_post(); ?> 

				<div id="ID-<?php the_ID(); ?>" <?php post_class($fave_post_class); ?> <?php echo fave_get_item_scope(); ?>>
					<div class="thumb big-thumb">
						<a href="<?php echo esc_url( get_permalink() ); ?>"></a>
						<div class="thumb-content"  itemprop="articleBody">
							<h2 itemprop="headline" class="gallery-title-small"><a itemprop="url" href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
							<ul class="list-inline post-meta hidden-xs hidden-sm hidden-md">
                                <?php get_template_part( 'inc/post', 'meta' ); ?>
							</ul><!-- .post-meta -->
						</div>
						<div class="slide-image-wrap">
							<?php get_template_part( 'inc/article', 'icon' ); ?>
							<img itemprop="image" class="featured-image" src="<?php echo fave_featured_image( get_the_ID(), 370, 278, true, true, true ); ?>" width="370" height="278" alt="<?php the_title(); ?>">
							
						</div><!-- slide-image-wrap -->
					</div><!-- thumb -->
				</div>

			<?php endwhile; endif; ?>
		
		</div><!-- .fave-loop-wrap -->
	</div><!-- .row -->
	
</div><!-- archive post-archive -->
