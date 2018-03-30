<?php
/**
 * @package WordPress
 * @subpackage Origami_Theme
 */
?>
<aside class="grid_4 right sidebar_aside" id="sidebar">
  <div>
  <?php


	if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('WPEC Sidebar')): ?>

	<?php endif ?>

  </div>
</aside>