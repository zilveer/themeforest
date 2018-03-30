<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes() ?>>
<head>
	
<meta http-equiv="Content-Type"
	content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title>
<?php if (is_home() || is_front_page()) {
	if(pex_text('_seo_home_title')){
		echo pex_text('_seo_home_title').' '.get_opt('_seo_serapartor').' ';
	}
	echo bloginfo('name');
} elseif (is_category()) {
	echo pex_text('_seo_category_title'); wp_title('&laquo; '.get_opt('_seo_serapartor').' ', TRUE, 'right');
	echo bloginfo('name');
} elseif (is_tag()) {
	echo pex_text('_seo_tag_title'); wp_title('&laquo; '.get_opt('_seo_serapartor').' ', TRUE, 'right');
	echo bloginfo('name');
} elseif (is_search()) {
	echo pex_text('_search_tag_title');
	echo the_search_query();
	echo '&laquo; '.get_opt('_seo_serapartor').' ';
	echo bloginfo('name');
} elseif (is_404()) {
	echo '404 '; wp_title(' '.get_opt('_seo_serapartor').' ', TRUE, 'right');
	echo bloginfo('name');
} else {
	echo wp_title(' '.get_opt('_seo_serapartor').' ', TRUE, 'right');
	echo bloginfo('name');
} ?>
</title>

<!-- Description meta-->
<meta name="description" content="<?php if ((is_home() || is_front_page()) && get_opt('_seo_description')) { echo (get_opt('_seo_description')); }else{ bloginfo('description');}?>" />

<?php if(get_opt('_seo_keywords')){ ?>
<!-- Keywords-->
<meta name="keywords" content="<?php echo get_opt('_seo_keywords'); ?>" />
<?php } ?>

<?php $responsive = get_opt('_responsive_layout')=='off'?false:true; 
	if($responsive){ ?>
	<!-- Mobile Devices Viewport Resset-->
	<meta name="viewport" content="width=device-width, initial-scale=0.9, maximum-scale=1">
	<meta name="apple-mobile-web-app-capable" content="yes">
<?php } ?>

<?php 
//remove SEO indexation and following for the selected archives pages
if(is_archive() || is_search()){
	$pages=pex_get_multiopt('_seo_indexation');
	if((is_category() && in_array('category', $pages))
	|| (is_author() && in_array('author', $pages))
	|| (is_tag() && in_array('tag', $pages))
	|| (is_date() && in_array('date', $pages))
	|| (is_search() && in_array('search', $pages))){ ?>
	<!-- Disallow contain indexation on this page to remove duplicate content problems -->
	<meta name="googlebot" content="noindex,nofollow" />
	<meta name="robots" content="noindex,nofollow" />
	<meta name="msnbot" content="noindex,nofollow" />
	<?php }
}
?>

<?php pexeto_print_social_meta_tags(); ?>

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/nivo-slider.css" type="text/css" media="screen" charset="utf-8" />

<!--Google fonts-->
<?php if(get_opt('_enable_google_fonts')!='off'){
$fonts=pexeto_get_google_fonts();
foreach($fonts as $font){
	?>
<link href='<?php echo $font; ?>' rel='stylesheet' type='text/css' />
<?php }
}
?>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<?php 
global $photolux_skin;
$photolux_skin=get_opt('_theme_skin');
if($photolux_skin=='white'){ 
	$lightbox_style="light_rounded";
	?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/white-skin.css" type="text/css" media="screen" charset="utf-8" />
<?php }else{
	$lightbox_style="dark_rounded";
	if($photolux_skin=='dark_trnsparent'){
	?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/dark-transparent-skin.css" type="text/css" media="screen" charset="utf-8" />
<?php } 
	}?>
<!-- Custom Theme CSS -->
<?php pexeto_print_additional_css(); ?>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo get_opt('_favicon'); ?>" />

<?php if($responsive){ ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/responsive.css" type="text/css" media="screen" charset="utf-8" />
<?php } 

$jsuri=get_template_directory_uri().'/js/';
wp_enqueue_script('jquery');

wp_enqueue_script("pexeto-main", $jsuri.'main.js');

$enable_cufon=get_opt('_enable_cufon');
if($enable_cufon=='on'){
	if(get_opt('_custom_cufon_font')!=''){
		$font_file=get_opt('_custom_cufon_font');
	}else{
		$font_file=get_template_directory_uri().'/js/fonts/'.get_opt('_cufon_font');
	}
	wp_enqueue_script("pexeto-cufon", $jsuri.'cufon-yui.js');
	wp_enqueue_script("pexeto-cufon-font", $font_file);
}


