<?php if(! defined('ABSPATH')){ return; } ?>
<div class="itemBottom kl-blog-item-bottom clearfix">

    <?php if ( has_tag() ) { ?>
        <div class="itemTagsBlock kl-blog-item-tags kl-font-alt">
            <?php echo WpkZn::getPostTags(get_the_ID()); ?>
            <div class="clear"></div>
        </div><!-- end tags blocks -->
    <?php } ?>

    <?php if(!empty($current_post['content'])): ?>
    <div class="itemReadMore kl-blog-item-more">
        <a class="kl-blog-item-more-btn btn btn-fullcolor text-uppercase" href="<?php the_permalink(); ?>"><?php echo __( 'Read more', 'zn_framework' );?></a>
    </div><!-- end read more -->
    <?php endif; ?>

</div>
<div class="clear"></div>
