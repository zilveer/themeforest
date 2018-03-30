<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*-----------------------------------------------------------------------------------*/
/* Exclude categories from displaying on the "Blog" page template.
/*-----------------------------------------------------------------------------------*/

// Exclude categories on the "Blog" page template.
add_filter( 'woo_blog_template_query_args', 'woo_exclude_categories_blogtemplate' );

function woo_exclude_categories_blogtemplate ( $args ) {

	if ( ! function_exists( 'woo_prepare_category_ids_from_option' ) ) { return $args; }

	$excluded_cats = array();

	// Process the category data and convert all categories to IDs.
	$excluded_cats = woo_prepare_category_ids_from_option( 'woo_exclude_cats_blog' );

	// Homepage logic.
	if ( count( $excluded_cats ) > 0 ) {

		// Setup the categories as a string, because "category__not_in" doesn't seem to work
		// when using query_posts().

		foreach ( $excluded_cats as $k => $v ) { $excluded_cats[$k] = '-' . $v; }
		$cats = join( ',', $excluded_cats );

		$args['cat'] = $cats;
	}

	return $args;

} // End woo_exclude_categories_blogtemplate()

/*-----------------------------------------------------------------------------------*/
/* Exclude categories from displaying on the homepage.
/*-----------------------------------------------------------------------------------*/

// Exclude categories on the homepage.
add_filter( 'pre_get_posts', 'woo_exclude_categories_homepage' );

function woo_exclude_categories_homepage ( $query ) {

	if ( ! function_exists( 'woo_prepare_category_ids_from_option' ) ) { return $query; }

	$excluded_cats = array();

	// Process the category data and convert all categories to IDs.
	$excluded_cats = woo_prepare_category_ids_from_option( 'woo_exclude_cats_home' );

	// Homepage logic.
	if ( is_home() && ( count( $excluded_cats ) > 0 ) ) {
		$query->set( 'category__not_in', $excluded_cats );
	}

	$query->parse_query();

	return $query;

} // End woo_exclude_categories_homepage()

/*-----------------------------------------------------------------------------------*/
/* post nav
/*-----------------------------------------------------------------------------------*/
// Single post navigation
add_action( 'woo_post_after', 'woo_postnav', 10 );

if (!function_exists('woo_postnav')):
	function woo_postnav() {

		if ( is_single() ) {
		?>
	        <div class="post-entries">
	            <div class="nav-prev fl"><?php previous_post_link( '%link', '<i class="fa fa-angle-left"></i> %title' ) ?></div>
	            <div class="nav-next fr"><?php next_post_link( '%link', '%title <i class="fa fa-angle-right"></i>' ) ?></div>
	            <div class="fix"></div>
	        </div>

		<?php
		}
	}
endif;

/*-----------------------------------------------------------------------------------*/
/* Post Inside After */
/*-----------------------------------------------------------------------------------*/
add_action( 'woo_post_inside_after_singular-post', 'woo_post_inside_after_default', 10 );

if ( ! function_exists( 'woo_post_inside_after_default' ) ):
	function woo_post_inside_after_default() {

		$post_info ='[post_tags before=""]';
		printf( '<div class="post-utility">%s</div>' . "\n", apply_filters( 'woo_post_inside_after_default', $post_info ) );

	} // End woo_post_inside_after_default()
endif;


/*-----------------------------------------------------------------------------------*/
/* Add Post Thumbnail to Single posts on Archives */
/*-----------------------------------------------------------------------------------*/
add_action( 'woo_post_inside_before', 'woo_display_post_image', 10 );

if ( ! function_exists( 'woo_display_post_image' ) ):

	function woo_display_post_image() {
		global $woo_options;

		$display_image = false;

		if (isset($woo_options['woo_thumb_w']) && isset( $woo_options['woo_thumb_h']) && isset($woo_options['woo_thumb_align']) ) {
			$width = $woo_options['woo_thumb_w'];
			$height = $woo_options['woo_thumb_h'];
			// $align = $woo_options['woo_thumb_align'];
		}

		if ( is_single() && isset( $woo_options['woo_thumb_single'] ) && ( $woo_options['woo_thumb_single'] == 'true' ) ) {
			$width = $woo_options['woo_single_w'];
			$height = $woo_options['woo_single_h'];
			// $align = $woo_options['woo_thumb_align_single'];
			$display_image = true;
		}

		if ( $display_image == true && ! woo_embed( '' ) ) { woo_image( 'width=' . $width . '&height=' . $height ); }
	} // End woo_display_post_image()

endif;

/*-----------------------------------------------------------------------------------*/
/* Author Box */
/*-----------------------------------------------------------------------------------*/

