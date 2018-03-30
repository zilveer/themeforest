<?php

 return array(
    'type' => 'radio-buttons',
    'heading' => 'Visibility',
    'full_width' => true,
    'default' => '',
    'options' => array(
        ''   => array( 'title' => 'Show for all','icon' => 'dashicons-visibility'),
        'hide-for-medium'  => array( 'title' => 'Only for Desktop','icon' => 'dashicons-desktop'),
        'show-for-medium'   => array( 'title' => 'Only for Tablet / Mobile','icon' => 'dashicons-tablet'),
        'show-for-small'   => array( 'title' => 'Only for Tablet','icon' => 'dashicons-smartphone'),
    ),
);