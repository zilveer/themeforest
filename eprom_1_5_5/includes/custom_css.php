<?php

$_GET = array_map('strip_tags', $_GET);

$wp_load = dirname(__FILE__);
 
for ($i = 0; $i < 8; $i++) {
	$wp_load = dirname($wp_load);
	if (file_exists($wp_load . '/wp-load.php')) break;
	if ($i == 7) { 
	    echo 'Error: wp-load.php doesn\'t exists';
		die();
	}
}

require_once($wp_load . '/wp-load.php');

global $r_option;

header('Content-type: text/css');

?>
/* Custom CSS Style
 ------------------------------------------------------------------------*/
<?php 
/* Body color */
if (isset($r_option['css_body_color']) && $r_option['css_body_color'] != ''): ?>
body, .line-heading span { background:<?php echo $r_option['css_body_color']; ?>; }
<?php endif; ?>
<?php
/* Page header */
if (isset($r_option['css_page_header_bg']) && $r_option['css_page_header_bg'] != ''): ?>
/* Page Header */
#page-header { <?php echo $r_option['css_page_header_bg']; ?> }
<?php endif; ?>

<?php 
/* Text Color */
if (isset($r_option['css_text_color']) && $r_option['css_text_color'] != '') : ?>
body { color: <?php echo $r_option['css_text_color']; ?>; }
<?php endif; ?>
<?php /* H1 Size */
if (isset($r_option['css_h1_size'])) : ?>
h1 { font-size: <?php echo $r_option['css_h1_size']; ?>px; }
<?php endif; ?>
<?php /* H2 Size */
if (isset($r_option['css_h2_size'])) : ?>
h2 { font-size: <?php echo $r_option['css_h2_size']; ?>px; }
<?php endif; ?>
<?php /* H3 Size */
if (isset($r_option['css_h3_size'])) : ?>
h3 { font-size: <?php echo $r_option['css_h3_size']; ?>px; }
<?php endif; ?>
<?php /* H4 Size */
if (isset($r_option['css_h4_size'])) : ?>
h4 { font-size: <?php echo $r_option['css_h4_size']; ?>px; }
<?php endif; ?>
<?php /* H5 Size */
if (isset($r_option['css_h5_size'])) : ?>
h5 { font-size: <?php echo $r_option['css_h5_size']; ?>px; }
<?php endif; ?>
<?php /* H6 Size */
if (isset($r_option['css_h6_size'])) : ?>
h6 { font-size: <?php echo $r_option['css_h6_size']; ?>px; }
<?php endif; ?>
<?php 
/* Main color */
if (isset($r_option['css_main_color']) && $r_option['css_main_color'] != ''): ?>

/* Main color */
a, a > *,
.color,
ul.stats li .stat-value,
ul.details a,
#main-nav a:hover, #main-nav .hover > a, #main-nav .current-menu-item > a, #main-nav .current_page_item > a, #main-nav .current-menu-ancestor > a, #main-nav .active > a,
#page-header .page-title,
#cat-filter a:hover,
#cat-filter a.active,
.cat a:hover,
.portfolio article footer h2 a,
.events-count,
.events-list li a:hover .title,
#error-404 span,
.entry-heading a:hover,
.recent-comments li .meta:hover,
.recent-entries li a:hover,
.theme_comment .author a:hover,
.playable:hover,
.playable.playing,
#footer, #footer a,
#footer-nav li a:hover,
.playlist .playable:hover,
.playlist .playable:hover .track-title,
.woocommerce-tabs ul.tabs li.active:hover a:hover,
.woocommerce-tabs ul.tabs li.active a,
.woocommerce-tabs ul.tabs li a:hover,
td.product-name a:hover,
table.cart a:hover.remove,
ul.product_list_widget li a:hover,
.widget_product_tag_cloud a:hover, 
.widget_product_categories a:hover
{ color:<?php echo $r_option['css_main_color']; ?>; }

/* Background */
#share .buttons,
#tag-filter a.active,
.header-countdown .days,
.header-countdown .hours,
.header-countdown .minutes,
.header-countdown .seconds,
.recent-entries li .date,
.widget_categories a span, 
.widget_archive a span, 
.widget_recent_entries a span, 
.widget_meta a span,
.widget_nav_menu a span,
.widget_pages a span,
.widget_links a span,
.widget_tag_cloud a:hover,
.widget table#wp-calendar a,
#tracklist-nav ul li:hover, 
#tracklist-nav ul li.active,
#top-wrap .top-right-nav li.cart a .contents,
span.onsale,
.quantity .plus:hover,
.quantity .minus:hover
{ background: <?php echo $r_option['css_main_color']; ?>; }

/* Selection background */
::-moz-selection { background: <?php echo $r_option['css_main_color']; ?>; }
::selection { background: <?php echo $r_option['css_main_color']; ?>; }

/* Background color */
.nivo-directionNav a,
.plus-button,
.entry-heading:before,
.playable .ui.progress .position,
.playlist .player-button:hover,
a:hover.social-icon,
a.twitter-button
{ background-color: <?php echo $r_option['css_main_color']; ?>; }
<?php endif; ?>
<?php /* Logo */ ?>
#logo { margin: <?php echo $r_option['css_logo_margin_top'] . 'px ' . $r_option['css_logo_margin_right'] . 'px ' . $r_option['css_logo_margin_bottom'] . 'px ' . $r_option['css_logo_margin_left'] . 'px;'; ?> }
<?php /* Submenu width */ ?>
#main-nav ul ul { width: <?php echo $r_option['css_menu_width']; ?>px; }