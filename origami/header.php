<?php
/**
 * @package WordPress
 * @subpackage Origami_Theme
 */
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?> <?php wp_title('&raquo;', true, 'right'); ?> </title>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link href="<?php bloginfo('template_url');?>/css/common.min.css" rel="stylesheet" type="text/css" />
<link href="<?php bloginfo('template_url');?>/js/nivoslider/nivo-slider.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<!--[if IE]>
    <link href="<?php bloginfo('template_url');?>/css/ie.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/html5.js"></script>
<![endif]-->

<link type="text/css" href="<?php bloginfo('template_url'); ?>/js/prettyphoto/css/prettyPhoto.css" rel="stylesheet" media="screen" />

<?php wp_head(); ?>

<?php echo themeteam_bg_options(get_option("themeteam_origami_custom_bg")); ?>

<?php if(get_option("themeteam_origami_enable_cufon") == 'yes') { ?>
<script type="text/javascript" src="<?php echo get_bloginfo('template_directory');?>/js/cufon_yui.js"></script>
<script type="text/javascript" src="<?php echo get_bloginfo('template_directory');?>/fonts/cufon/<?php echo get_option("themeteam_origami_cufon_font"); ?>"></script>
<script type="text/javascript">
	Cufon.replace('h1,h2,h3,h4,h5,h6');
	Cufon.replace('#navigation a',{hover: true});
</script>

<?php } ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<?php themeteam_globals(); ?>


<!-- Toolbar only -->
<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/toolbar/toolbar.js"></script>
<link href="<?php bloginfo('template_url');?>/js/toolbar/colorpicker.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php bloginfo('template_url');?>/js/toolbar/toolbar.css" rel="stylesheet" type="text/css" media="screen" />
<!-- toolbar end -->
<?php
// Split the featured pages from the options, and put in an array
	$featuredpages = get_option('themeteam_origami_featured_slider_ids');
	$featuredpages_array=split(",",$featuredpages); 
	$featuredpages_array = array_diff($featuredpages_array, array(""));
	
	$slider_type = get_option('themeteam_origami_featured_slider_type'); 
 	
 	switch($slider_type){
		case 'full_image':
?>
			<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/slider_v1.js"></script>
<?php		
		break;
		case 'normal_width':
?>
			<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/slider_v2.js"></script>
<?php		
		break;
		
		case 'nivo':
?>
			<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/slider_nivo.js"></script>
<?php		
		break;
	}
?>
<?php if(get_option('themeteam_origami_google_analytics')):?>
<?php echo stripslashes(get_option('themeteam_origami_google_analytics')); ?>
<?php endif ?> 
</head>
<body <?php body_class(); ?>>
<div id="wrapper">
  <header id="header" class="clearfix">
    <div class="container_12">
      <div class="grid_3">
        <div id="logo">
        	<a href="<?php echo get_option('home'); ?>/" class="nocufon">
        		<?php if ( get_option('themeteam_logo_upload') ) {?>
      			<img src="<?php echo get_option('themeteam_logo_upload'); ?>" alt="<?php bloginfo('name'); ?>" />
	      		<?php } else { ?>
	      			<?php bloginfo('name'); ?>
	      		<?php }?>
        	</a>
        </div>
      </div>
      <nav class="prefix_3" id="navigation">
        <?php wp_nav_menu(array('menu' => 'Main Nav', 'theme_location' => 'main','walker' => new themeteamcustom_walker())); ?>
      </nav>
      <script type="text/javascript">
      jQuery.noConflict();
      jQuery(document).ready(function() {
             jQuery("#navigation div > ul > li > ul").parent().addClass("parent").end().prev("a").append("<strong></strong>");
             jQuery("#breadcrumbs li,#navigation div > ul > li").last().addClass("last");
             jQuery("#sidebar div.widget:has(div.thumbnail)").addClass("nopadding");
             jQuery(".flickr_badge_image").find("a").append("<span><em> </em></span>");
             jQuery("pre code").wrapInner("<span></span>")
	         jQuery(".imgframe").each(function(){ var $_height = jQuery(this).find("img").height(); if ($_height > 0){  jQuery(this).find(".empty").height($_height-20).end().find("span.frame").css("display","block"); } })
	  });      
      </script>
    </div>
  </header>
  <div id="main-container">
