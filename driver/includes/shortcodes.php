<?php

function iron_shortcode_audioplayer( $atts ) {

	extract( shortcode_atts( array(
	  'title' => '',
	  'albums' => '',
	  'autoplay' => '',
	  'show_playlist' => '',
	  'action_title' => '',
	  'action_obj_id' => '',
	  'action_ext_link' => '',
	  'css_animation' => '',
	), $atts ) );

   	ob_start();
	$uppercase_option = Iron_Widget::is_widget_title_uppercase();
	if($uppercase_option == true){
		$isuppercase = 'uppercase';
	} else {
		$isuppercase = '';
	};
    the_widget('Iron_Widget_Radio', $atts, array('widget_id'=>'arbitrary-instance-'.uniqid(), 'before_widget'=>'<div class="widget '.$isuppercase.' iron_widget_radio '.$css_animation.'">', 'after_widget'=>'</div>'));
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
add_shortcode( 'iron_audioplayer', 'iron_shortcode_audioplayer' );

function iron_shortcode_discography( $atts ) {

	extract( shortcode_atts( array(
	  'title' => '',
	  'albums' => '',
	  'action_title' => '',
	  'action_obj_id' => '',
	  'action_ext_link' => '',
	  'css_animation' => '',
	), $atts ) );

   	ob_start();
	$uppercase_option = Iron_Widget::is_widget_title_uppercase();
	if($uppercase_option == true){
		$isuppercase = 'uppercase';
	} else {
		$isuppercase = '';
	};
    the_widget('Iron_Widget_Discography', $atts, array('widget_id'=>'arbitrary-instance-'.uniqid(), 'before_widget'=>'<div class="widget '.$isuppercase.' iron_widget_discography '.$css_animation.'">', 'after_widget'=>'</div>'));
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
add_shortcode( 'iron_discography', 'iron_shortcode_discography' );


function iron_shortcode_twitter( $atts ) {

	extract( shortcode_atts( array(
	  'title' => '',
	  'screen_name' => '',
	  'action_title' => '',
	  'action_obj_id' => '',
	  'action_ext_link' => '',
	  'css_animation' => '',
	), $atts ) );

   	ob_start();
	$uppercase_option = Iron_Widget::is_widget_title_uppercase();
	if($uppercase_option == true){
		$isuppercase = 'uppercase';
	} else {
		$isuppercase = '';
	};
    the_widget('Iron_Widget_Twitter', $atts, array('widget_id'=>'arbitrary-instance-'.uniqid(), 'before_widget'=>'<div class="widget '.$isuppercase.' iron_widget_twitter '.$css_animation.'">', 'after_widget'=>'</div>'));
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
add_shortcode( 'iron_twitter', 'iron_shortcode_twitter' );


function iron_shortcode_posts( $atts ) {

	extract( shortcode_atts( array(
	  'title' => '',
	  'number' => '',
	  'show_date' => 1,
	  'enable_excerpts' => 0,
	  'category' => '',
	  'view' => '',
	  'action_title' => '',
	  'action_obj_id' => '',
	  'action_ext_link' => '',
	  'css_animation' => '',
	), $atts ) );

   	ob_start();
	$uppercase_option = Iron_Widget::is_widget_title_uppercase();
	if($uppercase_option == true){
		$isuppercase = 'uppercase';
	} else {
		$isuppercase = '';
	};
    the_widget('Iron_Widget_Posts', $atts, array('widget_id'=>'arbitrary-instance-'.uniqid(), 'before_widget'=>'<div class="widget '.$isuppercase.' iron_widget_posts '.$css_animation.'">', 'after_widget'=>'</div>'));
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
add_shortcode( 'iron_posts', 'iron_shortcode_posts' );


function iron_shortcode_videos( $atts ) {

	extract( shortcode_atts( array(
	  'title' => '',
	  'number' => '',
	  'category' => '',
	  'view' => '',
	  'action_title' => '',
	  'action_obj_id' => '',
	  'action_ext_link' => '',
	  'css_animation' => '',
	), $atts ) );

   	ob_start();
	$uppercase_option = Iron_Widget::is_widget_title_uppercase();
	if($uppercase_option == true){
		$isuppercase = 'uppercase';
	} else {
		$isuppercase = '';
	};
    the_widget('Iron_Widget_Videos', $atts, array('widget_id'=>'arbitrary-instance-'.uniqid(), 'before_widget'=>'<div class="widget '.$isuppercase.' iron_widget_videos '.$css_animation.'">', 'after_widget'=>'</div>'));
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
add_shortcode( 'iron_recentvideos', 'iron_shortcode_videos' );


function iron_shortcode_photos( $atts ) {

	extract( shortcode_atts( array(
	  'title' => '',
	  'albums' => '',
	  'gallery_layout' => '',
	  'gallery_height' => '',
	  'action_title' => '',
	  'action_obj_id' => '',
	  'action_ext_link' => '',
	  'css_animation' => '',
	), $atts ) );

   	ob_start();
	$uppercase_option = Iron_Widget::is_widget_title_uppercase();
	if($uppercase_option == true){
		$isuppercase = 'uppercase';
	} else {
		$isuppercase = '';
	};
    the_widget('Iron_Widget_Photos', $atts, array('widget_id'=>'arbitrary-instance-'.uniqid(), 'before_widget'=>'<div class="widget '.$isuppercase.' iron_widget_photos '.$css_animation.'">', 'after_widget'=>'</div>'));
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
add_shortcode( 'iron_featuredphotos', 'iron_shortcode_photos' );


function iron_shortcode_iosslider( $atts ) {

	extract( shortcode_atts( array(
	  'title' => '',
	  'id' => '',
	  'css_animation' => '',
	), $atts ) );

   	ob_start();
	$uppercase_option = Iron_Widget::is_widget_title_uppercase();
	if($uppercase_option == true){
		$isuppercase = 'uppercase';
	} else {
		$isuppercase = '';
	};
    the_widget('Iron_Widget_Ios_Slider', $atts, array('widget_id'=>'arbitrary-instance-'.uniqid(), 'before_widget'=>'<div class="widget '.$isuppercase.' iron_widget_iosslider '.$css_animation.'">', 'after_widget'=>'</div>'));
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
add_shortcode( 'iron_iosslider', 'iron_shortcode_iosslider' );


function iron_shortcode_events( $atts ) {

	extract( shortcode_atts( array(
	  'title' => '',
	  'number' => '',
	  'show_date' => null,
	  'action_title' => '',
	  'action_obj_id' => '',
	  'action_ext_link' => '',
	  'css_animation' => '',
	), $atts ) );

   	ob_start();
	$uppercase_option = Iron_Widget::is_widget_title_uppercase();
	if($uppercase_option == true){
		$isuppercase = 'uppercase';
	} else {
		$isuppercase = '';
	};
    the_widget('Iron_Widget_Events', $atts, array('widget_id'=>'arbitrary-instance-'.uniqid(), 'before_widget'=>'<div class="widget '.$isuppercase.' iron_widget_events '.$css_animation.'">', 'after_widget'=>'</div>'));
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
add_shortcode( 'iron_events', 'iron_shortcode_events' );


function iron_shortcode_newsletter( $atts ) {

	extract( shortcode_atts( array(
	  'title' => '',
	  'description' => '',
	  'fid' => '',
	  'css_animation' => '',
	), $atts ) );

   	ob_start();
	$uppercase_option = Iron_Widget::is_widget_title_uppercase();
	if($uppercase_option == true){
		$isuppercase = 'uppercase';
	} else {
		$isuppercase = '';
	};
    the_widget('Iron_Widget_Newsletter', $atts, array('widget_id'=>'arbitrary-instance-'.uniqid(), 'before_widget'=>'<div class="widget '.$isuppercase.' iron_widget_newsletter '.$css_animation.'">', 'after_widget'=>'</div>'));
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}
add_shortcode( 'iron_newsletter', 'iron_shortcode_newsletter' );

function iron_shortcode_promotion( $atts ) {

	extract( shortcode_atts( array(
	  'image' => '',
	  'title' => '',
	  'title_tag_name' => '',
	  'title_color' => '',
	  'subtitle' => '',
	  'subtitle_tag_name' => '',
	  'subtitle_color' => '',
	  'overlay_color' => '',
	  'title_align' => '',
	  'link_page' => '',
	  'link_product' => '',
	  'link_external' => '',
	  'hover_animation' => '',
	  'css_animation' => '',
	), $atts ) );

	$image = wp_get_attachment_image_src($image,'medium');
	$link = '';
	$linkwrap = '';
	$linkwrap2 = '';
	
	if(!empty($link_page)) {
		$link = get_permalink($link_page);
		$linkwrap = 'href="';
		$linkwrap2 = '"';
	} else if(!empty($link_product)) {
		$link = get_permalink($link_product);
		$linkwrap = 'href="';
		$linkwrap2 = '"';
	} else {
		$link = $link_external;
		if(!empty($link)){
			$linkwrap = 'href="';
			$linkwrap2 = '"';
		}
	}
	
	$title_color_style = '';
	if(!empty($title_color)) {
		$title_color_style = ' style="color:'.$title_color.';"';
	}
	$subtitle_color_style = '';
	if(!empty($subtitle_color)) {
		$subtitle_color_style = ' style="color:'.$subtitle_color.';"';
	}
	
	$output =<<< stop
	<a {$linkwrap}{$link}{$linkwrap2} class="promobox animation-{$hover_animation} {$css_animation}">
		<div class="promo-overlay" style="background:{$overlay_color}"></div>
		<img src="{$image[0]}" class="promopic" alt="{$title_tag_name}">
		<div class="promocontent {$title_align}">
			<div class="promotext"><{$title_tag_name}{$title_color_style}>{$title}</{$title_tag_name}></div>
			<div class="promosubtext"><{$subtitle_tag_name}{$subtitle_color_style}>{$subtitle}</{$subtitle_tag_name}></div>
		</div>
	</a>
stop;
  return $output;
}
add_shortcode( 'iron_promotion', 'iron_shortcode_promotion' );



/*
function iron_shortcode_infobox( $atts ) {

	extract( shortcode_atts( array(
	  'icon' => '',
	  'title' => '',
	  'description' => '',
	  'css_animation' => '',
	), $atts ) );

	$output =<<< stop
	<div class="infobox {$css_animation}">
		<div class="infobox-icon">
			<i class="fa fa-{$icon}"></i>
		</div>
		<div class="infobox-content">
			<{$title_tag_name} class="infobox-title">{$title}</{$title_tag_name}>
			<div class="infobox-description">{$description}</div>
		</div>
		<div class="clear"></div>
	</div>
stop;
  return $output;
}
add_shortcode( 'iron_infobox', 'iron_shortcode_infobox' );
*/


function iron_shortcode_logos( $atts ) {

	extract( shortcode_atts( array(
		'title' => '',
		'logos' => '',
	), $atts ) );

	$logos = explode(',', $logos);
	
	ob_start();
	?>
	
	<div class="widget widget-logos-wrap">

	    <?php if(!empty($title)): ?>
	    <span class="heading-t3"></span>
		<h3 class="widgettitle"><?php echo esc_html($title); ?></h3>
		<?php Iron_Widget::get_title_divider(); ?>
	    <?php endif; ?>
    
		<div id="owlcarousel" class="owl-carousel">

		<?php
		foreach($logos as $logo) {
			$post = get_post($logo);
			$logo_link_type = $post->logo_link_type;
			$logo_link = $post->logo_link;
			$logo_link_external = $post->logo_link_external;
			if($logo_link_type == 'internal') {
				$link = $logo_link;
				$target = "_self";
			} else {
				$link = $logo_link_external;
				$target = "_blank";
			}
			$image = get_the_post_thumbnail($post->ID, 'thumbnail');
			?>
			<a class="item" target="<?php echo esc_attr($target); ?>" href="<?php echo esc_url($link); ?>"><?php echo $image; ?></a>
			<?php
		}
		?>
	
		</div>
	</div>

	<?php
	$output = ob_get_contents();
    ob_end_clean();
	return $output;
}
add_shortcode( 'iron_logos', 'iron_shortcode_logos' );

function iron_shortcode_button( $atts ) {

	extract( shortcode_atts( array(
	  'text' => '',
	  'link_page' => '',
	  'link_product' => '',
	  'link_external' => '',
	  'border_width' => '1',
	  'border_radius' => '0',
	  'border_color' => '',
	  'background_color' => '',
	  'text_color' => '',
	  'text_align' => '',
	  'hover_bg_color' => '',
	  'hover_border_color' => '',
	  'hover_text_color' => '',
	), $atts ) );

	$link = '';
	$target = "_self";
	if(!empty($link_page)) {
		$link = get_permalink($link_page);
	} else if(!empty($link_product)) {
		$link = get_permalink($link_product);
	} else {
		$link = $link_external;
		$target = "_blank";
	}
	$output = '
	<a target="'.$target.'" data-hoverbg="'.$hover_bg_color.'" data-hoverborder="'.$hover_border_color.'" data-hovertext="'.$hover_text_color.'"  class="button-widget '.$text_align.'" href="'.esc_url($link).'" style="border-width:'.$border_width.'px; border-radius:'.$border_radius.'px; border-color:'.$border_color.'; background-color:'.$background_color.'; color:'.$text_color.'">'.$text.'</a><div class="clear"></div>';
	
    return $output;
}
add_shortcode( 'iron_button', 'iron_shortcode_button' );

/*
function iron_shortcode_fancy_title( $atts ) {

	extract( shortcode_atts( array(
		'title' => '',
		'font_weight' => '',
		'font_family' => '',
		'custom_font_family' => '',
		'title_color' => '',
		'title_size' => '',
		'title_align' => '',
		'letter_spacing' => '',
		'animation_css' => '',
		'el_class' => '',
	), $atts ) );

	$id = mt_rand( 999, 9999 );
	
	if(!empty($custom_font_family)) {
		$font_family = 'google|'.$custom_font_family;
	}
	
	$font_type = "safefont";
	
	if(strpos($font_family, 'google|') !== false) {
		$font_type = "google";
		$font_family = str_replace("google|", "", $font_family);
	}

	$styles = 'font-size: '.$title_size.'px;text-align:'.$title_align.';line-height:1;letter-spacing:'.$letter_spacing.'px;color: '.$title_color.';font-weight:'.$font_weight.';';

	$output = '
	<div style="'.$styles.'" id="fancy-title-'.$id.'" class="fancy-title '.$animation_css.' '.$el_class.'">
		<div class="fancytext">' .$title . '</div>
	</div>';
	
	$output .= iron_get_fontfamily( "#fancy-title-", $id, $font_family, $font_type );

	return $output;
}
add_shortcode( 'iron_fancy_title', 'iron_shortcode_fancy_title' );

*/


function iron_shortcode_image_divider( $atts ) {

	extract( shortcode_atts( array(
	  'divider_image' => '',
	  'divider_color' => '',
	  'divider_align' => '',
	  'divider_padding_top' => '',
	  'divider_padding_bottom' => '',
	), $atts ) );

	$divider_image = ($divider_image) ? (wp_get_attachment_image_src($divider_image, 'thumbnail')) : ('');
	if(empty($divider_color)){
		$divider_color = get_iron_option('featured_color');
	}
	if($divider_image) $divider_image = '<img src="' . $divider_image[0] . '" class="imagedividerpic">';
	if($divider_image == ""){
			$output =<<< stop
	<div class="dividerwrap" style="padding-top:{$divider_padding_top}px; padding-bottom:{$divider_padding_bottom}px;">
		<div class="defaultdivider {$divider_align}" style="background-color:{$divider_color}"></div>
		<div class="clear"></div>
	</div>
stop;
  return $output;
	}else{
		$output =<<< stop
	<div class="dividerwrap" style="padding-top:{$divider_padding_top}px; padding-bottom:{$divider_padding_bottom}px;">
		<div class="imagedivider {$divider_align}">
		{$divider_image}
		</div>
		<div class="clear"></div>
	</div>
stop;
  return $output;
	};
}
add_shortcode( 'iron_image_divider', 'iron_shortcode_image_divider' );

?>