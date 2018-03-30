<?php
/**
 * The Template Part for displaying search form.
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
<form method="get" id="searchform" action="<?php echo home_url(); ?>" role="search">
    <div class="g1-outer">
        <div class="g1-inner">
            <input type="text" value="" name="s" id="s" size="15" placeholder="<?php esc_attr( _e('Search...', 'g1_theme') ); ?>" />
            <div class="g1-form-actions">
                <input id="searchsubmit" class="g1-no-replace" type="submit" value="<?php _e( 'Search', 'g1_theme'); ?>" />
            </div>
        </div>
    </div>
</form>
