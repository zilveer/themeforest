<?php
/**
 * Template Name: One column, no sidebar
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 */

get_header(); ?>
        <section id="main" class="column1">
            <div class="content">

			<?php
			/* Run the loop to output the posts.
			 * If you want to overload this in a child theme then include a file
			 * called loop-index.php and that will be used instead.
			 */
			get_template_part( 'loop', 'page' );
			?>
			</div><!-- #content -->
            <div class="clear"></div>
		</section><!-- #container -->

<?php get_footer(); ?>
