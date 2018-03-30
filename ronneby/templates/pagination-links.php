<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
	$prev_post = get_previous_post();
	$next_post = get_next_post();
	$prev_post_link = !empty($prev_post) ? get_permalink($prev_post->ID) : false;
	$next_post_link = !empty($next_post) ? get_permalink($next_post->ID) : false;
	$prev_post_title = !empty($prev_post) ? get_the_title($prev_post->ID) : false;
	$next_post_title = !empty($next_post) ? get_the_title($next_post->ID) : false;
	$prev_post_thumb = !empty($prev_post) ? get_the_post_thumbnail($prev_post->ID, 'thumbnail', array(42,42)) : false;
	$next_post_thumb = !empty($next_post) ? get_the_post_thumbnail($next_post->ID, 'thumbnail', array(42,42)) : false;
	if(!empty($prev_post) && is_object($prev_post) && empty($prev_post_thumb)) $prev_post_thumb = prev_next_post_format_icon($prev_post->ID);
	if(!empty($next_post) && is_object($next_post) && empty($next_post_thumb)) $next_post_thumb = prev_next_post_format_icon($next_post->ID);
?>
<div class="dfd-controls-top mobile-hide">
	<?php if(!empty($prev_post_link)) : ?>
		<a href="<?php echo esc_url($prev_post_link); ?>" class="page-inner-nav nav-prev">
			<div class="dfd-controler prev">
				<div class="thumb prev">
					<?php echo $prev_post_thumb; ?>
				</div>
			</div>
			<div class="pagination-title">
				<div class="dfd-vertical-aligned">
					<div class="box-name"><?php echo $prev_post_title; ?></div>
				</div>
			</div>
		</a>
	<?php endif; ?>
	<?php if(!empty($next_post_link)) : ?>
		<a href="<?php echo esc_url($next_post_link); ?>" class="page-inner-nav nav-next">
			<div class="dfd-controler next">
				<div class="thumb next">
					<?php echo $next_post_thumb; ?>
				</div>
			</div>
			<div class="pagination-title">
				<div class="dfd-vertical-aligned">
					<div class="box-name"><?php echo $next_post_title; ?></div>
				</div>
			</div>
		</a>
	<?php endif; ?>
</div>