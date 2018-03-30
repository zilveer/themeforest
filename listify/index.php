<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Listify
 */

global $style;

$blog_style = get_theme_mod( 'content-blog-style', 'default' );
$style = 'grid-standard' == $blog_style ? 'standard' : 'cover';

get_header(); ?>

    <?php if ( is_home() ) : ?>
    <div <?php echo apply_filters( 'listify_cover', 'page-cover', array( 'size' => 'full' ) ); ?>>
        <h1 class="page-title cover-wrapper"><?php echo get_option( 'page_for_posts' ) ? get_the_title( get_option( 'page_for_posts' ) ) :  _x( 'Blog', 'blog page title', 'listify' ); ?></h1>
    </div>
    <?php endif; ?>

    <div id="primary" class="container">
        <div class="row content-area">

            <?php if ( 'left' == esc_attr( listify_theme_mod( 'content-sidebar-position', 'right' ) ) ) : ?>
                <?php get_sidebar(); ?>
            <?php endif; ?>

            <main id="main" class="site-main col-xs-12 <?php if ( 'none' != esc_attr( listify_theme_mod( 'content-sidebar-position', 'right' ) ) && is_active_sidebar( 'widget-area-sidebar-1' ) ) : ?>col-sm-7 col-md-8<?php endif; ?>" role="main">

				<?php if ( 'default' != $blog_style ) : ?>
					<div class="blog-archive blog-archive--grid" data-columns>
					<?php add_filter( 'excerpt_length', 'listify_short_excerpt_length' ); ?>
				<?php endif; ?>

                <?php while ( have_posts() ) : the_post(); ?>
		
					<?php
						if ( 'default' == $blog_style ) :
							get_template_part( 'content' );
						else :
							get_template_part( 'content', 'recent-posts' );
						endif;
					?>

                <?php endwhile; ?>

				<?php if ( 'default' != $blog_style ) : ?>
					<?php remove_filter( 'excerpt_length', 'listify_short_excerpt_length' ); ?>
					</div>
				<?php endif; ?>

                <?php get_template_part( 'content', 'pagination' ); ?>

            </main>

            <?php if ( 'right' == esc_attr( get_theme_mod( 'content-sidebar-position', 'right' ) ) ) : ?>
                <?php get_sidebar(); ?>
            <?php endif; ?>

        </div>
    </div>

<?php get_footer(); ?>
