<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if(!function_exists('dfd_preloader_css_animation')) {
	function dfd_preloader_css_animation () {
		global $dfd_ronneby;
		
		$animation_css = $animation_color_value = '';
		$preloader_page_style = DfdMetaBoxSettings::get('preloader_style');
		$page_preloader_animation = DfdMetaBoxSettings::get('preloader_animation_style');
		$page_preloader_animation_color = DfdMetaBoxSettings::get('preloader_animation_color');
		if($preloader_page_style && $page_preloader_animation) {
			$animation_style = 'dfd-preloader-style-'.$page_preloader_animation;
		} elseif(isset($dfd_ronneby['css_animation_style']) && !empty($dfd_ronneby['css_animation_style'])) {
			$animation_style = 'dfd-preloader-style-'.$dfd_ronneby['css_animation_style'];
		} else {
			$animation_style = 'dfd-preloader-style-1';
		}
		if($preloader_page_style && $page_preloader_animation_color && $page_preloader_animation_color != '#') {
			$animation_color_value = $page_preloader_animation_color;
		} elseif(isset($dfd_ronneby['preoader_animation_color']) && !empty($dfd_ronneby['preoader_animation_color'])) {
			$animation_color_value = $dfd_ronneby['preoader_animation_color'];
		}
		
		if(!empty($animation_color_value)) {
			$animation_css .=  '#qLoverlay #qLbar_wrap #dfd-preloader-animation.dfd-preloader-style-1,
								#qLoverlay #qLbar_wrap #dfd-preloader-animation.dfd-preloader-style-4,
								#qLoverlay #qLbar_wrap #dfd-preloader-animation.dfd-preloader-style-3 {border-top-color: '.esc_attr($animation_color_value).'}
								#qLoverlay #qLbar_wrap #dfd-preloader-animation.dfd-preloader-style-2 span.item-one,
								#qLoverlay #qLbar_wrap #dfd-preloader-animation.dfd-preloader-style-2 span.item-two {border-color: '.esc_attr($animation_color_value).'}
								#qLoverlay #qLbar_wrap #dfd-preloader-animation.dfd-preloader-style-5 {background: -webkit-linear-gradient('.esc_attr($animation_color_value).' -50%,transparent 70%);background: -moz-linear-gradient('.esc_attr($animation_color_value).' -50%,transparent 70%);background: -o-linear-gradient('.esc_attr($animation_color_value).' -50%,transparent 70%);background: -ms-linear-gradient('.esc_attr($animation_color_value).' -50%,transparent 70%);background: linear-gradient('.esc_attr($animation_color_value).' -50%,transparent 70%);}
								#qLoverlay #qLbar_wrap #dfd-preloader-animation.dfd-preloader-style-6 span,
								#qLoverlay #qLbar_wrap #dfd-preloader-animation.dfd-preloader-style-7 span,
								#qLoverlay #qLbar_wrap #dfd-preloader-animation.dfd-preloader-style-8 span,
								#qLoverlay #qLbar_wrap #dfd-preloader-animation.dfd-preloader-style-9 span,
								#qLoverlay #qLbar_wrap #dfd-preloader-animation.dfd-preloader-style-10 span,
								#qLoverlay #qLbar_wrap #dfd-preloader-animation.dfd-preloader-style-11,
								#qLoverlay #qLbar_wrap #dfd-preloader-animation.dfd-preloader-style-12 span,
								#qLoverlay #qLbar_wrap #dfd-preloader-animation.dfd-preloader-style-13 span,
								#qLoverlay #qLbar_wrap #dfd-preloader-animation.dfd-preloader-style-13 span:before,
								#qLoverlay #qLbar_wrap #dfd-preloader-animation.dfd-preloader-style-14 span.item-two,
								#qLoverlay #qLbar_wrap #dfd-preloader-animation.dfd-preloader-style-16 span {background: '.esc_attr($animation_color_value).';}
								#qLoverlay #qLbar_wrap #dfd-preloader-animation.dfd-preloader-style-14 span.item-one,
								#qLoverlay #qLbar_wrap #dfd-preloader-animation.dfd-preloader-style-15 span.item-two {border-color: '.esc_attr($animation_color_value).' transparent;}
								#qLoverlay #qLbar_wrap #dfd-preloader-animation.dfd-preloader-style-15 span.item-one {border-color: transparent '.esc_attr($animation_color_value).';}';
			$animation_css =  '<script type="text/javascript">
									(function($) {
										$("head").append("<style>'.esc_js($animation_css).'</style>");
									})(jQuery);
								</script>';
		}
		
		echo '<div id="dfd-preloader-animation" class="'.esc_attr($animation_style).'"><span class="item-one"></span><span class="item-two"></span><span class="item-three"></span><span class="item-four"></span><span class="item-five"></span></div>'.$animation_css;
	}
}

