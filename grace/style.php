<?php
if(extension_loaded('zlib')){ob_start('ob_gzhandler');}

/**
* @package Grace - Religious WordPress Theme
* @subpackage grace
* @author Theme Blossom - www.themeblossom.net
**/


header("Content-type: text/css; charset: UTF-8");
header("Cache-Control: must-revalidate");
$offset = 60 * 60 ;
$ExpStr = "Expires: " .
gmdate("D, d M Y H:i:s",
time() + $offset) . " GMT";
header($ExpStr);

$helvetica	= '"HelveticaNeue", "Helvetica Neue", Helvetica, Arial, sans-serif';
$arial		= 'Arial, Helvetica, sans-serif';
$tahoma		= 'Tahoma, Verdana, Segoe, sans-serif';
$georgia	= 'Georgia, Constantia, "Lucida Bright", Lucidabright, "Lucida Serif", Lucida, "DejaVu Serif", "Bitstream Vera Serif", "Liberation Serif", serif';
$cambria	= 'Cambria, "Hoefler Text", Utopia, "Liberation Serif", "Nimbus Roman No9 L Regular", Times, "Times New Roman", serif';
$palatino	= '"Palatino Linotype", Palatino, Baskerville, Georgia, serif';
$verdana	= 'Verdana, Geneva, Tahoma, Segoe, sans-serif';

// Begin theme options

$themeOptions = of_get_all_options();
$use_google_fonts = $themeOptions['use_google_fonts'];

// BODY
$body_background = $themeOptions['body_background'];
$typography = $themeOptions['body_typography'];

$bodyColor = tb_default($typography['color'], BODY_TYPOGRAPHY_COLOR);
$bodySize = tb_default($typography['size'], BODY_TYPOGRAPHY_SIZE);
$bodyFontS = tb_default($typography['face'], BODY_TYPOGRAPHY_FACE);
$bodyStyle = tb_default($typography['style'], BODY_TYPOGRAPHY_STYLE);

// Main Body Styles
echo 'body {';
	if ($bodyFontS == "helvetica") {
		$bodyFont = $helvetica;
	} elseif ($bodyFontS == "arial") {
		$bodyFont = $arial;
	} elseif ($bodyFontS == "georgia") {
		$bodyFont = $georgia;
	} elseif ($bodyFontS == "cambria") {
		$bodyFont = $cambria;
	} elseif ($bodyFontS == "tahoma") {
		$bodyFont = $tahoma;
	} elseif ($bodyFontS == "palatino") {
		$bodyFont = $palatino;
	}
	
	echo "color: $bodyColor;";
	echo "font-size: $bodySize;";
	echo "font-family: $bodyFont;";

	if ($bodyStyle == 'normal' || $bodyStyle == 'bold') echo "font-weight: $bodyStyle;";			
	if ($bodyStyle == 'normal' || $bodyStyle == 'italic') echo "font-style: $bodyStyle;";			
	if ($bodyStyle == 'bold-italic') {
		echo 'font-weight: bold;';
		echo 'font-style: italic;';
	}
echo "} \n";

$specific_background_height = tb_default($themeOptions['specific_background_height'], 0);
	
// Custom Background
$bckgImage = tb_default($body_background['image'], BODY_BACKGROUND_IMAGE);
$bckgColor = tb_default($body_background['color'], BODY_BACKGROUND_COLOR);
$bckgPosition = tb_default($body_background['position'], BODY_BACKGROUND_POSITION);
$bckgRepeat = tb_default($body_background['repeat'], BODY_BACKGROUND_REPEAT);
$bckgAttachment = tb_default($body_background['attachment'], BODY_BACKGROUND_ATTACHMENT);

if (!$specific_background_height) {
	echo 'body {';
	echo "background: $bckgColor url($bckgImage) $bckgPosition $bckgRepeat $bckgAttachment;";
	echo '}';	
} else {
	$background_height = tb_default($themeOptions['background_height'], 420);

	echo '#background {';
	echo "background: $bckgColor url($bckgImage) $bckgPosition $bckgRepeat scroll;";
	echo '}';
	
	echo '.page-template-page-home-php .width100 #background, body > #background {';
	echo "height: $background_height" . "px;";
	echo '}';
	
	$background_shadow = $background_height + 1;
	echo ".page-template-page-home-php .width100 #backgroundShadow, body > #backgroundShadow {top: $background_shadow" . "px} \n \n";
	
}

// end BODY
?>


<?php echo '.nogooglefont, .nogooglefont a {font-family:' . $bodyFont . ' !important;}'; ?>

.address_info span {color: <?php echo $bodyColor; ?> !important;}

<?php
$link_color_set = $themeOptions['link_color_set'];
$link_color = tb_default($link_color_set['color1'], LINK_COLOR);
$link_color_hover = tb_default($link_color_set['color2'], LINK_COLOR_HOVER);
?>

