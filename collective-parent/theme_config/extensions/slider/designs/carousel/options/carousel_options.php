<?php
/**
 * Carousel slider's configurations
 *
 * @since  Collective 1.0
 */

$options = array(
    'tabs' => array(
        array(
            'name' => __('Slider Settings','tfuse'),
            'id' => 'slider_settings', #do no t change this ID
            'headings' => array(
                array(
                    'name' => __('Slider Settings','tfuse'),
                    'options' => array(
                        array('name' => __('Slider Title','tfuse'),
                            'desc' => __('Change the title of your slider','tfuse'),
                            'id' => 'slider_title',
                            'value' => '',
                            'type' => 'text'),
                        array('name' => __('Slider Info Text','tfuse'),
                            'desc' => __('Change the info text of your slider','tfuse'),
                            'id' => 'slider_info_text',
                            'value' => 'if we did not convinced you check out more work from us',
                            'type' => 'text'),
                        array('name' => __('Background Image','tfuse'),
                            'desc' => __('Upload backgroungd image. Image resolution 1280x592','tfuse'),
                            'id' => 'slider_background',
                            'value' => '',
                            'type' => 'upload'),
                        array('name' => __('More Button Text','tfuse'),
                            'desc' => __('Change the more button text of your slider','tfuse'),
                            'id' => 'slider_more_text',
                            'value' => 'Read more',
                            'type' => 'text'),
                        array('name' => __('More Button Link','tfuse'),
                            'desc' => __('Change the more button link of your slider','tfuse'),
                            'id' => 'slider_more_link',
                            'value' => '#',
                            'type' => 'text'),
                        array('name' => __('Resize images?','tfuse'),
                            'desc' => __('Want to let our script to resize the images for you? Or do you want to have total control and upload images with the exact slider image size?','tfuse'),
                            'id' => 'slider_image_resize',
                            'value' => 'false',
                            'type' => 'checkbox')
                    )
                )
            )
        ),
        array(
            'name' => __('Add/Edit Slides','tfuse'),
            'id' => 'slider_setup', #do not change ID
            'headings' => array(
                array(
                    'name' => 'Add New Slide', #do not change
                    'options' => array(
                        array('name' => __('Title','tfuse'),
                            'desc' => __('The Title is displayed on the image and will be visible by the users','tfuse'),
                            'id' => 'slide_title',
                            'value' => '',
                            'type' => 'text',
                        ),
                        // Custom Image
                        array('name' => __('Image (506 x 316)','tfuse'),
                            'desc' => __('You can upload an image from your hard drive or use one that was already uploaded by pressing  "Insert into Post" button from the image uploader plugin.','tfuse'),
                            'id' => 'slide_src',
                            'value' => '',
                            'type' => 'upload',
                            'media' => 'image',
                            'required' => TRUE,
                        ),
                    )
                )
            )
        ),
        array(
            'name' => __('Category Setup','tfuse'),
            'id' => 'slider_type_categories',
            'headings' => array(
                array(
                    'name' => __('Category options','tfuse'),
                    'options' => array(
                        array(
                            'name' => __('Categories','tfuse'),
                            'desc' => __('Select specific categories.','tfuse'),
                            'id' => 'posts_select_type',
                            'value' => 'categories',
                            'options' => array('categories' => __('From Categories','tfuse'),'portfolio' => __('From Portfolio','tfuse')),
                            'type' => 'select'
                        ),
                        array(
                            'name' => __('Select specific Categories','tfuse'),
                            'desc' => __('Pick one or more <a target="_new" href="' . get_admin_url() . 'edit.php">categories</a> by starting to type the Category name. The slider will be populated with images from the categories you selected.','tfuse'),
                            'id' => 'posts_select_cat',
                            'type' => 'multi',
                            'subtype' => 'category'
                        ),
                        array(
                            'name' => __('Select specific Categories','tfuse'),
                            'desc' => __('Pick one or more <a target="_new" href="' . get_admin_url() . 'edit.php">categories</a> by starting to type the Category name. The slider will be populated with images from the categories you selected.','tfuse'),
                            'id' => 'posts_select_portf',
                            'type' => 'multi',
                            'subtype' => 'group'
                        ),
                        array(
                            'name' => __('Number of images in the slider','tfuse'),
                            'desc' => __('How many images do you want in the slider?','tfuse'),
                            'id' => 'sliders_posts_number',
                            'value' => 6,
                            'type' => 'text'
                        )
                    )
                )
            )
        ),
        array(
            'name' => __('Posts Setup','tfuse'),
            'id' => 'slider_type_posts',
            'headings' => array(
                array(
                    'name' => __('Posts options','tfuse'),
                    'options' => array(
                        array(
                            'name' => __('Posts','tfuse'),
                            'desc' => __('Select posts.','tfuse'),
                            'id' => 'posts_select_type',
                            'value' => 'categories',
                            'options' => array('categories' => __('From Categories','tfuse'),'portfolio' => __('From Portfolio','tfuse')),
                            'type' => 'select'
                        ),
                        array(
                            'name' => __('Select specific Posts','tfuse'),
                            'desc' => __('Pick one or more <a target="_new" href="' . get_admin_url() . 'edit.php">posts</a> by starting to type the Post name. The slider will be populated with images from the posts you selected.','tfuse'),
                            'id' => 'posts_select_cat',
                            'type' => 'multi',
                            'subtype' => 'post'
                        ),
                        array(
                            'name' => __('Select specific Posts','tfuse'),
                            'desc' => __('Pick one or more <a target="_new" href="' . get_admin_url() . 'edit.php">posts</a> by starting to type the Post name. The slider will be populated with images from the posts you selected.','tfuse'),
                            'id' => 'posts_select_portf',
                            'type' => 'multi',
                            'subtype' => 'portfolio'
                        )
                    )
                )
            )
        ),
        array(
            'name' => __('Tags Setup','tfuse'),
            'id' => 'slider_type_tags',
            'headings' => array(
                array(
                    'name' => __('Tags options','tfuse'),
                    'options' => array(
                        array(
                            'name' => __('Tags','tfuse'),
                            'desc' => __('Select tags.','tfuse'),
                            'id' => 'posts_select_type',
                            'value' => 'categories',
                            'options' => array('categories' => __('From Categories','tfuse'),'portfolio' => __('From Portfolio','tfuse')),
                            'type' => 'select'
                        ),
                        array(
                            'name' => __('Select specific tags','tfuse'),
                            'desc' => 'Pick one or more <a target="_new" href="' . get_admin_url() . 'edit-tags.php?taxonomy=post_tag">tags</a> by starting to type the tag name. The slider will be populated with images from posts that have the selected tags.',
                            'id' => 'posts_select_cat',
                            'type' => 'multi',
                            'subtype' => 'post_tag'
                        ),
                        array(
                            'name' => __('Select specific tags','tfuse'),
                            'desc' => 'Pick one or more <a target="_new" href="' . get_admin_url() . 'edit-tags.php?taxonomy=post_tag">tags</a> by starting to type the tag name. The slider will be populated with images from posts that have the selected tags.',
                            'id' => 'posts_select_portf',
                            'type' => 'multi',
                            'subtype' => 'tags'
                        ),
                        array(
                            'name' => __('Number of images in the slider','tfuse'),
                            'desc' => __('How many images do you want in the slider?','tfuse'),
                            'id' => 'sliders_posts_number',
                            'value' => 6,
                            'type' => 'text'
                        )
                    )
                )
            )
        )
    )
);

$options['extra_options'] = array();
?>