if(!function_exists('dfd_preloader_image')) {
	function dfd_preloader_image () {
		global $dfd_ronneby;
		
		$preloader_page_style = DfdMetaBoxSettings::get('preloader_style');
		$page_preloader_logo = DfdMetaBoxSettings::get('preloader_img');
		if($preloader_page_style && $page_preloader_logo) {
			$logo = $page_preloader_logo;
		} elseif (isset($dfd_ronneby['preloader_image']['url']) && $dfd_ronneby['preloader_image']['url']) {
			$logo = $dfd_ronneby['preloader_image']['url'];
		} else {
			$logo = get_template_directory_uri().'/assets/img/logo.png';
		}
		echo '<div class="qLbar-img"><img src="'.esc_url($logo).'" alt="'.__('Preloader logo', 'dfd').'" /></div>';
	}
}

if(!function_exists('dfd_preloader_progress_bar')) {
	function dfd_preloader_progress_bar () {
		global $dfd_ronneby;
		$bar_css = 'width: 0%;';
		$preloader_bar_position = '';
		$preloader_page_style = DfdMetaBoxSettings::get('preloader_style');
		$page_bar_bg = DfdMetaBoxSettings::get('preloader_bar_bg');
		$page_bar_height = DfdMetaBoxSettings::get('preloader_bar_height');
		$page_bar_opacity = DfdMetaBoxSettings::get('preloader_bar_opacity');
		$page_bar_position = DfdMetaBoxSettings::get('preloader_bar_position');
		
		if($page_bar_bg && $page_bar_bg != '#' && $preloader_page_style) {
			$bar_css .= 'background: '.esc_attr($page_bar_bg).';';
		} elseif(isset($dfd_ronneby['preloader_bar_bg']) && !empty($dfd_ronneby['preloader_bar_bg'])) {
			$bar_css .= 'background: '.esc_attr($dfd_ronneby['preloader_bar_bg']).';';
		}
		if($page_bar_height && $preloader_page_style) {
			$bar_css .= 'height: '.esc_attr($page_bar_height).'px;';
		} elseif(isset($dfd_ronneby['preloader_bar_height']) && !empty($dfd_ronneby['preloader_bar_height'])) {
			$bar_css .= 'height: '.esc_attr($dfd_ronneby['preloader_bar_height']).'px;';
		}
		if($page_bar_opacity && $preloader_page_style) {
			$bar_css .= 'opacity: '. esc_attr($page_bar_opacity)/100 .';';
		} elseif(isset($dfd_ronneby['preloader_bar_opacity']) && !empty($dfd_ronneby['preloader_bar_opacity'])) {
			$bar_css .= 'opacity: '. esc_attr($dfd_ronneby['preloader_bar_opacity'])/100 .';';
		}
		if($page_bar_position && $preloader_page_style) {
			$preloader_bar_position .= $page_bar_position;
		} elseif(isset($dfd_ronneby['preloader_bar_position']) && !empty($dfd_ronneby['preloader_bar_position'])) {
			$preloader_bar_position .= $dfd_ronneby['preloader_bar_position'];
		} else {
			$preloader_bar_position .= 'middle';
		}
		echo '<div id="qLbar" class="dfd-preloader-bar-'.esc_attr($preloader_bar_position).'" style="'.$bar_css.'"></div>';
	}
}

if (!function_exists('dfd_get_preloader_style')) {
	function dfd_get_preloader_style() {
		global $dfd_ronneby;
		$preloader_style = '';
		$preloader_page_style = DfdMetaBoxSettings::get('preloader_style');
		if($preloader_page_style) {
			$preloader_style = 'dfd_preloader_'.esc_attr($preloader_page_style);
		} elseif(isset($dfd_ronneby['preloader_style']) && $dfd_ronneby['preloader_style']) {
			$preloader_style = 'dfd_preloader_'.$dfd_ronneby['preloader_style'];
		}
		return $preloader_style;
	}
}

