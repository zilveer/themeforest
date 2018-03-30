<?php
/**
 * News Stand functions and definitions
 *
 * @package News Stand
 */


/**
 * Add Redux Framework & extras
 */
require get_template_directory() . '/admin/admin-init.php';
require get_template_directory() . '/cmb/example-functions.php';
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'newsstand_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function newsstand_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on News Stand, use a find and replace
	 * to change 'newsstand' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'newsstand', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'newsstand' ),
		'footer' => __( 'Footer Menu', 'newsstand' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'gallery', 'audio', 'video', 'quote'
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'newsstand_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // newsstand_setup
add_action( 'after_setup_theme', 'newsstand_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function newsstand_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'newsstand' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Shop Sidebar', 'newsstand' ),
		'id'            => 'sidebar-2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'newsstand_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function newsstand_scripts() {
	// Stylesheet
		wp_enqueue_style( 'newsstand-fa', get_template_directory_uri() . '/css/font-awesome.min.css' );
		wp_enqueue_style( 'newsstand-slick', get_template_directory_uri() . '/css/slick.css' );
		wp_enqueue_style( 'newsstand-lightgallery', get_template_directory_uri() . '/css/lightGallery.css"' );
		wp_enqueue_style( 'newsstand-malihu', get_template_directory_uri() . '/css/jquery.mCustomScrollbar.min.css' );
		wp_enqueue_style( 'newsstand-normalize', get_template_directory_uri() . '/css/normalize.css' );
		wp_enqueue_style( 'newsstand-main', get_template_directory_uri() . '/css/main.css' );
		wp_enqueue_style( 'newsstand-style', get_stylesheet_uri() );

	// Javascript
		wp_enqueue_script( 'jquery' );
		if (is_page_template('templates/page-contact.php')) {
			wp_enqueue_script( 'newsstand-googleapi', 'https://maps.googleapis.com/maps/api/js', array(), '1', true );
		}
		wp_enqueue_script( 'newsstand-modernizr', get_template_directory_uri() . '/js/vendor/modernizr-2.8.3.min.js' );
		wp_enqueue_script( 'newsstand-plugins', get_template_directory_uri() . '/js/plugins.js', array(), '1', true );
		wp_enqueue_script( 'newsstand-main', get_template_directory_uri() . '/js/main.js', array(), '1', true );

		wp_enqueue_script( 'newsstand-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
		wp_enqueue_script( 'newsstand-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'newsstand_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

function newsstand_custom_head_style()
{
	global $newsstand;
    echo "<style>".$newsstand['newsstand_custom_css']."</style>";
}
add_action('wp_head', 'newsstand_custom_head_style');

function newsstand_custom_admin_css() {
    wp_enqueue_style( 'newsstand-custom-admin-css', get_template_directory_uri() . '/css/admin-style.css' );
    wp_enqueue_style( 'newsstand-custom-admin-fa', get_template_directory_uri() . '/css/font-awesome.min.css' );
    wp_enqueue_script( 'newsstand-custom-bootstrap-tooltip', get_template_directory_uri() . '/js/bootstrap/tooltip.js', array(), '1', true );
    wp_enqueue_script( 'newsstand-custom-bootstrap-popover', get_template_directory_uri() . '/js/bootstrap/popover.js', array(), '1', true );
    wp_enqueue_script( 'newsstand-custom-admin-js', get_template_directory_uri() . '/js/admin-js.js', array(), '1', true );
}
add_action( 'admin_enqueue_scripts', 'newsstand_custom_admin_css' );

function newsstand_metabox_script() {
 wp_register_script('newsstand-meta', get_template_directory_uri() . '/js/meta.js', array('jquery'), '1.0.0');
 wp_enqueue_script('newsstand-meta');
}
add_action('admin_enqueue_scripts', 'newsstand_metabox_script');

function newsstand_title($limit){
	$excerpt = get_the_title();
	$excerpt = strip_shortcodes($excerpt);
	$excerpt = strip_tags($excerpt);
	$the_str = substr($excerpt, 0, $limit);

	if (strlen($excerpt) > $limit) {
		$the_str .= "...";
	}

	return $the_str;
}

function newsstand_excerpt($limit){
	$excerpt = get_the_content();
	$excerpt = strip_shortcodes($excerpt);
	$excerpt = strip_tags($excerpt);
	$the_str = substr($excerpt, 0, $limit);

	if (strlen($excerpt) > $limit) {
		$the_str .= "...";
	}

	return $the_str;
}

function newsstand_limit($text, $limit){
	$excerpt = $text;
	$excerpt = strip_shortcodes($excerpt);
	$excerpt = strip_tags($excerpt);
	$the_str = substr($excerpt, 0, $limit);

	if (strlen($excerpt) > $limit) {
		$the_str .= "...";
	}

	return $the_str;
}

function newsstand_cat_color($post_id) {
	$categoryID = get_the_category($post_id);
	$categoryID = $categoryID[0]->cat_ID;
	$hex_color = Taxonomy_MetaData::get( 'category', $categoryID, 'newsstand_cat_color');

	return $hex_color;
}

function newsstand_cat_name($post_id) {
	$categoryID = get_the_category($post_id);
	$cat_name = $categoryID[0]->category_nicename;

	return $cat_name;
}

function newsstand_sticky_class_for_single_post_23559( $classes, $class, $post_id ) {
	if ( ! in_array( 'sticky', $classes ) && is_sticky( $post_id ) && ! is_paged() )
		$classes[] = 'sticky';

	return $classes;
}
add_filter( 'post_class', 'newsstand_sticky_class_for_single_post_23559', 10, 3 );

add_action( 'after_setup_theme', 'newsstand_woocommerce_support' );
function newsstand_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

function newsstand_user_excerpt($user_id, $limit){
	$user_info = get_userdata($user_id);
	$user_desc = $user_info->description;
	$excerpt = strip_tags($user_desc);
	$the_str = substr($excerpt, 0, $limit);

	if (strlen($excerpt) > $limit) {
		$the_str .= "...";
	}

	return $the_str;
}

function newsstand_pagination() {
    global $wp_query;
    $big = 999999999; // need an unlikely integer
    $pages = paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $wp_query->max_num_pages,
            'prev_next' => false,
            'type'  => 'array',
            'prev_next'   => TRUE,
			'prev_text'    => __('«', 'newsstand'),
			'next_text'    => __('»', 'newsstand'),
        ) );
        if( is_array( $pages ) ) {
            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
            foreach ( $pages as $page ) {
                    echo "<li>$page</li>";
            }
        }
}

function newsstand_searchfilter($query) {
	if ($query->is_search) {
		$query->set('post_type', 'post');
		$query->set('posts_per_page', '9');
	}
	return $query;
}
add_filter('pre_get_posts','newsstand_searchfilter');

/* Twitter Feed Widget Start */
class newsstand_widget_twitter_feed extends WP_Widget {

	function __construct() {
		parent::__construct(
			// Base ID of your widget
			'newsstand_widget_twitter_feed',
			// Title
			__('NewsStand - Twitter Feed', 'iblog'),
			// Description
			array( 'description' => __( 'Add Twitter Feed', 'iblog' ), )
		);
	}

	// Creating widget front-end
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$username = $instance['username'];
		$limit = (int)$instance['limit'];

		// before and after widget arguments are defined by themes
		echo '<aside id="newsstand-twitter" class="widget">';

		if (!empty( $title )) {
			echo '<h1 class="widget-title">' . $title . '</h1>';
		}

		if (!empty($username) && $limit != 0) {

			?>
				<div class="twitter-feed"></div>

				<script>
					(function($) {
						"use strict";

						$(document).ready(function() {
							if ($(".twitter-feed").length) {
								$('.twitter-feed').twittie({
									apiPath: '<?php echo get_template_directory_uri() . "/api/tweet.php" ?>',
									username: '<?php echo esc_js($username); ?>',
									count: <?php echo esc_js($limit); ?>,
									hideReplies: false,
									template: '<a href="{{url}}" target="_blank"><span class="text">{{tweet}}</span><span class="date">{{date}}</span></a>'
								});
							}
						});
					})(jQuery);
				</script>
			<?php

		}

		echo "</aside>";
	}

	// Widget Backend
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		} else { $title = __( 'Twitter Feed', 'iblog' ); }

		if ( isset( $instance[ 'username' ] ) ) {
			$username = $instance[ 'username' ];
		} else { $username = __( 'gordonramsay', 'iblog' ); }

		if ( isset( $instance[ 'limit' ] ) ) {
			$limit = $instance[ 'limit' ];
		} else { $limit = __( '5', 'iblog' ); }

		// Widget admin form
		?>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:', 'iblog' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'username' )); ?>"><?php _e( 'Username:', 'iblog' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'username' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'username' )); ?>" type="text" value="<?php echo esc_attr( $username ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'limit' )); ?>"><?php _e( 'Limit:', 'iblog' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'limit' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'limit' )); ?>" type="text" value="<?php echo esc_attr( $limit ); ?>" />
			</p>
		<?php
	}

	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['username'] = ( ! empty( $new_instance['username'] ) ) ? strip_tags( $new_instance['username'] ) : '';
		$instance['limit'] = ( ! empty( $new_instance['limit'] ) ) ? strip_tags( $new_instance['limit'] ) : '';
		return $instance;
	}
}

