<?php

	$theme_settings = sleek_theme_settings();
	$post_classes = '';

	$post_classes .= ' sleek-animate-appearance sleek-fade-in-bottom-soft';

	$post_classes .= ' post--size-small';

	$image_light = get_post_meta( get_the_ID(), 'image_is_light', true );
	if( $image_light ){
		$post_classes .= ' image-light';
	}else{
		$post_classes .= ' image-dark';
	}

	$post_format = get_post_format();

?>



<article id="post-<?php the_ID(); ?>" <?php post_class( $post_classes ); ?>>
<div class="post__inwrap">

<?php switch ($post_format) {

	case 'video':

		get_template_part('format_head', 'video');

		echo '<div class="post__text">';

			get_template_part('post_meta', 'nodate');
			echo '<h2>';
				echo '<a href="'.get_the_permalink().'" title="'.get_the_title().'">';
					the_title();
				echo '</a>';
			echo '</h2>';
			sleek_wp_excerpt('sleek_excerpt_length');

		echo '</div>';

		break;

	case 'audio':

		get_template_part('format_head', 'audio');

		echo '<div class="post__text">';

			get_template_part('post_meta', 'nodate');
			echo '<h2>';
				echo '<a href="'.get_the_permalink().'" title="'.get_the_title().'">';
					the_title();
				echo '</a>';
			echo '</h2>';
			sleek_wp_excerpt('sleek_excerpt_length');

		echo '</div>';

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

		get_template_part('format_head');

		echo '<div class="post__text">';

			get_template_part('post_meta', 'nodate');
			echo '<h2>';
				echo '<a href="'.get_the_permalink().'" title="'.get_the_title().'">';
					the_title();
				echo '</a>';
			echo '</h2>';
			sleek_wp_excerpt('sleek_excerpt_length');

		echo '</div>';

		break;

}
?>



</div>
</article>