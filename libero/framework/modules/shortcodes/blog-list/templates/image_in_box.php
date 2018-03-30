<li class="mkd-blog-list-item clearfix">
	<div class="mkd-blog-list-item-inner">
		<div class="mkd-item-image clearfix">
			<a href="<?php echo esc_url(get_permalink()) ?>">
				<?php
					echo get_the_post_thumbnail(get_the_ID(), $thumb_image_size);
				?>
				<div class="mkd-post-info-date-holder">
					<div class="mkd-post-info-date-holder-inner">
						<?php libero_mikado_post_info(array(
							'date' => 'yes',
						)) ?>
					</div>
				</div>
			</a>
		</div>
		<div class="mkd-item-text-holder">
			<<?php echo esc_attr($title_tag)?> class="mkd-item-title ">
				<a href="<?php echo esc_url(get_permalink()) ?>" >
					<?php the_title(); ?>
				</a>
			</<?php echo esc_attr($title_tag) ?>>

			<?php if ($text_length != '0') {
				$excerpt = ($text_length > 0) ? substr(get_the_excerpt(), 0, intval($text_length)) : get_the_excerpt(); ?>
				<p class="mkd-excerpt"><?php echo esc_html($excerpt)?>...</p>
			<?php } ?>
			<div class="mkd-item-info-section">
				<?php libero_mikado_post_info(array(
					'comments' => 'yes'
				),'list') ?>
			</div>
		</div>
	</div>	
</li>
