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
	'posts', 
	array( 
		'label' => __( 'Posts', 'btp_theme' ),
	),  
	'general',
	600
);


btp_shortgen_add_item(
	'custom_posts', 
	array(
		'label' 	=> '[custom_posts]',
		'atts' 		=> array(
			'entry_ids' => array( 
				'view' 		=> 'String',
				'hint'		=> __( 'Comma separated list of entry ids', 'btp_theme' ), 
			),
		    'template'	=> array( 
		    	'view' 		=> 'Choice', 
		    	'choices_cb'=> 'btp_post_get_collection_templates',
			),
			'hide'		=> array( 
				'view'		=> 'String',
				'help' 			=> __('<p>You can hide following elements:</p><ul><li>title</li><li>featured_media</li><li>date</li><li>author</li><li>comments_link</li><li>summary</li><li>categories</li><li>tags</li><li>button_1</li></ul>', 'btp_theme'),
				'hint' 			=> __('Comma separated list of elements to hide', 'btp_theme'),
			),
		),
		'type' 		=> 'block',
		'group'		=> 'general',
		'subgroup'	=> 'posts',
		'position'	=> 100,
	)	
);



/**
 * Callback for custom_posts shortcode
 * 
 * @param 			array $atts
 * @param 			string $content
 * @return			string
 */
function btp_custom_posts_shortcode( $atts, $content = null ) {
	static $counter = 0;
	$counter++;
	
	$default_template = key( btp_post_get_collection_templates() );
	
	extract( shortcode_atts( array(			
		'entry_ids'			=> '',
		'template'			=> $default_template,
		'hide'				=> '',
		'lightbox_group'	=> 'custom_posts_lightbox'					
		), $atts
	));
		
	$out = '';
	
	$entry_ids = explode(',', $entry_ids);
	
	$query_args = array(
   		'post_type'				=> 'post',
  		'post__in'				=> $entry_ids,
  		'orderby'				=> 'none',
		'ignore_sticky_posts'	=> true,
	);					

	$query = new WP_Query($query_args);	

	if ( $query->have_posts() ) {
		btp_loop_before();	
		
		btp_part_set_vars( array(
			'query'				=> $query,
			'elems'				=> btp_post_get_collection_elements( $hide ),
			'lightbox_group' 	=> $lightbox_group,
		));
		
		/* Compose output */
		$template = preg_replace('/[^0-9a-zA-Z_-]/', '', $template);
		$template = str_replace( '-', '_', $template );
		
		ob_start();
		get_template_part('/lib/posts/templates/collection', $template);
		$out .= '<div id="custom-posts-shortcode-' . $counter .'" class="custom-posts-shortcode shortcode">';		
			$out .= ob_get_clean();
		$out .= '</div>';	
		
		btp_loop_after();
	}
	else {
		$out .= '<p class="no-results">'.__( 'No results found.', 'btp_theme' ).'</p>';	
	}
	
	return $out;
}
add_shortcode('custom_posts', 'btp_custom_posts_shortcode');



btp_shortgen_add_item(
	'popular_posts', 
	array(
		'label' 	=> '[popular_posts]',
		'atts' 		=> array(
			'max' 		=> array( 
				'view' 		=> 'String',
				'hint'		=> __( 'Maximum entries to display', 'btp_theme' ), 
			),			
	    	'template'	=> array( 
	    		'view' 		=> 'Choice', 
	    		'choices_cb'=> 'btp_post_get_collection_templates',
			),
			'hide'		=> array( 
				'view' 		=> 'String',
				'help' 			=> __('<p>You can hide following elements:</p><ul><li>title</li><li>featured_media</li><li>date</li><li>author</li><li>comments_link</li><li>summary</li><li>categories</li><li>tags</li><li>button_1</li></ul>', 'btp_theme'),
				'hint' 			=> __('Comma separated list of elements to hide', 'btp_theme'),
			),
		),
		'type' 		=> 'block',
		'group'		=> 'general',
		'subgroup'	=> 'posts',
		'position'	=> 110,
	)	
);



