<?php
/**
 * The Template for displaying all single posts
 */

get_header(); ?>
<?php
    $subtitle = ''; $breadcrumbs = 'no';
    if(defined('FW'))
    {
        //get inner banner
        $banner = fw_get_db_settings_option('member_banner');

        if($banner['enable-member-banner'] == 'yes')
        {
            $subtitle = $banner['yes']['member_post-subtitle'];
            $breadcrumbs = $banner['yes']['enable-member-breadcrumbs'];
        }

        //show inner banner
        fw_show_inner_banner($banner['enable-member-banner'], get_the_title(), $subtitle, $breadcrumbs);
    }

?>
<?php $sidebar_position = (function_exists('fw_ext_sidebars_get_current_position')) ? fw_ext_sidebars_get_current_position() : 'right'; ?>
<div class="w-section section">
    <div class="w-container">
        <div class="w-row">
            <div class="w-col <?php echo ($sidebar_position == null || $sidebar_position == 'full') ? 'w-col-12' : 'w-col-9'; ?> w-col-stack">
                <div class="portfolio-pagination blog-pag">
                    <div class="w-row">
                        <div class="w-col w-col-6 right-aglin-column">
                            <span class="w-inline-block p-pagination">
                                <?php previous_post_link('%link', '<span class="w-embed"><i class="fa fa-chevron-left"></i></span>', false); ?>
                            </span>
                        </div>
                        <div class="w-col w-col-6 left-aglin-column">
                            <span class="w-inline-block p-pagination">
                                <?php next_post_link('%link', '<span class="w-embed"><i class="fa fa-chevron-right"></i></span>', false); ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="normal-blog-wrapper">
                    <?php
                    while ( have_posts() ) : the_post();
                        get_template_part( 'content', 'single-member' );
                        // If comments are open, load up the comment template.
                        if ( comments_open() ) {
                            comments_template();
                        }
                    endwhile;?>
                </div>
            </div>
            <?php if($sidebar_position == 'left' || $sidebar_position == 'right'):?>
                <div class="w-col w-col-3 w-col-stack">
                    <div class="sidebar">
                        <?php get_sidebar();?>
                    </div>
                </div>
            <?php endif;?>
        </div>
    </div>
</div>
<?php
    //call to action settings
    if(defined('FW'))
    {
        $call_to_action = fw_get_db_settings_option('member_post_action');

        if($call_to_action['enable-member-action'] == 'yes')
            fw_show_call_to_action($call_to_action['yes']);
    }
?>
<?php get_footer(); ?>