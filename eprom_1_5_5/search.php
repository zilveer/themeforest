<?php global $r_option; ?>

<?php get_header(); ?>

<?php 
// Include page header
include_once(THEME . '/includes/page_header.php');

$sw = $_GET['s'];
htmlentities($sw, ENT_QUOTES, get_bloginfo('charset'));
?>

<section id="main-content" class="container clearfix">
    <!-- main -->
    <section id="main" class="clearfix">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" class="entry">
                <h2 class="entry-heading"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                <ul class="entry-meta none">
                   <li class="entry-date"><?php the_time($r_option['custom_date']); ?></li>
                   <li class="entry-comments"><?php _e('Comments', SHORT_NAME); ?> <?php comments_number('0','1','%'); ?></li>
                   <li class="entry-more"><a href="<?php the_permalink(); ?>"><?php _e('Read more', SHORT_NAME); ?></a></li>
                </ul>
            </article>
        <?php endwhile; ?>
        <?php else : ?>
        <h2><?php _e('No search results for:', SHORT_NAME); ?> <span class="color"><?php echo $sw ?></color></h2>
        <?php endif; ?>
        <?php if (function_exists('wp_pagenavi')) {wp_pagenavi();} ?>
    </section>
    <!-- /main -->
    <!-- sidebar -->
    <aside class="sidebar">
    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('default-sidebar')) : ?>
    <?php endif; ?> 
    </aside>
   
</section>

<?php get_footer(); ?>