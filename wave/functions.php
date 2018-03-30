<?php
/**
 * Functions and definitions
 */

/**
 * Set the content width
 */
if ( ! isset( $content_width ) )
	$content_width = 1180;

$dd_sn = 'dd_wave';

/**
 * Hide the settings & documentation pages.
 */
add_filter( 'ot_show_pages', '__return_false' );

/**		 
 * Hide the "New Layout" section on the Theme Options page.
 */
add_filter( 'ot_show_new_layout', '__return_false' );

/**
 * Theme mode activate
 */
add_filter( 'ot_theme_mode', '__return_true' );

/**
 * Required: include OptionTree.
 */
include_once( 'option-tree/ot-loader.php' );
include_once( 'inc/admin/theme-options.php' );
include_once( 'inc/admin/post-options.php' );

/**
 * Include Widgets
 */
include_once( get_template_directory() . '/inc/widgets/widget.dribbble.php' );
include_once( get_template_directory() . '/inc/widgets/widget.social.php' );
include_once( get_template_directory() . '/inc/widgets/widget.gallery.php' );

add_action( 'after_setup_theme', 'dd_theme_setup' );
if ( ! function_exists( 'dd_theme_setup' ) ) {
	
	/**
	 * Set up theme defaults and register support for various WordPress features.
	 */
	function dd_theme_setup() {

		require get_template_directory() . '/inc/functions.php';
		require get_template_directory() . '/inc/shortcodes.php';

		/**
		 * Editor Style
		 */
		add_editor_style();

		/**
		 * Load translations
		 */
		load_theme_textdomain( 'dd_string', get_template_directory() . '/languages' );

		/**
		 * Add default posts and comments RSS feed links to head
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Enable support for Post Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Add Support for WooCommerce
		 */
		add_theme_support( 'woocommerce' );

		/**
		 * Register menus
		 */
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'dd_string' ),
			'footer' => __( 'Footer Menu', 'dd_string' ),
		) );

		/**
		 * Support for post formats
		 */
		add_theme_support( 'post-formats', array( 'link', 'quote' ) );

		/**
		 * Add custom image sizes
		 */

		add_image_size( 'dd-one-half', 580, 9999, false );
		add_image_size( 'dd-one-third', 380, 9999, false );
		add_image_size( 'dd-one-fourth', 280, 9999, false );
		add_image_size( 'dd-full', 1180, 9999, false );
		add_image_size( 'dd-one-fourth-crop', 280, 250, true );

	}

} // dd_theme_setup

/**
 * Register sidebars
 */
