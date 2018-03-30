<?php
/**
 * The template for displaying Comments.
 *
 * @package WordPress
 * @subpackage 3D
 * @since im themes 3D
 * Graphic Desing : İlkay Alpgiray
 * Code : Mustafa TANRIVERDİ
 */
?>

<!-- Comment List Start -->
<div class="comment-blog">
	<h1 class="comment-title"><?php echo get_option('im_lang_blog_post_comments', true); ?></h1>

	<?php if ( post_password_required() ) : ?>
    <?php _e( 'This post is password protected. Enter the password to view any comments.', '' ); ?>	
    <?php return; endif;?>
    <?php if ( have_comments() ) : ?>

	<?php           
    function iamthemes_comment( $comment, $args, $depth ) 
	{
    	$GLOBALS['comment'] = $comment;
   		switch ( $comment->comment_type ) :
    	case '' :
   	?>
    	<div class="comment-list">
   			<?php echo get_avatar( $comment, 58 ); ?> 
    
            <h1><?php echo get_the_author(); ?>:</h1>
            <span class="comment-date"><?php printf( __( '%1$s at %2$s', '' ), get_comment_date(),  get_comment_time() ); ?></span>
            <?php comment_text() ?>
			<div class="clear"></div>
    		<?php if ( $comment->comment_approved == '0' ) : ?>
        	<p><?php _e( 'Your comment is awaiting moderation.', '' ); ?></p>
    		<?php endif; ?>

    
    <?php break; endswitch; } ?>
    
		
			<?php wp_list_comments( array( 'callback' => 'iamthemes_comment', 'style' => 'div' ) ); ?>
      	
      
	<?php else : if ( ! comments_open() ) :?>
    	<p><?php _e( 'Comments are closed.', '' ); ?></p>
    <?php endif; ?>
    	<p>No Comment</p>
    <?php endif; ?>
</div> <!-- /.comment-blog -->
<div class="clear"></div>

<!-- Comment List Start -->
<div class="comment-blog">
    <h1 class="comment-title"><?php echo get_option('im_lang_blog_post_comment_write', true); ?></h1>   
    <div class="comment-form">
          <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
          
			  <?php if ( $user_ID ) : ?>
              
			  <?php else : ?>
              
              <fieldset><input id="author" name="author" type="text" value="<?php lang('Name'); ?>:" onfocus="if(this.value=='<?php lang('Name'); ?>:')this.value='';" onblur=	"if(this.value=='')this.value='<?php lang('Name'); ?>:';"/></fieldset>  
              <fieldset><input id="email" name="email" type="text" value="<?php lang('E-Mail'); ?>:" onfocus="if(this.value=='<?php lang('E-Mail'); ?>:')this.value='';" onblur=	"if(this.value=='')this.value='<?php lang('E-Mail'); ?>:';"/></fieldset>
              <fieldset><input id="url" name="url" type="text" value="<?php lang('Web'); ?>:" onfocus="if(this.value=='<?php lang('Web'); ?>:')this.value='';" onblur=	"if(this.value=='')this.value='<?php lang('Web'); ?>:';"/></fieldset>
              
              <?php endif; ?>
              
              <fieldset><textarea id="comment" name="comment" onfocus="if(this.value=='<?php echo get_option('im_lang_blog_message', true); ?>:')this.value='';" onblur=	"if(this.value=='')this.value='<?php echo get_option('im_lang_blog_message', true); ?>:';"><?php echo get_option('im_lang_blog_message', true); ?>:</textarea></fieldset>
              
              <a href="#" class="More3d comment-button" onclick="document.getElementById('commentform').submit();"><?php echo get_option('im_lang_blog_send', true); ?></a>
              
              <?php comment_id_fields(); ?>
              <?php do_action('comment_form', $post->ID); ?>

           </form>
         
    </div> <!-- /.comment-form -->
    <div class="requ"> <?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?> <?php comment_form(); ?></div>
</div><!-- /.comment-blog -->
<div class="clear"></div>