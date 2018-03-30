<?php get_header(); ?>

<?php the_post(); ?>

<?php blade_grve_print_header_title( 'post' ); ?>
<?php blade_grve_print_header_breadcrumbs( 'post' ); ?>
<?php blade_grve_print_anchor_menu( 'post' ); ?>

<div class="grve-single-wrapper">
	<!-- CONTENT -->
	<div id="grve-content" class="clearfix <?php echo blade_grve_sidebar_class(); ?>">
		<div class="grve-content-wrapper">
			<!-- MAIN CONTENT -->
			<div id="grve-main-content">
				<div class="grve-main-content-wrapper clearfix">

					<?php

						//Get Post template
						get_template_part( 'content', get_post_format() );

						//Post Pagination
						wp_link_pages();

					?>

				</div>
			</div>
			<!-- END MAIN CONTENT -->
			<?php blade_grve_set_current_view( 'post' ); ?>
			<?php get_sidebar(); ?>
		</div>
	</div>
	<!-- END CONTENT -->

	<?php

		//Print Meta Bar
		blade_grve_print_blog_meta_bar();

		//Prints Post Navigation / Social Links Bar
		blade_grve_print_post_bar();

		//Print Post Author Info
		if ( blade_grve_visibility( 'post_author_visibility' ) ) {
			blade_grve_print_post_about_author();
		}

		//Related Posts
		if ( blade_grve_visibility( 'post_related_visibility' ) ) {
			blade_grve_print_related_posts();
		}

		//Print Comments
		if ( blade_grve_visibility( 'post_comments_visibility' ) ) {
			comments_template();
		}
	?>
</div>
<?php get_footer();

//Omit closing PHP tag to avoid accidental whitespace output errors.
