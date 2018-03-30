<?php
if(!function_exists('theme_section_portfolio_list')){
/**
 * The default template for displaying portfolio lists in the pages
 */
function theme_section_portfolio_list($options){
	global $wp_filter;
	$the_content_filter_backup = $wp_filter['the_content'];

	$options = shortcode_atts(array(
		'column' => 4,
		'layout' => 'full',//sidebar
		'cat' => '',
		'max' => -1,
		'title' => '',
		'titlelinkable' => 'false',
		'titlelinktarget' => '_self',
		'desc' => '',
		'desc_length'=>'default',
		'more' => 'default',
		'moretext' => '',
		'morebutton' => 'default',
		'height' => '',
		"ajax" => 'false',
		'current' => '',
		'nopaging' => 'false',
		'sortable' => 'false',
		'group' => 'true',
		'lightboxtitle' => 'portfolio', //portfolio,image,imagecaption,imagedesc,none
		'advancedesc'=>'false',
		'effect' => 'icon', //icon,grayscale,zoom,blur,rotate,morph,tilt,none
		'ids' => '',
		'order'=> 'ASC',
		'orderby'=> 'menu_order', //none, id, author, title, date, modified, parent, rand, comment_count, menu_order
		'paged' => null,
		'rel_group' => 'portfolio_'.rand(1,1000)
	), $options);

	extract($options);
	
	if($desc_length != 'default'){
		$excerpt_constructor = new Theme_The_Excerpt_Length_Constructor($desc_length);
		add_filter( 'excerpt_length', array($excerpt_constructor,'get_length'));
		add_filter( 'get_the_excerpt', array($excerpt_constructor,'trim'));
	}
	if(!isset($_POST['portfolioAjax'])){
		wp_print_styles('mediaelementjs-styles');
		wp_print_scripts('mediaelementjs-scripts');
	}
	
	$output = '<div class="portfolio_wrap">';
	$size = array();
	switch($column){
		case 1:
			$column_class = 'one_column';
			if($layout=='sidebar'){
				$size[0] = '400';
			}else{
				$size[0] = '600';
			}
			$size[1] = (int)theme_get_option('portfolio','1_column_height');
			break;
		case 2:
			$column_class = 'two_columns';
			if($layout=='sidebar'){
				$size[0] = '293';
			}else{
				$size[0] = '450';
			}
			$size[1] = (int)theme_get_option('portfolio','2_columns_height');
			break;
		case 3:
			$column_class = 'three_columns';
			if($layout=='sidebar'){
				$size[0] = '188';
			}else{
				$size[0] = '292';
			}
			$size[1] = (int)theme_get_option('portfolio','3_columns_height');
			break;
		case 5:
			$column_class = 'five_columns';
			if($layout=='sidebar'){
				$size[0] = '108';
			}else{
				$size[0] = '170';
			}
			$size[1] = (int)theme_get_option('portfolio','5_columns_height');
			break;
		case 6:
			$column_class = 'six_columns';
			if($layout=='sidebar'){
				$size[0] = '88';
			}else{
				$size[0] = '138';
			}
			$size[1] = (int)theme_get_option('portfolio','6_columns_height');
			break;
		case 7:
			$column_class = 'seven_columns';
			if($layout=='sidebar'){
				$size[0] = '70';
			}else{
				$size[0] = '118';
			}
			$size[1] = (int)theme_get_option('portfolio','7_columns_height');
			break;
		case 8:
			$column_class = 'eight_columns';
			if($layout=='sidebar'){
				$size[0] = '61';
			}else{
				$size[0] = '97';
			}
			$size[1] = (int)theme_get_option('portfolio','8_columns_height');
			break;
		case 4:
		default:
			$column_class = 'four_columns';
			if($layout=='sidebar'){
				$size[0] = '136';
			}else{
				$size[0] = '217';
			}
			$size[1] = (int)theme_get_option('portfolio','4_columns_height');
	}
	if($height){
		$size[1] = $height;
	}

	if($layout=='sidebar'){
		$output .= '<ul class="portfolio_' . $column_class . ' with_sidebar portfolio_container">';
	}else{
		$output .= '<ul class="portfolio_' . $column_class . ' portfolio_container">';
	}

	if ($nopaging == 'false') {
		if(is_null($paged)){
			global $wp_version;
			if(is_front_page() && version_compare($wp_version, "3.1", '>=')){//fix wordpress 3.1 paged query
				$paged = (get_query_var('paged')) ?get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);
			}else{
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			}
		}
		
		$query = array(
			'post_type' => 'portfolio', 
			'posts_per_page' => $max, 
			'paged' => $paged,
			'orderby'=> $orderby, 
			'order'=> $order
		);
	} else {
		$query = array(
			'post_type' => 'portfolio', 
			'showposts' => $max,
			'orderby'=> $orderby, 
			'order'=> $order
		);
	}
	if(!empty($current)){
		$cat = $current;
	}
	if($cat != ''){
		global $wp_version;
		if(version_compare($wp_version, "3.1", '>=')){
			$query['tax_query'] = array(
				array(
					'taxonomy' => 'portfolio_category',
					'field' => 'slug',
					'terms' => explode(',', $cat)
				)
			);
		}else{
			$query['taxonomy'] = 'portfolio_category';
			$query['term'] = $cat;
		}
	}

	if($ids){
		$query['post__in'] = explode(',',$ids);
	}
	$r = new WP_Query($query);

	$i = 1;
	//deprecated
	if($title == ''){
		if(theme_get_option('portfolio','display_title') || $column == 1){
			$title = 'true';
		}
	}
	if($desc == ''){
		if(theme_get_option('portfolio','display_excerpt') || $column == 1){
			$desc = 'true';
		}
	}
	if($more == 'default'){
		$more =  theme_get_option('portfolio','display_more_button');
	}elseif($more == 'true'){
		$more = true;
	}else{
		$more = false;
	}
	if($morebutton == 'default'){
		$morebutton =  theme_get_option('portfolio','read_more_button');
	}elseif($morebutton == 'true'){
		$morebutton = true;
	}else{
		$morebutton = false;
	}
	$detect = new Mobile_Detect;
	

	while($r->have_posts()) {
		$r->the_post();
		$type = get_post_meta(get_the_id(), '_type', true);

		if($type === 'html'){
			$html_image = theme_get_inherit_option(get_the_id(), '_html_image', 'portfolio', 'html_image');
			$html_title = theme_get_inherit_option(get_the_id(), '_html_title', 'portfolio', 'html_title');
			$html_more = theme_get_inherit_option(get_the_id(), '_html_more', 'portfolio', 'html_more');
		}

		$terms = get_the_terms(get_the_id(), 'portfolio_category');
		$terms_slug = array();
		if (is_array($terms)) {
			foreach($terms as $term) {
				$terms_slug[] = $term->slug;
			}
		}
		
		
		
		$list_image = get_post_meta(get_the_ID(), '_list_image', true);
		$thumbnail_id = false;
		if(is_array($list_image) && isset($list_image['value'])){
			$thumbnail_id = $list_image['value'];
		} elseif(has_post_thumbnail()) {
			$thumbnail_id = get_post_thumbnail_id(get_the_id());
		}

		if($type === 'html'){
			if(!$html_image){
				$thumbnail_id = false;
			}
		}
		if($thumbnail_id){
			$with_image = ' portfolio_with_image';
		} else {
			$with_image = ' portfolio_without_image';
		}

		if (($i % $column) == 0 && $column != 1) {
			$output .= '<li class="portfolio_item'.$with_image.' hentry" data-id="'.get_the_id().'" data-type="'.esc_html($type).'" data-cat="' . implode(',', $terms_slug) . '">';
		} else {
			$output .= '<li class="portfolio_item'.$with_image.' hentry" data-id="'.get_the_id().'" data-type="'.esc_html($type).'" data-cat="' . implode(',', $terms_slug) . '">';
		}
		$i++;

		if ($thumbnail_id || $type == 'video') {
			$image_source = array('type'=>'attachment_id','value'=>$thumbnail_id);
			$image_src = theme_get_image_src($image_source, $size);
			
			$width = '';
			$height = '';
			$iframe = '';
			$inline = '';
			$image_lightbox_fittoview = '';
			$data = '';
			$thumb = '';
			if($type == 'image' || $type== "html"){
				$href =  get_post_meta(get_the_id(), '_image', true);
				if(empty($href) || (!empty($href) && is_array($href) && isset($href['value']) && empty($href['value']))){
					$href = theme_get_image_src($image_source);
				}else{
					$href = theme_get_image_src($href);
				}
				$image_lightbox_fittoview =  get_post_meta(get_the_id(), '_image_lightbox_fittoview', true);

				if($image_lightbox_fittoview === 'true'){
					$image_lightbox_fittoview = ' data-fittoview="true"';
				}else if($image_lightbox_fittoview === 'false'){
					$image_lightbox_fittoview = ' data-fittoview="false"';
				}
				$icon = 'zoom';
				$lightbox = ' lightbox';
				if($group == 'true'){
					$rel = ' data-fancybox-group="'.$rel_group.'"';
				}else{
					$rel = '';
				}

			}elseif($type == 'video'){
				$href =  get_post_meta(get_the_id(), '_video', true);
				if(empty($href)){
					$href = theme_get_image_src($image_source);
				} else {
					if(empty($image_src)){
						$provider = theme_get_video_provider($href);
						if(is_array($provider)){
							switch ($provider['provider']) {
								case 'youtube':
									$image_src = theme_get_youtube_thumbnail_url($provider['id']);
									break;
								
								case 'vimeo':
									$image_src = theme_get_vimeo_thumbnail_url($provider['id']);
									break;

								case 'dailymotion':
									$image_src = theme_get_dailymotion_thumbnail_url($provider['id']);
									break;
							}
						}
					}
				}

				$video_width = theme_get_inherit_option(get_the_id(), '_video_width', 'portfolio','video_width');
				$video_height = theme_get_inherit_option(get_the_id(), '_video_height', 'portfolio','video_height');
				$video_autoplay = theme_get_inherit_option(get_the_id(), '_video_autoplay', 'portfolio','video_autoplay');

				$width = ' data-width="'.$video_width.'"';
				$height = ' data-height="'.$video_height.'"';
				if($video_autoplay){
					$video_autoplay = 'true';
				}else{
					$video_autoplay = 'false';
				}

				$icon = 'play';
				$lightbox = ' lightbox';

				$data = ' data-autoplay="'.$video_autoplay.'"';
				if($group == 'true'){
					$rel = ' data-fancybox-group="'.$rel_group.'"';
				}else{
					$rel = '';
				}
				if(preg_match("/\.mp4$/",$href)){
					$mediaelement = true;
					
					$data .= ' data-source="'.$href.'"';
					$href = '';
					
					if(($detect->isMobile() || $detect->isTablet())){
						$lightbox = ' lightbox fancyvideo fancymobile';
					} else {
						$lightbox = ' fancyvideo lightbox';
					}
				}
			}elseif($type == 'audio'){
				$mediaelement = true;
				$href = '#';
				// get_post_meta(get_the_id(), '_audio', true);
				//if(empty($href)){
					//$href = theme_get_image_src($image_source);
				//}

				$audio_autoplay = theme_get_inherit_option(get_the_id(), '_audio_autoplay', 'portfolio','audio_autoplay');
				$audio_loop = theme_get_inherit_option(get_the_id(), '_audio_loop', 'portfolio','audio_loop');
				if($audio_autoplay){
					$audio_autoplay = 'true';
				}else{
					$audio_autoplay = 'false';
				}
				if($audio_loop){
					$audio_loop = 'true';
				}else{
					$audio_loop = 'false';
				}
				
				$audio_source =  get_post_meta(get_the_id(), '_audio', true);
				$data = ' data-source="'.$audio_source.'" data-autoplay="'.$audio_autoplay.'" data-loop="'.$audio_loop.'"';
				$icon = 'play';
				$lightbox = ' fancyaudio lightbox';
				if($group == 'true'){
					$rel = ' data-fancybox-group="'.$rel_group.'"';
				}else{
					$rel = '';
				}
			}elseif($type == 'lightbox'){
				$link = get_post_meta(get_the_ID(), '_lightbox_mobile_link', true);
				if(!empty($link) && ($detect->isMobile() || $detect->isTablet())){
					$href = $link;
					$link_target = get_post_meta(get_the_ID(), '_lightbox_mobile_link_target', true);
					$link_target = $link_target?$link_target:'_blank';
					$icon = 'link';
					$lightbox = '';
					$rel = '';
				}else{
					$href =  get_post_meta(get_the_id(), '_lightbox_href', true);
					if(empty($href)){
						$inline_id = 'portfolio_inline_'.get_the_id();
						$href = '#'.$inline_id;
						$inline = ' data-type="inline"';
						$output .= '<div class="hidden"><div id="'.$inline_id.'">';
						$output .= do_shortcode(get_post_meta(get_the_id(), '_lightbox_content', true));
						$output .= '</div></div>';
					}else{
						$iframe = ' data-type="iframe"';
					}
					$lightbox_width = theme_get_inherit_option(get_the_id(), '_lightbox_width', 'portfolio','lightbox_width');
					$lightbox_height = theme_get_inherit_option(get_the_id(), '_lightbox_height', 'portfolio','lightbox_height');
					
					$width = ' data-width="'.$lightbox_width.'"';
					$height = ' data-height="'.$lightbox_height.'"';
					
					$icon = 'zoom';
					$lightbox = ' lightbox';
					if($group == 'true'){
						$rel = ' data-fancybox-group="'.$rel_group.'"';
					}else{
						$rel = '';
					}
				}
			}elseif($type == 'gdoc'){
				$link = get_post_meta(get_the_ID(), '_gdoc_mobile_link', true);
				if(!empty($link) && ($detect->isMobile() || $detect->isTablet())){
					$href = $link;
					$link_target = get_post_meta(get_the_ID(), '_gdoc_mobile_link_target', true);
					$link_target = $link_target?$link_target:'_blank';
					$icon = 'link';
					$lightbox = '';
					$rel = '';
				}else{
					$http = (!empty($_SERVER['HTTPS'])) ? "https" : "http";
					$href =  get_post_meta(get_the_id(), '_gdoc_href', true);
					$href = $http.'://docs.google.com/viewer?url='.urlencode($href). "&embedded=true";;
					$iframe = ' data-type="iframe"';
					
					
					$gdoc_width = theme_get_inherit_option(get_the_id(), '_gdoc_width', 'portfolio','gdoc_width');
					$gdoc_height = theme_get_inherit_option(get_the_id(), '_gdoc_height', 'portfolio','gdoc_height');
					
					$width = ' data-width="'.$gdoc_width.'"';
					$height = ' data-height="'.$gdoc_height.'"';
					
					$icon = 'zoom';
					$lightbox = ' lightbox';
					if($group == 'true'){
						$rel = ' data-fancybox-group="'.$rel_group.'"';
					}else{
						$rel = '';
					}
				}
			}elseif($type == 'link'){
				$link = get_post_meta(get_the_ID(), '_link', true);
				$href = theme_get_superlink($link);
				$link_target = get_post_meta(get_the_ID(), '_link_target', true);
				$link_target = $link_target?$link_target:'_self';
				$icon = 'link';
				$lightbox = '';
				$rel = '';
			}elseif($type == 'gallery'){
				$image_ids_str = get_post_meta(get_the_id(), '_image_ids', true);
				$image_ids = array();
				if(!empty($image_ids_str)){
					$image_ids = explode(',',str_replace('image-','',$image_ids_str));
					$image_id = array_shift($image_ids);
					if($lightboxtitle=='portfolio'){
						$image_title = get_the_title();
					}elseif($lightboxtitle=='image'){
						$image_title = get_the_title($image_id);
					}elseif($lightboxtitle=='imagecaption'){
						$attachment = get_post( $image_id );
						$image_title = $attachment->post_excerpt;//Caption
					}elseif($lightboxtitle=='imagedesc'){
						$attachment = get_post( $image_id );
						$image_title = $attachment->post_content;;//Description
					}else{
						$image_title = '';
					}
					$base_image_src = wp_get_attachment_image_src($image_id,'full');
					$href = $base_image_src[0];
					$thumb = ' data-thumb="'.$href.'"';
				}else{
					$href =  get_post_meta(get_the_id(), '_image', true);
					if(empty($href)){
						$href = theme_get_image_src($image_source);
					}else{
						$href = theme_get_image_src($href);
					}
					if($lightboxtitle=='portfolio'){
						$image_title = get_the_title();
					}else{
						$image_title = '';
					}
				}

				$image_lightbox_fittoview =  get_post_meta(get_the_id(), '_image_lightbox_fittoview', true);

				if($image_lightbox_fittoview === 'true'){
					$image_lightbox_fittoview = ' data-fittoview="true"';
				}else if($image_lightbox_fittoview === 'false'){
					$image_lightbox_fittoview = ' data-fittoview="false"';
				}
				$icon = 'zoom';
				$lightbox = ' lightbox';
				if($group == 'true'){
					$rel = ' data-fancybox-group="'.$rel_group.'"';
				}else{
					$rel = ' data-fancybox-group="gallery-'.get_the_ID().'"';
				}
			}else{
				$href = get_permalink();
				$icon = 'doc';
				$lightbox = '';
				$rel = '';
			}
			
			if($type!=='gallery'){
				$image_id = get_post_thumbnail_id(get_the_id());
				if($lightboxtitle=='portfolio'){
					$image_title = get_the_title();
				}elseif($lightboxtitle=='image'){
					$image_title = get_the_title($image_id);
				}elseif($lightboxtitle=='imagecaption'){
					$attachment = get_post( $image_id );
					$image_title = $attachment->post_excerpt;//Caption
				}elseif($lightboxtitle=='imagedesc'){
					$attachment = get_post( $image_id );
					$image_title = $attachment->post_content;;//Description
				}else{
					$image_title = '';
				}
			}
			$override_icon = get_post_meta(get_the_ID(), '_icon', true);
			if($override_icon && $override_icon != 'default'){
				$icon = $override_icon;
			}
			
			$output .= '<div class="image_styled portfolio_image">';
			$output .= '<div class="image_frame effect-'.$effect.'" style="height:'.($size[1]+2).'px"><div class="image_shadow_wrap">';
			$output .= '<a class="image_icon_'.$icon.$lightbox.'" '.(isset($link_target)?'target="'.$link_target.'" ':'').' title="'. esc_html($image_title) .'" href="' . $href . '"'.$rel.$width.$height.$data.$inline.$iframe.$image_lightbox_fittoview.$thumb.'>';
			$output .= '<img width="'.$size[0].'" height="'.$size[1].'" src="' . $image_src . '" data-thumbnail="'.$thumbnail_id.'" title="' . esc_html(get_the_title()) . '" alt="' . esc_html(get_the_title()) . '" />';
			$output .= '</a>';
			$output .= '</div></div>';
			$output .= '</div>';
		}
		
		$output .= '<div class="portfolio_details">';
		
		if(($title == 'true' && $type!=="html") || ($type=="html" && $html_title == true)){
			if($titlelinkable == 'true'){
				if($type != 'link'){
					$href = get_permalink();
				}
				$target = $titlelinktarget?' target="'.$titlelinktarget.'"':'';

				$output .= '<div class="portfolio_title entry-title"><a href="'.$href.'"'.$target.' title="'.esc_html(get_the_title()).'">' . esc_html(get_the_title()) . '</a></div>';
			} else{
				$output .= '<div class="portfolio_title entry-title">' . esc_html(get_the_title()) . '</div>';
			}
		}
		
		if($desc == 'true' && $type !== 'html'){
			if($advancedesc == 'true'){
				remove_filter('get_the_excerpt', 'wp_trim_excerpt');
				$output .= '<div class="portfolio_desc entry-content">' . do_shortcode(get_the_excerpt()) . '</div>';
			}else{
				add_filter('get_the_excerpt', 'wp_trim_excerpt');
				$output .= '<div class="portfolio_desc entry-content">' . get_the_excerpt() . '</div>';
			}
		}
		if($type == 'html'){
			$output .= '<div class="portfolio_html entry-content">' . apply_filters('the_content', get_the_content()) . '</div>';
		}
		
		if((theme_is_enabled(get_post_meta(get_the_id(), '_more', true), $more) && $type!=="html") || ($type=="html" && $html_more == true)){
			$more_link = theme_get_superlink(get_post_meta(get_the_id(), '_more_link', true), get_permalink());
			$more_link_target = get_post_meta(get_the_ID(), '_more_link_target', true);
			$more_link_target = $more_link_target?$more_link_target:'_self';
			if($moretext == ''){
				$moretext = wpml_t(THEME_NAME , 'Portfolio More Button Text',theme_get_option('portfolio','more_button_text'));
			}
			if($morebutton){
				$output .= '<div class="portfolio_more_button"><a href="'.$more_link.'" class="'.apply_filters( 'theme_css_class', 'button' ).'" target="'.$more_link_target.'"><span>'.$moretext.'</span></a></div>';
			}else{
				$output .= '<div class="portfolio_more_button"><a href="'.$more_link.'" target="'.$more_link_target.'"><span>'.$moretext.'</span></a></div>';
			}
				
		}
		if($type == 'gallery'&&!empty($image_ids)){
			$output .= '<div class="hidden">';
			foreach($image_ids as $image_id){
				if($lightboxtitle=='portfolio'){
					$image_title = get_the_title();
				}elseif($lightboxtitle=='image'){
					$image_title = get_the_title($image_id);
				}elseif($lightboxtitle=='imagecaption'){
					$attachment = get_post( $image_id );
					$image_title = $attachment->post_excerpt;//Caption
				}elseif($lightboxtitle=='imagedesc'){
					$attachment = get_post( $image_id );
					$image_title = $attachment->post_content;;//Description
				}else{
					$image_title = '';
				}
				$image_src = wp_get_attachment_image_src($image_id,'full');
				$output .= '<a class="lightbox" href="'.$image_src[0].'" title="'. esc_html($image_title) .'" data-fancybox-group="'.(($group=='true')?$rel_group:'gallery-'.get_the_ID()).'"'.$image_lightbox_fittoview.'>gallery-'.get_the_ID().'</a>';
			}
			$output .= '</div>';
		}
		$output .= '</div>';
		$output .= '</li>';
	}
	$output .= '</ul>';
	if ($nopaging == 'false') {
		ob_start();
		theme_portfolio_pagenavi('', '', $r, $paged);
		$output .= ob_get_clean();
	}
	$output .= '</div>';
	if($desc_length != 'default'){
		remove_filter( 'excerpt_length', array($excerpt_constructor,'get_length'));
		remove_filter( 'get_the_excerpt', array($excerpt_constructor,'trim'));
	}

	wp_reset_postdata();
	$wp_filter['the_content'] = $the_content_filter_backup;
	return $output;
}
}