if (!function_exists('dfd_get_preloader_percentage')) {
	function dfd_get_preloader_percentage() {
		global $dfd_ronneby;
		$preloader_class = '';
		$preloader_page_style = DfdMetaBoxSettings::get('preloader_style');
		$preloader_page_percentage = DfdMetaBoxSettings::get('preloader_enable_counter');
		if($preloader_page_style && $preloader_page_percentage) {
			$preloader_class = ($preloader_page_percentage == 'on') ? ' dfd-percentage-enabled' : '';
		} elseif(isset($dfd_ronneby['preloader_percentage']) && $dfd_ronneby['preloader_percentage']) {
			$preloader_class = ' dfd-percentage-enabled';
		}
		return $preloader_class;
	}
}

if (!function_exists('dfd_get_preloader_bg')) {
	function dfd_get_preloader_bg() {
		global $dfd_ronneby;
		$preloader_css = '';
		$preloader_page_style = DfdMetaBoxSettings::get('preloader_style');
		$bg_image = DfdMetaBoxSettings::get('preloader_bg_img');
		$bg_position = DfdMetaBoxSettings::get('preloader_bg_img_position');
		$bg_color = DfdMetaBoxSettings::get('preloader_bg_color');
		$bg_size = DfdMetaBoxSettings::get('preloader_bg_size');
		$bg_repeat = DfdMetaBoxSettings::get('preloader_bg_repeat');
		$bg_attachment = DfdMetaBoxSettings::get('preloader_bg_attachment');
		if($bg_color && $bg_color != '#' && $preloader_page_style) {
			$preloader_css .= 'background-color: '.esc_attr($bg_color).';';
		} elseif(isset($dfd_ronneby['preloader_background']['background-color']) && !empty($dfd_ronneby['preloader_background']['background-color'])) {
			$preloader_css .= 'background-color: '.esc_attr($dfd_ronneby['preloader_background']['background-color']).';';
		}
		if($bg_repeat && $preloader_page_style) {
			$preloader_css .= 'background-repeat: '.esc_attr($bg_repeat).';';
		} elseif(isset($dfd_ronneby['preloader_background']['background-repeat']) && !empty($dfd_ronneby['preloader_background']['background-repeat'])) {
			$preloader_css .= 'background-repeat: '.esc_attr($dfd_ronneby['preloader_background']['background-repeat']).';';
		}
		if($bg_size && $preloader_page_style) {
			$preloader_css .= 'background-size: '.esc_attr($bg_size).';';
		} elseif(isset($dfd_ronneby['preloader_background']['background-size']) && !empty($dfd_ronneby['preloader_background']['background-size'])) {
			$preloader_css .= 'background-size: '.esc_attr($dfd_ronneby['preloader_background']['background-size']).';';
		}
		if($bg_attachment && $preloader_page_style) {
			$preloader_css .= 'background-attachment: '.esc_attr($bg_attachment).';';
		} elseif(isset($dfd_ronneby['preloader_background']['background-attachment']) && !empty($dfd_ronneby['preloader_background']['background-attachment'])) {
			$preloader_css .= 'background-attachment: '.esc_attr($dfd_ronneby['preloader_background']['background-attachment']).';';
		}
		if($bg_position && $preloader_page_style) {
			$preloader_css .= 'background-position: '.esc_attr($bg_position).';';
		} elseif(isset($dfd_ronneby['preloader_background']['background-position']) && !empty($dfd_ronneby['preloader_background']['background-position'])) {
			$preloader_css .= 'background-position: '.esc_attr($dfd_ronneby['preloader_background']['background-position']).';';
		}
		if($bg_image && $preloader_page_style) {
			$preloader_css .= 'background-image: url('.esc_url($bg_image).');';
		} elseif(isset($dfd_ronneby['preloader_background']['background-image']) && !empty($dfd_ronneby['preloader_background']['background-image'])) {
			$preloader_css .= 'background-image: url('.esc_url($dfd_ronneby['preloader_background']['background-image']).');';
		}
		return $preloader_css;
	}
}

