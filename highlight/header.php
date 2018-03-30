<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes() ?>>
<head>
<meta http-equiv="Content-Type"
	content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title>
<?php if (is_home()) {
	echo bloginfo('name');
} elseif (is_category()) {
	echo __('Category &raquo; ', 'blank'); wp_title('&laquo; @ ', TRUE, 'right');
	echo bloginfo('name');
} elseif (is_tag()) {
	echo __('Tag &raquo; ', 'blank'); wp_title('&laquo; @ ', TRUE, 'right');
	echo bloginfo('name');
} elseif (is_search()) {
	echo __('Search results &raquo; ', 'blank');
	echo the_search_query();
	echo '&laquo; @ ';
	echo bloginfo('name');
} elseif (is_404()) {
	echo '404 '; wp_title(' @ ', TRUE, 'right');
	echo bloginfo('name');
} else {
	echo wp_title(' @ ', TRUE, 'right');
	echo bloginfo('name');
} ?>
</title>

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/nivo-slider.css" type="text/css" media="screen" charset="utf-8" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/cssLoader.php" type="text/css" media="screen" charset="utf-8" />
	
	
<link rel="shortcut icon" type="image/x-icon" href="<?php echo get_opt('_favicon'); ?>" />


<?php wp_enqueue_script("jquery"); ?>
<?php wp_head(); ?>

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/script/script.js"></script>

<?php 
$enable_cufon=get_opt('_enable_cufon');
if($enable_cufon=='on'){
if(get_opt('_custom_cufon_font')!=''){
	$font_file=get_opt('_custom_cufon_font');
}else{
	$font_file=get_template_directory_uri().'/script/fonts/'.get_opt('_cufon_font');
}
?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/script/cufon-yui.js"></script>
<script type="text/javascript" src="<?php echo $font_file; ?>"></script>
<?php 
}
?>

<script type="text/javascript">
pexetoSite.enableCufon="<?php echo $enable_cufon; ?>";
jQuery(document).ready(function($){
	pexetoSite.initSite();
});
</script>

<?php if (is_page_template('template-portfolio.php')) { 
//load the scripts for the portfolio template
	?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/script/portfolio-previewer.js"></script>
<?php } ?>

<?php if (is_page_template('template-portfolio-gallery.php')) { 
//load the scripts for the portfolio gallery template
	?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/script/portfolio-setter.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/script/jquery-easing.js"></script>
<?php } ?>
	
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<!-- enables nested comments in WP 2.7 -->


<!--[if lte IE 6]>
<link href="<?php echo get_template_directory_uri(); ?>/css/style_ie6.css" rel="stylesheet" type="text/css" /> 
 <input type="hidden" value="<?php echo get_template_directory_uri(); ?>" id="baseurl" /> 
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/script/supersleight.js"></script>
<![endif]-->
<!--[if IE 7]>
<link href="<?php echo get_template_directory_uri(); ?>/css/style_ie7.css" rel="stylesheet" type="text/css" />  
<![endif]-->
<!--[if IE 8]>
<link href="<?php echo get_template_directory_uri(); ?>/css/style_ie8.css" rel="stylesheet" type="text/css" />  
<![endif]-->

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>



</head>
<?php $bodyclass=$enable_cufon=='on'?'class="cufon"':'';?>
<body <?php echo $bodyclass; ?>>
<div id="main-container">
  <div id="header" >
    <div id="header-gradient">
      <div id="header-light">
        <div id="header-bg">
          <div id="header-top">
              <div id="header-top-pattern">
              <div id="header-top-gradient">
            	<div class="center">
<div id="logo-container"><a href="<?php echo home_url(); ?>"></a></div>
<div id="logo-spacer"></div>
 <div id="menu-container">
                    <div id="menu">
<?php wp_nav_menu(array('theme_location' => 'pexeto_main_menu' )); ?>

 </div>
                  </div>
                </div>
              </div>
              <div id="header-top-border">
            </div>
          </div>
          </div>
