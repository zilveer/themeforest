<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 08/01/16
 * Time: 4:24 PM
 */
global $post_meta_data, $prop_description;
$documents_download = houzez_option('documents_download');

if( !empty( $prop_description ) ) {
?>
<div id="description" class="property-description detail-block">
    <div class="detail-title">
        <h2 class="title-left"><?php esc_html_e( 'Description', 'houzez' ); ?></h2>
    </div>

    <?php the_content(); ?>

    <?php if( !empty($post_meta_data['fave_attachments']) ): ?>
    <div class="detail-title-inner">
        <h4 class="title-inner"><?php esc_html_e( 'Property Documents', 'houzez' ); ?></h4>
    </div>
    <ul class="document-list">

        <?php foreach( $post_meta_data['fave_attachments'] as $attachment_id ): ?>
            <?php $attachment_meta = houzez_get_attachment_metadata($attachment_id);?>
        <li>
            <div class="pull-left">
                <i class="fa fa-file-o"></i> <?php echo esc_attr( $attachment_meta->post_title ); ?>
            </div>
            <div class="pull-right">
                <?php if( $documents_download == 1 ) {
                    if( is_user_logged_in() ) { ?>
                    <a href="<?php echo esc_url( $attachment_meta->guid ); ?>" download><?php esc_html_e( 'DOWNLOAD', 'houzez' ); ?></a>
                    <?php } else { ?>
                        <a href="#" data-toggle="modal" data-target="#pop-login"><?php esc_html_e( 'DOWNLOAD', 'houzez' ); ?></a>
                    <?php } ?>
                <?php } else { ?>
                    <a href="<?php echo esc_url( $attachment_meta->guid ); ?>" download><?php esc_html_e( 'DOWNLOAD', 'houzez' ); ?></a>
                <?php } ?>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
</div>
<?php } ?>