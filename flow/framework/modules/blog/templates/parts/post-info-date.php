<div class="eltd-post-info-date">
	<?php if(!flow_elated_post_has_title()) { ?>
	<a href="<?php the_permalink() ?>">
		<?php } ?>
		<?php the_time(get_option('date_format')); ?>
		<?php if(!flow_elated_post_has_title()) { ?>
	</a>
<?php } ?>
</div>