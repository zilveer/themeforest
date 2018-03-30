<?php

class PeThemeWooCommerce {

	protected $master;
	protected $woothumbs;
	protected $flare;


	public function __construct(&$master) {
		$this->master =& $master;
	}

	public function instantiate() {
		add_theme_support('woocommerce');

		$this->woothumbs = apply_filters("pe_theme_woocommerce_image_sizes",array("shop_single","shop_catalog","shop_thumbnail"));
		$this->flare = apply_filters("pe_theme_woocommerce_use_flare_lightbox",true);

		// custom script/css
		add_action('pe_theme_asset_style_pe_theme_init_deps',array(&$this,'pe_theme_asset_style_pe_theme_init_deps_filter'));
		add_action('pe_theme_asset_script_pe_theme_init_deps',array(&$this,'pe_theme_asset_script_pe_theme_init_deps_filter'));

		// layout wrapper
		add_action('pe_theme_after_header',array(&$this,'pe_theme_after_header'));
		add_action('pe_theme_before_footer',array(&$this,'pe_theme_before_footer'));

		// content wrapper
		remove_action('woocommerce_before_main_content','woocommerce_output_content_wrapper', 10);
		remove_action('woocommerce_after_main_content','woocommerce_output_content_wrapper_end', 10);
		add_action('woocommerce_before_main_content',array(&$this,'woocommerce_before_main_content'), 10);
		add_action('woocommerce_after_main_content',array(&$this,'woocommerce_after_main_content'), 10);
		add_action('pe_theme_woocommerce_has_sidebar',array(&$this,'pe_theme_woocommerce_has_sidebar'));
		

		// thumbnails
		add_filter('woocommerce_single_product_image_thumbnail_html',array(&$this,'woocommerce_single_product_image_thumbnail_html_filter'),20,2);

		if ($this->flare) {
			add_filter('woocommerce_single_product_image_html',array(&$this,'woocommerce_single_product_image_html_filter'),20,2);
		}
			
		$options =& $this->master->options;

		if ($options->get("retina") === "yes") {
			add_filter('post_thumbnail_html',array($this,'post_thumbnail_html_retina_filter'),99,5);
		} else if ($options->get("lazyImages") === "yes") {
			add_filter('post_thumbnail_html',array($this,'post_thumbnail_html_lazyload_filter'),99,5);
		}  else {
			add_filter('post_thumbnail_html',array($this,'post_thumbnail_html_filter'),99,5);
		}
	}

	public function post_thumbnail_html_retina_filter($html,$post_id,$post_thumbnail_id,$size,$attr) {
		return in_array($size,$this->woothumbs) ? $this->master->image->post_thumbnail_html_filter($html,$post_id,$post_thumbnail_id,$size,$attr,true,true) : $html;
	}

	public function post_thumbnail_html_lazyload_filter($html,$post_id,$post_thumbnail_id,$size,$attr) {
		return in_array($size,$this->woothumbs) ? $this->master->image->post_thumbnail_html_filter($html,$post_id,$post_thumbnail_id,$size,$attr,false,true) : $html;
	}

	public function post_thumbnail_html_filter($html,$post_id,$post_thumbnail_id,$size,$attr) {
		return in_array($size,$this->woothumbs) ? $this->master->image->post_thumbnail_html_filter($html,$post_id,$post_thumbnail_id,$size,$attr,false,false) : $html;
	}

	public function woocommerce_before_main_content() {	
		$sidebar = apply_filters("pe_theme_woocommerce_has_sidebar",true);
		if (!$sidebar) {
			remove_action('woocommerce_sidebar','woocommerce_get_sidebar');
		}
		printf('<div class="%s">',$sidebar ? "span8" : "span12");
	}

	public function pe_theme_woocommerce_has_sidebar() {
		return is_shop();
	}

	public function woocommerce_after_main_content() {
		print '</div>';
	}

	public function pe_theme_after_header() {
		if (function_exists('is_woocommerce') && is_woocommerce()) {
			print '<div class="site-body"><div class="pe-container pe-woocommerce"><div class="row-fluid">';
		}
	}

	public function pe_theme_before_footer() {
		if (function_exists('is_woocommerce') && is_woocommerce()) {
			print '</div></div></div>';
		}	
	}

	public function woocommerce_single_product_image_thumbnail_html_filter($html,$attachment_id,$post_id = null,$image_class = null) {
		$img = wp_get_attachment_image($attachment_id,'shop_thumbnail');
		$rep = preg_replace('/<img[^>]+>/',"$img",$html);
		$rep = str_replace("wp-post-image","",$rep);
		if ($this->flare) {
			$rep = str_replace("zoom","",$rep);
			$rep = preg_replace('/rel="prettyPhoto\[([^\]]+)]"/','data-flare-gallery="$1"',$rep);
		}
		return $rep;
	}

	public function woocommerce_single_product_image_html_filter($html) {
		$rep = str_replace("zoom","",$html);
		$rep = preg_replace('/rel="prettyPhoto\[([^\]]+)]"/','data-flare-gallery="$1"',$rep);
		return $rep;
	}

	public function pe_theme_asset_style_pe_theme_init_deps_filter($deps) {
		PeThemeAsset::addStyle("css/woocommerce.css",array(),"pe_theme_woocommerce");
		$deps[] = "pe_theme_woocommerce";
		return $deps;
	}

	public function pe_theme_asset_script_pe_theme_init_deps_filter($deps) {
		PeThemeAsset::addScript("framework/js/pe/jquery.pixelentity.woocommerce.js",array("jquery"),"pe_theme_woocommerce");
		$deps[] = "pe_theme_woocommerce";
		return $deps;
	}



}

?>
