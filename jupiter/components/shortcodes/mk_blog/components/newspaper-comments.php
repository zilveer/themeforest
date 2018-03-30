<?php
global $mk_options;

if ($mk_options['blog_single_comments'] == 'true'):
    if (get_post_meta($post->ID, '_disable_comments', true) != 'false') {
        $c_args = array(
            'number' => '4',
            'status' => 'approve',
            'post_id' => $post->ID
        );
        $comments = get_comments($c_args);
        echo '<ul class="newspaper-comments-list">';
        foreach ($comments as $comment):
            echo '<li>';
            echo get_avatar($comment->comment_author_email, 35);
            if (!empty($comment->comment_author_url)) {
                echo '<span class="comment-author"><a href="' . $comment->comment_author_url . '">' . $comment->comment_author . '</a></span>';
            } 
            else {
                echo '<span class="comment-author">' . $comment->comment_author . '</span>';
            }
            $stripped_comment = strip_tags($comment->comment_content);
            echo '<span class="comment-content">' . substr($stripped_comment, 0, 45) . '...</span>';
            echo '<div class="clearboth"></div></li>';
        endforeach;
        echo '</ul>';
    }
endif;
