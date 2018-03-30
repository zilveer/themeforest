<div class="st-format-image-holder">

	<?php if ( !defined( 'ABSPATH' ) ) exit;
	/*
	
		Post format: Image
	
	*/
	
	
	/*===============================================
	
		F E A T U R E D   I M A G E
		With different sizes dipends of some reasons
	
	===============================================*/
	
		if ( has_post_thumbnail() ) {
	
			$st_['large_image_url'] = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');


			/*-------------------------------------------
				on Post page:
				- sidebar(+)
				- sidebar(-)
			-------------------------------------------*/
	
			if ( is_single() ) {
		
				// if sidebar (+)
				if ( !$st_['sidebar_position'] || $st_['sidebar_position'] && $st_['sidebar_position'] != 'none' ) {
					echo '<a href="' . $st_['large_image_url'][0] . '" title="' . the_title_attribute( 'echo=0' ) . '">' . get_the_post_thumbnail( $post->ID, 'post-image', ( function_exists( 'st_get_2x' ) ? st_get_2x( $post->ID, 'post-image', 'array', 'size-original' ) : '' ) ) . '</a>'; }
	
				// if sidebar (-)
				else {
					echo '<a href="' . $st_['large_image_url'][0] . '" title="' . the_title_attribute( 'echo=0' ) . '">' . get_the_post_thumbnail( $post->ID, 'large', ( function_exists( 'st_get_2x' ) ? st_get_2x( $post->ID, 'large', 'array', 'size-original' ) : '' ) ) . '</a>'; }
		
			}


			/*-------------------------------------------
				on Arhive page:
				- blog page, sidebar(+)
				- blog page, sidebar(-)
				- archive
			-------------------------------------------*/
		
			else {
		
				// if blog
				if ( !empty( $st_['is_blog'] ) ) {
		
					// if sidebar (+)
					if ( !$st_['sidebar_position'] || $st_['sidebar_position'] && $st_['sidebar_position'] != 'none' ) {
						echo '<a href="' . $st_['large_image_url'][0] . '" title="' . the_title_attribute( 'echo=0' ) . '">' . get_the_post_thumbnail( $post->ID, 'archive-image', ( function_exists( 'st_get_2x' ) ? st_get_2x( $post->ID, 'archive-image', 'array', 'size-original' ) : '' ) ) . '</a>'; }
		
					// if sidebar (-)
					else {
						echo get_the_post_thumbnail( $post->ID, 'large', ( function_exists( 'st_get_2x' ) ? st_get_2x( $post->ID, 'large' ) : '' ) ); }
		
				}
		
				// if archive
				else {
	
					echo '<a href="' . $st_['large_image_url'][0] . '" title="' . the_title_attribute( 'echo=0' ) . '">' . get_the_post_thumbnail( $post->ID, 'archive-image', ( function_exists( 'st_get_2x' ) ? st_get_2x( $post->ID, 'archive-image', 'array', 'size-original' ) : '' ) ) . '</a>';
	
				}
		
			}


		}

	?>

</div>