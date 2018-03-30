<?php if(! defined('ABSPATH')){ return; }
/**
 * Single content
 */
?>
<div class="itemBody kl-blog-post-body kl-blog-cols-<?php echo $blog_multi_columns; ?>" <?php echo WpkPageHelper::zn_schema_markup('post_content'); ?>>
    <!-- Blog Image -->
    <?php
        if( !post_password_required() ){
            echo $current_post['media'];
        }
    ?>
    <!-- Blog Content -->
    <?php echo $current_post['content']; ?>

</div>
<!-- end item body -->
<div class="clearfix"></div>
