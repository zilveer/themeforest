<?php
$get_terms_settings = array(
    'hide_empty' => false,
);
$item = $settings['item_settings'];
$target = @$item['target'];
if($target!='') $target = ' target="'.$target.'"';
$link_more = false;
$i = 0;
if($item['object']['object'] == 'group' || $item['object']['object'] == 'category' )
{
    $term = get_term($item['object']['object_id'], $item['object']['object']);
    if(is_wp_error($term)) return;
    $args = array(
        'hide_empty' => false,
        'fields'     => 'all',
        'parent'     => $item['object']['object_id']
    );
    $args  = wp_parse_args( $get_terms_settings, $args );
    $terms = get_terms($item['object']['object'], $args);
}
elseif($item['object']['type'] == 'post_type' && $item['object']['object'] == 'page')
{
    $posts = get_posts(array('posts_per_page'  => -1,'post_type' => 'page'));
    $terms = array();
    foreach ($posts as $post) {
        if($post->post_parent == $item['object']['object_id'])
            $terms[] = $post;
    }
}
else
{ ?>
    <h3 class="widget_title"><?php echo $item['item_title']; ?></h3>
<?php return;
} ?>

<div class="widget_container widget_categories <?php echo $settings['tf_megamenu_column']; ?>">
    <h3 class="widget_title"><?php echo $item['item_title']; ?></h3>
    <?php
    if(!empty($terms)):
        $visible_childs = $settings['tf_megamenu_num_items']; ?>

        <ul class="<?php echo $settings['tf_megamenu_list']; ?>">
            <?php
            foreach ($terms as $child) :
                if($item['object']['object'] == 'group' || $item['object']['object'] == 'category')
                {
                    $title = $child->name;
                    $link = get_term_link($child);
                }
                elseif($item['object']['type'] == 'post_type' && $item['object']['object'] == 'page')
                {
                    $title = $child->post_title;
                    $link  = get_permalink($child->ID);
                }
                ?>
                <li class="menu-level-2">
                    <a <?php echo $target; ?> href="<?php print $link; ?>">
                        <span><?php echo $title; ?></span>
                    </a>
                </li>
                <?php $i++; if($i == $visible_childs) {break;} ?>
                <?php
            endforeach;
            if(count($terms) > $visible_childs)
            {
                $link_more = true;
            } ?>

            <?php if($link_more) : ?>
                <li class="menu-level-2 more-nav">
                    <a <?php echo $target; ?> href="<?php echo get_term_link($term); ?>">
                        <span><?php echo _e('See All','tfuse'); ?></span>
                    </a>
                </li>
            <?php endif; ?>

        </ul>
    <?php endif; ?>
</div>