<?php

/**
 * Post (in loop) date - inner part
 *
 * @package wpv
 */

if(!wpv_get_optionb('meta_posted_on')) return;

$title = get_the_title();

?>

<div class="post-date">
	<?php if(empty($title)): ?>
		<a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>">
	<?php endif ?>
		<span class="top-part">
			<?php the_time('d') ?>
		</span>
		<span class="bottom-part">
			<?php the_time("m 'y") ?>
		</span>
	<?php if(empty($title)): ?>
		</a>
	<?php endif ?>
</div>