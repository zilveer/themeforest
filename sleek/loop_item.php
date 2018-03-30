<?php

	$theme_settings = sleek_theme_settings();
	$post_classes = '';

	$post_classes .= ' sleek-animate-appearance sleek-fade-in-bottom-soft';

	$post_classes .= ' post--size-large';

	$image_light = get_post_meta( get_the_ID(), 'image_is_light', true );
	if( $image_light ){
		$post_classes .= ' image-light';
	}else{
		$post_classes .= ' image-dark';
	}

	$post_format = get_post_format();



	/* 	Check if post__media exists
	/*------------------------------------------------------------*/

	if( $post_format == 'video' || $post_format == 'audio' ){
		if( get_post_meta( get_the_ID(), 'format_embed_url', true ) || has_post_thumbnail() ){
			$post_classes .= ' post--media-true';
		}else{
			$post_classes .= ' post--media-false';
		}

		// check if embed exists
		if( get_post_meta( get_the_ID(), 'format_embed_url', true ) ){
			$post_classes .= ' post--embed-true';
		}else{
			$post_classes .= ' post--embed-false';
		}
	}

	if( !$post_format ){ // standard post format
		if( has_post_thumbnail() ){
			$post_classes .= ' post--media-true';
		}else{
			$post_classes .= ' post--media-false';
		}
	}

?>





<article id="post-<?php the_ID(); ?>" <?php post_class( $post_classes ); ?>>
<div class="post__inwrap">



<?php switch ($post_format) {

	case 'video':

		get_template_part('post_meta');
		echo '<h2>';
			echo '<a href="'.get_the_permalink().'" title="'.get_the_title().'">';
				the_title();
			echo '</a>';
		echo '</h2>';

		get_template_part('format_head', 'video');

		echo '<div class="post__text">';
			sleek_wp_excerpt('sleek_excerpt_length', false);
			echo '<a href="' . get_the_permalink() . '" title="' . get_the_title() . '" class="read-more--continue">' . __( 'Continue Reading', 'sleek' ) . '</a>';
		echo '</div>';

		echo '<div class="separator"></div>';

		break;

	case 'audio':

		get_template_part('post_meta');
		echo '<h2>';
			echo '<a href="'.get_the_permalink().'" title="'.get_the_title().'">';
				the_title();
			echo '</a>';
		echo '</h2>';

		get_template_part('format_head', 'audio');

		echo '<div class="post__text">';
			sleek_wp_excerpt('sleek_excerpt_length', false);
			echo '<a href="' . get_the_permalink() . '" title="' . get_the_title() . '" class="read-more--continue">' . __( 'Continue Reading', 'sleek' ) . '</a>';
		echo '</div>';

		echo '<div class="separator"></div>';

		break;

	case 'image':
		get_template_part('format_head', 'image');
		break;

	case 'quote':
		echo '<h2 class="hidden">'.get_the_title().'</h2>';
		get_template_part('format_head', 'quote');
		break;

	case 'status':
		echo '<h2 class="hidden">'.get_the_title().'</h2>';
		get_template_part('format_head', 'status');
		break;

	case 'aside':
		echo '<h2 class="hidden">'.get_the_title().'</h2>';
		get_template_part('format_head', 'aside');
		break;

	case 'link':
		get_template_part('format_head', 'link');
		break;

	default:

		get_template_part('post_meta');
		echo '<h2>';
			echo '<a href="'.get_the_permalink().'" title="'.get_the_title().'">';
				the_title();
			echo '</a>';
		echo '</h2>';

		get_template_part('format_head');

		echo '<div class="post__text">';
			sleek_wp_excerpt('sleek_excerpt_length', false);
			echo '<a href="' . get_the_permalink() . '" title="' . get_the_title() . '" class="read-more--continue">' . __( 'Continue Reading', 'sleek' ) . '</a>';
		echo '</div>';

		echo '<div class="separator"></div>';

	break;
}
?>



</div>
</article>
