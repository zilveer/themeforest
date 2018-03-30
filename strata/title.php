<?php 
global $qode_options_theme13;

if(get_post_meta($id, "qode_responsive-title-image", true) != ""){
 $responsive_title_image = get_post_meta($id, "qode_responsive-title-image", true);
}else{
	$responsive_title_image = $qode_options_theme13['responsive_title_image'];
}

if(get_post_meta($id, "qode_fixed-title-image", true) != ""){
 $fixed_title_image = get_post_meta($id, "qode_fixed-title-image", true);
}else{
	$fixed_title_image = $qode_options_theme13['fixed_title_image'];
}

if(get_post_meta($id, "qode_title-image", true) != ""){
 $title_image = get_post_meta($id, "qode_title-image", true);
}else{
	$title_image = $qode_options_theme13['title_image'];
}
$title_image_height = "";
$title_image_width = "";
if(!empty($title_image)){
	$title_image_url_obj = parse_url($title_image);
  if (file_exists($_SERVER['DOCUMENT_ROOT'].$title_image_url_obj['path']))
		list($title_image_width, $title_image_height, $title_image_type, $title_image_attr) = getimagesize($_SERVER['DOCUMENT_ROOT'].$title_image_url_obj['path']);
}

if(get_post_meta($id, "qode_title-overlay-image", true) != ""){
 $title_overlay_image = get_post_meta($id, "qode_title-overlay-image", true);
}else{
	$title_overlay_image = $qode_options_theme13['title_overlay_image'];
}

$header_height_padding = 0;
if (!empty($qode_options_theme13['header_height'])) {
	$header_height = $qode_options_theme13['header_height'];
} else {
	$header_height = 86;
}
if($qode_options_theme13['header_bottom_appearance'] == 'stick menu_bottom'){
	$menu_bottom = '46';
	if(is_active_sidebar('header_fixed_right')){
		$menu_bottom = $menu_bottom + 22;
	}
} else {
	$menu_bottom = 0;
}

$header_top = 0;
if(isset($qode_options_theme13['header_top_area']) && $qode_options_theme13['header_top_area'] == "yes"){
	$header_top = 34;	
}
$header_height_padding = $header_height + $menu_bottom + $header_top;
if (isset($qode_options_theme13['center_logo_image']) && $qode_options_theme13['center_logo_image'] == "yes") { 
		if(isset($qode_options_theme13['logo_image'])){
					$logo_width = 0;
					$logo_height = 0;
					if (!empty($qode_options_theme13['logo_image'])) {
						$logo_url_obj = parse_url($qode_options_theme13['logo_image']); 
						list($logo_width, $logo_height, $logo_type, $logo_attr) = getimagesize($_SERVER['DOCUMENT_ROOT'].$logo_url_obj['path']);  
					} 
				}
		if($qode_options_theme13['header_bottom_appearance'] == 'stick menu_bottom'){
			$header_height_padding = $logo_height + 30 + $menu_bottom + $header_top; // 30 is top and bottom margin of centered logo
		} else {
			$header_height_padding = $logo_height + 30 + $header_height + $header_top; // 30 is top and bottom margin of centered logo
		}
	} 
$title_height = 85;
if(get_post_meta($id, "qode_title-height", true) != ""){
	$title_height = get_post_meta($id, "qode_title-height", true);
}else if($qode_options_theme13['title_height'] != ''){
	$title_height = $qode_options_theme13['title_height'];
}else {
	if (isset($qode_options_theme13['center_logo_image']) && $qode_options_theme13['center_logo_image'] == "yes") { 
		if($qode_options_theme13['header_bottom_appearance'] == 'stick menu_bottom'){
			$title_height = $title_height + $logo_height + 30 + $menu_bottom + $header_top; // 30 is top and bottom margin of centered logo
		} else {
			$title_height = $header_height + $title_height + $logo_height + 30 + $header_top; // 30 is top and bottom margin of centered logo
		}
		
		
	} else {
		$title_height = $title_height + $header_height + $menu_bottom + $header_top;

	 }
}
if(get_post_meta($id, "qode_fixed-title-image", true) != ""){
 $fixed_title_image = get_post_meta($id, "qode_fixed-title-image", true);
}else{
	$fixed_title_image = $qode_options_theme13['fixed_title_image'];
}

$title_background_color = '';
if(get_post_meta($id, "qode_page-title-background-color", true) != ""){
 $title_background_color = get_post_meta($id, "qode_page-title-background-color", true);
}else{
	$title_background_color = $qode_options_theme13['title_background_color'];
}

