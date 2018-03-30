<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 */
global $g5plus_options,$g5plus_archive_loop;

if (isset($g5plus_archive_loop['image-size'])) {
    $size = $g5plus_archive_loop['image-size'];
} else {
    $size = 'full';
}

$class = array();
$class[]= "clearfix";

?>
<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
    <?php
    $thumbnail = g5plus_post_thumbnail($size);
    if (!empty($thumbnail)) : ?>
        <div class="entry-thumbnail-wrap">
            <?php echo wp_kses_post($thumbnail); ?>
        </div>
    <?php endif; ?>
    <div class="entry-content-wrap">
        <h3 class="entry-title">
            <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
        </h3>
        <div class="entry-post-meta-wrap">
            <?php g5plus_post_meta(); ?>
        </div>
        <div class="entry-content clearfix">
            <?php the_content(); ?>
        </div>

        <?php
        /**
         * @hooked - g5plus_link_pages - 5
         * @hooked - g5plus_post_tags - 10
         * @hooked - g5plus_share - 15
         *
         **/
        do_action('g5plus_after_single_post_content');
        ?>

    </div>
    <?php
    /**
     * @hooked - g5plus_post_nav - 20
     * @hooked - g5plus_post_author_info - 25
     *
     **/
    do_action('g5plus_after_single_post');
    ?>
</article>
