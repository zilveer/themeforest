<?php get_header(); ?>
<?php /* Get author data */
    if(get_query_var('author_name')) :
    $curauth = get_userdatabylogin(get_query_var('author_name'));
    else :
    $curauth = get_userdata(get_query_var('author'));
    endif;
?>

<!--BEGIN #primary .hfeed-->
<div id="primary" class="hfeed" role="main">

    <?php
    $archive = '';
    if(have_posts()):

        if( is_category() ){ $archive = 'cat='. get_query_var('cat'); }
        elseif( is_tag() ){ $archive = 'tag_id='. get_query_var('tag_id'); }
        elseif( is_day() ){ $archive = 'year='. get_the_time('Y') .'&monthnum='. get_the_time('n') .'&day='. get_the_time('j'); }
        elseif( is_month() ){ $archive = 'year='. get_the_time('Y') .'&monthnum='. get_the_time('n'); }
        elseif( is_year() ){ $archive = 'year='. get_the_time('Y'); }
        elseif( is_author() ){ $archive = 'author='. get_query_var('author'); }
        elseif( $format = get_post_format() ){ $archive = 'post-format-'. $format; }

    ?>

    <div class="archive-title">
        <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
        <?php /* If this is a category archive */ if (is_category()) { ?>
            <h1 class="page-title"><?php printf(__('All posts in %s', 'stag'), single_cat_title('',false)); ?></h1>
        <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
            <h1 class="page-title"><?php printf(__('All posts tagged %s', 'stag'), single_tag_title('',false)); ?></h1>
        <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
            <h1 class="page-title"><?php _e('Archive for', 'stag') ?> <span><?php the_time('F jS, Y'); ?></span></h1>
         <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
            <h1 class="page-title"><?php _e('Archive for', 'stag') ?> <span><?php the_time('F, Y'); ?></span></h1>
        <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
            <h1 class="page-title"><?php _e('Archive for', 'stag') ?> <span><?php the_time('Y'); ?></span></h1>
        <?php /* If this is an author archive */ } elseif (is_author()) { ?>
            <h1 class="page-title"><?php _e('All posts by', 'stag') ?> <span><?php echo $curauth->display_name; ?></span></h1>
        <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
            <h1 class="page-title"><?php _e('Blog Archives', 'stag') ?></h1>
        <?php } ?>
    </div>

    <?php while (have_posts()) : the_post(); ?>

    <?php stag_post_before(); ?>

    <!--BEGIN .hentry-->
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php stag_post_start(); ?>

    <?php
        $format = get_post_format();
        get_template_part('content', $format);
    ?>

    <?php stag_post_end(); ?>
    <!--END .hentry-->
    </article>

    <?php stag_post_after(); ?>

    <?php endwhile; ?>

    <?php echo stag_paging_nav(); ?>

    <?php else: ?>

    <!--BEGIN #post-0-->
    <div id="post-0" <?php post_class(); ?>>

        <h2 class="entry-title"><?php _e('Error 404 - Not Found', 'stag') ?></h2>

        <!--BEGIN .entry-content-->
        <div class="entry-content">
            <p><?php _e("Sorry, but you are looking for something that isn't here.", "stag") ?></p>
        <!--END .entry-content-->
        </div>

    <!--END #post-0-->
    </div>

    <?php endif; ?>

<!--END #primary .hfeed-->
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>