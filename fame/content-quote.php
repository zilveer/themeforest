<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

global $post;
//uses post content as title, and title as author name
echo '<h2 class="post-title">'.$post->post_content.'</h2><i class="post-format-icon fa fa-quote-left"></i>';
echo '<span class="cite-author">&mdash; '.get_the_title().'</span>';

a13_post_meta();