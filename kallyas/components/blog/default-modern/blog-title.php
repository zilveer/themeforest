<?php if(! defined('ABSPATH')){ return; }
/*
 * Get post title
 * @since v4.0.12
 */
?>
<div class="kl-blog-item-title" <?php echo WpkPageHelper::zn_schema_markup('title'); ?>>
    <?php echo $current_post['title']; ?>
</div>