$show_title_image = true;
if(get_post_meta($id, "qode_show-page-title-image", true)) {
	$show_title_image = false;
}
$qode_page_title_style = "standard";
if(get_post_meta($id, "qode_page_title_style", true) != ""){
	$qode_page_title_style = get_post_meta($id, "qode_page_title_style", true);
}else{
	if(isset($qode_options_theme13['title_style'])) {
		$qode_page_title_style = $qode_options_theme13['title_style'];
	} else {
		$qode_page_title_style = "standard";
	}
}

$animate_title_area = '';
if(get_post_meta($id, "qode_animate-page-title", true) != ""){
	$animate_title_area = get_post_meta($id, "qode_animate-page-title", true);
}else{
	$animate_title_area = $qode_options_theme13['animate_title_area'];
}

if($animate_title_area == "text_right_left") {
	$animate_title_class = "animate_title_text";
} elseif($animate_title_area == "area_top_bottom"){
	$animate_title_class = "animate_title_area";
} else {
	$animate_title_class = "title_without_animation";
}


$enable_breadcrumbs = 'yes';
if(get_post_meta($id, "qode_enable_breadcrumbs", true) != ""){
	$enable_breadcrumbs = get_post_meta($id, "qode_enable_breadcrumbs", true);
}elseif(isset($qode_options_theme13['enable_breadcrumbs'])){
	$enable_breadcrumbs = $qode_options_theme13['enable_breadcrumbs'];
}

$page_title_fontsize = '';
if(get_post_meta($id, "qode_page_title_font_size", true) != ""){
	$page_title_fontsize = "title_size_" . get_post_meta($id, "qode_page_title_font_size", true);
}else{
	if(isset($qode_options_theme13['predefined_title_sizes'])) {
		$page_title_fontsize = "title_size_" . $qode_options_theme13['predefined_title_sizes'];
	}
}
$title_subtitle_padding ="";
if(get_post_meta($id, "qode_header_color_transparency_per_page", true) == ""){
	if($qode_options_theme13['header_background_transparency_initial'] == "" || $qode_options_theme13['header_background_transparency_initial'] == "1"){
		$title_holder_height = 'style="padding-top:' . $header_height_padding . 'px;height:' . ($title_height - $header_height_padding) . 'px;"';
		$title_subtitle_padding = 'style="padding-top:' . $header_height_padding . 'px;"';
	} else {
		$title_holder_height = 'style="padding-top:0px;height:' . $title_height . 'px;"';
		$title_subtitle_padding = 'style="padding-top:0px;"';
	}
} elseif(get_post_meta($id, "qode_header_color_transparency_per_page", true) == "1") {
	$title_holder_height = 'style="padding-top:' . $header_height_padding . 'px;height:' . ($title_height - $header_height_padding) . 'px;"';
	$title_subtitle_padding = 'style="padding-top:' . $header_height_padding . 'px;"';
} else {
	
	$title_holder_height = 'style="padding-top:0px;height:' . $title_height . 'px;"';
	$title_subtitle_padding = 'style="padding-top:0px;"';
}

$page_title_position = 'left';
if(get_post_meta($id, "qode_page_title_position", true) != ""){
	$page_title_position = get_post_meta($id, "qode_page_title_position", true);
}else{
	$page_title_position = $qode_options_theme13['page_title_position'];
}
if($page_title_position == "center"){
	$page_title_position = "position_center ";
} else {
	$page_title_position = "position_left ";
}

$title_text_shadow = '';
if(get_post_meta($id, "qode_title_text_shadow", true) != ""){
	if(get_post_meta($id, "qode_title_text_shadow", true) == "yes"){
		$title_text_shadow = ' title_text_shadow';
	}
}else{
	if($qode_options_theme13['title_text_shadow'] == "yes"){
		$title_text_shadow = ' title_text_shadow';
	}
}
$subtitle_color ="";
if(get_post_meta($id, "qode_page_subtitle_color", true) != ""){
	$subtitle_color = " style='color:" . get_post_meta($id, "qode_page_subtitle_color", true) . "';";
} else {
	$subtitle_color = "";
}

