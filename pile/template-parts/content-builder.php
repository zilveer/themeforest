<?php
/**
 * This template will output the content of a pixtypes builder
 */


global $post;
// the default key on pages and products
$key = '_pile_page_builder';

// pickup the right pix_builder meta key
switch ( get_post_type() ) {
	case 'pile_portfolio' :
		$key = '_pile_project_builder';
		break;
	default :
		break;
}

// Handle the extraction of the builder info
$builder_meta = get_post_meta( get_the_ID(), $key, true );
$builder_meta = json_decode( $builder_meta );

if ( ! empty( $builder_meta ) ) {
	$last_row = 1; // keep the a separate row index for comparison
	$last_size = 1; // keep the last block size
	$last_pos = 1; // keep the last block position
	$row_reset = 1;
	$order = 0; ?>
	<div class="pile  pile--single  js-gallery  entry-content">
		<?php
		foreach ( $builder_meta as $i => $block ) {
			// track a row reset
			if ( $block->row > $last_row ) {
				$last_row = $block->row;
				$row_reset = 1;
			}

			// lets check for whitespaces at the row start or between blocks
			$sum = (int) $last_size + (int) $last_pos;

			if ( $row_reset == 1 && $block->col > 1 ) {
				echo '<div class="pile-empty-first pile-item  pile-item--single ' . pile_get_block_size( $block->col - 1 ) . '"></div>';
			} elseif ( $sum < $block->col ) {
				echo '<div class="pile-empty-between pile-item  pile-item--single ' . pile_get_block_size( $block->col - ( $last_pos + $last_size ) ) . '">  </div>';
			}

			$row_reset ++;
			$last_size = $block->size_x;
			$last_pos  = $block->col;

			$size_class = pile_get_block_size( $block->size_x );

			if ( empty( $block->position ) ) {
				$block->position = array(
					'top'    => 0,
					'right'  => 0,
					'bottom' => 0,
					'left'   => 0,
				);
			} else {
				$block->position = (array) $block->position;
			}

			$positionClasses = 'top-' . $block->position['top'] . ' right-' . $block->position['right'] . ' bottom-' . $block->position['bottom'] . ' left-' . $block->position['left']; ?>

			<div class="pile-item  pile-item--single  <?php echo $positionClasses; ?>  size-<?php echo $block->size_x . ' one-whole  desk-' . $size_class . ' block-' . ++ $order . ' pile-col-' . $block->col; ?> type-<?php echo $block->type ?>">
				<?php
				if ( isset( $block->content ) ) {
					if ( $block->type == 'image' && is_numeric( $block->content ) ) {
						//the block's content should hold just the image ID
						$id     = $block->content;
						$markup = '';

						// We work with the full-size thumbnail size since we use the responsive images srcset markup
						$image_full_size = wp_get_attachment_image_src( $id, 'full-size' );
						// generate the basic <img> markup
						$image_markup = '<img src="' . esc_url( $image_full_size[0] ) . '" alt="' . esc_attr( pile_get_img_alt( $id ) ) . '">';
						// add the srcset and sizes attributes to the <img>
						$image_meta = get_post_meta( $id, '_wp_attachment_metadata', true );
						$markup .= wp_image_add_srcset_and_sizes( $image_markup, $image_meta, $id ) . PHP_EOL;

						$markup = wp_get_attachment_image( $id, 'full-size' );

						/* Now determine where to link the image and add special classes/attributes */

						$link_media_to_value = get_post_meta( $id, "_link_media_to", true );
						// init some vars
						$link_class = $the_link = $link_target = $data_autoplay = '';
						switch ( $link_media_to_value ) {

							case 'media_file':
								$link_class = 'mfp-link  mfp-image';
								$the_link   = $image_full_size[0];
								break;

							case 'custom_image_url':
								$link_class = 'mfp-link  mfp-image';
								$the_link   = get_post_meta( $id, "_custom_image_url", true );
								break;

							case 'custom_video_url':

								$video_autoplay = get_post_meta( $id, "_video_autoplay", true );
								$link_class     = 'mfp-link  mfp-video  mfp-iframe';
								$the_link       = get_post_meta( $id, "_video_url", true );

								if ( $video_autoplay == 'on' ) {
									$data_autoplay = 'data-autoplay="on"';
									$the_link .= '?autoplay=1';
								}

								break;

							case 'external':
								$link_class  = 'external';
								$the_link    = get_post_meta( $id, "_external_url", true );
								$link_target = 'target="_blank"';
								break;

							default:
								break;
						}

						// we wrap the markup in a link if that is the case
						if ( ! empty( $the_link ) ) {
							$attachment  = get_post( $id );
							$title       = $attachment->post_title;
							$description = $attachment->post_content;

							$markup = '<a href="' . $the_link . '" class="' . $link_class . '" ' . $link_target . ' data-title="' . $title . '" data-caption="' . $description . '" ' . $data_autoplay . '>' . $markup . '</a>';
						}

						// Display
						echo $markup;

					} elseif ( $block->type == 'editor' ) {
						// Display the processed content of a text block
						pile_display_content( $block->content );
					}
				} ?>

			</div><!-- .pile-item.pile-item--single -->
			<?php

			// get the next row count
			$next_block_row = $last_row+1;
			if ( isset( $builder_meta[$i+1] ) ) {
				$next_block = $builder_meta[$i+1];
				$next_block_row = $next_block->row;
			}

			// if the next block is on a different row brake the row
			if ( $next_block_row > $last_row ) {

				//and if there are whitespeces left, fill them
				if ( ( $last_size + $last_pos ) <= 6 ) {
					echo '<div class=" pile-empty-last pile-item  pile-item--single ' . pile_get_block_size( 7 - ( $last_size + $last_pos ) ) . '"></div>';
				}

				echo '<br><!-- row ends here -->';
			}
		} /* endforeach */ ?>
	</div><!-- .pile.pile--portfolio.entry-content -->
<?php }