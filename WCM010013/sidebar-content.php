<?php
/**
 * The Content Sidebar
 *
 * @package WordPress
 * @subpackage TemplateMela
 * @since TemplateMela 1.0
 */

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}
?>

<div id="content-sidebar" class="content-sidebar widget-area" role="complementary">
  <?php dynamic_sidebar( 'sidebar-2' ); ?>
</div>
<!-- #content-sidebar -->
