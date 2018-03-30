<?php
global $post;
$pageID = jaw_template_get_var('page_id','0');
if($pageID > 0){
    $post = get_page($pageID);
    if (isset($post->ID) && $post->ID > 0) {
        ?>
        <div class="modal col-lg-8 fade" id="jaw_modal">
            <div class="modal-header col-lg-8">
                <a class="close" data-dismiss="modal"><i class="icon-cancel-circle"></i></a>
                <?php if (get_post_meta($post->ID, '_display_page_name', '1') == '1') { ?>
                    <h3><?php echo $post->post_title; ?></h3>
                <?php } ?>
            </div>
            <div class="modal-body col-lg-8">
                <p><?php echo apply_filters('the_content', $post->post_content); ?></p>
            </div>
            <div class="clear"></div>
        </div>
    <?php } 
}?>