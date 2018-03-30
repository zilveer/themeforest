<?php
class SlideshowGenerator {
	public static $types = array(
		'unleash'=>'Theme_Slideshow_Unleash',
		'roundabout'=>'Theme_Slideshow_Roundabout',
		'ken'=>'Theme_Slideshow_Ken',
		'nivo'=>'Theme_Slideshow_Nivo',
		'fotorama'=>'Theme_Slideshow_Fotorama',
	);

	public static $instances = array();
	
	public static function init() {
		foreach(self::$types as $stype => $classname){
			require_once (THEME_SLIDESHOW . '/'.$stype.'.php');
			self::$instances[$stype] = new $classname;
		}

	}

	public static function get_images($source_string='',$number='-1',$size=array(960,440)){
		$pattern = '/{([sbpg]):{0,1}([^}]+?){0,1}}/i';
		preg_match_all($pattern, $source_string, $match);
		$sources = array();
		if(empty($match[0])){
			$source_value = $source_string;
		}else{
			foreach($match[1] as $index => $cat){
				$sources[$cat] = $match[2][$index];
			}
		}
		$images = array();
		foreach($sources as $key=>$source_value){
			switch($key){
				case 'b':
					$query = array( 
						'post_type' => 'post', 
						'showposts'=>$number, 
						'orderby'=>'date', 
						'order'=>'DESC',
						'meta_key'=>'_thumbnail_id',
					);
					if(!empty($source_value)){
						$query['category_name'] = $source_value;
					}

					$loop = new WP_Query($query);
					$post_linkable = theme_get_option('slideshow','post_linkable');
					while ( $loop->have_posts() ) : $loop->the_post();
					$image_id = get_post_thumbnail_id();
					if(!empty($image_id)){
						$image_array = array(
							'source' => array(
								'type'=>'attachment_id',
								'value'=>$image_id
							),
							'type' => 'blog',
							'post_id'=> get_the_ID(),
							'title' => get_the_title(),
							'desc'  => get_the_excerpt(),
							'target' => '_self'
						);
						if($post_linkable){
							$image_array['link'] = get_permalink();
						}
						$images[] = $image_array;
					}
					endwhile;
					break;
				case 'p':
					$query = array( 
						'post_type' => 'portfolio', 
						'showposts'=>$number, 
						'orderby'=>'menu_order', 
						'order'=>'ASC',
					);
					if(!empty($source_value)){
						global $wp_version;
						if(version_compare($wp_version, "3.1", '>=')){
							$query['tax_query'] = array(
								array(
									'taxonomy' => 'portfolio_category',
									'field' => 'slug',
									'terms' => explode(',', $source_value)
								)
							);
						}else{
							$query['taxonomy'] = 'portfolio_category';
							$query['term'] = $source_value;
						}
					}
					
					$loop = new WP_Query($query);
					$portfolio_linkable = theme_get_option('slideshow','portfolio_linkable');
					while ( $loop->have_posts() ) : $loop->the_post();
					$image_id = get_post_thumbnail_id();
					if(!empty($image_id)){
						$image_array = array(
							'source' => array(
								'type'=>'attachment_id',
								'value'=>$image_id
							),
							'type' => 'portfolio',
							'post_id'=> get_the_ID(),
							'title' => get_the_title(),
							'desc'  => get_the_excerpt(),
							'target' => '_self'
						);
						if($portfolio_linkable){
							$image_array['link'] = get_permalink();

							if('link' == get_post_meta(get_the_id(), '_type', true)){
								$image_array['link'] = theme_get_superlink(get_post_meta(get_the_ID(), '_link', true));
							}
						}
						$images[] = $image_array;
					}
					endwhile;
					break;
				case 's':
					$query = array( 
						'post_type' => 'slideshow', 
						'showposts'=>$number, 
						'orderby'=>'menu_order', 
						'order'=>'ASC',
					);
					if(!empty($source_value)){
						global $wp_version;
						if(version_compare($wp_version, "3.1", '>=')){
							$query['tax_query'] = array(
								array(
									'taxonomy' => 'slideshow_category',
									'field' => 'slug',
									'terms' => explode(',', $source_value)
								)
							);
						}else{
							$query['taxonomy'] = 'slideshow_category';
							$query['term'] = $source_value;
						}
					}
					
					$loop = new WP_Query($query);
					
					while ( $loop->have_posts() ) : $loop->the_post();
						$link_to = get_post_meta(get_the_ID(), '_link_to', true);
						$link = theme_get_superlink($link_to);			
						$link_target = get_post_meta(get_the_ID(), '_link_target', true);
						$link_target = $link_target?$link_target:'_self';

						$image_id = get_post_thumbnail_id();
						if(!empty($image_id)){
							$caption = get_post_meta(get_the_ID(), '_caption', true);
							if(empty($caption)){
								$caption = get_the_title();
							}
							if(!empty($image_id)){
								$images[] = array(
									'source' => array(
										'type'=>'attachment_id',
										'value'=>get_post_thumbnail_id()
									),
									'type' => 'slideshow',
									'post_id'=> get_the_ID(),
									'title' => $caption,
									/*'desc'  => get_post_meta(get_the_ID(), '_description', true),*/
									'desc' => get_the_content(),
									'link' => $link,
									'target' => $link_target,
									/*'layers' => get_post_meta(get_the_ID(), '_layers', true)*/
								);
							}
						}
						$image_ids_str = get_post_meta(get_the_ID(), '_image_ids', true);
						$image_ids = array();
						if(!empty($image_ids_str)){
							$gallery_title = get_post_meta(get_the_ID(), '_gallery_caption', true);
							$gallery_desc = get_post_meta(get_the_ID(), '_gallery_desc', true);
							$slider_caption = get_post_meta(get_the_ID(), '_caption', true);
							if(empty($slider_caption)){
								$slider_caption = get_the_title();
							}
							$slider_desc = get_the_content();

							$image_ids = explode(',',str_replace('image-','',$image_ids_str));
							foreach($image_ids as $image_id){
								$attachment = get_post( $image_id );
								if(!$attachment){
									continue;
								}
								switch ($gallery_title) {
									case 'caption':
										$attachment_title = wptexturize( esc_html($attachment->post_excerpt) );
										break;
									case 'title':
										$attachment_title = $attachment->post_title;
										break;
									case 'slider':
										$attachment_title = $slider_caption;
										break;
									default:
										$attachment_title = '';
										break;
								}
								switch ($gallery_desc) {
									case 'image':
										$attachment_desc = $attachment->post_content;
										break;
									case 'slider':
										$attachment_desc = $slider_desc;
										break;
									default:
										$attachment_desc = '';
										break;
								}
								$images[] = array(
									'parent'=>get_the_ID(),
									'source' => array(
										'type'=>'attachment_id',
										'value'=>$image_id
									),
									'type' => 'slideshow',
									'post_id'=> get_the_ID(),
									'title' => $attachment_title,
									/*'desc'  => get_post_meta(get_the_ID(), '_description', true),*/
									'desc' => $attachment_desc,
									'link' => $link,
									'target' => $link_target,
									/*'layers' => get_post_meta(get_the_ID(), '_layers', true)*/
								);
							}
						}
					endwhile;
					break;
				case 'g':
					if($source_value==''){
						$post_id =  theme_get_queried_object_id();
					}else{
						$post_id = $source_value;
					}
					$children = array(
						'post_parent' => $post_id,
						'post_status' => 'inherit',
						'post_type' => 'attachment',
						'post_mime_type' => 'image',
						'order' => 'ASC',
						'orderby' => 'menu_order ID',
						'numberposts' => -1,
						'offset' => ''
					);

					/* Get image attachments. If none, return. */
					$attachments = get_children( $children );
					foreach ( $attachments as $id => $attachment ) {
						if(!empty($id)){
							$images[] = array(
								'source' => array(
									'type'=>'attachment_id',
									'value'=>$id
								),
								'type' => 'gallery',
								'post_id'=> $post_id,
								'title' => wptexturize( esc_html($attachment->post_excerpt) ),
								'desc'  => '',
								//'src' => $img_src[0],
								'link' => '',
								'target' => '_self'
							);
						}
					}
					break;
			}
		}
		wp_reset_postdata();
		/* fix $wp_filter the_content tag filters order issue */
		global $merged_filters;
		unset($merged_filters['the_content']);

		if($number!='-1'){
			return array_slice($images, 0, $number);
		} else {
			return $images;
		}
	}

