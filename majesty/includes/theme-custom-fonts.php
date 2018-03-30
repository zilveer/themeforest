<?php
/*
 *	Replcae Theme fonts with custom fonts from theme options
 */

add_action( 'wp_enqueue_scripts', 'sama_load_custom_fonts', 10 );
add_action( 'wp_head', 'sama_custom_css_for_fonts' );

function sama_custom_css_for_fonts () {
?>
<style  type="text/css">
<?php echo sama_output_font_css(); ?>
</style>
<?php

}

function sama_load_custom_fonts () {
	
	global $majesty_options;
	$font_families = array();
	$font_subsets  = array('latin');
	
	if( $majesty_options['enable_custom_fonts'] ) {
										
		// Font 1:: Check if Enable custom font to replace with Open Sans font
		if( $majesty_options['enable-font-opensans'] ) {
			if( ! empty( $majesty_options['font-opensans'] ) && $majesty_options['font-opensans']['font-family'] != 'Open Sans' && isset( $majesty_options['font-opensans']['google'] ) && $majesty_options['font-opensans']['google'] ) {
			
				$font_weight = $subsets = '';
				if( isset( $majesty_options['font-opensans']['font-weight'] ) && ! empty( $majesty_options['font-opensans']['font-weight'] ) ) {
					$font_weight = $majesty_options['font-opensans']['font-weight'];
					if( isset( $majesty_options['font-opensans']['font-style'] ) && ! empty( $majesty_options['font-opensans']['font-style'] ) ) {
						$font_weight = $font_weight . $majesty_options['font-opensans']['font-style'];
					}
				}
				if( ! empty( $majesty_options['font-opensans-style'] ) ) {
					if( ! empty( $font_weight ) ) {
						$font_weight .= ','. $majesty_options['font-opensans-style'];
					} else {
						$font_weight = $majesty_options['font-opensans-style'];
					}
				}
				if( ! empty($font_weight) ){
					$font_weight = ':'. $font_weight;
				}
				$font_families[] = esc_attr($majesty_options['font-opensans']['font-family']). esc_attr( $font_weight );
				if( isset( $majesty_options['font-opensans']['subsets'] ) && ! empty( $majesty_options['font-opensans']['subsets'] ) ) {
					$subsets = $majesty_options['font-opensans']['subsets'];
					if( ! in_array($subsets, $font_subsets) ) {
						$font_subsets[] = $subsets;
					}
				}
				if( ! empty( $majesty_options['font-opensans-subsets'] ) ) {
					$subsets_more = explode(',',esc_attr($majesty_options['font-opensans-subsets']),0);
					foreach( $subsets_more as $subset ){
						if( ! in_array($subset, $font_subsets) ) {
							$font_subsets[] = $subset;
						}
					}
				}
				
			} else {
				$font_families[] = 'Open Sans:300,400,600';
			}
		} else {
			$font_families[] = 'Open Sans:300,400,600';
		}
		
		// Font 2:: Check if Enable custom font to replace with Fjalla One font
		if( $majesty_options['enable-font-fjallaone'] ) {
			if( ! empty( $majesty_options['font-fjallaone'] ) && $majesty_options['font-fjallaone']['font-family'] != 'Fjalla One' && isset( $majesty_options['font-fjallaone']['google'] ) && $majesty_options['font-fjallaone']['google'] ) {
			
				$font_weight = $subsets = '';
				if( isset( $majesty_options['font-fjallaone']['font-weight'] ) && ! empty( $majesty_options['font-fjallaone']['font-weight'] ) ) {
					$font_weight = $majesty_options['font-fjallaone']['font-weight'];
					if( isset( $majesty_options['font-fjallaone']['font-style'] ) && ! empty( $majesty_options['font-fjallaone']['font-style'] ) ) {
						$font_weight = $font_weight . $majesty_options['font-fjallaone']['font-style'];
					}
				}
				if( ! empty( $majesty_options['font-fjallaone-style'] ) ) {
					if( ! empty( $font_weight ) ) {
						$font_weight .= ','. $majesty_options['font-fjallaone-style'];
					} else {
						$font_weight = $majesty_options['font-fjallaone-style'];
					}
				}
				if( ! empty($font_weight) ){
					$font_weight = ':'. $font_weight;
				}
				$font_families[] = esc_attr($majesty_options['font-fjallaone']['font-family']). esc_attr( $font_weight );
				
				if( isset( $majesty_options['font-fjallaone']['subsets'] ) && ! empty( $majesty_options['font-fjallaone']['subsets'] ) ) {
					$subsets = $majesty_options['font-fjallaone']['subsets'];
					if( ! in_array($subsets, $font_subsets) ) {
						$font_subsets[] = $subsets;
					}
				}
				if( ! empty( $majesty_options['font-fjallaone-subsets'] ) ) {
					$subsets_more = explode(',',esc_attr($majesty_options['font-fjallaone-subsets']),0);
					foreach( $subsets_more as $subset ){
						if( ! in_array($subset, $font_subsets) ) {
							$font_subsets[] = $subset;
						}
					}
				}
			} else {
				$font_families[] = 'Fjalla One';
			}
		} else {
			$font_families[] = 'Fjalla One';
		}
		
		// Font 3 :: Check if Enable custom font to replace with Courgette font
		if( $majesty_options['enable-font-courgette'] ) {
			if( ! empty( $majesty_options['font-courgette'] ) && $majesty_options['font-courgette']['font-family'] != 'Courgette' && isset( $majesty_options['font-courgette']['google'] ) && $majesty_options['font-courgette']['google'] ) {
			
				$font_weight = $subsets = '';
				if( isset( $majesty_options['font-courgette']['font-weight'] ) && ! empty( $majesty_options['font-courgette']['font-weight'] ) ) {
					$font_weight = $majesty_options['font-courgette']['font-weight'];
					if( isset( $majesty_options['font-courgette']['font-style'] ) && ! empty( $majesty_options['font-courgette']['font-style'] ) ) {
						$font_weight = $font_weight . $majesty_options['font-courgette']['font-style'];
					}
				}
				if( ! empty( $majesty_options['font-courgette-style'] ) ) {
					if( ! empty( $font_weight ) ) {
						$font_weight .= ','. $majesty_options['font-courgette-style'];
					} else {
						$font_weight = $majesty_options['font-courgette-style'];
					}
				}
				$font_families[] = esc_attr($majesty_options['font-courgette']['font-family']). esc_attr( $font_weight );
				if( isset( $majesty_options['font-courgette']['subsets'] ) && ! empty( $majesty_options['font-courgette']['subsets'] ) ) {
					$subsets = esc_attr($majesty_options['font-courgette']['subsets']);
					if( ! in_array($subsets, $font_subsets) ) {
						$font_subsets[] = $subsets;
					}
				}
				if( ! empty( $majesty_options['font-courgette-subsets'] ) ) {
					$subsets_more = explode(',',esc_attr($majesty_options['font-courgette-subsets']),0);
					foreach( $subsets_more as $subset ){
						if( ! in_array($subset, $font_subsets) ) {
							$font_subsets[] = $subset;
						}
					}
				}
			} else {
				$font_families[] = 'Courgette';
			}
		} else {
			$font_families[] = 'Courgette';
		}
		
		// Build Google Fonts
		$font_families[] = 'Herr Von Muellerhoff';
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( implode( ',', $font_subsets) ),
		);
		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
		
		wp_enqueue_style( 'majesty-theme-fonts', $fonts_url, array(), '1.0.0' );
	} else {
		wp_enqueue_style( 'majesty-theme-fonts', sama_theme_default_google_fonts(), array(), '1.0.0' );
	}
}

