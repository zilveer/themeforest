<?php if(! defined('ABSPATH')){ return; }

global $hasSidebar, $zn_config, $current_post;

$sb_archive_use_full_image = zget_option( 'sb_archive_use_full_image', 'blog_options', false, 'no' );

$featPostClass = is_sticky( get_the_id() ) ? 'featured-post kl-blog--featured-post' : '';
$post_format    = get_post_format() ? get_post_format() : 'standard';
$current_post   = zn_setup_post_data( $post_format );

// Hide Body & bottomn links side of the articles, for Links, Quote (post type articles)
$hide_body = ($post_format == 'link' || $post_format == 'quote');

if(! isset($current_post['title']) || empty( $current_post['title'] ) ) {
    if(! is_array($current_post)){
        $current_post = array();
    }
    $current_post['title'] = get_the_title();
}

if(!empty($featPostClass)) { ?>
<div class=" kl-blog-item-container <?php echo $featPostClass;?> <?php echo implode ( ' ' , get_post_class('blog-post' ) ); ?>" <?php echo WpkPageHelper::zn_schema_markup('blogpost'); ?>>
    <?php
        if(empty($current_post['media'])){
            echo '<div class="zn_sticky_no_image kl-blog-sticky-noimg"></div>';
        }
        else { echo $current_post['media']; }
    ?>
    <div class="kl-blog-featured-content">
        <div class="kl-blog-featured-inner">
            <?php
            // Load item title
            include(locate_template( 'components/blog/default-modern/blog-title.php' ));
            // Load item header
            include(locate_template( 'components/blog/default-modern/blog-header.php' ));

            ?>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<?php } else { ?>

<?php echo $current_post['before']; ?>

<div class="kl-blog-item-container kl-blog--normal-post <?php echo implode ( ' ' , get_post_class('blog-post' ) ); ?> " <?php echo WpkPageHelper::zn_schema_markup('blogpost'); ?>>

    <?php

    echo $current_post['before_head'];

    /**
     * Layout for FULL image
     */
    if( $sb_archive_use_full_image == 'yes' ){

        $item_head_start = '';
        $item_head_end = '';

        if(!empty($current_post['media'])){
            $item_head_start = '<div class="kl-blog-item-head-wrapper">';
            $item_head_end = '</div>';
        }

        echo $item_head_start;
            echo $current_post['media'];
            // Load item header
            include(locate_template( 'components/blog/default-modern/blog-header.php' ));
        echo $item_head_end;
        // Load item title
        include(locate_template( 'components/blog/default-modern/blog-title.php' ));

    }
    /**
     * Layout for normal fixed width image
     */
    elseif( $sb_archive_use_full_image == 'no' ){
        // Load item title
        include(locate_template( 'components/blog/default-modern/blog-title.php' ));
        // Load item Header
        include(locate_template( 'components/blog/default-modern/blog-header.php' ));
        echo $current_post['media'];
    }

    echo $current_post['after_head'];

    if(!$hide_body): ?>

    <div class="kl-blog-item-body clearfix">

        <?php

        // Load item image
        include(locate_template( 'components/blog/default-modern/blog-img.php' ));

        // Load item footer
        include(locate_template( 'components/blog/default-modern/blog-footer.php' ));

        ?>

    </div>

    <?php endif; ?>

</div><!-- end Blog Item -->
<?php } ?>
<div class="clearfix"></div>
