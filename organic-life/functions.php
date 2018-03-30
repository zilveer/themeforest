<?php
define('THEMEUMNAME', wp_get_theme()->get( 'Name' ));
define('THMCSS', get_template_directory_uri().'/css/');
define('THMJS', get_template_directory_uri().'/js/');


// Include the meta box script
require_once ( get_template_directory().'/lib/meta-box/meta-box.php' );
require_once ( get_template_directory().'/lib/metabox.php' );


/*-------------------------------------------------------
 *				Redux Framework Options Added
 *-------------------------------------------------------*/

global $themeum_options; 

if ( !class_exists( 'ReduxFramework' ) ) {
	require_once( get_template_directory() . '/admin/framework.php' );
}

if ( !isset( $redux_demo ) ) {
	require_once( get_template_directory() . '/theme-options/admin-config.php' );
}

add_theme_support('woocommerce');

/*-------------------------------------------------------
 *				Organic Life Themeum Custom Post Type
 *-------------------------------------------------------*/
require_once( get_template_directory()  . '/custom-posts/themeum-client.php');
require_once( get_template_directory()  . '/custom-posts/themeum-portfolio.php');
require_once( get_template_directory()  . '/custom-posts/themeum-testimonial.php');


/*-------------------------------------------*
 *				Register Navigation
 *------------------------------------------*/

register_nav_menu( 'primary','Primary Menu' );


/*-------------------------------------------*
 *				navwalker
 *------------------------------------------*/
//Main Navigation
require_once( get_template_directory()  . '/lib/menu/admin-megamenu-walker.php');
require_once( get_template_directory()  . '/lib/menu/meagmenu-walker.php');
require_once( get_template_directory()  . '/lib/menu/mobile-navwalker.php');

//Admin mega menu
if(!function_exists('nav_menu_walker_register')):
 
        function nav_menu_walker_register( $class, $menu_id )
        {
            return 'Themeum_Megamenu_Walker';
        }
        add_filter( 'wp_edit_nav_menu_walker', 'nav_menu_walker_register', 10, 2 );
endif;


/*-------------------------------------------------------
*			Custom Widgets Include
*-------------------------------------------------------*/

// all custom widgets
require_once( get_template_directory()  . '/lib/widgets/image_widget.php');
require_once( get_template_directory()  . '/lib/widgets/blog-posts.php');
require_once( get_template_directory()  . '/lib/widgets/organic_about_widget.php');
require_once( get_template_directory()  . '/lib/widgets/themeum_flickr_widget.php');

// all Visual Composer custom addon and wordpress shortcode also
require_once( get_template_directory()  . '/lib/vc-addons/fontawesome-helper.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-feature.php');
require_once( get_template_directory()  . '/lib/vc-addons/wc-latest-products.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-title.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-action.php');
require_once( get_template_directory()  . '/lib/vc-addons/pricing-table.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-person.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-icons.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-social-media.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-dropcap.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-divider.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-review.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-alert.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-feature-box.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-list-item.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-counter.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-image-caption.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-button.php');


/*-------------------------------------------*
 *				Themeum Setup
 *------------------------------------------*/

if(!function_exists('thmtheme_setup')):

	function thmtheme_setup()
	{
		//Textdomain
		load_theme_textdomain( 'themeum', get_template_directory() . '/languages' );

		add_theme_support( 'post-thumbnails' );

		add_image_size( 'blog-full', 1140, 500, true );
		add_image_size( 'blog-thumb', 750, 335, true );
		add_image_size( 'sm-blog-thumb', 360, 210, true );
		add_image_size( 'xs-blog-thumb', 260, 165, true );
		add_image_size( 'xs-thumb', 60, 60, true );
		add_image_size( 'blog-gallery', 380, 330, true );
		add_image_size( 'xs-blog-gallery', 250, 220, true );
		add_image_size( 'portfolio-thumb', 380, 250, true );
		add_image_size( 'portfolio-thumb2', 570, 300, true );

		add_theme_support( 'post-formats', array( 'aside','audio','chat','gallery','image','link','quote','status','video' ) );
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form' ) );
		add_theme_support( 'automatic-feed-links' );

		add_editor_style('');

		if ( ! isset( $content_width ) )
		$content_width = 660;
	}

	add_action('after_setup_theme','thmtheme_setup');

