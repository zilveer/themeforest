<div class="wrap" id="layout-panel-option">
    <h2><?php echo __( 'Layout Settings', 'yit' ) ?></h2>
    <?php wp_nonce_field( 'yit-layout-panel-option', 'panel_wpnonce' ); ?>
    <div id="layout-panel-frame">
        <div id="layout-settings-column" class="metabox-holder">
            <?php yit_get_template( '/admin/layout/page-list-view.php' ); ?>
        </div>
        <div id="layout-managment-liquid">
            <div id="poststuff">
                <div id="info-box" class="postbox">
                    <h3>Info</h3>
                    <div class="inside">
                        <?php _e('Choose a page from the right sidebar, to edit settings for Header, SEO, Layout ...','yit') ?>
                    </div>
                </div>
                <p id="message"></p>
                <form id="panel-form">
                    <?php  foreach ( $options as $box_id => $option ): ?>
                        <div id="<?php echo $box_id ?>" class="postbox disabled closed">
                            <div class="handlediv" title="<?php esc_attr_e( 'Click to toggle', 'yit' ); ?>"><br /></div>
                            <h3 class="hndle"><?php echo $option['label'] ?></h3>

                        </div>
                    <?php endforeach ?>

                </form>
            </div>
        </div>
    </div>
</div>