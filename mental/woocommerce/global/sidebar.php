<?php
/**
 * Sidebar template part
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<!-- sidebar -->
<aside class="sidebar" role="complementary">

	<div class="sidebar-widget">
		<?php if ( function_exists( 'dynamic_sidebar' ) ) { dynamic_sidebar( 'widget-area-woocommerce' ); } ?>
	</div>

</aside>
<!-- /sidebar -->
