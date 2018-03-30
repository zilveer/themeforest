<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php
global $edgt_options;
global $edgtIconCollections;
global $wp_query;
?>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<?php
	if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false))
		echo('<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">');

	$responsiveness = "yes";
	if (isset($edgt_options['responsiveness'])) $responsiveness = $edgt_options['responsiveness'];
	if($responsiveness != "no"){
		?>
		<meta name=viewport content="width=device-width,initial-scale=1,user-scalable=no">
	<?php
	}else{
		?>
		<meta name=viewport content="width=1200,user-scalable=no">
	<?php } ?>

    <?php edgt_wp_title(); ?>

	<?php do_action('edgt_header_meta'); ?>
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_url($edgt_options['favicon_image']); ?>">
	<link rel="apple-touch-icon" href="<?php echo esc_url($edgt_options['favicon_image']); ?>"/>
	<!--[if gte IE 9]>
	<style type="text/css">
		.gradient {
			filter: none;
		}
	</style>
	<![endif]-->

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php
$loading_animation = true;
if (isset($edgt_options['loading_animation'])){ if($edgt_options['loading_animation'] == "off") { $loading_animation = false; }};

if (isset($edgt_options['loading_image']) && $edgt_options['loading_image'] != ""){ $loading_image = $edgt_options['loading_image'];}else{ $loading_image =  ""; }
?>
<?php if($loading_animation){ ?>
	<div class="ajax_loader"><div class="ajax_loader_1"><?php if($loading_image != ""){ ?><div class="ajax_loader_2"><img src="<?php echo esc_url($loading_image); ?>" alt="" /></div><?php } else{ edgt_loading_spinners(); } ?></div></div>
<?php } ?>
<?php
$enable_side_area = "yes";
if (isset($edgt_options['enable_side_area'])){ if($edgt_options['enable_side_area'] == "no") { $enable_side_area = "no"; }};

$enable_popup_menu = "no";
if (isset($edgt_options['enable_popup_menu'])){
	if($edgt_options['enable_popup_menu'] == "yes" && has_nav_menu('popup-navigation')) {
		$enable_popup_menu = "yes";
	}
	$popup_menu_animation_style = '';
	if (isset($edgt_options['popup_menu_animation_style']) && !empty($edgt_options['popup_menu_animation_style'])) {
		$popup_menu_animation_style = $edgt_options['popup_menu_animation_style'];
	}
};

$enable_fullscreen_search="no";
if(isset($edgt_options['enable_search']) && $edgt_options['enable_search'] == "yes" && isset($edgt_options['search_type']) && $edgt_options['search_type'] == "fullscreen_search" ){ 
	$enable_fullscreen_search="yes";
}


$enable_vertical_menu = false;
if(isset($edgt_options['vertical_area']) && $edgt_options['vertical_area'] =='yes' && isset($edgt_options['paspartu']) && $edgt_options['paspartu'] == 'no'){
	$enable_vertical_menu = true;
}

$header_button_size = '';
if(isset($edgt_options['header_buttons_size'])){
	$header_button_size = $edgt_options['header_buttons_size'];
}
?>
<?php if($enable_side_area == "yes" && $enable_popup_menu == 'no' && !$enable_vertical_menu) { ?>
	<section class="side_menu right">
		<?php if(isset($edgt_options['side_area_title']) && $edgt_options['side_area_title'] != "") { ?>
			<div class="side_menu_title">
				<h5><?php echo esc_html($edgt_options['side_area_title']) ?></h5>
			</div>
		<?php } ?>
		<div class="close_side_menu_holder"><div class="close_side_menu_holder_inner"><a href="#" target="_self" class="close_side_menu"><span aria-hidden="true" class="icon_close"></span></a></div></div>
		<?php dynamic_sidebar('sidearea'); ?>
	</section>
<?php } ?>
<div class="wrapper">
<div class="wrapper_inner">
<?php

$paspartu_header_alignment = false;
if(isset($edgt_options['paspartu_header_alignment']) && $edgt_options['paspartu_header_alignment'] == 'yes' && isset($edgt_options['paspartu']) && $edgt_options['paspartu'] == 'yes'){$paspartu_header_alignment = true;}

$header_in_grid = true;
$header_bottom_class = ' header_in_grid';
if(isset($edgt_options['header_in_grid'])){
    if ($edgt_options['header_in_grid'] == "no"){ $header_in_grid = false; }
    if ($paspartu_header_alignment) { $header_in_grid = false; }
	if($edgt_options['header_in_grid'] == "yes"){
		$header_bottom_class = ' header_in_grid';
	}else{
		$header_bottom_class = ' header_full_width';
	}
}

$menu_item_icon_position = "";
if(isset($edgt_options['menu_item_icon_position'])){$menu_item_icon_position = $edgt_options['menu_item_icon_position']; }

$menu_position = "";
if(isset($edgt_options['menu_position'])){$menu_position = $edgt_options['menu_position']; }

$centered_logo = false;
if (isset($edgt_options['center_logo_image'])){ if($edgt_options['center_logo_image'] == "yes" && $edgt_options['header_bottom_appearance'] !== "stick_with_left_right_menu") { $centered_logo = true; }};

$enable_border_top_bottom_menu = false;
if (isset($edgt_options['enable_border_top_bottom_menu'])){ if($edgt_options['enable_border_top_bottom_menu'] == "yes") { $enable_border_top_bottom_menu = true; }};

if(isset($edgt_options['header_bottom_appearance']) && $edgt_options['header_bottom_appearance'] == "fixed_hiding"){
    $centered_logo = true;
}

$menu_dropdown_appearance_class = "";
if(isset($edgt_options['menu_dropdown_appearance']) && $edgt_options['menu_dropdown_appearance'] != "default"){
    $menu_dropdown_appearance_class = $edgt_options['menu_dropdown_appearance'];
}

//check if header is sticky divided and set width of logo wrapper
$logo_wrapper_style = "";
$divided_left_menu_padding = "";
$divided_right_menu_padding = "";
if(isset($edgt_options['header_bottom_appearance']) && $edgt_options['header_bottom_appearance'] == "stick_with_left_right_menu"){
    $logo_wrapper_style = 'width:'.(esc_attr($edgt_options['logo_width'])/2).'px;';
    $divided_left_menu_padding = 'padding-right:'.(esc_attr($edgt_options['logo_width'])/4).'px;';
    $divided_right_menu_padding = 'padding-left:'.(esc_attr($edgt_options['logo_width'])/4).'px;';
}
if($edgt_options['center_logo_image'] == "yes" && $edgt_options['header_bottom_appearance'] == "regular"){
	$logo_wrapper_style = 'height:'.(esc_attr($edgt_options['logo_height'])/2).'px;';
}

if(isset($edgt_options['header_bottom_appearance']) && $edgt_options['header_bottom_appearance'] == "fixed_top_header"){
	$logo_wrapper_style = 'height:'.(esc_attr($edgt_options['logo_height'])/2).'px;';
}


$display_header_top = "yes";
if(isset($edgt_options['header_top_area'])){
	$display_header_top = $edgt_options['header_top_area'];
}
if (!empty($_SESSION['edgt_vigor_header_top'])){
	$display_header_top = $_SESSION['edgt_vigor_header_top'];
}
$header_top_area_scroll = "no";
if(isset($edgt_options['header_top_area_scroll'])){
	$header_top_area_scroll = $edgt_options['header_top_area_scroll'];
}

global $wp_query;
$id = $wp_query->get_queried_object_id();

$is_woocommerce=false;
if(function_exists("is_woocommerce")) {
	$is_woocommerce = is_woocommerce();
	if($is_woocommerce){
		$id = get_option('woocommerce_shop_page_id');
	}
}
$header_style = "";
if(get_post_meta($id, "edgt_header-style", true) != ""){
	$header_style = get_post_meta($id, "edgt_header-style", true);
}else if(isset($edgt_options['header_style'])){
	$header_style = $edgt_options['header_style'];
}

$header_color_transparency_per_page = "";
if($edgt_options['header_background_transparency_initial'] != "") {
	$header_color_transparency_per_page = esc_attr($edgt_options['header_background_transparency_initial']);
}
if(get_post_meta($id, "edgt_header_color_transparency_per_page", true) != ""){
	$header_color_transparency_per_page = esc_attr(get_post_meta($id, "edgt_header_color_transparency_per_page", true));
}

$header_color_per_page = "";
if(get_post_meta($id, "edgt_header_color_per_page", true) != ""){
	if($header_color_transparency_per_page != ""){
		$header_background_color = edgt_hex2rgb(esc_attr(get_post_meta($id, "edgt_header_color_per_page", true)));
		$header_color_per_page .= "background-color:rgba(" . $header_background_color[0] . ", " . $header_background_color[1] . ", " . $header_background_color[2] . ", " . $header_color_transparency_per_page . ");";
	}else{
		$header_color_per_page .= "background-color:" . esc_attr(get_post_meta($id, "edgt_header_color_per_page", true)) . ";";
	}
} else if($header_color_transparency_per_page != "" && get_post_meta($id, "edgt_header_color_per_page", true) == ""){
	$header_background_color = $edgt_options['header_background_color'] ? edgt_hex2rgb(esc_attr($edgt_options['header_background_color'])) : edgt_hex2rgb("#ffffff");
	$header_color_per_page .= "background-color:rgba(" . $header_background_color[0] . ", " . $header_background_color[1] . ", " . $header_background_color[2] . ", " . $header_color_transparency_per_page . ");";
}

