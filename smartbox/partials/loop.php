<?php
/**
 * Main Blog loop
 *
 * @package Smartbox
 * @subpackage Frontend
 * @since 1.4
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license **LICENSE**
 * @version 1.5.8
 */
?>

<?php if( oxy_get_option('blog_layout') == 'sidebar-left' ): ?>
<aside class="span3 sidebar">
    <?php get_sidebar(); ?>
</aside>
<?php endif; ?>

<div class="<?php echo oxy_get_option('blog_layout') == 'full-width' ? 'span12':'span9' ; ?>">
    <?php if( have_posts() ): ?>
    <?php while ( have_posts() ) : the_post(); ?>

    <?php get_template_part( 'partials/content', get_post_format() ); ?>

    <?php endwhile; ?>

    <?php oxy_pagination($wp_query->max_num_pages); ?>
    <?php else: ?>
        <article id="post-0" class="post no-results not-found">
            <header class="entry-header">
                <h1 class="entry-title"><?php _e( 'Nothing Found', THEME_FRONT_TD ); ?></h1>
            </header>

            <div class="entry-content">
            <?php   if( is_category() ) {
                        $message = __('Sorry, no posts were found for this category.',THEME_FRONT_TD);
                    }
                    else if( is_date()  ){
                        $message = __('Sorry, no posts found in that timeframe',THEME_FRONT_TD);
                    }
                    else if ( is_author() ){
                        $message = __('Sorry, no posts from that author were found',THEME_FRONT_TD);
                    }
                    else if ( is_tag() ){
                        $message = sprintf( __('Sorry, no posts were tagged with  "%1$s"',THEME_FRONT_TD),single_tag_title( '', false ) );
                    }
                    else{
                        $message = __('Sorry, nothing found',THEME_FRONT_TD);
                    }
            ?>
                <p><?php _e( $message, THEME_FRONT_TD ); ?></p>
                <?php get_search_form(); ?>
            </div>
        </article>
    <?php endif; ?>
</div>

<?php if( oxy_get_option('blog_layout') == 'sidebar-right' ): ?>
<aside class="span3 sidebar">
    <?php get_sidebar(); ?>
</aside>
<?php endif;