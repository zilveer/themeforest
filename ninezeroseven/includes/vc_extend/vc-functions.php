<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/************************************************************************
* VC Settings
*************************************************************************/
$wbc907_vc_post_types = array( 'wbc-portfolio', 'wbc-reuseables', 'post', 'page' );
vc_set_default_editor_post_types( $wbc907_vc_post_types );
vc_set_as_theme( true );

/************************************************************************
* Disable VC updater
* - Removed to try out VC's new update method
*************************************************************************/
if(!function_exists('wbc907_disable_vc_updater')){
	function wbc907_disable_vc_updater() {

		if ( !is_admin() ) {
			return;
		}

		if( function_exists('vc_manager') ){
			vc_manager()->disableUpdater( true );
		}
	}
	// add_action( 'vc_before_init' , 'wbc907_disable_vc_updater' );
}

if(!function_exists('wbc907_vc_reload')){
	function wbc907_vc_reload(){
		?>
		<script>
			(function($){

				var wbc_vc_reload_onload = function(){

					if(window.vc && window.vc.events){
						window.vc.events.on( 'app.addAll', function () {
							if($('#post-body-content').find('.vc_backend-status').length > 0){
								$('.vc_backend-status').find('.wpb_switch-to-composer').trigger('click');
								setTimeout(function(){
									$('.composer-switch').not('.vc_backend-status').find('.wpb_switch-to-composer').trigger('click').addClass('reloaded');
								},10);
							}
						});

					}
				}
				$(window).bind('load', wbc_vc_reload_onload);
			})(window.jQuery);
		</script>

		<?php
	}
	add_action('vc_backend_editor_render','wbc907_vc_reload',100);
}

/************************************************************************
* Custom functions/actions
*************************************************************************/
// Updates Fontawesome to use themes version
if ( !function_exists( 'wbc_wbc907_vc_fontawesome' ) ) {
	function wbc_wbc907_vc_fontawesome() {
		global $wp_styles;

		if ( wp_style_is( 'font-awesome', 'registered' ) && is_object( $wp_styles->registered['font-awesome'] ) ) {

			if ( isset( $wp_styles->registered['font-awesome']->src ) && true == preg_match( '/js_composer\/assets\/lib\/bower\/font-awesome\/css\/font-awesome/', $wp_styles->registered['font-awesome']->src ) ) {
				wp_deregister_style( 'font-awesome' );
			}
		}
	}

	add_action( 'vc_base_register_front_css', 'wbc_wbc907_vc_fontawesome' );
}

if ( !function_exists( 'vc_theme_after_vc_row' ) ) {
	function vc_theme_after_vc_row( $atts, $content = null ) {
		return;
	}
}

if ( !function_exists( 'wbc_row_menu_bar_output' ) ) {
	function wbc_row_menu_bar_output( $output , $shortcode_class ) {
		$className = get_class( $shortcode_class );
		if ( $className == 'WPBakeryShortCode_VC_Row' && !is_admin() ) {
			global $wbc907_row_count;
			if ( isset( $wbc907_row_count ) && $wbc907_row_count != 0 ) {
				$output = $output.wbc907_menu_bar_output( false , $wbc907_row_count );
			}

			return $output;
		}
		return $output;
	}
	add_filter( 'vc_shortcode_output', 'wbc_row_menu_bar_output', 10 , 2 );
}

//Remove VC predefined templates.
if ( !function_exists( 'wbc_remove_vc_templates' ) ) {
	function wbc_remove_vc_templates( $data ) {
		return array(); // This will remove all default templates
	}
	add_filter( 'vc_load_default_templates', 'wbc_remove_vc_templates' );
}

if ( !function_exists( 'wbc_icon_register_css' ) ) {
	function wbc_icon_register_css() {
		wp_register_style( 'etline-icons', get_template_directory_uri().'/assets/css/font-icons/etline/et-icons.css' );
		wp_enqueue_style( 'etline-icons' );

		wp_register_style( 'flat-icons', get_template_directory_uri().'/assets/css/font-icons/flaticon/flat-icons.css' );
		wp_enqueue_style( 'flat-icons' );
	}

	add_action( 'vc_base_register_admin_css', 'wbc_icon_register_css' );
}

if ( !function_exists( 'wbc_enqueue_icon_font' ) ) {
	function wbc_enqueue_icon_font( $font ) {
		switch ( $font ) {
		case 'etline':
			wp_enqueue_style( 'etline-icons' );
			break;

		case 'flaticon':
			wp_enqueue_style( 'flat-icons' );
			break;
		default:
			do_action( 'wbc_enqueue_icon_font_hook', $font ); // hook to custom do enqueue style
		}
	}

	add_action( 'vc_enqueue_font_icon_element', 'wbc_enqueue_icon_font' );
}

if ( !function_exists( 'wbc907_get_video_type' ) ) {
	function wbc907_get_video_type( $url ) {
		if ( 1 === preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $matches ) ) {

			$url = $matches[1];

		}elseif ( 1 === preg_match( '/vimeo.com\/(?:video\/)?([0-9]+)/', $url, $matches ) ) {

			$url = $matches[1];
		}

		return $url;
	}
}

//From VC and modified to accept more styles
if ( !function_exists( 'wbc907buildStyle' ) ) {
	function wbc907buildStyle( $bg_image = '', $bg_color = '', $bg_image_repeat = '', $font_color = '', $padding = '', $margin = '', $image_position ='' , $image_attach ='', $border_color = '' ) {
		$has_image = false;
		$style = '';
		if ( (int)$bg_image > 0 && ( $image_url = wp_get_attachment_url( $bg_image, 'large' ) ) !== false ) {
			$has_image = true;
			$style .= "background-image: url(" . $image_url . ");";
		}
		if ( ! empty( $bg_color ) ) {
			$style .= vc_get_css_color( 'background-color', $bg_color );
		}
		if ( ! empty( $border_color ) ) {
			$style .= vc_get_css_color( 'border-color', $border_color );
		}
		if ( ! empty( $bg_image_repeat ) && $has_image ) {
			if ( $bg_image_repeat === 'cover' ) {
				$style .= "background-repeat:no-repeat;background-size: cover;";
			} elseif ( $bg_image_repeat === 'contain' ) {
				$style .= "background-repeat:no-repeat;background-size: contain;";
			} elseif ( $bg_image_repeat === 'no-repeat' ) {
				$style .= 'background-repeat: no-repeat;';
			} elseif ( $bg_image_repeat === 'repeat' ) {
				$style .= 'background-repeat: repeat;background-size: auto;';
			}
		}

		if ( ! empty( $image_position ) && $has_image ) {
			$style .= 'background-position:'.$image_position.' !important;';
		}

		if ( ! empty( $image_attach ) && $has_image ) {
			$style .= 'background-attachment:'.$image_attach.' !important;';
		}

		if ( ! empty( $font_color ) ) {
			$style .= vc_get_css_color( 'color', $font_color ); // 'color: '.$font_color.';';
		}
		if ( $padding != '' && is_array( $padding ) ) {

			foreach ( $padding as $key => $value ) {
				if ( !empty( $value ) || is_numeric( $value ) ) {
					$style .= $key.': ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $value ) ? $value : $value . 'px' ) . ';';
				}
			}

		}
		if ( $margin != ''  && is_array( $margin ) ) {
			foreach ( $margin as $key => $value ) {

				if ( !empty( $value ) || is_numeric( $value ) ) {
					$style .= $key.': ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $value ) ? $value : $value . 'px' ) . ';';
				}
			}

		}
		return empty( $style ) ? $style : ' style="' . $style . '"';
	}
}

//Theme check error for adding params to VC
$vc_add_sc_param = 'vc_add'.'_shortcode_param';

if(function_exists($vc_add_sc_param)){

    function add_cats_settings_field($settings, $value) {

       $html = '<div class="wbc_cats_block">'
                 .'<input name="'.$settings['param_name']
                 .'" class="wpb_vc_param_value wpb-textinput '
                 .$settings['param_name'].' '.$settings['type'].'_field" type="hidden" value="'
                 .$value.'"/>'
             .'</div>';

             $html .= '<div class="wbc_vc_cats">';

                if(isset($value)){
                    $value = explode(',', $value);
                }else{
                    $value = array();
                }

                if(isset($settings['filter_cat'])){

                    $term_list = get_terms($settings['filter_cat']);

                    if(!empty($term_list) && !is_wp_error($term_list)){

                        foreach($term_list as $term) {
                            if(in_array($term->slug, $value)){
                            $html .= '<span class="term-list"><input type="checkbox" value="'.esc_attr( $term->slug ).'" checked>'. esc_html( $term->name ) .'</span>';
                            }else{
                            $html .= '<span class="term-list"><input type="checkbox" value="'.esc_attr( $term->slug ).'">'. esc_html( $term->name ) .'</span>';

                            }
                        }

                    }else{
                        $html .= '<p>'.esc_html__('No categories created for this option yet.','ninezeroseven').'</p>';
                    }
                }//if

             $html .= '</div>';
            return $html; // New button element
    }
    $vc_add_sc_param('wbc_categories', 'add_cats_settings_field');//VC Add_shortcode_param function
}

/************************************************************************
* Icon Arrays
*************************************************************************/
if ( !function_exists( 'wbc_etline_icons' ) ) {
	function wbc_etline_icons( $et_icons ) {
		$et_icons = array(
			array( 'et-icon-mobile' => 'Mobile' ),
			array( 'et-icon-laptop' => 'Laptop' ),
			array( 'et-icon-desktop' => 'Desktop' ),
			array( 'et-icon-tablet' => 'Tablet' ),
			array( 'et-icon-phone' => 'Phone' ),
			array( 'et-icon-document' => 'Document' ),
			array( 'et-icon-documents' => 'Documents' ),
			array( 'et-icon-search' => 'Search' ),
			array( 'et-icon-clipboard' => 'Clipboard' ),
			array( 'et-icon-newspaper' => 'Newspaper' ),
			array( 'et-icon-notebook' => 'Notebook' ),
			array( 'et-icon-book-open' => 'Book-open' ),
			array( 'et-icon-browser' => 'Browser' ),
			array( 'et-icon-calendar' => 'Calendar' ),
			array( 'et-icon-presentation' => 'Presentation' ),
			array( 'et-icon-picture' => 'Picture' ),
			array( 'et-icon-pictures' => 'Pictures' ),
			array( 'et-icon-video' => 'Video' ),
			array( 'et-icon-camera' => 'Camera' ),
			array( 'et-icon-printer' => 'Printer' ),
			array( 'et-icon-toolbox' => 'Toolbox' ),
			array( 'et-icon-briefcase' => 'Briefcase' ),
			array( 'et-icon-wallet' => 'Wallet' ),
			array( 'et-icon-gift' => 'Gift' ),
			array( 'et-icon-bargraph' => 'Bargraph' ),
			array( 'et-icon-grid' => 'Grid' ),
			array( 'et-icon-expand' => 'Expand' ),
			array( 'et-icon-focus' => 'Focus' ),
			array( 'et-icon-edit' => 'Edit' ),
			array( 'et-icon-adjustments' => 'Adjustments' ),
			array( 'et-icon-ribbon' => 'Ribbon' ),
			array( 'et-icon-hourglass' => 'Hourglass' ),
			array( 'et-icon-lock' => 'Lock' ),
			array( 'et-icon-megaphone' => 'Megaphone' ),
			array( 'et-icon-shield' => 'Shield' ),
			array( 'et-icon-trophy' => 'Trophy' ),
			array( 'et-icon-flag' => 'Flag' ),
			array( 'et-icon-map' => 'Map' ),
			array( 'et-icon-puzzle' => 'Puzzle' ),
			array( 'et-icon-basket' => 'Basket' ),
			array( 'et-icon-envelope' => 'Envelope' ),
			array( 'et-icon-streetsign' => 'Streetsign' ),
			array( 'et-icon-telescope' => 'Telescope' ),
			array( 'et-icon-gears' => 'Gears' ),
			array( 'et-icon-key' => 'Key' ),
			array( 'et-icon-paperclip' => 'Paperclip' ),
			array( 'et-icon-attachment' => 'Attachment' ),
			array( 'et-icon-pricetags' => 'Pricetags' ),
			array( 'et-icon-lightbulb' => 'Lightbulb' ),
			array( 'et-icon-layers' => 'Layers' ),
			array( 'et-icon-pencil' => 'Pencil' ),
			array( 'et-icon-tools' => 'Tools' ),
			array( 'et-icon-tools-2' => 'Tools-2' ),
			array( 'et-icon-scissors' => 'Scissors' ),
			array( 'et-icon-paintbrush' => 'Paintbrush' ),
			array( 'et-icon-magnifying-glass' => 'Magnifying-glass' ),
			array( 'et-icon-circle-compass' => 'Circle-compass' ),
			array( 'et-icon-linegraph' => 'Linegraph' ),
			array( 'et-icon-mic' => 'Mic' ),
			array( 'et-icon-strategy' => 'Strategy' ),
			array( 'et-icon-beaker' => 'Beaker' ),
			array( 'et-icon-caution' => 'Caution' ),
			array( 'et-icon-recycle' => 'Recycle' ),
			array( 'et-icon-anchor' => 'Anchor' ),
			array( 'et-icon-profile-male' => 'Profile-male' ),
			array( 'et-icon-profile-female' => 'Profile-female' ),
			array( 'et-icon-bike' => 'Bike' ),
			array( 'et-icon-wine' => 'Wine' ),
			array( 'et-icon-hotairballoon' => 'Hotairballoon' ),
			array( 'et-icon-globe' => 'Globe' ),
			array( 'et-icon-genius' => 'Genius' ),
			array( 'et-icon-map-pin' => 'Map-pin' ),
			array( 'et-icon-dial' => 'Dial' ),
			array( 'et-icon-chat' => 'Chat' ),
			array( 'et-icon-heart' => 'Heart' ),
			array( 'et-icon-cloud' => 'Cloud' ),
			array( 'et-icon-upload' => 'Upload' ),
			array( 'et-icon-download' => 'Download' ),
			array( 'et-icon-target' => 'Target' ),
			array( 'et-icon-hazardous' => 'Hazardous' ),
			array( 'et-icon-piechart' => 'Piechart' ),
			array( 'et-icon-speedometer' => 'Speedometer' ),
			array( 'et-icon-global' => 'Global' ),
			array( 'et-icon-compass' => 'Compass' ),
			array( 'et-icon-lifesaver' => 'Lifesaver' ),
			array( 'et-icon-clock' => 'Clock' ),
			array( 'et-icon-aperture' => 'Aperture' ),
			array( 'et-icon-quote' => 'Quote' ),
			array( 'et-icon-scope' => 'Scope' ),
			array( 'et-icon-alarmclock' => 'Alarmclock' ),
			array( 'et-icon-refresh' => 'Refresh' ),
			array( 'et-icon-happy' => 'Happy' ),
			array( 'et-icon-sad' => 'Sad' ),
			array( 'et-icon-facebook' => 'Facebook' ),
			array( 'et-icon-twitter' => 'Twitter' ),
			array( 'et-icon-googleplus' => 'Googleplus' ),
			array( 'et-icon-rss' => 'Rss' ),
			array( 'et-icon-tumblr' => 'Tumblr' ),
			array( 'et-icon-linkedin' => 'Linkedin' ),
			array( 'et-icon-dribbble' => 'Dribbble' ),
		);
		return $et_icons;
	}
	add_filter( 'vc_iconpicker-type-etline', 'wbc_etline_icons' );
}