if (is_page_template('template-portfolio-showcase.php')) { 
	//load the scripts for the portfolio template
	wp_enqueue_script("pexeto-showcase", $jsuri.'portfolio-showcase.js');
} 


if (is_page_template('template-grid-gallery.php')) { 
	//load the scripts for the portfolio gallery template
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-draggable');
	wp_register_script("pexeto-desaturate", $jsuri.'desaturate.js');
	wp_enqueue_script("pexeto-grid-gallery", $jsuri.'grid-gallery.js');
} 

if(is_page_template('template-full-width-slideshow.php') || is_page_template('template-full-height-slideshow.php')){
	wp_enqueue_script("pexeto-full-slideshow", $jsuri.'slideshow.js', array("jquery", "pexeto-main"));
}

wp_head(); ?>


<?php 
$sociable_lightbox=get_opt('_sociable_lightbox')=='on'?'true':'false'; 
$logo_height=get_opt('_logo_height')||116;
$disable_right_click=get_opt('_disable_click')=='on'?'true':'false';
?>
<script type="text/javascript">
pexetoSite.ajaxurl="<?php echo admin_url('admin-ajax.php'); ?>";
pexetoSite.enableCufon="<?php echo $enable_cufon; ?>";
pexetoSite.lightboxStyle="<?php echo $lightbox_style; ?>";
<?php $desaturate=get_opt('_home_desaturate')=='off'?'false':'true'; ?>
pexetoSite.desaturateServices=<?php echo $desaturate; ?>;
<?php $resp_layout = $responsive ? 'true':'false'; ?>
pexetoSite.responsiveLayout = <?php echo $resp_layout; ?>;
pexetoSite.disableRightClick=<?php echo $disable_right_click; ?>;
pexetoSite.rightClickMessage="<?php echo str_replace("\r\n", "\\n", addslashes(pex_text('_click_message'))) ; ?>";
jQuery(document).ready(function($){
	pexetoSite.initSite();
<?php if (is_page_template('template-grid-gallery.php')) { ?>
	pexetoSite.setMenuSliderLink();
<?php } ?>
});
</script>


	
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<!-- enables nested comments in WP 2.7 -->

<!--[if lte IE 7]>
<link href="<?php echo get_template_directory_uri(); ?>/css/style_ie7.css" rel="stylesheet" type="text/css" />  
<![endif]-->
<!--[if lte IE 8]>
	<style type="text/css">
		#main-container {
		min-width: 1045px;
	}

	</style>
<![endif]-->

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); 

//print the Google Analytics
echo(get_opt('_analytics')); ?>

</head>
<body <?php body_class(); ?>>
<?php 

$bgimage = get_post_meta($post->ID, 'full_bg_value', true);
if(!$bgimage){
	$bgimage=get_opt('_fullwidth_bg_image');
}
if($bgimage && !is_page_template('template-full-width-slideshow.php')){ 
	?>
<?php if(get_opt('_bg_top_pattern')!='off'){?>
<div class="bg-image-pattern"></div>
<?php } ?>
<script type="text/javascript">
jQuery(document).ready(function($){
	pexetoSite.setResizingBg("<?php echo $bgimage; ?>");
});
</script>
<?php } ?>

<div id="main-container">

<!--HEADER -->
	<div id="header">
		<div id="logo-container">
			<?php $logo_image=get_opt('_logo_image');
			if(empty($logo_image)){
				$image_name = $photolux_skin == 'white' ? 'logo_w.png' : 'logo.png';
				$logo_image = get_template_directory_uri().'/images/'.$image_name;
			}
			?>
			<a href="<?php echo home_url(); ?>"><img src="<?php echo $logo_image; ?>" /></a>
		</div>
		 <div class="mobile-nav">
			<span class="mob-nav-btn"><?php echo pex_text('_menu_text'); ?></span>
		</div>
		<div class="clear"></div>
 		<div id="navigation-container">
			<div id="menu-container">
	        	<div id="menu">
				<?php wp_nav_menu(array('theme_location' => 'pexeto_main_menu', 'fallback_cb'=>'pexeto_no_menu')); ?>
				</div>
	        </div>
	        <div class="clear"></div>     
    	</div> 
	    <div class="clear"></div>       
	    <div id="navigation-line"></div>
	</div> <!-- end #header -->