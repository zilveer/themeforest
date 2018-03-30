<?php

/*
 * Main functions 
 * by www.themesdojo.com
 */

/*
|--------------------------------------------------------------------------
| default theme constants & repeating variables
| * do not change
|--------------------------------------------------------------------------
*/ 

define('TD_THEME_NAME', 'EventBuilder');
define('TD_THEME_VERSION', '1.0.5');

define('THEME_WEB_ROOT', get_template_directory_uri() );
define('THEME_DOCUMENT_ROOT', get_template_directory() );

define('STYLE_WEB_ROOT', get_stylesheet_directory_uri() );
define('STYLE_DOCUMENT_ROOT', get_stylesheet_directory() );

/*
|--------------------------------------------------------------------------
| Plugin Install and Update Notification
|--------------------------------------------------------------------------
*/
if( is_admin() ){
    include_once( THEME_DOCUMENT_ROOT . '/inc/td-theme-activation.php' );
}

/*
|--------------------------------------------------------------------------
| Default Content Width
|--------------------------------------------------------------------------
*/
if ( !isset( $content_width ) ) {
    $content_width = 1230; /* pixels */
}

/*
|--------------------------------------------------------------------------
| Load required files
|--------------------------------------------------------------------------
*/
include_once( THEME_DOCUMENT_ROOT . '/inc/td-theme-hooks.php' );
include_once( THEME_DOCUMENT_ROOT . '/inc/td-page-meta.php' );
include_once( THEME_DOCUMENT_ROOT . '/inc/td-shortcodes.php' );


add_action('init', 'td_hide_editor_from_packages');
function td_hide_editor_from_packages() {
    remove_post_type_support( 'package', 'editor' );
}

/*
|--------------------------------------------------------------------------
| Load post meta functions
|--------------------------------------------------------------------------
*/
include_once( THEME_DOCUMENT_ROOT . '/inc/lib/td-metaboxes.php' );
include_once( THEME_DOCUMENT_ROOT . '/inc/lib/td-post-meta.php' );

/*
|--------------------------------------------------------------------------
| Load breadcrumbs function
|--------------------------------------------------------------------------
*/
include_once( THEME_DOCUMENT_ROOT . '/inc/lib/td-breadcrumbs.php' );

/*
|--------------------------------------------------------------------------
| Load post views function
|--------------------------------------------------------------------------
*/
include_once( THEME_DOCUMENT_ROOT . '/inc/lib/td-post-views.php' );


/*
|--------------------------------------------------------------------------
| Load color options
|--------------------------------------------------------------------------
*/
include_once( THEME_DOCUMENT_ROOT . '/inc/lib/td-colors.php' );

/*
|--------------------------------------------------------------------------
| Load demo importer function
|--------------------------------------------------------------------------
*/
//include_once( THEME_DOCUMENT_ROOT .'/inc/demo-importer/init.php');

/*
|--------------------------------------------------------------------------
| Load stripe payment insert table function
|--------------------------------------------------------------------------
*/
include_once( THEME_DOCUMENT_ROOT . '/inc/payments/stripe/td-stripe-payment.php' );

/*
|--------------------------------------------------------------------------
| Load free payment insert table function
|--------------------------------------------------------------------------
*/
include_once( THEME_DOCUMENT_ROOT . '/inc/payments/free/td-free-payment.php' );


/*
|--------------------------------------------------------------------------
| Add to favorites
|--------------------------------------------------------------------------
*/
include_once( THEME_DOCUMENT_ROOT . '/inc/td-favorite.php' );

/*
|--------------------------------------------------------------------------
| Check event slot availability
|--------------------------------------------------------------------------
*/
include_once( THEME_DOCUMENT_ROOT . '/inc/td-check-event-slot-availability.php' );

/*
|--------------------------------------------------------------------------
| Event upload form
|--------------------------------------------------------------------------
*/
include_once( THEME_DOCUMENT_ROOT . '/inc/td-upload-event-form.php' );

/*
|--------------------------------------------------------------------------
| Upload event
|--------------------------------------------------------------------------
*/
include_once( THEME_DOCUMENT_ROOT . '/inc/td-upload-event.php' );

/*
|--------------------------------------------------------------------------
| Edit event
|--------------------------------------------------------------------------
*/
include_once( THEME_DOCUMENT_ROOT . '/inc/td-edit-event.php' );

/*
|--------------------------------------------------------------------------
| Update listing status
|--------------------------------------------------------------------------
*/
include_once( THEME_DOCUMENT_ROOT . '/inc/td-post-status.php' );

/*
|--------------------------------------------------------------------------
| Pending review
|--------------------------------------------------------------------------
*/
include_once( THEME_DOCUMENT_ROOT . '/inc/td-review-pendings.php' );

/*
|--------------------------------------------------------------------------
| My Account Pagination
|--------------------------------------------------------------------------
*/
include_once( THEME_DOCUMENT_ROOT . '/inc/td-my-account-pagination.php' );

/*
|--------------------------------------------------------------------------
| Delete Expired Listings
|--------------------------------------------------------------------------
*/
include_once( THEME_DOCUMENT_ROOT . '/inc/td-delete-expired-events.php' );

/*
|--------------------------------------------------------------------------
| Listing Review
|--------------------------------------------------------------------------
*/
include_once( THEME_DOCUMENT_ROOT . '/inc/td-item-review.php' );

/*
|--------------------------------------------------------------------------
| Events Filter
|--------------------------------------------------------------------------
*/
include_once( THEME_DOCUMENT_ROOT . '/inc/td-events-filter.php' );

/*
|--------------------------------------------------------------------------
| Past Events Filter
|--------------------------------------------------------------------------
*/
include_once( THEME_DOCUMENT_ROOT . '/inc/td-past-events-filter.php' );


/*
|--------------------------------------------------------------------------
| Upcoming Events Filter
|--------------------------------------------------------------------------
*/
include_once( THEME_DOCUMENT_ROOT . '/inc/td-events-upcoming-filter.php' );

/*
|--------------------------------------------------------------------------
| Menu Walker
|--------------------------------------------------------------------------
*/
include_once( THEME_DOCUMENT_ROOT . '/inc/td-menu-walker.php' );

/*
|--------------------------------------------------------------------------
| Import Demo Settings
|--------------------------------------------------------------------------
*/
include_once( THEME_DOCUMENT_ROOT . '/inc/lib/td-import-demo-settings.php' );


/*
|--------------------------------------------------------------------------
| Disable Admin Bar for Non-Admins
|--------------------------------------------------------------------------
*/
add_action('after_setup_theme', 'td_remove_admin_bar');

function td_remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}

/*
|--------------------------------------------------------------------------
| Featured Image suport
|--------------------------------------------------------------------------
*/
add_theme_support( 'post-thumbnails' );

/* Mobile Detect */
if ( ! class_exists('Mobile_Detect') ) { 
	
	include_once( THEME_DOCUMENT_ROOT . '/inc/lib/td-mobile-detect-class.php' );
	$detect = new Mobile_Detect();

} elseif( class_exists('Mobile_Detect') ) {
   
    $detect = new Mobile_Detect();

}

/*
|--------------------------------------------------------------------------
| Get Current user ID
|--------------------------------------------------------------------------
*/
add_action('init', 'td_get_current_user_id');

function td_get_current_user_id(){

    $user_id = get_current_user_id();

    return $user_id;
}


/*
|--------------------------------------------------------------------------
| Replace event place meta with place taxonomy
|--------------------------------------------------------------------------
*/
if( !wp_next_scheduled( 'replace_place_meta_7' ) ) {
   wp_schedule_event( time(), 'daily', 'replace_place_meta_7' );
}
 
add_action( 'replace_place_meta_7', 'td_replace_place_meta' );
function td_replace_place_meta() {

    $custom_posts = new WP_Query();
    $custom_posts->query(array(
        'post_type'      => 'event',
        'posts_per_page' => '-1',
        'post_status'    => 'publish'
        )
    );

    if ( $custom_posts->have_posts() ) {

        while ($custom_posts->have_posts()) : $custom_posts->the_post();

            $post_ID = get_the_ID();
            $event_location = get_post_meta( $post_ID, 'event_location', true );
            $event_location_status = get_post_meta( $post_ID, 'event_location_status', true );

            if(empty($event_location) OR !isset($event_location)) {

                $event_location = "Default";

            }

            if($event_location_status == "updated") {

            } else {

                wp_insert_term(
                    $event_location, // the term 
                    'event_place', // the taxonomy
                    array(
                        'description'=> '',
                        'slug' => $event_location,
                        'parent' => 0
                    )
                );

                $term_id = term_exists( $event_location, 'event_place', 0 );

                wp_set_post_terms( $post_ID, $term_id, "event_place", true );

            }

            update_post_meta( $post_ID, 'event_location_status', "updated" );

        endwhile;

    }
}

/*
|--------------------------------------------------------------------------
| Get all event places
|--------------------------------------------------------------------------
*/
function td_get_all_event_places(){

    $categories = get_categories( array('taxonomy' => 'event_place', 'hide_empty' => false,  'parent' => 0) );

    foreach ($categories as $category) {

        $event_locations[] = $category->cat_name;

        $catID = $category->term_id;

        $categories_child = get_categories( array('taxonomy' => 'event_place', 'hide_empty' => false,  'parent' => $catID) );

        foreach ($categories_child as $category_child) {

            $event_locations[] = $category_child->cat_name;

        }
    }

    return $event_locations;

}


/*
|--------------------------------------------------------------------------
| Load Theme Setup
|--------------------------------------------------------------------------
*/

add_action( 'after_setup_theme', 'themesdojo_setup' );

