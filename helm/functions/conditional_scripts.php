<?php
function load_ie78_styles() {
?>
<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/ie7.css" media="screen" />
<![endif]-->
<!--[if lt IE 9]>
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/ie8.css" media="screen" />
<![endif]-->
<!--[if IE 9]>
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/ie9.css" media="screen" />
<![endif]-->

<?php
}
add_action('wp_head','load_ie78_styles',12);
?>
<?php
function disable_rightclick() {
if ( of_get_option('rightclick_disable') ) {
?> 
<script language=JavaScript>var message="<?php echo of_get_option('rightclick_disabletext') ?>"; function clickIE4(){ if (event.button==2){ alert(message); return false; } } function clickNS4(e){ if (document.layers||document.getElementById&&!document.all){ if (e.which==2||e.which==3){ alert(message); return false; } } } if (document.layers){ document.captureEvents(Event.MOUSEDOWN); document.onmousedown=clickNS4; } else if (document.all&&!document.getElementById){ document.onmousedown=clickIE4; } document.oncontextmenu=new Function("alert(message);return false") </script>
<?php
}
}
add_action('wp_footer','disable_rightclick');

// Shortcodes checker //
//Maps
if(theme_got_shortcode('map')) {  
	GoogleMapsLoader();
}

if( theme_got_shortcode('flexislideshow')) {
	FlexiSlideScripts();
}

//Tabs
if(theme_got_shortcode('tabs') || theme_got_shortcode('accordion')) {
	JqueryUIScript();
}
?>
<?php
if ( is_archive() || is_single() || is_search() || is_page_template('template-bloglist.php') || is_page_template('template-bloglist_fullwidth.php') || is_page_template('template-gallery-posts.php') ) {
	FlexiSlideScripts();
}
if ( is_archive() || is_single() || is_search() || is_page_template('template-bloglist.php') || is_page_template('template-bloglist_fullwidth.php') || is_page_template('template-video-posts.php') || is_page_template('template-audio-posts.php') ) {
	JPlayerScripts();
}
if ( is_page_template('template-contact.php') ) {
	contactFormScript();
}
//Theme
if ( !DEMO_STATUS ) {
	if (of_get_option('general_theme_style')=="dark" ) {
		DarkTheme();
	}
}

if (DEMO_STATUS) {
	if ( isset( $_GET['demo_theme_style'] ) ) $_SESSION['demo_theme_style']=$_GET['demo_theme_style'];
	if ( isset($_SESSION['demo_theme_style'] )) $demo_theme_style = $_SESSION['demo_theme_style'];
	if ($_SESSION['demo_theme_style'] == "dark" ) {
		DarkTheme();
	}
}
//Responsive Load
if ( of_get_option(responsive_status) ) {
	ResponsiveStyle();
}
//Custom Style load
CustomStyle();
?>