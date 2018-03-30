<hr class="top-dashed">

<div class="container">

	<div class="row clear">

		<?php get_template_part( 'section', 'title' ); ?>

	</div><!-- row -->

	<div class="row clear">

		<?php if ( $i = get_retro_list( 'picks', get_the_id() ) ) : ?>

			<div class="slider">
				<div class="bxslider">

				<?php foreach ( $i as $item ) : ?>

					<figure><img src="<?php retro_get_media_url( $item->media, 'retro-slides' ); ?>" data-caption="<?php esc_attr_e( $item->caption ); ?>" <?php if ( $item->url ) echo 'data-url="' . esc_url( $item->url ) . '"' ?> alt="<?php esc_attr_e( $item->caption ); ?>"></figure>
				
				<?php endforeach; ?>

				</div>
			</div>

		<?php endif; ?>

		<?php

		$meta = get_post_meta( $post->ID, 'welcome', true );
		if ( isset( $meta['welcome-first'] ) || isset( $meta['welcome-second'] ) ) {

		?>

			<div class="welcome">

				<?php if ( ! isset( $meta['welcome-second'] ) ) : ?>

					<h2><?php echo '&#8220;' . $meta['welcome-first'] . '&#8221;' ?></h2>

				<?php elseif ( ! isset( $meta['welcome-first'] ) ) : ?>

					<h3><?php echo '&#8220;' . $meta['welcome-second'] . '&#8221;' ?></h3>

				<?php else : ?>

					<h2><?php echo '&#8220;' . $meta['welcome-first'] ?></h2>
					<h3><?php echo $meta['welcome-second'] . '&#8221;' ?></h3>					

				<?php endif; ?>

			</div> 

		<?php } ?>

	</div><!-- row -->

</div><!-- container -->

<hr class="bottom-dashed">  