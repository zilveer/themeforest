<?php 
/**
 * Your Inspiration Themes
 * 
 * In this files there is a collection of a functions useful for the core
 * of the framework.   
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
 
global $post, $is_extra_content;
wp_reset_query();

$is_extra_content = true;  //used to know if we are in extra content or not

$post_id = isset( $post->ID ) ? $post->ID : 0;

$extra_content = yit_clean_text( yit_get_post_meta( $post_id, '_extra-content' ) );
if( ! empty( $extra_content ) ) : ?>
    <div class="extra-content group span12"><?php echo $extra_content ?></div>
<?php endif;

$is_extra_content = false; ?>