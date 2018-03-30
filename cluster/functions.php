<?php

/* Set Max Content Width ---------------------------------------------------*/
if ( ! isset( $content_width ) ) $content_width = 940;

/* Set Retina Cookie -------------------------------------------------------*/
global $is_retina;
(isset($_COOKIE['retina'])) ? $is_retina = true : $is_retina = false;

/*--------------------------------------------------------------------------*/
/* Theme Setup
/*--------------------------------------------------------------------------*/
if(!function_exists('stag_theme_setup')){
  function stag_theme_setup(){

    /* Load translation domain ---------------------------------------------*/
    load_theme_textdomain('stag', get_template_directory().'/languages');

    $locale = get_locale();
    $locale_file = get_template_directory()."/languages/$locale.php";
    if(is_readable($locale_file)){
      require_once($locale_file);
    }

    /* Register Menus ------------------------------------------------------*/
    register_nav_menu('primary-menu', __('Primary Menu', 'stag'));

    // This theme styles the visual editor with editor-style.css to match the theme style.
    add_editor_style( 'framework/assets/css/editor-style.css' );

    add_theme_support( 'post-thumbnails' );
    add_image_size( 'portfolio-thumbnail', 366, 267, true );

    // Adds RSS feed links to <head> for posts and comments.
    add_theme_support( 'automatic-feed-links' );

    /**
     * Add StagFramework specific theme support
     *
     * @uses Stagtools
     * @link http://wordpress.org/plugins/stagtools/
     * @author Ram Ratan Maurya
     * @since 1.1
     */
    add_theme_support( 'stag-portfolio' );

    /* Add support for post formats ----------------------------------------*/
    add_theme_support( 'post-formats', array('aside', 'gallery', 'image','link', 'quote', 'video', 'audio', 'status', 'chat') );
  }
}
add_action('after_setup_theme', 'stag_theme_setup');


/*-------------------------------------------------------------------------*/
/* Register Sidebars
/*-----------------------------------------------------------------------------*/
if(!function_exists('stag_sidebar_init')){
  function stag_sidebar_init(){

    register_sidebar(array(
      'name' => __('Blog Sidebar', 'stag'),
      'id' => 'sidebar-main',
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h3 class="widget-title">',
      'after_title'   => '</h3>',
      'description'   => __('Blog Widgets Area.', 'stag')
    ));

    register_sidebar(array(
      'name' => __('Homepage Sidebar 1', 'stag'),
      'id' => 'sidebar-homepage-1',
      'before_widget' => '<section id="%1$s" class="section-block %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h3 class="section-title">',
      'after_title'   => '</h3>',
      'description'   => __('Widgets Area for template Homepage 1.', 'stag')
    ));

    register_sidebar(array(
      'name' => __('Services Sidebar', 'stag'),
      'id' => 'sidebar-services',
      'before_widget' => '<div id="%1$s" class="grid-4 %2$s">',
      'after_widget'  => '</div>',
      'before_title'  => '<h4 class="service__title">',
      'after_title'   => '</h4>',
      'description'   => __('Services Widgets area, use only "Service Box" widget here.', 'stag')
    ));

    register_sidebar(array(
      'name' => __('Footer Widgets', 'stag'),
      'id' => 'sidebar-footer',
      'before_widget' => '<div class="grid-4 widget %2$s">',
      'after_widget'  => '</div>',
      'before_title'  => '<h3 class="widget-title">',
      'after_title'   => '</h3>',
      'description'   => __('Widget area for footer', 'stag')
    ));

  }
}
add_action('widgets_init', 'stag_sidebar_init');


/*-----------------------------------------------------------------------------*/
/* WordPress Title Filter
/*-----------------------------------------------------------------------------*/
if ( !function_exists( 'stag_wp_title' ) ) {
    function stag_wp_title($title, $sep) {
        if( !stag_check_third_party_seo() ){
            $title .= get_bloginfo( 'name' );

            $site_desc = get_bloginfo( 'description', 'display' );
            if( $site_desc && ( is_home() || is_front_page() ) ) {
                $title = "$title $sep $site_desc";
            }
        }
        return $title;
    }
}
add_filter('wp_title', 'stag_wp_title', 10, 2);


