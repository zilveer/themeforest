<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Social Accounts Module
*/
if(!class_exists('Dfd_Social_Accounts_Module')) 
{
	class Dfd_Social_Accounts_Module {
		function __construct(){
			add_action('init',array($this,'dfd_social_accounts_init'));
			add_shortcode('dfd_social_accounts',array($this,'dfd_social_accounts_shortcode'));
		}
		function dfd_social_accounts_init() {
			if(function_exists('vc_map')) {
				vc_map(
					array(
						'name' => __('Social Accounts','dfd'),
						'base' => 'dfd_social_accounts',
						'class' => 'vc_info_banner_icon',
						'icon' => 'vc_icon_info_banner',
						'category' => __('Ronneby 1.0','dfd'),
						//'deprecated' => '4.6',
						'description' => __('Displays social accounts icons','dfd'),
						'params' => array(
							array(
								'type' => 'dropdown',
								'heading' => __('Icon hover style', 'dfd'),
								'param_name' => 'soc_icons_hover',
								'value' => dfd_soc_icons_hover_composer(),
								'group' => 'General',
							),
							array(
								'type' => 'dropdown',
								'heading' => __('Icon Alignment', 'dfd'),
								'param_name' => 'info_alignment',
								'value' => array(
									__('Center', 'dfd') => 'text-center',
									__('Left', 'dfd') => 'text-left',
									__('Right', 'dfd') => 'text-right'
								),
								'group' => 'General',
							),
							array(
								'type' => 'number',
								'class' => 'font-size',
								'heading' => __('Font Size', 'dfd'),
								'param_name' => 'icon_font_size',
								'min' => 10,
								'max' => 40,
								//'value' => '12',
								'suffix' => 'px',
								'group' => 'General'
							),
							array(
								"type" => "textfield",
								"heading" => __("Extra class name", "js_composer"),
								"param_name" => "el_class",
								"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer"),
								'group' => 'General'
							),
							array(
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Deviantart link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_de',
								'group' => 'Social networks',
							),
							array(
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Digg link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_dg',
								'group' => 'Social networks',
							),
							array(
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Dribbble link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_dr',
								'group' => 'Social networks',
							),
							array(
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Dropbox link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_db',
								'group' => 'Social networks',
							),
							array(
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Evernote link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_en',
								'group' => 'Social networks',
							),
							array(
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Facebook link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_fb',
								'group' => 'Social networks',
							),
							array(
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Flickr link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_flk',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Foursquare link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_fs',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Google + link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_gp',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Instagram link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_in',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('LastFM link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_lf',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('LinkedIN link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_li',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Livejournal link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_lj',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Picasa link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_pi',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Pinterest link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_pt',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('RSS link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_rss',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Tumblr link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_tu',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Twitter link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_tw',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Vimeo link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_vi',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Wordpress link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_wp',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('YouTube link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_yt',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('500px link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_500px',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Mail link', 'dfd'),
								'description' => __('Type your email in a form, e.g.: mailto:youremail@mail.com', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_ml',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('ViewBug link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_vb',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('VKontakte link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_vk',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Xing', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_xn',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Spotify', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_sp',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Houzz', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_hz',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Skype', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_sk',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Slideshare', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_ss',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Bandcamp', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_bd',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Soundcloud', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_sd',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Meerkat', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_mk',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Periscope', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_ps',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Snapchat', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_sc',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('The City', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_tc',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Behance', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_bh',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Microsoft Pinpoint', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_pp',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Viadeo', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_vd',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('TripAdvisor', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_ta',
								'group' => 'Social networks',
							),
							array(
								'type'        => 'dropdown',
								'class'       => '',
								'heading'     => __( 'Animation', 'dfd' ),
								'param_name'  => 'module_animation',
								'value'       => dfd_module_animation_styles(),
								'description' => __( '', 'dfd' ),
								'group'       => 'Animation Settings',
							),
						),
					)
				);
			}
		}
		// Shortcode handler function
		function dfd_social_accounts_shortcode($atts)
		{
			$output = $module_animation = $info_alignment = $soc_icons_hover = $icon_font_size = $icon_font_size_style = $icon_size = $el_class = '';
			$team_member_de = $team_member_dg = $team_member_dr = $team_member_db = $team_member_en = $team_member_fb = $team_member_flk = $team_member_fs = '';
			$team_member_gp = $team_member_in = $team_member_lf = $team_member_li = $team_member_lj = $team_member_pi = $team_member_pt = $team_member_rss = '';
			$team_member_tu = $team_member_tw = $team_member_vi = $team_member_wp = $team_member_yt = $team_member_500px = $team_member_vb = $team_member_ml = $team_member_vk = '';
			$team_member_xn = $team_member_sp = $team_member_hz = $team_member_sk = $team_member_ss = $team_member_bd = $team_member_sd = $team_member_mk = $team_member_ps = '';
			$team_member_sc = $team_member_tc = $team_member_bh = $team_member_pp = $team_member_vd = $team_member_ta = '';
						
			extract(shortcode_atts( array(
				'module_animation' => '',
				'soc_icons_hover' => '',
				'info_alignment' => 'text-center',
				'icon_font_size' => '',
				'el_class' => '',
				'team_member_de' => '',
				'team_member_dg' => '',
				'team_member_dr' => '',
				'team_member_db' => '',
				'team_member_en' => '',
				'team_member_fb' => '',
				'team_member_flk' => '',
				'team_member_fs' => '',
				'team_member_gp' => '',
				'team_member_in' => '',
				'team_member_lf' => '',
				'team_member_li' => '',
				'team_member_lj' => '',
				'team_member_pi' => '',
				'team_member_pt' => '',
				'team_member_rss' => '',
				'team_member_tu' => '',
				'team_member_tw' => '',
				'team_member_vi' => '',
				'team_member_wp' => '',
				'team_member_yt' => '',
				'team_member_500px' => '',
				'team_member_vb' => '',
				'team_member_ml' => '',
				'team_member_vk' => '',
				'team_member_xn' => '',
				'team_member_sp' => '',
				'team_member_hz' => '',
				'team_member_sk' => '',
				'team_member_ss' => '',
				'team_member_bd' => '',
				'team_member_sd' => '',
				'team_member_mk' => '',
				'team_member_ps' => '',
				'team_member_sc' => '',
				'team_member_tc' => '',
				'team_member_bh' => '',
				'team_member_pp' => '',
				'team_member_vd' => '',
				'team_member_ta' => '',
			),$atts));
			
			if($soc_icons_hover == '') {
				$soc_icons_hover = '1';
			}
			
			$soc_icons_hover_style = 'dfd-soc-icons-hover-style-'.$soc_icons_hover;
			
			$social_icons = array(
				'de' => 'soc_icon-deviantart',
				'dg' => 'soc_icon-digg',
				'dr' => 'soc_icon-dribbble',
				'db' => 'soc_icon-dropbox',
				'en' => 'soc_icon-evernote',
				'fb' => 'soc_icon-facebook',
				'flk' => 'soc_icon-flickr',
				'fs' => 'soc_icon-foursquare_2',
				'gp' => 'soc_icon-google__x2B_',
				'in' => 'soc_icon-instagram',
				'lf' => 'soc_icon-last_fm',
				'li' => 'soc_icon-linkedin',
				'lj' => 'soc_icon-livejournal',
				'pi' => 'soc_icon-picasa',
				'pt' => 'soc_icon-pinterest',
				'rss' => 'soc_icon-rss',
				'tu' => 'soc_icon-tumblr',
				'tw' => 'soc_icon-twitter-3',
				'vi' => 'soc_icon-vimeo',
				'wp' => 'soc_icon-wordpress',
				'yt' => 'soc_icon-youtube',
				'500px' => 'dfd-added-font-icon-px-icon',
				'vb' => 'dfd-added-font-icon-vb',
				'ml' => 'soc_icon-mail',
				'vk' => 'soc_icon-rus-vk-02',
				'xn' => 'dfd-added-font-icon-b_Xing-icon_bl',
				'sp' => 'dfd-added-font-icon-c_spotify-512-black',
				'hz' => 'dfd-added-font-icon-houzz-dark-icon',
				'sk' => 'dfd-added-font-icon-skype',
				'ss' => 'dfd-added-font-icon-slideshare',
				'bd' => 'dfd-added-font-icon-bandcamp-logo',
				'sd' => 'dfd-added-font-icon-soundcloud-logo',
				'mk' => 'dfd-added-font-icon-Meerkat-color',
				'ps' => 'dfd-added-font-icon-periscope-logo',
				'sc' => 'dfd-added-font-icon-Snapchat-logo',
				'tc' => 'dfd-added-font-icon-the-city',
				'bh' => 'soc_icon-behance',
				'pp' => 'dfd-added-font-icon-pinpoint',
				'vd' => 'dfd-added-font-icon-viadeo',
				'ta' => 'dfd-added-font-icon-tripadvisor',
			);
			
			$id = uniqid(rand());
			
			$animate = $animation_data = '';
			if ( ! ( $module_animation == '' ) ) {
				$animate        = ' cr-animate-gen';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}
			
			$font_size = '';
			if ($icon_font_size != '') {
				$font_size = 'font-size:'.esc_attr($icon_font_size).'px;';
			}
			
			$soc_icons_html = '';
			
			foreach($social_icons as $key => $value) {
				$url = 'team_member_'.$key;
				if(!empty($$url)) {
					$link = vc_build_link($$url);
					if(!filter_var( $link['url'], FILTER_VALIDATE_URL ) === false || $link['url'] == '#')
						$soc_icons_html .= '<a href="'.esc_url($link['url']).'" class="'.esc_attr($value).'" style="'.$font_size.'" target="_blank"><span class="line-top-left '.esc_attr($value).'"></span><span class="line-top-center '.esc_attr($value).'"></span><span class="line-top-right '.esc_attr($value).'"></span><span class="line-bottom-left '.esc_attr($value).'"></span><span class="line-bottom-center '.esc_attr($value).'"></span><span class="line-bottom-right '.esc_attr($value).'"></span><i class="'.esc_attr($value).'"></i></a>';
				}
			}
			
			$output .= '<div id="dfdsoc-'.esc_attr($id).'" class="dfd-socicon-module '.esc_attr($animate).' '.esc_attr($el_class).'" '.$animation_data.'>';
			
				if(!empty($soc_icons_html)) {
					$output .= '<div class="soc-icon-aligment '.esc_attr($info_alignment).'"><div class="widget soc-icons '.esc_attr($soc_icons_hover_style).'">'.$soc_icons_html.'</div></div>';
				}

			$output .= '</div>';
			
			return $output;
		}
	}
}
if(class_exists('Dfd_Social_Accounts_Module'))
{
	$Dfd_Social_Accounts_Module = new Dfd_Social_Accounts_Module;
}
