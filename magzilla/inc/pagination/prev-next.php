<?php  if(get_next_posts_link() || get_previous_posts_link()) : ?>
<div class="pagination-wrap module-top">
	
	<?php if( get_previous_posts_link() ) { ?>
	<div class="pagination pull-right">
		<?php previous_posts_link('New Entries'); ?>
	</div>
	<?php } ?>

	<?php if( get_next_posts_link() ) { ?>
	<div class="pagination pull-left">
		<?php next_posts_link( 'Old Entries' ); ?>
	</div>
	<?php } ?>

</div>
<?php endif; ?>