endif;


/*-------------------------------------------*
 *		Themeum Widget Registration
 *------------------------------------------*/

if(!function_exists('thmtheme_widdget_init')):

	function thmtheme_widdget_init()
	{

		register_sidebar(array( 'name' 			=> __( 'Sidebar', 'themeum' ),
							  	'id' 			=> 'sidebar',
							  	'description' 	=> __( 'Widgets in this area will be shown on Sidebar.', 'themeum' ),
							  	'before_title' 	=> '<h3  class="widget_title">',
							  	'after_title' 	=> '</h3>',
							  	'before_widget' => '<div id="%1$s" class="widget %2$s" >',
							  	'after_widget' 	=> '</div>'
					)
		);

		global $woocommerce;

		if($woocommerce) {
			register_sidebar(array(
				'name' 			=> __( 'Shop', 'themeum' ),
				'id' 			=> 'shop',
				'description' 	=> __( 'Widgets in this area will be shown on Shop Sidebar.', 'themeum' ),
				'before_title' 	=> '<h3 class="widget_title">',
				'after_title' 	=> '</h3>',
				'before_widget' => '<div id="%1$s" class="widget %2$s" >',
				'after_widget' 	=> '</div>'
				)
			);
		}

		register_sidebar(array( 
							'name' 			=> __( 'Bottom', 'themeum' ),
							'id' 			=> 'bottom',
							'description' 	=> __( 'Widgets in this area will be shown before Footer.' , 'themeum'),
							'before_title' 	=> '<h3 class="widget_title">',
							'after_title' 	=> '</h3>',
							'before_widget' => '<div class="col-sm-6 col-md-3 bottom-widget"><div id="%1$s" class="widget %2$s" >',
							'after_widget' 	=> '</div></div>'
							)
		);
	}
	
	add_action('widgets_init','thmtheme_widdget_init');

endif;


if(!function_exists('themeum_admin_scripts')){

	function themeum_admin_scripts()
	{
		if(is_admin())
		{
			wp_enqueue_media();
			wp_enqueue_script('adsScript', get_template_directory_uri() . '/js/image-uploader.js');

		}
	}

	add_action('admin_enqueue_scripts','themeum_admin_scripts');

}


/*-------------------------------------------*
 *		Themeum Style
 *------------------------------------------*/

if(!function_exists('themeum_style')):

    function themeum_style(){
    	global $themeum_options;

        wp_enqueue_style('thm-style',get_stylesheet_uri());

        wp_enqueue_script('jquery');
        wp_enqueue_script('bootstrap',THMJS.'bootstrap.min.js',array(),false,true);
        wp_enqueue_script('prettyPhoto',THMJS.'jquery.prettyPhoto.js',array(),false,true);
        wp_enqueue_script('parallax',THMJS.'jquery.parallax.js',array(),false,true);
        wp_enqueue_script('smoothScroll',THMJS.'SmoothScroll.js',array(),false,true);
        wp_enqueue_script('fitvids',THMJS.'jquery.fitvids.js',array(),false,true);
        wp_enqueue_script('owl.carousel.min',THMJS.'owl.carousel.min.js',array(),false,true);
        wp_enqueue_script('jquery.isotope',THMJS.'jquery.isotope.min.js',array(),false,true);
        wp_enqueue_script('countdown',THMJS.'jquery.countdown.min.js',array(),false,true);
        wp_enqueue_script('wow.min',THMJS.'wow.min.js',array(),false,true);
        wp_enqueue_script('themeum-addons',get_template_directory_uri().'/lib/vc-addons/themeum-addons.js',array(),false,true);


        wp_enqueue_style('quick-style',get_template_directory_uri().'/quick-style.php',array(),false,'all');

    	if( isset($themeum_options['custom-preset-en']) && !$themeum_options['custom-preset-en'] ) {
			wp_enqueue_style( 'themeum-preset', get_template_directory_uri(). '/css/presets/preset' . $themeum_options['preset'] . '.css', array(),false,'all' );
		}

		wp_enqueue_script('main',THMJS.'main.js',array(),false,true);
	}

    add_action('wp_enqueue_scripts','themeum_style');

