<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/5/2015
 * Time: 2:29 PM
 */
$prefix = 'g5plus_';

$quote_content = rwmb_meta($prefix.'post_format_quote',array(),get_the_ID());
$quote_author = rwmb_meta($prefix.'post_format_quote_author',array(),get_the_ID());
$quote_author_url = rwmb_meta($prefix.'post_format_quote_author_url',array(),get_the_ID());

$class = array();
$class[]= "clearfix";
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
    <div class="entry-quote-wrap p-font">
        <a class="entry-quote-style" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">

        </a>
        <?php if (empty($quote_content) || empty($quote_author) || empty($quote_author_url)) : ?>
            <?php the_content(); ?>
        <?php else : ?>
            <blockquote>
                <p><?php echo esc_html($quote_content); ?></p>
                <cite><a href="<?php echo esc_url($quote_author_url) ?>" title="<?php echo esc_attr($quote_author); ?>"><?php echo esc_html($quote_author); ?></a></cite>
            </blockquote>
        <?php endif; ?>
    </div>
</article>
