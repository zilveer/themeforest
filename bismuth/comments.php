<?php
// Dont delete these lines

	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))

		die (esc_attr_e('Please do not load this page directly. Thanks!','LB'));

	if ( post_password_required() ) { ?>

<p class="nocomments"><?php esc_attr_e('This post is password protected. Enter the password to view comments.','LB') ?></p>

<?php
		return;

	}

?>

<!-- You can start editing here. -->

<div id="comment-wrap">

<?php if ( have_comments() ) : ?>

	<h3 id="comments"><?php comments_number(esc_attr__('No Comments','LB'), esc_attr__('1 Comment','LB'), '% '.esc_attr__('Comments','LB') );?></h3>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>

		<div class="comment_navigation_top clearfix">

			<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Previous Comments', 'LB' ) ); ?></div>

			<div class="nav-next"><?php next_comments_link( __( 'Next Comments <span class="meta-nav">&rarr;</span>', 'LB' ) ); ?></div>

		</div> <!-- .navigation -->

	<?php endif; // check for comment navigation ?>

	<?php if ( ! empty($comments_by_type['comment']) ) : ?>

		<ol class="commentlist clearfix">

			<?php wp_list_comments( array('type'=>'comment','callback'=>'vp_comment') ); ?>

		</ol>

	<?php endif; ?>
	

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>

		<div class="comment_navigation_bottom clearfix">

			<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Previous Comments', 'LB' ) ); ?></div>

			<div class="nav-next"><?php next_comments_link( __( 'Next Comments <span class="meta-nav">&rarr;</span>', 'LB' ) ); ?></div>

		</div> <!-- .navigation -->

	<?php endif; // check for comment navigation ?>	

	<?php if ( ! empty($comments_by_type['pings']) ) : ?>

		<div id="trackbacks">

			<h3 id="trackbacks-title"><?php esc_html_e('Trackbacks/Pingbacks','LB') ?></h3>

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

            </div>

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

	$comment_textarea = '<textarea placeholder="Your Message..." cols="40" rows="6" id="comment" name="comment" aria-required="true"></textarea> <div class="clear"></div>';

	comment_form( array( 
		'fields' => $fields, 
		'comment_field' => $comment_textarea, 
		'label_submit' => esc_attr__( 'Post Comment', 'LB' ), 
		'title_reply' => '<span>' . esc_attr__( 'Leave a Reply', 'LB' ) . '</span>', 'title_reply_to' => esc_attr__( 'Reply to %s', 'LB' ),
		'comment_form_top' => '',
		'comment_notes_after' => '',
		'comment_notes_before' => '',
	) ); 
	?>

	<div class="clear"></div>

<?php else: ?>

<?php endif; // if you delete this bad things will happen ?>

</div>