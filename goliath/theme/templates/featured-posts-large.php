<?php

$items = plsh_get_featured_posts();
if($items['count'] > 0)
{
    global $post;
    $original_post = $post;
?>

<div class="post-block-3 featured">

    <div class="title-default">
        <a href="<?php echo esc_url($items['url']); ?>" class="active"><?php echo esc_html($items['title']); ?></a>
        <?php if($items['url'] != '#') { ?>
            <a href="<?php echo esc_url($items['url']); ?>" class="view-all"><?php _e('View all', 'goliath'); ?></a>
        <?php } ?>
    </div>

    <div class="items">
        <?php
            foreach($items['posts'] as $post)
            {
                @setup_postdata($post);
                get_template_part('theme/templates/post-list-2-item-featured');
            }
        ?>
    </div>

</div>
<?php
    $post = $original_post;
}
?>