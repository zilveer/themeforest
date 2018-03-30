<?php
global $wp_query, $jaw_data, $post;

$backup_query = $wp_query;
$wp_query = null;
$wp_query = jaw_template_get_data();

if (!have_posts()) {
    ?>
    <div class="notice">
        <p class="bottom"><?php _e('We are sorry, no results were found. You can try to find some related posts using the search function.', 'jawtemplates'); ?></p>
    </div>
    <?php get_search_form();
    ?>	
<?php } ?>

<div class="panel-group row faq">
    <div class="col-lg-<?php echo jaw_template_get_var('box_size', '6'); ?>">


        <?php
        while (have_posts()) {
            the_post();
            echo jaw_get_template_part('content-faq', 'custom-posts');
        }
        ?>

    </div>
</div>                 

<div class="clear"></div>
<?php
$wp_query = null;
$wp_query = $backup_query;
wp_reset_postdata();
?>