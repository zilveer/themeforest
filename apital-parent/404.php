<?php
/**
 * The template for displaying 404 page
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 */
get_header();?>
<?php
    $subtitle = ''; $breadcrumbs = 'no'; $title = '';

    if(defined('FW'))
    {
        //get inner banner
        $banner = fw_get_db_settings_option('404_banner');

        if($banner['enable-404-banner'] == 'yes')
        {
            $title = $banner['yes']['404-title'];
            $subtitle = fw_get_db_settings_option('404-subtitle');
            $subtitle = (!empty($subtitle)) ? $subtitle : $banner['yes']['404-subtitle'];
            $breadcrumbs = $banner['yes']['enable-404-breadcrumbs'];
        }

        //show inner banner
        fw_show_inner_banner($banner['enable-404-banner'], $title, $subtitle, $breadcrumbs);
    }
?>
    <!-- 404 ERROR PAGE -->
    <section class="w-section section">
        <div class="w-container">
            <div class="hero-center-div"><img src="<?php echo esc_url(get_template_directory_uri().'/images/404.png');?>" width="634" alt="">
                <div class="space x2">
                    <h3><?php _e( 'Page you are looking is not found', 'fw' ); ?>!</h3>
                </div>
                <div>
                    <div class="sub-tittle">
                        <?php _e( 'The page you are looking for does not', 'fw' ); ?>
                        <span class="hand-of-sean"><?php _e( 'exist', 'fw' ); ?>.</span>
                        <?php _e( 'It may have been moved, or removed altogether', 'fw' ); ?>.
                        <span class="hand-of-sean"></span>
                    </div>
                </div>
                <div class="space">
                    <a class="w-clearfix w-inline-block button btn-small" href="<?php echo esc_url(home_url()); ?>">
                        <div class="btn-ico">
                            <div class="w-embed"><i class="fa fa-home"></i>
                            </div>
                        </div>
                        <div class="btn-txt"><?php _e( 'Go back home', 'fw' ); ?></div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- END 404 ERROR PAGE -->
<?php
    //call to action settings
    if(defined('FW'))
    {
        $call_to_action = fw_get_db_settings_option('404_action');

        if($call_to_action['enable-404-action'] == 'yes')
            fw_show_call_to_action($call_to_action['yes']);
    }
?>
<?php
get_footer();