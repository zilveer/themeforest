<?php if(! defined('ABSPATH')){ return; }
/*
Name: STATIC CONTENT - Simple Text ( full width )
Description: Create and display a STATIC CONTENT - Simple Text ( full width ) element
Class: TH_StaticContentSimpleTextFullWidth
Category: headers, Fullwidth
Level: 1
*/
/**
 * Class TH_StaticContentSimpleTextFullWidth
 *
 * Create and display a STATIC CONTENT - Simple Text ( full width ) element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_StaticContentSimpleTextFullWidth extends ZnElements
{
	public static function getName(){
		return __( "STATIC CONTENT - Simple Text ( full width )", 'zn_framework' );
	}

	/**
	 * Load dependant resources
	 */
	function scripts(){
		wp_enqueue_style( 'static_content', THEME_BASE_URI . '/css/sliders/static_content_styles.css', '', ZN_FW_VERSION );
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{
		$uid = $this->data['uid'];
		$options = $this->data['options'];
		if( empty( $options ) ) { return; }
		?>
			<div class="kl-slideshow static-content__slideshow nobg <?php echo $uid; ?> <?php echo zn_get_element_classes($this->data['options']); ?>">

				<?php
					$sc_sc = $this->opt('sc_sc','');
					if( !empty ($sc_sc) ){
						echo do_shortcode( $sc_sc );
					}
				?>

			</div><!-- end kl-slideshow -->
	<?php
	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
					array (
						"name"        => __( "Text", 'zn_framework' ),
						"description" => __( "Please enter the shortcode.", 'zn_framework' ),
						"id"          => "sc_sc",
						"std"         => "",
						"type"        => "textarea"
					),
				),
			),

		);
		return $options;
	}
}
