<?php
/**
 * Custom TinyMce Styles
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */

if ( !class_exists( 'SdCustomTinyMceStyles' ) ) {
	class SdCustomTinyMceStyles {

		public function __construct() {
			add_filter( 'mce_buttons', array( &$this, 'add_dropdown' ) );
			add_filter( 'tiny_mce_before_init', array( &$this, 'add_items' ) );
		}

		public function add_dropdown( $buttons ){
			array_unshift( $buttons, 'styleselect' );
			return $buttons;
		}
 
		public function add_items( $init_array ){
			$styles = array();
		
			$styles[] = array(
				"title"   => "SD Light Text",
				"classes" => "sd-light",
				"inline"  => "span",
				'wrapper' => true,
			);

			$styles[] = array(
				"title"   => "SD Border Top",
				"classes" => "sd-border-top",
				"inline"  => "span",
				'wrapper' => true,
			);

			$styles[] = array(
				"title"   => "SD Border Bottom",
				"classes" => "sd-border-bottom",
				"inline"  => "span",
				'wrapper' => true,
			);
			
			$styles[] = array(
				"title"    => "SD Styled List",
				"classes"  => "sd-list-style",
				"selector" => "ul",
				"wrapper"  => true,
			);
		
			$styles[] = array(
				"title"   => "SD Subtitle",
				"classes" => "sd-subtitle",
				"inline"  => "span",
				"wrapper" => true,
			);
			
			$styles[] = array(
				"title"	  => "SD Colored",
				"classes" => "sd-colored",
				"inline"  => 'span',
				"wrapper" => true,
			);
			
			$styles[] = array(
				"title"	  => "SD Img Float Left",
				"classes" => "pull-left",
				"inline"  => 'img',
				"wrapper" => true,
			);

			$styles[] = array(
				"title"	  => "SD Img Float Right",
				"classes" => "pull-right",
				"selector" => "img",
				"wrapper" => true,
			);

			$styles[] = array(
				"title"	  => "SD Small Text",
				"classes" => "sd-small-text",
				"inline"  => "span",
				"wrapper" => true,
			);
			
			$styles[] = array(
				"title"	  => "SD Large Text",
				"classes" => "sd-large-text",
				"inline"  => "span",
				"wrapper" => true,
			);
			
			$styles[] = array(
				"title"	  => "SD No Margin Paragraph",
				"classes" => "sd-margin-none",
				"selector" => "p",
				"wrapper" => true,
			);
						
			$styles[] = array(
				"title"	  => "SD Clear Floats",
				"classes" => "sd-clear",
				"selector" => "p, h2, h3, h4, h5, h6, div, img",
				"wrapper" => true,
			);
						
			$styles[] = array(
				"title"	  => "SD Styled Title",
				"classes" => "sd-styled-title",
				"selector" => "h2, h3, h4, h5, h6",
				"wrapper" => true,
			);
			$styles[] = array(
				"title"	  => "SD Margin Bottom",
				"classes" => "sd-margin-bottom",
				"selector" => "p, h2, h3, h4, h5, h6, div, img, span, a",
				"wrapper" => true,
			);
			$styles[] = array(
				"title"	  => "SD Styled Title Center",
				"classes" => "sd-styled-title-centered",
				"selector" => "h2, h3, h4, h5, h6",
				"wrapper" => true,
			);
			$styles[] = array(
				"title"	  => "SD Text Background",
				"classes" => "sd-text-background",
				"selector" => "p, h2, h3, h4, h5, h6, div, img, span, a",
				"wrapper" => true,
			);
			$styles[] = array(
				"title"	  => "SD Text Background Dark",
				"classes" => "sd-text-background-dark",
				"selector" => "p, h2, h3, h4, h5, h6, div, img, span, a",
				"wrapper" => true,
			);
			$styles[] = array(
				"title"	  => "SD Text Background White",
				"classes" => "sd-text-bg-white",
				"selector" => "p, h2, h3, h4, h5, h6, div, img, span, a",
				"wrapper" => true,
			);
			$init_array['style_formats'] = json_encode( $styles );
		
			return $init_array;
		}
	}	

	new SdCustomTinyMceStyles();
}