<?php
if (!defined('ABSPATH')) exit();

$post_type_values = get_post_meta( get_the_ID(), 'post_type_values', true );
echo do_shortcode('[blockquote]' . $post_type_values['quote'] . '[/blockquote]');