<?php if ( !defined( 'ABSPATH' ) ) exit;

	$out = "\n";
	$st_['featcount']++;


	// Post's class
	$st_['class'] = '';
	if ( $st_['featcount'] == 1 ) { $st_['class'] = ' odd'; }
	if ( $st_['featcount'] == 2 ) { $st_['class'] = ' even'; $st_['featcount'] = 0; }


	// Feat image
	if ( has_post_thumbnail() ) {

		$st_['id'] = get_post_thumbnail_id( $post->ID );
		$st_['thumb'] = wp_get_attachment_image_src( $st_['id'], 'project-medium' );
		$st_['thumb'] = $st_['thumb'][0];

	}

	else {

		$st_['thumb'] = get_template_directory_uri() . '/assets/images/placeholder.png';

	}


	/*-------------------------------------------
		COMPOSE PROJECT
	-------------------------------------------*/

	$out .= '<div class="project' . $st_['class'] . '">';

		// Thumbnail
		$out .= '<a href="' . get_permalink() . '" class="project-thumb" ' . ( function_exists( 'st_get_2x' ) ? st_get_2x( $post->ID, 'project-medium', 'attr' ) : '' ) . ' style="background-image: url(' . $st_['thumb'] . ')">&nbsp;</a>';

		// Info
		$out .= '<div class="div-as-table project-info"><div>';

			$out .= '<h3><a href="' . get_permalink() . '" class="title">' . get_the_title() . '</a></h3>';

			$out .= '<div class="meta">' . st_wp_get_post_terms( $post->ID, $st_['st_category'] ) . '</div>';

			$out .= wpautop( get_the_excerpt() );

		$out .= '</div></div><div class="clear"><!-- --></div>';

	$out .= '</div>' . "\n";


	/*-------------------------------------------
		DISPLAY
	-------------------------------------------*/

	echo $out;


?>