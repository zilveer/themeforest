<?php



/* Prevent direct script access */
if ( !defined( 'BTP_FRAMEWORK_VERSION' ) ) exit( 'No direct script access allowed' );



btp_shortgen_add_subgroup( 
	'works', 
	array( 
		'label' => __( 'Works', 'btp_theme' ),
	),  
	'general',
	700
);



btp_shortgen_add_item(
	'custom_works', 
	array(
		'label' 	=> '[custom_works]',
		'atts' 		=> array(
			'entry_ids' 	=> array( 
				'view'			=> 'String',
				'hint'			=> __( 'Comma separated list of entry IDs', 'btp_theme' ), 
			),
		    'template'		=> array( 
		    	'view' 			=> 'Choice', 
		    	'choices_cb'	=> 'btp_work_get_collection_templates',
			),
			'hide'			=> array( 
				'view' 			=> 'String',
				'help' 			=> __('<p>You can hide following elements:</p><ul><li>title</li><li>featured_media</li><li>date</li><li>comments_link</li><li>summary</li><li>categories</li><li>tags</li><li>button_1</li></ul>', 'btp_theme'),
				'hint' 			=> __('Comma separated list of elements to hide', 'btp_theme'),
			),
		),
		'type' 		=> 'block',
		'group'		=> 'general',
		'subgroup'	=> 'works',
		'position'	=> 100,
	)	
);



/**
 * Callback for custom_works shortcode
 * 
 * @param			array $atts
 * @param 			string $content
 * @return			string
 */
function btp_custom_works_shortcode( $atts, $content = null ) {
	static $counter = 0;
	$counter++;
	
	$default_template = key( btp_work_get_collection_templates() );
	
	extract( shortcode_atts( array(			
		'entry_ids'			=> '',
		'template'			=> $default_template,
		'hide'				=> '',
		'lightbox_group'	=> 'custom_works_lightbox',
		), $atts 
	));
		
	$out = '';
	
	$entry_ids = explode(',', $entry_ids);
	
	$query_args = array(
   		'post_type'				=> 'btp_work',			
  		'post__in'				=> $entry_ids,
  		'orderby'				=> 'none',
		'ignore_sticky_posts'	=> true,
	);					

	
	$query = new WP_Query($query_args);	

	if ( $query->have_posts() ) {
		btp_loop_before();
		
		/* Push some variables for template part */
		btp_part_set_vars(array(
			'elems' 			=> btp_work_get_collection_elements($hide),
			'lightbox_group'	=> $lightbox_group,
			'query'				=> $query,
		));
		
		/* Compose output */
		$template = preg_replace('/[^0-9a-zA-Z_-]/', '', $template);
		$template = str_replace( '-', '_', $template );
		
		ob_start();
		get_template_part('/lib/works/templates/collection', $template);					
		$out .= '<div id="custom-works-shortcode-' . $counter . '" class="custom-works-shortcode shortcode">';					
			$out .= ob_get_clean();
		$out .= '</div>';
		
		btp_loop_after();
	}
	else {
		$out .= '<p class="no-results">'.__( 'No results found.', 'btp_theme' ).'</p>';	
	}
	
	return $out;
}
add_shortcode('custom_works', 'btp_custom_works_shortcode');



btp_shortgen_add_item(
	'popular_works', 
	array(
		'label' 	=> '[popular_works]',
		'atts'	 	=> array(
			'max' 		=> array( 
				'view' 		=> 'String',
				'hint'		=> __( 'Maximum items to display', 'btp_theme' ), 
			),				
		    'template'	=> array( 
		    	'view' 		=> 'Choice', 
		    	'choices_cb'=> 'btp_work_get_collection_templates',
			),
			'hide'		=> array( 
				'view' 		=> 'String',
				'help' 			=> __('<p>You can hide following elements:</p><ul><li>title</li><li>featured_media</li><li>date</li><li>comments_link</li><li>summary</li><li>categories</li><li>tags</li><li>button_1</li></ul>', 'btp_theme'),
				'hint' 			=> __('Comma separated list of elements to hide', 'btp_theme'), 
			),
		),
		'type'	 	=> 'block',
		'group'		=> 'general',
		'subgroup'	=> 'works',
		'position'	=> 110,
	)	
);



