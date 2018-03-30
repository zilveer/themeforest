<?php
/**
 * The sidebar containing the forum widget area.
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
<?php if ( apply_filters( 'g1_sidebar_bbpress', true ) ): ?>
    <!-- BEGIN: #secondary -->
    <div id="secondary" class="g1-sidebar widget-area" role="complementary">
        <div class="g1-inner">
            <?php
            // Custom hook
            do_action( 'g1_sidebar_bbpress_begin' );

            g1_sidebar_render( 'bbpress' );

            // Custom hook
            do_action( 'g1_sidebar_bbpress_end' );
            ?>
        </div>
        <div class="g1-background">
            <div></div>
        </div>
    </div>
    <!-- END: #secondary -->
<?php endif;