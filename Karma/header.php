<!DOCTYPE html>
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="en"> <![endif]-->
<!--[if !IE]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<?php
// retrieve values from site options panel
global $ttso;
$ka_sitelogo                  = $ttso->ka_sitelogo;
$ka_logo_icon                 = $ttso->ka_logo_icon;
$ka_logo_text                 = $ttso->ka_logo_text;
$ka_logo_alt                  = $ttso->ka_logo_alt;
$ka_toolbar                   = $ttso->ka_toolbar;
$ka_toolbar_right             = $ttso->ka_toolbar_right;
$ka_toolbar_left              = $ttso->ka_toolbar_left;
$boxedlayout                  = $ttso->ka_boxedlayout;
$responsive                   = $ttso->ka_responsive;
$true_logo                    = $ttso->ka_true_logo;
$true_logo_retina             = $ttso->ka_sitelogo_retina;
$true_logo_width              = $ttso->ka_sitelogo_width;
$true_logo_height             = $ttso->ka_sitelogo_height;
$apple_iphone                 = $ttso->ka_apple_iphone;
$apple_iphone_114             = $ttso->ka_apple_iphone_114;
$apple_ipad_72                = $ttso->ka_apple_ipad_72;
$apple_ipad_144               = $ttso->ka_apple_ipad_144;
$div_main_style               = $ttso->ka_div_main_style;
$div_main_custom_color        = $ttso->ka_div_main_custom_color;
$header_transparent_overlay   = $ttso->ka_header_transparent_overlay;
$customcode_head              = $ttso->ka_customcode_head;
$font_kit_modern              = $ttso->ka_font_kit_modern;
$font_kit_serif               = $ttso->ka_font_kit_serif;
$font_kit_organic             = $ttso->ka_font_kit_organic;
$ubermenu                     = $ttso->ka_ubermenu;
$ubermenu_styling             = $ttso->ka_ubermenu_karma_styling;

//pre-define options for backward-compatible
if ('' == $div_main_style): 'content-style-default'        ==  $div_main_style; endif;
if ('' == $header_transparent_overlay): 'overlay-rays.png' ==  $header_transparent_overlay; endif;
if ('' == $ubermenu):         $ubermenu         = 'false'; endif;
if ('' == $ka_toolbar_right): $ka_toolbar_right = 'true';  endif;
if ('' == $ka_toolbar_left):  $ka_toolbar_left  = 'true';  endif;

//define ALT text to be used for Logo
if(!empty($ka_logo_alt)) {
	$truethemes_logo_text = $ka_logo_alt; } else { $truethemes_logo_text = get_bloginfo('name');
}

//strip "px" from strings for valid HTML markup
$true_logo_width_px   = str_replace("px", "", $true_logo_width);
$true_logo_height_px  = str_replace("px", "", $true_logo_height);


//determine users logo position setting ($true_logo_class gets added to .header-holder div on line 188)
if ('tt-logo-right' == $true_logo){ $true_logo_class  = 'tt-logo-right';}
	elseif ('tt-logo-center' == $true_logo){ $true_logo_class  = 'tt-logo-center';} 
	else { $true_logo_class  = ''; }

//check for jquery-2 or 3d-cuber sliders...add special class to .header-holder for CSS3 styling
if(is_home()){
$post_id             = get_option('page_on_front');
	} else {
global $post;
@$post_id             = $post->ID;
$karma_slider_type2   = get_post_meta($post_id, 'karma_slider_type', true);
$cu3er_page_slider2   = get_post_meta($post_id, 'slider_3d_cu3er_id', true);

$true_tall_header='';
if ( ('null' != $karma_slider_type2) && ('karma-custom-jquery-2' == $karma_slider_type2)) {
	$true_tall_header       = ' tt-header-holder-tall';}
if ('' != $cu3er_page_slider2) {
	$true_tall_header       = ' tt-header-holder-tall';}
}

//check for responsive layout
if('true' != $responsive):?>
<!-- un-comment and delete 2nd meta below to disable zoom (not cool)
<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1"> -->
<meta name="viewport" content="width=device-width, initial-scale=1" />
<?php endif; //end responsive check
truethemes_meta_hook();// action hook ?>

