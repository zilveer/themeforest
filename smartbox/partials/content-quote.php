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
$author_id = get_the_author_meta('ID');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('row-fluid'); ?>>
    <?php get_template_part( 'partials/post-gutter' ); ?>
    <div class="<?php echo  oxy_get_option( 'blog_image_size' ) == 'normal'? 'span10':'span12'; ?> post-body">
        <div class="post-head">
            <?php get_template_part( 'partials/post-extras' ); ?>
        </div>
        <div class="entry-content">
                <?php if ( has_post_thumbnail() ){
                    $img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
                    echo '<figure>'
                        .   '<img alt="featured image" src="'.$img[0].'">'
                        .'</figure>'; ?>
                <?php  } ?>
                <?php echo do_shortcode('[blockquote who="'.get_the_title().'" cite=""]'.get_the_content().'[/blockquote]'); ?>
                <?php get_template_part( 'partials/social-links', null ); ?>
        </div>

    </div>
</article>

