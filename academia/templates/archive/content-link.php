<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/5/2015
 * Time: 2:29 PM
 */
$prefix = 'g5plus_';
$url = rwmb_meta($prefix.'post_format_link_url',array(),get_the_ID());
$text = rwmb_meta($prefix.'post_format_link_text',array(),get_the_ID());

$class = array();
$class[]= "clearfix";
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
    <div class="entry-link-wrap">
        <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
            <i class="fa fa-link"></i>
        </a>
        <?php if (empty($url) || empty($text)) : ?>
            <?php the_content(); ?>
        <?php else : ?>
            <p>
                <a href="<?php echo esc_url($url); ?>" rel="bookmark">
                    <?php echo esc_html($text); ?>
                </a>
            </p>
        <?php endif; ?>
    </div>
</article>

