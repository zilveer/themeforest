<?php
/**
 * Theme Name: 		SPECTRA - Responsive Music Wordpress Theme
 * Theme Author: 	Mariusz Rek - Rascals Themes
 * Theme URI: 		http://rascals.eu/spectra
 * Author URI: 		http://rascals.eu
 * File:			helpers.php
 * =========================================================================================================================================
 *
 * @package spectra
 * @since 1.0.0
 */

/* ----------------------------------------------------------------------
	SPECTRA COMMENTS LIST
/* ---------------------------------------------------------------------- */
if ( ! function_exists( 'spectra_comments' ) ) :
function spectra_comments( $comment, $args, $depth ) {

    global $spectra_opts;

    $GLOBALS['comment'] = $comment; 

    // Date format
    $date_format = 'd/m/y';

    if ( $spectra_opts->get_option( 'custom_comment_date' ) ) {
    	$date_format = $spectra_opts->get_option( 'custom_comment_date' );
    }
    ?>

    <!-- Comment -->
    <li id="li-comment-<?php comment_ID() ?>" <?php comment_class( 'theme_comment' ); ?>>
        <article id="comment-<?php comment_ID(); ?>">
            <div class="avatar-wrap">
                <?php echo get_avatar( $comment, '100' ); ?>
            </div>
            <div class="comment-meta">
                <h5 class="author"><?php comment_author_link(); ?></h5>
                <p class="date"><?php comment_date( $date_format ); ?> <span class="reply"><?php comment_reply_link( array_merge( $args, array( 'reply_text' => __('Reply', SPECTRA_THEME ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></span></p>
            </div>
            <div class="comment-body">
                <?php comment_text(); ?>
                <?php if ( $comment->comment_approved == '0' ) : ?>
                <p class="message info"><?php _e( 'Your comment is awaiting moderation.', SPECTRA_THEME ); ?></p>
                <?php endif; ?> 
            </div>
        </article>
<?php 
}
endif;


/* ----------------------------------------------------------------------
	TAG CLOUD FILTER
/* ---------------------------------------------------------------------- */
function spectra_tag_cloud_filter( $args = array() ) {
   $args['smallest'] = 12;
   $args['largest'] = 12;
   $args['unit'] = 'px';
   return $args;
}

add_filter( 'widget_tag_cloud_args', 'spectra_tag_cloud_filter', 90 );


/* ----------------------------------------------------------------------
    SHARE OPTIONS
 ------------------------------------------------------------------------*/
function spectra_share_options() {
    global $wp_query; 
    if ( is_single() || is_page() ) { 

        // Site name
        echo "\n" .'<meta property="og:title" content="' . get_bloginfo('name') . '"/>' . "\n";     

        // URL
        echo "\n" .'<meta property="og:url" content="' . get_permalink( $wp_query->post->ID ) . '"/>' . "\n";
        
        // Title
        $share_title = get_post_meta( $wp_query->post->ID, '_share_title', true );
        if ( isset( $share_title ) && $share_title != '' ) {
             echo "\n" .'<meta property="og:title" content="' . esc_html( $share_title ) . '"/>' . "\n";     
        }

        // Description
        $share_description = get_post_meta( $wp_query->post->ID, '_share_description', true );
        if ( isset( $share_description ) && $share_description != '' ) {
             echo "\n" .'<meta property="og:description" content="' . esc_html( $share_description ) . '"/>' . "\n";     
        }

        // Image
        $share_image = get_post_meta( $wp_query->post->ID, 'share_image', true );
        if ( isset( $share_image ) ) {
            $image_attributes = wp_get_attachment_image_src( $share_image, 'full' );
            if ( $image_attributes ) {
                echo "\n" .'<meta property="og:image" content="' . $image_attributes[0] . '"/>' . "\n";
            }
        }  

    }
}
add_action( 'wp_head', 'spectra_share_options' ); 


/* ----------------------------------------------------------------------
    CUSTOM AJAX LOADER (CONTACT FORM 7)
/* ---------------------------------------------------------------------- */

function my_wpcf7_ajax_loader () {
    return  get_template_directory_uri() . '/images/ajax-loader.gif';
}
add_filter( 'wpcf7_ajax_loader', 'my_wpcf7_ajax_loader' );


/* ----------------------------------------------------------------------
	NICE TITLE FILTER
/* ---------------------------------------------------------------------- */
/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
*/
if ( ! function_exists( 'spectra_wp_title' ) ) :
function spectra_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'spectra' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'spectra_wp_title', 10, 2 );
endif;


/* ----------------------------------------------------------------------
	GET IMAGE ID BY URL
/* ---------------------------------------------------------------------- */
if ( ! function_exists( 'spectra_get_image_id' ) ) :
function spectra_get_image_id( $image_url, $size ) {
 	global $wpdb;

    $attachment_query = $wpdb->prepare(
        "
        SELECT
            {$wpdb->posts}.id
        FROM 
            {$wpdb->posts}
        WHERE
            {$wpdb->posts}.post_type = 'attachment'
        AND
            {$wpdb->posts}.guid = %s
        ",
        $image_url

    );

	$attachment = $wpdb->get_results( $attachment_query, ARRAY_N );
    
	if ( is_array( $attachment ) && ! empty( $attachment ) ) {
		$attachment_url = wp_get_attachment_image_src( $attachment[0][0], $size );
		return $attachment_url[0];
	} else {
		return false;
	}
}
endif;


/* ----------------------------------------------------------------------
	ADD CUSTOM STYLES
/* ---------------------------------------------------------------------- */
if ( ! function_exists( 'spectra_add_custom_styles' ) ) :
function spectra_add_custom_styles() {
 	
	global $spectra_opts, $wp_query, $paged, $post;

    $custom_css = "";

	// Add styles
    wp_add_inline_style( SPECTRA_THEME . '-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'spectra_add_custom_styles' );
endif;