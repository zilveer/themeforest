<?php
/**
 * Your Inspiration Themes
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

if ( post_password_required() ) {
    do_action( 'yit_comments_password_required' );
    
    /* Stop the rest of comments.php from being processed,
     * but don't kill the script entirely -- we still have
     * to fully load the template.
     */
    return;
}

if ( have_comments() ) : ?>
<div class="clear"></div>

<h3 id="comments-title">
    <?php comments_number( __( 'No comments', 'yit' ), __( '<span>1</span> comment', 'yit' ), __( '<span>%</span> comments', 'yit' ) ); ?>
</h3>
<?php
// Are there comments to navigate through?
if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
    do_action( 'yit_comments_navigation' );
}
?>

<div class="row">
    <ol class="commentlist group">
    	<?php
    		/* Loop through and list the comments. Tell wp_list_comments()
    		 * to use yit_comment() to format the comments.
    		 * If you want to overload this in a child theme then you can
    		 * define yit_comment() and that will be used instead.
    		 */
    		wp_list_comments( array( 'type' => 'comment', 'callback' => 'yit_comment' ) );
    	?>
    </ol>
</div>

<?php
// Are there comments to navigate through?
if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
    do_action( 'yit_comments_navigation' );
}
?>

<?php do_action( 'yit_trackbacks' ) ?>
<?php
endif; //have_comments()

$commenter = wp_get_current_commenter();
	
if ( is_user_logged_in() )
	{ $email_author = get_the_author_meta('user_email'); }
else
	{ $email_author = $commenter['comment_author_email']; }
 
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );
$url_avatar = get_template_directory_uri() . '/images/noavatar.png';
$fields =  array(
	'author' => '<p class="comment-form-author span' . ( yit_get_sidebar_layout() == 'sidebar-no' ? 4 : 3 ) . '"><label class="hide-label" for="author">' . __( 'Name', 'yit' ) . '</label><i class="icon-user"></i>' . 
	            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
	'email'  => '<p class="comment-form-email  span' . ( yit_get_sidebar_layout() == 'sidebar-no' ? 4 : 3 ) . '"><label class="hide-label" for="email">' . __( 'Email', 'yit' ) . '</label><i class="icon-envelope"></i>' . 
	            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
	'url'    => '<p class="comment-form-url  span' . ( yit_get_sidebar_layout() == 'sidebar-no' ? 4 : 3 ) . '"><label class="hide-label" for="url">' . __( 'Website', 'yit' ) . '</label><i class="icon-globe"></i>' .
	            '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
);


$login_url = is_shop_installed() && is_shop_enabled() ? get_permalink( woocommerce_get_page_id( 'myaccount' ) ) : get_permalink( get_the_ID() );
$login_url = apply_filters( 'the_permalink', $login_url );

$comment_args = array(
	'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
	'comment_field'        => '<p class="comment-form-comment span' . ( yit_get_sidebar_layout() == 'sidebar-no' ? 12 : 9 ) . '"><label class="hide-label" for="comment">'. __( 'Your comment', 'yit' ).'</label><i class="icon-pencil"></i><textarea id="comment" name="comment" cols="45" rows="8"></textarea></p><div class="clear"></div>',
	'must_log_in'          => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'yit' ), $login_url ) . '</p>',
	'logged_in_as'         => '<p class="logged-in-as span' . ( yit_get_sidebar_layout() == 'sidebar-no' ? 12 : 9 ) . '">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'yit' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( get_the_ID() ) ) ) ) . '</p>',
	'comment_notes_before' => '',
	'comment_notes_after'  => '',
	'id_form'              => 'commentform',
	'id_submit'            => 'commentsubmit',
	'title_reply'          => __( 'Leave a <span>Reply</span>', 'yit' ),
	'title_reply_to'       => __( 'Leave a <span>Reply</span> to %s', 'yit' ),
	'cancel_reply_link'    => __( 'Cancel reply', 'yit' ),
	'label_submit'         => __( 'Post Comment', 'yit' ),
);

comment_form( $comment_args ); 