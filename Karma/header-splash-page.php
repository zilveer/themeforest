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
$customcode_head              = $ttso->ka_customcode_head;
$font_kit_modern              = $ttso->ka_font_kit_modern;
$font_kit_serif               = $ttso->ka_font_kit_serif;
$font_kit_organic             = $ttso->ka_font_kit_organic;


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
<link href='http://fonts.googleapis.com/css?family=Open+Sans|Lato' rel='stylesheet' type='text/css'>
<?php endif;
if('true' == $font_kit_serif): ?>
<link href='http://fonts.googleapis.com/css?family=PT+Serif|Source+Sans+Pro' rel='stylesheet' type='text/css'>
<?php endif;
if('true' == $font_kit_organic): ?>
<link href='http://fonts.googleapis.com/css?family=Varela+Round|Open+Sans' rel='stylesheet' type='text/css'>
<?php endif; //END Font Kits ?>

<?php wp_head(); ?>

<!--[if lte IE 8]>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/html5shiv.js'></script>
<style media="screen">
/* uncomment for IE8 rounded corners
#menu-main-nav .drop ul a,
#menu-main-nav .drop,
#menu-main-nav ul.sub-menu,
#menu-main-nav .drop .c, 
#menu-main-nav li.parent, */

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
	<div id="wrapper">