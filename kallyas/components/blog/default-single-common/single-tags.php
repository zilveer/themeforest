<?php if(! defined('ABSPATH')){ return; }
/**
 * Single Tags
 */

if ( has_tag() ) {
    ?>
    <!-- TAGS -->
    <div class="itemTagsBlock kl-blog-post-tags kl-font-alt">
        <span class="kl-blog-post-tags-text"><?php echo __( 'Tagged under:', 'zn_framework' ); ?></span>
        <?php echo WpkZn::getPostTags(get_the_ID(), ', '); ?>
        <div class="clearfix"></div>
    </div><!-- end tags blocks -->
    <div class="clearfix"></div>
<?php
}
