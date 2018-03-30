<?php
/**
 * Prints the Content slider in header.
 */

global $pexeto_slider_data, $post, $pexeto_scripts, $pexeto_content_sizes, $pexeto_content_slider_id;

$img_width = pexeto_get_column_width(2, 'content_slider', 'full');
$img_height = pexeto_option( 'content_img_height' );
$slider_height = pexeto_option('content_slider_height');
$thumbnail_preview = pexeto_option('content_thumbnail_preview');

if(!isset($pexeto_content_slider_id)){
	$slider_id = $post->ID;
	$pexeto_content_slider_id = 1;
}else{
	$slider_id = $post->ID.'-'.$pexeto_content_slider_id++;
}

$slider_div_id='content-slider-'.$slider_id;
//get the slider items(posts)
$slider_items=$pexeto_slider_data['posts'];
$slides_num = sizeof($slider_items);

$first_color = $slides_num ? get_post_meta($slider_items[0]->ID, PEXETO_CUSTOM_PREFIX.'bg_color', true) : '';
$color_style= $first_color ? 'style="background-color:#'.$first_color.'";':'';
$color_style='';
?>

<div class="content-slider-wrapper" <?php echo $color_style; ?>>
<div class="content-slider cols-wrapper cols-2" id="<?php echo $slider_div_id; ?>" >
	<div class="section-boxed">
	<ul id="cs-slider-ul" style="min-height:<?php echo $slider_height; ?>px;">
		<?php

		//set the meta key values for each item that will be retrieved
		$data_keys = array('layout', 'animation', 'bg_color', 'text_color', 'bg_image_url', 'bg_image_opacity', 
			'image_url', 'main_title', 'small_title', 'description', 'but_one_text', 'but_one_link',
			'but_two_text', 'but_two_link', 'video_url', 'slide_style');

		foreach ( $slider_items as $item ) {

			//get the meta values for the current item
			$item_data = pexeto_get_multi_meta_values($item->ID, $data_keys, PEXETO_CUSTOM_PREFIX);	

			//get the image URL
			$imgurl=$item_data['image_url'];
			if ( pexeto_option( 'content_auto_resize' )=='true' && !empty($imgurl)) {
				// $imgurl=pexeto_get_resized_image( $imgurl, $img_width , pexeto_option( 'content_img_height' ) );
				$imgurl = pexeto_get_resized_image( $imgurl, $img_width, $img_height, true );
			}

			$slide_layout = $item_data['layout'];
			if(empty($item_data['animation'])) $item_data['animation'] = 'random';

			//set the data attribute to the slide with the slide settings
			$slide_data='';
			$slide_data_keys = array('bg_image_url', 'bg_image_opacity', 'layout', 'animation', 'bg_color');
			foreach ($slide_data_keys as $key) {
				$slide_data.=' data-'.$key.'="'.$item_data[$key].'"';
			}

			//apply the slide text color if it is set
			$style = isset($item_data['text_color']) ? 'style="color:#'.$item_data['text_color'].';"' : '';

			$styles = array();
			
			if($item_data['slide_style']=='custom'){
				//get the custom styles
				$keys = array(
					'title'=>array(
						'title_font'=>'font-family',
						'title_font_size'=>'font-size',
						'title_text_style'=>'textstyle'),
					'subtitle'=>array(
						'subtitle_font'=>'font-family',
						'subtitle_font_size'=>'font-size',
						'subtitle_text_style'=>'textstyle'),
					'description'=>array(
						'description_font'=>'font-family',
						'description_font_size'=>'font-size',
						'description_text_style'=>'textstyle'),
					'button_one'=>array(
						'button_one_color'=>'background-color'),
					'button_two'=>array(
						'button_two_color'=>'color,border-color')
					);
				
				
				foreach ($keys as $key => $key_data) {
					$styles_data = pexeto_get_multi_meta_values($item->ID, array_keys($key_data), PEXETO_CUSTOM_PREFIX);
					$style_markup = '';
					foreach ($key_data as $field_id => $css_property) {
						$style_markup.=PexetoCustomCssGenerator::build_property_style($styles_data[$field_id], $css_property);
					}
					if(!empty($style_markup)){
						$style_markup = 'style="'.$style_markup.'"';
					}
					$styles[$key] = $style_markup;
				}

				$additional_settings = pexeto_get_multi_meta_values($item->ID, array( 'but_one_link_open', 'but_two_link_open', 'bg_align', 'bg_style'), PEXETO_CUSTOM_PREFIX);

				//button settings
				$item_data['but_one_link_open'] = $additional_settings['but_one_link_open'];
				$item_data['but_two_link_open'] = $additional_settings['but_two_link_open'];

				if(!empty($additional_settings['bg_align'])){
					$slide_data.=' data-bg_align="'.PexetoCustomCssGenerator::get_align_value_by_id($additional_settings['bg_align']).'"';
				}
				if(!empty($additional_settings['bg_style']) && $additional_settings['bg_style']!='default'){
					$slide_data.=' data-bg_style="'.$additional_settings['bg_style'].'"';
				}
			}

			$content_class = "cs-content-";
			$media_class = "cs-content-";
			$media_type = 'img';

			if($slide_layout=='centered'){
				$content_class.='centered';
				$media_type = "none";
			}elseif($slide_layout=='img-text' || $slide_layout=='video-text'){
				$content_class.='right';
				$media_class.='left';
			}elseif($slide_layout=='text-img' || $slide_layout=='text-video'){
				$content_class.='left';
				$media_class.='right';
			}

			if($slide_layout=='text-video' || $slide_layout=='video-text'){
				$media_type = 'video';
				$media_class.=' cs-type-video';
				if($item_data['video_url']){
					$video_id = pexeto_get_youtube_video_id($item_data['video_url']);
					if($video_id){
						$slide_data.=' data-video="'.$video_id.'"';
					}
				}
			}

			if($thumbnail_preview){
				$preview_thumbnail = '';
				if(!empty($imgurl)){
					$preview_thumbnail = $imgurl;
				}elseif(!empty($item_data['bg_image_url'])){
					$preview_thumbnail = $item_data['bg_image_url'];
				}

				if(!empty($preview_thumbnail)){
					$slide_data.=' data-thumbnail="'.pexeto_get_resized_image($preview_thumbnail, 150, 150).'"';
				}
			}
			

			

			$title = empty($item_data['main_title']) ? '' : $item_data['main_title'];
			?>

			 <li<?php echo $slide_data; ?> class="cs-layout-<?php echo $slide_layout; ?>" <?php echo $style; ?>>

				<!-- first slider box -->
				<div class="<?php echo $content_class; ?> col cs-content">
					<?php if ( !empty( $item_data['small_title'] ) ){
							//display the small title
							$inline_style = empty($styles['subtitle']) ? '':$styles['subtitle'];
						 	?><p class="cs-small-title cs-element" <?php echo $inline_style; ?>><?php echo $item_data['small_title']; ?></p>

					<?php } if ( !empty( $title ) ) { 
							//display the main title
							$inline_style = empty($styles['title']) ? '':$styles['title'];
							?> <h2 class="cs-title cs-element" <?php echo $inline_style; ?>><?php echo $item_data['main_title']; ?></h2>

					<?php } if ( !empty( $item_data['description'] ) ) {
							//display the description text
							$inline_style = empty($styles['description']) ? '':$styles['description'];
							?><p class="cs-element" <?php echo $inline_style; ?>><?php echo do_shortcode($item_data['description']); ?></p>
							<p class="clear"></p>
					
					<?php } if ( !empty( $item_data['but_one_text'] ) && !empty( $item_data['but_one_link'] ) ) {
							//display the first button
							$target = isset($item_data['but_one_link_open']) && $item_data['but_one_link_open'] == 'new' ? ' target="_blank"' : '';
							$inline_style = empty($styles['button_one']) ? '':$styles['button_one'];
							?><a href="<?php echo esc_url( $item_data['but_one_link'] ); ?>" class="button cs-element" <?php echo $inline_style.$target; ?>><?php echo $item_data['but_one_text']; ?></a>

					<?php } if ( !empty( $item_data['but_two_text'] ) && !empty( $item_data['but_two_link'] ) ) {  
							//display the second button
							$target = isset($item_data['but_two_link_open']) && $item_data['but_two_link_open'] == 'new' ? ' target="_blank"' : '';
							$inline_style = empty($styles['button_two']) ? '':$styles['button_two'];
							?><a href="<?php echo esc_url( $item_data['but_two_link'] ); ?>" class="button btn-alt cs-element" <?php echo $inline_style.$target; ?>><?php echo $item_data['but_two_text']; ?></a>
					<?php } ?>
				</div>
				<!-- second slider box -->

				<?php if($slide_layout!=='centered'){ ?>
				<div class="<?php echo $media_class; ?> col nomargin">
					<?php 
					if($media_type=='img'){
					if(!empty($imgurl)){ ?>
						<img src="<?php echo $imgurl; ?>" class="cs-element" alt="<?php echo esc_attr( $title ); ?>"/>
					<?php } 
				} else if($media_type=='video'){
					?>

					<div class="cs-video video-wrap"></div><?php
				} ?>
				</div>
				<?php } ?>
			</li><?php

			
		}

		//set the slider initialization arguments
		$args = array();
		$args['autoplay'] = pexeto_option('content_autoplay');
		if(pexeto_option('content_autoplay_mobile')===true){
			$args['autoplayMobile'] = true;
		}
		$args['pauseOnHover'] = pexeto_option('content_pause_hover');
		$args['animationInterval'] = intval(pexeto_option('content_interval'));
		$args['thumbnailPreview'] = $thumbnail_preview;

		$exclude_navigation = pexeto_option('exclude_content_navigation');
		$args['buttons'] = in_array('buttons', $exclude_navigation) ? false : true;
		$args['arrows'] = in_array('arrows', $exclude_navigation) ? false : true;

		//add the slider to the scripts to print
		if(empty($pexeto_scripts['contentslider'])){
			$pexeto_scripts['contentslider'] = array();
		}
		$pexeto_scripts['contentslider'][]=array( 'selector'=>'#'.$slider_div_id, 'options'=>$args );

		?>
	</ul>
</div>
</div>
</div>