a,a:link,a:visited,a:active {color: <?php echo $link_color; ?>;}
a:hover, a:focus { color: <?php echo $link_color_hover; ?>; }

<?php
$footer_link_color_set = $themeOptions['footer_link_color_set'];
$link_color_footer = tb_default($footer_link_color_set['color1'], FOOTER_LINK_COLOR);
$link_color_hover_footer = tb_default($footer_link_color_set['color2'], FOOTER_LINK_COLOR_HOVER);
?>

#footer a:not(.button), #footer a:not(.button):link, #footer a:not(.button):visited, #footer a:not(.button):active, #footer #twitter_update_list a:hover {color: <?php echo $link_color_footer; ?>;}
#footer a:not(.button):hover, #footer a:not(.button):focus, #footer #twitter_update_list a {color: <?php echo $link_color_hover_footer; ?>;}

<?php
$showPromoLine = tb_default($themeOptions['show_promo_line'], 1);
if ($showPromoLine) {
	$promoColors = $themeOptions['promo_line_colors'];
	$promoIconColors = $themeOptions['promo_line_icon_colors'];
	?>
	
	#promoLine {
		color: <?php echo tb_default($promoColors['color1'], PROMO_LINE_COLOR); ?>;
		font-family: <?php echo options_typography_return_google_font(tb_default($themeOptions['promo_line_font']['face'], DEFAULT_FONT), $bodyFont, $use_google_fonts); ?>;
	}
	
	#promoLine .bckg {
		background: <?php echo tb_default($themeOptions['promo_line_bckg_color'], PROMO_LINE_BCKG_COLOR); ?>;
		-ms-filter:"progid:DXImageTransform.Microsoft.Alpha"(Opacity=<?php echo tb_default($themeOptions['promo_line_opacity'], PROMO_LINE_OPACITY); ?>);
		filter:alpha(opacity=<?php echo tb_default($themeOptions['promo_line_opacity'], PROMO_LINE_OPACITY); ?>);
		-webkit-opacity: <?php echo tb_default($themeOptions['promo_line_opacity'], PROMO_LINE_OPACITY) / 100; ?>;
		-moz-opacity: <?php echo tb_default($themeOptions['promo_line_opacity'], PROMO_LINE_OPACITY) / 100; ?>;
		opacity: <?php echo tb_default($themeOptions['promo_line_opacity'], PROMO_LINE_OPACITY) / 100; ?>;
	}
	
	#promoLine a {
		color: <?php echo tb_default($promoColors['color2'], PROMO_LINE_LINK_COLOR); ?>;
	}
	
	#promoLine a:hover {
		color: <?php echo tb_default($promoColors['color3'], PROMO_LINE_LINK_COLOR_HOVER); ?>;
	}
	
	#promoLine a.iconLink span {
		color: <?php echo tb_default($promoIconColors['color1'], PROMO_LINE_ICON_COLOR); ?>;
		background-color: <?php echo tb_default($promoIconColors['color2'], PROMO_LINE_ICON_BCKG); ?>;
	}
	
	#promoLine a.iconLink:hover span {
		color: <?php echo tb_default($promoIconColors['color3'], PROMO_LINE_ICON_COLOR_HOVER); ?>;
		background-color: <?php echo tb_default($promoIconColors['color4'], PROMO_LINE_ICON_BCKG_HOVER); ?>;
	}
	
	<?php
}
?>

<?php
$button_color_set = $themeOptions['button_color_set'];
$buttonBckg = tb_default($button_color_set['color1'], BUTTON_BCKG);
$buttonColor = tb_default($button_color_set['color2'], BUTTON_COLOR);
$buttonColorHover = tb_default($button_color_set['color3'], BUTTON_COLOR);
$buttonTextShadow = tb_default($button_color_set['color4'], BUTTON_TEXT_SHADOW);
$buttonBorder = tb_default($button_color_set['color5'], BUTTON_BORDER);
$buttonInsetShadow = tb_default($button_color_set['color6'], BUTTON_INSET_SHADOW);

$buttonBckgEnd = adjustBrightness($buttonBckg, -30);
$buttonBckgMiddle = adjustBrightness($buttonBckg, -15);

$colorArray = array('White', 'Gray', 'Black', 'Light Blue', 'Blue', 'Dark Blue', 'Light Green', 'Green', 'Dark Green', 'Light Red', 'Red', 'Dark Red', 'Yellow', 'Orange', 'Brown');
$notColor = '';

foreach ($colorArray as $color) {
	$notColor .= ':not(.' . str_replace(' ', '', strtolower($color)) . ')';
}
?>

