<li class="eltd-blog-list-item clearfix">
	<div class="eltd-blog-list-item-inner">
		<div class="eltd-item-text-holder">
			<<?php echo esc_html( $title_tag)?> class="eltd-item-title">
				<a href="<?php echo esc_url(get_permalink()) ?>" >
					<?php echo esc_attr(get_the_title()) ?>
				</a>
			</<?php echo esc_html($title_tag) ?>>			
			<?php if ($text_length != '0') {
				$excerpt = ($text_length > 0) ? substr(get_the_excerpt(), 0, intval($text_length)) : get_the_excerpt(); ?>
				<p class="eltd-excerpt"><?php echo esc_html($excerpt)?>...</p>
			<?php } ?>
		</div>
	</div>	
</li>