	public static function render($type, $category = '', $color = '',$number ='-2',$text = false) {
		list($stype,$tmpl) = explode('_',$type);
		if(empty($number)){
			$number = '-1';
		}
		if(empty($stype) || empty($tmpl))
			return false;
		
		if(!empty($color) && $color != "transparent"){
			$color = ' style="background-color:'.$color.'"';
		}else{
			$color = '';
		}
		if($text){
			$text = '<div id="introduce" class="slider_top">'.$text.'</div>';
		}else{
			$text = '';
		}	
	
		$options = self::get_options($stype,$tmpl);

		$images = self::get_images($category,$number,'full');

		$stype_class = $stype;

		if($stype == 'res' && $options['fullWidth']){
			$stype_class .= '-full';
		}
		if($stype === 'fotorama'){
			return '<div id="feature" class="slider_fotorama" '.$color.'>'.self::get_slideshow($stype,$images,$options).'</div>';
		}
		if(in_array($stype, array('nivo','unleash'))){
			$output = '<div id="feature" class="with_shadow slider_'.$stype_class.'" '.$color.'>';
			$output .= '<div class="top_shadow"></div>';

			if($text){
				$output .= '<div class="inner">'.$text.'</div>';
			}
			$output .=  self::get_slideshow($stype,$images,$options);
			$output .= '<div class="bottom_shadow"></div>';
			$output .= '</div>';
		} else {
			$output = '<div id="feature" class="with_shadow slider_'.$stype_class.'" '.$color.'>';
			$output .= '<div class="top_shadow"></div>';
			$output .= '<div class="inner">'.$text;
			$output .=  self::get_slideshow($stype,$images,$options);
			$output .= '</div>';
			$output .= '<div class="bottom_shadow"></div>';
			$output .= '</div>';
		}
		
		return $output;
	}

	public static function get_slideshow($stype,$images,$options, $shortcode = false){
		$slideshow = self::$instances[$stype];
		return $slideshow->render($images,$options,$shortcode);
	}

	public static function get_options($stype,$tmpl){
		$options = array();
		$sfunc = $stype.'Option';
		$defined = Theme_Options_Page_Slideshow::$sfunc($tmpl);
		foreach ($defined as $opt) {
			$slugs = explode('_',$opt['id']);
			$options[implode('_',array_slice($slugs,2))] = theme_get_option('slideshow',$opt['id']);
		}
		return $options;
	}
	
}
