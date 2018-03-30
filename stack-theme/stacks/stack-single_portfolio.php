<div class="stack stack-page-content" id="<?php echo $stack['id']; ?>">
<div class="container">
<div class="row">
	<div class="span8">
	<div class="padding-right-20">
		<?php 
			// Get Images
			$images_list = get_post_meta( get_the_ID(), '_info_gallery', true );
			if( is_array( $images_list ) ):
			$img_attr = wp_get_attachment_image_src($images_list[0], 'full');
		?>
		<div class="slides slide-with-pagination" data-effect="<?php echo theme_options('portfolio', 'img_slide_effect'); ?>" data-width="<?php echo $img_attr[1]; ?>" data-height="<?php echo $img_attr[2]; ?>" data-pagination="true" data-autoplay="true" data-interval="<?php echo theme_options('portfolio', 'img_slide_pause') * 1000; ?>" data-speed="<?php echo theme_options('portfolio', 'img_slide_animate_speed') * 1000; ?>">
		<?php foreach ($images_list as $image_id): ?>
			<div class="slide">
			<?php echo gen_responsive_image_block( $image_id, array(
					array( 'width' => 290, 'media' => '(max-width: 767px)' ),
					array( 'width' => 290*2, 'media' => '(max-width: 767px) and (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi)' ),
					array( 'width' => 466, 'media' => '(min-width: 768px)' ),
					array( 'width' => 466*2, 'media' => '(min-width: 768px) and (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi)' ),
					array( 'width' => 600, 'media' => '(min-width: 980px)' ),
					array( 'width' => 600*2, 'media' => '(min-width: 980px) and (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi)' )
					));
			?>
			</div>
		<?php endforeach; ?>
		</div><!-- .slides -->
		<?php endif; ?>
	</div>
	</div>

	<div class="span4">
		<?php the_content(); ?>

		<ul class="features-list">
			
			<?php 
				$feature_list = array();
				
				// Print Category
				$category_list = get_the_terms(get_the_ID(), 'portfolio_category');
				$category_detail = array();
				if( is_array( $category_list ) ) {
					foreach ($category_list as $category) {
						$category_detail[] = $category->name;
					}
					if( count($category_detail) > 0 ) {
						echo '<li><strong>' . __('Category', 'theme_front') . ':</strong> ';
						$counter = 0;
						foreach ($category_list as $cat) {
							if( $counter++ != 0 ) echo ' / ';
							echo $cat->name;
						}
						echo '</li>';
					}
				}

				// Print Date
				$publish_date = get_post_meta(get_the_ID(), '_info_publish_date');
				if( is_array($publish_date) && count($publish_date) > 0 ) {
					echo '<li><strong>' . __('Date', 'theme_front') . ': </strong> ' . date( get_option('date_format'), $publish_date[0] ) . '</li>';
				}

				// Print Customed Feature Details
				$features_list = get_post_meta( get_the_ID(), '_info_features_list', true );
				if( is_array($features_list) ) {
					foreach ($features_list as $feature) {
						echo '<li><strong>' . $feature['stack_title'] . ':</strong> ' . $feature['feature_detail'] . '</li>';
					}
				}
			?>

		</ul>

		<?php
			$bt_text = get_post_meta( get_the_ID(), '_info_button_text', true );
			if ( $bt_text != '' ) {
				$bt_link = get_post_meta( get_the_ID(), '_info_button_link', true );
				$bt_target = get_post_meta( get_the_ID(), '_info_button_target', true );

				if( trim($bt_link) == '' ){ $bt_link = '#'; }
				
				echo '<p><a href="' . $bt_link . '" class="button" target="' . $bt_target . '" >' . do_shortcode( $bt_text ) . '</a></p>';
			}
		?>

	</div>

</div>
</div>
</div><!-- .stack-page-content -->