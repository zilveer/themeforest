<?php
/*====================================================================================
 * START IMPORTANT HEADER PROCESS FOR CSS & CACHING
 *====================================================================================*/
// function that creates browser caching headers
function caching_headers($file) {
    $timestamp = bfi_get_option('css_last_save');
    if (!$timestamp) $timestamp = date("U"); // failsafe
    $gmt_mtime = gmdate('r', $timestamp);
    
    header('ETag: "'.md5($timestamp.$file).'"');
    header('Last-Modified: '.$gmt_mtime);
    header('Cache-Control: public');

    if(isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])) {
        if ($_SERVER['HTTP_IF_MODIFIED_SINCE'] == $gmt_mtime) {
            header('HTTP/1.1 304 Not Modified');
            exit();
        }
    }
    if (isset($_SERVER['HTTP_IF_NONE_MATCH'])) {
        if (str_replace('"', '', stripslashes($_SERVER['HTTP_IF_NONE_MATCH'])) == md5($timestamp.$file)) {
            header('HTTP/1.1 304 Not Modified');
            exit();
        }
    }
}

// find wp-load.php
define('WP_USE_THEMES', false);
$wpLoad = 'wp-load.php';
for ($i = 0; $i < 8; $i++) {
    if (file_exists($wpLoad)) {
        require_once($wpLoad);
        break;
    }
    $wpLoad = '../'.$wpLoad;
}

// start css headers
header("Content-type: text/css; charset: UTF-8");
caching_headers(__FILE__);


function hexToRgb($hex) {
		$hex = str_replace('#', '', $hex);
		return hexdec(substr($hex, 0, 2)) .','. hexdec(substr($hex, 2, 2)) .','. hexdec(substr($hex, 4, 2));
}


/*====================================================================================
 * OTHER CSS WHICH CANNOT BE PARSED BY SASS
 *====================================================================================*/
echo bfi_get_social_icon_fontface();
?>
.monosocial {
    font-size: 24px;
    font-family: 'Mono Social Icons Font';
}
<?php

// BODY GRADIENT OPACITY
$opacity = bfi_get_option('style_background_gradient_opacity'); 
?>
.container.main {
    -webkit-box-shadow: 0 0 20px rgba(0, 0, 0, <?php echo $opacity ?>);
    -moz-box-shadow: 0 0 20px rgba(0, 0, 0, <?php echo $opacity ?>);
    box-shadow: 0 0 20px rgba(0, 0, 0, <?php echo $opacity ?>);
}
#heading-box-container:after {
    background-image: url("<?php echo bfi_thumb(BFI_IMAGEURL . "pagemedia-fade.png", array("color" => bfi_get_option('style_foreground_color'))); ?>");
}
<?php
 

// for repeating backgrounds, put in the repeating image together with opactiy
if (bfi_get_option("style_background") == "upload" && bfi_get_option("style_background_type") == "pattern" && bfi_get_option("style_background_image")) {
	?>
	body {
		background-image: url("<?php echo bfi_thumb(bfi_get_option("style_background_image"), array("opacity" => bfi_get_option("style_background_opacity")*100)) ?>");
	}
	<?php
} else if (bfi_get_option("style_background") == "library") {
	// just use the pattern (dont colorize)
	if (in_array(bfi_get_option("style_background_pattern"), array("bgnoise_lg", "bright_squares", "climpek", "diamond_upholstery", "furley_bg", "gplaypattern", "graphy", "grey", "hexellence", "inflicted", "light_honeycomb", "light_noise_diagonal", "light_wool", "low_contrast_linen", "noisy_grid", "old_mathematics", "px_by_gr3g", "subtle_zebra_3d", "vichy", "whitey", "xv")) == false) {
		?>
		body {
			background-image: url("<?php echo bfi_thumb(BFI_IMAGEURL."patterns/".bfi_get_option("style_background_pattern").".png", array("opacity" => bfi_get_option("style_background_opacity")*100)) ?>");
		}
		<?php
	// colorize
	} else {
		$negate = false;
		// apply negate filter
		if (bfi_get_option("style_background_pattern_invert")) {
			$negate = true;
		}
		?>
		body {
			background-image: url("<?php echo bfi_thumb(BFI_IMAGEURL."patterns/".bfi_get_option("style_background_pattern").".png", array("opacity" => bfi_get_option("style_background_opacity") * 100, "negate" => $negate)) ?>");
		}
		<?php
	}
}


