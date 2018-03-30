<?php if(! defined('ABSPATH')){ return; }
/**
 * Single header
 */

$media = $current_post['media'];

if(!empty($media) && $sb_use_full_image == 'yes'){
    echo '<div class="kl-blog-single-head-wrapper">';
}

if($sb_use_full_image == 'yes'){
    if( !post_password_required() ){
        echo $media;
    }
}
?>
<div class="kl-blog-post-header">
    <div class="kl-blog-post-details clearfix">

        <div class="pull-right hg-postlove-container">
            <!-- Display the postlove plugin here -->
            <?php do_action( 'znkl_love_post_area' ); ?>
        </div>

        <?php
        if( zget_option( 'zn_show_author_info', 'blog_options', false, 'yes' ) == 'yes' ){
            // Load details author
            include(locate_template( 'components/blog/default-single-modern/single-details-author.php' ));
        }
        ?>

        <div class="kl-blog-post-meta">
            <?php
                // Load details date
                include(locate_template( 'components/blog/default-single-modern/single-details-date.php' ));

                // Load details date
                include(locate_template( 'components/blog/default-single-modern/single-details-category.php' ));
            ?>
        </div>
    </div>
</div>
<!-- end itemheader -->

<?php
if(!empty($media) && $sb_use_full_image == 'yes'){
    echo '</div>';
}
?>
