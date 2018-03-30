<?php
	$zn_main_color = zget_option( 'zn_main_color', 'color_options', false, '#cd2122' );
?>
/* HEADINGS */
h1,
.page-title,
.h1-typography {

	<?php
		$h1_typo = zget_option( 'h1_typo', 'font_options', false, array() );
		foreach ($h1_typo as $key => $value) {
			if( $key == 'font-family' ){
				echo $key .':'. zn_convert_font($value).';';
			} else {
				echo $key .':'. $value.';';
			}
		}
	?>
}

h2,
.page-subtitle,
.subtitle,
.h2-typography {

	<?php
		$h2_typo = zget_option( 'h2_typo', 'font_options', false, array() );
		foreach ($h2_typo as $key => $value) {
			if( $key == 'font-family' ){
				echo $key .':'. zn_convert_font($value).';';
			} else {
				echo $key .':'. $value.';';
			}
		}
	?>

}

h3,
.h3-typography {

	<?php
		$h3_typo = zget_option( 'h3_typo', 'font_options', false, array() );
		foreach ($h3_typo as $key => $value) {
			if( $key == 'font-family' ){
				echo $key .':'. zn_convert_font($value).';';
			} else {
				echo $key .':'. $value.';';
			}
		}
	?>

}

h4,
.h4-typography {

	<?php
		$h4_typo = zget_option( 'h4_typo', 'font_options', false, array() );
		foreach ($h4_typo as $key => $value) {
			if( $key == 'font-family' ){
				echo $key .':'. zn_convert_font($value).';';
			} else {
				echo $key .':'. $value.';';
			}
		}
	?>

}

h5,
.h5-typography {

	<?php
		$h5_typo = zget_option( 'h5_typo', 'font_options', false, array() );
		foreach ($h5_typo as $key => $value) {
			if( $key == 'font-family' ){
				echo $key .':'. zn_convert_font($value).';';
			} else {
				echo $key .':'. $value.';';
			}
		}
	?>
}

h6,
.h6-typography {

	<?php
		$h6_typo = zget_option( 'h6_typo', 'font_options', false, array() );
		foreach ($h6_typo as $key => $value) {
			if( $key == 'font-family' ){
				echo $key .':'. zn_convert_font($value).';';
			} else {
				echo $key .':'. $value.';';
			}
		}
	?>
}

/* Body */
body{

	<?php
		// Check if font option has body color included
		$body_tcolor_fonts = '';
		// Add body fonts values
		$body_font = zget_option( 'body_font', 'font_options', false, array() );
		foreach ($body_font as $key => $value) {
			if(!empty($value)){
				if( $key == 'font-family' ){
					echo $key .':'. zn_convert_font($value).';';
				} else {
					echo $key .':'. $value.';';
				}
				if( $key == 'color' ){
					$body_tcolor_fonts = $value;
				}
			}
		}
	?>
}

/* Footer Area */
.site-footer {

	<?php
		$footer_font = zget_option( 'footer_font', 'font_options', false, array() );
		foreach ($footer_font as $key => $value) {
			if( $key == 'font-family' ){
				echo $key .':'. zn_convert_font($value).';';
			} else {
				echo $key .':'. $value.';';
			}
		}
	?>
}

/* Add Text Color, but check first if the Color option from Body Fonts exists and use that one */
body {
	<?php
		if(empty( $body_tcolor_fonts )){
			if($zn_body_def_textcolor = zget_option( 'zn_body_def_textcolor', 'color_options' )){
				echo 'color:'.$zn_body_def_textcolor.';';
			}
		}
	?>
}
/* Link Color */
a {
	<?php
		if($zn_body_def_linkscolor = zget_option( 'zn_body_def_linkscolor', 'color_options' )){
			echo 'color:'.$zn_body_def_linkscolor.';';
		}
	?>
}
/* Link Hover Color */
a:focus,
a:hover {
	<?php
		if($zn_body_def_linkscolor_hov = zget_option( 'zn_body_def_linkscolor_hov', 'color_options' )){
			echo 'color:'.$zn_body_def_linkscolor_hov.';';
		} elseif( $zn_main_color ) {
			echo 'color:'.$zn_main_color.';';
		}
	?>
}

<?php
// Light text colors
$default_light_color = '#535353';
$zn_body_light_textcolor = zget_option( 'zn_body_def_textcolor', 'color_options', false, $default_light_color );
$zn_body_light_linkscolor = zget_option( 'zn_body_def_linkscolor', 'color_options', false, '#000' );
$zn_body_light_linkscolor_hov = zget_option( 'zn_body_def_linkscolor_hov', 'color_options', false, $zn_main_color );

?>
/* Light text scheme */
.element-scheme--light {color: <?php echo $zn_body_light_textcolor; ?>;}
.element-scheme--light a {color: <?php echo $zn_body_light_linkscolor; ?>;}
.element-scheme--light a:hover,
.element-scheme--light .element-scheme__linkhv:hover {color: <?php echo $zn_body_light_linkscolor_hov; ?>;}
.element-scheme--light .element-scheme__hdg1 { color:<?php echo adjustBrightness( $default_light_color , 40); ?> }
.element-scheme--light .element-scheme__hdg2 { color:<?php echo adjustBrightness( $default_light_color , 10); ?> }
.element-scheme--light .element-scheme__faded { color:<?php echo zn_hex2rgba_str( $default_light_color , 70); ?> }

<?php
// Dark text colors
$default_dark_color = '#dcdcdc';
$zn_body_dark_textcolor = zget_option( 'zn_body_def_textcolor_dark', 'color_options', false, $default_dark_color );
$zn_body_dark_linkscolor = zget_option( 'zn_body_def_linkscolor_dark', 'color_options', false, '#ffffff' );
$zn_body_dark_linkscolor_hov = zget_option( 'zn_body_def_linkscolor_hov_dark', 'color_options', false, $zn_main_color );

?>
/* Dark text scheme */
.element-scheme--dark {color: <?php echo $zn_body_dark_textcolor; ?>;}
.element-scheme--dark a {color: <?php echo $zn_body_dark_linkscolor; ?>;}
.element-scheme--dark a:hover,
.element-scheme--dark .element-scheme__linkhv:hover {color: <?php echo $zn_body_dark_linkscolor_hov; ?>;}
.element-scheme--dark .element-scheme__hdg1 { color:<?php echo adjustBrightness( $default_dark_color , -40); ?> }
.element-scheme--dark .element-scheme__hdg2 { color:<?php echo adjustBrightness( $default_dark_color , -10); ?> }
.element-scheme--dark .element-scheme__faded { color:<?php echo zn_hex2rgba_str( $default_dark_color , 70); ?> }


body #page_wrapper ,
body.boxed #page_wrapper {

	<?php

	// Color
	$zn_body_def_color = zget_option( 'zn_body_def_color', 'color_options' );
	if ( isset($zn_body_def_color) && !empty($zn_body_def_color) ) {
		echo 'background-color:'.$zn_body_def_color.';';
	}

	// Image
	$body_back_image = zget_option( 'body_back_image', 'color_options', false, array() );

	if( !empty( $body_back_image['image'] ) ) { echo 'background-image:url("'.$body_back_image['image'].'");'; }
	if( !empty( $body_back_image['repeat'] ) ) { echo 'background-repeat:'.$body_back_image['repeat'].';'; }
	if( !empty( $body_back_image['position'] ) ) { echo 'background-position:'.$body_back_image['position']['x'].' '.$body_back_image['position']['y'].';'; }
	if( !empty( $body_back_image['attachment'] ) ) { echo 'background-attachment:'.$body_back_image['attachment'].';'; }
	?>
}

<?php if(!empty($zn_body_def_color)){ ?>
/* Force background color for sections after Fixed Position IOS Slider */
.ios-fixed-position-scr ~ .zn_section { background-color:<?php echo $zn_body_def_color;?>}
.kl-mask .bmask-bgfill { fill: <?php echo $zn_body_def_color;?>; }
<?php } ?>

<?php
/* LAYOUT OPTIONS - BOXED */
$zn_width = zget_option( 'zn_width' , 'layout_options', false, '1170' );

