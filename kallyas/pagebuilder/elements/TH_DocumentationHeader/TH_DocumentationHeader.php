<?php if(! defined('ABSPATH')){ return; }
/*
Name: Documentation Header
Description: Create and display a Documentation Header element
Class: TH_DocumentationHeader
Category: headers, Fullwidth
Level: 1
Scripts: true
*/
/**
 * Class TH_DocumentationHeader
 *
 * Create and display a Documentation Header element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_DocumentationHeader extends ZnElements
{
	public static function getName(){
		return __( "Documentation Header", 'zn_framework' );
	}

	function scripts(){
		wp_enqueue_style( 'documentation-css', THEME_BASE_URI . '/css/pages/documentation.css', array('kallyas-styles'), ZN_FW_VERSION );
	}


	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];

		$style = $this->opt('hm_header_style', '');
		if ( ! empty ( $style ) ) {
			$style = 'uh_' . $style;
		}

		$bottom_mask = $this->opt('hm_header_bmasks','none');
		$bm_class = $bottom_mask != 'none' ? 'maskcontainer--'.$bottom_mask : '';

		?>
		<div id="page_header" class="page-subheader <?php echo $style; ?> <?php echo $bm_class ?> zn_documentation_page <?php echo $this->data['uid']; ?> <?php echo zn_get_element_classes($this->data['options']); ?>">
			<div class="bgback"></div>
			<div class="th-sparkles"></div>
			<div class="container kl-slideshow-safepadding">
				<div class="row">
					<div class="zn_doc_search">
						<form method="get" id="" action="<?php echo home_url(); ?>">
							<input type="text" value="" name="s" id="s"
								   placeholder="<?php _e("Search the Documentation", 'zn_framework'); ?>">
							<input type="submit" id="searchsubmit" class="btn"
								   value="<?php _e('Search', 'zn_framework');?>">
							<input type="hidden" name="post_type" value="documentation">
						</form>
					</div>
				</div>
				<!-- end row -->
			</div>
			<?php
				zn_bottommask_markup($bottom_mask, $this->opt('hm_header_bmasks_bg',''));
			?>
		</div><!-- end page-subheader -->
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

					array(
						"name" => __("Header Style", 'zn_framework'),
						"description" => __("Select the header style you want to use for this page.Please note that
											  header styles can be created from the theme's admin page.", 'zn_framework'),
						"id" => "hm_header_style",
						"std" => "",
						"type" => "select",
						"options" => WpkZn::getThemeHeaders(true),
						"class" => ""
					),

					// Bottom masks overrides
					array (
						"name"        => __( "Bottom masks override", 'zn_framework' ),
						"description" => __( "The new masks are svg based, vectorial and color adapted.", 'zn_framework' ),
						"id"          => "hm_header_bmasks",
						"std"         => "none",
						"type"        => "select",
						"options"     => zn_get_bottom_masks(),
					),

                    array(
                        'id'          => 'hm_header_bmasks_bg',
                        'name'        => 'Bottom Mask Background Color',
                        'description' => 'If you need the mask to have a different color than the main site background, please choose the color. Usually this color is needed when the next section, under this one has a different background color.',
                        'type'        => 'colorpicker',
                        'std'         => '',
                        "dependency"  => array( 'element' => 'hm_header_bmasks' , 'value'=> array('mask3', 'mask3 mask3l', 'mask3 mask3r', 'mask4', 'mask4 mask4l', 'mask4 mask4r', 'mask5', 'mask6') ),
                    ),
				),
			),

			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#Yl7l2SVgyRU',
				'docs'    => 'http://support.hogash.com/documentation/documentation-header/',
				'copy'    => $uid,
				'general' => true,
			)),

		);

		return $options;
	}
}
