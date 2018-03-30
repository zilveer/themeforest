<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (esc_attr_e('Please do not load this page directly. Thanks!','Tharsis'));

	if ( post_password_required() ) { ?>

<p class="nocomments"><?php esc_attr_e('This post is password protected. Enter the password to view comments.','Tharsis') ?></p>
<?php
		return;
	}
?>
<!-- You can start editing here. -->

<div id="comment-wrap">

<?php if ( have_comments() ) : ?>
	
	<h3 id="comments"><?php comments_number(esc_attr__('No comments','Tharsis'), esc_attr__('One comment','Tharsis'), '% '.esc_attr__('comments','Tharsis') );?></h3>
		
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<div class="comment_navigation_top clearfix">
			<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'Tharsis' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'Tharsis' ) ); ?></div>
		</div> <!-- .navigation -->
	<?php endif; // check for comment navigation ?>
	<?php if ( ! empty($comments_by_type['comment']) ) : ?>
		<ol class="commentlist clearfix">
			<?php wp_list_comments( array('type'=>'comment','callback'=>'vp_comment') ); ?>
		</ol>
	<?php endif; ?>
	
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<div class="comment_navigation_bottom clearfix">
			<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'Tharsis' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'Tharsis' ) ); ?></div>
		</div> <!-- .navigation -->
	<?php endif; // check for comment navigation ?>
		
	<?php if ( ! empty($comments_by_type['pings']) ) : ?>
		<div id="trackbacks">
			<h3 id="trackbacks-title"><?php esc_html_e('Trackbacks/Pingbacks','Tharsis') ?></h3>
			<ol class="pinglist">
				<?php //wp_list_comments('type=pings&callback=vp_pings'); ?>
			</ol>
		</div>
	<?php endif; ?>	
<?php else : // this is displayed if there are no comments so far ?>
   <div id="comment-section" class="nocomments">
      <?php if ('open' == $post->comment_status) : ?>
         <!-- If comments are open, but there are no comments. -->
         
      <?php else : // comments are closed ?>
         <!-- If comments are closed. -->
            <div id="respond">
               
            </div> <!-- end respond div -->
      <?php endif; ?>
   </div>
<?php endif; ?>
<?php if ('open' == $post->comment_status) : ?>
	<?php 
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	if($commenter['comment_author'] != '') 
		$name = esc_attr($commenter['comment_author']);
	else 
		$name = '';
	if($commenter['comment_author_email'] != '') 
		$email = esc_attr($commenter['comment_author_email']);
	else
		$email = '';
	if($commenter['comment_author_url'] != '') 
		$url = esc_attr($commenter['comment_author_url']);
	else 
		$url = '';
	$fields =  array(
	'author' => '<input id="author" placeholder="Name *" name="author" type="text" value="' . $name . '" size="30"' . $aria_req . ' />',
	'email'  => '<input id="email" placeholder="E-mail *" name="email" type="text" value="' . $email . '" size="30"' . $aria_req . ' />',
	'url'    => '<input id="url" placeholder="Website" name="url" type="text" value="' . $url . '" size="30" /> <div class="clear"></div>'
	); 
	$comment_textarea = '<textarea placeholder="Message..." cols="40" rows="3" id="comment" name="comment" aria-required="true"></textarea> <div class="clear"></div>';
	comment_form( array( 'fields' => $fields, 'comment_field' => $comment_textarea, 'label_submit' => esc_attr__( 'Submit Comment', 'Tharsis' ), 'title_reply' => '<span>' . esc_attr__( 'Leave a Reply', 'Tharsis' ) . '</span>', 'title_reply_to' => esc_attr__( 'Leave a Reply to %s', 'Tharsis' )) ); ?>
	<div class="clear"></div>
<?php else: ?>

<?php endif; // if you delete this the sky will fall on your head ?>
</div>