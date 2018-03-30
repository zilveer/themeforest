<?php

    $tags = get_the_tags(get_the_ID());
    if(!empty($tags))
    {
        ?> <div class="tag-cloud tag-title"> <i class="fa fa-tags"></i> <?php
        foreach($tags as $tag)
        {
            $tag = get_tag($tag);
            $link = get_tag_link($tag);
            echo ' <a href="' . esc_url( $link ) . '" title="' . esc_attr($tag->name) . '" class="tag-1"><span>' . $tag->name . '</span><s>' . $tag->count . '</s></a>';
        }
        ?> </div> <?php
    }
?>