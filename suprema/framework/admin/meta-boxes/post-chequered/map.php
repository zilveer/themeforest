<?php

/*** Link Post Format ***/

$chequered_post_format_meta_box = suprema_qodef_add_meta_box(
    array(
        'scope' => array('post'),
        'title' => 'Chequered Blog List',
        'name' => 'post_format_chequered_meta'
    )
);

suprema_qodef_add_meta_box_field(
    array(
        'name'        => 'qodef_post_format_chequered_color_meta',
        'type'        => 'color',
        'label'       => 'Background Color',
        'description' => 'Choose color for post background on chequered blog list.',
        'parent'      => $chequered_post_format_meta_box,

    )
);

