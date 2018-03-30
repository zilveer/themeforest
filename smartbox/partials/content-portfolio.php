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
<figure class="round-box box-big <?php echo oxy_get_option('portfolio_img_style')=='squared'? 'no-rounded': ''; ?>">
    <a href="<?php the_permalink(); ?>" class="box-inner">
        <?php the_post_thumbnail( 'portfolio-thumb', array( 'class' => 'img-circle' ) ); ?>
        <i class="plus-icon"></i>
    </a>
    <figcaption>
        <h4>
            <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </h4>
        <p>
            <?php echo oxy_limit_excerpt( get_the_excerpt(), oxy_get_option( 'portfolio_excerpt_words' ) ); ?>
        </p>
    </figcaption>
</figure>