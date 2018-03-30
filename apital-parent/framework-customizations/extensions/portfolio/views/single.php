<?php
/**
 * The template for displaying all portfolio posts
 *
 */
get_header(); ?>
<?php
    $ext_portfolio_instance = fw()->extensions->get( 'portfolio' );
    $subtitle = ''; $breadcrumbs = 'no'; $portf_post_view = 'half';

    //get inner banner
    $banner = fw_get_db_settings_option('portf_post_banner');
    //post portfolio view
    $portf_post_view = fw_get_db_settings_option('portf_post_view');
    $portf_post_view = (isset($_GET['portfolio_type']) && $_GET['portfolio_type'] == 'wide') ? 'wide' : $portf_post_view;

    if($banner['enable-portf_post-banner'] == 'yes')
    {
        $post_subtile = fw_get_db_post_option($post->ID,'portf_post-subtitle');
        $subtitle = (!empty($post_subtile)) ? $post_subtile : $banner['yes']['portf_post-subtitle'];
        $breadcrumbs = $banner['yes']['enable-portf_post-breadcrumbs'];
    }

    //enable related projects settings
    $enable_projects = fw_get_db_settings_option('enable-portf_post-projects');

    //show inner banner
    fw_show_inner_banner($banner['enable-portf_post-banner'], get_the_title(), $subtitle, $breadcrumbs);
?>


<section class="w-section section">
    <div class="w-container">
        <?php
            if($portf_post_view == 'half')
                while ( have_posts() ) : the_post();
                    get_template_part( 'framework-customizations/extensions' . $ext_portfolio_instance->get_rel_path() . '/views/content', 'single-half' );
                endwhile;
            else
                while ( have_posts() ) : the_post();
                    get_template_part( 'framework-customizations/extensions' . $ext_portfolio_instance->get_rel_path() . '/views/content', 'single-wide' );
                endwhile;
        ?>
    </div>
</section>

<!--display related projects-->
<?php
    if($enable_projects == 'yes'):
        get_template_part( 'framework-customizations/extensions' . $ext_portfolio_instance->get_rel_path() . '/views/related', 'projects' );
    endif;
?>

<?php
    //call to action settings
    $call_to_action = fw_get_db_settings_option('portf_post_action');

    if($call_to_action['enable-portf_post-action'] == 'yes')
        fw_show_call_to_action($call_to_action['yes']);
?>
<?php get_footer(); ?>