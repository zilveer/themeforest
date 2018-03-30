<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<!-- ### HEAD ####  -->
<head>

<!-- Meta -->
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' />

<!-- Title -->
<title><?php bloginfo('name'); ?> » <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>

<!-- Favicon -->
<?php
if (of_get_option('favicon_upload', 'true') == 'true') {
} else {
	if (of_get_option('favicon_upload', null) != null) {
		$favicon_url = of_get_option('favicon_upload');
	} else {
		$favicon_url = get_template_directory_uri() . '/favicon.ico';
	}
	echo '<link rel="shortcut icon" href="' . esc_url($favicon_url) . '" />';
}
?>


<!-- Wordpress functions -->	
<?php wp_head(); ?>

</head>

<!-- ### BODY #### -->
<body <?php body_class(); ?>> 

<!-- Header -->
<div id="header">
	<div class="header-row fixed">	
	
		<div id="logo"><?php
if (of_get_option('logo_upload', 'true') == 'true') {
} else {
	if (of_get_option('logo_upload', null) != null) {
		$logo_url = of_get_option('logo_upload');
	} else {
		$logo_url = get_template_directory_uri() . '/images/logo.png';
	}
	echo '
			<a href="' . esc_url( home_url() ) . '"><img src="' . esc_url($logo_url) . '" alt="logo" /></a>';
}
?>

		</div><!-- end #logo -->

<?php 
$headerfeat = of_get_option('header_feat');	
switch ($headerfeat) {
	case "header_event":
		require_once('event-header.php');
	break;
		 
	case "header_banner":
		require_once('banner-header.php');
	break;
}
?>
	  
	</div><!-- end .header-row fixed -->
	
	<div id="menu">
	<div class="menu-row">
			
<?php
wp_nav_menu(array(
	'menu' => 'Main Menu',
	'container_id' => 'wizemenu',
	'items_wrap' => '<ul class="megamenu">%3$s</ul>',
	'walker' => new wize_css_menu()
));

$search = of_get_option('active_search', '1') == '1';
$social = of_get_option('social_header', '1') == '1';
if ($search) {
    echo '		
		<div class="menu-search">
			<form id="searchforms" method="get">
				<input id="submit" value="" type="submit">
				<label for="submit" class="submit"></label>
				<a href="javascript: void(0)" class="iconsearh"></a>
				<input type="search" name="s" id="search" placeholder="' . esc_html__( "SEARCH...", "wizedesign" ) . '">
			</form>
        </div><!-- end .menu-search -->';
}

if ($social) {
    require_once('social-header.php');
}

?>	
	</div><!-- end .menu-row -->
	</div><!-- end #menu -->
</div><!-- end #header -->


<?php
$player = of_get_option('player_audio_radio');
switch ($player) {
    case "player_audio":
       require_once('player.php');
    break;
		
	case "player_radio":
       require_once('radio.php');
    break;	
}
?>

<!-- ContBack -->
<div id="contback">