if ( ! function_exists( 'themesdojo_setup' ) ) :

    /**
     * Note that this function is hooked into the after_setup_theme hook, which runs
     * before the init hook. The init hook is too late for some features, such as indicating
     * support post thumbnails.
     */

    function themesdojo_setup() {

        /**
         * Make theme available for translation
         * Translations can be filed in the /languages/ directory
         * If you're building a theme based on themesdojo, use a find and replace
         * to change 'themesdojo' to the name of your theme in all the template files
		 * we recommend to place the language files inside the child theme
         */
         
        load_theme_textdomain( 'themesdojo' , STYLE_DOCUMENT_ROOT . '/languages' );
    			
        /**
         * Add default posts and comments RSS feed links to head
         */
        add_theme_support( 'automatic-feed-links' );
    
        /**
         * Enable support for Post Thumbnails on posts and pages
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
		add_image_size( 'blog-default', '806', '300', true);
		
		
        /**
         * This theme uses wp_nav_menu() in one location.
         */
        register_nav_menus( array(
            'primary' 	    	=> __( 'Primary Menu', 'themesdojo' ),
            'secondary' 		=> __( 'Top Menu', 'themesdojo' )
        ) );
    
	
        /**
         * Enable support for Post Formats
         */
        add_theme_support( 'post-formats', array( 'image', 'video', 'quote', 'link', 'gallery' ) );

        /**
         * Add has-submenu if the menu has sub menu
         */
		add_filter( "wp_nav_menu_objects", "td_menu_item_parent_classing", 10, 2 );
		
    }
    
endif; // themesdojo_setup

// Add Redux Framework
if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/ReduxFramework/ReduxCore/framework.php' ) ) {
	require_once( dirname( __FILE__ ) . '/ReduxFramework/ReduxCore/framework.php' );
}
if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/ReduxFramework/sample/sample-config.php' ) ) {
	require_once( dirname( __FILE__ ) . '/ReduxFramework/sample/sample-config.php' );
}

/*
|--------------------------------------------------------------------------
| Register widgetized area and update sidebar with default widgets
|--------------------------------------------------------------------------
*/
if ( ! function_exists( 'themesdojo_widgets_init' ) ) :
 
    function themesdojo_widgets_init() {
		
		register_sidebar( array(
            'name' => __( 'Blog Sidebar', 'themesdojo' ),
            'id' => 'blog',
            'before_widget' => '<div class="clearfix widget-container %1$s %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title"><span>',
            'after_title'   => '</span></h3>',
        ) );

        register_sidebar( array(
            'name' => __( 'Page Sidebar', 'themesdojo' ),
            'id' => 'page',
            'before_widget' => '<div class="clearfix widget-container %1$s %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title"><span>',
            'after_title'   => '</span></h3>',
        ) ); 

        register_sidebar( array(
            'name' => __( 'Event Page Sidebar', 'themesdojo' ),
            'id' => 'event',
            'before_widget' => '<div class="clearfix widget-container %1$s %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title"><span>',
            'after_title'   => '</span></h3>',
        ) ); 

        register_sidebar( array(
            'name' => __( 'Navigation Sidebar', 'themesdojo' ),
            'id' => 'navigation',
            'before_widget' => '<div class="clearfix widget-container %1$s %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title"><span>',
            'after_title'   => '</span></h3>',
        ) );  
        
        register_sidebar( array(
			'name'          => __( 'Footer Widget Area One', 'themesdojo' ),
			'id'            => 'footer-one',
			'description'   => __( 'Appears in the footer section of the site.', 'themesdojo' ),
			'before_widget' => '<div class="clearfix widget-container %1$s %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title"><span>',
            'after_title'   => '</span></h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Footer Widget Area Two', 'themesdojo' ),
			'id'            => 'footer-two',
			'description'   => __( 'Appears in the footer section of the site.', 'themesdojo' ),
			'before_widget' => '<div class="clearfix widget-container %1$s %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title"><span>',
            'after_title'   => '</span></h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Footer Widget Area Three', 'themesdojo' ),
			'id'            => 'footer-three',
			'description'   => __( 'Appears in the footer section of the site.', 'themesdojo' ),
			'before_widget' => '<div class="clearfix widget-container %1$s %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title"><span>',
            'after_title'   => '</span></h3>',
		) );
		
    }
    
    add_action( 'widgets_init', 'themesdojo_widgets_init' );

endif;


/*
|--------------------------------------------------------------------------
| Title on homepage
|--------------------------------------------------------------------------
*/
add_filter('wp_title', 'td_pagetitle');

function td_pagetitle($title) {
 	
 	if ( is_feed() ) {
        return $title;
    }

    global $page, $paged;

    // Add the blog name
    $title .= get_bloginfo( 'name', 'display' );

    $sep = "|";

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) ) {
        $title .= " $sep $site_description";
    }

    // Add a page number if necessary:
    if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
        $title .= " $sep " . sprintf( __( 'Page %s', '_s' ), max( $paged, $page ) );
    }

    return $title;
}

/*
|--------------------------------------------------------------------------
| Stars rating
|--------------------------------------------------------------------------
*/
function td_rating_func($overview_stars_value) {
    if ($overview_stars_value <=  10) {
        $html = '<i class="fa fa-star-half-empty"></i>
                <i class="fa fa-star-o"></i>            
                <i class="fa fa-star-o"></i>
                <i class="fa fa-star-o"></i>
                <i class="fa fa-star-o"></i>';
    } elseif ($overview_stars_value > 10 && $overview_stars_value <=  20) { 
     $html = '<i class="fa fa-star"></i>       
                <i class="fa fa-star-o"></i>             
                <i class="fa fa-star-o"></i>
                <i class="fa fa-star-o"></i>
                <i class="fa fa-star-o"></i>';           
    } elseif ($overview_stars_value > 20 && $overview_stars_value <=  30) { 
     $html = '<i class="fa fa-star"></i>       
            <i class="fa fa-star-half-empty"></i>                     
            <i class="fa fa-star-o"></i>
            <i class="fa fa-star-o"></i>
            <i class="fa fa-star-o"></i>';               
    } elseif ($overview_stars_value > 30 && $overview_stars_value <=  40) { 
     $html = '<i class="fa fa-star"></i>
            <i class="fa fa-star"></i>       
            <i class="fa fa-star-o"></i>
            <i class="fa fa-star-o"></i>
            <i class="fa fa-star-o"></i>'; 
    } elseif ($overview_stars_value > 40 && $overview_stars_value <=  50) { 
     $html = '<i class="fa fa-star"></i>
            <i class="fa fa-star"></i>         
            <i class="fa fa-star-half-empty"></i>                     
            <i class="fa fa-star-o"></i>
            <i class="fa fa-star-o"></i> ';         
    } elseif ($overview_stars_value > 50 && $overview_stars_value <=  60) { 
     $html = '<i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>         
            <i class="fa fa-star-o"></i>
            <i class="fa fa-star-o"></i>';  
    } elseif ($overview_stars_value > 60 && $overview_stars_value <=  70) { 
    $html = '<i class="fa fa-star"></i>
            <i class="fa fa-star"></i> 
            <i class="fa fa-star"></i>         
            <i class="fa fa-star-half-empty"></i>                     
            <i class="fa fa-star-o"></i>';                 
    } elseif ($overview_stars_value > 70 && $overview_stars_value <= 80) { 
    $html = '<i class="fa fa-star"></i>
            <i class="fa fa-star"></i> 
            <i class="fa fa-star"></i>  
            <i class="fa fa-star"></i>         
            <i class="fa fa-star-o"></i>';                    
    } elseif ($overview_stars_value > 80 && $overview_stars_value <=  90) { 
    $html = '<i class="fa fa-star"></i>
            <i class="fa fa-star"></i> 
            <i class="fa fa-star"></i>    
            <i class="fa fa-star"></i>      
            <i class="fa fa-star-half-empty"></i>';  
    } elseif ($overview_stars_value > 90 && $overview_stars_value <=  100) { 
    $html = '<i class="fa fa-star"></i>
            <i class="fa fa-star"></i> 
            <i class="fa fa-star"></i>    
            <i class="fa fa-star"></i>      
            <i class="fa fa-star"></i>';
    }
return $html; 
}

/*
|--------------------------------------------------------------------------
| Login Form
|--------------------------------------------------------------------------
*/
function tdLoginForm() {

    if ( isset( $_POST['tdLogin_nonce'] ) && wp_verify_nonce( $_POST['tdLogin_nonce'], 'tdLogin_html' ) ) {

    $username = sanitize_text_field($_POST['userNameLogin']);
    $password = $_POST['userPasswordLogin'];
    if(isset($_POST['rememberme'])) { $remember = $_POST['rememberme']; } else { $remember = ""; };

    $registerSuccess = 1;
    $registerName = 1;
    $registerEmail = 1;

    if ( username_exists( $username ) ) {

        $registerSuccess = 1;
        $registerName = 1;

    } else {

      $registerSuccess = 0;
        $registerName = 0;

    }

    $user = get_user_by( 'login', $username );

    if ( $user && wp_check_password( $password, $user->data->user_pass, $user->ID) ) {

        $registerSuccess = 1;
        $registerPassword = 1;

    } else {

      $registerSuccess = 0;
        $registerPassword = 0;

    }

    if($registerName == 0) {

        $registerUserSuccess = 1;

    } elseif($registerPassword == 0) {

        $registerUserSuccess = 2;

    } elseif($registerName == 0 AND $registerPassword == 0) {

        $registerUserSuccess = 3;

    } 

    if($registerSuccess == 1) {

        $login_data = array();
        $login_data['user_login'] = $username;
        $login_data['user_password'] = $password;
        $login_data['remember'] = $remember;
        wp_signon( $login_data, false );

        $registerUserSuccess = 4;

    }

    } else {

    $registerUserSuccess = 5;

    }

    echo esc_attr($registerUserSuccess);

    die(); // this is required to return a proper result

}
add_action( 'wp_ajax_tdLoginForm', 'tdLoginForm' );
add_action( 'wp_ajax_nopriv_tdLoginForm', 'tdLoginForm' );

