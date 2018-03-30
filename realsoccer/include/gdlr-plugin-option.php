<?php
	/*	
	*	Goodlayers Framework File
	*	---------------------------------------------------------------------
	*	This file contains the code to register the goodlayers plugin option
	*	to admin area
	*	---------------------------------------------------------------------
	*/

	// add an admin option to portfolio
	add_filter('gdlr_admin_option', 'gdlr_register_portfolio_admin_option');
	if( !function_exists('gdlr_register_portfolio_admin_option') ){
		
		function gdlr_register_portfolio_admin_option( $array ){		
			if( empty($array['general']['options']) ) return $array;
			
			$portfolio_option = array( 									
				'title' => __('Portfolio Style', 'gdlr_translate'),
				'options' => array(
					'portfolio-slug' => array(
						'title' => __('Portfolio Slug ( Permalink )', 'gdlr_translate'),
						'type' => 'text',
						'default' => 'portfolio',
						'description' => __('Only <strong>a-z (lower case), hyphen and underscore</strong> is allowed here <br><br>', 'gdlr_translate') .
							__('After changing, you have to set the permalink at the setting > permalink to default (to reset the permalink rules) as well.', 'gdlr_translate')
					),
					'portfolio-category-slug' => array(
						'title' => __('Portfolio Category Slug ( Permalink )', 'gdlr_translate'),
						'type' => 'text',
						'default' => 'portfolio_category',
					),
					'portfolio-tag-slug' => array(
						'title' => __('Portfolio Tag Slug ( Permalink )', 'gdlr_translate'),
						'type' => 'text',
						'default' => 'portfolio_tag',
					),					
					'portfolio-comment' => array(
						'title' => __('Enable Comment On Portfolio', 'gdlr_translate'),
						'type' => 'checkbox',
						'default' => 'disable'
					),	
					'portfolio-related' => array(
						'title' => __('Enable Related Portfolio', 'gdlr_translate'),
						'type' => 'checkbox',
						'default' => 'enable'
					),					
					'portfolio-page-style' => array(
						'title' => __('Portfolio Page Style', 'gdlr_translate'),
						'type'=> 'combobox',
						'options'=> array(
							'style1'=> __('Portfolio Style 1', 'gdlr_translate'),
							'style2'=> __('Portfolio Style 2', 'gdlr_translate'),
							'blog-style'=> __('Blog Style', 'gdlr_translate'),
						)
					),					
					'portfolio-thumbnail-size' => array(
						'title' => __('Single Portfolio Thumbnail Size', 'gdlr_translate'),
						'type'=> 'combobox',
						'options'=> gdlr_get_thumbnail_list(),
						'default'=> 'post-thumbnail-size'
					),	
					'related-portfolio-style' => array(
						'title' => __('Related Portfolio Style', 'gdlr_translate'),
						'type'=> 'combobox',
						'options'=> array(
							'classic-portfolio'=> __('Portfolio Classic Style', 'gdlr_translate'),
							'modern-portfolio'=> __('Portfolio Modern Style', 'gdlr_translate')
						)
					),
					'related-portfolio-size' => array(
						'title' => __('Related Portfolio Size', 'gdlr_translate'),
						'type'=> 'combobox',
						'options'=> array(
							'2'=> __('1/2', 'gdlr_translate'),
							'3'=> __('1/3', 'gdlr_translate'),
							'4'=> __('1/4', 'gdlr_translate'),
							'5'=> __('1/5', 'gdlr_translate')
						),
						'default'=>'4'
					),					
					'related-portfolio-num-fetch' => array(
						'title' => __('Related Portfolio Num Fetch', 'gdlr_translate'),
						'type'=> 'text',
						'default'=> '4'
					),					
					'related-portfolio-num-excerpt' => array(
						'title' => __('Related Portfolio Num Excerpt', 'gdlr_translate'),
						'type'=> 'text',
						'default'=> '25'
					),
					'related-portfolio-thumbnail-size' => array(
						'title' => __('Related Portfolio Thumbnail Size', 'gdlr_translate'),
						'type'=> 'combobox',
						'options'=> gdlr_get_thumbnail_list(),
						'default'=> 'small-grid-size'
					),					
				)
			);
			
			$array['general']['options']['portfolio-style'] = $portfolio_option;
			return $array;
		}
		
	}		

?>