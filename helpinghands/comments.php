<?php
/**
 * Comments Page
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */

// Do not delete these lines
	if ( !empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'] ) )
		die ( 'Please do not load this page directly. Thanks!' );

	if ( post_password_required() ) { ?>

<p class="nocomments">
	<?php _e( 'This post is password protected. Enter the password to view comments.', 'sd-framework' ) ?>
</p>
<?php
		return;
	}
?>
<!-- You can start editing here. -->
<div id="comments" class="sd-comments-wrapper">
<?php if ( have_comments() ) : ?>
<div class="sd-comments clearfix">
	<?php if ( !empty( $comments_by_type['comment'] ) ) : ?>
	<h3 class="sd-comments-title"> 
		<?php comments_number( __( 'Leave a comment', 'sd-framework' ), __( '1 comment', 'sd-framework' ), __( '% Comments', 'sd-framework' ) );?>
	</h3>
	<ol class="sd-commentlist clearfix">
		<?php wp_list_comments( 'type=comment&avatar_size=135&callback=sd_custom_comments' ); ?>
	</ol>
	<?php endif; ?>
	
	<!-- trackbacks & pings -->
	<?php if ( ! empty( $comments_by_type['pings'] ) ) : ?>
	<div class="sd-trackbacks">
		<h3 class="sd-comments-title">
			<?php _e( 'Trackbacks/Pings', 'sd-framework' ); ?>
		</h3>
		<ul>
			<?php wp_list_comments( 'type=pings&callback=list_pings' ); ?>
		</ul>
	</div>
	<!-- trackbacks & pings end -->
	<?php endif; ?>
	<div class="sd-comments-nav">
		<div class="alignleft">
			<?php previous_comments_link() ?>
		</div>
		<div class="alignright">
			<?php next_comments_link() ?>
		</div>
	</div>
	</div>
<?php else : // this is displayed if there are no comments so far ?>
<?php if ( comments_open() ) : ?>
<!-- If comments are open, but there are no comments. -->

<?php else : // comments are closed ?>
<p class="hidden">
	<?php _e('Comments are closed.', 'sd-framework'); ?>
</p>
<?php endif; ?>
<?php endif; ?>
<?php if ( comments_open() ) : ?>
<?php
		// Customize comments fields
		$fields =  array(
			'author'=> '<div class="sd-respond-inputs clearfix"><p><input name="author" type="text" placeholder="' . __( 'Name*', 'sd-framework' ) .  '" size="30" aria-required="true" /></p>',
			'email' => '<p><input name="email" type="email" size="30" aria-required="true" placeholder="' . __( 'E-mail*', 'sd-framework' ) .  '"></p>',
			
			'url' 	=> '<p class="sd-last-input"><input name="url" type="url" size="30" placeholder="' . __( 'Website', 'sd-framework' ) .  '" /></p></div>'
	);
		// Comment Form Args
		$comments_args = array(
			'reply_text'        => __( 'Reply', 'sd-framework' ),
			'cancel_reply_link' => __( 'Cancel reply', 'sd-framework' ),
			'class_submit'         => 'sd-submit-comments sd-opacity-trans',
			'fields'            => $fields,
			'title_reply'       => '<span>'. __( 'Leave a reply', 'sd-framework' ) . '</span>',
			'comment_field'     => '<div class="sd-respond-textarea"><p><textarea id="comment" name="comment" aria-required="true" cols="58" rows="10" tabindex="4" placeholder="' . __( 'Comments*', 'sd-framework' ) .  '"></textarea></p></div>',
			'label_submit'      => __( 'Submit Comment', 'sd-framework' )
		);

	// Show Comment Form
	comment_form( $comments_args ); 
	?>
<?php endif; ?>
</div>