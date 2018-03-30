<?php

/**
 * 
 * The theme functions
 *
 */

//define admin uri
if ( !defined('STYLICO_ADMIN_URI') )
    define( 'STYLICO_ADMIN_URI', get_template_directory_uri() . '/admin' );

//get theme options
global $stylico_theme_options;
$stylico_theme_options = get_option('stylico_theme_options');

if ( ! isset( $content_width ) ) $content_width = 920;

add_action( 'after_setup_theme', 'stylico_setup' );
add_action( 'wp_print_scripts', 'stylico_enqueue_scripts' );
add_action( 'wp_print_styles', 'stylico_enqueue_styles' );

add_filter( 'wp_page_menu_args', 'home_page_menu_arg' );
add_filter( 'excerpt_length', 'new_excerpt_length' );
add_filter( 'excerpt_more', 'new_excerpt_more' );
add_filter( 'comment_form_default_fields','stylico_comment_form_fields' );
add_filter( 'comment_form_field_comment', 'stylico_comment_form_comment' );
add_filter( 'widget_text', 'do_shortcode' );


/**
 * Stylico Setup
*/
function stylico_setup() {
	
	//load language file
	load_theme_textdomain( 'stylico', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );
		
	//include neceassry php files
	include_once( TEMPLATEPATH  . '/admin/index.php' );
	include_once( TEMPLATEPATH . '/inc/widgets.php' );
	include_once( TEMPLATEPATH . '/inc/shortcodes.php' );
	
	add_editor_style();
	
	//set image support and sizes
	add_custom_background();
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'post-sticky', 570, 150, true );
	add_image_size( 'post-teaser', 570, 200, true );
	add_image_size( 'post-teaser-fullwidth', 910, 200, true );
	set_post_thumbnail_size( 90, 90 );
	
	
	//CUSTOM MENU AREAS	
	register_nav_menus( array('header-menu' => __( 'Header Menu', 'stylico' ), 'footer-menu' => __( 'Footer Menu', 'stylico' ) ) );
	
	
	//******** WIDGET AREAS ************
	
	//Home widget areas
	register_sidebar( array(
		  'name' => 'Home Left',
		  'id' => 'home-left',
		  'before_widget' => '<div id="%1$s" class="widget %2$s content-box">',
		  'after_widget' => '</div>',
		  'before_title' => '<h3 class="widget-title ribbon-blue">',
		  'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		  'name' => 'Home Center',
		  'id' => 'home-center',
		  'before_widget' => '<div id="%1$s" class="widget %2$s content-box">',
		  'after_widget' => '</div>',
		  'before_title' => '<h3 class="widget-title ribbon-lila">',
		  'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		  'name' => 'Home Right',
		  'id' => 'home-right',
		  'before_widget' => '<div id="%1$s" class="widget %2$s content-box">',
		  'after_widget' => '</div>',
		  'before_title' => '<h3 class="widget-title ribbon-green">',
		  'after_title' => '</h3>',
	) );
	
	
	//Sidebar widget area
	register_sidebar( array(
		  'name' => 'Main Sidebar',
		  'id' => 'sidebar-1',
		  'before_widget' => '<div id="%1$s" class="widget %2$s content-box">',
		  'after_widget' => "</div>",
		  'before_title' => '<h3 class="widget-title ribbon-blue">',
		  'after_title' => '</h3>',
	) );
	
	
	//Footer widget area
	register_sidebar( array(
		  'name' => 'Footer Left',
		  'id' => 'footer-left',
		  'before_widget' => '<div id="%1$s" class="widget %2$s content-box">',
		  'after_widget' => "</div>",
		  'before_title' => '<h3 class="widget-title">',
		  'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		  'name' => 'Footer Center',
		  'id' => 'footer-center',
		  'before_widget' => '<div id="%1$s" class="widget %2$s content-box">',
		  'after_widget' => "</div>",
		  'before_title' => '<h3 class="widget-title">',
		  'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		  'name' => 'Footer Right',
		  'id' => 'footer-right',
		  'before_widget' => '<div id="%1$s" class="widget %2$s content-box">',
		  'after_widget' => "</div>",
		  'before_title' => '<h3 class="widget-title">',
		  'after_title' => '</h3>',
	) );
	
	
	
	//CUSTOM POST TYPES
	$gigs_labels = array(
	  'name' => _x('Gigs', 'post type general name', 'stylico'),
	  'singular_name' => _x('Gig', 'post type singular name', 'stylico'),
	  'add_new' => __('Add New', 'stylico'),
	  'add_new_item' => __('Add New Gig', 'stylico'),
	  'edit_item' => __('Edit Gig', 'stylico'),
	  'new_item' => __('New Gig', 'stylico'),
	  'all_items' => __('All Gigs', 'stylico'),
	  'view_item' => __('View Gig', 'stylico'),
	  'search_items' => __('Search Gigs', 'stylico'),
	  'not_found' =>  __('No gigs found', 'stylico'),
	  'not_found_in_trash' => __('No gigs found in Trash', 'stylico'), 
	  'parent_item_colon' => '',
	  'menu_name' => 'Gigs'
  
	);
	
	$gigs_args = array(
	  'labels' => $gigs_labels,
	  'public' => true,
	  'publicly_queryable' => true,
	  'show_ui' => true, 
	  'show_in_menu' => true, 
	  'has_archive' => true, 
	  'hierarchical' => false,
	  'menu_icon' => STYLICO_ADMIN_URI . '/images/admin_menu_gig.png',
	  'supports' => array('title','editor','thumbnail')
	);
	
	$releases_labels = array(
	  'name' => _x('Releases', 'post type general name', 'stylico'),
	  'singular_name' => _x('Release', 'post type singular name', 'stylico'),
	  'add_new' => __('Add New', 'stylico'),
	  'add_new_item' => __('Add New Release', 'stylico'),
	  'edit_item' => __('Edit Release', 'stylico'),
	  'new_item' => __('New Release', 'stylico'),
	  'all_items' => __('All Releases', 'stylico'),
	  'view_item' => __('View Release', 'stylico'),
	  'search_items' => __('Search Releases', 'stylico'),
	  'not_found' =>  __('No releases found', 'stylico'),
	  'not_found_in_trash' => __('No releases found in Trash', 'stylico'), 
	  'parent_item_colon' => '',
	  'menu_name' => 'Releases'
  
	);
	
	$releases_args = array(
	  'labels' => $releases_labels,
	  'public' => true,
	  'publicly_queryable' => true,
	  'show_ui' => true, 
	  'show_in_menu' => true, 
	  'has_archive' => true, 
	  'hierarchical' => false,
	  'menu_icon' => STYLICO_ADMIN_URI . '/images/admin_menu_release.png',
	  'supports' => array('title','editor','thumbnail')
	);
	
	$slider_labels = array(
	  'name' => _x('Slides', 'post type general name', 'stylico'),
	  'singular_name' => _x('Slide', 'post type singular name', 'stylico'),
	  'add_new' => __('Add New Slide', 'stylico'),
	  'add_new_item' => __('Add New Slide', 'stylico'),
	  'edit_item' => __('Edit Slide', 'stylico'),
	  'new_item' => __('New Slide', 'stylico'),
	  'all_items' => __('All Slides', 'stylico'),
	  'view_item' => __('View Slide', 'stylico'),
	  'search_items' => __('Search Slides', 'stylico'),
	  'not_found' =>  __('No slides found', 'stylico'),
	  'not_found_in_trash' => __('No slides found in Trash', 'stylico'), 
	  'parent_item_colon' => '',
	  'menu_name' => 'Slider'
  
	);
	
	$slider_args = array(
	  'labels' => $slider_labels,
	  'public' => true,
	  'publicly_queryable' => true,
	  'show_ui' => true, 
	  'show_in_menu' => true, 
	  'has_archive' => true, 
	  'hierarchical' => false,
	  'menu_icon' => STYLICO_ADMIN_URI . '/images/admin_menu_slider.png',
	  'supports' => array('title','editor','thumbnail', 'page-attributes')
	);
	
	register_post_type( 'gig', $gigs_args );
	register_post_type( 'release', $releases_args );
	register_post_type( 'stylico-slide', $slider_args );
	
	
	
	//TAXONOMIES
	$release_genres_labels = array(
	  'name' => _x( 'Genres', 'taxonomy general name', 'stylico' ),
	  'singular_name' => _x( 'Genre', 'taxonomy singular name', 'stylico' ),
	  'search_items' =>  __( 'Search Genres', 'stylico' ),
	  'all_items' => __( 'All Genres', 'stylico' ),
	  'parent_item' => __( 'Parent Genre', 'stylico' ),
	  'parent_item_colon' => __( 'Parent Genre:', 'stylico' ),
	  'edit_item' => __( 'Edit Genre', 'stylico' ), 
	  'update_item' => __( 'Update Genre', 'stylico' ),
	  'add_new_item' => __( 'Add New Genre', 'stylico' ),
	  'new_item_name' => __( 'New Genre Name', 'stylico' ),
	  'menu_name' => __( 'Genre', 'stylico' ),
	);
	
	register_taxonomy('genre', 'release', array(
	  'hierarchical' => true,
	  'labels' => $release_genres_labels,
	  'show_ui' => true,
	  'query_var' => true,
	  'rewrite' => array( 'slug' => 'genre' ),
	));
	
	
	//register some styles and scripts for frontend and backend
	wp_register_style( 'jquery-ui-datepicker', get_template_directory_uri() . " /admin/css/datepicker/jquery-ui-datepicker.css" );
	wp_register_style( 'radykal-colorpicker', get_template_directory_uri() . " /admin/css/colorpicker.css" );
	
	wp_register_script( 'jquery-ui-datepicker', get_template_directory_uri() . " /admin/js/jquery-ui-datepicker.min.js" );
	wp_register_script( 'radykal-colorpicker', get_template_directory_uri() . " /admin/js/colorpicker.js" );
	    
}


