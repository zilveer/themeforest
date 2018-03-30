<?php
/**
 * Comments Template
 *
 * @package Mysitemyway
 * @subpackage Template
 */
	if ( 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) )
		die( __( 'Please do not load this page directly.', MYSITE_TEXTDOMAIN ) );

	if ( !post_type_supports( get_post_type(), 'comments' ) || ( !have_comments() && !comments_open() && !pings_open() ) )
		return;

	if ( post_password_required() ) : ?>

		<h3 class="comments-header"><?php _e( 'Password Protected', MYSITE_TEXTDOMAIN ); ?></h3>

		<p class="alert password-protected">
			<?php _e( 'Enter the password to view comments.', MYSITE_TEXTDOMAIN ); ?>
		</p><!-- .alert .password-protected -->
		
		<?php return; ?>
		
	<?php endif; ?>
	
	
<?php if ( have_comments() ) : ?>
	
	<div id="comments">
		
		<?php if( apply_atomic( 'post_comment_styles', mysite_get_setting( 'post_comment_styles' ) ) == 'tab' ) : ?>
			
			<?php mysite_comment_tab(); ?>
			
		<?php else : ?>
			
			<?php mysite_comment_list(); ?>
			
		<?php endif; ?>
		
	</div><!-- #comments -->
	
<?php endif; ?>
	
<?php comment_form(); ?>
<?php mysite_after_comments(); ?>