/**
 * Callback for popular_works shortcode
 * 
 * @param 			array $atts
 * @param 			string $content
 * @return			string
 */
function btp_popular_works_shortcode( $atts, $content = null ) {	
	static $counter = 0;
	$counter++;
	
	$default_template = key( btp_work_get_collection_templates() );
	
	extract( shortcode_atts( array(
		'max'				=> 1,
		'template'			=> $default_template,
		'hide'				=> '',
		'lightbox_group'	=> 'popular_works_lightbox'										
		), $atts ) );
		
	$out = '';
	
	$query_args = array(
   		'post_type'				=> 'btp_work',
		'posts_per_page'		=> absint($max),  			
  		'orderby'				=> 'comment_count',
  		'order'					=> 'desc',
		'ignore_sticky_posts'	=> true,
	);	
	
	/* Modify post query to consider only commented posts */		
	add_filter( 'posts_where', 'btp_filter_where_commented_posts' );
	
	$query = new WP_Query($query_args);	
	
	if ( $query->have_posts() ) {
		/* Remove filter to not interfere with further post queries */
		remove_filter('posts_where', 'btp_filter_where_commented_posts');
				 
		btp_loop_before();			
		
		/* Push some variables for template part */
		btp_part_set_vars(array(
			'elems' 			=> btp_work_get_collection_elements($hide),
			'lightbox_group'	=> $lightbox_group,
			'query'				=> $query,
		));
		
		/* Compose output */
		$template = preg_replace('/[^0-9a-zA-Z_-]/', '', $template);
		$template = str_replace( '-', '_', $template );
		
		ob_start();
		get_template_part('/lib/works/templates/collection', $template);					
		$out .= '<div id="popular-works-shortcode-' . $counter . '" class="popular-works-shortcode shortcode">';					
			$out .= ob_get_clean();
		$out .= '</div>';
		
		btp_loop_after();
	} 
	else {
		/* Remove filter to not interfere with further post queries */
		remove_filter('posts_where', 'btp_filter_where_commented_posts');
		
		$out .= '<p class="no-results">'.__( 'No results found.', 'btp_theme' ).'</p>';	
	}
	
	return $out;
}
add_shortcode('popular_works', 'btp_popular_works_shortcode');


	
btp_shortgen_add_item( 
	'recent_works',
	array(
		'label'			=> '[recent_works]',
		'atts'			=> array(
			'cat' 			=> array( 
				'view' 		=> 'String',
				'hint'		=> __( 'The slug of a work category', 'btp_theme' ), 
			),
			'max'			=> array( 
				'view' 		=> 'String',
				'hint'		=> __( 'Maximum entries to display', 'btp_theme' ),	 
			),
			'template'		=> array(
				'view'			=> 'Choice',
				'choices_cb'	=> 'btp_work_get_collection_templates'
			),
			'hide'			=> array(
				'view'			=> 'String',
				'help' 			=> __('<p>You can hide following elements:</p><ul><li>title</li><li>featured_media</li><li>date</li><li>comments_link</li><li>summary</li><li>categories</li><li>tags</li><li>button_1</li></ul>', 'btp_theme'),
				'hint' 			=> __('Comma separated list of elements to hide', 'btp_theme'),
			),
		),
		'group'			=> 'general',
		'subgroup'		=> 'works',
		'position'		=> 120,	
	)			 
); 



/**
 * Callback for recent_works shortcode
 * 
 * @param 			array $atts
 * @param 			string $content
 * @return			string
 */