a.button<?php echo $notColor; ?>, form button, input[type="submit"],	input[type="reset"], input[type="button"]:not(.plus):not(.minus) {
	color: <?php echo $buttonColor; ?> !important;
	text-shadow: 1px 1px 1px <?php echo $buttonTextShadow; ?> !important;	
	background-color: <?php echo $buttonBckgMiddle; ?> !important;
	*background-color: <?php echo $buttonBckgEnd; ?> !important;
	background-image: -moz-linear-gradient(top, <?php echo $buttonBckg; ?>, <?php echo $buttonBckgEnd; ?>) !important;
	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(<?php echo $buttonBckg; ?>), to(<?php echo $buttonBckgEnd; ?>)) !important;
	background-image: -webkit-linear-gradient(top, <?php echo $buttonBckg; ?>, <?php echo $buttonBckgEnd; ?>) !important;
	background-image: -o-linear-gradient(top, <?php echo $buttonBckg; ?>, <?php echo $buttonBckgEnd; ?>) !important;
	background-image: linear-gradient(to bottom, <?php echo $buttonBckg; ?>, <?php echo $buttonBckgEnd; ?>) !important;
	background-repeat: repeat-x;
	border: 1px solid <?php echo $buttonBorder; ?> !important;
	*border: 0;
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $buttonBckg; ?>', endColorstr='<?php echo $buttonBckgEnd; ?>', GradientType=0) !important;
	filter: progid:DXImageTransform.Microsoft.gradient(enabled=false) !important;
	-webkit-box-shadow: inset 0 0 3px <?php echo $buttonInsetShadow; ?>, 0px 0px 4px rgba(0, 0, 0, 0.15) !important;
	-moz-box-shadow: inset 0 0 3px <?php echo $buttonInsetShadow; ?>, 0px 0px 4px rgba(0, 0, 0, 0.15) !important;
	box-shadow: inset 0 0 3px <?php echo $buttonInsetShadow; ?>, 0px 0px 4px rgba(0, 0, 0, 0.15) !important;
}

a.button, form button, input[type="submit"],	input[type="reset"], input[type="button"] { font-family: <?php echo options_typography_return_google_font(tb_default($themeOptions['button_font']['face'],DEFAULT_FONT), $bodyFont, $use_google_fonts); ?> !important; }

a.button<?php echo $notColor; ?>:hover, a.button<?php echo $notColor; ?>:focus, a.button<?php echo $notColor; ?>:active, a.button<?php echo $notColor; ?>.active, a.button<?php echo $notColor; ?>.disabled, a.button<?php echo $notColor; ?>[disabled], form button:hover, input[type="submit"]:hover, input[type="reset"]:hover,	input[type="button"]:not(.plus):not(.minus):hover {
	color: <?php echo $buttonColorHover; ?> !important;
	background-color: <?php echo $buttonBckgEnd; ?> !important;
	*background-color: <?php echo $buttonBckgMiddle; ?> !important;
	background-image: -moz-linear-gradient(top, <?php echo $buttonBckgEnd; ?>, <?php echo $buttonBckg; ?>) !important;
	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(<?php echo $buttonBckgEnd; ?>), to(<?php echo $buttonBckg; ?>)) !important;
	background-image: -webkit-linear-gradient(top, <?php echo $buttonBckgEnd; ?>, <?php echo $buttonBckg; ?>) !important;
	background-image: -o-linear-gradient(top, <?php echo $buttonBckgEnd; ?>, <?php echo $buttonBckg; ?>) !important;
	background-image: linear-gradient(to bottom, <?php echo $buttonBckgEnd; ?>, <?php echo $buttonBckg; ?>) !important;
	background-repeat: repeat-x;
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $buttonBckgEnd; ?>', endColorstr='<?php echo $buttonBckg; ?>', GradientType=0) !important;
	filter: progid:DXImageTransform.Microsoft.gradient(enabled=false) !important;
}

.widget-container h4, .widget-container h4 a {
	color: <?php echo tb_default($themeOptions['date_color_set']['color4'], DATE_BOX_BCKG_HOVER); ?> !important;
}
.tb_date_box { font-family: <?php echo options_typography_return_google_font(tb_default($themeOptions['date_font']['face'], DEFAULT_FONT), $bodyFont, $use_google_fonts); ?> !important; color: <?php echo tb_default($themeOptions['date_color_set']['color1'], DATE_BOX_COLOR); ?>;}
.tb_date_box span.month {background-color: <?php echo tb_default($themeOptions['date_color_set']['color3'], DATE_BOX_BCKG); ?>;}
.listPost:hover .tb_date_box span.month {background-color: <?php echo tb_default($themeOptions['date_color_set']['color4'], DATE_BOX_BCKG_HOVER); ?>; color: <?php echo tb_default($themeOptions['date_color_set']['color2'], DATE_BOX_COLOR_HOVER); ?>;}
.tb_upcoming_events .listPost { font-family: <?php echo options_typography_return_google_font(tb_default($themeOptions['date_font']['face'], DEFAULT_FONT), $bodyFont, $use_google_fonts); ?> !important; }


