<?php
class DH_Jakiro_Theme {
	public $themeInfo;
	public $themeName;
	public $themeAuthor;
	public $themeAuthor_URI;
	public $themeVersion;
	public function __construct(){
		$this->themeInfo            =  wp_get_theme();
		$this->themeName            = trim($this->themeInfo['Title']);
		$this->themeAuthor          = trim($this->themeInfo['Author']);
		$this->themeAuthor_URI      = trim($this->themeInfo['AuthorURI']);
		$this->themeVersion         = trim($this->themeInfo['Version']);
		$this->_define();
		$this->_includes();
		
		add_action( 'wp_head', array(&$this,'theme_slug_render_title' ));
		add_action( 'widgets_init', array(&$this,'register_sidebar' ));
		add_action( 'after_setup_theme', array(&$this,'after_setup_theme' ));
		add_action( 'wp_enqueue_scripts', array(&$this,'enqueue_theme_styles' ));
		add_action( 'wp_enqueue_scripts', array($this,'enqueue_theme_script') );
		add_filter( 'post_type_archive_title', array(&$this,'portfolio_post_type_archive_title'),100,2);
		add_action( 'template_redirect', array($this,'register_vendor_assets' ));
	}
	
	public function theme_slug_render_title(){
		if ( ! function_exists( '_wp_render_title_tag' ) ) {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
		}
	}
	

