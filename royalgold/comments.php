<?php
/**
 * The template for displaying Comments.
 */

if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) return;
if ( post_password_required() ) return;

if ( comments_open() ) : ?>

		<div id="comments">
<?php if ( have_comments() ) : ?>
			<h3 class="comment_no"><?php printf( __( 'Comments (%s)', 'royalgold' ), number_format_i18n( get_comments_number() ) ); ?></h3>
			<ol class="commentlist">
				<?php wp_list_comments( array( 'callback' => 'royalgold_comment', 'style' => 'ol' ) ); ?>

			</ol>
			<div class="sep"><span></span></div>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<div class="comments-pagination">
				<p><?php previous_comments_link( __( '&larr; Older Comments', 'royalgold' ) ); echo " "; next_comments_link( __( 'Newer Comments &rarr;', 'royalgold' ) ); ?></p>
			</div>
<?php endif; // check for comment navigation ?>
<?php if ( ! comments_open() && get_comments_number() ) : ?>
				<p class="nocomments"><?php _e( 'Comments are closed.' , 'royalgold' ); ?></p>
<?php endif; ?>
<?php endif; // have_comments() ?>
<?php
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$args = array(
		'comment_field' => '<label for="comment">' . __( 'Message', 'royalgold' ) . '</label><textarea name="comment" id="comment" rows="10" tabindex="4" class="full-width" aria-required="true"></textarea>',
		'logged_in_as' => '
				<p class="logged-in-as">' . __( 'Logged in as', 'royalgold' ) . ' <a href="' . get_option( 'siteurl' ) . '/wp-admin/profile.php">' . $user_identity . '</a>. <a href="' . wp_logout_url(apply_filters( 'the_permalink', get_permalink( ) )) . '" title="' . __( 'Log out of this account', 'royalgold' ) . '">' . __( 'Log out', 'royalgold' ) . '</a></p><div class="sep"><span></span></div>',
		'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.', 'royalgold' ) . '</p><div class="sep"><span></span></div>',
		'comment_notes_after' => '',
		'fields' => apply_filters( 'comment_form_default_fields', array(
			'author' => '<div class="comment-form-author">' . '<label for="author">' . __( 'Name', 'royalgold' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label><input id="author" name="author" type="text" class="full-width" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' tabindex="1" /></div>',
			'email' => '<div class="comment-form-email"><label for="email">' . __( 'Email', 'royalgold' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label><input id="email" name="email" type="text" class="full-width" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' tabindex="2" /></div>',
			'url' => '<div class="comment-form-url"><label for="url">' . __( 'Website', 'royalgold' ) . '</label>' . '<input id="url" name="url" type="text" class="full-width" value="' . esc_attr( $commenter['comment_author_url'] ) . '" tabindex="3" /></div></div>'
		) )
	);
	comment_form($args);
?>
		</div>

<?php endif; // comments_open ?>