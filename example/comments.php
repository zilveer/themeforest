<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to mpcth_comment() which is
 * located in the mpcth-functions.php file.
 *
 * @package WordPress
 * @subpackage MPC WP Boilerplate
 * @since 1.0
 */

$field_name 	=  __('Name', 'mpcth');
$field_email 	=  __('Email', 'mpcth');
$field_url 		=  __('Website', 'mpcth');
$field_comment 	=  __('Comment', 'mpcth');

if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area">

	<?php mpcth_add_corners(); ?>

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				comments_number(__('0 comments', 'mpcth'), __('1 comment', 'mpcth'), __('% comments', 'mpcth'));
			?>
		</h2>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'mpcth_comment', 'style' => 'ol' ) ); ?>
		</ol><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation" role="navigation">
			<h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'mpcth' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'mpcth' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'mpcth' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

		<?php
		/* If there are no comments and comments are closed, let's leave a note.
		 * But we only want the note on posts and pages that had comments in the first place.
		 */
		if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.' , 'mpcth' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>

	<script type="text/javascript">
		jQuery(document).ready(function($) {
			
			$.validator.addMethod("notEqual", function(value, element, param) {
				return value !== param;
			}, "<?php _e('Please input value!', 'mpcth'); ?>");
			 	
			/* Validation for contact form */
			$('#commentform').validate({
				rules: {
					author: {
						required: true,
						minlength: 2,
						notEqual: '<?php echo $field_name; ?>*'
					},
							
					email: {
						required: true,
						email: true, 
						notEqual: '<?php echo $field_email; ?>*'
					},
					
					comment: {
						required: true,
						minlength: 5,
						notEqual: '<?php echo $field_comment; ?>*'
						
					}			
				},
						
				messages: {
					author	: "<?php _e('Wrong name, please insert correct value.', 'mpcth') ?>",
					email	: "<?php _e('Wrong email, please insert correct value.', 'mpcth') ?>",
					comment	: "<?php _e('Wrong message, please insert correct value.', 'mpcth') ?>"
				}
			});

			$('#commentform').on('submit', function() {
				var $url = $(this).find('#mpcth_comments_url');

				if($url.val() == '<?php echo $field_url ?>')
					$url.val('');
			})
		});
	</script>

	<?php
	$fields =  array(
		'author' => '<p class="comment-form-author"><label for="author">' . $field_name . '</label><input id="author" name="author" type="text" value="' . $field_name . '*" size="30" onfocus="if(this.value==\''. $field_name .'*\') this.value=\'\';" onblur="if(this.value==\'\')this.value=\''. $field_name .'*\';"/></p>',

		'email' => '<p class="comment-form-email"><label for="email">' . $field_email . '</label><input id="email" name="email" type="text" value="' . $field_email . '*" size="30" onfocus="if(this.value==\''. $field_email .'*\') this.value=\'\';" onblur="if(this.value==\'\')this.value=\''. $field_email .'*\';"/></p>',

		'url' => '<p class="comment-form-url"><label for="url">' . $field_url . '</label><input id="mpcth_comments_url" name="url" type="text" value="' . $field_url . '" size="30" onfocus="if(this.value==\''. $field_url .'\') this.value=\'\';" onblur="if(this.value==\'\')this.value=\''. $field_url .'\';"/></p>'	
	); 

	$defaults = array(
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'title_reply'          => __( 'Leave a Comment', 'mpcth' ),
		'title_reply_to'       => __( 'Leave a Reply to %s', 'mpcth' ),
		'cancel_reply_link'    => __( ' - Cancel Reply', 'mpcth' ),
		'label_submit'         => __( 'Post Comment', 'mpcth' ),
		'comment_field' => '<p class="comment-form-comment"><label for="comment">' . $field_comment . '</label><textarea id="comment" name="comment" cols="45" rows="8" onfocus="if(this.value==\''. $field_comment .'*\') this.value=\'\';" onblur="if(this.value==\'\')this.value=\''. $field_comment .'*\';">' . $field_comment . '*</textarea></p>'
	);

	comment_form($defaults); 
	?>

</div><!-- #comments .comments-area -->