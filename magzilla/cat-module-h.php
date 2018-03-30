<?php
/*  ----------------------------------------------------------------------------
    Category Module H
 */
global $ft_option;
global $cur_cat_obj;
global $fave_cat_color;
global $fave_cat_module;
global $fave_cat_sidebar_position;
global $fave_sidebar;
global $fave_cat_excerpt;
global $fave_show_child_cat;
global $fave_cat_pagination;
global $fave_container;
global $fave_cat_id;
global $stick_sidebar;

if( $fave_cat_sidebar_position == "none" ) {
	$column_one = "col-lg-12 col-md-12 col-sm-12 col-xs-12";
	$fave_post_class = 'col-lg-4 col-md-4 col-sm-6 col-xs-6';

} elseif( $fave_cat_sidebar_position == "right") {
	$column_one = "col-lg-8 col-md-8 col-sm-8 col-xs-12";
	$column_two = "col-lg-4 col-md-4 col-sm-4 col-xs-12";
	$fave_post_class = 'col-lg-6 col-md-6 col-sm-6 col-xs-6';

} elseif( $fave_cat_sidebar_position == "left" ) {
	$column_one = "col-lg-8 col-md-8 col-sm-8 col-xs-12 col-lg-push-4 col-md-push-4 col-sm-push-4";
	$column_two = "col-lg-4 col-md-4 col-sm-4 col-xs-12 col-lg-pull-8 col-md-pull-8 col-sm-pull-8";
	$fave_post_class = 'col-lg-6 col-md-6 col-sm-6 col-xs-6';
}

?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<?php get_template_part( 'inc/cat', 'head' ); ?>
    </div>
</div>

<div class="row">

	<div class="<?php echo $column_one; ?>">
		<main class="site-main" role="main">
			<div class="archive archive-h post-archive main-box-for-load-more ">
				

				<div class="row fave-loop-wrap">
					<div class="fave-post">
					<?php if( have_posts() ): while ( have_posts() ): the_post(); ?>

						<div id="ID-<?php the_ID(); ?>" <?php post_class($fave_post_class); ?> <?php echo fave_get_item_scope(); ?>>
							<div class="thumb big-thumb">
								<a href="<?php echo esc_url( get_permalink() ); ?>"></a>
								<div class="thumb-content">
									<h2 itemprop="headline" class="gallery-title-small"><a itemprop="url" href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
									<ul class="list-inline post-meta hidden-xs hidden-sm hidden-md">
										<?php get_template_part('inc/cat', 'meta'); ?>
									</ul><!-- .post-meta -->
								</div>
								<div class="slide-image-wrap">
									<?php get_template_part( 'inc/article', 'icon' ); ?>
									<img itemprop="image" class="featured-image" width="370" height="278" src="<?php echo fave_featured_image( get_the_ID(), 370, 278, true, true, true ); ?>" alt="<?php the_title(); ?>">
								</div><!-- slide-image-wrap -->
							</div><!-- thumb -->
						</div>
						<?php endwhile; endif; ?>
					</div><!-- .fave-post -->
				</div><!-- .fave-loop-wrap -->


				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<?php get_template_part('inc/pagination/'. $fave_cat_pagination); ?>
					</div>
				</div>

			</div><!-- archive post-archive -->
		</main><!-- site-main -->
	</div><!-- col-lg-8 col-md-8 col-sm-8 col-xs-12 -->

	<?php if( $fave_cat_sidebar_position != "none" ): ?>

		<div class="<?php echo $column_two.' '.$stick_sidebar; ?>">
			<?php get_sidebar(); ?>
		</div><!-- col-lg-4 col-md-4 col-sm-4 col-xs-12 -->

	<?php endif; ?>

</div><!-- .row -->
