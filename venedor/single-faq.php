<?php get_header() ?>

<?php
global $venedor_settings;
?>

<div id="content" role="main">
    <?php wp_reset_postdata(); ?>
    <?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
    <?php //query_posts($query_string.'&paged='.$paged); ?>

    <?php if (have_posts()) : the_post(); ?>
    <div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
        <?php global $previousday; unset($previousday); ?>
        <?php // Post Title ?>
        <h1 class="entry-title"><?php the_title(); ?></h1>
        
        <div class="faq-content single-faq">
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
            <div class="entry-meta">
                <div class="meta-item meta-date"><div class="meta-inner"><span class="meta-title"><?php _e('Date:', 'venedor') ?></span> <?php the_date() ?> <?php the_time(); ?></div></div>
                <div class="meta-item meta-cat"><div class="meta-inner"><span class="meta-title"><?php _e('Categories:', 'venedor') ?></span> <?php echo get_the_term_list($post->ID, 'faq_cat', '', ', ', ''); ?></div></div>
            </div>
        </div>
                        
    </div>
    <?php endif; ?>
</div>

<?php get_footer() ?>