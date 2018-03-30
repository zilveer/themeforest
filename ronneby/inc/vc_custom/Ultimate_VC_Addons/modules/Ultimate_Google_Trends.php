<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Ultimate Google Trends
* Add-on URI: https://www.brainstormforce.com
*/
global $dfd_ronneby;
if(isset($dfd_ronneby['enable_default_addons']) && strcmp($dfd_ronneby['enable_default_addons'], '1') === 0){
	if(!class_exists('Ultimate_Google_Trends')){
		class Ultimate_Google_Trends{
			function __construct(){
				add_action('init',array($this,'google_trends_init'));
				add_shortcode('ultimate_google_trends',array($this,'display_ultimate_trends'));
			}
			function google_trends_init(){
				if ( function_exists('vc_map')) {
					vc_map( array(
						'name' => __('Google Trends', 'dfd'),
						'base' => 'ultimate_google_trends',
						'class' => 'vc_google_trends',
						'controls' => 'full',
						'show_settings_on_create' => true,
						'icon' => 'vc_google_trends',
						'description' => __('Display Google Trends to show insights.', 'dfd'),
						'category' => 'Ultimate VC Addons',
						'params' => array(
							array(
								'type' => 'textarea',
								'class' => '',
								'heading' => __('Comparison Terms', 'dfd'),
								'param_name' => 'gtrend_query',
								'value' => '',
								'description' => __('Enter maximum 5 terms separated by comma. Example:','dfd').' <em>'.__('Google, Facebook, LinkedIn','dfd').'</em>',	
								//'dependency' => Array('element' => 'search_by','value' => array('q')),				
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Location', 'dfd'),
								'param_name' => 'location_by',
								'admin_label' => true,
								'value' => array(
									__('Worldwide', 'dfd') => '', 
									__('Argentina', 'dfd') => 'AR', 
									__('Australia', 'dfd') => 'AU',
									__('Austria', 'dfd') => 'AT', 
									__('Bangladesh', 'dfd') => 'BD',
									__('Belgium', 'dfd') => 'BE', 
									__('Brazil', 'dfd') => 'BR',
									__('Bulgaria', 'dfd') => 'BG', 
									__('Canada', 'dfd') => 'CA',
									__('Chile', 'dfd') => 'CL', 
									__('China', 'dfd') => 'CN',
									__('Colombia', 'dfd') => 'CO', 
									__('Costa Rica', 'dfd') => 'CR',
									__('Croatia', 'dfd') => 'HR', 
									__('Czech Republic', 'dfd') => 'CZ',
									__('Denmark', 'dfd') => 'DK', 
									__('Dominican Republic', 'dfd') => 'DO',
									__('Ecuador', 'dfd') => 'EC', 
									__('Egypt', 'dfd') => 'EG',
									__('El Salvador', 'dfd') => 'SV', 
									__('Estonia', 'dfd') => 'EE',
									__('Finland', 'dfd') => 'FI', 
									__('France', 'dfd') => 'FR',
									__('Germany', 'dfd') => 'DE', 
									__('Ghana', 'dfd') => 'GH',
									__('Greece','dfd') => 'GR',
									__('Guatemala', 'dfd') => 'GT', 
									__('Honduras', 'dfd') => 'HN',
									__('Hong Kong', 'dfd') => 'HK', 
									__('Hungary', 'dfd') => 'HU',
									__('India', 'dfd') => 'IN', 
									__('Indonesia', 'dfd') => 'ID', 
									__('Ireland', 'dfd') => 'IE',
									__('Israel', 'dfd') => 'IL', 
									__('Italy', 'dfd') => 'IT',
									__('Japan', 'dfd') => 'JP', 
									__('Kenya', 'dfd') => 'KE',
									__('Latvia', 'dfd') => 'LV', 
									__('Lithuania', 'dfd') => 'LT',
									__('Malaysia', 'dfd') => 'MY', 
									__('Mexico', 'dfd') => 'MX',
									__('Netherlands', 'dfd') => 'NL', 
									__('New Zealand', 'dfd') => 'NZ',
									__('Nigeria', 'dfd') => 'NG', 
									__('Norway', 'dfd') => 'NO',
									__('Pakistan', 'dfd') => 'PK', 
									__('Panama', 'dfd') => 'PA',
									__('Peru', 'dfd') => 'PE', 
									__('Philippines', 'dfd') => 'PH',
									__('Poland', 'dfd') => 'PL', 
									__('Portugal', 'dfd') => 'PT',
									__('Puerto Rico', 'dfd') => 'PR', 
									__('Romania', 'dfd') => 'RO',
									__('Russia', 'dfd') => 'RU', 
									__('Saudi Arabia', 'dfd') => 'SA',
									__('Senegal', 'dfd') => 'SN', 
									__('Serbia', 'dfd') => 'RS',
									__('Singapore', 'dfd') => 'SG', 
									__('Slovakia', 'dfd') => 'SK',
									__('Slovenia', 'dfd') => 'SI', 
									__('South Africa', 'dfd') => 'ZA',
									__('South Korea', 'dfd') => 'KR', 
									__('Spain', 'dfd') => 'ES',
									__('Sweden', 'dfd') => 'SE', 
									__('Switzerland', 'dfd') => 'CH',
									__('Taiwan', 'dfd') => 'TW', 
									__('Thailand', 'dfd') => 'TH',
									__('Turkey', 'dfd') => 'TR', 
									__('Uganda', 'dfd') => 'UG',
									__('Ukraine', 'dfd') => 'UA', 
									__('United Arab Emirates', 'dfd') => 'AE',
									__('United Kingdom', 'dfd') => 'GB', 
									__('United States', 'dfd') => 'US',
									__('Uruguay', 'dfd') => 'UY',
									__('Venezuela', 'dfd') => 'VE',
									__('Vietnam', 'dfd') => 'VN',
								)
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Graph type', 'dfd'),
								'param_name' => 'graph_type',
								'admin_label' => true,
								'value' => array(__('Interest over time', 'dfd') => 'TIMESERIES_GRAPH_0', __('Interest over time with average', 'dfd') => 'TIMESERIES_GRAPH_AVERAGES_CHART', __('Regional interest in map', 'dfd') => 'GEO_MAP_0_0', __('Regional interest in table', 'dfd') => 'GEO_TABLE_0_0', __('Related searches (Topics)', 'dfd') => 'TOP_ENTITIES_0_0', __('Related searches (Queries)', 'dfd') => 'TOP_QUERIES_0_0'),
								//'dependency' => Array('element' => 'search_by','value' => array('q'))
							),
							array(
								'type' => 'textfield',
								'class' => '',
								'heading' => __('Frame Width (optional)', 'dfd'),
								'param_name' => 'gtrend_width',
								'value' => '',
								'description' => __('For Example: 500', 'dfd')
							),
							array(
								'type' => 'textfield',
								'class' => '',
								'heading' => __('Frame Height (optional)', 'dfd'),
								'param_name' => 'gtrend_height',
								'value' => '',
								'description' => __('For Example: 350', 'dfd')
							),
							array(
									'type' => 'textfield',
									'heading' => __('Extra class name', 'dfd'),
									'param_name' => 'el_class',
									'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'dfd')
							),
						)
					));
				}
			}
			function display_ultimate_trends($atts,$content = null){
				$width = $height = $graph_type = $graph_type_2 = $search_by = $location_by = $gtrend_query = $gtrend_query_2 = $el_class = '';
				extract(shortcode_atts(array(
					//"id" => "map",
					'gtrend_width' => '',
					'gtrend_height' => '',
					'graph_type' => 'TIMESERIES_GRAPH_0',
					'graph_type_2' => '',
					'search_by' => 'q',
					'location_by' => '',
					'gtrend_query' => '',
					'gtrend_query_2' => '',
					'el_class' => ''
				), $atts));
				if($search_by === 'q') {
					$graph_type_new = $graph_type;
					$gtrend_query_new = $gtrend_query;
				} else {
					$graph_type_new = $graph_type_2;
					$gtrend_query_new = $gtrend_query_2;
				}
				if($gtrend_width != '') {
					$width = $gtrend_width;
					$width = '&amp;w='.esc_attr($width);
				}
				if($gtrend_height != '') {
					$height = $gtrend_height;
					$height = '&amp;h='.esc_attr($height);
				}
				$id = uniqid('vc-trends-');
				$output = '<div id="'.esc_attr($id).'" class="ultimate-google-trends '.esc_attr($el_class).'">
					<script type="text/javascript" src="//www.google.com/trends/embed.js?hl=en-US&amp;q='.esc_attr($gtrend_query_new).'&cmpt='.esc_attr($search_by).'&amp;geo='.esc_attr($location_by).'&amp;content=1&amp;cid='.esc_attr($graph_type_new).'&amp;export=5'.$width.$height.'"></script>
				</div>';
				return $output;
			}
		}
		new Ultimate_Google_Trends;
		if(class_exists('WPBakeryShortCode')) {
			class WPBakeryShortCode_ultimate_google_trends extends WPBakeryShortCode {
			}
		}

	}
}