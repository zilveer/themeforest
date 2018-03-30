<?php

// Add deafult 1/4 grid classes
$class = "col col-3 tablet-col-6 mobile-full";

$meta = get_post_meta( $post->ID, 'link', true );
if ( get_post_format() == 'link' ) {
	$href = $meta['url'];
	if ( isset( $meta['target'] ) ) {
		$newpage = 'target="_blank"';
	} else {
		$newpage = 'target="_self"';
	}
}
else {
	$href = get_permalink();
}

// Define post format behaviour
if ( get_post_format() == 'link' ) {
	$icon = 'clip';
}
else if ( get_post_format() == 'image' ) {
	$icon = 'photo';
	$class = $class . " lightbox";
}
else if ( get_post_format() == 'gallery' ) {
	$icon = 'gallery';
	$class = $class . " lightbox";
}
else if ( get_post_format() == 'video' ) {
	$icon = 'tv';
	$class = $class . " lightbox";
}
else {
	$icon = 'note';	
}

?>

<li id="item-<?php the_ID(); ?>" class="<?php isset( $class ) ? esc_attr_e( $class ) : null; ?>" data-cat="<?php esc_attr_e( implode( ' ', wp_get_post_terms( $post->ID, 'tags-' . get_retro_post_type_page(), array( 'fields' => 'slugs' ) ) ) ); ?>">
		
	<a href="<?php echo esc_url( $href ); ?>" <?php isset( $newpage ) ? esc_attr_e( $newpage ) : null; ?>>

		<?php the_post_thumbnail(); ?>

		<span class="icon retroicon-<?php echo $icon; ?>"></span>

		<h3><?php the_title(); ?></h3>

	</a>


	<?php 

	if ( get_post_format() == 'gallery' ) :

		$meta = get_post_meta( $post->ID, 'gallery', true );
		$images = isset( $meta['images'] ) ? explode( ',', $meta['images'] ) : null;

		if ( ! $images )
			return;
	?>

		<span class="hidden-gallery hidden">

			<?php foreach ( $images as $id ) : ?>
					
				<a class="mfp-image" href="<?php echo reset( wp_get_attachment_image_src( $id, 'full' ) ); ?>"></a>
			
			<?php endforeach; ?>

		</span>

	<?php

	elseif ( get_post_format() == 'image' ) :

		$meta = get_post_meta( $post->ID, 'image', true );
		$image = isset( $meta['image'] ) ? $meta['image'] : null;

		if ( ! $image )
		return;

	?>

		<span class="hidden-gallery hidden">
					
			<a class="mfp-image" href="<?php echo reset( wp_get_attachment_image_src( $image, 'full' ) ); ?>"></a>
			
		</span>	

	<?php

	elseif ( get_post_format() == 'video' ) :

		$meta = get_post_meta( $post->ID, 'video', true );
		$href = $meta['url'];

		if ( ! $href )
		return;

	?>

		<span class="hidden-gallery hidden">
					
			<a class="mfp-iframe" href="<?php echo esc_url( $href ); ?>"></a>
			
		</span>		

	<?php endif; ?>

</li>