<?php get_header(); ?>

<!--BEGIN #primary .hfeed-->
<div id="primary" class="hfeed" role="main">

    <?php stag_post_before(); ?>
    <?php while ( have_posts() ) : the_post(); ?>

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
    <?php stag_post_after(); ?>

    <?php comments_template('', true); ?>

<!--END #primary .hfeed-->
</div>

<nav class="navigation paging-navigation lr-navigation" role="navigation">
    <?php
    $prev = get_adjacent_post(false,'',false);
    $next = get_adjacent_post(false,'',true);
    ?>
    <div class="nav-links">
        <?php if( is_object($prev) && $prev->ID != get_the_ID()): ?>
        <div class="nav-previous">
            <a href="<?php echo get_permalink($prev->ID); ?>"><i class="icon icon-arrow-left"></i></a>
        </div>
        <?php endif; ?>

        <?php if( is_object($next) && $next->ID != get_the_ID()): ?>
        <div class="nav-next">
            <a href="<?php echo get_permalink($next->ID); ?>"><i class="icon icon-arrow-right"></i></a>
        </div>
        <?php endif; ?>
    </div>
</nav>


<?php get_sidebar(); ?>
<?php get_footer(); ?>
