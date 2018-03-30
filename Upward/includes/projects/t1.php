<?php if ( !defined( 'ABSPATH' ) ) exit;

	$out = "\n";
	$st_['featcount']++;


	/*-------------------------------------------
		PROJECT A
	-------------------------------------------*/

	if ( $st_['featcount'] == 1 ) {


		$out .= '<div class="projects-t1-a-wrapper">';


			// Feat image
			if ( has_post_thumbnail() ) {
		
				$st_['id'] = get_post_thumbnail_id( $post->ID );
				$st_['thumb'] = wp_get_attachment_image_src( $st_['id'], 'project-medium' );
				$st_['thumb'] = $st_['thumb'][0];

			}
		
			else {
		
				$st_['thumb'] = get_template_directory_uri() . '/assets/images/placeholder.png';
		
			}


			// Compose project
			$out .= '<a href="' . get_permalink() . '" class="project-thumb" ' . ( function_exists( 'st_get_2x' ) ? st_get_2x( $post->ID, 'project-medium', 'attr' ) : '' ) . ' style="background-image: url(' . $st_['thumb'] . ')" data-category="' . st_wp_get_post_terms( $post->ID, $st_['st_category'], false ) . '" title="' . get_the_title() . '">&nbsp;</a>';


		$out .= '</div>' . "\n";


	}


	/*-------------------------------------------
		PROJECTS B,C
	-------------------------------------------*/

	elseif ( $st_['featcount'] < 4 ) {


		$out .= '<div class="projects-t1-b-wrapper">';


			// Feat image
			if ( has_post_thumbnail() ) {
		
				$st_['id'] = get_post_thumbnail_id( $post->ID );
				$st_['thumb'] = wp_get_attachment_image_src( $st_['id'], 'project-thumb' );
				$st_['thumb'] = $st_['thumb'][0];
		
			}
		
			else {
		
				$st_['thumb'] = get_template_directory_uri() . '/assets/images/placeholder.png';
		
			}


			// Compose project
			$out .= '<a href="' . get_permalink() . '" class="project-thumb" ' . ( function_exists( 'st_get_2x' ) ? st_get_2x( $post->ID, 'project-thumb', 'attr' ) : '' ) . ' style="background-image: url(' . $st_['thumb'] . ')" data-category="' . st_wp_get_post_terms( $post->ID, $st_['st_category'], false ) . '" title="' . get_the_title() . '">&nbsp;</a>';


		$out .= '</div>' . "\n";


	}


	/*-------------------------------------------
		PROJECTS D,E,F...
	-------------------------------------------*/

	else {

		$st_['postcount']++;

		// Post's class
		$st_['class'] = '';
		if ( $st_['postcount'] == 1 ) { $st_['class'] = 'first'; }
		if ( $st_['postcount'] == 3 ) { $st_['class'] = 'last'; $st_['postcount'] = 0; }


		// Feat image
		if ( has_post_thumbnail() ) {
	
			$st_['id'] = get_post_thumbnail_id( $post->ID );
			$st_['thumb'] = wp_get_attachment_image_src( $st_['id'], 'project-thumb' );
			$st_['thumb'] = $st_['thumb'][0];
	
		}
	
		else {
	
			$st_['thumb'] = get_template_directory_uri() . '/assets/images/placeholder.png';
	
		}


		// Compose project
		$out .= '<div class="' . $st_['class'] . '">';

			$out .= '<a href="' . get_permalink() . '" class="project-thumb" ' . ( function_exists( 'st_get_2x' ) ? st_get_2x( $post->ID, 'project-thumb', 'attr' ) : '' ) . ' style="background-image: url(' . $st_['thumb'] . ')" data-category="' . st_wp_get_post_terms( $post->ID, $st_['st_category'], false ) . '" title="' . get_the_title() . '">&nbsp;</a>';

		$out .= '</div>' . "\n";


	}


	/*-------------------------------------------
		DISPLAY
	-------------------------------------------*/

	echo $out;


?>