// Register and load the widget
function newsstand_load_twitter_feed_widget() {
	register_widget( 'newsstand_widget_twitter_feed' );
}
add_action( 'widgets_init', 'newsstand_load_twitter_feed_widget' );
/* Twitter Feed Widget End */

/* Instagram Feed Widget Start */

// Widget : iBlog Instagram Feed
	class newsstand_widget_instagram_feed extends WP_Widget {

		function __construct() {
			parent::__construct(
				// Base ID of your widget
				'newsstand_widget_instagram_feed',
				// Title
				__('Newsstand - Instagram Feed', 'iblog'),
				// Description
				array( 'description' => __( 'Add Instagram Feed', 'iblog' ), )
			);
		}

		// Creating widget front-end
		public function widget( $args, $instance ) {
			$title = apply_filters( 'widget_title', $instance['title'] );
			$userid = (int)$instance['userid'];
			$limit = (int)$instance['limit'];

			// before and after widget arguments are defined by themes
			echo '<aside id="newsstand-instagram" class="widget">';

			if (!empty( $title )) {
				echo '<h1 class="widget-title">' . $title . '</h1>';
			}

			if (!empty($userid) && $limit != 0) {

				?>
					<div id="instafeed"></div>

					<script>
						(function($) {
							"use strict";

							$(document).ready(function() {
								if ($("#instafeed").length > 0) {
									var feed = new Instafeed({
										target: "instafeed",
									    get: 'user',
									    limit: <?php echo esc_js($limit); ?>,
									    userId: <?php echo esc_js($userid); ?>,
									    accessToken: '1068835781.467ede5.bed6906b0d4f43279648a2d6bf6c7b0d',
									    template: '<span class="sameHeight" style="background-image: url({{image}});"><a href="{{link}}" class="plus-hover" target="_blank"><span class="plus"></span></a></span>',
									    sortBy: 'most-recent',
									    useHttp: true,
									});
									feed.run();
								}
							});
						})(jQuery);
					</script>
				<?php

			}

			echo "</aside>";
		}

		// Widget Backend
		public function form( $instance ) {
			if ( isset( $instance[ 'title' ] ) ) {
				$title = $instance[ 'title' ];
			} else { $title = __( 'Instagram Feed', 'iblog' ); }

			if ( isset( $instance[ 'userid' ] ) ) {
				$userid = $instance[ 'userid' ];
			} else { $userid = __( '192815961', 'iblog' ); }

			if ( isset( $instance[ 'limit' ] ) ) {
				$limit = $instance[ 'limit' ];
			} else { $limit = __( '6', 'iblog' ); }

			// Widget admin form
			?>
				<p>
					<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:','iblog' ); ?></label>
					<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
				</p>
				<p>
					<label for="<?php echo esc_attr($this->get_field_id( 'userid' )); ?>"><?php _e( 'User ID:', 'iblog' ); ?></label>
					<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'userid' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'userid' )); ?>" type="text" value="<?php echo esc_attr( $userid ); ?>" />
				</p>
				<p>
					<label for="<?php echo esc_attr($this->get_field_id( 'limit' )); ?>"><?php _e( 'Limit:', 'iblog' ); ?></label>
					<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'limit' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'limit' )); ?>" type="text" value="<?php echo esc_attr( $limit ); ?>" />
				</p>
			<?php
		}

		// Updating widget replacing old instances with new
		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['userid'] = ( ! empty( $new_instance['userid'] ) ) ? strip_tags( $new_instance['userid'] ) : '';
			$instance['limit'] = ( ! empty( $new_instance['limit'] ) ) ? strip_tags( $new_instance['limit'] ) : '';
			return $instance;
		}
	}

	// Register and load the widget
	function newsstand_load_instagram_feed_widget() {
		register_widget( 'newsstand_widget_instagram_feed' );
	}
	add_action( 'widgets_init', 'newsstand_load_instagram_feed_widget' );

/* Instagram Feed Widget End */

function newsstand_custom_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>

   <div <?php comment_class('single-comment'); ?> id="li-comment-<?php comment_ID() ?>">
	   <span class="avatar"><?php echo get_avatar( $comment->comment_ID, 120 ); ?></span>

	   <div class="comment-content">
	   		<div class="inside">
	   			<?php if ($comment->comment_approved == '0') : ?>
	   			   <span class="awaiting-moderator"><?php _e('Your comment is awaiting moderation.', 'iblog') ?></span>
	   			<?php endif; ?>
	   			<span class="authorinfo">
	   				<span class="author-date"><?php comment_date('d/m/Y'); ?></span>
	   			</span>
	   			<span class="author-name"><?php comment_author_link(); ?></span>
	   			<span class="text"><?php comment_text(); ?></span>
	   			<span class="buttons">
	   				<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'])))?>
	   				<?php edit_comment_link(); ?>
	   			</span>
	   		</div>
	   </div>
   </div>

<?php }

// Change number or products per row to 3
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 9;' ), 20 );

function woocommerce_output_related_products() {
	$args = array(
        'posts_per_page' => 3,
        'columns'        => 3,
      );
	woocommerce_related_products( $args );
}