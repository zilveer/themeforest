<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 27/11/15
 * Time: 5:16 PM
 */
global $ft_option;
global $pagination_type;
global $sidebar;
global $fave_sidebar_position;
global $posts_excerpt;
global $main_classes;
global $sidebar_classes;
global $fave_container;
?>


<div class="archive archive-3 archive-i post-archive">

	<div class="fave-loop-wrap">

		<?php if( have_posts() ): while ( have_posts() ): the_post(); ?>

			<div id="ID-<?php the_ID(); ?>" <?php post_class('row fave-post'); ?> <?php echo fave_get_item_scope(); ?>>

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<article class="post">
						<div class="category-label-wrap">
							<div class="category-label"><?php get_template_part( 'inc/post', 'cats' ); ?></div>
						</div><!-- category-label-wrap -->
						<h2 itemprop="headline" class="post-title module-big-title"><a itemprop="url" href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
						<ul class="list-inline post-meta">
							<?php get_template_part( 'inc/post', 'meta' ); ?>
						</ul><!-- .post-meta -->
						<?php if( $posts_excerpt != 'disable' ) { ?>
							<div class="post-content">
								<p><?php echo fave_clean_excerpt( '300', 'true' ); ?></p>
							</div><!-- post-content -->
						<?php } ?>
					</article><!-- .module-2-post -->
				</div><!-- col-lg-8 col-md-8 col-sm-8 col-xs-8 -->
			</div>

		<?php endwhile; endif; ?>

	</div><!-- .fave-loop-wrap -->


</div><!-- archive post-archive -->