//Flat Icon
if ( !function_exists( 'wbc_flaticon_icons' ) ) {
	function wbc_flaticon_icons( $flaticon_icons ) {
		$flaticon_icons = array(
			array( 'flaticon-25' => '25' ),
			array( 'flaticon-access9' => 'Access9' ),
			array( 'flaticon-access32' => 'Access32' ),
			array( 'flaticon-adjusting' => 'Adjusting' ),
			array( 'flaticon-animal265' => 'Animal265' ),
			array( 'flaticon-apple27' => 'Apple27' ),
			array( 'flaticon-apple28' => 'Apple28' ),
			array( 'flaticon-apple32' => 'Apple32' ),
			array( 'flaticon-architecture' => 'Architecture' ),
			array( 'flaticon-architecture1' => 'Architecture1' ),
			array( 'flaticon-attention1' => 'Attention1' ),
			array( 'flaticon-ax2' => 'Ax2' ),
			array( 'flaticon-bald33' => 'Bald33' ),
			array( 'flaticon-barrow' => 'Barrow' ),
			array( 'flaticon-bath23' => 'Bath23' ),
			array( 'flaticon-bike7' => 'Bike7' ),
			array( 'flaticon-black244' => 'Black244' ),
			array( 'flaticon-black245' => 'Black245' ),
			array( 'flaticon-black251' => 'Black251' ),
			array( 'flaticon-black253' => 'Black253' ),
			array( 'flaticon-bodybuilder' => 'Bodybuilder' ),
			array( 'flaticon-bodybuilder1' => 'Bodybuilder1' ),
			array( 'flaticon-boy17' => 'Boy17' ),
			array( 'flaticon-boy18' => 'Boy18' ),
			array( 'flaticon-brick3' => 'Brick3' ),
			array( 'flaticon-bricks3' => 'Bricks3' ),
			array( 'flaticon-bricks4' => 'Bricks4' ),
			array( 'flaticon-brush13' => 'Brush13' ),
			array( 'flaticon-brush14' => 'Brush14' ),
			array( 'flaticon-brush15' => 'Brush15' ),
			array( 'flaticon-brush20' => 'Brush20' ),
			array( 'flaticon-building144' => 'Building144' ),
			array( 'flaticon-building188' => 'Building188' ),
			array( 'flaticon-building189' => 'Building189' ),
			array( 'flaticon-buildings39' => 'Buildings39' ),
			array( 'flaticon-burger5' => 'Burger5' ),
			array( 'flaticon-burger6' => 'Burger6' ),
			array( 'flaticon-chair6' => 'Chair6' ),
			array( 'flaticon-chair7' => 'Chair7' ),
			array( 'flaticon-chair8' => 'Chair8' ),
			array( 'flaticon-chair9' => 'Chair9' ),
			array( 'flaticon-circular77' => 'Circular77' ),
			array( 'flaticon-circular107' => 'Circular107' ),
			array( 'flaticon-clipboard39' => 'Clipboard39' ),
			array( 'flaticon-clipboard40' => 'Clipboard40' ),
			array( 'flaticon-close25' => 'Close25' ),
			array( 'flaticon-closed48' => 'Closed48' ),
			array( 'flaticon-comb4' => 'Comb4' ),
			array( 'flaticon-comb5' => 'Comb5' ),
			array( 'flaticon-comb6' => 'Comb6' ),
			array( 'flaticon-comb7' => 'Comb7' ),
			array( 'flaticon-comb8' => 'Comb8' ),
			array( 'flaticon-comb9' => 'Comb9' ),
			array( 'flaticon-comb10' => 'Comb10' ),
			array( 'flaticon-comb11' => 'Comb11' ),
			array( 'flaticon-comb13' => 'Comb13' ),
			array( 'flaticon-combs' => 'Combs' ),
			array( 'flaticon-combs1' => 'Combs1' ),
			array( 'flaticon-commercial14' => 'Commercial14' ),
			array( 'flaticon-computer299' => 'Computer299' ),
			array( 'flaticon-construction8' => 'Construction8' ),
			array( 'flaticon-construction9' => 'Construction9' ),
			array( 'flaticon-construction10' => 'Construction10' ),
			array( 'flaticon-construction11' => 'Construction11' ),
			array( 'flaticon-construction12' => 'Construction12' ),
			array( 'flaticon-constructor2' => 'Constructor2' ),
			array( 'flaticon-constructor3' => 'Constructor3' ),
			array( 'flaticon-constructor4' => 'Constructor4' ),
			array( 'flaticon-constructor5' => 'Constructor5' ),
			array( 'flaticon-crane8' => 'Crane8' ),
			array( 'flaticon-crane9' => 'Crane9' ),
			array( 'flaticon-cranes3' => 'Cranes3' ),
			array( 'flaticon-curled9' => 'Curled9' ),
			array( 'flaticon-curled10' => 'Curled10' ),
			array( 'flaticon-curler' => 'Curler' ),
			array( 'flaticon-curlers' => 'Curlers' ),
			array( 'flaticon-dark46' => 'Dark46' ),
			array( 'flaticon-dart9' => 'Dart9' ),
			array( 'flaticon-demolition' => 'Demolition' ),
			array( 'flaticon-document312' => 'Document312' ),
			array( 'flaticon-drawing7' => 'Drawing7' ),
			array( 'flaticon-drawing8' => 'Drawing8' ),
			array( 'flaticon-drill6' => 'Drill6' ),
			array( 'flaticon-drill7' => 'Drill7' ),
			array( 'flaticon-drinking1' => 'Drinking1' ),
			array( 'flaticon-drop41' => 'Drop41' ),
			array( 'flaticon-dumbbell14' => 'Dumbbell14' ),
			array( 'flaticon-dumbbell16' => 'Dumbbell16' ),
			array( 'flaticon-dumbbell17' => 'Dumbbell17' ),
			array( 'flaticon-dumbbells1' => 'Dumbbells1' ),
			array( 'flaticon-elastic' => 'Elastic' ),
			array( 'flaticon-electrical9' => 'Electrical9' ),
			array( 'flaticon-elegant19' => 'Elegant19' ),
			array( 'flaticon-exclamation19' => 'Exclamation19' ),
			array( 'flaticon-exercise4' => 'Exercise4' ),
			array( 'flaticon-factory11' => 'Factory11' ),
			array( 'flaticon-female111' => 'Female111' ),
			array( 'flaticon-female117' => 'Female117' ),
			array( 'flaticon-female154' => 'Female154' ),
			array( 'flaticon-female155' => 'Female155' ),
			array( 'flaticon-female156' => 'Female156' ),
			array( 'flaticon-female157' => 'Female157' ),
			array( 'flaticon-female158' => 'Female158' ),
			array( 'flaticon-female159' => 'Female159' ),
			array( 'flaticon-female160' => 'Female160' ),
			array( 'flaticon-female161' => 'Female161' ),
			array( 'flaticon-female162' => 'Female162' ),
			array( 'flaticon-female163' => 'Female163' ),
			array( 'flaticon-female164' => 'Female164' ),
			array( 'flaticon-female165' => 'Female165' ),
			array( 'flaticon-female166' => 'Female166' ),
			array( 'flaticon-female167' => 'Female167' ),
			array( 'flaticon-female168' => 'Female168' ),
			array( 'flaticon-female169' => 'Female169' ),
			array( 'flaticon-female170' => 'Female170' ),
			array( 'flaticon-female171' => 'Female171' ),
			array( 'flaticon-female172' => 'Female172' ),
			array( 'flaticon-female173' => 'Female173' ),
			array( 'flaticon-female175' => 'Female175' ),
			array( 'flaticon-female176' => 'Female176' ),
			array( 'flaticon-female177' => 'Female177' ),
			array( 'flaticon-female178' => 'Female178' ),
			array( 'flaticon-female179' => 'Female179' ),
			array( 'flaticon-female180' => 'Female180' ),
			array( 'flaticon-female182' => 'Female182' ),
			array( 'flaticon-female183' => 'Female183' ),
			array( 'flaticon-female184' => 'Female184' ),
			array( 'flaticon-female185' => 'Female185' ),
			array( 'flaticon-female186' => 'Female186' ),
			array( 'flaticon-fen' => 'Fen' ),
			array( 'flaticon-file252' => 'File252' ),
			array( 'flaticon-flats' => 'Flats' ),
			array( 'flaticon-foam' => 'Foam' ),
			array( 'flaticon-folded30' => 'Folded30' ),
			array( 'flaticon-fork15' => 'Fork15' ),
			array( 'flaticon-fork16' => 'Fork16' ),
			array( 'flaticon-four57' => 'Four57' ),
			array( 'flaticon-fruit3' => 'Fruit3' ),
			array( 'flaticon-furniture116' => 'Furniture116' ),
			array( 'flaticon-furniture117' => 'Furniture117' ),
			array( 'flaticon-garages' => 'Garages' ),
			array( 'flaticon-garden107' => 'Garden107' ),
			array( 'flaticon-gear27' => 'Gear27' ),
			array( 'flaticon-geisha2' => 'Geisha2' ),
			array( 'flaticon-gel' => 'Gel' ),
			array( 'flaticon-gym' => 'Gym' ),
			array( 'flaticon-gym1' => 'Gym1' ),
			array( 'flaticon-gym2' => 'Gym2' ),
			array( 'flaticon-gym4' => 'Gym4' ),
			array( 'flaticon-gym5' => 'Gym5' ),
			array( 'flaticon-gym6' => 'Gym6' ),
			array( 'flaticon-gymnast4' => 'Gymnast4' ),
			array( 'flaticon-gymnast5' => 'Gymnast5' ),
			array( 'flaticon-gymnast6' => 'Gymnast6' ),
			array( 'flaticon-gymnast7' => 'Gymnast7' ),
			array( 'flaticon-gymnast8' => 'Gymnast8' ),
			array( 'flaticon-gymnast9' => 'Gymnast9' ),
			array( 'flaticon-gymnast10' => 'Gymnast10' ),
			array( 'flaticon-gymnast12' => 'Gymnast12' ),
			array( 'flaticon-gymnast13' => 'Gymnast13' ),
			array( 'flaticon-gymnast14' => 'Gymnast14' ),
			array( 'flaticon-gymnast15' => 'Gymnast15' ),
			array( 'flaticon-gymnast16' => 'Gymnast16' ),
			array( 'flaticon-gymnast17' => 'Gymnast17' ),
			array( 'flaticon-gymnast18' => 'Gymnast18' ),
			array( 'flaticon-gymnast19' => 'Gymnast19' ),
			array( 'flaticon-gymnast21' => 'Gymnast21' ),
			array( 'flaticon-gymnast22' => 'Gymnast22' ),
			array( 'flaticon-gymnast23' => 'Gymnast23' ),
			array( 'flaticon-gymnast24' => 'Gymnast24' ),
			array( 'flaticon-gymnast25' => 'Gymnast25' ),
			array( 'flaticon-gymnast26' => 'Gymnast26' ),
			array( 'flaticon-gymnast27' => 'Gymnast27' ),
			array( 'flaticon-gymnast28' => 'Gymnast28' ),
			array( 'flaticon-gymnast29' => 'Gymnast29' ),
			array( 'flaticon-gymnast30' => 'Gymnast30' ),
			array( 'flaticon-gymnast31' => 'Gymnast31' ),
			array( 'flaticon-gymnast33' => 'Gymnast33' ),
			array( 'flaticon-gymnast35' => 'Gymnast35' ),
			array( 'flaticon-gymnast36' => 'Gymnast36' ),
			array( 'flaticon-gymnast37' => 'Gymnast37' ),
			array( 'flaticon-gymnast38' => 'Gymnast38' ),
			array( 'flaticon-gymnast39' => 'Gymnast39' ),
			array( 'flaticon-gymnast40' => 'Gymnast40' ),
			array( 'flaticon-gymnast41' => 'Gymnast41' ),
			array( 'flaticon-gymnast42' => 'Gymnast42' ),
			array( 'flaticon-gymnast43' => 'Gymnast43' ),
			array( 'flaticon-gymnast44' => 'Gymnast44' ),
			array( 'flaticon-gymnast45' => 'Gymnast45' ),
			array( 'flaticon-gymnast46' => 'Gymnast46' ),
			array( 'flaticon-gymnast47' => 'Gymnast47' ),
			array( 'flaticon-gymnast48' => 'Gymnast48' ),
			array( 'flaticon-gymnast49' => 'Gymnast49' ),
			array( 'flaticon-gymnast50' => 'Gymnast50' ),
			array( 'flaticon-gymnast51' => 'Gymnast51' ),
			array( 'flaticon-gymnast52' => 'Gymnast52' ),
			array( 'flaticon-hair13' => 'Hair13' ),
			array( 'flaticon-hair14' => 'Hair14' ),
			array( 'flaticon-hair15' => 'Hair15' ),
			array( 'flaticon-hair16' => 'Hair16' ),
			array( 'flaticon-hair17' => 'Hair17' ),
			array( 'flaticon-hair18' => 'Hair18' ),
			array( 'flaticon-hair19' => 'Hair19' ),
			array( 'flaticon-hair20' => 'Hair20' ),
			array( 'flaticon-hair21' => 'Hair21' ),
			array( 'flaticon-hair22' => 'Hair22' ),
			array( 'flaticon-hair23' => 'Hair23' ),
			array( 'flaticon-hair24' => 'Hair24' ),
			array( 'flaticon-hair25' => 'Hair25' ),
			array( 'flaticon-hair26' => 'Hair26' ),
			array( 'flaticon-hair27' => 'Hair27' ),
			array( 'flaticon-hair28' => 'Hair28' ),
			array( 'flaticon-hair29' => 'Hair29' ),
			array( 'flaticon-hair30' => 'Hair30' ),
			array( 'flaticon-hair31' => 'Hair31' ),
			array( 'flaticon-hair32' => 'Hair32' ),
			array( 'flaticon-hair33' => 'Hair33' ),
			array( 'flaticon-hair34' => 'Hair34' ),
			array( 'flaticon-hair35' => 'Hair35' ),
			array( 'flaticon-hair36' => 'Hair36' ),
			array( 'flaticon-hair37' => 'Hair37' ),
			array( 'flaticon-hair38' => 'Hair38' ),
			array( 'flaticon-hair39' => 'Hair39' ),
			array( 'flaticon-hair40' => 'Hair40' ),
			array( 'flaticon-hair41' => 'Hair41' ),
			array( 'flaticon-hair42' => 'Hair42' ),
			array( 'flaticon-hair43' => 'Hair43' ),
			array( 'flaticon-hair44' => 'Hair44' ),
			array( 'flaticon-hair45' => 'Hair45' ),
			array( 'flaticon-hair46' => 'Hair46' ),
			array( 'flaticon-hair47' => 'Hair47' ),
			array( 'flaticon-hair48' => 'Hair48' ),
			array( 'flaticon-hair49' => 'Hair49' ),
			array( 'flaticon-hair50' => 'Hair50' ),
			array( 'flaticon-hair51' => 'Hair51' ),
			array( 'flaticon-hair52' => 'Hair52' ),
			array( 'flaticon-hair53' => 'Hair53' ),
			array( 'flaticon-hair54' => 'Hair54' ),
			array( 'flaticon-hair55' => 'Hair55' ),
			array( 'flaticon-hair56' => 'Hair56' ),
			array( 'flaticon-hair57' => 'Hair57' ),
			array( 'flaticon-hair58' => 'Hair58' ),
			array( 'flaticon-hair59' => 'Hair59' ),
			array( 'flaticon-hair60' => 'Hair60' ),
			array( 'flaticon-hair61' => 'Hair61' ),
			array( 'flaticon-hair62' => 'Hair62' ),
			array( 'flaticon-hair63' => 'Hair63' ),
			array( 'flaticon-hair64' => 'Hair64' ),
			array( 'flaticon-hair65' => 'Hair65' ),
			array( 'flaticon-hair66' => 'Hair66' ),
			array( 'flaticon-hairdresser' => 'Hairdresser' ),
			array( 'flaticon-hairdresser1' => 'Hairdresser1' ),
			array( 'flaticon-hairdresser2' => 'Hairdresser2' ),
			array( 'flaticon-hairdresser3' => 'Hairdresser3' ),
			array( 'flaticon-hairdresser4' => 'Hairdresser4' ),
			array( 'flaticon-hairdresser5' => 'Hairdresser5' ),
			array( 'flaticon-hairdresser6' => 'Hairdresser6' ),
			array( 'flaticon-hairdresser7' => 'Hairdresser7' ),
			array( 'flaticon-hairdresser8' => 'Hairdresser8' ),
			array( 'flaticon-hairdresser9' => 'Hairdresser9' ),
			array( 'flaticon-hairdresser10' => 'Hairdresser10' ),
			array( 'flaticon-hairdresser11' => 'Hairdresser11' ),
			array( 'flaticon-hairdresser12' => 'Hairdresser12' ),
			array( 'flaticon-hairdresser13' => 'Hairdresser13' ),
			array( 'flaticon-hairdresser14' => 'Hairdresser14' ),
			array( 'flaticon-hairdresser15' => 'Hairdresser15' ),
			array( 'flaticon-hairdryer5' => 'Hairdryer5' ),
			array( 'flaticon-hairdryer6' => 'Hairdryer6' ),
			array( 'flaticon-hairdryer7' => 'Hairdryer7' ),
			array( 'flaticon-hairstyle' => 'Hairstyle' ),
			array( 'flaticon-hairstyle1' => 'Hairstyle1' ),
			array( 'flaticon-hairstylist' => 'Hairstylist' ),
			array( 'flaticon-hammer40' => 'Hammer40' ),
			array( 'flaticon-hammer41' => 'Hammer41' ),
			array( 'flaticon-hammer42' => 'Hammer42' ),
			array( 'flaticon-hand121' => 'Hand121' ),
			array( 'flaticon-hand122' => 'Hand122' ),
			array( 'flaticon-hand123' => 'Hand123' ),
			array( 'flaticon-hand125' => 'Hand125' ),
			array( 'flaticon-hand126' => 'Hand126' ),
			array( 'flaticon-head20' => 'Head20' ),
			array( 'flaticon-heads' => 'Heads' ),
			array( 'flaticon-heart88' => 'Heart88' ),
			array( 'flaticon-heart92' => 'Heart92' ),
			array( 'flaticon-hexagonal5' => 'Hexagonal5' ),
			array( 'flaticon-home180' => 'Home180' ),
			array( 'flaticon-hook3' => 'Hook3' ),
			array( 'flaticon-house250' => 'House250' ),
			array( 'flaticon-house251' => 'House251' ),
			array( 'flaticon-house252' => 'House252' ),
			array( 'flaticon-house253' => 'House253' ),
			array( 'flaticon-house254' => 'House254' ),
			array( 'flaticon-houses22' => 'Houses22' ),
			array( 'flaticon-houses23' => 'Houses23' ),
			array( 'flaticon-human72' => 'Human72' ),
			array( 'flaticon-human86' => 'Human86' ),
			array( 'flaticon-human87' => 'Human87' ),
			array( 'flaticon-indication' => 'Indication' ),
			array( 'flaticon-industrial19' => 'Industrial19' ),
			array( 'flaticon-irregular9' => 'Irregular9' ),
			array( 'flaticon-juice' => 'Juice' ),
			array( 'flaticon-jump4' => 'Jump4' ),
			array( 'flaticon-jumping8' => 'Jumping8' ),
			array( 'flaticon-jumping9' => 'Jumping9' ),
			array( 'flaticon-juvenile' => 'Juvenile' ),
			array( 'flaticon-lateral' => 'Lateral' ),
			array( 'flaticon-liquid7' => 'Liquid7' ),
			array( 'flaticon-list34' => 'List34' ),
			array( 'flaticon-long19' => 'Long19' ),
			array( 'flaticon-long20' => 'Long20' ),
			array( 'flaticon-long21' => 'Long21' ),
			array( 'flaticon-long22' => 'Long22' ),
			array( 'flaticon-long23' => 'Long23' ),
			array( 'flaticon-long24' => 'Long24' ),
			array( 'flaticon-long25' => 'Long25' ),
			array( 'flaticon-long26' => 'Long26' ),
			array( 'flaticon-long27' => 'Long27' ),
			array( 'flaticon-long28' => 'Long28' ),
			array( 'flaticon-long29' => 'Long29' ),
			array( 'flaticon-long30' => 'Long30' ),
			array( 'flaticon-long31' => 'Long31' ),
			array( 'flaticon-long32' => 'Long32' ),
			array( 'flaticon-long33' => 'Long33' ),
			array( 'flaticon-long34' => 'Long34' ),
			array( 'flaticon-machine10' => 'Machine10' ),
			array( 'flaticon-mail138' => 'Mail138' ),
			array( 'flaticon-male118' => 'Male118' ),
			array( 'flaticon-male126' => 'Male126' ),
			array( 'flaticon-male130' => 'Male130' ),
			array( 'flaticon-male131' => 'Male131' ),
			array( 'flaticon-male134' => 'Male134' ),
			array( 'flaticon-male136' => 'Male136' ),
			array( 'flaticon-male140' => 'Male140' ),
			array( 'flaticon-male142' => 'Male142' ),
			array( 'flaticon-male143' => 'Male143' ),
			array( 'flaticon-male146' => 'Male146' ),
			array( 'flaticon-male173' => 'Male173' ),
			array( 'flaticon-male175' => 'Male175' ),
			array( 'flaticon-male176' => 'Male176' ),
			array( 'flaticon-male177' => 'Male177' ),
			array( 'flaticon-male178' => 'Male178' ),
			array( 'flaticon-male179' => 'Male179' ),
			array( 'flaticon-male180' => 'Male180' ),
			array( 'flaticon-male184' => 'Male184' ),
			array( 'flaticon-male185' => 'Male185' ),
			array( 'flaticon-male186' => 'Male186' ),
			array( 'flaticon-male187' => 'Male187' ),
			array( 'flaticon-male188' => 'Male188' ),
			array( 'flaticon-male189' => 'Male189' ),
			array( 'flaticon-male190' => 'Male190' ),
			array( 'flaticon-man81' => 'Man81' ),
			array( 'flaticon-man82' => 'Man82' ),
			array( 'flaticon-man159' => 'Man159' ),
			array( 'flaticon-man174' => 'Man174' ),
			array( 'flaticon-man178' => 'Man178' ),
			array( 'flaticon-man181' => 'Man181' ),
			array( 'flaticon-man200' => 'Man200' ),
			array( 'flaticon-man201' => 'Man201' ),
			array( 'flaticon-man202' => 'Man202' ),
			array( 'flaticon-man203' => 'Man203' ),
			array( 'flaticon-medallion' => 'Medallion' ),
			array( 'flaticon-medication2' => 'Medication2' ),
			array( 'flaticon-medication3' => 'Medication3' ),
			array( 'flaticon-mirror3' => 'Mirror3' ),
			array( 'flaticon-mirror4' => 'Mirror4' ),
			array( 'flaticon-mirror5' => 'Mirror5' ),
			array( 'flaticon-mirror6' => 'Mirror6' ),
			array( 'flaticon-money441' => 'Money441' ),
			array( 'flaticon-monitoring1' => 'Monitoring1' ),
			array( 'flaticon-mountain16' => 'Mountain16' ),
			array( 'flaticon-muscular1' => 'Muscular1' ),
			array( 'flaticon-muscular3' => 'Muscular3' ),
			array( 'flaticon-muscular4' => 'Muscular4' ),
			array( 'flaticon-muscular5' => 'Muscular5' ),
			array( 'flaticon-muscular6' => 'Muscular6' ),
			array( 'flaticon-muscular7' => 'Muscular7' ),
			array( 'flaticon-muscular8' => 'Muscular8' ),
			array( 'flaticon-muscular9' => 'Muscular9' ),
			array( 'flaticon-muscular10' => 'Muscular10' ),
			array( 'flaticon-muscular12' => 'Muscular12' ),
			array( 'flaticon-muscular13' => 'Muscular13' ),
			array( 'flaticon-muscular14' => 'Muscular14' ),
			array( 'flaticon-muscular15' => 'Muscular15' ),
			array( 'flaticon-mustache8' => 'Mustache8' ),
			array( 'flaticon-mustache9' => 'Mustache9' ),
			array( 'flaticon-mustache10' => 'Mustache10' ),
			array( 'flaticon-mustache11' => 'Mustache11' ),
			array( 'flaticon-mustache12' => 'Mustache12' ),
			array( 'flaticon-nut' => 'Nut' ),
			array( 'flaticon-one30' => 'One30' ),
			array( 'flaticon-open153' => 'Open153' ),
			array( 'flaticon-open154' => 'Open154' ),
			array( 'flaticon-opened5' => 'Opened5' ),
			array( 'flaticon-oval16' => 'Oval16' ),
			array( 'flaticon-oval17' => 'Oval17' ),
			array( 'flaticon-oval18' => 'Oval18' ),
			array( 'flaticon-pail' => 'Pail' ),
			array( 'flaticon-paint54' => 'Paint54' ),
			array( 'flaticon-paint55' => 'Paint55' ),
			array( 'flaticon-painter26' => 'Painter26' ),
			array( 'flaticon-painting34' => 'Painting34' ),
			array( 'flaticon-painting35' => 'Painting35' ),
			array( 'flaticon-pets8' => 'Pets8' ),
			array( 'flaticon-phonereceiver15' => 'Phonereceiver15' ),
			array( 'flaticon-pipes' => 'Pipes' ),
			array( 'flaticon-placeholder71' => 'Placeholder71' ),
			array( 'flaticon-plug55' => 'Plug55' ),
			array( 'flaticon-ponytail' => 'Ponytail' ),
			array( 'flaticon-pressure2' => 'Pressure2' ),
			array( 'flaticon-processed' => 'Processed' ),
			array( 'flaticon-professional7' => 'Professional7' ),
			array( 'flaticon-prohibition6' => 'Prohibition6' ),
			array( 'flaticon-protein' => 'Protein' ),
			array( 'flaticon-protein1' => 'Protein1' ),
			array( 'flaticon-punk1' => 'Punk1' ),
			array( 'flaticon-punk2' => 'Punk2' ),
			array( 'flaticon-punk3' => 'Punk3' ),
			array( 'flaticon-razor' => 'Razor' ),
			array( 'flaticon-razor1' => 'Razor1' ),
			array( 'flaticon-razor2' => 'Razor2' ),
			array( 'flaticon-razor3' => 'Razor3' ),
			array( 'flaticon-razor4' => 'Razor4' ),
			array( 'flaticon-razors' => 'Razors' ),
			array( 'flaticon-realestate11' => 'Realestate11' ),
			array( 'flaticon-rectangular53' => 'Rectangular53' ),
			array( 'flaticon-roof1' => 'Roof1' ),
			array( 'flaticon-round48' => 'Round48' ),
			array( 'flaticon-rounded45' => 'Rounded45' ),
			array( 'flaticon-saw8' => 'Saw8' ),
			array( 'flaticon-sawing' => 'Sawing' ),
			array( 'flaticon-scale10' => 'Scale10' ),
			array( 'flaticon-scissor8' => 'Scissor8' ),
			array( 'flaticon-scissors23' => 'Scissors23' ),
			array( 'flaticon-scissors24' => 'Scissors24' ),
			array( 'flaticon-scissors25' => 'Scissors25' ),
			array( 'flaticon-scissors26' => 'Scissors26' ),
			array( 'flaticon-scissors27' => 'Scissors27' ),
			array( 'flaticon-scissors28' => 'Scissors28' ),
			array( 'flaticon-scissors29' => 'Scissors29' ),
			array( 'flaticon-scissors30' => 'Scissors30' ),
			array( 'flaticon-scissors31' => 'Scissors31' ),
			array( 'flaticon-scissors32' => 'Scissors32' ),
			array( 'flaticon-scissors33' => 'Scissors33' ),
			array( 'flaticon-scissors34' => 'Scissors34' ),
			array( 'flaticon-scissors36' => 'Scissors36' ),
			array( 'flaticon-scissors37' => 'Scissors37' ),
			array( 'flaticon-scissors38' => 'Scissors38' ),
			array( 'flaticon-scissors39' => 'Scissors39' ),
			array( 'flaticon-scissors40' => 'Scissors40' ),
			array( 'flaticon-scissors41' => 'Scissors41' ),
			array( 'flaticon-scissors42' => 'Scissors42' ),
			array( 'flaticon-screen157' => 'Screen157' ),
			array( 'flaticon-screw7' => 'Screw7' ),
			array( 'flaticon-screwdriver18' => 'Screwdriver18' ),
			array( 'flaticon-sexy4' => 'Sexy4' ),
			array( 'flaticon-shampoo' => 'Shampoo' ),
			array( 'flaticon-shaver' => 'Shaver' ),
			array( 'flaticon-shaver1' => 'Shaver1' ),
			array( 'flaticon-shaving' => 'Shaving' ),
			array( 'flaticon-short5' => 'Short5' ),
			array( 'flaticon-short6' => 'Short6' ),
			array( 'flaticon-short7' => 'Short7' ),
			array( 'flaticon-short8' => 'Short8' ),
			array( 'flaticon-short9' => 'Short9' ),
			array( 'flaticon-short10' => 'Short10' ),
			array( 'flaticon-short11' => 'Short11' ),
			array( 'flaticon-short12' => 'Short12' ),
			array( 'flaticon-short13' => 'Short13' ),
			array( 'flaticon-short14' => 'Short14' ),
			array( 'flaticon-short15' => 'Short15' ),
			array( 'flaticon-short16' => 'Short16' ),
			array( 'flaticon-short17' => 'Short17' ),
			array( 'flaticon-short18' => 'Short18' ),
			array( 'flaticon-short19' => 'Short19' ),
			array( 'flaticon-short20' => 'Short20' ),
			array( 'flaticon-short21' => 'Short21' ),
			array( 'flaticon-short22' => 'Short22' ),
			array( 'flaticon-short23' => 'Short23' ),
			array( 'flaticon-short24' => 'Short24' ),
			array( 'flaticon-short25' => 'Short25' ),
			array( 'flaticon-short26' => 'Short26' ),
			array( 'flaticon-short27' => 'Short27' ),
			array( 'flaticon-short28' => 'Short28' ),
			array( 'flaticon-short29' => 'Short29' ),
			array( 'flaticon-short30' => 'Short30' ),
			array( 'flaticon-short31' => 'Short31' ),
			array( 'flaticon-short32' => 'Short32' ),
			array( 'flaticon-short33' => 'Short33' ),
			array( 'flaticon-short34' => 'Short34' ),
			array( 'flaticon-short35' => 'Short35' ),
			array( 'flaticon-short36' => 'Short36' ),
			array( 'flaticon-short37' => 'Short37' ),
			array( 'flaticon-shovel3' => 'Shovel3' ),
			array( 'flaticon-shovel4' => 'Shovel4' ),
			array( 'flaticon-showers7' => 'Showers7' ),
			array( 'flaticon-sitting7' => 'Sitting7' ),
			array( 'flaticon-slim' => 'Slim' ),
			array( 'flaticon-smog' => 'Smog' ),
			array( 'flaticon-spang' => 'Spang' ),
			array( 'flaticon-spang1' => 'Spang1' ),
			array( 'flaticon-spang2' => 'Spang2' ),
			array( 'flaticon-spang3' => 'Spang3' ),
			array( 'flaticon-speech-bubble75' => 'Speech-bubble75' ),
			array( 'flaticon-speechbubble75' => 'Speechbubble75' ),
			array( 'flaticon-sportive25' => 'Sportive25' ),
			array( 'flaticon-sportive26' => 'Sportive26' ),
			array( 'flaticon-spray10' => 'Spray10' ),
			array( 'flaticon-spray11' => 'Spray11' ),
			array( 'flaticon-stair1' => 'Stair1' ),
			array( 'flaticon-standing61' => 'Standing61' ),
			array( 'flaticon-stats113' => 'Stats113' ),
			array( 'flaticon-steroids' => 'Steroids' ),
			array( 'flaticon-stick1' => 'Stick1' ),
			array( 'flaticon-stick2' => 'Stick2' ),
			array( 'flaticon-stick3' => 'Stick3' ),
			array( 'flaticon-stick4' => 'Stick4' ),
			array( 'flaticon-stick5' => 'Stick5' ),
			array( 'flaticon-stick6' => 'Stick6' ),
			array( 'flaticon-stick7' => 'Stick7' ),
			array( 'flaticon-store19' => 'Store19' ),
			array( 'flaticon-street7' => 'Street7' ),
			array( 'flaticon-street12' => 'Street12' ),
			array( 'flaticon-striped8' => 'Striped8' ),
			array( 'flaticon-super2' => 'Super2' ),
			array( 'flaticon-supplement' => 'Supplement' ),
			array( 'flaticon-swimmer16' => 'Swimmer16' ),
			array( 'flaticon-syringe11' => 'Syringe11' ),
			array( 'flaticon-tablet109' => 'Tablet109' ),
			array( 'flaticon-telephone277' => 'Telephone277' ),
			array( 'flaticon-three100' => 'Three100' ),
			array( 'flaticon-timer22' => 'Timer22' ),
			array( 'flaticon-timer23' => 'Timer23' ),
			array( 'flaticon-tool190' => 'Tool190' ),
			array( 'flaticon-traffic14' => 'Traffic14' ),
			array( 'flaticon-transport6' => 'Transport6' ),
			array( 'flaticon-transport771' => 'Transport771' ),
			array( 'flaticon-transport772' => 'Transport772' ),
			array( 'flaticon-treadmill' => 'Treadmill' ),
			array( 'flaticon-treadmill1' => 'Treadmill1' ),
			array( 'flaticon-treadmill2' => 'Treadmill2' ),
			array( 'flaticon-triangular45' => 'Triangular45' ),
			array( 'flaticon-triangular46' => 'Triangular46' ),
			array( 'flaticon-trolley1' => 'Trolley1' ),
			array( 'flaticon-truck27' => 'Truck27' ),
			array( 'flaticon-truck28' => 'Truck28' ),
			array( 'flaticon-truck29' => 'Truck29' ),
			array( 'flaticon-tvscreen31' => 'Tvscreen31' ),
			array( 'flaticon-two193' => 'Two193' ),
			array( 'flaticon-two195' => 'Two195' ),
			array( 'flaticon-verified4' => 'Verified4' ),
			array( 'flaticon-wall20' => 'Wall20' ),
			array( 'flaticon-weighing9' => 'Weighing9' ),
			array( 'flaticon-weighing10' => 'Weighing10' ),
			array( 'flaticon-weight7' => 'Weight7' ),
			array( 'flaticon-wheelbarrow2' => 'Wheelbarrow2' ),
			array( 'flaticon-wheelbarrow3' => 'Wheelbarrow3' ),
			array( 'flaticon-wig' => 'Wig' ),
			array( 'flaticon-woman67' => 'Woman67' ),
			array( 'flaticon-woman68' => 'Woman68' ),
			array( 'flaticon-woman69' => 'Woman69' ),
			array( 'flaticon-woman70' => 'Woman70' ),
			array( 'flaticon-woman71' => 'Woman71' ),
			array( 'flaticon-woman72' => 'Woman72' ),
			array( 'flaticon-woman73' => 'Woman73' ),
			array( 'flaticon-woman74' => 'Woman74' ),
			array( 'flaticon-woman75' => 'Woman75' ),
			array( 'flaticon-woman76' => 'Woman76' ),
			array( 'flaticon-woman77' => 'Woman77' ),
			array( 'flaticon-woman78' => 'Woman78' ),
			array( 'flaticon-woman79' => 'Woman79' ),
			array( 'flaticon-woman80' => 'Woman80' ),
			array( 'flaticon-woman81' => 'Woman81' ),
			array( 'flaticon-worker5' => 'Worker5' ),
			array( 'flaticon-wrench57' => 'Wrench57' ),
			array( 'flaticon-wrench58' => 'Wrench58' ),
			array( 'flaticon-wrench59' => 'Wrench59' ),
			array( 'flaticon-wrench60' => 'Wrench60' ),
			array( 'flaticon-yoga9' => 'Yoga9' ),
			array( 'flaticon-young13' => 'Young13' ),
		);
		return $flaticon_icons;
	}
	add_filter( 'vc_iconpicker-type-flaticon', 'wbc_flaticon_icons' );
}

