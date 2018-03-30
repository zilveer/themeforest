<?php
	/*	
	*	Goodlayers Theme File
	*	---------------------------------------------------------------------
	*	This file contains the function use to print the elements of the theme
	*	---------------------------------------------------------------------
	*/
	
	// print title
	if( !function_exists('gdlr_get_item_title') ){
		function gdlr_get_item_title( $atts ){
			$ret = '';
			
			$atts['title-type'] = (empty($atts['title-type']))? $atts['type']: $atts['title-type'];
		
			if( !empty($atts['title-type']) && $atts['title-type'] != 'none' ){
				$item_class  = 'pos-' . str_replace('-divider', '', $atts['title-type']);
				$item_class .= (!empty($atts['carousel']))? ' gdlr-nav-container': '';
				
				$ret .= '<div class="gdlr-item-title-wrapper gdlr-item ' . $item_class . ' ">';
				
				$ret .= '<div class="gdlr-item-title-head">';
				if(!empty($atts['title'])){
					$ret .= '<h3 class="gdlr-item-title gdlr-skin-title gdlr-skin-border">' . $atts['title'] . '</h3>';
				}
				if( $atts['title-type'] == 'left' ){
					if(!empty($atts['caption'])){
						$ret .= '<div class="gdlr-item-title-caption gdlr-skin-info">' . $atts['caption'] . '</div>';
					}
					if(!empty($atts['right-text']) && !empty($atts['right-text-link'])){
						$ret .= '<a class="gdlr-item-title-link" href="' . esc_url($atts['right-text-link']) . '" >' . $atts['right-text'] . '</a>';
					}
				}
				if(!empty($atts['carousel'])){
					$ret .= '<div class="gdlr-title-navigation">';
					$ret .= '<i class="icon-angle-left gdlr-flex-prev"></i>';
					$ret .= '<i class="icon-angle-right gdlr-flex-next"></i>';
					$ret .= '</div>';
				}
				$ret .= '<div class="clear"></div>';
				$ret .= '</div>';
				
				$ret .= (strpos($atts['title-type'], 'divider') > 0)? '<div class="gdlr-item-title-divider"></div>': '';
				
				if( $atts['title-type'] != 'left' ){
					if(!empty($atts['caption'])){
						$ret .= '<div class="gdlr-item-title-caption gdlr-skin-info">' . $atts['caption'] . '</div>';
					}
					if(!empty($atts['right-text']) && !empty($atts['right-text-link'])){
						$ret .= '<a class="gdlr-item-title-link" href="' . esc_url($atts['right-text-link']) . '" >' . $atts['right-text'] . '</a>';
					}
				}
				
				$ret .= '</div>'; // gdlr-item-title-wrapper
			}
			return $ret;
		}
	}		

	// title item
	if( !function_exists('gdlr_get_title_item') ){
		function gdlr_get_title_item( $settings ){	
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';
	
			global $gdlr_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';		
			
			$ret  = '<div class="gdlr-title-item" ' . $item_id . $margin_style . ' >';
			$ret .= gdlr_get_item_title($settings);			
			$ret .= '</div>';
			return $ret;
		}
	}
	
	// accordion item
	if( !function_exists('gdlr_get_accordion_item') ){
		function gdlr_get_accordion_item( $settings ){
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';
	
			global $gdlr_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';
			
			$accordion = is_array($settings['accordion'])? $settings['accordion']: json_decode($settings['accordion'], true);

			$ret  = gdlr_get_item_title($settings);				
			$ret .= '<div class="gdlr-item gdlr-accordion-item '  . $settings['style'] . '" ' . $item_id . $margin_style . ' >';
			$current_tab = 0;
			foreach( $accordion as $tab ){  $current_tab++;
				$ret .= '<div class="accordion-tab';
				$ret .= ($current_tab == intval($settings['initial-state']))? ' active pre-active" >': '" >';
				$ret .= '<h4 class="accordion-title" ';
				$ret .= empty($tab['gdl-tab-title-id'])? '': 'id="' . $tab['gdl-tab-title-id'] . '" ';
				$ret .= '><i class="';
				$ret .= ($current_tab == intval($settings['initial-state']))? 'icon-minus': 'icon-plus';
				$ret .= '" ></i><span>' . gdlr_text_filter($tab['gdl-tab-title']) . '</span></h4>';
				$ret .= '<div class="accordion-content">' . gdlr_content_filter($tab['gdl-tab-content']) . '</div>';
				$ret .= '</div>';				
			}
			$ret .= '</div>';
			
			return $ret;
		}
	}	

	// toggle box item
	if( !function_exists('gdlr_get_toggle_box_item') ){
		function gdlr_get_toggle_box_item( $settings ){
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';
			
			global $gdlr_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';

			$accordion = is_array($settings['toggle-box'])? $settings['toggle-box']: json_decode($settings['toggle-box'], true);

			$ret  = gdlr_get_item_title($settings);	
			$ret .= '<div class="gdlr-item gdlr-accordion-item gdlr-multiple-tab '  . $settings['style'] . '" ' . $item_id . $margin_style . ' >';
			foreach( $accordion as $tab ){ 
				$ret .= '<div class="accordion-tab';
				$ret .= ($tab['gdl-tab-active'] == 'yes')? ' active pre-active" >': '" >';
				$ret .= '<h4 class="accordion-title" ';
				$ret .= empty($tab['gdl-tab-title-id'])? '': 'id="' . $tab['gdl-tab-title-id'] . '" ';
				$ret .= '><i class="';
				$ret .= ($tab['gdl-tab-active'] == 'yes')? 'icon-minus': 'icon-plus';
				$ret .= '" ></i><span>' . gdlr_text_filter($tab['gdl-tab-title']) . '</span></h4>';
				$ret .= '<div class="accordion-content">' . gdlr_content_filter($tab['gdl-tab-content']) . '</div>';
				$ret .= '</div>';
			}
			$ret .= '</div>';
			
			return $ret;
		}
	}		
	
	// column service item
	if( !function_exists('gdlr_get_column_service_item') ){
		function gdlr_get_column_service_item( $settings ){
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';

			global $gdlr_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';
			
			$settings['style'] = empty($settings['style'])? 'type-1': $settings['style'];
			$ret  = '<div class="gdlr-ux column-service-ux">';
			$ret .= '<div class="gdlr-item gdlr-column-service-item gdlr-' . $settings['style'] . '" ' . $item_id . $margin_style . '>';
			$ret .= '<div class="column-service-icon gdlr-skin-box"><i class="' . $settings['icon'] . '" ></i></div>';
			$ret .= '<div class="column-service-content-wrapper">';
			$ret .= '<h3 class="column-service-title">' . gdlr_text_filter($settings['title']) . '</h3>';
			$ret .= '<div class="column-service-content gdlr-skin-content">';
			$ret .= gdlr_content_filter($settings['content']);
			$ret .= '</div>'; // column-service-content 
			$ret .= '</div>'; // column-service-content-wrapper			
			$ret .= '</div>'; // column-service-item
			$ret .= '</div>'; // column-service-ux
			return $ret;
		}
	}
	
	// service with image item
	if( !function_exists('gdlr_get_service_with_image_item') ){
		function gdlr_get_service_with_image_item( $settings ){
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';

			global $gdlr_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';
			
			$ret  = '<div class="gdlr-item gdlr-service-with-image-item gdlr-' . $settings['align'] . '" ';
			$ret .= $item_id . $margin_style . '>';
			if( !empty($settings['image']) ){
				$ret .= '<div class="service-with-image-thumbnail gdlr-skin-box">';
				$ret .= gdlr_get_image($settings['image'], $settings['thumbnail-size']);
				$ret .= '</div>';
			}
			
			$ret .= '<div class="service-with-image-content-wrapper">';
			$ret .= '<h3 class="service-with-image-title">' . gdlr_text_filter($settings['title']) . '</h3>';
			$ret .= '<div class="service-with-image-content">' . gdlr_content_filter($settings['content']) . '</div>'; 
			$ret .= '</div>'; // service with image content wrapper
			$ret .= '<div class="clear"></div>';
			$ret .= '</div>'; // gdlr-item
			return $ret;
		}
	}	
	
	// feature media item
	if( !function_exists('gdlr_get_feature_media_item') ){
		function gdlr_get_feature_media_item( $settings ){
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';

			global $gdlr_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';
			
			$settings['align'] = empty($settings['align'])? 'left': $settings['align'];
			$ret  = gdlr_get_item_title($settings);	
			$ret .= '<div class="gdlr-item gdlr-feature-media-item" ' . $item_id . $margin_style . '>';
			
			if($settings['type'] == 'image' && !empty($settings['image'])){
				$ret .= '<div class="feature-media-thumbnail gdlr-image">';
				$ret .= empty($settings['image-link'])? '': '<a href="' . $settings['image-link'] . '" >';
				$ret .= gdlr_get_image($settings['image'], 'full');
				$ret .= empty($settings['image-link'])? '': '</a>';
				$ret .= '</div>';
			}else if($settings['type'] == 'video' && !empty($settings['video-url'])){
				$ret .= '<div class="feature-media-thumbnail gdlr-video">';
				$ret .= gdlr_get_video($settings['video-url']);
				$ret .= '</div>';
			}
			
			$ret .= '<h4 class="feature-media-caption">';
			$ret .= gdlr_text_filter($settings['feature-media-caption']);		
			$ret .= '</h4>'; // feature-media-caption
			
			$ret .= '</div>'; // gdlr-item
			return $ret;
		}
	}		
	
	// content item
	if( !function_exists('gdlr_get_content_item') ){
		function gdlr_get_content_item( $settings ){
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';

			global $gdlr_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';
			
			$ret  = gdlr_get_item_title($settings);	
			$ret .= '<div class="gdlr-item gdlr-content-item" ' . $item_id . $margin_style . '>' . gdlr_content_filter($settings['content']) . '</div>';
			return $ret;
		}
	}	

	// notification item
	if( !function_exists('gdlr_get_notification_item') ){
		function gdlr_get_notification_item( $settings ){
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';

			global $gdlr_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';	
		
			$style  = ' style="';
			if($settings['type'] == 'color-background'){
				$style .= !empty($settings['color'])? 'color:' . $settings['color'] . '; ': '';
				$style .= !empty($settings['background'])? 'background-color:' . $settings['background'] . '; ': '';
			}else if($settings['type'] == 'color-border'){
				$style .= !empty($settings['color'])? 'color:' . $settings['color'] . '; ': '';
				$style .= !empty($settings['border'])? 'border-color:' . $settings['border'] . '; ': '';	
			}	
			$style .= $margin . '" ';
			
			$ret  = '<div class="gdlr-notification gdlr-item ' . $settings['type'] . '" ' . $style . '>';
			$ret .= '<i class="' . $settings['icon'] . '"></i>';
			$ret .= '<div class="notification-content">' . gdlr_text_filter($settings['content']) . '</div>';
			$ret .= '<div class="clear"></div>';
			$ret .= '</div>';
			return $ret;	
		}
	}
	
	// icon with list item
	if( !function_exists('gdlr_get_list_with_icon_item') ){
		function gdlr_get_list_with_icon_item( $settings ){
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';
			
			global $gdlr_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';			
			
			$settings['icon-with-list'] = empty($settings['icon-with-list'])? array(): $settings['icon-with-list'];
			$list = is_array($settings['icon-with-list'])? $settings['icon-with-list']: json_decode($settings['icon-with-list'], true);

			$ret  = gdlr_get_item_title($settings);	
			$ret .= '<div class="gdlr-item gdlr-icon-with-list-item" ' . $item_id . $margin_style . '>';
			foreach( $list as $tab ){ 
				$ret .= '<div class="list-with-icon-ux gdlr-ux">';
				$ret .= '<div class="list-with-icon gdlr-' . $settings['align'] . '">';
				$ret .= '<div class="list-with-icon-title gdlr-skin-title">';
				if( $settings['align'] == 'right' ){
					$ret .= '<i class="' . $tab['gdl-tab-icon'] . '"></i>';
				}
				$ret .= gdlr_text_filter($tab['gdl-tab-title']);
				if( $settings['align'] == 'left' ){
					$ret .= '<i class="' . $tab['gdl-tab-icon'] . '"></i>';
				}
				$ret .= '</div>';
				$ret .= '<div class="list-with-icon-caption">' . gdlr_content_filter($tab['gdl-tab-content']) . '</div>';
				$ret .= '</div>'; // icon-with-list
				$ret .= '</div>'; // gdlr-ux
			}
			$ret .= '<div class="clear"></div>';
			$ret .= '</div>';
			
			return $ret;
		}
	}	

	// skill bar item
	if( !function_exists('gdlr_get_skill_bar_item') ){
		function gdlr_get_skill_bar_item( $settings ){	
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';
			
			global $gdlr_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';	
		
		
			$ret  = '<div class="gdlr-skill-bar-wrapper  gdlr-item gdlr-size-' . $settings['size'] . '" ' . $item_id . $margin_style . '>';
			if( $settings['size'] == 'small' && !empty($settings['content']) ){ 
				$ret .= '<span class="skill-bar-content" style="color: ' . $settings['text-color'] . ';" >';
				$ret .= $settings['content'];
				$ret .= '</span>';
			}
			$ret .= '<div class="gdlr-skill-bar gdlr-ux" style="background-color: ' . $settings['background-color'] . ';" >';
			$ret .= '<div class="gdlr-skill-bar-progress" data-percent="' . $settings['percent'] . '" ';
			$ret .= 'style="background-color: ' . $settings['progress-color'] . ';" >';
			if( $settings['size'] != 'small' && !empty($settings['content']) ){ 
				$ret .= '<span class="skill-bar-content" style="color: ' . $settings['text-color'] . ';" >';
				$ret .= empty($settings['icon'])? '': '<i class="' . $settings['icon'] . '" ></i>';
				$ret .= $settings['content'];
				$ret .= '</span>';
			}		
			$ret .= '</div>'; // gdlr-skill-bar-progress
			$ret .= '</div>'; // gdlr-skill-bar
			$ret .= '</div>'; // gdlr-skill-bar-wrapper				
			
			return $ret;
		}
	}
	
	// skill round item
	if( !function_exists('gdlr_get_skill_item') ){
		function gdlr_get_skill_item( $settings ){	
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';
			
			global $gdlr_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';

			if( empty($settings['style']) || $settings['style'] == 'normal' ){
				$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';	
				$ret  = '<div class="gdlr-skill-item-wrapper gdlr-skin-content gdlr-item" ' . $item_id . $margin_style . '>';
				$ret .= '<div class="gdlr-skill-item-title">' . $settings['title'] . '</div>';
				$ret .= '<div class="gdlr-skill-item-dot" >•</div>';
				$ret .= '<div class="gdlr-skill-item-caption">' . $settings['caption'] . '</div>';
				$ret .= '</div>'; // gdlr-skill-item-wrapper		
			}else{
				$margin .= ' background-color: ' . $settings['background'] . '; color: ' . $settings['text-color'] . ';';
				$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';	
				$ret  = '<div class="gdlr-skill-item-wrapper gdlr-type-2 gdlr-item" ' . $item_id . $margin_style . '>';
				$ret .= '<div class="gdlr-skill-item-title">' . $settings['title'] . '</div>';
				$ret .= '<div class="gdlr-skill-item-dot" >•</div>';
				$ret .= '<div class="gdlr-skill-item-caption">' . $settings['caption'] . '</div>';
				$ret .= '</div>'; // gdlr-skill-item-wrapper		
			
			}
			
			return $ret;
		}
	}	
	
	// price table item
	if( !function_exists('gdlr_get_price_table_item') ){
		function gdlr_get_price_table_item( $settings ){
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';
			
			global $gdlr_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';			
			
			$settings['price-table'] = empty($settings['price-table'])? array(): $settings['price-table'];
			$list = is_array($settings['price-table'])? $settings['price-table']: json_decode($settings['price-table'], true);
			$ret  = '<div class="gdlr-item gdlr-price-table-item" ' . $item_id . $margin_style . '>';
			foreach( $list as $tab ){ 
				$best_price = ($tab['gdl-tab-active'] == 'yes')? ' best-price ': '';
				
				$ret .= '<div class="gdlr-price-item ' . gdlr_get_column_class('1/' . $settings['columns']) . '">';
				$ret .= '<div class="gdlr-price-inner-item ' . $best_price . '">';
				
				$ret .= '<div class="price-title-wrapper">';
				$ret .= '<h4 class="price-title">' . gdlr_text_filter($tab['gdl-tab-title']) . '</h4>';
				$ret .= '<div class="price-tag">' . gdlr_text_filter($tab['gdl-tab-price']) . '</div>';
				$ret .= '</div>';
				
				$ret .= '<div class="price-content">' . gdlr_content_filter($tab['gdl-tab-content']) . '</div>';
				
				if(!empty($tab['gdl-tab-link'])){
					$ret .= '<div class="price-button">';
					$ret .= '<a class="gdlr-button without-border" href="' . esc_url($tab['gdl-tab-link']) . '">' . __('Buy Now', 'gdlr_translate') . '</a>';
					$ret .= '</div>';
				}
				
				$ret .= '</div>'; // gdlr-price-inner-item
				$ret .= '</div>'; // gdlr-price-item
			}
			$ret .= '<div class="clear"></div>';
			$ret .= '</div>';
			
			return $ret;
		}
	}
	
	// pie chart item
	if( !function_exists('gdlr_get_pie_chart_item') ){
		function gdlr_get_pie_chart_item( $settings ){	
			global $gdlr_spaces;
			wp_enqueue_script('jquery-easypiechart', GDLR_PATH . '/plugins/easy-pie-chart/jquery.easy-pie-chart.js', array(), '1.0', true);
			
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';

			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';
			
			$ret  = '<div class="gdlr-item gdlr-pie-chart-item" ' . $item_id . $margin_style . '>';
			
			$ret .= '<div class="gdlr-chart gdlr-ux" data-percent="' . $settings['progress'] . '" data-size="155" data-linewidth="8" ';
			$ret .= 'data-color="' . $settings['color'] . '" data-bg-color="' . $settings['bg-color'] . '" >';
			$ret .= '<div class="chart-content-wrapper">';
			$ret .= '<div class="chart-content-inner">';
			$ret .= '<span class="chart-content" ><i class="' . $settings['icon'] . '" ></i></span>';
			$ret .= '<span class="chart-percent-number" style="color:' . $settings['color'] . ';" >' . $settings['progress'] . '%' . '</span>';
			$ret .= '</div>';			
			$ret .= '</div>';			
			$ret .= '</div>';			
			
			$ret .= '<h4 class="pie-chart-title">' . gdlr_text_filter($settings['title']) . '</h4>';
			$ret .= '<div class="pie-chart-content">';
			$ret .= gdlr_content_filter($settings['content']);
			if( !empty($settings['learn-more-link']) ){
				$ret .= '<a href="' . esc_url($settings['learn-more-link']) . '" ';
				$ret .= 'class="pie-chart-learn-more">' . __('Learn More', 'gdlr_translate') . '</a>';	
			}
			$ret .= '</div>'; // pie-chart-content
			
			$ret .= '</div>'; // gdlr-item
			return $ret;
		}
	}
	
	// tab item
	if( !function_exists('gdlr_get_tab_item') ){
		function gdlr_get_tab_item( $settings ){
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';

			global $gdlr_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';
			
			$tabs = is_array($settings['tab'])? $settings['tab']: json_decode($settings['tab'], true);			
			$current_tab = 0;

			$ret  = gdlr_get_item_title($settings);	
			$ret .= '<div class="gdlr-item gdlr-tab-item '  . $settings['style'] . '" ' . $item_id . $margin_style . '>';
			$ret .= '<div class="tab-title-wrapper" >';
			foreach( $tabs as $tab ){  $current_tab++;
				$ret .= '<h4 class="tab-title';
				$ret .= ($current_tab == intval($settings['initial-state']))? ' active" ': '" ';
				$ret .= empty($tab['gdl-tab-title-id'])? '>': 'id="' . $tab['gdl-tab-title-id'] . '" >';
				$ret .= empty($tab['gdl-tab-icon-title'])? '': '<i class="' . $tab['gdl-tab-icon-title'] . '" ></i>';				
				$ret .= '<span>' . gdlr_text_filter($tab['gdl-tab-title']) . '</span></h4>';				
			}
			$ret .= '</div>';
			
			$current_tab = 0;
			$ret .= '<div class="tab-content-wrapper" >';
			foreach( $tabs as $tab ){  $current_tab++;
				$ret .= '<div class="tab-content';
				$ret .= ($current_tab == intval($settings['initial-state']))? ' active" >': '" >';
				$ret .= gdlr_content_filter($tab['gdl-tab-content']) . '</div>';
							
			}	
			$ret .= '</div>';	
			$ret .= '<div class="clear"></div>';
			$ret .= '</div>'; // gdlr-tab-item 
			
			return $ret;
		}
	}		
	
	// stunning text item
	if( !function_exists('gdlr_get_stunning_text_item') ){
		function gdlr_get_stunning_text_item( $settings ){
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';
			$class  = empty($settings['button-link'])? '': ' gdlr-button-on';
			$class .= empty($settings['style'])? ' type-normal': ' type-' . $settings['style'];

			global $gdlr_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';
			
			$ret  = '<div class="gdlr-stunning-text-ux gdlr-ux">';
			$ret .= '<div class="gdlr-item gdlr-stunning-text-item' . $class . '" ' . $item_id . $margin_style . '>';
			$ret .= '<h2 class="stunning-text-title">' . gdlr_text_filter($settings['title']) . '</h2>';
			$ret .= '<div class="stunning-text-caption gdlr-skin-content">' . gdlr_content_filter($settings['caption']) . '</div>';
			if( !empty($settings['button-link']) ){
				$ret .= '<a class="stunning-text-button gdlr-button with-border" href="' . esc_url($settings['button-link']) . '" target="_blank" >';
				$ret .= $settings['button-text'];
				$ret .= '</a>';
			}
			$ret .= '</div>'; // gdlr-item
			$ret .= '</div>'; // gdlr-ux
			
			return $ret;
		}
	}	

	if( !function_exists('gdlr_get_divider_item') ){
		function gdlr_get_divider_item( $settings ){
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';
			
			global $gdlr_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-divider-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';
			
			$style = empty($settings['size'])? '': ' style="width: ' . $settings['size'] . ';" ';
			$ret  = '<div class="clear"></div>';
			$ret .= '<div class="gdlr-item gdlr-divider-item" ' . $item_id . $margin_style . ' >';
			$ret .= '<div class="gdlr-divider ' . $settings['type'] . '" ' . $style . '></div>';
			$ret .= '</div>';					
			
			return $ret;
		}
	}
	
	// boxed icon item
	if( !function_exists('gdlr_get_box_icon_item') ){
		function gdlr_get_box_icon_item( $settings ){
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';
			
			global $gdlr_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';
			
			$ret  = '<div class="gdlr-box-with-icon-ux gdlr-ux">';
			$ret .= '<div class="gdlr-item gdlr-box-with-icon-item pos-' . $settings['icon-position'];
			$ret .=	' type-' . $settings['icon-type'] . '" ' . $item_id . $margin_style . '>';
			
			
			$ret .= ($settings['icon-type'] == 'circle')? '<div class="box-with-circle-icon" style="background-color: ' . $settings['icon-background'] . '">': '';
			$style = empty($settings['icon-color'])? '': ' style="color:' . $settings['icon-color'] . ';" ';
			$ret .= '<i class="' . $settings['icon'] . '" ' . $style . '></i><br>';
			$ret .= ($settings['icon-type'] == 'circle')? '</div>': '';
			
			$ret .= '<h4 class="box-with-icon-title">' . gdlr_text_filter($settings['title']) . '</h4>';
			$ret .= '<div class="clear"></div>';
			$ret .= '<div class="box-with-icon-caption">' . gdlr_content_filter($settings['content']) . '</div>';
			$ret .= '</div>'; // gdlr-item	
			$ret .= '</div>'; // gdlr-ux
			
			return $ret;
		}
	}
	
	
	// styled box item
	if( !function_exists('gdlr_get_styled_box_item') ){
		function gdlr_get_styled_box_item( $settings ){
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';
			$style  = 'color: ' . $settings['content-color'] . '; ';
			$style .= empty($settings['height'])? '': 'height: ' . $settings['height'] . '; ';

			global $gdlr_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';
			
			$ret  = '<div class="gdlr-styled-box-item-ux gdlr-ux" >';
			$ret .= '<div class="gdlr-item gdlr-styled-box-item" ' . $item_id . $margin_style . '>';
			if($settings['type'] == 'color'){
				if(!empty($settings['flip-corner']) && $settings['flip-corner'] == 'enable'){
					$ret .= '<div class="gdlr-styled-box-head-wrapper" >';
					$ret .= '<div class="gdlr-styled-box-corner" style="border-bottom-color:' . $settings['corner-color'] . ';" ></div>';
					$ret .= '<div class="gdlr-styled-box-head" style="background-color:' . $settings['background-color'] . ';" ></div>';
					$ret .= '</div>';
					$ret .= '<div class="gdlr-styled-box-body with-head" style="background-color:' . $settings['background-color'] . '; ' . $style . '" >';
				}else{
					$ret .= '<div class="gdlr-styled-box-body" style="background-color:' . $settings['background-color'] . '; ' . $style . '" >';
				}
				
			}else if( $settings['type'] == 'image' ){
				if( is_numeric($settings['background-image']) ){ 
					$thumbnail = wp_get_attachment_image_src($settings['background-image'], 'full');
					$file_url = $thumbnail[0];
				}else{
					$file_url = $settings['background-image'];
				}			
				$ret .= '<div class="gdlr-styled-box-body" style="background-image: url(\'' . $file_url . '\'); ' . $style . '" >';
			}
			$ret .= gdlr_content_filter($settings['content']);
			$ret .= '</div>'; // gdlr-styled-box-body
			$ret .= '</div>'; // gdlr-item
			$ret .= '</div>'; // gdlr-ux
			return $ret;
		}
	}		
	
	// testimonial item
	if( !function_exists('gdlr_get_testimonial_item') ){
		function gdlr_get_testimonial_item( $settings ){
			if( $settings['testimonial-type'] == 'carousel' ){
				return gdlr_get_carousel_testimonial_item($settings);
			}else{
				return gdlr_get_static_testimonial_item($settings);
			}
		}
	}		
	if( !function_exists('gdlr_get_static_testimonial_item') ){
		function gdlr_get_static_testimonial_item( $settings ){	
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';	

			global $gdlr_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';
			
			$settings['testimonial'] = empty($settings['testimonial'])? array(): $settings['testimonial'];
			$list = is_array($settings['testimonial'])? $settings['testimonial']: json_decode($settings['testimonial'], true);
			$item_size = intval($settings['testimonial-columns']);
			
			$current_size = 0;

			$ret  = gdlr_get_item_title($settings);	
			$ret .= '<div class="gdlr-testimonial-item-wrapper" ' . $item_id . $margin_style . '>';
			foreach( $list as $tab ){ 
				if( $current_size % $item_size == 0 ){
					$ret .= '<div class="clear"></div>';
				}	
				
				$ret .= '<div class="' . gdlr_get_column_class('1/' . $item_size) . '">';
				$ret .= '<div class="gdlr-item gdlr-testimonial-item ' . $settings['testimonial-style'] . '">';
				$ret .= '<div class="gdlr-ux gdlr-testimonial-ux">';
				$ret .= '<div class="testimonial-item">';

				if( strpos($settings['testimonial-style'], 'plain-style') === false ){ // hide this in plain style
					$ret .= '<div class="testimonial-item-inner gdlr-skin-box">';
				}

				$ret .= '<div class="testimonial-content gdlr-skin-content">' . gdlr_content_filter($tab['gdl-tab-content']) . '</div>';
				$ret .= '<div class="testimonial-info">';
				if( !empty($tab['gdl-tab-title'] ) ){
					$ret .= '<span class="testimonial-author gdlr-skin-link-color">' . gdlr_text_filter($tab['gdl-tab-title']) . '</span>';
				}
				if( !empty($tab['gdl-tab-position']) ){
					$ret .= '<span class="testimonial-position gdlr-skin-info">';
					$ret .= (!empty($tab['gdl-tab-title']))? '<span>, </span>': '';
					$ret .= gdlr_text_filter($tab['gdl-tab-position']) . '</span>';
				}
				$ret .= '</div>'; // testimonial-info
				
				if( strpos($settings['testimonial-style'], 'plain-style') === false ){ // hide this in plain style
					$ret .= '<div class="testimonial-author-image gdlr-skin-border" >';
					$ret .= gdlr_get_image($tab['gdl-tab-author-image'], 'thumbnail');
					$ret .= '</div>';
					
					$ret .= '</div>'; // testimonial-item-inner
				}
				
				$ret .= '</div>'; // testimonial-item
				$ret .= '</div>'; // gdlr-ux
				$ret .= '</div>'; // gdlr-item
				$ret .= '</div>'; // gdlr-get-column-class
				$current_size ++;
			}
			
			$ret .= '<div class="clear"></div>';
			$ret .= '</div>';
			return $ret;
		}
	}
	if( !function_exists('gdlr_get_carousel_testimonial_item') ){
		function gdlr_get_carousel_testimonial_item( $settings ){	
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';

			global $gdlr_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';			
			
			$settings['testimonial'] = empty($settings['testimonial'])? array(): $settings['testimonial'];
			$list = is_array($settings['testimonial'])? $settings['testimonial']: json_decode($settings['testimonial'], true);
			$ret  = '<div class="gdlr-testimonial-item-wrapper" ' . $item_id . $margin_style . '>';
			
			$settings['carousel'] = true;
			$ret .= gdlr_get_item_title($settings);							
			$ret .= '<div class="gdlr-item gdlr-testimonial-item carousel ' . $settings['testimonial-style'] . '">';
			$ret .= '<div class="gdlr-ux gdlr-testimonial-ux">';
			$ret .= '<div class="flexslider" data-type="carousel" data-nav-container="gdlr-testimonial-item" ';
			$ret .= 'data-columns="' . $settings['testimonial-columns'] . '" >';
			$ret .= '<ul class="slides" >';
			foreach( $list as $tab ){ 
				$ret .= '<li class="testimonial-item">';
				if( strpos($settings['testimonial-style'], 'plain-style') === false ){ // hide this in plain style
					$ret .= '<div class="testimonial-item-inner gdlr-skin-box">';
				}

				$ret .= '<div class="testimonial-content gdlr-skin-content">' . gdlr_content_filter($tab['gdl-tab-content']) . '</div>';
				$ret .= '<div class="testimonial-info">';
				if( !empty($tab['gdl-tab-title'] ) ){
					$ret .= '<span class="testimonial-author gdlr-skin-link-color">' . gdlr_text_filter($tab['gdl-tab-title']) . '</span>';
				}
				if( !empty($tab['gdl-tab-position']) ){
					$ret .= '<span class="testimonial-position gdlr-skin-info">';
					$ret .= (!empty($tab['gdl-tab-title']))? '<span>, </span>': '';
					$ret .= gdlr_text_filter($tab['gdl-tab-position']) . '</span>';
				}
				$ret .= '</div>'; // testimonial-info
				
				if( strpos($settings['testimonial-style'], 'plain-style') === false ){ // hide this in plain style
					$ret .= '<div class="testimonial-author-image gdlr-skin-border" >';
					$ret .= gdlr_get_image($tab['gdl-tab-author-image'], 'thumbnail');
					$ret .= '</div>';
					
					$ret .= '</div>'; // testimonial-item-inner
				}
				$ret .= '</li>';
			}
			$ret .= '</ul>';
			$ret .= '</div>'; // flexslider
			$ret .= '</div>'; // gdlr-ux
			$ret .= '</div>'; // gdlr-testimonial-item
			$ret .= '</div>'; // gdlr-testimonial-item-wrapper
			
			return $ret;
		}
	}	
	
	// personnel item
	if( !function_exists('gdlr_get_personnel_item') ){
		function gdlr_get_personnel_item( $settings ){
			if( $settings['personnel-style'] == 'box-style' ){
				$settings['thumbnail-size'] == 'thumbnail';
			}
		
			if( $settings['personnel-type'] == 'carousel' ){
				return gdlr_get_carousel_personnel_item($settings);
			}else{
				return gdlr_get_static_personnel_item($settings);
			}
		}
	}		
	if( !function_exists('gdlr_get_static_personnel_item') ){
		function gdlr_get_static_personnel_item( $settings ){	
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';

			global $gdlr_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';			
			
			$settings['personnel'] = empty($settings['personnel'])? array(): $settings['personnel'];
			$list = is_array($settings['personnel'])? $settings['personnel']: json_decode($settings['personnel'], true);
			$item_size = intval($settings['personnel-columns']);
			
			$current_size = 0; 
			
			$ret  = gdlr_get_item_title($settings);	
			$ret .= '<div class="gdlr-personnel-item-wrapper" ' . $item_id . $margin_style . '>';
			foreach( $list as $tab ){ 
				if( $current_size % $item_size == 0 ){
					$ret .= '<div class="clear"></div>';
				}			
				
				$ret .= '<div class="' . gdlr_get_column_class('1/' . $item_size) . '">';
				$ret .= '<div class="gdlr-item gdlr-personnel-item ' . $settings['personnel-style'] . '">';
				$ret .= '<div class="gdlr-ux gdlr-personnel-ux">';
				$ret .= '<div class="personnel-item">';
				
				if( $settings['personnel-style'] == 'round-style' ){
					$ret .= '<div class="personnel-author-image" >';
					$ret .= gdlr_get_image($tab['gdl-tab-author-image'], $settings['thumbnail-size']);
					$ret .= '</div>';	
				}
				
				if( $settings['personnel-style'] != 'plain-style' ){ // hide this in plain style
					$ret .= '<div class="personnel-item-inner gdlr-skin-box">';
				}
				if( $settings['personnel-style'] != 'round-style' ){
					$ret .= '<div class="personnel-author-image gdlr-skin-border" >';
					$ret .= gdlr_get_image($tab['gdl-tab-author-image'], $settings['thumbnail-size']);
					$ret .= '</div>';		
				}
				
				$ret .= '<div class="personnel-info">';
				if( !empty($tab['gdl-tab-title'] ) ){
					$ret .= '<div class="personnel-author gdlr-skin-title">' . gdlr_text_filter($tab['gdl-tab-title']) . '</div>';
				}
				if( !empty($tab['gdl-tab-position']) ){
					$ret .= '<div class="personnel-position gdlr-skin-info">' . gdlr_text_filter($tab['gdl-tab-position']) . '</div>';
				}
				$ret .= '</div>'; // personnel-info
				
				$ret .= '<div class="personnel-content gdlr-skin-content">' . gdlr_content_filter($tab['gdl-tab-content']) . '</div>';

				if( !empty($tab['gdl-tab-social-list']) ){
					$ret .= '<div class="personnel-social">';
					$ret .= gdlr_text_filter($tab['gdl-tab-social-list']);
					$ret .= '</div>';
				}
				if( $settings['personnel-style'] != 'plain-style' ){ // hide this in plain style
					$ret .= '</div>'; // personnel-item-inner
				}
				
				$ret .= '</div>'; // personnel-item
				$ret .= '</div>'; // gdlr-ux
				$ret .= '</div>'; // gdlr-item
				$ret .= '</div>'; // gdlr-get-column-class
				$current_size ++;
			}
			
			$ret .= '<div class="clear"></div>';
			$ret .= '</div>';
			
			return $ret;
		}
	}
	if( !function_exists('gdlr_get_carousel_personnel_item') ){
		function gdlr_get_carousel_personnel_item( $settings ){	
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';
			
			global $gdlr_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';
			
			$settings['carousel'] = true;
			$settings['personnel'] = empty($settings['personnel'])? array(): $settings['personnel'];
			$list = is_array($settings['personnel'])? $settings['personnel']: json_decode($settings['personnel'], true);

			$ret  = '<div class="gdlr-personnel-item-wrapper" ' . $item_id . $margin_style . '>';
			$ret .= gdlr_get_item_title($settings);		
			$ret .= '<div class="gdlr-item gdlr-personnel-item carousel ' . $settings['personnel-style'] . '">';
			$ret .= '<div class="gdlr-ux gdlr-personnel-ux">';
			$ret .= '<div class="flexslider" data-type="carousel" data-nav-container="gdlr-personnel-item" ';
			$ret .= 'data-columns="' . $settings['personnel-columns'] . '" >';
			$ret .= '<ul class="slides" >';
			foreach( $list as $tab ){ 
				$ret .= '<li class="personnel-item">';
				
				if( $settings['personnel-style'] == 'round-style' ){
					$ret .= '<div class="personnel-author-image" >';
					$ret .= gdlr_get_image($tab['gdl-tab-author-image'], $settings['thumbnail-size']);
					$ret .= '</div>';	
				}				
				
				if( $settings['personnel-style'] != 'plain-style' ){ // hide this in plain style
					$ret .= '<div class="personnel-item-inner gdlr-skin-box">';
				}
				
				if( $settings['personnel-style'] != 'round-style' ){
					$ret .= '<div class="personnel-author-image gdlr-skin-border" >';
					$ret .= gdlr_get_image($tab['gdl-tab-author-image'], $settings['thumbnail-size']);
					$ret .= '</div>';				
				}

				$ret .= '<div class="personnel-info">';
				if( !empty($tab['gdl-tab-title'] ) ){
					$ret .= '<div class="personnel-author gdlr-skin-title">' . gdlr_text_filter($tab['gdl-tab-title']) . '</div>';
				}
				if( !empty($tab['gdl-tab-position']) ){
					$ret .= '<div class="personnel-position gdlr-skin-info">' . gdlr_text_filter($tab['gdl-tab-position']) . '</div>';
				}
				$ret .= '</div>'; // personnel-info
				
				$ret .= '<div class="personnel-content gdlr-skin-content">' . gdlr_content_filter($tab['gdl-tab-content']) . '</div>';

				if( !empty($tab['gdl-tab-social-list']) ){
					$ret .= '<div class="personnel-social">';
					$ret .= gdlr_text_filter($tab['gdl-tab-social-list']);
					$ret .= '</div>';
				}
				if( $settings['personnel-style'] != 'plain-style' ){ // hide this in plain style
					$ret .= '</div>'; // personnel-item-inner
				}
				$ret .= '</li>';
			}
			$ret .= '</ul>';
			$ret .= '</div>'; // flexslider
			$ret .= '</div>'; // gdlr-ux
			$ret .= '</div>'; // gdlr-personnel-item
			$ret .= '</div>'; // gdlr-personnel-item-wrapper
			
			return $ret;
		}
	}			
	
	// page list item
	if( !function_exists('gdlr_get_page_list_item') ){
		function gdlr_get_page_list_item( $settings ){	
			if(function_exists('gdlr_include_portfolio_scirpt')){ gdlr_include_portfolio_scirpt(); }
		
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';
		
			global $gdlr_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-blog-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';

			$ret  = gdlr_get_item_title($settings);	
			$ret .= '<div class="portfolio-item-wrapper type-' . $settings['page-style'] . '" ' . $item_id . $margin_style . '>'; 
			
			// query section
			$args = array('post_type' => 'page', 'suppress_filters' => false);
			$args['posts_per_page'] = (empty($settings['num-fetch']))? '5': $settings['num-fetch'];
			$args['orderby'] = 'menu_order';
			$args['order'] = 'asc';
			$args['paged'] = (get_query_var('paged'))? get_query_var('paged') : 1;
			if( !empty($settings['category']) ){
				$args['tax_query'] = array( 
					array('terms'=>explode(',', $settings['category']), 'taxonomy'=>'page_category', 'field'=>'slug')
				);		
			}		

			$query = new WP_Query( $args );	
				
			// print item section
			$settings['item-size'] = str_replace('1/', '', $settings['item-size']);
			
			$ret .= '<div class="portfolio-item-holder">';
			if($settings['page-style'] == 'classic'){
				$ret .= gdlr_get_classic_page_list($query, $settings['item-size'], 
							$settings['thumbnail-size'], $settings['page-layout'] );
			}else if($settings['page-style'] == 'modern'){	
				$ret .= gdlr_get_modern_page_list($query, $settings['item-size'], 
							$settings['thumbnail-size'], $settings['page-layout'] );
			}
			$ret .= '<div class="clear"></div>';
			$ret .= '</div>';	

			if($settings['pagination'] == 'enable'){
				$ret .= gdlr_get_pagination($query->max_num_pages, $args['paged']);
			}
			
			$ret .= '</div>'; // portfolio-item-wrapper
			return $ret;
			
		}
	}
	
	// print classic page list
	if( !function_exists('gdlr_get_classic_page_list') ){
		function gdlr_get_classic_page_list($query, $size, $thumbnail_size, $layout = 'fitRows'){
			$current_size = 0;
			$ret  = '<div class="gdlr-isotope" data-type="portfolio" data-layout="' . $layout  . '" >';
			while($query->have_posts()){ $query->the_post();
				if( $current_size % $size == 0 ){
					$ret .= '<div class="clear"></div>';
				}			
    
				$ret .= '<div class="' . gdlr_get_column_class('1/' . $size) . '">';
				$ret .= '<div class="gdlr-item gdlr-portfolio-item gdlr-classic-portfolio">';
				
				$ret .= '<div class="portfolio-thumbnail gdlr-image">';
				$ret .= gdlr_get_image(get_post_thumbnail_id(), $thumbnail_size);
				$ret .= '<a class="portfolio-overlay-wrapper" href="' . get_permalink() . '" >';
				$ret .= '<span class="portfolio-overlay" ></span>';
				$ret .= '<span class="portfolio-icon" ><i class="icon-link" ></i></span>';
				$ret .= '</a>';	
				$ret .= '</div>'; // portfolio-thumbnail
 
				$ret .= '<div class="portfolio-content-wrapper">';
				$ret .= '<h3 class="portfolio-title"><a href="' . get_permalink() . '" >' . get_the_title() . '</a></h3>';
				$ret .= '</div>';
				
				$ret .= '</div>';				
				$ret .= '</div>';
				$current_size ++;
			}
			$ret .= '</div>';
			wp_reset_postdata();
			
			return $ret;
		}
	}	

	// print modern page list
	if( !function_exists('gdlr_get_modern_page_list') ){
		function gdlr_get_modern_page_list($query, $size, $thumbnail_size, $layout = 'fitRows'){
			$current_size = 0;
			$ret  = '<div class="gdlr-isotope" data-type="portfolio" data-layout="' . $layout  . '" >';
			while($query->have_posts()){ $query->the_post();
				if( $current_size % $size == 0 ){
					$ret .= '<div class="clear"></div>';
				}	
    
				$ret .= '<div class="' . gdlr_get_column_class('1/' . $size) . '">';
				$ret .= '<div class="gdlr-item gdlr-portfolio-item gdlr-modern-portfolio">';
				
				// overlay
				$ret .= '<div class="portfolio-thumbnail gdlr-image">';
				$ret .= gdlr_get_image(get_post_thumbnail_id(), $thumbnail_size);
				$ret .= '<a class="portfolio-overlay-wrapper" href="' . get_permalink() . '" >';
				$ret .= '<span class="portfolio-overlay" >';
				$ret .= '<span class="portfolio-icon" ><i class="icon-link" ></i></span>';
				$ret .= '</span>';
				$ret .= '<div class="portfolio-thumbnail-bar"></div>';
				$ret .= '</a>';	
				
				// content
				$ret .= '<div class="portfolio-content-wrapper">';
				$ret .= '<div class="portfolio-content-overlay"></div>';
				$ret .= '<h3 class="portfolio-title"><a href="' . get_permalink() . '" >' . get_the_title() . '</a></h3>';
				$ret .= '</div>'; // portfolio-content-wrapper
				$ret .= '</div>'; // portfolio-thumbnail	
				
				$ret .= '</div>'; // gdlr-item				
				$ret .= '</div>'; // column class
				$current_size ++;
			}
			$ret .= '</div>';
			wp_reset_postdata();
			
			return $ret;
		}
	}		
?>