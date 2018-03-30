<div class="eltd-single-tags-holder">
	<div class="eltd-tags">
		<?php
		$tags = wp_get_post_tags(get_the_ID());
		foreach ($tags as $tag){?>
			<a href="<?php echo esc_attr(get_tag_link($tag->term_id))?>" data-tag-slug ="<?php echo esc_attr($tag->slug); ?>">
				<span>
					<?php echo esc_attr($tag->name) ?>
				</span>
			</a>
		<?php }
		?>
	</div>
</div>