<?php
/**
 * Sidebar template part
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */
defined( 'ABSPATH' ) OR exit( 'restricted access' ); // Protect against direct call
?>

<!-- sidebar -->
<aside class="sidebar" role="complementary">

	<div class="sidebar-widget">
		<?php if ( function_exists( 'dynamic_sidebar' ) ) { dynamic_sidebar( 'widget-area-1' ); } ?>
	</div>

</aside>
<!-- /sidebar -->
