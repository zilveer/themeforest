<?php

add_action('admin_init', 'uxbarn_create_team_meta_boxes');

if( ! function_exists('uxbarn_create_team_meta_boxes')) {
    
    function uxbarn_create_team_meta_boxes() {
        uxbarn_create_team_excerpt_setting();
        uxbarn_create_team_meta_info();
        uxbarn_create_team_social_network_setting();
        uxbarn_create_team_header_image_setting();
        
    }
	
}


if( ! function_exists('uxbarn_create_team_excerpt_setting')) {

    function uxbarn_create_team_excerpt_setting() {
        
        $excerpt = array(
            'id'          => 'uxbarn_team_excerpt_meta_box',
            'title'       => __('Team Member Excerpt Setting', 'uxbarn'),
            'desc'        => '',
            'pages'       => array( 'team' ),
            'context'     => 'normal',
            'priority'    => 'high',
            'fields'      => array(
                array(
                'id'          => 'uxbarn_team_excerpt',
                'label'       => __('Excerpt', 'uxbarn'),
                'desc'        => __('The excerpt or short description of this member. It will be used in the team member created by shortcode. This should be short and concise.', 'uxbarn'),
                'std'         => '',
                'type'        => 'textarea-simple',
                'section'     => 'uxbarn_team_excerpt_sec',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => ''
              )
            )
        );
        
        ot_register_meta_box($excerpt);
        
    }

}


if( ! function_exists('uxbarn_create_team_meta_info')) {
    
    function uxbarn_create_team_meta_info() {
        $meta_info = array(
            'id'          => 'uxbarn_team_meta_info_meta_box',
            'title'       => __('Team Member Meta Info Setting', 'uxbarn'),
            'desc'        => '',
            'pages'       => array( 'team' ),
            'context'     => 'normal',
            'priority'    => 'high',
            'fields'      => array(
                array(
                    'id'          => 'uxbarn_team_meta_info_position',
                    'label'       => __('Position', 'uxbarn'),
                    'desc'        => __('Enter the position of this member. Example: <em>Co-founder</em>', 'uxbarn'),
                    'std'         => '',
                    'type'        => 'text',
                    'section'     => 'uxbarn_team_meta_info_sec',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => ''
                ),
                array(
                    'id'          => 'uxbarn_team_meta_info_email',
                    'label'       => __('Email', 'uxbarn'),
                    'desc'        => __('Enter the email of this member', 'uxbarn'),
                    'std'         => '',
                    'type'        => 'text',
                    'section'     => 'uxbarn_team_meta_info_sec',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => ''
                ),
            )
        );
        
        ot_register_meta_box($meta_info);
    }

}


if( ! function_exists('uxbarn_create_team_social_network_setting')) {
    
    function uxbarn_create_team_social_network_setting() {
        
        $social = array(
            'id'          => 'uxbarn_team_social_network_meta_box',
            'title'       => __('Social Network Setting', 'uxbarn'),
            'desc'        => '',
            'pages'       => array( 'team' ),
            'context'     => 'normal',
            'priority'    => 'high',
            'fields'      => array(
                array(
                'id'          => 'uxbarn_team_social_twitter',
                'label'       => __('Twitter URL', 'uxbarn'),
                'desc'        => '',
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_team_social_network_sec',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => ''
              ),
              array(
                'id'          => 'uxbarn_team_social_facebook',
                'label'       => __('Facebook URL', 'uxbarn'),
                'desc'        => '',
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_team_social_network_sec',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => ''
              ),
              array(
                'id'          => 'uxbarn_team_social_googleplus',
                'label'       => __('Google+ URL', 'uxbarn'),
                'desc'        => '',
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_team_social_network_sec',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => ''
              ),
              array(
                'id'          => 'uxbarn_team_social_linkedin',
                'label'       => __('LinkedIn URL', 'uxbarn'),
                'desc'        => '',
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_team_social_network_sec',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => ''
              ),
              array(
                'id'          => 'uxbarn_team_social_dribbble',
                'label'       => __('Dribbble URL', 'uxbarn'),
                'desc'        => '',
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_team_social_network_sec',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => ''
              ),
              array(
                'id'          => 'uxbarn_team_social_forrst',
                'label'       => __('Forrst URL', 'uxbarn'),
                'desc'        => '',
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_team_social_network_sec',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => ''
              ),
              array(
                'id'          => 'uxbarn_team_social_flickr',
                'label'       => __('Flickr URL', 'uxbarn'),
                'desc'        => '',
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_team_social_network_sec',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => ''
              ),
            )
        );
        
        ot_register_meta_box($social);
        
    }

}


if( ! function_exists('uxbarn_create_team_header_image_setting')) {
	
    function uxbarn_create_team_header_image_setting() {
        $header_image = array(
            'id'          => 'uxbarn_team_header_image_meta_box',
            'title'       => __('Individual Header Image Setting', 'uxbarn'),
            'desc'        => '',
            'pages'       => array( 'team' ),
            'context'     => 'normal',
            'priority'    => 'high',
            'fields'      => array(
                array(
                    'id'          => 'uxbarn_team_header_image_upload',
                    'label'       => __('Upload Header Image', 'uxbarn'),
                    'desc'        => __('Click the icon to upload the file or if you already know the URL of the image, just paste it into the box. Recommended size is 2000x330.<p>This header image will only be displayed on team\'s single page.</p>', 'uxbarn'),
                    'std'         => '',
                    'type'        => 'upload',
                    'section'     => 'uxbarn_team_header_image_sec',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => ''
                  ),
            )
        );
        
        ot_register_meta_box($header_image);
    }

}


?>