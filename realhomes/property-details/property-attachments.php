<?php
$display_display_attachments = get_option('theme_display_attachments');
if( $display_display_attachments == 'true' ){
    global $post;
    $attachments = get_post_meta( $post->ID, 'REAL_HOMES_attachments',false);
    if ( is_array( $attachments ) ) {
        $attachments = array_filter( $attachments );
    }
    if( !empty($attachments) ){
        ?>
        <div class="attachments-wrap clearfix">
            <?php
            $property_attachments_title = get_option('theme_property_attachments_title');
            if( !empty( $property_attachments_title ) ){
                ?><span class="attachments-label"><?php echo $property_attachments_title; ?></span><?php
            }
            ?>
            <div class="attachments-inner clearfix">
                <?php
                echo '<ul class="attachments-list clearfix">';
                foreach( $attachments as $attachment_id ){
                    $file_path = wp_get_attachment_url( $attachment_id );
                    if( $file_path ){
                        $file_type = wp_check_filetype( $file_path );
                        echo '<li class="'.$file_type['ext'].'"><a target="_blank" href="'.$file_path.'">'.get_icon_for_extension( $file_type['ext'] ) . get_the_title( $attachment_id ).'</a></li>';
                    }
                }
                echo '</ul>';
                ?>
            </div>
        </div>
        <?php
    }
}
?>