<?php
/**
 * Shows a simple single post
 *
 * @package Smartbox
 * @subpackage Frontend
 * @since 1.0
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.5.8
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('row-fluid'); ?>>
    <?php get_template_part( 'partials/post-gutter' ); ?>
    <div class="<?php echo  oxy_get_option( 'blog_image_size' ) == 'normal'? 'span10':'span12'; ?> post-body">
        <div class="post-head">
            <h2 class="small-screen-center">
                <?php if ( is_single() ) : ?>
                    <?php the_title(); ?>
                <?php else : ?>
                    <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', THEME_FRONT_TD ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
                        <?php the_title(); ?>
                    </a>
                <?php endif; // is_single() ?>
            </h2>
            <?php get_template_part( 'partials/post-extras' ); ?>
        </div>
        <div class="entry-content">
            <?php
            if ( has_post_thumbnail() ) {
                $img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
                $img_link = is_single() ? $img[0] : get_permalink();
                $link_class = is_single() ? 'class="fancybox"' : '';
                echo '<figure>';
                if( oxy_get_option('blog_fancybox') == 'on') {
                    echo '<a href="' . $img_link . '" ' . $link_class . '>';
                }
                echo '<img alt="featured image" src="'.$img[0].'">';
                if( oxy_get_option('blog_fancybox') == 'on') {
                    echo '</a>';
                }
                echo '</figure>';
            } ?>
            <?php the_content(); ?>
            <?php get_template_part( 'partials/social-links', null ); ?>
            <?php oxy_wp_link_pages(array('before' => '<div class="pagination pagination-centered">', 'after' => '</div>')); ?>
        </div>
    </div>
</article>

