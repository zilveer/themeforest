<?php

get_header();

the_post();

$page_type = bt_rwmb_meta( BTPFX . '_page_type', array(), get_the_ID() );

$cat_slug = bt_rwmb_meta( BTPFX . '_cat_slug', array(), get_the_ID() );

$limit = bt_rwmb_meta( BTPFX . '_limit', array(), get_the_ID() );

if ( $page_type == '' ) {
	$page_type = 'standard';
}

if ( $page_type == 'standard' ) {

	$blog_author = bt_get_option( 'blog_author' );
	$blog_date = bt_get_option( 'blog_date' );
	
	$meta = '';
	
	$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
	$author_html = '<a href="' . esc_url( $author_url ) . '">' . esc_html( get_the_author() ) . '</a>';			
	
	if ( $blog_author || $blog_date ) {
		$meta .= '<p class="meta">';
		if ( $blog_date ) $meta .= esc_html( date_i18n( $date_format, strtotime( get_the_time( 'Y-m-d' ) ) ) ); 
		if ( $blog_date && $blog_author ) $meta .= ' &mdash; ';
		if ( $blog_author ) $meta .= __( 'by', 'bt_theme' ) . ' <strong>' . $author_html . '</strong>';
		$meta .= '</p>';
	}

	if ( has_post_thumbnail() ) {
	
		$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
		$img = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );

		wp_enqueue_script( 'bt_anystretch_js', get_template_directory_uri() . '/js/jquery.anystretch.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'bt_classie_js', get_template_directory_uri() . '/js/classie.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'bt_single_js', get_template_directory_uri() . '/js/single.js', array( 'jquery' ), '', true );
		
		$featured_overlay = bt_rwmb_meta( BTPFX . '_featured_overlay' );

		echo '<div id="topBlock" class="topBlock tpost">';
			echo '<div id="imageHolder" data-stretch="' . esc_attr( $img[0] ) . '">';
				if ( $featured_overlay ) {
					echo '<div class="tbPort fade">';
				} else {
					echo '<div class="tbPort">';
				}
					echo '<div class="tbTable classic">';
						echo '<header class="tbHeader light">';
							echo '<h1>' . esc_html( get_the_title() ) . '</h1>';
							echo $meta;
						echo '</header>';
					echo '</div><!-- /tbTable -->';
				echo '</div><!-- /tbPort -->';
			echo '</div><!-- /imageHolder -->';
		echo '</div><!-- /topBlock -->';
	}

	if ( has_post_thumbnail() ) {
		echo '<div id="content" class="content tpost">';
	} else {
		echo '<div id="content" class="content">';
	}
	echo '<div class="gutter">';

	$sidebar = bt_get_option( 'sidebar' );
	if ( isset( $_GET['sidebar'] ) && $_GET['sidebar'] != '' ) {
		$sidebar = $_GET['sidebar'];
	}	
	if ( ( $sidebar == 'left' || $sidebar == 'right' ) && ! is_404() ) {
		echo '<aside class="side column ' . sanitize_html_class( $sidebar ) . '" role="complementary" data-toggler-label="' . esc_attr( __( 'Additional Content', 'bt_theme' ) ) . '">';
			dynamic_sidebar( 'primary_widget_area' );
		echo '</aside><!-- /side -->';
		echo '<section class="main column narrow" role="main">';
		$class_array = array( 'classic', 'noBorder' );
	} else {
		echo '<section class="main column wide" role="main">';
		$class_array = array( 'classic', 'noBorder', 'btSingle' );
	}

	echo '<article class="' . implode( ' ', get_post_class( $class_array ) ) . '">';
	echo '<div class="articleBody">';
	echo '<header><h2>' . esc_html( get_the_title() ) . '</h2></header>';
	the_content();
	echo '</div>';
	echo '</article>';
	
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}

	echo '</section><!-- /main -->';
	echo '</div><!-- /gutter -->';
	echo '</div><!-- /content -->';

} else {
	wp_enqueue_script( 'bt_imagesloaded_js', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'bt_masonry_js', get_template_directory_uri() . '/js/masonry.pkgd.min.js', array( 'jquery' ), '', true );
}

if ( $page_type == 'grid' || $page_type == 'wide_grid' ) {

	wp_enqueue_script( 'bt_grid_js', get_template_directory_uri() . '/js/bt_grid.js', array( 'jquery' ), '', true );
	
	echo '<div class="content grid">';
    if ( $page_type == 'wide_grid' ) {
		$data = '';
		if ( $cat_slug != '' ) {
			$data .= 'data-cat-slug="' . $cat_slug . '" ';
		}
		if ( $limit != '' ) {
			$data .= 'data-limit="' . $limit . '" ';
		}
		echo '<div class="gridWall wide" ' . $data . ' role="main">';
	} else {
		echo '<div class="gutter">';
		$data = '';
		if ( $cat_slug != '' ) {
			$data .= 'data-cat-slug="' . $cat_slug . '" ';
		}
		if ( $limit != '' ) {
			$data .= 'data-limit="' . $limit . '" ';
		}
		echo '<div class="gridWall" ' . $data . ' role="main">';
	}
    echo '<div class="gridSizer"></div>';
	
	echo '</div><div class="more fixed"><div id="bt_loader"></div><div id="bt_no_more">' . esc_html( __( 'no more posts', 'bt_theme' ) ) . '</div></div>';

	if ( $page_type == 'grid' ) {
		echo '</div>';
	}
	
	echo '</div>';
	
}

if ( $page_type == 'tile_grid' ) {

	wp_enqueue_script( 'bt_tile_grid_js', get_template_directory_uri() . '/js/bt_tile_grid.js', array( 'jquery' ), '', true );
	
	$data = '';
	if ( $cat_slug != '' ) {
		$data .= 'data-cat-slug="' . $cat_slug . '" ';
	}
	if ( $limit != '' ) {
		$data .= 'data-limit="' . $limit . '" ';
	}
	echo '<div class="content tiles">
	<div class="tilesWall" ' . $data . ' role="main">
	<div class="gridSizer"></div>';
	
	echo '</div><div class="more fixed"><div id="bt_loader"></div><div id="bt_no_more">' . esc_html( __( 'no more posts', 'bt_theme' ) ) . '</div></div>';
	
	echo '</div>';
}

if ( $page_type == 'standard' ) {
	get_footer();
} else { ?>
	</div><!-- /pageWrap -->
	<?php wp_footer(); ?>
	</body>
	</html>
<?php }