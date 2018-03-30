<?php
/**
 *  Single template page for portfolio
 * 
 * @package Toranj
 * @author owwwlab
 */

$owlabpfl_meta = get_post_meta( get_the_ID() ); 

get_header(); 

//this is just on post so the loop can be here
if ( have_posts() ) : while( have_posts() ) : the_post();

			
	//which layout should we use here
	if (array_key_exists('owlabpfl_layout', $owlabpfl_meta)){
		
		switch ( $owlabpfl_meta["owlabpfl_layout"][0] ) {
			case 'rightside':
				include(locate_template(OWLAB_TEMPLATES . '/portfolio/single-rightside.php'));
				break;

			case 'leftside':
				include(locate_template(OWLAB_TEMPLATES . '/portfolio/single-leftside.php'));
				break;

			case 'regular-light':
				include(locate_template(OWLAB_TEMPLATES . '/portfolio/single-regular-light.php'));
				break;
			case 'regular-dark':
				include(locate_template(OWLAB_TEMPLATES . '/portfolio/single-regular-dark.php'));
				break;
			case 'full-light':
				include(locate_template(OWLAB_TEMPLATES . '/portfolio/single-full-light.php'));
				break;
			case 'full-dark':
				include(locate_template(OWLAB_TEMPLATES . '/portfolio/single-full-dark.php'));
				break;
			default:
				include(locate_template(OWLAB_TEMPLATES . '/portfolio/single-leftside.php'));
				break;
		} 

	}else{
		include(locate_template(OWLAB_TEMPLATES . '/portfolio/single-leftside.php'));
	}

endwhile; endif; 

get_footer(); ?>