<?php

/*** Audio Post Format ***/

$audio_post_format_meta_box = hashmag_mikado_add_meta_box(
    array(
        'scope' => array('post'),
        'title' => 'Audio Post Format',
        'name' => 'post_format_audio_meta'
    )
);

hashmag_mikado_add_meta_box_field(
    array(
        'name' => 'mkdf_post_audio_link_meta',
        'type' => 'text',
        'label' => 'Link',
        'description' => 'Enter Audio Link',
        'parent' => $audio_post_format_meta_box,

    )
);