<ul class="list">
	<?php foreach( $posts as $post ) : ?>
	<?php
		$thb_thumbnail_image = thb_get_featured_image( 'micro', $post->ID );
	?>
		<li class="item<?php if( $thumb == 0 || empty($thb_thumbnail_image) ) : ?> no-thumb<?php endif; ?>">
			<article>
				<?php
					if( $thumb && !empty($thb_thumbnail_image) ) : ?>
					<a class="item-thumb" href="<?php echo get_permalink($post->ID); ?>">
						<span class="thb-overlay"></span>
						<img src="<?php echo $thb_thumbnail_image; ?>" alt="thumb">
					</a>
				<?php endif; ?>
				<div class="item-title">
					<h1>
						<a href="<?php echo get_permalink($post->ID); ?>">
							<?php echo apply_filters('the_title', $post->post_title); ?>
						</a>
					</h1>
					<p>
						<?php echo get_the_time( get_option('date_format'), $post->ID ); ?>
					</p>
				</div>
			</article>
		</li>
	<?php endforeach; ?>
</ul>