/*
|--------------------------------------------------------------------------
| Register Form
|--------------------------------------------------------------------------
*/
function tdRegisterForm() {

  if ( isset( $_POST['tdRegister_nonce'] ) && wp_verify_nonce( $_POST['tdRegister_nonce'], 'tdRegister_html' ) ) {

  $username = sanitize_text_field($_POST['userName']);
  $email = sanitize_email($_POST['userEmail']);
  $password = $_POST['userPassword'];
  $account_type = $_POST['account_type'];

  $registerSuccess = 1;
  $registerName = 1;
  $registerEmail = 1;


  if (username_exists($username)) {

      $registerSuccess = 0;
      $registerName = 0;

  } 

  if( email_exists( $email )) {

      $registerSuccess = 0;
      $registerEmail = 0;

  } 

  if($registerName == 0 AND $registerEmail == 0) {
      $registerUserSuccess = 3;
  } elseif($registerEmail == 0) {
      $registerUserSuccess = 2;
  } elseif($registerName == 0) {
      $registerUserSuccess = 1;
  }

  if($registerSuccess == 1) {

      $user_ID = wp_create_user( $username, $password, $email );

      if (!empty($account_type)) {

      update_user_meta($user_ID, 'account_type', $account_type);

    }

      $from = get_option('admin_email');
      $headers = 'From: '.$from . "\r\n";
      $subject = "Registration successful";
      $msg = "Registration successful.\nYour login details\nUsername: $username\nPassword: $password";
      wp_mail( $email, $subject, $msg, $headers );

      $login_data = array();
      $login_data['user_login'] = $username;
      $login_data['user_password'] = $password;
      wp_signon( $login_data, false );

      $registerUserSuccess = 4;

  }

  } else {

    $registerUserSuccess = 5;

  }

  echo esc_attr($registerUserSuccess);

  die(); // this is required to return a proper result

}
add_action( 'wp_ajax_tdRegisterForm', 'tdRegisterForm' );
add_action( 'wp_ajax_nopriv_tdRegisterForm', 'tdRegisterForm' );

/*
|--------------------------------------------------------------------------
| Reset Password
|--------------------------------------------------------------------------
*/
function tdResetForm() {

  if ( isset( $_POST['tdReset_nonce'] ) && wp_verify_nonce( $_POST['tdReset_nonce'], 'tdReset_html' ) ) {

  $email = sanitize_email($_POST['userEmail']);
  
  $user = get_user_by( 'email', $email );
  $user_ID = $user->ID;

  if( !empty($user_ID)) {

    $new_password = wp_generate_password( 12, false ); 

    if ( isset($new_password) ) {

      wp_set_password( $new_password, $user_ID );

      $from = get_option('admin_email');
      $headers = 'From: '.$from . "\r\n";
      $subject = "Password reset!";
      $msg = "Reset password.\nYour login details\nNew Password: $new_password";
      wp_mail( $email, $subject, $msg, $headers );

      $resetSuccess = 1;

    }

  } else {

    $resetSuccess = 2;

    $message = "There is no user available for this email.";

  } // end if/else


  } else {

  $resetSuccess = 3;

  }

  echo esc_attr($resetSuccess);

  die(); // this is required to return a proper result

}
add_action( 'wp_ajax_tdResetForm', 'tdResetForm' );
add_action( 'wp_ajax_nopriv_tdResetForm', 'tdResetForm' );

/*
|--------------------------------------------------------------------------
| Contact Form
|--------------------------------------------------------------------------
*/
function td_ContactForm() {

  	if ( isset( $_POST['ContactForm_nonce'] ) && wp_verify_nonce( $_POST['ContactForm_nonce'], 'ContactForm_html' ) ) {

		$name = sanitize_text_field($_POST['name']);
		$email = sanitize_email($_POST['email']);
		$subject = sanitize_text_field($_POST['subject']);
		$receiverEmail = sanitize_email($_POST['receiverEmail']);
		$message = wp_kses_data($_POST['message']);

		$blog_title = get_bloginfo('name');

		$emailTo = $receiverEmail; 
		$body = "Name: $name \n\nEmail: $email \n\nMessage: $message";
		$headers = 'From <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
		  
		wp_mail($emailTo, $subject, $body, $headers);

  	} else {

  	}

  	die(); // this is required to return a proper result

}
add_action( 'wp_ajax_ContactForm', 'td_ContactForm' );
add_action( 'wp_ajax_nopriv_ContactForm', 'td_ContactForm' );

/*
|--------------------------------------------------------------------------
| Contact Item Owner Form
|--------------------------------------------------------------------------
*/
function td_ContactOwnerForm() {

    if ( isset( $_POST['ContactOwnerForm_nonce'] ) && wp_verify_nonce( $_POST['ContactOwnerForm_nonce'], 'ContactOwnerForm_html' ) ) {

    	$name = sanitize_text_field($_POST['contactName']);
    	$email = sanitize_email($_POST['email']);
        $emailSubject = sanitize_text_field($_POST['emailSubject']);
    	$receiverEmail = sanitize_email($_POST['receiverEmail']);
    	$message = wp_kses_data($_POST['message']);

    	$emailTo = $receiverEmail;
    	$subject = $emailSubject; 
    	$body = "Name: $name \n\nEmail: $email \n\nMessage: $message";
    	$headers = 'From <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
    	  
    	wp_mail($emailTo, $subject, $body, $headers);

    } else {

    }

    die(); // this is required to return a proper result

}
add_action( 'wp_ajax_ContactOwnerForm', 'td_ContactOwnerForm' );
add_action( 'wp_ajax_nopriv_ContactOwnerForm', 'td_ContactOwnerForm' );

/*
|--------------------------------------------------------------------------
| Claim Listing Form
|--------------------------------------------------------------------------
*/
function td_ClaimListingForm() {

    if ( isset( $_POST['ClaimListingForm_nonce'] ) && wp_verify_nonce( $_POST['ClaimListingForm_nonce'], 'ClaimListingForm_html' ) ) {

        $name = sanitize_text_field($_POST['contactName']);
        $email = sanitize_email($_POST['email']);
        $emailSubject = sanitize_text_field($_POST['emailSubject']);
        $receiverEmail = sanitize_email($_POST['receiverEmail']);
        $message = wp_kses_data($_POST['message']);

        $emailTo = $receiverEmail;
        $subject = $emailSubject; 
        $body = "Name: $name \n\nEmail: $email \n\nMessage: $message";
        $headers = 'From <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
          
        wp_mail($emailTo, $subject, $body, $headers);

    } else {

    }

    die(); // this is required to return a proper result

}
add_action( 'wp_ajax_ClaimListingForm', 'td_ClaimListingForm' );
add_action( 'wp_ajax_nopriv_ClaimListingForm', 'td_ClaimListingForm' );

/*
|--------------------------------------------------------------------------
| Contact Form 7 Custom Email
|--------------------------------------------------------------------------
*/
add_filter( 'wpcf7_mail_components', 'td_wpcf7_mail_components1', 10, 3 );
function td_wpcf7_mail_components1( $components, $cf7, $three = null ) {
    
    $submission = WPCF7_Submission::get_instance();
    $unit_tag = $submission->get_meta( 'unit_tag' );

    if ( ! preg_match( '/^wpcf7-f(\d+)-p(\d+)-o(\d+)$/', $unit_tag, $matches ) )
        return $components;

    $post_id = (int) $matches[2];
    $post = get_post( $post_id );
    $thisPostId = $post->ID;
    
    if(get_post_type( $thisPostId ) == 'event' ) {
    
        $user_email = get_post_meta($thisPostId, 'item_email',true);
        
    }
    
    $components[ 'recipient' ] = $user_email;

    return $components;
}

/*
|--------------------------------------------------------------------------
| Ninja Forms Custom Email
|--------------------------------------------------------------------------
*/
function td_notification_email_custom( $setting, $setting_name, $id ) {
    
        if ( 'to' != $setting_name ) {
			return $setting;
		}

		$fake = array_search( 'no-reply@listingowner.com', $setting );

		if ( false === $fake ) {
			return $setting;
		}

		global $ninja_forms_processing;

		$form_id = $ninja_forms_processing->get_form_ID();

		$object = $field_id = null;
		$fields = $ninja_forms_processing;

		foreach ( $fields->data[ 'field_data' ] as $field ) {
			if ( 'Listing ID' == $field[ 'data' ][ 'label' ] ) {
				$field_id = $field[ 'id' ];

				break;
			}
		}

		$object = get_post( $ninja_forms_processing->get_field_value( $field_id ) );

		if ( ! is_a( $object, 'WP_Post' ) ) {
			return $setting;
        }
    
        $thisPostId = $object->ID;

        if(get_post_type( $thisPostId ) == 'event' ) {

            $setting[ $fake ] = get_post_meta($thisPostId, 'item_email',true);

        } 

		return $setting;
    
}
add_filter( 'nf_email_notification_process_setting', 'td_notification_email_custom', 10, 3 );


