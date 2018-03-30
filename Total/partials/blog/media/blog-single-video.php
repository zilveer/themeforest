<?php
/**
 * Blog single post video format media
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.3.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get post video
$video = wpex_get_post_video_html();

// Show featured image for password-protected post or if video isn't defined
if ( post_password_required() || ! $video ) {
    get_template_part( 'partials/blog/media/blog-single', 'thumbnail' );
    return;
} ?>

<div id="post-media" class="clr">
	<div id="blog-post-video"><?php echo $video; ?></div>
</div>