<title><?php wp_title('&ndash;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>" href="<?php bloginfo('rss2_url'); ?>" />

<?php //Font Kits
if('true' == $font_kit_modern): ?>
<link href='//fonts.googleapis.com/css?family=Open+Sans|Lato' rel='stylesheet' type='text/css'>
<?php endif;
if('true' == $font_kit_serif): ?>
<link href='//fonts.googleapis.com/css?family=PT+Serif|Source+Sans+Pro' rel='stylesheet' type='text/css'>
<?php endif;
if('true' == $font_kit_organic): ?>
<link href='//fonts.googleapis.com/css?family=Varela+Round|Open+Sans' rel='stylesheet' type='text/css'>
<?php endif; //END Font Kits ?>

<?php wp_head(); ?>

<?php get_template_part('theme-template-part-page-styling','childtheme'); ?>
<!--[if IE 9]>
<style media="screen">
#footer,
.header-holder
 {
      behavior: url(<?php echo get_template_directory_uri(); ?>/js/PIE/PIE.php);
}
</style>
<![endif]-->

<!--[if lte IE 8]>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/html5shiv.js'></script>
<style media="screen">
/* uncomment for IE8 rounded corners
#menu-main-nav .drop ul a,
#menu-main-nav .drop,
#menu-main-nav ul.sub-menu,
#menu-main-nav .drop .c, 
#menu-main-nav li.parent, */

a.button,
a.button:hover,
ul.products li.product a img,
div.product div.images img,
span.onsale,
#footer,
.header-holder,
#horizontal_nav ul li,
#horizontal_nav ul a,
#tt-gallery-nav li,
#tt-gallery-nav a,
ul.tabset li,
ul.tabset a,
.karma-pages a,
.karma-pages span,
.wp-pagenavi a,
.wp-pagenavi span,
.post_date,
.post_comments,
.ka_button,
.flex-control-paging li a,
.colored_box,
.tools,
.karma_notify
.opener,
.callout_button,
.testimonials {
      behavior: url(<?php echo get_template_directory_uri(); ?>/js/PIE/PIE.php);
}
<?php if('overlay-rays.png' == $header_transparent_overlay): ?>
#header .header-overlay {
	background-image: none;
	filter: progid:DXImageTransform.Microsoft.AlphaImageLoader( src='<?php echo get_template_directory_uri(); ?>/images/_global/overlay-rays.png', sizingMethod='scale');
    -ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader( src='<?php echo get_template_directory_uri(); ?>/images/_global/overlay-rays.png', sizingMethod='scale')";
}
<?php endif; ?>
</style>
<![endif]-->

<!--[if IE]>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/_internet_explorer.css" media="screen"/>
<![endif]-->

<?php //Apple Touch Icons 

if ('' != $apple_iphone): ?>
<!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
<link rel="apple-touch-icon-precomposed" href="<?php echo $apple_iphone; ?>">
<?php endif;?>

<?php if ('' != $apple_iphone_114): ?>
<!-- For iPhone with high-resolution Retina display: -->
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $apple_iphone_114; ?>">
<?php endif;?>

<?php if ('' != $apple_ipad_72): ?>
<!-- For first- and second-generation iPad: -->
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $apple_ipad_72; ?>">
<?php endif;?>

<?php if ('' != $apple_ipad_144): ?>
<!-- For third-generation iPad with high-resolution Retina display: -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $apple_ipad_144; ?>">
<?php endif;

//Custom CSS Code from Site Options Panel
if ('' != $customcode_head): echo stripslashes($customcode_head) . "\n"; endif; ?>
</head>

<body <?php body_class(); ?>>
<div id="<?php if ( 'true' == $boxedlayout ){echo 'tt-boxed-layout';} else { echo 'tt-wide-layout';} ?>" class="<?php if ('' != $div_main_custom_color){echo 'content-custom-bg';} else {echo $div_main_style;} ?>">
	<div id="wrapper"<?php if ( 'true' == $ubermenu_styling ){echo ' class="tt-uberstyling-enabled"';} ?>>
		<header role="banner" id="header" <?php if (is_page_template('template-homepage-3D.php')){echo "style='height: 560px;'";} ?>>
