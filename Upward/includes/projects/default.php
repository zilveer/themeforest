<?php if ( !defined( 'ABSPATH' ) ) exit;

	$out = "\n";
	$st_['postcount']++;


	// Post's class
	$st_['class'] = '';
	if ( $st_['postcount'] == 1 ) { $st_['class'] = ' first'; }
	if ( $st_['postcount'] == 3 ) { $st_['class'] = ' last'; $st_['postcount'] = 0; }


	// Feat image
	if ( has_post_thumbnail() ) {

		$st_['id'] = get_post_thumbnail_id( $post->ID );
		$st_['thumb'] = wp_get_attachment_image_src( $st_['id'], 'project-thumb' );
		$st_['thumb'] = $st_['thumb'][0];

	}

	else {

		$st_['thumb'] = get_template_directory_uri() . '/assets/images/placeholder.png';

	}


	/*-------------------------------------------
		COMPOSE PROJECT
	-------------------------------------------*/

	$out .= '<div class="project' . $st_['class'] . '"><div>';

		// Thumbnail
		$out .= '<a href="' . get_permalink() . '" class="project-thumb" ' . ( function_exists( 'st_get_2x' ) ? st_get_2x( $post->ID, 'project-thumb', 'attr' ) : '' ) . ' style="background-image: url(' . $st_['thumb'] . ')">' . get_the_title() . '</a>';

		// Info
		$out .= '<div class="div-as-table project-info"><div><div>';

			$out .= '<a href="' . get_permalink() . '" class="title">' . get_the_title() . '</a>';

			$out .= '<div class="meta">' . st_wp_get_post_terms( $post->ID, $st_['st_category'] ) . '</div>';

		$out .= '</div></div></div>';

	$out .= '</div></div>' . "\n";


	/*-------------------------------------------
		DISPLAY
	-------------------------------------------*/

	echo $out;


?>