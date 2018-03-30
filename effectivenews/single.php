<?php
    //Page settings
    $d_breacrumb = get_post_meta(get_the_ID(), 'mom_disbale_breadcrumb', true);
    $PS = get_post_meta(get_the_ID(), 'mom_page_share', true);
    $PC = get_post_meta(get_the_ID(), 'mom_page_comments', true);
    //Page Layout
    $custom_page = get_post_meta(get_the_ID(), 'mom_custom_page', true);
    $layout = get_post_meta(get_the_ID(), 'mom_page_layout', true);
    if ($layout == '') { $layout = mom_option('posts_layout');}
    $right_sidebar = get_post_meta(get_the_ID(), 'mom_right_sidebar', true);
    $left_sidebars = get_post_meta(get_the_ID(), 'mom_left_sidebar', true);
?>
<?php get_header(); ?>
    <div class="inner">
        <?php
            if (mom_option('post_top_ad') != '') {
                echo do_shortcode('[ad id="'.mom_option('post_top_ad').'"]');
                echo do_shortcode('[gap height="20"]');
            }
        ?>
        <?php if ($layout == 'fullwidth') { ?>
                <?php if ($d_breacrumb != true) { ?>
                <div class="category-title">
                        <?php mom_breadcrumb(); ?>
                </div>
                <?php } ?>
                <?php if ($custom_page) { ?>
                        <?php mom_single_post_content(); ?>
                        <? } else { ?>
                        <?php mom_single_post_content(); ?>
                <?php } // end cutom page  ?>
        <?php } else { //if not full width ?>
            <div class="main_container">
           <div class="main-col">
                <?php if ($d_breacrumb != true) { ?>
                <div class="category-title">
                        <?php mom_breadcrumb(); ?>
                </div>
                <?php } ?>
<?php if ($custom_page) { 
                        mom_single_post_content(); 
} else { ?>
                        <?php mom_single_post_content(); ?>
<?php } ?>
            </div> <!--main column-->
            <?php get_sidebar('secondary'); ?>
            <div class="clear"></div>
</div> <!--main container-->            
<?php get_sidebar(); ?>
<?php }// end full width ?>
            </div> <!--main inner-->
            
<?php get_footer(); ?>