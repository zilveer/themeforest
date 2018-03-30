<ul class="post-meta">
    <li>
        <i class="ti-user"></i>
        <span><?php _e('Written by','foundry'); ?> <?php the_author_posts_link(); ?></span>
    </li>
    <li>
        <i class="ti-tag"></i>
        <span><?php _e('Categorised','foundry'); ?> <?php the_category(', '); ?></span>
    </li>
</ul>