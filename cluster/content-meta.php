<!-- BEGIN .entry-meta -->
<div class="entry-meta <?php if(is_single()) echo "top"; ?>">
    <?php
    $format = get_post_format();
    if(false === $format) $format = 'standard';

    $postFormatLink = get_post_format_link($format);
    ?>
    <span class="post-icon"><a href="<?php echo $postFormatLink; ?>"><i class="accent-background icon icon-<?php echo $format; ?>"></i></a></span>
    <span class="published"><a href="<?php the_permalink(); ?>"><?php the_time( get_option('date_format') ); ?></a></span>
    <span class="divider">/</span>
    <span class="comment-count"><?php comments_popup_link( __('0 Comments', 'stag'), __('1 comment', 'stag'), __('% comments', 'stag') ); ?></span>
    <span class="divider">/</span>
    <span class="entry-categories"><?php _e('Category:', 'stag') ?> <?php the_category(', ') ?></span>
    <?php if(has_tag()): ?>
    <span class="divider">/</span>
    <span class="post-tags">
        <?php the_tags(); ?>
    </span>
    <?php endif; ?>
<!-- END .entry-meta -->
</div>