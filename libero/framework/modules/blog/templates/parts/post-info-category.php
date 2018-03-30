<?php if (has_category()){ ?>
<div class="mkd-post-info-category">
	<span class="mkd-post-info-icon icon-clock"></span>
	<?php esc_html_e('in ','libero'); ?><?php the_category(', '); ?>
</div>
<?php } ?>