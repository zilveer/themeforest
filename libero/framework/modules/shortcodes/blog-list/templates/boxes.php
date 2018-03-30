<li class="mkd-blog-list-item clearfix">
	<div class="mkd-blog-list-item-inner">
		<div class="mkd-item-image">
			<a href="<?php // echo esc_url(get_permalink()) ?>">
				<?php
					 echo get_the_post_thumbnail(get_the_ID(), $thumb_image_size);
				?>				
			</a>
		</div>
		<div class="mkd-item-text-holder">
			<<?php echo esc_attr($title_tag)?> class="mkd-item-title">
				<a href="<?php echo esc_url(get_permalink()) ?>" >
					<?php the_title(); ?>
				</a>
			</<?php echo esc_attr($title_tag) ?>>
			
			<div class="mkd-item-info-section">
				<?php libero_mikado_post_info(array(
					'date' => 'yes',
					'category' => 'yes',
					'author' => 'yes'
				)) ?>
			</div>
			
			<?php if ($text_length != '0') {
				$excerpt = ($text_length > 0) ? substr(get_the_excerpt(), 0, intval($text_length)) : get_the_excerpt(); ?>
				<p class="mkd-excerpt"><?php echo esc_html($excerpt)?>...</p>
			<?php } ?>
		</div>
	</div>	
</li>