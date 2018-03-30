<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<div class="entry-meta">
	<?php get_template_part('templates/entry-meta/mini', 'date'); ?>
	<span><?php _e('by', 'dfd'); ?></span>
	<?php get_template_part('templates/entry-meta/mini', 'author'); ?>
	<span><?php _e('in', 'dfd'); ?></span>
	<?php
	get_template_part('templates/entry-meta/mini', 'category');
	get_template_part('templates/entry-meta/mini', 'comments');
	get_template_part('templates/entry-meta/mini', 'like');
	?>
</div>