// used to define new fonts for html elments
function sama_output_font_css() {
	global $majesty_options;
	$output = '';
	if(  isset( $majesty_options['enable_custom_fonts'] ) && $majesty_options['enable_custom_fonts'] ) {
		// Font 1
		if( $majesty_options['enable-font-opensans'] && ! empty( $majesty_options['font-opensans'] ) && $majesty_options['font-opensans']['font-family'] != 'Open Sans' ) {
			$font1 = esc_attr( $majesty_options['font-opensans']['font-family'] );
			if( ! empty( $majesty_options['font-opensans']['font-backup'] ) ) {
				$font1 .= ',' .  esc_attr( $majesty_options['font-opensans']['font-backup'] );
			}
			$output .= ".font3,body p,body,.btn-gold,.btn-white,.btn-black,.post-password-form input[type=\"submit\"],.woocommerce input[type=\"submit\"],.woocommerce button,.woocommerce .button,.btn.btn-black,#main-menu ul ul a,.slider-content p,.video-content p,.welcome-block p,.post-top-blockquote blockquote small,.blockquote small,.blockquote.blockquote-default p,.slider-parallax .slider-content p,#footer .widget_recent_comments_with_avatar a span,.skipper-slider .slider-content p{font-family:$font1}\n";
		}
		
		// Font 2
		if( $majesty_options['enable-font-fjallaone'] && isset( $majesty_options['font-fjallaone'] ) && ! empty( $majesty_options['font-fjallaone'] ) && $majesty_options['font-fjallaone']['font-family'] != 'Fjalla One' ) {
			$font2 = esc_attr( $majesty_options['font-fjallaone']['font-family'] );
			if( ! empty( $majesty_options['font-fjallaone']['font-backup'] ) ) {
				$font2 .= ',' . esc_attr( $majesty_options['font-fjallaone']['font-backup'] );
			}
			$output .= ".font1,h1,h2,h3,h4,h5,h6,#logo,.menu_carousel .item h3,#main-menu ul li a,.slider-content h1,.video-content h1,.menu-fillter a,#menu-scroll li,.vertical-menu ul a,.shop_table tr th,.countdown-section,.fc th,.price_head,.accordion_majesty .panel-default a.panel-link,.majesty_tab .nav-tabs > li > a,.price_head,.accordion_majesty .panel-default a.panel-link,.majesty_tab .nav-tabs > li > a,.page-numbers > li > a,.page-numbers-gold > li > a,.page-numbers > li > span,.page-numbers-gold > li > span,.menu_tabs div.tab-menu div.list-group > a,.latest_news figure p.post-cats,.masonary_blog figure p.post-cats,.blog-grid figure p.post-cats,.comment-body .fn,.widget_shopping_cart .total .amount,.em-calendar-wrapper table.fullcalendar thead td.month_name,.em-calendar-wrapper table.fullcalendar tbody tr.days-names td,.woocommerce .price,.woocommerce-tabs .commentlist .meta strong,#footer .widget_recent_comments_with_avatar a,#footer .widget_recently_viewed_products a,#footer .widget_top_rated_products a,#footer .widget_products a,#footer .widget_recent_reviews a,#footer .widget-recent-posts a,.sidebar .widget .amount,#footer .widget .amount,a.comment-reply-login{font-family:$font2}\n";
		}
		
		// Font 3
		if( $majesty_options['enable-font-courgette'] && ! empty( $majesty_options['font-courgette'] ) && $majesty_options['font-courgette']['font-family'] != 'Courgette' ) {
			$font3 = esc_attr( $majesty_options['font-courgette']['font-family'] );
			if( ! empty( $majesty_options['font-courgette']['font-backup'] ) ) {
				$font3 .= ',' . esc_attr( $majesty_options['font-courgette']['font-backup'] );
			}
			$output .= ".font2,.video-content p.font2,.yt-bg-player .slider-content p,.slider-content p.font2,.interactive-bg .wrapper-bg p,.swiper-wrapper .slider-content h4,.swiper-wrapper .slider-content p,.menu_today figure p,.masonary_blog figure p.post-cats,.blog-grid figure p.post-cats,.latest_news figure p.post-cats,.video b,span.welcome,.blog_single .blockquote p,.banner .banner-content p,.blockquote p,.post-top-blockquote blockquote p{font-family:$font3}\n";
		}
	}
	
	return $output;
}
?>