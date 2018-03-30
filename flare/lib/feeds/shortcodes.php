<?php
/**
 * This file is part of the BTP_Flare_Theme package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 */



/* Prevent direct script access */
if ( !defined( 'BTP_FRAMEWORK_VERSION' ) ) exit( 'No direct script access allowed' );



btp_shortgen_add_subgroup( 
	'feeds', 
	array( 
		'label' => __( 'Feeds', 'btp_theme' ),
	),  
	'general',
	800
);


btp_shortgen_add_item(	 
	'feeds',
	array(
		'label'			=> '[feeds]',
		'atts'			=> array(
			'include' 		=> array( 
				'view' 			=> 'String',
				'hint' 			=> __('Comma separated list of feeds to include', 'btp_theme'),
			),
			'exclude' 		=> array(
				'view'			=> 'String',
				'hint'		 	=> __('Comma separated list of feeds to exclude', 'btp_theme'),
			),
			'template'		=> array(
				'view' 			=> 'Choice',
				'choices_cb'	=> 'btp_feeds_get_collection_templates',
			),
			'hide'			=> array( 
				'view' => 'String',
				'help' => __('<p>You can hide following elements:</p><ul><li>icon</li><li>label</li><li>caption</li></ul>', 'btp_theme'),
				'hint' => __('Comma separated list of elements to hide', 'btp_theme')
			),
		),
		'display'		=> 'block',
		'group'			=> 'general',
		'subgroup'		=> 'feeds',
		'position'		=> 400,	
	)			 
); 



/**
 * Callback for feeds shortcode
 * 
 * @param 			array $atts
 * @param 			string $content
 * @return			string
 */
function btp_feeds_shortcode( $atts, $content = null ) {
	global $_BTP;
	
	$templates = btp_feeds_get_collection_templates();
	
	$feeds = array();

	/* Extract arguments */
	extract( shortcode_atts( array(			
		'include'			=> '',
		'exclude'			=> '',
		'template'			=> key($templates),
		'hide'				=> '',
		'linking'			=> 'default'			
	    ), $atts ) 
	);

	$hide = btp_string_to_bools($hide);
	
	/* Process the 'include' variable */		
	$include = explode(',', $include);
	foreach ( $include as $feed ) {	
		$feed = preg_replace('/[^a-zA-Z0-9_-]*/', '', $feed);	
			
		if( !empty( $feed ) ) {
			$val = btp_theme_get_option_value( 'feed_'.$feed );
			
			if ( strlen( $val['link'] ) ) {				
				$feeds[$feed] = $val;
			}				
		}
	}
	
	/* Populate 'feeds' array only if there are no feeds from the 'include' variable */
	if ( !count( $feeds ) ) {					
		foreach ( $_BTP[ 'theme_option_holder' ]->hierarchy[ 'feeds' ][ 'subgroups' ][ 'main' ][ 'items' ] as $item_id => $item_args ) {
			$config = (array) btp_theme_get_option_value( $item_id );
			
			if ( count( $config ) && strlen( $config[ 'link' ] ) ) {									
				$feeds[ str_replace( 'feed_', '', $item_id)] = $config;
			}			
		}
		
		/* Exclude feeds based on the 'exclude' variable */
		if ( count( $feeds ) ) {
			$exclude = explode(',', $exclude);
			foreach ( $exclude as $feed ) {
				$feed = preg_replace('/[^a-zA-Z0-9_-]*/', '', $feed);
				
				if ( isset($feeds[$feed] ) )
					unset($feeds[$feed]);
			}
		}			
	}
	

	/* Compose output */
	$out = '';	
	$css_class = '';
	$css_class .= 'feeds '.esc_attr($template);
	$css_class .= !isset( $hide['icon'] ) ? '' : ' no-icon';

	
	
	if ( count( $feeds ) ) {				
		$out .= '<ul class="'.$css_class.'">';
			
			foreach ( $feeds as $feed => $args ) {
				
				/* WPML fallback */
				if ( function_exists( 'icl_t' ) ) {
					$args['label'] = icl_t( 'btp_theme_options', 'feed_' . esc_attr($feed) . '[label]' );	
					$args['caption'] = icl_t( 'btp_theme_options', 'feed_' . esc_attr($feed) . '[caption]' );
				}
				
				$out .= '<li class="feed-'.esc_attr($feed).'">';					
				
				if ( !isset( $hide['label'] ) || !isset( $hide['icon'] ) ) {
					$linking = ( $args[ 'linking' ] == 'new-window' ) ? ' class="new-window"' : '';
											
					$out .= '<h5><a href="'.esc_url($args['link']).'" title="'.esc_attr($args['label']).'"'.$linking.'>';						
						if ( !isset( $hide['icon'] ) ) {
						 	$out .= '<img width="16" height="16" src="'.get_bloginfo('template_url').'/images/icons/'.$feed.'.png" alt="'.esc_attr($feed).'"/>';
						}			
						if ( !isset( $hide['label'] ) ) {				
							$out .= '<span>'.esc_html($args['label']).'</span>';
						}															 
					$out .= '</a></h5>';
				}
								
				if ( !isset( $hide['caption'] ) ) {
					$out .= '<span class="meta">'.esc_html($args['caption']).'</span>';
				}
					
				$out .= '</li>';
			}					
		$out .= '</ul>';
	}				
	return $out;
}
add_shortcode( 'feeds', 'btp_feeds_shortcode' );
?>