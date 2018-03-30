<?php
	/*	
	*	Goodlayers Layerslider Support File
	*/
	
	if(!function_exists('gdlr_get_layerslider_list')){
		function gdlr_get_layerslider_list(){
			if( !function_exists('lsSliders') ) return;
		
			$ret = array();
			$sliders = lsSliders();
			foreach($sliders as $slider){
				$ret[$slider['id']] = $slider['name'];
			}
			return $ret;
		}
	}
	
	add_action('gdlr_print_item_selector', 'gdlr_check_layerslider_item', 10, 2);
	if( !function_exists('gdlr_check_layerslider_item') ){
		function gdlr_check_layerslider_item( $type, $settings = array() ){
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';

			global $gdlr_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';	
		
			if($type == 'layer-slider'){
				echo '<div class="gdlr-layerslider-item gdlr-slider-item gdlr-item" ' . $item_id . $margin_style . ' >';
				echo '<div class="gdlr-ls-shadow gdlr-top" ></div>';
				echo do_shortcode('[layerslider id="' . $settings['id'] . '"]');
				echo '<div class="gdlr-ls-shadow gdlr-bottom" ></div>';
				echo '</div>';
			}
		}
	}	
	
	add_action('layerslider_ready', 'gdlr_layerslider_overrides');
	if( !function_exists('gdlr_layerslider_overrides') ){
		function gdlr_layerslider_overrides() {
			$GLOBALS['lsAutoUpdateBox'] = false;
		}
	}
	
?>