<?php
/**
 * Shows tags, categories and comment count for posts
 *
 * @package Smartbox
 * @subpackage Frontend
 * @since 1.3
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license **LICENSE**
 * @version 1.5.8
 */
$author_id = get_the_author_meta('ID'); ?>
<?php if( oxy_get_option( 'blog_image_size' ) == 'normal' ): ?>
<div class="span2 post-info">
    <div class="round-box box-small">
        <?php echo get_avatar( $author_id, 300 ); ?>
    </div>
    <h5 class="text-center">
        <?php the_author(); ?>
    </h5>
    <h5 class="text-center light">
        <?php the_time(get_option('date_format')); ?>
    </h5>
</div>
<?php endif; ?>