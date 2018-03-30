<?php
$month = get_the_time('m');
$year = get_the_time('Y');
?>
<div itemprop="dateCreated" class="mkdf-post-info-date entry-date updated">
	<?php if(!hashmag_mikado_post_has_title()) { ?>
		<a itemprop="url" href="<?php the_permalink() ?>">
	<?php } else { ?>
		<a itemprop="url" href="<?php echo get_month_link($year, $month); ?>">
	<?php } ?>
	<?php 
	if ($date_format !== ''){
		the_time($date_format);
	}
	else{
		the_time(get_option('date_format'));
	} ?>
	<?php if(!hashmag_mikado_post_has_title()) { ?>
		</a>
	<?php } else { ?>
		</a>
	<?php } ?>
	<meta itemprop="interactionCount" content="UserComments: <?php echo get_comments_number(hashmag_mikado_get_page_id()); ?>"/>
</div>