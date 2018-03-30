<?php
/**
 * Woocommerce Compare page
 *
 * @author Your Inspiration Themes
 * @package YITH Woocommerce Compare
 * @version 1.1.1
 */

global $product;

// remove the style of woocommerce
if( defined('WOOCOMMERCE_USE_CSS') && WOOCOMMERCE_USE_CSS ) wp_dequeue_style('woocommerce_frontend_styles');

$is_iframe = (bool)( isset( $_REQUEST['iframe'] ) && $_REQUEST['iframe'] );

wp_enqueue_script( 'jquery-fixedheadertable', YITH_WOOCOMPARE_URL . 'assets/js/jquery.dataTables.min.js', array('jquery'), '1.3', true );
wp_enqueue_script( 'jquery-fixedcolumns', YITH_WOOCOMPARE_URL . 'assets/js/FixedColumns.min.js', array('jquery', 'jquery-fixedheadertable'), '1.3', true );

$widths = array();
foreach( $products as $product ) $widths[] = '{ "sWidth": "205px", resizeable:true }';

/** FIX WOO 2.1 */
$wc_get_template = function_exists('wc_get_template') ? 'wc_get_template' : 'woocommerce_get_template';

?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" class="ie"<?php language_attributes() ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" class="ie"<?php language_attributes() ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" class="ie"<?php language_attributes() ?>>
<![endif]-->
<!--[if IE 9]>
<html id="ie9" class="ie"<?php language_attributes() ?>>
<![endif]-->
<!--[if gt IE 9]>
<html class="ie"<?php language_attributes() ?>>
<![endif]-->
<!--[if !IE]>
<html <?php language_attributes() ?>>
<![endif]-->

<!-- START HEAD -->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width" />
    <title><?php _e( 'Product Comparison', 'yit' ) ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />

    <link rel="stylesheet" href="<?php echo $this->stylesheet_url() ?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo YITH_WOOCOMPARE_URL ?>assets/css/colorbox.css"/>
    <link rel="stylesheet" href="<?php echo YITH_WOOCOMPARE_URL ?>assets/css/jquery.dataTables.css"/>
<?php
global $blog_id;
    if ( is_multisite() && $blog_id > 1 ) {
        $upload_dir = wp_upload_dir();
        $dir = $upload_dir['baseurl'] .'/geode/';
        if (!is_dir($dir))
            @mkdir($dir);
        
        $css_file = $dir . '/css_compiled.css';
    } else {
        $css_file = get_template_directory_uri().'/css/css_compiled.css';
    }
?>
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>"/>
    <link rel="stylesheet" href="<?php echo $css_file; ?>"/>

    <?php if(get_option('pix_style_enable_google_fonts')=='true') { ?>
    <script src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
        google.load("webfont", "1");
        WebFontConfig = {
            google: { 
                families: [ <?php echo pix_font_set(); ?> ]
             }
        };
    </script><?php } ?>

    <?php wp_head() ?>

    <style type="text/css">
        body.loading {
            background: url("<?php echo YITH_WOOCOMPARE_URL ?>assets/images/colorbox/loading.gif") no-repeat scroll center center transparent;
        }
    </style>
</head>
<!-- END HEAD -->
<!-- START BODY -->
<body <?php body_class('woocommerce') ?>>