add_action( 'widgets_init', 'dd_theme_sidebars' );
function dd_theme_sidebars() {

	register_sidebar( array(
		'name' => __( 'Blog Widgets', 'dd_string' ),
		'id' => 'sidebar-blog',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Page Widgets', 'dd_string' ),
		'id' => 'sidebar-page',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Gallery Widgets', 'dd_string' ),
		'id' => 'sidebar-gallery',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Widgets', 'dd_string' ),
		'id' => 'sidebar-footer',
		'before_widget' => '<div id="%1$s" class="widget four columns %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Top Bar Widgets', 'dd_string' ),
		'id' => 'sidebar-top-bar',
		'before_widget' => '<div id="%1$s" class="widget four columns %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'WooCommerce Widgets', 'dd_string' ),
		'id' => 'sidebar-woocommerce',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	

}

/**
 * Register post types
 */
add_action( 'init', 'dd_theme_register_post_types' );
function dd_theme_register_post_types() {

	global $dd_sn;	
	
	register_post_type( 'dd_gallery', array(
		'labels' => array(
			'name' => __( 'Galleries', 'dd_string' ),
			'singular_name' => __( 'Gallery', 'dd_string' ),
			'add_new' => __( 'Add Gallery', 'dd_string' ),
			'add_new_item' => __( 'Add Gallery', 'dd_string' ),
			'edit' => __( 'Edit', 'dd_string' ),
			'edit_item' => __( 'Edit Gallery', 'dd_string' ),
			'new_item' => __( 'New Gallery', 'dd_string' ),
			'view' => __( 'View Gallery', 'dd_string' ),
			'view_item' => __( 'View Gallery', 'dd_string' ),
			'search_items' => __( 'Search Galleries', 'dd_string' ),
			'not_found' => __( 'No Galleries found', 'dd_string' ),
			'not_found_in_trash' => __( 'No Galleries found in Trash', 'dd_string' ),
			'parent' => __( 'Parent Gallery', 'dd_string' ),
		),
		'public' => true,
		'rewrite' => array( 'slug' => 'gallery-view' ),
		'supports' => array( 'title', 'excerpt', 'custom-fields', 'editor', 'author', 'thumbnail', 'comments'  ),
	));
	register_taxonomy('dd_gallery_cats', 'dd_gallery', array( 'label' => 'Categories', 'hierarchical' => true, 'public' => true));


}

/**
 * Enqueue scripts and styles
 */
add_action( 'wp_enqueue_scripts', 'dd_theme_scripts' );
function dd_theme_scripts() {
	
	/* CSS */
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'fonts', get_template_directory_uri() . '/css/font.css' );

	if ( class_exists( 'woocommerce' ) )
		wp_enqueue_style( 'woocommerce', get_template_directory_uri() . '/css/woocommerce.css' );

	/* Plugins JS */
	wp_enqueue_script( 'plugins', get_template_directory_uri() . '/js/plugins.js', array( 'jquery' ) );

	/* Ajax Requests JS */
	//wp_enqueue_script( 'dd-ajax', get_template_directory_uri() . '/js/ajax.js', array( 'jquery' ) );	
	//wp_localize_script( 'dd-ajax', 'DDAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

	/* Custom JS */
	wp_enqueue_script( 'main-js', get_template_directory_uri() . '/js/main.js', array( 'jquery' ) );

	/* Comment Reply JS */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}

/**
 * Enqueue scripts and styles in the admin
 */
function dd_theme_scripts_admin( $hook ) {	

	if ( $hook == 'post.php' || $hook = 'post-new.php' ):
		wp_enqueue_script( 'theme-options-js', get_template_directory_uri() . '/inc/admin/js/admin.js' );
	endif;

}
add_action( 'admin_enqueue_scripts', 'dd_theme_scripts_admin' );

/**
 * Custom CSS and JS code from Theme Options.
 */

add_action( 'wp_footer', 'dd_custom_code');
function dd_custom_code() {

	global $dd_sn;
    
	if ( ot_get_option( $dd_sn . 'code_css' ) )
		echo '<style>' . ot_get_option( $dd_sn . 'code_css' ) . '</style>';

	if ( ot_get_option( $dd_sn . 'code_js' ) )
		echo '<script>' . ot_get_option( $dd_sn . 'code_js' ) . '</script>';

}

/**
 * Get id of a post by using different methods
 */
function dd_get_post_id($by, $needle){
		
	global $wpdb;
	
	if($by == 'name'){ return $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$needle."'"); }
	
	if($by == 'title'){ return $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_title = '".$needle."'"); }
	
	if($by == 'template'){ $pages = $wpdb->get_row("SELECT post_id FROM $wpdb->postmeta WHERE meta_key='_wp_page_template' AND meta_value='".$needle."'", ARRAY_A); return $pages['post_id']; }
	
}

if ( ! function_exists( 'dd_home_section_blog' ) ) {
	
	/**
	 * Home section- Blog
	 *
	 * Output contents for the section on the homepage.
	 */
	function dd_home_section_blog( $atts ) {

		global $dd_sn;

		$wrapper_class = '';

		// Wrapper classes
		if ( $atts['parity'] == 'even' )
			$wrapper_class .= 'even ';
		else
			$wrapper_class .= 'odd ';

		$args = array(
			'post_type' => 'post',
			'posts_per_page' => ot_get_option( $dd_sn . 'home_blog_amount', '5' )
		);

		if ( ot_get_option( $dd_sn . 'home_blog_cats', false ) ) {
			// Categories
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field' => 'id',
					'terms' => ot_get_option( $dd_sn . 'home_blog_cats', false )
				)
			);
		}

		$dd_query = new WP_Query( $args );

		if ( $dd_query->have_posts() ) : ?>

			<div class="blog-posts-wrapper <?php echo $wrapper_class; ?>">

				<div class="container">

					<h2 class="section-title">
						<?php _e( 'Newest Articles', 'dd_string' ); ?>
						<a href="<?php echo get_permalink( dd_get_post_id( 'template', 'template-blog.php' ) ); ?>" class="button fr"><?php _e( 'VIEW ALL', 'dd_string' ); ?></a>
					</h2>

					<div class="blog-posts masonry clearfix">

						<?php while ( $dd_query->have_posts() ) : $dd_query->the_post();  ?>

							<?php get_template_part( 'templates/content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) ); ?>

						<?php endwhile; ?>

					</div><!-- .blog-posts -->

				</div><!-- .container -->

			</div><!-- .blog-posts-wrapper -->

		<?php endif; wp_reset_postdata();

	}

}