<?php if ('true' == $ka_toolbar): ?>
<div class="top-block">
<div class="top-holder">

  <?php truethemes_before_top_toolbar_menu_hook();// action hook ?>
  
<?php if ('true' == $ka_toolbar_left): ?>
  <div class="toolbar-left">
  <?php if(has_nav_menu('Top Toolbar Navigation')):
    
 		echo '<ul>'; wp_nav_menu(array('theme_location' => 'Top Toolbar Navigation' , 'depth' => 0 , 'container' =>false )); echo '</ul>';
		
		else: dynamic_sidebar("Toolbar - Left Side"); endif; ?>
  </div><!-- END toolbar-left -->
<?php endif; //end toolbar_left check ?>
  
<?php if ('true' == $ka_toolbar_right): ?>
  <div class="toolbar-right">
  <?php if(is_active_sidebar(2)): dynamic_sidebar("Toolbar - Right Side"); 
  		elseif(current_user_can( 'install_plugins' )): _e('Add Social Networks Widget in WP Dashboard: <a href="'.admin_url( 'widgets.php' ).'" style="text-decoration:underline;">Appearance > Widgets</a>', 'truethemes_localize');
		endif; ?>
  </div><!-- END toolbar-right -->
<?php endif; //end toolbar_right check ?>

<?php truethemes_after_top_toolbar_menu_hook();// action hook ?>
</div><!-- END top-holder -->
</div><!-- END top-block -->
<?php endif; //end if('true' == $toolbar)

truethemes_before_header_holder_hook();// action hook
?>

<div class="header-holder <?php echo $true_logo_class.@$true_tall_header; ?>">
<div class="header-overlay">
<div class="header-area<?php if (is_search()) {echo ' search-header';} ?><?php if (is_404()) {echo ' error-header';} ?><?php if (is_page_template('template_sitemap.php')) {echo ' search-header';} ?>">

<?php // Website Logo
if (('' == $ka_logo_text) && ('' == $true_logo_retina)){ //display uploaded logo image ?>
<a href="<?php echo home_url(); ?>" class="logo"><img src="<?php echo $ka_sitelogo; ?>" alt="<?php echo $truethemes_logo_text; ?>" /></a>

<?php } elseif (('' == $ka_logo_text) && ('' != $true_logo_retina)){ //display uploaded retina logo ?>
<a href="<?php echo home_url(); ?>" class="logo"><img src="<?php echo $true_logo_retina; ?>" alt="<?php echo $truethemes_logo_text; ?>" class="tt-retina-logo" width="<?php echo $true_logo_width_px; ?>" height="<?php echo $true_logo_height_px; ?>" /></a>

<?php } else { //display logo builder logo ?>
<a href="<?php echo home_url(); ?>" class="custom-logo"><img src="<?php echo get_template_directory_uri(); ?>/images/_global/<?php echo $ka_logo_icon; ?>" alt="<?php echo $truethemes_logo_text; ?>" /><span class="logo-text"><?php echo $ka_logo_text; echo '</span></a>';
} // END Website Logo ?>

<?php truethemes_before_primary_navigation_hook();// action hook ?>

<nav role="navigation">
<?php if('true' == $ubermenu):
	wp_nav_menu(array(
		'theme_location' => 'Primary Navigation' ,
		'depth'          => 0 ,
		'container'      => false ,
		'walker'         => new description_walker() ));
else: ?>
<ul id="menu-main-nav" class="sf-menu">
<?php wp_nav_menu(array(
		'theme_location' => 'Primary Navigation' ,
		'depth'          => 0 ,
		'container'      => false ,
		'walker'         => new description_walker() )); ?>
</ul>
<?php endif; //end uberMenu check  ?>
</nav>
<?php truethemes_after_primary_navigation_hook();// action hook ?>