/*---------------------------------------------------------------------------------------------------------------------------------*/
/* Register and load scripts
/*---------------------------------------------------------------------------------------------------------------------------------*/
function stag_enqueue_scripts(){
  if ( ! is_admin() ) {
    global $is_IE;

    $protocol = ( is_ssl() ) ? 'https:' : 'http:';

    /* Enqueue Styles ---------------------------------------------------*/
    wp_dequeue_style( 'stag-shortcode-styles' );
    wp_enqueue_style( 'shortcode-styles', get_template_directory_uri().'/assets/css/shortcodes.css', '', STAG_THEME_VERSION );

    wp_enqueue_style( 'flexslider', get_template_directory_uri().'/assets/css/flexslider.css' );
    wp_enqueue_style( 'stag-style', get_stylesheet_uri() );

    $custom_styles = apply_filters( 'stag_custom_styles',  '' );
    wp_add_inline_style( 'stag-style', $custom_styles );

    wp_enqueue_style( 'cluster-icon-font', get_template_directory_uri().'/assets/fonts/fonts.css' );
    wp_enqueue_style( 'cluster-fonts', stag_google_font_url(), array(), null );

    /* Register Scripts ---------------------------------------------------*/
    wp_register_script( 'script', get_template_directory_uri().'/assets/js/jquery.custom.js', array('jquery', 'superfish'), '', true );
    wp_register_script( 'superfish', get_template_directory_uri().'/assets/js/superfish.js', array('jquery'), '', true );
    wp_register_script( 'flexslider', get_template_directory_uri().'/assets/js/jquery.flexslider-min.js', array('jquery'), '2.1', true );
    wp_register_script( 'stag-plugins', get_template_directory_uri().'/assets/js/plugins.js', array('jquery'), '', true );
    wp_register_script( 'jplayer', get_template_directory_uri() . '/assets/js/jquery.jplayer.min.js', array('jquery'), '2.9.2', true );
    wp_register_script( 'backstretch', get_template_directory_uri() . '/assets/js/jquery.backstretch.min.js', array('jquery'), '2.0.4', true );
    wp_register_script( 'fitvids', get_template_directory_uri() . '/assets/js/jquery.fitvids.js', array('jquery'), '1.1', true );
    wp_register_script( 'isotope', get_template_directory_uri() . '/assets/js/isotope.pkgd.min.js', array('jquery'), '3.0.1', true );


    /* Enqueue Scripts ---------------------------------------------------*/
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'script' );
    wp_enqueue_script( 'superfish' );
    wp_enqueue_script( 'flexslider' );

    if ( ! is_page_template( 'template-portfolio.php' ) || ! is_page() ) {
      wp_enqueue_script( 'jplayer' );
    }

    wp_enqueue_script( 'stag-plugins' );
    wp_enqueue_script( 'fitvids' );
    wp_enqueue_script( 'backstretch' );

    if ( is_page_template( 'template-portfolio.php' ) && stag_get_option( 'portfolio_style' ) == 'filterable' ) {
       wp_enqueue_script( 'isotope' );
    }

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ){
      wp_enqueue_script( 'comment-reply' ); // loads the javascript required for threaded comments
    }

    wp_localize_script('script', 'stag', array(
      'ajaxurl'   => admin_url('admin-ajax.php'),
      'nonce'     => wp_create_nonce('stag-ajax'),
      'menuIcon' => ( function_exists( 'stag_icon' ) ) ? stag_icon( array( 'icon' => 'reorder' ) ) : '',
      'gateway'   => get_template_directory_uri().'/includes/gateway.php'
    ));
  }
}
add_action('wp_enqueue_scripts', 'stag_enqueue_scripts');


/*---------------------------------------------------------------------------------------------------------------------------------*/
/* Admin Scripts
/*---------------------------------------------------------------------------------------------------------------------------------*/
function stag_admin_enqueue_scripts(){
  wp_enqueue_script('stag-custom-admin', get_template_directory_uri().'/includes/js/custom.admin.js', 'jquery');
}
add_action( 'admin_enqueue_scripts', 'stag_admin_enqueue_scripts' );


