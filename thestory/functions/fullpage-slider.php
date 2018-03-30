<?php

if(!function_exists('pexeto_print_fullpage_slider')){
	function pexeto_print_fullpage_slider($post_id){
		$slide_data = PexetoFullpageSlider::get_slide_data($post_id);
		$animate_elements = pexeto_option('fullpage_animate');


		if(!empty($slide_data)){
			$builder = new PexetoFullpageSliderBuilder($slide_data, $animate_elements);
			echo $builder->get_markup();
		}

		//set the slider options
		global $pexeto_scripts;
		$settings = pexeto_get_post_meta($post_id, array('fullpage_autoplay'));

		$autoplay = isset($settings['fullpage_autoplay']['enabled']) && $settings['fullpage_autoplay']['enabled']=='true' ? true : false;
		$horizontal_autoplay = isset($settings['fullpage_autoplay']['horizontal']) && $settings['fullpage_autoplay']['horizontal']=='true' ? true : false;
		$interval = isset($settings['fullpage_autoplay']['interval']) ? intval($settings['fullpage_autoplay']['interval']) : 5000;


		$pexeto_scripts['fullpage'] = array(
			'autoplay' => $autoplay,
			'interval'=>$interval,
			'horizontal' => $horizontal_autoplay
			);
	}
}

class PexetoFullpageSlider{

	public static function get_slide_data($post_id){
		$data = array();

		$slider_id = pexeto_get_single_meta($post_id, 'fullpage_slider');
		if(empty($slider_id)){
			$slider_id='default';
		}

		$slider_posts=PexetoCustomPageHelper::get_instance_data(PEXETO_FULLPAGESLIDER_POSTTYPE, $slider_id, 'slug' );

		if(!empty($slider_posts['posts'])){
			$common_fields = array('slide_background_image', 'background_color', 'slide_title',
				'slide_description', 'button_text', 'button_link', 'button_link_open', 'slide_style');
			$text_fields = array_merge($common_fields, array('text_layout'));
			$image_fields = array_merge($common_fields, array('image_layout', 'content_image'));
			$custom_style_fields = array('bg_align', 'title_color', 'title_text_style', 'title_font',
        		'title_font_size', 'description_color', 'description_text_style',
        		'description_font', 'description_font_size', 'button_color', 'button_link_open');
        	$video_fields = array('text_layout', 'slide_video_mp4', 'slide_video_webm', 'slide_video_ogg', 'mobile_background_image',
        		'slide_title', 'slide_description', 'button_text', 'button_link', 'slide_style', 'slide_style', 'background_color');			


			foreach ($slider_posts['posts'] as $p) {
				$slide_type = PexetoCustomPageHelper::get_meta($p->ID, 'slide_type');

				if($slide_type=='textimg' || $slide_type=='text'){
					$keys = $slide_type == 'textimg' ? $image_fields : $text_fields;

					$slide_meta = PexetoCustomPageHelper::get_multi_meta($p->ID, $keys);

					$slide_data = array(
		        		'bg_image'=>$slide_meta['slide_background_image'],
		        		'title'=>$slide_meta['slide_title'],
		        		'desc'=>$slide_meta['slide_description'],
		        		'bg_color'=>$slide_meta['background_color'],
		        		'type'=>$slide_type
		        	);

		        	$btn = array(
		        		'text' => $slide_meta['button_text'],
		        		'link' => $slide_meta['button_link']
		        	);
		        	if(!empty($btn['text']) && !empty($btn['link'])){
		        		$slide_data['button'] = $btn;
		        	}

		        	if($slide_meta['slide_style']=='custom'){
		        		$slide_styles = PexetoCustomPageHelper::get_multi_meta($p->ID, $custom_style_fields);
		        		$slide_data['style'] = $slide_styles;
					}


		        	if($slide_type=='textimg'){
		        		$slide_data['layout']=$slide_meta['image_layout'];
		        		$slide_data['content_image']= $slide_meta['content_image'];
		        	}else{
		        		$slide_data['layout']=$slide_meta['text_layout'];
		        	}

		        	$data[]=$slide_data;
				}elseif($slide_type=='slider'){
					$ids = PexetoCustomPageHelper::get_meta($p->ID, 'images');
					$data[]=array(
		        		'type'=>'slider',
		        		'images' => pexeto_get_multiupload_images($ids)
		        	);
				}elseif($slide_type=='video'){
					$slide_meta = PexetoCustomPageHelper::get_multi_meta($p->ID, $video_fields);
					$slide_data = array(
						'type'=>'video',
						'layout'=>$slide_meta['text_layout'],
						'video_mp4'=>$slide_meta['slide_video_mp4'],
						'video_webm'=>$slide_meta['slide_video_webm'],
						'video_ogg'=>$slide_meta['slide_video_ogg'],
						'mobile_bg'=>$slide_meta['mobile_background_image'],
						'title'=>$slide_meta['slide_title'],
		        		'desc'=>$slide_meta['slide_description'],
		        		'bg_color'=>$slide_meta['background_color']
						);

					if($slide_meta['slide_style']=='custom'){
		        		$slide_styles = PexetoCustomPageHelper::get_multi_meta($p->ID, $custom_style_fields);
		        		$slide_data['style'] = $slide_styles;
					}

					$btn = array(
		        		'text' => $slide_meta['button_text'],
		        		'link' => $slide_meta['button_link']
		        	);
		        	if(!empty($btn['text']) && !empty($btn['link'])){
		        		$slide_data['button'] = $btn;
		        	}

					$data[]=$slide_data;
				}
			}
		}

		return $data;
	}
}