/**
 * Enqueue styles (frontend)
*/
function stylico_enqueue_styles() {
	
	if(is_home()) {
		wp_enqueue_style( 'orbit-slider', get_template_directory_uri() . " /css/orbit-slider.css" );
	}
		
	if( !is_admin() ) {
		wp_enqueue_style( 'prettyphoto', get_template_directory_uri() . " /css/prettyPhoto.css", array(), '3.1.2' );
	}
    
}


/**
 * Enqueue scripts (frontend)
*/
function stylico_enqueue_scripts() {
	
	
	if ( (!is_admin()) && is_singular() && comments_open() && get_option('thread_comments') )
		wp_enqueue_script( 'comment-reply' );
				
	if( !is_admin() ) {
		
		//enqueue jquery 1.6.4
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js', array(), '1.6.4');
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script('superfish', get_template_directory_uri() . " /js/superfish.js");
        wp_enqueue_script('main-script', get_template_directory_uri() . " /js/script.js");
		
 		wp_enqueue_script( 'prettyphoto', get_template_directory_uri() . " /js/jquery.prettyPhoto.js", array(), '3.1.2' );
		wp_enqueue_script( 'smart-tab', get_template_directory_uri() . " /js/jquery.tools.min.js" );
	}
	
	if(is_home()) {
	    wp_enqueue_script( 'orbit-slider', get_template_directory_uri() . " /js/jquery.orbit-slider.js" );	
	}
    
}