/*
|--------------------------------------------------------------------------
| Gravity Forms
|--------------------------------------------------------------------------
*/
add_filter( 'gform_notification', 'td_notification_email', 10, 3 );
function td_notification_email( $notification, $form, $entry ) {
		if ( 'no-reply@listingowner.com' != $notification[ 'to' ] ) {
			return $notification;
		}

		$notification[ 'toType' ] = 'email';

		$listing = false;
		$fields  = $form[ 'fields' ];

		foreach ( $fields as $check ) {
			if ( $check[ 'inputName' ] == 'Listing ID' ) {
				$listing = $check[ 'id' ];
			}
		}

		$object = get_post( $listing );

		$thisPostId = $object->ID;
    
	    if(get_post_type( $thisPostId ) == 'event' ) {
	    
	        $user_email = get_post_meta($thisPostId, 'item_email',true);
	        
	    } 

		$notification[ 'to' ] = $user_email;

		return $notification;
}



/*
|--------------------------------------------------------------------------
| Custom image size
|--------------------------------------------------------------------------
*/
add_theme_support( 'post-thumbnails' );
add_image_size( 'app', 270, 190, true ); 
add_image_size( 'app-large', 1080, 675, true ); 



/*
|--------------------------------------------------------------------------
| Prevent users change email.
|--------------------------------------------------------------------------
*/
function td_prevent_email_change( $errors, $update, $user ) {

    $old = get_user_by('id', $user->ID);

    if( $user->user_email != $old->user_email )
        $user->user_email = $old->user_email;
}

if ( ! current_user_can('administrator') ) :
    add_action( 'user_profile_update_errors', 'td_prevent_email_change', 10, 3 );
endif;

/*
|--------------------------------------------------------------------------
| Update user account
|--------------------------------------------------------------------------
*/
function tdUpdateAccountForm() {

  if ( isset( $_POST['tdUpdateAccount_nonce'] ) && wp_verify_nonce( $_POST['tdUpdateAccount_nonce'], 'tdUpdateAccount_html' ) ) {

    $user_ID = esc_attr($_POST['userID']);
    $password = esc_attr($_POST['userPasswordLogin']);
    $avatar_url = esc_url_raw($_POST['avatar-image-url']);
    $display_name = esc_attr($_POST['userNameLogin']);
    $facebook_link = esc_url_raw($_POST['facebook-link']);
    $twitter_link = esc_url_raw($_POST['twitter-link']);
    $google_plus_link = esc_url_raw($_POST['google-plus-link']);
    $dribbble_link = esc_url_raw($_POST['dribbble-link']);

    $registerEmail = 0;
    $registerPass = 0;

    if (!empty($account_type)) {

      update_user_meta($user_ID, 'account_type', $account_type);

      $registerUserSuccess = 4;

    }

    if (!empty($avatar_url)) {

      update_user_meta( $user_ID, 'user_meta_image', $avatar_url );

    }

    if (!empty($display_name)) {

      $userdata = array(
          'ID' => $user_ID,
          'display_name' => $display_name
      );

      wp_update_user( $userdata );

    }

    if (!empty($facebook_link)) {

      update_user_meta( $user_ID, 'user_meta_facebook', $facebook_link );

    }

    if (!empty($twitter_link)) {

      update_user_meta( $user_ID, 'user_meta_twitter', $twitter_link );

    }

    if (!empty($google_plus_link)) {

      update_user_meta( $user_ID, 'user_meta_googleplus', $google_plus_link );

    }

    if (!empty($dribbble_link)) {

      update_user_meta( $user_ID, 'user_meta_dribbble', $dribbble_link );

    }

    if (!empty($password)) {

      $update = wp_set_password( $password, $user_ID ); 

    } 

    $registerUserSuccess = 1;

  } else {

    $registerUserSuccess = 4;

  }

  echo esc_attr($registerUserSuccess);

  die(); // this is required to return a proper result

}
add_action( 'wp_ajax_tdUpdateAccountForm', 'tdUpdateAccountForm' );
add_action( 'wp_ajax_nopriv_tdUpdateAccountForm', 'tdUpdateAccountForm' );

/*
|--------------------------------------------------------------------------
| include all custom widgets
|--------------------------------------------------------------------------
*/
foreach ( glob( dirname(__FILE__)."/widgets/*.php" ) as $filename ){
    include_once( $filename );
}

/*
|--------------------------------------------------------------------------
| Get IP Address
|--------------------------------------------------------------------------
*/
function td_get_the_user_ip() {
    if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
    //check ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
    //to check ip is pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return apply_filters( 'wpb_get_ip', $ip );
}

/*
|--------------------------------------------------------------------------
| Listings Category extra info
|--------------------------------------------------------------------------
*/
define('MY_CATEGORY_FIELDS', 'my_category_fields_option');

// your fields (the form)
function td_my_category_fields($tag) {
    $tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
    $category_page_template = isset( $tag_extra_fields[$tag->term_id]['category_page_template'] ) ? esc_attr( $tag_extra_fields[$tag->term_id]['category_page_template'] ) : '';
    $category_review_fields = isset( $tag_extra_fields[$tag->term_id]['category_review_fields'] ) ? esc_attr( $tag_extra_fields[$tag->term_id]['category_review_fields'] ) : '';
    $category_icon_code = isset( $tag_extra_fields[$tag->term_id]['category_icon_code'] ) ? esc_attr( $tag_extra_fields[$tag->term_id]['category_icon_code'] ) : '';
    $your_image_url = isset( $tag_extra_fields[$tag->term_id]['your_image_url'] ) ? esc_attr( $tag_extra_fields[$tag->term_id]['your_image_url'] ) : '';
?>

<div class="form-field">    
<table class="form-table">
        <tr class="form-field">
            <th scope="row" valign="top"><label for="category-page-slider"><?php _e( 'Page template', 'themesdojo' ); ?></label></th>
            <td>

                <select id="category_page_template" name="category_page_template">

                    <option value="default" <?php selected( $category_page_template, 'default' ); ?> ><?php _e( 'Default', 'themesdojo' ); ?></option>
                    <option value="version_2" <?php selected( $category_page_template, 'version_2' ); ?> ><?php _e( 'Version 2 (map on top)', 'themesdojo' ); ?></option>
                    <option value="version_3" <?php selected( $category_page_template, 'version_3' ); ?> ><?php _e( 'Version 3 (big map)', 'themesdojo' ); ?></option>

                </select>

            </td>
        </tr>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="category-page-slider"><?php _e( 'Review fields', 'themesdojo' ); ?></label></th>
            <td>

                <input id="category_icon_code" type="text" size="36" name="category_review_fields" value="<?php $category_review_fields = stripslashes($category_review_fields); echo esc_attr($category_review_fields); ?>" />
                <p class="description"><?php _e( 'Separated by comma.', 'themesdojo' ); ?></p>

            </td>
        </tr>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="category-page-slider"><?php _e( 'Icon Code', 'themesdojo' ); ?></label></th>
            <td>

                <input id="category_icon_code" type="text" size="36" name="category_icon_code" value="<?php $category_icon = stripslashes($category_icon_code); echo esc_attr($category_icon); ?>" />
                <p class="description"><?php _e( 'AwesomeFont code:', 'themesdojo' ); ?> <a href="http://fontawesome.io/icons/" target="_blank">fontawesome.io/icons</a></p>

            </td>
        </tr>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="category-page-slider">Map Pin</label></th>
            <td>
            <?php 

            if(!empty($your_image_url)) {

                echo '<div style="width: 100%; float: left;"><img id="your_image_url_img" src="'. $your_image_url .'" style="float: left; margin-bottom: 20px;" /> </div>';
                echo '<input id="your_image_url" type="text" size="36" name="your_image_url" style="max-width: 200px; float: left; margin-top: 10px; display: none;" value="'.$your_image_url.'" />';
                echo '<input id="your_image_url_button_remove" class="button" type="button" style="max-width: 140px; float: left; margin-top: 10px;" value="Remove" /> </br>';
                echo '<input id="your_image_url_button" class="button" type="button" style="max-width: 140px; float: left; margin-top: 10px; display: none;" value="Upload Image" /> </br>'; 

            } else {

                echo '<div style="width: 100%; float: left;"><img id="your_image_url_img" src="'. $your_image_url .'" style="float: left; margin-bottom: 20px;" /> </div>';
                echo '<input id="your_image_url" type="text" size="36" name="your_image_url" style="max-width: 200px; float: left; margin-top: 10px; display: none;" value="'.$your_image_url.'" />';
                echo '<input id="your_image_url_button_remove" class="button" type="button" style="max-width: 140px; float: left; margin-top: 10px; display: none;" value="Remove" /> </br>';
                echo '<input id="your_image_url_button" class="button" type="button" style="max-width: 140px; float: left; margin-top: 10px;" value="Upload Image" /> </br>';

            }

            ?>
            </td>

            <?php get_template_part( 'partials/part-add-image-functions' ); ?>
            
        </tr>
</table>
</div>

    <?php
}

// when the form gets submitted, and the category gets updated (in your case the option will get updated with the values of your custom fields above
function td_update_my_category_fields($term_id) {
    if($_POST['taxonomy'] == 'cat'):
        $tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
        $tag_extra_fields[$term_id]['your_image_url'] = strip_tags($_POST['your_image_url']);
        $tag_extra_fields[$term_id]['category_icon_code'] = $_POST['category_icon_code'];
        $tag_extra_fields[$term_id]['category_page_template'] = $_POST['category_page_template'];
        $tag_extra_fields[$term_id]['category_review_fields'] = $_POST['category_review_fields'];
        update_option(MY_CATEGORY_FIELDS, $tag_extra_fields);
    endif;
}


