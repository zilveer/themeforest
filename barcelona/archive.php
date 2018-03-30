<?php

$barcelona_mod_header = '<div class="box-header archive-header has-title"><h2 class="title">'. get_the_archive_title() .'</h2></div>';

get_header();

barcelona_breadcrumb();

if ( is_category() ) {

	$barcelona_cat = get_queried_object();

	if ( barcelona_get_option( 'show_cat_title' ) == 'off' ) {
		unset( $barcelona_mod_header );
	}

	if ( ! empty( $barcelona_cat->description ) ) {

		if ( ! isset( $barcelona_mod_header ) ) {
			$barcelona_mod_header = '';
		}

		$barcelona_mod_header .= '<div class="box-description post-content">'. apply_filters( 'the_content', $barcelona_cat->description ) .'</div>';

	}

}

if ( barcelona_featured_posts() && isset( $barcelona_mod_header ) ) {
	unset( $barcelona_mod_header );
}

?>
<div class="container">

	<div class="<?php echo esc_attr( barcelona_row_class() ); ?>">

		<main id="main" class="<?php echo esc_attr( barcelona_main_class() ); ?>">
		<?php

			if ( is_author() && barcelona_get_option( 'show_author_box' ) == 'on' ) {
				barcelona_author_box();
			}

			$barcelona_mod_post_meta = barcelona_get_option( 'post_meta_choices' );

			include( locate_template( 'includes/modules/module-'. barcelona_get_option( 'posts_layout' ) .'.php' ) );

			barcelona_pagination( barcelona_get_option( 'pagination' ) );

		?>
		</main>

		<?php get_sidebar(); ?>

	</div><!-- .row -->

</div><!-- .container -->
<?php

get_footer();