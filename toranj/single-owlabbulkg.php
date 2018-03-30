<?php
/**
 *  Single template page for bulk gallery
 * 
 * @package Toranj
 * @author owwwlab
 */


$owlabgal_meta = get_post_meta( get_the_ID() );
$owlabbulk_meta = unserialize($owlabgal_meta['_owlabbulkg_slider_data'][0]);
$config = $owlabbulk_meta['config'];
$imgs = $owlabbulk_meta['slider'];

$item_overlay = owlab_get_gallery_overlay($config['hover'],$config['icon']);

get_header(); 


//this is just on post so the loop can be here
if ( have_posts() ) : while( have_posts() ) : the_post();

			
	//which layout should we use here
	
		
		switch ( $config['layout'] ) {
			case 'grid':
				include(locate_template(OWLAB_TEMPLATES . '/bulk-gallery/single-grid.php'));
				break;

			case 'horizontal-scroll':
				include(locate_template(OWLAB_TEMPLATES . '/bulk-gallery/single-horizontal-scroll.php'));
				break;

			case 'slider':
				
				include(locate_template(OWLAB_TEMPLATES . '/bulk-gallery/single-slider.php'));
				break;

			default:
				include(locate_template(OWLAB_TEMPLATES . '/bulk-gallery/single-grid.php'));
				break;
		} 

	

endwhile; endif; 

get_footer(); 



?>