if ( ! function_exists( 'dd_home_section_gallery' ) ) {
	
	/**
	 * Home section- Gallery
	 *
	 * Output contents for the section on the homepage.
	 */
	function dd_home_section_gallery( $atts ) {

		global $dd_sn;

		$wrapper_class = '';

		// Wrapper classes
		if ( $atts['parity'] == 'even' )
			$wrapper_class .= 'even ';
		else
			$wrapper_class .= 'odd ';

		$args = array(
			'post_type' => 'dd_gallery',
			'posts_per_page' => ot_get_option( $dd_sn . 'home_gallery_amount', '8' )
		);

		if ( ot_get_option( $dd_sn . 'home_gallery_cats', false ) ) {
			// Categories
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'dd_gallery_cats',
					'field' => 'id',
					'terms' => ot_get_option( $dd_sn . 'home_gallery_cats', false )
				)
			);
		}

		$dd_query = new WP_Query( $args );
		
		if ( $dd_query->have_posts() ) : ?>

			<div class="galleries-wrapper <?php echo $wrapper_class; ?>">

				<div class="container">

					<h2 class="section-title">
						<?php _e( 'Newest Galleries', 'dd_string' ); ?>
						<span class="carousel-nav">
							<span class="carousel-nav-inner">
								<a href="#" class="carousel-prev"></a>
								<a href="#" class="carousel-next"></a>
							</span>
						</span><!-- .carousel-nav -->
						<a href="<?php echo get_permalink( dd_get_post_id( 'template', 'template-dd_gallery.php' ) ); ?>" class="button fr"><?php _e( 'VIEW ALL', 'dd_string' ); ?></a>
					</h2>

					<div class="galleries carousel clearfix">

						<div class="flexslider">

							<ul class="slides">

								 <?php while ( $dd_query->have_posts() ) : $dd_query->the_post();  ?>

								 	<?php

								 		$gallery_images = get_post_meta( get_the_ID(), $dd_sn . 'gallery_images', true );
										if ( ! empty( $gallery_images ) )
											$gallery_images_count = count( $gallery_images );
										else
											$gallery_images_count = 0;

										if ( has_post_thumbnail() )
											$post_class_append = 'has-thumb ';
										else
											$post_class_append = '';

								 	?>

									<li class="gallery four columns <?php echo $post_class_append; ?>">

										<div class="gallery-inner">

											<div class="gallery-thumb">

												<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'dd-one-fourth-crop' ); ?></a>

												<div class="gallery-thumb-overlay">
													<a href="<?php the_permalink(); ?>" class="button"><span class="icon-layout"></span><?php _e( 'VIEW GALLERY', 'dd_string' ); ?></a>
												</div><!-- gallery-thumb-overlay -->

											</div><!-- .gallery-thumb -->

											<div class="gallery-main">

												<div class="gallery-meta clearfix">

													<a href="<?php the_permalink(); ?>" class="gallery-title"><?php the_title(); ?></a>
													<a href="<?php the_permalink(); ?>" class="gallery-images"><span class="icon-docs"></span><?php echo $gallery_images_count; ?></a>

												</div><!-- .gallery-meta -->

											</div><!-- .gallery-main -->

										</div><!-- .gallery-inner -->

									</li><!-- .gallery -->

								<?php endwhile; ?>

							</ul><!-- .slides -->

						</div><!-- .flexslider -->

					</div><!-- galleries -->
					
				</div><!-- .container -->

			</div><!-- .galleries-wrapper -->

		<?php endif; wp_reset_postdata();

	}

}

