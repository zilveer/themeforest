<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 */

get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php 
    $fullwidth = get_post_meta($post->ID, 'bk_page_fullwidth_checkbox', true);
?>
    <div class="content <?php if ($fullwidth) {echo 'full-width';} else echo 'has-sidebar'; ?>">
        <div class="article-thumb">
            <?php echo get_the_post_thumbnail($post->ID, 'full'); ?>
        </div> <!-- article-thumb -->
        <article class="post-article">
        <?php
        
        if (get_the_title()): ?>
        	<h1 class="post-title post-title-single" <?php if (!has_post_thumbnail()) echo 'style="margin-top:0;"'; ?> ><?php the_title(); ?></h1>
        <?php else: ?>
        	<h1 class="post-title post-title-single" <?php if (!has_post_thumbnail()) echo 'style="margin-top:0;"'; ?> ><?php _e('Untitled','bkninja'); ?></h1>
        <?php endif; ?>
        
        <div class="article-content">
        <?php the_content(); ?>
        </div>

    </article>

<?php endwhile; endif; ?>

    </div> <!-- main-content -->
    
    <?php if (!$fullwidth) get_sidebar(); ?>
        

<?php get_footer();?>