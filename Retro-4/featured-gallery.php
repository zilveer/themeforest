<?php
$meta = get_post_meta( $post->ID, 'gallery', true );
$images = isset( $meta['images'] ) ? explode( ',', $meta['images'] ) : null;

if ( ! $images )
	return;
?>

<figure class="featured gallery">
	
	<?php the_post_thumbnail( 'retro-big' ); ?>
	
	<ul class="gallery-list clear <?php esc_attr_e( is_retro_post_type() ? 'half' : '' ); ?>">
	
		<?php foreach ( $images as $id ) : ?>
		
		<li>
					
			<img src="<?php echo reset( wp_get_attachment_image_src( $id, is_retro_post_type() ? 'retro-big' : null ) ); ?>" alt="" />
			
		</li>
		
		<?php endforeach; ?>
	
	</ul>

</figure>