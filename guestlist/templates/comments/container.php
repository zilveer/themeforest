<h2 id="comments"><?php _e('Comments', $bSettings->getPrefix()) ?></h2>
			


  <ul class="comments">
  <?php
    wp_list_comments(array(
      'style' => 'ul',
      'callback' => array('simpleUtils', 'displayComments'),
      'max_depth' => 4,
      'per_page' => 9999
    ));
  ?>
  </ul>
  <br class="clear" />

  <div id="commentsErrorWrapper"></div>

  <div class="post-comment-form">
    <?php comment_form($bebel_comment_form); ?>

  </div>
  <br class="clear" />

