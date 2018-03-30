<?php
/**
 * The template for displaying a services page builder block
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?>
<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php list($data) = $t->template->data(); ?>

<?php

// create a carousel view
$view = new PeThemeViewCarousel();

$conf["data"] = (object) 
	array(
		  "post_type" => "service"
		  );

if (!empty($data->id)) {
	$conf["data"]->id = $data->id;
}

$conf["settings"] = (object) 
	array(
		  "layout" => $data->columns,
		  "style" => 'services',
		  "delay" => 0
		  );

$view->output((object) $conf);

?>