<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 7/6/2015
 * Time: 5:19 PM
 */
global $g5plus_options;
$show_author_info = $g5plus_options['show_author_info'];
if ($show_author_info == 0) {
    return;
}
$author_description = get_the_author_meta('description');
if (empty($author_description)) return;
?>
<div class="author-info clearfix">
    <div class="author-avatar">
        <?php
        $author_avatar_size = apply_filters( 'g5plus_framework_author_avatar_size', 70 );
        echo get_avatar( get_the_author_meta( 'user_email' ), $author_avatar_size );
        ?>
        <h3 class="author-title"><?php the_author_posts_link(); ?></h3>
    </div>
    <div class="author-description">
            <p class="author-bio"><?php the_author_meta( 'description' ); ?></p>
    </div>
</div>