endif;


if(!function_exists('themeum_admin_style')):

	function themeum_admin_style()
	{
		if(is_admin())
		{
			wp_register_script('thmpostmeta', get_template_directory_uri() .'/js/admin/post-meta.js');
			wp_enqueue_script('thmpostmeta');
		}
	}

	add_action('admin_enqueue_scripts','themeum_admin_style');

endif;

/*-------------------------------------------*
 *				Excerpt Length
 *------------------------------------------*/

if(!function_exists('new_excerpt_more')):

	if( isset($themeum_options['blog-continue-en']) && $themeum_options['blog-continue-en'] ){

		function new_excerpt_more( $more )
		{
			global $themeum_options;
			$continue = 'Continue Reading';

			if ( isset($themeum_options['blog-continue']) ){
				$continue = $themeum_options['blog-continue'];
			}

			$postObj = get_post(get_the_ID());

			if ($postObj->post_type === 'post') {
				return '&nbsp;<br /><br /><a class="btn btn-style" href="'. get_permalink(  ) . '">'.__($continue,'themeum').'...</a>';
			}else{
				return '&nbsp;<br />';
			}
		}
		add_filter( 'excerpt_more', 'new_excerpt_more' );

	}

endif;


/*-------------------------------------------------------
*			Include the TGM Plugin Activation class
*-------------------------------------------------------*/

require_once( get_template_directory()  . '/lib/class-tgm-plugin-activation.php');

add_action( 'tgmpa_register', 'themeum_plugins_include');

if(!function_exists('themeum_plugins_include')):

	function themeum_plugins_include()
	{
		$plugins = array(
                array(
                    'name'                  => 'WPBakery Visual Composer',
                    'slug'                  => 'js_composer',
                    'source'                => 'http://demo.themeum.com/wordpress/plugins/js_composer.zip',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => 'revslider',
                    'slug'                  => 'revslider',
                    'source'                => 'http://demo.themeum.com/wordpress/plugins/revslider.zip',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),  
				array(
					'name'                  => 'The Events Calendar', // The plugin name
					'slug'                  => 'the-events-calendar', // The plugin slug (typically the folder name)
					'required'              => false, // If false, the plugin is only 'recommended' instead of required
					'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
					'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
					'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
					'external_url'          => 'https://downloads.wordpress.org/plugin/the-events-calendar.4.1.3.zip', // If set, overrides default API URL and points to an external URL
				),
				array(
					'name'                  => 'Contact Form 7', // The plugin name
					'slug'                  => 'contact-form-7', // The plugin slug (typically the folder name)
					'required'              => false, // If false, the plugin is only 'recommended' instead of required
					'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
					'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
					'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
					'external_url'          => 'https://downloads.wordpress.org/plugin/contact-form-7.4.4.2.zip', // If set, overrides default API URL and points to an external URL
				),
				array(
					'name'                  => 'Themeum Tweet',
					'slug'                  => 'themeum-tweet',
					'source'                => get_stylesheet_directory() . '/lib/plugins/themeum-tweet.zip',
					'required'              => false,
					'version'               => '',
					'force_activation'      => false,
					'force_deactivation'    => false,
					'external_url'          => '',
				),
				array(
					'name'                  => 'Themeum Demo Importer',
					'slug'                  => 'themeum-demo-importer',
					'source'                => get_stylesheet_directory() . '/lib/plugins/themeum-demo-importer.zip',
					'required'              => false,
					'version'               => '',
					'force_activation'      => false,
					'force_deactivation'    => false,
					'external_url'          => '',
				),
				array(
					'name'                  => 'MailChimp for WordPress', // The plugin name
					'slug'                  => 'mailchimp-for-wp', // The plugin slug (typically the folder name)
					'required'              => false, // If false, the plugin is only 'recommended' instead of required
					'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
					'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
					'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
					'external_url'          => 'https://downloads.wordpress.org/plugin/mailchimp-for-wp.3.1.6.zip', // If set, overrides default API URL and points to an external URL
				),
				array(
					'name'                  => 'Woocoomerce', // The plugin name
					'slug'                  => 'woocommerce', // The plugin slug (typically the folder name)
					'required'              => false, // If false, the plugin is only 'recommended' instead of required
					'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
					'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
					'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
					'external_url'          => 'http://downloads.wordpress.org/plugin/woocommerce.2.5.5.zip', // If set, overrides default API URL and points to an external URL
				),
			);

	$config = array(
			'domain'            => 'themeum',           // Text domain - likely want to be the same as your theme.
			'default_path'      => '',                           // Default absolute path to pre-packaged plugins
			'parent_menu_slug'  => 'themes.php',         		 // Default parent menu slug
			'parent_url_slug'   => 'themes.php',         		 // Default parent URL slug
			'menu'              => 'install-required-plugins',   // Menu slug
			'has_notices'       => true,                         // Show admin notices or not
			'is_automatic'      => false,            			 // Automatically activate plugins after installation or not
			'message'           => '',               			 // Message to output right before the plugins table
			'strings'           => array(
						'page_title'                                => __( 'Install Required Plugins', 'themeum' ),
						'menu_title'                                => __( 'Install Plugins', 'themeum' ),
						'installing'                                => __( 'Installing Plugin: %s', 'themeum' ), // %1$s = plugin name
						'oops'                                      => __( 'Something went wrong with the plugin API.', 'themeum'),
						'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
						'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
						'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
						'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
						'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
						'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
						'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
						'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
						'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
						'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
						'return'                                    => __( 'Return to Required Plugins Installer', 'themeum'),
						'plugin_activated'                          => __( 'Plugin activated successfully.','themeum'),
						'complete'                                  => __( 'All plugins installed and activated successfully. %s', 'themeum' ) // %1$s = dashboard link
				)
	);

	tgmpa( $plugins, $config );

	}

