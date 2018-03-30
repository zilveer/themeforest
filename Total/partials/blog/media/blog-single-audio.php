<?php
/**
 * Blog single post audio format media
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.4.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get audio html
$audio = wpex_get_post_audio_html();

// Display audio if audio exists and the post isn't protected
if ( $audio && ! post_password_required() ) : ?>

	<div id="post-media" class="clr"><div class="blog-post-audio clr"><?php echo $audio; ?></div></div>

<?php
// Otherwise get post thumbnail
else : ?>

	<?php get_template_part( 'partials/blog/media/blog-single' ); ?>

<?php endif; ?>