<?php
/**
 * The template for displaying a single slide custom post type.
 *
 * Only meant for preview purposes since one wouldn't use a slide cpt on its own
 * but just group one or more into a slider view
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?>
<?php get_header(); ?>

<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>

<?php while ($content->looping() ) : ?>

<?php $meta =& $content->meta(); ?>
<?php if (empty($meta->layers)) break; ?>
<?php $layers =& $meta->layers; ?>
<?php $boxed = empty($layers->layout) ? true : ($layers->layout === "boxed"); ?>
<?php $boxed = $content->hasFeatImage() ? $boxed : false; ?>
<?php list($w,$h) = explode("x",$layers->preview); ?>


<?php $t->layout->content = $boxed ? "boxed" : "fullwidth"; ?>
<?php $t->get_template_part("common","layout-start"); ?>

<?php 

// create a slider view with a single slide (this one)
$view = new PeThemeViewSliderVario();

$conf["data"] = (object) 
	array(
		  "id" => array(get_the_id()),
		  "post_type" => "slide"
		  );

$conf["settings"] = (object) 
	array(
		  "layout" => $boxed ? "boxed" : "fullwidth",
		  "max" => $h,
		  "min" => 0,
		  );

$view->output((object) $conf);
?>

<?php $t->get_template_part("common","layout-end"); ?>

<?php endwhile; ?>
<?php get_footer(); ?>