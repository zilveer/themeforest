<?php
/*
* This file handles javascript register, enqueue, hook etc.
*/

function truethemes_manage_javascripts_scripts(){

if (!is_admin()) {

/*--------------------------------------------------------------
Grab Variables for localize custom-main.js
--------------------------------------------------------------*/
//http://codex.wordpress.org/Function_Reference/wp_localize_script
global $ttso;
$sticky_sidebar          = $ttso->st_sticky_sidebar;
$sticky_header_menu      = $ttso->st_fix_header_and_menubar;

//set the data into array, prepare for wp_localize_script()
$data = array(
'sticky_sidebar'         => $sticky_sidebar,
'sticky_header_menu'     => $sticky_header_menu,
);


/*-----------------------------------------------------------------*/
/* Deregister Scripts
/*-----------------------------------------------------------------*/
wp_deregister_script('comment-reply');

/*-----------------------------------------------------------------*/
/* Register Scripts
/*-----------------------------------------------------------------*/
//@since version 2.2.2 dev 3 modified by denzel
if(is_rtl()){
	//if it is Right to Left Language enabled on site, we load rtl slider script, else we load normal slider script
	wp_register_script('jquery-slides', TT_JS .'/slides.min.jquery.rtl.js', array('jquery'), '',$in_footer = true);
}else{
	wp_register_script('jquery-slides', TT_JS .'/slides.min.jquery.js', array('jquery'), '',$in_footer = true);
}
wp_register_script( 'comment-reply', site_url().'/wp-includes/js/comment-reply.js',$deps=null,'',$in_footer = true);
wp_register_script( 'truethemes-custom', TT_JS .'/custom-main.js', array('jquery'),'',$in_footer = true);
wp_register_script( 'truethemes-lightbox', TT_JS .'/jquery.prettyPhoto.js', array('jquery'),'',$in_footer = true);
wp_register_script( 'jquery-cycle-all', TT_JS .'/jquery.cycle.all.min.js', array('jquery'),'',$in_footer = true);
wp_register_script('jquery-easing', TT_JS .'/jquery.easing.1.3.js', array('jquery'), '',$in_footer = true);
wp_register_script( 'jquery-superfish', TT_JS .'/jquery.superfish.js', array('jquery'),'',$in_footer = true);
wp_register_script('jquery-isotope', TT_JS .'/jquery.isotope.js', array('jquery'), '',$in_footer = true);
wp_register_script('jquery-scrollto', TT_JS .'/jquery.scrollTo-min.js', array('jquery'), '',$in_footer = true);
wp_register_script('jquery-highlight', TT_JS .'/jquery.highlightFade.js', array('jquery'), '',$in_footer = true);
wp_register_script( 'truethemes-custom-faq', TT_JS .'/custom-faq.js', array('jquery'),'',$in_footer = true);
wp_register_script('custom-counter', TT_JS .'/custom-counter.js', array('jquery'), '',$in_footer = true);


/*-----------------------------------------------------------------*/
/* Enqueue Scripts
/*-----------------------------------------------------------------*/
//global scripts
wp_enqueue_script( 'comment-reply', site_url().'/wp-includes/js/comment-reply.js',$deps=null,'',$in_footer = true);
wp_enqueue_script( 'truethemes-custom', TT_JS .'/custom-main.js', array('jquery'),'1.0',$in_footer = true);
wp_enqueue_script( 'jquery-slides', TT_JS .'/slides.min.jquery.js', array('jquery'), '',$in_footer = true);
wp_enqueue_script( 'truethemes-lightbox', TT_JS .'/jquery.prettyPhoto.js', array('jquery'),'',$in_footer = true);
wp_enqueue_script( 'jquery-superfish', TT_JS .'/jquery.superfish.js', array('jquery'),'',$in_footer = true);
wp_enqueue_script( 'jquery-cycle-all', TT_JS .'/jquery.cycle.all.min.js', array('jquery'),'',$in_footer = true);
wp_enqueue_script( 'jquery-easing', TT_JS .'/jquery.easing.1.3.js', array('jquery'), '',$in_footer = true);
wp_enqueue_script( 'jquery-isotope', TT_JS .'/jquery.isotope.js', array('jquery'), '',$in_footer = true);

//localize custom-main.js (must be placed after enqueue)
wp_localize_script('truethemes-custom', 'php_data', $data);

//FAQ page template scripts
if (is_page_template('page-template-faq.php')) {
wp_enqueue_script( 'jquery-scrollto', TT_JS .'/jquery.scrollTo-min.js', array('jquery'), '',$in_footer = true);
wp_enqueue_script( 'jquery-highlight', TT_JS .'/jquery.highlightFade.js', array('jquery'), '',$in_footer = true);
wp_enqueue_script( 'truethemes-custom-faq', TT_JS .'/custom-faq.js', array('jquery'),'',$in_footer = true);
}

//Under Construction page template scripts
if (is_page_template('page-template-under-construction.php')) {
wp_enqueue_script('custom-counter', TT_JS .'/custom-counter.js', array('jquery'), '',$in_footer = true);
}


/*-----------------------------------------------------------------*/
/* WooCommerce Custom Enqueue
/*-----------------------------------------------------------------*/
//check for plugin
if (class_exists('woocommerce') && ((is_woocommerce() == "true") || (is_checkout() == "true") || (is_cart() == "true") || (is_account_page() == "true") )){

//de-regsiter unnecessary scripts
wp_deregister_script('comment-reply');
wp_deregister_script('jquery-cycle-all');
wp_deregister_script('jquery-easing');

//regsiter and enqueue scripts
wp_register_script('truethemes-woocommerce', TT_JS .'/custom-woocommerce.js', array('jquery'), '',$in_footer = true);
wp_enqueue_script('truethemes-woocommerce', TT_JS .'/custom-woocommerce.js', array('jquery'), '',$in_footer = true);
}
	
}
}
//hook in last, so that plugins cannot change this? Maybe.
//hook in template redirect instead of init so that is_single() conditional tags works.
add_action('template_redirect', 'truethemes_manage_javascripts_scripts',90);