// when a category is removed
add_filter('deleted_term_taxonomy', 'td_remove_my_category_fields');
function td_remove_my_category_fields($term_id) {
    if($_POST['taxonomy'] == 'cat'):
        $tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
        unset($tag_extra_fields[$term_id]);
        update_option(MY_CATEGORY_FIELDS, $tag_extra_fields);
    endif;
}
// category new fields (the form)
add_filter('cat_add_form_fields', 'td_my_category_fields');
add_filter('cat_edit_form_fields', 'td_my_category_fields');

// Update category fields
add_action( 'edited_cat', 'td_update_my_category_fields', 10, 2 );  
add_action( 'create_cat', 'td_update_my_category_fields', 10, 2 );

// your fields (the form)
function td_my_location_fields($tag) {
    $tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
    $category_page_template = isset( $tag_extra_fields[$tag->term_id]['category_page_template'] ) ? esc_attr( $tag_extra_fields[$tag->term_id]['category_page_template'] ) : '';
    $your_image_url = isset( $tag_extra_fields[$tag->term_id]['your_image_url'] ) ? esc_attr( $tag_extra_fields[$tag->term_id]['your_image_url'] ) : '';
?>

<div class="form-field">    
<table class="form-table">
        <tr class="form-field">
            <th scope="row" valign="top"><label for="category-page-slider"><?php _e( 'Page template', 'themesdojo' ); ?></label></th>
            <td>

                <select id="category_page_template" name="category_page_template">

                    <option value="default" <?php selected( $category_page_template, 'default' ); ?> ><?php _e( 'Default', 'themesdojo' ); ?></option>
                    <option value="version_2" <?php selected( $category_page_template, 'version_2' ); ?> ><?php _e( 'Version 2 (map on top)', 'themesdojo' ); ?></option>
                    <option value="version_3" <?php selected( $category_page_template, 'version_3' ); ?> ><?php _e( 'Version 3 (big map)', 'themesdojo' ); ?></option>

                </select>

            </td>
        </tr>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="category-page-slider">Location Cover Image</label></th>
            <td>
            <?php 

            if(!empty($your_image_url)) {

                echo '<div style="width: 100%; float: left;"><img id="your_image_url_img" src="'. $your_image_url .'" style="float: left; margin-bottom: 20px; max-width: 250px; height: auto;" /> </div>';
                echo '<input id="your_image_url" type="text" size="36" name="your_image_url" style="max-width: 200px; float: left; margin-top: 10px; display: none;" value="'.$your_image_url.'" />';
                echo '<input id="your_image_url_button_remove" class="button" type="button" style="max-width: 140px; float: left; margin-top: 10px;" value="Remove" /> </br>';
                echo '<input id="your_image_url_button" class="button" type="button" style="max-width: 140px; float: left; margin-top: 10px; display: none;" value="Upload Image" /> </br>'; 

            } else {

                echo '<div style="width: 100%; float: left;"><img id="your_image_url_img" src="'. $your_image_url .'" style="float: left; margin-bottom: 20px; max-width: 250px; height: auto;" /> </div>';
                echo '<input id="your_image_url" type="text" size="36" name="your_image_url" style="max-width: 200px; float: left; margin-top: 10px; display: none;" value="'.$your_image_url.'" />';
                echo '<input id="your_image_url_button_remove" class="button" type="button" style="max-width: 140px; float: left; margin-top: 10px; display: none;" value="Remove" /> </br>';
                echo '<input id="your_image_url_button" class="button" type="button" style="max-width: 140px; float: left; margin-top: 10px;" value="Upload Image" /> </br>';

            }

            ?>
            </td>

            <?php get_template_part( 'partials/part-add-image-functions' ); ?>

        </tr>
</table>
</div>

    <?php
}

// when the form gets submitted, and the category gets updated (in your case the option will get updated with the values of your custom fields above
function td_update_my_location_fields($term_id) {
    if($_POST['taxonomy'] == 'loc'):
        $tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
        $tag_extra_fields[$term_id]['category_page_template'] = $_POST['category_page_template'];
        $tag_extra_fields[$term_id]['your_image_url'] = strip_tags($_POST['your_image_url']);
        update_option(MY_CATEGORY_FIELDS, $tag_extra_fields);
    endif;
}


// when a category is removed
add_filter('deleted_term_taxonomy', 'td_remove_my_location_fields');
function td_remove_my_location_fields($term_id) {
    if($_POST['taxonomy'] == 'loc'):
        $tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
        unset($tag_extra_fields[$term_id]);
        update_option(MY_CATEGORY_FIELDS, $tag_extra_fields);
    endif;
}
// category new fields (the form)
add_filter('loc_add_form_fields', 'td_my_location_fields');
add_filter('loc_edit_form_fields', 'td_my_location_fields');

// Update category fields
add_action( 'edited_loc', 'td_update_my_location_fields', 10, 2 );  
add_action( 'create_loc', 'td_update_my_location_fields', 10, 2 );

/*
|--------------------------------------------------------------------------
| Events Category extra info
|--------------------------------------------------------------------------
*/

// your fields (the form)
function td_my_events_category_fields($tag) {
    $tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
    if(!empty($tag->term_id)) {
        $term_id = $tag->term_id;
    } else {
        $term_id = "";
    }
    $category_page_template = isset( $tag_extra_fields[$term_id]['category_page_template'] ) ? esc_attr( $tag_extra_fields[$term_id]['category_page_template'] ) : '';
    $category_review_fields = isset( $tag_extra_fields[$term_id]['category_review_fields'] ) ? esc_attr( $tag_extra_fields[$term_id]['category_review_fields'] ) : '';
    $category_icon_code = isset( $tag_extra_fields[$term_id]['category_icon_code'] ) ? esc_attr( $tag_extra_fields[$term_id]['category_icon_code'] ) : '';
    $your_image_url = isset( $tag_extra_fields[$term_id]['your_image_url'] ) ? esc_attr( $tag_extra_fields[$term_id]['your_image_url'] ) : '';
?>

<div class="form-field">    
<table class="form-table">
        <tr class="form-field">
            <th scope="row" valign="top"><label for="category-page-slider"><?php _e( 'Page template', 'themesdojo' ); ?></label></th>
            <td>

                <select id="category_page_template" name="category_page_template">

                    <option value="default" <?php selected( $category_page_template, 'default' ); ?> ><?php _e( 'Default', 'themesdojo' ); ?></option>
                    <option value="version_2" <?php selected( $category_page_template, 'version_2' ); ?> ><?php _e( 'Version 2 (map on top)', 'themesdojo' ); ?></option>
                    <option value="version_3" <?php selected( $category_page_template, 'version_3' ); ?> ><?php _e( 'Version 3 (big map)', 'themesdojo' ); ?></option>

                </select>

            </td>
        </tr>
         <tr class="form-field">
            <th scope="row" valign="top"><label for="category-page-slider"><?php _e( 'Review fields', 'themesdojo' ); ?></label></th>
            <td>

                <input id="category_icon_code" type="text" size="36" name="category_review_fields" value="<?php $category_review_fields = stripslashes($category_review_fields); echo esc_attr($category_review_fields); ?>" />
                <p class="description"><?php _e( 'Separated by comma.', 'themesdojo' ); ?></p>

            </td>
        </tr>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="category-page-slider"><?php _e( 'Icon Code', 'themesdojo' ); ?></label></th>
            <td>

                <input id="category_icon_code" type="text" size="36" name="category_icon_code" value="<?php $category_icon = stripslashes($category_icon_code); echo esc_attr($category_icon); ?>" />
                <p class="description"><?php _e( 'AwesomeFont code:', 'themesdojo' ); ?> <a href="http://fontawesome.io/icons/" target="_blank">fontawesome.io/icons</a></p>

            </td>
        </tr>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="category-page-slider">Map Pin</label></th>
            <td>
            <?php 

            if(!empty($your_image_url)) {

                echo '<div style="width: 100%; float: left;"><img id="your_image_url_img" src="'. $your_image_url .'" style="float: left; margin-bottom: 20px;" /> </div>';
                echo '<input id="your_image_url" type="text" size="36" name="your_image_url" style="max-width: 200px; float: left; margin-top: 10px; display: none;" value="'.$your_image_url.'" />';
                echo '<input id="your_image_url_button_remove" class="button" type="button" style="max-width: 140px; float: left; margin-top: 10px;" value="Remove" /> </br>';
                echo '<input id="your_image_url_button" class="button" type="button" style="max-width: 140px; float: left; margin-top: 10px; display: none;" value="Upload Image" /> </br>'; 

            } else {

                echo '<div style="width: 100%; float: left;"><img id="your_image_url_img" src="'. $your_image_url .'" style="float: left; margin-bottom: 20px;" /> </div>';
                echo '<input id="your_image_url" type="text" size="36" name="your_image_url" style="max-width: 200px; float: left; margin-top: 10px; display: none;" value="'.$your_image_url.'" />';
                echo '<input id="your_image_url_button_remove" class="button" type="button" style="max-width: 140px; float: left; margin-top: 10px; display: none;" value="Remove" /> </br>';
                echo '<input id="your_image_url_button" class="button" type="button" style="max-width: 140px; float: left; margin-top: 10px;" value="Upload Image" /> </br>';

            }

            ?>
            </td>

            <?php get_template_part( 'partials/part-add-image-functions' ); ?>

        </tr>
</table>
</div>

    <?php
}

// when the form gets submitted, and the category gets updated (in your case the option will get updated with the values of your custom fields above
function td_update_my_events_category_fields($term_id) {
    if($_POST['taxonomy'] == 'event_cat'):
        $tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
        $tag_extra_fields[$term_id]['your_image_url'] = strip_tags($_POST['your_image_url']);
        $tag_extra_fields[$term_id]['category_icon_code'] = $_POST['category_icon_code'];
        $tag_extra_fields[$term_id]['category_page_template'] = $_POST['category_page_template'];
        $tag_extra_fields[$term_id]['category_review_fields'] = $_POST['category_review_fields'];
        update_option(MY_CATEGORY_FIELDS, $tag_extra_fields);
    endif;
}


