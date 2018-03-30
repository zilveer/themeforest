<?php
/**
 * The template used for displaying post content on archives
 *
 * @package Pile
 * @since   Pile 2.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'article  one-whole lap-one-half desk-one-third' ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>

		<?php
		$id = get_post_thumbnail_id( get_the_ID() );

		//we need to request the "full" size thumbnail (the original image) since this guarantees that we will get back the dimensions
		// Jetpack Photon removes those for all other sizes
		$image = wp_get_attachment_image_src( $id, 'full' );
		$image_width = $image[1];
		$image_height = $image[2];
		$style = 'style="padding-top: ' . 100 * $image_height / $image_width . '%"';
		?>

		<a class="article__image  article__link" <?php echo $style; ?> href="<?php the_permalink(); ?>">
			<?php
			// just use a decent sized image
			$image = wp_get_attachment_image_src( $id, 'large-size' );
			$image_markup = '<img src="' . esc_url( $image[0] ) . '" alt="' . esc_attr( pile_get_img_alt( $id ) ) . '">';
			$image_meta = get_post_meta( $id, '_wp_attachment_metadata', true );

			$image_markup = wp_image_add_srcset_and_sizes( $image_markup, $image_meta, $id ) . PHP_EOL;

			echo $image_markup;
			?>
		</a><!-- .article__image -->

	<?php endif; ?>

	<div class="article__wrap">

		<div class="article__meta">
			<?php pile_cats_list(); ?>

			<?php if ( pile_option( 'blog_show_date' ) ) : ?>
				<span class="article__date  meta meta--post"><?php the_time( 'j F' ); ?></span>
			<?php endif; ?>
		</div>

		<a class="article__link" href="<?php the_permalink(); ?>">

			<?php the_title('<h2 class="article__title">', '</h2>'); ?>

			<?php $read_more = pile_option( 'blog_read_more_text' );
			if ( ! empty( $read_more ) ): ?>
				<span class="article__more"><?php echo $read_more ?></span>
			<?php endif; ?>

		</a>

	</div><!-- .article__wrap -->

</article>