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
$class = array();
$class[]= "clearfix";
?>
<article  id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
    <div class="entry-wrapper clearfix">
        <div class="entry-content clearfix">
            <?php the_content(); ?>
        </div>
        <div class="entry-meta">
            <?php zorka_post_meta(); ?>
        </div>
        <?php if (is_single()): ?>
            <?php wp_link_pages( array(
                'before'      => '<div class="zorka-page-links"><span class="zorka-page-links-title">' . esc_html__('Pages:', 'zorka' ) . '</span>',
                'after'       => '</div>',
                'link_before' => '<span class="zorka-page-link">',
                'link_after'  => '</span>',
            ) ); ?>
            <?php the_tags('<div class="entry-meta"><span class="entry-meta-tag"><i class="pe-7s-ticket"></i>', ', ', '</span></div>' ); ?>
            <?php zorka_post_nav(); ?>
        <?php endif; ?>
    </div>
</article>