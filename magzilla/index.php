<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Magzilla
 * @since Magzilla 1.0
 */
global $fave_container, $fave_sidebar, $ft_option, $stick_sidebar;

$fave_sidebar = 'default-sidebar';

if( $ft_option['sticky_sidebar'] != 0 ) {
	$stick_sidebar = 'magzilla_sticky';
}

get_header(); ?>

<div class="<?php echo $fave_container; ?>">
		
	<div class="row">
		
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<main class="site-main" role="main">
				<div class="archive archive-5 post-archive">
					
					<?php if( have_posts() ): while ( have_posts() ): the_post(); 

						$categories = get_the_category( get_the_ID() );

						$cats_html = '';
						
						if($categories){
							foreach($categories as $category) {
								$cat_id = $category->cat_ID;
								$cat_link = get_category_link( $cat_id );
								
								$cats_html .= '<a class="cat-color-'.$cat_id.'" href="'.esc_url($cat_link).'">'.esc_html($category->name).'</a>';
							}
						}

					?> 

						<div <?php post_class('blog-post'); ?> <?php echo fave_get_item_scope(); ?>>
							
							<?php if( has_post_thumbnail() ): ?>
							<div class="featured-image-wrap">
								<?php get_template_part( 'inc/article', 'icon' ); ?>
								
								<div class="category-label"><?php echo $cats_html; ?></div>
								
								<a href="<?php echo esc_url( get_permalink() ); ?>">
									<img class="featured-image" src="<?php echo fave_featured_image( get_the_ID(), 770, 400, true, true, true ); ?>" alt="<?php the_title(); ?>"> 
								</a>
							</div><!-- featured-image-wrap -->
							<?php endif; ?>

							<article class="post">
								<h2 class="post-title module-big-title"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
								<ul class="list-inline post-meta">
									<?php get_template_part( 'inc/post', 'meta' ); ?>
								</ul><!-- .post-meta -->
								
								<div class="post-content post-small-content">
									<p><?php echo fave_clean_excerpt( '250', 'true' ); ?></p>
								</div><!-- post-content -->
								
							</article><!-- .post -->
						</div>

					<?php endwhile; endif; ?>
					
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <?php get_template_part( 'inc/pagination/numeric' ); ?>
						</div>
					</div>
					
				</div><!-- archive post-archive -->
			</main><!-- site-main -->
		</div><!-- col-lg-8 col-md-8 col-sm-8 col-xs-12 -->
		
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 <?php echo $stick_sidebar; ?>">
			<?php get_sidebar(); ?>
		</div><!-- col-lg-4 col-md-4 col-sm-4 col-xs-12 -->

	</div><!-- .row -->

</div> <!-- End Container -->

<?php get_footer(); ?>