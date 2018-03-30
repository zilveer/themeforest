<?php 

if (is_product()){

    include "single-product.php";

}else{


get_header(); ?>

<!--start header parallax image-->
<?php if ($redux_demo['archive_woocommerce_header_img_display'] == 1){ ?>

    <section class="nicdark_section" style="background:url(<?php echo $redux_demo['archive_woocommerce_header_img']['url']; ?>); background-size:cover;  background-position:center center;">

        <div class="nicdark_filter <?php echo $redux_demo['archive_woocommerce_header_filter']; ?>">

            <!--start nicdark_container-->
            <div class="nicdark_container nicdark_clearfix">

                <div class="grid grid_12">
                    <div class="nicdark_space<?php echo $redux_demo['archive_woocommerce_header_margintop']; ?>"></div>

                    <?php if ( $redux_demo['archive_woocommerce_header_title'] != "" ){ ?> <h1 class="center white extrasize title"><?php echo $redux_demo['archive_woocommerce_header_title']; ?></h1> <?php } ?>

                    <div class="nicdark_space<?php echo $redux_demo['archive_woocommerce_header_marginbottom']; ?>"></div>
                </div>

            </div>
            <!--end nicdark_container-->

        </div>
         
    </section>

    <div class="nicdark_space50"></div>


<?php }else{ ?>

    <div class="nicdark_space60"></div>

<?php } ?>
<!--end header parallax image-->


<!--first section-->
<section class="nicdark_section">
    <div class="nicdark_container nicdark_clearfix">
        <div class="grid grid_12">
    
            <!--start content-->
            <?php woocommerce_content(); ?>
            <!--end content-->

        </div>
    </div>
</section>
<!--end second section-->

<div class="nicdark_space50"></div>

                
<?php get_footer(); 

}

?>

