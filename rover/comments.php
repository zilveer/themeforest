<?php
/**
 * Comments
 * @package by Theme Record
 * @auther: MattMao
 */
?>

<?php if ( post_password_required() ) : ?>
<div id="comments">
	<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'TR'); ?></p>
</div><!-- #comments -->
<?php return; endif; ?>


<?php if ( have_comments() ) : ?>
<div id="comments">

	<h2 id="comments-title"><span><?php echo get_comments_number(); ?>  <?php _e('Comments','TR');  ?></span></h2>

	<ol class="commentlist">
		<?php wp_list_comments( array( 'callback' => 'theme_comments_list') ); ?>
	</ol>

	<?php 
	if (get_comment_pages_count() > 1 && get_option('page_comments')) 
	{
		$comment_pages = paginate_comments_links('echo=0');
		if ($comment_pages) 
		{
			echo '<div  class="comment-pagination clearfix">'.$comment_pages.'</div>';
		}
	}
	?>

</div><!-- #comments -->
<?php endif; ?>

<?php theme_comment_form(); ?>