if(!function_exists('theme_portfolio_pagenavi')){
function theme_portfolio_pagenavi($before = '', $after = '',$portfolio_query, $paged) {
	global $wpdb, $wp_query;
	
	// if (is_single())
	// 	return;
	
	$pagenavi_options = array(
		//'pages_text' => __('Page %CURRENT_PAGE% of %TOTAL_PAGES%','striking-r'),
		'pages_text' => '',
		'current_text' => '%PAGE_NUMBER%',
		'page_text' => '%PAGE_NUMBER%',
		'first_text' => __('&laquo; First','striking-r'),
		'last_text' => __('Last &raquo;','striking-r'),
		'next_text' => __('&raquo;','striking-r'),
		'prev_text' => __('&laquo;','striking-r'),
		'dotright_text' => __('...','striking-r'),
		'dotleft_text' => __('...','striking-r'),
		'style' => 1,
		'num_pages' => 4,
		'always_show' => 0,
		'num_larger_page_numbers' => 3,
		'larger_page_numbers_multiple' => 10,
		'use_pagenavi_css' => 0,
	);
	
	$request = $portfolio_query->request;
	$posts_per_page = intval($portfolio_query->query_vars['posts_per_page']);
	
	$numposts = $portfolio_query->found_posts;
	$max_page = intval($portfolio_query->max_num_pages);
	/* fix offset issue */
	if(isset($portfolio_query->query['offset'])){	
		if($paged == 0){
			$offset = $portfolio_query->query['offset'];
		} else {
			$offset = $portfolio_query->query['offset'] - $posts_per_page * ($paged-1 );
		}
		$numposts = $numposts - $offset;	
		$max_page = $max_page - ceil($offset/$posts_per_page);		
	}
	/* end fix */
	
	if (empty($paged) || $paged == 0)
		$paged = 1;
	$pages_to_show = intval($pagenavi_options['num_pages']);
	$larger_page_to_show = intval($pagenavi_options['num_larger_page_numbers']);
	$larger_page_multiple = intval($pagenavi_options['larger_page_numbers_multiple']);
	$pages_to_show_minus_1 = $pages_to_show - 1;
	$half_page_start = floor($pages_to_show_minus_1 / 2);
	$half_page_end = ceil($pages_to_show_minus_1 / 2);
	$start_page = $paged - $half_page_start;
	
	if ($start_page <= 0)
		$start_page = 1;
	
	$end_page = $paged + $half_page_end;
	if (($end_page - $start_page) != $pages_to_show_minus_1) {
		$end_page = $start_page + $pages_to_show_minus_1;
	}
	
	if ($end_page > $max_page) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = $max_page;
	}
	
	if ($start_page <= 0)
		$start_page = 1;
	
	$larger_pages_array = array();
	if ($larger_page_multiple)
		for($i = $larger_page_multiple; $i <= $max_page; $i += $larger_page_multiple)
			$larger_pages_array[] = $i;
	
	if ($max_page > 1 || intval($pagenavi_options['always_show'])) {
		$pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), $pagenavi_options['pages_text']);
		$pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);
		echo $before . '<div class="wp-pagenavi">' . "\n";
		switch(intval($pagenavi_options['style'])){
			// Normal
			case 1:
				if (! empty($pages_text)) {
					echo '<span class="pages">' . $pages_text . '</span>';
				}
				if ($start_page >= 2 && $pages_to_show < $max_page) {
					$first_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['first_text']);
					echo '<a href="' . esc_url(get_pagenum_link()) . '" class="first" data-page="1" title="' . $first_page_text . '">' . $first_page_text . '</a>';
					if (! empty($pagenavi_options['dotleft_text'])) {
						echo '<span class="extend">' . $pagenavi_options['dotleft_text'] . '</span>';
					}
				}
				$larger_page_start = 0;
				foreach($larger_pages_array as $larger_page) {
					if ($larger_page < $start_page && $larger_page_start < $larger_page_to_show) {
						$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($larger_page), $pagenavi_options['page_text']);
						echo '<a href="' . esc_url(get_pagenum_link($larger_page)) . '" data-page="'.$larger_page.'" class="page" title="' . $page_text . '">' . $page_text . '</a>';
						$larger_page_start++;
					}
				}
				if ( $paged > 1 ) {
					$prevpage = intval($paged) - 1;
					if ( $prevpage < 1 ){
						$prevpage = 1;
					}
					echo '<a class="previouspostslink" href="' . esc_url(get_pagenum_link($prevpage)) . '" data-page="'.$prevpage.'" title="' . $pagenavi_options['prev_text'] . '">'.$pagenavi_options['prev_text'].'</a>';
				}
				
				for($i = $start_page; $i <= $end_page; $i++) {
					if ($i == $paged) {
						$current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
						echo '<span class="current">' . $current_page_text . '</span>';
					} else {
						$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
						echo '<a href="' . esc_url(get_pagenum_link($i)) . '" data-page="'.$i.'" class="page" title="' . $page_text . '">' . $page_text . '</a>';
					}
				}

				$nextpage = intval($paged) + 1;

				if ( $nextpage <= $max_page ) {
					echo '<a class="nextpostslink" href="' . esc_url(get_pagenum_link($nextpage)) . '" data-page="'.$nextpage.'" title="' . $pagenavi_options['next_text'] . '">'.$pagenavi_options['next_text'].'</a>';
				}
				
				$larger_page_end = 0;
				foreach($larger_pages_array as $larger_page) {
					if ($larger_page > $end_page && $larger_page_end < $larger_page_to_show) {
						$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($larger_page), $pagenavi_options['page_text']);
						echo '<a href="' . esc_url(get_pagenum_link($larger_page)) . '" data-page="'.$larger_page.'" class="page" title="' . $page_text . '">' . $page_text . '</a>';
						$larger_page_end++;
					}
				}
				if ($end_page < $max_page) {
					if (! empty($pagenavi_options['dotright_text'])) {
						echo '<span class="extend">' . $pagenavi_options['dotright_text'] . '</span>';
					}
					$last_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['last_text']);
					echo '<a href="' . esc_url(get_pagenum_link($max_page)) . '" data-page="'.$max_page.'" class="last" title="' . $last_page_text . '">' . $last_page_text . '</a>';
				}
				break;
			// Dropdown
			case 2:
				echo '<form action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '" method="get">' . "\n";
				echo '<select size="1" onchange="document.location.href = this.options[this.selectedIndex].value;">' . "\n";
				for($i = 1; $i <= $max_page; $i++) {
					$page_num = $i;
					if ($page_num == 1) {
						$page_num = 0;
					}
					if ($i == $paged) {
						$current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
						echo '<option value="' . esc_url(get_pagenum_link($page_num)) . '" selected="selected" class="current">' . $current_page_text . "</option>\n";
					} else {
						$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
						echo '<option value="' . esc_url(get_pagenum_link($page_num)) . '">' . $page_text . "</option>\n";
					}
				}
				echo "</select>\n";
				echo "</form>\n";
				break;
		}
		echo '</div>' . $after . "\n";
	}
}
}