if($zn_width == '960'){
	echo '@media screen and (min-width: 1200px) { .container {width: 970px; } }';
}
elseif($zn_width == 'custom'){
	/* CUSTOM HEADER WIDTH */
	$zn_initial_width = '1170';
	$zn_custom_width = (int)zget_option( 'custom_width' , 'layout_options', false, '1170' );
	if( !empty($zn_custom_width) && ( $zn_custom_width != '1170px' || $zn_custom_width != '1170' ) ){
		$zn_custom_width_extra = $zn_custom_width+30;
		echo '
		@media (min-width: '.$zn_custom_width_extra.'px) {
			.container {width:'.$zn_custom_width.'px;}
			body.boxed #page_wrapper {width:'.$zn_custom_width_extra.'px;}
			/* Calc\'s */
			.zn_col_eq_first { padding-left: calc((100vw - '.$zn_custom_width.'px) / 2);}
			.zn_col_eq_last {padding-right: calc((100vw - '.$zn_custom_width.'px) / 2);}
			.woocommerce div.product.prodpage-style3 .summary {padding-right: calc((100vw - '.$zn_custom_width.'px) / 2);}
			.process_steps--style2 .process_steps__container:before { padding-left: calc(((100vw - '.$zn_custom_width.'px) / 2) + 60px); }
			.kl-contentmaps__panel { left:calc((100vw - '.$zn_custom_width.'px) / 2) ; }
			.kl-ios-selectors-block.thumbs { width:'.$zn_custom_width.'px; margin-left:-'.($zn_custom_width/2).'px;}
			.klios-imageboxes {right: calc((100vw - '.$zn_custom_width.'px) / 2);}
			.klios-imageboxes.klios-alignright,
			.klios-imageboxes.fromright {left: calc((100vw - '.$zn_custom_width.'px) / 2);}
			.process_steps--style2 .process_steps__container {padding-right: calc(((100vw - '.$zn_custom_width.'px) / 2) + 15px);}
			.process_steps--style2 .process_steps__container:before { padding-right: calc(((100vw - '.$zn_custom_width.'px) / 2) + 60px); }
			.process_steps--style2 .process_steps__intro {padding-left: calc(((100vw - '.$zn_custom_width.'px) / 2) + 15px);}
			.th-wowslider { max-width:'.$zn_custom_width.'px;}
			.zn_section_size.full_width .recentwork_carousel__left { padding-left:calc((100vw - '.($zn_custom_width-15).'px) / 2);}
		}
		@media (min-width:1200px) and (max-width: '.($zn_custom_width_extra-1).'px) {
			.container {width:100%;}
			.iosSlider .kl-iosslide-caption {width:'.$zn_initial_width.'px}
			/* Calc\'s */
			.zn_col_eq_first { padding-left: 15px;}
			.zn_col_eq_last {padding-right: 15px;}
			.woocommerce div.product.prodpage-style3 .summary {padding-right: 15px;}
			.process_steps--style2 .process_steps__container:before { padding-left: 15px; }
			.kl-contentmaps__panel { left:15px; }
			.kl-ios-selectors-block.thumbs { width:100vw; margin-left:calc(100vw / 2);}
			.klios-imageboxes {right: 15px;}
			.klios-imageboxes.klios-alignright,
			.klios-imageboxes.fromright {left: 15px;}
			.process_steps--style2 .process_steps__container {padding-right: 15px;}
			.process_steps--style2 .process_steps__container:before { padding-right: 15px; }
			.process_steps--style2 .process_steps__intro {padding-left: 15px;}
			.th-wowslider { max-width:100%;}
			.zn_section_size.full_width .recentwork_carousel__left { padding-left:15px;}
		}';

	}
}
elseif($zn_width == 'custom_perc'){
	$zn_custom_perc_width = zget_option( 'custom_perc_width' , 'layout_options', false, '100' );
	if( !empty($zn_custom_perc_width) ){
		echo zn_smart_slider_css( $zn_custom_perc_width, '.container', 'width', '%' );
	}
}

/* RESPONSIVE MENU TRIGGER */
$menu_trigger = zget_option( 'header_res_width', 'general_options', false, 992 );
$menu_trigger2 = $menu_trigger + 1;
echo "
@media (max-width: {$menu_trigger}px) {
	#main-menu { display: none !important;}
}
@media (min-width: {$menu_trigger2}px) {
	.zn-res-menuwrapper { display: none;}
}
";


/* CUSTOM HEADER WIDTH */
$def_height = 1170;
$old_height = zget_option( 'header_width' , 'general_options', false, '1170' );

if(!empty($old_height) && ( $old_height != '1170px' || $old_height != '1170' )){

	$zn_head_width_v2 = zget_option( 'header_width_v2' , 'general_options', false, array(
			'breakpoints' => 1,
			'lg' => $old_height,
			'unit_lg' => 'px',
			'md' => 100,
			'unit_md' => '%',
			'sm' => 100,
			'unit_sm' => '%',
			'xs' => 100,
			'unit_xs' => '%'
		)
	);

	$header_lg_height = $zn_head_width_v2['lg'];

	if( (int) $header_lg_height != 1170){

		echo zn_smart_slider_css( $zn_head_width_v2, '.site-header .siteheader-container', 'width' );

		if($header_lg_height > $def_height){
			echo '@media (min-width:1200px) and (max-width: '.($header_lg_height - 1).'px) {.site-header .siteheader-container {width:100%;} }';
		}
	}


}


/*----------------------  Logo --------------------------*/
if( $logo_image = zget_option( 'logo_upload', 'general_options' ) ) {

	$logo_saved_size_type = zget_option( 'logo_size', 'general_options', false, 'yes' );
		$logo_width = '';
		$logo_height = '';

	if( $logo_saved_size_type == 'yes'){

		$logo_size = @getimagesize($logo_image);

		if (isset($logo_size[0]) && isset($logo_size[1])) {
			$logo_width = 'width:auto;';
			$logo_height = 'height:auto;';
		}

	}
	elseif( $logo_saved_size_type == 'no'){

		$logo_saved_sizes = zget_option( 'logo_manual_size', 'general_options', false, 'false' );

		if ( !empty( $logo_saved_sizes['width'] ) ) {
			$logo_width = 'width:'.$logo_saved_sizes['width'].'px;';
		}
		if( !empty( $logo_saved_sizes['height'] ) ) {
			$logo_height = 'height:'.$logo_saved_sizes['height'].'px;';
		}
	}
?>
.site-logo-img {
	max-width:none;
	<?php echo $logo_width; ?>
	<?php echo $logo_height; ?>
}

<?php }
else { ?>
.site-logo,
.site-logo-anch  {
	text-decoration:none;
	<?php
		$logo_font_option = zget_option( 'logo_font', 'general_options', false, array() );
		foreach ($logo_font_option as $key => $value) {
			echo $key .':'. $value.';';
		}
	?>
}

.site-logo-anch:hover {
	<?php if ( $logo_hover_color = zget_option( 'logo_hover', 'general_options', false, array() ) ) {
		foreach ($logo_hover_color as $key => $value) {
			echo $key .':'. $value.';';
		}
	} ?>
}

<?php } ?>

/*----------------------  Header --------------------------*/

.uh_zn_def_header_style ,
.zn_def_header_style ,
.page-subheader.zn_def_header_style ,
.kl-slideshow.zn_def_header_style ,
.page-subheader.uh_zn_def_header_style ,
.kl-slideshow.uh_zn_def_header_style {
<?php if ( $def_header_color = zget_option( 'def_header_color', 'general_options' ) ) { echo 'background-color:'.$def_header_color.';'; } ?>
}

.page-subheader.zn_def_header_style .bgback ,
.kl-slideshow.zn_def_header_style .bgback ,
.page-subheader.uh_zn_def_header_style .bgback ,
.kl-slideshow.uh_zn_def_header_style .bgback{
<?php if ( $def_header_background = zget_option( 'def_header_background', 'general_options', false, false ) ) { echo 'background-image:url("'.$def_header_background.'");'; } ?>
}

<?php

