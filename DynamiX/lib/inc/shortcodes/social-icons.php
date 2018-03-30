<?php

/* ------------------------------------
:: SOCIAL ICONS
------------------------------------*/

	class WPBakeryShortCode_Socialicon extends WPBakeryShortCode {
		protected  $predefined_atts = array(
					'url' => '',
					'name' => '',
					);
		public function content( $atts, $content = null ) {
			$title = $tab_id = '';
			extract(shortcode_atts(array(
					'url' => '',
					'name' => '',
			), $atts));
	
			$output = '';

			require NV_FILES .'/adm/inc/social-media-urls.php'; // get social media button links

			// Get Social Icons
			$get_social_icons = social_icon_data();
			
			foreach( $get_social_icons as $social_icon => $value )
			{
				$icon_id = str_replace( 'sociallink_','',$social_icon );
				
				if( $icon_id == $name )
				{
					if( $url !='' )
					{
						$sociallink = $url;
					}
					else
					{
						$sociallink = getsociallink( ${'sociallink_'.$name} );
					}
					
					$icon_name = '';
					$icon_name = strtolower( str_replace('.','',$value['name'] ) );
				
					
					if( $icon_name == 'vimeo' ) $icon_name = 'vimeo-square';
					if( $icon_name == 'email' ) $icon_name = 'envelope';
					if( $icon_name == 'google' ) $icon_name = 'google-plus';
						
					$output .= "\n\t\t". '<li class="dock-tab social-'. strtolower( str_replace('.','',$value['name'] ) ) .'">';
					$output .= "\n\t\t\t". '<a href="'. str_replace(' ', '%20', $sociallink) .'" title="'. $value['name'] .'" target="_blank"><i class="social-icon fa fa-lg fa-'. $icon_name .'"></i></a>';
					$output .= "\n\t\t". '</li>';
					
				}
			}
	
			return $output;
		}

		public function mainHtmlBlockParams($width, $i) {
			return 'data-element_type="'.$this->settings["base"].'" class=" wpb_'.$this->settings['base'].'"'.$this->customAdminBlockParams();
		}
		public function containerHtmlBlockParams($width, $i) {
			return 'class="wpb_column_container vc_container_for_children"';
		}
		protected function outputTitle($title) {
			return  '';
		}
	
		public function customAdminBlockParams() {
			return '';
		}
	
	}

	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_Socialwrap extends WPBakeryShortCodesContainer {

			protected function content( $atts, $content = null ) {
	
				$align = $share_icon = $el_position = $el_class = '';
				//
				extract(shortcode_atts(array(
					'align' => '',
					'share_icon' => '',
					'el_class' => '',
				), $atts));
				
				$output = '';
		
				$el_class = $this->getExtraClass($el_class);
	
				if( $share_icon == 'yes' )
				{
					$output .= "\n\t".'<div class="socialicons init '. $align .' '. $el_class .' clearfix">';
					$output .= "\n\t\t".'<ul>';
					$output .= "\n\t\t\t".'<li class="dock-tab"><a class="socialinit" href="#"><i class="fa fa-share-square-o fa-lg"></i></a></li>';
					$output .= "\n\t\t".'</ul>';
					
					$output .= "\n\t".'<div class="socialicons '.$align.' '. $el_class .' toggle">';
					$output .= "\n\t\t".'<ul>';
					$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
					$output .= "\n\t\t".'</ul>';
					$output .= "\n\t".'</div>';
					$output .= "\n\t".'</div>';
				}
				else
				{
					$output .= "\n\t".'<div class="socialicons display '.$align.' '. $el_class .' clearfix">';
					$output .= "\n\t\t".'<ul>';
					$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
					$output .= "\n\t\t".'</ul>';
					$output .= "\n\t".'</div>';
					$output .= "\n\t".'<div class="clear"></div>';				
				}
	
				return $output;
			}
		}
	}

	/* ------------------------------------
	:: SOCIAL ICONS MAP
	------------------------------------*/	

	wpb_map( array(
		"name"		=> __("Social Icons", "js_composer"),
		"base"		=> "socialwrap",
		"show_settings_on_create" => false,
		"content_element" => true,
		"as_parent" => array('only' => 'socialicon'), // Use only|except attributes 
		"category"  => __('Social', 'js_composer'),
		"wrapper_class" => "clearfix nv_options social_wrap",
		"params"	=> array(
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Share Icon", "js_composer"),
				"param_name" => "share_icon",
				"value" =>  array(
					__('Enable', "js_composer") => "yes", 
				)
			),	
			array(
				"type" => "dropdown",
				"heading" => __("Align", "js_composer"),
				"param_name" => "align",
				"value" => array(
					__('Left', "js_composer") => 'left',
					__('Center', "js_composer") => 'center', 
					__('Right', "js_composer") => 'right', 

				),
			),				
			array(
				"type" => "textfield",
				"heading" => __("Extra class name", "js_composer"),
				"param_name" => "el_class",
				"value" => "",
				"description" => __("Add custom CSS classes to the above field: <br /><br />
				<strong>color</strong> = Color Social Icons <br />", "js_composer")
			)
		),
		"js_view" => 'VcColumnView'
	) );
	
	
	// Get Social Icons
	$get_social_icons = social_icon_data();
	
	foreach( $get_social_icons as $social_icon => $value )
	{
		$social_icons[ $value['name'] ] = str_replace('sociallink_','',$social_icon);
	}
	
	wpb_map( array(
		"name"		=> __("Social Icon", "js_composer"),
		"base"		=> "socialicon",
		"content_element" => true,
		"as_child" => array('only' => 'socialwrap'), // Use only|except attributes 
		"params"	=> array(
			array(
				"type" => "dropdown",
				"heading" => __("Social Icon", "js_composer"),
				"holder" => "h4",
				"param_name" => "name",
				"value" => $social_icons,
				"description" => __("Select color of the toggle icon.", "js_composer")
			),				
			array(
				"type" => "textfield",
				"heading" => __("Link URL", "js_composer"),
				"param_name" => "url",
				"value" => "",
				"description" => __("Optional Link URL", "js_composer")
			),	
		)
	) );
	
	//add_shortcode('socialwrap', 'socialicons_shortcode');
	//add_shortcode('socialicon', 'socialicons_shortcode');