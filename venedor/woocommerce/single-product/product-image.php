<?php
/**
 * Single Product Image
 *
 * @author         WooThemes
 * @package     WooCommerce/Templates
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $woocommerce, $product, $venedor_settings;

$attachment_ids = $product->get_gallery_attachment_ids();

$image_count = 0;

if ( has_post_thumbnail() ) {
    $image_count++;
}

foreach ( $attachment_ids as $attachment_id ) {
    $image_link = wp_get_attachment_url( $attachment_id );
    if ( ! $image_link )
        continue;
    $image_count++;
}

?>


<div class="images product-images clearfix">

    <div class="product-image elevate-zoom-<?php echo $product->id ?><?php if (!$image_count) echo ' no-gallery' ?>">
            
        <?php
            if ( has_post_thumbnail() ) {

                $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'shop_single', false);
                list($src, $width, $height) = $image;

                $image_ratio = ($width == 0) ? 1 : $height / $width;
                if ($image_ratio == 0)
                    $image_ratio = 1;
                ?>
                <style type="text/css">
                    .product-images .thumbnails .elastislide-vertical,
                    .product-images .thumbnails .normal-images {
                        margin-top: <?php echo -(430 * $image_ratio - 97 * $image_ratio * 4) / 6 ?>px !important;
                    }
                    .product-images .thumbnails {
                        height: <?php echo (97 * $image_ratio + (430 * $image_ratio - 97 * $image_ratio * 4) / 3) * 4; ?>px;
                    }
                    .product-images .thumbnails img {
                        padding: <?php echo (430 * $image_ratio - 97 * $image_ratio * 4) / 6 ?>px 0 !important;
                    }
                    /*========= Media Styles ==========*/
                    @media (max-width: 1199px) {
                        .product-images .thumbnails .elastislide-vertical,
                        .product-images .thumbnails .normal-images {
                            margin-top: <?php echo -(404 * $image_ratio - 92 * $image_ratio * 4) / 6 ?>px !important;
                        }
                        .product-images .thumbnails {
                            height: <?php echo (92 * $image_ratio + (404 * $image_ratio - 92 * $image_ratio * 4) / 3) * 4; ?>px;
                        }
                        .product-images .thumbnails img {
                            padding: <?php echo (404 * $image_ratio - 92 * $image_ratio * 4) / 6 ?>px 0 !important;
                        }
                    }

                    @media (max-width: 991px) {
                        .product-images .thumbnails .elastislide-vertical,
                        .product-images .thumbnails .normal-images {
                            margin-top: <?php echo -(560 * $image_ratio - 128 * $image_ratio * 4) / 6 ?>px !important;
                        }
                        .product-images .thumbnails {
                            height: <?php echo (128 * $image_ratio + (560 * $image_ratio - 128 * $image_ratio * 4) / 3) * 4; ?>px;
                        }
                        .product-images .thumbnails img {
                            padding: <?php echo (560 * $image_ratio - 128 * $image_ratio * 4) / 6 ?>px 0 !important;
                        }
                    }

                    .single-product .column2 .product-images .thumbnails .elastislide-vertical,
                    .single-product .column2 .product-images .thumbnails .normal-images {
                        margin-top: <?php echo -(320 * $image_ratio - 73 * $image_ratio * 4) / 6 ?>px !important;
                    }
                    .single-product .column2 .product-images .thumbnails {
                        height: <?php echo (73 * $image_ratio + (320 * $image_ratio - 73 * $image_ratio * 4) / 3) * 4; ?>px;
                    }
                    .single-product .column2 .product-images .thumbnails img {
                        padding: <?php echo (320 * $image_ratio - 73 * $image_ratio * 4) / 6 ?>px 0 !important;
                    }

                    @media (max-width: 1199px) {
                        .single-product .column2 .product-images .thumbnails .elastislide-vertical,
                        .single-product .column2 .product-images .thumbnails .normal-images {
                            margin-top: <?php echo -(272 * $image_ratio - 58 * $image_ratio * 4) / 6 ?>px !important;
                        }
                        .single-product .column2 .product-images .thumbnails {
                            height: <?php echo (58 * $image_ratio + (272 * $image_ratio - 58 * $image_ratio * 4) / 3) * 4; ?>px;
                        }
                        .single-product .column2 .product-images .thumbnails img {
                            padding: <?php echo (272 * $image_ratio - 58 * $image_ratio * 4) / 6 ?>px 0 !important;
                        }
                    }

                    @media (max-width: 991px) {
                        .single-product .column2 .product-images .thumbnails .elastislide-vertical,
                        .single-product .column2 .product-images .thumbnails .normal-images {
                            margin-top: <?php echo -(360 * $image_ratio - 78 * $image_ratio * 4) / 6 ?>px !important;
                        }
                        .single-product .column2 .product-images .thumbnails {
                            height: <?php echo (78 * $image_ratio + (360 * $image_ratio - 78 * $image_ratio * 4) / 3) * 4; ?>px;
                        }
                        .single-product .column2 .product-images .thumbnails img {
                            padding: <?php echo (360 * $image_ratio - 78 * $image_ratio * 4) / 6 ?>px 0 !important;
                        }
                    }

                    @media (max-width: 767px) {
                        .product-images .thumbnails .elastislide-vertical,
                        .product-images .thumbnails .normal-images,
                        .single-product .column2 .product-images .thumbnails .elastislide-vertical,
                        .single-product .column2 .product-images .thumbnails .normal-images {
                            margin-top: <?php echo -(238 * $image_ratio - 50 * $image_ratio * 4) / 6 ?>px !important;
                        }
                        .product-images .thumbnails,
                        .single-product .column2 .product-images .thumbnails {
                            height: <?php echo (50 * $image_ratio + (238 * $image_ratio - 50 * $image_ratio * 4) / 3) * 4; ?>px;
                        }
                        .product-images .thumbnails img,
                        .single-product .column2 .product-images .thumbnails img {
                            padding: <?php echo (238 * $image_ratio - 50 * $image_ratio * 4) / 6 ?>px 0 !important;
                        }
                    }

                    @media (max-width: 480px) {

                    }

                </style>

                <?php
                $image_title         = esc_attr( get_the_title( get_post_thumbnail_id() ) );
                $image_link          = wp_get_attachment_url( get_post_thumbnail_id() );
                $image               = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
                    'title' => $image_title,
                    'class' => 'attachment-shop_single product-image-' . $product->id,
                    'data-zoom-image' => $image_link
                    ) );
                $image = preg_replace('/ srcset="(.+?)"(.+?)/i', "$2", $image);
                
                echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image" title="%s">%s</a>', $image_link, $image_title, $image ), $post->ID );

            } else {

                echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );

            }
        ?>
        <?php
        // show new/sale label
        woocommerce_show_product_sale_flash();
        // show price
        if ($venedor_settings['product-price']) {
            if ($product->get_price() != '') {
                $variable_class = '';
                if ($product->is_type( array( 'variable' ) ) && $product->get_variation_price( 'min' ) !== $product->get_variation_price( 'max' ))
                    $variable_class = ' price-variable';
                if ($product->is_type( array( 'grouped' ) )) {
                    $child_prices = array();
                    foreach ( $product->get_children() as $child_id )
                        $child_prices[] = get_post_meta( $child_id, '_price', true );
                    $child_prices = array_unique( $child_prices );
                    if ( ! empty( $child_prices ) ) $variable_class = ' price-variable';
                }
                echo '<div class="price-box '. $venedor_settings['product-price-pos'] . $variable_class . '">';
                woocommerce_template_single_price();
                echo '</div>';
            }
        }
        ?>
    </div>
    <?php do_action( 'woocommerce_product_thumbnails' ); ?>
