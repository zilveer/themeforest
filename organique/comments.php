<?php
/**
 * The template for displaying Comments.
 *
 * @package Organique
 */
?>

<section id="comments" class="comments-container">
<?php
	if ( ! post_password_required() ) :
	if ( comments_open() ) :
?>

	<?php if( have_comments() ) : ?>
	<h3 class="push-down-30">
		<?php
			echo lighted_title( sprintf(
				_n( 'One Comment', '%s Comments', get_comments_number(), 'organique_wp' ),
				number_format_i18n( get_comments_number() )
			) );
		?>
	</h3>
	<?php endif; // have comments ?>

	<?php
		wp_list_comments( array(
			'style'        => 'div',
			'format'       => 'html5',
			'avatar_size'  => 140,
			'callback'     => 'organique_comment',
			'end-callback' => 'end_organique_comment',
		));


/**
 * Comments navigation
 */
if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
	<div class="navigation  clearfix  push-down-40" role="navigation">
		<div class="nav-previous  pull-left"><?php previous_comments_link( __( '&larr; Older Comments' , 'organique_wp' ) ); ?></div>
		<div class="nav-next  pull-right"><?php next_comments_link( __( 'Newer Comments &rarr;' , 'organique_wp' ) ); ?></div>
	</div>
<?php endif; //paginate comments or not ?>

	<?php if ( have_comments() ) {
		echo '<hr />';
	} ?>

	<h3 class="push-down-25">
		<?php echo lighted_title( __( 'Leave a Comment' , 'organique_wp' ) ); ?>
	</h3>


<?php
/**
 * Form for posting a new comment
 * @link http://codex.wordpress.org/comment_form
 */

$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true' required" : '' );

$form_args = array(
	"title_reply"          => "",
	"label_submit"         => __( "Send now" , 'organique_wp' ),
	"comment_notes_before" => '',
	"comment_notes_after"  => '',
	'id_submit'            => 'submitWPComment',
	'comment_field'        =>  '<p class="push-down-15"><label for="message">' . __( 'Message' , 'organique_wp' ) . ( $req ? ' <span class="warning">*</span>' : '' ) . '</label><textarea class="form-control form-control--contact form-control--big" id="comment" name="comment" rows="7" aria-required="true" placeholder="' . __( 'Your comment goes here.', 'organique_wp' ) . '" required>' . '</textarea></p>',
	'fields' => array(
		'author' => '<p class="push-down-15"><label for="author">' . __( 'Name' , 'organique_wp' ) . ( $req ? ' <span class="warning">*</span>' : '' ) . '<input class="form-control  form-control--contact" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></label></p>',
		'email' => '<p class="push-down-15"><label for="email">' . __( 'Email' , 'organique_wp' ) . ( $req ? ' <span class="warning">*</span>' : '' ) . '<input class="form-control  form-control--contact" id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></label></p>',
		'url' => '<p class="push-down-15"><label for="url">' . __( 'Website' , 'organique_wp' ) . '<input class="form-control  form-control--contact" id="url" name="url" type="text" value="' . esc_attr(  $commenter['comment_author_url'] ) . '" size="30" /></label></p>',
	)
);

comment_form( $form_args );

else : //if comments_open
if ( is_single() ) :
?>

	<h3><?php _e( '<span class="light">Comments</span> are disabled for this post' , 'organique_wp' ) ?></h3>

<?php
	endif; //if is_page
	endif; //if comments_open
	else : //if post_password_required
?>

	<h3><?php _e( '<span class="light">Comments</span> not shown for password protected posts' , 'organique_wp' ); ?></h3>

<?php endif; //if post_password_required ?>
</section>