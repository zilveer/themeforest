<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Comments
 Description: Create and display the current page content
 Class: TH_Comments
 Category: content
 Level: 3
*/

/**
 * Class TH_Comments
 *
 * Create and display the current page content
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_Comments extends ZnElements
{
	public static function getName(){
		return __( "Comments", 'zn_framework' );
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];

		$classes=array();
		$classes[] = $this->data['uid'];
		$classes[] = zn_get_element_classes($options);

		$attributes = zn_get_element_attributes($options);

		echo '<div class="zn_page_comments_element '.implode(' ', $classes).'" '.$attributes.'>';
			comments_template();
		echo '</div>';
	}

	function options(){

		$uid = $this->data['uid'];
		return array(

			'has_tabs'  => true,

			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#mWRmLnuEz1E',
				'copy'    => $uid,
				'general' => true,
			)),

		);
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	// function element_edit()
	// {
	//     echo '<div class="zn-pb-notification">This element will be rendered only in View Page Mode and not in PageBuilder Edit Mode.</div>';
	// }

}
