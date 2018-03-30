<?php
/**
 * The template for displaying 404 page (Not Found)
 *
 */

get_header(); ?>

        <section id="main" class="columns2-left">
            <aside id="sidebar">
                <?php get_sidebar(); ?>
            </aside>
            <div class="content">
                    <h1 class="notFound"><?php _e('whoo<strong>404</strong>ps!', ETHEME_DOMAIN); ?></h1>
    				
    				<h3>Page not found</h3>
    				
    				<p><?php _e('The page you are looking for could not be found.', ETHEME_DOMAIN); ?> <br />
    				<?php get_search_form(); ?>
			</div><!-- #content -->
            <div class="clear"></div>
		</section><!-- #container -->

<?php get_footer(); ?>