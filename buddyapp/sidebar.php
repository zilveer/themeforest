<?php
/**
 * The Sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Kleo
 * @since Kleo 1.0
 */
?>
<?php

$sidebar_name = apply_filters('kleo_sidebar_name', '0');
?>

<div <?php kleo_sidebar_class( 'sidebar sidebar-colors' ); ?>>
	<div class="inner-content widgets-container">
		<?php generated_dynamic_sidebar($sidebar_name);?>
	</div><!--end inner-content-->
</div><!--end sidebar-->

