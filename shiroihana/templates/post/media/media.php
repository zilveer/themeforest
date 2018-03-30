<?php if( has_post_thumbnail() ):

	$featured_img_display = Youxi()->option->get( 'blog_featured_image_display' );
	if( ( is_single() && 'archive' == $featured_img_display ) || ( ! is_single() && 'single' == $featured_img_display ) ) {
		return;
	}

	$img_tag  = 'a';
	$img_attr = array();
	$img_behavior = Youxi()->option->get( 'blog_featured_image_behavior' );

	if( 'post' == $img_behavior && ! is_single() ) {
		$img_attr['href'] = get_permalink();
	} elseif( 'img' == $img_behavior ) {
		$img_attr['href'] = wp_get_attachment_url( get_post_thumbnail_id() );
		$img_attr['class'] = 'image-link';
	} else {
		$img_tag = 'span';
	}

	$img_html = '';
	foreach( (array) $img_attr as $key => $val ) {
		if( is_string( $val ) && ! is_numeric( $key ) ) {
			$img_html .= ' ' . $key . '="' . esc_attr( $val ) . '"';
		}
	}

?><section class="entry-media">

	<figure class="entry-media-image"><?php

		echo '<' . $img_tag . $img_html . '>';

			echo wp_get_attachment_image( get_post_thumbnail_id(), shiroi_thumbnail_size(), false, array( 'itemprop' => 'image' ) );

			if( 'img' == $img_behavior ):
				echo '<span class="overlay"><i class="fa fa-expand"></i></span>';
			endif;

		echo '</' . $img_tag . '>';

	?></figure>

</section>

<?php endif; ?>
