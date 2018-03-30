<?php
if(!function_exists('theme_shortcode_lightbox')){
/**
 * icon:zoom, doc, play
 */
function theme_shortcode_lightbox($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'href' => '#',
		'title' => '',
		'group' => '',
		'width' => false,
		'height' => false,
		'type' => '', //'image', 'inline', 'ajax', 'iframe', 'swf' and 'html'
		'close' => '',
		'fittoview' => '',
		'aspectratio' => '',
		'autosize' => '',
		'autoheight' => '',
		'autowidth' => '',
		'closeclick' => '',
		'imagesource_type' => false,
		'imagesource_value' => false,
		'imageeffect' => 'icon',
		'imagewidth'  => false,
		'imageheight' => false,
		'imagealign'  => '',
		'imageicon' => false,
		'imagesize' => 'medium',
	), $atts));

	// compatible code
	if(empty($type)){
		if(isset($atts['iframe']) && $atts['iframe']!= 'false'){
			$type = 'iframe';
		}
		if(isset($atts['inline']) && $atts['inline']!= 'false'){
			$type = 'inline';
		}
		if(isset($atts['photo']) && $atts['photo']!= 'false'){
			$type = 'image';
		}
	}
	if(isset($atts['restrict'])){
		$fittoview = $atts['restrict'];
	}
	// end compatible
	
	if($width && is_numeric($width)){
		$width = ' data-width="'.$width.'"';
	}else{
		$width = '';
	}
	if($height && is_numeric($height)){
		$height = ' data-height="'.$height.'"';
	}else{
		$height = '';
	}
	
	if($type){
		$type = ' data-fancybox-type="'.$type.'"';
	}else{
		$type = '';
	}
	if($close != ''){
		$close = ($close == 'false')?' data-close="false"':' data-close="true"';
	}
	if($fittoview != ''){	
		$fittoview = ($fittoview == 'false')?' data-fittoview="false"':' data-fittoview="true"';
	}
	if($autosize != ''){	
		$autosize = ($autosize == 'false')?' data-autosize="false"':' data-autosize="true"';
	}
	if($autowidth != ''){	
		$autowidth = ($autowidth == 'false')?' data-autowidth="false"':' data-autowidth="true"';
	}
	if($autoheight != ''){	
		$autoheight = ($autoheight == 'false')?' data-autoheight="false"':' data-autoheight="true"';
	}
	if($aspectratio != ''){	
		$aspectratio = ($aspectratio == 'false')?' data-aspectratio="false"':' data-aspectratio="true"';
	}
	if($closeclick != ''){	
		$closeclick = ($closeclick == 'false')?' data-closeclick="false"':' data-closeclick="true"';
	}

	$content = do_shortcode(str_replace('[button','[button button="true"',$content));

	if($imagesource_value){
		if(!$imagewidth){
			$imagewidth = theme_get_option('image', $imagesize.'_width');
			if(!$imagewidth){
				$imagewidth = '150';
			}
		}
		if(!$imageheight){
			$imageheight = theme_get_option('image', $imagesize.'_height');
			if(!$imageheight){
				$imageheight = '150';
			}
		}
		$image_src = theme_get_image_src(array('type'=>$imagesource_type,'value'=>$imagesource_value), array($imagewidth, $imageheight));
		if($imagesource_type == 'attachment_id'){
			$content = '<img alt="'.$title.'" src="'.$image_src.'" data-thumbnail="'.$imagesource_value.'" />';
		} else {
			$content = '<img alt="'.$title.'" src="'.$image_src.'" />';
		}
		
		return '<figure class="image_styled'.($imagealign?' align'.$imagealign:'').'" style="width:'.($imagewidth+2).'px;">
		<div class="image_frame effect-'.$imageeffect.'" style="'.((empty($imageheight))?'':'height:'.($imageheight+2).'px').'"><div class="image_shadow_wrap">
		<a title="'.$title.'" href="'.$href.'"'.($group?' data-fancybox-group="'.$group.'"':'').' class="fancybox image_size_'.$imagesize.($imageicon?' image_icon_'.$imageicon:'').'"'.$width.$height.$type.$close.$closeclick.$fittoview.$aspectratio.$autosize.$autowidth.$autoheight.'>' . $content . '</a>
		</div></div></figure>';
	} else {
		return '<a title="'.$title.'" href="'.$href.'"'.($group?' data-fancybox-group="'.$group.'"':'').' class="fancybox"'.$width.$height.$type.$close.$closeclick.$fittoview.$aspectratio.$autosize.$autowidth.$autoheight.'>'.$content.'</a>';
	}
}
}
add_shortcode('lightbox', 'theme_shortcode_lightbox');