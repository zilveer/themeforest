<?php
/**
 * @package WordPress
 * @subpackage AllAround Theme
 * @author Shindiri Studio (http://www.shindiristudio.com) & http://www.mihajlovicnenad.com/
 */

if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');
?>
<div id="comments" class="comments_wrapper clearfix">
	<?php if ( post_password_required() ) : ?>
	<div class="nopassword">
		<?php _e( 'This post is password protected. Enter the password to view any comments.', 'allaround' ); ?>
	</div>
</div>
<?php 
	return; endif;
	if ( have_comments() ) :
?>
<div class="headline_wrap">
<h3><?php _e('Comments', 'allaround'); ?></h3>
<span class="number_of_comments"><?php echo get_comments_number(); ?></span><div class="clear"></div><!-- clear --></div><!-- header_wrapper -->
<div class="blog_post_comments">
	<?php wp_list_comments( array( 'callback' => 'allaround_comment' ) ); ?>
</div>
<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
<nav id="comment-nav-below">
	<div class="nav-previous">
		<?php previous_comments_link( __( '&larr; Older Comments', 'allaround' ) ); ?>
	</div>
	<div class="nav-next">
		<?php next_comments_link( __( 'Newer Comments &rarr;', 'allaround' ) ); ?>
	</div>
</nav>
<?php
	endif;
	else :
	if ( comments_open() ) :
	else :
	if ( ! comments_open() && ! is_page() ) :
?>
<p class="nocomments">
  <?php _e( 'Comments are closed.', 'allaround' ); ?>
</p>
<?php
	endif;
	endif;
	endif;?>
	<div class="margin-top24 margin-bottom24 blog_post_form">
	<?php
$fields =  array(

  'author' =>
    '<div class="input_column_wrapper"><div class="input_wrapper"><span class="input_title">' . __( 'Name', 'allaround' ) . ' ' . ( $req ? '<span class="required">*</span>' : '' ) . '</span><input id="author" class="input_field" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="' . __( 'Enter your name here', 'allaround' ) . '"/><div class="clear"></div><!-- clear --></div><!-- input_wrapper -->',

  'email' =>
    '<div class="input_wrapper"><span class="input_title">' . __( 'Email', 'domainreference' ) . ' ' . ( $req ? '<span class="required">*</span>' : '' ) . '</span><input id="email" class="input_field" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" placeholder="' . __( 'Enter your email here', 'allaround' ) . '"/><div class="clear"></div><!-- clear --></div><!-- input_wrapper -->',

  'url' =>
    '<div class="input_wrapper"><span class="input_title">' . __( 'Web', 'domainreference' ) . '</span><input id="url" class="input_field" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="' . __( 'Enter your website here', 'allaround' ) . '" /><div class="clear"></div><!-- clear --></div><!-- input_wrapper --></div><!-- input_column_wrapper -->'


);
	comment_form(array('fields'=>$fields, 'comment_field' =>
	'<div class="textarea_wrapper"><span class="textarea_title">' . __( 'Comment', 'allaround' ) . '</span><textarea id="comment" name="comment" name="text" class="textarea_field"  aria-required="true">Enter Text Here...</textarea></div><!-- textarea_wrapper -->', 'title_reply' => __( 'Send Us A Message Here', 'allaround' ), 'title_reply_to'    => __( 'Leave a Reply to %s' , 'allaround' )));
?>
</div>
</div>