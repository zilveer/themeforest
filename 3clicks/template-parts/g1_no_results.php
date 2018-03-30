<?php
/**
 * The Template Part for displaying the "No results" message, when there are no posts in the loop.
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
<p class="no-results">
    <?php _e( 'Apologies, but no results were found.', 'g1_theme' ); ?>
</p>