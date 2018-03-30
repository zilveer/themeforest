<?php 
global $qode_options;

/* Set id on -1 beacause archive page id can have same id as some post and settings is not good */
if(is_category() || is_tag() || is_author() || is_search() || is_404()){
	$archive_id = $id;
	$id = -1;
}

if(get_post_meta($id, "qode_responsive-title-image", true) != ""){
	$responsive_title_image = get_post_meta($id, "qode_responsive-title-image", true);
}else{
	$responsive_title_image = $qode_options['responsive_title_image'];
}

if(get_post_meta($id, "qode_fixed-title-image", true) != ""){
	$fixed_title_image = get_post_meta($id, "qode_fixed-title-image", true);
}else{
	$fixed_title_image = $qode_options['fixed_title_image'];
}

if(get_post_meta($id, "qode_title-image", true) != ""){
 $title_image = get_post_meta($id, "qode_title-image", true);
}else{
	$title_image = $qode_options['title_image'];
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
	$title_overlay_image = $qode_options['title_overlay_image'];
}

if (!empty($qode_options['header_height']) && $qode_options['header_bottom_appearance'] != "fixed_hiding") {
	$header_height = $qode_options['header_height'];
} elseif(!empty($qode_options['header_height']) && $qode_options['header_bottom_appearance'] == "fixed_hiding"){
	$header_height = $qode_options['header_height'] + 50; // 50 is logo height for fixed advanced header type
} elseif($qode_options['center_logo_image'] == "yes" && $qode_options['header_bottom_appearance'] != "stick" && $qode_options['header_bottom_appearance'] != "fixed_hiding") {
	$header_height = 190;
} elseif(empty($qode_options['header_height']) && $qode_options['header_bottom_appearance'] == "fixed_hiding"){
	$header_height = 222;
} else {
	$header_height = 100;
}

if (isset($qode_options['header_bottom_border_color']) && !empty($qode_options['header_bottom_border_color'])) {
	$header_height = $header_height + 1;
}
if($qode_options['header_bottom_appearance'] == 'stick menu_bottom'){
	$menu_bottom = '60';
	if(is_active_sidebar('header_fixed_right')){
		$menu_bottom = $menu_bottom + 26;
	}
} else {
	$menu_bottom = 0;
}
$nav_font_size = 7;
if(isset($qode_options['menu_fontsize']) && $qode_options['menu_fontsize'] != ""){
	$nav_font_size = $qode_options['menu_fontsize'] / 2;
}
$header_top = 0;
if(isset($qode_options['header_top_area']) && $qode_options['header_top_area'] == "yes"){
	$header_top = 33;
}
$header_height_padding = 0;
$header_height_padding = $header_height + $menu_bottom + $header_top;
if (isset($qode_options['center_logo_image']) && $qode_options['center_logo_image'] == "yes") {
    if(isset($qode_options['logo_image'])){
                $logo_width = 0;
                $logo_height = 0;
                if (!empty($qode_options['logo_image'])) {
                    $logo_url_obj = parse_url($qode_options['logo_image']);
                    list($logo_width, $logo_height, $logo_type, $logo_attr) = getimagesize($_SERVER['DOCUMENT_ROOT'].$logo_url_obj['path']);
                }
            }
    if($qode_options['header_bottom_appearance'] == 'stick menu_bottom'){
        $header_height_padding = $header_height + $menu_bottom + $header_top + $logo_height + 20; // 20 is top margin of centered logo
    } else if($qode_options['header_bottom_appearance'] == 'fixed_hiding' || $qode_options['header_bottom_appearance'] == 'fixed'){
        if(!empty($qode_options['header_height']) && $qode_options['header_bottom_appearance'] == "fixed"){
        	$header_height_padding = $header_height + $header_top + $logo_height + 20;
        } else {
        	$header_height_padding = $header_height + $header_top;
        }
    } else {
        $header_height_padding = $header_height + $header_top + $logo_height + 20; // 20 is top margin of centered logo
    }
}
$title_type = "standard_title";
if(get_post_meta($id, "qode_page_title_type", true) != ""){
    $title_type = get_post_meta($id, "qode_page_title_type", true);
}else{
    if(isset($qode_options['title_type'])){
        $title_type = $qode_options['title_type'];
    }
}
if(is_404()){
	$title_type = "breadcrumbs_title";
}

//init variables
$title_subtitle_padding 	= '';
$header_transparency 		= '';
$is_header_transparent  	= false;
$transparent_values_array 	= array('0.00', '0');
$solid_values_array			= array('', '1');
$header_bottom_border		= '';
$is_title_area_visible		= true;

