<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class( 'post clearfix' ); ?>>

	<a href="<?php the_permalink(); ?>">

		<?php if ( has_post_thumbnail() ) {

			$thumb = get_post_thumbnail_id();
			$img_url = wp_get_attachment_image_src( $thumb, 'full' ); 
			$retina = krown_retina();
			$img_size = $retina === 'true' ? array( 460, 300 ) : array( 230, 150 );

			echo '<img src="' . aq_resize( $img_url[0], $img_size[0], $img_size[1], true ) . '" alt="' . get_the_title() . '">';

		} ?>

		<div class="caption">
			<div>
				<h2><?php the_title(); ?></h2>
				<time class="post-time" datetime="<?php the_time( 'c' ); ?>"><?php the_time( __( 'jS \o\f F Y', 'krown' ) ); ?></time>
			</div>
		</div>

		<div class="post-arrow"><?php echo krown_svg( 'arrow_right' ); ?></div>

		<div class="post-back"></div>

	</a>

</div>