add_action( 'wp_head', 'woo_author', 10 );

if ( ! function_exists( 'woo_author' ) ) :

	function woo_author () {
		// Author box single post page
		if ( is_single() && get_option( 'woo_disable_post_author' ) != 'true' ) { add_action( 'woo_post_inside_after', 'woo_author_box', 10 ); }
		// Author box author page
		if ( is_author() ) { add_action( 'woo_loop_before', 'woo_author_box', 10 ); }
	} // End woo_author()

endif;

/*-----------------------------------------------------------------------------------*/
/* Single Post Author */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'woo_author_box' ) ):
	function woo_author_box () {

		global $post;
		$author_id=$post->post_author;

		?>
		<aside id="post-author">

			<div class="profile-image"><?php echo get_avatar( $author_id, '80' ); ?></div>
			<div class="profile-content">

				<h4>
					<?php printf( esc_attr__( 'About %s', 'woothemes' ), get_the_author_meta( 'display_name', $author_id ) ); ?>
				</h4>

				<?php echo get_the_author_meta( 'description', $author_id ); ?>

				<?php if ( is_singular() ) { ?>

					<div class="profile-link">

						<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID', $author_id ) ) ); ?>">
							<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'woothemes' ), get_the_author_meta( 'display_name', $author_id ) ); ?>
						</a>

					</div><!--#profile-link-->

				<?php } ?>
			</div>

			<div class="fix"></div>

		</aside>
		<?php
	} // End woo_author_box()
endif;

// Woo Conditionals
add_action( 'woo_head', 'woo_conditionals', 10 );



/*-----------------------------------------------------------------------------------*/
/* Woo Conditionals */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'woo_conditionals' ) ) :
	function woo_conditionals () {
		//Video Embed
		if( is_single()) {
			add_action( 'woo_post_inside_before', 'freschi_get_embed' );
		}

		// Post More
		if ( ! is_singular() && ! is_404() ||  is_page_template( 'template-blog.php' ) || is_page_template( 'template-blog-elegant.php' )  ) {
			add_action( 'woo_post_inside_after', 'woo_post_more' );
		}


	} // End woo_conditionals()
endif;

/*-----------------------------------------------------------------------------------*/
/* Video Embed  */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'freschi_get_embed' ) ):
	function freschi_get_embed() {
		// Setup height & width of embed
		$width = '767';
		$height = '300';
		$embed = woo_embed( 'width=' . $width . '&height=' . $height );

		if ( '' != $embed ) {
			?>
			<div class="post-embed">
				<?php echo $embed; ?>
			</div><!-- /.post-embed -->
			<?php
		}
	} // End freschi_get_embed()
endif;

/*-----------------------------------------------------------------------------------*/
/* Post More  */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'woo_post_more' ) ):
	function woo_post_more() {
		if ( get_option( 'woo_disable_post_more' ) != 'true' ) {

		$html = '';

		if ( get_option('woo_post_content') == 'excerpt' ) { $html .= '[view_full_article after=" <span class=\'sep\'>&rarr;</span>"] '; }

		$html = apply_filters( 'woo_post_more', $html );

			if ( $html != '' ) {
				?>
				<div class="post-more">
					<?php
						echo $html;
					?>
				</div>
				<?php
			}
		}
	} // End woo_post_more()
endif;

/*-----------------------------------------------------------------------------------*/
/* Add customisable post meta */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'woo_post_meta' ) ):
	function woo_post_meta() {
		if ( is_page() ) return;

		$post_info = '<span class="small">' . __( 'Published on ', 'woothemes' ) . ' </span> [post_date after=" |"] <span class="small">' . __( 'in', 'woothemes' ) . '</span> [post_categories before=""] <span class="small">' . __( 'By', 'woothemes' ) . '</span> [post_author_posts_link after=" |"] [post_comments]' . ' [post_edit]';
		printf( '<div class="post-meta">%s</div>' . "\n", apply_filters( 'woo_filter_post_meta', $post_info ) );

	} // End woo_post_meta()
endif;

if ( ! function_exists( 'woo_elegant_post_meta' ) ) :
	function woo_elegant_post_meta() {
		if ( is_page() ) return;

		$post_info = '<span class="small">' . __( 'in', 'woothemes' ) . '</span> [post_categories before=""] <span class="small">' . __( 'By', 'woothemes' ) . '</span> [post_author_posts_link after=" |"] [post_comments]' . ' [post_edit]';
		printf( '<div class="post-meta">%s</div>' . "\n", apply_filters( 'woo_filter_post_meta', $post_info ) );


	} // End woo_elegant_post_meta()
endif;
