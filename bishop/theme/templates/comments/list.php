<?php
/**
 * Your Inspiration Themes
 *
 * In this files there is a collection of a functions useful for the core
 * of the framework.
 *
 * @package    WordPress
 * @subpackage Your Inspiration Themes
 * @author     Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
?>
<!-- START COMMENTS -->
<li class="comment" id="comment-<?php echo $comment->comment_ID;?>">
    <span class="<?php echo $avatar_class ?>">
        <?php echo get_avatar( $comment_author_gravatar_mail, 65 ); ?>
    </span>

    <div class="information clearfix">
        <span class="user-info">
            <?php echo $comment->comment_author ?>
            <?php if( $is_author ) : ?>
                <span class="is_author">
                    <?php _e( 'Author', 'yit' ) ?>
                </span>
            <?php endif; ?>
            <span class="date"><?php echo date('F d, Y', strtotime( $comment->comment_date ) ) ?></span>
        </span>
    </div>

    <div class="content arrow">
        <?php echo yit_addp($comment->comment_content); ?>
        <?php if( comments_open() ) : ?>
            <span class="reply_link">
                <i class="fa fa-reply"></i>
                <?php comment_reply_link( $args, $comment->comment_ID, $comment->comment_post_ID )  ?>
            </span>
        <?php endif; ?>
    </div>
</li>
<!-- END COMMENTS -->