function btp_recent_works_shortcode( $atts, $content = null ) {	
	static $counter = 0;
	$counter++;
	
	$default_template = key( btp_work_get_collection_templates() );
	
	extract( shortcode_atts( array(
		'cat'				=> '',
		'max'				=> 1,
		'template'			=> $default_template,
		'hide'				=> '',
		'lightbox_group'	=> 'recent_works_lightbox'										
		), $atts ) );
		
	$out = '';
	
	$query_args = array(
   		'post_type'				=> 'btp_work',
		'posts_per_page'		=> absint($max),  			
  		'orderby'				=> 'date',
  		'order'					=> 'desc',
		'btp_work_category'		=> $cat,
		'ignore_sticky_posts'	=> true,
	);		
	
	$query = new WP_Query($query_args);	
		
	if ( $query->have_posts() ) {	 
		btp_loop_before();
			
		btp_part_set_vars( array(
			'query'				=> $query,
			'elems' 			=> btp_work_get_collection_elements( $hide ),			
			'lightbox_group'	=> $lightbox_group,
		));	
		
		/* Compose output */
		$template = preg_replace('/[^0-9a-zA-Z_-]/', '', $template);
		$template = str_replace( '-', '_', $template );
				
		ob_start();
		get_template_part('/lib/works/templates/collection', $template);
		$out .= '<div id="recent-works-shortcode-' . $counter . '" class="recent-works-shortcode shortcode">';					
			$out .= ob_get_clean();
		$out .= '</div>';	
		
		btp_loop_after();
	} 
	else {
		$out .= '<p class="no-results">'.__( 'No results found.', 'btp_theme' ).'</p>';	
	}
	
	return $out;
}
add_shortcode('recent_works', 'btp_recent_works_shortcode');

	

btp_shortgen_add_item(
	'related_works', 
	array(
		'label' 	=> '[related_works]',
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
		    		'choices_cb'	=> 'btp_work_get_collection_templates',
				),
				'hide'			=> array( 
					'view' 			=> 'String',
					'help' 			=> __('<p>You can hide following elements:</p><ul><li>title</li><li>featured_media</li><li>date</li><li>comments_link</li><li>summary</li><li>categories</li><li>tags</li><li>button_1</li></ul>', 'btp_theme'),
					'hint' 			=> __('Comma separated list of elements to hide', 'btp_theme'), 
				),
		),
		'type' 		=> 'block',
		'group'		=> 'general',
		'subgroup'	=> 'works',
		'position'	=> 130,				
	)	
);


/**
 * Callback for related_works shortcode
 * 
 * @param 			array $atts
 * @param 			string $content
 * @return			string
 */
function btp_related_works_shortcode( $atts, $content = null ) {
	static $counter = 0;
	$counter++;
	
	$default_template = key(btp_work_get_collection_templates());
	
	extract( shortcode_atts( array(
		'entry_id'			=> 0,	
		'max'				=> 1,
		'template'			=> $default_template,
		'hide'				=> '',
		'lightbox_group'	=> 'related_works_lightbox',
		), $atts 
	));
	
	$out = '';
	
	$related_ids = btp_relations_get_related_ids($entry_id, 'btp_work', $max);
	if ( count($related_ids) ) {
  		$query_args = array(
  			'posts_per_page'		=> 100,
   			'post_type'				=> 'btp_work',
  			'post__in'				=> $related_ids,
  			'orderby'				=> 'none',
  			'ignore_sticky_posts'	=> true,
		);					
		
		$query = new WP_Query($query_args);	
			
		if ( $query->have_posts() ) {					
			btp_loop_before();	
			
			btp_part_set_vars(array(
				'elems' 			=> btp_work_get_collection_elements($hide),
				'lightbox_group'	=> $lightbox_group,
				'query'				=> $query,
			));
			
			/* Compose output */
			$template = preg_replace('/[^0-9a-zA-Z_-]/', '', $template);
			$template = str_replace( '-', '_', $template );
			
			ob_start();
			get_template_part('/lib/works/templates/collection', $template);					
			$out .= '<div id="related-works-shortcode-' . $counter . '" class="related-works-shortcode shortcode">';					
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
add_shortcode('related_works', 'btp_related_works_shortcode');
?>