if(isset($edgt_options['header_botom_border_in_grid']) && $edgt_options['header_botom_border_in_grid'] != "yes" && get_post_meta($id, "edgt_header_bottom_border_color", true) != ""){
	$header_color_per_page .= "border-bottom: 1px solid ".esc_attr(get_post_meta($id, "edgt_header_bottom_border_color", true)).";";
}

$header_top_color_per_page = "";
if(get_post_meta($id, "edgt_header_color_per_page", true) != ""){
	if($header_color_transparency_per_page != ""){
		$header_background_color = edgt_hex2rgb(esc_attr(get_post_meta($id, "edgt_header_color_per_page", true)));
		$header_top_color_per_page .= "background-color:rgba(" . esc_attr($header_background_color[0]) . ", " . esc_attr($header_background_color[1]) . ", " . esc_attr($header_background_color[2]) . ", " . esc_attr($header_color_transparency_per_page) . ");";
	}else{
		$header_top_color_per_page .= "background-color:" . esc_attr(get_post_meta($id, "edgt_header_color_per_page", true)) . ";";
	}
} else if($header_color_transparency_per_page != "" && get_post_meta($id, "edgt_header_color_per_page", true) == ""){
	$header_background_color = $edgt_options['header_top_background_color'] ? edgt_hex2rgb(esc_attr($edgt_options['header_top_background_color'])) : edgt_hex2rgb("#ffffff");
	$header_top_color_per_page .= "background-color:rgba(" . esc_attr($header_background_color[0]) . ", " . esc_attr($header_background_color[1]) . ", " . esc_attr($header_background_color[2]) . ", " . esc_attr($header_color_transparency_per_page) . ");";
}

$header_color_transparency_on_scroll="";
if(isset($edgt_options['header_background_transparency_sticky']) && $edgt_options['header_background_transparency_sticky'] != ""){
	$header_color_transparency_on_scroll = esc_attr($edgt_options['header_background_transparency_sticky']);
}

$header_separator = edgt_hex2rgb("#c0c0c0");
if(isset($edgt_options['header_separator_color']) && $edgt_options['header_separator_color'] != ""){
	$header_separator = edgt_hex2rgb(esc_attr($edgt_options['header_separator_color']));
}

$header_bottom_border_style = '';
if(isset($edgt_options['header_botom_border_in_grid']) && $edgt_options['header_botom_border_in_grid'] == "yes" && get_post_meta($id, "edgt_header_bottom_border_color", true) != ""){
	$header_bottom_border_style = 'border-bottom: 1px solid '.esc_attr(get_post_meta($id, "edgt_header_bottom_border_color", true)).';';
}

$header_triangle_style = '';
if(isset($edgt_options['enable_header_triangle']) && $edgt_options['enable_header_triangle'] == "yes" && !empty($edgt_options['header_triangle_section_color'])){
    $header_triangle_style = 'border-top-color:'.esc_attr($edgt_options['header_triangle_section_color']).';';
}

//generate header classes based on edgt options
$header_classes = '';

$header_bottom_appearance = 'fixed';
if(isset($edgt_options['header_bottom_appearance'])){
	$header_bottom_appearance = $edgt_options['header_bottom_appearance'];
}

$per_page_header_transparency = esc_attr(get_post_meta($id, 'edgt_header_color_transparency_per_page', true));
$header_transparency = '';

if($per_page_header_transparency !== '' && $per_page_header_transparency !== false) {
	$header_transparency = $per_page_header_transparency;
} else {
	$header_transparency = esc_attr($edgt_options['header_background_transparency_initial']);
}


$vertical_area_background_image = "";
if(isset($edgt_options['vertical_area_background_image']) && $edgt_options['vertical_area_background_image'] != "" && isset($edgt_options['vertical_area_dropdown_showing']) && $edgt_options['vertical_area_dropdown_showing'] != "side") {
	$vertical_area_background_image = $edgt_options['vertical_area_background_image'];
}
if(get_post_meta($id, "edgt_page_vertical_area_background_image", true) != "" && isset($edgt_options['vertical_area_dropdown_showing']) && $edgt_options['vertical_area_dropdown_showing'] != "side"){
	$vertical_area_background_image = get_post_meta($id, "edgt_page_vertical_area_background_image", true);
}

