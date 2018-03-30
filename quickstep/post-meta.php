    <div class="meta">
        <time datetime="<?php the_time('c');?>" ><span class="day"><?php the_time('j'); ?></span><span class="month"><?php the_time('M'); ?> '<?php the_time('y'); ?></span></time>
        <span class="post-author"><?php _e("By", "qs_framework"); ?> <?php the_author_posts_link(); ?> </span>
        <?php the_tags('<p class="tags">', '<br />', '</p>'); ?>
    </div>	