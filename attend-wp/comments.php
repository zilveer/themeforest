<?php
 
// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');
 
if ( post_password_required() ) { ?>
<p class="nocomments"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'cr3_attend_theme' ); ?></p>
<?php
return;
}
?>
 
<!-- You can start editing here. -->
<?php if ( have_comments() ) : ?>

<!-- Start of comment title -->
<div class="comment_title">
    <?php if (get_comments_number()==0) { ?>

    <?php } ?>

    <?php
    if (get_comments_number()==1) { ?>

    <h2 class="comments_number"><?php comments_number('0', '1', '%' );?> <?php _e( 'Comment', 'cr3_attend_theme' ); ?></h2>

    <?php } else { ?>

    <h2 class="comments_number"><?php comments_number('0', '1', '%' );?> <?php _e( 'Comments', 'cr3_attend_theme' ); ?></h2>

    <?php } ?>

</div>
<!-- End of comment title -->
 
<!-- Start of commentlist -->
<div class="commentlist">
    
    <?php wp_list_comments('type=comment&callback=cr3ativ_comment'); ?>

</div>
<!-- End of commentlist -->

<!-- Start of pagination -->
<div id="pagination">

    <!-- Start of pagination class -->
    <div class="pagination">
        
        <?php paginate_comments_links(); ?>

    </div>
    <!-- End of pagination class -->

</div>
<!-- End of pagination -->

<?php else : ?>
 
<?php if ('open' == $post->comment_status) : ?>
<!-- If comments are open, but there are no comments. -->
 
<?php else : // comments are closed ?>
<!-- If comments are closed. -->
 
<?php endif; ?>
 
<?php endif; // if you delete this the sky will fall on your head ?>