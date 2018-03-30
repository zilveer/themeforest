<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Smart Carousel
 Description: Create carousels containing page builder elements
 Class: ZnSmartCarousel
 Category: content
 Level: 3
 Multiple: true
 Scripts: true
*/

class ZnSmartCarousel extends ZnElements
{
	public static function getName(){
		return __( "Smart Carousel", 'zn_framework' );
	}

	/**
	 * Load dependant resources
	 */
	function scripts(){
		wp_enqueue_script( 'caroufredsel', THEME_BASE_URI . '/addons/caroufredsel/jquery.carouFredSel-packed.js', array ( 'jquery' ), ZN_FW_VERSION, true );
	}

	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	// function css(){
	// 	$css = '';
	// 	$uid = $this->data['uid'];

	// 	return $css;
	// }

	/**
	 * This method is used to display the output of the element.
	 *
	 * @return void
	 */
	function element()
	{

		$options = $this->data['options'];

		if( empty ( $options['single_item'] ) ){
			return;
		}

		$opt_bullets = $this->opt('smc_bullets', 'yes');
		$opt_bullets_position = $this->opt('smc_bullets_position', 'bottom-center');

		$opt_nav = $this->opt('smc_nav', 'yes');
		$opt_nav_position = $this->opt('smc_nav_position', 'bottom-center');

		$bullets = '';
		if( $opt_bullets == 'yes'){
			$bullets = '<div class="znSmartCarousel-pagi cfs--pagination znSmartCarousel-bulletsPosition--'.$opt_bullets_position.'"></div>';
		}

		$navigation = '';
		if( $opt_nav == 'yes' ){

			$nav_classes = array();
			$nav_classes[] = 'znSmartCarousel-navPosition--'.$opt_nav_position;
			$nav_classes[] = 'znSmartCarousel-navStyle--'.$this->opt('smc_nav_style', 'default');

			$navigation = '<div class="znSmartCarousel-nav '. implode(' ', $nav_classes) .'">';

				$navigation .= '<span class="znSmartCarousel-arr znSmartCarousel-prev cfs--prev">';
					$navigation .= '<svg viewBox="0 0 256 256"><polyline fill="none" stroke="black" stroke-width="16" stroke-linejoin="round" stroke-linecap="round" points="184,16 72,128 184,240"/></svg>';
				$navigation .= '</span>';

				// if( $opt_nav_position == $opt_bullets_position ){
				// 	$navigation .= $bullets;
				// }

				$navigation .= '<span class="znSmartCarousel-arr znSmartCarousel-next cfs--next">';
				$navigation .= '<svg viewBox="0 0 256 256"><polyline fill="none" stroke="black" stroke-width="16" stroke-linejoin="round" stroke-linecap="round" points="72,16 184,128 72,240"/></svg>';
				$navigation .= '</span>';

			$navigation .= '</div>';
			$navigation .= '<div class="clearfix"></div>';
		}

		$elm_classes = array();
		$elm_classes[] = $uid = $this->data['uid'];
		$elm_classes[] = zn_get_element_classes($options);

		$elm_classes[] = $this->opt('smc_preloaded', 1) == 1 ? 'znSmartCarousel-hasPreloader' : '';
		$elm_classes[] = ZNPB()->is_active_editor ? 'znSmartCarouselMode--edit' : 'znSmartCarouselMode--view';

		$attributes = zn_get_element_attributes($options);

		// $color_scheme = $this->opt( 'element_scheme', '' ) == '' ? zget_option( 'zn_main_style', 'color_options', false, 'light' ) : $this->opt( 'element_scheme', '' );
		// $elm_classes[] = 'element-scheme--'.$color_scheme;

		$single_item = $this->opt('single_item');
		$itemCount = count($single_item);

		echo '<div class="znSmartCarousel '.implode(' ', $elm_classes).'" '.$attributes.'>';

		if ( ! empty ( $single_item ) && is_array( $single_item ) )
		{

			if($this->opt('smc_preloaded', 1) == 1){
				echo '<div class="znSmartCarousel-loadingContainer">';
			}

			$carousel_attributes[] = 'data-transition="'. $this->opt('smc_transition','fade').'"';
			$carousel_attributes[] = 'data-autoplay="'. $this->opt('smc_autoplay', 1) .'"';
			$carousel_attributes[] = 'data-timout="'. ( $this->opt('smc_speed', 6) * 1000 ) .'"';
			$carousel_attributes[] = 'data-easing="easeOutExpo"';
			$carousel_attributes[] = 'data-swipe-touch="'. $this->opt('smc_swipe_touch', 1) .'"';
			$carousel_attributes[] = 'data-swipe-mouse="'. $this->opt('smc_swipe_mouse', 1) .'"';
			$carousel_attributes[] = 'data-carousel-uid=".'. $uid .'"';

			if( $this->opt('smc_continuous', '') == 1){
				$carousel_attributes[] = 'data-continuous="'. $this->opt('smc_continuous_speed', '4000') .'"';
			}

			// Bullets / Pagination
			if( $opt_bullets == 'yes' && in_array($opt_bullets_position, array('top-left', 'top-center', 'top-right' )) ){
				echo $bullets;
			}

			// Navigation Arrows
			if( $opt_nav == 'yes' && in_array($opt_nav_position, array( 'top-left', 'top-center', 'top-right', 'middle' )) ){
				echo $navigation;
			}

			echo '<div class="znSmartCarousel-holder cfs--default " '.implode(' ', $carousel_attributes).'>';

				foreach($single_item as $i => $sitem)
				{
					$uniq_name = $uid.'_'.$i;
					$ic = $i+1;

					// Slide content
					echo '<div class="znSmartCarousel-item znSmartCarousel-item--'.$ic.' cfs--item" id="' . $uniq_name . '">';

						if ( ZNPB()->is_active_editor ){
							$slide_title = 'SLIDE '.$ic.(isset($sitem['smc_title']) && !empty($sitem['smc_title']) ? ' - '.$sitem['smc_title'] : '');
							echo '<div class="znSmartCarousel-PbModeHandler '.( $ic == 1 ? 'pbModeHandler--start':'' ).'" data-slide-title="'.$slide_title.'"></div>';
						}

						// Add complex page builder element
						echo '<div class="row znSmartCarousel-container zn_columns_container zn_content '.$this->opt('gutter_size','').'" data-droplevel="1">';
							if ( empty( $this->data['content'][$i] ) ) {
								$column = ZNPB()->add_module_to_layout( 'ZnColumn', array() , array(), 'col-sm-12' );
								$this->data['content'][$i] = array ( $column );
							}

							if ( !empty( $this->data['content'][$i] ) ) {
								// print_z($this);
								ZNPB()->zn_render_content( $this->data['content'][$i] );
							}
						echo '</div>';

						if ( ZNPB()->is_active_editor && $ic == $itemCount ){
							echo '<div class="znSmartCarousel-PbModeHandler pbModeHandler--end"></div>';
						}

					echo '</div>';
				}
			echo '</div>';


			// Bullets / Pagination
			if( $opt_bullets == 'yes' && in_array($opt_bullets_position, array( 'bottom-left', 'bottom-center', 'bottom-right' )) ){
				echo $bullets;
			}

			// Navigation Arrows
			if($opt_nav == 'yes' && in_array($opt_nav_position, array( 'bottom-left', 'bottom-center', 'bottom-right' )) ){
				echo $navigation;
			}

			if($this->opt('smc_preloaded', 1) == 1){
				echo '</div>';
				echo '<div class="znSmartCarousel-loading"></div>';
			}

			?>

			<div class="clearfix"></div>

<?php
		}
		echo '</div>';
	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$extra_options = array (
			"name"           => __( "Carousel Items", 'zn_framework' ),
			"description"    => __( "Here you can create your desired carousel items.", 'zn_framework' ),
			"id"             => "single_item",
			"std"            => "",
			"type"           => "group",
			"add_text"       => __( "Item", 'zn_framework' ),
			"remove_text"    => __( "Item", 'zn_framework' ),
			"group_sortable" => true,
			"element_title" => "smc_title",
			"subelements"    => array (
				array (
					"name"        => __( "Carousel Item Title", 'zn_framework' ),
					"description" => __( "Will be hidden, but please enter the desired title of a slide, mostly for visual guideline in these rows.", 'zn_framework' ),
					"id"          => "smc_title",
					"std"         => "",
					"type"        => "text"
				),
			)
		);

		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,

			'items' => array(
				'title' => 'Slides',
				'options' => array(

					$extra_options,

				),
			),

			'general' => array(
				'title' => 'Options',
				'options' => array(

					array (
						"name"        => __( "Slider Transition", 'zn_framework' ),
						"description" => __( "Select the desired transition that you want to use for this slider. VIEW MODE ONLY!", 'zn_framework' ),
						"id"          => "smc_transition",
						"std"         => "fade",
						"type"        => "zn_radio",
						"options"     => array (
							'fade'  => __( 'Fade', 'zn_framework' ),
							'crossfade'  => __( 'Cross Fade', 'zn_framework' ),
							'slide' => __( 'Slide', 'zn_framework' )
						),
					),

					array (
						"name"        => __( "Autoplay carousel?", 'zn_framework' ),
						"description" => __( "Does the carousel autoplay itself? VIEW MODE ONLY!", 'zn_framework' ),
						"id"          => "smc_autoplay",
						"std"         => "1",
						"value"         => "1",
						"type"        => "toggle2"
					),
					array (
						"name"        => __( "Autoplay Duration", 'zn_framework' ),
						"description" => __( "Adjust the speed between sliding timeout in seconds. VIEW MODE ONLY!", 'zn_framework' ),
						"id"          => "smc_speed",
						"std"         => "6",
						"type"        => "slider",
						'helpers'     => array(
							'step' => '1',
							'min' => '0',
							'max' => '25',
						),
						"dependency"  => array( 'element' => 'smc_autoplay' , 'value'=> array('1') ),
					),

					array (
						"name"        => __( "Arrows Navigation", 'zn_framework' ),
						"description" => __( "Display arrows navigation?", 'zn_framework' ),
						"id"          => "smc_nav",
						"std"         => "yes",
						"type"        => "zn_radio",
						"options"     => array (
							'yes'  => __( 'Yes', 'zn_framework' ),
							'no' => __( 'No', 'zn_framework' )
						),
						"class" => "zn_radio--yesno",
					),

					array (
						"name"        => __( "Arrows Navigation Style", 'zn_framework' ),
						"description" => __( "Select a style for the navigation", 'zn_framework' ),
						"id"          => "smc_nav_style",
						"std"         => "default",
						"type"        => "select",
						"options"     => array (
							'default'  => __( 'Default (minimal)', 'zn_framework' ),
							's1' => __( 'Style #1 (Bigger arrows)', 'zn_framework' ),
							// 's2' => __( 'Style #2 (with background)', 'zn_framework' ),
							// 's3' => __( 'Style #3', 'zn_framework' ),
							// 's4' => __( 'Style #4', 'zn_framework' ),
							// 's5' => __( 'Style #5', 'zn_framework' ),
							// 's6' => __( 'Style #6', 'zn_framework' ),
						),
						"dependency"  => array( 'element' => 'smc_nav' , 'value'=> array('yes') ),
					),

					array (
						"name"        => __( "Arrows Navigation Position", 'zn_framework' ),
						"description" => __( "Select the position of the Arrows", 'zn_framework' ),
						"id"          => "smc_nav_position",
						"std"         => "bottom-center",
						"type"        => "select",
						"options"     => array (
							'top-left'  => __( 'Top Left', 'zn_framework' ),
							'top-center' => __( 'Top Center', 'zn_framework' ),
							'top-right' => __( 'Top Right', 'zn_framework' ),
							'middle' => __( 'Vertically Middle', 'zn_framework' ),
							'bottom-left' => __( 'Bottom Left', 'zn_framework' ),
							'bottom-center' => __( 'Bottom Center', 'zn_framework' ),
							'bottom-right' => __( 'Bottom Right', 'zn_framework' ),
						),
						"dependency"  => array(
							array( 'element' => 'smc_nav' , 'value'=> array('yes') ),
							array( 'element' => 'smc_nav_style' , 'value'=> array('default', 's1') ),
						),
					),

					array (
						"name"        => __( "Slider Bullets", 'zn_framework' ),
						"description" => __( "Display navigation bullets? VIEW MODE ONLY!", 'zn_framework' ),
						"id"          => "smc_bullets",
						"std"         => "yes",
						"type"        => "zn_radio",
						"options"     => array (
							'yes'  => __( 'Yes', 'zn_framework' ),
							'no' => __( 'No', 'zn_framework' )
						),
						"class" => "zn_radio--yesno",
					),

					array (
						"name"        => __( "Bullets Navigation Position", 'zn_framework' ),
						"description" => __( "Select the position of the bullets. VIEW MODE ONLY!", 'zn_framework' ),
						"id"          => "smc_bullets_position",
						"std"         => "bottom-center",
						"type"        => "select",
						"options"     => array (
							'top-left'  => __( 'Top Left', 'zn_framework' ),
							'top-center' => __( 'Top Center', 'zn_framework' ),
							'top-right' => __( 'Top Right', 'zn_framework' ),
							'bottom-left' => __( 'Bottom Left', 'zn_framework' ),
							'bottom-center' => __( 'Bottom Center', 'zn_framework' ),
							'bottom-right' => __( 'Bottom Right', 'zn_framework' ),
						),
						"dependency"  => array( 'element' => 'smc_bullets' , 'value'=> array('yes') ),
					),

					array (
						"name"        => __( "Swipe on touch?", 'zn_framework' ),
						"description" => __( "Enable swipe on touch. Applies to mobile devices or laptops/monitors with touchscreen. VIEW MODE ONLY!", 'zn_framework' ),
						"id"          => "smc_swipe_touch",
						"std"         => "1",
						"value"         => "1",
						"type"        => "toggle2"
					),

					array (
						"name"        => __( "Swipe on mouse?", 'zn_framework' ),
						"description" => __( "Enable swipe on mouse drag. Applies generally to desktop normal computers using a mouse. VIEW MODE ONLY!", 'zn_framework' ),
						"id"          => "smc_swipe_mouse",
						"std"         => "1",
						"value"         => "1",
						"type"        => "toggle2"
					),

					array (
						"name"        => __( "Enable preloader?", 'zn_framework' ),
						"description" => __( "Enable if you want a preloader to be displayed until loaded. VIEW MODE ONLY!", 'zn_framework' ),
						"id"          => "smc_preloaded",
						"std"         => "1",
						"value"         => "1",
						"type"        => "toggle2"
					),

					array (
						"name"        => __( "Enable continuously scrolling?", 'zn_framework' ),
						"description" => __( "Enable if you want a continuously scrolling carousel immediately stopping onMouseOver. VIEW MODE ONLY!", 'zn_framework' ),
						"id"          => "smc_continuous",
						"std"         => "",
						"value"         => "1",
						"type"        => "toggle2"
					),

					array (
						"name"        => __( "Continuously scroll speed", 'zn_framework' ),
						"description" => __( "Add the speed in milliseconds. For example 1 second = 1000 milliseconds. VIEW MODE ONLY!", 'zn_framework' ),
						"id"          => "smc_continuous_speed",
						"std"         => "4000",
						"type"        => "text",
						"dependency"  => array( 'element' => 'smc_continuous' , 'value'=> array('1') ),
					),

				),
			),

			'advanced' => array(
				'title' => 'Advanced',
				'options' => array(

					array(
						'id'          => 'gutter_size',
						'name'        => 'Gutter Size',
						'description' => 'Select the gutter distance between columns',
						"std"         => "",
						"type"        => "select",
						"options"     => array (
							'' => __( 'Default (15px)', 'zn_framework' ),
							'gutter-xs' => __( 'Extra Small (5px)', 'zn_framework' ),
							'gutter-sm' => __( 'Small (10px)', 'zn_framework' ),
							'gutter-md' => __( 'Medium (25px)', 'zn_framework' ),
							'gutter-lg' => __( 'Large (40px)', 'zn_framework' ),
							'gutter-0' => __( 'No distance - 0px', 'zn_framework' ),
						),
						'live' => array(
							'type'      => 'class',
							'css_class' => '.'.$uid.' .znSmartCarousel-container.row'
						)
					),

				),
			),

			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/',
				'docs'    => 'http://support.hogash.com/documentation/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}
