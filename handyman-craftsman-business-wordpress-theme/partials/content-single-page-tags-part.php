<?php
/**
 * Display post/page tags
 */

$the_tags = get_the_tags(get_the_ID());
$tags     = '';
if($the_tags){
    foreach ($the_tags as $tag) {

        $tags .= ' <a class="button" href="' . esc_url(get_tag_link($tag->term_id)) . '" title="' . esc_attr(sprintf(__("View all posts tagged %s", TL_DOMAIN), $tag->name)) . '">'
            . $tag->name .
            '</a>';
    }
}

if (!empty($the_tags)) {
    echo '<div  class="meta-info tags">';
    echo '<p><span>' . __('Tagged with:', TL_DOMAIN).'</span>' . $tags . '</p>';
    echo '</div>';
}
