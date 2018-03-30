<?php get_header(); ?>

<?php $post_id = get_the_ID(); ?> 

<!--get all datas-->
<?php $all_product_datas = redux_post_meta( 'redux_demo', $post_id ); ?>


<!--start header parallax image-->
<?php if ($all_product_datas['metabox_products_header_img_display'] == 1){ ?>

    <section class="nicdark_section" style="background:url(<?php echo $all_product_datas['metabox_products_header_img']['url']; ?>); background-size:cover;  background-position:center center;">

        <div class="nicdark_filter <?php echo $all_product_datas['metabox_products_header_filter']; ?>">

            <!--start nicdark_container-->
            <div class="nicdark_container nicdark_clearfix">

                <div class="grid grid_12">
                    <div class="nicdark_space<?php echo $all_product_datas['metabox_products_header_margintop']; ?>"></div>
                    <h1 class="center white extrasize title"><?php echo $all_product_datas['metabox_products_header_title']; ?></h1>
                    <div class="nicdark_space10"></div>
                    <h3 class="subtitle center white"><?php echo $all_product_datas['metabox_products_header_description']; ?></h3>
                    <div class="nicdark_space20"></div>
                    <?php if ( $all_product_datas['metabox_products_header_divider'] == 1 ){ ?> <div class="nicdark_divider center big"><span class="nicdark_bg_white nicdark_radius"></span></div> <?php } ?>
                    <div class="nicdark_space<?php echo $all_product_datas['metabox_products_header_marginbottom']; ?>"></div>
                </div>

            </div>
            <!--end nicdark_container-->

        </div>
         
    </section>


<?php }else{ ?>

    <div class="nicdark_space60"></div>

<?php } ?>
<!--end header parallax image-->




<?php $nicdark_productlayout = $all_product_datas['layout_products']; ?>

<!--FULL WIDTH PAGE-->
<?php if ($nicdark_productlayout == 0) { ?>

            
            <div class="nicdark_space50"></div>
            <section class="nicdark_section">
                <div class="nicdark_container nicdark_clearfix">
                    <div class="grid grid_12">
                                                
                        <!--start content-->
                        <?php woocommerce_content(); ?>
                        <!--end content-->

                    </div>
                </div>
            </section>
            <div class="nicdark_space30"></div>
        

<?php } ?>


<!--RIGHT SIDEBAR PAGE PAGE-->
<?php if ($nicdark_productlayout == 1) { ?>


            <div class="nicdark_space50"></div>
            <section class="nicdark_section">
                <div class="nicdark_container nicdark_clearfix">
                    <div class="grid grid_8 nicdark_page_sidebar">
                                                
                        <!--start content-->
                        <?php woocommerce_content(); ?>
                        <!--end content-->

                    </div>
                    <div class="grid grid_4  nicdark_sidebar"><?php if ( ! dynamic_sidebar( 'woo-commerce' ) ) : ?><?php endif ?></div>
                </div>
            </section>
            <!--<div class="nicdark_space50"></div>-->


<?php } ?>


<!--LEFT SIDEBAR PAGE PAGE-->
<?php if ($nicdark_productlayout == 2) { ?>


            <div class="nicdark_space50"></div>
            <section class="nicdark_section">
                <div class="nicdark_container nicdark_clearfix">
                    <div class="grid grid_4  nicdark_sidebar"><?php if ( ! dynamic_sidebar( 'woo-commerce' ) ) : ?><?php endif ?></div>
                    <div class="grid grid_8 nicdark_page_sidebar">
                        
                        <!--start content-->
                        <?php woocommerce_content(); ?>
                        <!--end content-->
                        
                    </div>
                </div>
            </section>
            <!--<div class="nicdark_space50"></div>-->


<?php } ?>
        


<?php get_footer(); ?>