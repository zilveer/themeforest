<?php

/***********************************************************************************************/
/* Prevent the direct loading of comments.php */
/***********************************************************************************************/
if (!empty($_SERVER['SCRIPT-FILENAME']) && basename($_SERVER['SCRIPT-FILENAME']) == 'comments.php') {
    die(__('You cannot access this page directly.', 'zen7'));
}

/***********************************************************************************************/
/* If the post is password protected then display text and return */
/***********************************************************************************************/
if (post_password_required()) : ?>
    <p>
        <?php
        _e( 'This post is password protected. Enter the password to view the comments.', LANGUAGE_ZONE);
        return;
        ?>
    </p>

<?php endif;

/***********************************************************************************************/
/* If we have comments to display, we display them */
/***********************************************************************************************/
if (have_comments()) : ?>

    <h1 class="title-comments">
        <?php comments_number(__('No thoughts about the post', LANGUAGE_ZONE), __('One thought about the post', LANGUAGE_ZONE), __('% thoughts about the post', LANGUAGE_ZONE)); ?>
    </h1>
    <hr>

    <ul class="comments">
        <?php wp_list_comments('callback=zen_comments'); ?>
    </ul>

    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>

        <div class="comment-nav-section clearfix">

            <p class="fl"><?php previous_comments_link(__( '&larr; Older Comments', LANGUAGE_ZONE)); ?></p>
            <p class="fr"><?php next_comments_link(__( 'Newer Comments &rarr;', LANGUAGE_ZONE)); ?></p>

        </div> <!-- end comment-nav-section -->

    <?php endif; ?>

    <hr />

<?php
/***********************************************************************************************/
/* If we don't have comments and the comments are closed, display a text */
/***********************************************************************************************/

elseif (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>

<?php endif;

/***********************************************************************************************/
/* Display the comment form */
/***********************************************************************************************/
?>

    <!-- ============== COMMENT RESPOND ============= -->
    <div class="comment-respond">

        <?php
        comment_form();
        ?>

    </div>

<?php

?>