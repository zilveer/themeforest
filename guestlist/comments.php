<?php 
/**
 * This template contains the nested comments.
 */
$bSettings = BebelSingleton::getInstance('BebelSettings');

// first the really ugly part:
  $bebel_comment_form =  array(
    'fields' => apply_filters('comment_form_default_fields', array(
     'author'       => '  <div class="inputframe">
                            <input type="text" class="requiredField" aria-required="true" value="'.esc_attr( $commenter['comment_author'] ).'" id="author" name="author" required  placeholder="'._x('Your Name:', $bSettings->getPrefix()).'">
                          </div>',
      'email'       => '  <div class="inputframe">
                            <input type="email" class="post-comment-form-input requiredField" aria-required="true" value="'.esc_attr( $commenter['comment_author_email'] ).'" id="email" name="email" required placeholder="'._x('Your Email:', $bSettings->getPrefix()).'">
                          </div>')),
    'comment_field' =>  ' <div class="inputframe_big">
                            <textarea id="comment" class="post-comment-form-textarea requiredField" name="comment" cols="45" rows="8" aria-required="true" required  placeholder="'._x('Your Message:', $bSettings->getPrefix()).'"></textarea>
                          </div>',
    'title_reply'   =>  '',
    'title_reply_to'   =>  '',
    'id_submit'     => 'submit',
    'label_submit'  => _x('Post Comment!', $bSettings->getPrefix())
  );


if(post_password_required()) {} // don't display anything
    
    
if(comments_open()){

  include('templates/comments/container.php');

}
