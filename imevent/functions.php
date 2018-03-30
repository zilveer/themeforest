<?php
define('TEXT_DOMAIN','imevent');

// Load the theme of translated strings
$lang = get_template_directory() . '/languages';
load_theme_textdomain(TEXT_DOMAIN, $lang);

// Require theme option
require_once get_template_directory() . '/framework/redux/sample-config.php';
global $theme_option;

// Create sidebar right
function theme_slug_widgets_init() {
	$args = array(
		'name' => sprintf( __( 'Blog Sidebar', TEXT_DOMAIN) ),
		'id' => "sidebar-right",
		'description' => __( 'Sidebar right', TEXT_DOMAIN ),
		'class' => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => "</h3>",
	);
	register_sidebar( $args ); 

  $args_product = array(
    'name' => sprintf( __( 'Product Sidebar', TEXT_DOMAIN) ),
    'id' => "product-sidebar",
    'description' => __( 'Product Sidebar', TEXT_DOMAIN ),
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => "</h3>",
  );
  register_sidebar( $args_product ); 


}
add_action( 'widgets_init', 'theme_slug_widgets_init' );


function ova_theme_setup(){
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );

    if ( ! isset( $content_width ) ) $content_width = 900;

    // This theme styles the visual editor with editor-style.css to match the theme style.
    add_editor_style();

    // Adds RSS feed links to <head> for posts and comments.
    add_theme_support( 'automatic-feed-links' );

    // Switches default core markup for search form, comment form, and comments    
    // to output valid HTML5.
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

    /*
     * This theme supports all available post formats by default.
     * See http://codex.wordpress.org/Post_Formats
     */
     add_theme_support( 'post-formats', array(
         'audio', 'video'
     ) );

    add_theme_support( 'post-thumbnails' );

    //add_shortcode('gallery', '__return_false');

    add_theme_support( 'custom-header' );
    add_theme_support( 'custom-background');

    if ( function_exists( 'add_theme_support' ) ) {
        add_theme_support( 'post-home-thumbnails' );
        set_post_thumbnail_size( 318, 250,true );
    }
    if ( function_exists( 'add_theme_support' ) ) {
      add_image_size('thumbnail_350x175', 350, 175, true);
    }
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'ova_theme_setup' );


function ova_register_menus() {
  register_nav_menus( array(
    'primary'   => __( 'Subpage Menu', TEXT_DOMAIN ),
    'one_page'   => __( 'One Page Menu', TEXT_DOMAIN ),
  ) );
}
add_action( 'init', 'ova_register_menus' );

