<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package smartfood
 */

get_header(); ?>

<section id="page-content" <?php tdp_attr( 'content' ); ?>>
	
	<div class="container">
		<div class="row clearfix">

			<?php if(get_field('page_layout') == 'Sidebar Left') : ?>

                <div class="col-md-3 col-sm-12 col-xs-12 column sidebar" id="sidebar">
                    
                    <?php dynamic_sidebar( 'Page Sidebar' ); ?>

                </div>

            <?php endif; ?>

			<article <?php tdp_attr( 'post' ); ?>>

						<div <?php tdp_attr( 'entry-content' ); ?>>
							
							<header class="page-header">
								<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'smartfood' ); ?></h1>
							</header><!-- .page-header -->
							
							<p><?php _e( 'It looks like nothing was found at this location. Maybe try to search?', 'smartfood' ); ?></p>

							<?php get_search_form(); ?>
							
						</div><!-- .entry-content -->

			</article><!-- .entry -->

			<?php if(get_field('page_layout') == 'Sidebar Right') : ?>

                <div class="col-md-3 col-sm-12 col-xs-12 column sidebar" id="sidebar">
                    
                    <?php dynamic_sidebar( 'Page Sidebar' ); ?>

                </div>

            <?php endif; ?>

		</div>
	</div> <!-- end container -->
</section> <!-- end page content -->

<?php get_footer(); ?>
