<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Zorka
 * @since Zorka 1.0
 */
?>
<?php

global $zorka_archive_loop;
if (isset($zorka_archive_loop['image-size'])) {
    $size = $zorka_archive_loop['image-size'];
} else {
    $size = 'full';
}
if (is_single()) {
    $size = 'full';
}
$class = array();
$class[]= "clearfix";
?>
<article  id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
    <div class="entry-wrapper clearfix">
        <h3 class="entry-title">
            <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
        </h3>
        <div class="entry-meta">
            <?php zorka_post_meta(); ?>
        </div>
        <?php
            $thumbnail = zorka_post_thumbnail($size);
            if (!empty($thumbnail)) : ?>
                <div class="entry-image-wrapper">
                    <?php echo wp_kses_post($thumbnail); ?>
                </div>
        <?php endif; ?>

        <?php if (!is_single()) : ?>
            <div class="entry-excerpt">
                <?php the_excerpt(); ?>
            </div>
            <div class="entry-read-more">
                <a class="zorka-button button-md style1" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php esc_html_e("Read more","zorka"); ?>"><?php esc_html_e("Read more","zorka"); ?></a>
            </div>
        <?php else : ?>
            <div class="entry-content clearfix">
                <?php the_content(); ?>
            </div>
            <?php wp_link_pages( array(
                'before'      => '<div class="zorka-page-links"><span class="zorka-page-links-title">' . esc_html__('Pages:', 'zorka' ) . '</span>',
                'after'       => '</div>',
                'link_before' => '<span class="zorka-page-link">',
                'link_after'  => '</span>',
            ) ); ?>
            <?php the_tags('<div class="entry-meta"><span class="entry-meta-tag"><i class="pe-7s-ticket"></i>', ', ', '</span></div>' ); ?>
            <?php zorka_post_nav(); ?>

            <?php
            $author_description = get_the_author_meta('description');
            if (!empty($author_description)) : ?>
            <div class="entry-author">
                <div class="entry-author-image">
                    <?php echo get_avatar( get_the_author_meta('user_email'), '100', '' ); ?>
                    <?php the_author_posts_link(); ?>
                </div>
                <div class="entry-author-description">

                    <?php the_author_meta('description'); ?>
                </div>
            </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</article>