class PexetoFullpageSliderBuilder{
	private $data;
	private $sizes;
	private $enable_resizing;
	private $animate_elements;

	public function __construct($data, $animate_elements){
		$this->data = $data;
		$this->animate_elements = $animate_elements;
		$this->enable_resizing = pexeto_option('fullpage_auto_resize');
	}

	public function get_markup(){
		$html = '<div class="fullpage-wrapper loading">';
		foreach ($this->data as $index => $slide) {
			$html.=$this->get_slide_markup($slide, $index);
		}
		$html.='<div class="fullpage-data"><ul class="fullpage-nav"></ul></div></div>';
		return $html;
	}

	public function get_slide_markup($slide, $index){
		$html='';
		$style='';
		$add_class = isset($slide['layout']) ? ' layout-'.$slide['layout'] : '';

		switch ($slide['type']) {
			case 'text':
				$html = $this->get_text_layout_markup($slide);
				break;
			
			case 'textimg':
				$html = $this->get_textimg_layout_markup($slide);
				break;
			case 'slider':
				$html = $this->get_horizontal_slider_markup($slide);
				$add_class = '';
				break;
			case 'video':
				$html = $this->get_video_slider_markup($slide);
				$add_class.=' section-text';
				break;
		}


		if($slide['type']=='text' || $slide['type']=='textimg' || $slide['type']=='video'){
			if(!empty($slide['style']['bg_align'])){
				$slide['bg_align']=$slide['style']['bg_align'];
			}
			$rel = array('bg_image' => 'background-image', 'bg_color'=>'background-color', 'bg_align'=>'background-position');
			$style = $this->get_style_markup($slide, $rel);
		}

		if($index === 0 && pexeto_option('fullpage_scroll_arrow') == true){
			//add a scroll down arrow
			$html.='<span class="fullpage-scroll-arrow icon-arrow-down-2"></span>';
		}

		$html='<div class="section section-'.$slide['type'].$add_class.'"'.$style.'>'.$html.'</div>';

		return $html;
	}

	protected function get_video_slider_markup($slide){
		$data = empty($slide['mobile_bg'])?'':' data-mobilebg="'.$slide['mobile_bg'].'"';

		$html = '<div class="fullpage-video-wrap"'.$data.'><video width="500" height="500" loop preload="auto">';

		$formats = array('webm', 'mp4', 'ogg');

		foreach ($formats as $format) {
			if(!empty($slide['video_'.$format])){
				$html.='<source src="'.$slide['video_'.$format].'" type="video/'.$format.'">';
			}
		}

		$html.='</video></div>';
		$html.=$this->get_text_layout_markup($slide);
		return $html;
	}

	protected function get_text_layout_markup($slide){
		$add_class = $this->animate_elements ? ' anim-el':'';
		$content = '<div class="section-content'.$add_class.'">';

		$content.=$this->get_title_markup($slide);
		$content.=$this->get_desc_markup($slide);
		$content.=$this->get_button_markup($slide);


		$content.='</div>';
		return $content;
	}

