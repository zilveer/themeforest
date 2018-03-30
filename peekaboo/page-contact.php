<?php
/*
Template Name: Contact Page
*/
global $post;
$gmap_url = get_post_meta($post->ID, 'pkb_map_code', true);
$contact_info_title = get_post_meta($post->ID, 'pkb_contact_info_title', true);
$contact_info = get_post_meta($post->ID, 'pkb_contact_info', true);
$cf7_info = get_post_meta($post->ID, 'pkb_cf7_info', true);
$cf7_id = get_post_meta($post->ID, 'pkb_cf7_id', true);
?>

<?php get_header(); ?>
    <!--Main begin-->
<div id="main" class="round_8 clearfix row">
    <!-- Breadcrumb begin -->
    <div class="pad-left-10">
        <?php if (function_exists('pkb_breadcrumbs')) pkb_breadcrumbs(); ?>
    </div>
    <!-- Breadcrumb end -->

    <!-- Page title begin -->
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
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
    <div id="content" class="large-12 columns">
        <?php wp_link_pages(array('before' => '' . __('Pages:', 'peekaboo'), 'after' => '')); ?>
        <?php endwhile; ?>
        <?php the_content(); ?>

        <?php if ($gmap_url || $contact_info) { ?>
            <div class="row">
                <div class="columns large-9">
                    <?php if ($gmap_url) echo do_shortcode("[iframe src=\"$gmap_url\"]"); ?>
                </div>
                <div class="columns large-3">
                    <?php if ($contact_info_title) echo '<h5 class="replace">' . $contact_info_title . '</h5>'; ?>
                    <?php if ($contact_info) echo '<div class="text-smaller">' . $contact_info . '</div>'; ?>
                </div>

            </div>
        <?php } ?>

        <?php if ($cf7_id && $cf7_info) { ?>
            <hr>
            <div class="row">
                <div class="columns large-3">
                    <?php echo $cf7_info; ?>
                </div>
                <div class="columns large-9">
                    <?php echo do_shortcode('[contact-form-7 id="' . $cf7_id . '" title=""]'); ?>
                </div>
            </div>
        <?php } elseif ($cf7_id) { ?>
            <hr>
            <div class="row">
                <div class="columns large-12">
                    <?php echo do_shortcode('[contact-form-7 id="' . $cf7_id . '" title="Drop us a line"]'); ?>
                </div>
            </div>

        <?php } ?>
    </div>
    <!-- Content end-->

<?php get_footer(); ?>