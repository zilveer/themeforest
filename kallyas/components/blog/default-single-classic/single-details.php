<?php if(! defined('ABSPATH')){ return; }
/**
 * Single header
 */
?>
<div class="itemHeader kl-blog-post-header">
    <div class="post_details kl-blog-post-details kl-font-alt">
        <?php
            // Load details author
            include(locate_template( 'components/blog/default-single-classic/single-details-author.php' ));
        ?>
        <span class="infSep kl-blog-post-details-sep "> / </span>
        <?php
            // Load details date
            include(locate_template( 'components/blog/default-single-classic/single-details-date.php' ));
        ?>
        <span class="infSep kl-blog-post-details-sep"> / </span>
        <?php
            // Load details date
            include(locate_template( 'components/blog/default-single-classic/single-details-category.php' ));
        ?>
    </div>
</div>
<!-- end itemheader -->