/**
 * Enqueues scripts and styles for front end.
 *
 */
 function ova_theme_scripts_styles() {

    global $theme_option;

    // Adds JavaScript to pages with the comment form to support sites with
    
    /* JS Global */
    wp_enqueue_script("jquery");
    
    
    wp_enqueue_script("modernizr-custom", get_template_directory_uri()."/assets/plugins/modernizr.custom.js",array(),false,true);    
    wp_enqueue_script("bootstrap-min", get_template_directory_uri()."/assets/plugins/bootstrap/js/bootstrap.min.js",array(),false,true);
    wp_enqueue_script("bootstrap-select", get_template_directory_uri()."/assets/plugins/bootstrap-select/bootstrap-select.min.js",array(),false,true);
    wp_enqueue_script("superfish", get_template_directory_uri()."/assets/plugins/superfish/js/superfish.js",array(),false,true);
    wp_enqueue_script("prettyPhoto", get_template_directory_uri()."/assets/plugins/prettyphoto/js/jquery.prettyPhoto.js",array(),false,true);
    wp_enqueue_script("placeholdem", get_template_directory_uri()."/assets/plugins/placeholdem.min.js",array(),false,true);    
    wp_enqueue_script("smoothscroll", get_template_directory_uri()."/assets/plugins/jquery.smoothscroll.min.js",array(),false,true);
    wp_enqueue_script("easing", get_template_directory_uri()."/assets/plugins/jquery.easing.min.js",array(),false,true);

    
    /* JS Page Level */
    wp_enqueue_script("carousel", get_template_directory_uri()."/assets/plugins/owlcarousel2/owl.carousel.min.js",array(),false,true);
    wp_enqueue_script("waypoints", get_template_directory_uri()."/assets/plugins/waypoints/waypoints.min.js",array(),false,true);
    wp_enqueue_script("jquery-plugin", get_template_directory_uri()."/assets/plugins/countdown/jquery.plugin.min.js",array(),false,true);
    wp_enqueue_script("countdown", get_template_directory_uri()."/assets/plugins/countdown/jquery.countdown.min.js",array(),false,true);
    wp_enqueue_script("googleapis", "https://maps.googleapis.com/maps/api/js?key=AIzaSyALw-8KDZPw976zDr6U1LvU7YgHFmDP4Iw",array(),false,true);  
    wp_enqueue_script("paralax_theme", get_template_directory_uri()."/assets/js/parallax_theme.js",array(),false,true);  
    
    wp_enqueue_script( 'ajax-script', get_template_directory_uri().'/assets/js/register_event.js', array('jquery'),false,true );

    if(!is_admin()){
      wp_localize_script( 'ajax-script', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
    }

    wp_enqueue_script("wow", get_template_directory_uri()."/assets/plugins/wow.js",array(),false,true);
    wp_enqueue_script("moment", get_template_directory_uri()."/assets/plugins/moment-with-locales.min.js",array(),false,true);
    

    wp_enqueue_script("theme", get_template_directory_uri()."/assets/js/theme.js",array(),false,true);
    wp_enqueue_script("custom", get_template_directory_uri()."/assets/js/custom.js",array(),false,true);

    wp_enqueue_script('jquery-ui-datepicker');
    wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');    
    

    wp_enqueue_script("theme-init", get_template_directory_uri()."/assets/js/theme-init.js",array(),false,true);    


    // Loads our main stylesheet.   
    wp_enqueue_style( 'bootstrap_min', get_template_directory_uri().'/assets/plugins/bootstrap/css/bootstrap.min.css');
    wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/assets/plugins/fontawesome/css/font-awesome.min.css');
    wp_enqueue_style( 'bootstrap-select', get_template_directory_uri().'/assets/plugins/bootstrap-select/bootstrap-select.min.css');
    wp_enqueue_style( 'owl-carousel', get_template_directory_uri().'/assets/plugins/owlcarousel2/assets/owl.carousel.min.css');
    wp_enqueue_style( 'theme-default', get_template_directory_uri().'/assets/plugins/owlcarousel2/assets/owl.theme.default.min.css');
    wp_enqueue_style( 'prettyphoto', get_template_directory_uri().'/assets/plugins/prettyphoto/css/prettyPhoto.css');
    wp_enqueue_style( 'animate', get_template_directory_uri().'/assets/plugins/animate/animate.min.css');
    wp_enqueue_style( 'countdown', get_template_directory_uri().'/assets/plugins/countdown/jquery.countdown.css');
    
    wp_enqueue_style( 'newhome', get_template_directory_uri().'/assets/css/newhome.css');

    wp_enqueue_style( 'theme-style', get_stylesheet_uri(), array(), '2014-10-15' );
    // wp_enqueue_style( 'style-css', get_template_directory_uri().'/style.php');
    wp_enqueue_style( 'custom-css', get_template_directory_uri().'/assets/css/custom.css');

}
add_action( 'wp_enqueue_scripts', 'ova_theme_scripts_styles' );




function imevent_do_shortcode($content) {
    global $shortcode_tags;
    if (empty($shortcode_tags) || !is_array($shortcode_tags))
        return $content;
    $pattern = get_shortcode_regex();
    return preg_replace_callback( "/$pattern/s", 'do_shortcode_tag', $content );
}



add_filter( 'excerpt_length', 'ova_custom_excerpt_length', 999 );
function ova_custom_excerpt_length( $length ) {
    return 42;
}

function custom_excerpt($limit) {
  $excerpt = explode(' ', get_the_content(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}

add_filter('excerpt_more', 'new_excerpt_more');
function new_excerpt_more( $more ) {
    return '';
}


// Remove Background and Header setting in Appearance
add_action( 'after_setup_theme','remove_theme_support_ova', 100 );
function remove_theme_support_ova() {
    remove_theme_support( 'custom-background' );
    remove_theme_support( 'custom-header' );
}


//Custom comment List:


function ova_theme_comment($comment, $args, $depth) {
    //echo 's';
   $GLOBALS['comment'] = $comment; ?>   
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <article class="comment_item" id="comment-<?php comment_ID(); ?>">
         <header class="comment-author">
         <?php echo get_avatar($comment,$size='85',$default='http://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=70' ); ?>
         </header>
         <section class="comment-details">
             <div class="comment-meta commentmetadata clearfix media-body author-name">
                  <div class="author-name">
                    <?php printf(__('%s', TEXT_DOMAIN), get_comment_author_link()) ?>
                    <?php printf(get_comment_date()) ?>
                  </div> 
                  
              </div>

              <div class="comment-body clearfix comment-content">
                  <?php comment_text() ?>
                  <div class="pull-left">
                    <?php edit_comment_link(__('(Edit)', TEXT_DOMAIN),'  ','') ?>
                  <a href="" title=""> <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                  </div>
                  
                </div>
                
             
          </section>
          <?php if ($comment->comment_approved == '0') : ?>
             <em><?php _e('Your comment is awaiting moderation.', TEXT_DOMAIN) ?></em>
             <br />
          <?php endif; ?>
      
        
     </article>
<?php
        }

function ova_do_shortcode($content) {
    global $shortcode_tags;
    if (empty($shortcode_tags) || !is_array($shortcode_tags))
        return $content;
    $pattern = get_shortcode_regex();
    return preg_replace_callback( "/$pattern/s", 'do_shortcode_tag', $content );
}


function ova_numeric_posts_nav() {
   
    if( is_singular() )
        return;
 
    global $wp_query;
 
    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;
 
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );
 
    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;
 
    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
 
    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
 
    echo '<ul class="pagination clearfix">' . "\n";
 
    /** Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li>%s</li>' . "\n", get_previous_posts_link('&laquo;') );
 
    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';
 
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
 
        if ( ! in_array( 2, $links ) )
            echo '<li>...</li>';
    }
 
    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }
 
    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li>...</li>' . "\n";
 
        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }
 
    /** Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li>%s</li>' . "\n", get_next_posts_link('&raquo;') );
 
    echo '</ul>' . "\n";
 
}


function ajax_action_stuff() {
  $data     = $_POST['data'];
  $userinfo    = $data['userinfo'];
  $orderid = $data['orderid'];
  $register_emailclient = $data['register_emailclient'];

  global $wpdb;
  global $theme_option;

  if($theme_option['paypal_active'] == 1){
      $status = 'progressing';
  }else if($theme_option['paypal_active'] == 0){
    $status = 'free';
  }
  

  $wpdb->query('CREATE TABLE IF NOT EXISTS `imevent_payments` (
            `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `buyer_email` TEXT NOT NULL,
            `price` TEXT NOT NULL,
            `currency` TEXT NOT NULL,
            `status` TEXT NOT NULL,
            `payment_type` TEXT NOT NULL,            
            `order_id` TEXT NOT NULL,
            `transaction_id` TEXT NOT NULL,
            `sumary` TEXT NOT NULL,
            `buyer_info` TEXT NOT NULL,
            `created` INT( 4 ) UNSIGNED NOT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ;');

  if(trim($userinfo) == ''){
    echo 'false';
    return false;
  }

  $price_plan_information = array(
    'buyer_email' => $register_emailclient,
    'price'       =>'',
    'currency'    => '',
    'status'      => esc_attr($status),
    'payment_type' => '',
    'order_id'    => esc_attr($orderid),
    'transaction_id'  => '',
    'sumary'      => '',
    'buyer_info'  => esc_attr($userinfo),
    'created'     => time()
    );

  $insert_format = array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');
  $wpdb->insert('imevent_payments', $price_plan_information, $insert_format);

  if($status == 'free' && trim($theme_option['register_email_free']) != ''){

    $body_email = str_replace('[orderid]',$orderid, $theme_option['register_patter_template_free']);
    $body_email = str_replace('[userinfo]', str_replace('|||','',$userinfo), $body_email);
    

    $multiple_to_recipients = array($theme_option['register_email_free'], $register_emailclient);         

    $subject = $theme_option['register_patter_template_free_subject'];
    $body    = $body_email;
    $headers = __('From website', TEXT_DOMAIN) . "\r\n";
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                              
    wp_mail($multiple_to_recipients, $subject, $body, $headers);
  }

  echo 'true';
  die(); // stop executing script
}
add_action( 'wp_ajax_ajax_action', 'ajax_action_stuff' ); // ajax for logged in users
add_action( 'wp_ajax_nopriv_ajax_action', 'ajax_action_stuff' );

/* Change for email from when send mail */
add_filter( 'wp_mail_from', 'register_wp_mail_from' );
function register_wp_mail_from( $original_email_address ) {
  global $theme_option;
  return $theme_option['register_email_free'];
}
/* Change for name of email */
add_filter( 'wp_mail_from_name', 'register_wp_mail_from_name' );
function register_wp_mail_from_name( $original_email_from ) {
  global $theme_option;
  return $theme_option['register_patter_template_free_name'];
}



/* Updated in version 2.6 */
function create_table_payment(){
  global $wpdb;
  $wpdb->query('CREATE TABLE IF NOT EXISTS `imevent_payments` (
            `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `buyer_email` TEXT NOT NULL,
            `price` TEXT NOT NULL,
            `currency` TEXT NOT NULL,
            `status` TEXT NOT NULL,
            `payment_type` TEXT NOT NULL,            
            `order_id` TEXT NOT NULL,
            `transaction_id` TEXT NOT NULL,
            `sumary` TEXT NOT NULL,
            `buyer_info` TEXT NOT NULL,
            `created` INT( 4 ) UNSIGNED NOT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ;');
}
add_action( 'init', 'create_table_payment' );
/* /Updated in version 2.6 */



/*==========================================================================
Fix Youtube
==========================================================================*/
add_filter( 'oembed_result', 'pgl_framework_fix_oembeb' );
function pgl_framework_fix_oembeb( $url ){
    $array = array (
        'webkitallowfullscreen'     => '',
        'mozallowfullscreen'        => '',
        'frameborder="0"'           => '',
        '</iframe>)'        => '</iframe>'
    );
    $url = strtr( $url, $array );

    if ( strpos( $url, "<embed src=" ) !== false ){
        return str_replace('</param><embed', '</param><param name="wmode" value="opaque"></param><embed wmode="opaque" ', $url);
    }
    elseif ( strpos ( $url, 'feature=oembed' ) !== false ){
        return str_replace( 'feature=oembed', 'feature=oembed&amp;wmode=opaque', $url );
    }
    else{
        return $url;
    }
}

/* Visual Composer */
if(function_exists('vc_add_param')){

  $attributes = array(

    array("type" => "textfield",
          "heading" => __('Section ID', TEXT_DOMAIN),
          "param_name" => "section_id",
          "value" => "",
          "description" => __("Set ID section. Only use lowercase word. For example: about", TEXT_DOMAIN)),
    array("type" => "colorpicker",
        "heading" => esc_html__('Background pattern color ', 'ovathemecuatoi'),
        "param_name" => 'ova_bg_pattern',
        "default" => ''
    )
  );

  vc_add_params( 'vc_row', $attributes );
  vc_remove_param('vc_row', 'el_id');
  
}

add_filter('wp_title', 'filter_pagetitle');
function filter_pagetitle( $title, $sep ) {
  global $paged, $page, $wp_query;

  if ( is_feed() ) {
    return $title;
  }

  // Add the blog name.
  $title .= get_bloginfo( 'name' );

  $seo_title = get_post_meta($wp_query->get_queried_object_id(), "_cmb_seo_title", true);
  if($seo_title){
    $title .= $sep.$seo_title;
  }

  // Add the blog description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );


  if ( $site_description && ( is_home() || is_front_page() ) ) {
    $title = "$title $sep $site_description";
  }

  // Add a page number if necessary.
  if ( $paged >= 2 || $page >= 2 ) {
    $title = "$title $sep " . sprintf( esc_html__( 'Page %s', TEXT_DOMAIN ), max( $paged, $page ) );
  }

  return $title;
}
add_filter( 'wp_title', 'filter_pagetitle', 10, 2 );




add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_single_add_to_cart_text' );  // 2.1 +
  
function woo_custom_single_add_to_cart_text() {
  
    return __( 'My Button Text', 'woocommerce' );
  
}



function removeDemoModeLink() { // Be sure to rename this function to something more unique
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
    }
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
    }
}
add_action('init', 'removeDemoModeLink');


require_once dirname( __FILE__ ) . '/framework/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );

function my_theme_register_required_plugins() {
    $plugins = array(


        array(
            'name'                     => 'Contact Form 7',
            'slug'                     => 'contact-form-7',
            'required'                 => true,
        ),
        array(
            'name'                     => 'Redux Framework',
            'slug'                     => 'redux-framework',
            'required'                 => true,
        ),
        array(
            'name'                     => 'Woocommerce',
            'slug'                     => 'woocommerce',
            'required'                 => true,
        ),
        array(
            'name'                     => 'WPBakery Visual Composer',
            'slug'                     => 'js_composer',
            'required'                 => true,
            'source'                   => get_template_directory() . '/framework/plugins/js_composer.zip',
        ),
        
        array(
            'name'                     => 'ImEvent Common',
            'slug'                     => 'imevent-common',
            'required'                 => true,
            'source'                   => get_template_directory() . '/framework/plugins/imevent-common.zip',
        )


    );

    /*
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'theme-slug' ),
            'menu_title'                      => __( 'Install Plugins', 'theme-slug' ),
            'installing'                      => __( 'Installing Plugin: %s', 'theme-slug' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'theme-slug' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'theme-slug' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'theme-slug' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'theme-slug' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'theme-slug' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'theme-slug' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'theme-slug' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'theme-slug' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'theme-slug' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'theme-slug' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'theme-slug' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'theme-slug' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'theme-slug' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'theme-slug' ), // %s = dashboard link.
            'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );

}

function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);
   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return $rgb; // returns an array with the rgb values
}


add_action('wp_head', 'imevent_primary_color');
function imevent_primary_color(){ ?>

         <style type="text/css">

            <?php
                global $theme_option;
                $parallax_overlay = hex2rgb($theme_option['theme_color']);
                $main_color= $theme_option['theme_color'] ? $theme_option['theme_color'] : '#dc143c';
                $menu_font_color = $theme_option['menu_font_color'] ? $theme_option['menu_font_color'] : '#ffffff';
                $menu_font_color_hover = $theme_option['menu_font_color_hover'] ? $theme_option['menu_font_color_hover']: '#ffffff';
                $background_menu_hover = $theme_option['background_menu_hover']['rgba'] ? $theme_option['background_menu_hover']['rgba']: '#cccccc';
                $menu_font_color_scroll = $theme_option['menu_font_color_scroll'] ? $theme_option['menu_font_color_scroll'] : '#ffffff';
                $menu_font_color_hover_scroll = $theme_option['menu_font_color_hover_scroll'] ? $theme_option['menu_font_color_hover_scroll'] : '#fff';
                $background_submenu = $theme_option['background_submenu'] ? $theme_option['background_submenu'] : '#cccccc';
                $background_multi_page = $theme_option['background_multi_page'] ? $theme_option['background_multi_page'] : '#cccccc';
            ?>

            /* RED 2 */
            #preloader {
              background-color: #ffffff;
            }
            .spinner {
              background: #ffffff;
              box-shadow: inset 0 0 0 0.12em rgba(0, 0, 0, 0.2);
              background: -webkit-linear-gradient(<?php echo esc_attr($main_color); ?> 50%, #353535 50%), -webkit-linear-gradient(#353535 50%, <?php echo esc_attr($main_color); ?> 50%);
              background: linear-gradient(<?php echo esc_attr($main_color); ?> 50%, #353535 50%), linear-gradient(#353535 50%, <?php echo esc_attr($main_color); ?> 50%);
            }
            .spinner:after {
              border: 0.9em solid #ffffff;
            }
            body {
              background: #fbfbfb;
              color: #6d7a83;
            }
            .wide .page-section.light,.boxednew .page-section.light{
              background-color: #f5f5f5;
              color: #435469;
            }
            .color,.wide .page-section.color,.boxednew .page-section.color {
              background-color: <?php echo esc_attr($main_color); ?>;
              color: #ffffff;
            }
            h1,h2,h3,h4,h5,h6 { color: #141f23;}
            h1 .fa,h2 .fa,h3 .fa,h4 .fa,h5 .fa,h6 .fa,h1 .glyphicon,h2 .glyphicon,h3 .glyphicon,h4 .glyphicon,h5 .glyphicon,h6 .glyphicon {
              color: #e71f16;
            }
            .section-title {
              color: #0d1d31;
            }
            .section-title small {
              color: #374146;
            }
            .dark .section-title,.dark .section-title small,.color .section-title,.color .section-title small {
              color: #ffffff;
            }
            .body-dark .color .section-title small{
              color: #435469;
            }
            .color .section-title:after {
              color: #141f23;
            }
            .section-title .fa-stack .fa {
              color: #ffffff;
            }
            .color .section-title .fa-stack .fa {
              color: <?php echo esc_attr($main_color); ?>;
            }
            .section-title .rhex {
              background-color: <?php echo esc_attr($main_color); ?>;
            }
            .color .section-title .rhex {
              background-color: #ffffff;
            }
            .rhex {
              background-color: <?php echo esc_attr($main_color); ?>;
            }
            a {
              color: <?php echo esc_attr($main_color); ?>;
            }
            a:hover,a:active,a:focus {
              color: #000000;
            }
            .color a {
              color: #ffffff;
            }
            .color a:hover,.color a:active,.color a:focus {
              color: #000000;
            }
            .dropcap {
              color: #e71f16;
            }
            .text-lg {
              color: #141f23;
            }
            .page-header {
              color: #515151;
            }
            .page-header h1 {
              color: #515151;
            }
            .page-header h1 small {
              color: #6f6f6f;
            }
            hr.page-divider {
              border-color: #eeeeee;
            }
            hr.page-divider:after {
              border-bottom: solid 1px #eeeeee;
            }
            hr.page-divider.single {
              border-color: #646464;
            }
            .btn-theme {
              color: #ffffff;
              background-color: <?php echo esc_attr($main_color); ?>;
              border-color: <?php echo esc_attr($main_color); ?>;
            }
            .btn-theme:hover {
              background-color: #435469;
              border-color: #435469;
              color: #ffffff;
            }
            .color .btn-theme {
              color: <?php echo esc_attr($main_color); ?>;
              background-color: #ffffff;
              border-color: #ffffff;
            }
            .color .btn-theme:hover {
              background-color: #435469;
              border-color: #435469;
              color: #ffffff;
            }
            .btn-theme-transparent,
            .btn-theme-transparent:focus,
            .btn-theme-transparent:active {
              background-color: transparent;
              border-color: <?php echo esc_attr($main_color); ?>;
              color: <?php echo esc_attr($main_color); ?>;
            }
            .btn-theme-transparent:hover {
              background-color: #435469;
              border-color: #435469;
              color: #ffffff;
            }
            .btn-theme-transparent-grey,
            .btn-theme-transparent-grey:focus,
            .btn-theme-transparent-grey:active {
              background-color: transparent;
              border-color: #435469;
              color: #435469;
            }
            .btn-theme-transparent-grey:hover {
              background-color: #435469;
              border-color: #435469;
              color: #ffffff;
            }
            .btn-theme-transparent-white,
            .btn-theme-transparent-white:focus,
            .btn-theme-transparent-white:active {
              background-color: transparent;
              border-color: #ffffff;
              color: #ffffff;
            }
            .btn-theme-transparent-white:hover {
              background-color: #435469;
              border-color: #435469;
              color: #ffffff;
            }
            .btn-theme-grey {
              background-color: #f5f5f5;
              border-color: #e8e8e8;
              color: #e71f16;
            }
            .btn-theme-grey:hover,
            .btn-theme-grey:focus,
            .btn-theme-grey:active {
              background-color: #435469;
              border-color: #435469;
              color: #ffffff;
            }
            .form-control {
              border: 1px solid #c8cdd2;
              color: #6d7a83;
            }
            .form-control:focus {
              border-color: <?php echo esc_attr($main_color); ?>;
            }
            .bootstrap-select > .selectpicker {
              border: 1px solid #c8cdd2;
              color: #6d7a83 !important;
              background-color: #ffffff !important;
            }
            .bootstrap-select > .selectpicker:focus {
              border-color: <?php echo esc_attr($main_color); ?>;
            }
            .registration-form .tooltip-inner {
              background-color: <?php echo esc_attr($main_color); ?>;
            }
            .registration-form .tooltip-arrow {
              border-top-color: <?php echo esc_attr($main_color); ?>;
            }
            .registration-form .tooltip.top .tooltip-arrow {
              border-top-color: <?php echo esc_attr($main_color); ?>;
            }
            .sub-page .header {
              background-color: #81868c;
            }
            .home.sub-page .header{
              background-color: transparent;
            }
            .home.blog .header{
              background-color: #81868c;
            }

            .wide .header.shrink,
            .boxednew .header.shrink  {
              background-color: rgba(129, 134, 140, 0.8);
            }
            .logo a {
              color: #ffffff;
            }
            .logo a:hover {
              color: <?php echo esc_attr($main_color); ?>;
            }
            .logo a .logo-hex {
              background-color: <?php echo esc_attr($main_color); ?>;
            }
            .logo a:hover .logo-hex {
              background-color: #ffffff;
            }
            .logo a .logo-fa {
              color: #ffffff;
            }
            .logo a:hover .logo-fa {
              color: <?php echo esc_attr($main_color); ?>;
            }
           
            .sf-menu li.active {
              background-color: rgba(13, 29, 49, 0.3);
            }
            .sf-menu li.active > a {
              color: #ffffff;
            }
            .sf-menu ul li {
              background: #f2f2f2;
            }
            .sf-arrows .sf-with-ul:after {
              border-top-color: #9e9e9e;
            }
            .sf-arrows > li > .sf-with-ul:focus:after,
            .sf-arrows > li:hover > .sf-with-ul:after,
            .sf-arrows > .sfHover > .sf-with-ul:after {
              border-top-color: <?php echo esc_attr($main_color); ?>;
            }
            .sf-arrows ul .sf-with-ul:after {
              border-left-color: #9e9e9e;
            }
            .sf-arrows ul li > .sf-with-ul:focus:after,
            .sf-arrows ul li:hover > .sf-with-ul:after,
            .sf-arrows ul .sfHover > .sf-with-ul:after {
              border-left-color: <?php echo esc_attr($main_color); ?>;
            }
            .menu-toggle {
              color: #ffffff !important;
            }
            @media (max-width: 991px) {
              .navigation {
                background-color: rgba(13, 29, 49, 0.95);
              }
            }
            @media (max-width: 991px) {
              .mobile-submenu {
                background-color: <?php echo esc_attr($main_color); ?>;
              }
            }
            #main-slider.owl-theme .owl-controls .owl-buttons .owl-prev,
            #main-slider.owl-theme .owl-controls .owl-buttons .owl-next {
              color: #ffffff;
              text-shadow: 1px 1px 0 #141f23;
            }
            #main-slider.owl-theme .owl-controls .owl-buttons .owl-prev:hover,
            #main-slider.owl-theme .owl-controls .owl-buttons .owl-next:hover {
              color: <?php echo esc_attr($main_color); ?>;
            }
            #main-slider .caption-title {
              color: #ffffff;
              text-shadow: 1px 1px #000000;
            }
            #main-slider .caption-title span:before,
            #main-slider .caption-title span:after {
              border-top: solid 1px #ffffff;
              border-bottom: solid 1px #ffffff;
            }
            #main-slider .caption-subtitle {
              color: #ffffff;
              text-shadow: 1px 1px #000000;
            }
            #main-slider .caption-subtitle .fa {
              color: #ffffff;
            }
            #main-slider .caption-subtitle span {
              color: #253239;
            }
            #main-slider .caption-text {
              color: #8c8e93;
            }
            .form-background {
              background-color: #0d1d31;
            }
            .form-header {
              background-color: <?php echo esc_attr($main_color); ?>;
            }
            .text-holder:before,
            .text-holder:after {
              border-top: solid 1px #ffffff;
              border-bottom: solid 1px #ffffff;
            }
            .btn-play {
              border: solid 1px #ffffff;
              background-color: rgba(255, 255, 255, 0.3);
            }
            .btn-play .fa {
              background-color: #ffffff;
              color: <?php echo esc_attr($main_color); ?>;
            }
            .btn-play:hover {
              border-color: <?php echo esc_attr($main_color); ?>;
            }
            .btn-play:hover .fa {
              background-color: <?php echo esc_attr($main_color); ?>;
            }
            .btn-play:hover .fa {
              color: #ffffff;
            }

            .event-background {
              background-color: #0d1d31;
            }
            .event-description {
              color: #ffffff;
            }
            .event-description .media-heading {
              color: #d01c14;
            }
            .img-carousel .owl-controls .owl-page span,
            .img-carousel .owl-controls .owl-buttons div {
              background-color: <?php echo esc_attr($main_color); ?>;
            }
            /* 3.4 - Partners carousel / Owl carousel
            /* ========================================================================== */
            .partners-carousel .owl-carousel div a {
              background-color: #f3f4f5;
            }
            .partners-carousel .owl-prev,
            .partners-carousel .owl-next {
              border: solid 1px #435469;
              color: #435469;
            }
            .partners-carousel .owl-prev .fa,
            .partners-carousel .owl-next .fa {
              color: #435469;
            }
            .partners-carousel .owl-prev:hover,
            .partners-carousel .owl-next:hover {
              border-color: <?php echo esc_attr($main_color); ?>;
              color: <?php echo esc_attr($main_color); ?>;
            }
            .partners-carousel .owl-prev:hover .fa,
            .partners-carousel .owl-next:hover .fa {
              color: <?php echo esc_attr($main_color); ?>;
            }
            .page-section.breadcrumbs {
              background-color: #f9f9f9;
            }
            .breadcrumbs .breadcrumb:after {
              background-color: #e1e1e1;
            }
            .schedule-wrapper {
              border: solid 1px #435469;
              border-bottom-width: 10px;
            }
            .schedule-tabs.lv1 {
              background-color: #435469;
              color: #ffffff;
            }
            .schedule-tabs.lv2 {
              border: solid 1px #8598b0;
              background-color: #ffffff;
            }
            .schedule-wrapper .schedule-tabs.lv1 .nav > li > a {
              color: #ffffff;
            }
            .schedule-wrapper .schedule-tabs.lv1 .nav > li.active:before {
              border-top: 7px solid #435469;
            }
            .schedule-wrapper .schedule-tabs.lv2 .nav > li > a {
              color: #293239;
            }
            .schedule-wrapper .schedule-tabs.lv2 .nav > li.active > a {
              color: <?php echo esc_attr($main_color); ?>;
            }
            .schedule-wrapper .schedule-tabs.lv2 .nav > li.active:before {
              background-color: <?php echo esc_attr($main_color); ?>;
            }
            .row.faq .tab-content {
              border: solid 1px #435469;
              background-color: #fdfdfd;
            }
            @media (min-width: 768px) {
              .row.faq .tab-content:before {
                border-right: 10px solid #435469;
              }
              .row.faq .tab-content:after {
                border-right: 10px solid #fdfdfd;
              }
            }
            .row.faq .nav li a {
              border: solid 1px #435469;
              background-color: #fdfdfd;
              color: #374146;
            }
            .row.faq .nav li.active a,
            .row.faq .nav li a:hover {
              background-color: <?php echo esc_attr($main_color); ?>;
              border-color: <?php echo esc_attr($main_color); ?>;
              color: #ffffff;
            }
            .post-title {
              color: #0d1d31;
            }
            .post-title a {
              color: #0d1d31;
            }
            .post-title a:hover {
              color: <?php echo esc_attr($main_color); ?>;
            }
            .post-header .post-meta {
              color: <?php echo esc_attr($main_color); ?>;
            }
            .post-header .post-meta a,
            .post-header .post-meta .fa {
              color: #435469;
            }
            .post-header .post-meta a:hover {
              color: <?php echo esc_attr($main_color); ?>;
            }
            .post-readmore .btn {
              border-color: #435469;
              color: #435469;
            }
            .post-readmore .btn:hover,
            .post-readmore .btn:focus {
              background-color: #435469;
              border-color: #435469;
              color: #ffffff;
            }
            .post-meta-author a {
              color: #464c4e;
            }
            .post-meta-author a:hover {
              color: #000000;
            }
            .post-type {
              background-color: rgba(255, 255, 255, 0.8);
            }
            .post + .post {
              border-top: solid 1px #efefef;
            }
            .about-the-author {
              border-top: solid 1px #efefef;
            }
            .timeline .media-body {
              background-color: #ffffff;
            }
            .timeline .post-media {
              border: solid 8px #afb4ba;
            }
            .timeline .no.post-media {
              border: none;
            }
            .timeline .post-title {
              color: <?php echo esc_attr($main_color); ?>;
              border-bottom: solid 1px #d2d2dc;
            }
            .timeline .post-title a {
              color: <?php echo esc_attr($main_color); ?>;
            }
            .body-dark .timeline .post-title a{
              color: #fff;
            }
            .timeline .post-title a:hover {
              color: #000000;
            }
            .timeline .post-meta a .fa {
              color: <?php echo esc_attr($main_color); ?>;
            }
            .timeline .post-meta a:hover .fa {
              color: #293239;
            }
            .timeline .post-readmore {
              color: #293239;
            }
            .timeline .post-readmore a {
              color: #293239;
            }
            .timeline .post-readmore a:hover {
              color: <?php echo esc_attr($main_color); ?>;
            }
            .comments {
              border-top: solid 1px #efefef;
            }
            .comment-date {
              color: #b0afaf;
            }
            .comment-reply {
              border-bottom: solid 1px #efefef;
            }
            .comments-form {
              border-top: solid 1px #efefef;
            }
            .pagination-wrapper {
              border-top: solid 1px #efefef;
            }
            .pagination > li > a {
              background-color: #f5f5f5;
              color: #253239;
            }
            .pagination > li > a:hover,
            .pagination > li > span:hover,
            .pagination > li > a:focus,
            .pagination > li > span:focus {
              background-color: <?php echo esc_attr($main_color); ?>;
              color: #ffffff;
            }
            .pagination > .active > a,
            .pagination > .active > span,
            .pagination > .active > a:hover,
            .pagination > .active > span:hover,
            .pagination > .active > a:focus,
            .pagination > .active > span:focus {
              background-color: <?php echo esc_attr($main_color); ?>!important;
              border-color: <?php echo esc_attr($main_color); ?>!important;
            }

            .project-details .dl-horizontal dt {
              color: #3c4547;
            }
            .thumbnail.hover,
            .thumbnail:hover {
              border: solid 1px <?php echo esc_attr($main_color); ?>;
            }
            .thumbnail .caption.hovered {
              background-color: rgba(<?php echo esc_attr($parallax_overlay[0]); ?>,<?php echo esc_attr($parallax_overlay[1]); ?>, <?php echo esc_attr($parallax_overlay[2]); ?>, 0.5);  
              color: #ffffff;
            }
            .caption-title {
              color: #0d1d31;
            }
            .hovered .caption-title {
              color: #ffffff;
            }
            .caption-buttons .btn {
              color: #ffffff;
            }
            .caption-category {
              color: <?php echo esc_attr($main_color); ?>;
            }
            .caption-redmore {
              color: #c4334b;
            }
            .caption-redmore:hover {
              color: #000000;
            }
            .testimonial .media-heading {
              color: #0d1d31;
            }
            .color .testimonials.owl-theme .owl-dots .owl-dot span {
              background-color: <?php echo esc_attr($main_color); ?>;
              border: solid 2px #ffffff;
            }
            .color .testimonials.owl-theme .owl-dots .owl-dot.active span,
            .color .testimonials.owl-theme .owl-dots .owl-dot:hover span {
              background-color: #ffffff;
            }
            .wide .footer-meta,
            .boxednew .footer-meta  {
              background-color: #f5f5f5;
              color: #414650;
            }
            .footer .widget-title {
              color: #ffffff;
            }
            .sidebar .widget-title small {
              color: #999999;
            }
            .footer .widget-title small {
              color: #818181;
            }
            .widget-title:before {
              background-color: <?php echo esc_attr($main_color); ?>;
            }
            #af-form .form-control {
              background-color: #ffffff;
              border-color: #ffffff;
              color: #ffffff;
            }
            #af-form .form-control:focus {
              border-color: <?php echo esc_attr($main_color); ?>;
            }
            #af-form .alert {
              border-color: <?php echo esc_attr($main_color); ?>;
              background-color: <?php echo esc_attr($main_color); ?>;
              color: #ffffff;
            }
            #af-form .tooltip-inner {
              background-color: #000000;
            }
            #af-form .tooltip-arrow {
              border-top-color: #000000;
            }
            .form-button-reset {
              color: #253239;
              background-color: #f5f5f5;
              border-color: #e8e8e8;
            }
            .form-button-reset:focus,
            .form-button-reset:hover {
              color: #ffffff;
              background-color: #999999;
              border-color: #999999;
            }
            .color #af-form .form-control {
              border-color: #ffffff;
              background-color: rgba(2, 2, 2, 0.2);
            }
            .color #af-form .form-control:focus {
              background-color: rgba(2, 2, 2, 0.5);
            }
            .social-line a {
              background-color: #c3c3c3;
              color: #ffffff;
            }
            .social-line a:before {
              border-bottom: 10px solid #c3c3c3;
            }
            .social-line a:after {
              border-top: 10px solid #c3c3c3;
            }
            .price-table {
              border: solid 1px #0d1d31;
            }
            .price-label {
              background-color: #f5f5f5;
              color: #475056;
            }
            .price-label-title {
              color: #475056;
            }
            .price-value {
              color: <?php echo esc_attr($main_color); ?>;
            }
            .price-table-row {
              color: #6d7a83;
              border-top: solid 1px #c5c7c9;
            }
            .price-table-row-bottom {
              border-top: solid 1px #c5c7c9;
            }
            .price-table.featured {
              border-color: <?php echo esc_attr($main_color); ?>;
            }
            .price-table.featured:before {
              background-color: <?php echo esc_attr($main_color); ?>;
              color: #ffffff;
            }
            .container.gmap-background .on-gmap.color {
              background-color: <?php echo esc_attr($main_color); ?>;
              color: #fefefe;
            }
            .parallax h1,
            .parallax h2,
            .parallax h3,
            .parallax h4,
            .parallax h5,
            .parallax h6 {
              color: #ffffff;
            }
            .parallax .block-text {
              color: #ffffff;
            }
            .parallax-inner {
              color: #ffffff;
            }
            .error-number {
              color: #0d1d31;
            }
            .to-top {
              background-color: #373737;
              color: #9f9197;
            }
            .to-top:hover {
              background-color: <?php echo esc_attr($main_color); ?>;
              color: #ffffff;
            }
            .btn-preview-light,
            .btn-preview-light:hover {
              border-color: #f5f5f5;
              background-color: <?php echo esc_attr($main_color); ?>;
            }
            .btn-preview-dark,
            .btn-preview-dark:hover {
              border-color: #f5f5f5;
              background-color: #0d1d31;
            }
            .sidebar .widget-title {
              color: <?php echo esc_attr($main_color); ?>;
            }
            .widget.categories li.active a,
            .widget.categories li a:hover {
              background-color: <?php echo esc_attr($main_color); ?>;
              color: #ffffff;
            }
            .about-the-author .media-heading {
              color: <?php echo esc_attr($main_color); ?>;
            }
            .comments-form .block-title {
              color: <?php echo esc_attr($main_color); ?> !important;
            }
            .error-page .logo a,
            .error-page .logo a:hover {
              color: #ffffff;
            }
            .error-page .logo a .logo-hex,
            .error-page .logo a:hover .logo-hex {
              background-color: #ffffff;
            }
            .error-page .logo a .logo-fa,
            .error-page .logo a:hover .logo-fa {
              color: <?php echo esc_attr($main_color); ?>;
            }
            /* dark version */
            .body-dark .section-title .rhex {
              background-color: <?php echo esc_attr($main_color); ?>;
            }
            .body-dark .color .section-title .rhex {
              background-color: <?php echo esc_attr($main_color); ?>;
            }
            .body-dark .form-background .section-title .rhex {
              background-color: #ffffff;
            }
            .body-dark .form-background .section-title .fa-stack-1x {
              color: <?php echo esc_attr($main_color); ?> !important;
            }
            .body-dark .color .btn-theme {
              background-color: <?php echo esc_attr($main_color); ?>;
              border-color: <?php echo esc_attr($main_color); ?>;
            }
            .body-dark .form-control:focus {
              border-color: #e71f16;
            }
            .body-dark .event-background {
              background-color: <?php echo esc_attr($main_color); ?>;
            }
            .body-dark .post-header .post-meta {
              color: <?php echo esc_attr($main_color); ?>;
            }
            .body-dark .pagination-wrapper {
              border-top: solid 1px #435469;
            }
            .body-dark .pagination > li > a {
              background-color: #435469 ;
              color: #f5f5f5;
            }
            .body-dark .pagination > li > a:hover,
            .body-dark .pagination > li > span:hover,
            .body-dark .pagination > li > a:focus,
            .body-dark .pagination > li > span:focus {
              background-color: <?php echo esc_attr($main_color); ?>;
              color: #ffffff;
            }
            .body-dark .pagination > .active > a,
            .body-dark .pagination > .active > span,
            .body-dark .pagination > .active > a:hover,
            .body-dark .pagination > .active > span:hover,
            .body-dark .pagination > .active > a:focus,
            .body-dark .pagination > .active > span:focus {
              background-color: <?php echo esc_attr($main_color); ?>;
              border-color: <?php echo esc_attr($main_color); ?>;
            }
            .body-dark .widget.categories li a {
              background-color: #435469;
              color: #f5f5f5;
            }
            .body-dark .widget.categories li.active a,
            .body-dark .widget.categories li a:hover {
              background-color: <?php echo esc_attr($main_color); ?>;
              color: #ffffff;
            }

            .tagcloud a:hover{
              background-color: <?php echo esc_attr($main_color); ?>;
              border-color: <?php echo esc_attr($main_color); ?>;
            }

            .speaker .caption-title a:hover{
             color: <?php echo esc_attr($main_color); ?>; 
            }
            .body-dark .speaker .caption-title a{
              color: #fff!important;
            }

            .error404.sub-page .header{
              background-color: <?php echo esc_attr($main_color); ?>;
              border-bottom: 1px solid #fff;
            }

            .error404 #preloader{
              display:none;
            }
            .error404 .logo a:hover{
              color:#fff;

            }
            .error404 .logo a .logo-hex{
              background-color:#fff;
            }
            .error404 .logo a .logo-fa{
              color: <?php echo esc_attr($main_color); ?>;
            }
            .error404 footer, .error404 .to-top{
              display:none;
            }

            .social-line a:hover{
              background-color: <?php echo esc_attr($main_color); ?>!important;
            }
            .social-line a:hover:before{
            border-bottom-color: <?php echo esc_attr($main_color); ?>!important;
            }
            .social-line a:hover:after{
              border-top-color: <?php echo esc_attr($main_color); ?>!important;
            }

            .single-schedule .post-readmore{
            text-align: left;
            }

            #sidebar ul,#sidebar li{
              list-style-type:none;
              padding-left: 0;
              margin-left:0;

            }
            .page-section.with-sidebar{
              padding-top: 170px;
            }


            /*************** Update css for version 2.0 ************************/
            .event-description .media-heading{
              color: <?php echo esc_attr($main_color); ?>!important;
            }

            /* fix for icon style of heading */

            .wohex, .crcle, .rhex {
            background-color: <?php echo esc_attr($main_color); ?>;
            }

            .color .wohex,.color .crcle {
            background-color: #fff;
            }

            .body-dark  .wohex, .body-dark .crcle, .body-dark  .rhex {
            background-color: <?php echo esc_attr($main_color); ?>;
            }


            #main-slider.owl-theme .owl-controls .owl-nav [class*=owl-]:hover{
              border-color: <?php echo esc_attr($main_color); ?>!important;
              background: <?php echo esc_attr($main_color); ?>!important;  
            }

            ul.pagination li span.current{
                background-color: <?php echo esc_attr($main_color); ?>;
              }


            /* Update for version 2.8 */

            .theme-color, 
            .primary-navbar > li > a:hover, 
            .primary-navbar > li > a:focus, 
            .primary-navbar > li > a:focus, 
            .testimonials-links .slider-btn:hover,
            .testimonials-links .slider-btn:focus, 
            .pricing-wrap:hover .theme-btn-2, 
            .navigation .dropdown-menu li a:hover, 
            .navigation .dropdown-menu li a:focus, 
            .pricing-wrap:focus .theme-btn-2, 
            .event-faqs-tabs li a:hover, 
            .event-faqs-tabs li a:focus, 
            .event-faqs-tabs li.active > a, 
            .slider_button:hover,
            .slider_button:focus, 
            .event-faqs-tabs li.active > a:hover, 
            .event-faqs-tabs li.active > a:focus, 
            .contact-form .theme-btn,
            .footer-social a:hover, 
            .footer-social a:focus, 
            .breadcrumb-menubar > li > a:hover, 
            .breadcrumb-menubar > li > a:focus, 
            .widget-wrap ul li.active a, 
            .comment-form input[type="submit"]:hover, 
            .comment-form input[type="submit"]:focus, 
            .blog-pagination li a, 
            .pricing-wrap.featured:hover::before, 
            .pricing-wrap.featured:focus::before, 
            .blog-post-wrap .post-title:hover, 
            .blog-post-wrap .post-title:focus{
                color: <?php echo esc_attr($main_color); ?>;
            }
            .object, 
            .theme-btn, 
            .theme-btn-big, 
            .theme-color-bg, 
            .event-schedule-wrap .schedule-tabs li.active a,
            .event-schedule-wrap .schedule-tabs li a:hover,
            .event-schedule-wrap .schedule-tabs li a:focus,
            .event-schedule-wrap .schedule-tabs > li.active > a,
            .event-schedule-wrap .schedule-tabs > li.active > a:hover, 
            .event-schedule-wrap .schedule-tabs > li.active > a:focus, 
            .social-overlay li a:hover, 
            .social-overlay li a:focus,
            .pricing-wrap:hover,
            .pricing-wrap:focus, 
            .register-bg,
            .contact-form .theme-btn:hover,
            .contact-form .theme-btn:focus, 
            .to-top,.comment-form input[type="submit"],
            .blog-pagination > .active > a,
            .blog-pagination > .active > a:hover, 
            .blog-pagination > .active > a:focus, 
            .blog-pagination > li > a:hover, 
            .blog-pagination > li > a:focus{
                background-color: <?php echo esc_attr($main_color); ?>;
            }
            .theme-btn:hover,.theme-btn:focus, 
            .theme-btn-big:hover,
            .theme-btn-big:focus,
            .donation-wrap .theme-btn:hover,
            .donation-wrap .theme-btn:focus{
                border-color: <?php echo esc_attr($main_color); ?>;
                color: #ffffff;
                background-color: <?php echo esc_attr($main_color); ?>;
            }

            .title-devider .line-1 ,
            .title-devider .line-2, 
            .title-devider .line-3, 
            .testimonials-links .slider-btn:hover,
            .testimonials-links .slider-btn:focus,
            .slider_button:hover, 
            .slider_button:focus, 
            .tagcloud > a:hover, 
            .tagcloud > a:focus,
            .post-previous a:hover, 
            .post-next a:hover,
            .post-previous a:focus,
            .post-next a:focus, 
            .comment-form input[type="submit"], 
            .comment-form input[type="submit"]:hover,
            .comment-form input[type="submit"]:focus,
            .blog-pagination li a, 
            .blog-pagination .active a,
            .blog-pagination > .active > a:hover, 
            .blog-pagination > .active > a:focus, 
            .blog-pagination > li > a:hover, 
            .blog-pagination > li > a:focus{
                border-color: <?php echo esc_attr($main_color); ?>;
            }
            .donation button:hover{
              background-color: <?php echo esc_attr($main_color); ?>;
              border-color: <?php echo esc_attr($main_color); ?>;
              color: #fff;
            }

            .bg_color .title-devider .line-1, 
            .bg_color .title-devider .line-2, 
            .bg_color .title-devider .line-3{
              border-color: #fff;
            }

            .theme-btn-big:hover,
            .theme-btn:hover{
              background:#fff;
              color: <?php echo esc_attr($main_color); ?>;
            }
            /* /Update for version 2.8 */
            .event-schedule-wrap .schedule-tabs > li:hover{
              background-color: <?php echo esc_attr($main_color); ?>;
            }

            .section-title.normal .fa-stack .fa.fa-stack-2x{
              color: <?php echo esc_attr($main_color); ?>;
              margin-top: 5px;
            }
            .section-title.normal .fa-stack .fa.fa-stack-1x{
              font-size: 70%;
            }
            .section-title.normal.color .fa-stack .fa.fa-stack-2x{
              color:#fff;
            }
            .valentine{
              margin-top: 5px;
            }

            .color .valentine{
              color:#fff!important;
            }


            .pricing_woo .woocommerce a.button{
              background-color: <?php echo esc_attr($main_color); ?>;
              border-color: <?php echo esc_attr($main_color); ?>;
            }
            .pricing_woo .woocommerce a.button:hover{
                background-color: #435469;
                border-color: #435469;
                color: #ffffff;
            }


            

            

            .sf-menu a{
              color: <?php echo esc_attr($menu_font_color); ?>;
            }

            .sf-menu a:hover{
              color: <?php echo esc_attr($menu_font_color_hover); ?>;
            }
            .wide .header.shrink, .boxednew .header.shrink{
              background-color: <?php echo esc_attr($background_menu_hover); ?>;
            }
            .wide .header.shrink .sf-menu a, .boxednew .header.shrink .sf-menu a{
              color: <?php echo esc_attr($menu_font_color_scroll); ?>;
            }
            .wide .header.shrink .sf-menu a:hover, .boxednew .header.shrink .sf-menu a:hover{
              color: <?php echo esc_attr($menu_font_color_hover_scroll); ?>;
            }

            .sf-menu ul.sub-menu li{
              background-color: <?php echo esc_attr($background_submenu); ?>
            }

            .sub-page .header{
              background-color: <?php echo esc_attr($background_multi_page); ?>
              
            }
            

         </style>
    <?php
}


