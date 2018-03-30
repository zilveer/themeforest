<?php 
	/*
	 * This file is used to generate comments form.
	 */	
?>

<!-- Check Authorize -->
<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
	if (post_password_required()){
		?>

<p class="nopassword">
  <?php ('This post is password protected. Enter the password to view comments.'); ?>
</p>
<?php
		return;
	}
?>
<!-- Comment List -->
<?php if ( have_comments() ) : ?>
<article>
  <div class="widget-bg">
    <div class="comments">
      <h2><?php comments_number(__('No Comment','cp_front_end'), __('One Comment','crunchpress'), __('% Comments','cp_front_end') );?></h2>
      <ul>
        
        <?php wp_list_comments(array('callback' => 'get_comment_list')); ?>

        <!--FIRST LEVEL COMMENTS START-->
       
      </ul>
      
      <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
<br>
<div class="comments-navigation">
  <div class="previous">
    <?php previous_comments_link('Older Comments'); ?>
  </div>
  <div class="next">
    <?php next_comments_link('Newer Comments'); ?>
  </div>
</div>
<?php endif; ?>

    </div>
  </div>
</article>

<!-- Comment Navigation -->

<?php endif; ?>
<!-- Comment Form -->

<article>
  <div class="widget-bg">
    <div class="form">
      <?php 

	$comment_form = array( 
		'fields' => apply_filters( 'comment_form_default_fields', array(
			'author' => '<li class="span4">' .
						'<input class="input-block-level" id="author" name="author" value="Name *" type="text" value="' .
						esc_attr( $commenter['comment_author'] ) . '" size="30" tabindex="1" />' .						
						'</li><!-- #form-section-author .form-section -->',
			'email'  => '<li class="span4">' .
						'<input class="input-block-level" id="email" value="Email *" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" tabindex="2" />' .						
						'</li><!-- #form-section-email .form-section -->',
			'url'    => '<li class="span4">' .
						'<input class="input-block-level" value="Website" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" tabindex="3" />' .						
						'</li><!-- #form-section-url .form-section -->' ) ),
			
		'comment_notes_before' => '<ul class="row-fluid">',
		'comment_notes_after' => '</ul>',
		'comment_field' => '' .
						'<textarea id="comment" name="comment" aria-required="true" rows="7">'.__('Comment','crunchpress').'</textarea>' .
						'<!-- #form-section-comment .form-section -->',
		'title_reply' => __('<div class="heading"><h3>'.__('Leave a Reply','crunchpress').'</h3></div>','cp_front_end'),
	);
	comment_form($comment_form, $post->ID); 

?>
    </div>
  </div>
</article>
