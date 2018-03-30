<?php global $jaw_data; ?>
<?php
global $post, $wp_query;
wp_reset_query();
wp_reset_postdata();
if (jaw_template_get_var('id', '') != '' && get_page(jaw_template_get_var('id', ''))) {
    $wp_query = new WP_Query('page_id=' . jaw_template_get_var('id', ''));
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            ?>
            <div class="row" style="background: url('<?php echo jaw_template_get_var('image_src'); ?>');">
                <?php
                the_content();
                ?> 
            </div>
        <?php } ?>
    <?php } ?>
<?php }
wp_reset_query();