endif;



/*-------------------------------------------------------
 *			Themeum Pagination
 *-------------------------------------------------------*/

if(!function_exists('themeum_pagination')):

	function themeum_pagination($pages = '', $range = 2)
	{  
	     $showitems = ($range * 1)+1;  

	     global $paged;

	     if(empty($paged)) $paged = 1;

	     if($pages == '')
	     {
	         global $wp_query;
	         $pages = $wp_query->max_num_pages;

	         if(!$pages)
	         {
	             $pages = 1;
	         }
	     }   

	     if(1 != $pages)
	     {
			echo "<div class='prolog-pagination'><ul class='pagination'>";

			if($paged > 2 && $paged > $range+1 && $showitems < $pages){
				echo "<li><a href='".get_pagenum_link(1)."'>&laquo;</a></li>";
			}

			if($paged > 1 && $showitems < $pages){ 
				echo '<li>';
				previous_posts_link("Previous");
				echo '</li>';
			}

			for ($i=1; $i <= $pages; $i++)
			{
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
				{
					echo ($paged == $i)? "<li class='active'><a href='#'>".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."' >".$i."</a></li>";
				}
			}

			if ($paged < $pages && $showitems < $pages){
				echo '<li>';
				next_posts_link("Next");
				echo '</li>';
			}

			if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages){
				echo "<li><a href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
			}
			
			echo "</ul></div>";
	     }
	}

endif;


/*-------------------------------------------------------
 *				Themeum Comment
 *-------------------------------------------------------*/

