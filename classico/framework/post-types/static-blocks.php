<?php  if ( ! defined('ET_FW')) exit('No direct script access allowed');
// **********************************************************************// 
// ! Static Blocks Post Type
// **********************************************************************// 

if(!function_exists('et_get_static_blocks')) {
    function et_get_static_blocks () {
        $return_array = array();
        $args = array( 'post_type' => 'staticblocks', 'posts_per_page' => 50);
        
		$myposts = get_posts( $args );
        $i=0;
        foreach ( $myposts as $post ) {
            $i++;
            $return_array[$i]['label'] = get_the_title($post->ID);
            $return_array[$i]['value'] = $post->ID;
        } 
        wp_reset_postdata();

        return $return_array;
    }
}


if(!function_exists('et_show_block')) {
    function et_show_block ($id = false) {
        echo et_get_block($id);
    }
}


if(!function_exists('et_get_block')) {
    function et_get_block($id = false) {
    	if(!$id) return;
    	
    	$output = false;
    	
    	$output = wp_cache_get( $id, 'et_get_block' );
    	
	    if ( !$output ) {
	   
	        $args = array( 'include' => $id,'post_type' => 'staticblocks', 'posts_per_page' => 1);
	        $output = '';
	        $myposts = get_posts( $args );
	        foreach ( $myposts as $post ) {
	        	setup_postdata($post);
				
	        	$output = do_shortcode(get_the_content($post->ID));
	        	
				$shortcodes_custom_css = get_post_meta( $post->ID, '_wpb_shortcodes_custom_css', true );
				if ( ! empty( $shortcodes_custom_css ) ) {
					$output .= '<style type="text/css" data-type="vc_shortcodes-custom-css">';
					$output .= $shortcodes_custom_css;
					$output .= '</style>';
				}
	        } 
	        wp_reset_postdata();
	        
	        wp_cache_add( $id, $output, 'et_get_block' );
	    }
	    
        return $output;
   }
}