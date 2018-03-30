<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Theme03
 * @subpackage G1_Relations_Module
 * @since G1_Relations_Module 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php
    $g1_post_type = get_post_type();

    // Hide all elements except the title and the featured media
    $g1_hide = G1_Collection_Element_Manager()->get_default_values( $g1_post_type );
    unset( $g1_hide['title'] );
    unset( $g1_hide['featured-media'] );
    $g1_hide = implode( ',', array_keys( $g1_hide ) );

    $g1_out = G1_Related_Collection_Shortcode( $g1_post_type )->shortcode( array(
        'max' => 4,
        'template' => 'one-fourth',
        'hide' => $g1_hide,
    ), null);
?>
<?php if ( strlen( $g1_out ) ): ?>
    <aside class="g1-related-entries">
        <h3><?php _e( 'Related entries', 'g1_theme' ); ?></h3>
        <?php echo $g1_out; ?>
    </aside>
<?php endif; ?>