<?php
/**
 * The sidebar containing the main widget area.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Framework
 * @subpackage G1_Theme03
 * @since G1_Theme03 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php
    // Custom hook
    do_action( 'g1_sidebar_1_before' );
?>
<?php if ( apply_filters( 'g1_sidebar_1', true ) ): ?>
<!-- BEGIN: #secondary -->
<div id="secondary" class="g1-sidebar widget-area" role="complementary">
	<div class="g1-inner">
		<?php
            // Custom hook
			do_action( 'g1_sidebar_1_begin' );

            $g1_sidebar = G1_Elements()->get( 'sidebar-1' );
            // Apply custom filter
            $g1_sidebar = apply_filters( 'g1_sidebar_1_id', $g1_sidebar );

            $g1_sidebar = ( empty( $g1_sidebar ) || true === $g1_sidebar ) ? 'primary' : $g1_sidebar;

			g1_sidebar_render( $g1_sidebar );

            // Custom hook
			do_action( 'g1_sidebar_1_end' );
		?>
	</div>
	<div class="g1-background">
        <div></div>
	</div>	
</div>
<!-- END: #secondary -->
<?php endif; ?>
<?php
    // Custom hook
    do_action( 'g1_sidebar_1_after' );
?>