if ( ! function_exists( 'dd_home_section_products' ) ) {
	
	/**
	 * Home section - Products
	 *
	 * Output contents for the section on the homepage.
	 */
	function dd_home_section_products( $atts ) {

		if ( class_exists( 'woocommerce' ) ) :

			global $dd_sn;
			global $woocommerce; 

			$woo_cart_url = $woocommerce->cart->get_cart_url();

			$wrapper_class = '';

			// Wrapper classes
			if ( $atts['parity'] == 'even' )
				$wrapper_class .= 'even ';
			else
				$wrapper_class .= 'odd ';

			$args = array(
				'post_type' => 'product',
				'posts_per_page' => ot_get_option( $dd_sn . 'home_products_amount', '8' )
			);
			$dd_query = new WP_Query( $args );
			
			if ( $dd_query->have_posts() ) : ?>

				<div class="products-wrapper <?php echo $wrapper_class; ?>">

					<div class="container">

						<h2 class="section-title">
							<?php _e( 'What\'s In The Store', 'dd_string' ); ?>
							<span class="carousel-nav">
								<span class="carousel-nav-inner">
									<a href="#" class="carousel-prev"></a>
									<a href="#" class="carousel-next"></a>
								</span>
							</span><!-- .carousel-nav -->
							<a href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>" class="button fr"><?php _e( 'VIEW ALL', 'dd_string' ); ?></a>
						</h2>

						<div class="products carousel clearfix">

							<div class="flexslider">

								<ul class="slides">

									<?php while ( $dd_query->have_posts() ) : $dd_query->the_post(); global $product;  ?>

										<li class="product four columns">

											<div class="product-thumb">

												<?php if ( has_post_thumbnail() ) : ?>
													<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'dd-one-fourth-crop' ); ?></a>
												<?php endif; ?>

												<div class="product-thumb-overlay">
													<div class="product-thumb-overlay-inner">
														<a href="<?php echo do_shortcode( '[add_to_cart_url id="' . get_the_ID() . '"]' ); ?>" data-view-cart-url="<?php echo $woo_cart_url; ?>" data-view-cart-text="<?php _e( 'VIEW CART', 'dd_string' ); ?>" class="button add-to-cart-ajax"><span class="icon-cart"></span><?php _e( 'ADD TO CART', 'dd_string' ); ?></a>
														<br>
														<a href="<?php the_permalink(); ?>" class="button"><span class="icon-text-doc"></span><?php _e( 'MORE DETAILS', 'dd_string' ); ?></a>
													</div><!-- .product-thumb-overlay-inner -->
												</div><!-- product-thumb-overlay -->

											</div><!-- .product-thumb -->

											<div class="product-main">

												<div class="product-meta clearfix">

													<a href="<?php the_permalink(); ?>" class="product-title"><?php the_title(); ?></a>
													<a href="<?php the_permalink(); ?>" class="product-price"><span class="icon-tag"></span><?php echo $product->get_price_html(); ?></a>

												</div><!-- .product-meta -->

											</div><!-- .product-main -->

										</li><!-- .product -->

									<?php endwhile; ?>

								</ul><!-- .slides -->

							</div><!-- .flexslider -->

						</div><!-- .products -->

					</div><!-- .container -->

				</div><!-- .products-wrapper -->

			<?php endif; wp_reset_postdata();

		endif;

	}

}

if ( ! function_exists( 'dd_home_section_custom' ) ) {

	/**
	 * Home section - Custom
	 *
	 * Output the custom content from the Theme Options to the section on the homepage.
	 */
	function dd_home_section_custom( $atts ) {

		global $dd_sn;

		$wrapper_class = '';

		// Wrapper classes
		if ( $atts['parity'] == 'even' )
			$wrapper_class .= 'even ';
		else
			$wrapper_class .= 'odd ';

		if ( ot_get_option( $dd_sn . 'home_custom_content' ) ) : ?>

			<div class="custom-content-wrapper <?php echo $wrapper_class; ?>">

				<div class="container">

					<?php echo do_shortcode( ot_get_option( $dd_sn . 'home_custom_content' ) ); ?>

				</div><!-- .container -->

			</div><!-- .custom-content-wrapper -->

		<?php endif;

	}

}

