<?php
/* Template Name: Homepage - 3D Slider */

define('GAL_HOME', 1);
?>
<?php get_header(); ?>
<?php get_sidebar(); ?>
<div id="prevthumb"></div>
<div id="nextthumb"></div>

<!--Arrow Navigation-->
<a id="prevslide" class="load-item"></a>
<a id="nextslide" class="load-item"></a>

<div id="thumb-tray" class="load-item">
	<div id="thumb-back"></div>
	<div id="thumb-forward"></div>
</div>

<div id="loading"></div>
<div id="superslides"></div>

<?php get_footer(); ?>