a.comment-reply-link, a.thumb span.more {
	background-color: <?php echo $link_color; ?>;
}
a.comment-reply-link:hover {
	background-color: <?php echo $link_color_hover; ?>;
}

<?php
$pagination_color_set = $themeOptions['pagination_color_set'];
$paginationBckg = tb_default($pagination_color_set['color1'], PAGINATION_BCKG);
$paginationColor = tb_default($pagination_color_set['color2'], PAGINATION_COLOR);
$paginationTextShadow = tb_default($pagination_color_set['color3'], PAGINATION_TEXT_SHADOW);
$paginationBorder = tb_default($pagination_color_set['color4'], PAGINATION_BORDER);
$paginationInsetShadow = tb_default($pagination_color_set['color5'], PAGINATION_INSET_SHADOW);

$paginationBckgEnd = adjustBrightness($paginationBckg, -30);
$paginationBckgMiddle = adjustBrightness($paginationBckg, -15);
?>

.pn_pagination a {
	color: <?php echo $paginationColor; ?> !important;
	text-shadow: 1px 1px 1px <?php echo $paginationTextShadow; ?> !important;	
	background-color: <?php echo $paginationBckgMiddle; ?> !important;
	*background-color: <?php echo $paginationBckgEnd; ?> !important;
	background-image: -moz-linear-gradient(top, <?php echo $paginationBckg; ?>, <?php echo $paginationBckgEnd; ?>) !important;
	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(<?php echo $paginationBckg; ?>), to(<?php echo $paginationBckgEnd; ?>)) !important;
	background-image: -webkit-linear-gradient(top, <?php echo $paginationBckg; ?>, <?php echo $paginationBckgEnd; ?>) !important;
	background-image: -o-linear-gradient(top, <?php echo $paginationBckg; ?>, <?php echo $paginationBckgEnd; ?>) !important;
	background-image: linear-gradient(to bottom, <?php echo $paginationBckg; ?>, <?php echo $paginationBckgEnd; ?>) !important;
	background-repeat: repeat-x;
	border: 1px solid <?php echo $paginationBorder; ?> !important;
	*border: 0;
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $paginationBckg; ?>', endColorstr='<?php echo $paginationBckgEnd; ?>', GradientType=0) !important;
	filter: progid:DXImageTransform.Microsoft.gradient(enabled=false) !important;
	-webkit-box-shadow: inset 0 0 3px <?php echo $paginationInsetShadow; ?>, 0px 0px 4px rgba(0, 0, 0, 0.15) !important;
	-moz-box-shadow: inset 0 0 3px <?php echo $paginationInsetShadow; ?>, 0px 0px 4px rgba(0, 0, 0, 0.15) !important;
	box-shadow: inset 0 0 3px <?php echo $paginationInsetShadow; ?>, 0px 0px 4px rgba(0, 0, 0, 0.15) !important;
}

<?php
$pagination_color_set_active = $themeOptions['pagination_color_set_active'];
$paginationBckgActive = tb_default($pagination_color_set_active['color1'], PAGINATION_BCKG_ACTIVE);
$paginationColorActive = tb_default($pagination_color_set_active['color2'], PAGINATION_COLOR_ACTIVE);
$paginationTextShadowActive = tb_default($pagination_color_set_active['color3'], PAGINATION_TEXT_SHADOW_ACTIVE);
$paginationBorderActive = tb_default($pagination_color_set_active['color4'], PAGINATION_BORDER_ACTIVE);
$paginationInsetShadowActive = tb_default($pagination_color_set_active['color5'], PAGINATION_INSET_SHADOW);

$paginationBckgEndActive = adjustBrightness($paginationBckgActive, -30);
$paginationBckgMiddleActive = adjustBrightness($paginationBckgActive, -15);
?>

