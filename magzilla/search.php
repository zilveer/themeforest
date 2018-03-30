<?php 
/**
 * Search Results
 *
 * @package Magzilla
 * @since 	Magzilla 1.0
**/ 
global $fave_container, $fave_sidebar, $ft_option;
$fave_sidebar = 'search-sidebar';

if( $ft_option['sticky_sidebar'] != 0 ) {
	$stick_sidebar = 'magzilla_sticky';
}

get_header(); ?>

<div class="<?php echo $fave_container; ?>">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="page-header">
				<h1 class="page-title"><?php _e("Search results for ","magzilla"); ?>: <span><?php echo get_search_query(); ?></span></h1>
			</div>		
		</div><!-- col-xs-12 col-sm-12 col-md-12 col-lg-12 -->
	</div><!-- row -->

	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<main class="site-main" role="main">
				<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="form-horizontal search-result-form">
					<div class="form-group">
						<div class="col-xs-12 col-sm-9 col-md-10 col-lg-10">
							<input type="text" name="s" id="s" class="form-control fave-search" placeholder="<?php _e("Search","magzilla"); ?>">
						</div>
					
						<div class="col-xs-12 col-sm-3 col-md-2 col-lg-2">						
							<button type="submit" class="btn btn-theme btn-block"><?php _e( 'Search', 'magzilla' )?></button>
						</div>
					</div>
				</form>
				<p><?php _e( "If you're not happy with the results, please do another search", "magzilla" ); ?></p>
				
				<div class="archive search-result-posts">

					<!-- ==== start all post ==== -->
					<?php

					if( have_posts() ):
					while ( have_posts() ): the_post();
					
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
					<div class="row">
						<?php if ( has_post_thumbnail() ): ?>
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
							
							<div class="featured-image-wrap">
								<?php get_template_part( 'inc/article', 'icon' ); ?>
		
								<a href="<?php echo esc_url( get_permalink() ); ?>">
									<img class="featured-image" src="<?php echo fave_featured_image( get_the_ID(), 720, 539, true, true, true ); ?>" alt="<?php the_title(); ?>">
								</a>
							</div><!-- featured-image-wrap -->
							
						</div><!-- col-lg-4 col-md-4 col-sm-4 col-xs-4 -->
						<?php endif; ?>

						<?php if ( has_post_thumbnail() ): ?>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
						<?php else: ?>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<?php endif; ?>	
							<article class="post">
								<div class="category-label-wrap">
									<div class="category-label"><?php echo $cats_html; ?></div>
								</div><!-- category-label-wrap -->		
								<h2 class="post-title module-big-title"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
								<ul class="list-inline post-meta">
									<?php get_template_part( 'inc/post-meta' ); ?>
								</ul><!-- .post-meta -->
								
								<div class="post-content">
									<p><?php echo fave_clean_excerpt( '115', ‘true’ ); ?></p>
								</div><!-- post-content -->

							</article><!-- .module-2-post -->
						</div><!-- col-lg-8 col-md-8 col-sm-8 col-xs-8 -->
					</div><!-- .row -->
					<?php endwhile; ?>

					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<?php get_template_part( 'inc/pagination/numeric' ); ?>
						</div>
					</div>

					<?php else: ?>
						<p class="message"><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'magzilla' ); ?></p>
					<?php endif; ?>
					
				</div><!-- archive search-result-posts -->
			</main><!-- site-main -->
		</div><!-- col-lg-8 col-md-8 col-sm-8 col-xs-12 -->

		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 <?php echo $stick_sidebar; ?>">
			<?php get_sidebar(); ?>
		</div><!-- col-lg-4 col-md-4 col-sm-4 col-xs-12 -->
	</div><!-- .row -->
	
</div>

<?php get_footer(); ?>