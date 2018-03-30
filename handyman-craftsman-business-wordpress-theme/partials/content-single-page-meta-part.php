<?php
use \Handyman\Front as F;
/**
 * Meta data related to post/page.
 * Post date, categories and number of comments
 */

do_action('layers_before_single_title_meta');
    /**
    * Display the Post Date, Categories only, number of comments
    */
    F\tl_layers_post_meta( get_the_ID(), array('date', 'categories', 'comment-num'), 'div', 'meta-info push-bottom' );

do_action('layers_after_single_title_meta');