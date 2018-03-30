<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 */

global $wp_query;
$blog_sidebar = etheme_get_option('blog_sidebar');
get_header(); ?>
        <section id="main" class="columns2-<?php echo $blog_sidebar; ?>">
            <div class="content">
            	<?php $post_id = $wp_query->get_queried_object_id();
    			$title = get_post_field( 'post_title', $post_id ); ?>
                <h1><?php echo $title; ?></h1>
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
                    <?php wp_link_pages( array( 'before' => '' . __( 'Pages:', ETHEME_DOMAIN ), 'after' => '' ) ); ?>
                    <?php edit_post_link( __( 'Edit', ETHEME_DOMAIN ), '', '' ); ?>
				<?php endwhile; ?>
                <?php else : ?>
					<p><strong><?php _e( 'Not Found', ETHEME_DOMAIN ); ?></strong></p>
					<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', ETHEME_DOMAIN ); ?></p>
					<?php get_search_form(); ?>
				<?php endif; ?>
			</div><!-- #content -->
            <aside id="sidebar">
                <?php get_sidebar(); ?>
            </aside>
            <div class="clear"></div>
		</section><!-- #container -->

<?php get_footer(); ?>