/* Pagination */
function pagination(){
  global $wp_query;
    $total_pages = $wp_query->max_num_pages;
    $big = 999999999;
    if($total_pages > 1){
      if ($total_pages > 1){
        $current_page = max(1, get_query_var('paged'));
        $return = paginate_links(array(
          'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
          'format' => '/page/%#%',
          'current' => $current_page,
          'total' => $total_pages,
          'prev_next' => false
          ));
        echo "<div class='pages'>{$return}</div>";
        }
  }else{
    return false;
  }
}

function stag_paging_nav() {
  global $wp_query;

  // Don't print empty markup if there's only one page.
  if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
    return;
  ?>
  <nav class="navigation paging-navigation" role="navigation">
    <?php echo pagination(); ?>
    <div class="nav-links">

      <?php if ( get_previous_posts_link() ) : ?>
      <div class="nav-previous"><?php previous_posts_link( __( '<i class="icon icon-arrow-left"></i>', 'stag' ) ); ?></div>
      <?php endif; ?>

      <?php if ( get_next_posts_link() ) : ?>
      <div class="nav-next"><?php next_posts_link( __( '<i class="icon icon-arrow-right"></i>', 'stag' ) ); ?></div>
      <?php endif; ?>

    </div><!-- .nav-links -->
  </nav><!-- .navigation -->
  <?php
}


/*-----------------------------------------------------------------------------*/
/* Stag Comment Styling
/*-----------------------------------------------------------------------------*/
function stag_comments($comment, $args, $depth) {

    $isByAuthor = false;

    if($comment->comment_author_email == get_the_author_meta('email')) {
        $isByAuthor = true;
    }

    $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>" class="the-comment">

     <div class="comment-body clearfix">
        <div class="avatar-wrap">
          <?php
            global $is_retina;
            if($is_retina){
              echo get_avatar($comment,$size='140');
            }else{
              echo get_avatar($comment,$size='70');
            }
          ?>
        </div>
        <div class="comment-area">
            <div class="row">
              <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
              <p class="comment-author"><?php echo get_comment_author_link(); ?></p>
              <time datetime="<?php comment_time( 'c' ); ?>" class="comment-date">
                <?php echo human_time_diff( get_comment_time('U'), current_time('timestamp') ) .' '. __('ago', 'stag'); ?>
              </time>
            </div>
            <?php if ($comment->comment_approved == '0') : ?>
               <em class="moderation"><?php _e('Your comment is awaiting moderation.', 'stag') ?></em>
            <?php endif; ?>
            <div class="comment-text">
              <?php comment_text() ?>
            </div>
        </div>
      </div>

     </div>
   </li>

<?php
}

function stag_list_pings($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
<?php }


/* A little math stuff ---------------------------------------------------*/
function is_multiple($number, $multiple){
  return ($number % $multiple) == 0;
}

/*-----------------------------------------------------------------------------------*/
/*  Allow shortcodes in Text Widgets
/*-----------------------------------------------------------------------------------*/
add_filter('widget_text', 'shortcode_unautop');
add_filter('widget_text', 'do_shortcode');

/**
 * @package StagFramework
 * @subpackage Cluster
 * @param bool $postid - Post ID
 * @return Audio Player
 */
