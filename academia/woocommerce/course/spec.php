<?php
/**
 * Add the question & answer meta box
 * @var [type]
 */
$course_repeat_metabox_ = new WPAlchemy_MetaBox(array
(
    'id' => 'course_custom_fields',
    'title' => esc_html__('Course Extra', 'g5plus-academia'),
    'template' => G5PLUS_THEME_DIR . 'woocommerce/course/custom-field.php',
    'types' => array('product'),
    'autosave' => TRUE,
    'priority' => 'high',
    'context' => 'normal',
    'hide_editor' => FALSE
));


