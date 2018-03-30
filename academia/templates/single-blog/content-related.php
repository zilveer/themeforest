<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 7/11/2015
 * Time: 2:39 PM
 */
$class = array();
$class[]= "clearfix";
$class[]= "text-center";
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
    <?php
    $thumbnail = g5plus_post_thumbnail('blog-related');
    if (!empty($thumbnail)) : ?>
        <div class="entry-thumbnail-wrap">
            <?php echo wp_kses_post($thumbnail); ?>
        </div>
    <?php else : ?>
        <div class="entry-thumbnail-wrap">
            <div class="no-image">
                <div class="no-image-inner">
                    <?php esc_html_e('No Image','g5plus-academia'); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <h3 class="entry-post-title p-font">
        <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
    </h3>
    <div class="entry-post-meta-wrap">
        <?php g5plus_post_meta_related(); ?>
    </div>
</article>