	protected function get_textimg_layout_markup($slide){
		$add_class = $this->animate_elements ? ' anim-el':'';
		$html='<div class="section-wrapper">';
		$content = '<div class="section-content'.$add_class.'">';
		$image = '';
		

		$content.=$this->get_title_markup($slide);
		$content.=$this->get_desc_markup($slide);
		$content.=$this->get_button_markup($slide);

		if(!empty($slide['content_image'])){
			$columns = $slide['layout']=='bottom' || $slide['layout']=='top' ? 1 : 2;
			$size = $this->get_image_size($columns);

			$img_src = $this->enable_resizing ? 
				pexeto_get_resized_image($slide['content_image'], $size['width'], $size['height']) :
				$slide['content_image'];

			$image ='<div class="section-img'.$add_class.'">'.'<img src="'.$img_src.'" alt=""/></div>';
		}

		$content.='</div>';

		if($slide['layout']=='bottom'){
			$html.=$content.$image;
		}else{
			$html.=$image.$content;
		}

		$html.='</div>';
		return $html;
	}

	protected function get_title_markup($slide){
		$html = '';

		if(!empty($slide['title'])){
			$style = '';
			if(isset($slide['style'])){
				$rel = array(
					'title_color' => 'color', 
					'title_text_style'=>'textstyle',
					'title_font' => 'font-family',
					'title_font_size' => 'font-size'
				);
				$style = $this->get_style_markup($slide['style'], $rel);
			}

			$html.='<h2 class="section-title"'.$style.'>'.$slide['title'].'</h2>';
		}

		return $html;
	}

	protected function get_desc_markup($slide){
		$html = '';

		if(!empty($slide['desc'])){
			$style = '';
			if(isset($slide['style'])){
				$rel = array(
					'description_color' => 'color', 
					'description_text_style'=>'textstyle',
					'description_font' => 'font-family',
					'description_font_size' => 'font-size'
				);
				$style = $this->get_style_markup($slide['style'], $rel);
			}

			$html.='<div class="section-desc"'.$style.'>'.apply_filters('the_content', $slide['desc']).'</div>';
		}

		return $html;
	}

	protected function get_button_markup($slide){
		$html = '';

		if(!empty($slide['button'])){
			$style = '';
			$target = '';

			if(isset($slide['style'])){
				$rel = array('button_color' => 'background-color');
				$style = $this->get_style_markup($slide['style'], $rel);
			}

			if(!empty($slide['style']['button_link_open']) && $slide['style']['button_link_open']=='new'){
				$target = ' target="_blank"';
			}

			$html.='<a '.$style.' href="'.esc_attr($slide['button']['link']).'" class="button"'.$target.'>'.$slide['button']['text'].'</a>';
		}

		return $html;
	}

	protected function get_style_markup($style, $rel){
		$css='';
		foreach ($rel as $key => $value) {
			if(!empty($style[$key])){
				switch ($value) {
					case 'color':
					case 'background-color':
						$css.=$value.':#'.$style[$key].';';
						break;
					case 'background-image':
						$css.='background-image:url('.$style[$key].');';
						break;
					case 'background-position':
						$css.='background-position:'.PexetoCustomCssGenerator::get_align_value_by_id($style[$key]).';';
						break;
					case 'font-family':
						if($style[$key]!='default'){
							$css.='font-family:'.pexeto_get_font_name_by_key($style[$key]).';';
						}
						break;
					case 'font-size':
						$css.='font-size:'.$style[$key].'px;';
						break;
					case 'textstyle':
						$styles = explode(',', $style[$key]);
						if(in_array('bold', $styles)){
							$css.='font-weight:bold;';
						}
						if(in_array('italic', $styles)){
							$css.='font-style:italic;';
						}
						if(in_array('uppercase', $styles)){
							$css.='text-transform:uppercase;';
						}
						break;
				}
			}
		}

		if(!empty($css)){
			$css=' style="'.esc_attr($css).'"';
		}

		return $css;
	}


	protected function get_horizontal_slider_markup($slide){
		$html='';
		if(!empty($slide['images'])){
			foreach ($slide['images'] as $img) {
				$caption = empty($img['caption']) ? '' : '<span class="slide-caption">'.$img['caption'].'</span>';
				$html.='<div class="slide" style="background-image:url('.$img['url'].')">'.$caption.'</div>';
			}
		}
		return $html;
	}

	protected function get_image_size($columns){
		if(isset($this->sizes[$columns])){
			return $this->sizes[$columns];
		}

		if($columns==1){
			$sizes = pexeto_option('fullpage_center_image_size');
		}else{
			$sizes = array( 'width' => 775,
				'height' => pexeto_option('fullpage_column_image_height'));
		}

		$this->sizes[$columns] = $sizes;
		return $sizes;
	}
}
