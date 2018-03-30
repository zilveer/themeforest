<!doctype html>
<html <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php global $bd_data; ?>
<?php wp_head(); ?>
</head>
<?php
$body_styles = null;
if( is_singular() ){
    $body_styles = "style='";
    if(get_post_meta(get_the_ID(), 'bd_post_background_color', true) && get_post_meta(get_the_ID(), 'bd_post_background_color', true) !='#'){
        $body_styles .=   "background:".get_post_meta(get_the_ID(), 'bd_post_background_color', true)." !important;";
    }

    if(get_post_meta(get_the_ID(), 'bd_post_background_custom', true)){
        $att_id = get_post_meta(get_the_ID(), 'bd_post_background_custom', true);
        $attachment = wp_get_attachment_image_src( $att_id, 'full' );
        $body_styles .=   "background: ".get_post_meta(get_the_ID(), 'bd_post_background_color', true)." url(".$attachment[0].")".get_post_meta(get_the_ID(), 'bd_post_background_repeat', true)." ".get_post_meta(get_the_ID(), 'bd_post_background_attachment', true)." ".get_post_meta(get_the_ID(), 'bd_post_background_x', true)." ".get_post_meta(get_the_ID(), 'bd_post_background_y', true)." !important;";
    } else {}
    $body_styles .=  "'";
}
/*
 * Site sidebar position
 */
if( bdayh_get_option( 'site_sidebar_position_type', true ) == 'site_sidebar_position_left' ){
    $site_sidebar_position_type = 'site_sidebar_position_left';
} elseif( bdayh_get_option( 'site_sidebar_position_type', true ) == 'site_sidebar_position_right' ){
    $site_sidebar_position_type = 'site_sidebar_position_right';
} elseif( bdayh_get_option( 'site_sidebar_position_type', true ) == 'site_sidebar_position_no' ){
    if( is_home() )
        $site_sidebar_position_type = 'layout-full-width';
} else {
    $site_sidebar_position_type = '';
}

/* Header Style */
if( bdayh_get_option( 'header_style' ) ==  "dark" ){
    $header_style = ' header-dark';
} else {
    $header_style = '';
}

if( bdayh_get_option( 'slide_out_sidebar_position' ) ==  'left' ){
    $SOSP = ' slide_out_sidebar_left';
} else {
    $SOSP = ' slide_out_sidebar_right';
}

