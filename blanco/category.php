<?php
/**
 * The template for displaying Category Archive pages.
 *
 */

$blog_layout = etheme_get_option('blog_layout');
$blog_sidebar = etheme_get_option('blog_sidebar');

get_header(); ?>
        <section id="main" class="columns2-<?php echo $blog_sidebar; ?> blog-<?php echo $blog_layout; ?>">
            <div class="content">
				<h3 class="page-title"><?php
					printf( __( 'Category Archives: %s', ETHEME_DOMAIN ), '<span>' . single_cat_title( '', false ) . '</span>' );
				?></h3>
				<?php
					$category_description = category_description();
					if ( ! empty( $category_description ) )
						echo '<div class="archive-meta">' . $category_description . '</div>';

				/* Run the loop for the category page to output the posts.
				 * If you want to overload this in a child theme then include a file
				 * called loop-category.php and that will be used instead.
				 */
				get_template_part( 'loop', 'category' );
				?>
			</div><!-- #content -->
            <aside id="sidebar">
                <?php get_sidebar(); ?>
            </aside>
            <div class="clear"></div>
		</section><!-- #container -->
<?php get_footer(); ?>