// when a category is removed
add_filter('deleted_term_taxonomy', 'td_remove_my_events_category_fields');
function td_remove_my_events_category_fields($term_id) {
    if($_POST['taxonomy'] == 'event_cat'):
        $tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
        unset($tag_extra_fields[$term_id]);
        update_option(MY_CATEGORY_FIELDS, $tag_extra_fields);
    endif;
}
// category new fields (the form)
add_filter('event_cat_add_form_fields', 'td_my_events_category_fields');
add_filter('event_cat_edit_form_fields', 'td_my_events_category_fields');

// Update category fields
add_action( 'edited_event_cat', 'td_update_my_events_category_fields', 10, 2 );  
add_action( 'create_event_cat', 'td_update_my_events_category_fields', 10, 2 );

// your fields (the form)
function td_my_events_location_fields($tag) {
    $tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
    if(!empty($tag->term_id)) {
        $term_id = $tag->term_id;
    } else {
        $term_id = "";
    }
    $category_page_template = isset( $tag_extra_fields[$term_id]['category_page_template'] ) ? esc_attr( $tag_extra_fields[$term_id]['category_page_template'] ) : '';
    $your_image_url = isset( $tag_extra_fields[$term_id]['your_image_url'] ) ? esc_attr( $tag_extra_fields[$term_id]['your_image_url'] ) : '';
?>

<div class="form-field">    
<table class="form-table">
        <tr class="form-field">
            <th scope="row" valign="top"><label for="category-page-slider"><?php _e( 'Page template', 'themesdojo' ); ?></label></th>
            <td>

                <select id="category_page_template" name="category_page_template">

                    <option value="default" <?php selected( $category_page_template, 'default' ); ?> ><?php _e( 'Default', 'themesdojo' ); ?></option>
                    <option value="version_2" <?php selected( $category_page_template, 'version_2' ); ?> ><?php _e( 'Version 2 (map on top)', 'themesdojo' ); ?></option>
                    <option value="version_3" <?php selected( $category_page_template, 'version_3' ); ?> ><?php _e( 'Version 3 (big map)', 'themesdojo' ); ?></option>

                </select>

            </td>
        </tr>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="category-page-slider">Location Cover Image</label></th>
            <td>
            <?php 

            if(!empty($your_image_url)) {

                echo '<div style="width: 100%; float: left;"><img id="your_image_url_img" src="'. $your_image_url .'" style="float: left; margin-bottom: 20px; max-width: 250px; height: auto;" /> </div>';
                echo '<input id="your_image_url" type="text" size="36" name="your_image_url" style="max-width: 200px; float: left; margin-top: 10px; display: none;" value="'.$your_image_url.'" />';
                echo '<input id="your_image_url_button_remove" class="button" type="button" style="max-width: 140px; float: left; margin-top: 10px;" value="Remove" /> </br>';
                echo '<input id="your_image_url_button" class="button" type="button" style="max-width: 140px; float: left; margin-top: 10px; display: none;" value="Upload Image" /> </br>'; 

            } else {

                echo '<div style="width: 100%; float: left;"><img id="your_image_url_img" src="'. $your_image_url .'" style="float: left; margin-bottom: 20px; max-width: 250px; height: auto;" /> </div>';
                echo '<input id="your_image_url" type="text" size="36" name="your_image_url" style="max-width: 200px; float: left; margin-top: 10px; display: none;" value="'.$your_image_url.'" />';
                echo '<input id="your_image_url_button_remove" class="button" type="button" style="max-width: 140px; float: left; margin-top: 10px; display: none;" value="Remove" /> </br>';
                echo '<input id="your_image_url_button" class="button" type="button" style="max-width: 140px; float: left; margin-top: 10px;" value="Upload Image" /> </br>';

            }

            ?>
            </td>

            <?php get_template_part( 'partials/part-add-image-functions' ); ?>

        </tr>
</table>
</div>

    <?php
}

// when the form gets submitted, and the category gets updated (in your case the option will get updated with the values of your custom fields above
function td_update_my_events_location_fields($term_id) {
    if($_POST['taxonomy'] == 'event_loc'):
        $tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
        $tag_extra_fields[$term_id]['category_page_template'] = $_POST['category_page_template'];
        $tag_extra_fields[$term_id]['your_image_url'] = strip_tags($_POST['your_image_url']);
        update_option(MY_CATEGORY_FIELDS, $tag_extra_fields);
    endif;
}


// when a category is removed
add_filter('deleted_term_taxonomy', 'td_remove_my_events_location_fields');
function td_remove_my_events_location_fields($term_id) {
    if($_POST['taxonomy'] == 'event_loc'):
        $tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
        unset($tag_extra_fields[$term_id]);
        update_option(MY_CATEGORY_FIELDS, $tag_extra_fields);
    endif;
}
// category new fields (the form)
add_filter('event_loc_add_form_fields', 'td_my_events_location_fields');
add_filter('event_loc_edit_form_fields', 'td_my_events_location_fields');

// Update category fields
add_action( 'edited_event_loc', 'td_update_my_events_location_fields', 10, 2 );  
add_action( 'create_event_loc', 'td_update_my_events_location_fields', 10, 2 );


/*
|--------------------------------------------------------------------------
| Add "has-submenu" CSS class to navigation menu items that have children 
| in a submenu
|--------------------------------------------------------------------------
*/
function td_menu_item_parent_classing( $items ) {
	
	$parents = array();
    foreach ( $items as $item ) {
        if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
            $parents[] = $item->menu_item_parent;
        }
    }
    
    foreach ( $items as $item ) {
        if ( in_array( $item->ID, $parents ) ) {
            $item->classes[] = 'has-submenu'; 
        }
    }
    
    return $items; 

}



