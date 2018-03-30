<?php
/**
 * The template for displaying posts metadata
 *
 * Used for both single and index/archive/blog/search.
 *
 * @package WordPress
 * @subpackage Mango
 * @since Mango 1.0
 */
global $blog_settings ,$post, $mango_settings;
 
?>
<div class="entry-meta">
    <?php  _e("Posted at",'mango') ?> <span class="entry-meta-date"><?php the_time('h:i A, j F Y') ?></span>
    <?php if(!$blog_settings['hide_blog_post_author']){
     _e("by",'mango') ?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="entry-author" title="<?php the_author(); ?>"><?php the_author(); ?></a>
    <?php } ?>
    <?php if(!$blog_settings['hide_blog_post_category'] && has_category()){ ?>
        <span class="separator">/</span>
        <span class="entry-cats"><?php _e("Category",'mango')?>: <?php the_category(", "); ?></span>
    <?php } ?>
    <?php if(!$blog_settings['hide_blog_post_tags'] && !is_single() && has_tag()){ ?>
        <span class="separator">/</span>
        <span class="entry-cats"><?php _e("Tags",'mango')?>: <?php the_tags("", ", "); ?></span>
    <?php } ?>
</div><!-- End .entry-meta -->