<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<!-- Favicon -->
<?php 
$site_favicon = couponxl_get_option( 'site_favicon' );
if( !empty( $site_favicon ) ):
 ?>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_attr( $site_favicon['url'] ); ?>">
<?php endif; ?>
<?php 
if( is_single() || is_page() ){
    $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'post-thumbnail' );    
    if( is_singular( 'offer' ) && !has_post_thumbnail() ){
        $store_id = get_post_meta( get_the_ID(), 'offer_store', true ); 
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $store_id ), 'post-thumbnail' );
    }
    ?>
    <meta property="og:title" content="<?php the_title(); ?>" />
    <meta property="og:image" content="<?php echo !empty( $image ) ? esc_url( $image[0] ) : '' ?>" />
    <meta property="og:url" content="<?php the_permalink(); ?>" />
    <meta property="og:description" content="<?php echo esc_attr( strip_tags( get_the_excerpt() ) ); ?>" />

    <meta name="twitter:title" content="<?php the_title(); ?>" />
    <meta name="twitter:description" content="<?php echo esc_attr( strip_tags( get_the_excerpt() ) ); ?>" />
    <meta name="twitter:image" content="<?php echo !empty( $image ) ? esc_url( $image[0] ) : '' ?>" />    
    <?php
}
?>

<?php
include( locate_template( 'includes/search-args.php' ) );
$offer_cat_slug = isset( $offer_cat ) ? $offer_cat : '';
$offer_tag_slug = isset( $offer_tag ) ? $offer_tag : '';
$location_slug = isset( $location ) ? $location : '';
if( !empty( $offer_cat_slug ) ){
    $term = get_term_by( 'slug', $offer_cat_slug, 'offer_cat'  );
}
else if( !empty( $offer_tag_slug ) ){
    $term = get_term_by( 'slug', $offer_tag_slug, 'offer_tag'  );
}
else if( !empty( $location_slug ) ){
    $term = get_term_by( 'slug', $location_slug, 'location'  );
}
if( !empty( $term ) && !is_wp_error( $term ) ){
    echo '<meta name="title" content="'.esc_html( $term->name ).'">';
    echo '<meta name="description" content="'.esc_html( $term->description ).'">';    
}
?>

<?php wp_head(); ?>
</head>
<?php
$body_extra_class = 'small-sticky-half';
$show_top_bar = couponxl_get_option( 'show_top_bar' );
if( $show_top_bar == 'yes' ){
    $body_extra_class = '';
}
?>
<body <?php body_class( $body_extra_class ); ?> id="body">
<?php $site_logo = couponxl_get_option( 'site_logo' ); ?>


<?php
if( $show_top_bar == 'yes' ):
?>
    <button class="navbar-toggle button-white menu" data-toggle="collapse" data-target=".search-collapse">
        <span class="sr-only"><?php _e( 'Toggle Top Bar', 'couponxl' ) ?></span>
        <i class="fa fa-search fa-3x"></i>
    </button>

    <button class="navbar-toggle button-white menu" data-toggle="collapse" data-target=".account-collapse">
        <span class="sr-only"><?php _e( 'Toggle Top Bar', 'couponxl' ) ?></span>
        <i class="fa fa-user fa-3x"></i>
    </button>
<?php endif; ?>

<button class="navbar-toggle button-white menu" data-toggle="collapse" data-target=".navbar-collapse">
    <span class="sr-only"><?php _e( 'Toggle navigation', 'couponxl' ) ?></span>
    <i class="fa fa-bars fa-3x"></i>
</button>

<?php

$show_notification_bar = couponxl_get_option( 'show_notification_bar' );
$notification_bar_closeable = couponxl_get_option( 'notification_bar_closeable' );
if( $show_notification_bar == 'yes' &&  ( $notification_bar_closeable == 'no' || ( $notification_bar_closeable == 'yes' && !isset( $_COOKIE['couponxl_notification'] ) ) ) ):
?>
<section class="notification-bar">
    <div class="container">
        <p>
            <?php
            $notification_txt = couponxl_get_option( 'notification_txt' );
            echo wp_kses( $notification_txt, array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array(),
            ) );

            if( $notification_bar_closeable == 'yes' ){
                echo '<a href="javascript:;" class="close-notification-bar"><i class="fa fa-times"></i></a>';
            }
            ?>
        </p>
    </div>
</section>
<?php
endif;
?>
<input type="hidden" class="prettylinks" value="<?php echo get_option('permalink_structure') ? 'yes' : 'no'; ?>" />
<input type="hidden" class="search_page_url" value="<?php echo esc_url( couponxl_get_permalink_by_tpl( 'page-tpl_search_page' ) ); ?>" />
<input type="hidden" class="coupon_slug" value="<?php echo esc_attr( $couponxl_slugs['coupon'] ); ?>" />
<?php

