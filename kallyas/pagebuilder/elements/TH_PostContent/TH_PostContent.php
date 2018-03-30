<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Post content
 Description: Create and display the current post content
 Class: TH_PostContent
 Category: content, post
 Level: 3
 Keywords: blog
*/

/**
 * Class TH_PostContent
 *
 * Create and display the current page content
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_PostContent extends ZnElements
{
	public static function getName(){
		return __( "Post content", 'zn_framework' );
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{
		global $zn_config;

		$options = $this->data['options'];

		$zn_config['blog_style'] = $this->opt( 'blog_style', '' );
		$zn_config['blog_multicolumns'] = $this->opt( 'blog_multicolumns', '' );

		echo '<div class="zn_post_content_elemenent '.$this->data['uid'].' '.zn_get_element_classes($options).'" '.zn_get_element_attributes($options).'>';
			get_template_part( 'inc/page', 'content-view-post.inc' );
		echo '</div>';
	}

	function options(){

		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General Options',
				'options' => array(
					array(
						'id'          => 'blog_style',
						'name'        => 'Blog color scheme',
						'description' => 'Select the style of this blog page',
						'type'        => 'select',
						'std'         => '',
						'options'        => array(
							'' => 'Inherit from Blog Options (Kallyas options)',
							'light' => 'Light',
							'dark' => 'Dark'
						),
					),
					array(
						"name"        => __( "Display posts on multiple columns?", 'zn_framework' ),
						"description" => __( "Please select if you want .", 'zn_framework' ),
						"id"          => "blog_multicolumns",
						"std"         => "1",
						"type"        => "select",
						"options"     => array (
							'' => 'Inherit from Blog Options (Kallyas options)',
							'1' => __( '1 Column (default)', 'zn_framework' ),
							'2' => __( '2 Columns', 'zn_framework' ),
						)
					),
				),
			),


			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#5yfqc8O4_88',
				'copy'    => $uid,
				'general' => true,
			)),

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
