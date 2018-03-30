<?php

add_action('add_meta_boxes', 'stag_metabox_gallery');

function stag_metabox_gallery(){

  /* Gallery Metabox -------------------------------------------*/
  $meta_box = array(
    'id' => 'stag-metabox-gallery',
    'title' => __('Gallery Settings', 'stag'),
    'description' => __('Set up your gallery', 'stag'),
    'page' => 'post',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
      array(
        'name' => __('Upload Images', 'stag'),
        'desc' => __('Upload gallery images.', 'stag'),
        'id' => '_stag_gallery_images',
        'type' => 'file',
        'std' => '',
        'multiple' => "true",
        'title' => __('Choose Images', 'stag')
        ),
      )
    );
  stag_add_meta_box($meta_box);

  /* Link Metabox -------------------------------------------*/
  $meta_box = array(
    'id' => 'stag-metabox-link',
    'title' => __('Link Settings', 'stag'),
    'description' => __('Input your link', 'stag'),
    'page' => 'post',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
      array(
        'name' => __('Link', 'stag'),
        'desc' => __('Input your link e.g. https://codestag.com', 'stag'),
        'id' => '_stag_link_url',
        'type' => 'text',
        'std' => ''
        ),
      )
    );
  stag_add_meta_box($meta_box);

  /* Quote Metabox -------------------------------------------*/
  $meta_box = array(
    'id' => 'stag-metabox-quote',
    'title' => __('Quote Settings', 'stag'),
    'description' => __('Input your quote', 'stag'),
    'page' => 'post',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
      array(
        'name' => __('Quote Source', 'stag'),
        'desc' => __('Enter the quote source/author', 'stag'),
        'id' => '_stag_quote_source',
        'type' => 'text',
        'std' => ''
        ),
      array(
        'name' => __('The Quote', 'stag'),
        'desc' => __('Input your quote', 'stag'),
        'id' => '_stag_quote_quote',
        'type' => 'textarea',
        'std' => ''
        ),
      )
    );
  stag_add_meta_box($meta_box);

  /* Audio Metabox -------------------------------------------*/
  $meta_box = array(
    'id' => 'stag-metabox-audio',
    'title' => __('Audio Settings', 'stag'),
    'description' => __('This setting enables you to embed audio for this post.', 'stag'),
    'page' => 'post',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
      array(
        'name' => __('MP3 File URL', 'stag'),
        'desc' => __('Enter URL to .mp3 file.', 'stag'),
        'id' => '_stag_audio_mp3',
        'type' => 'text',
        'std' => ''
        ),
      array(
        'name' => __('OGA File URL', 'stag'),
        'desc' => __('Enter URL to .oga, .ogg file.', 'stag'),
        'id' => '_stag_audio_oga',
        'type' => 'text',
        'std' => ''
        ),
      array(
        'name' => __('Embed Audio URL', 'stag'),
        'desc' => __('Enter URL or shortcode to embed an Audio Player', 'stag'),
        'id' => '_stag_audio_embed',
        'type' => 'textarea',
        'std' => ''
        ),
      )
    );
  stag_add_meta_box($meta_box);

  /* Video Metabox -------------------------------------------*/
  $meta_box = array(
    'id' => 'stag-metabox-video',
    'title' => __('Video Settings', 'stag'),
    'description' => __('This setting enables you to embed video for this post.', 'stag'),
    'page' => 'post',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
      array(
        'name' => __('M4V File URL', 'stag'),
        'desc' => __('Enter URL to .m4v video file.', 'stag'),
        'id' => '_stag_video_m4v',
        'type' => 'text',
        'std' => ''
        ),
      array(
        'name' => __('OGV File URL', 'stag'),
        'desc' => __('Enter URL to .ogv video file.', 'stag'),
        'id' => '_stag_video_ogv',
        'type' => 'text',
        'std' => ''
        ),
      array(
        'name' => __('Embedded Code', 'stag'),
        'desc' => __('If you are using a video other than self-hosted such as YouTube or Vimeo, paste the embed code here.<br><br>This field will override the above.', 'stag'),
        'id' => '_stag_video_embed',
        'type' => 'textarea',
        'std' => ''
        ),
      )
    );
  stag_add_meta_box($meta_box);
}
