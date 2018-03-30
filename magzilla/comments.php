<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package Magzilla
 * @since Magzilla 1.0
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
global $ft_option;
?>

<div class="post-comments-form">
	
	<?php
	//Custom Fields
	$fields =  array(
		'author'=> '<div class="module-body"><div class="row">
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-user"></i></div>
									<input name="author" required class="form-control" id="author" value="" placeholder="'.__('Enter your name', 'magzilla' ).'" type="text">
								</div>
							</div>
						</div>',

		'email' => '<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-envelope-o"></i></div>
								<input type="email" class="form-control" required name="email" id="email" placeholder="'.__('Enter your email', 'magzilla' ).'">
							</div>
						</div>
					</div>',

		'url' 	=> '</div></div>',
	);

	//Comment Form Args
	$comments_args = array(
		'fields' => $fields,
		'title_reply'=>'<div class="module-top clearfix"><h4 class="module-title">'. __('JOIN THE DISCUSSION', 'magzilla') .'</h4></div>',
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'comment_field' => '<div class="module-body"><div class="row"><div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><div class="form-group"><textarea class="form-control" required rows="4" name="comment" id="comment"></textarea></div></div></div></div>',
		'label_submit' => __('Submit', 'magzilla' )
	);

	// Show Comment Form
	comment_form($comments_args); 
	?>


</div><!-- post-comments -->

<?php if ( have_comments() ) : ?>
<div class="post-comments">
	<div id="comments" class="module-top clearfix">
		<h4 class="module-title"><?php _e( 'Comments', 'magzilla' ); ?></h4>
	</div><!-- module-top -->
	<div class="module-body">
		<ul class="media-list comment-list">

			<?php
				wp_list_comments( array(
					'style'      => 'ul',
					'short_ping' => true,
					'avatar_size'=> 50,
					'callback' => 'fave_comments_callback'
				) );
			?>
		</ul>
	</div><!-- module-body -->

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
		<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'magzilla' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'magzilla' ) ); ?></div>
	</nav><!-- #comment-nav-above -->
	<?php endif; // Check for comment navigation. ?>

</div><!-- post-comments -->
<?php endif; ?>


