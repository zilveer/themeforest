<?php

	/*
	*
	*	Swift Page Builder - Build Class
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2013 - http://www.swiftideas.net
	*
	*/

	if (!defined('ABSPATH')) die('-1');
	
	class SFPageBuilderSetup extends SFPageBuilderAbstract {
	    
	    public static $version = '2.0';
	    protected $swift_page_builder;
	
	    public function __construct() {
	    }
	
	    public function init($settings) {
	        parent::init($settings);
	
	        $this->swift_page_builder = SwiftPageBuilder::getInstance();
						
	        $this->swift_page_builder->setTheme();
	        $this->setUpTheme();
	
	    }
	
	    public function setUpPlugin() {
	        register_activation_hook( __FILE__, Array( $this, 'activate' ) );
	        if (!is_admin()) {
	            $this->addAction('template_redirect', 'frontCss');
	            $this->addAction('template_redirect', 'frontJsRegister');
	            $this->addFilter('the_content', 'fixPContent', 10000);
	        }
	    }
	
	    public function fixPContent($content = null) {
	        $s = array("<p><div class=\"row-fluid\"", "</div></p>");
	        $r = array("<div class=\"row-fluid\"", "</div>");
	        $content = str_ireplace($s, $r, $content);
	        return $content;
	    }

	    public function activate() {
	        add_option( 'spb_do_activation_redirect', true );
	    }
	
	    public function setUpTheme() {
		    if (!is_admin()) {
		        $this->addFilter('the_content', 'fixPContent', 10000);
		   	}
	    }
	}
	
	/* SETUP FOR ADMIN
	================================================== */ 
	class SFPageBuilderSetupAdmin extends SFPageBuilderSetup {
	    
	    public function __construct() {
	        parent::__construct();
	    }
		
	    public function setUpTheme() {
	        parent::setUpPlugin();
	
	        $this->swift_page_builder->addAction( 'edit_post', 'saveMetaBoxes' );
	        $this->swift_page_builder->addAction( 'wp_ajax_spb_get_element_backend_html', 'elementBackendHtmlJavascript_callback' );
	        $this->swift_page_builder->addAction( 'wp_ajax_spb_shortcodes_to_builder', 'spbShortcodesJS_callback' );
	        $this->swift_page_builder->addAction( 'wp_ajax_spb_show_edit_form', 'showEditFormJavascript_callback' );
	        $this->swift_page_builder->addAction( 'wp_ajax_spb_show_small_edit_form', 'showSmallEditFormJavascript_callback' );
	        $this->swift_page_builder->addAction( 'wp_ajax_spb_save_template', 'saveTemplateJavascript_callback' );
	        $this->swift_page_builder->addAction( 'wp_ajax_spb_load_template', 'loadTemplateJavascript_callback' );
	        $this->swift_page_builder->addAction( 'wp_ajax_sf_load_template', 'loadSFTemplateJavascript_callback' );
	        $this->swift_page_builder->addAction( 'wp_ajax_spb_delete_template', 'deleteTemplateJavascript_callback' );
	
	        /* Add specific CSS class by filter */
	        $this->addFilter( 'body_class', 'pageBuilderBodyClass' );
	        $this->addFilter( 'get_media_item_args', 'jsForceSend' );
	
	        $this->addAction( 'admin_init', 'swiftPageBuilderRedirect' );
	        $this->addAction( 'admin_init', 'swiftPageBuilderEditPage', 5 );
	
	        $this->addAction( 'admin_init', 'registerCss' );
	        $this->addAction( 'admin_init', 'registerJavascript' );
	
	        $this->addAction( 'admin_print_scripts-post.php', 'swiftPageBuilderScripts' );
	        $this->addAction( 'admin_print_scripts-post-new.php', 'swiftPageBuilderScripts' );
	
	        /* Create Media tab for images */
	        $this->swift_page_builder->createImagesMediaTab();
	    }
	
	    public function pageBuilderBodyClass($classes) {
	        $classes[] = 'page-builder page-builder-version-'.SPB_VERSION;
	        return $classes;
	    }
	
	    public function jsForceSend($args) {
	        $args['send'] = true;
	        return $args;
	    }
	
	    public function swiftPageBuilderScripts() {
			wp_enqueue_style( 'bootstrap' );
			wp_enqueue_style( 'ui-custom-theme' );
			wp_enqueue_style( 'page-builder-css' );
			wp_enqueue_style( 'colorpicker-css' );
			wp_enqueue_style( 'uislider-css' );
			wp_enqueue_style( 'chosen-css' );
			
			wp_enqueue_script( 'jquery-ui-tabs' );
			wp_enqueue_script( 'jquery-ui-droppable' );
			wp_enqueue_script( 'jquery-ui-draggable' );
			wp_enqueue_script( 'jquery-ui-accordion' );
			wp_enqueue_script( 'jquery-ui-button' );
			
			wp_enqueue_script( 'bootstrap-js' );
			wp_enqueue_script( 'page-builder-js' );
			wp_enqueue_script( 'colorpicker-js' );
			wp_enqueue_script( 'uislider-js' );
			wp_enqueue_script( 'chosen-js' );
	    }
	
	    public function registerJavascript() {
	        wp_register_script( 'page-builder-js', $this->assetURL( 'js/page-builder.js' ), array( 'jquery' ), SPB_VERSION, true );
            wp_register_script( 'bootstrap-js', $this->assetURL( 'js/bootstrap.min.js' ), false, SPB_VERSION, false );
            wp_register_script( 'colorpicker-js', $this->assetURL( 'js/jquery.minicolors.min.js' ), array( 'jquery' ), SPB_VERSION, true );
            wp_register_script( 'uislider-js', $this->assetURL( 'js/jquery.nouislider.min.js' ), array( 'jquery' ), SPB_VERSION, true );
            wp_register_script( 'chosen-js', $this->assetURL( 'js/chosen.jquery.min.js' ), array( 'jquery' ), SPB_VERSION, true );
	    }
	
	    public function registerCss() {
	        wp_register_style( 'bootstrap', $this->assetURL( 'css/bootstrap.css' ), false, SPB_VERSION, false );
	        wp_register_style( 'page-builder-css', $this->assetURL( 'css/page-builder.css' ), false, null, false );
	        wp_register_style( 'colorpicker-css', $this->assetURL( 'css/jquery.minicolors.css' ), false, null, false );
	        wp_register_style( 'uislider-css', $this->assetURL( 'css/jquery.nouislider.min.css' ), false, null, false );
	        wp_register_style( 'chosen-css', $this->assetURL( 'css/chosen.min.css' ), false, null, false );
	    }
	    
	    public function swiftPageBuilderEditPage() {
	        $pt_array = $this->swift_page_builder->getPostTypes();
	        foreach ($pt_array as $pt) {
	            add_meta_box( 'swift_page_builder', __('Swift Page Builder', "swiftframework"), Array($this->swift_page_builder->getLayout(), 'output'), $pt, 'normal', 'high');
	        }
	    }
	
	    public function swiftPageBuilderRedirect() {
	        if ( get_option('spb_do_activation_redirect', false) ) {
	            delete_option('spb_do_activation_redirect');
	            wp_redirect(admin_url().'options-general.php?page=spb_settings');
	        }
	    }
	}

?>
