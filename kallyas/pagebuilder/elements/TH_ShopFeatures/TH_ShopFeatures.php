<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Shop Features
 Description: Create and display a Shop Features element
 Class: TH_ShopFeatures
 Category: content
 Level: 3
 Legacy: true
*/
/**
 * Class TH_ShopFeatures
 *
 * Create and display a Shop Features element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_ShopFeatures extends ZnElements
{
	public static function getName(){
		return __( "Shop Features", 'zn_framework' );
	}

	/**
	 * This method is used to display the output of the element.
	 *
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];

		$classes=array();
		$classes[] = $this->data['uid'];
		$classes[] = zn_get_element_classes($options);

		$attributes = zn_get_element_attributes($options);

		?>

		<div class="shop-features <?php echo implode(' ', $classes); ?>" <?php echo $attributes; ?>>
			<div class="row">
				<?php
					if ( ! empty ( $options['sf_title'] ) ) {
						echo '<div class="col-sm-3">';
						echo '<h3 class="title" '.WpkPageHelper::zn_schema_markup('title').'>' . $options['sf_title'] . '</h3>';
						echo '</div>';
					}
					if ( isset ( $options['sf_single'] ) && is_array( $options['sf_single'] ) ) {
						foreach ( $options['sf_single'] as $single ) {
							echo '<div class="col-sm-3">';
							$link_start = '';
							$link_end   = '';

							$lp_link = zn_extract_link($single['lp_link']);

							echo '<div class="shop-feature u-trans-all-2s kl-font-alt">';

							if ( ! empty ( $single['lp_single_logo'] ) ) {
								echo $lp_link['start'] . '<img src="' . $single['lp_single_logo'] . '" '.ZngetImageSizesFromUrl($single['lp_single_logo'], true).' alt="'. ZngetImageAltFromUrl( $single['lp_single_logo'] ) .'" title="'.ZngetImageTitleFromUrl( $single['lp_single_logo'] ).'">' . $lp_link['end'];
							}

							echo '<div class="sf-text">';
							if ( ! empty ( $single['lp_single_line1'] ) ) {
								echo '<h4 class="kl-font-alt">' . $single['lp_single_line1'] . '</h4>';
							}

							if ( ! empty ( $single['lp_single_line2'] ) ) {
								echo '<h5 class="kl-font-alt">' . $single['lp_single_line2'] . '</h5>';
							}
							echo '</div>';

							echo '</div><!-- end shop feature -->';

							echo '</div>';
						}
					}
				?>
			</div>
		</div>
	<?php
	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$extra_options = array (
			"name"           => __( "Features", 'zn_framework' ),
			"description"    => __( "Here you can add your shop features.", 'zn_framework' ),
			"id"             => "sf_single",
			"std"            => "",
			"type"           => "group",
			"add_text"       => __( "Feature", 'zn_framework' ),
			"remove_text"    => __( "Feature", 'zn_framework' ),
			"group_sortable" => true,
			"element_title" => "lp_single_line1",
			"subelements"    => array (
				array (
					"name"        => __( "Icon", 'zn_framework' ),
					"description" => __( "Please select an icon.", 'zn_framework' ),
					"id"          => "lp_single_logo",
					"std"         => "",
					"type"        => "media"
				),
				array (
					"name"        => __( "Line 1 text", 'zn_framework' ),
					"description" => __( "Please enter a text that will appear on the first line.", 'zn_framework' ),
					"id"          => "lp_single_line1",
					"std"         => "",
					"type"        => "text"
				),
				array (
					"name"        => __( "Line 2 text", 'zn_framework' ),
					"description" => __( "Please enter a text that will appear on the second line.", 'zn_framework' ),
					"id"          => "lp_single_line2",
					"std"         => "",
					"type"        => "text"
				),
				array (
					"name"        => __( "Feature Link", 'zn_framework' ),
					"description" => __( "Please choose the link you want to use.", 'zn_framework' ),
					"id"          => "lp_link",
					"std"         => "",
					"type"        => "link",
					"options"     => zn_get_link_targets(),
				),
			)
		);

		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
					array(
						"name"        => __( '<strong style="font-size:120%">Warning!</strong>', 'zn_framework' ),
						"description" => __( 'Since v4.x, <strong>this element is <em>deprecated</em> & <em>unsuported</em></strong>. It\'s not recommended to be used bucause at some point it\'ll be removed (now it\'s kept only for backwards compatibilty).<br> Instead, try to use a combination of these elements: Section (to add background), 2 Columns (4 + 8), Title element (onto the left column), Icon boxes (into the right column)', 'zn_framework' ),
						'type'  => 'zn_message',
						'id'    => 'zn_error_notice',
						'show_blank'  => 'true',
						'supports'  => 'warning'
					),
					array (
						"name"        => __( "Title", 'zn_framework' ),
						"description" => __( "Please enter the title for this element.", 'zn_framework' ),
						"id"          => "sf_title",
						"std"         => "",
						"type"        => "text",
					),
					$extra_options,
				),
			),


			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#1ypiBcjZEB4',
				'docs'    => 'http://support.hogash.com/documentation/shop-features/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}