function stag_audio_player($postid){
  $mp3 = get_post_meta($postid, '_stag_audio_mp3', true);
  $ogg = get_post_meta($postid, '_stag_audio_oga', true);

  // I can guarantee you some safety
  if($mp3 === "" && $ogg === "") return;

  ?>

  <script type="text/javascript">

  jQuery(document).ready(function($){
    if( $().jPlayer ){
      $('#jquery-jplayer-audio-<?php echo $postid; ?>').jPlayer({
        ready: function(){
          $(this).jPlayer("setMedia", {
            <?php if($mp3 != '') : ?>
            mp3: "<?php echo $mp3; ?>",
            <?php endif; ?>
            <?php if($ogg != '') : ?>
            oga: "<?php echo $ogg; ?>",
            <?php endif; ?>
            end: ""
          });
        },
        play: function() { // To avoid both jPlayers playing together.
          $(this).jPlayer("pauseOthers");
        },
        swfPath: "<?php echo get_template_directory_uri(); ?>/assets/js",
        cssSelectorAncestor: "#jp-audio-interface-<?php echo $postid; ?>",
        supplied: "<?php if($ogg != '') : ?>oga,<?php endif; ?><?php if($mp3 != '') : ?>mp3<?php endif; ?>",
      });
    }
  });

  </script>

  <div id="jp-container-<?php echo $postid; ?>" class="jp-audio">
    <div class="jp-type-single">
      <div id="jquery-jplayer-audio-<?php echo $postid; ?>" class="jp-jplayer"></div>
      <div id="jp-audio-interface-<?php echo $postid; ?>" class="jp-interface">
          <ul class="jp-controls">
              <li><a href="#" class="jp-play" tabindex="1" title="play"><i class="icon icon-play"></i></a></li>
              <li><a href="#" class="jp-pause" tabindex="1" title="pause"><i class="icon icon-pause"></i></a></li>
              <li><a href="#" class="jp-mute" tabindex="1" title="mute"><i class="icon icon-volume"></i></a></li>
              <li><a href="#" class="jp-unmute" tabindex="1" title="unmute"><i class="icon icon-volume"></i></a></li>
              <li><a href="#" class="jp-duration" tabindex="1" title="duration"></a></li>
          </ul>
          <div class="jp-progress">
              <div class="jp-seek-bar">
                  <div class="jp-play-bar"></div>
              </div>
          </div>
          <div class="jp-volume-bar">
              <div class="jp-volume-bar-value"></div>
          </div>
      </div>
    </div>
  </div>

  <?php

}

/**
 * @package StagFramework
 * @subpackage Cluster
 * @param bool $postid - Post ID
 * @return Video Player
 */
function stag_video_player($postid){
  $m4v = get_post_meta(get_the_ID(), '_stag_video_m4v', true);
  $ogv = get_post_meta(get_the_ID(), '_stag_video_ogv', true);

  if($m4v === "" && $ogv === "") return;

  ?>
  <script type="text/javascript">
  jQuery(document).ready(function($){

    if( $().jPlayer ) {
      $("#jquery-jplayer-video-<?php echo $postid; ?>").jPlayer({
        ready: function(){
          $(this).jPlayer("setMedia",{
            <?php if( $m4v != '' ) : ?>
            m4v: "<?php echo $m4v; ?>",
            <?php endif; ?>
            <?php if( $ogv != '' ) : ?>
            ogv: "<?php echo $ogv; ?>",
            <?php endif; ?>
          });
        },
        size: {
          cssClass: "jp-video-normal",
          width: "100%",
        },
        autohide:{
          restored: false,
          full: true
        },
        play: function() { // To avoid both jPlayers playing together.
          $('#jp-video-container-<?php echo $postid; ?> .jp-jplayer').css('padding-bottom', '56.25%');
        },
        swfPath: "<?php echo get_template_directory_uri(); ?>/assets/js",
        cssSelectorAncestor: "#jp-video-container-<?php echo $postid; ?>",
        supplied: "<?php if($m4v != '') : ?>m4v, <?php endif; ?><?php if($ogv != '') : ?>ogv<?php endif; ?>"
      });
    }

  });
  </script>

  <div id="jp-video-container-<?php echo $postid; ?>" class="jp-video jp-video-normal">
      <div class="jp-type-single">
          <div id="jquery-jplayer-video-<?php echo $postid; ?>" class="jp-jplayer" data-orig-width="700" data-orig-height="300"></div>
          <div class="jp-gui">
          <div id="jp-video-interface-<?php echo $postid; ?>" class="jp-interface">
              <ul class="jp-controls">
                  <li><a href="#" class="jp-play" tabindex="1"><i class="icon-play"></i></a></li>
                  <li><a href="#" class="jp-pause" tabindex="1"><i class="icon icon-pause"></i></a></li>
                  <li><a href="#" class="jp-mute" tabindex="1"><i class="icon icon-volume"></i></a></li>
                  <li><a href="#" class="jp-unmute" tabindex="1"><i class="icon icon-volume"></i></a></li>
                  <li><a href="#" class="jp-duration" tabindex="1" title="duration">time</a></li>
              </ul>
              <div class="jp-progress">
                  <div class="jp-seek-bar">
                      <div class="jp-play-bar"></div>
                  </div>
              </div>
              <div class="jp-volume-bar">
                  <div class="jp-volume-bar-value"></div>
              </div>
          </div>
      </div>
      </div>
  </div>

  <?php
}

