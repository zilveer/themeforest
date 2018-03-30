<!--BEGIN .entry-footer-->
<div class="entry-footer clearfix">
    <span class="entry-permalink"><a href="<?php the_permalink(); ?>"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) .' '. __('ago', 'framework'); ?></a></span>
    <span class="entry-tags"><?php the_tags('/&nbsp;&nbsp;'.__('Tagged:', 'framework').' ', ', ', ''); ?></span>
    <?php if( get_option('tz_post_like') == 'true' ) { ?>
        <span class="entry-like"><?php tz_printlikes($post->ID); ?></span>
    <?php } ?>
    <span class="entry-comments"><a href="<?php comments_link(); ?>"><?php comments_number( '0', '1', '%' ); ?></a></span>
<!--END .entry-footer-->
</div>