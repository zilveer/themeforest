<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Testimonial Fader
 Description: Create and display a Testimonial Fader element
 Class: TH_TestimonialFader
 Category: content
 Level: 3
 Scripts: true
*/
/**
 * Class TH_TestimonialFader
 *
 * Create and display a Testimonial Fader element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_TestimonialFader extends ZnElements
{
	public static function getName(){
		return __( "Testimonial Fader", 'zn_framework' );
	}

	/**
	 * Load dependant resources
	 */
	function scripts(){
		wp_enqueue_script( 'caroufredsel', THEME_BASE_URI . '/addons/caroufredsel/jquery.carouFredSel-packed.js', array ( 'jquery' ), ZN_FW_VERSION, true );
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];

		if( empty( $options['testimonials_single'] ) ){
			return;
		}

		$elm_classes=array();
		$elm_classes[] = $this->data['uid'];
		$elm_classes[] = zn_get_element_classes($options);

		$attributes = zn_get_element_attributes($options);

		$color_scheme = $this->opt( 'element_scheme', '' ) == '' ? zget_option( 'zn_main_style', 'color_options', false, 'light' ) : $this->opt( 'element_scheme', '' );
		$elm_classes[] = 'tstfd--'.$color_scheme;
		$elm_classes[] = 'element-scheme--'.$color_scheme;

		$title_content = false;

		echo '<div class="row elm-testimonial-fader tst-fader '.implode(' ', $elm_classes).'" '.$attributes.'>';

		if ( ! empty ( $options['tf_title'] ) || ! empty ( $options['tf_desc'] ) ) {

			echo '<div class="col-sm-3">';
			echo '<div class="testimonials_fader tst-fader-wrapper">';

			if ( ! empty ( $options['tf_title'] ) ) {

				echo '<h3 class="m_title m_title_ext text-custom tst-fader-title" '.WpkPageHelper::zn_schema_markup('title').'>' . $options['tf_title'] . '</h3>';
			}

			if ( ! empty ( $options['tf_desc'] ) ) {

				echo '<div class="tst-fader-desc">' . $options['tf_desc'] . '</div>';
			}

			$show_controls = $this->opt('tf_controls','');
			if($show_controls == '1'){
				echo '<div class="controls tst-fader-controls">';
				echo '<a href="#" class="prev tst-fader-controls-arr"><span class="glyphicon glyphicon-chevron-left"></span></a>';
				echo '<a href="#" class="next tst-fader-controls-arr"><span class="glyphicon glyphicon-chevron-right"></span></a>';
				echo '</div>';
			}

			echo '</div>';
			echo '</div>';

			$title_content = true;
		} // end if

		echo '<div class="col-sm-'.($title_content ? 9 : 12).'">';

		// Speed
		$speed = 5000;
		if ( ! empty( $options['tf_speed'] ) ) {
			$speed = intval($options['tf_speed']);
		}

		echo '<ul class="fixclear testimonials_fader_trigger tst-fader-list '.($title_content ? 'has-left-border' : '').'" data-speed="'.$speed.'" data-autoplay="'.$this->opt('tf_autoplay',1).'">';

		foreach ( $options['testimonials_single'] as $test ) {

			echo '<li class="tst-fader-item">';

			echo '<blockquote class="tst-fader-bqt">' . do_shortcode( $test['tf_single_test'] ) . '</blockquote>';

			echo '<div class="testimonial-author tst-fader-author clearfix">';

			if ( isset($test['tf_author_photo']) && !empty($test['tf_author_photo'])) {
				echo '<div class="testimonial-author--photo tst-fader-photo">';
				$image = vt_resize( '', $test['tf_author_photo'], '30', '30', true );
				echo '<img class="tst-fader-img" src="' . $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" alt="'. ZngetImageAltFromUrl( $test['tf_author_photo'] ) .'" title="'.ZngetImageTitleFromUrl( $test['tf_author_photo'] ).'">';
				echo '</div>';
			}

			echo '<h6 class="tst-fader-author-title">' . $test['tf_single_author'] . '</h6>';

			echo '</div>';

			echo '</li>';
		}

		echo '</ul>';

		echo '</div>';

		echo '</div>'; // end .row

	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$extra_options = array (
			"name"           => __( "Testimonials", 'zn_framework' ),
			"description"    => __( "Here you can add your testimonials.", 'zn_framework' ),
			"id"             => "testimonials_single",
			"std"            => "",
			"type"           => "group",
			"add_text"       => __( "Testimonial", 'zn_framework' ),
			"remove_text"    => __( "Testimonial", 'zn_framework' ),
			"group_sortable" => true,
			"element_title" => "tf_single_test",
			"subelements"    => array (
				array (
					"name"        => __( "Testimonial", 'zn_framework' ),
					"description" => __( "Please enter the desired testimonial.", 'zn_framework' ),
					"id"          => "tf_single_test",
					"std"         => "",
					"type"        => "textarea"
				),
				array (
					"name"        => __( "Author Photo", 'zn_framework' ),
					"description" => __( "Please select a photo for this author.", 'zn_framework' ),
					"id"          => "tf_author_photo",
					"std"         => "",
					"type"        => "media",
				),
				array (
					"name"        => __( "Testimonial author", 'zn_framework' ),
					"description" => __( "Please enter the desired author for this testimonial.", 'zn_framework' ),
					"id"          => "tf_single_author",
					"std"         => "",
					"type"        => "text"
				)
			)
		);
		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
					array (
						"name"        => __( "Title", 'zn_framework' ),
						"description" => __( "Please enter the Testimonials Fader title", 'zn_framework' ),
						"id"          => "tf_title",
						"std"         => "",
						"type"        => "text",
					),
					array (
						"name"        => __( "Description", 'zn_framework' ),
						"description" => __( "Please enter a description for this element", 'zn_framework' ),
						"id"          => "tf_desc",
						"std"         => "",
						"type"        => "textarea",
					),
					array (
						"name"        => __( "Auto-play?", 'zn_framework' ),
						"description" => __( "Please select whether you want the carousel to auto-play itself.", 'zn_framework' ),
						"id"          => "tf_autoplay",
						"std"         => "1",
						"value"         => "1",
						"type"        => "toggle2",
					),
					array (
						"name"        => __( "Transition Speed", 'zn_framework' ),
						"description" => __( "Please enter a numeric value for the transition speed. Default is 5000", 'zn_framework' ),
						"id"          => "tf_speed",
						"std"         => "5000",
						"type"        => "text",
					),
					array (
						"name"        => __( "Display Nav. arrows?", 'zn_framework' ),
						"description" => __( "Choose if you want to display navigation arrows onto the left side column.", 'zn_framework' ),
						"id"          => "tf_controls",
						"std"         => "",
						"value"         => "1",
						"type"        => "toggle2",
					),
					array(
						'id'          => 'element_scheme',
						'name'        => 'Element Color Scheme',
						'description' => 'Select the color scheme of this element',
						'type'        => 'select',
						'std'         => '',
						'options'        => array(
							'' => 'Inherit from Kallyas options > Color Options [Requires refresh]',
							'light' => 'Light (default)',
							'dark' => 'Dark'
						),
						'live'        => array(
							'multiple' => array(
								array(
									'type'      => 'class',
									'css_class' => '.'.$uid,
									'val_prepend'  => 'tstfd--',
								),
								array(
									'type'      => 'class',
									'css_class' => '.'.$uid,
									'val_prepend'  => 'element-scheme--',
								),
							)
						)
					),
					$extra_options,
				),
			),

			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#-vAt6gs9BRU',
				'docs'    => 'http://support.hogash.com/documentation/testimonial-fader/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}
