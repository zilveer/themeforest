<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Product item content
 Description: Create and display the current post content
 Class: TH_ProductContent
 Category: content, post
 Level: 3
 Dependency_class: WooCommerce
 Keywords: shop, store
*/

/**
 * Class TH_ProductContent
 *
 * Create and display the current page content
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_ProductContent extends ZnElements
{
	public static function getName(){
		return __( "Portfolio item content", 'zn_framework' );
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];

		// Prevent the elemnt from being accessible on other pages
		if( ! is_singular( 'product' ) ){
			echo '<div class="zn-pb-notification">This element only works on single product pages created with WooCommerce. Please delete it.</div>';
			return false;
		}

		$classes=array();
		$classes[] = $this->data['uid'];
		$classes[] = zn_get_element_classes($options);

		$attributes = zn_get_element_attributes($options);

		echo '<div class="zn_post_content_elemenent '.implode(' ', $classes).'" '.$attributes.'>';
			wc_get_template_part( 'content', 'single-product' );
		echo '</div>';
	}

	function options(){
		$uid = $this->data['uid'];
		$options = array(
			'has_tabs'  => true,
		);
		return $options;
	}

	// TODO : Uncomment this if JS errors appears because of clients shortcodes/plugins
	// /**
	//  * This method is used to display the output of the element.
	//  * @return void
	//  */
	// function element_edit()
	// {
	//     echo '<div class="zn-pb-notification">This element will be rendered only in View Page Mode and not in PageBuilder Edit Mode.</div>';
	// }

}
