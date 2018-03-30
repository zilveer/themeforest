<?php global $r_option; ?>

<?php get_header(); ?>

<?php 
// Include page header
if (isset($post)) include_once(THEME . '/includes/page_header.php');
?>

<section id="main-content" class="container clearfix">
    <!-- main -->
    <section id="main" class="clearfix">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" class="entry">
                <h2 class="entry-heading"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                <?php 
                   // Get short description
                   $desc = get_post_meta($wp_query->post->ID, '_short_desc', true);

                   // Display content
                   if (isset($desc) && $desc != '') {
                      echo do_content($desc);
                   } else if (has_excerpt()) {
                      the_excerpt();
                   } else {
                      the_content();
                   }
                ?>
                <ul class="entry-meta none">
                   <li class="entry-date"><?php the_time($r_option['custom_date']); ?></li>
                   <li class="entry-comments"><?php _e('Comments', SHORT_NAME); ?> <?php comments_number('0','1','%'); ?></li>
                   <li class="entry-more"><a href="<?php the_permalink(); ?>"><?php _e('Read more', SHORT_NAME); ?></a></li>
                </ul>
            </article>
        <?php endwhile; ?>
        <?php endif; ?>
        <?php if (function_exists('wp_pagenavi')) {wp_pagenavi();} ?>
    </section>
    <!-- /main -->
    <!-- sidebar -->
    <aside class="sidebar">
    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('category-sidebar)) : ?>
    <?php endif; ?> 
    </aside>
   
</section>

<?php get_footer(); ?>