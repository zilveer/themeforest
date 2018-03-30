<div class="thb-shortcode <?php echo implode(' ', $class); ?>">
	<?php echo $content; ?>
	
	<ul class="list">
		<?php foreach( $items as $item ) : ?>
			<?php 
			$thumbnail_image = thb_get_post_thumbnail_src($item->ID, 'micro'); ?>
			<li class="item<?php if( $thumb == 0 || empty($thumbnail_image) ) : ?> no-thumb<?php endif; ?>">
				<?php
					if( $thumb && !empty($thumbnail_image) ) : ?>
					<a class="item-thumb" href="<?php echo get_permalink($item->ID); ?>">
						<span class="thb-overlay"></span>
						<img src="<?php echo $thumbnail_image; ?>" alt="thumb">
					</a>
				<?php endif; ?>
				<div class="item-title">
					<h1>
						<a href="<?php echo get_permalink($item->ID); ?>">
							<?php echo apply_filters('the_title', $item->post_title); ?>
						</a>
					</h1>
				</div>
			</li>
		<?php endforeach; ?>
	</ul>
</div>