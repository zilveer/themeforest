<?php
/**
 * The template for displaying a section page builder block
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?>
<?php $t =& peTheme(); ?>
<?php $view = $t->view; ?>
<?php list($data,$items) = $t->template->data(); ?>

<?php if (!empty($data->title)): ?>
<h2><?php echo wp_kses_post($data->title);  ?></h2>
<?php endif; ?>

<?php 
if (isset($items) && is_array($items)) {
	foreach ($items as $item) {
		$view->outputModule($item);
	}
}
?>