<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 */
global $g5plus_archive_loop;

$size = 'full';
if (isset($g5plus_archive_loop['image-size'])) {
    $size = $g5plus_archive_loop['image-size'];
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
        <h3 class="entry-title p-font">
            <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
        </h3>
        <div class="entry-post-meta-wrap">
            <?php g5plus_post_meta(); ?>
        </div>
        <div class="entry-excerpt">
            <?php the_excerpt(); ?>
        </div>
    </div>
</article>