/*====================================================================================
 * START ACTUAL CSS (PASTE CONTENTS FROM custom.css <- parsed by SASS)
 *====================================================================================*/
// BUILDSCRIPT POINTER START

?>
.backstretch {
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=<?php echo bfi_get_option('style_background_opacity') * 100 ?>);
  opacity: <?php echo bfi_get_option('style_background_opacity') ?>; }

body {
  background-color: <?php echo bfi_get_option('style_background_color') ?>; }

a, a:visited {
  color: <?php echo bfi_get_option('style_cta_bg_color') ?>; }
  a i, a:visited i {
    color: <?php echo bfi_get_option('style_cta_bg_color') ?>; }

.container.main {
  background-color: <?php echo bfi_get_option('style_foreground_color') ?>; }

a.button, a.button:visited,
body.error404 .amplus_panel h1 {
  background: <?php echo bfi_get_option('style_cta_bg_color') ?>;
  color: <?php echo bfi_get_option('style_cta_text_color') ?>; }

.featureimage > span {
  color: <?php echo bfi_get_option('style_cta_bg_color') ?>; }

footer .copyrighttext small {
  color: white; }

a:hover {
  color: #222; }
  a:hover i {
    color: #222; }

.bfi_accordion li > h4.selected {
  background: <?php echo bfi_get_option('style_cta_bg_color') ?>;
  color: <?php echo bfi_get_option('style_cta_text_color') ?>; }
  .bfi_accordion li > h4.selected i {
    color: <?php echo bfi_get_option('style_cta_text_color') ?>; }

.bfi_tabs .tab-title li.selected h4 {
  background: <?php echo bfi_get_option('style_cta_bg_color') ?>;
  color: <?php echo bfi_get_option('style_cta_text_color') ?>; }
  .bfi_tabs .tab-title li.selected h4 i {
    color: <?php echo bfi_get_option('style_cta_text_color') ?>; }
.bfi_tabs .tab-body {
  border-color: <?php echo bfi_get_option('style_cta_bg_color') ?>; }

.dropcaps.colored, .bfi_toggle.colored > h4, .bfi_highlight.colored,
.featurebox1:hover > i {
  background: <?php echo bfi_get_option('style_cta_bg_color') ?>;
  color: <?php echo bfi_get_option('style_cta_text_color') ?>; }

.featurebox1 > i:after {
  border-color: <?php echo 'rgba('.hexToRgb(bfi_get_option('style_cta_bg_color')).',.4)' ?> !important; }

.bfi_pricingtable > div.big > h3, .bfi_pricingtable > div.big > a, .bfi_pricingtable > div.big > a:visited {
  background: <?php echo bfi_get_option('style_cta_bg_color') ?>;
  color: <?php echo bfi_get_option('style_cta_text_color') ?>; }
  .bfi_pricingtable > div.big > h3 i, .bfi_pricingtable > div.big > a i, .bfi_pricingtable > div.big > a:visited i {
    color: <?php echo bfi_get_option('style_cta_text_color') ?>; }
.bfi_pricingtable > div.big > .subtitle {
  background: <?php echo 'rgba('.hexToRgb(bfi_get_option('style_cta_bg_color')).',.7)' ?>;
  color: <?php echo bfi_get_option('style_cta_text_color') ?>; }
  .bfi_pricingtable > div.big > .subtitle i {
    color: <?php echo bfi_get_option('style_cta_text_color') ?>; }

.filters a.filter.selected {
  background: <?php echo bfi_get_option('style_cta_bg_color') ?>;
  color: <?php echo bfi_get_option('style_cta_text_color') ?>; }
  .filters a.filter.selected:hover {
    background: <?php echo bfi_get_option('style_cta_bg_color') ?> !important;
    color: <?php echo bfi_get_option('style_cta_text_color') ?> !important; }

.widget_calendar #wp-calendar td {
  color: #555; }
  .widget_calendar #wp-calendar td a, .widget_calendar #wp-calendar td a:visited {
    background: <?php echo bfi_get_option('style_cta_bg_color') ?>;
    color: <?php echo bfi_get_option('style_cta_text_color') ?>; }
    .widget_calendar #wp-calendar td a i, .widget_calendar #wp-calendar td a:visited i {
      color: <?php echo bfi_get_option('style_cta_text_color') ?>; }

