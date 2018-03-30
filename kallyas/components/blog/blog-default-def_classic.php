<?php if(! defined('ABSPATH')){ return; }

global $hasSidebar, $zn_config, $current_post;

$featPostClass = is_sticky( get_the_id() ) ? 'featured-post kl-blog--featured-post' : '';
$post_format    = get_post_format() ? get_post_format() : 'standard';
$current_post   = zn_setup_post_data( $post_format );

// Hide Body & bottomn links side of the articles, for Links, Quote (post type articles)
$hide_body = ($post_format == 'link' || $post_format == 'quote');

if(!empty($featPostClass)) { ?>
<div class="itemContainer kl-blog-item-container <?php echo $featPostClass;?> <?php echo implode ( ' ' , get_post_class('blog-post' ) ); ?>" <?php echo WpkPageHelper::zn_schema_markup('blogpost'); ?>>
    <?php
        if(empty($current_post['media'])){
            echo '<div class="zn_sticky_no_image kl-blog-sticky-noimg"></div>';
        }
        else { echo $current_post['media']; }
    ?>
    <div class="itemFeatContent kl-blog-featured-content">
        <div class="itemFeatContent-inner kl-blog-featured-inner">
            <?php
                // Load Item Header
                include(locate_template( 'components/blog/blog-meta.php' ));
                // Load Post links
                include(locate_template( 'components/blog/blog-links.php' ));
                // Load item comments
                include(locate_template( 'components/blog/blog-item-comments.php' ));

            ?>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<?php } else { ?>

<?php echo $current_post['before']; ?>

<div class="itemContainer kl-blog-item-container kl-blog--normal-post <?php echo implode ( ' ' , get_post_class('blog-post' ) ); ?>" <?php echo WpkPageHelper::zn_schema_markup('blogpost'); ?>>

    <?php echo $current_post['before_head']; ?>

    <?php
        // Load Item Header
        include(locate_template( 'components/blog/blog-meta.php' ));
    ?>

    <?php echo $current_post['after_head']; ?>

    <?php if(!$hide_body): ?>

    <div class="itemBody kl-blog-item-body">

        <?php
            // Load Item Content
            include(locate_template( 'components/blog/default-classic/blog-content.php' ));
            // Load Item Footer
            include(locate_template( 'components/blog/default-classic/blog-bottom.php' ));

        ?>

    </div>
    <!-- end Item BODY -->

    <?php
        // Load Item Links
        include(locate_template( 'components/blog/blog-links.php' ));
        // Load Item Comments
        include(locate_template( 'components/blog/blog-item-comments.php' ));
    ?>

    <!-- item links -->
    <div class="clear"></div>

    <?php endif; ?>

</div><!-- end Blog Item -->
<?php } ?>
<div class="clear"></div>
