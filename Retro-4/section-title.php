<?php $meta = get_post_meta( $post->ID, 'stream', true ); ?>

<?php if ( isset( $meta['kind'] ) && $meta['kind'] == 'slider' ) : ?>

	<?php $meta = get_post_meta( $post->ID, 'banner', true ); ?>

	<?php if ( isset( $meta['imgbanner'] ) ) : ?>

		<div class="banner">										

			<?php if ( isset( $meta['banner'] ) ) : ?>

				<?php $alt = get_post_meta( $meta['banner'], '_wp_attachment_image_alt', true ); ?>		

				<?php if ( ! isset( $meta['banner-retina'] ) ) : ?>

					<img src="<?php echo reset( wp_get_attachment_image_src( $meta['banner'], 'full' ) ); ?>" alt="<?php echo $alt ?>">

				<?php else : ?>

					<img data-x2="<?php echo reset( wp_get_attachment_image_src( $meta['banner-retina'], 'full' ) ); ?>" src="<?php echo reset( wp_get_attachment_image_src( $meta['banner'], 'full' ) ); ?>" alt="<?php echo $alt ?>">

				<?php endif; ?>					

			<?php else : ?>

				<img data-x2="<?php echo get_template_directory_uri() . '/images/banner-x2.png' ?>" src="<?php echo get_template_directory_uri() . '/images/banner.png' ?>" alt="Retro Banner">	

			<?php endif; ?>	

		</div>						

	<?php else : ?>

		<h2 class="section-title <?php if ( op_theme_opt( 'multiple-borders' ) ) { echo 'retro-borders'; } ?>"><?php echo get_the_title(); ?></h2>

	<?php endif; ?>

	<?php echo retro_get_ribbon( $post->ID ); ?>

<?php elseif ( is_home() ) : ?>

	<h2 class="section-title <?php if ( op_theme_opt( 'multiple-borders' ) ) { echo 'retro-borders'; } ?>"><?php echo get_the_title( get_queried_object() ); ?></h2>

	<div class="separator"><span>&times;&times;&times;</span></div>

	<div class="section-subtitle"><?php echo retro_get_headline( get_queried_object() ); ?></div>

<?php else : ?>

	<h2 class="section-title <?php if ( op_theme_opt( 'multiple-borders' ) ) { echo 'retro-borders'; } ?>"><?php echo get_the_title(); ?></h2>

	<div class="separator"><span>&times;&times;&times;</span></div>
	
	<div class="section-subtitle"><?php echo retro_get_headline( $post->ID ); ?></div>

<?php endif; ?>