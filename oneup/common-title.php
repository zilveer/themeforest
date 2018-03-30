<?php
/**
 * Shows page title
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?>
<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>

<div class="page-title">
	<div class="pe-container">
		<h1>
			<?php if ($t->layout->pageTitle): ?>
			<?php echo $t->layout->pageTitle; ?>
			<?php elseif (is_singular()): ?>
			<?php $t->content->title(); ?>
			<?php elseif (is_home() || is_category() || is_tag()): ?>
			<?php _e("Our Blog",'Pixelentity Theme/Plugin'); ?>
			<?php elseif (is_search()): ?>
			<?php _e("Search Results",'Pixelentity Theme/Plugin'); ?>
			<?php elseif (is_404()): ?>
			<?php _e("Page Not Found",'Pixelentity Theme/Plugin'); ?>
			<?php else: ?>
			&nbsp;
			<?php endif; ?>
		</h1>
	</div>
</div>