/**
 * Format custom date.
 *
 * @deprecated 1.7
 *
 * @return mixed Formatted date.
 */
function stag_date( $arg, $data = null ) {
    $return = date_i18n( $arg, strtotime($data) );
    return $return;
}

function stag_portfolio_load_more(){
    if ( ! wp_verify_nonce( $_POST['nonce'], 'stag-ajax') ) die('Invalid nonce');
    if ( ! is_numeric( $_POST['page'] ) || $_POST['page'] < 0 ) die('Invalid page');

    $query_args = array(
  		'post_type'      => 'portfolio',
  		'posts_per_page' => stag_get_option('portfolio_count'),
  		'paged'          => $_POST['page'],
  		'meta_query'     => array(
  			array( 'key' => '_thumbnail_id')
  		)
    );

    $unique_skills = array();

    ob_start();
    $query = new WP_Query($query_args);

    while ( $query->have_posts() ) : $query->the_post();

    if ( ! has_post_thumbnail() ) continue;

    $skills = get_the_terms( get_the_ID(), 'skill' );
    $class = 'grid-4 portfolio';

    if ( is_array( $skills ) ) {
      $unique_skills = wp_list_pluck( $skills, 'slug' );
      $class .= ' ' . implode( ' ', $unique_skills );
    }

    ?>

    <div <?php post_class($class); ?>>
        <div class="overlay">
          <h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'stag'), get_the_title()); ?>"> <?php the_title(); ?></a></h3>
          <div class="portfolio-navigation">
            <a href="<?php the_permalink(); ?>" class="accent-background portfolio-trigger" data-id="<?php the_ID(); ?>"><i class="icon-eye"></i></a>
            <a href="<?php the_permalink(); ?>" class="accent-background" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'stag'), get_the_title()); ?>"><i class="icon-post-link"></i></a>
          </div>
        </div>
        <?php the_post_thumbnail('full'); ?>
    </div>

    <?php

    endwhile;
    wp_reset_postdata();
    $content = ob_get_contents();
    ob_end_clean();

    echo json_encode(array(
		'pages'      => $query->max_num_pages,
		'content'    => $content,
		'new_skills' => json_encode( array_values( array_unique( $unique_skills ) ) )
    ));
    exit;
}
add_action('wp_ajax_stag_portfolio_load_more', 'stag_portfolio_load_more');
add_action('wp_ajax_nopriv_stag_portfolio_load_more', 'stag_portfolio_load_more');

/**
 * Check if there is any third party plugin active
 *
 * @since 1.1
 */
function stag_check_third_party_seo() {
	include_once(ABSPATH .'wp-admin/includes/plugin.php');

	if( is_plugin_active('headspace2/headspace.php') ) return true;
	if( is_plugin_active('all-in-one-seo-pack/all_in_one_seo_pack.php') ) return true;
	if( is_plugin_active('wordpres-seo/wp-seo.php') ) return true;

	return false;
}

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 *
 * @since 1.4
 */
function stag_required_plugins() {
  $plugins = array(

    // This is an example of how to include a plugin from the WordPress Plugin Repository
    array(
      'name'    => 'StagTools',
      'slug'    => 'stagtools',
      'required'  => true,
    ),

  );

  tgmpa( $plugins );
}
add_action( 'tgmpa_register', 'stag_required_plugins' );

/**
 * Include framework and other files
 */
include_once ( get_template_directory() . '/framework/stag-framework.php' );
include_once ( get_template_directory() . '/includes/_init.php' );

if ( ! function_exists( 'stag_content_width' ) ) :
/**
 * Set the content width based on the current layout.
 *
 * @since 1.6.3
 *
 * @return void
 */
function stag_content_width() {
  global $content_width;

  if ( is_page_template( 'template-full-width.php' ) || stag_get_option('style_main_layout') === 'layout-1cf' ) {
    $content_width = 1170;
  }
}
endif;

add_action( 'template_redirect', 'stag_content_width' );
