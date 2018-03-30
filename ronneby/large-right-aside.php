<?php
/*
Template Name: Page with Large right aside
*/
?>

<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$add_text = get_post_meta($post->ID, '_top_page_text', true);
echo do_shortcode($add_text);

?>

<section id="layout" class="no-title magazine">

    <div class="row">
        <div class="eight columns">
            <?php get_template_part('templates/content', 'page'); ?>
        </div>
        <div class="four columns" style="overflow-x: hidden">
            <?php

            $page_id = get_queried_object_id();

            $selected_sidebar = get_post_meta($page_id, 'crum_sidebars_sidebar_2', true);

            if ($selected_sidebar && (function_exists('smk_sidebar'))) {

                smk_sidebar($selected_sidebar);

            } elseif (is_active_sidebar('sidebar-right')) {

                dynamic_sidebar('sidebar-right');

            } else {

                the_widget( 'WP_Widget_Search', 'title=');

                the_widget( 'Crum_Cat_And_Archives', 'title=Follow us on twitter&cachetime=60&username=crumina&tweetstoshow=1');

                the_widget( 'crum_tags_widget', 'title=Tags&number=15');

            }?>
        </div>
    </div>
</section>