if(!function_exists('themeum_comment')):

	function themeum_comment($comment, $args, $depth)
	{
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
			// Display trackbacks differently than normal comments.
		?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<p>Pingback: <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'themeum' ), '<span class="edit-link">', '</span>' ); ?></p>
		<?php
				break;
			default :
			
			global $post;
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<div id="comment-<?php comment_ID(); ?>" class="comment-body media">
				
					<div class="comment-avartar pull-left">
						<?php
							echo get_avatar( $comment, $args['avatar_size'] );
						?>
					</div>
					<div class="comment-context media-body">
						<div class="comment-head">
							<?php
								printf( '<span class="comment-author">%1$s</span>',
									get_comment_author_link());
							?>
							<span class="comment-date"><?php echo get_comment_date('d / m / Y') ?></span>

							<?php edit_comment_link( __( 'Edit', 'themeum' ), '<span class="edit-link">', '</span>' ); ?>
							<span class="comment-reply">
								<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'themeum' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
							</span>
						</div>

						<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'themeum' ); ?></p>
						<?php endif; ?>

						<div class="comment-content">
							<?php comment_text(); ?>
						</div>
					</div>
				
			</div>
		<?php
			break;
		endswitch; 
	}

endif;


/*-------------------------------------------------------
*			Themeum Breadcrumb
*-------------------------------------------------------*/

function themeum_breadcrumbs(){ ?>

	<div class="themeum-breadcrumbs">

		<ul class="breadcrumb">
			<li>
				<a href="<?php home_url(); ?>" class="breadcrumb_home"><?php esc_html_e('Home', 'themeum') ?></a> 
			</li>
			<?php
	            if(function_exists('is_product')){
	                $shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
	                if(is_product()){
	                    echo "<li><a href='".$shop_page_url."'>".esc_html__('shop', 'themeum')."</a></li>";
	                }   
	            }
	        ?>
			<li class="active">
				<?php if(function_exists('is_shop')){ if(is_shop()){ _e('shop','themeum'); } } ?>
				
				<?php if( is_tag() ) { ?>
				<?php esc_html_e('Posts Tagged ', 'themeum') ?><span class="raquo">/</span><?php single_tag_title(); echo('/'); ?>
				<?php } elseif (is_day()) { ?>
				<?php esc_html_e('Posts made in', 'themeum') ?> <?php the_time('F jS, Y'); ?>
				<?php } elseif (is_month()) { ?>
				<?php esc_html_e('Posts made in', 'themeum') ?> <?php the_time('F, Y'); ?>
				<?php } elseif (is_year()) { ?>
				<?php esc_html_e('Posts made in', 'themeum') ?> <?php the_time('Y'); ?>
				<?php } elseif (is_search()) { ?>
				<?php esc_html_e('Search results for', 'themeum') ?> <?php the_search_query() ?>
				<?php } elseif (is_single()) { ?>
				<?php $category = get_the_category();
				if ( $category ) { 
					$catlink = get_category_link( $category[0]->cat_ID );
					echo ('<a href="'.esc_url($catlink).'">'.esc_html($category[0]->cat_name).'</a> '.'<span class="raquo"> /</span> ');
				}
				echo get_the_title(); ?>
				<?php } elseif (is_category()) { ?>
				<?php single_cat_title(); ?>
				<?php } elseif (is_tax()) { ?>
				<?php 
				$themeum_taxonomy_links = array();
				$themeum_term = get_queried_object();
				$themeum_term_parent_id = $themeum_term->parent;
				$themeum_term_taxonomy = $themeum_term->taxonomy;

				while ( $themeum_term_parent_id ) {
					$themeum_current_term = get_term( $themeum_term_parent_id, $themeum_term_taxonomy );
					$themeum_taxonomy_links[] = '<a href="' . esc_url( get_term_link( $themeum_current_term, $themeum_term_taxonomy ) ) . '" title="' . esc_attr( $themeum_current_term->name ) . '">' . esc_html( $themeum_current_term->name ) . '</a>';
					$themeum_term_parent_id = $themeum_current_term->parent;
				}

				if ( !empty( $themeum_taxonomy_links ) ) echo implode( ' <span class="raquo">/</span> ', array_reverse( $themeum_taxonomy_links ) ) . ' <span class="raquo">/</span> ';

				echo esc_html( $themeum_term->name ); 
			} elseif (is_author()) { 
				global $wp_query;
				$curauth = $wp_query->get_queried_object();

				esc_html_e('Posts by ', 'themeum'); echo ' ',$curauth->nickname; 
			} elseif (is_page()) { 
				echo get_the_title(); 
			} elseif (is_home()) { 
				esc_html_e('Blog', 'themeum');
			} ?>  
		</li>
	</ul>
	</div>
<?php
}



