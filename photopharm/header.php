<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="initial-scale=1.0,width=device-width" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php
//VAR SETUP
$light = get_theme_mod('themolitor_customizer_theme_skin', FALSE);
$googleApi = get_theme_mod('themolitor_customizer_google_api');
$googleKeyword = get_theme_mod('themolitor_customizer_google_key');
$logo = get_theme_mod('themolitor_customizer_logo');
$footerText = get_theme_mod('themolitor_customizer_footer','Site by <a href="http://themolitor.com/portfolio" title="Site by THE MOLITOR">THE MOLITOR</a>');
$color = get_theme_mod('themolitor_customizer_link_color','#ffffff');
$favicon = get_theme_mod('themolitor_customizer_favicon'); 
$css = get_theme_mod('themolitor_customizer_css'); 

if($favicon) { ?><link rel="icon" href="<?php echo $favicon; ?>" type="image/x-icon" /><?php } ?>

<?php 
if($googleApi) { echo "<link href='".$googleApi."' rel='stylesheet' type='text/css'>"; } 
wp_head(); 
?>

<!--BELOW STYLES ARE CONTROLLED FROM THE THEME OPTIONS PANEL-->
<style>
a {color: <?php echo $color;?>;}
<?php if($googleKeyword){?>body {font-family: '<?php echo $googleKeyword;?>', sans-serif;}<?php } ?>
<?php echo $css;?>
</style>
<!--ABOVE STYLES ARE CONTROLLED FROM THE THEME OPTIONS PANEL-->

<!--[if lt IE 8]>
<script src="http://ie7-js.googlecode.com/svn/version/2.0(beta3)/IE8.js" type="text/javascript"></script>
<![endif]-->

</head>

<body <?php body_class();?>>

<div id="pageContent">

<!--TAB STUFF-->
<?php if(is_page() || is_single()){
	$args = array('post_type' => 'attachment','post_mime_type' => 'image' ,'post_status' => null, 'post_parent' => $post->ID ); 
	$attachments = get_posts($args);
} ?>
<ul id="navBox" <?php if(!is_page_template('page_gallery.php')){?>class="openNav"<?php }?>>
	<!--MENU-->
	<li id="homeNav"><a href="#homeBox" class="<?php if(is_front_page() && !is_page_template('page_gallery.php')){?>activeNav<?php }?>"><?php _e('MENU','themolitor');?></a></li>
	<!--INFO/LIST-->
	<li id="contentNav">
		<a href="#contentBox" class="<?php if(!is_front_page() && !is_page_template('page_gallery.php')){?>activeNav<?php }?>"><?php if(is_search() || is_archive() || is_home()){ _e('LIST','themolitor'); } else { _e('INFO','themolitor'); } ?></a>
	</li>
	<!--THUMBS-->
<?php if (!empty($attachments)) { ?>
	<li id="galleryNav"><a href="#galleryBox"><?php _e('THUMBS','themolitor');?></a></li>
	<!--MORE-->
<?php } if ( is_dynamic_sidebar() ) { ?>
	<li id="widgetNav"><a href="#widgetBox"><?php _e('MORE','themolitor');?></a></li>
<?php } ?>
</ul>

<!--HOME BOX-->	
<div id="homeBox" class="boxStuff<?php if(is_front_page() && !is_page_template('page_gallery.php')){?> activeBox<?php }?>">
	<!--LOGO-->
	<img id="logo" src="<?php echo $logo;?>" alt="<?php bloginfo('name'); ?>" /><!--end logo--> 
	<!--MENU-->
	<?php if (has_nav_menu( 'main' ) ) { wp_nav_menu(array('theme_location' => 'main', 'container_id' => 'navigation', 'menu_id' => 'dropmenu')); }?>
	<!--COPYRIGHT-->
	<div id="copyright">
		&copy; <?php echo date("Y "); bloginfo('name'); ?>. <?php echo $footerText;?>
	</div>
</div><!--end homeBox-->