.pn_pagination span, .pn_pagination a:hover, .pn_pagination a.selected {
	color: <?php echo $paginationColorActive; ?> !important;
	text-shadow: 1px 1px 1px <?php echo $paginationTextShadowActive; ?> !important;	
	background-color: <?php echo $paginationBckgMiddleActive; ?> !important;
	*background-color: <?php echo $paginationBckgEndActive; ?> !important;
	background-image: -moz-linear-gradient(top, <?php echo $paginationBckgActive; ?>, <?php echo $paginationBckgEndActive; ?>) !important;
	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(<?php echo $paginationBckgActive; ?>), to(<?php echo $paginationBckgEndActive; ?>)) !important;
	background-image: -webkit-linear-gradient(top, <?php echo $paginationBckgActive; ?>, <?php echo $paginationBckgEndActive; ?>) !important;
	background-image: -o-linear-gradient(top, <?php echo $paginationBckgActive; ?>, <?php echo $paginationBckgEndActive; ?>) !important;
	background-image: linear-gradient(to bottom, <?php echo $paginationBckgActive; ?>, <?php echo $paginationBckgEndActive; ?>) !important;
	background-repeat: repeat-x;
	border: 1px solid <?php echo $paginationBorderActive; ?> !important;
	*border: 0;
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $paginationBckgActive; ?>', endColorstr='<?php echo $paginationBckgEndActive; ?>', GradientType=0) !important;
	filter: progid:DXImageTransform.Microsoft.gradient(enabled=false) !important;
	-webkit-box-shadow: inset 0 0 3px <?php echo $paginationInsetShadowActive; ?>, 0px 0px 4px rgba(0, 0, 0, 0.15) !important;
	-moz-box-shadow: inset 0 0 3px <?php echo $paginationInsetShadowActive; ?>, 0px 0px 4px rgba(0, 0, 0, 0.15) !important;
	box-shadow: inset 0 0 3px <?php echo $paginationInsetShadowActive; ?>, 0px 0px 4px rgba(0, 0, 0, 0.15) !important;
}

<?php

// H1 Settings
$h1 = $themeOptions['h1_typography'];
$h1color = tb_default($h1['color'], DEFAULT_H1_COLOR);
$h1size = tb_default($h1['size'], DEFAULT_H1_SIZE);
$h1family = tb_default($h1['face'], DEFAULT_FONT);
$h1style = tb_default($h1['style'], 'normal');

echo 'h1, h1 a:link, h1 a:visited, h1 a:active {';
	echo "color: $h1color;";
	echo "font-size: $h1size;";
	echo 'font-family: ' . options_typography_return_google_font($h1family, $bodyFont, $use_google_fonts).';';
	tb_return_style($h1style);
echo '}';
?>

<?php	
// H2 Settings
$h2 = $themeOptions['h2_typography'];
$h2color = tb_default($h2['color'], DEFAULT_HEADING_COLOR);
$h2size = tb_default($h2['size'], DEFAULT_H2_SIZE);
$h2family = tb_default($h2['face'], DEFAULT_FONT);
$h2style = tb_default($h2['style'], 'normal');

echo 'h2, h2 a:link, h2 a:visited, h2 a:active {';
	echo "color: $h2color;";
	echo "font-size: $h2size;";
	echo 'font-family: ' . options_typography_return_google_font($h2family, $bodyFont, $use_google_fonts).';';
	tb_return_style($h2style);
echo '}';
?>

<?php	
// H3 Settings
$h3 = $themeOptions['h3_typography'];
$h3color = tb_default($h3['color'], DEFAULT_HEADING_COLOR);
$h3size = tb_default($h3['size'], DEFAULT_H3_SIZE);
$h3family = tb_default($h3['face'], DEFAULT_FONT);
$h3style = tb_default($h3['style'], 'normal');

echo 'h3, h3 a:link, h3 a:visited, h3 a:active, .entry-meta h2.entry-title, .entry-meta h2.entry-title a:link, .entry-meta h2.entry-title a:visited, .entry-meta h2.entry-title a:active {';
	echo "color: $h3color;";
	echo "font-size: $h3size;";
	echo 'font-family: ' . options_typography_return_google_font($h3family, $bodyFont, $use_google_fonts) . ';';
	tb_return_style($h3style);
echo '}';
?>

<?php
$h3sidebar = tb_default($themeOptions['sidebar_title_color'], DEFAULT_H1_COLOR);
?>
#sidebar h3, h3.homeTitle {color: <?php echo $h3sidebar; ?>;}

<?php
$indexPageTitles = tb_default($themeOptions['index_title_color'], DEFAULT_INDEX_HEADING_COLOR);
?>
h2.entry-title, h2.entry-title a {color: <?php echo $indexPageTitles; ?> !important;}

<?php
echo 'p.donation label, p.donation label span {';
	echo 'color:' . $h3color . ' !important;';
	echo 'font-family: ' . options_typography_return_google_font($h3family, $bodyFont, $use_google_fonts) . ';';
echo '}';
?>

<?php
// H4 Settings
$h4 = $themeOptions['h4_typography'];
$h4color = tb_default($h4['color'], DEFAULT_HEADING_COLOR);
$h4size = tb_default($h4['size'], DEFAULT_H4_SIZE);
$h4family = tb_default($h4['face'], DEFAULT_FONT);
$h4style = tb_default($h4['style'], 'normal');

echo 'h4, h4 a:link, h4 a:visited, h4 a:active {';
	echo "color: $h4color;";
	echo "font-size: $h4size;";
	echo 'font-family: ' . options_typography_return_google_font($h4family, $bodyFont, $use_google_fonts) . ';';
	tb_return_style($h4style);
echo '}';
?>