<table class="compare-list" <?php if ( empty( $products ) ) echo ' style="width:100%"' ?>>
    <tbody>

    <?php if ( empty( $products ) ) : ?>

        <tr class="no-products">
            <td><?php _e( 'No products added in the compare table.', 'yit' ) ?></td>
        </tr>

    <?php else : ?>
        <tr class="remove">
            <?php foreach( $products as $i => $product ) : $product_class = ( $i % 2 == 0 ? 'odd' : 'even' ) . ' product_' . $product->id ?>
                <td class="<?php echo $product_class; ?>">
                    <a href="<?php echo esc_url( add_query_arg( 'redirect', 'view', $this->remove_product_url( $product->id ) ) ); ?>" data-product_id="<?php echo $product->id; ?>"><i class="scicon-awesome-cancel"></i> <?php _e( 'Remove', 'yit' ) ?></a>
                </td>
            <?php endforeach ?>
        </tr>

        <?php foreach ( $fields as $field => $name ) : ?>

            <tr class="<?php echo $field ?>">

                <?php foreach( $products as $i => $product ) : $product_class = ( $i % 2 == 0 ? 'odd' : 'even' ) . ' product_' . $product->id ?>
                    <td class="<?php echo $product_class; ?>"><?php
                        switch( $field ) {

                            case 'image':
                                echo '<div class="image-wrap">' . wp_get_attachment_image( $product->fields[$field], 'shop_catalog_image_size' ) . '</div>';
                                break;

                            case 'add-to-cart':
                                $wc_get_template( 'loop/add-to-cart.php', array( 'product' => $product ) );
                                break;

                            case 'title':
                                echo empty( $product->fields[$field] ) ? '&nbsp;' : '<h3><a href="'.get_permalink($product->id).'">'.$product->fields[$field].'</a></h3>';
                                break;

                            case 'stock':
                                echo empty( $product->fields[$field] ) ? '&nbsp;' : '<small>'.$product->fields[$field].'</small>';
                                break;

                            default:
                                echo empty( $product->fields[$field] ) ? '&nbsp;' : $product->fields[$field];
                                break;
                        }
                        ?>
                    </td>
                <?php endforeach ?>

            </tr>

        <?php endforeach; ?>

        <?php if ( $repeat_price == 'yes' && isset( $fields['price'] ) ) : ?>
            <tr class="price repeated">

                <?php foreach( $products as $i => $product ) : $product_class = ( $i % 2 == 0 ? 'odd' : 'even' ) . ' product_' . $product->id ?>
                    <td class="<?php echo $product_class ?>"><?php echo $product->fields['price'] ?></td>
                <?php endforeach; ?>

            </tr>
        <?php endif; ?>

        <?php if ( $repeat_add_to_cart == 'yes' && isset( $fields['add-to-cart'] ) ) : ?>
            <tr class="add-to-cart repeated">

                <?php foreach( $products as $i => $product ) : $product_class = ( $i % 2 == 0 ? 'odd' : 'even' ) . ' product_' . $product->id ?>
                    <td class="<?php echo $product_class ?>"><?php $wc_get_template( 'loop/add-to-cart.php', array( 'product' => $product ) ); ?></td>
                <?php endforeach; ?>

            </tr>
        <?php endif; ?>

    <?php endif; ?>

    </tbody>
</table>

<?php if( wp_script_is( 'responsive-theme', 'enqueued' ) ) wp_dequeue_script( 'responsive-theme' ) ?><?php if( wp_script_is( 'responsive-theme', 'enqueued' ) ) wp_dequeue_script( 'responsive-theme' ) ?>
<?php do_action('wp_print_footer_scripts'); ?>

<script type="text/javascript">

    jQuery(document).ready(function($){
        <?php if ( $is_iframe ) : ?>$('a').attr('target', '_parent');<?php endif; ?>

        var oTable;
        $('body')/*.on( 'yith_woocompare_render_table', function(){
            if( $( window ).width() > 767 ) {
                oTable = $('table.compare-list').dataTable( {
                    "sScrollX": "100%",
                    //"sScrollXInner": "150%",
                    "bScrollInfinite": true,
                    "bScrollCollapse": true,
                    "bPaginate": false,
                    "bSort": false,
                    "bInfo": false,
                    "bFilter": false,
                    "bAutoWidth": false
                } );

                new FixedColumns( oTable );
                $('<table class="compare-list" />').insertAfter( $('h1') ).hide();
            }
        })*/.trigger('yith_woocompare_render_table');

        // remove add to cart button after added
        $('body').on('added_to_cart', function(){
            <?php if ( $is_iframe ) : ?>$('a').attr('target', '_parent');<?php endif; ?>
        });

        // close window
        $(document).on( 'click', 'a.close', function(e){
            e.preventDefault();
            window.close();
        });

        $(window).on( 'yith_woocompare_product_removed', function(){
            /*if( $( window ).width() > 767 ) {
                oTable.fnDestroy(true);
            }*/
            $('body').trigger('yith_woocompare_render_table');
        });

    });

</script>

</body>
</html>