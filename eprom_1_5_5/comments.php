<?php
/* Do not delete these line */
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) die (__('Please do not load this page directly. Thanks!', SHORT_NAME)); 
?>

<?php global $r_option;  ?>

<?php

/* Comment display function
 ------------------------------------------------------------------------*/
   
function theme_comments($comment, $args, $depth) {
    global $r_option;
    $GLOBALS['comment'] = $comment; 
    $date_format = 'd/m/y';
    if (isset($r_option['custom_comment_date'])) $date_format = $r_option['custom_comment_date'];
    ?>

    <!-- Comment -->
    <li id="li-comment-<?php comment_ID() ?>" <?php comment_class('theme_comment'); ?>>
        <article id="comment-<?php comment_ID(); ?>">
            <div class="avatar-wrap">
                <?php echo get_avatar($comment, '50'); ?>
            </div>
            <div class="comment-meta">
                <h5 class="author"><?php comment_author_link(); ?></h5>
                <p class="date"><?php comment_date($date_format); ?> <span class="reply"><?php comment_reply_link(array_merge( $args, array('reply_text' => __('Reply', SHORT_NAME), 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?></span></p>
            </div>
            <div class="comment-body">
                <?php comment_text(); ?>
                <?php if($comment->comment_approved == '0') : ?>
                <p class="message info"><?php _e('Your comment is awaiting moderation.', SHORT_NAME); ?></p>
                <?php endif; ?> 
            </div>
        </article>

<?php } // End comment function ?>

<!-- comments -->
<div class="entry comments">
<h3 class="entry-heading"><?php _e('Comments.', SHORT_NAME); ?></h3>

<?php 

/* If post password required
 ------------------------------------------------------------------------*/ 

if (post_password_required()) : ?>
	<p><?php _e('This post is password protected. Enter the password to view any comments.', SHORT_NAME); ?></p>
    </div>
<?php return; endif; ?>
    
<?php 

/* If the post has a comments
 ------------------------------------------------------------------------*/ 

if (have_comments()) : ?>
    <ol class="commentlist">
    <?php wp_list_comments('callback=theme_comments'); ?>
    </ol>
	<?php else : ?>
    <?php if (!comments_open()) : ?>
    <p><?php _e('Comments are closed.', SHORT_NAME); ?></p>
    <?php else : ?>
	<p><?php _e('Currently there are no comments related to this article. You have a special honor to be the first commenter. Thanks!', SHORT_NAME); ?></p>
    <?php endif; // end !comments_open() ?>
    <?php endif; // end have_comments() ?>
    
<?php 

/* Comment form
 ------------------------------------------------------------------------*/ 

?>  
    <!-- comment form -->   
    <?php if (!comments_open() && get_comments_number()) : ?>
    <p class="nocomments"><?php _e('Comments are closed.', SHORT_NAME); ?></p>
    <?php return; endif; ?>
    <?php
        $fields = array();
        function custom_fields($fields) {
            global $comment_author, $comment_author_email, $comment_author_url;

            $fields['author'] = '<p class="input">
                    <label for="author">' . __('<strong>Name</strong> (required)', SHORT_NAME ) . '</label>
                    <input type="text" name="author" id="author" value="' . $comment_author . '" size="22" tabindex="1" required />
                    </p>';
            $fields['email'] = '<p class="input">
                    <label for="email">' . __('<strong>Email</strong> (required)', SHORT_NAME ) . '</label>
                    <input type="text" name="email" id="email" value="' . $comment_author_email . '" size="22" tabindex="2" required />
                    </p>';
            $fields['url'] = '<p class="input input-web">
                    <label for="url">' . __('<strong>Website URL</strong>', SHORT_NAME ) . '</label>
                    <input type="text" name="url" id="url" value="' . $comment_author_url . '" size="22" tabindex="3" />
                    </p>';
            return $fields;
        }

        add_filter('comment_form_default_fields', 'custom_fields');

        $form_fields = array(
            'fields' => apply_filters('comment_form_default_fields', $fields),
            'title_reply' => __('Leave a Reply.', SHORT_NAME),
            'title_reply_to' => __('Leave a Reply.', SHORT_NAME),
            'cancel_reply_link' => __('(Click here to cancel reply)', SHORT_NAME),
            'comment_notes_before' => '',
            'label_submit' => __('Post Comment', SHORT_NAME),
            'comment_notes_after' => '<p class="form-allowed-tags">' . __('* Your email address will not be published.', SHORT_NAME) . '<br/>' . sprintf( __('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', SHORT_NAME), ' <span>' . allowed_tags() . '</span>' ) . '</p>',
            'comment_field' => '<p class="textarea">
                    <label for="comment">' . __('<strong>Your Comment</strong> (required)', SHORT_NAME) . '</label>
                    <textarea tabindex="4" rows="9" id="comment" name="comment" class="textarea" required></textarea>
                    </p>'
        );
    ?>
	<?php comment_form($form_fields); ?>
</div>
<!-- /comments -->