?>
<body <?php body_class($SOSP); echo $body_styles; ?>>

    <?php if( bdayh_get_option( 'slide_out_about' ) == true ){ ?>
        <div class="slide-out-info">

            <div class="bd-container">
                <div class="slide-out-info-row1">

                    <h4 class="slide-out-info-title"><?php echo bdayh_get_option( 'slide_out_about_name' ); ?></h4>
                    <div class="slide-out-info-desc">
                        <?php echo stripcslashes( bdayh_get_option( 'slide_out_about_desc' ) ); ?>

                        <?php if( bdayh_get_option( 'slide_out_about_read_more' ) ){?>
                            <a class="slide-out-info-read-more" href="<?php echo bdayh_get_option( 'slide_out_about_read_more' ); ?>"><?php _e( 'Read More ..', 'bd' ) ?></a>
                        <?php } ?>
                    </div>
                    <?php if( bdayh_get_option( 'slide_out_about_social' ) ){ echo bd_social('yes', '', 'ttip'); } ?>
                </div>
                <div class="slide-out-info-row2">
                    <?php if( bdayh_get_option( 'slide_out_about_img' ) ){ ?>
                        <div class="slide-out-info-img">
                            <img src="<?php echo bdayh_get_option( 'slide_out_about_img' ) ?>" alt="" />
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>


    <?php if( bdayh_get_option( 'slide_out_sidebar' ) == true ):
        ?>
        <div class="nav-out">
            <div class="nav-out-bar">
                <div class="nav-out-content">
                    <div class="btn-nav-out">
                        <i class="fa"></i>
                    </div>

                    <?php
                    if (is_active_sidebar('slideout-widget')) :
                        dynamic_sidebar('slideout-widget');
                    endif;
                    ?>
                </div>
            </div>
        </div>
    <?php
        endif;
    ?>

    <?php if( bdayh_get_option( 'logo_center' ) ) { $logo_center = ' logo-center'; } ?>
    <div id="warp" class="<?php echo $site_sidebar_position_type ?>">
        <div class="bd-header<?php echo $logo_center; echo $header_style ?>">
            <?php if( bdayh_get_option( 'show_top_bar' ) ){ ?>
                <div class="top-bar">
                    <?php if( bdayh_get_option( 'show_top_search_right' ) ){ ?>
                    <div class="top-search">
                        <?php bd_search(); ?>
                    </div><!-- .top-search -->
                    <?php } ?>

                    <?php if( bdayh_get_option( 'show_top_social_right' ) ){ ?>
                    <div class="top-social">
                        <?php echo bd_social('yes', '', 'tooldown'); ?>
                    </div><!-- .top-social -->
                    <?php } ?>

                </div><!-- .top-bar -->
            <?php } ?>


            <div id="header-fix" class="header<?php if( bdayh_get_option( 'header_fix' ) ) { echo ' fixed-on'; } if( bdayh_get_option( 'header_fix_transparency' ) ) { echo ' header-fixed-trans'; } ?>">

                <?php if( bdayh_get_option( 'slide_out_sidebar' ) == true ){ ?>
                    <div class="btn-nav-out"><i class="fa"></i></div>
                <?php } ?>

                <div class="bd-container">

                    <?php if( bdayh_get_option( 'slide_out_about' ) == true ){ ?>
                        <span class="slide-out-info-btn">
                            <i class="fa fa-user"></i>
                            <?php _e( 'About me', 'bd' ) ?>
                        </span>
                    <?php } ?>

                    <?php
                    if( bdayh_get_option( 'margin_logo_top' ) ){
                        $logo_top     = bdayh_get_option( 'margin_logo_top' ).'px';
                    } else {
                        $logo_top     = 'auto';
                    }

                    if( bdayh_get_option( 'margin_logo_right' ) ){
                        $logo_right     = bdayh_get_option( 'margin_logo_right' ).'px';
                    } else {
                        $logo_right     = 'auto';
                    }

                    if( bdayh_get_option( 'margin_logo_bottom' ) ){
                        $logo_bottom     = bdayh_get_option( 'margin_logo_bottom' ).'px';
                    } else {
                        $logo_bottom     = 'auto';
                    }

                    if( bdayh_get_option( 'margin_logo_left' ) ){
                        $logo_left     = bdayh_get_option( 'margin_logo_left' ).'px';
                    } else {
                        $logo_left     = 'auto';
                    }

                    $logo_margin    = '';

                    if( $logo_top || $logo_right || $logo_bottom || $logo_left ){
                        $logo_margin = ' style="margin:'.$logo_top.' '.$logo_right.' '.$logo_bottom.' '.$logo_left.'"';
                    }
                    ?>
                    <div class="bd-logo"<?php echo $logo_margin ?>>
                        <?php if( !is_singular() && !is_category() && !is_tag() ) echo '<h1 class="site-title">'; else echo '<h2 class="site-title">'; ?>
                        <?php if( bdayh_get_option( 'logo_displays' ) == 'logo_image' ) { ?>
                            <?php
                            if( bdayh_get_option( 'logo_upload' ) ) {
                                $logo = bdayh_get_option( 'logo_upload' );
                            } else {
                                $logo = BD_IMG .'/logo.svg';
                            }

                            if( bdayh_get_option( 'logo_retina' ) ) {
                                $logo_retina        = bdayh_get_option( 'logo_retina' );
                                $logo_retina_width  = bdayh_get_option( 'retina_logo_width' );
                            }
                            ?>
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                                <img src="<?php echo $logo ; ?>" alt="<?php bloginfo('name'); ?>" />
                            </a>
                        <?php if( bdayh_get_option( 'logo_retina' ) && bdayh_get_option( 'retina_logo_width' ) ) { ?>
                            <script type="text/javascript">jQuery(document).ready(function($) { var retina = window.devicePixelRatio > 1 ? true : false; if( retina ) { jQuery('#theme-header .bd-logo img').attr('src', '<?php echo $logo_retina ?>'); jQuery('#theme-header .bd-logo img').attr('width', '<?php echo $logo_retina_width ?>'); } });</script>
                        <?php } ?>
                        <?php } else { ?>
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-name">
                                <?php bloginfo('name'); ?>
                            </a>
                            <?php if( bdayh_get_option( 'logo_tagline' ) == 1 ){ ?>
                                <span class="site-tagline"><?php bloginfo( 'description' ); ?></span>
                            <?php } ?>
                        <?php } ?>
                        <?php if( !is_singular() && !is_category() && !is_tag() ) echo '</h1>'; else echo '</h2>'; ?>
                    </div><!-- End Logo -->

                    <div id="navigation">
                        <?php wp_nav_menu(array('theme_location' => 'primary', 'depth' => 5, 'container' => false, 'menu_id' => 'menu-nav', 'fallback_cb' => 'nav_fallback' ) ); ?>
                    </div><!-- #navigation -->

                </div>



            </div><!-- .header -->
        </div><!-- .bd-header -->

        <?php 
            if( is_front_page() ) {
                bd_in ('slide-set'); // Get Slide Set 
            }
        ?>

        <div class="clear"></div>
        <?php
        if( bdayh_get_option('show_header_ads') == true ){
            if($bd_data['margin_header_adv_top']){
                $m_adv_top = 'style="margin-top: '. $bd_data['margin_header_adv_top'] .'px"';
            } else {
                $m_adv_top ='';
            }
            if($bd_data['header_ads_code'] != ''){
                echo '<div class="header-adv">' ."\n";
                echo stripslashes( $bd_data['header_ads_code'] );
                echo '<div class="clear"></div></div><!-- .header-adv/-->' ."\n";
            } else {
                echo '<div class="header-adv" '. $m_adv_top .'><a href="'.$bd_data['header_ads_img_url'].'" title="'.$bd_data['header_ads_img_altname'].'"><img src="'.$bd_data['header_ads_img'].'" alt="'.$bd_data['header_ads_img_altname'].'" /></a><div class="clear"></div></div><!-- .header-adv/-->' ."\n";
            }
        }
        ?>
