<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<div class="entry-meta meta-bottom">
	<?php get_template_part('templates/entry-meta/mini', 'date'); ?>
	<span class="before-author"><?php _e('by', 'dfd'); ?></span>
	<?php
		get_template_part('templates/entry-meta/mini', 'author');
	?>
	<span class="before-category"><?php _e('in', 'dfd'); ?></span>
	<?php get_template_part('templates/entry-meta/mini', 'category'); ?>
</div>