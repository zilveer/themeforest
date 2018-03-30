<?php

add_action('add_meta_boxes', 'stag_metabox_portfolio');

function stag_metabox_portfolio(){

  $meta_box = array(
    'id' => 'stag-metabox-portfolio',
    'title' => __('Portfolio Settings', 'stag'),
    'description' => __('Here you can customize project images, dates etc..', 'stag'),
    'page' => 'portfolio',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
      array(
        'name' => __('Project Date', 'stag'),
        'desc' => __('Enter the project date e.g. Feb 24, 2013', 'stag'),
        'id' => '_stag_portfolio_date',
        'type' => 'text',
        'std' => ''
        ),
      array(
        'name' => __('Project URL', 'stag'),
        'desc' => __('Enter the project URL.', 'stag'),
        'id' => '_stag_portfolio_url',
        'type' => 'text',
        'std' => ''
        ),
      array(
        'name' => __('Open link in new window?', 'stag'),
        'desc' => __('Check to open project URL in new window.', 'stag'),
        'id' => '_stag_portfolio_new_window',
        'type' => 'checkbox',
        'std' => ''
        ),
      array(
        'name' => __('Project Images', 'stag'),
        'desc' => __('Choose project images, ideal size 770px x unlimited.', 'stag'),
        'id' => '_stag_portfolio_images',
        'type' => 'file',
        'std' => '',
        'multiple' => true
        ),
      )
    );
  stag_add_meta_box($meta_box);
}
