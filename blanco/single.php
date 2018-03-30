<?php
/**
 * The Template for displaying all single posts.
 *
 */

$blog_layout = etheme_get_option('blog_layout');
$blog_sidebar = etheme_get_option('blog_sidebar');
get_header(); ?>
        <section id="main" class="columns2-<?php echo $blog_sidebar; ?> blog-<?php echo $blog_layout; ?>">
            <div class="content">

			<?php
			/* Run the loop to output the posts.
			 * If you want to overload this in a child theme then include a file
			 * called loop-index.php and that will be used instead.
			 */
			 get_template_part( 'loop', 'single' );
			?>
			</div><!-- #content -->
            <aside id="sidebar">
                <?php get_sidebar(); ?>
            </aside>
            <div class="clear"></div>
		</section><!-- #container -->
<?php get_footer(); ?>
