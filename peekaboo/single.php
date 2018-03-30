<?php
/*
 * Single pages
 */
get_header(); ?>

    <!--Main begin-->
<div id="main" class="round_8 clearfix row" role="main">
<?php if (have_posts()) {
while (have_posts()) :
    the_post(); ?>
    <!-- Content begin-->
    <div id="content" class="large-8 columns">

    <!--Breadcrumbs begin-->
    <?php if (function_exists('pkb_breadcrumbs')) {
    pkb_breadcrumbs();
} ?>
    <!--Breadcrumbs end-->

    <h1 class="replace"><?php the_title(); ?></h1>

    <!--Post begin-->
    <div class="post">
        <?php if ($smof_data['pkb_single_img'] == '1') {
            if ((has_post_thumbnail() && function_exists('has_post_thumbnail'))) {
                ?>
                <div class="post_image"><a
                        href="<?php the_permalink() ?>"><?php the_post_thumbnail(
                            'single-image',
                            array('class' => 'shadow')
                        ); ?> </a>
                </div>
            <?php
            }
        } ?>
        <?php the_content(); ?>

        <?php posts_nav_link(); ?>

        <div
            class="pkb-nav"><?php wp_link_pages(
                array('before' => '' . __('Pages:', 'peekaboo'), 'after' => '')
            ); ?></div>
    </div>

    <?php if ((get_the_author_meta('description') != "") && ($smof_data['pkb_author_desc'] == "1")): ?>
    <div class="author-bio clearfix round_6">
        <div class="author-img ">
            <?php echo get_avatar(
                get_the_author_meta('user_email'),
                apply_filters('pkb_author_bio_avatar_size', 70)
            ); ?>
        </div>
        <div class="author-desc">
            <h4><?php echo get_the_author() ?></h4>

            <p><?php the_author_meta('description'); ?></p>
        </div>
    </div>
<?php endif; ?>
    <!--Post end-->

    <div class="clear">&nbsp;</div>
    <ul class="meta clearfix">
        <?php pkb_caldate_on(); ?>
        <?php pkb_posted_in(); ?>
    </ul>
    <hr/>

    <?php comments_template('', true); ?>

<?php endwhile;
} // end of the loop.
?>

    </div>
    <!-- Content end-->

    <!-- Sidebar begin-->
    <div id="sidebar" class="large-4 columns">
        <?php get_sidebar(); ?>
    </div>
    <!-- Sidebar end-->

<?php get_footer(); ?>