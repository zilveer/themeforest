<?php
/**
 * single Post template 8
 **/

if (have_posts()) {
    the_post();

    $td_mod_single = new td_module_single($post);

    ?>
    <div class="td-post-header td-pb-padding-side">

        <?php echo $td_mod_single->get_category(); ?>

        <header>
            <?php echo $td_mod_single->get_title();?>


            <?php if (!empty($td_mod_single->td_post_theme_settings['td_subtitle'])) { ?>
                <p class="td-post-sub-title"><?php echo $td_mod_single->td_post_theme_settings['td_subtitle'];?></p>
            <?php } ?>


            <div class="meta-info">

                <?php echo $td_mod_single->get_author();?>
                <?php echo $td_mod_single->get_date(false);?>
                <?php echo $td_mod_single->get_views();?>
                <?php echo $td_mod_single->get_comments();?>
            </div>
        </header>


    </div>

    <?php echo $td_mod_single->get_social_sharing_top();?>


    <div class="td-post-content td-pb-padding-side">

    <?php echo $td_mod_single->get_content();?>
    </div>


    <footer>
        <?php echo $td_mod_single->get_post_pagination();?>
        <?php echo $td_mod_single->get_review();?>

        <div class="td-post-source-tags td-pb-padding-side">
            <?php echo $td_mod_single->get_source_and_via();?>
            <?php echo $td_mod_single->get_the_tags();?>
        </div>

        <?php echo $td_mod_single->get_social_sharing_bottom();?>
        <?php echo $td_mod_single->get_next_prev_posts();?>
        <?php echo $td_mod_single->get_author_box();?>
	    <?php echo $td_mod_single->get_item_scope_meta();?>
    </footer>

    <?php echo $td_mod_single->related_posts();?>

<?php
} else {
    //no posts
    echo td_page_generator::no_posts();
}