<?php
// h5 Settings
$h5 = $themeOptions['h5_typography'];
$h5color = tb_default($h5['color'], DEFAULT_HEADING_COLOR);
$h5size = tb_default($h5['size'], DEFAULT_H4_SIZE);
$h5family = tb_default($h5['face'], DEFAULT_FONT);
$h5style = tb_default($h5['style'], 'normal');

echo 'h5, h5 a:link, h5 a:visited, h5 a:active {';
	echo "color: $h5color;";
	echo "font-size: $h5size;";
	echo 'font-family: ' . options_typography_return_google_font($h5family, $bodyFont, $use_google_fonts) . ';';
	tb_return_style($h5style);
echo '}';
?>

<?php
// Comments H3 Settings
$h3C = $themeOptions['h3_typography_comments'];
$h3Ccolor = tb_default($h3C['color'], DEFAULT_H1_COLOR);
$h3Csize = tb_default($h3C['size'], DEFAULT_COMMENTS_H3_SIZE);
$h3Cfamily = tb_default($h3C['face'], DEFAULT_FONT);
$h3Cstyle = tb_default($h3C['style'], 'normal');

echo '#comments h3, #respond h3 {';
	echo "color: $h3Ccolor;";
	echo "font-size: $h3Csize;";
	echo 'font-family: ' . options_typography_return_google_font($h3Cfamily, $bodyFont, $use_google_fonts) . ';';
	tb_return_style($h3Cstyle);
echo '}';
?>

<?php
// Blockquote/Quote Settings
$BQ = $themeOptions['blockquote_typography'];
$BQcolor = tb_default($BQ['color'], DEFAULT_QUOTE_COLOR);
$BQsize = tb_default($BQ['size'], DEFAULT_BLOCKQUOTE_SIZE);
$BQfamily = tb_default($BQ['face'], DEFAULT_QUOTE_FONT);
$BQstyle = tb_default($BQ['style'], 'italic');

echo 'blockquote, blockquote p {';
	echo "color: $BQcolor;";
	echo "font-size: $BQsize;";
	echo 'font-family: ' . options_typography_return_google_font($BQfamily, $bodyFont, $use_google_fonts) . ';';
	tb_return_style($BQstyle);
echo '}';
?>

<?php
$quote = $themeOptions['quote_typography'];
$qcolor = tb_default($quote['color'], DEFAULT_QUOTE_COLOR);
$qsize = tb_default($quote['size'], DEFAULT_QUOTE_SIZE);
$qfamily = tb_default($quote['face'], DEFAULT_QUOTE_FONT);
$qstyle = tb_default($quote['style'], 'normal');

echo 'quote, quote p {';
	echo "color: $qcolor;";
	echo "font-size: $qsize;";
	echo 'font-family: ' . options_typography_return_google_font($qfamily, $bodyFont, $use_google_fonts) . ';';
	tb_return_style($qstyle);
echo '}';

// Horizontal Spacer Settings
$hsContentBckg = tb_default($themeOptions['hscontent_bckg'], PARENT_URL . '/images/dividers/divider_01.png');

?>

.contentSpacer {
	background: url(<?php echo $hsContentBckg  ?>);
}

h1 a:hover, h2 a:hover, h2.entry-title a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover {
	color: <?php echo $link_color_hover; ?> !important;
}

<?php

$headingBckg = tb_default($themeOptions['heading_bckg_set']['color1'], DEFAULT_SECTION_TITLE_BCKG_COLOR);
$headingBorder = tb_default($themeOptions['heading_bckg_set']['color2'], DEFAULT_SECTION_TITLE_BORDER_COLOR);

?>
	
#content h1, h1.entry-title, #sidebar h3.widget-title, #sidebar .textwidget, h3.homeTitle, #highlightArea h3 {padding: 5px 20px; background-color: <?php echo $headingBckg; ?>; border: 5px solid <?php echo $headingBorder; ?>; border-width: 0 5px;}

blockquote {
	border-color: <?php echo $headingBorder; ?> !important; background-color: <?php echo $headingBckg; ?> !important;
}

#entry-author-info {background-color: <?php echo $headingBckg; ?>; border: 1px solid <?php echo $headingBorder; ?>;}

.listColumns .one_third > div {background-color: <?php echo $headingBckg; ?>; border-color: <?php echo $headingBorder; ?>;}

div.widget_sermon_menu ul {background-color: <?php echo $headingBckg; ?>; border-color: <?php echo $headingBorder; ?>;}

#sidebar ul ul li, div.widget_sermon_menu ul li {background-color: <?php echo $headingBckg; ?>;}

#sidebar ul ul li.fulldp:hover, div.widget_sermon_menu li.fulldp:hover {background-color: <?php echo adjustBrightness($headingBckg, -5); ?>;}

