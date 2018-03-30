<?php 
$_template_path = get_template_directory();
require_once $_template_path."/framework/abstract.php";
class Theme extends EWAbstractTheme
{
	public function __construct($options){
		$this->options = $options;
		parent::__construct($options);
		$this->constant($options);
	}
	
	public function init(){
		parent::init();
		//$this->loadOtherJSCSS($this->options);
		add_action('wp_enqueue_scripts',array($this,'loadOtherJSCSS'));
		add_action( 'init' , array($this, 'loadImageSize'));
	}
	
	protected function initArrIncludes(){
		parent::initArrIncludes();
		$this->arrIncludes = array_merge($this->arrIncludes,array('class-tgm-plugin-activation'));
	}

	//overwrite widget	
	protected function initArrWidgets(){
		$this->arrWidgets = array('flickr','hot_product','best_selling_product','sale_product','wd_recent_post','emads','twitterupdate'
								,'recent_comments_custom','ew_social','productaz','ew_subscriptions','product_categories','recent_product_slider','related_upsell_product'
								,'popular_product_by_categories','tab_product','testimonial','wd_tag_cloud','facebook_like_box', 'instagram', 'aboutme');
		
		if( class_exists('bbPress') ){
			$this->arrWidgets[] = 'bbpress_forums';
			$this->arrWidgets[] = 'bbpress_recent_posts';
		}
	}
	
	protected function constant($options){
		parent::constant($options);
		define('THEME_EXTENDS', THEME_DIR.'/theme');
		define('THEME_EXTENDS_FUNCTIONS', THEME_EXTENDS.'/functions');
		define('THEME_EXTENDS_SHORTCODES', THEME_EXTENDS.'/shortcodes');
		define('THEME_EXTENDS_INCLUDES', THEME_EXTENDS.'/includes');
		define('THEME_EXTENDS_WIDGETS', THEME_EXTENDS.'/widgets');
		define('THEME_EXTENDS_ADMIN', THEME_EXTENDS.'/admin');
		define('THEME_EXTENDS_ADMIN_TPL', THEME_EXTENDS_ADMIN.'/template');
		define('THEME_EXTENDS_ADMIN_URI', THEME_URI . '/theme/admin');
		define('THEME_EXTENDS_ADMIN_JS', THEME_EXTENDS_ADMIN_URI . '/js');
		define('THEME_EXTENDS_ADMIN_CSS', THEME_EXTENDS_ADMIN_URI . '/css');
	}
	
	function loadImageSize(){
		global $pagenow;
		if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ){
			$compare_size = get_option( 'yith_woocompare_image_size' );
			if( $compare_size === false ){
				$compare_size = array('width'=>220,'height'=>154,'crop'=>1);
				update_option( 'yith_woocompare_image_size', $compare_size );
			}
			return;
		}
		
		if ( function_exists( 'add_image_size' ) ) {
			global $smof_data;
			$wd_blog_thumb_width = absint($smof_data['wd_blog_thumb_width']);
			$wd_blog_thumb_height = absint($smof_data['wd_blog_thumb_height']);
			
			$wd_custom_product_thumb_width = absint($smof_data['wd_custom_product_thumb_width']);
			$wd_custom_product_thumb_height = absint($smof_data['wd_custom_product_thumb_height']);
			
			$wd_product_tini_thumb_width = absint($smof_data['wd_product_tini_thumb_width']);
			$wd_product_tini_thumb_height = absint($smof_data['wd_product_tini_thumb_height']);
			
			$wd_shortcode_blog_thumb_width = absint($smof_data['wd_shortcode_blog_thumb_width']);
			$wd_shortcode_blog_thumb_height = absint($smof_data['wd_shortcode_blog_thumb_height']);
			
			$wd_testimonial_thumb_width = absint($smof_data['wd_testimonial_thumb_width']);
			$wd_testimonial_thumb_height = absint($smof_data['wd_testimonial_thumb_height']);
			
			$wd_feature_thumb_width = absint($smof_data['wd_feature_thumb_width']);
			$wd_feature_thumb_height = absint($smof_data['wd_feature_thumb_height']);
			
			$wd_menu_thumb_width = absint($smof_data['wd_menu_thumb_width']);
			$wd_menu_thumb_height = absint($smof_data['wd_menu_thumb_height']);
			
			add_image_size('blog_thumb',$wd_blog_thumb_width,$wd_blog_thumb_height,true); /* image for blog thumbnail */		   
			add_image_size('custom_prod_thumb',$wd_custom_product_thumb_width,$wd_custom_product_thumb_height,true); /* image for product - woo-hook.php */
			add_image_size('prod_tini_thumb',$wd_product_tini_thumb_width,$wd_product_tini_thumb_height,true); /* image for product thumbnail - widget */
			add_image_size('blog_shortcode',$wd_shortcode_blog_thumb_width,$wd_shortcode_blog_thumb_height,true); /* using for recent blog shortcode */
			add_image_size('woo_shortcode',$wd_testimonial_thumb_width,$wd_testimonial_thumb_height,true); /* image for testimonial */
			add_image_size('woo_feature',$wd_feature_thumb_width,$wd_feature_thumb_height,true); /* image for feature */
			add_image_size('wd_menu_thumb',$wd_menu_thumb_width,$wd_menu_thumb_height,true);
		}
	}
	
	public function loadOtherJSCSS(){
		/// Load Custom JS for theme
		if(!is_admin()){			
			wp_register_script( 'oswadmarket', THEME_JS.'/oswadmarket.js',false,false,true);
			wp_enqueue_script('oswadmarket');
		}
	}
}
?>