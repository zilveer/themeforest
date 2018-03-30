<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<div class="dfd-meta-container">
	<div class="post-like-wrap left">
		<?php get_template_part('templates/entry-meta/mini', 'like'); ?>
		<div class="box-name"><?php _e('Recommend', 'dfd'); ?></div>
	</div>
	<div class="dfd-single-share left">
		<?php get_template_part('templates/entry-meta/mini', 'share-popup'); ?>
		<div class="box-name"><?php _e('Share', 'dfd'); ?></div>
	</div>
	<div class="dfd-single-tags right">
		<?php get_template_part('templates/entry-meta/mini', 'tags'); ?>
		<div class="box-name"><?php _e('Tagged in', 'dfd'); ?></div>
	</div>
</div>