<?php
/**
 * This file is part of the BTP_FaderTheme package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code. *
 */



/* Prevent direct script access */
if ( !defined( 'BTP_FRAMEWORK_VERSION' ) ) exit( 'No direct script access allowed' );



btp_shortgen_add_subgroup( 
	'pages', 
	array( 
		'label' => __( 'Pages', 'btp_theme' ),
	),  
	'general',
	500
);
	
	

btp_shortgen_add_item(
	'custom_pages', 
	array(
		'label' 	=> '[custom_pages]',
		'atts' 		=> array(
			'entry_ids' 	=> array( 
				'view'			=> 'String',
				'hint'			=> __( 'Comma separated list of entry IDs', 'btp_theme' ), 
			),
		    'template'		=> array( 
		    	'view' 			=> 'Choice', 
		    	'choices_cb' 	=> 'btp_page_get_collection_templates',
			),
			'hide'			=> array( 
				'view' 			=> 'String',
				'help' 			=> __('<p>You can hide following elements:</p><ul><li>title</li><li>featured_media</li><li>summary</li><li>button_1</li></ul>', 'btp_theme'),
				'hint' 			=> __('Comma separated list of elements to hide', 'btp_theme'),
			),
		),
		'type' 		=> 'block',
		'group'		=> 'general',
		'subgroup'	=> 'pages',
		'position'	=> 100,
	)	
);

	
	
/**
 * [custom_pages] shortcode callback function.
 * 
 * @param 			array $atts
 * @param 			string$content
 * @return			string
 */
function btp_custom_pages_shortcode( $atts, $content = null ) {
	static $counter = 0;
	$counter++;
	
	$default_template = key( btp_page_get_collection_templates() );
	
	extract( shortcode_atts( 
		array(			
			'entry_ids'			=> '',
			'template'			=> $default_template,
			'hide'				=> '',
			'lightbox_group'	=> 'custom_pages_lightbox'					
		), 
		$atts 
	));
		
	$out = '';
	
	$entry_ids = explode(',', $entry_ids);
	
	$query_args = array(
   		'post_type'				=> 'page',
  		'post__in'				=> $entry_ids,
  		'orderby'				=> 'none',
		'ignore_sticky_posts'	=> true,
	);
	
	$query = new WP_Query($query_args);	

	if($query->have_posts()) {
		btp_loop_before();	
		
		/* Push some variables for template part */
		btp_part_set_vars(array(
			'elems' 			=> btp_page_get_collection_elements($hide),
			'lightbox_group'	=> $lightbox_group,
			'query'				=> $query,
		));
		
		/* Compose output */
		$template = preg_replace('/[^0-9a-zA-Z_-]/', '', $template);
		$template = str_replace( '-', '_', $template );
		
		ob_start();
		get_template_part('/lib/pages/templates/collection', $template);					
		$out .= '<div id="custom-pages-shortcode-' . $counter . '" class="custom-pages-shortcode shortcode">';					
			$out .= ob_get_clean();
		$out .= '</div>';
		
		btp_loop_after();
	}
	else {
		$out .= '<p class="no-results">'.__( 'No results found.', 'btp_theme' ).'</p>';	
	}	
	
	return $out;
}
add_shortcode( 'custom_pages', 'btp_custom_pages_shortcode' );



btp_shortgen_add_item(
	'related_pages', 
	array(
		'label' 	=> '[related_pages]',
		'atts' 		=> array(
				'entry_id'		=> array( 
					'view' 			=> 'String',
					'hint'			=> __( 'Entry ID - leave empty to use the current entry ID', 'btp_theme' ),
				),
				'max' 			=> array( 
					'view' 			=> 'String',
					'hint'			=> __( 'Maximum entries to display', 'btp_theme' ),	 
				),
		    	'template'		=> array( 
		    		'view' 			=> 'Choice', 
		    		'choices_cb'	=> 'btp_page_get_collection_templates',
				),
				'hide'			=> array( 
					'view' 			=> 'String',
					'help' 			=> __('<p>You can hide following elements:</p><ul><li>title</li><li>featured_media</li><li>summary</li><li>button_1</li></ul>', 'btp_theme'),
					'hint' 			=> __('Comma separated list of elements to hide', 'btp_theme'), 
				),
		),
		'type' 		=> 'block',
		'group'		=> 'general',
		'subgroup'	=> 'pages',
		'position'	=> 130,				
	)	
);



/**
 * [related_pages] shortcode callback function.
 * 
 * @param 			array $atts
 * @param 			string $content
 * @return			string
 */
function btp_related_pages_shortcode( $atts, $content = null ) {
	static $counter = 0;
	$counter++;
	
	$default_template = key( btp_page_get_collection_templates() );
	
	extract( shortcode_atts( array(
		'entry_id'			=> 0,	
		'max'				=> 1,
		'template'			=> $default_template,
		'hide'				=> '',
		'lightbox_group'	=> 'related_pages_lightbox'										
		), $atts ) );
	
	$out = '';
			
	$related_ids = btp_relations_get_related_ids( $entry_id, 'page', $max );
	if(count($related_ids)){
  		$query_args = array(
   			'post_type'				=> 'page',
  			'post__in'				=> $related_ids,
  			'orderby'				=> 'none',
  			'ignore_sticky_posts'	=> true,
		);					

		$query = new WP_Query($query_args);	
			
		if ( $query->have_posts() ) {					
			btp_loop_before();	
			
			btp_part_set_vars(array(
				'elems' 			=> btp_page_get_collection_elements($hide),
				'lightbox_group'	=> $lightbox_group,
				'query'				=> $query,
			));
			
			/* Compose output */
			$template = preg_replace('/[^0-9a-zA-Z_-]/', '', $template);
			$template = str_replace( '-', '_', $template );
			
			ob_start();
			get_template_part('/lib/pages/templates/collection', $template);					
			$out .= '<div id="related-pages-shortcode-' . $counter . '" class="related-pages-shortcode shortcode">';					
				$out .= ob_get_clean();
			$out .= '</div>';
	
			btp_loop_after();
		}	
	}
	else {
		$out .= '<p class="no-results">'.__( 'No results found.', 'btp_theme' ).'</p>';	
	}
	
	return $out;
}
add_shortcode( 'related_pages', 'btp_related_pages_shortcode' );
?>