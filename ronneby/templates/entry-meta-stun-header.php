<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<div class="entry-meta">
	<?php get_template_part('templates/entry-meta/mini', 'date'); ?>
	<span><?php _e('by', 'dfd'); ?></span>
	<?php get_template_part('templates/entry-meta/mini', 'author'); ?>
	<?php get_template_part('templates/entry-meta/mini', 'comments'); ?>
	<span class="entry-views"><?php get_template_part('templates/entry-meta/mini', 'views'); ?></span>
</div>