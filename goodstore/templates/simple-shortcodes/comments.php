<?php global $jaw_data; ?>

<?php
$comments = jaw_template_get_var('comments', null);
?>
<div class="row">
    <div class="col-lg-<?php echo jaw_template_get_var('box_size'); ?>">
        <div   class="comments-block">
            <?php foreach ($comments as $comment) { ?>

                    <div   class="one-comment">
                        <div class="comment-author">
                            <?php echo($comment->comment_author); ?>
                        </div>
                        <div class="comment-date">
                            <?php comment_date('Y'); ?>
                        </div>
                        <div class="clear"></div>
                        <div class="comment-content">
                            <?php echo($comment->comment_content); ?>
                        </div>
                        <div class="comment-dot"></div>
                        <div class="comment-dot-border"></div>
                        <div class="comment-arrow"></div>
                    </div>
             
            <?php } ?>
        </div>
    </div>
</div>