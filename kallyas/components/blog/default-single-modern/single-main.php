<?php if(! defined('ABSPATH')){ return; } ?>
<div class="kl-blog-post" <?php echo WpkPageHelper::zn_schema_markup('blogpost'); ?>>

    <?php

    // Load single header details
    include(locate_template( 'components/blog/default-single-modern/single-details.php' ));

    echo $current_post['title'];

    // Load single content
    include(locate_template( 'components/blog/default-single-modern/single-content.php' ));

    // Load single page links
    include(locate_template( 'components/blog/default-single-common/single-pagelinks.php' ));

    ?>

    <div class="row blog-sg-footer">
        <div class="col-sm-6">
            <?php
                // Load single social
                include(locate_template( 'components/blog/default-single-common/single-social.php' ));
            ?>
        </div>
        <div class="col-sm-6">
            <?php
                // Load single tags
                include(locate_template( 'components/blog/default-single-common/single-tags.php' ));
            ?>
        </div>
    </div>

    <?php

    // Load single related
    include(locate_template( 'components/blog/default-single-common/single-related.php' ));

    ?>

</div><!-- /.kl-blog-post -->