//WooCommerce Update Cart
add_filter('add_to_cart_fragments', function($fragments){
	global $woocommerce;
	ob_start();
	$has_products = '';
	if($woocommerce->cart->cart_contents_count>0) {
		$has_products = 'cart-has-products';
	}
	?>
	<span class="woo-cart-items">
		<span class="<?php echo $has_products; ?>"><?php echo $woocommerce->cart->cart_contents_count; ?></span>
	</span>
	<?php
	$fragments['.woo-cart-items'] = ob_get_clean();
	return $fragments;
});


//Admin mega menu
if(!function_exists('nav_menu_walker_register')):
 
        function nav_menu_walker_register( $class, $menu_id )
        {
            return 'Themeum_Megamenu_Walker';
        }
        add_filter( 'wp_edit_nav_menu_walker', 'nav_menu_walker_register', 10, 2 );
endif;


/*Woocoomerce*/
global $woocommerce;

if($woocommerce) {
	/*Remove Woocommerce default style*/
	add_filter( 'woocommerce_enqueue_styles', function($enqueue_styles){
		unset( $enqueue_styles['woocommerce-general'] );
		return $enqueue_styles;
	});

	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
}


/*--------------------------------------------------------------
 * Get All Terms of Taxonomy 
 * @author : Themeum
 *-------------------------------------------------------------*/


function get_all_term_names( $post_id, $taxonomy = 'post_tag' )
{
	$terms = get_the_terms( $post_id, $taxonomy );

	$term_names = '';
    if ( $terms && ! is_wp_error( $terms ) )
    { 
        $term_name = array();

        foreach ( $terms as $term ) {
            $term_name[] = $term->name;
        }

        $term_names = join( ", ", $term_name );
    }

    return $term_names;
}


/*-----------------------------------------------------
 * 				Coming Soon Page Settings
 *----------------------------------------------------*/


if (isset($themeum_options['comingsoon-en']) && $themeum_options['comingsoon-en']) {
	function my_page_template_redirect()
	{
		if( is_page( ) || is_home() || is_category() || is_single() )
		{
			get_template_part( 'coming','soon');
			exit();
		}
	}
	add_action( 'template_redirect', 'my_page_template_redirect' );

	function cooming_soon_wp_title(){
		return 'Coming Soon';
	}

	add_filter( 'wp_title', 'cooming_soon_wp_title' );
}


/*-----------------------------------------------------
 * 				Custom Excerpt Length
 *----------------------------------------------------*/

if(!function_exists('the_excerpt_max_charlength')):

	function the_excerpt_max_charlength($charlength) {
		$excerpt = get_the_excerpt();
		$charlength++;

		if ( mb_strlen( $excerpt ) > $charlength ) {
			$subex = mb_substr( $excerpt, 0, $charlength - 5 );
			$exwords = explode( ' ', $subex );
			$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
			if ( $excut < 0 ) {
				return mb_substr( $subex, 0, $excut );
			} else {
				return $subex;
			}

		} else {
			return $excerpt;
		}
	}

endif;

/*-----------------------------------------------------
 * 				Custom Excerpt Length
 *----------------------------------------------------*/

if(!function_exists('themeum_get_video_id')){
	function themeum_get_video_id($url){
		$video = parse_url($url);

		switch($video['host']) {
			case 'youtu.be':
			$id = trim($video['path'],'/');
			$src = 'https://www.youtube.com/embed/' . $id;
			break;

			case 'www.youtube.com':
			case 'youtube.com':
			parse_str($video['query'], $query);
			$id = $query['v'];
			$src = 'https://www.youtube.com/embed/' . $id;
			break;

			case 'vimeo.com':
			case 'www.vimeo.com':
			$id = trim($video['path'],'/');
			$src = "http://player.vimeo.com/video/{$id}";
		}

		return $src;
	}
}


function themeum_hex2rgb($hex) {
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

   return $rgb[0].','.$rgb[1].','.$rgb[2];
}