.address_info, #breadcrumbs {border-color: <?php echo $headingBckg; ?>;}


#sidebar ul ul li.fulldp, #sidebar ul ul li.fulldp a:not(.fulld), .widget_sermon_menu a.icon, .address_info, #breadcrumbs {font-family: <?php echo options_typography_return_google_font(tb_default($themeOptions['widget_link_font']['face'], 'default'), $bodyFont, $use_google_fonts); ?>;}

.wpb_content_element div.ui-tabs .ui-tabs-nav li.ui-state-default:hover {
	background-color: <?php echo $headingBckg; ?> !important;
}

.wpb_content_element div.ui-tabs .ui-tabs-nav li.ui-state-active, h3.ui-state-default, .wpb_accordion .ui-accordion .ui-accordion-content {
	background-color: <?php echo $headingBckg; ?> !important;
}

.wpb_tabs li.ui-state-default, .wpb_tour li.ui-state-default, .wpb_tabs .ui-tabs .ui-tabs-panel, h3.ui-state-default, .wpb_accordion .ui-accordion .ui-accordion-content {
	border-color: <?php echo $headingBorder; ?> !important;
	border: 1px solid;	
}

.wpb_tabs li.ui-state-default {
	border-bottom-color: <?php echo $headingBckg; ?> !important;
}

/* .wpb_tour ul.ui-tabs-nav {
	border-bottom: 1px solid <?php echo $headingBorder; ?> !important;		
} */

<?php

$sidebarLinkColor = tb_default($themeOptions['sidebar_link_color_set']['color1'], SIDEBAR_LINK_COLOR);
$sidebarLinkColorHover = tb_default($themeOptions['sidebar_link_color_set']['color2'], SIDEBAR_LINK_COLOR_HOVER);
?>

#sidebar ul ul li a:not(.button), div.widget_sermon_menu ul li a, li.fulldp {color: <?php echo $sidebarLinkColor; ?>;}
#sidebar ul ul li:hover a:not(.button), div.widget_sermon_menu ul li a:hover, li.fulldp:hover {color: <?php echo $sidebarLinkColorHover; ?>;}

#header .inner, #navigation #site-title, #logoArea #site-title {
	padding-top: <?php echo of_get_option('logo_top', '15' ); ?>px;
	padding-bottom: <?php echo of_get_option('logo_bottom', '0' ); ?>px;
}

<?php
	$sidebar_position = tb_default($themeOptions['page_layout'], 'right');
	$content_position = ($sidebar_position == "right" ? "left" : "right");
?>
#wrap #content, #wrap #home2 {float:<?php echo $content_position; ?>;}
#wrap #sidebar {float:<?php echo $sidebar_position; ?>;}
#wrap #sidebar .widget-container {margin-<?php echo $sidebar_position; ?>: 0px;}

#site-title a {
	color: <?php echo tb_default($themeOptions['header_color'], '#000000');?>;
}

<?php
$navigation = $themeOptions['navigation_typography'];
$ncolor = tb_default($navigation['color'], NAVIGATION_COLOR);
$nsize = tb_default($navigation['size'], '14px');
$nfamily = tb_default($navigation['face'], DEFAULT_FONT);
$nstyle = tb_default($navigation['style'], 'normal');

echo '#navigation a {';
	echo "color: $ncolor;";
	echo "font-size: $nsize;";
	echo 'font-family: ' . options_typography_return_google_font($nfamily, $bodyFont, $use_google_fonts) . ';';
	tb_return_style($nstyle);
echo '}';

?>

<?php
$navigation_color_set = $themeOptions['navigation_color_set'];
$navBckg = tb_default($navigation_color_set['color1'], NAVIGATION_BCKG);
$navBckgHover = tb_default($navigation_color_set['color2'], NAVIGATION_BCKG_HOVER);
$navBckgHover2 = tb_default($navigation_color_set['color3'], NAVIGATION_BCKG_HOVER_COLOR2);
$navBorderHover = tb_default($navigation_color_set['color4'], NAVIGATION_BORDER_HOVER);
$navColorHover = tb_default($navigation_color_set['color5'], NAVIGATION_COLOR_HOVER);

$navBckgImage = isset($themeOptions['navigation_bckg_image']) ? $themeOptions['navigation_bckg_image'] : FALSE;
if ($navBckgImage) $navBckgImage = "url($navBckgImage)";

$navigation_submenu_color_set = $themeOptions['navigation_submenu_color_set'];
$navSubmenuBckg = tb_default($navigation_submenu_color_set['color1'], NAVIGATION_SUBMENU_BCKG);
$navSubmenuBckgHover = tb_default($navigation_submenu_color_set['color2'], NAVIGATION_SUBMENU_BCKG_HOVER);
$navSubmenuColor = tb_default($navigation_submenu_color_set['color3'], NAVIGATION_SUBMENU_COLOR);
$navSubmenuColorHover = tb_default($navigation_submenu_color_set['color4'], NAVIGATION_SUBMENU_COLOR_HOVER);