if( function_exists( 'vc_remove_param' ) ){
	vc_remove_param('vc_row', 'parallax_speed_video');
	vc_remove_param('vc_row', 'parallax_speed_bg');
	vc_remove_param('vc_row', 'css');
    vc_remove_param('vc_row', 'full_width');
    vc_remove_param('vc_row', 'parallax');
    vc_remove_param('vc_row', 'parallax_image');
    vc_remove_param('vc_row', 'el_id');
    vc_remove_param('vc_row', 'video_bg');
    vc_remove_param('vc_row', 'video_bg_url');
    vc_remove_param('vc_row', 'video_bg_parallax');
    vc_remove_param('vc_row', 'content_placement');
	// vc_remove_param('vc_row', 'gap');
    vc_remove_param('vc_row', 'columns_placement');
    vc_remove_param('vc_row', 'equal_height');
	vc_remove_param('vc_column', 'css');
	vc_remove_param('vc_row_inner', 'el_id');
	vc_remove_param('vc_row_inner', 'content_placement');
	// vc_remove_param('vc_row_inner', 'gap');
	vc_remove_param('vc_row_inner', 'equal_height');
}

/************************************************************************
* Mapper Adds Shortcodes to VC Editor
*************************************************************************/
if ( !function_exists( 'wbc907_map_to_vc' ) ) {
	function wbc907_map_to_vc() {
		$wbc_image_sizes = apply_filters('wbc_image_sizes', array(
					esc_html__( 'Default', 'ninezeroseven' )    => '',
					esc_html__( 'Small', 'ninezeroseven' )      =>  'small',
					esc_html__( 'Medium', 'ninezeroseven' )     =>  'medium',
					esc_html__( 'Large', 'ninezeroseven' )      =>  'large',
					esc_html__( 'Full', 'ninezeroseven' )       =>  'full',
					esc_html__( 'Square', 'ninezeroseven' )     =>  'square',
					esc_html__( 'Portrait', 'ninezeroseven' )   =>  'portrait',
					esc_html__( 'Landscaped', 'ninezeroseven' ) =>  'landscape',
					esc_html__( '600 x 400', 'ninezeroseven' )  =>  'post-600x400-image',
					esc_html__( '500 x 400', 'ninezeroseven' )  =>  'post-500x400-image',
					esc_html__( '1140 Width', 'ninezeroseven' ) =>  'post-1140-image',
					esc_html__( '848 Width', 'ninezeroseven' )  =>  'post-848-image',
				));

		$wbc_animation_array = array(
			'None'            	 => '',
		    'bounce'             => 'bounce',
		    'flash'              => 'flash',
		    'pulse'              => 'pulse',
		    'rubberBand'         => 'rubberBand',
		    'shake'              => 'shake',
		    'swing'              => 'swing',
		    'tada'               => 'tada',
		    'wobble'             => 'wobble',
		    'jello'              => 'jello',
		    'bounceIn'           => 'bounceIn',
		    'bounceInDown'       => 'bounceInDown',
		    'bounceInLeft'       => 'bounceInLeft',
		    'bounceInRight'      => 'bounceInRight',
		    'bounceInUp'         => 'bounceInUp',
		    'bounceOut'          => 'bounceOut',
		    'bounceOutDown'      => 'bounceOutDown',
		    'bounceOutLeft'      => 'bounceOutLeft',
		    'bounceOutRight'     => 'bounceOutRight',
		    'bounceOutUp'        => 'bounceOutUp',
		    'fadeIn'             => 'fadeIn',
		    'fadeInDown'         => 'fadeInDown',
		    'fadeInDownBig'      => 'fadeInDownBig',
		    'fadeInLeft'         => 'fadeInLeft',
		    'fadeInLeftBig'      => 'fadeInLeftBig',
		    'fadeInRight'        => 'fadeInRight',
		    'fadeInRightBig'     => 'fadeInRightBig',
		    'fadeInUp'           => 'fadeInUp',
		    'fadeInUpBig'        => 'fadeInUpBig',
		    'fadeOut'            => 'fadeOut',
		    'fadeOutDown'        => 'fadeOutDown',
		    'fadeOutDownBig'     => 'fadeOutDownBig',
		    'fadeOutLeft'        => 'fadeOutLeft',
		    'fadeOutLeftBig'     => 'fadeOutLeftBig',
		    'fadeOutRight'       => 'fadeOutRight',
		    'fadeOutRightBig'    => 'fadeOutRightBig',
		    'fadeOutUp'          => 'fadeOutUp',
		    'fadeOutUpBig'       => 'fadeOutUpBig',
		    'flipInX'            => 'flipInX',
		    'flipInY'            => 'flipInY',
		    'flipOutX'           => 'flipOutX',
		    'flipOutY'           => 'flipOutY',
		    'lightSpeedIn'       => 'lightSpeedIn',
		    'lightSpeedOut'      => 'lightSpeedOut',
		    'rotateIn'           => 'rotateIn',
		    'rotateInDownLeft'   => 'rotateInDownLeft',
		    'rotateInDownRight'  => 'rotateInDownRight',
		    'rotateInUpLeft'     => 'rotateInUpLeft',
		    'rotateInUpRight'    => 'rotateInUpRight',
		    'rotateOut'          => 'rotateOut',
		    'rotateOutDownLeft'  => 'rotateOutDownLeft',
		    'rotateOutDownRight' => 'rotateOutDownRight',
		    'rotateOutUpLeft'    => 'rotateOutUpLeft',
		    'rotateOutUpRight'   => 'rotateOutUpRight',
		    'hinge'              => 'hinge',
		    'rollIn'             => 'rollIn',
		    'rollOut'            => 'rollOut',
		    'zoomIn'             => 'zoomIn',
		    'zoomInDown'         => 'zoomInDown',
		    'zoomInLeft'         => 'zoomInLeft',
		    'zoomInRight'        => 'zoomInRight',
		    'zoomInUp'           => 'zoomInUp',
		    'zoomOut'            => 'zoomOut',
		    'zoomOutDown'        => 'zoomOutDown',
		    'zoomOutLeft'        => 'zoomOutLeft',
		    'zoomOutRight'       => 'zoomOutRight',
		    'zoomOutUp'          => 'zoomOutUp',
		    'slideInDown'        => 'slideInDown',
		    'slideInLeft'        => 'slideInLeft',
		    'slideInRight'       => 'slideInRight',
		    'slideInUp'          => 'slideInUp',
		    'slideOutDown'       => 'slideOutDown',
		    'slideOutLeft'       => 'slideOutLeft',
		    'slideOutRight'      => 'slideOutRight',
		    'slideOutUp'         => 'slideOutUp',
		);

		// ADD PARAMS
		//Column
		vc_add_param("vc_row_inner",array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Anchor ID', 'ninezeroseven' ),
				'param_name'  => 'anchor',
				'description' => esc_html__( 'Use this field to enter anchor tag for menu items. eg about,contact,etc', 'ninezeroseven' ),
			));
		vc_add_param("vc_row_inner",array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Equal Height Columns?', 'ninezeroseven' ),
				'param_name'  => 'match_height',
				'description' => esc_html__( 'If selected, will make inner columns same height.', 'ninezeroseven' ),
				'value'       => array( esc_html__( 'Yes, please', 'ninezeroseven' ) => 'yes' )
			));
		vc_add_param("vc_row_inner",array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Vertical Center Content?', 'ninezeroseven' ),
				'param_name'  => 'vertical_center',
				'description' => esc_html__( 'If selected, will center content vertically', 'ninezeroseven' ),
				'value'       => array( esc_html__( 'Yes, please', 'ninezeroseven' ) => 'yes' ),
				"dependency" => array('element' => "match_height", 'value' => array('yes')),
			));

		vc_add_param("vc_row_inner",array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Bordered Columns?', 'ninezeroseven' ),
				'param_name'  => 'bordered',
				'description' => esc_html__( 'If selected, will add border between columns', 'ninezeroseven' ),
				'value'       => array( esc_html__( 'Yes, please', 'ninezeroseven' ) => 'yes' ),
			));

		vc_add_param("vc_row_inner", array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Border Color', 'ninezeroseven' ),
			'param_name' => 'bordered_color',
			'description' => esc_html__( 'Color of borders', 'ninezeroseven' ),
			"dependency" => array('element' => "bordered", 'value' => array('yes')),

		));

		vc_add_param("vc_row_inner",array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Remove Column Padding?', 'ninezeroseven' ),
				'param_name'  => 'no_innerpadding',
				'description' => esc_html__( 'If selected, will remove padding from inner columns.', 'ninezeroseven' ),
				'value'       => array( esc_html__( 'Yes, please', 'ninezeroseven' ) => 'yes' )
			));

		vc_add_param("vc_column", array(
			"type" => "attach_image",
			"admin_label" => true,
			"class" => "",
			"heading" => esc_html__('Bg Image', 'ninezeroseven'),
			"param_name" => "parallax_img",
			'group' => esc_html__( '907 Options', 'ninezeroseven' )
		));
		vc_add_param("vc_column", array(
		    'type' => 'dropdown',
		    'heading' => esc_html__( 'Background Repeat', 'ninezeroseven' ),
		    'param_name' => 'parallax_repeat',
		    'value' => array(
							esc_html__( 'Default', 'ninezeroseven' ) => '',
							esc_html__( 'Cover', 'ninezeroseven' )   => 'cover',
							esc_html__('Contain', 'ninezeroseven')   => 'contain',
							esc_html__('Repeat', 'ninezeroseven')    => 'repeat',
							esc_html__('No Repeat', 'ninezeroseven') => 'no-repeat'
						),
		    'description' => esc_html__( 'Select how a background image will be repeated', 'ninezeroseven' ),
			'group' => esc_html__( '907 Options', 'ninezeroseven' )
		));

		vc_add_param("vc_column", array(
		    'type' => 'dropdown',
		    'heading' => esc_html__( 'Background Position', 'ninezeroseven' ),
		    'param_name' => 'bg_image_postions',
		    'value' => array(
							esc_html__( 'Default', 'ninezeroseven' )       => '',
							esc_html__( 'Left Top', 'ninezeroseven' )      => 'left top',
							esc_html__( 'Left Center', 'ninezeroseven' )   => 'left center',
							esc_html__( 'Left Bottom', 'ninezeroseven')     => 'left bottom',
							esc_html__( 'Right Top', 'ninezeroseven' )     => 'right top',
							esc_html__( 'Right Center', 'ninezeroseven' )  => 'right center',
							esc_html__( 'Right Bottom', 'ninezeroseven')    => 'right bottom',
							esc_html__( 'Center Top', 'ninezeroseven' )    => 'center top',
							esc_html__( 'Center Center', 'ninezeroseven' ) => 'center center',
							esc_html__( 'Center Bottom', 'ninezeroseven')   => 'center bottom',
						),
		    'description' => esc_html__( 'Select how background image will be positioned.', 'ninezeroseven' ),
				'group' => esc_html__( '907 Options', 'ninezeroseven' )
		));

		vc_add_param("vc_column", array(
		    'type' => 'dropdown',
		    'heading' => esc_html__( 'Background Attachment', 'ninezeroseven' ),
		    'param_name' => 'bg_image_attach',
		    'value' => array(
		    				esc_html__( 'Default', 'ninezeroseven' ) => '',
							esc_html__( 'Scroll', 'ninezeroseven' ) => 'scroll',
							esc_html__( 'Fixed', 'ninezeroseven' ) => 'fixed',
						),
		    'description' => esc_html__( 'Select how a background image will be attached', 'ninezeroseven' ),
				'group' => esc_html__( '907 Options', 'ninezeroseven' )
		));

		vc_add_param("vc_column", array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Background Color', 'ninezeroseven' ),
			'param_name' => 'bg_color',
			'description' => esc_html__( 'Backgroud color for row.', 'ninezeroseven' ),
			'group' => esc_html__( '907 Options', 'ninezeroseven' )

		));
		//Padding
		vc_add_param("vc_column",array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Padding Top', 'ninezeroseven' ),
			'param_name'  => 'p_top',
			'description' => esc_html__( 'Padding top, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
			'group'       => esc_html__( 'Padding', 'ninezeroseven' )
		));
		vc_add_param("vc_column",array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Padding Bottom', 'ninezeroseven' ),
			'param_name'  => 'p_bottom',
			'description' => esc_html__( 'Padding bottom, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
			'group'       => esc_html__( 'Padding', 'ninezeroseven' )
		));
		vc_add_param("vc_column",array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Padding Left', 'ninezeroseven' ),
			'param_name'  => 'p_left',
			'description' => esc_html__( 'Padding left, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
			'group'       => esc_html__( 'Padding', 'ninezeroseven' )
		));

		vc_add_param("vc_column",array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Padding Right', 'ninezeroseven' ),
			'param_name'  => 'p_right',
			'description' => esc_html__( 'Padding right, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
			'group'       => esc_html__( 'Padding', 'ninezeroseven' )
		));

		//Margin
		vc_add_param("vc_column",array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Margin Top', 'ninezeroseven' ),
			'param_name'  => 'm_top',
			'description' => esc_html__( 'Margin top, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
			'group'       => esc_html__( 'Margin', 'ninezeroseven' )
		));
		vc_add_param("vc_column",array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Margin Bottom', 'ninezeroseven' ),
			'param_name'  => 'm_bottom',
			'description' => esc_html__( 'Margin bottom, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
			'group'       => esc_html__( 'Margin', 'ninezeroseven' )
		));
		vc_add_param("vc_column",array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Margin Left', 'ninezeroseven' ),
			'param_name'  => 'm_left',
			'description' => esc_html__( 'Margin left, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
			'group'       => esc_html__( 'Margin', 'ninezeroseven' )
		));

		vc_add_param("vc_column",array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Margin Right', 'ninezeroseven' ),
			'param_name'  => 'm_right',
			'description' => esc_html__( 'Margin right, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
			'group'       => esc_html__( 'Margin', 'ninezeroseven' )
		));
	

		vc_add_param("vc_column",
			array(
				"type"        => "dropdown",
				"class"       => "",
				"heading"     => esc_html__('Animation', 'ninezeroseven'),
				"description" => esc_html__('Animates section/object', 'ninezeroseven'),
				"param_name"  => "wbc_animation",
				"value"       => $wbc_animation_array,
				'group'       => esc_html__( 'Animation', 'ninezeroseven' )
			)
		);
		vc_add_param("vc_column",array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Animation Duration', 'ninezeroseven' ),
				'param_name'  => 'wbc_duration',
				'description' => esc_html__( 'Change the animation duration ie 4s', 'ninezeroseven' ),
				'dependency'  => array( 'element' => 'wbc_animation', 'not_empty' => true),
				'group'       => esc_html__( 'Animation', 'ninezeroseven' )
			)
		);
		vc_add_param("vc_column",array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Animation Delay', 'ninezeroseven' ),
				'param_name'  => 'wbc_delay',
				'description' => esc_html__( 'Delay before the animation starts ie 4s', 'ninezeroseven' ),
				'dependency'  => array( 'element' => 'wbc_animation', 'not_empty' => true),
				'group'       => esc_html__( 'Animation', 'ninezeroseven' )
			)
		);
		vc_add_param("vc_column",array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Animation offset', 'ninezeroseven' ),
				'param_name'  => 'wbc_offset',
				'description' => esc_html__( 'Distance to start the animation (related to the browser bottom) ie 10', 'ninezeroseven' ),
				'dependency'  => array( 'element' => 'wbc_animation', 'not_empty' => true),
				'group'       => esc_html__( 'Animation', 'ninezeroseven' )
			)
		);
		vc_add_param("vc_column",array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Animation Iteration', 'ninezeroseven' ),
				'param_name'  => 'wbc_iteration',
				'description' => esc_html__( 'Number of times the animation is repeated ie 4', 'ninezeroseven' ),
				'dependency'  => array( 'element' => 'wbc_animation', 'not_empty' => true),
				'group'       => esc_html__( 'Animation', 'ninezeroseven' )
			)
		);
		vc_add_param("vc_row",array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Anchor ID', 'ninezeroseven' ),
			'param_name'  => 'anchor',
			'description' => esc_html__( 'Use this field to enter anchor tag for menu items. eg about,contact,etc', 'ninezeroseven' ),
		));

	    vc_add_param("vc_row", array(
	            'type' => 'colorpicker',
	            'heading' => esc_html__( 'Font Color', 'ninezeroseven' ),
	            'param_name' => 'font_color',
	            // 'description' => esc_html__( 'You can set an overlay color/opacity.', 'ninezeroseven' ),
	            // 'dependency' => array( 'element' => 'parallax_img', 'not_empty' => true),
	            // 'group' => esc_html__( '907 Options', 'ninezeroseven' )

	        ));

	    vc_add_param("vc_row",array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Full Height?', 'ninezeroseven' ),
			'param_name'  => 'full_height',
			'description' => esc_html__( 'If selected, this will set min-height to browser height.', 'ninezeroseven' ),
			'value'       => array( esc_html__( 'Yes, please', 'ninezeroseven' ) => 'yes' )
		));

		vc_add_param("vc_row",array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Remove Column Padding?', 'ninezeroseven' ),
			'param_name'  => 'no_innerpadding',
			'description' => esc_html__( 'If selected, will remove padding from inner columns.', 'ninezeroseven' ),
			'value'       => array( esc_html__( 'Yes, please', 'ninezeroseven' ) => 'yes' )
		));

		vc_add_param("vc_row",array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Equal Height Columns?', 'ninezeroseven' ),
			'param_name'  => 'match_height',
			'description' => esc_html__( 'If selected, will make inner columns same height.', 'ninezeroseven' ),
			'value'       => array( esc_html__( 'Yes, please', 'ninezeroseven' ) => 'yes' )
		));

		vc_add_param("vc_row",array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Vertical Center Content?', 'ninezeroseven' ),
			'param_name'  => 'vertical_center',
			'description' => esc_html__( 'If selected, will center content vertically', 'ninezeroseven' ),
			'value'       => array( esc_html__( 'Yes, please', 'ninezeroseven' ) => 'yes' ),
			"dependency" => array('element' => "match_height", 'value' => array('yes')),
		));

	    vc_add_param("vc_row", array(
		"type"                    => "dropdown",
		"class"                   => "",
		"show_settings_on_create" => true,
		"heading"                 => esc_html__('Align Content', 'ninezeroseven'),
	    'description' => esc_html__( 'Aligns the inner content within the full height section.', 'ninezeroseven' ),
		"param_name"              => "row_align",
		"value"                   => array(
										"Default" => "default",
										"Middle"  => "align_middle",
										"Bottom"  => "align_bottom",
										),
		'std' => 'default',
		"dependency" => array('element' => "full_height", 'value' => array('yes')),

		));


		//Row Selector
		vc_add_param("vc_row", array(
			"type"                    => "dropdown",
			"class"                   => "",
			"show_settings_on_create" => true,
			"heading"                 => esc_html__('Row Type', 'ninezeroseven'),
		    'description' => esc_html__( 'Choose standard or full width, full width should be used with page template full width 100%.', 'ninezeroseven' ),
			"param_name"              => "row_type",
			"value"                   => array(
											"Select Type.." => " ",
											"Standard"      => "standard",
											"Full Width"    => "full_width",
											),
			'group'                   => esc_html__( '907 Options', 'ninezeroseven' )

		));

		vc_add_param("vc_row", array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__('Inner Content', 'ninezeroseven'),
			"description" => esc_html__('Do you want the inner content in container or full width?', 'ninezeroseven'),
			"param_name" => "type",
			"value" => array(
				"Select Type.."     => "",
				"In Container"      => "container",
				"Full Screen Width" => "full_screen"
			),
			"dependency" => array('element' => "row_type", 'value' => array('full_width')),
			'group' => esc_html__( '907 Options', 'ninezeroseven' )
		));

		vc_add_param("vc_row", array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__('Background Type', 'ninezeroseven'),
			"param_name" => "bg_select",
			"value" => array(
				"None"           => '',
				"Colored BG"     => "bg_color_section",
				"Image/Parallax" => "bg_parallax",
				"Hosted Video"   => "bg_video",
				"Youtube Video"  => "bg_youtube_video"
			),
			'group' => esc_html__( '907 Options', 'ninezeroseven' )
		));
		vc_add_param("vc_column", array(
		            'type' => 'colorpicker',
		            'heading' => esc_html__( 'Font Color', 'ninezeroseven' ),
		            'param_name' => 'font_color',
				));
		vc_add_param("vc_column", array(
		            'type' => 'colorpicker',
		            'heading' => esc_html__( 'Overlay Color', 'ninezeroseven' ),
		            'param_name' => 'color_overlay',
				));
		vc_add_param("vc_column", array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__('Align Content', 'ninezeroseven'),
			"description" => esc_html__('You can choose to align text within the row here,', 'ninezeroseven'),
			"param_name" => "content_align",
			"value" => array(
				"Default"     => '',
				"Text Left"   => "text-left",
				"Text Right"  => "text-right",
				"Text Center" => "text-center",
			)
		));

		/************************************************************************
		* Parallax
		*************************************************************************/

		vc_add_param("vc_row", array(
			"type" => "attach_image",
			"admin_label" => true,
			"class" => "",
			"heading" => esc_html__('Bg Image', 'ninezeroseven'),
			"param_name" => "parallax_img",
			"dependency" => array('element' => "bg_select", 'value' => array('bg_parallax')),
			'group' => esc_html__( '907 Options', 'ninezeroseven' )
		));

		vc_add_param("vc_row", array(
		    'type' => 'dropdown',
		    'heading' => esc_html__( 'Parallax Speed', 'ninezeroseven' ),
		    'param_name' => 'parallax_speed',
		    'value' => array(0,1,2,3,4,5,6,7,8,9,10),
		    'std' => 4,
		    'description' => esc_html__( 'Set parallax speed, set to 0 for no parallax effect.', 'ninezeroseven' ),
		    'dependency' => array( 'element' => 'parallax_img', 'not_empty' => true),
			'group' => esc_html__( '907 Options', 'ninezeroseven' )
		));


		vc_add_param("vc_row", array(
		    'type' => 'dropdown',
		    'heading' => esc_html__( 'Background Repeat', 'ninezeroseven' ),
		    'param_name' => 'parallax_repeat',
		    'value' => array(
							esc_html__( 'Default', 'ninezeroseven' ) => '',
							esc_html__( 'Cover', 'ninezeroseven' )   => 'cover',
							esc_html__('Contain', 'ninezeroseven')   => 'contain',
							esc_html__('Repeat', 'ninezeroseven')    => 'repeat',
							esc_html__('No Repeat', 'ninezeroseven') => 'no-repeat'
						),
		    'description' => esc_html__( 'Select how a background image will be repeated', 'ninezeroseven' ),
		    'dependency' => array(
		    	'element' => "bg_select", 'value' => array('bg_parallax'),
				),
				'group' => esc_html__( '907 Options', 'ninezeroseven' )
		));

		vc_add_param("vc_row", array(
		    'type' => 'dropdown',
		    'heading' => esc_html__( 'Background Position', 'ninezeroseven' ),
		    'param_name' => 'bg_image_postions',
		    'value' => array(
							esc_html__( 'Default', 'ninezeroseven' )       => '',
							esc_html__( 'Left Top', 'ninezeroseven' )      => 'left top',
							esc_html__( 'Left Center', 'ninezeroseven' )   => 'left center',
							esc_html__( 'Left Bottom', 'ninezeroseven')     => 'left bottom',
							esc_html__( 'Right Top', 'ninezeroseven' )     => 'right top',
							esc_html__( 'Right Center', 'ninezeroseven' )  => 'right center',
							esc_html__( 'Right Bottom', 'ninezeroseven')    => 'right bottom',
							esc_html__( 'Center Top', 'ninezeroseven' )    => 'center top',
							esc_html__( 'Center Center', 'ninezeroseven' ) => 'center center',
							esc_html__( 'Center Bottom', 'ninezeroseven')   => 'center bottom',
						),
		    'description' => esc_html__( 'Select how background image will be positioned.', 'ninezeroseven' ),
		    'dependency' => array(
		    	'element' => "bg_select", 'value' => array('bg_parallax'),
				),
				'group' => esc_html__( '907 Options', 'ninezeroseven' )
		));

		vc_add_param("vc_row", array(
		    'type' => 'dropdown',
		    'heading' => esc_html__( 'Background Attachment', 'ninezeroseven' ),
		    'param_name' => 'bg_image_attach',
		    'value' => array(
		    				esc_html__( 'Default', 'ninezeroseven' ) => '',
							esc_html__( 'Scroll', 'ninezeroseven' ) => 'scroll',
							esc_html__( 'Fixed', 'ninezeroseven' ) => 'fixed',
						),
		    'description' => esc_html__( 'Select how a background image will be attached', 'ninezeroseven' ),
		    'dependency' => array(
		    	'element' => "bg_select", 'value' => array('bg_parallax'),
				),
				'group' => esc_html__( '907 Options', 'ninezeroseven' )
		));

		vc_add_param("vc_row", array(
			'type'        => 'colorpicker',
			'heading'     => esc_html__( 'Overlay Color', 'ninezeroseven' ),
			'param_name'  => 'parallax_overlay',
			'description' => esc_html__( 'You can set an overlay color/opacity.', 'ninezeroseven' ),
			'dependency'  => array( 'element' => 'parallax_img', 'not_empty' => true),
			'group'       => esc_html__( '907 Options', 'ninezeroseven' )

		));

		/************************************************************************
		* Video Hosted
		*************************************************************************/

		vc_add_param("vc_row",array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'MP4 video URL', 'ninezeroseven' ),
			'param_name'  => 'mp4_url',
			'description' => esc_html__( 'Enter the URL to your MP4 file here.', 'ninezeroseven' ),
			"dependency"  => array('element' => "bg_select", 'value' => array('bg_video')),
			'group'       => esc_html__( '907 Options', 'ninezeroseven' )
		));

		vc_add_param("vc_row",array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'WebM Video URL', 'ninezeroseven' ),
			'param_name'  => 'webm_url',
			'description' => esc_html__( 'Enter the URL to your WebM file here.', 'ninezeroseven' ),
			"dependency"  => array('element' => "bg_select", 'value' => array('bg_video')),
			'group'       => esc_html__( '907 Options', 'ninezeroseven' )
		));

		vc_add_param("vc_row",array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'OGV Video URL', 'ninezeroseven' ),
			'param_name'  => 'ogv_url',
			'description' => esc_html__( 'Enter the URL to your OGV file here.', 'ninezeroseven' ),
			"dependency"  => array('element' => "bg_select", 'value' => array('bg_video')),
			'group'       => esc_html__( '907 Options', 'ninezeroseven' )
		));

		//Youtube
		vc_add_param("vc_row",array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Youtube ID', 'ninezeroseven' ),
			'param_name'  => 'youtube_url',
			'description' => esc_html__( 'Enter Youtube URL here ie http://www.youtube.com/watch?v=qelHgzRFC0k', 'ninezeroseven' ),
			"dependency"  => array('element' => "bg_select", 'value' => array('bg_youtube_video')),
			'group'       => esc_html__( '907 Options', 'ninezeroseven' )
		));
		vc_add_param("vc_row",array(
			'type'           => 'checkbox',
			'heading'        => esc_html__( 'Mute?', 'ninezeroseven' ),
			'param_name'     => 'video_mute',
			// 'description' => esc_html__( 'If selected, this will set min-height to browser height.', 'ninezeroseven' ),
			"dependency"     => array('element' => "bg_select", 'value' => array('bg_video','bg_youtube_video')),
			'value'          => array( esc_html__( 'Yes, please', 'ninezeroseven' ) => true ),
			'group'          => esc_html__( '907 Options', 'ninezeroseven' )
		));

		vc_add_param("vc_row", array(
		    'type' => 'dropdown',
		    'heading' => esc_html__( 'Video Quality', 'ninezeroseven' ),
		    'param_name' => 'video_quality', //or “small”, “medium”, “large”, “hd720”, “hd1080”, “highres”
		    'value' => array(
							esc_html__( 'Default', 'ninezeroseven' )  => 'default',
							esc_html__( 'Small', 'ninezeroseven' )    => 'small',
							esc_html__( 'Medium', 'ninezeroseven' )   => 'medium',
							esc_html__( 'Large', 'ninezeroseven' )    => 'large',
							esc_html__( 'HD720', 'ninezeroseven' )    => 'hd720',
							esc_html__( 'HD1080', 'ninezeroseven' )   => 'hd1080',
							esc_html__( 'High Res', 'ninezeroseven' ) => 'highres',
						),
		    'description' => esc_html__( 'This will attempt to load as suggested quality. Keep in mind it will affect loading time using higher res videos.', 'ninezeroseven' ),
		    'std' => 'default',
		    'dependency' => array(
		    	'element' => "bg_select", 'value' => array('bg_youtube_video'),
				),
				'group' => esc_html__( '907 Options', 'ninezeroseven' )
		));

		vc_add_param("vc_row", array(
			"type" => "attach_image",
			"class" => "",
			"heading" => esc_html__('Cover Image', 'ninezeroseven'),
			"description" => esc_html__('This image will be shown before video starts and on not supported(mobile) devices.', 'ninezeroseven'),
			"param_name" => "cover_img",
			"dependency" => array('element' => "bg_select", 'value' => array('bg_video','bg_youtube_video')),
			'group' => esc_html__( '907 Options', 'ninezeroseven' )
		));

		vc_add_param("vc_row", array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Overlay Color', 'ninezeroseven' ),
			'param_name' => 'video_overlay',
			'description' => esc_html__( 'You can set an overlay color/opacity.', 'ninezeroseven' ),
			"dependency" => array('element' => "bg_select", 'value' => array('bg_video','bg_youtube_video')),
			'group' => esc_html__( '907 Options', 'ninezeroseven' )

		));

		vc_add_param("vc_row", array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Border Color', 'ninezeroseven' ),
			'param_name' => 'border_color',
			'description' => esc_html__( 'Adds a border color to the bottom of section', 'ninezeroseven' ),
			"dependency" => array('element' => "bg_select", 'value' => array('bg_color_section', 'bg_parallax')),
			'group' => esc_html__( '907 Options', 'ninezeroseven' )

		));

		vc_add_param("vc_row", array(
		    'type' => 'dropdown',
		    'heading' => esc_html__( 'Style', 'ninezeroseven' ),
		    'param_name' => 'fancy_row',
		    'value' => array(
							esc_html__( 'Default', 'ninezeroseven' )           => '',
							esc_html__( 'Arrow Down Bottom', 'ninezeroseven' ) => 'down_arrow',
							esc_html__( 'Band Bottom', 'ninezeroseven' )       => 'bottom_band',
						),
		    'description' => esc_html__( 'Just some extra styling options ;)', 'ninezeroseven' ),
		    "dependency" => array('element' => "bg_select", 'not_empty' => true),
			'group' => esc_html__( '907 Options', 'ninezeroseven' )
		));

		vc_add_param("vc_row", array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Band Background Color', 'ninezeroseven' ),
			'param_name' => 'band_color',
			// 'description' => esc_html__( 'Backgroud c', 'ninezeroseven' ),
			"dependency" => array('element' => "fancy_row", 'value' => array('bottom_band')),
			'group' => esc_html__( '907 Options', 'ninezeroseven' )

		));

		vc_add_param("vc_row",array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Band Height', 'ninezeroseven' ),
			'param_name'  => 'band_height',
			'description' => esc_html__( 'Enter height you\' like the band, must be number only ie 100', 'ninezeroseven' ),
			"dependency" => array('element' => "fancy_row", 'value' => array('bottom_band')),
			'group' => esc_html__( '907 Options', 'ninezeroseven' )
		));

		vc_add_param("vc_row", array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Background Color', 'ninezeroseven' ),
			'param_name' => 'bg_color',
			'description' => esc_html__( 'Backgroud color for row.', 'ninezeroseven' ),
			'group' => esc_html__( '907 Options', 'ninezeroseven' )

		));

		//Padding
		vc_add_param("vc_row",array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Padding Top', 'ninezeroseven' ),
			'param_name'  => 'p_top',
			'description' => esc_html__( 'Padding top, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
			'group'       => esc_html__( 'Padding', 'ninezeroseven' )
		));
		vc_add_param("vc_row",array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Padding Bottom', 'ninezeroseven' ),
			'param_name'  => 'p_bottom',
			'description' => esc_html__( 'Padding bottom, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
			'group'       => esc_html__( 'Padding', 'ninezeroseven' )
		));
		vc_add_param("vc_row",array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Padding Left', 'ninezeroseven' ),
			'param_name'  => 'p_left',
			'description' => esc_html__( 'Padding left, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
			'group'       => esc_html__( 'Padding', 'ninezeroseven' )
		));

		vc_add_param("vc_row",array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Padding Right', 'ninezeroseven' ),
			'param_name'  => 'p_right',
			'description' => esc_html__( 'Padding right, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
			'group'       => esc_html__( 'Padding', 'ninezeroseven' )
		));

		//Margin
		vc_add_param("vc_row",array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Margin Top', 'ninezeroseven' ),
			'param_name'  => 'm_top',
			'description' => esc_html__( 'Margin top, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
			'group'       => esc_html__( 'Margin', 'ninezeroseven' )
		));
		vc_add_param("vc_row",array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Margin Bottom', 'ninezeroseven' ),
			'param_name'  => 'm_bottom',
			'description' => esc_html__( 'Margin bottom, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
			'group'       => esc_html__( 'Margin', 'ninezeroseven' )
		));
		vc_add_param("vc_row",array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Margin Left', 'ninezeroseven' ),
			'param_name'  => 'm_left',
			'description' => esc_html__( 'Margin left, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
			'group'       => esc_html__( 'Margin', 'ninezeroseven' )
		));

		vc_add_param("vc_row",array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Margin Right', 'ninezeroseven' ),
			'param_name'  => 'm_right',
			'description' => esc_html__( 'Margin right, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
			'group'       => esc_html__( 'Margin', 'ninezeroseven' )
		));


		//Accordian
		vc_add_param("vc_accordion_tab", array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Handle Font Color', 'ninezeroseven' ),
			'param_name' => 'font_color',
		));
		vc_add_param("vc_accordion_tab", array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Handle Background Color', 'ninezeroseven' ),
			'param_name' => 'bg_color',
		));


		//Toggle
		vc_add_param("vc_toggle",array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Font Size', 'ninezeroseven' ),
			'param_name'  => 'font_size',
			'description' => esc_html__( 'Can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		));
		vc_add_param("vc_toggle", array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Font Color', 'ninezeroseven' ),
			'param_name' => 'font_color',
		));

		// Portfolio Shortcode
		vc_map(array(
			'name'                    =>'Portfolio',
			'base'                    =>'wbc_portfolio',
			'is_container'            => false,
			'icon'                    => 'icon-wpb-row',
			'show_settings_on_create' => true,
			'category'                => esc_html__( '907 Additions', 'ninezeroseven' ),
			'description'             => esc_html__( 'Displays portfolio Grid', 'ninezeroseven' ),
			'params'=>array(
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Gallery Type', 'ninezeroseven' ),
					'param_name'  => 'layout_type',
					'admin_label' => true,
					'value'       => array(
									esc_html__( 'Default', 'ninezeroseven' )    => '',
									esc_html__( 'Masonry', 'ninezeroseven' )    => 'masonry',
									esc_html__( 'Fit Rows', 'ninezeroseven' )   => 'fitRows',
									esc_html__( 'Brick Wall', 'ninezeroseven' ) => 'brick',
								),
				    'description' => esc_html__( 'Select type of portfolio layout you\'d like displayed.', 'ninezeroseven' ),
				),
				array(
				    'type' => 'dropdown',
				    'heading' => esc_html__( 'Image Size', 'ninezeroseven' ),
				    'param_name' => 'img_size',
				    'value' => $wbc_image_sizes,
				    'description' => esc_html__( 'You can select image sizing here.', 'ninezeroseven' ),
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Amount of post to show.', 'ninezeroseven' ),
					'param_name'  => 'show_post',
					'admin_label' => true,
					'description' => esc_html__( 'Leave blank to show all or enter how many you want displayed.', 'ninezeroseven' ),
					//'group'       => esc_html__( 'Margin', 'ninezeroseven' )
				),
	            array(
	                'type' => 'wbc_categories',
	                'heading' => esc_html__( 'Portfolio Categories', 'ninezeroseven' ),
	                'param_name' => 'portfolio_cats',
	                'admin_label' => true,
	                'filter_cat' => 'portfolio-categories',
	                'description' => esc_html__( 'You can choose to show only the categories you want by checking the boxes.', 'ninezeroseven' ),
	            ),
				array(
				    'type' => 'dropdown',
				    'heading' => esc_html__( 'Order By', 'ninezeroseven' ),
				    'param_name' => 'order_by',
				    'value' => array(
									esc_html__( 'Default', 'ninezeroseven' ) => '',
									esc_html__( 'None', 'ninezeroseven' )    =>  'none',
									esc_html__( 'ID', 'ninezeroseven' )      =>  'ID',
									esc_html__( 'Title', 'ninezeroseven' )   =>  'Title',
									esc_html__( 'Name', 'ninezeroseven' )    =>  'name',
									esc_html__( 'Date', 'ninezeroseven' )    =>  'date',
									esc_html__( 'Random', 'ninezeroseven' )  =>  'rand',
								),
				    'description' => esc_html__( 'Please note that if you select "Random", the pagination option won\'t work', 'ninezeroseven' ),
				),
				array(
				    'type' => 'dropdown',
				    'heading' => esc_html__( 'Ordering', 'ninezeroseven' ),
				    'param_name' => 'order_dir',
				    'value' => array(
									esc_html__( 'Default', 'ninezeroseven' )    => '',
									esc_html__( 'Ascending', 'ninezeroseven' )  =>  'ASC',
									esc_html__( 'Descending', 'ninezeroseven' ) =>  'DESC',
								),
				    'description' => esc_html__( 'This controls rather to order from post in up or down value based on the "Order By" option above.', 'ninezeroseven' ),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Paginate?', 'ninezeroseven' ),
					'param_name' => 'paginate',
					'admin_label' => true,
					// 'description' => esc_html__( 'If selected, this will set min-height to browser height.', 'ninezeroseven' ),
					'dependency' => array( 'element' => 'show_post', 'not_empty' => true),
					'value' => array( esc_html__( 'Yes, please', 'ninezeroseven' ) => 'yes' ),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Ajax Pagination?', 'ninezeroseven' ),
					'param_name' => 'ajaxed',
					'description' => esc_html__( 'This option will load next post without page reload.', 'ninezeroseven' ),
					'value' => array( esc_html__( 'Yes, please', 'ninezeroseven' ) => 'yes' ),
					"dependency" => array('element' => "paginate", 'value' => array('yes')),
				),
				array(
	                'type' => 'dropdown',
	                'heading' => esc_html__( 'Pagination Align', 'ninezeroseven' ),
	                'param_name' => 'pagination_align',
	                'value' => array(
									esc_html__( 'Default', 'ninezeroseven' ) => '',
									esc_html__( 'Center', 'ninezeroseven' )  =>  'center',
									esc_html__( 'Right', 'ninezeroseven' )   =>  'right',
									esc_html__( 'Left', 'ninezeroseven' )    =>  'left',
	                            ),
	                "dependency" => array('element' => "paginate", 'value' => array('yes')),
	                'description' => esc_html__( 'Align pagination buttons.', 'ninezeroseven' ),
	            ),
	            array(
	                'type' => 'dropdown',
	                'heading' => esc_html__( 'Grid Gap', 'ninezeroseven' ),
	                'param_name' => 'gap',
	                'value' => array(
									esc_html__( 'Default', 'ninezeroseven' )   => '',
									esc_html__('Gap 0', 'ninezeroseven' )      =>  '0',
									esc_html__('Gap 1', 'ninezeroseven' )      =>  '1',
									esc_html__('Gap 5', 'ninezeroseven' )      =>  '5',
									esc_html__('Gap 10', 'ninezeroseven' )     =>  '10',
									esc_html__('Gap 15', 'ninezeroseven' )     =>  '15',
									esc_html__('Gap 20', 'ninezeroseven' )     =>  '20',
									esc_html__('Custom Gap', 'ninezeroseven' ) =>  'custom',

	                            ),
	                'description' => esc_html__( 'Spacing between items', 'ninezeroseven' ),
	            ),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Padding', 'ninezeroseven' ),
					'param_name'  => 'padding',
					'description' => esc_html__( 'Amount of padding between each item, only enter number without px. ie 10.', 'ninezeroseven' ),
					"dependency" => array('element' => "gap", 'value' => array('custom')),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Filter?', 'ninezeroseven' ),
					'param_name' => 'show_filter',
					'description' => esc_html__( 'Shows the filter buttons for filtering the gallery.', 'ninezeroseven' ),
					'value' => array( esc_html__( 'Yes, please', 'ninezeroseven' ) => 'yes' ),
				),
	            array(
	                'type' => 'dropdown',
	                'heading' => esc_html__( 'Filter Align', 'ninezeroseven' ),
	                'param_name' => 'filter_align',
	                'value' => array(
	                                esc_html__( 'Default', 'ninezeroseven' )    => '',
	                                esc_html__( 'Center', 'ninezeroseven' )  =>  'center',
	                                esc_html__( 'Right', 'ninezeroseven' ) =>  'right',
	                            ),
	                "dependency" => array('element' => "show_filter", 'value' => array('yes')),
	                'description' => esc_html__( 'Align filter buttons.', 'ninezeroseven' ),
	            ),
	            array(
	                'type'        => 'textfield',
	                'heading'     => esc_html__( '"All" Word', 'ninezeroseven' ),
	                'param_name' => 'all_word',
	                'description' => esc_html__( 'The text for the "All" button, leave blank to use default', 'ninezeroseven' ),
	                "dependency" => array('element' => "show_filter", 'value' => array('yes')),
	            ),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Text?', 'ninezeroseven' ),
					'param_name' => 'portfolio_display',
					'description' => esc_html__( 'This option will show a text excerpt below the image.', 'ninezeroseven' ),
					'value' => array( esc_html__( 'Yes, please', 'ninezeroseven' ) => 'yes' ),
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Excerpt Lenght', 'ninezeroseven' ),
					'param_name'  => 'excerpt_length',
					'admin_label' => true,
					'description' => esc_html__( 'Amount of excerpt text to show, only enter number value ie 60', 'ninezeroseven' ),
					"dependency" => array('element' => "portfolio_display", 'value' => array('yes')),
					//'group'       => esc_html__( 'Margin', 'ninezeroseven' )
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Text Color', 'ninezeroseven' ),
					'param_name' => 'text_color',
					'description' => esc_html__( 'Color of excerpt text.', 'ninezeroseven' ),
					"dependency" => array('element' => "portfolio_display", 'value' => array('yes')),

				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Text Box BG color', 'ninezeroseven' ),
					'param_name' => 'box_bg',
					'description' => esc_html__( 'The color of the background box behind the text.', 'ninezeroseven' ),
					"dependency" => array('element' => "portfolio_display", 'value' => array('yes')),

				),
				array(
					'type'        => 'checkbox',
					'heading'     => esc_html__( 'MouseOver Play Videos?', 'ninezeroseven' ),
					'param_name'  => 'mouse_over_play',
					'description' => esc_html__( 'Play any videos on mouseover?', 'ninezeroseven' ),
					'value'       => array( esc_html__( 'Yes, please', 'ninezeroseven' ) => 'yes' )
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Overlay Color', 'ninezeroseven' ),
					'param_name' => 'overlay_color',
					'description' => esc_html__( 'This is for image hover overlay color, leave blank to use theme default color.', 'ninezeroseven' ),

				),
				//Cols
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Over 1200', 'ninezeroseven' ),
					'param_name'  => 'cols_xl',
					'description' => esc_html__( 'Columns to display in area over 1200 in width, enter only a number i.e 4', 'ninezeroseven' ),
					'group'       => esc_html__( 'Column Settings', 'ninezeroseven' )
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Over 800', 'ninezeroseven' ),
					'param_name'  => 'cols_l',
					'description' => esc_html__( 'Columns to display in area over 800 in width, enter only a number i.e 4', 'ninezeroseven' ),
					'group'       => esc_html__( 'Column Settings', 'ninezeroseven' )
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Over 600', 'ninezeroseven' ),
					'param_name'  => 'cols_s',
					'description' => esc_html__( 'Columns to display in area over 600 in width, enter only a number i.e 4', 'ninezeroseven' ),
					'group'       => esc_html__( 'Column Settings', 'ninezeroseven' )
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Over 400', 'ninezeroseven' ),
					'param_name'  => 'cols_xs',
					'description' => esc_html__( 'Columns to display in area over 400 in width, enter only a number i.e 4', 'ninezeroseven' ),
					'group'       => esc_html__( 'Column Settings', 'ninezeroseven' )
				),
			),
		));

		// Portfolio Carousel Shortcode
		vc_map(array(
			'name'=>'Portfolio Carousel',
			'base'=>'wbc_portfolio_carousel',
			'is_container' => false,
			'icon' => 'icon-wpb-row',
			'show_settings_on_create' => true,
			'category' => esc_html__( '907 Additions', 'ninezeroseven' ),
			'description' => esc_html__( 'Display portfolio carousel', 'ninezeroseven' ),
			'params'=>array(
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Amount of post to show', 'ninezeroseven' ),
					'param_name'  => 'show_post',
					'admin_label' => true,
					'description' => esc_html__( 'Leave blank to get all portfolio items.', 'ninezeroseven' ),
					//'group'       => esc_html__( 'Margin', 'ninezeroseven' )
				),
	            array(
	                'type' => 'wbc_categories',
	                'heading' => esc_html__( 'Portfolio Categories', 'ninezeroseven' ),
	                'param_name' => 'portfolio_cats',
	                'admin_label' => true,
	                'filter_cat' => 'portfolio-categories',
	                'description' => esc_html__( 'You can choose to show only the categories you want by checking the boxes.', 'ninezeroseven' ),
	            ),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Include Posts', 'ninezeroseven' ),
					'param_name'  => 'post_in',
					'admin_label' => true,
					'description' => esc_html__( 'You can add post ids here, so select only those post. Seperate with comma\'s, ie. 23,54,46' , 'ninezeroseven' ),
					//'group'       => esc_html__( 'Margin', 'ninezeroseven' )
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Exclude Posts', 'ninezeroseven' ),
					'param_name'  => 'post_not_in',
					'admin_label' => true,
					'description' => esc_html__( 'You can add post ids here to exclude. Seperate with comma\'s, ie. 23,54,46' , 'ninezeroseven' ),
					//'group'       => esc_html__( 'Margin', 'ninezeroseven' )
				),
				array(
				    'type' => 'dropdown',
				    'heading' => esc_html__( 'Image Size', 'ninezeroseven' ),
				    'param_name' => 'img_size',
				    'value' => $wbc_image_sizes,
				    'std' => 'square',
				    'description' => esc_html__( 'Just some extra element options ;)', 'ninezeroseven' ),
				),
				array(
				    'type' => 'dropdown',
				    'heading' => esc_html__( 'Order By', 'ninezeroseven' ),
				    'param_name' => 'order_by',
				    'value' => array(
									esc_html__( 'Default', 'ninezeroseven' ) => '',
									esc_html__( 'None', 'ninezeroseven' )    =>  'none',
									esc_html__( 'ID', 'ninezeroseven' )      =>  'ID',
									esc_html__( 'Title', 'ninezeroseven' )   =>  'Title',
									esc_html__( 'Name', 'ninezeroseven' )    =>  'name',
									esc_html__( 'Date', 'ninezeroseven' )    =>  'date',
									esc_html__( 'Random', 'ninezeroseven' )  =>  'rand',
								),
				    'description' => esc_html__( 'Option for display order', 'ninezeroseven' ),
				),
				array(
				    'type' => 'dropdown',
				    'heading' => esc_html__( 'Ordering', 'ninezeroseven' ),
				    'param_name' => 'order_dir',
				    'value' => array(
									esc_html__( 'Default', 'ninezeroseven' )    => '',
									esc_html__( 'Ascending', 'ninezeroseven' )  =>  'ASC',
									esc_html__( 'Descending', 'ninezeroseven' ) =>  'DESC',
								),
				    'description' => esc_html__( 'This controls rather to order from post in up or down value based on the "Order By" option above.', 'ninezeroseven' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Overlay Color', 'ninezeroseven' ),
					'param_name' => 'overlay_color',
					'description' => esc_html__( 'This is for image hover overlay color, leave blank to use theme default color.', 'ninezeroseven' ),

				),
	            array(
	                'type' => 'checkbox',
	                'heading' => esc_html__( 'Link Overlay?', 'ninezeroseven' ),
	                'param_name' => 'link_overlay',
	                'description' => esc_html__( 'This will make the whole overlay a link to post.', 'ninezeroseven' ),
	                'value' => array( esc_html__( 'Yes, please', 'ninezeroseven' ) => 'yes' ),
	            ),
				//Cols
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Item Width', 'ninezeroseven' ),
					'param_name'  => 'item_width',
					'description' => esc_html__( 'Enter the item max width you\'d like, ie 400', 'ninezeroseven' ),
					'group'       => esc_html__( 'Settings', 'ninezeroseven' )
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Scroll Amount', 'ninezeroseven' ),
					'param_name'  => 'item_scroll',
					'description' => esc_html__( 'This controls how many items are scrolled into view. Enter number only ie 3', 'ninezeroseven' ),
					'group'       => esc_html__( 'Settings', 'ninezeroseven' )
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Min Amount', 'ninezeroseven' ),
					'param_name'  => 'item_min',
					'description' => esc_html__( 'Enter min amount of images you want shown, default is 1.', 'ninezeroseven' ),
					'group'       => esc_html__( 'Settings', 'ninezeroseven' )
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Max Amount', 'ninezeroseven' ),
					'param_name'  => 'item_max',
					'description' => esc_html__( 'Enter max amount of images you want shown.', 'ninezeroseven' ),
					'group'       => esc_html__( 'Settings', 'ninezeroseven' )
				),
			),

		));

		// Blog Post Shortcode
		vc_map(array(
			'name'=>'Blog Posts',
			'base'=>'wbc_blog',
			'is_container' => false,
			'icon' => 'icon-wpb-row',
			'show_settings_on_create' => true,
			'category' => esc_html__( '907 Additions', 'ninezeroseven' ),
			'description' => esc_html__( 'Displays blog posts', 'ninezeroseven' ),
			'params'=>array(
				array(
				    'type' => 'dropdown',
				    'heading' => esc_html__( 'Layout', 'ninezeroseven' ),
				    'param_name' => 'blog_layout',
				    'admin_label' => true,
				    'value' => array(
	                                esc_html__( 'Default', 'ninezeroseven' )     => '',
	                                esc_html__( 'Big Image', 'ninezeroseven' )   => 'blog-style-1',
	                                esc_html__( 'Small Image', 'ninezeroseven' ) => 'blog-style-2',
	                                esc_html__( 'Masonry', 'ninezeroseven' )     => 'blog-style-3',
								),
				    'description' => esc_html__( 'Select type of layout you\'d like', 'ninezeroseven' ),
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Amount of post to show.', 'ninezeroseven' ),
					'param_name'  => 'show_post',
					'admin_label' => true,
					'description' => esc_html__( 'Leave blank to show all or enter how many you want display.', 'ninezeroseven' ),
					//'group'       => esc_html__( 'Margin', 'ninezeroseven' )
				),
	            array(
	                'type' => 'wbc_categories',
	                'heading' => esc_html__( 'Blog Categories', 'ninezeroseven' ),
	                'param_name' => 'blog_cats',
	                'admin_label' => true,
	                'filter_cat' => 'category',
	                'description' => esc_html__( 'You can choose to show only the categories you want by checking the boxes.', 'ninezeroseven' ),
	            ),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Include Posts', 'ninezeroseven' ),
					'param_name'  => 'post_in',
					'admin_label' => true,
					'description' => esc_html__( 'You can add post ids here, so that only those post are selected. Seperate with comma\'s, ie. 23,54,46' , 'ninezeroseven' ),
					//'group'       => esc_html__( 'Margin', 'ninezeroseven' )
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Exclude Posts', 'ninezeroseven' ),
					'param_name'  => 'post_not_in',
					'admin_label' => true,
					'description' => esc_html__( 'You can add post ids here to exclude. Seperate with comma\'s, ie. 23,54,46' , 'ninezeroseven' ),
					//'group'       => esc_html__( 'Margin', 'ninezeroseven' )
				),
				array(
				    'type' => 'dropdown',
				    'heading' => esc_html__( 'Image Size', 'ninezeroseven' ),
				    'param_name' => 'img_size',
				    'value' => $wbc_image_sizes,
				    'description' => esc_html__( 'Image sizing options', 'ninezeroseven' ),
				),
				array(
				    'type' => 'dropdown',
				    'heading' => esc_html__( 'Order By', 'ninezeroseven' ),
				    'param_name' => 'order_by',
				    'value' => array(
									esc_html__( 'Default', 'ninezeroseven' ) => '',
									esc_html__( 'None', 'ninezeroseven' )    =>  'none',
									esc_html__( 'ID', 'ninezeroseven' )      =>  'ID',
									esc_html__( 'Title', 'ninezeroseven' )   =>  'Title',
									esc_html__( 'Name', 'ninezeroseven' )    =>  'name',
									esc_html__( 'Date', 'ninezeroseven' )    =>  'date',
									esc_html__( 'Random', 'ninezeroseven' )  =>  'rand',
								),
				    'description' => esc_html__( 'Please note that if you select "Random", the pagination option won\'t work', 'ninezeroseven' ),
				),
				array(
				    'type' => 'dropdown',
				    'heading' => esc_html__( 'Ordering', 'ninezeroseven' ),
				    'param_name' => 'order_dir',
				    'value' => array(
									esc_html__( 'Default', 'ninezeroseven' )    => '',
									esc_html__( 'Ascending', 'ninezeroseven' )  =>  'ASC',
									esc_html__( 'Descending', 'ninezeroseven' ) =>  'DESC',
								),
				    'description' => esc_html__( 'This controls rather to order from post in up or down value based on the "Order By" option above.', 'ninezeroseven' ),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Paginate?', 'ninezeroseven' ),
					'param_name' => 'paginate',
					'admin_label' => true,
					'description' => esc_html__( 'Select this if you\'d like to have pagination.', 'ninezeroseven' ),
					'dependency' => array( 'element' => 'show_post', 'not_empty' => true),
					'value' => array( esc_html__( 'Yes, please', 'ninezeroseven' ) => 'yes' ),
				),
				array(
				    'type' => 'dropdown',
				    'heading' => esc_html__( 'Align Page Nav', 'ninezeroseven' ),
				    'param_name' => 'page_nav_align',
				    'value' => array(
									esc_html__( 'Default', 'ninezeroseven' )    => '',
									esc_html__( 'Left', 'ninezeroseven' )  =>  'left',
									esc_html__( 'Right', 'ninezeroseven' ) =>  'right',
									esc_html__( 'Center', 'ninezeroseven' ) =>  'center',
								),
				    'description' => esc_html__( 'Aligns the page navigation buttons', 'ninezeroseven' ),
				    "dependency" => array('element' => "paginate", 'value' => array('yes')),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Ajax Pagination?', 'ninezeroseven' ),
					'param_name' => 'ajaxed',
					'description' => esc_html__( 'This option will load next post without page reload.', 'ninezeroseven' ),
					'value' => array( esc_html__( 'Yes, please', 'ninezeroseven' ) => 'yes' ),
					"dependency" => array('element' => "paginate", 'value' => array('yes')),
				),
				array(
				    'type' => 'dropdown',
				    'heading' => esc_html__( 'Button Type', 'ninezeroseven' ),
				    'param_name' => 'page_nav_type',
				    'value' => array(
									esc_html__( 'Default', 'ninezeroseven' )   => '',
									esc_html__( 'Numbers', 'ninezeroseven' )   =>  'numbers',
									esc_html__( 'Load More', 'ninezeroseven' ) =>  'load-more',
								),
				    'description' => esc_html__( 'Type of pagination buttons', 'ninezeroseven' ),
				    "dependency" => array('element' => "ajaxed", 'value' => array('yes')),
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Load More Text', 'ninezeroseven' ),
					'param_name'  => 'load_more_text',
					'description' => esc_html__( 'Option to change the "Load More" text, leave blank for default text.', 'ninezeroseven' ),
					"dependency" => array('element' => "page_nav_type", 'value' => array('load-more')),
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Padding', 'ninezeroseven' ),
					'param_name'  => 'padding',
					'description' => esc_html__( 'Amount of padding between each item, only enter number without px. ie 10', 'ninezeroseven' ),
					//'group'       => esc_html__( 'Margin', 'ninezeroseven' )
				),
				// array(
				// 	'type' => 'checkbox',
				// 	'heading' => esc_html__( 'Show Text?', 'ninezeroseven' ),
				// 	'param_name' => 'portfolio_display',
				// 	// 'description' => esc_html__( 'If selected, this will set min-height to browser height.', 'ninezeroseven' ),
				// 	'value' => array( esc_html__( 'Yes, please', 'ninezeroseven' ) => 'yes' ),
				// ),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Excerpt Lenght', 'ninezeroseven' ),
					'param_name'  => 'excerpt_length',
					'admin_label' => true,
					'description' => esc_html__( 'Amount of excerpt text to show, only enter number value ie 60', 'ninezeroseven' ),
					//"dependency" => array('element' => "portfolio_display", 'value' => array('yes')),
					//'group'       => esc_html__( 'Margin', 'ninezeroseven' )
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Overlay Color', 'ninezeroseven' ),
					'param_name' => 'overlay_color',
					'description' => esc_html__( 'This is for image hover overlay color, leave blank to use theme default color.', 'ninezeroseven' ),

				),
				//Cols
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Over 1200', 'ninezeroseven' ),
					'param_name'  => 'cols_xl',
					'description' => esc_html__( 'Columns to display in area over 1200 in width when using "Masonry" layout option., enter only a number i.e 4', 'ninezeroseven' ),
					'group'       => esc_html__( 'Column Settings', 'ninezeroseven' )
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Over 800', 'ninezeroseven' ),
					'param_name'  => 'cols_l',
					'description' => esc_html__( 'Columns to display in area over 800 in width when using "Masonry" layout option., enter only a number i.e 4', 'ninezeroseven' ),
					'group'       => esc_html__( 'Column Settings', 'ninezeroseven' )
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Over 600', 'ninezeroseven' ),
					'param_name'  => 'cols_s',
					'description' => esc_html__( 'Columns to display in area over 600 in width when using "Masonry" layout option., enter only a number i.e 4', 'ninezeroseven' ),
					'group'       => esc_html__( 'Column Settings', 'ninezeroseven' )
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Over 400', 'ninezeroseven' ),
					'param_name'  => 'cols_xs',
					'description' => esc_html__( 'Columns to display in area over 400 in width when using "Masonry" layout option., enter only a number i.e 4', 'ninezeroseven' ),
					'group'       => esc_html__( 'Column Settings', 'ninezeroseven' )
				),
			),


		));

		// Single Icon Shortcode
		vc_map(array(
			'name'=>'Single Icon',
			'base'=>'wbc_icon',
			'is_container' => false,
			'icon' => 'icon-wpb-row',
			'show_settings_on_create' => true,
			'admin_enqueue_css' => array(get_template_directory_uri().'/includes/vc_extend/css/vc_admin.css'),
			'admin_enqueue_js' => array(get_template_directory_uri().'/includes/vc_extend/js/vc_admin.js'),
			'front_enqueue_css' => get_template_directory_uri().'/includes/vc_extend/css/vc_admin.css',
			'front_enqueue_js' => get_template_directory_uri().'/includes/vc_extend/js/vc_admin-front.js',
			'category' => esc_html__( '907 Additions', 'ninezeroseven' ),
			'description' => esc_html__( 'For Displaying Icons', 'ninezeroseven' ),
			'params'=>array(
			
			//BEGIN ICON SELECTOR(S)
			array(
				'type' => 'dropdown',
				'heading' => __( 'Icon Packs', 'ninezeroseven' ),
				'value' => array(
					__( 'Font Awesome', 'ninezeroseven' ) => 'fontawesome',
					__( 'Open Iconic', 'ninezeroseven' )  => 'openiconic',
					__( 'Typicons', 'ninezeroseven' )     => 'typicons',
					__( 'Entypo', 'ninezeroseven' )       => 'entypo',
					__( 'Linecons', 'ninezeroseven' )     => 'linecons',
					__( 'ET Line', 'ninezeroseven' )     => 'etline',
					__( 'Flaticons', 'ninezeroseven' )     => 'flaticon',
				),
				'param_name' => 'icon_pack',
				'description' => __( 'Select icon library.', 'ninezeroseven' ),
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'ninezeroseven' ),
				'param_name' => 'icon_fontawesome',
				'value' => 'fa fa-info-circle',
				'settings' => array(
					'emptyIcon' => false,
					// default true, display an "EMPTY" icon?
					'iconsPerPage' => 75,
					// default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'icon_pack',
					'value' => 'fontawesome',
				),
				'description' => __( 'Select icon from library.', 'ninezeroseven' ),
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'ninezeroseven' ),
				'param_name' => 'icon_openiconic',
				'settings' => array(
					'emptyIcon' => false,
					// default true, display an "EMPTY" icon?
					'type' => 'openiconic',
					'iconsPerPage' => 75,
					// default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'icon_pack',
					'value' => 'openiconic',
				),
				'description' => __( 'Select icon from library.', 'ninezeroseven' ),
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'ninezeroseven' ),
				'param_name' => 'icon_typicons',
				'settings' => array(
					'emptyIcon' => false,
					// default true, display an "EMPTY" icon?
					'type' => 'typicons',
					'iconsPerPage' => 75,
					// default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'icon_pack',
					'value' => 'typicons',
				),
				'description' => __( 'Select icon from library.', 'ninezeroseven' ),
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'ninezeroseven' ),
				'param_name' => 'icon_entypo',
				'settings' => array(
					'emptyIcon' => false,
					// default true, display an "EMPTY" icon?
					'type' => 'entypo',
					'iconsPerPage' => 75,
					// default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'icon_pack',
					'value' => 'entypo',
				),
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'ninezeroseven' ),
				'param_name' => 'icon_linecons',
				'settings' => array(
					'emptyIcon' => false,
					// default true, display an "EMPTY" icon?
					'type' => 'linecons',
					'iconsPerPage' => 75,
					// default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'icon_pack',
					'value' => 'linecons',
				),
				'description' => __( 'Select icon from library.', 'ninezeroseven' ),
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'ninezeroseven' ),
				'param_name' => 'icon_etline',
				'settings' => array(
					'emptyIcon' => false,
					// default true, display an "EMPTY" icon?
					'type' => 'etline',
					'iconsPerPage' => 75,
					// default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'icon_pack',
					'value' => 'etline',
				),
				'description' => __( 'Select icon from library.', 'ninezeroseven' ),
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'ninezeroseven' ),
				'param_name' => 'icon_flaticon',
				'settings' => array(
					'emptyIcon' => false,
					// default true, display an "EMPTY" icon?
					'type' => 'flaticon',
					'iconsPerPage' => 75,
					// default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'icon_pack',
					'value' => 'flaticon',
				),
				'description' => __( 'Select icon from library.', 'ninezeroseven' ),
			)
			//END ICON SELECTOR(S)
			,array(
			    'type' => 'dropdown',
			    'heading' => esc_html__( 'Icon Type', 'ninezeroseven' ),
			    'param_name' => 'icon_type',
			    'value' => array(
								esc_html__( 'Default', 'ninezeroseven' ) => '',
								esc_html__( 'Style 1', 'ninezeroseven' ) =>  'style-1',
								esc_html__( 'Style 2', 'ninezeroseven' ) =>  'style-2',
								esc_html__( 'Style 3', 'ninezeroseven' ) =>  'style-3',
								esc_html__( 'Style 4', 'ninezeroseven' ) =>  'style-4',
							),
			    'description' => esc_html__( 'Some preset styles', 'ninezeroseven' ),
			),
				array(
				    'type' => 'dropdown',
				    'heading' => esc_html__( 'Icon Style', 'ninezeroseven' ),
				    'param_name' => 'icon_style',
				    'value' => array(
									esc_html__( 'Default', 'ninezeroseven' )     => '',
									esc_html__( 'Icon Circle', 'ninezeroseven' ) =>  'circle',
									esc_html__( 'Icon Square', 'ninezeroseven' ) =>  'square',
								),
				    'description' => esc_html__( 'Some options for the styling of the icon background.', 'ninezeroseven' ),
				),
				array(
				    'type' => 'dropdown',
				    'heading' => esc_html__( 'Icon Extra', 'ninezeroseven' ),
				    'param_name' => 'icon_extra',
				    'value' => array(
									esc_html__( 'Default', 'ninezeroseven' )     => '',
									esc_html__( 'Icon Outline', 'ninezeroseven' ) =>  'outline',
									esc_html__( 'Icon Border', 'ninezeroseven' ) =>  'border',
								),
				    'description' => esc_html__( 'Some options for the styling of the icon background.', 'ninezeroseven' ),
				),
				array(
					'type'        => 'vc_link',
					'heading'     => esc_html__( 'Link', 'ninezeroseven' ),
					'param_name'  => 'icon_link',
					'description' => esc_html__( 'If you\'d like the icon linked', 'ninezeroseven' ),
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Font Icon Size', 'ninezeroseven' ),
					'param_name'  => 'font_size',
					'description' => esc_html__( 'This sets the size of the icon.', 'ninezeroseven' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Icon Color', 'ninezeroseven' ),
					'param_name' => 'color',
					'description' => esc_html__( 'Color for the icon.', 'ninezeroseven' ),

				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Icon Hover Color', 'ninezeroseven' ),
					'param_name' => 'color_hover',
					'description' => esc_html__( 'Color for the icon.', 'ninezeroseven' ),

				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Icon background', 'ninezeroseven' ),
					'param_name' => 'bg_color',
					'description' => esc_html__( 'Background color for the icon.', 'ninezeroseven' ),

				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Icon Hover background', 'ninezeroseven' ),
					'param_name' => 'bg_color_hover',
					'description' => esc_html__( 'Background color for the icon.', 'ninezeroseven' ),

				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Icon Border Color', 'ninezeroseven' ),
					'param_name' => 'border_color',
					'description' => esc_html__( 'Border color when using bordered options.', 'ninezeroseven' ),

				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Icon Border Hover Color', 'ninezeroseven' ),
					'param_name' => 'border_color_hover',
					'description' => esc_html__( 'Border color when using bordered options.', 'ninezeroseven' ),

				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Icon Border Size', 'ninezeroseven' ),
					'param_name'  => 'border_width',
					'description' => esc_html__( 'Width you\'d like the border when using border style', 'ninezeroseven' ),
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Icon Border Radius', 'ninezeroseven' ),
					'param_name'  => 'border_radius',
					'description' => esc_html__( 'Controls the background raduis.', 'ninezeroseven' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Outline Color', 'ninezeroseven' ),
					'param_name' => 'outline_color',
					'description' => esc_html__( 'Color of outline when using outline option', 'ninezeroseven' ),

				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Outline Hover Color', 'ninezeroseven' ),
					'param_name' => 'outline_color_hover',
					'description' => esc_html__( 'Color of outline when using outline option', 'ninezeroseven' ),

				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Outline Width', 'ninezeroseven' ),
					'param_name'  => 'outline_width',
					'description' => esc_html__( 'Width of outline', 'ninezeroseven' ),
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Outline Spacing', 'ninezeroseven' ),
					'param_name'  => 'outline_spacing',
					'description' => esc_html__( 'Spacing between inner icon bg and outline.', 'ninezeroseven' ),
				),
	            // //Margin
	            array(
	                'type'        => 'textfield',
	                'heading'     => esc_html__( 'Margin Top', 'ninezeroseven' ),
	                'param_name'  => 'margin_top',
	                'description' => esc_html__( 'Margin top, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
	                'group'       => esc_html__( 'Margin', 'ninezeroseven' )
	            ),
	            array(
	                'type'        => 'textfield',
	                'heading'     => esc_html__( 'Margin Bottom', 'ninezeroseven' ),
	                'param_name'  => 'margin_bottom',
	                'description' => esc_html__( 'Margin bottom, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
	                'group'       => esc_html__( 'Margin', 'ninezeroseven' )
	            ),
	            array(
	                'type'        => 'textfield',
	                'heading'     => esc_html__( 'Margin Left', 'ninezeroseven' ),
	                'param_name'  => 'margin_left',
	                'description' => esc_html__( 'Margin Left, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
	                'group'       => esc_html__( 'Margin', 'ninezeroseven' )
	            ),
	            array(
	                'type'        => 'textfield',
	                'heading'     => esc_html__( 'Margin Right', 'ninezeroseven' ),
	                'param_name'  => 'margin_right',
	                'description' => esc_html__( 'Margin Right, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
	                'group'       => esc_html__( 'Margin', 'ninezeroseven' )
	            ),
			)
		));

		// List Item
		vc_map( array(
		    "name"                    => esc_html__('Icon/Info List', 'ninezeroseven'),
		    "base"                    => "wbc_list",
		    'icon'                    => 'icon-wpb-row',
		    'description' => esc_html__( 'Adds a list of icons with info option.', 'ninezeroseven' ),
		    "as_parent"               => array('only' => 'wbc_list_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    "content_element"         => true,
		    "show_settings_on_create" => true,
		    'category'                => esc_html__( '907 Additions', 'ninezeroseven' ),
		    'front_enqueue_js'        => get_template_directory_uri().'/includes/vc_extend/js/vc_admin-front.js',
		    "params"                  => array(
					array(
					    'type' => 'dropdown',
					    'heading' => esc_html__( 'Icon Style', 'ninezeroseven' ),
					    'param_name' => 'icon_style',
					    'value' => array(
										esc_html__( 'Default', 'ninezeroseven' )     => '',
										esc_html__( 'Icon Circle', 'ninezeroseven' ) =>  'circle',
										esc_html__( 'Icon Square', 'ninezeroseven' ) =>  'square',
									),
					    'description' => esc_html__( 'Sets the icon style for all list items to be added.', 'ninezeroseven' ),
					),
					array(
					    'type' => 'dropdown',
					    'heading' => esc_html__( 'Icon Extra', 'ninezeroseven' ),
					    'param_name' => 'icon_extra',
					    'value' => array(
										esc_html__( 'Default', 'ninezeroseven' )     => '',
										esc_html__( 'Icon Outline', 'ninezeroseven' ) =>  'outline',
										esc_html__( 'Icon Border', 'ninezeroseven' ) =>  'border',
									),
					    'description' => esc_html__( 'Addtional styling options for list items to be added.', 'ninezeroseven' ),
					),
					array(
					    'type' => 'dropdown',
					    'heading' => esc_html__( 'Icon Type', 'ninezeroseven' ),
					    'param_name' => 'icon_type',
					    'value' => array(
										esc_html__( 'Default', 'ninezeroseven' ) => '',
										esc_html__( 'Style 1', 'ninezeroseven' ) =>  'style-1',
										esc_html__( 'Style 2', 'ninezeroseven' ) =>  'style-2',
										esc_html__( 'Style 3', 'ninezeroseven' ) =>  'style-3',
										esc_html__( 'Style 4', 'ninezeroseven' ) =>  'style-4',
									),
					    'description' => esc_html__( 'Some preset styles', 'ninezeroseven' ),
					),
					array(
					    'type' => 'dropdown',
					    'heading' => esc_html__( 'Align List', 'ninezeroseven' ),
					    'param_name' => 'list_align',
					    'value' => array(
										esc_html__( 'Left', 'ninezeroseven' )    => '',
										esc_html__( 'Right', 'ninezeroseven' ) =>  'right',
										esc_html__( 'Center', 'ninezeroseven' ) =>  'center',
									),
					    'description' => esc_html__( 'Aligns list items.', 'ninezeroseven' ),
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Font/Icon Size', 'ninezeroseven' ),
						'param_name'  => 'font_size',
						'description' => esc_html__( 'Size option for icons.', 'ninezeroseven' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Icon Color', 'ninezeroseven' ),
						'param_name' => 'color',
						'description' => esc_html__( 'This sets the font icon color, leave blank to use theme default color.', 'ninezeroseven' ),

					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Icon background', 'ninezeroseven' ),
						'param_name' => 'bg_color',
						'description' => esc_html__( 'This sets the background color for the icon, leave blank to use theme default color.', 'ninezeroseven' ),

					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Icon Border Color', 'ninezeroseven' ),
						'param_name' => 'border_color',
						'description' => esc_html__( 'Border color for icon, leave blank to use theme default color.', 'ninezeroseven' ),

					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Inner Content Font Color', 'ninezeroseven' ),
						'param_name' => 'font_color',
						'description' => esc_html__( 'This can be overridden in editor when adding list items', 'ninezeroseven' ),

					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Icon Border Size', 'ninezeroseven' ),
						'param_name'  => 'border_width',
						'description' => esc_html__( 'If using border style, you can set border width here.', 'ninezeroseven' ),
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Icon Border Radius', 'ninezeroseven' ),
						'param_name'  => 'border_radius',
						'description' => esc_html__( 'Sets the radius of the icon for round option.', 'ninezeroseven' ),
					),

					//Padding
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Padding Top', 'ninezeroseven' ),
						'param_name'  => 'p_top',
						'description' => esc_html__( 'Padding top, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
						'group'       => esc_html__( 'Padding', 'ninezeroseven' )
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Padding Bottom', 'ninezeroseven' ),
						'param_name'  => 'p_bottom',
						'description' => esc_html__( 'Padding bottom, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
						'group'       => esc_html__( 'Padding', 'ninezeroseven' )
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Padding Left', 'ninezeroseven' ),
						'param_name'  => 'p_left',
						'description' => esc_html__( 'Padding Left, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
						'group'       => esc_html__( 'Padding', 'ninezeroseven' )
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Padding Right', 'ninezeroseven' ),
						'param_name'  => 'p_right',
						'description' => esc_html__( 'Padding Right, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
						'group'       => esc_html__( 'Padding', 'ninezeroseven' )
					),
					//Margin
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Margin Top', 'ninezeroseven' ),
						'param_name'  => 'm_top',
						'description' => esc_html__( 'Margin top, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
						'group'       => esc_html__( 'Margin', 'ninezeroseven' )
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Margin Bottom', 'ninezeroseven' ),
						'param_name'  => 'm_bottom',
						'description' => esc_html__( 'Margin bottom, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
						'group'       => esc_html__( 'Margin', 'ninezeroseven' )
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Margin Left', 'ninezeroseven' ),
						'param_name'  => 'm_left',
						'description' => esc_html__( 'Margin Left, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
						'group'       => esc_html__( 'Margin', 'ninezeroseven' )
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Margin Right', 'ninezeroseven' ),
						'param_name'  => 'm_right',
						'description' => esc_html__( 'Margin Right, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
						'group'       => esc_html__( 'Margin', 'ninezeroseven' )
					),

		    ),
		    "js_view" => 'VcColumnView'
		) );
		vc_map( array(
		    "name" => esc_html__('List Item', 'ninezeroseven'),
		    "base" => "wbc_list_item",
		    'description' => esc_html__( 'Items for list box.', 'ninezeroseven' ),
		    'icon' => 'icon-wpb-row',
		    "content_element" => true,
		    "as_child" => array('only' => 'wbc_list'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    "params" => array(
		        // add params same as with any other content element
		        //BEGIN ICON SELECTOR(S)
				array(
					'type' => 'dropdown',
					'heading' => __( 'Icon Packs', 'ninezeroseven' ),
					'value' => array(
						__( 'Font Awesome', 'ninezeroseven' ) => 'fontawesome',
						__( 'Open Iconic', 'ninezeroseven' )  => 'openiconic',
						__( 'Typicons', 'ninezeroseven' )     => 'typicons',
						__( 'Entypo', 'ninezeroseven' )       => 'entypo',
						__( 'Linecons', 'ninezeroseven' )     => 'linecons',
						__( 'ET Line', 'ninezeroseven' )     => 'etline',
						__( 'Flaticons', 'ninezeroseven' )     => 'flaticon',
					),
					'param_name' => 'icon_pack',
					'description' => __( 'Select icon library.', 'ninezeroseven' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => __( 'Icon', 'ninezeroseven' ),
					'param_name' => 'icon_fontawesome',
					'value' => 'fa fa-info-circle',
					'settings' => array(
						'emptyIcon' => false,
						// default true, display an "EMPTY" icon?
						'iconsPerPage' => 75,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => 'fontawesome',
					),
					'description' => __( 'Select icon from library.', 'ninezeroseven' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => __( 'Icon', 'ninezeroseven' ),
					'param_name' => 'icon_openiconic',
					'settings' => array(
						'emptyIcon' => false,
						// default true, display an "EMPTY" icon?
						'type' => 'openiconic',
						'iconsPerPage' => 75,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => 'openiconic',
					),
					'description' => __( 'Select icon from library.', 'ninezeroseven' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => __( 'Icon', 'ninezeroseven' ),
					'param_name' => 'icon_typicons',
					'settings' => array(
						'emptyIcon' => false,
						// default true, display an "EMPTY" icon?
						'type' => 'typicons',
						'iconsPerPage' => 75,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => 'typicons',
					),
					'description' => __( 'Select icon from library.', 'ninezeroseven' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => __( 'Icon', 'ninezeroseven' ),
					'param_name' => 'icon_entypo',
					'settings' => array(
						'emptyIcon' => false,
						// default true, display an "EMPTY" icon?
						'type' => 'entypo',
						'iconsPerPage' => 75,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => 'entypo',
					),
				),
				array(
					'type' => 'iconpicker',
					'heading' => __( 'Icon', 'ninezeroseven' ),
					'param_name' => 'icon_linecons',
					'settings' => array(
						'emptyIcon' => false,
						// default true, display an "EMPTY" icon?
						'type' => 'linecons',
						'iconsPerPage' => 75,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => 'linecons',
					),
					'description' => __( 'Select icon from library.', 'ninezeroseven' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => __( 'Icon', 'ninezeroseven' ),
					'param_name' => 'icon_etline',
					'settings' => array(
						'emptyIcon' => false,
						// default true, display an "EMPTY" icon?
						'type' => 'etline',
						'iconsPerPage' => 75,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => 'etline',
					),
					'description' => __( 'Select icon from library.', 'ninezeroseven' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => __( 'Icon', 'ninezeroseven' ),
					'param_name' => 'icon_flaticon',
					'settings' => array(
						'emptyIcon' => false,
						// default true, display an "EMPTY" icon?
						'type' => 'flaticon',
						'iconsPerPage' => 75,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => 'flaticon',
					),
					'description' => __( 'Select icon from library.', 'ninezeroseven' ),
				),
				//END ICON SELECTOR(S)
				array(
					'type' => 'textarea_html',
					// 'holder' => 'div',
					'heading' => esc_html__( 'Content', 'ninezeroseven' ),
					'param_name' => 'content',
					'value' => '<p>'.esc_html__( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'ninezeroseven' ).'</p>'
				)
		    )
		) );

		if(class_exists('WPBakeryShortCodesContainer'))
		{
		    class WPBakeryShortCode_Wbc_List extends WPBakeryShortCodesContainer {

		    }
		}
		if(class_exists('WPBakeryShortCode'))
		{
		    class WPBakeryShortCode_Wbc_List_Item extends WPBakeryShortCode {

		    }
		}

		// Client Logos
		vc_map( array(
		    "name"                    => esc_html__('Client Logo Carousel', 'ninezeroseven'),
		    "base"                    => "wbc_logos",
		    'icon'                    => 'icon-wpb-row',
		    'description' => esc_html__( 'Adds your client logos in carousel', 'ninezeroseven' ),
		    "as_parent"               => array('only' => 'wbc_logo'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    "content_element"         => true,
		    "show_settings_on_create" => true,
		    'category'                => esc_html__( '907 Additions', 'ninezeroseven' ),
		    'admin_enqueue_css' => array(get_template_directory_uri().'/includes/vc_extend/css/vc_admin.css'),
			'admin_enqueue_js' => array(get_template_directory_uri().'/includes/vc_extend/js/vc_admin.js'),
			'front_enqueue_css' => get_template_directory_uri().'/includes/vc_extend/css/vc_admin.css',
			'front_enqueue_js' => get_template_directory_uri().'/includes/vc_extend/js/vc_admin-front.js',
		    "params"                  => array(
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Item Width', 'ninezeroseven' ),
						'param_name'  => 'item_width',
						'description' => esc_html__( 'Sets the widths for logo area.', 'ninezeroseven' ),
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Scroll Amount', 'ninezeroseven' ),
						'param_name'  => 'item_scroll',
						'description' => esc_html__( 'How many to scroll at once', 'ninezeroseven' ),
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Item Min Shown', 'ninezeroseven' ),
						'param_name'  => 'item_min',
						'description' => esc_html__( 'Set Min amout of items to show', 'ninezeroseven' ),
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Item Max Shown', 'ninezeroseven' ),
						'param_name'  => 'item_max',
						'description' => esc_html__( 'Set Max amout of items to show', 'ninezeroseven' ),
					),
					

		    ),
		    "js_view" => 'VcColumnView'
		) );
		vc_map( array(
		    "name" => esc_html__('Client Logo', 'ninezeroseven'),
		    "base" => "wbc_logo",
		    'description' => esc_html__( 'Clients Logos', 'ninezeroseven' ),
		    'icon' => 'icon-wpb-row',
		    "content_element" => true,
		    "as_child" => array('only' => 'wbc_logos'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    "params" => array(
		        // add params same as with any other content element
		        array(
		            'type' => 'attach_image',
		            'heading' => esc_html__( 'Image', 'ninezeroseven' ),
		            'param_name' => 'logo_image',
		            'description' => esc_html__( 'Attach image to be displayed', 'ninezeroseven' ),

		        ),
		        array(
		            'type'        => 'vc_link',
		            'heading'     => esc_html__( 'Link', 'ninezeroseven' ),
		            'param_name'  => 'logo_link',
		            'description' => esc_html__( 'If you\'d like the logo linked', 'ninezeroseven' ),
		            ),
		    )
		) );

		if(class_exists('WPBakeryShortCodesContainer'))
		{
		    class WPBakeryShortCode_Wbc_Logos extends WPBakeryShortCodesContainer {

		    }
		}
		if(class_exists('WPBakeryShortCode'))
		{
		    class WPBakeryShortCode_Wbc_Logo extends WPBakeryShortCode {

		    }
		}

		// Testimonials
		vc_map( array(
		    "name"                    => esc_html__('Testimonials', 'ninezeroseven'),
		    "base"                    => "wbc_testimonials",
		    'icon'                    => 'icon-wpb-row',
		    'description' => esc_html__( 'Adds testimonials carousel', 'ninezeroseven' ),
		    "as_parent"               => array('only' => 'wbc_testimonial'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    "content_element"         => true,
		    "show_settings_on_create" => false,
		    'category'                => esc_html__( '907 Additions', 'ninezeroseven' ),
		    'front_enqueue_js'        => get_template_directory_uri().'/includes/vc_extend/js/vc_admin-front.js',
		    "params"                  => array(
		    		array(
						'type'        => 'checkbox',
						'heading'     => esc_html__( 'Make Same Height?', 'ninezeroseven' ),
						'param_name'  => 'auto_height',
						'description' => esc_html__( 'Enable this will make all items same height', 'ninezeroseven' ),
						'value'       => array( esc_html__( 'Yes, please', 'ninezeroseven' ) => 'yes' )
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Speed', 'ninezeroseven' ),
						'param_name'  => 'speed',
						'description' => esc_html__( 'Changes the speed/duration between entires. Use numbers only i.e 8000', 'ninezeroseven' ),
					),

		    	),
		    "js_view" => 'VcColumnView'
		) );
		vc_map( array(
		    "name" => esc_html__('Testimonial', 'ninezeroseven'),
		    "base" => "wbc_testimonial",
		    'description' => esc_html__( 'Testimonial', 'ninezeroseven' ),
		    'icon' => 'icon-wpb-row',
		    "content_element" => true,
		    "as_child" => array('only' => 'wbc_testimonials'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    "params" => array(
		        // add params same as with any other content element
		        array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Name', 'ninezeroseven' ),
					'param_name'  => 'user_name',
					'description' => esc_html__( 'Displays Name', 'ninezeroseven' ),
				),
				array(
		            'type'        => 'textarea',
		            'heading'     => esc_html__( 'Testimonial Message', 'ninezeroseven' ),
		            'param_name'  => 'user_message',
		            'description' => esc_html__( 'Add testimonial here, you can use | around words to turn into theme color ie "This is |GREAT| feature" and "Great" will be turned into theme primary color. Or use color option below.', 'ninezeroseven' ),
		        ),
		        array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Credit', 'ninezeroseven' ),
					'param_name'  => 'user_credit',
					'description' => esc_html__( 'Shows below name.', 'ninezeroseven' ),
				),
		        array(
		            'type' => 'attach_image',
		            'heading' => esc_html__( 'Image', 'ninezeroseven' ),
		            'param_name' => 'user_image',
		            'description' => esc_html__( 'Attach image to be displayed', 'ninezeroseven' ),

		        ),
		    )
		) );

		if(class_exists('WPBakeryShortCodesContainer'))
		{
		    class WPBakeryShortCode_Wbc_Testimonials extends WPBakeryShortCodesContainer {

		    }
		}
		if(class_exists('WPBakeryShortCode'))
		{
		    class WPBakeryShortCode_Wbc_Testimonial extends WPBakeryShortCode {

		    }
		}

		// Icon Box
		vc_map( array(
		    "name" => esc_html__('Icon Box', 'ninezeroseven'),
		    "base" => "wbc_icon_box",
		    "content_element" => true,
		    'icon' => 'icon-wpb-row',
		    "show_settings_on_create" => true,
		    'description' => esc_html__( 'Add icon area, great for services', 'ninezeroseven' ),
		    'category' => esc_html__( '907 Additions', 'ninezeroseven' ),
		    'front_enqueue_js' => get_template_directory_uri().'/includes/vc_extend/js/vc_admin-front.js',
		    "params" => array(
		    		//Heading
		    		array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Heading', 'ninezeroseven' ),
		                'param_name'  => 'heading',
		                'admin_label' => true,
		                // 'description' => esc_html__( 'Sets the radius of the icon for round option.', 'ninezeroseven' ),
		            ),

		            //Heading
		    		array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Subtitle', 'ninezeroseven' ),
		                'param_name'  => 'subtitle',
		                // 'description' => esc_html__( 'Sets the radius of the icon for round option.', 'ninezeroseven' ),
		            ),
		         
		        array(
					'type' => 'dropdown',
					'heading' => __( 'Display Type', 'ninezeroseven' ),
					'value' => array(
						__( 'Icon', 'ninezeroseven' )   => 'icon',
						__( 'Image', 'ninezeroseven' )  => 'img',
					),
					'param_name' => 'display_type',
					'description' => __( 'Select Icon or Image', 'ninezeroseven' ),
				),
				array(
		            'type' => 'attach_image',
		            'heading' => esc_html__( 'Icon Image', 'ninezeroseven' ),
		            'param_name' => 'icon_img',
		            'description' => esc_html__( 'Attach image to be displayed', 'ninezeroseven' ),
		            'dependency' => array(
						'element' => 'display_type',
						'value'   => 'img',
					),

		        ),
		    	array(
					'type' => 'dropdown',
					'heading' => __( 'Icon Packs', 'ninezeroseven' ),
					'value' => array(
						__( 'Font Awesome', 'ninezeroseven' ) => 'fontawesome',
						__( 'Open Iconic', 'ninezeroseven' )  => 'openiconic',
						__( 'Typicons', 'ninezeroseven' )     => 'typicons',
						__( 'Entypo', 'ninezeroseven' )       => 'entypo',
						__( 'Linecons', 'ninezeroseven' )     => 'linecons',
						__( 'ET Line', 'ninezeroseven' )      => 'etline',
						__( 'Flaticons', 'ninezeroseven' )    => 'flaticon',
					),
					'param_name' => 'icon_pack',
					'description' => __( 'Select icon library.', 'ninezeroseven' ),
					'dependency' => array(
						'element' => 'display_type',
						'value' => 'icon',
					),
				),
				array(
					'type' => 'iconpicker',
					'heading' => __( 'Icon', 'ninezeroseven' ),
					'param_name' => 'icon_fontawesome',
					'value' => 'fa fa-info-circle',
					'settings' => array(
						'emptyIcon' => false,
						// default true, display an "EMPTY" icon?
						'iconsPerPage' => 75,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => 'fontawesome',
					),
					'description' => __( 'Select icon from library.', 'ninezeroseven' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => __( 'Icon', 'ninezeroseven' ),
					'param_name' => 'icon_openiconic',
					'settings' => array(
						'emptyIcon' => false,
						// default true, display an "EMPTY" icon?
						'type' => 'openiconic',
						'iconsPerPage' => 75,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => 'openiconic',
					),
					'description' => __( 'Select icon from library.', 'ninezeroseven' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => __( 'Icon', 'ninezeroseven' ),
					'param_name' => 'icon_typicons',
					'settings' => array(
						'emptyIcon' => false,
						// default true, display an "EMPTY" icon?
						'type' => 'typicons',
						'iconsPerPage' => 75,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => 'typicons',
					),
					'description' => __( 'Select icon from library.', 'ninezeroseven' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => __( 'Icon', 'ninezeroseven' ),
					'param_name' => 'icon_entypo',
					'settings' => array(
						'emptyIcon' => false,
						// default true, display an "EMPTY" icon?
						'type' => 'entypo',
						'iconsPerPage' => 75,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => 'entypo',
					),
				),
				array(
					'type' => 'iconpicker',
					'heading' => __( 'Icon', 'ninezeroseven' ),
					'param_name' => 'icon_linecons',
					'settings' => array(
						'emptyIcon' => false,
						// default true, display an "EMPTY" icon?
						'type' => 'linecons',
						'iconsPerPage' => 75,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => 'linecons',
					),
					'description' => __( 'Select icon from library.', 'ninezeroseven' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => __( 'Icon', 'ninezeroseven' ),
					'param_name' => 'icon_etline',
					'settings' => array(
						'emptyIcon' => false,
						// default true, display an "EMPTY" icon?
						'type' => 'etline',
						'iconsPerPage' => 75,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => 'etline',
					),
					'description' => __( 'Select icon from library.', 'ninezeroseven' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => __( 'Icon', 'ninezeroseven' ),
					'param_name' => 'icon_flaticon',
					'settings' => array(
						'emptyIcon' => false,
						// default true, display an "EMPTY" icon?
						'type' => 'flaticon',
						'iconsPerPage' => 75,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => 'flaticon',
					),
					'description' => __( 'Select icon from library.', 'ninezeroseven' ),
				),
				//END ICON SELECTOR(S)
		            array(
					    'type' => 'dropdown',
					    'heading' => esc_html__( 'Icon Type', 'ninezeroseven' ),
					    'param_name' => 'icon_type',
					    'value' => array(
										esc_html__( 'Default', 'ninezeroseven' ) => '',
										esc_html__( 'Style 1', 'ninezeroseven' ) =>  'style-1',
										esc_html__( 'Style 2', 'ninezeroseven' ) =>  'style-2',
										esc_html__( 'Style 3', 'ninezeroseven' ) =>  'style-3',
										esc_html__( 'Style 4', 'ninezeroseven' ) =>  'style-4',
									),
					    'description' => esc_html__( 'Some preset styles', 'ninezeroseven' ),
					    'dependency' => array(
							'element' => 'display_type',
							'value' => 'icon',
							),
					),
					array(
		                'type' => 'dropdown',
		                'heading' => esc_html__( 'Info Box Style', 'ninezeroseven' ),
		                'param_name' => 'box_style',
		                'value' => array(
										esc_html__( 'Icon Left', 'ninezeroseven' )   => '',
										esc_html__( 'Icon Right', 'ninezeroseven' )  =>  'right',
										esc_html__( 'Icon Center', 'ninezeroseven' ) =>  'center',
		                                esc_html__( 'Wrap Left', 'ninezeroseven' ) =>  'left-wrap',
		                                esc_html__( 'Wrap Right', 'ninezeroseven' ) =>  'right-wrap',
		                            ),
		                'description' => esc_html__( 'This option aligns the content.', 'ninezeroseven' ),
		            ),

		            /************************************************************************
		            * Icon Styling
		            *************************************************************************/
		            
		            array(
		                'type' => 'dropdown',
		                'heading' => esc_html__( 'Icon Style', 'ninezeroseven' ),
		                'param_name' => 'icon_style',
		                'value' => array(
		                                esc_html__( 'Default', 'ninezeroseven' )     => '',
		                                esc_html__( 'Icon Circle', 'ninezeroseven' ) =>  'circle',
		                                esc_html__( 'Icon Square', 'ninezeroseven' ) =>  'square',
		                            ),
		                'description' => esc_html__( 'Just some styling options for icon background', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Icon Styling', 'ninezeroseven' ),
		            ),
		            array(
		                'type' => 'dropdown',
		                'heading' => esc_html__( 'Icon Extra', 'ninezeroseven' ),
		                'param_name' => 'icon_extra',
		                'value' => array(
		                                esc_html__( 'Default', 'ninezeroseven' )     => '',
		                                esc_html__( 'Icon Outline', 'ninezeroseven' ) =>  'outline',
		                                esc_html__( 'Icon Border', 'ninezeroseven' ) =>  'border',
		                            ),
		                'description' => esc_html__( 'Just some extra background options ;)', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Icon Styling', 'ninezeroseven' ),
		            ),
		            array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Icon Margin Bottom', 'ninezeroseven' ),
						'param_name'  => 'icon_margin_bottom',
						'description' => esc_html__( 'Add some space between icon and content.', 'ninezeroseven' ),
						// "dependency"  => array('element' => "list_align", 'value' => array('center')),
						'group'       => esc_html__( 'Icon Styling', 'ninezeroseven' ),
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Icon Size', 'ninezeroseven' ),
		                'param_name'  => 'icon_size',
		                'description' => esc_html__( 'This sets the size for the icon.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Icon Styling', 'ninezeroseven' ),
		            ),
		            array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__( 'Icon Color', 'ninezeroseven' ),
						'param_name'  => 'icon_color',
						'description' => esc_html__( 'This sets the font icon color, leave blank to use theme default color.', 'ninezeroseven' ),
						'group'       => esc_html__( 'Icon Styling', 'ninezeroseven' ),

		            ),
		            array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__( 'Icon Hover Color', 'ninezeroseven' ),
						'param_name'  => 'icon_color_hover',
						'description' => esc_html__( 'Color for the icon.', 'ninezeroseven' ),
						'group'       => esc_html__( 'Icon Styling', 'ninezeroseven' ),

					),
		            array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__( 'Icon background', 'ninezeroseven' ),
						'param_name'  => 'icon_bg_color',
						'description' => esc_html__( 'This sets the background color for the icon, leave blank to use theme default color.', 'ninezeroseven' ),
						'group'       => esc_html__( 'Icon Styling', 'ninezeroseven' ),

		            ),
		            array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__( 'Icon background Hover', 'ninezeroseven' ),
						'param_name'  => 'icon_bg_color_hover',
						'description' => esc_html__( 'This sets the background color for the icon, leave blank to use theme default color.', 'ninezeroseven' ),
						'group'       => esc_html__( 'Icon Styling', 'ninezeroseven' ),

		            ),
		            array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__( 'Icon Border Color', 'ninezeroseven' ),
						'param_name'  => 'icon_border_color',
						'description' => esc_html__( 'Border color for icon, leave blank to use theme default color.', 'ninezeroseven' ),
						'group'       => esc_html__( 'Icon Styling', 'ninezeroseven' ),

		            ),
		            array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Icon Border Hover Color', 'ninezeroseven' ),
						'param_name' => 'icon_border_color_hover',
						'description' => esc_html__( 'Border color when using bordered options.', 'ninezeroseven' ),
						'group'       => esc_html__( 'Icon Styling', 'ninezeroseven' ),

					),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Icon Border Size', 'ninezeroseven' ),
		                'param_name'  => 'icon_border_width',
		                'description' => esc_html__( 'If using border style, you can set border width here.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Icon Styling', 'ninezeroseven' ),
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Icon Border Radius', 'ninezeroseven' ),
		                'param_name'  => 'icon_border_radius',
		                'description' => esc_html__( 'Sets the radius of the icon for round option.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Icon Styling', 'ninezeroseven' ),
		            ),
		            array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Outline Color', 'ninezeroseven' ),
						'param_name' => 'icon_outline_color',
						'description' => esc_html__( 'Color of outline when using outline option', 'ninezeroseven' ),
						'group'       => esc_html__( 'Icon Styling', 'ninezeroseven' ),

					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Outline Hover Color', 'ninezeroseven' ),
						'param_name' => 'icon_outline_color_hover',
						'description' => esc_html__( 'Color of outline when using outline option', 'ninezeroseven' ),
						'group'       => esc_html__( 'Icon Styling', 'ninezeroseven' ),

					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Outline Width', 'ninezeroseven' ),
						'param_name'  => 'icon_outline_width',
						'description' => esc_html__( 'Width of outline', 'ninezeroseven' ),
						'group'       => esc_html__( 'Icon Styling', 'ninezeroseven' ),
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Outline Spacing', 'ninezeroseven' ),
						'param_name'  => 'icon_outline_spacing',
						'group'       => esc_html__( 'Icon Styling', 'ninezeroseven' ),
						),

					//Content
		            array(
		                'type' => 'textarea_html',
		                // 'holder' => 'div',
		                'heading' => esc_html__( 'Content', 'ninezeroseven' ),
		                'param_name' => 'content',
		                'value' => esc_html__( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'ninezeroseven' )
		            ),
		            //Styling
		           	array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Heading Size', 'ninezeroseven' ),
		                'param_name'  => 'heading_size',
		                'description' => esc_html__( 'Font size for heading', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Styling', 'ninezeroseven' ),
		            ),
		            array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__( 'Heading Color', 'ninezeroseven' ),
						'param_name'  => 'heading_color',
						'description' => esc_html__( 'Heading color', 'ninezeroseven' ),
						'group'       => esc_html__( 'Styling', 'ninezeroseven' ),

		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Heading Margin Bottom', 'ninezeroseven' ),
		                'param_name'  => 'heading_margin_bottom',
		                // 'description' => esc_html__( 'Font size for heading', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Styling', 'ninezeroseven' ),
		            ),
		            array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__( 'Sub Heading Color', 'ninezeroseven' ),
						'param_name'  => 'sub_color',
						'description' => esc_html__( 'Sub Heading color', 'ninezeroseven' ),
						'group'       => esc_html__( 'Styling', 'ninezeroseven' ),

		            ),
		            array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__( 'Box background color', 'ninezeroseven' ),
						'param_name'  => 'background_color',
						'description' => esc_html__( 'This sets the background color for the boxed area', 'ninezeroseven' ),
						'group'       => esc_html__( 'Styling', 'ninezeroseven' ),

		            ),
		            array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__( 'Inner Content Font Color', 'ninezeroseven' ),
						'param_name'  => 'font_color',
						'description' => esc_html__( 'This can be overridden in editor when adding content below.', 'ninezeroseven' ),
						'group'       => esc_html__( 'Styling', 'ninezeroseven' ),

		            ),
		            //Padding
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Padding Top', 'ninezeroseven' ),
		                'param_name'  => 'p_top',
		                'description' => esc_html__( 'Padding top, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Padding', 'ninezeroseven' )
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Padding Bottom', 'ninezeroseven' ),
		                'param_name'  => 'p_bottom',
		                'description' => esc_html__( 'Padding bottom, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Padding', 'ninezeroseven' )
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Padding Left', 'ninezeroseven' ),
		                'param_name'  => 'p_left',
		                'description' => esc_html__( 'Padding Left, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Padding', 'ninezeroseven' )
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Padding Right', 'ninezeroseven' ),
		                'param_name'  => 'p_right',
		                'description' => esc_html__( 'Padding Right, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Padding', 'ninezeroseven' )
		            ),
		            //Margin
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Margin Top', 'ninezeroseven' ),
		                'param_name'  => 'm_top',
		                'description' => esc_html__( 'Margin top, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Margin', 'ninezeroseven' )
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Margin Bottom', 'ninezeroseven' ),
		                'param_name'  => 'm_bottom',
		                'description' => esc_html__( 'Margin bottom, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Margin', 'ninezeroseven' )
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Margin Left', 'ninezeroseven' ),
		                'param_name'  => 'm_left',
		                'description' => esc_html__( 'Margin Left, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Margin', 'ninezeroseven' )
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Margin Right', 'ninezeroseven' ),
		                'param_name'  => 'm_right',
		                'description' => esc_html__( 'Margin Right, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Margin', 'ninezeroseven' )
		            ),
		            array(
						"type"        => "dropdown",
						"class"       => "",
						"heading"     => esc_html__('Animation', 'ninezeroseven'),
						"description" => esc_html__('Animates section/object', 'ninezeroseven'),
						"param_name"  => "wbc_animation",
						"value"       => $wbc_animation_array,
						'group'       => esc_html__( 'Animation', 'ninezeroseven' )
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Animation Duration', 'ninezeroseven' ),
						'param_name'  => 'wbc_duration',
						'description' => esc_html__( 'Change the animation duration ie 4s', 'ninezeroseven' ),
						'dependency'  => array( 'element' => 'wbc_animation', 'not_empty' => true),
						'group'       => esc_html__( 'Animation', 'ninezeroseven' )
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Animation Delay', 'ninezeroseven' ),
						'param_name'  => 'wbc_delay',
						'description' => esc_html__( 'Delay before the animation starts ie 4s', 'ninezeroseven' ),
						'dependency'  => array( 'element' => 'wbc_animation', 'not_empty' => true),
						'group'       => esc_html__( 'Animation', 'ninezeroseven' )
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Animation offset', 'ninezeroseven' ),
						'param_name'  => 'wbc_offset',
						'description' => esc_html__( 'Distance to start the animation (related to the browser bottom) ie 10', 'ninezeroseven' ),
						'dependency'  => array( 'element' => 'wbc_animation', 'not_empty' => true),
						'group'       => esc_html__( 'Animation', 'ninezeroseven' )
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Animation Iteration', 'ninezeroseven' ),
						'param_name'  => 'wbc_iteration',
						'description' => esc_html__( 'Number of times the animation is repeated ie 4', 'ninezeroseven' ),
						'dependency'  => array( 'element' => 'wbc_animation', 'not_empty' => true),
						'group'       => esc_html__( 'Animation', 'ninezeroseven' )
					)

		    ),
		    //"js_view" => 'VcColumnView'
		) );

		// Heading Shortcode
		vc_map( array(
		    "name" => esc_html__('Heading', 'ninezeroseven'),
		    "base" => "wbc_heading",
		    "content_element" => true,
		    'icon' => 'icon-wpb-row',
		    "show_settings_on_create" => true,
		    'description' => esc_html__( 'Great for headings and page titles.', 'ninezeroseven' ),
		    'category' => esc_html__( '907 Additions', 'ninezeroseven' ),
		    "params" => array(
		            array(
		                'type'        => 'textarea',
		                'heading'     => esc_html__( 'Title', 'ninezeroseven' ),
		                'admin_label' => true,
		                'param_name'  => 'title',
		                'description' => esc_html__( 'Add text here, you can use | around words to turn into theme color ie "This is |GREAT| feature" and "Great" will be turned into theme primary color. Or use color option below.', 'ninezeroseven' ),
		            ),
		            array(
		                'type' => 'dropdown',
		                'heading' => esc_html__( 'Heading Tag', 'ninezeroseven' ),
		                'param_name' => 'tag',
		                'value' => array(
										esc_html__( 'Default', 'ninezeroseven' ) => '',
										esc_html__( 'H1', 'ninezeroseven' )      =>  'h1',
										esc_html__( 'H2', 'ninezeroseven' )      =>  'h2',
										esc_html__( 'H3', 'ninezeroseven' )      =>  'h3',
										esc_html__( 'H4', 'ninezeroseven' )      =>  'h4',
										esc_html__( 'H5', 'ninezeroseven' )      =>  'h5',
										esc_html__( 'H6', 'ninezeroseven' )      =>  'h6',
										esc_html__( 'DIV', 'ninezeroseven' )     =>  'div',

		                            ),
		                'std' => '',
		                'description' => esc_html__( 'H tag used for heading.', 'ninezeroseven' ),
		            ),
		            array(
		                'type' => 'dropdown',
		                'heading' => esc_html__( 'Heading Font Style', 'ninezeroseven' ),
		                'param_name' => 'heading_style',
		                'value' => array(
		                                esc_html__( 'Default', 'ninezeroseven' )     => '',
		                                esc_html__( 'Style 1', 'ninezeroseven' )     => 'heading-1',
		                                esc_html__( 'Style 2', 'ninezeroseven' )     => 'heading-2',
		                                esc_html__( 'Style 3', 'ninezeroseven' )     => 'heading-3',
		                                esc_html__( 'Style 4', 'ninezeroseven' )     => 'heading-4',
		                            ),
		                'std' => '',
		                'description' => esc_html__( 'Select heading styles, these can be set/overrode in Theme Options panel.', 'ninezeroseven' ),
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Font Size', 'ninezeroseven' ),
		                'param_name'  => 'font_size',
		                // 'description' => esc_html__( 'This sets the size for the icon.', 'ninezeroseven' ),
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Line Height', 'ninezeroseven' ),
		                'param_name'  => 'line_height',
		                // 'description' => esc_html__( 'This sets the size for the icon.', 'ninezeroseven' ),
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Letter Spacing', 'ninezeroseven' ),
		                'param_name'  => 'letter_spacing',
		                // 'description' => esc_html__( 'This sets the size for the icon.', 'ninezeroseven' ),
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Max Width', 'ninezeroseven' ),
		                'param_name'  => 'max_width',
		                'description' => esc_html__( 'Adds a max width to the heading.', 'ninezeroseven' ),
		            ),
		            array(
		                'type' => 'colorpicker',
		                'heading' => esc_html__( 'Piped Text Color', 'ninezeroseven' ),
		                'param_name' => 'wbc_color',
		                'description' => esc_html__( 'This will change the color of font between the pipes |text here| if used above.', 'ninezeroseven' ),

		            ),
		            array(
		                'type' => 'colorpicker',
		                'heading' => esc_html__( 'Text Color', 'ninezeroseven' ),
		                'param_name' => 'color',
		                'description' => esc_html__( 'Sets the color of your title.', 'ninezeroseven' ),

		            ),
		            array(
		                'type' => 'colorpicker',
		                'heading' => esc_html__( 'Background Color', 'ninezeroseven' ),
		                'param_name' => 'bg_color',
		                'description' => esc_html__( 'Adds background color to title.', 'ninezeroseven' ),

		            ),
		            array(
		                'type' => 'dropdown',
		                'heading' => esc_html__( 'Align', 'ninezeroseven' ),
		                'param_name' => 'align',
		                'value' => array(
		                                 esc_html__( 'Default', 'ninezeroseven' ) => '',
		                                 esc_html__( 'Left', 'ninezeroseven' )    => 'left',
		                                 esc_html__( 'Right', 'ninezeroseven' )   =>  'right',
		                                 esc_html__( 'Center', 'ninezeroseven' )  =>  'center',
		                            ),
		                'std' => '',
		                'description' => esc_html__( 'Align text.', 'ninezeroseven' ),
		            ),
		            //Padding
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Padding Top', 'ninezeroseven' ),
		                'param_name'  => 'p_top',
		                'description' => esc_html__( 'Padding top, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Padding', 'ninezeroseven' )
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Padding Bottom', 'ninezeroseven' ),
		                'param_name'  => 'p_bottom',
		                'description' => esc_html__( 'Padding bottom, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Padding', 'ninezeroseven' )
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Padding Left', 'ninezeroseven' ),
		                'param_name'  => 'p_left',
		                'description' => esc_html__( 'Padding Left, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Padding', 'ninezeroseven' )
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Padding Right', 'ninezeroseven' ),
		                'param_name'  => 'p_right',
		                'description' => esc_html__( 'Padding Right, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Padding', 'ninezeroseven' )
		            ),
		            //Margin
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Margin Top', 'ninezeroseven' ),
		                'param_name'  => 'm_top',
		                'description' => esc_html__( 'Margin top, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Margin', 'ninezeroseven' )
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Margin Bottom', 'ninezeroseven' ),
		                'param_name'  => 'm_bottom',
		                'description' => esc_html__( 'Margin bottom, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Margin', 'ninezeroseven' )
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Margin Left', 'ninezeroseven' ),
		                'param_name'  => 'm_left',
		                'description' => esc_html__( 'Margin Left, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Margin', 'ninezeroseven' )
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Margin Right', 'ninezeroseven' ),
		                'param_name'  => 'm_right',
		                'description' => esc_html__( 'Margin Right, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Margin', 'ninezeroseven' )
		            ),

		            //Font Options
		            array(
		                'type' => 'dropdown',
		                'heading' => esc_html__( 'Font Size For < 970 width', 'ninezeroseven' ),
		                'param_name' => 'md_font_size',
		                'value' => array(
		                                esc_html__( 'Default', 'ninezeroseven' ) => '',
		                                '70' =>  '70',
		                                '65' =>  '65',
		                                '60' =>  '60',
		                                '55' =>  '55',
		                                '50' =>  '50',
		                                '45' =>  '45',
		                                '40' =>  '40',
		                                '35' =>  '35',
		                                '30' =>  '30',
		                                '25' =>  '25',
		                                '20' =>  '20',
		                                '15' =>  '15',
		                            ),
		                'std' => '',
		                'description' => esc_html__( 'Sets font-size when screen width under 750. Please not this uses predefined css media queries.', 'ninezeroseven' ),
		            ),
		            array(
		                'type' => 'dropdown',
		                'heading' => esc_html__( 'Font Size For < 750 width', 'ninezeroseven' ),
		                'param_name' => 'sm_font_size',
		                'value' => array(
		                                esc_html__( 'Default', 'ninezeroseven' ) => '',
		                                '70' =>  '70',
		                                '65' =>  '65',
		                                '60' =>  '60',
		                                '55' =>  '55',
		                                '50' =>  '50',
		                                '45' =>  '45',
		                                '40' =>  '40',
		                                '35' =>  '35',
		                                '30' =>  '30',
		                                '25' =>  '25',
		                                '20' =>  '20',
		                                '15' =>  '15',
		                            ),
		                'std' => '',
		                'description' => esc_html__( 'Sets font-size when screen width under 750. Please not this uses predefined css media queries.', 'ninezeroseven' ),
		            ),
		            array(
		                'type' => 'dropdown',
		                'heading' => esc_html__( 'Font Size For < 480 width', 'ninezeroseven' ),
		                'param_name' => 'xs_font_size',
		                'value' => array(
		                                esc_html__( 'Default', 'ninezeroseven' ) => '',
		                                '70' =>  '70',
		                                '65' =>  '65',
		                                '60' =>  '60',
		                                '55' =>  '55',
		                                '50' =>  '50',
		                                '45' =>  '45',
		                                '40' =>  '40',
		                                '35' =>  '35',
		                                '30' =>  '30',
		                                '25' =>  '25',
		                                '20' =>  '20',
		                                '15' =>  '15',
		                            ),
		                'std' => '',
		                'description' => esc_html__( 'Sets font-size when screen width under 480. Please not this uses predefined css media queries.', 'ninezeroseven' ),
		            ),
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__('Animation', 'ninezeroseven'),
						"description" => esc_html__('Animates section/object', 'ninezeroseven'),
						"param_name" => "wbc_animation",
						"value" => $wbc_animation_array,
						'group'=> esc_html__( 'Animation', 'ninezeroseven' )
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Animation Duration', 'ninezeroseven' ),
						'param_name'  => 'wbc_duration',
						'description' => esc_html__( 'Change the animation duration ie 4s', 'ninezeroseven' ),
						'dependency'  => array( 'element' => 'wbc_animation', 'not_empty' => true),
						'group'       => esc_html__( 'Animation', 'ninezeroseven' )
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Animation Delay', 'ninezeroseven' ),
						'param_name'  => 'wbc_delay',
						'description' => esc_html__( 'Delay before the animation starts ie 4s', 'ninezeroseven' ),
						'dependency'  => array( 'element' => 'wbc_animation', 'not_empty' => true),
						'group'       => esc_html__( 'Animation', 'ninezeroseven' )
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Animation offset', 'ninezeroseven' ),
						'param_name'  => 'wbc_offset',
						'description' => esc_html__( 'Distance to start the animation (related to the browser bottom) ie 10', 'ninezeroseven' ),
						'dependency'  => array( 'element' => 'wbc_animation', 'not_empty' => true),
						'group'       => esc_html__( 'Animation', 'ninezeroseven' )
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Animation Iteration', 'ninezeroseven' ),
						'param_name'  => 'wbc_iteration',
						'description' => esc_html__( 'Number of times the animation is repeated ie 4', 'ninezeroseven' ),
						'dependency'  => array( 'element' => 'wbc_animation', 'not_empty' => true),
						'group'       => esc_html__( 'Animation', 'ninezeroseven' )
					)
		            

		    ),
		    //"js_view" => 'VcColumnView'
		) );
		
		// CountUp
		vc_map( array(
		    "name" => esc_html__('CountUp', 'ninezeroseven'),
		    "base" => "wbc_countup",
		    "content_element" => true,
		    'icon' => 'icon-wpb-row',
		    "show_settings_on_create" => true,
		    'description' => esc_html__( 'Animated counter.', 'ninezeroseven' ),
		    'category' => esc_html__( '907 Additions', 'ninezeroseven' ),
		    "params" => array(
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Count From', 'ninezeroseven' ),
		                'admin_label' => true,
		                'param_name'  => 'count_from',
		                'description' => esc_html__( 'Number you\'d to count from', 'ninezeroseven' ),
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Count To', 'ninezeroseven' ),
		                'admin_label' => true,
		                'param_name'  => 'count_to',
		                'description' => esc_html__( 'Number you\'d to count to', 'ninezeroseven' ),
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Count Speed', 'ninezeroseven' ),
		                'admin_label' => true,
		                'param_name'  => 'count_speed',
		                'description' => esc_html__( 'How fast to count', 'ninezeroseven' ),
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Count Interval', 'ninezeroseven' ),
		                'admin_label' => true,
		                'param_name'  => 'interval',
		                'description' => esc_html__( 'How often to change number when counting.', 'ninezeroseven' ),
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Delimiter', 'ninezeroseven' ),
		                'admin_label' => true,
		                'param_name'  => 'delimiter',
		                'description' => esc_html__( 'Adds delimiter i.e "," adds comma to number "2,300"', 'ninezeroseven' ),
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Content Before', 'ninezeroseven' ),
		                'admin_label' => true,
		                'param_name'  => 'before',
		                'description' => esc_html__( 'Add something before number, ie $ will add to number $2300', 'ninezeroseven' ),
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Content After', 'ninezeroseven' ),
		                'admin_label' => true,
		                'param_name'  => 'after',
		                'description' => esc_html__( 'Add something after number, ie K will add to number 2300K', 'ninezeroseven' ),
		            ),
		            array(
		                'type' => 'dropdown',
		                'heading' => esc_html__( 'Heading Font Style', 'ninezeroseven' ),
		                'param_name' => 'heading_style',
		                'value' => array(
		                                esc_html__( 'Default', 'ninezeroseven' )     => '',
		                                esc_html__( 'Style 1', 'ninezeroseven' )     => 'heading-1',
		                                esc_html__( 'Style 2', 'ninezeroseven' )     => 'heading-2',
		                                esc_html__( 'Style 3', 'ninezeroseven' )     => 'heading-3',
		                                esc_html__( 'Style 4', 'ninezeroseven' )     => 'heading-4',
		                            ),
		                'std' => '',
		                'description' => esc_html__( 'Select heading styles, these can be set/overrode in Theme Options panel.', 'ninezeroseven' ),
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Font Size', 'ninezeroseven' ),
		                'param_name'  => 'font_size',
		                // 'description' => esc_html__( 'This sets the size for the icon.', 'ninezeroseven' ),
		            ),
		            array(
		                'type' => 'colorpicker',
		                'heading' => esc_html__( 'Text Color', 'ninezeroseven' ),
		                'param_name' => 'color',
		                'description' => esc_html__( 'Use to change the color.', 'ninezeroseven' ),

		            ),
		            //Margin
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Margin Top', 'ninezeroseven' ),
		                'param_name'  => 'm_top',
		                'description' => esc_html__( 'Margin top, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Margin', 'ninezeroseven' )
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Margin Bottom', 'ninezeroseven' ),
		                'param_name'  => 'm_bottom',
		                'description' => esc_html__( 'Margin bottom, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Margin', 'ninezeroseven' )
		            ),
		    ),
		    //"js_view" => 'VcColumnView'
		) );

		// Progress Bar
		vc_map( array(
		    "name" => esc_html__('Progress Bar', 'ninezeroseven'),
		    "base" => "wbc_progress",
		    "content_element" => true,
		    'icon' => 'icon-wpb-row',
		    "show_settings_on_create" => true,
		    'description' => esc_html__( 'Progress Bar.', 'ninezeroseven' ),
		    'category' => esc_html__( '907 Additions', 'ninezeroseven' ),
		    "params" => array(
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Title', 'ninezeroseven' ),
		                'admin_label' => true,
		                'param_name'  => 'title',
		                'description' => esc_html__( 'Title to appear above progress bar', 'ninezeroseven' ),
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Percent', 'ninezeroseven' ),
		                'param_name'  => 'percent',
		                'description' => esc_html__( 'Enter a percenatage ie 54', 'ninezeroseven' ),
		            ),
		            //Styling
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Title Font Size', 'ninezeroseven' ),
		                'param_name'  => 'title_font_size',
		                'description' => esc_html__( 'Font size for title.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Styling', 'ninezeroseven' )
		            ),
		            array(
		                'type' => 'colorpicker',
		                'heading' => esc_html__( 'Title Color', 'ninezeroseven' ),
		                'param_name' => 'title_color',
		                'description' => esc_html__( 'Change title color', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Styling', 'ninezeroseven' )

		            ),
		             array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Percentage Font Size', 'ninezeroseven' ),
		                'param_name'  => 'percent_font_size',
		                'description' => esc_html__( 'Font size for percentage', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Styling', 'ninezeroseven' )
		            ),
		            array(
		                'type' => 'colorpicker',
		                'heading' => esc_html__( 'Percentage Color', 'ninezeroseven' ),
		                'param_name' => 'percent_color',
		                'description' => esc_html__( 'Change percentage text color', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Styling', 'ninezeroseven' )

		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Progress Height', 'ninezeroseven' ),
		                'param_name'  => 'bar_height',
		                'description' => esc_html__( 'Height of progress bar.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Styling', 'ninezeroseven' )
		            ),

		            array(
		                'type' => 'colorpicker',
		                'heading' => esc_html__( 'Progress Bar Color', 'ninezeroseven' ),
		                'param_name' => 'bar_color',
		                'description' => esc_html__( 'Change progress bar color', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Styling', 'ninezeroseven' )

		            ),
		            array(
		                'type' => 'colorpicker',
		                'heading' => esc_html__( 'Progress Bar BG Color', 'ninezeroseven' ),
		                'param_name' => 'bg_color',
		                'description' => esc_html__( 'Change progress bar background color', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Styling', 'ninezeroseven' )

		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Percentage Bar Spacing', 'ninezeroseven' ),
		                'param_name'  => 'bg_spacing',
		                'description' => esc_html__( 'Adds spacing between background and progress bar', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Styling', 'ninezeroseven' )
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Percentage Bar Radius', 'ninezeroseven' ),
		                'param_name'  => 'border_radius',
		                'description' => esc_html__( 'Add a border radius', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Styling', 'ninezeroseven' )
		            ),


		            
		    ),
		    //"js_view" => 'VcColumnView'
		) );

		// Quote
		vc_map( array(
		    "name" => esc_html__('Quote', 'ninezeroseven'),
		    "base" => "wbc_quote",
		    "content_element" => true,
		    'icon' => 'icon-wpb-row',
		    "show_settings_on_create" => true,
		    'description' => esc_html__( 'Styled quote block', 'ninezeroseven' ),
		    'category' => esc_html__( '907 Additions', 'ninezeroseven' ),
		    "params" => array(
		            array(
		                'type'        => 'textarea',
		                'heading'     => esc_html__( 'Quote', 'ninezeroseven' ),
		                'param_name'  => 'quote_message',
		                'description' => esc_html__( 'Add text here, you can use | around words to turn into theme color ie "This is |GREAT| feature" and "Great" will be turned into theme primary color. Or use color option below.', 'ninezeroseven' ),
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Credit', 'ninezeroseven' ),
		                'param_name'  => 'quote_credit',
		                'admin_label' => true,
		                'description' => esc_html__( 'Credit this quote', 'ninezeroseven' ),
		            ),
		            array(
		                'type' => 'dropdown',
		                'heading' => esc_html__( 'Heading Font Style', 'ninezeroseven' ),
		                'param_name' => 'heading_style',
		                'value' => array(
		                                esc_html__( 'Default', 'ninezeroseven' )     => '',
		                                esc_html__( 'Style 1', 'ninezeroseven' )     => 'heading-1',
		                                esc_html__( 'Style 2', 'ninezeroseven' )     => 'heading-2',
		                                esc_html__( 'Style 3', 'ninezeroseven' )     => 'heading-3',
		                                esc_html__( 'Style 4', 'ninezeroseven' )     => 'heading-4',
		                            ),
		                'std' => '',
		                'description' => esc_html__( 'Select heading styles, these can be set/overrode in Theme Options panel.', 'ninezeroseven' ),
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Font Size', 'ninezeroseven' ),
		                'param_name'  => 'font_size',
		                // 'description' => esc_html__( 'This sets the size for the icon.', 'ninezeroseven' ),
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Line Height', 'ninezeroseven' ),
		                'param_name'  => 'line_height',
		                // 'description' => esc_html__( 'This sets the size for the icon.', 'ninezeroseven' ),
		            ),
		            array(
		                'type' => 'colorpicker',
		                'heading' => esc_html__( 'Quote Text Color', 'ninezeroseven' ),
		                'param_name' => 'quote_color',
		                'description' => esc_html__( 'This changes the color of the quote text.', 'ninezeroseven' ),

		            ),
		            array(
		                'type' => 'colorpicker',
		                'heading' => esc_html__( 'Credit Text Color', 'ninezeroseven' ),
		                'param_name' => 'credit_color',
		                'description' => esc_html__( 'This changes the color of the credit text.', 'ninezeroseven' ),

		            ),
		            array(
		                'type' => 'colorpicker',
		                'heading' => esc_html__( 'Piped Text Color', 'ninezeroseven' ),
		                'param_name' => 'wbc_color',
		                'description' => esc_html__( 'This will change the color of font between the pipes |text here| if used above.', 'ninezeroseven' ),

		            ),
		            
		    ),
		    //"js_view" => 'VcColumnView'
		) );

		// Team
		vc_map( array(
		    "name" => esc_html__('Team Box', 'ninezeroseven'),
		    "base" => "wbc_team_box",
		    "content_element" => true,
		    'icon' => 'icon-wpb-row',
		    "show_settings_on_create" => true,
		    'description' => esc_html__( 'Add a boxed background.', 'ninezeroseven' ),
		    "as_parent" => array('only' => 'wbc_icon'),
		    "controls" => "full",
		    'category' => esc_html__( '907 Additions', 'ninezeroseven' ),
		    "params" => array(

		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Name', 'ninezeroseven' ),
		                'admin_label' => true,
		                'param_name'  => 'member_name',
		                'description' => esc_html__( 'Add text here, you can use | around words to turn into theme color ie "This is |GREAT| feature" and "Great" will be turned into theme primary color. Or use color option below.', 'ninezeroseven' ),
		            ),

		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Position', 'ninezeroseven' ),
		                'admin_label' => true,
		                'param_name'  => 'member_position',
		                'description' => esc_html__( 'Add members role/position', 'ninezeroseven' ),
		            ),

		            array(
		                'type' => 'attach_image',
		                'heading' => esc_html__( 'Member Image', 'ninezeroseven' ),
		                'param_name' => 'team_image',
		                'description' => esc_html__( 'Attach image to be displayed', 'ninezeroseven' ),

		            ),
		            array(
		                'type' => 'dropdown',
		                'heading' => esc_html__( 'Image Size', 'ninezeroseven' ),
		                'param_name' => 'img_size',
		                'value' => $wbc_image_sizes,
		                'std' => 'square',
		                'description' => esc_html__( 'Just some extra element options ;)', 'ninezeroseven' ),
		            ),
		            array(
		                'type' => 'textarea',
		                'holder' => 'div',
		                'heading' => esc_html__( 'Member Text', 'ninezeroseven' ),
		                'description' => esc_html__( 'HTML may cause this field to now show.', 'ninezeroseven' ),
		                'param_name' => 'member_info',
		                'value' => esc_html__( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'ninezeroseven' )
		            ),
		            array(
		                'type' => 'colorpicker',
		                'heading' => esc_html__( 'Member Name Color', 'ninezeroseven' ),
		                'param_name' => 'heading_color',
		                'description' => esc_html__( 'Changes Color of the member name', 'ninezeroseven' ),

		            ),
		            array(
		                'type' => 'colorpicker',
		                'heading' => esc_html__( 'Member Text Color', 'ninezeroseven' ),
		                'param_name' => 'font_color',
		                'description' => esc_html__( 'Chages description/bio text color.', 'ninezeroseven' ),

		            ),


		    ),
		    "js_view" => 'VcColumnView'
		) );

		if(class_exists('WPBakeryShortCodesContainer'))
		{
		    class WPBakeryShortCode_Wbc_Team_box extends WPBakeryShortCodesContainer {

		    }
		}

		// Featured Content
		vc_map( array(
		    "name" => esc_html__('Featured Content', 'ninezeroseven'),
		    "base" => "wbc_featured_content",
		    "content_element" => true,
		    "show_settings_on_create" => false,
		    'icon' => 'icon-wpb-row',
		    'description' => esc_html__( 'Displays featured content. Use on single post pages.', 'ninezeroseven' ),
		    'category' => esc_html__( '907 Additions', 'ninezeroseven' ),
		    "params" => array(
		            array(
		                'type' => 'dropdown',
		                'heading' => esc_html__( 'Image Size', 'ninezeroseven' ),
		                'param_name' => 'img_size',
		                'value' => $wbc_image_sizes,
		                'std' => 'post-848-image',
		                'description' => esc_html__( 'List of available image sizes. only used if gallery or featured image', 'ninezeroseven' ),
		            ),

		    ),
		    // "js_view" => 'VcColumnView'
		) );

		// Color Box
		vc_map( array(
		    "name" => esc_html__('Color Box', 'ninezeroseven'),
		    "base" => "wbc_color_box",
		    "content_element" => true,
		    'icon' => 'icon-wpb-row',
		    "show_settings_on_create" => true,
		    'description' => esc_html__( 'Add a boxed background.', 'ninezeroseven' ),
		    "as_parent" => array('except' => 'wbc_color_box'),
		    "controls" => "full",
		    'category' => esc_html__( '907 Additions', 'ninezeroseven' ),
		    "params" => array(
		            array(
		                'type' => 'dropdown',
		                'heading' => esc_html__( 'Align Content', 'ninezeroseven' ),
		                'param_name' => 'align',
		                'value' => array(
		                                esc_html__( 'Left', 'ninezeroseven' ) => '',
		                                esc_html__( 'Right', 'ninezeroseven' ) =>  'right',
		                                esc_html__( 'Center', 'ninezeroseven' ) =>  'center',
		                            ),
		                'description' => esc_html__( 'Aligns content within the box.', 'ninezeroseven' ),
		            ),
		            array(
		                'type' => 'colorpicker',
		                'heading' => esc_html__( 'Background Color', 'ninezeroseven' ),
		                'param_name' => 'bg_color',
		                'description' => esc_html__( 'Box background color option.', 'ninezeroseven' ),

		            ),
		            array(
		                'type' => 'colorpicker',
		                'heading' => esc_html__( 'Font Color', 'ninezeroseven' ),
		                'param_name' => 'color',
		                'description' => esc_html__( 'Font color of text within the box.', 'ninezeroseven' ),

		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Border Radius', 'ninezeroseven' ),
		                'param_name'  => 'border_radius',
		                'description' => esc_html__( 'Can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                // 'group'       => esc_html__( 'Styling', 'ninezeroseven' )
		            ),
		            array(
		                'type' => 'dropdown',
		                'heading' => esc_html__( 'Border Style', 'ninezeroseven' ),
		                'param_name' => 'border_style',
		                'value' => array(
										esc_html__( 'None', 'ninezeroseven' )   => '',
										esc_html__( 'Solid', 'ninezeroseven' )  =>  'solid',
										esc_html__( 'Dotted', 'ninezeroseven' ) =>  'dotted',
										esc_html__( 'Dashed', 'ninezeroseven' ) =>  'dashed',
		                            ),
		                'description' => esc_html__( 'Select the border style you\'d like.', 'ninezeroseven' ),
		            ),
		            array(
		                'type' => 'colorpicker',
		                'heading' => esc_html__( 'Border Color', 'ninezeroseven' ),
		                'param_name' => 'border_color',
		                'description' => esc_html__( 'Color you want you\'re border', 'ninezeroseven' ),

		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Border Width', 'ninezeroseven' ),
		                'param_name'  => 'border_width',
		                'description' => esc_html__( 'Can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                // 'group'       => esc_html__( 'Styling', 'ninezeroseven' )
		            ),

		            //Padding
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Padding Top', 'ninezeroseven' ),
		                'param_name'  => 'p_top',
		                'description' => esc_html__( 'Padding top, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Padding', 'ninezeroseven' )
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Padding Bottom', 'ninezeroseven' ),
		                'param_name'  => 'p_bottom',
		                'description' => esc_html__( 'Padding bottom, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Padding', 'ninezeroseven' )
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Padding Left', 'ninezeroseven' ),
		                'param_name'  => 'p_left',
		                'description' => esc_html__( 'Padding Left, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Padding', 'ninezeroseven' )
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Padding Right', 'ninezeroseven' ),
		                'param_name'  => 'p_right',
		                'description' => esc_html__( 'Padding Right, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Padding', 'ninezeroseven' )
		            ),
		            //Margin
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Margin Top', 'ninezeroseven' ),
		                'param_name'  => 'm_top',
		                'description' => esc_html__( 'Margin top, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Margin', 'ninezeroseven' )
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Margin Bottom', 'ninezeroseven' ),
		                'param_name'  => 'm_bottom',
		                'description' => esc_html__( 'Margin bottom, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Margin', 'ninezeroseven' )
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Margin Left', 'ninezeroseven' ),
		                'param_name'  => 'm_left',
		                'description' => esc_html__( 'Margin Left, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Margin', 'ninezeroseven' )
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Margin Right', 'ninezeroseven' ),
		                'param_name'  => 'm_right',
		                'description' => esc_html__( 'Margin Right, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Margin', 'ninezeroseven' )
		            ),
		            array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__('Animation', 'ninezeroseven'),
						"description" => esc_html__('Animates section/object', 'ninezeroseven'),
						"param_name" => "wbc_animation",
						"value" => $wbc_animation_array,
						'group'                   => esc_html__( 'Animation', 'ninezeroseven' )
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Animation Duration', 'ninezeroseven' ),
						'param_name'  => 'wbc_duration',
						'description' => esc_html__( 'Change the animation duration ie 4s', 'ninezeroseven' ),
						'dependency'  => array( 'element' => 'wbc_animation', 'not_empty' => true),
						'group'       => esc_html__( 'Animation', 'ninezeroseven' )
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Animation Delay', 'ninezeroseven' ),
						'param_name'  => 'wbc_delay',
						'description' => esc_html__( 'Delay before the animation starts ie 4s', 'ninezeroseven' ),
						'dependency'  => array( 'element' => 'wbc_animation', 'not_empty' => true),
						'group'       => esc_html__( 'Animation', 'ninezeroseven' )
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Animation offset', 'ninezeroseven' ),
						'param_name'  => 'wbc_offset',
						'description' => esc_html__( 'Distance to start the animation (related to the browser bottom) ie 10', 'ninezeroseven' ),
						'dependency'  => array( 'element' => 'wbc_animation', 'not_empty' => true),
						'group'       => esc_html__( 'Animation', 'ninezeroseven' )
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Animation Iteration', 'ninezeroseven' ),
						'param_name'  => 'wbc_iteration',
						'description' => esc_html__( 'Number of times the animation is repeated ie 4', 'ninezeroseven' ),
						'dependency'  => array( 'element' => 'wbc_animation', 'not_empty' => true),
						'group'       => esc_html__( 'Animation', 'ninezeroseven' )
					)

		    ),
		    "js_view" => 'VcColumnView'
		) );

		if(class_exists('WPBakeryShortCodesContainer'))
		{
		    class WPBakeryShortCode_Wbc_Color_Box extends WPBakeryShortCodesContainer {

		    }
		}

		// Button
		vc_map( array(
			"name"                    => esc_html__('Button', 'ninezeroseven'),
			"base"                    => "wbc_button",
			'icon'                    => 'icon-wpb-row',
			"show_settings_on_create" => true,
			'description'             => esc_html__( 'Button', 'ninezeroseven' ),
			'category'                => esc_html__( '907 Additions', 'ninezeroseven' ),
			"params"                  => array(
		            array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Button Text', 'ninezeroseven' ),
						'param_name'  => 'button_text',
						'description' => esc_html__( 'Can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
						'admin_label' => true,
						'std'         => esc_html__('Button Text','ninezeroseven')
		            ),
		            array(
		                'type'        => 'vc_link',
		                'heading'     => esc_html__( 'Link', 'ninezeroseven' ),
		                'param_name'  => 'link',
		                'description' => esc_html__( 'If you\'d like the icon linked', 'ninezeroseven' ),
		            ),
		            array(
		                'type'       => 'dropdown',
		                'heading'    => esc_html__( 'Align Button', 'ninezeroseven' ),
		                'param_name' => 'align_button',
		                'value'      => array(
		                                esc_html__( 'Default', 'ninezeroseven' ) => '',
		                                esc_html__( 'Left', 'ninezeroseven' )    =>  'left',
		                                esc_html__( 'Center', 'ninezeroseven' )  =>  'center',
		                                esc_html__( 'Right', 'ninezeroseven' )   =>  'right',
		                            ),
		                // 'description' => esc_html__( '', 'ninezeroseven' ),
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Font Size', 'ninezeroseven' ),
		                'param_name'  => 'font_size',
		                'description' => esc_html__( 'Can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                // 'group'       => esc_html__( 'Styling', 'ninezeroseven' )
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Line Height', 'ninezeroseven' ),
		                'param_name'  => 'line_height',
		                'description' => esc_html__( 'Can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                // 'group'       => esc_html__( 'Styling', 'ninezeroseven' )
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Button Width', 'ninezeroseven' ),
		                'param_name'  => 'width',
		                'description' => esc_html__( 'Can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                // 'group'       => esc_html__( 'Styling', 'ninezeroseven' )
		            ),
		            array(
		                'type' => 'colorpicker',
		                'heading' => esc_html__( 'Background Color', 'ninezeroseven' ),
		                'param_name' => 'bg_color',
		                'description' => esc_html__( 'Button background color', 'ninezeroseven' ),

		            ),
		            array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__( 'Font Color', 'ninezeroseven' ),
						'param_name'  => 'color',
						'description' => esc_html__( 'Font color of text within the button.', 'ninezeroseven' ),

		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Border Radius', 'ninezeroseven' ),
		                'param_name'  => 'border_radius',
		                'description' => esc_html__( 'Can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                // 'group'       => esc_html__( 'Styling', 'ninezeroseven' )
		            ),
		            array(
		                'type'        => 'colorpicker',
		                'heading'     => esc_html__( 'Border Color', 'ninezeroseven' ),
		                'param_name'  => 'border_color',
		                'description' => esc_html__( 'Color you want border', 'ninezeroseven' ),

		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Border Width', 'ninezeroseven' ),
		                'param_name'  => 'border_width',
		                'description' => esc_html__( 'Can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                // 'group'       => esc_html__( 'Styling', 'ninezeroseven' )
		            ),

		            //Hover
		            array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__( 'Font Color', 'ninezeroseven' ),
						'param_name'  => 'hover_color',
						'description' => esc_html__( 'Font color of text within the button.', 'ninezeroseven' ),
						'group'       => esc_html__( 'Hover', 'ninezeroseven' )

		            ),
		            array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__( 'Background Color', 'ninezeroseven' ),
						'param_name'  => 'hover_bg_color',
						'description' => esc_html__( 'Hover background color.', 'ninezeroseven' ),
						'group'       => esc_html__( 'Hover', 'ninezeroseven' )

		            ),
		            array(
		                'type'        => 'colorpicker',
		                'heading'     => esc_html__( 'Border Color', 'ninezeroseven' ),
		                'param_name'  => 'hover_border_color',
		                'description' => esc_html__( 'Hover border color.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Hover', 'ninezeroseven' )

		            ),

		            //Padding
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Padding Top', 'ninezeroseven' ),
		                'param_name'  => 'padding_top',
		                'description' => esc_html__( 'Padding top, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Padding', 'ninezeroseven' )
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Padding Bottom', 'ninezeroseven' ),
		                'param_name'  => 'padding_bottom',
		                'description' => esc_html__( 'Padding bottom, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Padding', 'ninezeroseven' )
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Padding Left', 'ninezeroseven' ),
		                'param_name'  => 'padding_left',
		                'description' => esc_html__( 'Padding Left, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Padding', 'ninezeroseven' )
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Padding Right', 'ninezeroseven' ),
		                'param_name'  => 'padding_right',
		                'description' => esc_html__( 'Padding Right, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Padding', 'ninezeroseven' )
		            ),
		            //Margin
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Margin Top', 'ninezeroseven' ),
		                'param_name'  => 'margin_top',
		                'description' => esc_html__( 'Margin top, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Margin', 'ninezeroseven' )
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Margin Bottom', 'ninezeroseven' ),
		                'param_name'  => 'margin_bottom',
		                'description' => esc_html__( 'Margin bottom, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Margin', 'ninezeroseven' )
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Margin Left', 'ninezeroseven' ),
		                'param_name'  => 'margin_left',
		                'description' => esc_html__( 'Margin Left, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Margin', 'ninezeroseven' )
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Margin Right', 'ninezeroseven' ),
		                'param_name'  => 'margin_right',
		                'description' => esc_html__( 'Margin Right, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Margin', 'ninezeroseven' )
		            ),

		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Extra Class', 'ninezeroseven' ),
		                'param_name'  => 'el_class',
		                'description' => esc_html__( 'Can add extra classes here, use "scrollable" if you\'re wanting button to scroll to a page section when clicked.', 'ninezeroseven' ),
		                // 'group'       => esc_html__( 'Styling', 'ninezeroseven' )
		            ),

		    ),
		    // "js_view" => 'VcColumnView'
		) ); 
		
		// WBC HR
		vc_map( array(
		    "name" => esc_html__('Wbc HR', 'ninezeroseven'),
		    "base" => "wbc_hr",
		    'icon' => 'icon-wpb-row',
		    "show_settings_on_create" => true,
		    'description' => esc_html__( 'HR (line)', 'ninezeroseven' ),
		    'category' => esc_html__( '907 Additions', 'ninezeroseven' ),
		    "params" => array(
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Height', 'ninezeroseven' ),
		                'param_name'  => 'height',
		                'description' => esc_html__( 'Can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'HR Width', 'ninezeroseven' ),
		                'param_name'  => 'width',
		                'description' => esc_html__( 'Can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		            ),
		            array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__( 'Background Color', 'ninezeroseven' ),
						'param_name'  => 'bg_color',
						'description' => esc_html__( 'Background color', 'ninezeroseven' ),

		            ),
		       		//Margin
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Margin Top', 'ninezeroseven' ),
		                'param_name'  => 'm_top',
		                'description' => esc_html__( 'Margin top, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Margin', 'ninezeroseven' )
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Margin Bottom', 'ninezeroseven' ),
		                'param_name'  => 'm_bottom',
		                'description' => esc_html__( 'Margin bottom, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Margin', 'ninezeroseven' )
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Margin Left', 'ninezeroseven' ),
		                'param_name'  => 'm_left',
		                'description' => esc_html__( 'Margin Left, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Margin', 'ninezeroseven' )
		            ),
		            array(
		                'type'        => 'textfield',
		                'heading'     => esc_html__( 'Margin Right', 'ninezeroseven' ),
		                'param_name'  => 'm_right',
		                'description' => esc_html__( 'Margin Right, can use px,em,% if not defined will default to px.', 'ninezeroseven' ),
		                'group'       => esc_html__( 'Margin', 'ninezeroseven' )
		            ),

		    ),
		    // "js_view" => 'VcColumnView'
		) );

		// Pricing Table
		vc_map( array(
		    "name" => esc_html__('Pricing Table', 'ninezeroseven'),
		    "base" => "wbc_pricing",
		    // 'description' => esc_html__( 'Services', 'ninezeroseven' ),
		    'icon' => 'icon-wpb-row',
		    "content_element" => true,
		    'category' => esc_html__( '907 Additions', 'ninezeroseven' ),
		    "params" => array(
		        // add params same as with any other content element
		        array(
		            'type'        => 'textfield',
		            'heading'     => esc_html__( 'Title', 'ninezeroseven' ),
		            'admin_label' => true,
		            'param_name'  => 'title',
		            'value' => '<strong>Basic</strong> Plan',
		            'description' => esc_html__( 'Heading for Plan i.e Basic Plan', 'ninezeroseven' ),
		        ),
		        array(
		            'type'        => 'textfield',
		            'heading'     => esc_html__( 'Sub Title', 'ninezeroseven' ),
		            'param_name'  => 'per_title',
		            'value' => 'Per Month',
		            'description' => esc_html__( 'Adds line next to price, i.e Per Month', 'ninezeroseven' ),
		        ),
		        array(
		            'type'        => 'textfield',
		            'heading'     => esc_html__( 'Price', 'ninezeroseven' ),
		            'param_name'  => 'price',
		            'value' => '$49',
		            'description' => esc_html__( 'Set the price for this plan.', 'ninezeroseven' ),
		        ),
				array(
					'type' => 'textarea_html',
					// 'holder' => 'div',
					'heading' => esc_html__( 'Plan Options', 'ninezeroseven' ),
					'param_name' => 'content',
					'value' => '<ul><li>Unlimited Options</li><li><strong>Awesome</strong> Feature</li><li>Included</li><li>Something Else</li><li>60+ Days</li><li>Great Support</li></ul>',
					'description' => 'Add a UL list for plan options'
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Set As Featured?', 'ninezeroseven' ),
					'param_name' => 'featured',
					'description' => esc_html__( 'Adds featured state to plan', 'ninezeroseven' ),
					'value' => array( esc_html__( 'Yes, please', 'ninezeroseven' ) => 'yes' ),
				),
				array(
					'type'        => 'vc_link',
					'heading'     => esc_html__( 'Button Link', 'ninezeroseven' ),
					'param_name'  => 'link',
					'description' => esc_html__( 'If you\'d like the button linked', 'ninezeroseven' ),
				),
				
		    )
		) );

		// Chart
		vc_map( array(
			"name"            => esc_html__('Animated Chart', 'ninezeroseven'),
			"base"            => "wbc_chart",
			'icon'            => 'icon-wpb-row',
			"content_element" => true,
			'category'        => esc_html__( '907 Additions', 'ninezeroseven' ),
			"params"          => array(
		        // add params same as with any other content element
		        array(
		            'type'        => 'textfield',
		            'heading'     => esc_html__( 'Value', 'ninezeroseven' ),
		            'param_name'  => 'percent',
		            'description' => esc_html__( 'Enter the value you\' like to animate to, ie 86', 'ninezeroseven' ),
		        ),
		        array(
					'type'        => 'colorpicker',
					'heading'     => esc_html__( 'Track Color', 'ninezeroseven' ),
					'param_name'  => 'track_color',
					'description' => esc_html__( 'Track background color.', 'ninezeroseven' ),

		        ),
		        array(
					'type'        => 'colorpicker',
					'heading'     => esc_html__( 'Bar Color', 'ninezeroseven' ),
					'param_name'  => 'bar_color',
					'description' => esc_html__( 'Color or the animated bar', 'ninezeroseven' ),

		        ),
		        array(
		            'type'        => 'textfield',
		            'heading'     => esc_html__( 'Line Width', 'ninezeroseven' ),
		            'param_name'  => 'line_width',
		            'description' => esc_html__( 'Sets the width of the line, ie 7', 'ninezeroseven' ),
		        ),
		        array(
		            'type'        => 'textfield',
		            'heading'     => esc_html__( 'Graph Size', 'ninezeroseven' ),
		            'param_name'  => 'size',
		            'description' => esc_html__( 'Size of the animated graph, ie 200', 'ninezeroseven' ),
		        ),
		        array(
		            'type'        => 'textfield',
		            'heading'     => esc_html__( 'Ending Character', 'ninezeroseven' ),
		            'param_name'  => 'ending',
		            'description' => esc_html__( 'Adds to the end of the value, ie % will result in 86%', 'ninezeroseven' ),
		        ),
		        array(
		            'type'        => 'textfield',
		            'heading'     => esc_html__( 'Backing Size', 'ninezeroseven' ),
		            'param_name'  => 'backing_size',
		            'description' => esc_html__( 'Changes the size of the backing, enter 0 to hide', 'ninezeroseven' ),
		        ),
				array(
					'type'        => 'colorpicker',
					'heading'     => esc_html__( 'Backing Color', 'ninezeroseven' ),
					'param_name'  => 'backing_color',
					'description' => esc_html__( 'Color or the backing behide the value.', 'ninezeroseven' ),

		        ),
		        array(
					'type'        => 'colorpicker',
					'heading'     => esc_html__( 'Font Color', 'ninezeroseven' ),
					'param_name'  => 'font_color',
					'description' => esc_html__( 'Changes the font color.', 'ninezeroseven' ),

		        ),
		        array(
		            'type'        => 'textfield',
		            'heading'     => esc_html__( 'Font Size', 'ninezeroseven' ),
		            'param_name'  => 'font_size',
		            'description' => esc_html__( 'Changes the size of the font', 'ninezeroseven' ),
		        ),
		        array(
		            'type'        => 'textfield',
		            'heading'     => esc_html__( 'Margin Bottom', 'ninezeroseven' ),
		            'param_name'  => 'margin_bottom',
		            'description' => esc_html__( 'Margin Below Chart', 'ninezeroseven' ),
		        ),
				
		    )
		) );

	} // END wbc907_map_to_vc
	add_action( 'vc_before_init', 'wbc907_map_to_vc' );
} // END IF EXIST wbc907_map_to_vc

?>