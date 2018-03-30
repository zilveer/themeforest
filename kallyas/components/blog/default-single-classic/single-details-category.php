<?php if(! defined('ABSPATH')){ return; }
/**
 * Details category
 */
?>
<span class="itemCategory kl-blog-post-category">
    <span class="kl-blog-post-category-icon glyphicon glyphicon-folder-close"></span>
    <?php echo __( 'Published in ', 'zn_framework' ); ?>
</span>
<?php the_category( ", " ); ?>
