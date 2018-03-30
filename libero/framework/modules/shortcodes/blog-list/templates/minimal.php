<li class="mkd-blog-list-item clearfix">
	<div class="mkd-blog-list-item-inner">
		<div class="mkd-item-date-holder">
			<?php libero_mikado_post_info(array(
				'date' => 'yes',
			),'minimal'); ?>
		</div>
		<div class="mkd-item-text-holder">
			<a class="mkd-item-minimal-link" href="<?php echo esc_url(get_permalink()) ?>">
			</a>
			<<?php echo esc_attr($title_tag)?> class="mkd-item-title">
				<a href="<?php echo esc_url(get_permalink()) ?>" >
					<?php the_title(); ?>
				</a>
			</<?php echo esc_attr($title_tag) ?>>
			<div class="mkd-item-minimal-info">
				<?php
				libero_mikado_post_info(array(
					'category' => 'yes'
				));
				?>
			</div>
		</div>
	</div>	
</li>