function stylico_header_nav_fallback() {
	echo '<p class="header-nav-default">Please create your menu in Appearance > Menus.</p>';	
}


/**
 * Add a home page link.
 */
function home_page_menu_arg( $args ) {
	$args = array(
        'show_home' => 'Home',
        'sort_column' => 'menu_order',
        'menu_class' => 'menu',
        'echo' => true
    );
    return $args;
}


/**
 * Set excerpt length
 */
function new_excerpt_length( $length ) {
	return 60;
}


/**
 * Add Read more
 */
function new_excerpt_more( $more ) {
    global $post;
	return '<a href="'. get_permalink( $post->ID ) . '" title="Permalink to the full post of '. get_the_title( $post->ID ) . '" class="more-link">&rarr;&nbsp;&nbsp;'.__('Read Post', 'stylico').'</a>';
}


/**
 * Show only upcoming gigs
 */
function show_upcoming_gigs( $where = '' ) {
	$where .= " AND meta_value >= '".date('Y-m-d')."'";
	return $where;
}


/**
 * Custom Comment Fields
*/
function stylico_comment_form_fields( $fields ) {
	$fields['author'] = '<p class="comment-form-author"><input type="text" aria-required="true" size="30" value="" name="author" id="author"> <span class="required">*</span><label for="author">Name</label></p>';
	$fields['email'] = '<p class="comment-form-email"><input type="text" aria-required="true" size="30" value="" name="email" id="email"> <span class="required">*</span><label for="email">Email</label></p>';
    $fields['url'] = '<p class="comment-form-url"><input type="text" size="30" value="" name="url" id="url"> <label for="url">Website</label></p>';
    return $fields;
}