?>
<?php if($enable_vertical_menu) { ?>
	<?php


    $vertical_area_dropdown_showing = $edgt_options['vertical_area_dropdown_showing'];

    switch($vertical_area_dropdown_showing){
        case 'hover':
            $vertical_menu_style = "toggle";
            break;
        case 'click':
            $vertical_menu_style = "toggle click";
            break;
        case 'side':
            $vertical_menu_style = "side";
            break;
        case 'to_content':
            $vertical_menu_style = "to_content";
            break;
        default:
            $vertical_menu_style = "toggle";

    }
	$vertical_area_scroll = " with_scroll";
	if ($vertical_area_dropdown_showing == 'to_content') {
		$vertical_area_scroll = "";
	}


	$page_vertical_area_background_transparency = "";
	if($edgt_options['vertical_area_background_transparency'] != "") {
		$page_vertical_area_background_transparency = esc_attr($edgt_options['vertical_area_background_transparency']);
	}
	if(get_post_meta($id, "edgt_page_vertical_area_background_opacity", true) != ""){
		$page_vertical_area_background_transparency = esc_attr(get_post_meta($id, "edgt_page_vertical_area_background_opacity", true));
	}
	
	if(isset($edgt_options['vertical_area_dropdown_showing']) && $edgt_options['vertical_area_dropdown_showing'] == "side"){
		$page_vertical_area_background_transparency = 1;
	}

	$page_vertical_area_background = "";
	
	if(get_post_meta($id, "edgt_page_vertical_area_background", true) != ""){
		if($page_vertical_area_background_transparency != ""){
			$vertical_area_background_color = edgt_hex2rgb(esc_attr(get_post_meta($id, "edgt_page_vertical_area_background", true)));
			$page_vertical_area_background = 'background-color:rgba(' . $vertical_area_background_color[0] . ', ' . $vertical_area_background_color[1] . ', ' . $vertical_area_background_color[2] . ', ' . $page_vertical_area_background_transparency . ');';
		}else{
			$page_vertical_area_background = 'background-color:' . esc_attr(get_post_meta($id, 'edgt_page_vertical_area_background', true)) . ';';
		}
		
	}else if($page_vertical_area_background_transparency != "" && get_post_meta($id, "edgt_page_vertical_area_background", true) == ""){
		$vertical_area_background_color = $edgt_options['vertical_area_background'] ? edgt_hex2rgb(esc_attr($edgt_options['vertical_area_background'])) : edgt_hex2rgb("#ffffff");
		$page_vertical_area_background = 'background-color:rgba(' . esc_attr($vertical_area_background_color[0]) . ', ' . esc_attr($vertical_area_background_color[1]) . ', ' . esc_attr($vertical_area_background_color[2]) . ', ' . esc_attr($page_vertical_area_background_transparency) . ');';
	}
    
?>
	<aside class="vertical_menu_area<?php echo esc_attr($vertical_area_scroll); ?> <?php echo esc_attr($header_style); ?>" <?php edgt_inline_style($page_vertical_area_background); ?>>
		<div class="vertical_menu_area_inner">
			<?php if(isset($edgt_options['vertical_area_type']) && ($edgt_options['vertical_area_type'] == 'hidden' || $edgt_options['vertical_area_type'] == 'hidden_with_icons')) { ?>
			<a href="#" class="vertical_menu_hidden_button">
				<span class="vertical_menu_hidden_button_line"></span>
			</a>
			<?php } ?>

            <?php if($vertical_area_background_image != ""){ ?>
			    <div class="vertical_area_background preload_background" <?php echo 'style="background-image:url('.esc_url($vertical_area_background_image).'); opacity:'.esc_attr($page_vertical_area_background_transparency).';"'; ?>></div>
            <?php } ?>

			<?php if (!(isset($edgt_options['show_logo']) && $edgt_options['show_logo'] == "no")){ ?>
				<div class="vertical_logo_wrapper">
					<?php
					if (isset($edgt_options['logo_image']) && $edgt_options['logo_image'] != ""){ $logo_image = $edgt_options['logo_image'];}else{ $logo_image =  get_template_directory_uri().'/img/logo.png'; };
					if (isset($edgt_options['logo_image_light']) && $edgt_options['logo_image_light'] != ""){ $logo_image_light = $edgt_options['logo_image_light'];}else{ $logo_image_light =  get_template_directory_uri().'/img/logo.png'; };
					if (isset($edgt_options['logo_image_dark']) && $edgt_options['logo_image_dark'] != ""){ $logo_image_dark = $edgt_options['logo_image_dark'];}else{ $logo_image_dark =  get_template_directory_uri().'/img/logo_black.png'; };

					?>
					<div class="edgt_logo_vertical" style="height: <?php echo esc_attr(intval($edgt_options['logo_height'])/2); ?>px;">
						<a href="<?php echo esc_url(home_url('/')); ?>">
							<img class="normal" src="<?php echo esc_url($logo_image); ?>" alt="Logo"/>
							<img class="light" src="<?php echo esc_url($logo_image_light); ?>" alt="Logo"/>
							<img class="dark" src="<?php echo esc_url($logo_image_dark); ?>" alt="Logo"/>
						</a>
					</div>

				</div>
			<?php } ?>

			<nav class="vertical_menu dropdown_animation vertical_menu_<?php echo esc_attr($vertical_menu_style); ?>">
				<?php

				wp_nav_menu( array( 'theme_location' => 'top-navigation' ,
					'container'  => '',
					'container_class' => '',
					'menu_class' => '',
					'menu_id' => '',
					'fallback_cb' => 'top_navigation_fallback',
					'link_before' => '<span>',
					'link_after' => '</span>',
					'walker' => new edgt_type1_walker_nav_menu()
				));
				?>
			</nav>
			<div class="vertical_menu_area_widget_holder">
				<?php dynamic_sidebar('vertical_menu_area'); ?>
			</div>
		</div>
	</aside>
	<?php if((isset($edgt_options['vertical_area_type']) && ($edgt_options['vertical_area_type'] == 'hidden' || $edgt_options['vertical_area_type'] == 'hidden_with_icons')) &&
		(isset($edgt_options['vertical_logo_bottom']) && $edgt_options['vertical_logo_bottom'] !== '')) { ?>
		<div class="vertical_menu_area_bottom_logo">
			<div class="vertical_menu_area_bottom_logo_inner">
				<a href="javascript: void(0)">
					<img src="<?php echo esc_url($edgt_options['vertical_logo_bottom']); ?>" alt="vertical_menu_area_bottom_logo"/>
				</a>
			</div>
		</div>
	<?php } ?>

<?php } ?>
<?php
global $edgt_toolbar;
?>
<?php if(!$enable_vertical_menu){ ?>

	<?php if($header_bottom_appearance == "regular" || $header_bottom_appearance == "fixed" || $header_bottom_appearance == "fixed_hiding" || $header_bottom_appearance == "stick" || $header_bottom_appearance == "stick menu_bottom" || $header_bottom_appearance == "stick_with_left_right_menu"){ ?>
		<header class="<?php edgt_header_classes(); ?>">
			<div class="header_inner clearfix">
				<?php if(isset($edgt_options['enable_search']) && $edgt_options['enable_search'] == "yes" ){ ?>
					<?php if( ($header_color_transparency_per_page == '' || $header_color_transparency_per_page == '1') && ($header_color_transparency_on_scroll=='' || $header_color_transparency_on_scroll == '1') &&  isset($edgt_options['search_type']) && $edgt_options['search_type'] == "search_slides_from_header_bottom"){ ?>
					<form role="search" action="<?php echo esc_url(home_url('/')); ?>" class="edgt_search_form_2" method="get">
						<?php if($header_in_grid){ ?>
						<div class="container">
							<div class="container_inner clearfix">
							<?php if($edgt_options['overlapping_content'] == 'yes') {?><div class="overlapping_content_margin"><?php } ?>
							 <?php } ?>
								<div class="form_holder_outer">
									<div class="form_holder">
										<input type="text" placeholder="<?php _e('Search', 'edgt'); ?>" name="s" class="edgt_search_field" autocomplete="off" />
										<input type="submit" class="edgt_search_submit" value="&#xf002;" />
									</div>
								</div>
								<?php if($header_in_grid){ ?>
								<?php if($edgt_options['overlapping_content'] == 'yes') {?></div><?php } ?>
							</div>
						</div>
					<?php } ?>
					</form>

				<?php } else if(isset($edgt_options['search_type']) && $edgt_options['search_type'] == "search_covers_header") { ?>

				<form role="search" action="<?php echo esc_url(home_url('/')); ?>" class="edgt_search_form_3" method="get">
						<?php if($header_in_grid){ ?>
						<div class="container">
							<div class="container_inner clearfix">
							<?php if($edgt_options['overlapping_content'] == 'yes') {?><div class="overlapping_content_margin"><?php } ?>
						<?php } ?>
								<div class="form_holder_outer">
									<div class="form_holder">
										
										<input type="text" placeholder="<?php _e('Search', 'edgt'); ?>" name="s" class="edgt_search_field" autocomplete="off" />

										<div class="edgt_search_close">
											<a href="#">
												<?php if(isset($edgt_options['header_icon_pack'])) { $edgtIconCollections->getSearchClose($edgt_options['header_icon_pack']); } ?>
											</a>
										</div>
									</div>
								</div>
						<?php if($header_in_grid){ ?>
							<?php if($edgt_options['overlapping_content'] == 'yes') {?></div><?php } ?>
							</div>
						</div>
					<?php } ?>
					</form>
					<?php } ?>
				<?php } ?>
			<div class="header_top_bottom_holder">
				<?php if($display_header_top == "yes"){ ?>
					<div class="header_top clearfix" <?php edgt_inline_style($header_top_color_per_page); ?> >
						<?php if($header_in_grid){ ?>
						<div class="container">
							<div class="container_inner clearfix" >
							<?php if($edgt_options['overlapping_content'] == 'yes') {?><div class="overlapping_content_margin"><?php } ?>
								<?php } ?>
								<div class="left">
									<div class="inner">
										<?php
										dynamic_sidebar('header_left');
										?>
									</div>
								</div>
								<div class="right">
									<div class="inner">
										<?php
										dynamic_sidebar('header_right');
										?>
									</div>
								</div>
								<?php if($header_in_grid){ ?>
								<?php if($edgt_options['overlapping_content'] == 'yes') {?></div><?php } ?>
							</div>
						</div>
					<?php } ?>
					</div>
				<?php } ?>
				<div class="header_bottom <?php echo esc_attr($header_bottom_class) ;?> clearfix <?php if($menu_item_icon_position=="top"){echo 'with_large_icons ';} if($menu_position == "left" && $header_bottom_appearance != "fixed_hiding" && $header_bottom_appearance != "stick menu_bottom" && $header_bottom_appearance != "stick_with_left_right_menu"){ echo 'left_menu_position';} ?>" <?php edgt_inline_style($header_color_per_page); ?> >
					<?php if($header_in_grid){ ?>
					<div class="container">
						<div class="container_inner clearfix" <?php edgt_inline_style($header_bottom_border_style); ?>>
						<?php if($edgt_options['overlapping_content'] == 'yes') {?><div class="overlapping_content_margin"><?php } ?>
							<?php } ?>
							<?php if($header_bottom_appearance == "stick_with_left_right_menu") { ?>
								<nav class="main_menu drop_down left_side <?php echo esc_attr($menu_dropdown_appearance_class); ?>" <?php edgt_inline_style($divided_left_menu_padding); ?>>
									<div class="side_menu_button_wrapper right">
										<?php if(is_active_sidebar('header_bottom_left')) { ?>
											<div class="header_bottom_right_widget_holder"><?php dynamic_sidebar('header_bottom_left'); ?></div>
										<?php } ?>
									</div>
									
									<?php
									wp_nav_menu( array( 'theme_location' => 'left-top-navigation' ,
										'container'  => '',
										'container_class' => '',
										'menu_class' => '',
										'menu_id' => '',
										'fallback_cb' => 'top_navigation_fallback',
										'link_before' => '<span>',
										'link_after' => '</span>',
										'walker' => new edgt_type1_walker_nav_menu()
									));
									?>
								</nav>
							<?php } ?>
							<div class="header_inner_left">
								<?php if($centered_logo && $header_bottom_appearance !== "stick menu_bottom") {
									dynamic_sidebar( 'header_left_from_logo' );
								} ?>
								<?php if(edgt_is_main_menu_set()) { ?>
									<div class="mobile_menu_button">
										<span>
											<?php $edgtIconCollections->getMobileMenuIcon($edgt_options['header_icon_pack']); ?>
										</span>
									</div>
								<?php } ?>
								<?php if (!(isset($edgt_options['show_logo']) && $edgt_options['show_logo'] == "no")){ ?>
									<div class="logo_wrapper" <?php edgt_inline_style($logo_wrapper_style); ?>>
										<?php
										if (isset($edgt_options['logo_image']) && $edgt_options['logo_image'] != ""){ $logo_image = $edgt_options['logo_image'];}else{ $logo_image =  get_template_directory_uri().'/img/logo.png'; };
										if (isset($edgt_options['logo_image_light']) && $edgt_options['logo_image_light'] != ""){ $logo_image_light = $edgt_options['logo_image_light'];}else{ $logo_image_light =  get_template_directory_uri().'/img/logo.png'; };
										if (isset($edgt_options['logo_image_dark']) && $edgt_options['logo_image_dark'] != ""){ $logo_image_dark = $edgt_options['logo_image_dark'];}else{ $logo_image_dark =  get_template_directory_uri().'/img/logo_black.png'; };
										if (isset($edgt_options['logo_image_sticky']) && $edgt_options['logo_image_sticky'] != ""){ $logo_image_sticky = $edgt_options['logo_image_sticky'];}else{ $logo_image_sticky =  get_template_directory_uri().'/img/logo_black.png'; };
										if (isset($edgt_options['logo_image_popup']) && $edgt_options['logo_image_popup'] != ""){ $logo_image_popup = $edgt_options['logo_image_popup'];}else{ $logo_image_popup =  get_template_directory_uri().'/img/logo_white.png'; };
										if (isset($edgt_options['logo_image_fixed_hidden']) && $edgt_options['logo_image_fixed_hidden'] != ""){ $logo_image_fixed_hidden = $edgt_options['logo_image_fixed_hidden'];}else{ $logo_image_fixed_hidden =  get_template_directory_uri().'/img/logo.png'; };
										if (isset($edgt_options['logo_image_mobile']) && $edgt_options['logo_image_mobile'] != ""){
											$logo_image_mobile = $edgt_options['logo_image_mobile'];
										}else{ 
											if(isset($edgt_options['logo_image']) && $edgt_options['logo_image'] != ""){
												$logo_image_mobile = $edgt_options['logo_image'];
											}else{ 
												$logo_image_mobile =  get_template_directory_uri().'/img/logo.png'; 
											}
										}
										?>
										<div class="edgt_logo"><a <?php edgt_inline_style($logo_wrapper_style); ?> href="<?php echo esc_url(home_url('/')); ?>"><img class="normal" src="<?php echo esc_url($logo_image); ?>" alt="Logo"/><img class="light" src="<?php echo esc_url($logo_image_light); ?>" alt="Logo"/><img class="dark" src="<?php echo esc_url($logo_image_dark); ?>" alt="Logo"/><img class="sticky" src="<?php echo esc_url($logo_image_sticky); ?>" alt="Logo"/><img class="mobile" src="<?php echo esc_url($logo_image_mobile); ?>" alt="Logo"/><?php if($enable_popup_menu == 'yes'){ ?><img class="popup" src="<?php echo esc_url($logo_image_popup); ?>" alt="Logo"/><?php } ?></a></div>
										<?php if($header_bottom_appearance == "fixed_hiding") { ?>
											<div class="edgt_logo_hidden"><a href="<?php echo esc_url(home_url('/')); ?>"><img alt="Logo" src="<?php echo esc_url($logo_image_fixed_hidden); ?>" style="height: 100%;"></a></div>
										<?php } ?>
									</div>
								<?php } ?>
								<?php if($header_bottom_appearance == "stick menu_bottom" && is_active_sidebar('header_fixed_right')){ ?>
									<div class="header_fixed_right_area">
										<?php dynamic_sidebar('header_fixed_right'); ?>
									</div>
								<?php } ?>
								<?php if($centered_logo && $header_bottom_appearance !== "stick menu_bottom") {
									dynamic_sidebar( 'header_right_from_logo' );
								} ?>
							</div>
							<?php if($header_bottom_appearance == "stick_with_left_right_menu") { ?>
								<nav class="main_menu drop_down right_side <?php echo esc_attr($menu_dropdown_appearance_class); ?>" <?php edgt_inline_style($divided_right_menu_padding); ?>>
									<?php
									wp_nav_menu( array( 'theme_location' => 'right-top-navigation' ,
										'container'  => '',
										'container_class' => '',
										'menu_class' => '',
										'menu_id' => '',
										'fallback_cb' => 'top_navigation_fallback',
										'link_before' => '<span>',
										'link_after' => '</span>',
										'walker' => new edgt_type1_walker_nav_menu()
									));
									?>
									<div class="side_menu_button_wrapper right">
										<?php if(is_active_sidebar('header_bottom_right')) { ?>
											<div class="header_bottom_right_widget_holder"><?php dynamic_sidebar('header_bottom_right'); ?></div>
										<?php } ?>
										<?php if(is_active_sidebar('woocommerce_dropdown')) {
											dynamic_sidebar('woocommerce_dropdown');
										} ?>
										<div class="side_menu_button">
										<?php if(isset($edgt_options['enable_search']) && $edgt_options['enable_search'] == 'yes') {
											$search_type_class = 'search_slides_from_top';
											if(isset($edgt_options['search_type']) && $edgt_options['search_type'] !== '') {
												$search_type_class = $edgt_options['search_type'];
											} ?>
											
											
											
											<a class="<?php echo esc_attr($search_type_class); ?> <?php echo esc_attr($header_button_size); ?>" href="javascript:void(0)">
												<?php if(isset($edgt_options['header_icon_pack'])){ $edgtIconCollections->getSearchIcon($edgt_options['header_icon_pack']); } ?>
												<?php if(isset($edgt_options['enable_search_icon_text']) && $edgt_options['enable_search_icon_text'] == 'yes'){?>
													<span class="search_icon_text">
														<?php _e('Search', 'edgt'); ?>
													</span>
												<?php } ?>
											</a>
											
											<?php if($enable_fullscreen_search=="yes"){ ?>
												<a class="fullscreen_search_close"  href="javascript:void(0)">
													<?php if(isset($edgt_options['header_icon_pack'])) { $edgtIconCollections->getSearchClose($edgt_options['header_icon_pack']); } ?>
												</a>
											<?php } ?>
										<?php } ?>
										<?php if($enable_popup_menu == "yes"){ ?>
											<a href="javascript:void(0)" class="popup_menu <?php echo esc_attr($header_button_size.' '.$popup_menu_animation_style); ?>"><span class="popup_menu_inner"><i class="line">&nbsp;</i></span></a>
										<?php } ?>
										<?php if($enable_side_area == "yes" && $enable_popup_menu == 'no'){ ?>
											<a class="side_menu_button_link <?php echo esc_attr($header_button_size); ?>" href="javascript:void(0)">
											<?php echo edgt_get_side_menu_icon_html(); ?></a>
										<?php } ?>
										</div>
									</div>
								</nav>
								
							<?php } ?>
							<?php if($header_bottom_appearance != "stick menu_bottom" && $header_bottom_appearance != "stick_with_left_right_menu"){ ?>
								<?php if($header_bottom_appearance == "fixed_hiding") { ?> <div class="holeder_for_hidden_menu"> <?php } //only for fixed with hiding menu ?>
								<?php if(!$centered_logo) { ?>
									<div class="header_inner_right">
										<div class="side_menu_button_wrapper right">
											<?php if(is_active_sidebar('header_bottom_right')) { ?>
												<div class="header_bottom_right_widget_holder"><?php dynamic_sidebar('header_bottom_right'); ?></div>
											<?php } ?>
											<?php if(is_active_sidebar('woocommerce_dropdown')) {
												dynamic_sidebar('woocommerce_dropdown');
											} ?>
											<div class="side_menu_button">
	
											<?php if(isset($edgt_options['enable_search']) && $edgt_options['enable_search'] == 'yes') {
												$search_type_class = 'search_slides_from_top';
												if(isset($edgt_options['search_type']) && $edgt_options['search_type'] !== '') {
													$search_type_class = $edgt_options['search_type'];
												} ?>
												
												<a class="<?php echo esc_attr($search_type_class); ?> <?php echo esc_attr($header_button_size); ?>" href="javascript:void(0)">
													<?php if(isset($edgt_options['header_icon_pack'])){ $edgtIconCollections->getSearchIcon($edgt_options['header_icon_pack']); } ?>
													<?php if(isset($edgt_options['enable_search_icon_text']) && $edgt_options['enable_search_icon_text'] == 'yes'){?>
														<span class="search_icon_text">
															<?php _e('Search', 'edgt'); ?>
														</span>
													<?php } ?>
												</a>
												
												<?php if($enable_fullscreen_search=="yes"){ ?>
													<a class="fullscreen_search_close"  href="javascript:void(0)">
														<?php if(isset($edgt_options['header_icon_pack'])) { $edgtIconCollections->getSearchClose($edgt_options['header_icon_pack']); } ?>
													</a>
												<?php } ?>
											<?php } ?>
		
												<?php if($enable_popup_menu == "yes"){ ?>
													<a href="javascript:void(0)" class="popup_menu <?php echo esc_attr($header_button_size.' '.$popup_menu_animation_style); ?>"><span class="popup_menu_inner"><i class="line">&nbsp;</i></span></a>
												<?php } ?>
												<?php if($enable_side_area == "yes" && $enable_popup_menu == 'no'){ ?>
													<a class="side_menu_button_link <?php echo esc_attr($header_button_size); ?>" href="javascript:void(0)">
													<?php echo edgt_get_side_menu_icon_html(); ?></a>
												<?php } ?>
											</div>
										</div>
									</div>
								<?php } ?>
								<?php if($centered_logo == true && $enable_border_top_bottom_menu == true) { ?> <div class="main_menu_and_widget_holder"> <?php } //only for logo is centered ?>
								<nav class="main_menu drop_down  <?php  echo esc_attr($menu_dropdown_appearance_class); if($menu_position == "" && $header_bottom_appearance != "stick menu_bottom"){ echo ' right';} ?>">
									<?php

									wp_nav_menu( array( 'theme_location' => 'top-navigation' ,
										'container'  => '',
										'container_class' => '',
										'menu_class' => '',
										'menu_id' => '',
										'fallback_cb' => 'top_navigation_fallback',
										'link_before' => '<span>',
										'link_after' => '</span>',
										'walker' => new edgt_type1_walker_nav_menu()
									));
									?>
								</nav>
								<?php if($centered_logo) { ?>
									<div class="header_inner_right">
										<div class="side_menu_button_wrapper right">
											<?php if(is_active_sidebar('header_bottom_right')) { ?>
												<div class="header_bottom_right_widget_holder"><?php dynamic_sidebar('header_bottom_right'); ?></div>
											<?php } ?>
											<?php if(is_active_sidebar('woocommerce_dropdown')) {
												dynamic_sidebar('woocommerce_dropdown');
											} ?>
											<div class="side_menu_button">
												<?php if(isset($edgt_options['enable_search']) && $edgt_options['enable_search'] == 'yes') {
													$search_type_class = 'search_slides_from_top';
													if(isset($edgt_options['search_type']) && $edgt_options['search_type'] !== '') {
														$search_type_class = $edgt_options['search_type'];
													} ?>

													<a class="<?php echo esc_attr($search_type_class); ?>" href="javascript:void(0)">
														<?php if(isset($edgt_options['header_icon_pack'])){ $edgtIconCollections->getSearchIcon($edgt_options['header_icon_pack']); } ?>
														<?php if(isset($edgt_options['enable_search_icon_text']) && $edgt_options['enable_search_icon_text'] == 'yes'){?>
															<span class="search_icon_text">
																<?php _e('Search', 'edgt'); ?>
															</span>
														<?php } ?>
													</a>
												
													<?php if($enable_fullscreen_search=="yes"){ ?>
														<a class="fullscreen_search_close"  href="javascript:void(0)">
															<?php if(isset($edgt_options['header_icon_pack'])) { $edgtIconCollections->getSearchClose($edgt_options['header_icon_pack']); } ?>
														</a>
													<?php } ?>
												<?php } ?>
												<?php if($enable_popup_menu == "yes"){ ?>
													<a href="javascript:void(0)" class="popup_menu <?php echo esc_attr($header_button_size.' '.$popup_menu_animation_style); ?>"><span class="popup_menu_inner"><i class="line">&nbsp;</i></span></a>
												<?php } ?>
												<?php if($enable_side_area == "yes" && $enable_popup_menu == 'no'){ ?>
													<a class="side_menu_button_link <?php echo esc_attr($header_button_size); ?>" href="javascript:void(0)">
														<?php echo edgt_get_side_menu_icon_html(); ?>
													</a>
												<?php } ?>

											</div>
										</div>
									</div>
								<?php } ?>
								<?php if($centered_logo == true && $enable_border_top_bottom_menu == true) { ?> </div> <?php } //only for logo is centered ?>
								<?php if($header_bottom_appearance == "fixed_hiding") { ?> </div> <?php } //only for fixed with hiding menu ?>
							<?php }else if($header_bottom_appearance == "stick menu_bottom"){ ?>
							<div class="header_menu_bottom clearfix">
								<div class="header_menu_bottom_inner">
									<?php if($centered_logo) { ?>
									<div class="main_menu_header_inner_right_holder with_center_logo">
										<?php } else { ?>
										<div class="main_menu_header_inner_right_holder">
											<?php } ?>
											<nav class="main_menu drop_down <?php echo esc_attr($menu_dropdown_appearance_class); ?>">
												<?php
												wp_nav_menu( array(
													'theme_location' => 'top-navigation' ,
													'container'  => '',
													'container_class' => '',
													'menu_class' => 'clearfix',
													'menu_id' => '',
													'fallback_cb' => 'top_navigation_fallback',
													'link_before' => '<span>',
													'link_after' => '</span>',
													'walker' => new edgt_type1_walker_nav_menu()
												));
												?>
											</nav>
											<div class="header_inner_right">
												<div class="side_menu_button_wrapper right">
													<?php if(is_active_sidebar('header_bottom_right')) { ?>
														<div class="header_bottom_right_widget_holder"><?php dynamic_sidebar('header_bottom_right'); ?></div>
													<?php } ?>
													<?php if(is_active_sidebar('woocommerce_dropdown')) {
														dynamic_sidebar('woocommerce_dropdown');
													} ?>
													<div class="side_menu_button">
		
													<?php if(isset($edgt_options['enable_search']) && $edgt_options['enable_search'] == 'yes') {
														$search_type_class = 'search_slides_from_top';
														if(isset($edgt_options['search_type']) && $edgt_options['search_type'] !== '') {
															$search_type_class = $edgt_options['search_type'];
														} ?>

														<a class="<?php echo esc_attr($search_type_class); ?>" href="javascript:void(0)">
															<?php if (isset($edgt_options['header_icon_pack'])) { $edgtIconCollections->getSearchIcon($edgt_options['header_icon_pack']); } ?>
															<?php if(isset($edgt_options['enable_search_icon_text']) && $edgt_options['enable_search_icon_text'] == 'yes'){?>
																<span class="search_icon_text">
																	<?php _e('Search', 'edgt'); ?>
																</span>
															<?php } ?>
														</a>
														
														<?php if($enable_fullscreen_search=="yes"){ ?>
															<a class="fullscreen_search_close"  href="javascript:void(0)">
																<?php if(isset($edgt_options['header_icon_pack'])) { $edgtIconCollections->getSearchClose($edgt_options['header_icon_pack']); } ?>
															</a>
														<?php } ?>
													<?php } ?>
		
														<?php if($enable_popup_menu == "yes"){ ?>
															<a href="javascript:void(0)" class="popup_menu <?php echo esc_attr($header_button_size.' '.$popup_menu_animation_style); ?>"><span class="popup_menu_inner"><i class="line">&nbsp;</i></span></a>
														<?php } ?>
														<?php if($enable_side_area == "yes" && $enable_popup_menu == 'no'){ ?>
															<a class="side_menu_button_link <?php echo esc_attr($header_button_size); ?>" href="javascript:void(0)">
																<?php echo edgt_get_side_menu_icon_html(); ?>
															</a>
														<?php } ?>
												
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php } ?>
								<nav class="mobile_menu">
									<?php
									if($header_bottom_appearance == "stick_with_left_right_menu") {
										echo '<ul>';
										wp_nav_menu( array( 'theme_location' => 'left-top-navigation' ,
											'container'  => '',
											'container_class' => '',
											'menu_class' => '',
											'menu_id' => '',
											'fallback_cb' => '',
											'link_before' => '<span>',
											'link_after' => '</span>',
											'walker' => new edgt_type4_walker_nav_menu(),
											'items_wrap'      => '%3$s'
										));
										wp_nav_menu( array( 'theme_location' => 'right-top-navigation' ,
											'container'  => '',
											'container_class' => '',
											'menu_class' => '',
											'menu_id' => '',
											'fallback_cb' => '',
											'link_before' => '<span>',
											'link_after' => '</span>',
											'walker' => new edgt_type4_walker_nav_menu(),
											'items_wrap'      => '%3$s'
										));
										echo '</ul>';
									}else{
										wp_nav_menu( array( 'theme_location' => 'top-navigation' ,
											'container'  => '',
											'container_class' => '',
											'menu_class' => '',
											'menu_id' => '',
											'fallback_cb' => 'top_navigation_fallback',
											'link_before' => '<span>',
											'link_after' => '</span>',
											'walker' => new edgt_type2_walker_nav_menu()
										));
									}
									?>
								</nav>
								<?php if($header_in_grid){ ?>
								<?php if($edgt_options['overlapping_content'] == 'yes') {?></div><?php } ?>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
                <?php if($header_bottom_appearance == "stick_with_left_right_menu"){ ?>
                    <?php  if(isset($edgt_options['enable_header_triangle']) && $edgt_options['enable_header_triangle'] == 'yes') { ?>
                        <div class="row_triangle row_triangle_top triangle_bkg" <?php edgt_inline_style($header_triangle_style); ?>></div>
                    <?php } ?>
                <?php } ?>
		</header>
	<?php } else if($header_bottom_appearance == "fixed_top_header"){ ?>
	
<?php //FIXED HEADER TOP Header Type ?>
	
	<header class="<?php edgt_header_classes(); ?>">
		<div class="header_inner clearfix">
			<!--insert start-->
				<?php if(isset($edgt_options['enable_search']) && $edgt_options['enable_search'] == "yes" ){ ?>
					<?php  if(isset($edgt_options['search_type']) && $edgt_options['search_type'] == "search_covers_header") { ?>
						<form role="search" action="<?php echo esc_url(home_url('/')); ?>" class="edgt_search_form_3" method="get">
								<?php if($header_in_grid){ ?>
								<div class="container">
									<div class="container_inner clearfix">
									<?php if($edgt_options['overlapping_content'] == 'yes') {?><div class="overlapping_content_margin"><?php } ?>
								<?php } ?>
										<div class="form_holder_outer">
											<div class="form_holder">
												<input type="text" placeholder="<?php _e('Search', 'edgt'); ?>" name="s" class="edgt_search_field" autocomplete="off" />
						

												<div class="edgt_search_close">
													<a href="#">
														<?php if(isset($edgt_options['header_icon_pack'])) { $edgtIconCollections->getSearchClose($edgt_options['header_icon_pack']); } ?>
													</a>
												</div>
											</div>
										</div>
								<?php if($header_in_grid){ ?>
									<?php if($edgt_options['overlapping_content'] == 'yes') {?></div><?php } ?>
									</div>
								</div>
							<?php } ?>
						</form>
					<?php } ?>
				<?php } ?>
			<!--insert end-->
			<div class="header_top_bottom_holder">
				<?php if($display_header_top == "yes"){ ?>
					<div class="top_header clearfix" <?php edgt_inline_style($header_top_color_per_page); ?> >
						<?php if($header_in_grid){ ?>
						<div class="container">
							<div class="container_inner clearfix" >
							<?php if($edgt_options['overlapping_content'] == 'yes') {?><div class="overlapping_content_margin"><?php } ?>
								<?php } ?>
								<div class="left">
									<div class="inner">
										<nav class="main_menu drop_down <?php echo esc_attr($menu_dropdown_appearance_class); ?>">
											<?php
											wp_nav_menu( array(
												'theme_location' => 'top-navigation' ,
												'container'  => '',
												'container_class' => '',
												'menu_class' => 'clearfix',
												'menu_id' => '',
												'fallback_cb' => 'top_navigation_fallback',
												'link_before' => '<span>',
												'link_after' => '</span>',
												'walker' => new edgt_type1_walker_nav_menu()
											));
											?>
										</nav>
										<?php if(edgt_is_main_menu_set()) { ?>
											<div class="mobile_menu_button"><span>
													<?php $edgtIconCollections->getMobileMenuIcon($edgt_options['header_icon_pack']); ?>
												</span>
											</div>
										<?php } ?>
										
									</div>
								</div>
								<div class="right">
									<div class="inner">
										<div class="side_menu_button_wrapper right">
											<div class="header_bottom_right_widget_holder">
												<?php
												dynamic_sidebar('header_right');
												?>
											</div>
											<?php if(is_active_sidebar('woocommerce_dropdown')) {
												dynamic_sidebar('woocommerce_dropdown');
											} ?>
											<div class="side_menu_button">
												
												<?php if(isset($edgt_options['enable_search']) && $edgt_options['enable_search'] == 'yes') { ?>
													<a class="search_covers_header <?php echo esc_attr($header_button_size); ?>" href="javascript:void(0)">
														<?php if(isset($edgt_options['header_icon_pack'])){ $edgtIconCollections->getSearchIcon($edgt_options['header_icon_pack']); } ?>
														<?php if(isset($edgt_options['enable_search_icon_text']) && $edgt_options['enable_search_icon_text'] == 'yes'){?>
															<span class="search_icon_text">
																<?php _e('Search', 'edgt'); ?>
															</span>
														<?php } ?>
													</a>
												<?php } ?>
												
												<?php if($enable_popup_menu == "yes"){ ?>
													<a href="javascript:void(0)" class="popup_menu <?php echo esc_attr($header_button_size.' '.$popup_menu_animation_style); ?>"><span class="popup_menu_inner"><i class="line">&nbsp;</i></span></a>
												<?php } ?>
												<?php if($enable_side_area == "yes" && $enable_popup_menu == 'no'){ ?>
													<a class="side_menu_button_link <?php echo esc_attr($header_button_size); ?>" href="javascript:void(0)">
														<?php echo edgt_get_side_menu_icon_html(); ?>
													</a>
												<?php } ?>
										
											</div>
										</div>
									</div>
								</div>
								<nav class="mobile_menu">
								<?php
									wp_nav_menu( array( 'theme_location' => 'top-navigation' ,
										'container'  => '',
										'container_class' => '',
										'menu_class' => '',
										'menu_id' => '',
										'fallback_cb' => 'top_navigation_fallback',
										'link_before' => '<span>',
										'link_after' => '</span>',
										'walker' => new edgt_type2_walker_nav_menu()
									));
								
								?>
								</nav>
								<?php if($header_in_grid){ ?>
								<?php if($edgt_options['overlapping_content'] == 'yes') {?></div><?php } ?>
							</div>
						</div>
					<?php } ?>
					</div>
				<?php } ?>
				<div class="bottom_header clearfix" <?php edgt_inline_style($header_color_per_page); ?> >
					<?php if($header_in_grid){ ?>
					<div class="container">
						<div class="container_inner clearfix" <?php edgt_inline_style($header_bottom_border_style); ?>>
						<?php if($edgt_options['overlapping_content'] == 'yes') {?><div class="overlapping_content_margin"><?php } ?>
							<?php } ?>
							<div class="header_inner_center">
								
								<?php if (!(isset($edgt_options['show_logo']) && $edgt_options['show_logo'] == "no")){ ?>
									<div class="logo_wrapper" <?php edgt_inline_style($logo_wrapper_style); ?>>
										<?php
										if (isset($edgt_options['logo_image']) && $edgt_options['logo_image'] != ""){ $logo_image = $edgt_options['logo_image'];}else{ $logo_image =  get_template_directory_uri().'/img/logo.png'; };
										if (isset($edgt_options['logo_image_light']) && $edgt_options['logo_image_light'] != ""){ $logo_image_light = $edgt_options['logo_image_light'];}else{ $logo_image_light =  get_template_directory_uri().'/img/logo.png'; };
										if (isset($edgt_options['logo_image_dark']) && $edgt_options['logo_image_dark'] != ""){ $logo_image_dark = $edgt_options['logo_image_dark'];}else{ $logo_image_dark =  get_template_directory_uri().'/img/logo_black.png'; };
										if (isset($edgt_options['logo_image_sticky']) && $edgt_options['logo_image_sticky'] != ""){ $logo_image_sticky = $edgt_options['logo_image_sticky'];}else{ $logo_image_sticky =  get_template_directory_uri().'/img/logo_black.png'; };
										if (isset($edgt_options['logo_image_popup']) && $edgt_options['logo_image_popup'] != ""){ $logo_image_popup = $edgt_options['logo_image_popup'];}else{ $logo_image_popup =  get_template_directory_uri().'/img/logo_white.png'; };
										if (isset($edgt_options['logo_image_fixed_hidden']) && $edgt_options['logo_image_fixed_hidden'] != ""){ $logo_image_fixed_hidden = $edgt_options['logo_image_fixed_hidden'];}else{ $logo_image_fixed_hidden =  get_template_directory_uri().'/img/logo.png'; };
										if (isset($edgt_options['logo_image_mobile']) && $edgt_options['logo_image_mobile'] != ""){
											$logo_image_mobile = $edgt_options['logo_image_mobile'];
										}else{ 
											if(isset($edgt_options['logo_image']) && $edgt_options['logo_image'] != ""){
												$logo_image_mobile = $edgt_options['logo_image'];
											}else{ 
												$logo_image_mobile =  get_template_directory_uri().'/img/logo.png'; 
											}
										}
										?>
										<div class="edgt_logo"><a <?php edgt_inline_style($logo_wrapper_style); ?> href="<?php echo esc_url(home_url('/')); ?>"><img class="normal" src="<?php echo esc_url($logo_image); ?>" alt="Logo"/><img class="light" src="<?php echo esc_url($logo_image_light); ?>" alt="Logo"/><img class="dark" src="<?php echo esc_url($logo_image_dark); ?>" alt="Logo"/><img class="sticky" src="<?php echo esc_url($logo_image_sticky); ?>" alt="Logo"/><img class="mobile" src="<?php echo esc_url($logo_image_mobile); ?>" alt="Logo"/><?php if($enable_popup_menu == 'yes'){ ?><img class="popup" src="<?php echo esc_url($logo_image_popup); ?>" alt="Logo"/><?php } ?></a></div>
										
									</div>
								<?php } ?>
								<?php
									dynamic_sidebar('header_bottom_center');
								?>
								
							</div>
								<?php if($header_in_grid){ ?>
								<?php if($edgt_options['overlapping_content'] == 'yes') {?></div><?php } ?>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</header>

	<?php } else if($header_bottom_appearance == "fixed fixed_minimal"){ ?>
	
<?php //FIXED MINIMAL Header Type ?>

		<header class="<?php edgt_header_classes(); ?>">
			<div class="header_inner clearfix">
				<?php if(isset($edgt_options['enable_search']) && $edgt_options['enable_search'] == "yes" ){ ?>
					<?php if( ($header_color_transparency_per_page == '' || $header_color_transparency_per_page == '1') && ($header_color_transparency_on_scroll=='' || $header_color_transparency_on_scroll == '1') &&  isset($edgt_options['search_type']) && $edgt_options['search_type'] == "search_slides_from_header_bottom"){ ?>
					<form role="search" action="<?php echo esc_url(home_url('/')); ?>" class="edgt_search_form_2" method="get">
						<?php if($header_in_grid){ ?>
						<div class="container">
							<div class="container_inner clearfix">
							<?php if($edgt_options['overlapping_content'] == 'yes') {?><div class="overlapping_content_margin"><?php } ?>
							 <?php } ?>
								<div class="form_holder_outer">
									<div class="form_holder">
										<input type="text" placeholder="<?php _e('Search', 'edgt'); ?>" name="s" class="edgt_search_field" autocomplete="off" />
										<input type="submit" class="edgt_search_submit" value="&#xf002;" />
									</div>
								</div>
								<?php if($header_in_grid){ ?>
								<?php if($edgt_options['overlapping_content'] == 'yes') {?></div><?php } ?>
							</div>
						</div>
					<?php } ?>
					</form>
				<?php } else if(isset($edgt_options['search_type']) && $edgt_options['search_type'] == "search_covers_header") { ?>
					<form role="search" action="<?php echo esc_url(home_url('/')); ?>" class="edgt_search_form_3" method="get">
						<?php if($header_in_grid){ ?>
						<div class="container">
							<div class="container_inner clearfix">
							<?php if($edgt_options['overlapping_content'] == 'yes') {?><div class="overlapping_content_margin"><?php } ?>
						<?php } ?>
								<div class="form_holder_outer">
									<div class="form_holder">
										<input type="text" placeholder="<?php _e('Search', 'edgt'); ?>" name="s" class="edgt_search_field" autocomplete="off" />
										<div class="edgt_search_close">
											<a href="#">
												<?php if(isset($edgt_options['header_icon_pack'])) { $edgtIconCollections->getSearchClose($edgt_options['header_icon_pack']); } ?>
											</a>
										</div>
									</div>
								</div>
						<?php if($header_in_grid){ ?>
							<?php if($edgt_options['overlapping_content'] == 'yes') {?></div><?php } ?>
							</div>
						</div>
					<?php } ?>
					</form>
					<?php } ?>
				<?php } ?>
				<div class="header_top_bottom_holder">
					<?php if($display_header_top == "yes"){ ?>
						<div class="header_top clearfix" <?php edgt_inline_style($header_top_color_per_page); ?> >
							<?php if($header_in_grid){ ?>
							<div class="container">
								<div class="container_inner clearfix" >
								<?php if($edgt_options['overlapping_content'] == 'yes') {?><div class="overlapping_content_margin"><?php } ?>
									<?php } ?>
									<div class="left">
										<div class="inner">
											<?php
											dynamic_sidebar('header_left');
											?>
										</div>
									</div>
									<div class="right">
										<div class="inner">
											<?php
											dynamic_sidebar('header_right');
											?>
										</div>
									</div>
									<?php if($header_in_grid){ ?>
									<?php if($edgt_options['overlapping_content'] == 'yes') {?></div><?php } ?>
								</div>
							</div>
						<?php } ?>
						</div>
					<?php } ?>
					<div class="header_bottom <?php echo esc_attr($header_bottom_class) ;?> clearfix" <?php edgt_inline_style($header_color_per_page); ?> >
						<?php if($header_in_grid){ ?>
						<div class="container">
							<div class="container_inner clearfix" <?php edgt_inline_style($header_bottom_border_style); ?>>
							<?php if($edgt_options['overlapping_content'] == 'yes') {?><div class="overlapping_content_margin"><?php } ?>
						<?php } ?>
								<div class="header_inner_left">
									<div class="side_menu_button_wrapper left">
										<div class="side_menu_button">
											<?php if($enable_popup_menu == "yes"){ ?>
												<a href="javascript:void(0)" class="popup_menu <?php echo esc_attr($header_button_size.' '.$popup_menu_animation_style); ?>"><span class="popup_menu_inner"><i class="line">&nbsp;</i></span></a>
											<?php } ?>
										</div>
									</div>
								</div>
								<?php if (!(isset($edgt_options['show_logo']) && $edgt_options['show_logo'] == "no")){ ?>
									<div class="logo_wrapper" <?php edgt_inline_style($logo_wrapper_style); ?>>
										<?php
										if (isset($edgt_options['logo_image']) && $edgt_options['logo_image'] != ""){ $logo_image = $edgt_options['logo_image'];}else{ $logo_image =  get_template_directory_uri().'/img/logo.png'; };
										if (isset($edgt_options['logo_image_light']) && $edgt_options['logo_image_light'] != ""){ $logo_image_light = $edgt_options['logo_image_light'];}else{ $logo_image_light =  get_template_directory_uri().'/img/logo.png'; };
										if (isset($edgt_options['logo_image_dark']) && $edgt_options['logo_image_dark'] != ""){ $logo_image_dark = $edgt_options['logo_image_dark'];}else{ $logo_image_dark =  get_template_directory_uri().'/img/logo_black.png'; };
										if (isset($edgt_options['logo_image_sticky']) && $edgt_options['logo_image_sticky'] != ""){ $logo_image_sticky = $edgt_options['logo_image_sticky'];}else{ $logo_image_sticky =  get_template_directory_uri().'/img/logo_black.png'; };
										if (isset($edgt_options['logo_image_popup']) && $edgt_options['logo_image_popup'] != ""){ $logo_image_popup = $edgt_options['logo_image_popup'];}else{ $logo_image_popup =  get_template_directory_uri().'/img/logo_white.png'; };
										if (isset($edgt_options['logo_image_fixed_hidden']) && $edgt_options['logo_image_fixed_hidden'] != ""){ $logo_image_fixed_hidden = $edgt_options['logo_image_fixed_hidden'];}else{ $logo_image_fixed_hidden =  get_template_directory_uri().'/img/logo.png'; };
										if (isset($edgt_options['logo_image_mobile']) && $edgt_options['logo_image_mobile'] != ""){
											$logo_image_mobile = $edgt_options['logo_image_mobile'];
										}else{ 
											if(isset($edgt_options['logo_image']) && $edgt_options['logo_image'] != ""){
												$logo_image_mobile = $edgt_options['logo_image'];
											}else{ 
												$logo_image_mobile =  get_template_directory_uri().'/img/logo.png'; 
											}
										}
										?>
										<div class="edgt_logo"><a <?php edgt_inline_style($logo_wrapper_style); ?> href="<?php echo esc_url(home_url('/')); ?>"><img class="normal" src="<?php echo esc_url($logo_image); ?>" alt="Logo"/><img class="light" src="<?php echo esc_url($logo_image_light); ?>" alt="Logo"/><img class="dark" src="<?php echo esc_url($logo_image_dark); ?>" alt="Logo"/><img class="sticky" src="<?php echo esc_url($logo_image_sticky); ?>" alt="Logo"/><img class="mobile" src="<?php echo esc_url($logo_image_mobile); ?>" alt="Logo"/><?php if($enable_popup_menu == 'yes'){ ?><img class="popup" src="<?php echo esc_url($logo_image_popup); ?>" alt="Logo"/><?php } ?></a></div>
								
									</div>
								<?php } ?>
								<div class="header_inner_right">
									<div class="side_menu_button_wrapper right">
										<?php if(is_active_sidebar('woocommerce_dropdown')) {
											dynamic_sidebar('woocommerce_dropdown');
										} ?>
										<div class="side_menu_button">
											<?php if(isset($edgt_options['enable_search']) && $edgt_options['enable_search'] == 'yes') {
												$search_type_class = 'search_slides_from_top';
												if(isset($edgt_options['search_type']) && $edgt_options['search_type'] !== '') {
													$search_type_class = $edgt_options['search_type'];
												} ?>
												<a class="<?php echo esc_attr($search_type_class); ?>" href="javascript:void(0)">
													<?php if (isset($edgt_options['header_icon_pack'])) { $edgtIconCollections->getSearchIcon($edgt_options['header_icon_pack']); } ?>
													<?php if(isset($edgt_options['enable_search_icon_text']) && $edgt_options['enable_search_icon_text'] == 'yes'){?>
														<span class="search_icon_text">
															<?php _e('Search', 'edgt'); ?>
														</span>
													<?php } ?>
												</a>
												
												<?php if($enable_fullscreen_search=="yes"){ ?>
													<a class="fullscreen_search_close"  href="javascript:void(0)">
														<?php if(isset($edgt_options['header_icon_pack'])) { $edgtIconCollections->getSearchClose($edgt_options['header_icon_pack']); } ?>
													</a>
												<?php } ?>
											<?php } ?>
										</div>
									</div>
								</div>
								<?php if($header_in_grid){ ?>
								<?php if($edgt_options['overlapping_content'] == 'yes') {?></div><?php } ?>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</header>
	
	<?php } ?>
	
<?php } else{?>

	<?php //Here renders header simplified because Side Menu is enabled?>
	
	<header class="page_header <?php if($display_header_top == "yes"){ echo 'has_top'; }  if($header_top_area_scroll == "yes"){ echo ' scroll_top'; }?> <?php if($centered_logo){ echo " centered_logo"; } ?> <?php echo esc_attr($header_bottom_appearance); ?>  <?php echo esc_attr($header_style); ?> <?php if(is_active_sidebar('header_fixed_right')) { echo 'has_header_fixed_right'; } ?>">
		<div class="header_inner clearfix">
			
			<div class="header_bottom <?php echo esc_attr($header_bottom_class) ;?> clearfix" <?php edgt_inline_style($header_color_per_page); ?>>
				<?php if($header_in_grid){ ?>
				<div class="container">
					<div class="container_inner clearfix" <?php edgt_inline_style($header_bottom_border_style); ?>>
                    <?php if($edgt_options['overlapping_content'] == 'yes') {?><div class="overlapping_content_margin"><?php } ?>
						<?php } ?>
						<div class="header_inner_left">
							<?php if(edgt_is_main_menu_set()) { ?>
								<div class="mobile_menu_button"><span>
										<?php $edgtIconCollections->getMobileMenuIcon($edgt_options['header_icon_pack']); ?>
									</span>
								</div>
							<?php } ?>
							<?php if (!(isset($edgt_options['show_logo']) && $edgt_options['show_logo'] == "no")){ ?>
								<div class="logo_wrapper">
									<?php
									if (isset($edgt_options['logo_image']) && $edgt_options['logo_image'] != ""){ $logo_image = $edgt_options['logo_image'];}else{ $logo_image =  get_template_directory_uri().'/img/logo.png'; };
									if (isset($edgt_options['logo_image_light']) && $edgt_options['logo_image_light'] != ""){ $logo_image_light = $edgt_options['logo_image_light'];}else{ $logo_image_light =  get_template_directory_uri().'/img/logo.png'; };
									if (isset($edgt_options['logo_image_dark']) && $edgt_options['logo_image_dark'] != ""){ $logo_image_dark = $edgt_options['logo_image_dark'];}else{ $logo_image_dark =  get_template_directory_uri().'/img/logo_black.png'; };
									if (isset($edgt_options['logo_image_sticky']) && $edgt_options['logo_image_sticky'] != ""){ $logo_image_sticky = $edgt_options['logo_image_sticky'];}else{ $logo_image_sticky =  get_template_directory_uri().'/img/logo_black.png'; };
									if (isset($edgt_options['logo_image_popup']) && $edgt_options['logo_image_popup'] != ""){ $logo_image_popup = $edgt_options['logo_image_popup'];}else{ $logo_image_popup =  get_template_directory_uri().'/img/logo_white.png'; };
									if (isset($edgt_options['logo_image_mobile']) && $edgt_options['logo_image_mobile'] != ""){
										$logo_image_mobile = $edgt_options['logo_image_mobile'];
									}else{ 
										if(isset($edgt_options['logo_image']) && $edgt_options['logo_image'] != ""){
											$logo_image_mobile = $edgt_options['logo_image'];
										}else{ 
											$logo_image_mobile =  get_template_directory_uri().'/img/logo.png'; 
										}
									}
									?>
									<div class="edgt_logo"><a href="<?php echo esc_url(home_url('/')); ?>"><img class="normal" src="<?php echo esc_url($logo_image); ?>" alt="Logo"/><img class="light" src="<?php echo esc_url($logo_image_light); ?>" alt="Logo"/><img class="dark" src="<?php echo esc_url($logo_image_dark); ?>" alt="Logo"/><img class="sticky" src="<?php echo esc_url($logo_image_sticky); ?>" alt="Logo"/><img class="mobile" src="<?php echo esc_url($logo_image_mobile); ?>" alt="Logo"/><?php if($enable_popup_menu == 'yes'){ ?><img class="popup" src="<?php echo esc_url($logo_image_popup); ?>" alt="Logo"/><?php } ?></a></div>
								</div>
							<?php } ?>
						</div>


						<?php if($header_in_grid){ ?>
                        <?php if($edgt_options['overlapping_content'] == 'yes') {?></div><?php } ?>
					</div>
				</div>
			<?php } ?>
				<nav class="mobile_menu">
					<?php
					wp_nav_menu( array( 'theme_location' => 'top-navigation' ,
						'container'  => '',
						'container_class' => '',
						'menu_class' => '',
						'menu_id' => '',
						'fallback_cb' => 'top_navigation_fallback',
						'link_before' => '<span>',
						'link_after' => '</span>',
						'walker' => new edgt_type2_walker_nav_menu()
					));
					?>
				</nav>
			</div>
		</div>
	</header>
<?php } ?>

<?php if($edgt_options['show_back_button'] == "yes") {
    $edgt_back_to_top_button_styles = "";
    if(isset($edgt_options['back_to_top_position']) && !empty($edgt_options['back_to_top_position'])) {
        $edgt_back_to_top_button_styles = $edgt_options['back_to_top_position'];
    } ?>
	<?php if(!(isset($edgt_options['back_to_top_button_type']) && ($edgt_options['back_to_top_button_type']) =='triangle')) { ?>
		<a id='back_to_top' class="<?php echo esc_attr($edgt_back_to_top_button_styles);?>" href='#'>
			<span class="edgt_icon_stack">
				<?php if(isset($edgt_options['show_back_button_icon_set'])) {
					$edgtIconCollections->getBackToTopIcon($edgt_options['show_back_button_icon_set']);
				} ?>
			</span>
		</a>
	<?php } ?>
<?php } ?>


<?php if($enable_popup_menu == "yes"){
	?>
	<div class="popup_menu_holder_outer">
		<div class="popup_menu_holder">
			<div class="popup_menu_holder_inner">
			<?php if (isset($edgt_options['popup_in_grid']) && $edgt_options['popup_in_grid'] == "yes") { ?>
				<div class = "container_inner">
			<?php } ?>

				<?php if(is_active_sidebar('fullscreen_above_menu')) { ?>
					<div class="fullscreen_above_menu_widget_holder"><?php dynamic_sidebar('fullscreen_above_menu'); ?></div>
				<?php } ?>
				<nav class="popup_menu">
					<?php
					wp_nav_menu( array( 'theme_location' => 'popup-navigation' ,
						'container'  => '',
						'container_class' => '',
						'menu_class' => '',
						'menu_id' => '',
						'fallback_cb' => 'top_navigation_fallback',
						'link_before' => '<span>',
						'link_after' => '</span>',
						'walker' => new edgt_type3_walker_nav_menu()
					));
					?>
				</nav>
				<?php if(is_active_sidebar('fullscreen_menu')) { ?>
					<div class="fullscreen_menu_widget_holder"><?php dynamic_sidebar('fullscreen_menu'); ?></div>
				<?php } ?>
			<?php if (isset($edgt_options['popup_in_grid']) && $edgt_options['popup_in_grid'] == "yes") { ?>
				</div>
			<?php } ?>
			</div>
		</div>
	</div>
<?php } ?>

<?php if($enable_fullscreen_search=="yes"){ ?>
	<div class="fullscreen_search_holder fade">
		<div class="fullscreen_search_table">
			<div class="fullscreen_search_cell">
				<div class="fullscreen_search_inner">
					<form role="search" action="<?php echo esc_url(home_url('/')); ?>" class="fullscreen_search_form" method="get">
						<div class="form_holder">
							<span class="search_label"><?php _e('Search:', 'edgt'); ?></span>
							<div class="field_holder">
								<input type="text"  name="s" class="search_field" autocomplete="off" />
								<div class="line"></div>
							</div>
							<input type="submit" class="search_submit" value="&#x55;" />
						</div>	
					</form>
				</div>
			</div>
		</div>
	</div>
<?php } ?>


<?php
$content_class = "";
$is_title_area_visible = true;
if(get_post_meta($id, "edgt_show-page-title", true) == 'yes') {
	$is_title_area_visible = true;
} elseif(get_post_meta($id, "edgt_show-page-title", true) == 'no') {
	$is_title_area_visible = false;
} elseif(get_post_meta($id, "edgt_show-page-title", true) == '' && (isset($edgt_options['show_page_title']) && $edgt_options['show_page_title'] == 'yes')) {
	$is_title_area_visible = true;
} elseif(get_post_meta($id, "edgt_show-page-title", true) == '' && (isset($edgt_options['show_page_title']) && $edgt_options['show_page_title'] == 'no')) {
	$is_title_area_visible = false;
} elseif(isset($edgt_options['show_page_title']) && $edgt_options['show_page_title'] == 'yes') {
	$is_title_area_visible = true;
}

if((get_post_meta($id, "edgt_revolution-slider", true) == "" && ($header_transparency == '' || $header_transparency == 1))  || get_post_meta($id, "edgt_enable_content_top_margin", true) == "yes"){
	if($edgt_options['header_bottom_appearance'] == "fixed" || $edgt_options['header_bottom_appearance'] == "fixed_hiding" || $edgt_options['header_bottom_appearance'] == "fixed fixed_minimal"){
		$content_class = "content_top_margin";
	}else {
		$content_class = "content_top_margin_none";
	}
}

//check if there is slider added and set class to content div, this is used for content top margin in style_dynamic.php
if(get_post_meta($id, "edgt_revolution-slider", true) != ""){
    $content_class .= " has_slider";
}
?>

<?php
if(isset($edgt_options['paspartu']) && $edgt_options['paspartu'] == 'yes'){

$paspartu_additional_classes = "";
if(isset($edgt_options['paspartu_on_top']) && $edgt_options['paspartu_on_top'] == 'no'){
    $paspartu_additional_classes .= " disable_top_paspartu";
}
if(isset($edgt_options['paspartu_on_bottom']) && $edgt_options['paspartu_on_bottom'] == 'no'){
    $paspartu_additional_classes .= " disable_bottom_paspartu";
}
if(isset($edgt_options['paspartu_on_top']) && $edgt_options['paspartu_on_top'] == 'no' && isset($edgt_options['paspartu_on_bottom_slider']) && $edgt_options['paspartu_on_bottom_slider'] == 'yes'){
    $paspartu_additional_classes .= " paspartu_on_bottom_slider";
}
if(isset($edgt_options['paspartu_on_bottom']) && $edgt_options['paspartu_on_bottom'] == 'yes' && isset($edgt_options['paspartu_on_bottom_fixed']) && $edgt_options['paspartu_on_bottom_fixed'] == 'yes'){
    $paspartu_additional_classes .= " paspartu_on_bottom_fixed";
}
?>


<div class="paspartu_outer <?php echo esc_attr($paspartu_additional_classes); ?>">
    <?php if(isset($edgt_options['paspartu_on_top']) && $edgt_options['paspartu_on_top'] == 'yes' && isset($edgt_options['paspartu_on_top_fixed']) && $edgt_options['paspartu_on_top_fixed'] == 'yes'){ ?>
        <div class="paspartu_top"></div>
    <?php }?>
	<div class="paspartu_left"></div>
    <div class="paspartu_right"></div>
    <?php if(isset($edgt_options['paspartu_on_bottom']) && $edgt_options['paspartu_on_bottom'] == 'yes' && isset($edgt_options['paspartu_on_bottom_fixed']) && $edgt_options['paspartu_on_bottom_fixed'] == 'yes'){ ?>
        <div class="paspartu_bottom"></div>
    <?php }?>
    <div class="paspartu_inner">
<?php
}
?>

<div class="content <?php echo esc_attr($content_class); ?>">
	<?php
	$animation = get_post_meta($id, "edgt_show-animation", true);
	if (!empty($_SESSION['edgt_animation']) && $animation == "")
		$animation = $_SESSION['edgt_animation'];

	?>
	<?php if($edgt_options['page_transitions'] == "1" || $edgt_options['page_transitions'] == "2" || $edgt_options['page_transitions'] == "3" || $edgt_options['page_transitions'] == "4" || ($animation == "updown") || ($animation == "fade") || ($animation == "updown_fade") || ($animation == "leftright")){ ?>
		<div class="meta">
			<?php do_action('edgt_ajax_meta'); ?>
			<span id="edgt_page_id"><?php echo esc_html($wp_query->get_queried_object_id()); ?></span>
			<div class="body_classes"><?php echo esc_html(implode( ',', get_body_class())); ?></div>
		</div>
	<?php } ?>
	<div class="content_inner <?php echo esc_attr($animation);?> ">
		<?php if($edgt_options['page_transitions'] == "1" || $edgt_options['page_transitions'] == "2" || $edgt_options['page_transitions'] == "3" || $edgt_options['page_transitions'] == "4" || ($animation == "updown") || ($animation == "fade") || ($animation == "updown_fade") || ($animation == "leftright")){ ?>
		<?php do_action('edgt_visual_composer_custom_shortcodce_css');?>
	<?php } ?>