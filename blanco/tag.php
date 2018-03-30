<?php
/**
 * The template for displaying Tag Archive pages.
 *
 */

get_header(); ?>
        <section id="main" class="columns2-left">
            <aside id="sidebar">
                <?php get_sidebar(); ?>
            </aside>
            <div class="content">
                <h1 class="page-title"><?php
                    printf( __( 'Tag Archives: %s', ETHEME_DOMAIN ), '<span>' . single_tag_title( '', false ) . '</span>' );
                ?></h1>
                
                <?php
                /* Run the loop for the tag archive to output the posts
                * If you want to overload this in a child theme then include a file
                * called loop-tag.php and that will be used instead.
                */
                get_template_part( 'loop', 'tag' );
                ?>
			</div><!-- #content -->
            <div class="clear"></div>
		</section><!-- #container -->

<?php get_footer(); ?>
