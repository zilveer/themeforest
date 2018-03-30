<?php
/**
 * The template for displaying Comments.
 */

if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) return;
if ( post_password_required() ) return;

if ( comments_open() ) : ?>

		<div class="clear"></div>
		<div id="comments" class=" col">
<?php if ( have_comments() ) : ?>
			<div class="sep sep-small"></div>
			<h3 class="comment_bold_title"><?php printf( __( 'Comments (%s)', 'flatbox' ), number_format_i18n( get_comments_number() ) ); ?></h3>
			<ol class="commentlist">
				<?php wp_list_comments( array( 'callback' => 'flatbox_comment', 'style' => 'ol' ) ); ?>

			</ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<div class="comments-pagination">
				<?php previous_comments_link( __( '&larr; Older Comments', 'flatbox' ) ); ?>
				<?php next_comments_link( __( 'Newer Comments &rarr;', 'flatbox' ) ); ?>
			</div>
<?php endif; // check for comment navigation ?>
<?php if ( ! comments_open() && get_comments_number() ) : ?>
				<p class="nocomments"><?php _e( 'Comments are closed.' , 'flatbox' ); ?></p>
<?php endif; ?>

<?php endif; // have_comments() ?>
<?php
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$args = array(
		'comment_field' => '<label class="message_label" for="comment">' . __( 'Message', 'flatbox' ) . '</label><textarea name="comment" id="comment" rows="10" tabindex="4" class="full-width" aria-required="true"></textarea>',
		'logged_in_as' => '<p class="logged-in-as">' . __( 'Logged in as', 'flatbox' ) . ' <a href="' . get_option( 'siteurl' ) . '/wp-admin/profile.php">' . $user_identity . '</a>. <a href="' . wp_logout_url(apply_filters( 'the_permalink', get_permalink( ) )) . '" title="' . __( 'Log out of this account', 'flatbox' ) . '">' . __( 'Log out', 'flatbox' ) . '</a></p>',
		'comment_notes_after' => '',
		'fields' => apply_filters( 'comment_form_default_fields', array(
			'author' => '<div class="comment-form-author grid4 col alpha">' . '<label for="author">' . __( 'Name', 'flatbox' ) . ( $req ? '<span class="required cred">*</span>' : '' ) . '</label><input id="author" name="author" type="text" class="full-width" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' tabindex="1" /></div>',
			'email' => '<div class="comment-form-email grid4 col alpha"><label for="email">' . __( 'Email', 'flatbox' ) . ( $req ? '<span class="required cred">*</span>' : '' ) . '</label><input id="email" name="email" type="text" class="full-width" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' tabindex="2" /></div>',
			'url' => '<div class="comment-form-url grid4 col alpha"><label for="url">' . __( 'Website', 'flatbox' ) . '<span class="required"></span></label>' . '<input id="url" name="url" type="text" class="full-width" value="' . esc_attr( $commenter['comment_author_url'] ) . '" tabindex="3" /></div>'
		) )
	);
	comment_form($args);
?>
		</div>

<?php endif; // comments_open ?>