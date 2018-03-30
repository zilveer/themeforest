<?php
	global $woocommerce, $yith_wcwl, $yith_woocompare, $header_style;
?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
    <!-- Meta -->
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/html5.js" type="text/javascript"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/respond.min.js" type="text/javascript"></script>
	<![endif]-->

	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
<div id="page" class="wrapper">
    <?php
        if ( apply_filters( 'mc_is_enable_top_bar_switch', true ) ) {
            media_center_display_header_part( 'top-bar' );
        }

        $header_style = !empty( $header_style ) ? $header_style : media_center_header_style();
        $header_class = ( $header_style == 'header-style-1' ? 'header-style-1' : 'no-padding-bottom header-alt' );
    ?>
    <header class="<?php echo esc_attr( $header_class ); ?>">
            
        <div class="container no-padding">
            <div class="col-xs-12 col-md-3 logo-holder">
                <?php media_center_display_header_part( 'logo' ); ?>
            </div><!-- /.logo-holder -->

    		<div class="col-xs-12 col-md-6 top-search-holder no-margin">
    			
                <?php media_center_display_header_part( 'contact-row' ); ?>

                <?php
                    mc_output_search_bar();
                ?>

            </div><!-- /.top-search-holder -->

    		<div class="col-xs-12 col-md-3 top-cart-row no-margin">
                <?php
                    if( defined( 'ECWID_DEMO_STORE_ID' ) ) {
                        mc_get_template( 'ecwid/top-cart.php' );
                    } elseif( is_woocommerce_activated() ) {
                        mc_get_template( 'header/top-cart.php' );    
                    }
                ?>
            </div><!-- /.top-cart-row -->
    	</div><!-- /.container -->

    <?php if( $header_style == 'header-style-2' ) : ?>
    	
        <?php media_center_display_header_part( 'top-megamenu-nav' ) ; ?>
    	
        <?php media_center_display_breadcrumb( $header_style ); ?>
            
    </header><!-- /.header-alt -->

    <?php else : ?>

    </header><!-- /.header-style-1 -->
        
    <?php media_center_display_breadcrumb( $header_style ); ?>

    <?php endif; ?>