/*
|--------------------------------------------------------------------------
| Enqueue scripts and styles
|--------------------------------------------------------------------------
*/
if ( ! function_exists( 'themesdojo_scripts' ) ) :

    function themesdojo_scripts() {
        
		global $detect;
		
		/*
		|--------------------------------------------------------------------------
		| CSS
		|--------------------------------------------------------------------------
		*/
		
        /* Fonts */
		wp_enqueue_style( 'genericons', 	    THEME_WEB_ROOT . '/fonts/genericons.css' );
		
		/* Google Fonts */
		td_google_fonts();

		/* Main CSS */
        wp_enqueue_style( 'td-style' , get_stylesheet_uri(), array(), TD_THEME_VERSION );

		/* Loads the Internet Explorer specific stylesheet. */
		wp_enqueue_style( 'td-ie',              THEME_WEB_ROOT . '/css/ie.css', array( 'td-style' ), '2013-07-18' );
		wp_style_add_data( 'td-ie', 'conditional', 'lt IE 9' );
				
        /* Bootstrap */
        wp_enqueue_style( 'td-bootstrap',       THEME_WEB_ROOT . '/css/bootstrap.min.css' );
        		
		/* Main */
		wp_enqueue_style( 'td-main', 		    THEME_WEB_ROOT . '/css/main.css' );

		/* FlexSlider */
		wp_enqueue_style( 'td-flexslider' ,     THEME_WEB_ROOT . '/css/flexslider.css' );

		/* PrettyPhoto */
		wp_enqueue_style( 'td-pretty-photo' ,   THEME_WEB_ROOT . '/css/prettyPhoto.css' );

        /* flipclock */
        wp_enqueue_style( 'td-flipclock' ,      THEME_WEB_ROOT . '/css/flipclock.css' );

        /* Owl Carousel */
        wp_enqueue_style( 'td-owl-carousel',    THEME_WEB_ROOT . '/css/owl.carousel.css' );

        // Load main style
        wp_enqueue_style( 'td-owl-theme-style', THEME_WEB_ROOT . '/css/owl.theme.css', array(), '1' );

        // Load main style
        wp_enqueue_style( 'td-owl-trans',       THEME_WEB_ROOT . '/css/owl.transitions.css', array(), '1' );

		/* Responsive */
		wp_enqueue_style( 'td-responsive' ,     THEME_WEB_ROOT . '/css/responsive.css' );

		/* FontAwesome */
		wp_enqueue_style( 'td-font-awesome',    THEME_WEB_ROOT . '/css/font-awesome.min.css', array(), '4.2.0' );

        if ( is_page_template('templates/template-edit-event.php') || is_page_template('templates/template-upload-event.php') ) { 

            /* pickadate script */
            wp_enqueue_style( 'td-picker-css',  THEME_WEB_ROOT . '/css/classic-picker.css' );

            /* pickadate script */
            wp_enqueue_style( 'td-picker-date', THEME_WEB_ROOT . '/css/classic.date.css' );

            /* pickadate script */
            wp_enqueue_style( 'td-picker-time', THEME_WEB_ROOT . '/css/classic.time.css' );

        }
        
		
		
		/*
		|--------------------------------------------------------------------------
		| JavaScript
		|--------------------------------------------------------------------------
		*/	
				
		/* base javaScripts header */
    wp_enqueue_script( 'jquery' );

    if ( is_page_template('templates/template-contact.php') || is_single()) {	
		
			/* loag gmap api script */
			wp_enqueue_script( 'td-google-maps-script', 'https://maps.googleapis.com/maps/api/js?sensor=true', array( 'jquery' ), '2013-07-18', true );

			/* gmap3 script */
			wp_enqueue_script( 'td-gmap3',        THEME_WEB_ROOT . '/js/gmap3.js', array('jquery'), '5.1.1' , true );

			/* infobox script */
			wp_enqueue_script( 'td-infobox',      THEME_WEB_ROOT . '/js/gmap3.infobox.js', array('jquery'), TD_THEME_VERSION , true );

			/* modernizer script */
			wp_enqueue_script( 'td-modernizer',   THEME_WEB_ROOT . '/js/modernizr.touch.js', array('jquery'), TD_THEME_VERSION , true );

	}	


    function themesdojo_load_map_scripts() { 
    
        /* loag gmap api script */
        wp_enqueue_script( 'td-google-maps-script', 'https://maps.googleapis.com/maps/api/js?libraries=geometry', array( 'jquery' ), '2013-07-18', true );

        /* gmap3 script */
        wp_enqueue_script( 'td-gmap3',        THEME_WEB_ROOT . '/js/gmap3.js', array('jquery'), '5.1.1' , true );

        /* infobox script */
        wp_enqueue_script( 'td-infobox',      THEME_WEB_ROOT . '/js/gmap3.infobox.js', array('jquery'), TD_THEME_VERSION , true );

        /* modernizer script */
        wp_enqueue_script( 'td-modernizer',   THEME_WEB_ROOT . '/js/modernizr.touch.js', array('jquery'), TD_THEME_VERSION , true );

        wp_enqueue_script( 'admin-jquery-ui-script', '//code.jquery.com/ui/1.10.4/jquery-ui.js', array( 'jquery' ), '2013-07-18', true );

        /* gmap3 script */
        wp_enqueue_script( 'td-cluster',      THEME_WEB_ROOT . '/js/markerclusterer_compiled.js', array('jquery'), '5.1.1' , true );

        /* gmap3 script */
        wp_enqueue_script( 'td-spider',       THEME_WEB_ROOT . '/js/oms.min.js', array('jquery'), '1.0.0' , true );

    } 

    if ( is_page_template('templates/template-upload-listing.php') || is_page_template('inc/td-upload-form.php') || is_page_template('templates/template-edit-listing.php') || is_page_template('templates/template-edit-event.php') || is_page_template('templates/template-upload-event.php') ) { 

        themesdojo_load_map_scripts();

    }

    if ( is_page_template('templates/template-edit-event.php') || is_page_template('templates/template-upload-event.php') ) { 

        /* pickadate script */
        wp_enqueue_script( 'td-picker',       THEME_WEB_ROOT . '/js/picker.js', array('jquery'), '3.5.5' , true );

        /* pickadate script */
        wp_enqueue_script( 'td-picker-date',  THEME_WEB_ROOT . '/js/picker.date.js', array('jquery'), '3.5.5' , true );

        /* pickadate script */
        wp_enqueue_script( 'td-picker-time',  THEME_WEB_ROOT . '/js/picker.time.js', array('jquery'), '3.5.5' , true );

    }
						
		/* comment reply*/
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }        
		
		/* 
		 * base Java Scripts // output in footer 
		 */
        
		/* Custom JavaScripts - you can use this file inside the child theme or use the footer java hook */
		wp_enqueue_script( 'td-init-script' ,    THEME_WEB_ROOT . '/js/functions.js', TD_THEME_VERSION , true ); 
		
		/* bootstrap script */
		wp_enqueue_script( 'td-bootstrap',       THEME_WEB_ROOT . '/js/bootstrap.min.js', array('jquery'), '3.1.1' , true );

		/* Load form script */
		wp_enqueue_script( 'td-form-script',     THEME_WEB_ROOT . '/js/jquery.form.js', array( 'jquery' ), '2013-07-18', true );

		/* Load validate script */
		wp_enqueue_script( 'td-validate-script', THEME_WEB_ROOT . '/js/jquery.validate.min.js', array( 'jquery' ), '2013-07-18', true );

		/* fitvids script */
		wp_enqueue_script( 'td-fitvids',         THEME_WEB_ROOT . '/js/jquery.fitvids.js', array('jquery'), '1.0.3' , true );

		/* nav script */
		wp_enqueue_script( 'td-nav',             THEME_WEB_ROOT . '/js/jquery.nav.js', array('jquery'), '2.2.0' , true );

		// PrettyPhoto script //
		wp_enqueue_script( 'td-pretty-photo',    THEME_WEB_ROOT . '/js/jquery.prettyPhoto.js', array('jquery'), '1.0.0' , true );

		/* scrollTo script */
		wp_enqueue_script( 'td-scrollTo',        THEME_WEB_ROOT . '/js/jquery.scrollTo.js', array('jquery'), '1.4.3' , true );

		/* parallax script */
		wp_enqueue_script( 'td-parallax',        THEME_WEB_ROOT . '/js/skrollr.min.js', array('jquery'), '0.6.27' , true );

		/* stick topscript */
		wp_enqueue_script( 'td-stickUp-main',    THEME_WEB_ROOT . '/js/waypoints.min.js', array('jquery'), '1.0.0' , true );
		wp_enqueue_script( 'td-stickUp',         THEME_WEB_ROOT . '/js/waypoints-sticky.min.js', array('jquery'), '1.0.0' , true );

		// TweenLite script //
		wp_enqueue_script( 'td-tween-css',       THEME_WEB_ROOT . '/js/CSSPlugin.min.js', array('jquery'), '1.13.2' , true );
		wp_enqueue_script( 'td-tween-ease',      THEME_WEB_ROOT . '/js/EasePack.min.js', array('jquery'), '1.13.2' , true );
		wp_enqueue_script( 'td-tween',           THEME_WEB_ROOT . '/js/TweenLite.min.js', array('jquery'), '1.13.2' , true );

		// PrettyPhoto script //
		wp_enqueue_script( 'td-pretty-photo',    THEME_WEB_ROOT . '/js/jquery.prettyPhoto.js', array('jquery'), '1.0.0' , true );

        // Owl Carousel script //
        wp_enqueue_script( 'td-owl-carousel',   THEME_WEB_ROOT . '/js/owl.carousel.min.js', array('jquery'), '1.0.0' , true );

		/* flexslider script */
		wp_register_script( 'td-flexslider',     THEME_WEB_ROOT . '/js/jquery.flexslider.js', array( 'jquery' ),'',true );

		// Loads JavaScript file
		wp_enqueue_script( 'td-main',            THEME_WEB_ROOT . '/js/main.js', array( 'jquery' ), TD_THEME_VERSION, true );

		// Loads Menu Script file
		wp_enqueue_script( 'td-menu',            THEME_WEB_ROOT . '/js/menu.js', array( 'jquery' ), TD_THEME_VERSION, true );

		// Inview script //
		wp_enqueue_script( 'td-inview',          THEME_WEB_ROOT . '/js/jquery.inview.js', array('jquery'), '1.0.0' , true );

        // Isotope //
        wp_enqueue_script( 'td-masonry',         THEME_WEB_ROOT . '/js/jquery.isotope.min.js', array('jquery'), '1.0.0' , true );

		
    }
    
    add_action( 'wp_enqueue_scripts', 'themesdojo_scripts' );

endif;


/*
|--------------------------------------------------------------------------
| Enqueue scripts and styles
|--------------------------------------------------------------------------
*/

