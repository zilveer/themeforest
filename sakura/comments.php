<?php
if (empty($GLOBALS['is_contacts']) || !$GLOBALS['is_contacts']) { ?>
   <div class="article_b"></div> 
      <?php } ?>
<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  The actual display of comments is
 * handled by a callback to sakura_comment which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
 
global $post;
               if (!$post) $post = $wp_query->post;
               //print_r($post);
				   if ($post->comment_status!='closed') {
 
?>

        <div class="article_footer"> 
          <div class="article_footer_s comments"> 

			<div id="comments">
<?php if ( post_password_required() ) : ?>
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'sakura' ); ?></p>
			</div><!-- #comments -->
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>

<?php if ( have_comments() ) : ?>
			<div class="header"><?php
			printf( _n( 'One comment:', '%1$s comments:', get_comments_number(), 'sakura' ),
			number_format_i18n( get_comments_number() ) );
			?></div>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'sakura' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'sakura' ) ); ?></div>
			</div> <!-- .navigation -->
<?php endif; // check for comment navigation ?>

				<?php
					/* Loop through and list the comments. Tell wp_list_comments()
					 * to use sakura_comment() to format the comments.
					 * If you want to overload this in a child theme then you can
					 * define sakura_comment() and that will be used instead.
					 * See sakura_comment() in sakura/functions.php for more.
					 */
					wp_list_comments( array( 'callback' => 'sakura_comment' ) );
				?>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'sakura' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'sakura' ) ); ?></div>
			</div><!-- .navigation -->
<?php endif; // check for comment navigation ?>

<?php else : // or, if we don't have comments:

?>

<div class="comments_spead"></div>

<?php

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() ) :
?>
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

   <?php
   
   ob_start();
   comment_form();
   ob_get_clean();
   
   global $current_user;
   get_currentuserinfo();
   
global $post;
               if (!$post) $post = $wp_query->post;
               //print_r($post);
				   if ($post->comment_status!='closed') {
   
   ?>
   
      <div id="form_prev_holder"> 
      <div id="form_holder"> 
   
  <div id="respond">
    <div class="header">Share a comment:</div>
    
    <?php if (is_user_logged_in()) { ?>
      <small>You are currently logged in as <a href="<?php echo home_url('/').'author/'.$current_user->user_login.'/'; ?>"><?php echo $current_user->user_login; ?></a></small>
    <?php } else { ?>
    <small>Your email address will not be published. Required fields are marked <span class="required">*</span></small>
    <?php } ?>
    
    <form action="<?php echo home_url('/'); ?>wp-comments-post.php" method="post" id="commentform" class="uniform">
    
      <?php if (!is_user_logged_in()) { ?>
      
        <div class="i_h"><div class="l">
           <input id="author" name="author" type="text" aria-required='true' placeholder="Name*" class="validate[required]" value="<?php echo $current_user->user_login; ?>" />
        </div></div>
        <div class="i_h"><div class="r">
           <input id="f_email" name="email" type="text" placeholder="Email*" aria-required='true' class="validate[required,custom[email]]" value="<?php echo $current_user->user_email; ?>" />
        </div></div>
        <input type="hidden" id="url" name="url" value="<?php echo $current_user->user_url; ?>" />
        
      <?php } ?>
      
      <div class="t_h"><textarea id="comment" name="comment" class="validate[required]" aria-required="true" placeholder="Comment*"></textarea></div> 
      
     <a href="#" id="submit" class="subm_comm go_add_comment" title="Add comment"></a>
     <a rel="nofollow" id="cancel-comment-reply-link" href="#respond" class="do_clear">Cancel</a>
     
     <?php comment_id_fields(); ?>
      
      <?php do_action('comment_form', $post->ID); ?>
      
    </form>
    
    <!--
      <p class="form-allowed-tags">You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:  <code>&lt;a href=&quot;&quot; title=&quot;&quot;&gt; &lt;abbr title=&quot;&quot;&gt; &lt;acronym title=&quot;&quot;&gt; &lt;b&gt; &lt;blockquote cite=&quot;&quot;&gt; &lt;cite&gt; &lt;code&gt; &lt;del datetime=&quot;&quot;&gt; &lt;em&gt; &lt;i&gt; &lt;q cite=&quot;&quot;&gt; &lt;strike&gt; &lt;strong&gt; </code></p>
     -->

  </div><!-- #respond -->
  <?php } ?>

</div><!-- #comments -->

</div></div>


          </div> 
        </div> 
        <div class="article_footer_b"></div> 
        
<?php } ?>
