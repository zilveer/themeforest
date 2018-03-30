<?php
/**
 * The template for displaying a gallery carousel page builder block
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

// create a gallery carousel view
$view = new PeThemeViewGalleryCarousel();

$conf = 
	array(
		  "type" => "gallery",
		  "data" => (object) 
		  array(
				"id" => $data->id
				),
		  "settings" => (object) 
		  array(
				"layout" => $data->columns,
				"height" => 9/16,
				"delay" => 0
				)
		  );

if (!empty($data->caption)) {
	$conf["caption"] = (object) 
		array(
			  "title" => "ititle",
			  "description" => "caption"
			  );
}

$view->output((object) $conf);

?>