if (!function_exists('dfd_site_preloader_html')) {
	function dfd_site_preloader_html() {
		global $dfd_ronneby;
		if (isset($dfd_ronneby['site_preloader_enabled']) && strcmp($dfd_ronneby['site_preloader_enabled'],'1')===0) {
			$preloader_css = $preloader_percentage_css = $preloader_style = $preloader_class = '';
			$preloader_style .= dfd_get_preloader_style();
			$preloader_class .= $preloader_style;
			$preloader_class .= dfd_get_preloader_percentage();
			$preloader_css .= dfd_get_preloader_bg();
			if(isset($dfd_ronneby['preloader_percentage_typography']) && $dfd_ronneby['preloader_percentage_typography'] && is_array($dfd_ronneby['preloader_percentage_typography'])) {
				if(isset($dfd_ronneby['preloader_percentage_typography']['font-family']) && !empty($dfd_ronneby['preloader_percentage_typography']['font-family'])) {
					$preloader_percentage_css .= 'font-family: '.esc_attr($dfd_ronneby['preloader_percentage_typography']['font-family']).';';
				}
				if(isset($dfd_ronneby['preloader_percentage_typography']['font-size']) && !empty($dfd_ronneby['preloader_percentage_typography']['font-size'])) {
					$preloader_percentage_css .= 'font-size: '.esc_attr($dfd_ronneby['preloader_percentage_typography']['font-size']).';';
				}
				if(isset($dfd_ronneby['preloader_percentage_typography']['font-weight']) && !empty($dfd_ronneby['preloader_percentage_typography']['font-weight'])) {
					$preloader_percentage_css .= 'font-weight: '.esc_attr($dfd_ronneby['preloader_percentage_typography']['font-weight']).';';
				}
				if(isset($dfd_ronneby['preloader_percentage_typography']['font-style']) && !empty($dfd_ronneby['preloader_percentage_typography']['font-style'])) {
					$preloader_percentage_css .= 'font-style: '.esc_attr($dfd_ronneby['preloader_percentage_typography']['font-style']).';';
				}
				if(isset($dfd_ronneby['preloader_percentage_typography']['text-transform']) && !empty($dfd_ronneby['preloader_percentage_typography']['text-transform'])) {
					$preloader_percentage_css .= 'text-transform: '.esc_attr($dfd_ronneby['preloader_percentage_typography']['text-transform']).';';
				}
				if(isset($dfd_ronneby['preloader_percentage_typography']['line-height']) && !empty($dfd_ronneby['preloader_percentage_typography']['line-height'])) {
					$preloader_percentage_css .= 'line-height: '.esc_attr($dfd_ronneby['preloader_percentage_typography']['line-height']).';';
				}
				if(isset($dfd_ronneby['preloader_percentage_typography']['letter-spacing']) && !empty($dfd_ronneby['preloader_percentage_typography']['letter-spacing'])) {
					$preloader_percentage_css .= 'letter-spacing: '.esc_attr($dfd_ronneby['preloader_percentage_typography']['letter-spacing']).';';
				}
				if(isset($dfd_ronneby['preloader_percentage_typography']['color']) && !empty($dfd_ronneby['preloader_percentage_typography']['color'])) {
					$preloader_percentage_css .= 'color: '.esc_attr($dfd_ronneby['preloader_percentage_typography']['color']).';';
				}
				?>
				<script type="text/javascript">
				(function($) {
					$('head').append('<style type="text/css">#qLpercentage {<?php echo esc_js($preloader_percentage_css) ?>}</style>');
				})(jQuery);
				</script>
				<?php
			}
			?>
			<div id="qLoverlay">';
				<div id="qLbar_wrap" class="<?php echo esc_attr($preloader_class) ?>" style="<?php echo $preloader_css ?>">
					<?php if(!empty($preloader_style) && function_exists($preloader_style)) {
						$preloader_style();
					}?>
					<?php /* <div id="qLbar" style="width: 0%"></div><div id="dfd-preloader-content"><div class="qLbar-img">'.$img.'</div><div id="dfd-preloader-mask"></div></div><div id="dfd-preloader-content-circle"><img src="'.  get_template_directory_uri().'/assets/img/preloader_mask.png" alt="" /></div> */ ?>
				</div>
			</div>
		<?php
		}
	}
}