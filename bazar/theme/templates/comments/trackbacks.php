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

global $wp_query, $withcomments, $post, $wpdb, $id, $comment, $user_login, $user_ID, $user_identity, $overridden_cpage;

if( $post->ping_status != 'open' ) { return; }

?>
<!-- START TRACKBACK & PINGBACK -->
<h3 id="trackbacks"><?php _e( 'Trackbacks and pingbacks', 'yit' ) ?></h3>
<ol class="trackbacklist">
<?php
$comments = get_comments( 'post_id=' . get_the_ID() );

$trackbacks_number = 0;
foreach ( $comments as $comment ) : 
    if ( $comment->comment_type == "trackback" || $comment->comment_type == "pingback" ) : ?>
    <li id="comment-<?php comment_ID() ?>" class="group">
        <cite><?php comment_author_link() ?></cite>
    	<br/>
    	<?php comment_excerpt() ?>
    </li>
    <?php $trackbacks_number++; endif ?>
<?php endforeach ?>
</ol>
<?php if( $trackbacks_number == 0 ) : ?><p><em><?php _e('No trackback or pingback available for this article.', 'yit'); ?></em></p><?php endif ?> 
<!-- END TRACKBACK & PINGBACK -->