<div class="thb-shortcode thb-single-id <?php echo implode(' ', $class); ?>">
	<?php echo $content; ?>

	<?php foreach( $items as $item ) : ?>
		<div class="item">
			<?php if( !isset($thumb) || $thumb ) : ?>
				<?php $post_featured_image = thb_get_post_thumbnail_src($item->ID, 'large'); ?>
				<?php if( !empty($post_featured_image) ) : ?>
					<a href="<?php echo $post_featured_image ?>" class="item-thumb" title="<?php echo apply_filters('the_title', $item->post_title); ?>">
						<img src="<?php echo $post_featured_image ?>" alt="">
					</a>
				<?php endif; ?>
			<?php endif; ?>

			<?php if( !isset($caller) || $caller != 'widget' ) : ?>
				<h1 class="thb-shortcode-title">
					<a href="<?php echo get_permalink($item->ID); ?>">
						<?php echo apply_filters('the_title', $item->post_title); ?>
					</a>
				</h1>
			<?php endif; ?>

			<div class="thb-text">
				<?php thb_the_excerpt($item); ?>

				<p>
					<a href="<?php echo get_permalink($item->ID); ?>" class="thb-read-more"><?php _e( 'More', 'thb_text_domain' ); ?></a>
				</p>
			</div>
		</div>
	<?php endforeach; ?>
</div>