<?php
	$day = 'd';
	$month = 'F';
?>

<div class="mkd-post-info-date">
	<?php if(!libero_mikado_post_has_title()) { ?>
	<a href="<?php the_permalink() ?>">
		<?php } ?>

		<span class="mkd-post-info-date-day"><?php the_time($day); ?></span>
		<span class="mkd-post-info-date-month"><?php the_time($month); ?></span>

		<?php if(!libero_mikado_post_has_title()) { ?>
	</a>
<?php } ?>
</div>