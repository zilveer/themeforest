<?php

class BFIScriptController {
    
    function __construct() {
        add_action('wp_enqueue_scripts', array($this, 'loadFrontEndScripts'));
    }

    public function loadFrontEndScripts() {
        // Tame Internet Explorer
        bfi_wp_enqueue_script('html5shim', 'http://html5shim.googlecode.com/svn/trunk/html5.js', array(), NULL, false, 'lt IE 9');
        bfi_wp_enqueue_script('selectivizr', '//cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js', array(), NULL, false, 'lt IE 9');
        
        // IE specific styles
        bfi_wp_enqueue_style('ie8', 'css/ie8.css', array('*'), NULL, 'all', 'lte IE 8');
        bfi_wp_enqueue_style('ie9', 'css/ie9.css', array('*'), NULL, 'all', 'IE 9');

		// If there is a background image, then enqueue backstretch
		if (bfi_get_option('style_background') == 'upload' && 
		    bfi_get_option('style_background_image') != '' &&
		    bfi_get_option('style_background_type') == 'stretch') {
	        bfi_wp_enqueue_script('backstretch', '//cdnjs.cloudflare.com/ajax/libs/jquery-backstretch/2.0.3/jquery.backstretch.min.js', array('jquery'), NULL, true);
        }		

        bfi_wp_enqueue_script('sharrre', '//cdn.jsdelivr.net/sharrre/1.3.4/jquery.sharrre-1.3.4.min.js', array('jquery'), NULL, true);

        if (bfi_get_option('heading_font_type') == "googlewebfont") {
            // enqueue the google font for the headings
            bfi_wp_enqueue_googlefont('style_googlefont', array());
        }
				
		// load font awesome (for now use bootstrap cdn since cdnjs hasn't been fixed yet)
		bfi_wp_enqueue_style('fontawesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/3.0.0/css/font-awesome.min.css', array(), NULL);
            
        // dependencies of the main script, these are the scripts we initialize
		$deps = array('jquery', 'fancybox', 'ddsmoothmenu', 'lazyload');
		
		// load main script
        bfi_wp_enqueue_script('bfi', 'scripts/bfi.min.js', $deps, NULL, true);
        
        // load lazy load script
        bfi_wp_enqueue_script('lazyload', '//cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.8.3/jquery.lazyload.min.js', array('jquery'), NULL, true);
        
        // load infinite scroll script
        bfi_wp_enqueue_script('infinitescroll', '//cdnjs.cloudflare.com/ajax/libs/jquery-infinitescroll/2.0b2.110713/jquery.infinitescroll.min.js', array('jquery'), NULL, true);

		// load base style
		bfi_wp_enqueue_style('style', BFI_TEMPLATEURL.'style.min.css');
		
		// load theme style
        bfi_wp_enqueue_style('application', 'css/application.css', array('ddsmoothmenu', 'style'), NULL);
		
		// load customized (via admin) theme style
        bfi_wp_enqueue_style('custom', 'css/custom.php', array('application'), NULL);
        
        // right-to-left styles
        if (is_rtl()) {
            bfi_wp_enqueue_style('rtl', 'css/rtl.css', array('application'), NULL);
        }
		
		// load fancybox
		bfi_wp_enqueue_script('fancybox', '//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.4/jquery.fancybox.pack.js', array('jquery'), NULL, true);
		bfi_wp_enqueue_style('fancybox', '//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.4/jquery.fancybox.css');
		
        bfi_wp_enqueue_script('ddsmoothmenu', 'scripts/ddsmoothmenu/ddsmoothmenu.min.js', array('jquery'), NULL, true);
        bfi_wp_enqueue_style('ddsmoothmenu', 'scripts/ddsmoothmenu/ddsmoothmenu.css');
        // bfi_wp_enqueue_script('ddsmoothmenu', '//cdn.jsdelivr.net/ddsmoothmenu/1.51/ddsmoothmenu.js', array('jquery'), NULL);
        // bfi_wp_enqueue_style('ddsmoothmenu', '//cdn.jsdelivr.net/ddsmoothmenu/1.51/ddsmoothmenu.css', array(), NULL);
				
        // jquery tools is used for form validation in comments (used in contact also, but the shortcode
        // enqueues the script)
        if (is_singular() && comments_open()) {
            bfi_wp_enqueue_script('comment-reply', false, array(), NULL, true);
            bfi_wp_enqueue_script('jquery-validate', '//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.10.0/jquery.validate.min.js', array('jquery'), NULL, true);
        }
        
        
    }
}
