<?php
/**
 * Single Product Image
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     2.1.0
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

global $post, $woocommerce, $product;
$cb_sidebars=cb_get_sidebars($post->ID);


if($cb_sidebars['sidebar_position'] == '' || $cb_sidebars['sidebar_position'] == 'none'){

?>
<div class="col-lg-6 col-md-12">
    <div class="row">

        <?php
        if (has_post_thumbnail()) {

            $image_title = esc_attr(get_the_title(get_post_thumbnail_id()));
            $image_link = wp_get_attachment_url(get_post_thumbnail_id());
            $image = '<img src="' . bfi_thumb($image_link, array('width' => '390', 'height' => '390', 'crop' => true)) . '" class="product_image_full"/>';
            $attachment_count = count($product->get_gallery_attachment_ids());

            if ($attachment_count > 0) {
                ?>
                <div class="col-xs-1 col-sm-3 hidden-xs">
                    <div class="single-product-vertical-gallery">
                        <a class="fa fa-angle-up up-btn" href="#up"></a>
                        <a class="fa fa-angle-down down-btn" href="#down"></a>
                        <ul>
                            <li>
                                <a class="vertical-gallery-item" href="#slide1">
                                    <img class="lazy" alt="product"
                                         src="<?php echo bfi_thumb($image_link, array('width' => '113', 'height' => '146', 'crop' => true)) ?>"
                                         width="113" height="146"/>
                                </a>
                            </li>
                            <?php
                            $i = 2;
                            $more_images = '';
                            foreach ($product->get_gallery_attachment_ids() as $im_url) {

                                $image_extra = wp_get_attachment_url($im_url);
                                ?>
                                <li>
                                    <a class="vertical-gallery-item" href="#slide<?php echo $i; ?>">
                                        <img class="lazy" alt="product"
                                             src="<?php echo bfi_thumb($image_extra, array('width' => '113', 'height' => '146', 'crop' => true)) ?>"
                                             width="113" height="146"/>
                                    </a>
                                </li>
                                <?php
                                $more_images .= '<div class="single-product-gallery-item" id="slide' . $i . '">
                           <a data-rel="prettyphoto" href="' . $image_extra . '">
                                <img class="lazy"  alt="" src="' . bfi_thumb($image_extra, array('width' => '512', 'height' => '683', 'crop' => true)) . '" />

                            </a>
                        </div>';

                                $i++;
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            <?php
            }

            //echo '<img src="'.bfi_thumb($image_link, array('width' => '960','height'=>'960', 'crop' => true)).'" class="product_image_full"/>';
            //echo apply_filters('woocommerce_single_product_image_html', sprintf('<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', bfi_thumb($image_link, array('width' => '960', 'height' => '960', 'crop' => true)), $image_title, $image), $post->ID);
            ?>


            <div class="col-xs-11 col-sm-9">
                <div class="single-product-gallery">
                    <?php if ($attachment_count > 0) { ?>
                        <div class="nav-holder">
                            <a class="fa fa-angle-right next-btn" href="#next"></a>
                            <a class="fa fa-angle-left prev-btn" href="#prev"></a>
                        </div>
                    <?php } ?>
                    <div class="single-product-slider">
                        <div class="single-product-gallery-item" id="slide1">
                            <a data-rel="prettyphoto"
                               href="<?php echo $image_link; ?>">
                                <img class="lazy" alt=""
                                     src="<?php echo bfi_thumb($image_link, array('width' => '512', 'height' => '683', 'crop' => true)); ?>"/>

                            </a>
                        </div>
                        <?php if ($more_images !='') echo $more_images;?>

                    </div>
                </div>
            </div>

        <?php
        } else {

            echo '<img src="' . bfi_thumb(WP_THEME_URL . '/img/blank.jpg', array('width' => '960', 'height' => '960', 'crop' => true)) . '" />';

        }
        ?>

        <?php do_action('woocommerce_product_thumbnails'); ?>
    </div>
</div>
<?php }else{ ?>
<div class="col-md-12 col-lg-7 ml0">
    <?php



    if (has_post_thumbnail()) {

        $image_title = esc_attr(get_the_title(get_post_thumbnail_id()));
        $image_link = wp_get_attachment_url(get_post_thumbnail_id());
        $image = '<img src="' . bfi_thumb($image_link, array('width' => '390', 'height' => '390', 'crop' => true)) . '" class="product_image_full"/>';
        $attachment_count = count($product->get_gallery_attachment_ids());

        ?>

    <div class="single-product-gallery">
        <?php if ($attachment_count > 0) { ?>
        <div class="nav-holder">
            <a class="fa fa-angle-right next-btn" href="#next"></a>
            <a class="fa fa-angle-left prev-btn" href="#prev"></a>
        </div>
        <?php

            $i = 2;
            $more_images = '';
            $attach_photos = '';
            foreach ($product->get_gallery_attachment_ids() as $im_url) {

                $image_extra = wp_get_attachment_url($im_url);
               $attach_photos.='
                <li>
                    <a class="horizontal-gallery-item" href="#slide'.$i.'">
                        <img class="lazy" alt="product"
                             src="'.bfi_thumb($image_extra, array('width' => '113', 'height' => '146', 'crop' => true)) .'"
                             width="113" height="146"/>
                    </a>
                </li>';
                $more_images .= '<div class="single-product-gallery-item" id="slide' . $i . '">
                           <a data-rel="prettyphoto" href="' . $image_extra . '">
                                <img class="lazy"  alt="" src="' . bfi_thumb($image_extra, array('width' => '512', 'height' => '683', 'crop' => true)) . '" />

                            </a>
                        </div>';

                $i++;
            }


        } ?>

        <div class="single-product-slider">
            <div class="single-product-gallery-item" id="slide1">
                <a data-rel="prettyphoto"
                   href="<?php echo $image_link; ?>">
                    <img class="lazy" alt=""
                         src="<?php echo bfi_thumb($image_link, array('width' => '512', 'height' => '683', 'crop' => true)); ?>"/>

                </a>
            </div>
            <?php if ($more_images !='') echo $more_images;?>

        </div>

    </div>
<?php
        if ($attachment_count > 0) {
        ?>
            <div class="single-product-horizontal-gallery">
                <a class="fa fa-angle-left prev-btn" href="#prev"></a>
                <a class="fa fa-angle-right next-btn" href="#next"></a>
                <ul>
                    <li>
                        <a class="horizontal-gallery-item" href="#slide1">
                            <img class="lazy" alt="product"
                                 src="<?php echo bfi_thumb($image_link, array('width' => '113', 'height' => '146', 'crop' => true)) ?>"
                                 width="113" height="146"/>
                        </a>
                    </li>
                    <?php
                    echo $attach_photos;
                    ?>
                </ul>
            </div>

    <?php
    }?>
    <?php
    } else {

        echo '<img src="' . bfi_thumb(WP_THEME_URL . '/img/blank.jpg', array('width' => '960', 'height' => '960', 'crop' => true)) . '" />';

    }
    ?>
    <?php do_action('woocommerce_product_thumbnails'); ?>
</div>
<?php } ?>