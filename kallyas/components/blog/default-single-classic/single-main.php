<?php if(! defined('ABSPATH')){ return; }
echo $current_post['title'];
?>
<div class="kl-blog-post" <?php echo WpkPageHelper::zn_schema_markup('blogpost'); ?>>

    <?php

    // Load single header details
    include(locate_template( 'components/blog/default-single-classic/single-details.php' ));

    // Load single content
    include(locate_template( 'components/blog/default-single-classic/single-content.php' ));

    // Load single page links
    include(locate_template( 'components/blog/default-single-common/single-pagelinks.php' ));

    // Load single social
    include(locate_template( 'components/blog/default-single-common/single-social.php' ));

    // Load single tags
    include(locate_template( 'components/blog/default-single-common/single-tags.php' ));

    // Load single author
    include(locate_template( 'components/blog/default-single-classic/single-author.php' ));

    // Load single related
    include(locate_template( 'components/blog/default-single-common/single-related.php' ));

    ?>

</div><!-- /.kl-blog-post -->
