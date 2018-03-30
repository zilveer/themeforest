<?php
//
// post tags
//
?>

<?php if( has_tag() ): ?>

<div class="post-tags">
	<div class="module-top clearfix">
		<h4 class="module-title"><?php _e( 'Tags', 'magzilla' ); ?></h4>
	</div><!-- module-top -->
	<div class="module-body">
		<?php the_tags('', ' ', ''); ?>
	</div><!-- module-body -->
</div><!-- post-tags -->

<?php endif; ?>