/**
 * Callback for popular_posts shortcode
 * 
 * @param 			array $atts
 * @param 			string $content
 * @return			string
 */
function btp_popular_posts_shortcode( $atts, $content = null ) {
	static $counter = 0;
	$counter++;
	
	$default_template = key( btp_post_get_collection_templates() );
	
	extract( shortcode_atts( array(
		'max'				=> 1,
		'template'			=> $default_template,
		'hide'				=> '',
		'lightbox_group'	=> 'popular_posts_lightbox'										
		), $atts
	));
		
	$out = '';
	
	$query_args = array(
   		'post_type'				=> 'post',
		'posts_per_page'		=> absint($max),  			
  		'orderby'				=> 'comment_count',
		'order'					=> 'desc',
		'ignore_sticky_posts'	=> true,
	);	

	global $query;
	
	/* Modify post query to consider only commented posts */
	add_filter( 'posts_where', 'btp_filter_where_commented_posts' );		    
	$query = new WP_Query($query_args);	

	if ( $query->have_posts() ) {
		/* Remove filter to not interfere with further post queries */
		remove_filter('posts_where', 'btp_filter_where_commented_posts');
		
		btp_loop_before();			
		
		btp_part_set_vars( array(
			'query'				=> $query,
			'elems'				=> btp_post_get_collection_elements( $hide ),
			'lightbox_group'	=> $lightbox_group,
		));	
		
		/* Compose output */
		$template = preg_replace( '/[^0-9a-zA-Z_-]/', '', $template );
		$template = str_replace( '-', '_', $template );
		
		ob_start();
		get_template_part( '/lib/posts/templates/collection', $template );
		$out .= '<div id="popular-posts-shortcode-' . $counter .'" class="popular-posts-shortcode shortcode">';					
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
add_shortcode('popular_posts', 'btp_popular_posts_shortcode');



btp_shortgen_add_item(
	'recent_posts', 
	array(
		'label' 	=> '[recent_posts]',
		'atts' 		=> array(
			'cat' 		=> array( 
				'view'		=> 'String',
				'hint'		=> __( 'Comma separated list of category IDs', 'btp_theme' ),
			),
			'max' 		=> array( 
				'view' 		=> 'String',
				'hint'		=> __( 'Maximum entries to display', 'btp_theme' ),  
			),			
	    	'template'	=> array( 
	    		'view' 		=> 'Choice', 
	    		'choices_cb'=> 'btp_post_get_collection_templates',
			),
			'hide'		=> array( 
				'view' 		=> 'String',
				'help' 			=> __('<p>You can hide following elements:</p><ul><li>title</li><li>featured_media</li><li>date</li><li>author</li><li>comments_link</li><li>summary</li><li>categories</li><li>tags</li><li>button_1</li></ul>', 'btp_theme'),
				'hint' 			=> __('Comma separated list of elements to hide', 'btp_theme'),				 
			),
		),
		'type' 		=> 'block',
		'group'		=> 'general',
		'subgroup'	=> 'posts',
		'position'	=> 120,
	)	
);



/**
 * Callback for recent_posts shortcode
 * 
 * @param 			array $atts
 * @param 			string $content
 * @return			string
 */
function btp_recent_posts_shortcode( $atts, $content = null ) {	
	static $counter = 0;
	$counter++;
	
	$default_template = key( btp_post_get_collection_templates() );
	
	extract( shortcode_atts( array(
		'cat'				=> '',
		'max'				=> 1,
		'template'			=> $default_template,
		'hide'				=> '',
		'lightbox_group'	=> 'recent_posts_lightbox'										
		), $atts ) );
		
	$out = '';
	
	$query_args = array(
   		'post_type'				=> 'post',
		'posts_per_page'		=> absint($max),  			
  		'orderby'				=> 'date',
  		'order'					=> 'desc',
  		'cat'					=> preg_replace('/[^0-9,\s]/', '', $cat),
		'ignore_sticky_posts'	=> true,
	);
	
	$query = new WP_Query($query_args);	
	
	if ( $query->have_posts() ) {
		
		btp_loop_before();			
		
		btp_part_set_vars( array(
			'query'				=> $query,
			'elems'				=> btp_post_get_collection_elements( $hide ),
			'lightbox_group'	=> $lightbox_group,
		));
		
		/* Compose output */
		$template = preg_replace('/[^0-9a-zA-Z_-]/', '', $template);
		$template = str_replace( '-', '_', $template );
		
		ob_start();
		get_template_part('/lib/posts/templates/collection', $template);
		$out .= '<div id="recent-posts-shortcode-' . $counter .'" class="recent-posts-shortcode shortcode">';					
			$out .= ob_get_clean();
		$out .= '</div>';				
		
		btp_loop_after();			
	} 
	else {
		$out .= '<p class="no-results">'.__( 'No results found.', 'btp_theme' ).'</p>';	
	}
	
	return $out;
}
add_shortcode('recent_posts', 'btp_recent_posts_shortcode');
	


btp_shortgen_add_item(
	'related_posts', 
	array(
		'label' 	=> '[related_posts]',
		'atts' 		=> array(
			'entry_id' 	=> array( 
				'view' 		=> 'String',
				'hint'		=> __( 'Entry ID - leave empty to use the current entry ID', 'btp_theme' ),  
			),
			'max' 		=> array( 
				'view' 		=> 'String',
				'hint'		=> __( 'Maximum entries to display', 'btp_theme' ), 
			),			
		    'template'	=> array( 
		    	'view' 		=> 'Choice', 
		    	'choices_cb'=> 'btp_post_get_collection_templates',
			),
			'hide'		=> array( 
				'view' 		=> 'String',
				'help' 			=> __('<p>You can hide following elements:</p><ul><li>title</li><li>featured_media</li><li>date</li><li>author</li><li>comments_link</li><li>summary</li><li>categories</li><li>tags</li><li>button_1</li></ul>', 'btp_theme'),
				'hint' 			=> __('Comma separated list of elements to hide', 'btp_theme'),
			),
		),
		'type' 		=> 'block',
		'group'		=> 'general',
		'subgroup'	=> 'posts',
		'position'	=> 130,
	)	
);



/**
 * Callback for related_posts shortcode
 * 
 * @param 			array $atts
 * @param 			string $content
 * @return			string
 */	
function btp_related_posts_shortcode( $atts, $content = null ) {
	static $counter = 0;
	$counter++;
	
	$default_template = key( btp_post_get_collection_templates() );
	
	extract( shortcode_atts( array(
		'entry_id'			=> 0,	
		'max'				=> 1,
		'template'			=> $default_template,
		'hide'				=> '',
		'lightbox_group'	=> 'related_posts_lightbox'										
		), $atts
	));
	
	$out = '';
			
	$related_ids = btp_relations_get_related_ids($entry_id, 'post', $max);
	if ( count( $related_ids ) ){
  		$query_args = array(
  			'posts_per_page'		=> 100,
   			'post_type'				=> 'post',
  			'post__in'				=> $related_ids,
  			'orderby'				=> 'none',
  			'ignore_sticky_posts'	=> true,
		);		
		$query = new WP_Query( $query_args );	
			
		if ( $query->have_posts() ) {					
			btp_loop_before();	
			
			btp_part_set_vars( array(			
				'query'				=> $query,
				'elems'				=> btp_post_get_collection_elements( $hide ),
				'lightbox_group'	=> $lightbox_group,
			));
			
			/* Compose output */
			$template = preg_replace('/[^0-9a-zA-Z_-]/', '', $template);
			$template = str_replace( '-', '_', $template );
			
			ob_start();
			get_template_part('/lib/posts/templates/collection', $template);
			$out .= '<div id="related-posts-shortcode-' . $counter .'" class="related-posts-shortcode shortcode">';					
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
add_shortcode('related_posts', 'btp_related_posts_shortcode');
?>