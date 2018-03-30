<?php /* based on twentyten comment template*/ ?>
<div class="clearfix"></div>
<div id="comments" class="rt_comments rt_form">
<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'rt_theme' ); ?></p>
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
 

			<h6 id="comments-title"><?php		
				if(get_comments_number() == 1)
				    $results = __('One Response to' , 'rt_theme');
				else
				    $results = sprintf( __('%s Responses to' , 'rt_theme') , get_comments_number());

				echo $results . ' <em>' . get_the_title() . '</em>';
			?></h6>
			
			
			<div class="line"></div><!-- line -->			
			

			<ol class="commentlist">
				<?php
					/* Loop through and list the comments. Tell wp_list_comments()
					 * to use twentyten_comment() to format the comments.
					 * If you want to overload this in a child theme then you can
					 * define twentyten_comment() and that will be used instead.
					 * See twentyten_comment() in twentyten/functions.php for more.
					 */
					wp_list_comments(  					
                                array(
                                'walker'            => null,
                                'max_depth'         => 7,
                                'style'             => 'ul',
                                'callback'          => "rt_comments", 
                                'type'              => 'all',  
                                'avatar_size'       => 48,
                                )
					); 
				?>
			</ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation clearfix">
				<?php if( get_previous_comments_link() ):?>
					<div class="nav-previous button_border"><span class="meta-nav">&larr; </span><?php echo get_previous_comments_link( __( 'Older Comments', 'rt_theme' ) ); ?></div>
				<?php endif;?>


				<?php if( get_next_comments_link() ):?>
					<div class="nav-next button_border"><?php next_comments_link( __( 'Newer Comments ', 'rt_theme' ) ); ?><span class="meta-nav"> &rarr;</span></div>
				<?php endif;?>
			</div><!-- .navigation -->
<?php endif; // check for comment navigation ?>


		<?php if ( ! comments_open() ) :?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'rt_theme' ); ?></p>
		<?php endif; // end ! comments_open() ?>

<?php else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
?> 
			
<?php endif; // end have_comments() ?>


<?php if ( get_comments_number() > 0) : // Are there comments to navigate through? ?>
<br /><div class="line"><span class="top">[<?php _e( 'top', 'rt_theme' ); ?>]</span></div>
<?php endif;?>

<?php  
 
//text fields
$commnet_author = ( $commenter['comment_author'] ) ?  esc_attr( $commenter['comment_author'] )  :  __('Name','rt_theme') . ( $req ? ' *' : '' );
$commnet_author_email = ( $commenter['comment_author_email'] ) ?  esc_attr( $commenter['comment_author_email'] )  :  __('Email','rt_theme') . ( $req ? ' *' : '' );
$comment_author_url = ( $commenter['comment_author_url'] ) ?  esc_attr( $commenter['comment_author_url'] )  :  __('Website','rt_theme');
$aria_req = "";

$fields =  array(
	'author' => '<li class="box three first comment-form-author">'.
	            '<input id="author" name="author" class="showtextback" type="text" value="' . $commnet_author . '" size="30"' . $aria_req . ' />'.
	            '</li>',

	'email' => '<li class="box three comment-form-email">'.
	            '<input id="email" name="email" class="showtextback" type="text" value="' . $commnet_author_email . '" size="30"' . $aria_req . ' />'.
	            '</li>',


	'url' => '<li class="box three last comment-form-url ">'.
	            '<input id="url" name="url" class="showtextback" type="text" value="' . $comment_author_url . '" size="30" />'.
	            '</li>',


);
 
//comment form args

$comments_args = array( 	
	'comment_field'        => '<div class="text-boxes"><ul><li><textarea tabindex="4" class="comment_textarea showtextback" rows="10" id="comment" name="comment">'. __('Comment','rt_theme') .' *</textarea></li></ul></div><div class="clear space"></div>',
	'id_form'              => 'commentform', 
	'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
	'id_submit'            => 'submit',
	'title_reply'          => __( 'Leave a Reply' ,'rt_theme'),
	'title_reply_to'       => __( 'Leave a Reply to %s' ,'rt_theme'),
	'cancel_reply_link'    => __( 'Cancel reply' ,'rt_theme'),
	'label_submit'         => __( 'Post Comment','rt_theme' ),
	'comment_notes_after' => ""
);
comment_form( $comments_args, $post->ID );

?> 

</div><!-- #comments -->