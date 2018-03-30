<?php

/**
 * @package sellya Sport
 * @subpackage sellya_sport
 */

?>

<?php
	if ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :
?>
	<p class="nocomments"><?php _e( 'Comments are closed.', 'sellya' ); ?></p>
<?php

	return;

	endif; 

?>    


<div id="articleComments">

<?php if ( have_comments() ) : ?>

<?php if ( post_password_required() ) : ?>

	<h4 class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'sellya' ); ?></h4>

	</div><!--#articleComments -->

<?php		

		return;

	endif;

	global $post;

?>

    <h4>

	<?php printf( _n( 'One thought on &ldquo; %2$s &rdquo;', '%1$s thoughts on &ldquo; %2$s &rdquo;', get_comments_number(), 'sellya' ),

					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );

	?>

	</h4>

    <div id="comments">

    	<ul class="commentList">

        	<?php

				$GLOBALS['ncc'] = 1;

				$args = array( 'type'=>'comment', 'style'=>'', 'callback' => 'sellya_comment' );

				wp_list_comments($args);

				

				

			?>

        </ul><!--.commentList -->

    </div><!--#comments -->

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>

		<nav id="comment-nav-above">

			<h1 class="assistive-text"><?php _e( 'Comment navigation', 'sellya' ); ?></h1>

			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'sellya' ) ); ?></div>

			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'sellya' ) ); ?></div>

		</nav>

	<?php endif; // check for comment navigation ?>

    

    

<?php endif;?>    

 

<?php 
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );

$formargs = array(
	
  'id_form'           => 'commentform',
  'id_submit'         => 'submit',
  'title_reply'       => __( 'Leave a Reply','sellya' ),
  'title_reply_to'    => __( 'Leave a Reply to %s','sellya' ),
  'cancel_reply_link' => __( 'Cancel Reply','sellya' ),
  'label_submit'      => __( 'Post Comment','sellya' ),

  'comment_field' =>  '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun', 'sellya' ) .
    '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">' .
    '</textarea></p>',

  'must_log_in' => '<p class="must-log-in">' .
    sprintf(
      __( 'You must be <a href="%s">logged in</a> to post a comment.','sellya' ),
      wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
    ) . '</p>',

  'logged_in_as' => '<p class="logged-in-as">' .
    sprintf(
    __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','sellya' ),
      admin_url( 'profile.php' ),
      $user_identity,
      wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
    ) . '</p>',

  'comment_notes_before' => '<p class="comment-notes">' .
    __( 'Your email address will not be published.','sellya' ) . ( $req ? '<span class="required">*</span>' : '' ) .
    '</p>',
	'comment_notes_after' => '',
  'fields' => apply_filters( 'comment_form_default_fields', array(

    'author' =>
      '<p class="comment-form-author">' .
      '<label for="author">' . __( 'Name', 'sellya' ) . '</label> ' .
      ( $req ? '<span class="required">*</span>' : '' ) .
      '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
      '" size="30"' . $aria_req . ' /></p>',

    'email' =>
      '<p class="comment-form-email"><label for="email">' . __( 'Email', 'sellya' ) . '</label> ' .
      ( $req ? '<span class="required">*</span>' : '' ) .
      '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
      '" size="30"' . $aria_req . ' /></p>',

    'url' =>
      '<p class="comment-form-url"><label for="url">' .
      __( 'Website', 'sellya' ) . '</label>' .
      '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
      '" size="30" /></p>'
    )
  ),
);


comment_form($formargs); 


?>

</div><!--#articleComments -->



