<?php
/**
 * Register meta boxes
 */

add_filter( 'rwmb_meta_boxes', 'inspiry_register_meta_boxes' );

if( !function_exists( 'inspiry_register_meta_boxes' ) ) {
    function inspiry_register_meta_boxes() {

        // Make sure there's no errors when the plugin is deactivated or during upgrade
        if (!class_exists('RW_Meta_Box')) {
            return;
        }

        $meta_boxes = array();
        $prefix = 'MEDICAL_META_';


        // Video Meta Box
        $meta_boxes[] = array(
            'id' => 'video-meta-box',
            'title' => __('Video Information', 'framework'),
            'pages' => array('post'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'name' => __('Video Embed Code', 'framework'),
                    'desc' => __('Provide the video embed code and remove the width and height attributes.', 'framework'),
                    'id' => "{$prefix}embed_code",
                    'type' => 'textarea',
                    'cols' => '20',
                    'rows' => '3'
                )
            )
        );


        // Link Meta Box
        $meta_boxes[] = array(
            'id' => 'url-meta-box',
            'title' => __('Link Information', 'framework'),
            'pages' => array('post'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'name' => __('Link Title Text', 'framework'),
                    'id' => "{$prefix}link_text",
                    'desc' => '',
                    'type' => 'text'
                ),
                array(
                    'name' => __('Link URL', 'framework'),
                    'id' => "{$prefix}link_url",
                    'desc' => '',
                    'type' => 'text'
                )
            )
        );


        // Gallery Meta Box for blog post
        $meta_boxes[] = array(
            'title' => __('Gallery Settings', 'framework'),
            'pages' => array('post'),
            'id' => 'gallery-meta-box',
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'name' => __('Gallery Images', 'framework'),
                    'id' => "{$prefix}gallery",
                    'desc' => __('An image should have minimum width of 732px and minimum height of 447px ( Bigger size images will be cropped automatically).', 'framework'),
                    'type' => 'image_advanced',
                    'max_file_uploads' => 48
                )
            )
        );

        // Gallery Meta Box for service single
        $meta_boxes[] = array(
            'title' => __('Gallery Settings', 'framework'),
            'pages' => array('service'),
            'id' => 'service-gallery-meta-box',
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'name' => __('Gallery Images', 'framework'),
                    'id' => "{$prefix}gallery",
                    'desc' => __('An image should have minimum width of 848px and minimum height of 518px ( Bigger size images will be cropped automatically).', 'framework'),
                    'type' => 'image_advanced',
                    'max_file_uploads' => 48
                )
            )
        );

        // Audio Meta Box
        $meta_boxes[] = array(
            'id' => 'audio-meta-box',
            'title' => __('Audio Settings', 'framework'),
            'pages' => array('post'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'name' => __('MP3 Audio File', 'framework'),
                    'id' => "{$prefix}audio_mp3",
                    'desc' => __('Upload the MP3 audio file.', 'framework'),
                    'type' => 'file',
                    'max_file_uploads' => 1
                ),
                array(
                    'name' => __('OGG Audio File', 'framework'),
                    'id' => "{$prefix}audio_ogg",
                    'desc' => __('Upload the OGG audio file.', 'framework'),
                    'type' => 'file',
                    'max_file_uploads' => 1
                ),
                array(
                    'name' => __('Audio Embed Code', 'framework'),
                    'desc' => __('If you do not have audio files to upload, then you can provide audio embed code here.', 'framework'),
                    'id' => "{$prefix}audio_embed_code",
                    'type' => 'textarea',
                    'cols' => '20',
                    'rows' => '3'
                )
            )
        );


        // Quote Meta Box
        $meta_boxes[] = array(
            'id' => 'quote-meta-box',
            'title' => __('Quote Information', 'framework'),
            'pages' => array('post'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'name' => __('Quote Text', 'framework'),
                    'id' => "{$prefix}quote_desc",
                    'desc' => __('Provide quote text here.', 'framework'),
                    'type' => 'textarea',
                    'cols' => '20',
                    'rows' => '3'
                ),
                array(
                    'name' => __('Quote Author', 'framework'),
                    'id' => "{$prefix}quote_author",
                    'desc' => __('Provide quote author name.', 'framework'),
                    'type' => 'text',
                )
            )
        );


        // doctor meta box
        $meta_boxes[] = array(
            'id' => 'doctor-schedule-meta-box',
            'title' => __('Doctor Information', 'framework'),
            'pages' => array('doctor'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'name' => __('Speciality', 'framework'),
                    'id' => "doctor_speciality",
                    'type' => 'text'
                ),
                array(
                    'name' => __('Education', 'framework'),
                    'id' => "doctor_education",
                    'type' => 'text'
                ),
                array(
                    'name' => __('Work Days', 'framework'),
                    'id' => "doctor_work_days",
                    'type' => 'text'
                ),
                array(
                    'name' => __('Intro Text', 'framework'),
                    'desc' => __('A short introduction of doctor to display on homepage and multiple doctors listing places.', 'framework'),
                    'id' => "doctor_intro_text",
                    'type' => 'textarea'
                ),
                array(
                    'name' => __('Twitter URL', 'framework'),
                    'id' => "twitter_link",
                    'type' => 'text'

                ),
                array(
                    'name' => __('Facebook URL', 'framework'),
                    'id' => "facebook_link",
                    'type' => 'text'
                ),
                array(
                    'name' => __('LinkedIn URL', 'framework'),
                    'id' => "linkedin_link",
                    'type' => 'text'
                ),
                array(
                    'name' => __('Skype Username', 'framework'),
                    'id' => "skype_username",
                    'type' => 'text'
                )
            )
        );

        // testimonial meta box
        $meta_boxes[] = array(
            'id' => 'testimonial-meta-box',
            'title' => __('Testimonial', 'framework'),
            'pages' => array('testimonial'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'name' => __('Testimonial Text', 'framework'),
                    'id' => "the_testimonial",
                    'type' => 'textarea',
                    'cols' => '20',
                    'rows' => '3'
                ),
                array(
                    'name' => __('Testimonial Author', 'framework'),
                    'id' => "testimonial_author",
                    'type' => 'text'
                ),
                array(
                    'name' => __('Testimonial Author Organization', 'framework'),
                    'id' => "testimonial_author_organization",
                    'type' => 'text'
                ),
                array(
                    'name' => __('Testimonial Author URL', 'framework'),
                    'id' => "testimonial_author_link",
                    'type' => 'text'
                )
            )
        );

        // gallery item meta box
        $meta_boxes[] = array(
            'id' => 'gallery-item-meta-box',
            'title' => __('Gallery Settings', 'framework'),
            'pages' => array('gallery-item'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'name' => __('Gallery Images', 'framework'),
                    'id' => "{$prefix}custom_gallery",
                    'desc' => __('An image should have minimum width of 670px and minimum height of 500px, Bigger size images will be cropped automatically.', 'framework'),
                    'type' => 'image_advanced',
                    'max_file_uploads' => 48
                )
            )
        );

        // page banner meta box
        $meta_boxes[] = array(
            'id' => 'page-banner-meta-box',
            'title' => __('Banner Settings', 'framework'),
            'pages' => array('page', 'post', 'gallery-item', 'service', 'faq', 'doctor'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'name' => __('Banner Image', 'framework'),
                    'id' => "{$prefix}page_banner",
                    'desc' => __('Banner image should have minimum width of 2000px and minimum height of 180px.', 'framework'),
                    'type' => 'image_advanced',
                    'max_file_uploads' => 1
                )

            )
        );

        // apply a filter before returning meta boxes
        $meta_boxes = apply_filters('framework_theme_meta', $meta_boxes);

        return $meta_boxes;

    }
}

?>