if( $show_top_bar == 'yes' ):
?>
<section class="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 collapse search-collapse">
                <div class="row">
                    <?php  include( locate_template('includes/main-search-values.php') ); ?>

                    <form method="get" action="<?php echo esc_url( couponxl_get_permalink_by_tpl( 'page-tpl_search_page' ) ) ?>" class="clearfix keyword-search <?php echo !empty( $keyword ) ? 'keyword-search-visible' : ''; ?>">
                        <div class="input-group">
                            <input type="text" class="form-control keyword_search" value="<?php echo esc_attr( $keyword ); ?>" placeholder="<?php echo couponxl_get_option( 'keyword_search_placeholder' ); ?>" name="<?php echo esc_attr( $couponxl_slugs['keyword'] ) ?>">
                        </div>
                    </form>
                    <form method="get" action="<?php echo esc_url( couponxl_get_permalink_by_tpl( 'page-tpl_search_page' ) ) ?>" class="clearfix main-search <?php echo !empty( $keyword ) ? 'main-search-hide' : ''; ?>">
                        <div class="col-sm-6">
                            <i class="fa fa-map-marker"></i>
                            <div class="input-group">
                                <input type="text" class="form-control top_bar_search" value="<?php echo esc_attr( $term_name ); ?>" placeholder="<?php echo couponxl_get_option( 'top_bar_location_placeholder' ); ?>">
                                <input type="hidden" name="<?php echo esc_attr( $couponxl_slugs['location'] ) ?>" value="<?php echo esc_attr( $location ) ?>">
                                <div class="search_options"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <i class="fa fa-shopping-cart"></i>
                            <div class="input-group">
                                <input type="text" class="form-control top_bar_search" value="<?php echo esc_attr( $store_name ); ?>" placeholder="<?php echo couponxl_get_option( 'top_bar_store_placeholder' ); ?>">
                                <input type="hidden" name="<?php echo esc_attr( $couponxl_slugs['offer_store'] ) ?>" value="<?php echo esc_attr( $offer_store ) ?>">
                                <div class="search_options"></div>
                            </div>                    
                        </div>
                    </form>
                    <div class="col-md-12">
                        <a href="javascript:;" class="btn keyword-search-toggle keyword-small-screen">
                            <i class="fa fa-search icon-margin"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 collapse account-collapse">
                <div class="text-right">
                    <a href="javascript:;" class="btn keyword-search-toggle">
                        <i class="fa fa-search icon-margin"></i>
                    </a>
                    <?php
                    if( !is_user_logged_in() && get_option('users_can_register') ){
                        ?>
                        <a href="<?php echo couponxl_get_permalink_by_tpl( 'page-tpl_login' ) ?>" class="btn">
                            <i class="fa fa-sign-out icon-margin"></i><?php _e( 'LOGIN', 'couponxl' ) ?>
                        </a>
                        <a href="<?php echo couponxl_get_permalink_by_tpl( 'page-tpl_register' ) ?>" class="btn">
                            <i class="fa fa-unlock icon-margin"></i><?php _e( 'REGISTER', 'couponxl' ) ?>
                        </a>
                        <a href="<?php echo couponxl_get_permalink_by_tpl( 'page-tpl_register' ) ?>" class="btn">
                            <i class="fa fa-ticket icon-margin"></i><?php _e( 'SUBMIT', 'couponxl' ) ?>
                        </a>
                        <?php
                    }
                    else if(  get_option('users_can_register') ){
                        ?>
                        <a href="<?php echo couponxl_get_permalink_by_tpl( 'page-tpl_my_profile' ) ?>" class="btn">
                            <i class="fa fa-user icon-margin"></i><?php _e( 'MY ACCOUNT', 'couponxl' ) ?>
                        </a>
                        <a href="<?php echo wp_logout_url( home_url() ); ?>" class="btn">
                            <i class="fa fa-sign-out icon-margin"></i><?php _e( 'LOG OUT', 'couponxl' ) ?>
                        </a>                    
                        <?php
                    }
                    ?>

                    <?php 
                    $top_bar_facebook_link = couponxl_get_option( 'top_bar_facebook_link' ); 
                    if( !empty( $top_bar_facebook_link ) ):
                    ?>
                        <a href="<?php echo esc_url( $top_bar_facebook_link ); ?>" class="btn facebook" target="_blank">
                            <i class="fa fa-facebook"></i>
                        </a>
                    <?php 
                    endif; 
                    ?>

                    <?php 
                    $top_bar_twitter_link = couponxl_get_option( 'top_bar_twitter_link' ); 
                    if( !empty( $top_bar_twitter_link ) ):
                    ?>
                        <a href="<?php echo esc_url( $top_bar_twitter_link ); ?>" class="btn twitter" target="_blank">
                            <i class="fa fa-twitter"></i>
                        </a>
                    <?php 
                    endif; 
                    ?>

                    <?php 
                    $top_bar_google_link = couponxl_get_option( 'top_bar_google_link' ); 
                    if( !empty( $top_bar_google_link ) ):
                    ?>
                        <a href="<?php echo esc_url( $top_bar_google_link ); ?>" class="btn google" target="_blank">
                            <i class="fa fa-google-plus"></i>
                        </a>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php 
$site_logo = couponxl_get_option( 'site_logo' );
$enable_sticky = couponxl_get_option( 'enable_sticky' );
$locations = get_nav_menu_locations();
$has_nav = isset( $locations[ 'top-navigation' ] ) ? true : false;
if( !empty( $site_logo['url'] ) || $has_nav ):
?>
    <section class="navigation" data-enable_sticky="<?php echo $enable_sticky == 'yes' ? 'yes' : 'no' ?>">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-xs-3">
                    <?php if( !empty( $site_logo['url'] ) ): ?>
                        <a href="<?php echo esc_url( home_url('/') ); ?>" class="site-logo">    
                            <img src="<?php echo esc_url( $site_logo['url'] ); ?>" width="<?php echo esc_attr( $site_logo['width'] ) ?>" height="<?php echo esc_attr( $site_logo['height'] ) ?>" alt="">
                        </a>
                    <?php endif; ?>
                </div>
                <div class="col-md-9 col-xs-9">
                    <div class="navbar navbar-default" role="navigation">
                        <div class="collapse navbar-collapse pull-right">
                            <?php
                            if ( $has_nav ) {
                                wp_nav_menu( array(
                                    'theme_location'    => 'top-navigation',
                                    'menu_class'        => 'nav navbar-nav clearfix',
                                    'container'         => false,
                                    'echo'              => true,
                                    'items_wrap'        => '<ul class="%2$s">%3$s</ul>',
                                    'depth'             => 10,
                                    'walker'            => new couponxl_walker,
                                ) );
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>