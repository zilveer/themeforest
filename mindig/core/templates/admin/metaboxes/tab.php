<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'YIT' ) ) {
    exit( 'Direct access forbidden.' );
}

global $post;

do_action( 'yit_before_metaboxes_tab' ) ?>
<div class="metaboxes-tab">
    <?php do_action( 'yit_before_metaboxes_labels' ) ?>
    <ul class="metaboxes-tabs clearfix"<?php if ( count( $tabs ) <= 1 ) : ?> style="display:none;"<?php endif; ?>>
        <?php
        $i = 0;
        foreach ( $tabs as $tab ) :
            if ( ! isset( $tab['fields'] ) || empty( $tab['fields'] ) ) {
                continue;
            }
            ?>
            <li<?php if ( ! $i ) : ?> class="tabs"<?php endif ?>>
            <a href="#<?php echo urldecode( sanitize_title( $tab['label'] ) ) ?>"><?php echo $tab['label'] ?></a></li><?php
            $i ++;
        endforeach;
        ?>
    </ul>
    <?php do_action( 'yit_after_metaboxes_labels' ) ?>
    <?php do_action( 'yit_before_metabox_option_' . urldecode( sanitize_title( $tab['label'] ) ) ); ?>


    <?php
    // Use nonce for verification
    wp_nonce_field( 'metaboxes-fields-nonce', 'yit_metaboxes_nonce' );
    ?>
    <?php foreach ( $tabs as $tab ) :


        ?>
        <div class="tabs-panel" id="<?php echo urldecode( sanitize_title( $tab['label'] ) ) ?>">
            <?php
            if ( ! isset( $tab['fields'] ) ) {
                continue;
            }
            foreach (  $tab['fields'] as $id_tab=>$field ) :
                $value           = yit_get_post_meta( $post->ID, $field['id'] );
                $field['value'] = $value != '' ? $value : ( isset( $field['std'] ) ? $field['std'] : '' );
                ?>
                <div class="the-metabox <?php echo $field['type'] ?> clearfix<?php if ( empty( $field['label'] ) ) : ?> no-label<?php endif; ?>">
                    <?php yit_get_template( 'admin/metaboxes/types/' . $field['type'] . '.php', array( 'args' => $field ) ) ?>
                </div>
            <?php endforeach ?>
        </div>
    <?php endforeach ?>
    <?php do_action( 'yit_after_metabox_option_' . urldecode( sanitize_title( $field['label'] ) ) ) ?>
</div>