<?php

	$data_attrs = array(
		'url' => thb_photogallery_ajax_dataurl(),
	);

	if ( $force_isotope ) {
		$data_attrs['force-isotope'] = (int) $force_isotope;
	}

	$link_class = isset( $link_class ) ? $link_class : 'item-thumb';
?>

<div class="thb-photogallery">
	<?php if ( count( $slides ) > 0 ) : ?>
		<?php
			$thb_grid_layout_id = thb_grid_layout_id();
		?>
		<ul <?php if ( ! empty ( $thb_grid_layout_id ) ) : ?>id="<?php echo esc_attr( $thb_grid_layout_id ); ?>"<?php endif; ?> class="thb-photogallery-container thb-images-container <?php thb_grid_layout_class( $columns, $gutter, $height ); ?>" <?php thb_data_attributes( $data_attrs ); ?>>
			<?php foreach( $slides as $slide ) : ?>
				<li class="<?php thb_grid_layout_item_class(); ?>">
					<?php
						thb_image( $slide['id'], $image_size, array(
							'link'       => true,
							'link_class' => $link_class,
							'overlay'    => true,
							'link_title' => $slide['caption']
						) );
					?>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>

	<?php if ( $show_load_more ) : ?>
		<div id="thb-infinite-scroll-nav">
			<a href="#" id="thb-infinite-scroll-button" class="thb-infinite-scroll-button"><?php _e( 'Load more', 'thb_text_domain' ); ?></a>
		</div>
	<?php endif; ?>
</div>