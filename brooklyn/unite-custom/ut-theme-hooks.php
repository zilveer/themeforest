<?php if (!defined('ABSPATH')) {
    exit; // exit if accessed directly
}

/* before article */
function ut_before_article_hook(){

	do_action('ut_before_article_hook');

}

/* after article */
function ut_after_article_hook(){

	do_action('ut_after_article_hook');

}