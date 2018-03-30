<?php
$args = array(
    'wrap_begin'        =>  '<div class="pagination">',
    'wrap_end'          =>  '</div>',
    'ul_class'          =>  '',
    'ul_show'           =>  0,
    'prev_next_class'   =>  'pager',
    'prev_show'         =>  1,
    'prev_class'        =>  'previous blog-page transition',
    'next_class'        =>  'next blog-page transition',
    'next_show'         =>  1,
    'li_class'          =>  '',
    'li_show'           =>  0,
    'a_class'           =>  'blog-page transition',
    'active'            =>  'current-page',
);
post_navigation($args);
?>