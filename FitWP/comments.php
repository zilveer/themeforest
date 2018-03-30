<?php

/**

 * @package WordPress

 * @subpackage Default_Theme

 */



// Do not delete these lines

	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))

		die ('Please do not load this page directly. Thanks!');



	if (post_password_required()) {
    ?>

    <p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'localization'); ?></p>

    <?php
    return;
}



global $id;

$id = $post->ID;
?>



<!-- You can start editing here. -->

<div id="comments">



<h4><?php comments_number(__('No Comments', 'localization'), __('One Comment', 'localization'), __('% Comments', 'localization') );?> <?php _e('to', 'localization'); ?> "<?php the_title(); ?>"</h4>




    <ul id="comments" class="commentlist unstyled">

        <?php wp_list_comments('avatar_size=80&style=ol&callback=rm_comments'); ?>

    </ul>

<?php comment_form(); ?>

</div>