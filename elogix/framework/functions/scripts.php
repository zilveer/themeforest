<?php

/* ---------------------------------------------------- */
/* Javascripts											*/
/* ---------------------------------------------------- */

function register_scripts() {
	wp_deregister_script('jquery'); // register local jquery
	wp_register_script('jquery', get_template_directory_uri() . '/framework/js/jquery.js', 'jquery', '1.7');
	wp_register_script('easing', get_template_directory_uri() . '/framework/js/jquery.easing.js', 'jquery', '1.0', TRUE);
	wp_register_script('selectivizr', get_template_directory_uri() . '/framework/js/selectivizr.js', 'jquery', '1.0', TRUE);
	wp_register_script('mediaqueries', get_template_directory_uri() . '/framework/js/mediaqueries.js', 'jquery', '1.0', TRUE);
	wp_register_script('superfish', get_template_directory_uri() . '/framework/js/superfish.js', 'jquery', '1.0', TRUE);
	
	wp_register_script('isotope', get_template_directory_uri() . '/framework/js/jquery.isotope.js', 'jquery', '1.0', TRUE);
	wp_register_script('prettyphoto', get_template_directory_uri() . '/framework/js/jquery.prettyPhoto.js', 'jquery', '1.0', TRUE);
	wp_register_style('prettyphoto_css', get_bloginfo('stylesheet_directory').'/framework/js/prettyPhoto/css/prettyPhoto.css');
	wp_register_script('slider', get_template_directory_uri() . '/framework/js/jquery.flexslider.js', 'jquery', '1.0');
	wp_register_script('sliderscript', get_template_directory_uri() . '/framework/js/slider.js', 'jquery', '1.0', TRUE);
	wp_register_script('carousel', get_template_directory_uri() . '/framework/js/jquery.jcarousel.js', 'jquery', '1.0', TRUE);
	wp_register_script('mobilemenu', get_template_directory_uri() . '/framework/js/jquery.mobilemenu.js', 'jquery', '1.0', TRUE);
	wp_register_script('touchwipe', get_template_directory_uri() . '/framework/js/jquery.touchwipe.min.js', 'jquery', '1.0', TRUE);
  wp_register_script('twitter', get_template_directory_uri() . '/framework/js/twitter.js', 'jquery', '1.0', TRUE);
	
	wp_register_script('scripts', get_template_directory_uri() . '/framework/js/scripts.js', 'jquery', '1.0', TRUE);
	wp_register_script('work', get_template_directory_uri() . '/framework/js/work.js', 'jquery', '1.0', TRUE);
}

 

/* ---------------------------------------------------- */
/* Load Scripts											*/
/* ---------------------------------------------------- */

function print_scripts() {
	// load scripts into queue
	wp_enqueue_script('jquery');
  	wp_enqueue_script('easing');
  	wp_enqueue_script('selectivizr');
  	wp_enqueue_script('mediaqueries');
  	wp_enqueue_script('superfish');
  	wp_enqueue_script('mobilemenu');
  	wp_enqueue_style('prettyphoto_css');
  	wp_enqueue_script('prettyphoto');
  	wp_enqueue_script('slider');
    wp_enqueue_script('twitter');
  
  // portfolio scripts
  if(is_page_template('page-work.php')) {
     wp_enqueue_script('isotope');
     wp_enqueue_script('work');
  }
  
  if(is_singular('work')) {
     wp_enqueue_script('sliderscript');
  }
  
  if(is_page_template('page-home.php')) {
  	 wp_enqueue_script('touchwipe');
     wp_enqueue_script('carousel');
     wp_enqueue_script('sliderscript');
  }
    
  // comments reply wordpress script
  if(is_singular() && comments_open() && get_option( 'thread_comments' )) {
   	wp_enqueue_script( 'comment-reply' );
  }  
 
  wp_enqueue_script('scripts');
}

// add scripts not on dashboard
if(!is_admin()) {
 	add_action('init','register_scripts');
 	add_action('wp_print_scripts','print_scripts');
}

/* ---------------------------------------------------- */
/* Load Custom Styles                     */
/* ---------------------------------------------------- */