if ( ! function_exists( 'themesdojo_admin_enqueue' ) ) :

	function themesdojo_admin_enqueue() {

		/* Admin slider script */
		wp_enqueue_style( 'td-ui-style',                "http://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css", false, "1.0.0", "all");

        /* Main */
        wp_enqueue_style( 'td-admin-style',             THEME_WEB_ROOT . '/css/td_admin_style.css' );

		/* Admin slider script */
		wp_enqueue_script( 'td-admin-depend-script',    'http://code.jquery.com/ui/1.11.1/jquery-ui.js', array('jquery'), TD_THEME_VERSION, true );

        /* Admin script */
        wp_enqueue_script( 'td-admin-script',           THEME_WEB_ROOT . '/js/td_admin_script.js', array('jquery'), TD_THEME_VERSION, true );

        /* Time picker */
        wp_enqueue_script( 'td-time-picker',            THEME_WEB_ROOT . '/js/jquery.timePicker.min.js', array('jquery'), '2013-07-18', true );

		wp_enqueue_script( 'admin-google-maps-script', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', array( 'jquery' ), '2013-07-18', true );

		global $post_type;
	    if( 'resume' == $post_type OR 'job' == $post_type OR 'company' == $post_type OR 'event' == $post_type ) {
			wp_enqueue_script( 'admin-jquery-ui-script', '//code.jquery.com/ui/1.10.4/jquery-ui.js', array( 'jquery' ), '2013-07-18', true );
		}

	}

	add_action( 'admin_enqueue_scripts', 'themesdojo_admin_enqueue' );

endif;


/*
|--------------------------------------------------------------------------
| Enqueue google fonts
|--------------------------------------------------------------------------
*/
if ( ! function_exists( 'td_google_fonts' ) ) :
	
    function td_google_fonts() {

		$protocol = is_ssl() ? 'https' : 'http';
		wp_enqueue_style( 'mytheme-raleway', "$protocol://fonts.googleapis.com/css?family=Raleway:400,500,600,700" );
		wp_enqueue_style( 'mytheme-ptsanserif', "$protocol://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic" );
	}
    
endif;


/*
|--------------------------------------------------------------------------
| Get Avatar Image Url
|--------------------------------------------------------------------------
*/
if ( ! function_exists( 'td_get_avatar_url' ) ) :
	function td_get_avatar_url($author_id, $size){
	    $get_avatar = get_avatar( $author_id, $size );
	    preg_match("/src='(.*?)'/i", $get_avatar, $matches);
	    return ( $matches[1] );
	}
endif;

/*
|--------------------------------------------------------------------------
| Custom Search Form 
| due to WP echo on get_search_form Bug we need to make use a filter
|--------------------------------------------------------------------------
*/
if ( !function_exists( 'td_searchform_filter' ) ) {

    function td_searchform_filter( $form ) {

    $searchform = '<form role="search" method="get" class="search-form" id="searchform" action="' . esc_url( home_url( '/' ) ) . '">
        <label style="margin-bottom: 0;">
            <input style="margin-bottom: 0;" type="search" class="search-field" placeholder="' .esc_attr__( 'Type and hit enter ...' , 'themesdojo' ) . '" value="' . esc_attr( get_search_query() ) . '" name="s" title="' . __( 'Search for:' , 'themesdojo' ) . '">
        </label>
        </form>';
        
        return $searchform; 
    }
    
    add_filter( 'get_search_form', 'td_searchform_filter' );

}

/*
|--------------------------------------------------------------------------
| Get image id from url
|--------------------------------------------------------------------------
*/
function td_get_attachment_id_from_src($image_src) {

  global $wpdb;
  $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
  $id = $wpdb->get_var($query);
  return $id;

}

/*
|--------------------------------------------------------------------------
| Fix SSL Attachment url
|--------------------------------------------------------------------------
*/
function td_fix_ssl_attachment_url( $url ) {
	if ( is_ssl() )
		$url = str_replace( 'http://', 'https://', $url );
	return $url;
}
add_filter( 'wp_get_attachment_url', 'td_fix_ssl_attachment_url' );


/*
|--------------------------------------------------------------------------
| Enqueue media scripts
|--------------------------------------------------------------------------
*/
function td_custom_admin_scripts() {
	wp_enqueue_media();
}
add_action('admin_enqueue_scripts', 'td_custom_admin_scripts' );

/*
|--------------------------------------------------------------------------
| Allow user upload media from front end
|--------------------------------------------------------------------------
*/
function td_add_media_upload_scripts() {
    if ( is_admin() ) {
         return;
       }
    wp_enqueue_media();
}
add_action('wp_enqueue_scripts', 'td_add_media_upload_scripts');

if ( current_user_can('subscriber') && !current_user_can('upload_files') )
  add_action('admin_init', 'td_allow_contributor_uploads');
function td_allow_contributor_uploads() {
  $contributor = get_role('subscriber');
  $contributor->add_cap('upload_files');
}

/*
|--------------------------------------------------------------------------
| Restrict user to see only his attachments
|--------------------------------------------------------------------------
*/
add_filter( 'posts_where', 'td_devplus_attachments_wpquery_where' );
function td_devplus_attachments_wpquery_where( $where ){
  global $current_user;

  if( is_user_logged_in() ){
    // we spreken over een ingelogde user
    if( isset( $_POST['action'] ) ){
      // library query
      if( $_POST['action'] == 'query-attachments' ){
        $where .= ' AND post_author='.$current_user->data->ID;
      }
    }
  }

  return $where;
}

/*
|--------------------------------------------------------------------------
| Adds custom field to user profile
|--------------------------------------------------------------------------
*/
function td_additional_user_fields( $user ) { ?>
 
    <h3><?php _e( 'Additional User Meta', 'themesdojo' ); ?></h3>

    <table class="form-table" style="margin-bottom: 30px;">
 
        <tr>

            <th>
            	<label for="user_meta_facebook"><?php _e( 'Facebook link', 'themesdojo' ); ?></label>
            </th>
            <td>
            	<input type="text" name="user_meta_facebook" id="user_meta_facebook" value="<?php echo esc_url_raw( get_the_author_meta( 'user_meta_facebook', $user->ID ) ); ?>" class="regular-text" />
            </td>

        </tr>

    </table>

    <table class="form-table" style="margin-bottom: 30px;">

        <tr>

            <th>
            	<label for="user_meta_twitter"><?php _e( 'Twitter link', 'themesdojo' ); ?></label>
            </th>
            <td>
            	<input type="text" name="user_meta_twitter" id="user_meta_twitter" value="<?php echo esc_url_raw( get_the_author_meta( 'user_meta_twitter', $user->ID ) ); ?>" class="regular-text" />
            </td>

        </tr>
 
    </table>

    <table class="form-table" style="margin-bottom: 30px;">

        <tr>

            <th>
            	<label for="user_meta_googleplus"><?php _e( 'Google+ link', 'themesdojo' ); ?></label>
            </th>
            <td>
            	<input type="text" name="user_meta_googleplus" id="user_meta_googleplus" value="<?php echo esc_url_raw( get_the_author_meta( 'user_meta_googleplus', $user->ID ) ); ?>" class="regular-text" />
            </td>

        </tr>
 
    </table>

    <table class="form-table" style="margin-bottom: 30px;">

        <tr>

            <th>
            	<label for="user_meta_dribbble"><?php _e( 'Dribbble link', 'themesdojo' ); ?></label>
            </th>
            <td>
            	<input type="text" name="user_meta_dribbble" id="user_meta_dribbble" value="<?php echo esc_url_raw( get_the_author_meta( 'user_meta_dribbble', $user->ID ) ); ?>" class="regular-text" />
            </td>

        </tr>
 
    </table>
 
    <table class="form-table">
 
        <tr>
            <th><label for="user_meta_image"><?php _e( 'A special image for each user', 'themesdojo' ); ?></label></th>
            <td>
                <!-- Outputs the image after save -->
                <img id="your_image_url_img" src="<?php echo esc_url( get_the_author_meta( 'user_meta_image', $user->ID ) ); ?>" style="width:150px;"><br />
                <!-- Outputs the text field and displays the URL of the image retrieved by the media uploader -->
                <input type="text" name="user_meta_image" id="user_meta_image" value="<?php echo esc_url_raw( get_the_author_meta( 'user_meta_image', $user->ID ) ); ?>" class="regular-text" />
                <!-- Outputs the save button -->
                <input type='button' class="additional-user-image button-primary" value="<?php _e( 'Upload Image', 'themesdojo' ); ?>" id="uploadimage"/><br />
                <span class="description"><?php _e( 'Upload an additional image for your user profile.', 'themesdojo' ); ?></span>
            </td>
        </tr>
       
 
    </table><!-- end form-table -->
<?php } // additional_user_fields
 
add_action( 'show_user_profile', 'td_additional_user_fields' );
add_action( 'edit_user_profile', 'td_additional_user_fields' );

/**
* Saves additional user fields to the database
*/
function td_save_additional_user_meta( $user_id ) {
 
    // only saves if the current user can edit user profiles
    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;
 
 	  $user_facebook_url = esc_url_raw($_POST['user_meta_facebook']);
    update_user_meta( $user_id, 'user_meta_facebook', $user_facebook_url );

    $user_twitter_url = esc_url_raw($_POST['user_meta_twitter']);
    update_user_meta( $user_id, 'user_meta_twitter', $user_twitter_url );

    $user_googleplus_url = esc_url_raw($_POST['user_meta_googleplus']);
    update_user_meta( $user_id, 'user_meta_googleplus', $user_googleplus_url );

    $user_dribbble_url = esc_url_raw($_POST['user_meta_dribbble']);
    update_user_meta( $user_id, 'user_meta_dribbble', $user_dribbble_url );

    $user_avatar_url = esc_url_raw($_POST['user_meta_image']);
    update_user_meta( $user_id, 'user_meta_image', $user_avatar_url );
}
 
add_action( 'personal_options_update', 'td_save_additional_user_meta' );
add_action( 'edit_user_profile_update', 'td_save_additional_user_meta' );


/*
|--------------------------------------------------------------------------
|  helper function : return true if current page is blog related
|--------------------------------------------------------------------------
*/
if ( !function_exists( 'td_is_blog_related' ) ) {
	
    function td_is_blog_related() {
	
		return ( is_tag() || is_search() || is_archive() || is_category() ) ? true : false;
		
	}
    
}

/*
|--------------------------------------------------------------------------
| helper function : returns needed meta data of the current page
|--------------------------------------------------------------------------
*/

if( !function_exists('td_return_meta') ) {

	function td_return_meta( $ID = '' , $key = '' ) {
		
        global $post, $wp_query;
        
		// woo commerce shop ID
		if( function_exists('is_shop') ) {
			
			if( is_shop() ) {
				$pageID = get_option('woocommerce_shop_page_id');
			}
			
		}
		
		// blog page ID
		if( is_home() || td_is_blog_related() ) {
			
			$pageID = get_option('page_for_posts');
		
		// all other pages
		} else {
			
			$pageID = ( isset($wp_query->post) ) ? $wp_query->post->ID : NULL;
            
		}
        
        if ( !empty($key) ) {
            
            return get_post_meta( $pageID , $key , true);
             
        } else {
            
            return get_post_meta( $pageID );
            
        }
        
	}
		
}


/*
|--------------------------------------------------------------------------
| helper function : fix wordpress w3c rel
|--------------------------------------------------------------------------
*/

if( !function_exists('td_replace_cat_tag') ) {
	
	function td_replace_cat_tag ( $text ) {
		$text = preg_replace('/rel="category tag"/', 'data-rel="category tag"', $text); return $text;
	}
	add_filter( 'the_category', 'td_replace_cat_tag' );
	
}



if( !function_exists('td_meta_description') ) :

	function td_meta_description() { ?>
        
        <!-- Title -->
        <title><?php wp_title( '|', true, 'right' ); ?></title>
        <meta name="description" content="<?php bloginfo('description'); ?>">  
        
    <?php }

    add_action('td_meta_theme_hook', 'td_meta_description' );
    
endif;