if ( ! function_exists( 'dd_related_galleries' ) ) {

	/**
	 * Related Galleries
	 */
	function dd_related_galleries( $post_id, $layout = 'c' ) {

		$col_max = 4;
		$thumb_id = 'dd-one-fourth-crop';
		$col_class = 'four columns';
		$posts_per_page = 4;

		if ( $layout == 'cs' ) {
			$col_max = 2;
			$thumb_id = 'dd-one-third';
			$col_class = 'one-third column';
			$posts_per_page = 2;
		}

		global $dd_sn;
		$categories = get_the_terms( $post_id, 'dd_gallery_cats' );
	
		if ( ! empty ( $categories ) ) :

			foreach ( $categories as $category ) :
				
				$categories_arr[] = $category->term_id;

			endforeach;

			$post_not_in = array($post_id);

			$args = array(
				'post_type' => 'dd_gallery',
				'posts_per_page' => $posts_per_page,
				'post__not_in' => $post_not_in,
				'tax_query' => array(
					array(
						'taxonomy' => 'dd_gallery_cats',
						'field' => 'id',
						'terms' => $categories_arr,
						'operator' => 'IN',
					)
				)
			);
			$dd_query = new WP_Query( $args );

			if ( $dd_query->have_posts() ) : $count = 0; ?>

				<div class="gallery-related">

					<h2 class="section-title"><?php _e( 'Related Galleries', 'dd_string' ); ?></h2>

					<div class="galleries clearfix">

						<?php while ( $dd_query->have_posts() ) : $dd_query->the_post(); $count++; ?>

							<?php

								$class = '';

								$gallery_images = get_post_meta( get_the_ID(), $dd_sn . 'gallery_images', true );
								if ( ! empty( $gallery_images ) )
									$gallery_images_count = count( $gallery_images );
								else
									$gallery_images_count = 0;

								if ( $count == $col_max )
									$class .= 'last ';

								if ( has_post_thumbnail() )
									$class .= 'has-thumb';

							?>

							<div class="gallery <?php echo $col_class; ?> <?php echo $class; ?>">

								<div class="gallery-inner">

									<div class="gallery-thumb">

										<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $thumb_id ); ?></a>

										<div class="gallery-thumb-overlay">
											<a href="<?php the_permalink(); ?>" class="button"><?php _e( 'VIEW GALLERY', 'dd_string' ); ?></a>
										</div><!-- gallery-thumb-overlay -->

									</div><!-- .gallery-thumb -->

									<div class="gallery-main">

										<div class="gallery-meta clearfix">

											<a href="<?php the_permalink(); ?>" class="gallery-title"><?php the_title(); ?></a>
											<a href="<?php the_permalink(); ?>" class="gallery-images"><span class="icon-docs"></span><?php echo $gallery_images_count; ?></a>

										</div><!-- .gallery-meta -->

									</div><!-- .gallery-main -->

								</div><!-- .gallery-inner -->

							</div><!-- .gallery -->

						<?php endwhile; ?>

					</div><!-- galleries -->

				</div><!-- .gallery-related -->

			<?php endif; wp_reset_postdata();

		endif;

	}

}

/**
 * Google Fonts
 */
function dd_google_fonts() {

    $protocol = is_ssl() ? 'https' : 'http';

    wp_enqueue_style( 'dd-gf-arimo', "$protocol://fonts.googleapis.com/css?family=Arimo:400,700,400italic,700italic" );
    wp_enqueue_style( 'dd-gf-bitter', "$protocol://fonts.googleapis.com/css?family=Bitter:400,700,400italic" );
    wp_enqueue_style( 'dd-gf-opensans', "$protocol://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" );
    wp_enqueue_style( 'dd-gf-roboto', "$protocol://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic" );

}
add_action( 'wp_enqueue_scripts', 'dd_google_fonts' );

function wave_remove_theme_update( $array ){
			
	if ( isset( $array->response ) && isset( $array->response['wave'] ) ) {
		unset( $array->response['wave'] );
	}

	return $array;

} add_filter('site_transient_update_themes','wave_remove_theme_update', 10, 1);