//this is done this way because content was already created
//and we had to keep current settings for existing pages
//checkbox that was previously here had 'yes' value when title area is hidden
if(get_post_meta($id, "qode_show-page-title", true) == 'yes') {
	$is_title_area_visible = true;
} elseif(get_post_meta($id, "qode_show-page-title", true) == 'no') {
	$is_title_area_visible = false;
} elseif(get_post_meta($id, "qode_show-page-title", true) == '' && (isset($qode_options['show_page_title']) && $qode_options['show_page_title'] == 'yes')) {
	$is_title_area_visible = true;
} elseif(get_post_meta($id, "qode_show-page-title", true) == '' && (isset($qode_options['show_page_title']) && $qode_options['show_page_title'] == 'no')) {
	$is_title_area_visible = false;
} elseif(isset($qode_options['show_page_title']) && $qode_options['show_page_title'] == 'yes') {
	$is_title_area_visible = true;
}

//is header transparent not set on current page?
if(get_post_meta($id, "qode_header_color_transparency_per_page", true) === "") {
	//take global value set in Qode Options
	$header_transparency = $qode_options['header_background_transparency_initial'];
} else {
	//take value set for current page
	$header_transparency = get_post_meta($id, "qode_header_color_transparency_per_page", true);
}

//is header completely transparent?
$is_header_transparent 	= in_array($header_transparency, $transparent_values_array);

//is header solid?
$is_header_solid		= in_array($header_transparency, $solid_values_array);

$title_height = 330; // default title height without header height
if($title_type == "breadcrumbs_title") {
    $title_height = 88;
}

if(get_post_meta($id, "qode_title-height", true) != ""){
	$title_height = get_post_meta($id, "qode_title-height", true);
}elseif($qode_options['title_height'] != ''){
	$title_height = $qode_options['title_height'];
}

if($title_type == "breadcrumbs_title" && !$is_header_solid && qode_is_content_below_header() == false){
	if ((isset($qode_options['center_logo_image']) && $qode_options['center_logo_image'] == "yes") || $qode_options['header_bottom_appearance'] == 'fixed_hiding') {
		if($qode_options['header_bottom_appearance'] == 'stick menu_bottom'){
	        $title_height = $title_height + $header_height + $menu_bottom + $header_top + $logo_height + 20; // 20 is top margin of centered logo
	    } elseif($qode_options['header_bottom_appearance'] == 'fixed_hiding' || $qode_options['header_bottom_appearance'] == 'fixed'){
	        if(!empty($qode_options['header_height']) && $qode_options['header_bottom_appearance'] == "fixed"){
	        	$title_height = $title_height + $header_height + $header_top + $logo_height + 20;
	        } else {
	        	$title_height = $title_height + $header_height + $header_top;
	        }
	    } else {
	        $title_height = $title_height + $header_height + $header_top + $logo_height + 20; // 20 is top margin of centered logo
	    }
	} else {
		$title_height = $title_height + $header_height + $menu_bottom + $header_top;
	}
}



$title_background_color = '';
if(get_post_meta($id, "qode_page-title-background-color", true) != ""){
 $title_background_color = get_post_meta($id, "qode_page-title-background-color", true);
}else{
	$title_background_color = $qode_options['title_background_color'];
}

$show_title_image = true;
if(get_post_meta($id, "qode_show-page-title-image", true) == "yes") {
	$show_title_image = false;
}
$qode_page_title_style = "standard";
if(get_post_meta($id, "qode_page_title_style", true) != ""){
	$qode_page_title_style = get_post_meta($id, "qode_page_title_style", true);
}else{
	if(isset($qode_options['title_style'])) {
		$qode_page_title_style = $qode_options['title_style'];
	} else {
		$qode_page_title_style = "standard";
	}
}

$animate_title_area = '';
if(get_post_meta($id, "qode_animate-page-title", true) != ""){
	$animate_title_area = get_post_meta($id, "qode_animate-page-title", true);
}else{
	$animate_title_area = $qode_options['animate_title_area'];
}

if($animate_title_area == "text_right_left") {
	$animate_title_class = "animate_title_text";
} elseif($animate_title_area == "area_top_bottom"){
	$animate_title_class = "animate_title_area";
} else {
	$animate_title_class = "title_without_animation";
}

//is border bottom color for header set in Qode Options?
if(isset($qode_options['header_bottom_border_color']) && !empty($qode_options['header_bottom_border_color'])) {
	$header_bottom_border = $qode_options['header_bottom_border_color'];
}

