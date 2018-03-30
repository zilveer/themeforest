<?php
/**
* @package   Master
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

paginate_links();
next_comments_link();
post_class();
language_attributes();
comment_form();
get_template_part( 'content', get_post_format() );
if ( ! isset( $content_width ) ) $content_width = 900;
if ( is_singular() ) wp_enqueue_script( "comment-reply" );