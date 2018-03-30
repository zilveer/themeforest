<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Portfolio item content
 Description: Create and display the current post content
 Class: TH_PortfolioContent
 Category: content, post
 Level: 3
 Keywords: project
*/

/**
 * Class TH_PortfolioContent
 *
 * Create and display the current page content
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_PortfolioContent extends ZnElements
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
		global $zn_config;

		$options = $this->data['options'];

		$zn_config['portfolio_scheme'] = $this->opt( 'portfolio_scheme', '' );

		echo '<div class="zn_post_content_elemenent '.$this->data['uid'].' '.zn_get_element_classes($options).'" '.zn_get_element_attributes($options).'>';
			get_template_part( 'inc/page', 'content-view-portfolio.inc' );
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
						'id'          => 'portfolio_scheme',
						'name'        => 'Portfolio color scheme',
						'description' => 'Select the color scheme of the Portfolio',
						'type'        => 'select',
						'std'         => '',
						'options'        => array(
							'' => 'Inherit from Portfolio Options (Kallyas options)',
							'light' => 'Light',
							'dark' => 'Dark'
						),
					),

				),
			),


			'help' => znpb_get_helptab( array(
				'video'   => 'https://www.youtube.com/watch?v=b1z44M6EaM4',
				'docs'    => 'http://support.hogash.com/documentation/portfolio-item-content/',
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