function minti_styles_custom() {
      $color = of_get_option('primary_colorpicker');
      $logo_margin = of_get_option('logo_margin');
      $header_height = of_get_option('header_height');
      $default_background = of_get_option('default_background');
      $customcss = of_get_option('css_code');
?>

<style>

#logo{margin-top:<?php echo $logo_margin; ?>!important}

a:hover, .post-entry h2 a:hover{color:<?php echo $color; ?>}

#contactform #submit:hover{background-color:<?php echo $color; ?>}

::-moz-selection{background-color:<?php echo $color; ?>}
.::selection{background-color:<?php echo $color; ?>}

.color-hr{background:<?php echo $color; ?>}

#infobar{background:<?php echo $color; ?>}

#infobar .openbtn{background-color:<?php echo $color; ?>}

#infobar2{background-color:<?php echo $color; ?>}

#nav ul li a:hover{color:<?php echo $color; ?>; border-color:<?php echo $color; ?>}

#nav ul li.current-menu-item a, 
#nav ul li.current-page-ancestor a, 
#nav ul li.current-menu-ancestor a{border-color:<?php echo $color; ?>; background-color:<?php echo $color; ?>; color:<?php echo $color; ?>}

#nav ul li.current-menu-item ul li a:hover, 
#nav ul li.current-page-ancestor ul li a:hover, 
#nav ul li.current-menu-ancestor ul li a:hover{color:<?php echo $color; ?>!important}

#nav ul.sub-menu{border-color:<?php echo $color; ?>}

#latestposts .entry a.readmore{color:<?php echo $color; ?>}

#latestwork .entry:hover{border-color:<?php echo $color; ?>}
#latestwork .entry:hover h4 a{color:<?php echo $color; ?>}

#latestwork .entry:hover img{border-color:<?php echo $color; ?>}

a.work-carousel-prev:hover{background-color:<?php echo $color; ?>}

a.work-carousel-next:hover{background-color:<?php echo $color; ?>}

.post-thumb a:hover{border-color:<?php echo $color; ?>}

.big-post-thumb img{border-color:<?php echo $color; ?>}

.post-entry a.readmore{color:<?php echo $color; ?>}
.post-entry a.readmore:hover{background-color:<?php echo $color; ?>}

.meta a:hover{color:<?php echo $color; ?>}

.navigation a:hover{color:<?php echo $color; ?>}

a#cancel-comment-reply-link{color:<?php echo $color; ?>}

#commentform #submit:hover{background-color:<?php echo $color; ?>}
.posts-prev a:hover, .posts-next a:hover{background-color:<?php echo $color; ?>}

#filters li a:hover{color:<?php echo $color; ?>}

.work-item:hover{background-color:#fff; border-color:<?php echo $color; ?>}
.work-item:hover h3 a{color:<?php echo $color; ?>}

.work-item:hover img{border-color:<?php echo $color; ?>}

#sidebar .widget_nav_menu li.current-menu-item a{color:<?php echo $color; ?>!important}

#sidebar a:hover{color:<?php echo $color; ?>}

#breadcrumb a:hover{color:<?php echo $color; ?>}

#lasttweet{background-color:<?php echo $color; ?>}

.plan.featured{border-color:<?php echo $color; ?>}
.pricing-table .plan.featured:last-child{border-color:<?php echo $color; ?>}

.plan.featured h3{background-color:<?php echo $color; ?>}

.plan.featured .price{background-color:<?php echo $color; ?>}

.toggle .title:hover{color:<?php echo $color; ?>}
.toggle .title.active{color:<?php echo $color; ?>}

ul.tabNavigation li a.active{ color:<?php echo $color; ?>;  border-bottom:1px solid #fff;  border-top:1px solid <?php echo $color; ?>}

ul.tabNavigation li a:hover{color:<?php echo $color; ?>}

.button{ background-color:<?php echo $color; ?>}

#home-slider .flex-control-nav li a:hover{background:<?php echo $color; ?>}
#home-slider .flex-control-nav li a.active{background:<?php echo $color; ?>}

.accordion .title.active a{color:<?php echo $color; ?>!important}

#latestposts .entry a.readmore:hover{background-color:<?php echo $color; ?>}

.post-entry h2 a:hover, .search-result h2 a:hover, .work-detail-description a:hover{color:<?php echo $color; ?>}

<?php echo $customcss; ?>

@media only screen and (max-width: 767px) {
  #header{
    border-top:6px solid <?php echo $color; ?>;
  }
}

</style>

<?php }
add_action( 'wp_head', 'minti_styles_custom', 100 );

/* ---------------------------------------------------- */
/* EOF */
/* ---------------------------------------------------- */

?>