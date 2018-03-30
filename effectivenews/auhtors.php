<?php
/*
    Template Name: Authors
 */

?>
<?php
    //Page settings
    $d_breacrumb = get_post_meta(get_the_ID(), 'mom_disbale_breadcrumb', true);
    $hpt = get_post_meta(get_the_ID(), 'mom_hide_pagetitle', true);
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
                <?php if ($d_breacrumb != true) { ?>
                <div class="category-title">
                        <?php mom_breadcrumb(); ?>
                </div>
                <?php } ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; // end of the loop. ?>
                    <?php wp_reset_query(); ?>
        <?php } else { //if not full width ?>
            <div class="main_container">
           <div class="main-col">
                <?php if ($d_breacrumb != true) { ?>
                <div class="category-title">
                        <?php mom_breadcrumb(); ?>
                </div>
                <?php } ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                    <?php
                            $users = get_users( 'orderby=post_count&order=DESC' );
                            // Array of WP_User objects.
                            foreach ( $users as $user ) {mom_author_box('', $user->ID, false);}
                    ?>
                    <?php the_content(); ?>
                    <?php endwhile; // end of the loop. ?>
                    <?php wp_reset_query(); ?>
            </div> <!--main column-->
            <?php get_sidebar('secondary'); ?>
            <div class="clear"></div>
</div> <!--main container-->            
<?php get_sidebar(); ?>
<?php }// end full width ?>             
</div> <!--main inner-->
            
<?php get_footer(); ?>