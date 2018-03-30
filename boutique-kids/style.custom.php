<?php if ( $tags ) {  ?>
<!-- start customisable css rules -->
<style type="text/css">
<?php }

function dtbaker_hex2rgb( $hex ) {
	$hex = str_replace( '#', '', $hex );

	if ( strlen( $hex ) == 3 ) {
		$r = hexdec( substr( $hex,0,1 ).substr( $hex,0,1 ) );
		$g = hexdec( substr( $hex,1,1 ).substr( $hex,1,1 ) );
		$b = hexdec( substr( $hex,2,1 ).substr( $hex,2,1 ) );
	} else {
		$r = hexdec( substr( $hex,0,2 ) );
		$g = hexdec( substr( $hex,2,2 ) );
		$b = hexdec( substr( $hex,4,2 ) );
	}
	$rgb = array( $r, $g, $b );
	//return implode(",", $rgb); // returns the rgb values separated by commas
	return $rgb; // returns an array with the rgb values
}

?>

.wp-caption-text,
a,a:link,a:visited,
.blog_links,
.dtbaker_pagination,
.woocommerce-result-count{
    color:#<?php echo trim( $boutique_theme_settings['font_color_link_color'] );?>;
}
#menu_wrap #menu_container > div > ul li.current_page_parent > a,
#menu_wrap #menu_container > div > ul li.current_page_ancestor > a,
#menu_wrap #menu_container > div > ul li.current-menu-item > a,
#menu_wrap #menu_container > div > ul li.current_page_item > a{
	color:#<?php echo trim( $boutique_theme_settings['font_color_highlight_color'] );?>;
}


#logo a,
h1,h2{
	text-shadow: 2px 2px rgba(<?php
	$rgb = dtbaker_hex2rgb($boutique_theme_settings['font_color_link_color']);
	echo (int)$rgb[0].','.$rgb[1].','.$rgb[2].',0.3'; ?>);
}

<?php
if ( ! empty( $blog_line[0]['primary'] ) ) {  ?>
div.blog .blog_content_wrap .blog_date{
    background: <?php echo $blog_line[0]['primary'];?>;
}
div.blog .blog_content_wrap .blog_date:before{
    border-color: <?php echo $blog_line[0]['lighter1'];?> #FFF;
}
<?php } ?>

.blog_footer,
div.blog_footer li a, div.blog_footer li a:link, div.blog_footer li a:visited{
    color: #<?php echo trim( $boutique_theme_settings['font_color_link_color'] );?>;
}


.gallery-dtbaker-pretty .gallery-icon-inner{
<?php if($boutique_theme_settings['gallery_background_image']){ ?>
	background-image: url(<?php echo trim($boutique_theme_settings['gallery_background_image']);?>);
	background-repeat: repeat;
<?php } ?>
}


.commentlist div.comment{
	border: 1px solid #<?php echo trim($boutique_theme_settings['color_comment_border']);?>;
}
#respond input[type="text"],
#respond textarea,
.wpcf7 input,
.wpcf7 textarea{
	background: #<?php echo trim($boutique_theme_settings['color_background_forms']);?>;
	color:#4a4438;
}



/* sidebar width */

