<?php
/**
 * Main Header Layout Output
 * Have a look at framework/hooks/actions to see what is hooked into the header
 * See all header parts at partials/header/
 *
 * @package Total WordPress Theme
 * @subpackage Partials
 * @version 3.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<?php wpex_hook_header_before(); ?>

<header id="site-header" class="<?php echo wpex_header_classes(); ?>"<?php wpex_schema_markup( 'header' ); ?>>

	<?php wpex_hook_header_top(); ?>

	<div id="site-header-inner" class="container clr">

		<?php wpex_hook_header_inner(); ?>

	</div><!-- #site-header-inner -->

	<?php wpex_hook_header_bottom(); ?>

</header><!-- #header -->

<?php wpex_hook_header_after(); ?>