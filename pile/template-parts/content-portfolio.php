<?php
/**
 * The template for displaying each project in the portfolio archive.
 * @package Pile
 * @since   Pile 1.0
 */

global $post;

// We will use the hero background color as the border color on portfolio archives
$border_color = pile_get_the_hero_background_color();

//if this project has a featured image, we need to determine if it has a portrait aspect ratio
$image_is_portrait = false;
if ( has_post_thumbnail() ) {
	//we need to get the 'full' size since other sizes can get screwed by Jetpack (they return 0 sizes)
	$attachment = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
	if ( $attachment[2] >= $attachment[1] ) { //we will also treat square images as portrait
		$image_is_portrait = true;
	}
} ?>

<div class="pile-item-even-spacing">
<div class="pile-item-negative-spacing">

	<?php if ( $image_is_portrait ): ?>
	<div class="pile-item-portrait-spacing">
	<?php endif; ?>

    <div class="pile-item-wrap">
		<a href="<?php the_permalink(); ?>" class="pile-item-wrapper-link" style="border-color: <?php echo $border_color; ?>">

			<?php if ( has_post_thumbnail() ) {
			    $id = get_post_thumbnail_id( get_the_ID() );

				//just use a decent sized image
				$image_full_size = wp_get_attachment_image_src( $id, 'large-size' );
				$image_markup = '<img src="' . esc_url( $image_full_size[0] ) . '" alt="' . esc_attr( pile_get_img_alt( $id ) ) . '">';

				//add the responsive images <img> attributes (the srcset and sizes)
				$image_meta = get_post_meta( $id, '_wp_attachment_metadata', true );
				$image_markup = wp_image_add_srcset_and_sizes( $image_markup, $image_meta, $id ) . PHP_EOL;

				echo $image_markup;
			} ?>

			<div class="pile-item-content">
				<div class="pile-item-meta">
					<?php
					$categories = get_the_terms( get_the_ID(), 'pile_portfolio_categories' );
					if ( ! is_wp_error( $categories ) && ! empty( $categories ) ):
						echo '<ul class="meta">' . PHP_EOL;
						foreach ( $categories as $category ) {
							echo '<li class="meta-list__item">' . $category->name . '</li>' . PHP_EOL;
						};
						echo '</ul>' . PHP_EOL;
					endif ?>
				</div><!-- .pile-item-meta -->
				<h2 class="pile-item-title"><?php the_title(); ?></h2>
				<div class="pile-item-link"><span><?php esc_html_e( 'See More', 'pile' ); ?></span></div>
			</div><!-- .pile-item-content -->
			<span class="pile-item-bg"></span>
			<div class="pile-item-border" style="border-color: <?php echo $border_color; ?>"></div>
		</a>
	</div><!-- .pile-item-wrap -->

	<?php if ( $image_is_portrait ) : ?>
	</div><!-- .pile-item-portrait-spacing -->
	<?php endif; ?>

</div><!-- .pile-item-negative-spacing -->
</div><!-- .pile-item-even-spacing -->