//is header solid?
if($title_type == "breadcrumbs_title" && !$is_header_solid  && qode_is_content_below_header() == false){
	//is header semi-transparent?
	if(!$is_header_transparent) {
		$title_calculated_height = $title_height - $header_height_padding;

		if($title_calculated_height < 0) {
			$title_calculated_height = 0;
		}

		//center title between border and end of title section
		$title_holder_height = 'style="padding-top:' . $header_height_padding . 'px;height:' . ($title_calculated_height) . 'px;"';
		$title_subtitle_padding = 'style="padding-top:' . $header_height_padding . 'px;"';
	} else {
		//header is transparent
		$title_holder_height = 'style="padding-top:'.$header_height_padding.'px;height:'.($title_height - $header_height_padding).'px;"';
		$title_subtitle_padding = 'style="padding-top:'.$header_height_padding.'px;"';
	}
} else {
	$title_holder_height = 'style="height:'.$title_height.'px;"';
	$title_subtitle_padding = '';
}


//is vertical menu activated in Qode Options?
if(isset($qode_options['vertical_area']) && $qode_options['vertical_area'] =='yes'){
    $title_subtitle_padding = 0;
    $title_holder_height = 330;
    if($title_type == "breadcrumbs_title") {
        $title_holder_height = 100;
    }
    $title_height = 330; // default title height without header height
    if($title_type == "breadcrumbs_title") {
        $title_height = 100;
    }
    if(get_post_meta($id, "qode_title-height", true) != ""){
        $title_holder_height = get_post_meta($id, "qode_title-height", true);
        $title_height = get_post_meta($id, "qode_title-height", true);
    }else if($qode_options['title_height'] != ''){
        $title_holder_height = $qode_options['title_height'];
        $title_height = $qode_options['title_height'];
    }
    $title_holder_height = 'style="height:' . $title_holder_height . 'px;"';
}

$enable_breadcrumbs = 'no';
if(get_post_meta($id, "qode_enable_breadcrumbs", true) != ""){
	$enable_breadcrumbs = get_post_meta($id, "qode_enable_breadcrumbs", true);
}elseif(isset($qode_options['enable_breadcrumbs'])){
	$enable_breadcrumbs = $qode_options['enable_breadcrumbs'];
}

$title_text_shadow = '';
if(get_post_meta($id, "qode_title_text_shadow", true) != ""){
	if(get_post_meta($id, "qode_title_text_shadow", true) == "yes"){
		$title_text_shadow = ' title_text_shadow';
	}
}else{
	if($qode_options['title_text_shadow'] == "yes"){
		$title_text_shadow = ' title_text_shadow';
	}
}
$subtitle_color ="";
if(get_post_meta($id, "qode_page_subtitle_color", true) != ""){
	$subtitle_color = " style='color:" . get_post_meta($id, "qode_page_subtitle_color", true) . "'";
} else {
	$subtitle_color = "";
}

