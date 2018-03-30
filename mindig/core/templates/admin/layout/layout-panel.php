<div id="poststuff">
    <div id="info-box" class="postbox">
        <h3>Info</h3>

        <div class="inside">
            <?php echo $current_panel['info'] ?>
        </div>
    </div>

    <p id="message"></p>

    <form id="panel-form">
        <?php wp_nonce_field( 'yit-layout-panel-save-option', 'wpnonce' ) ?>
        <input type="hidden" name="action" value="yit-layout-panel-save" />
        <input type="hidden" name="panel_id" value="<?php echo $current_panel['id'] ?>" />
        <input type="hidden" name="panel_type" value="<?php echo $current_panel['type'] ?>" />
        <input type="hidden" name="panel_model" value="<?php echo $current_panel['model'] ?>" />
        <?php  foreach ( $options as $box_id => $option ):
            if ( isset( $option['post_types'] ) && ! in_array( $current_panel['type'], (array) $option['post_types'] ) ) {
                continue;
            }
            ?>
            <div id="<?php echo $box_id ?>" class="postbox">
                <div class="handlediv" title="<?php esc_attr_e( 'Click to toggle', 'yit' ); ?>"><br /></div>
                <h3 class="hndle"><?php echo $option['label'] ?></h3>
                <div class="inside">
                    <?php
                    foreach ( $option['fields'] as $id_tab => $field ) :
                        if ( isset( $field['post_types'] ) && ! in_array( $current_panel['type'], (array) $field['post_types'] ) ) {
                            continue;
                        }
                        $value          = ( isset( $db_options[$box_id][$id_tab] ) ) ? $db_options[$box_id][$id_tab] : null;
                        $field['name']  = $prefix . 'options[' . $box_id . '][' . $id_tab . ']';
                        $field['id']    = $prefix . 'options_' . $box_id . '_' . $id_tab;
                        $field['prefix'] = $prefix . 'options_' . $box_id . '_';
                        $field['value'] = ( ! is_null( $value ) ) ? $value : ( isset( $field['std'] ) ? $field['std'] : '' );
                        ?>
                        <div class="panel-field <?php echo $field['type'] ?> clearfix<?php if ( empty( $field['label'] ) ) : ?> no-label<?php endif; ?>">
                            <?php yit_get_template( '/admin/layout/types/' . $field['type'] . '.php', array( 'field' => $field ) ) ?>
                        </div>
                    <?php endforeach ?>

                </div>
            </div>
        <?php endforeach ?>
        <input type="submit" class="button-primary" id="panel-form-submit" value="<?php _e( 'Save Changes', 'yit' ) ?>" style="float:left;margin-right:10px;" />
        <input type="submit" class="button-secondary" id="panel-form-clear-submit" value="<?php _e( 'Clear All Settings', 'yit' ) ?>" style="float:right;margin-right:10px;" />
        <span id="panel-form-spinner" class="spinner"></span>
    </form>
</div>

<script>jQuery(document).ready(function () {
        postboxes.add_postbox_toggles(pagenow);
    });</script>