?>

#navigationarea {
	background: <?php echo $navBckg; ?> <?php echo $navBckgImage; ?>;
}

<?php if ($navBckgImage) { ?>
#content h1, h1.entry-title, #sidebar h3.widget-title, #sidebar .textwidget, h3.homeTitle, #highlightArea h3 {
	background-image: <?php echo $navBckgImage; ?>;
}	
<?php } ?>

#navigation > div > ul > li:hover > a, #navigation > div > ul > li.current_page_item > a, #navigation > div > ul > li.current_page_parent > a, #navigation > div > ul > li.current_page_ancestor > a, #navigation > div > ul > li.current-menu-item > a, #navigation > div > ul > li.current-menu-parent > a, #navigation > div > ul > li.current-menu-ancestor > a {
	border-color: <?php echo $navBorderHover; ?>;
	color: <?php echo $navColorHover; ?>;
	background-color: <?php echo $navBckgHover; ?> !important;
	*background-color: <?php echo $navBckgHover; ?> !important;
	background-image: -moz-linear-gradient(top, <?php echo $navBckgHover2; ?>, <?php echo $navBckgHover; ?>) !important;
	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(<?php echo $navBckgHover2; ?>), to(<?php echo $navBckgHover; ?>)) !important;
	background-image: -webkit-linear-gradient(top, <?php echo $navBckgHover2; ?>, <?php echo $navBckgHover; ?>) !important;
	background-image: -o-linear-gradient(top, <?php echo $navBckgHover2; ?>, <?php echo $navBckgHover; ?>) !important;
	background-image: linear-gradient(to bottom, <?php echo $navBckgHover2; ?>, <?php echo $navBckgHover; ?>) !important;
	background-repeat: repeat-x;
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $navBckgHover2; ?>', endColorstr='<?php echo $navBckgHover; ?>', GradientType=0) !important;
	filter: progid:DXImageTransform.Microsoft.gradient(enabled=false) !important;
}

#navigation > div > ul ul {
	border: 1px solid <?php echo adjustBrightness($navBorderHover, 50); ?>;
	border-bottom: none !important;
	background-color: <?php echo $navSubmenuBckg; ?> !important;
}

#navigation > div > ul ul li a {
	color: <?php echo $navSubmenuColor; ?>;
	border-top: 1px solid <?php echo adjustBrightness($navSubmenuBckg, 40); ?>;
	border-bottom: 1px solid <?php echo adjustBrightness($navBorderHover, 50); ?>;
}

#navigation > div > ul ul li a:hover, #navigation > div > ul ul li.current_page_item > a, #navigation > div > ul ul li.current-menu-item > a {
	background-color: <?php echo $navSubmenuBckgHover; ?>;
	color: <?php echo $navSubmenuColorHover; ?>;
}

#navigationSearch {
	background: <?php echo adjustBrightness($navBckg, 5); ?> !important;
	color: <?php echo $ncolor; ?> !important;
	border-color: <?php echo $navBorderHover; ?> !important;
}

#navigationSearch:hover {
	background: <?php echo adjustBrightness($navBckg, 10); ?> !important;
}

#navigation #navigationSearchForm {
	background-color: <?php echo adjustBrightness($navBckg, 5); ?>;
}

<?php $ornamentLine = tb_default($themeOptions['ornament_line_bckg_image'], PARENT_URL . '/images/patterns/default.png' ); ?>
.ornamentLine {	background: url(<?php echo $ornamentLine; ?>); border: 1px solid <?php echo $navBorderHover; ?>; border-width: 1px 0; }

<?php
$logoOption = tb_default($themeOptions['logo_style'], 'default');
if ($logoOption != 'default') {
?>
#logoAreaBorder {
	border-top-color: <?php echo $navBorderHover; ?>; border-bottom-color: <?php echo adjustBrightness($navBorderHover, 50); ?>;
}
<?php
}

if ($logoOption == 'above2') {
	$logoHeight = tb_default($themeOptions['logo_height'], 32);
	$logoTopMargin = tb_default($themeOptions['logo_top'], 8);
	$logoBottomMargin = tb_default($themeOptions['logo_bottom'], 8);
	$navigationSearchTopMargin = ceil(($logoHeight + $logoTopMargin + $logoBottomMargin - 32) / 2);
	?>
	#logoArea #navigationSearchForm {
		margin-top: <?php echo $navigationSearchTopMargin; ?>px !important;
	}
	<?php
}
?>

#tb_gallery .type-<?php echo strtolower(TB_GALLERY_CPT); ?> {
	margin-top: 10px !important;
}

<?php
if(extension_loaded('zlib')){ob_end_flush();}
?>