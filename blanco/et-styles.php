<?php
	global $woocommerce;
    $google_font_array = explode('|',etheme_get_option('google_font'));
    $font_src = '';
    if(!empty($google_font_array[1])){
        $font_name = $google_font_array[1];
        $font_src = $google_font_array[0];
    }
    if($font_src != ''):
?>
    <link href='http://fonts.googleapis.com/css?family=<?php echo $font_src; ?>' rel='stylesheet' type='text/css'/>
<?php endif; ?>
<style type="text/css">
    body {
        background-color: <?php etheme_option('backgroundcol') ?> ;
        <?php if(etheme_get_option('background_img') && etheme_get_option('background_img') != ''): ?>background-image: url(<?php etheme_option('background_img') ?>) ;<?php endif; ?>
        background-attachment: <?php etheme_option('background_attachment') ?> ;
        background-repeat: <?php etheme_option('background_repeat') ?> ;
        background-position: <?php etheme_option('background_position_x') ?> <?php etheme_option('background_position_y') ?> ;
        <?php if(etheme_get_option('background_cover') == 'enable'): ?>
        	background-size: cover;
        <?php endif; ?>
    }

    <?php if ( etheme_get_option('sale_icon') ) : ?>
        .label-icon.sale-label {
            width: <?php echo (etheme_get_option('sale_icon_width')) ? etheme_get_option('sale_icon_width') : 40 ?>px;
            height: <?php echo (etheme_get_option('sale_icon_height')) ? etheme_get_option('sale_icon_height') : 20 ?>px;
        }
        .label-icon.sale-label { background-image: url(<?php echo (etheme_get_option('sale_icon_url')) ? etheme_get_option('sale_icon_url') : get_template_directory_uri().'/images/sale.png' ?>); }
    <?php endif; ?>

    <?php if ( etheme_get_option('new_icon') ) : ?>
        .label-icon.new-label {
            width: <?php echo (etheme_get_option('new_icon_width')) ? etheme_get_option('new_icon_width') : 40 ?>px;
            height: <?php echo (etheme_get_option('new_icon_height')) ? etheme_get_option('new_icon_height') : 20 ?>px;
        }
        .label-icon.new-label { background-image: url(<?php echo (etheme_get_option('new_icon_url')) ? etheme_get_option('new_icon_url') : get_template_directory_uri().'/images/new.png' ?>); }

        .label-icon.second_label {
            top:<?php echo (etheme_get_option('new_icon_height')) ? etheme_get_option('new_icon_height') : 20 ?>px;
        }
    <?php endif; ?>

    <?php
    $selectors = Array();
    $selectors['active_color'] = '
        a:hover,
        .entry-title,
        .page-title,
		.nav-tabs > li:hover > a,
		.nav-tabs > li.active > a,
        #main-nav > ul > li.current_page_item > a,
        #main-nav > ul > li > a:hover,
        .cats .block-content li a:hover,
        #search .button:hover span,
        .cats .block-content .current-parent h5 a,
        .cats .block-content .wpsc_categories li.current-cat > a,
        .amount,
        .onsale-price .price, .currentprice,
        .portfolio-filters li a.selected,
        .widget_categories > ul > li:hover,
        #main-nav > ul > li > ul li:hover,
        .footer-information ul li a:hover,
        #tabs li > a:hover,
        #tabs li > a.active
    ';

    $selectors['google_font'] = '
        h1,h2,h3,h4,h5,h6,
        table.table th,
        .menu > ul > li > a,
        #main-nav > ul > li > a,
        .block .block-head,
        .product-slider .product-slide .product-name a,
        #products-grid .product-grid .product-name a,
		.nav-tabs > li > a,
        .tabs li a,
        .logo .logo-text,
        #tabs li > a
    ';

    $selectors['active_bg'] = '
        .cats .block-head,
        .widget_categories .widget-title,
        .widget_product_categories .widget-title,
        .et-menu-title,
        .variations_form .variations_button .button,
        .dropcap.dark,

        .cats .block-content .wpsc_category_title .btn-show:hover,
        .widget_price_filter .ui-slider .ui-slider-range,


        input[type=\'submit\'].active,
        .button.active,

        .etheme_widget_recent_comments > ul > li span:hover,
        .widget_archive li:hover,

        .square li:hover,

        .pagintaion span,
        .pagintaion a:hover,
        .pagintaion .selected,

        .continue_shopping:hover,
        .go_to_checkout:hover,
        input[type=\'submit\']:hover,
				#checkout_page_container .wpsc_make_purchase input[type=\'submit\'],
        .button:hover,
        .button.checkout-button,

        .widget_layered_nav ul li.chosen a,
        .continue-reading
    ';


    $selectors['brown_bg'] = '
        .square li,

        .etheme_widget_recent_comments > ul > li span,
        .widget_archive li,

        .continue_shopping,
        .go_to_checkout,
        input[type=\'submit\'],
        .button
    ';

    $selectors['active_bg2'] = '
        input[type=\'submit\'].active:hover,
        .button.active:hover,
        .button.checkout-button:hover,
        .continue-reading:hover
    ';
    $selectors['active_border'] = '
        textarea.validation-failed,
        input.validation-failed,
        .widget_layered_nav ul li.chosen a
    ';
    ?>

    ::-moz-selection, ::selection                                    { background-color: <?php echo (etheme_get_option('activecol')) ? etheme_get_option('activecol') : '#ff4949' ?>; }

    <?php echo jsString($selectors['active_color']); ?>              { color: <?php echo (etheme_get_option('activecol')) ? etheme_get_option('activecol') : '#ff4949' ?>; }

    <?php echo jsString($selectors['active_bg']); ?>                 { background-color: <?php echo (etheme_get_option('activecol')) ? etheme_get_option('activecol') : '#ff4949' ?>; }

    <?php echo jsString($selectors['active_bg2']); ?>                { background-color: <?php echo (etheme_get_option('activehovercol')) ? etheme_get_option('activehovercol') : '#ee2121' ?>; }

    <?php echo jsString($selectors['google_font']); ?>               { font-family: <?php echo (etheme_get_option('google_font') && etheme_get_option('google_font') != '') ? $font_name : 'Georgia' ?>; }

    <?php echo jsString($selectors['active_border']); ?>             { border-color: <?php echo (etheme_get_option('activecol')) ? etheme_get_option('activecol') : '#ff4949' ?>;}

    <?php echo jsString($selectors['brown_bg']); ?>                  { background-color:#acacac; }

</style>
<script type="text/javascript">
    var active_color_selector = '<?php echo jsString($selectors['active_color']); ?>';
    var active_bg_selector = '<?php echo jsString($selectors['active_bg']); ?>';
    var active_border_selector = '<?php echo jsString($selectors['active_border']); ?>';
    var active_color_default = '<?php echo (etheme_get_option('activecol')) ? etheme_get_option('activecol') : '#ff4949' ?>';
    var bg_default = '#ffffff';
    var pattern_default = '<?php etheme_option('background_img') ?>';

    var isRequired = ' <?php _e('Please, fill in the required fields!', ETHEME_DOMAIN); ?>';
    var cartHref = '<?php echo (class_exists('WooCommerce')) ? $woocommerce->cart->get_cart_url() : ''; ?>';
    var successfullyAdded2 = '<?php _e('was successfully added to your shopping cart.',ETHEME_DOMAIN) ?><div class="clear"><a class="button cont-shop"><span><?php _e('Continue Shopping',ETHEME_DOMAIN) ?></span></a><a href="'+cartHref+'" class="button fl-r"><span><?php _e('Checkout',ETHEME_DOMAIN) ?></span></a></div>';
    var someerrmsg = '<?php _e('Something went wrong', ETHEME_DOMAIN); ?>';
    var menuTitle = '<?php _e('Menu', ETHEME_DOMAIN); ?>';
    var nav_accordion = false;

</script>
