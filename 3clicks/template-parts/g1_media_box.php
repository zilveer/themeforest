<?php
/**
 * The Template Part for displaying a list of  attachments in the Media box.
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
    global $post;

    $g1_data = g1_part_get_data();
    $g1_size = $g1_data['size'];
    $g1_force_placeholder = $g1_data['force_placeholder'];

    $g1_mediabox_items = g1_mediabox_items( $post->ID, $g1_data['size'] );
    $g1_mediabox_lightbox = g1_mediabox_lightbox( $post->ID, 'full' );

?>
<?php if ( count( $g1_mediabox_items ) ) : ?>
<?php
    /* Executes a custom hook.
     * If you want to add some content before a mediabox
     * hook into the 'g1_mediabox_before' action.
     */
    do_action( 'g1_mediabox_before' );
    ?>
<figure class="g1-mediabox g1-mediabox--list">
        <?php
        /* Executes a custom hook.
         * If you want to add some content at the beginning of a mediabox
         * hook into the 'g1_mediabox_begin' action.
         */
        do_action( 'g1_mediabox_begin' );
        ?>

        <?php if ( count($g1_mediabox_items) > 0 ): ?>
        <ol class="g1-mediabox__items">
            <?php foreach ( $g1_mediabox_items as $g1_index => $g1_item ): ?>
            <?php $g1_class = array_merge( array( ( $g1_index % 2 ) ? 'even' : 'odd'), $g1_item['class']  ); ?>
            <li class="g1-mediabox__item <?php echo sanitize_html_classes( $g1_class ); ?>">
                <?php echo $g1_item['html']; ?>
            </li>
            <?php endforeach; ?>
        </ol>
        <ol class="g1-lightbox-data">
            <?php foreach ( $g1_mediabox_lightbox as $g1_index => $g1_item ): ?>
                <li class="<?php echo sanitize_html_classes( $g1_item['class'] ); ?>">
                    <?php echo $g1_item['html']; ?>
                </li>
            <?php endforeach; ?>
        </ol>
        <?php elseif ($g1_force_placeholder): ?>
            <?php echo do_shortcode( '[placeholder icon="eye-close" size="' . esc_attr( $g1_size ) .  '"]' ); ?>
        <?php endif; ?>
        <?php
        /* Executes a custom hook.
         * If you want to add some content at the end of a mediabox
         * hook into the 'g1_mediabox_end' action.
         */
        do_action( 'g1_mediabox_end' );
        ?>
</figure><!-- .g1-mediabox -->
<?php
    /* Executes a custom hook.
     * If you want to add some content after a mediabox
     * hook into the 'g1_mediabox_after' action.
     */
    do_action( 'g1_mediabox_after' );
    ?>
<?php endif; ?>