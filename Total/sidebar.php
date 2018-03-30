<?php
/**
 * Main sidebar area containing your defined widgets.
 * You shouldn't have to edit this file ever since things are added via hooks.
 *
 * @package Total WordPress Theme
 * @subpackage Templates
 */ ?>

<?php wpex_hook_sidebar_before(); ?>

<aside id="sidebar" class="sidebar-container sidebar-primary"<?php wpex_schema_markup( 'sidebar' ); ?>>

	<?php wpex_hook_sidebar_top(); ?>

	<div id="sidebar-inner" class="clr">

		<?php wpex_hook_sidebar_inner(); ?>

	</div><!-- #sidebar-inner -->

	<?php wpex_hook_sidebar_bottom(); ?>

</aside><!-- #sidebar -->

<?php wpex_hook_sidebar_after(); ?>