#main-menu > ul > li > a, #main-menu > ul > li > a:visited {
  height: <?php echo bfi_get_option('style_topmenu_height') ?>px;
  line-height: <?php echo bfi_get_option('style_topmenu_height') ?>px; }

header.container .navbar.container {
  background-color: <?php echo 'rgba(' . hexToRgb(bfi_get_option('style_topmenu_bg_color')) . ', ' . (bfi_get_option('style_topmenu_opacity') !== false ? bfi_get_option('style_topmenu_opacity') : '1.0') . ')' ?>; }

.ddsmoothmenu ul li a, .ddsmoothmenu ul li a:link, .ddsmoothmenu ul li a:visited,
.ddsmoothmenu ul li a i, .ddsmoothmenu ul li a:link i, .ddsmoothmenu ul li a:visited i {
  color: <?php echo bfi_get_option('style_topmenu_text_color') ?>; }

#main-menu > ul > li > a:hover, #main-menu > ul > li > a:hover i,
#main-menu > ul > li > ul a:hover, #main-menu > ul > li > ul a.selected,
#main-menu > ul > li > ul a:hover i, #main-menu > ul > li > ul a.selected i {
  color: <?php echo bfi_get_option('style_cta_bg_color') ?>; }

footer .container.copyrighttext {
  background-color: <?php echo 'rgba(' . hexToRgb(bfi_get_option('style_footer_copyright_bg_color')) . ', ' . (bfi_get_option('style_footer_bar_opacity') !== false ? bfi_get_option('style_footer_bar_opacity') : '1.0') . ')' ?>; }

footer .copyrighttext small, footer .copyrighttext small i, footer a.monosocial {
  color: <?php echo bfi_get_option('style_footer_copyright_text_color') ?>; }

footer .widget * {
  color: <?php echo bfi_get_option('style_footer_text_color') ?>; }
footer .widget h1, footer .widget h2, footer .widget h3, footer .widget h4, footer .widget h5, footer .widget h6 {
  color: <?php echo bfi_get_option('style_footer_headings_color') ?>; }
footer .widget a, footer .widget a:visited {
  color: <?php echo bfi_get_option('style_footer_link_color') ?>; }
  footer .widget a i, footer .widget a:visited i {
    color: <?php echo bfi_get_option('style_footer_link_color') ?>; }
  footer .widget a:hover, footer .widget a:visited:hover {
    color: <?php echo bfi_get_option('style_footer_text_color') ?>; }
    footer .widget a:hover i, footer .widget a:visited:hover i {
      color: <?php echo bfi_get_option('style_footer_text_color') ?>; }
footer .widget a.button {
  background: <?php echo bfi_get_option('style_cta_bg_color') ?>;
  color: <?php echo bfi_get_option('style_cta_text_color') ?>; }
  footer .widget a.button i {
    background: <?php echo bfi_get_option('style_cta_bg_color') ?>;
    color: <?php echo bfi_get_option('style_cta_text_color') ?>; }
  footer .widget a.button:hover {
    background: #555;
    color: white; }
    footer .widget a.button:hover i {
      color: white; }
footer .widget .search a.button i {
  color: #999;
  background: none; }
footer .widget .search a.button:hover i {
  color: #ccc;
  background: none; }
footer .widget hr {
  border-color: <?php echo bfi_get_option('style_footer_link_color') ?>;
  background-color: <?php echo 'rgba('.hexToRgb(bfi_get_option('style_footer_decor_color')).',.1)' ?>; }
footer .widget li:before {
  color: <?php echo bfi_get_option('style_footer_decor_color') ?>; }
footer .widget li {
  border-color: <?php echo 'rgba('.hexToRgb(bfi_get_option('style_footer_decor_color')).',.06)' ?>; }

<?php