if (is_tag()) {
	$title = single_term_title("", false)." Tag";
}elseif (is_date()) {
	$title = get_the_time('F Y');
}elseif (is_author()){
	$title = __('Author:', 'qode').get_the_author();
}elseif (is_category()){
	$title = single_cat_title('', false);
}elseif (is_home()){
	$title = get_option('blogname');
}elseif (is_search()){
	$title = __('Search', 'qode');
}elseif (is_404()){
	if($qode_options['404_title'] != "") {
		$title = $qode_options['404_title'];
	} else { 
		$title = __('404 - Page not found', 'qode');
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

$title_classes = '';

if(get_post_meta($id, "qode_show-page-title-text", true) == 'yes') {
	$title_classes = 'without_title_text';
}

$title_text_style = array();
if(get_post_meta($id, "qode_page-title-color", true) != '') {
	$title_text_style[] = 'color: ' .  get_post_meta($id, "qode_page-title-color", true);
}
if(get_post_meta($id, "qode_page-title-text-background-color", true) != '') {
	$original_color = get_post_meta($id, "qode_page-title-text-background-color", true);
	$rgb_color = qode_hex2rgb($original_color);
	if(get_post_meta($id, "qode_page-title-text-background-opacity", true) != '') {
		$opacity = get_post_meta($id, "qode_page-title-text-background-opacity", true);
	} elseif(isset($qode_options['title_text_background_opacity']) && $qode_options['title_text_background_opacity'] !='') {
		$opacity = $qode_options['title_text_background_opacity'];
	}
	else {
		$opacity = 1;
	}
	$title_text_style[] = 'background-color: rgba(' . $rgb_color[0] . ',' . $rgb_color[1] . ',' . $rgb_color[2] . ',' . $opacity . ')';
} elseif(isset($qode_options['title_text_background_color']) && $qode_options['title_text_background_color'] !='') {
	$original_color = $qode_options['title_text_background_color'];
	$rgb_color = qode_hex2rgb($original_color);
	if(get_post_meta($id, "qode_page-title-text-background-opacity", true) != '') {
		$opacity = get_post_meta($id, "qode_page-title-text-background-opacity", true);
	} elseif(isset($qode_options['title_text_background_opacity']) && $qode_options['title_text_background_opacity'] !='') {
		$opacity = $qode_options['title_text_background_opacity'];
	}
	else {
		$opacity = 1;
	}
	$title_text_style[] = 'background-color: rgba(' . $rgb_color[0] . ',' . $rgb_color[1] . ',' . $rgb_color[2] . ',' . $opacity . ')';
}


if($is_title_area_visible) { ?>
	<div class="title_outer <?php echo esc_attr($animate_title_class); ?> <?php echo esc_attr($title_text_shadow); ?> <?php if($responsive_title_image == 'yes' && $show_title_image == true && $title_image !== ''){ echo ' with_image'; }?>" <?php echo 'data-height="'.esc_attr($title_height).'"'; if($title_height != '' && $animate_title_area == 'area_top_bottom'){ echo 'style="opacity:0;height:' . esc_attr($header_height_padding) .'px;"'; } ?>>
		<div class="title <?php qode_title_classes(); ?>" style="<?php if($responsive_title_image == 'no' && $title_image != "" && $show_title_image == true){ if($title_image_width != ''){ echo 'background-size:'.$title_image_width.'px auto;'; } echo 'background-image:url('.$title_image.');';  } if($title_height != ''){ echo 'height:'.$title_height.'px;'; } if($title_background_color != ''){ echo 'background-color:'.$title_background_color.';'; } ?>">
			<div class="image <?php if($responsive_title_image == 'yes' && $title_image != "" && $show_title_image == true){ echo "responsive"; }else{ echo "not_responsive"; } ?>"><?php if($title_image != ""){ ?><img src="<?php echo esc_url($title_image); ?>" alt="&nbsp;" /> <?php } ?></div>
			<?php if($title_overlay_image != ""){ ?>
				<div class="title_overlay" style="background-image:url('<?php echo esc_url($title_overlay_image); ?>');"></div>
			<?php } ?>

				<div class="title_holder" <?php if(($title_image !== '' && $responsive_title_image != 'yes' && $show_title_image == true) || ($title_type == 'breadcrumbs_title' && $title_image == '')){ echo wp_kses($title_holder_height, array('style')); }?>>
					<div class="container">
						<div class="container_inner clearfix">
								<div class="title_subtitle_holder" <?php if($title_image !== '' && $responsive_title_image == 'yes' && $show_title_image == true){ echo wp_kses($title_subtitle_padding, array('style')); }?>>
								<?php if(($responsive_title_image == 'yes' && $show_title_image == true) || ($fixed_title_image == "yes" || $fixed_title_image == "yes_zoom") || ($responsive_title_image == 'no' && $title_image != "" && $fixed_title_image == "no" && $show_title_image == true)){ ?>
									<div class="title_subtitle_holder_inner">
								<?php } ?>

                                    <?php if($title_type != "breadcrumbs_title") { ?>

                                        <?php if(get_post_meta($id, "qode_show-page-title-text", true) !== 'yes') { ?>
                                            <h1<?php if(is_array($title_text_style) && count($title_text_style)) { ?> style="<?php echo implode(';', $title_text_style); ?>" <?php } ?>><span><?php echo esc_html($title); ?></span></h1>
                                        <?php } ?>

                                        <?php if(get_post_meta($id, "qode_page_subtitle", true) != ""){ ?>
                                            <span class="subtitle" <?php echo wp_kses($subtitle_color, array('style')); ?>><?php echo get_post_meta($id, "qode_page_subtitle", true); ?></span>
                                        <?php } ?>
                                        <?php if (function_exists('qode_custom_breadcrumbs') && $enable_breadcrumbs == "yes") { ?>
                                            <div class="breadcrumb"> <?php qode_custom_breadcrumbs(); ?></div>
                                        <?php } ?>

                                    <?php } else { ?>

                                        <div class="breadcrumb"> <?php qode_custom_breadcrumbs(); ?></div>

                                    <?php } ?>
								</div>
								<?php if(($responsive_title_image == 'yes' && $show_title_image == true)  || ($fixed_title_image == "yes" || $fixed_title_image == "yes_zoom") || ($responsive_title_image == 'no' && $title_image != "" && $fixed_title_image == "no" && $show_title_image == true)){ ?>
									</div>
								<?php } ?>
						</div>
					</div>
				</div>
		</div>
	</div>
<?php } ?>
<?php
	/* Return id for archive pages */
	if(is_category() || is_tag() || is_author() || is_search() || is_404()){
		$id = $archive_id;
	}
?>