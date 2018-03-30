<?php
/**
 * The template for displaying index page
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 */
get_header(); ?>

<?php
    $subtitle = $title = ''; $blog_view = 'normal'; $breadcrumbs = 'no';

    if(defined('FW'))
    {
        //get blog view type
        $blog_view = fw_get_db_settings_option('blog_view');

        if ( is_front_page() && is_home() ) {
            //get inner banner
            $banner = fw_get_db_settings_option('home_banner');

            if($banner['enable-home-banner'] == 'yes')
            {
                $title = (!empty($banner['yes']['home-subtitle'])) ? $banner['yes']['home-subtitle'] : __('Homepage','fw');
                $breadcrumbs = $banner['yes']['enable-home-breadcrumbs'];
            }
            //show inner banner
            fw_show_inner_banner($banner['enable-home-banner'], $title, $subtitle, $breadcrumbs);
        }
        else
        {
            //get inner banner
            $banner = fw_get_db_settings_option('blogpage_banner');

            if($banner['enable-blogpage-banner'] == 'yes')
            {
                $title = (!empty($banner['yes']['blogpage-subtitle'])) ? $banner['yes']['blogpage-subtitle'] : __('Posts Page','fw');
                $breadcrumbs = $banner['yes']['enable-blogpage-breadcrumbs'];
            }
            //show inner banner
            fw_show_inner_banner($banner['enable-blogpage-banner'], $title, $subtitle, $breadcrumbs);
        }
    }
?>
<?php $sidebar_position = (function_exists('fw_ext_sidebars_get_current_position')) ? fw_ext_sidebars_get_current_position() : 'right';?>
    <div class="w-section section">
        <div class="w-container">
            <div class="w-row">
                <div class="w-col <?php echo ($sidebar_position == null || $sidebar_position == 'full') ? 'w-col-12' : 'w-col-9'; ?> w-col-stack">
                    <div class="normal-blog-wrapper">

                        <?php if ( have_posts() ) : ?>

                            <?php
                            // Start the Loop.
                            while ( have_posts() ) : the_post();

                                if($blog_view == 'normal')
                                    get_template_part( 'listing', 'blog1' );
                                else
                                    get_template_part( 'listing', 'blog2' );

                            endwhile;
                            // archive pagination
                            fw_theme_paging_nav();

                        else :
                            // If no content, include the "No posts found" template.
                            get_template_part( 'content', 'none' );

                        endif; ?>
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
        if ( is_front_page() && is_home() ) {
            $call_to_action = fw_get_db_settings_option('home_action');

            if($call_to_action['enable-home-action'] == 'yes')
                fw_show_call_to_action($call_to_action['yes']);
        }
        else
        {
            $call_to_action = fw_get_db_settings_option('blogpage_action');

            if($call_to_action['enable-blogpage-action'] == 'yes')
                fw_show_call_to_action($call_to_action['yes']);
        }
    }
?>
<?php
get_footer();