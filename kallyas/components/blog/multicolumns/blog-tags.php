<?php if(! defined('ABSPATH')){ return; }
/**
 * Multicolumns item tags
 */
if ( has_tag() ) { ?>
    <div class="itemTagsBlock kl-blog-item-tags kl-font-alt">
        <span class="kl-blog-item-tags-icon" data-zniconfam='glyphicons_halflingsregular' data-zn_icon="&#xe042;"></span>
        <span class="kl-blog-item-tags-text"><?php echo __( 'Tagged under:', 'zn_framework' ); ?></span>
        <?php echo WpkZn::getPostTags(get_the_ID(), ', '); ?>
        <div class="clearfix"></div>
    </div><!-- end tags blocks -->
<?php
}