if (is_tag()) {
	$title = single_term_title("", false)." Tag";
}elseif (is_date()) {
	$title = get_the_time('F Y');
}elseif (is_author()){
	$title = "Author: ".get_the_author();
}elseif (is_category()){
	$title = single_cat_title('', false);
}elseif (is_home()){
	$title = get_option('blogname');
}elseif (is_search()){
	$title = __('Search', 'qode');
}elseif (is_404()){
	if($qode_options_theme13['404_title'] != "") {
		$title = $qode_options_theme13['404_title']; 
	} else { 
		$title = __('404', 'qode');
	}
	if($qode_options_theme13['404_subtitle'] != "") {
		$title  .= $qode_options_theme13['404_subtitle']; 
	} else { 
		$title .= " - " . __('Page not found', 'qode');
	}
}elseif(function_exists("is_woocommerce") && (is_shop() || is_singular('product'))){
	global $woocommerce;
	$shop_id = get_option('woocommerce_shop_page_id');
	$shop= get_page($shop_id);
	$title = $shop->post_title;
}elseif(function_exists("is_woocommerce") && (is_product_category() || is_product_tag())){
	global $wp_query;
	$tax = $wp_query->get_queried_object();
	$category_title = $tax->name;
	$title = $category_title;
}elseif (is_archive()){
	$title = __('Archive','qode');
}else {
	$title = get_the_title($id);
}

if(!get_post_meta($id, "qode_show-page-title", true)) { ?>
	<div class="title_outer <?php echo $animate_title_class.$title_text_shadow; if($responsive_title_image == 'yes' && $show_title_image == true){ echo ' with_image'; }?>" <?php echo 'data-height="'.$title_height.'"'; if($title_height != '' && $animate_title_area == 'area_top_bottom'){ echo 'style="opacity:0;height:' . $header_height_padding .'px;"'; } ?>>
		<div class="title <?php echo $page_title_fontsize . " " . $page_title_position; if($responsive_title_image == 'no' && $title_image != "" && ($fixed_title_image == "yes" || $fixed_title_image == "yes_zoom") && $show_title_image == true){ echo 'has_fixed_background '; if($fixed_title_image == "yes_zoom"){ echo 'zoom_out '; } } if($responsive_title_image == 'no' && $title_image != "" && $fixed_title_image == "no" && $show_title_image == true){ echo 'has_background'; }  ?>" style="<?php if($responsive_title_image == 'no' && $title_image != "" && $show_title_image == true){ if($title_image_width != ''){ echo 'background-size:'.$title_image_width.'px auto;'; } echo 'background-image:url('.$title_image.');';  } if($title_height != ''){ echo 'height:'.$title_height.'px;'; } if($title_background_color != ''){ echo 'background-color:'.$title_background_color.';'; } ?>">
			<div class="image <?php if($responsive_title_image == 'yes' && $title_image != "" && $show_title_image == true){ echo "responsive"; }else{ echo "not_responsive"; } ?>"><?php if($title_image != ""){ ?><img src="<?php echo $title_image; ?>" alt="&nbsp;" /> <?php } ?></div>
			<?php if($title_overlay_image != ""){ ?>
				<div class="title_overlay" style="background-image:url('<?php echo $title_overlay_image; ?>');"></div>
			<?php } ?>
			<?php if(!get_post_meta($id, "qode_show-page-title-text", true)) { ?>
				<div class="title_holder" <?php if($responsive_title_image != 'yes' && get_post_meta($id, "qode_show-page-title-image", true) == ""){ echo $title_holder_height; }?>>
					<div class="container">
						<div class="container_inner clearfix">
								<div class="title_subtitle_holder" <?php if($responsive_title_image == 'yes' && $show_title_image == true){ echo $title_subtitle_padding; }?>>
								<?php if(($responsive_title_image == 'yes' && $show_title_image == true) || ($fixed_title_image == "yes" || $fixed_title_image == "yes_zoom") || ($responsive_title_image == 'no' && $title_image != "" && $fixed_title_image == "no" && $show_title_image == true)){ ?>
									<div class="title_subtitle_holder_inner">
								<?php } ?>
									<h1<?php if(get_post_meta($id, "qode_page-title-color", true)) { ?> style="color:<?php echo get_post_meta($id, "qode_page-title-color", true) ?>" <?php } ?>><span><?php echo $title; ?></span></h1>
									<?php if(get_post_meta($id, "qode_page_subtitle", true) != ""){ ?>
										<span class="subtitle" <?php echo $subtitle_color; ?>><?php echo get_post_meta($id, "qode_page_subtitle", true); ?></span>
									<?php } ?>
								
									<?php if (function_exists('qode_custom_breadcrumbs') && $enable_breadcrumbs == "yes") { ?>
											<div class="breadcrumb"> <?php qode_custom_breadcrumbs(); ?></div>
									<?php } ?>
								</div>
								<?php if(($responsive_title_image == 'yes' && $show_title_image == true)  || ($fixed_title_image == "yes" || $fixed_title_image == "yes_zoom") || ($responsive_title_image == 'no' && $title_image != "" && $fixed_title_image == "no" && $show_title_image == true)){ ?>
									</div>
								<?php } ?>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
<?php } ?>