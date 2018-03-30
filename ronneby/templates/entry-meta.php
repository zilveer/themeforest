<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<div class="entry-meta post-info">

    <span class="byline author vcard"><?php echo __('By', 'dfd'); ?> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn"><?php echo get_the_author(); ?></a>, </span>

    <span class="post-tags"> <?php echo __('in', 'dfd') . ' '; the_tags('',', ',''); ?></span>


    <?php if ( ! is_single() ) {
        echo '<i class="icon-comment"></i>';
        comments_popup_link(__('Comments', 'dfd'), __('1 Comment', 'dfd'), __('% Comments', 'dfd'));
    } ?>

</div>