.sidebar .widget{
    width: <?php echo trim( $boutique_theme_settings['sidebar_width'] ); ?>px;
}
#column_wrapper .content_main.with-left-sidebar{
    left: <?php echo trim( $boutique_theme_settings['sidebar_width'] + 30 );?>px;
}
.rtl #column_wrapper .content_main.with-left-sidebar{
    right: <?php echo trim( $boutique_theme_settings['sidebar_width'] + 30 );?>px;
	left:auto;
}
#column_wrapper .content_main.with-right-sidebar{
    margin-left: -<?php echo trim( $boutique_theme_settings['sidebar_width'] + 30 );?>px;
}
.rtl #column_wrapper .content_main.with-right-sidebar{
    margin-right: -<?php echo trim( $boutique_theme_settings['sidebar_width'] + 30 );?>px;
	margin-left: 0;
}
#column_wrapper .content_main.with-left-sidebar .content_main_wrap{
    right: <?php echo trim( $boutique_theme_settings['sidebar_width'] + 30 );?>px;
}
.rtl #column_wrapper .content_main.with-left-sidebar .content_main_wrap{
    left: <?php echo trim( $boutique_theme_settings['sidebar_width'] + 30 );?>px;
	right:auto;
}
#column_wrapper .content_main_data{
    margin-left: <?php echo trim( $boutique_theme_settings['sidebar_width'] + 30 );?>px; /* increase gap between sidebar and content */
}
.rtl #column_wrapper .content_main_data{
    margin-right: <?php echo trim( $boutique_theme_settings['sidebar_width'] + 30 );?>px; /* increase gap between sidebar and content */
}
#column_wrapper .sidebar{
    width: <?php echo trim( $boutique_theme_settings['sidebar_width'] );?>px;
    right: <?php echo trim( $boutique_theme_settings['sidebar_width'] + 30 );?>px; /* increase to get sidebar closer to left wall */
}
.rtl #column_wrapper .sidebar{
    left: <?php echo trim( $boutique_theme_settings['sidebar_width'] + 30 );?>px; /* increase to get sidebar closer to left wall */
	right: auto;
}
#column_wrapper .content_main.with-right-sidebar .sidebar{
    left: <?php echo trim( $boutique_theme_settings['sidebar_width'] + 30 );?>px; /* increase to get sidebar closer to left wall */
}
.rtl #column_wrapper .content_main.with-right-sidebar .sidebar{
    right: <?php echo trim( $boutique_theme_settings['sidebar_width'] + 30 );?>px; /* increase to get sidebar closer to left wall */
	left: auto;
}

<?php

if ( class_exists( 'EGF_Register_Options' ) && is_callable( 'EGF_Register_Options::get_options' ) ) {

	$font_options = EGF_Register_Options::get_options();
	$font_options = apply_filters( 'boutique_font_options',$font_options );

	// match widget link colors to the widget content font
	// grab the font options from easy google fonts and calculate a lighter/darker color for the drop shadow

	// grab the font options from easy google fonts and calculate a lighter/darker color for the drop shadow
	if ( ! empty( $font_options['boutique_buttons']['font_name'] ) ) {
	    ?>
		button,
		.em-tickets tr td,
		.em-booking-form-details label,
		.em-booking-login label,
		.em_event_wrapper .event_details ul li,
		.em_event_wrapper .location_details,
		.rtb-booking-form label,
		table.events-table thead tr th,
		div.blog .blog_summary_wrap .blog_date,
		.dtbaker_cafe_menu_buttons .menu_button a,
		.dtbaker_icon .icon_title,
		div.share-post .title,
		.div.blog .blog_date,
		#nav-single a,
		.slickslider-caption,
		.dtbaker-menu-widget-go,
		.sbHolder,
		.wpcf7 .wpcf7-submit,
		.wpcf7-form,
		.dtbaker_line_rectangle{
			font-family: '<?php echo esc_js( $font_options['boutique_buttons']['font_name'] );?>';
		}
	<?php
	}

	// grab the logo circle color from the border property of the logo font option
	if ( ! empty( $font_options['boutique_widgets']['border_left_color'] ) ) { ?>
	.widget.widget_boutique ul li:before{
		background: <?php echo $font_options['boutique_widgets']['border_left_color'];?>;
	}
	<?php }

	if ( ! empty( $font_options['tt_default_heading_2']['font_name'] ) ) { ?>
	.dtbaker-pretty-title{
		font-family: '<?php echo esc_js( $font_options['tt_default_heading_2']['font_name'] );?>';
		font-size: <?php echo (int)$font_options['tt_default_heading_2']['font_size']['amount'];?>px;
	}
	<?php }
}
/*
if ( get_theme_mod( 'menu_fade_in',1 ) ) {  ?>

#menu_container{
	opacity: 0;
}

<?php }*/

if(!get_theme_mod('header_menu_buttons',0)){
?>
#menu_buttons{
	display: none;
}
<?php
}
if ( get_theme_mod( 'responsive_enabled',1 ) ) {  ?>

<?php }

if ( get_theme_mod( 'full_width_fluid',0 ) ) {  ?>
 /* make #wrapper 100% width */
#wrapper{
	max-width:100%;
}
<?php }
?>

<?php if ( $tags ) {  ?>
</style>
<!-- end customisable css rules -->
<?php } ?>
