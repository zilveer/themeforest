<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/5/2015
 * Time: 2:29 PM
 */
$prefix = 'g5plus_';
$url = rwmb_meta($prefix.'post_format_link_url', array(), get_the_ID());
$text = rwmb_meta($prefix.'post_format_link_text', array(), get_the_ID());

$class = array();
$class[]= "clearfix";
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
    <i class="post-format-icon fa fa-link p-color-bg"></i>
    <div class="entry-content-wrap">
        <h3 class="entry-title p-font">
            <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
        </h3>
        <div class="entry-post-meta-wrap">
            <?php g5plus_post_meta(); ?>
        </div>
        <div class="entry-content-link s-font">
            <?php if (empty($url) || empty($text)) : ?>
                <?php the_content(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url($url); ?>" rel="bookmark">
                    <?php echo esc_html($text); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</article>

