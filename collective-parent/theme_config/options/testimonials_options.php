<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for posts area. */
/* ----------------------------------------------------------------------------------- */

$options = array(

    /* ----------------------------------------------------------------------------------- */
    /* After Textarea */
    /* ----------------------------------------------------------------------------------- */

    /* Post */
    array('name' => __('Post','tfuse'),
        'id' => TF_THEME_PREFIX . '_testimonials_option',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    // Thumbnail Image
    array('name' => __('Thumbnail','tfuse'),
        'desc' => __('This is the thumbnail for your post. Upload one from your computer, or specify an online address for your image (Ex: http://yoursite.com/image.png).','tfuse'),
        'id' => TF_THEME_PREFIX . '_thumbnail_image',
        'value' => '',
        'type' => 'upload',
    ),
    // Profession
    array('name' => __('Profession','tfuse'),
        'desc' => __('Enter the profession','tfuse'),
        'id' => TF_THEME_PREFIX . '_profession',
        'value' => '',
        'type' => 'text'
    ),
);

?>