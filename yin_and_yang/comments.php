<?php

  // Do not delete these lines
  if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die (esc_html__('Please do not load this page directly. Thanks!', 'onioneye'));

  if ( post_password_required() ) { ?>
  	<div class="help">
    	<p class="nocomments"><?php esc_html_e('This post is password protected. Enter the password to view comments.', 'onioneye'); ?></p>
  	</div>
  <?php
    return;
  }
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	
	<h3 id="comments" class="h4">
		<?php
			echo esc_html(sprintf(_n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'onioneye' ),
						number_format_i18n( get_comments_number() ), get_the_title() ));
		?>
	</h3>
	
	<nav class="comment-nav">
		<ul class="group">
	  		<li><?php previous_comments_link() ?></li>
	  		<li><?php next_comments_link() ?></li>
	 	</ul>
	</nav>
	
	<ol class="commentlist">
		<?php wp_list_comments('type=comment&callback=onioneye_post_comments'); ?>
	</ol>
	
	<nav class="comment-nav">
		<ul class="group">
	  		<li><?php previous_comments_link() ?></li>
	  		<li><?php next_comments_link() ?></li>
		</ul>
	</nav>
  
	<?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
    	<!-- If comments are open, but there are no comments. -->

	<?php else : // comments are closed ?>
	
	<!-- If comments are closed. -->
	
	<?php endif; ?>

<?php endif; ?>


<?php if ( comments_open() ) : ?>
	
	<?php 
	
	$fields =  array(
		'author' => '<p class="comment-form-author">' . '<label for="author">' . esc_html__( 'Name', 'onioneye' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
		            '<input id="author" name="author" type="text" placeholder="' . esc_html__('Your Name', 'onioneye') . '" tabindex="1" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></p>',
		'email'  => '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'onioneye' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
		            '<input id="email" name="email" type="text" placeholder="' . esc_html__('Your Email', 'onioneye') . '" tabindex="2" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></p>',
		'url'    => '<p class="comment-form-url"><label for="url">' . esc_html__( 'Website', 'onioneye' ) . '</label>' .
		            '<input id="url" name="url" type="text" placeholder="' . esc_html__('Your Website', 'onioneye') . '" tabindex="3" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
	); 

	$new_defaults = array(
		'fields' => $fields,
		'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" aria-required="true" tabindex="4" placeholder="' . esc_attr__('Your Comment Here...', 'onioneye') . '"></textarea></p>',
		'comment_notes_before' => '<p class="comment-notes">' . esc_html__( 'Your email address will not be published.', 'onioneye' ) . '</p>',
		'comment_notes_after' => ''
	);
	
	?>
	
	<?php comment_form($new_defaults); ?>

<?php endif; ?>
