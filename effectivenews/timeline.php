<?php
/*
 Template Name: timeline
 */
?>

<?php
    //Page settings
    $d_breacrumb = get_post_meta(get_the_ID(), 'mom_disbale_breadcrumb', true);
    $PS = get_post_meta(get_the_ID(), 'mom_page_share', true);
    $PC = get_post_meta(get_the_ID(), 'mom_page_comments', true);
    //Page Layout
    $custom_page = get_post_meta(get_the_ID(), 'mom_custom_page', true);
    $layout = get_post_meta(get_the_ID(), 'mom_page_layout', true);
    $right_sidebar = get_post_meta(get_the_ID(), 'mom_right_sidebar', true);
    $left_sidebars = get_post_meta(get_the_ID(), 'mom_left_sidebar', true);
?>
<?php get_header(); ?>
    <div class="inner">
        <?php if ($layout == 'fullwidth') { ?>
        <div class="base-box page-wrap">
        <h1 class="page-title"><?php the_title(); ?></h1>
        <div class="entry-content">
                     <?php echo mom_posts_timeline(array('posts_per_page' => -1 )); ?>
        </div> <!-- entry content -->
        </div> <!-- base box -->
        <?php } else { ?>
            <div class="main_container">
           <div class="main-col">
                <?php if ($d_breacrumb != true) { ?>
                <div class="category-title">
                        <?php mom_breadcrumb(); ?>
                </div>
                <?php } ?>
        <div class="base-box page-wrap">
        <h1 class="page-title"><?php the_title(); ?></h1>
        <div class="entry-content">
                     <?php //echo mom_posts_timeline(array('posts_per_page' => -1 )); ?>

        </div> <!-- entry content -->
        </div> <!-- base box -->
            </div> <!--main column-->
            <?php get_sidebar('secondary'); ?>
            <div class="clear"></div>
        </div> <!--main container-->
<?php get_sidebar(); ?>
<?php } ?>
</div> <!--main inner-->
            
<?php get_footer(); ?>