/* PAGE SUBHEADER */

	// Default Height
	$def_header_height = zget_option( 'def_header_custom_height', 'general_options', false, '300' );
	if( ! empty( $def_header_height ) ){
		echo "
			.page-subheader.zn_def_header_style,
			.page-subheader.uh_zn_def_header_style {
				min-height: {$def_header_height}px;
				height: {$def_header_height}px;
			}
		";
	}

	// Default top padding
	$def_header_top_padding = zget_option( 'def_header_top_padding', 'general_options', false, '170' );
	if( ! empty( $def_header_top_padding ) ){
		echo "
			.page-subheader.zn_def_header_style .ph-content-wrap,
			.page-subheader.uh_zn_def_header_style .ph-content-wrap { padding-top: {$def_header_top_padding}px; }
		";
	}

	echo '
		.page-subheader.zn_def_header_style ,
		.kl-slideshow.zn_def_header_style,
		.page-subheader.uh_zn_def_header_style ,
		.kl-slideshow.uh_zn_def_header_style {';
		// GRADIENT OVER COLOR
		if ( zget_option( 'def_grad_bg', 'general_options', false, 1 ) ) {
			echo 'background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%,transparent), color-stop(100%,rgba(0,0,0,0.5)));';
			echo 'background-image: -webkit-linear-gradient(top, transparent 0%,rgba(0,0,0,0.5) 100%);';
			echo 'background-image: linear-gradient(to bottom, transparent 0%,rgba(0,0,0,0.5) 100%);';
		}
	echo '}';

	// GLARE EFFECT
	if ( zget_option( 'def_glare', 'general_options', false, 0 ) ) {
			echo '
			.page-subheader.zn_def_header_style .bgback:after,
			.kl-slideshow.zn_def_header_style .bgback:after,
			.page-subheader.uh_zn_def_header_style .bgback:after,
			.kl-slideshow.uh_zn_def_header_style .bgback:after {';
			echo 'content:""; position:absolute; top:0; left:0; width:100%; height:100%; z-index:-1;background-image: url('.get_template_directory_uri().'/images/glare-effect.png); background-repeat: no-repeat; background-position: center top;';
		echo '}';
	}

	// Animation
	if ( zget_option( 'def_header_animate', 'general_options', false, 0 ) ) {
		echo '
		.zn_def_header_style .th-sparkles,
		.kl-slideshow.zn_def_header_style .th-sparkles,
		.uh_zn_def_header_style .th-sparkles,
		.kl-slideshow.uh_zn_def_header_style .th-sparkles {display:block}';
	}

	// Default SHADOW
	$def_bottom_style = zget_option( 'def_bottom_style', 'general_options', false, false );
	/*
		Commented as per https://github.com/hogash/kallyas/issues/386
	*/
	// $zn_main_style = zget_option( 'zn_main_style', 'color_options', false, 'light' );
	$zn_main_style = 'light';

	if ( $def_bottom_style == 'shadow' ) {

		echo '.page-subheader.zn_def_header_style .zn_header_bottom_style , .kl-slideshow.zn_def_header_style .zn_header_bottom_style,';
		echo '.page-subheader.uh_zn_def_header_style .zn_header_bottom_style , .kl-slideshow.uh_zn_def_header_style .zn_header_bottom_style {';
			echo 'position:absolute; bottom:0; left:0; width:100%; height:20px; background:url('.get_template_directory_uri().'/images/shadow-up.png) no-repeat center bottom; z-index: 2;';
		echo '}';

		echo '.page-subheader.zn_def_header_style .zn_header_bottom_style:after , .kl-slideshow.zn_def_header_style .zn_header_bottom_style:after,';
		echo '.page-subheader.uh_zn_def_header_style .zn_header_bottom_style:after , .kl-slideshow.uh_zn_def_header_style .zn_header_bottom_style:after {';
			echo 'content:\'\'; position:absolute; bottom:-18px; left:50%; border:6px solid transparent; border-top-color:#fff; margin-left:-6px;';
		echo '}';

		echo '.page-subheader.zn_def_header_style, .kl-slideshow.zn_def_header_style,';
		echo '.page-subheader.uh_zn_def_header_style, .kl-slideshow.uh_zn_def_header_style {';
			echo 'border-bottom:6px solid #FFFFFF';
		echo '}';

	}


	// SHADOW UP AND DOWN
	if ( $def_bottom_style == 'shadow_ud' ) {

		echo '.page-subheader.zn_def_header_style .zn_header_bottom_style , .kl-slideshow.zn_def_header_style .zn_header_bottom_style,';
		echo '.page-subheader.uh_zn_def_header_style .zn_header_bottom_style , .kl-slideshow.uh_zn_def_header_style .zn_header_bottom_style {';
			echo 'position:absolute; bottom:0; left:0; width:100%; height:20px; background:url('.get_template_directory_uri().'/images/shadow-up.png) no-repeat center bottom; z-index: 2;';
		echo '}';

		echo '.page-subheader.zn_def_header_style .zn_header_bottom_style:after , .kl-slideshow.zn_def_header_style .zn_header_bottom_style:after,';
		echo '.page-subheader.uh_zn_def_header_style .zn_header_bottom_style:after , .kl-slideshow.uh_zn_def_header_style .zn_header_bottom_style:after {';
			echo 'content:\'\'; position:absolute; bottom:-18px; left:50%; border:6px solid transparent; border-top-color:#fff; margin-left:-6px;';
		echo '}';

		echo '.page-subheader.zn_def_header_style, .kl-slideshow.zn_def_header_style,';
		echo '.page-subheader.uh_zn_def_header_style, .kl-slideshow.uh_zn_def_header_style {';
			echo 'border-bottom:6px solid #FFFFFF';
		echo '}';

		echo '.page-subheader.zn_def_header_style .zn_header_bottom_style:before , .kl-slideshow.zn_def_header_style .zn_header_bottom_style:before,';
		echo '.page-subheader.uh_zn_def_header_style .zn_header_bottom_style:before , .kl-slideshow.uh_zn_def_header_style .zn_header_bottom_style:before {';
			echo 'content:\'\'; position:absolute; bottom:-26px; left:0; width:100%; height:20px; background:url('.get_template_directory_uri().'/images/shadow-down.png) no-repeat center top; opacity:.6; filter:alpha(opacity=60);';
		echo '}';

	}

	// MASK 1
	if ( $def_bottom_style == 'mask1' && $zn_main_style == 'light' ) {

		echo '.page-subheader.zn_def_header_style .zn_header_bottom_style , .kl-slideshow.zn_def_header_style .zn_header_bottom_style,';
		echo '.page-subheader.uh_zn_def_header_style .zn_header_bottom_style , .kl-slideshow.uh_zn_def_header_style .zn_header_bottom_style {';
			echo 'position:absolute; bottom:0; left:0; width:100%; height:27px; z-index:99; background:url('.get_template_directory_uri().'/images/bottom_mask.png) no-repeat center top;';
		echo '}';

	}
	/*
		Commented as per https://github.com/hogash/kallyas/issues/386
	*/
	 elseif ( $def_bottom_style == 'mask1' && $zn_main_style == 'dark' )  {
	 	echo '.page-subheader.zn_def_header_style .zn_header_bottom_style , .kl-slideshow.zn_def_header_style .zn_header_bottom_style {';
	 		echo 'position:absolute; bottom:0; left:0; width:100%; height:27px; z-index:99; background:url('.get_template_directory_uri().'/images/bottom_mask_dark.png) no-repeat center top;';
	 	echo '}';
	 }

	// MASK 2
	if ( $def_bottom_style == 'mask2' && $zn_main_style == 'light' ) {

		echo '.page-subheader.zn_def_header_style .zn_header_bottom_style , .kl-slideshow.zn_def_header_style .zn_header_bottom_style,';
		echo '.page-subheader.uh_zn_def_header_style .zn_header_bottom_style , .kl-slideshow.uh_zn_def_header_style .zn_header_bottom_style {';
			echo 'position:absolute; bottom:0; left:0; width:100%; z-index:99; ';
			echo 'height:33px; background:url('.get_template_directory_uri().'/images/bottom_mask2.png) no-repeat center top;';
		echo '}';

	}
	/*
		Commented as per https://github.com/hogash/kallyas/issues/386
	*/
	 elseif ( $def_bottom_style == 'mask2' && $zn_main_style == 'dark' ) {
	 	echo '.page-subheader.zn_def_header_style .zn_header_bottom_style , .kl-slideshow.zn_def_header_style .zn_header_bottom_style {';
	 		echo 'position:absolute; bottom:0; left:0; width:100%;  z-index:99; ';
	 		echo 'height:33px; background:url('.get_template_directory_uri().'/images/bottom_mask2_dark.png) no-repeat center top;';
	 	echo '}';
	 }
?>



/*----------------------  Unlimited Headers --------------------------*/

<?php
	$saved_headers = zget_option( 'header_generator', 'unlimited_header_options', false, array() );
	foreach ( $saved_headers as $header ) {

		if ( isset ( $header['uh_style_name'] ) && !empty ( $header['uh_style_name'] ) ) {
			$header_name = strtolower ( str_replace(' ','_',$header['uh_style_name'] ) );
			$header_name = sanitize_html_class( $header_name );

			// Background type
			$bg_type = isset($header['uh_bg_type']) && !empty($header['uh_bg_type']) ? $header['uh_bg_type'] : 'simple_bg';

			// Page header + BGBACK
			echo '.page-subheader.uh_'.$header_name.' .bgback , .kl-slideshow.uh_'.$header_name.' .bgback {';

			if($bg_type == 'simple_bg'){

				if ( isset ( $header['uh_background_image'] ) && !empty ( $header['uh_background_image'] ) ) {
					echo 'background-image:url("'.$header['uh_background_image'].'");';
				}

			} else if($bg_type == 'advanced_bg'){
				$advanced_bg = $header['uh_background_image_advanced'];

				if ( isset ( $advanced_bg ) && !empty ( $advanced_bg ) ) {

	                $background_image = $advanced_bg['image'];

	                $background_styles = array();
	                $background_styles[] = 'background-image:url('.$background_image.')';
	                $background_styles[] = 'background-repeat:'.$advanced_bg['repeat'];
	                $background_styles[] = 'background-attachment:'.$advanced_bg['attachment'];
	                $background_styles[] = 'background-position:'.$advanced_bg['position']['x'].' '.$advanced_bg['position']['y'];
	                $background_styles[] = 'background-size:'.$advanced_bg['size'];

	                if ( !empty($background_image) ) {
	                    echo implode(';', $background_styles);
	                }

				}
			}

			echo '}';

			// Animate - Page header + SPARKLES
			if ( !empty ( $header['uh_anim_bg'] ) ) {
				echo '.uh_'.$header_name.' .th-sparkles , .kl-slideshow.uh_'.$header_name.' .th-sparkles {display:block}';
			}
			else {
				echo '.uh_'.$header_name.' .th-sparkles , .kl-slideshow.uh_'.$header_name.' .th-sparkles{display:none}';
			}

			// COLOR - Page header
			echo '.page-subheader.uh_'.$header_name.' , .kl-slideshow.uh_'.$header_name.' {';

			if ( isset ( $header['uh_header_color'] ) && !empty ( $header['uh_header_color'] ) ) {
				echo 'background-color:'.$header['uh_header_color'].';';
			}

			// GRADIENT OVER COLOR
			if ( isset ( $header['uh_grad_bg'] ) && !empty ( $header['uh_grad_bg'] ) ) {
				echo 'background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%,transparent), color-stop(100%,rgba(0,0,0,0.5)));';
				echo 'background-image: -webkit-linear-gradient(top, transparent 0%,rgba(0,0,0,0.5) 100%);';
				echo 'background-image: linear-gradient(to bottom, transparent 0%,rgba(0,0,0,0.5) 100%);';
			}

			echo '}';

			// GLARE EFFECT
			if ( isset ( $header['uh_glare'] ) && !empty ( $header['uh_glare'] ) ) {

				echo '.page-subheader.uh_'.$header_name.' .bgback:after , .kl-slideshow.uh_'.$header_name.' .bgback:after {';
					echo 'content:""; position:absolute; top:0; left:0; width:100%; height:100%; z-index:-1;background-image: url('.get_template_directory_uri().'/images/glare-effect.png); background-repeat: no-repeat; background-position: center top;';
				echo '}';

			}

			// Intentionally skipped "kl-slideshow" class
			echo '.page-subheader.uh_'.$header_name.'.page-subheader--inherit-hp{';
				// Custom Height
				if ( isset ( $header['uh_header_height'] ) && !empty ( $header['uh_header_height'] ) ) {
					$header_height = $header['uh_header_height'];
						echo 'height:'.$header_height.'px; min-height:'.$header_height.'px;';
				}
			echo '}';
			echo '.page-subheader.uh_'.$header_name.'.page-subheader--inherit-hp .ph-content-wrap {';
				// Custom Top Padding
				if ( isset ( $header['uh_top_padding'] ) && !empty ( $header['uh_top_padding'] ) ) {
					$subheader_top_padding = $header['uh_top_padding'];
						echo 'padding-top:'.$subheader_top_padding.'px;';
				}
				// Custom Bottom Padding
				if ( isset ( $header['uh_bottom_padding'] ) && !empty ( $header['uh_bottom_padding'] ) ) {
					$subheader_bottom_padding = $header['uh_bottom_padding'];
						echo 'padding-bottom:'.$subheader_bottom_padding.'px;';
				}
			echo '}';

			// Subheader height & padding for MEDIUM
			echo '@media screen and (min-width:992px) and (max-width:1199px) {';
				echo '.page-subheader.uh_'.$header_name.'.page-subheader--inherit-hp{';
					// Custom Height
					if ( isset ( $header['uh_header_height_md'] ) && !empty ( $header['uh_header_height_md'] ) ) {
						$header_height_md = $header['uh_header_height_md'];
						if($header_height_md != 300){
							echo 'height:'.$header_height_md.'px; min-height:'.$header_height_md.'px;';
						}
					}
				echo '}';
				echo '.page-subheader.uh_'.$header_name.'.page-subheader--inherit-hp .ph-content-wrap {';
					// Custom Top Padding
					if ( isset ( $header['uh_top_padding_md'] ) && !empty ( $header['uh_top_padding_md'] ) ) {
						$subheader_top_padding_md = $header['uh_top_padding_md'];
						if($subheader_top_padding_md != 170){
							echo 'padding-top:'.$subheader_top_padding_md.'px;';
						}
					}
					// Custom Bottom Padding
					if ( isset ( $header['uh_bottom_padding_md'] ) && !empty ( $header['uh_bottom_padding_md'] ) ) {
						$subheader_bottom_padding_md = $header['uh_bottom_padding_md'];
						if($subheader_bottom_padding_md != 0){
							echo 'padding-bottom:'.$subheader_bottom_padding_md.'px;';
						}
					}
				echo '}';
			echo '}';

			// Subheader height & padding for SMALL
			echo '@media screen and (min-width:768px) and (max-width:991px) {';
				echo '.page-subheader.uh_'.$header_name.'.page-subheader--inherit-hp{';
					// Custom Height
					if ( isset ( $header['uh_header_height_sm'] ) && !empty ( $header['uh_header_height_sm'] ) ) {
						$header_height_sm = $header['uh_header_height_sm'];
						if($header_height_sm != 300){
							echo 'height:'.$header_height_sm.'px; min-height:'.$header_height_sm.'px;';
						}
					}
				echo '}';
				echo '.page-subheader.uh_'.$header_name.'.page-subheader--inherit-hp .ph-content-wrap {';
					// Custom Top Padding
					if ( isset ( $header['uh_top_padding_sm'] ) && !empty ( $header['uh_top_padding_sm'] ) ) {
						$subheader_top_padding_sm = $header['uh_top_padding_sm'];
						if($subheader_top_padding_sm != 170){
							echo 'padding-top:'.$subheader_top_padding_sm.'px;';
						}
					}
					// Custom Bottom Padding
					if ( isset ( $header['uh_bottom_padding_sm'] ) && !empty ( $header['uh_bottom_padding_sm'] ) ) {
						$subheader_bottom_padding_sm = $header['uh_bottom_padding_sm'];
						if($subheader_bottom_padding_sm != 0){
							echo 'padding-bottom:'.$subheader_bottom_padding_sm.'px;';
						}
					}
				echo '}';
			echo '}';

			// Subheader height & padding for EXTRA SMALL
			echo '@media screen and (max-width:767px) {';
				echo '.page-subheader.uh_'.$header_name.'.page-subheader--inherit-hp{';
					// Custom Height
					if ( isset ( $header['uh_header_height_xs'] ) && !empty ( $header['uh_header_height_xs'] ) ) {
						$header_height_xs = $header['uh_header_height_xs'];
						if($header_height_xs != 300){
							echo 'height:'.$header_height_xs.'px; min-height:'.$header_height_xs.'px;';
						}
					}
				echo '}';
				echo '.page-subheader.uh_'.$header_name.'.page-subheader--inherit-hp .ph-content-wrap {';
					// Custom Top Padding
					if ( isset ( $header['uh_top_padding_xs'] ) && !empty ( $header['uh_top_padding_xs'] ) ) {
						$subheader_top_padding_xs = $header['uh_top_padding_xs'];
						if($subheader_top_padding_xs != 170){
							echo 'padding-top:'.$subheader_top_padding_xs.'px;';
						}
					}
					// Custom Bottom Padding
					if ( isset ( $header['uh_bottom_padding_xs'] ) && !empty ( $header['uh_bottom_padding_xs'] ) ) {
						$subheader_bottom_padding_xs = $header['uh_bottom_padding_xs'];
						if($subheader_bottom_padding_xs != 0){
							echo 'padding-bottom:'.$subheader_bottom_padding_xs.'px;';
						}
					}
				echo '}';
			echo '}';



			// Default SHADOW
			if ( isset ( $header['uh_bottom_style'] ) && $header['uh_bottom_style'] == 'shadow' ) {

				echo '.page-subheader.uh_'.$header_name.' .zn_header_bottom_style , .kl-slideshow.uh_'.$header_name.' .zn_header_bottom_style {';
					echo 'position:absolute; bottom:0; left:0; width:100%; height:20px; background:url('.get_template_directory_uri().'/images/shadow-up.png) no-repeat center bottom; z-index: 2;';
				echo '}';

				echo '.page-subheader.uh_'.$header_name.' .zn_header_bottom_style:after , .kl-slideshow.uh_'.$header_name.' .zn_header_bottom_style:after {';
					echo 'content:\'\'; position:absolute; bottom:-18px; left:50%; border:6px solid transparent; border-top-color:#fff; margin-left:-6px;';
				echo '}';

				echo '.page-subheader.uh_'.$header_name.', .kl-slideshow.uh_'.$header_name.' {';
					echo 'border-bottom:6px solid #FFFFFF';
				echo '}';

			}


			// SHADOW UP AND DOWN
			if ( isset ( $header['uh_bottom_style'] ) && $header['uh_bottom_style'] == 'shadow_ud' ) {

				echo '.page-subheader.uh_'.$header_name.' .zn_header_bottom_style , .kl-slideshow.uh_'.$header_name.' .zn_header_bottom_style {';
					echo 'position:absolute; bottom:0; left:0; width:100%; height:20px; background:url('.get_template_directory_uri().'/images/shadow-up.png) no-repeat center bottom; z-index: 2;';
				echo '}';

				echo '.page-subheader.uh_'.$header_name.' .zn_header_bottom_style:after , .kl-slideshow.uh_'.$header_name.' .zn_header_bottom_style:after {';
					echo 'content:\'\'; position:absolute; bottom:-18px; left:50%; border:6px solid transparent; border-top-color:#fff; margin-left:-6px;';
				echo '}';

				echo '.page-subheader.uh_'.$header_name.', .kl-slideshow.uh_'.$header_name.' {';
					echo 'border-bottom:6px solid #FFFFFF';
				echo '}';

				echo '.page-subheader.uh_'.$header_name.' .zn_header_bottom_style:before , .kl-slideshow.uh_'.$header_name.' .zn_header_bottom_style:before {';
					echo 'content:\'\'; position:absolute; bottom:-26px; left:0; width:100%; height:20px; background:url('.get_template_directory_uri().'/images/shadow-down.png) no-repeat center top; opacity:.6; filter:alpha(opacity=60);';
				echo '}';

			}

			// MASK 1
			if ( isset ( $header['uh_bottom_style'] ) && $header['uh_bottom_style'] == 'mask1' && $zn_main_style == 'light' ) {

				echo '.page-subheader.uh_'.$header_name.' .zn_header_bottom_style , .kl-slideshow.uh_'.$header_name.' .zn_header_bottom_style {';
					echo 'position:absolute; bottom:0; left:0; width:100%; height:27px; z-index:99; background:url('.get_template_directory_uri().'/images/bottom_mask.png) no-repeat center top;';
				echo '}';

			}
			/*
				Commented as per https://github.com/hogash/kallyas/issues/386
			*/
			 elseif ( isset ( $header['uh_bottom_style'] ) && $header['uh_bottom_style'] == 'mask1' && $zn_main_style == 'dark' )  {
			 	echo '.page-subheader.uh_'.$header_name.' .zn_header_bottom_style , .kl-slideshow.uh_'.$header_name.' .zn_header_bottom_style {';
			 		echo 'position:absolute; bottom:0; left:0; width:100%; height:27px; z-index:99; background:url('.get_template_directory_uri().'/images/bottom_mask_dark.png) no-repeat center top;';
			 	echo '}';
			 }

			// MASK 2
			if ( isset ( $header['uh_bottom_style'] ) && $header['uh_bottom_style'] == 'mask2' && $zn_main_style == 'light' ) {

				echo '.page-subheader.uh_'.$header_name.' .zn_header_bottom_style , .kl-slideshow.uh_'.$header_name.' .zn_header_bottom_style {';
					echo 'position:absolute; bottom:0; left:0; width:100%; z-index:99; ';
					echo 'height:33px; background:url('.get_template_directory_uri().'/images/bottom_mask2.png) no-repeat center top;';
				echo '}';

			}
			/*
				Commented as per https://github.com/hogash/kallyas/issues/386
			*/
			 elseif ( isset ( $header['uh_bottom_style'] ) && $header['uh_bottom_style'] == 'mask2' && $zn_main_style == 'dark' ) {
			 	echo '.page-subheader.uh_'.$header_name.' .zn_header_bottom_style , .kl-slideshow.uh_'.$header_name.' .zn_header_bottom_style {';
			 		echo 'position:absolute; bottom:0; left:0; width:100%;  z-index:99; ';
			 		echo 'height:33px; background:url('.get_template_directory_uri().'/images/bottom_mask2_dark.png) no-repeat center top;';
			 	echo '}';
			 }

		}

	}

?>
/* GENERAL COLOR */

/* Text - Main Color */
.m_title,
.text-custom,
.text-custom-hover:hover,
.text-custom-after:after,
.text-custom-before:before,
.text-custom-parent .text-custom-child,
.text-custom-parent .text-custom-child-hov:hover,
.text-custom-parent-hov:hover .text-custom-child,
.text-custom-parent-act.active .text-custom-active,
.text-custom-a>a,
.btn-lined.lined-custom,
.latest_posts--4.default-style .latest_posts-link:hover .latest_posts-readon,
.grid-ibx__item:hover .grid-ibx__icon,
.site-header .site-header .main-nav.mainnav--active-text > ul > li.active > a,
.site-header .site-header .main-nav.mainnav--active-text > ul > li:hover > a,
.site-header .site-header .main-nav.mainnav--active-text > ul > li > a:hover,
.preloader-pulsating-circle,
.preloader-material-circle,
ul.colored-list[class*="list-style"] li:before,
.woocommerce-MyAccount-navigation ul li.is-active a
{color:<?php echo $zn_main_color; ?>;}

/* Darker text color */
.btn-lined.lined-custom:hover,
#header .main-nav > ul > li.menuitem-highlight > a
{ color: <?php echo adjustBrightness($zn_main_color, 20); ?>;}

/**** Background Color - Main Color ****/
.kl-main-bgcolor,
.kl-main-bgcolor-after:after,
.kl-main-bgcolor-before:before,
.kl-main-bgcolor-hover:hover,
.kl-main-bgcolor-parenthover:hover .kl-main-bgcolor-child
{background-color:<?php echo $zn_main_color;?>;}

/* BgColor Site components */
.main-nav.mainnav--active-bg > ul > li > a:before,
.main-nav .zn_mega_container li a:not(.zn_mega_title):before,
.main-nav ul .zn-mega-new-item,
.social-icons.sc--normal .social-icons-item:hover,
.kl-cart-button .glyphicon:after,
.site-header.style7 .kl-cart-button .glyphicon:after,
.site-header.style8 .site-header-bottom-wrapper .kl-cta-lined,
.site-header.style9 .kl-cta-lined,
.kl-cta-ribbon,
.cart-container .buttons .button.wc-forward,
.chaser-main-menu li.active > a
{background-color:<?php echo $zn_main_color;?>;}

/* BgColor PB elements */
.action_box,
.action_box.style3:before,
.action_box.style3 .action_box-inner:before,
.btn-fullcolor,
.btn-fullcolor:focus,
.btn-fullcolor.btn-skewed:before,
.circle-text-box.style3 .wpk-circle-span,
.circle-text-box.style2 .wpk-circle-span::before,
.circle-text-box:not(.style3) .wpk-circle-span:after,
.elm-social-icons.sc--normal .elm-sc-icon:hover,
.elm-searchbox--normal .elm-searchbox__submit,
.elm-searchbox--transparent .elm-searchbox__submit,
.hover-box:hover,
.how_to_shop .number,
.image-boxes.image-boxes--4 .image-boxes-title:after,
.kl-flex--classic .zn_simple_carousel-arr:hover,
.kl-flex--modern .flex-underbar,
.kl-blog-item-overlay-more:hover,
.kl-blog-related-post-link:after,
.kl-ioscaption--style1 .more:before,
.kl-ioscaption--style1 .more:after,
.kl-ioscaption--style2 .more,
.kl-ioscaption--style3.s3ext .main_title::before,
.kl-ios-selectors-block.bullets2 .item.selected::before,
.kl-ioscaption--style5 .klios-separator-line span,
.kl-ptfcarousel-carousel-arr:hover,
.kl-ptfsortable-nav-link:hover,
.kl-ptfsortable-nav-item.current .kl-ptfsortable-nav-link,
.latest_posts3-post-date,
.latest_posts--style4.kl-style-2 .latest_posts-elm-titlew,
.latest_posts--style4.kl-style-2 .latest_posts-title:after,
.latest_posts--style4.default-style .latest_posts-readon,
.ls__nav-item.selected,
.lt-offers-item:after,
.media-container__link--style-borderanim1 > i,
.nivo-directionNav a:hover,
.pricing-table-element .plan-column.featured .subscription-price .inner-cell,
.process_steps--style1 .process_steps__intro,
.process_steps--style2 .process_steps__intro,
.process_steps--style2 .process_steps__intro:before,
.recentwork_carousel--1 .recentwork_carousel__bg,
.recentwork_carousel--2 .recentwork_carousel__title:after,
.recentwork_carousel--2 .recentwork_carousel__cat,
.recentwork_carousel_v2 .recentwork_carousel__plus,
.recentwork_carousel_v3 .btn::before,
.recentwork_carousel_v3 .recentwork_carousel__cat,
.timeline_box:hover:before,
.title_circle,
.title_circle:before,
.services_box--classic:hover .services_box__icon,
.spp-el-item.active .spp-el-nav-link:before,
.stepbox2-box--ok:before,
.stepbox2-box--ok:after,
.stepbox2-box--ok,
.stepbox3-content:before,
.stepbox4-number:before,
.tbk--color-theme.tbk-symbol--line .tbk__symbol span,
.tbk--color-theme.tbk-symbol--line_border .tbk__symbol span,
.th-wowslider a.ws_next:hover,
.th-wowslider a.ws_prev:hover,
.zn-acc--style4 .acc-title,
.zn-acc--style4 .acc-tgg-button .acc-icon:before,
.zn-acc--style3 .acc-tgg-button:before,
.zn_badge_sale,
.zn_badge_sale:after,
/* Deprecated */
.shop-features .shop-feature:hover,
.feature_box.style3 .box:hover,
.services_box_element:hover .box .icon
{background-color:<?php echo $zn_main_color;?>;}

/* Alpha BG */
.kl-ioscaption--style4 .more:before { background: <?php echo zn_hex2rgba_str($zn_main_color, 70); ?> }
.kl-ioscaption--style4 .more:hover:before { background: <?php echo zn_hex2rgba_str($zn_main_color, 90); ?> }

/* plugins */
.zn-wc-pages-classic a.button,
.zn-wc-pages-classic button.button,
.zn-wc-pages-classic button.button.alt,
.zn-wc-pages-classic input.button,
.zn-wc-pages-classic input#button,
.zn-wc-pages-classic #respond input#submit,
.add_to_cart_inline .kw-actions a,
.zn-wc-pages-style2 #respond input#submit.alt,
.zn-wc-pages-style2 a.button.alt,
.zn-wc-pages-style2 button.button.alt,
.zn-wc-pages-style2 input.button.alt,
.product-list-item.prod-layout-classic .kw-actions a,
.woocommerce ul.products li.product .product-list-item.prod-layout-classic .kw-actions a,
#bbpress-forums div.bbp-search-form input[type=submit],
#bbpress-forums .bbp-submit-wrapper button,
#bbpress-forums #bbp-your-profile fieldset.submit button
{background-color:<?php echo $zn_main_color;?>;}

/* Hover Background color - Main Color */
.btn-fullcolor:hover,
.btn-fullcolor.btn-skewed:hover:before,
.cart-container .buttons .button.wc-forward:hover,
.zn-wc-pages-classic a.button:hover,
.zn-wc-pages-classic button.button:hover,
.zn-wc-pages-classic button.button.alt:hover,
.zn-wc-pages-classic input.button:hover,
.zn-wc-pages-classic input#button:hover,
.zn-wc-pages-classic #respond input#submit:hover,
.add_to_cart_inline .kw-actions a:hover,
.zn-wc-pages-style2 #respond input#submit.alt:hover,
.zn-wc-pages-style2 a.button.alt:hover,
.zn-wc-pages-style2 button.button.alt:hover,
.zn-wc-pages-style2 input.button.alt:hover
{ background-color: <?php echo adjustBrightness($zn_main_color, 20); ?> }

/**** END Background Color - Main Color ****/

/* Border - Main Color */
.border-custom,
.border-custom-after:after,
.border-custom-before:before,
.kl-blog-item-overlay-more:hover,
.acc--style4,
.acc--style4 .acc-tgg-button .acc-icon,
.kl-ioscaption--style4 .more:before,
.btn-lined.lined-custom,
.btn.btn-bordered
{ border-color: <?php echo $zn_main_color;?>;  }

/* Alpha Border color */
.fake-loading:after
{ border-color: <?php echo zn_hex2rgba_str($zn_main_color, 15); ?>;}

/* Border Top - Main Color */
.action_box:before,
.action_box:after,
.site-header.style1,
.site-header.style2 .site-logo-anch,
.site-header.style3 .site-logo-anch,
.site-header.style6,
.tabs_style1 > ul.nav > li.active > a,
.offline-page-container:after,
.latest_posts3-post-date:after,
.fake-loading:after
{ border-top-color:<?php echo $zn_main_color;?>; }

/* Border Right - Main Color */
.stepbox3-box[data-align=right] .stepbox3-content:after,
.vr-tabs-kl-style-1 .vr-tabs-nav-item.active .vr-tabs-nav-link,
.kl-ioscaption--style2.klios-alignright .title_big,
.kl-ioscaption--style2.klios-alignright .title_small,
.fake-loading:after
{ border-right-color:<?php echo $zn_main_color;?>; }

/* Border Bottom - Main Color */
.image-boxes.image-boxes--4.kl-title_style_bottom .imgboxes-border-helper,
.image-boxes.image-boxes--4.kl-title_style_bottom:hover .imgboxes-border-helper,
.kl-blog-full-image-link,
.kl-blog-post-image-link,
.site-header.style8 .site-header-bottom-wrapper,
.site-header.style9,
.spp-el-item.active .spp-el-nav-link:after,
.statistic-box__line,
.zn-sidebar-widget-title:after,
.tabs_style5 > ul.nav > li.active > a,
.offline-page-container,
.keywordbox.keywordbox-2,
.keywordbox.keywordbox-3
{border-bottom-color:<?php echo $zn_main_color;?>}

/* Border left - Main Color */
.breadcrumbs.bread-style--black li:before,
.infobox2-inner,
.kl-flex--classic .flex-caption,
.ls--laptop .ls__item-caption,
.nivo-caption,
.process_steps--style1 .process_steps__intro:after,
.stepbox3-box[data-align=left] .stepbox3-content:after,
.th-wowslider .ws-title,
.kl-ioscaption--style2 .title_big,
.kl-ioscaption--style2 .title_small
{border-left-color:<?php echo $zn_main_color;?>; }


/* Various properties - Main Color */

.kl-cta-ribbon .trisvg path,
.kl-mask .bmask-customfill,
.kl-slideshow .kl-loader svg path,
.kl-slideshow  .kl-loadersvg rect,
.kl-diagram circle { fill: <?php echo $zn_main_color;?>; }

.borderanim2-svg__shape,
.kl-blog--layout-def_modern .kl-blog-item-comments-link:hover path,
.kl-blog--layout-def_modern .kl-blog-item-more-btn:hover .svg-more-bg {stroke: <?php echo $zn_main_color;?>;}

.hoverBorder:hover:after {box-shadow:0 0 0 5px <?php echo $zn_main_color;?> inset;}

/* Services boxes (modern style) */
.services_box--modern .services_box__icon { box-shadow:inset 0 0 0 2px <?php echo $zn_main_color;?>; }
.services_box--modern:hover .services_box__icon {box-shadow:inset 0 0 0 40px <?php echo $zn_main_color;?>;}
.services_box--modern .services_box__list li:before {box-shadow: 0 0 0 2px <?php echo $zn_main_color;?>;}
.services_box--modern .services_box__list li:hover:before {box-shadow: 0 0 0 3px <?php echo $zn_main_color;?>;}

.portfolio-item-overlay-imgintro:hover .portfolio-item-overlay {box-shadow: inset 0 -8px 0 0 <?php echo $zn_main_color;?>;}


/* Contrast Color */
<?php $zn_main_color_contrast = zget_option( 'zn_main_color_contrast', 'color_options', false, '#fff' ); ?>
.main-nav.mainnav--active-bg > ul > li.active > a,
.main-nav.mainnav--active-bg > ul > li > a:hover,
.main-nav.mainnav--active-bg > ul > li:hover > a,
.chaser-main-menu li.active > a,
.kl-cart-button .glyphicon:after,
.kl-ptfsortable-nav-link:hover,
.kl-ptfsortable-nav-item.current .kl-ptfsortable-nav-link,
.circlehover,
.circle-text-box .wpk-circle-span,
.imgboxes_style1 .hoverBorder h6
{color:<?php echo $zn_main_color_contrast;?> !important;}

/* Without forced !important */
.btn-flat,
.zn-wc-pages-classic a.button,
.zn-wc-pages-classic button.button,
.zn-wc-pages-classic button.button.alt,
.zn-wc-pages-classic input.button,
.zn-wc-pages-classic input#button,
.zn-wc-pages-classic #respond input#submit,
.zn-wc-pages-style2 #respond input#submit.alt,
.zn-wc-pages-style2 a.button.alt,
.zn-wc-pages-style2 button.button.alt,
.zn-wc-pages-style2 input.button.alt,
.product-list-item.prod-layout-classic .kw-actions a,
.woocommerce ul.products li.product .product-list-item.prod-layout-classic .kw-actions a
{color:<?php echo $zn_main_color_contrast;?> !important;}

/* Contrast color without important flag */
.latest-posts-crs-readon,
.latest_posts--4.default-style .latest_posts-readon,
.latest_posts--4.kl-style-2 .latest_posts-elm-title,
.latest_posts3-post-date,
.action_box-text,
.recentwork_carousel__link:hover .recentwork_carousel__crsl-title,
.recentwork_carousel__link:hover .recentwork_carousel__cat,
.stepbox2-box--ok:before,
.stepbox2-box--ok:after,
.stepbox2-box--ok,
.stepbox2-box--ok .stepbox2-title,
.kl-ioscaption--style4 .more,
.image-boxes.image-boxes--1 .image-boxes-readon,
.acc--style3 .acc-tgg-button:not(.collapsed):before
{color:<?php echo $zn_main_color_contrast;?>;}


/* Plugin based */
#bbpress-forums .bbp-topics li.bbp-body .bbp-topic-title > a,
.product-list-item.prod-layout-classic:hover .kw-details-title,
.woocommerce ul.products li.product .product-list-item.prod-layout-classic:hover .kw-details-title,
.woocommerce ul.product_list_widget li .star-rating,
.woocommerce .prodpage-classic .woocommerce-product-rating .star-rating,
.widget.buddypress div.item-options a.selected ,
#buddypress div.item-list-tabs ul li.selected a,
#buddypress div.item-list-tabs ul li.current a ,
#buddypress div.activity-meta a ,
#buddypress div.activity-meta a:hover,
#buddypress .acomment-options a
{color:<?php echo $zn_main_color; ?>;}

#buddypress form#whats-new-form p.activity-greeting:after {border-top-color: <?php echo $zn_main_color;?>;}
#buddypress input[type=submit],
#buddypress input[type=button],
#buddypress input[type=reset],
#buddypress .activity-list li.load-more a {background: <?php echo $zn_main_color;?>;}
#buddypress div.item-list-tabs ul li.selected a,
#buddypress div.item-list-tabs ul li.current a {border-top: 2px solid <?php echo $zn_main_color;?>;}
#buddypress form#whats-new-form p.activity-greeting,
.widget.buddypress ul.item-list li:hover {background-color: <?php echo $zn_main_color;?>;}

/***** End Main Color */

/* Call to action header */
<?php $cta_bg = zget_option( 'wpk_cs_bg_color', 'general_options', false, $zn_main_color ); ?>
.kl-cta-ribbon { background-color: <?php echo $cta_bg; ?> }
.kl-cta-ribbon .trisvg path { fill: <?php echo $cta_bg; ?> }
.ctabutton { color: <?php echo zget_option( 'wpk_cs_fg_color', 'general_options', false, '#fff' ); ?> }

<?php
// Custom CTA button in header.
$calltoaction_style = zget_option( 'head_show_cta_style', 'general_options', false, 'ribbon' );

if($calltoaction_style == 'custom'){
    $btn_custom = zget_option( 'cta_custom', 'general_options', false, false );

    if( isset($btn_custom) && !empty($btn_custom) ):
        foreach($btn_custom as $i => $btn):

        	$button_style = $btn['cta_style'];
			$button_selector = '.btn-custom-color.cta-button-'.$i;
			$button_simple_selector = '.kl-cta-custom.cta-button-'.$i;

			$button_color = isset($btn['cta_custom_color']) && !empty($btn['cta_custom_color']) ? $btn['cta_custom_color'] : '';
			$button_color_hover = isset($btn['cta_custom_color_hov']) && !empty($btn['cta_custom_color_hov']) ? $btn['cta_custom_color_hov'] : adjustBrightness($button_color, 20);

			// Button Fullcolor
			if($button_style == 'btn-fullcolor btn-custom-color' && $button_color ){
				echo $button_selector.'{background-color:'.$button_color.'}';
				echo $button_selector.':hover{background-color:'.$button_color_hover.'}';
			}
			// Button lined
			elseif($button_style == 'btn-lined btn-custom-color' && $button_color ){
				echo $button_selector.'{color:'.$button_color.'; border-color:'.$button_color.';}';
				echo $button_selector.':hover{color:'.$button_color_hover.'; border-color:'.$button_color_hover.';}';
			}
			// Button Skewed
			elseif($button_style == 'btn-fullcolor btn-skewed btn-custom-color' && $button_color ){
				echo $button_selector.':before{background-color:'.$button_color.'}';
				echo $button_selector.':hover:before{background-color:'.$button_color_hover.';}';
			}

			$btn_font_styles = '';
			if( isset($btn['button_typo']) && !empty($btn['button_typo']) ){
				foreach ($btn['button_typo'] as $key => $value) {
					if($value != '') {
						$btn_font_styles .= $key.':'. $value.';';
					}
				}
				if(!empty($btn_font_styles)){
					echo $button_simple_selector.'{'.$btn_font_styles.'}';
				}
			}

    	endforeach;
    endif;

}

?>

/* Infocard */
.logo-container .logo-infocard {background: <?php echo zget_option( 'infocard_bg_color', 'general_options', false, $zn_main_color ); ?>}
.logo-infocard, .logo-infocard a,
.logo-infocard .social-icons-item,
.logo-infocard .glyphicon {color:<?php echo zget_option( 'infocard_text_color', 'general_options', false, '#FFFFFF' ); ?>}


/* Hidden panel */
.support-panel {background: <?php echo zget_option( 'hidden_panel_bg', 'general_options', false, '#fff' ); ?>; }
.support-panel,
.support-panel * {color:<?php echo zget_option( 'hidden_panel_fg', 'general_options', false, '#000000' ); ?>;}

/* Custom blog post image width */
<?php
if( $zn_bpost_img = zget_option( 'sb_bp_def_cwidth', 'blog_options', false, '' ) ){
	echo '.zn-bg-post--default-view {max-width:'.(int)$zn_bpost_img.'px;}';
}
?>

/* Custom background color for header */
<?php
    if( zget_option( 'header_style', 'general_options', false, 'default' ) == 'image_color'):

    	$header_style_color = zget_option( 'header_style_color', 'general_options', false, '#000' );

    	$custom_siteheader_selector = '';
    	if('rgba(0,0,0,0)' == $header_style_color && 'sticky' == zn_get_layout_option( 'menu_follow', 'general_options', false, 'no' )) {
    		$custom_siteheader_selector = '.header--not-sticked ';
    	}

        $header_style_bg_image = 'background-image:none;';
        $header_style_image = zget_option( 'header_style_image', 'general_options', false, array() );
        if( !empty( $header_style_image['image'] ) ){
            $header_style_bg_image .= 'background-image:url("'.$header_style_image['image'].'");';
        }
        if(isset( $header_style_image['repeat']) && !empty( $header_style_image['repeat'])){
            $header_style_bg_image .= 'background-repeat:'.$header_style_image['repeat'].';';
        }
        if(isset( $header_style_image['position']) && !empty( $header_style_image['position'])){
            $header_style_bg_image .= 'background-position:'.$header_style_image['position']['x'].' '. $header_style_image['position']['y'].';';
        }
        if(isset( $header_style_image['attachment']) && !empty( $header_style_image['attachment'])){
            $header_style_bg_image .= 'background-attachment:'. $header_style_image['attachment'].';';
        }
    ?>

@media (min-width:768px){
	<?php echo $custom_siteheader_selector; ?>.site-header {background-color:<?php echo $header_style_color; ?>; <?php echo $header_style_bg_image; ?> }
}
<?php
$kl_top_header_color = $header_style_color;
$kl_main_header_color = $header_style_color;
if(strpos($header_style_color, 'rgba') === false ){
	$kl_top_header_color = zn_hex2rgba_str($header_style_color, 70);
	$kl_main_header_color = zn_hex2rgba_str($header_style_color, 60);
} ?>
	.site-header.style8 .site-header-main-wrapper {background:<?php echo $kl_top_header_color; ?>;}
	.site-header.style8 .site-header-bottom-wrapper {background:<?php echo $kl_main_header_color; ?>;}

<?php
    endif;
?>

<?php
	// TOP Bar Header BG Color
    if( zget_option( 'topbar_style', 'general_options', false, 'default' ) == 'custom'){
    	$topbar_bg_color = zget_option( 'topbar_bg_color', 'general_options', false, '' );
    	if( $topbar_bg_color != '' ){
    		echo '.site-header .site-header-top-wrapper {background-color:'.$topbar_bg_color.'; }';
    		echo '.topbar-style--custom .site-header-separator {display:none;}';

    	}
    }
?>

<?php

/* Social Header */
if ( zget_option( 'social_icons_visibility_status', 'general_options', false, 'yes' ) == 'yes' ) {
	$header_which_icons_set = zget_option( 'header_which_icons_set', 'general_options', false, 'normal' );
	if($header_which_icons_set != 'normal' && $header_which_icons_set != 'clean'){
		if ( $header_social_icons = zget_option( 'header_social_icons', 'general_options', false, array() ) ) {
			foreach ( $header_social_icons as $key => $icon ):
				$hhover = $header_which_icons_set == 'colored_hov' ? ':hover':'';
				if(isset($icon['header_social_color']) && !empty($icon['header_social_color'])){
					echo '.scheader-icon-'.$icon['header_social_icon']['unicode'].$hhover.' { background-color: '.$icon['header_social_color'].'; }';
				}
			endforeach;
		}
	}
}

/* Social Footer */
if ( zget_option( 'footer_social_icons_enable', 'general_options', false, 'yes' ) == 'yes' ) {
	$footer_which_icons_set = zget_option( 'footer_which_icons_set', 'general_options', false, 'normal' );
	if($footer_which_icons_set != 'normal' && $footer_which_icons_set != 'clean'){
		if ( $footer_social_icons = zget_option( 'footer_social_icons', 'general_options', false, array() ) ) {
			foreach ( $footer_social_icons as $key => $icon ):
				$fhover = $footer_which_icons_set == 'colored_hov' ? ':hover':'';
				if(isset($icon['footer_social_color']) && !empty($icon['footer_social_color'])){
					echo '.scfooter-icon-'.$icon['footer_social_icon']['unicode'].$fhover.' { background-color: '.$icon['footer_social_color'].'; }';
				}
			endforeach;
		}
	}
}

/* Social icons in Coming Soon page */
if ( zget_option( 'cs_social_icons_enable', 'coming_soon_options', false, 'yes' ) == 'yes' && zget_option( 'cs_enable', 'coming_soon_options', false, 'no' ) == 'yes' ) {
	$cs_which_icons_set = zget_option( 'cs_which_icons_set', 'coming_soon_options', false, 'normal' );
	if($cs_which_icons_set != 'normal' && $cs_which_icons_set != 'clean'){
		if ( $cs_social_icons = zget_option( 'cs_social_icons', 'coming_soon_options', false, array() ) ) {
			foreach ( $cs_social_icons as $key => $icon ):
				$chover = $cs_which_icons_set == 'colored_hov' ? ':hover':'';
				if(isset($icon['cs_social_color']) && !empty($icon['cs_social_color'])){
					echo '.sccsoon-icon-'.$icon['cs_social_icon']['unicode'].$chover.' { background-color: '.$icon['cs_social_color'].'; }';
				}
			endforeach;
		}
	}
}

?>

.site-footer {
	<?php
	$footer_top_padding = zget_option( 'footer_top_padding', 'general_options', false, '60' );
	if ( $footer_top_padding != '' && $footer_top_padding != 60 ) {
			echo 'padding-top:'. $footer_top_padding .'px;';
	}

	if ( $footer_border_color_top = zget_option( 'footer_border_color_top', 'general_options', false, '#FFFFFF' ) ) {
	echo 'border-top-color:'. $footer_border_color_top .';'; }

	// Footer Styles
	$footer_style = zget_option( 'footer_style', 'general_options', false, 'default' );

	if( $footer_style == 'image_color' ){

		// Color
		$footer_style_color = zget_option( 'footer_style_color', 'general_options', false, '#000' );
		if ( !empty( $footer_style_color ) ){
			echo 'background-color:'.$footer_style_color.';';
		}

		// Image
		$footer_style_image = zget_option( 'footer_style_image', 'general_options', false, array() );

		if( !empty( $footer_style_image['image'] ) ) { echo 'background-image:url("'.$footer_style_image['image'].'");'; }
		if( !empty( $footer_style_image['repeat'] ) ) { echo 'background-repeat:'.$footer_style_image['repeat'].';'; }
		if( !empty( $footer_style_image['position'] ) ) { echo 'background-position:'.$footer_style_image['position']['x'].' '.$footer_style_image['position']['y'].';'; }
		if( !empty( $footer_style_image['attachment'] ) ) { echo 'background-attachment:'.$footer_style_image['attachment'].';'; }

	} ?>
}
.site-footer-bottom { <?php if ( $footer_border_color = zget_option( 'footer_border_color', 'general_options', false, '#484848' ) ) {
	echo 'border-top-color:'. $footer_border_color .';'; } ?>
}

/* Main menu font */
<?php

$menu_font = zget_option( 'menu_font', 'general_options', false, array() );
$menu_font_active = zget_option( 'menu_font_active', 'general_options', false, $zn_main_color );
$menu_font_sub = zget_option( 'menu_font_sub', 'general_options', false, array() );

if(!empty($menu_font)){
	$mf_color='';
	$mf_fsize='';
	$mf_others='';
	foreach ($menu_font as $key => $value) {
		if($key == 'color'){
			$mf_color = $value;
		}
		elseif($key == 'font-size'){
			$mf_fsize = $value;
		}
		elseif($key == 'font-family'){
			$mf_others .= 'font-family:'.zn_convert_font($value).';';
		}
		else {
			$mf_others .= $key .':'. $value.';';
		}
	}
	echo '.main-nav > ul > li > a {'.$mf_others.'}';
	// Font-size
	echo '.main-nav > ul > li > a {font-size:'.$mf_fsize.';}';
	echo '.main-nav.mainnav--active-bg > ul > li > a:before {height:'.$mf_fsize.';}';
	echo '.main-nav.mainnav--active-bg > ul > li.active > a:before, .main-nav.mainnav--active-bg > ul > li > a:hover:before, .main-nav.mainnav--active-bg > ul > li:hover > a:before {height:calc('.$mf_fsize.' + 16px)}';
	echo '.mainnav--pointer-dash.main-nav > ul > li.menu-item-has-children > a:after {bottom: calc(52% - '.($mf_fsize-2).'px);}';
	// Color
	if(!empty($mf_color)){
		echo '.site-header .site-header-row .main-nav > ul > li > a {color:'.$mf_color.'}';
	}
}
if(!empty($menu_font_active)){
	echo '.site-header .main-nav.mainnav--active-text > ul > li.active > a, .site-header .main-nav.mainnav--active-text > ul > li > a:hover, .site-header .main-nav.mainnav--active-text > ul > li:hover > a {color:'.$menu_font_active.';}';
	echo '.main-nav.mainnav--active-bg > ul > li.active > a:before, .main-nav.mainnav--active-bg > ul > li > a:hover:before, .main-nav.mainnav--active-bg > ul > li:hover > a:before {background-color:'.$menu_font_active.';}';
}
if(!empty($menu_font_sub)){
	echo '.main-nav ul ul.sub-menu li a, .main-nav .zn_mega_container li a {';
		foreach ($menu_font_sub as $key => $value) {
			if(!empty($value)){
				if($key == 'font-size'){
					$fsv = $value;
					echo $key .':'. $fsv.';';
				}
				else {
					echo $key .':'. $value.';';
				}
			}
		}
	echo '}';
	echo '.main-nav .zn_mega_container li a.zn_mega_title, .main-nav div.zn_mega_container ul li:last-child > a.zn_mega_title{font-size:'.($fsv+2).'px}';
}
?>

/* Alternative font - Several elements using other font */
.ff-alternative,
.kl-font-alt,
.kl-fontafter-alt:after,
/* Page Title and Subtitle */
<?php
	$h1_pgtitle = zget_option( 'h1_pgtitle', 'font_options', false, '' );
	if( $h1_pgtitle != '1' ) echo '.page-title, .page-subtitle, .subtitle,';
?>
.topnav-item,
.topnav .menu-item > a,
.zn-sidebar-widget-title,
/* JS Generated */
.nivo-caption,
.th-wowslider .ws-title,
/* WooCommerce un-classed content */
.cart-container .cart_list li a:not(.remove) {
<?php
	$alternative_font = zget_option( 'alternative_font', 'font_options', false, $menu_font );
	if ( !empty ( $alternative_font['font-family'] ) ) {
		echo 'font-family:' .zn_convert_font($alternative_font['font-family']).';';
	}
 ?>
}

/* Header Custom Font */
<?php if( zget_option( 'topbar_style', 'general_options', false, 'default' ) == 'custom'): ?>
	.site-header-top-wrapper .kl-font-alt,
	.site-header-top-wrapper .kl-fontafter-alt:after,
	.site-header-top-wrapper .topnav-item,
	.site-header-top-wrapper .topnav .menu-item > a,
	.site-header-top-wrapper .cart-container .cart_list li a:not(.remove) {
	<?php
		$topbar_font = zget_option( 'topbar_font', 'general_options', false, array() );
		foreach ($topbar_font as $key => $value) {
			if(!empty($value)) {
				if( $key == 'font-family' ){
					echo $key .':'. zn_convert_font($value).';';
				} else {
					echo $key .':'. $value.';';
				}
			}
		}
	?>
	}
<?php endif; ?>

/* Add Custom fonts classes */
<?php
if ( $google_fonts = zget_option('zn_google_fonts_setup', 'google_font_options') ){
	foreach ( $google_fonts as $key => $font ) {
		if(isset($font['font_family']) && !empty($font['font_family'])){
			echo '.ff-'.strtolower(str_replace(' ', '_', $font['font_family'])).'{font-family:"'.$font['font_family'].'", "Helvetica Neue", Helvetica, Arial, sans-serif;}';
		}

	}
}
?>

<?php
if ( zget_option( 'zn_boxed_layout', 'layout_options', false, 'no' ) == 'yes') {
	?>
	body {

		<?php
		// Color
		$boxed_style_color = zget_option( 'boxed_style_color', 'layout_options', false, '#fff' );
		if ( !empty( $boxed_style_color ) ){
			echo 'background-color:'.$boxed_style_color.';';
		}

		// Image
		$boxed_style_image = zget_option( 'boxed_style_image', 'layout_options', false, array() );

		if( !empty( $boxed_style_image['image'] ) ) { echo 'background-image:url("'.$boxed_style_image['image'].'");'; }
		if( !empty( $boxed_style_image['repeat'] ) ) { echo 'background-repeat:'.$boxed_style_image['repeat'].';'; }
		if( !empty( $boxed_style_image['position'] ) ) { echo 'background-position:'.$boxed_style_image['position']['x'].' '.$boxed_style_image['position']['y'].';'; }
		if( !empty( $boxed_style_image['attachment'] ) ) { echo 'background-attachment:'.$boxed_style_image['attachment'].';'; }
		?>
	}
	<?php
}

// Top Navigation Colors
if( $zn_top_nav_color = zget_option( 'zn_top_nav_color', 'color_options' ) ){
	echo '.site-header[class*="sh-"] .topnav .topnav-item,
	.site-header[class*="sh-"] .topnav.social-icons .topnav-item,
	.site-header[class*="sh-"] .topnav .menu-item>a,
	.site-header[class*="sh-"] .topnav .topnav-li .glyphicon,
	.site-header[class*="sh-"] .kl-header-toptext,
	.site-header[class*="sh-"] .kl-header-toptext a { color:'.$zn_top_nav_color.' ;}';
}
if ( $zn_top_nav_h_color = zget_option( 'zn_top_nav_h_color', 'color_options' ) ) {
	echo '.site-header[class*="sh-"] .topnav .topnav-item:hover,
	.site-header[class*="sh-"] .topnav.social-icons .topnav-item:hover,
	.site-header[class*="sh-"] .topnav .menu-item>a:hover,
	.site-header[class*="sh-"] .kl-header-toptext a:hover { color:'.$zn_top_nav_h_color.' ;}';
}

// Various usages of the body color
if ( isset($zn_body_def_color) && !empty($zn_body_def_color) ) {
	// Static content fade mask
	echo '.sc__fade-mask, .portfolio-item-desc-inner:after { background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,'.zn_hex2rgba_str($zn_body_def_color, 0).'), color-stop(100%, '.$zn_body_def_color.')); background: -webkit-linear-gradient(top, '.zn_hex2rgba_str($zn_body_def_color, 0).' 0%, '.$zn_body_def_color.' 100%); background: linear-gradient(to bottom, '.zn_hex2rgba_str($zn_body_def_color, 0).' 0%, '.$zn_body_def_color.' 100%); }
	 ';
	// Laptop Slider Mask
	echo '.ls-source__mask-front {background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,'.zn_hex2rgba_str($zn_body_def_color, 60).'), color-stop(50%, '.$zn_body_def_color.')); background: -webkit-linear-gradient(top,  '.zn_hex2rgba_str($zn_body_def_color, 60).' 0%, '.$zn_body_def_color.' 50%); background: linear-gradient(to bottom,  '.zn_hex2rgba_str($zn_body_def_color, 60).' 0%, '.$zn_body_def_color.' 50%);}';
}

// Header background & text color for smaller than 480px devices

if($zn_header_resp_color = zget_option( 'zn_header_resp_color', 'general_options',  false, '' )){
	echo '@media (max-width: 767px) {';
	echo '.site-header {background-color: '.$zn_header_resp_color.' !important;}';
	echo '}';
}

// Hide specific header components on mobile
$header_components_mobile = zget_option( 'header_components_mobile', 'general_options',  false, array() );
if(!empty($header_components_mobile)){
	// $last_key = end(array_keys($header_components_mobile));
	$last_key = array_search(end($header_components_mobile), $header_components_mobile);
	echo '@media (max-width: 767px) {';
		foreach ($header_components_mobile as $i => $comp) {
			echo '.site-header .'. $comp . ( $i != $last_key ? ',':'' );
		}
		echo '{display: none !important;}';
	echo '}';
}

if( zget_option( 'page_preloader' , 'general_options', false, 'no' ) != 'no' ){
	echo '#page-loading{ background-color:'. zget_option( 'page_preloader_bg' , 'general_options', false, '#ffffff' ) .' }';
}

