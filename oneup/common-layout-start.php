<?php
/**
 * Ends page layout according to page settings (fullwidth / sidebar)
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?>
<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $layout =& $t->layout; ?>

<?php if ($t->hasBgVideo()): ?>
<?php $t->get_template_part("bgvideo"); ?>
<?php endif; ?>

<div class="site-body">

	<?php if ($layout->title !== "no") $t->get_template_part("common","title"); ?>
	<?php if ($layout->content != "fullwidth"): ?>
	<div class="pe-container">
		<?php if ($layout->sidebar === "right"): ?>
		<?php $t->media->w(619); ?>
		<div class="row-fluid">
			<section class="span8">
		<?php endif; ?>
	<?php endif; ?>

