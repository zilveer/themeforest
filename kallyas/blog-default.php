<?php if(! defined('ABSPATH')){ return; }

global $hasSidebar, $zn_config, $current_post;

// Check if PB Element has style selected, if not use Blog style option. If no blog style option, use Global site skin.
$blog_style_global = zget_option( 'blog_style', 'blog_options', false, '' ) != '' ? zget_option( 'blog_style', 'blog_options', false, '' ) : zget_option( 'zn_main_style', 'color_options', false, 'light' );
$blog_style = isset($zn_config['blog_style']) && $zn_config['blog_style'] != '' ? $zn_config['blog_style'] : $blog_style_global;

$blog_layout = isset($zn_config['blog_layout']) && $zn_config['blog_layout'] != '' ? $zn_config['blog_layout'] : zget_option( 'blog_layout', 'blog_options', false, 'def_classic' );
$sb_archive_content_type = zget_option( 'sb_archive_content_type', 'blog_options', false, 'full' );

$classes = array();
$classes[] = 'itemListView eBlog kl-blog kl-blog-list-wrapper kl-blog--default clearfix';
$classes[] = 'kl-blog--style-'.$blog_style;
$classes[] = 'element-scheme--'.$blog_style;
$classes[] = 'kl-blog--layout-'.$blog_layout;
$classes[] = 'kl-blog-content-'.$sb_archive_content_type;

?>
<div class="<?php echo implode(' ', $classes); ?>" <?php echo WpkPageHelper::zn_schema_markup('blog'); ?>>

    <?php
        the_archive_description( '<div class="kl-blog-taxonomy-description">', '</div>' );
    ?>

    <div class="itemList kl-blog-list ">
        <?php
            if ( have_posts() ) :

                while ( have_posts() ) {
                    the_post();

                    /**
                     * Get generic blog layout/style
                     * @since v4.0.12
                     */
                    include(locate_template( 'components/blog/blog-default-' . $blog_layout . '.php'));
                }

            else:

                /**
                 * No posts message
                 * @since v4.0.12
                 */
                include(locate_template( 'components/blog/blog-noposts.php' ));

            endif;
            ?>
    </div>
    <!-- end .itemList -->

    <?php include(locate_template( 'components/blog/blog-pagination.php' )); ?>
</div>
<!-- end blog items list (.itemListView) -->
