<?php if(! defined('ABSPATH')){ return; }
/**
 * Multi-columns content
 */

if( !empty($current_post['content']) ) { ?>
    <div class="itemBody kl-blog-item-body" <?php echo WpkPageHelper::zn_schema_markup('post_content'); ?>>
        <div class="itemIntroText kl-blog-item-content">
            <?php echo $current_post['content']; ?>
        </div>
        <!-- end Item Intro Text -->
        <div class="clearfix"></div>
    </div>
    <!-- end Item BODY -->
<?php
}
