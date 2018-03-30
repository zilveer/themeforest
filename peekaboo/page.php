<?php get_header(); ?>
    <!--Main begin-->
<div id="main" class="round_8 clearfix row" role="main">

    <!-- Breadcrumb begin -->
    <div class="large-12 columns">
        <?php if (function_exists('pkb_breadcrumbs')) pkb_breadcrumbs(); ?>
    </div>
    <!-- Breadcrumb end -->

    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

    <!-- Page title begin -->
    <div class="large-12 columns">
        <div class="page_title round_6">
            <h1 class="replace">
                <?php if (is_front_page()) { ?>
                    <?php the_title(); ?>
                <?php } else { ?>
                    <?php the_title(); ?>
                <?php } ?>
            </h1>
        </div>
    </div>
    <!-- Page title end -->

    <!-- Content begin-->
    <div id="content" class="large-8 columns">
        <?php if ((has_post_thumbnail() && function_exists('has_post_thumbnail'))) { ?>
            <div class="landing_image"><a
                    href="<?php the_permalink() ?>"><?php the_post_thumbnail('landing-image', array('class' => 'shadow')); ?> </a>
            </div>
        <?php } ?>

        <?php the_content(); ?>
        <?php wp_link_pages(array('before' => '' . __('Pages:', 'peekaboo'), 'after' => '')); ?>
        <div class="clear">&nbsp;</div>

        <?php endwhile; ?>
    </div>
    <!-- Content end-->

    <!-- Sidebar begin-->
    <div id="sidebar" class="large-4 columns">
        <?php get_sidebar(); ?>
    </div>
    <!-- Sidebar end-->
<?php get_footer(); ?>