</div>
<?php if (!$venedor_settings['image-zoom']) : ?>
<style type="text/css">
    .product-images .zoomContainer { display: none !important; }
</style>
<?php endif; ?>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
		// check mobile
        var venedorIsMobile = {
            Android: function() {
                return navigator.userAgent.match(/Android/i);
            },
            BlackBerry: function() {
                return navigator.userAgent.match(/BlackBerry/i);
            },
            iOS: function() {
                return navigator.userAgent.match(/iPhone|iPad|iPod/i);
            },
            Opera: function() {
                return navigator.userAgent.match(/Opera Mini/i);
            },
            Windows: function() {
                return navigator.userAgent.match(/IEMobile/i);
            },
            any: function() {
                return (venedorIsMobile.Android() || venedorIsMobile.BlackBerry() || venedorIsMobile.iOS() || venedorIsMobile.Opera() || venedorIsMobile.Windows());
            }
        };

        $(".product-image-<?php echo $product->id ?>").elevateZoom({
            gallery: 'thumbnails-slider-<?php echo $product->id ?>', 
            scrollZoom: <?php echo $venedor_settings['zoom-scroll'] ? 'true' : 'false' ?>, 
            zoomType: '<?php echo $venedor_settings['zoom-type'] ?>',
            lensSize: <?php echo $venedor_settings['zoom-lens-size'] ?>,
            lensShape: '<?php echo $venedor_settings['zoom-lens-shape'] ?>',
            containLensZoom: <?php echo $venedor_settings['zoom-contain-lens'] ? 'true' : 'false' ?>, 
            zoomWindowWidth: <?php echo $venedor_settings['zoom-window-width'] ?>,
            zoomWindowHeight: <?php echo $venedor_settings['zoom-window-height'] ?>,
            zoomWindowOffetx: <?php echo $venedor_settings['zoom-window-offset-x'] ?>,
            zoomWindowOffety: <?php echo $venedor_settings['zoom-window-offset-y'] ?>,
            zoomWindowPosition: <?php echo $venedor_settings['zoom-window-pos'] ?>,
            cursor: '<?php echo $venedor_settings['zoom-cursor'] ?>', 
            borderSize: <?php echo $venedor_settings['zoom-border'] ?>,
            lensBorder: <?php echo $venedor_settings['zoom-lens-border'] ?>,
            borderColour: '<?php echo $venedor_settings['zoom-border-color'] ?>',
            responsive: true, 
            galleryActiveClass: "active", 
            imageCrossfade: true,
            easing: true,
            zoomContainer: '.elevate-zoom-<?php echo $product->id ?>'
        });

        <?php
        global $venedor_quickview;
        if (!isset($venedor_quickview)) : ?>

        $(".product-image-<?php echo $product->id ?>").bind("click", function(e) {
            e.preventDefault();
            var ez = $('.product-image-<?php echo $product->id ?>').data('elevateZoom');
            ez.closeAll();
            var gallery = blueimp.Gallery(ez.getGalleryList());
            return false;
        });

        <?php else : ?>

        $(".product-image-<?php echo $product->id ?>").bind("click", function(e) {
            e.preventDefault();
            return false;
        });

        <?php endif; ?>

        var pi_timer;
        var win_width = 0;
        $(window).resize(function() {
            pi_timer = setTimeout(function() {
                if (win_width != $(window).width()) {
                    $('#thumbnails-slider-<?php echo $product->id ?> li a').first().click();
                    $zoomWrapper = $('.elevate-zoom-<?php echo $product->id ?>').find('.zoomWrapper');
                    $zoomWrapper.css('width', $zoomWrapper.find('.product-image-<?php echo $product->id ?>').width());
                    $zoomWrapper.css('height', $zoomWrapper.find('.product-image-<?php echo $product->id ?>').height());
                    win_width = $(window).width();
                }
            }, 200); 
        });

		if (venedorIsMobile.any()) {
			$( "<style>.product-images .zoomContainer { display: none; }</style>" ).appendTo( "head" )
		}
    });
</script>
