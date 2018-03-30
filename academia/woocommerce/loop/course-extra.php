<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 12/18/15
 * Time: 11:32 AM
 */
$comments_count = wp_count_comments();
?>
<span class="comment-count">
    <i class="fa fa-comments-o s-color pd-right-5"></i>
    <?php echo esc_html($comments_count->approved) ?>
</span>