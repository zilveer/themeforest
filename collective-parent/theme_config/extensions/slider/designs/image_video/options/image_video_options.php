<?php
/**
 * Image-Video slider's configurations
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
                            'desc' => __('Change the title of your slider. Only for internal use (Ex: Homepage)','tfuse'),
                            'id' => 'slider_title',
                            'value' => '',
                            'type' => 'text',
                            'divider' => true),
                        array('name' => __('Text','tfuse'),
                            'desc' => __('Enter the text.This text is display in bottom side of slider.','tfuse'),
                            'id' => 'slider_text',
                            'value' => '',
                            'type' => 'text',
                            'divider' => true),
                        array('name' => __('Default Background (960x460)','tfuse'),
                            'desc' => __('Upload a background image. Image resolution (960x460)','tfuse'),
                            'id' => 'slider_default_bg',
                            'value' => '',
                            'type' => 'upload',
                            ),
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
                        array('name' => __('Type','tfuse'),
                            'desc' => __('Select the type of slide','tfuse'),
                            'id' => 'slide_type_slide',
                            'options' =>  array('image' => __('Image & List','tfuse'), 'video' => __('Video','tfuse'), 'bg_list' => __('Full Image & List','tfuse'), 'center_img' => __('Center Image & List','tfuse'),'img_2buttons' => __('Image & 2 Buttons','tfuse'), 'gallery' => __('Gallery','tfuse')),
                            'value' => 'image',
                            'type' => 'select',
                            'divider' => true),
                        array('name' => __('Text align','tfuse'),
                            'desc' => __('Select the type of text align','tfuse'),
                            'id' => 'slide_type_align',
                            'options' =>  array('left' => __('Left','tfuse'), 'right' => __('Right','tfuse')),
                            'value' => 'left',
                            'type' => 'select',
                            'divider' => true),
                        array('name' => __('Background (960x460)','tfuse'),
                            'desc' => __('Upload a background image. Image resolution (960x460)','tfuse'),
                            'id' => 'slide_bg',
                            'value' => '',
                            'type' => 'upload',
                            'divider' => true),
                        array('name' => __('Title','tfuse'),
                            'desc' => __('The Title is displayed on the image and will be visible by the users','tfuse'),
                            'id' => 'slide_title',
                            'value' => '',
                            'type' => 'text',
                            'required' => TRUE,),
                        array('name' => __('Subtitle','tfuse'),
                            'desc' => __('The Subtitle is displayed on the image and will be visible by the users','tfuse'),
                            'id' => 'slide_subtitle',
                            'value' => '',
                            'type' => 'text',
                            'divider' => true),
                        array('name' => __('Video','tfuse'),
                            'desc' => __('Enter the video frame in this input. In frame you can specify the width and height.','tfuse'),
                            'id' => 'slide_video_frame',
                            'value' => '',
                            'type' => 'text'),
                        // Custom Image
                        array('name' => __('Image','tfuse'),
                            'desc' => __('You can upload an image from your hard drive or use one that was already uploaded by pressing  "Insert into Post" button from the image uploader plugin.','tfuse'),
                            'id' => 'slide_src',
                            'value' => '',
                            'type' => 'upload',
                            'media' => 'image',
                            'required' => false,
                            'divider' => true),
                        // Gallery
                        array('name' => __('Gallery','tfuse'),
                            'desc' => __('Please put the sourse of images. Separate the item with enter','tfuse'),
                            'id' => 'slide_gallery',
                            'value' => '',
                            'type' => 'textarea',
                            'required' => false,
                            'divider' => true),
                        array('name' => __('List','tfuse'),
                            'desc' => __('You can put a list of item. Separe the item with enter','tfuse'),
                            'id' => 'slide_list',
                            'value' => '',
                            'type' => 'textarea',
                            'required' => false,
                            'divider' => true),
                        array('name' => __('Button text','tfuse'),
                            'desc' => __('Enter the text for the button.','tfuse'),
                            'id' => 'slide_button_text',
                            'value' => 'Learn more about it',
                            'type' => 'text',
                        ),
                        array('name' => __('Button link','tfuse'),
                            'desc' => __('Enter the link for the button.','tfuse'),
                            'id' => 'slide_button_link',
                            'value' => '#',
                            'type' => 'text',
                        ),
                        array('name' => __('Button 2 text','tfuse'),
                            'desc' => __('Enter the text for the button.','tfuse'),
                            'id' => 'slide_button_text2',
                            'value' => 'Learn more about it',
                            'type' => 'text',
                        ),
                        array('name' => __('Button 2 link','tfuse'),
                            'desc' => __('Enter the link for the button.','tfuse'),
                            'id' => 'slide_button_link2',
                            'value' => '#',
                            'type' => 'text',
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
                            'desc' => __('Pick one or more <a target="_new" href="' . get_admin_url() . 'edit-tags.php?taxonomy=post_tag">tags</a> by starting to type the tag name. The slider will be populated with images from posts that have the selected tags.','tfuse'),
                            'id' => 'posts_select_cat',
                            'type' => 'multi',
                            'subtype' => 'post_tag'
                        ),
                        array(
                            'name' => __('Select specific tags','tfuse'),
                            'desc' => __('Pick one or more <a target="_new" href="' . get_admin_url() . 'edit-tags.php?taxonomy=post_tag">tags</a> by starting to type the tag name. The slider will be populated with images from posts that have the selected tags.','tfuse'),
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