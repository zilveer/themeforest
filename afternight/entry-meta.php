<ul class="meta-details-list">
    <li class="meta-details-author"><?php echo sprintf(__('By %s','cosmotheme'),'<a href="'.get_author_posts_url($post->post_author).'">'.get_the_author_meta('display_name', $post->post_author).'</a>')?></li>    
    <li class="meta-details-date"><?php echo post::get_post_date($post -> ID); ?>  </li>

    <?php
    if (comments_open($post_id)) {
        if (options::logic('general', 'fb_comments')) {
            ?>
                    <li class="meta-details-comments">
                        <a href="<?php echo get_comments_link($post_id); ?>" >
                            <span class="comments">
                                <fb:comments-count href="<?php echo get_permalink($post_id) ?>"></fb:comments-count>
                                <?php _e('Comments','cosmotheme'); ?>
                            </span>
                        </a>
                    </li>
            <?php
        } else {
            if(get_comments_number($post_id) == 1){
                $comments_label = __('reply','cosmotheme');    
            }
            ?>
                <li class="meta-details-comments">
                    <a href="<?php echo get_comments_link($post_id); ?>" >
                        <span class="comments">
                            <?php echo get_comments_number($post_id) ?>
                            <?php _e('Comments','cosmotheme'); ?>
                        </span>
                    </a>
                </li>    
            <?php
            }
        }
    ?>

    <?php
        if ( function_exists( 'stats_get_csv' ) ){  
        $views = stats_get_csv( 'postviews' , "&post_id=" . $post_id);    
    ?>
    <li class="meta-details-views">
        <a href="<?php echo get_permalink($post_id); ?>" >
            <?php echo (int)$views[0]['views']; ?>
            <?php _e('Views','cosmotheme'); ?>
        </a>
    </li>
    <?php } ?>

    <?php if( options::logic( 'upload' , 'enb_edit_delete' )  && is_user_logged_in() && ($post->post_author == get_current_user_id() || current_user_can('administrator')) && (get_post_type( $post -> ID) != 'page') && get_post_type( $post -> ID) != 'event' ) { 
            if( is_numeric(options::get_value( 'upload' , 'post_item_page' ))){ 
    ?>
            <li class="edit_post" title="<?php _e('Edit post','cosmotheme') ?>"><a href="<?php  echo esc_url(add_query_arg( 'post', $post->ID, get_page_link(options::get_value( 'upload' , 'post_item_page' ))  ) ) ;  ?>"  >Edit</a></li>    
            <?php }   ?>
            <?php   
                $confirm_delete = __('Confirm to delete this post.','cosmotheme');
            ?>
            <li class="delete_post" title="<?php _e('Remove post','cosmotheme') ?>"><a href="javascript:void(0)" onclick="if(confirm('<?php echo $confirm_delete; ?> ')){ removePost('<?php echo $post->ID; ?>','<?php echo home_url() ?>');}" >Delete</a></li>

    <?php } ?>
    
</ul>
