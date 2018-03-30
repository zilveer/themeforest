<?php
/**
 * The Template Part for displaying the precontent.
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
    ob_start();
    do_action( 'g1_precontent' );
    $g1_precontent = trim( ob_get_clean() );
?>

<!-- BEGIN #g1-precontent -->
<div id="g1-precontent" class="g1-precontent">
    <?php echo $g1_precontent; ?>
    <?php get_template_part( 'template-parts/g1_background', 'precontent' ); ?>
</div>
<!-- END #g1-precontent -->