/**
 * Custom Comment Textarea 
*/
function stylico_comment_form_comment( $arg ) {
    return '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';
}


/**
 * Content pagination navigation 
*/
function stylico_content_nav() {
	global $wp_query;
    
	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav class="content-nav clearfix">
            <span class="nav-previous"><?php next_posts_link( __( '&larr; Older posts', 'stylico') ); ?></span>
            <span class="nav-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'stylico') ); ?></span>
		</nav>
	<?php endif;
	
}


/**
 * Post meta menu(date, admin, category, comments) 
*/
function post_meta_menu() {
	?>
	<div class="post-meta-menu">
        <span class="meta-date"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'stylico' ), get_the_title() ); ?>"><?php the_time('jS M Y'); ?></a></span>
        <span class="meta-author"><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php printf( __('Permalink to %s', 'stylico'), get_the_author() ); ?>"><?php the_author(); ?></a></span>
        <span class="meta-category"><?php the_category(', '); ?></span>
        <span class="meta-comments"><?php comments_popup_link(); ?></span>
    </div>
    <?php
}


/**
 * Nothing found content 
*/
function stylico_nothing_found() {
	?>
    <article class="not-found">
    
        <div class="page-header">
            <span class="page-title"><?php printf( __( 'Nothing found for %s', 'stylico'), '<span>' . get_search_query() . '</span>' ); ?></span>
        </div>
        
        <div class="psot-entry">
            <?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'stylico' ); ?>
        </div>
        
    </article>
    <?php
}


/**
 * Social menu
*/
function stylico_social_menu( $floated = true ) {
	?>    
    <div class="post-socials clearfix<?php if($floated) echo ' floated-left'; ?>">
        <span><a href="https://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script></span>
        <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
        <span><g:plusone size="medium"></g:plusone></span>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) {return;}
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>   
        <div class="fb-like" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>
    </div>    
    <?php
}


/**
 * Comment Display 
*/
function stylico_comment( $comment, $args, $depth ) {
	
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'stylico' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'stylico') ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<div class="comment-meta clearfix">
				<?php
					$avatar_size = 70;
					if ( '0' != $comment->comment_parent )
						$avatar_size = 50;

					echo get_avatar( $comment, $avatar_size );
				?>
				<div class="comment-sub-menu">
					<div class="comment-author"><a href="<?php comment_author_url(); ?>" target="_blank"><?php comment_author(); ?></a></div>
					<div class="comment-date"><?php comment_date('jS M Y'); ?></div>
					<div class="comment-time"><?php comment_time('H:i:s'); ?></div>
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __('Reply', 'stylico'), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					<?php edit_comment_link( __( 'Edit', 'stylico'), '|&nbsp;' ); ?>
				</div>
			</div>
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'stylico'); ?></em>
				<br />
			<?php endif; ?>
	 
			<div class="comment-content"><?php comment_text(); ?></div>
		</article>
		<hr class="comment-dotted-line" />

	<?php
			break;
	endswitch;
}
	

?>