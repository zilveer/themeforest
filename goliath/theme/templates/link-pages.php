<?php

$args = array (
    'before'           => '<div class="post-pages pages clearfix">',
    'after'            => '</div>',
    'link_before'      => '<span></span>',
    'link_after'       => '',
    'next_or_number'   => 'next',
    'nextpagelink'     => __('Next page', 'goliath'),
    'previouspagelink' => __('Previous page', 'goliath'),
    'pagelink'         => '%',
    'echo'             => 1
);
wp_link_pages($args);