	public function after_setup_theme(){
		load_theme_textdomain( 'jakiro', get_template_directory() . '/languages' );

		add_theme_support( 'nav-menus' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( "title-tag" );
		
		add_image_size('dh-thumbnail-square',600,450, true);
		add_image_size('dh-thumbnail',770,395, true);
		
		add_theme_support( 'woocommerce' );
		add_theme_support( 'post-formats', array('image', 'video', 'audio', 'quote', 'link', 'gallery'));
		
		$nav_menus['top'] = esc_html__( 'Top Menu', 'jakiro' );
		$nav_menus['primary'] = esc_html__( 'Primary Menu', 'jakiro' );
		$nav_menus['mobile'] = esc_html__( 'Mobile Menu', 'jakiro' );
		$nav_menus['footer'] = esc_html__( 'Footer Menu', 'jakiro' );
		register_nav_menus( $nav_menus );
	}

	protected function _define(){
		define('DH_THEME_NAME', $this->themeName);
		define('DH_THEME_AUTHOR', $this->themeAuthor);
		define('DH_THEME_AUTHOR_URI', $this->themeAuthor_URI);
		define('DH_THEME_VERSION', $this->themeVersion);
	}

	protected function _includes(){
		do_action('dh_theme_includes');
		if(!defined('SITESAO_CORE_DIR')){
			include_once (get_template_directory().'/includes/functions.php');
		}
		include_once (get_template_directory().'/includes/breadcrumb.php');
		include_once (get_template_directory().'/includes/walker.php');
		include_once ( get_template_directory(). '/includes/plugins/tgm-plugin-activation.php');
		$plugin_path = get_template_directory() . '/includes/plugins';
		if ( class_exists('TGM_Plugin_Activation')) {
			include_once ($plugin_path . '/tgmpa_register.php');
		}

	}

	public function portfolio_post_type_archive_title($title,$post_type){
		if($post_type == 'portfolio')
			return esc_html(dh_get_theme_option('portfolio-archive-title',esc_html__('My Portfolio','jakiro')));
		return $title;
	}



	public function register_vendor_assets() {
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		wp_deregister_style('dhvc-form-font-awesome');

		wp_register_style('vendor-font-awesome',get_template_directory_uri().'/assets/vendor/font-awesome/css/font-awesome' . $suffix . '.css', array(), '4.6.2' );
		wp_register_style('vendor-elegant-icon',get_template_directory_uri().'/assets/vendor/elegant-icon/css/elegant-icon.css');

		wp_register_style( 'vendor-preloader', get_template_directory_uri().'/assets/vendor/preloader/preloader.css', '1.0.0' );
		wp_register_script( 'vendor-preloader', get_template_directory_uri().'/assets/vendor/preloader/preloader'.$suffix.'.js', array('jquery') , '1.0.0', false );

		wp_register_script( 'vendor-countdown', get_template_directory_uri().'/assets/vendor/jquery.countdown'.$suffix.'.js', array('vendor-appear') , '2.0.4', true );

		wp_register_script( 'vendor-stellar', get_template_directory_uri().'/assets/vendor/jquery.stellar'.$suffix.'.js', array('vendor-appear') , '2.0.4', true );


		wp_register_script( 'vendor-ajax-chosen', get_template_directory_uri().'/assets/vendor/chosen/ajax-chosen.jquery' . $suffix . '.js', array( 'jquery', 'vendor-chosen' ), '1.0.0', true );
		wp_register_script( 'vendor-appear', get_template_directory_uri().'/assets/vendor/jquery.appear' . $suffix . '.js', array( 'jquery' ), '1.0.0', true );
		wp_register_script( 'vendor-typed', get_template_directory_uri().'/assets/vendor/typed' . $suffix .'.js', array( 'jquery','vendor-appear' ), '1.0.0', true );
		wp_register_script( 'vendor-easing', get_template_directory_uri().'/assets/vendor/easing' . $suffix . '.js', array( 'jquery' ), '1.3.0', true );
		wp_register_script( 'vendor-waypoints', get_template_directory_uri().'/assets/vendor/waypoints' . $suffix . '.js', array( 'jquery' ), '2.0.5', true );
		wp_register_script( 'vendor-transit', get_template_directory_uri().'/assets/vendor/jquery.transit' . $suffix . '.js', array( 'jquery' ), '0.9.12', true );
		wp_register_script( 'vendor-imagesloaded', get_template_directory_uri().'/assets/vendor/imagesloaded.pkgd' . $suffix . '.js', array( 'jquery' ), '3.1.8', true );

		wp_register_script( 'vendor-requestAnimationFrame', get_template_directory_uri().'/assets/vendor/requestAnimationFrame' . $suffix . '.js', null, '0.0.17', true );
		wp_register_script( 'vendor-parallax', get_template_directory_uri().'/assets/vendor/jquery.parallax' . $suffix . '.js', array( 'jquery'), '1.1.3', true );

		wp_register_script( 'vendor-boostrap', get_template_directory_uri().'/assets/vendor/bootstrap' . $suffix . '.js', array('jquery','vendor-imagesloaded'), '3.2.0', true );
		wp_register_script( 'vendor-superfish',get_template_directory_uri().'/assets/vendor/superfish-1.7.4.min.js',array( 'jquery' ),'1.7.4',true );

		wp_register_script( 'vendor-countTo', get_template_directory_uri().'/assets/vendor/jquery.countTo' . $suffix . '.js', array( 'jquery', 'vendor-appear' ), '2.0.2', true );
		wp_register_script( 'vendor-infinitescroll', get_template_directory_uri().'/assets/vendor/jquery.infinitescroll' . $suffix . '.js', array( 'jquery','vendor-imagesloaded' ), '2.0.2', true );

		wp_register_script( 'vendor-ProgressCircle', get_template_directory_uri().'/assets/vendor/ProgressCircle' . $suffix . '.js', array( 'jquery','vendor-appear'), '2.0.2', true );

		wp_register_style( 'vendor-magnific-popup', get_template_directory_uri().'/assets/vendor/magnific-popup/magnific-popup.css' );
		wp_register_script( 'vendor-magnific-popup', get_template_directory_uri().'/assets/vendor/magnific-popup/jquery.magnific-popup' . $suffix . '.js', array( 'jquery' ,'mediaelement'), '0.9.9', true );

		wp_register_script( 'vendor-touchSwipe', get_template_directory_uri().'/assets/vendor/jquery.touchSwipe' . $suffix . '.js', array( 'jquery'), '1.6.6', true );

		wp_register_script( 'vendor-carouFredSel', get_template_directory_uri().'/assets/vendor/jquery.carouFredSel' . $suffix . '.js', array( 'jquery','vendor-touchSwipe', 'vendor-easing','vendor-imagesloaded','vendor-transit'), '6.2.1', true );
		wp_register_script( 'vendor-isotope', get_template_directory_uri().'/assets/vendor/isotope.pkgd' . $suffix . '.js', array( 'jquery', 'vendor-imagesloaded' ), '6.2.1', true );

	}


	public function enqueue_theme_styles(){
		$protocol = dh_get_protocol();
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		$main_css_id = basename(get_template_directory());
		//Playfair Display
		dh_enqueue_google_font();
		if ( 'off' !== _x( 'on', 'Google font: on or off', 'jakiro' ) ) {
		wp_enqueue_style('dh-google-font-montserrat','http://fonts.googleapis.com/css?family=Montserrat:400,700|Droid+Serif:400,700');
		}
		wp_enqueue_style('vendor-elegant-icon');
		wp_enqueue_style('vendor-font-awesome');
	
		wp_register_style($main_css_id,get_template_directory_uri().'/assets/css/style'.$suffix.'.css',false,DH_THEME_VERSION);
	
		if ( class_exists( 'WPCF7_ContactForm' ) ) :
			wp_deregister_style( 'contact-form-7' );
		endif;
		
		wp_enqueue_style($main_css_id);
		
		if(defined('WOOCOMMERCE_VERSION')){
			wp_enqueue_style($main_css_id.'-woocommerce',get_template_directory_uri().'/assets/css/woocommerce'.$suffix.'.css',array($main_css_id),DH_THEME_VERSION);
		}
		wp_register_style($main_css_id.'-wp',get_stylesheet_uri(),false,DH_THEME_VERSION);
		do_action('dh_main_inline_style',$main_css_id);
		if($custom_css=dh_get_theme_option('custom-css')){
			wp_add_inline_style($main_css_id.'-wp',$custom_css);
		}
		$fix_el_apper = '@media (max-width: '.apply_filters('dh_js_breakpoint', 992).'px) {.animate-box.animated{visibility: visible;}.column[data-fade="1"]{opacity: 1;filter: alpha(opacity=100);}.el-appear{opacity: 1;filter: alpha(opacity=100);-webkit-transform: scale(1);-ms-transform: scale(1);-o-transform: scale(1);transform: scale(1);}}';
		wp_add_inline_style($main_css_id.'-wp', $fix_el_apper);
		wp_enqueue_style($main_css_id.'-wp');
	}

	public function enqueue_theme_script(){
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
		if(defined('WOOCOMMERCE_VERSION')) {
			wp_enqueue_script( 'wc-add-to-cart-variation' );
		}else{
			wp_enqueue_script( 'vendor-cookie', get_template_directory_uri().'/assets/vendor/jquery.cookie'.$suffix.'.js', array('jquery') , '1.4.1', false );
		}
			
		//wp_register_script('dh', get_template_directory_uri().'/assets/js/script'.$suffix.'.js',array('jquery','vendor-easing','vendor-infinitescroll','vendor-imagesloaded','vendor-parallax','vendor-boostrap','vendor-superfish','vendor-carouFredSel','vendor-isotope','vendor-appear','vendor-countTo','vendor-ProgressCircle'),DH_THEME_VERSION,true);
		wp_register_script('dh', get_template_directory_uri().'/assets/js/script'.$suffix.'.js',array('jquery','vendor-easing','vendor-boostrap','vendor-superfish','vendor-appear'),DH_THEME_VERSION,true);
		$logo_retina = '';
		$dhL10n = array(
			'ajax_url'=>admin_url( 'admin-ajax.php', 'relative' ),
			'protocol'=>dh_get_protocol(),
			'breakpoint'=>apply_filters('dh_js_breakpoint', 900),
			'nav_breakpoint'=>apply_filters('dh_nav_breakpoint', 900),
			'cookie_path'=>COOKIEPATH,
			'screen_sm'=>768,
			'screen_md'=>992,
			'screen_lg'=>1200,
			'touch_animate'=>apply_filters('dh_js_touch_animate', true),
			'logo_retina'=>$logo_retina,
			'ajax_finishedMsg'=>esc_attr__('All posts displayed','jakiro'),
			'ajax_msgText'=>esc_attr__('Loading the next set of posts...','jakiro'),
			'woocommerce'=>(defined('WOOCOMMERCE_VERSION') ? 1 : 0),
			'add_to_wishlist_text'=>esc_attr(apply_filters('dh_yith_wishlist_is_active',defined( 'YITH_WCWL' )) ? apply_filters( 'dh_yith_wcwl_button_label', get_option( 'yith_wcwl_add_to_wishlist_text' )) : ''),
			'user_logged_in'=>(is_user_logged_in() ? 1 : 0),
			'loadingmessage'=>esc_attr__('Sending info, please wait...','jakiro'),
		);
		wp_localize_script('dh', 'dhL10n', $dhL10n);
		wp_enqueue_script('dh');
		
	}


	public function register_sidebar() {
		// Default Sidebar (WP main sidebar)
		register_sidebar( 
			array(  // 1
				'name' => esc_html__( 'Main Sidebar', 'jakiro' ), 
				'description' => esc_html__( 'This is main sidebar', 'jakiro' ), 
				'id' => 'sidebar-main', 
				'before_widget' => '<div id="%1$s" class="widget %2$s">', 
				'after_widget' => '</div>', 
				'before_title' => '<h4 class="widget-title"><span>', 
				'after_title' => '</span></h4>' ) );
		// Shop Sidebar (WP shop sidebar) 
		register_sidebar( 
			array(  // 1
				'name' => esc_html__( 'Shop Sidebar', 'jakiro' ), 
				'description' => esc_html__( 'This sidebar use for Woocommerce page', 'jakiro' ), 
				'id' => 'sidebar-shop', 
				'before_widget' => '<div id="%1$s" class="widget %2$s">', 
				'after_widget' => '</div>', 
				'before_title' => '<h4 class="widget-title"><span>', 
				'after_title' => '</span></h4>' ) );
		register_sidebar(
			array(  // 1
				'name' => esc_html__( 'Mobile Off-canvas Sidebar', 'jakiro' ),
				'description' => esc_html__( 'This sidebar use for Woocommerce page', 'jakiro' ),
				'id' => 'sidebar-offcanvas',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h4 class="widget-title"><span>',
				'after_title' => '</span></h4>' ) );
		for ( $i = 1; $i <= 5; $i++ ) :
			register_sidebar( 
				array( 
					'name' => esc_html__( 'Footer Sidebar #', 'jakiro' ) . $i, 
					'id' => 'sidebar-footer-' . $i, 
					'before_widget' => '<div id="%1$s" class="widget %2$s">', 
					'after_widget' => '</div>', 
					'before_title' => '<h3 class="widget-title"><span>', 
					'after_title' => '</span></h3>' ) );
		endfor;
	}
}
$dh_jakiro_theme = new DH_Jakiro_Theme(); 

if ( ! isset( $content_width ) )
	$content_width = 1200;
