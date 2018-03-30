<?php 
$res = preg_split('/wp-content/', dirname(__FILE__));
include $res[0].'wp-load.php';
global $smof_data;
header('Content-type:text/css;');
?>	
/******************************************************/
/*  COLORS AND STYLES > General
/******************************************************/

/*  Body background color and pattern  */
body {
    <?php if ($smof_data['sellya_bodybg_color']) : ?>
	background-color: <?php echo $smof_data['sellya_bodybg_color'];?>;
    <?php endif;?>
	<?php if ($smof_data['sellya_show_bg_image_custom'] != 0) : ?>
    background-image: url("<?php echo $smof_data['sellya_bg_image_custom'];?>");
    <?php else : ?>
    background-image: url("<?php echo $smof_data['sellya_body_bg'];?>");
    <?php endif;?>
    <?php if ($smof_data['sellya_bodybg_position']) : ?>
    background-position: <?php echo strtolower($smof_data['sellya_bodybg_position']);?>!important;
    <?php endif;?>
    <?php if ($smof_data['sellya_bodybg_repeat']) : ?>            
    background-repeat: <?php echo strtolower($smof_data['sellya_bodybg_repeat']);?>!important;
    <?php endif;?>
    <?php if ($smof_data['sellya_bodybg_attach']) : ?>
    background-attachment: <?php echo strtolower($smof_data['sellya_bodybg_attach']);?>!important;
    <?php endif;?>
}
body, p, .ei-title h3 a, .cart-info thead .price, .cart-info tbody .price, #menu h1{
	<?php
	if($smof_data['sellya_body_fonts'] != ''):
	?>
    font-family: <?php echo urldecode($smof_data['sellya_body_fonts'])?>,Arial,Helvetica,sans-serif !important;
    <?php 
	endif;
	?>
}
 
 /*  Headings color  */
h1, h2, h3, h4, h5, h6, .welcome, .box-category-home > div.span2 a, .box-category-home > div.span3 a, .box-category-home > div.span4 a, .box-category-home > div.span6 a, .product-info .description span.stock { color:<?php echo $smof_data['sellya_headings_color'];?>;}

/*  Body text color  */
body, label, .dropdown_l li a, .box .box-content .box-content-information a, .box-product .name a, .box-product .l_column .name a, .box-category > ul > li > a, .box-category > ul > li a.active, .box-category > ul > li ul > li > a, .box-category-home > div.span2 > div > ul > li > a, .box-category-home > div.span3 > div > ul > li > a, .box-category-home > div.span4 > div > ul > li > a, .box-category-home > div.span6 > div > ul > li > a, .box-manufacturers-home > div.span2 > div > ul > li > a, .box-manufacturers-home > div.span3 > div > ul > li > a, .product-list .name a, .product-grid .name a, .product-grid .description, .product-name h1, .product-info .description a, .product-info .wishlist-compare a, .product-info .review a, .product-info a, .product-related .name a, .htabs a, .tags a, .es-carousel .name a { color: <?php echo $smof_data['sellya_btext_color'];?>;}
.breadcrumb a, .category-list a, table.form > * > * > td { color: <?php echo $smof_data['sellya_btext_color'];?>!important;}

/*  Light text color  */
#t-header #search input, .pagination .results, .help, .box-category-home > div.span2 > div.all a, .box-category-home > div.span3 > div.all a, .box-category-home > div.span4 > div.all a, .box-category-home > div.span6 > div.all a, .product-grid .wishlist a, .product-grid .compare a, .product-list .wishlist a, .product-list .compare a, .product-list .description, .product-info .description span, .product-info .cart, .product-info .cart div > span, .product-info .cart .minimum, #content .content .reviews-left span, .breadcrumb { color: <?php echo $smof_data['sellya_ltext_color'];?>;}

/*  Other links color  */
a, a:visited, a b, .pagination .links b, .product-custom-block a { color: <?php echo $smof_data['sellya_olink_color'];?>;}
.es-nav span:hover, .product-related .bx-wrapper div.bx-next:hover, .product-related .bx-wrapper div.bx-prev:hover, #toTopHover, .flexslider:hover .flex-next:hover, .flexslider:hover .flex-prev:hover, .camera_prevThumbs:hover, .camera_nextThumbs:hover, .camera_prev:hover, .camera_next:hover, .camera_commands:hover, .camera_thumbs_cont:hover, .camera_wrap .camera_pag .camera_pag_ul li.cameracurrent > span, .flex-control-paging li a.flex-active { background-color:<?php echo $smof_data['sellya_olink_color'];?>!important;}

/*  Links hover color  */
a:hover { color:<?php echo $smof_data['sellya_lover_color'];?>!important;}

 
/*  Main Column  */
.wrapper {
   <?php if ($smof_data['sellya_layout']=='full') : ?>
    width:100%;
    margin:0 auto;
    <?php endif;?>
    <?php if ($smof_data['sellya_mainbg_status']=='1' &&  $smof_data['sellya_mainbg_color']) : ?>
    background-color: <?php echo $smof_data['sellya_mainbg_color'];?>;
    <?php endif;?>
    <?php if ($smof_data['sellya_show_bg_image_mc_custom']!='0') : ?>
    background-image: url("<?php echo $smof_data['sellya_bg_image_mc_custom']; ?>"); 
    <?php else : ?>
    background-image: url("<?php echo $smof_data['sellya_maincol_bg']; ?>");
    <?php endif;?>
    background-position: <?php echo $smof_data['sellya_maincolbg_position'];?> !important;
    background-repeat: <?php echo $smof_data['sellya_maincolbg_repeat'];?>!important;
    background-attachment:  <?php echo $smof_data['sellya_maincolbg_attach'];?>!important;
    
     <?php if ($smof_data['sellya_mainborder_status']=='1') : ?>
    border: <?php echo $smof_data['sellya_mainborder_size'];?> <?php echo $smof_data['sellya_mainborder_style'];?> <?php echo $smof_data['sellya_mainborder_color'];?>;		
    <?php endif;?>
     
    -webkit-border-radius: <?php echo $smof_data['sellya_mainboder_radius'];?>px;
    -moz-border-radius: <?php echo $smof_data['sellya_mainboder_radius'];?>px;
    -khtml-border-radius: <?php echo $smof_data['sellya_mainboder_radius'];?>px;
    border-radius: <?php echo $smof_data['sellya_mainboder_radius'];?>px;
    
    <?php if ($smof_data['sellya_mainborder_shadow']=='1') : ?>
    box-shadow: 0 1px 3px rgba(0,0,0,0.3); 
    -webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.3);
    -moz-box-shadow:0 1px 3px rgba(0,0,0,0.3); 
    <?php endif;?>
}


/*  Left/Right Column  */
#column-left, #column-right {
       <?php if ($smof_data['sellya_lrcbg_status']=='1') : ?>
         background-color: <?php echo $smof_data['sellya_lrcbg_color'];?>!important; 
		 <?php endif;?>
      
      /*<?php echo gettype($smof_data['sellya_lrcbg_radius']); ?>*/
	  <?php if ($smof_data['sellya_lrcbg_radius']!='0') : ?>
      
	-webkit-border-radius: <?php echo $smof_data['sellya_lrcbg_radius'];?>px;
	-moz-border-radius: <?php echo $smof_data['sellya_lrcbg_radius'];?>px;
	-khtml-border-radius: <?php echo $smof_data['sellya_lrcbg_radius'];?>px;
	border-radius: <?php echo $smof_data['sellya_lrcbg_radius'];?>px;
	<?php endif;?>
     <?php if ($smof_data['sellya_lrcbg_shadow']!='0') :?>
        box-shadow: 0 1px 3px rgba(0,0,0,0.3); -webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.3); -moz-box-shadow: 0 1px 3px rgba(0,0,0,0.3);
	<?php endif;?>
}

/*  Left/Right Column Heading  */
.box .box-heading,#tab ul.nav li.ui-state-active a {
      <?php if ($smof_data['sellya_lrchbg_status']=='1') :?>
	background-color: <?php echo $smof_data['sellya_lrchbg_color'];?>; 
	<?php endif;?>
      <?php /*if ($smof_data['sellya_lrch_bg']!='') :?>
          background-image: url("<?php echo $smof_data['sellya_lrch_bg'];?>"); 
		  <?php else : ?>
          background-image: none; <?php endif;*/?>
      
    -webkit-border-radius:  <?php echo $smof_data['sellya_lrch_radius'];?>px;
	-moz-border-radius: <?php echo $smof_data['sellya_lrch_radius'];?>px;
	-khtml-border-radius: <?php echo $smof_data['sellya_lrch_radius'];?>px;
	border-radius:<?php echo $smof_data['sellya_lrch_radius'];?>px;
    
    <?php if ($smof_data['sellya_lrch_shadow']!='0') :?>
        box-shadow: 0 1px 3px rgba(0,0,0,0.3); -webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.3); -moz-box-shadow: 0 1px 3px rgba(0,0,0,0.3);
	<?php endif;?>
    
}

#tab ul.nav{

	<?php if ($smof_data['sellya_lrchbg_status']=='1') :?>
	border-bottom-color: <?php echo $smof_data['sellya_lrchbg_color'];?>; 
	<?php endif;?>
}


.box .box-heading h2{ color:<?php echo $smof_data['sellya_lrchtitle_color'];?>;}

/*  Left/Right Column Box  */
.box {
         <?php if ($smof_data['sellya_lrcboxbg_status']=='1') : ?>
        background-color: <?php echo $smof_data['sellya_lrcboxbg_color'];?>!important; 
		<?php endif;?>
        <?php if($smof_data['sellya_lrcboxsep_size'] != '0'):?>
        
        border: <?php echo $smof_data['sellya_lrcboxsep_size']?>px <?php echo $smof_data['sellya_lrcboxsep_style']?> <?php echo $smof_data['sellya_lrcboxsep_color']?>;
        
        <?php endif;?>
        	
         <?php if ($smof_data['sellya_lrcbox_radius']!='0') :?>
	-webkit-border-radius: <?php echo $smof_data['sellya_lrcbox_radius'];?>px;
	-moz-border-radius: <?php echo $smof_data['sellya_lrcbox_radius'];?>px;
	-khtml-border-radius: <?php echo $smof_data['sellya_lrcbox_radius'];?>px;
	border-radius: <?php echo $smof_data['sellya_lrcbox_radius'];?>px; 
	<?php endif;?>	
        <?php if ($smof_data['sellya_lrcbox_shadow']!='0') : ?>
            box-shadow: 0 1px 3px rgba(0,0,0,0.3); -webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.3); -moz-box-shadow: 0 1px 3px rgba(0,0,0,0.3); 
		<?php endif;?>       
}
#home_content_right{
	<?php if ($smof_data['sellya_lrcboxbg_status']=='1') : ?>
    background-color: <?php echo $smof_data['sellya_lrcboxbg_color'];?>; 
    <?php endif;?>
}


.box-category > ul > li + li, .box-product > .l_column + .l_column, .box-product ol li + li {
	border-top:<?php echo $smof_data['sellya_lrcboxsep_size'];?>px <?php echo $smof_data['sellya_lrcboxsep_style'];?> <?php echo $smof_data['sellya_lrcboxsep_color'];?>!important;	
}


/*  Content Column  */
#content, #content-home {
     <?php if ($smof_data['sellya_ccbg_status']=='1') :?>
	background-color:<?php echo $smof_data['sellya_ccbg_color'];?>!important; 
	<?php endif;?>
     <?php if ($smof_data['sellya_cc_redius']!='') :?>
        -webkit-border-radius: <?php echo $smof_data['sellya_cc_redius'];?>px;
        -moz-border-radius: <?php echo $smof_data['sellya_cc_redius'];?>px;
        -khtml-border-radius: <?php echo $smof_data['sellya_cc_redius'];?>px;
        border-radius: <?php echo $smof_data['sellya_cc_redius'];?>px; 
	<?php endif;?>
    
    <?php if (isset($smof_data['sellya_ccsep_size']) and $smof_data['sellya_ccsep_size'] != 0) :?>
    
    border: <?php echo $smof_data['sellya_ccsep_size']?>px <?php echo $smof_data['sellya_ccsep_style']?> <?php echo $smof_data['sellya_ccsep_color']?>;
    
    <?php endif;?>    
       
    <?php if ($smof_data['sellya_ccbox_shadow']!='0') : ?>
        box-shadow: 0 1px 3px rgba(0,0,0,0.3); -webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.3); -moz-box-shadow: 0 1px 3px rgba(0,0,0,0.3); 
	<?php endif;?>
        
        
}

.product-list > div + div, .product-list > div + div.span-first-child, .pagination, .product-filter {
<?php if( isset($smof_data['sellya_ccsep_size'])):?>

    border-top: <?php echo $smof_data['sellya_ccsep_size'];?>px <?php echo $smof_data['sellya_ccsep_style'];?>
	<?php echo $smof_data['sellya_ccsep_color'];?>!important;	
<?php endif;?>
}
.product-filter, #content .l_column, #content .box .box-heading h2, .bestseller h2, .featured h2, .latest h2, .special h2 {
	
    <?php if(isset($smof_data['sellya_ccsep_size'])):?>

    border-bottom:<?php echo $smof_data['sellya_ccsep_size'];?>px <?php echo $smof_data['sellya_ccsep_style'];?>
	<?php echo $smof_data['sellya_ccsep_color'];?>!important;
    <?php endif;?>
    	
}
.product-compare, .box-category-home > div.span2, .box-category-home > div.span3 {

 <?php if(isset($smof_data['sellya_ccsep_style'])):?>
     border-left:1px <?php echo $smof_data['sellya_ccsep_style'];?>
	<?php echo $smof_data['sellya_ccsep_color'];?>;
 <?php endif;?>
    
}




.product-info .left .image, .product-info .image-additional img { 

<?php if(isset($smof_data['sellya_ccsep_style'])):?>

	border: 1px <?php echo $smof_data['sellya_ccsep_style'];?> <?php echo $smof_data['sellya_ccsep_color'];?>;

<?php endif;?>

}
.product-manufacturer-logo-block, .product-related, .product-custom-block, .product-share, .right-sm-tags {

<?php if(isset($smof_data['sellya_ccsep_style'])){?>

    border-bottom: 1px <?php echo $smof_data['sellya_ccsep_style'];?> <?php echo $smof_data['sellya_ccsep_color'];?>;
    
<?php }?>  

}
.product-manufacturer-logo-block, .product-related > div + div { 
<?php if( isset( $smof_data['sellya_ccsep_style'])){?>

	border-top: 1px <?php echo $smof_data['sellya_ccsep_style'];?> <?php echo $smof_data['sellya_ccsep_color'];?>;
<?php }?>
}
@media screen and (max-width: 767px) {
.product-compare { border-left: none;}
}
.box-category-home > div.span-first-child { border: none;}
.box-manufacturers-home > div.span2, .box-manufacturers-home > div.span3 {

<?php if(isset($smof_data['sellya_ccsep_style'])){?>
       border-top: 1px <?php echo $smof_data['sellya_ccsep_style'];?> <?php echo $smof_data['sellya_ccsep_color'];?>;
	border-bottom: 1px <?php echo $smof_data['sellya_ccsep_style'];?> <?php echo $smof_data['sellya_ccsep_color'];?>;	
	border-right: 1px <?php echo $smof_data['sellya_ccsep_style'];?> <?php echo $smof_data['sellya_ccsep_color'];?>;	
<?php }?>
}
.box-manufacturers-home > div.span-first-child {
<?php if(isset($smof_data['sellya_ccsep_style'])){?>

    border: 1px <?php echo $smof_data['sellya_ccsep_style'];?> <?php echo $smof_data['sellya_ccsep_color'];?>;
    
<?php } ?>
}


 <?php if ($smof_data['sellya_ccbg_status']=='1') : ?>
#content-home .span { width: 900px;margin-left: 20px;}
.box-product > div { width: 200px!important;}
.box-product > div > div.pbox, .es-carousel ul li div.pbox { padding: 5px 4px 10px;}
.es-carousel-banners ul li { margin: 5px 19px 20px 0!important;}
@media (max-width: 767px) {
#content-home { float: left;width: 100%;}
#content-home .span { width: auto;max-width: 100%;margin-left: 10px;margin-right: 10px;clear: both;}
.es-carousel-wrapper, .es-carousel-banners { max-width: 258px;}
.es-carousel ul li { margin-right: 0!important;}
}
@media (min-width: 768px) and (max-width: 979px) {
#content-home .span { width: 705px;margin-left: 10px;}
.box-product .span3 { margin-left: 13px;}
.es-carousel ul li { margin-right: 12px!important;}
} <?php endif;?>




/******************************************************/
/*  COLORS AND STYLES > Prices
/******************************************************/

.price, .total, span.amount { color: <?php echo $smof_data['sellya_price_color'];?>;}
.price-old , .wishlist-info tbody .price s { color: <?php echo $smof_data['sellya_oprice_color'];?>!important;}
.price-new { color: <?php echo $smof_data['sellya_nprice_color'];?>!important;}



/******************************************************/
/*  COLORS AND STYLES > Buttons
/******************************************************/

.woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit, .woocommerce #content input.button, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce-page #respond input#submit, .woocommerce-page #content input.button ,a.button, input.button {
	background: <?php echo $smof_data['sellya_btnbg_color'];?>;
	border-color:  <?php echo $smof_data['sellya_btntopbor_color'];?> <?php echo $smof_data['sellya_btnbuttom_color'];?> <?php echo $smof_data['sellya_btnbuttom_color'];?> <?php echo $smof_data['sellya_btntopbor_color'];?>;
	color:<?php echo $smof_data['sellya_btntext_color'];?>!important;
    font-weight: <?php echo $smof_data['sellya_buttonf_weight']?>;    
    padding-top:8px;
    padding-bottom:8px;
    transition:ease-in 0.2s all;
    box-shadow:none;
    height: auto;
    display:inline-block;
    <?php if($smof_data['sellya_buttonf_transform'] != 0):?>
    text-transform: uppercase;
    <?php else:?>
    text-transform: none;
    
    <?php endif;?>
   <?php if($smof_data['sellya_btntext_shadow'] != '0'):?>     
    text-shadow:0 1px 0 rgba(255, 255, 255, 0.8);   
   <?php else:?>
   text-shadow: none;
   <?php endif;?>
   
   <?php if($smof_data['sellya_btnborder_radius'] != '0'):?>
		-webkit-border-radius: <?php echo $smof_data['sellya_btnborder_radius'];?>px;
        -moz-border-radius: <?php echo $smof_data['sellya_btnborder_radius'];?>px;
        -khtml-border-radius: <?php echo $smof_data['sellya_btnborder_radius'];?>px;
        border-radius: <?php echo $smof_data['sellya_btnborder_radius'];?>px;    
   
   <?php endif;?>
}
.woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce #content input.button:hover, .woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover, .woocommerce-page #respond input#submit:hover, .woocommerce-page #content input.button:hover ,a.button:hover, input.button:hover, .ei-title h4 a.button:hover {
	background-image:none;
	background-color: <?php echo $smof_data['sellya_btnbghover_color'];?>;
	border-color:<?php echo $smof_data['sellya_btntopo_color'];?> <?php echo $smof_data['sellya_btnbottomo_color'];?> <?php echo $smof_data['sellya_btnbottomo_color'];?> <?php echo $smof_data['sellya_btntopo_color'];?>;
	color: <?php echo $smof_data['sellya_btntext_color'];?>!important;	
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2) inset;
    
}
a.button-exclusive, input.button-exclusive{
	background-color:<?php echo $smof_data['sellya_ebtnbg_color'];?>;

	color: <?php echo $smof_data['sellya_ebtntext_color'];?>!important;
}
a.button-exclusive:hover, input.button-exclusive:hover {
	background-color:<?php echo $smof_data['sellya_ebtnbgover_color'];?>;
	
	color: <?php echo $smof_data['sellya_ebtntext_color'];?>!important;
}
a.button, input.button, a.button-exclusive, input.button-exclusive {
        
         <?php if ($smof_data['sellya_btnborder_radius']!='') :?>
         border-radius: <?php echo $smof_data['sellya_btnborder_radius'];?>px;
	-webkit-border-radius: <?php echo $smof_data['sellya_btnborder_radius'];?>px;
	-moz-border-radius: <?php echo $smof_data['sellya_btnborder_radius'];?>px;
	-khtml-border-radius: <?php echo $smof_data['sellya_btnborder_radius'];?>px; <?php endif;?>
}
.woocommerce-page #content button.single_add_to_cart_button {
	background:none <?php echo $smof_data['sellya_ebtnbg_color'];?> no-repeat !important;
	border-color: <?php echo $smof_data['sellya_ebtnbortop_color'];?> !important;
	color: <?php echo $smof_data['sellya_ebtntext_color'];?>!important;
        text-transform:uppercase;
        padding:8px;
}
.woocommerce-page #content button.single_add_to_cart_button:hover {
	background:<?php echo $smof_data['sellya_ebtnbgover_color'];?> !important;
	border-color: <?php echo $smof_data['sellya_ebtntopo_color'];?> !important;
	color: <?php echo $smof_data['sellya_ebtntext_color'];?>!important;
}

 <?php if ($smof_data['sellya_btntext_shadow']!='') :?>
    a.button, input.button, a.button-exclusive, input.button-exclusive {
            text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.2);
    } <?php endif;?>






/******************************************************/
/*  COLORS AND STYLES > Top Area
/******************************************************/

/*  Top Area background color and pattern  */
#header {
	<?php if ($smof_data['sellya_topbg_status']=='1') : ?>
    background-color: <?php echo $smof_data['sellya_topareabg_color'];?>!important; <?php endif;?>
    <?php if ($smof_data['sellya_show_bg_image_ta_custom']!='0' ) :?>
      background-image: url("<?php echo $smof_data['sellya_bg_image_ta_custom'];?>"); 
	<?php else : ?>
      background-image: url("<?php echo $smof_data['sellya_topa_bg'];?>"); 
	<?php endif;?>
    background-position: <?php echo $smof_data['sellya_topabg_position'];?>!important;
    background-repeat: <?php echo $smof_data['sellya_topabg_repeat'];?>!important;
    background-attachment: <?php echo $smof_data['sellya_topabg_attach'];?>!important;
}

/*  Logo  <?php echo $smof_data['sellya_logo_position'].$smof_data['sellya_search_position']?>*/
 <?php if ($smof_data['sellya_logo_position']=='left') :?>	
	#t-header #logo { margin-left: 25px;} 
<?php endif;?>


<?php 
if($smof_data['sellya_top_search_status'] != 0):
?>

<?php if( ($smof_data['sellya_logo_position']=='left') && ($smof_data['sellya_search_position']=='left')) :?>	
#t-header { min-height: 150px;}
#t-header #logo { padding-top: 30px;}
#t-header #search { top: 112px;left: 0;width: 280px;} 
<?php endif;?>  
<?php if (($smof_data['sellya_logo_position']=='left') && ($smof_data['sellya_search_position']=='center')):?>
#t-header { min-height: 115px;}
#t-header #search { top: 50px;right: 320px;width: 300px;} 
<?php endif;?>
<?php if (($smof_data['sellya_logo_position']=='left') && ($smof_data['sellya_search_position']=='right')) :?>
#t-header { min-height: 150px;}
#t-header #search { top: 112px;right: 3px;width: 300px;} 
<?php endif;?>

<?php if (($smof_data['sellya_logo_position']=='center') && ($smof_data['sellya_search_position']=='left')):?>	
#t-header { min-height: 115px;} 
#t-header #logo { padding-top: 30px;text-align: center; margin-left: auto; margin-right: auto;}
#t-header #search { top: 47px;left: 0;width: 280px;} <?php endif;?>   
<?php if (($smof_data['sellya_logo_position']=='center') && ($smof_data['sellya_search_position']=='center')):?>	   
#t-header { min-height: 145px;}
#t-header #logo { padding-top: 25px;text-align: center; margin-left: auto; margin-right: auto;}

#t-header #search { right: 320px;top: 100px;width: 300px;} <?php endif;?> 
<?php if (($smof_data['sellya_logo_position']=='center') && ($smof_data['sellya_search_position']=='right')):?>	
#t-header { min-height: 150px;}    
#t-header #logo { padding-top: 45px;text-align: center;margin-left: auto; margin-right: auto;}
#t-header #search { top: 112px;right: 3px;width: 300px;} <?php endif;?> 
@media (max-width: 767px) {
#t-header #logo { margin-left: inherit;}
#t-header #search { top: 5px;right: inherit;width: 276px}
}

<?php
else:
?>

<?php if ($smof_data['sellya_logo_position']=='center'):?>	

#t-header #logo { padding-top: 30px;text-align: center; margin-left: auto; margin-right: auto;}

<?php endif;?> 
@media (max-width: 767px) {
	#t-header #logo { margin-left: inherit;}
}

<?php 
endif; //if($smof_data['sellya_top_search_status'] != 0)
?>


@media (min-width: 768px) and (max-width: 979px) {
 <?php if (($smof_data['sellya_logo_position']=='left') && ($smof_data['sellya_search_position']=='left')):?>	   
#t-header .links a + a { margin-left: 7px;padding-left: 7px}
#t-header #search { right: 270px;width: 200px;} <?php endif;?>
 <?php if (($smof_data['sellya_logo_position']=='left') && ($smof_data['sellya_search_position']=='center')):?>	   
#t-header .links a + a { margin-left: 7px;padding-left: 7px}
#t-header #search { right: 270px;width: 200px;} <?php endif;?>
 <?php if (($smof_data['sellya_logo_position']=='left') && ($smof_data['sellya_search_position']=='right')):?>	   
#t-header .links a + a { margin-left: 7px;padding-left: 7px}
#t-header #search { width: 200px;} <?php endif;?>
 <?php if (($smof_data['sellya_logo_position']=='center') && ($smof_data['sellya_search_position']=='left')):?>	   
#t-header .links a + a { margin-left: 7px;padding-left: 7px}
#t-header #logo { margin-left: 207px;}
#t-header #search { top: 47px;left: 0;width: 200px;} <?php endif;?>
 <?php if (($smof_data['sellya_logo_position']=='center') && ($smof_data['sellya_search_position']=='center')):?>	   
#t-header .links a + a { margin-left: 7px;padding-left: 7px}
#t-header #logo { margin-left: 207px;}
#t-header #search { right: 234px;top: 100px;width: 260px;} <?php endif;?>
 <?php if (($smof_data['sellya_logo_position']=='center') && ($smof_data['sellya_search_position']=='right')):?>	   
#t-header .links a + a { margin-left: 7px;padding-left: 7px}
#t-header #logo { margin-left: 207px;}
#t-header #search { top: 112px;right: 3px;width: 200px;} <?php endif;?>

}



/*  Search Bar  */
 <?php if ($smof_data['sellya_search_style']=='search2' ) :?>
#t-header .button-search {
	right: 1px;
	top: 1px;
	background: url('image/button-search2.png') center center no-repeat;
	width: 34px;
	height: 28px;
	border-left: 1px solid #DFDFDF;
}
@media (max-width: 767px) {
#t-header .button-search { right: -1px;top: 8px;}
}
@media (min-width: 768px) and (max-width: 979px) {
#t-header .button-search { right: -3px;}	
} <?php endif;?>
 <?php if ($smof_data['sellya_search_style']=='search3' ) :?>
#t-header .button-search {
	right: 3px;
	top: 3px;
	background: url('image/button-search3.png') center center no-repeat <?php echo $smof_data['sellya_searchbtn_color'];?>;
	width: 24px;
	height: 24px;
	border-left: none;
	border-radius: 30px;
}
#t-header #search input { border-radius: 28px;}

@media (max-width: 767px) {
#t-header .button-search { right: 2px;top: 10px;}
}
@media (min-width: 768px) and (max-width: 979px) {
#t-header .button-search { right: 1px;}	
} <?php endif;?>
    
    
#t-header #search input { 
   <?php if (($smof_data['sellya_searchf_wieight']) && ($smof_data['sellya_searchf_size'])):?>
        font-size: <?php echo $smof_data['sellya_searchf_size'];?>px;
        font-weight:<?php echo $smof_data['sellya_searchf_wieight'];?>; <?php endif;?>
     <?php if ($smof_data['sellya_searchf_transform']):?>
        text-transform: <?php echo $smof_data['sellya_searchf_transform'];?>; <?php endif;?>
}


#t-header #search input { border-color:  <?php echo $smof_data['sellya_searchbor_color'];?>;}

/*  Links Section  */
#t-header .links li {border-left: 1px solid <?php echo $smof_data['sellya_linksepa_color']?>;}
#t-header .links a { color: <?php echo $smof_data['sellya_link_color'];?>;}
#t-header .links a:hover { color: <?php echo $smof_data['sellya_linkover_color'];?>!important;}
#t-header .links a + a { border-left: 1px solid <?php echo $smof_data['sellya_linksepa_color'];?>;}



/*  Cart Section  */
#t-header #cart .heading a span#cart-total, #t-header #cart .heading a span#cart-total span.amount { 
	color: <?php echo $smof_data['sellya_cartlink_color'];?> !important;
    font-size: <?php echo $smof_data['sellya_cartf_size'];?>px !important;
    font-weight: <?php echo $smof_data['sellya_cartf_weight'];?> !important;
    <?php if (($smof_data['sellya_cartf_transform']!='0')):?>
    text-transform: uppercase;
    <?php endif;?>    
}


#t-header #cart.active .heading a span#cart-total, #t-header #cart.active .heading a span#cart-total span.amount, #t-header #cart .heading a span#cart-total:hover, #t-header #cart .heading a span#cart-total:hover span.amount { color: <?php echo $smof_data['sellya_cartlinko_color'];?>!important;}

 <?php if ($smof_data['sellya_cart_icon']==1) : ?>
#t-header #cart .heading a #cart-total {
    background: url('<?php echo get_template_directory_uri()?>/image/icon_cart_<?php echo $smof_data['sellya_carticon_style'];?>.png') 96% 50% no-repeat;
    padding: 10px 40px 10px 0;
} <?php endif;?>
/*  Language/Currency Section  */


/*  Dropdowns  */
.dropdown_l ul, #t-header #cart .content {
	background: <?php echo $smof_data['sellya_subsbg_color'];?>;
	border-top: 3px solid <?php echo $smof_data['sellya_subsbar_color'];?>;
}






/******************************************************/
/*  COLORS AND STYLES > Main Menu
/******************************************************/

/*  Main Menu Bar   */
#menu {
	<?php if ($smof_data['sellya_mainmenu_status']==1) : ?>
    background-color: <?php echo $smof_data['sellya_mainmbg_color'];?>!important; <?php endif;?>
    <?php if (($smof_data['sellya_mmtopbor_status']==1) && ($smof_data['sellya_mainmtopb_color'])) :?>
    border-top: 2px <?php echo $smof_data['sellya_mainmtop_style'];?> <?php echo $smof_data['sellya_mainmtopb_color'];?>!important; <?php endif;?>
    <?php if (($smof_data['sellya_mmbtmbor_status']==1) && ($smof_data['sellya_mainmtopb_color'])) :?>
    border-bottom: 2px <?php echo $smof_data['sellya_mainbbuttom_style'];?> <?php echo $smof_data['sellya_mainbbuttom_color'];?>!important; <?php endif;?>  
    <?php if ($smof_data['sellya_show_bg_image_mm_thumb'] != 0) :?>
      background-image: url("<?php echo $smof_data['sellya_bg_image_mm_thumb'];?>"); 
	<?php else : ?>
      background-image: url("<?php echo $smof_data['sellya_mainm_bg'];?>"); 
	<?php endif;?>
    <?php if ($smof_data['sellya_mainmbg_repeat']!='') :?>
    background-repeat: <?php echo $smof_data['sellya_mainmbg_repeat'];?>!important; <?php endif;?>
    <?php if ($smof_data['sellya_mainbbuttom_shadow']!='0') :?>
    box-shadow: 0 1px 3px rgba(0,0,0,0.3); -webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.3); -moz-box-shadow: 0 1px 3px rgba(0,0,0,0.3); <?php endif;?>
    <?php if ($smof_data['sellya_mainbbuttom_radius']!='') :?>
    border-radius: <?php echo $smof_data['sellya_mainbbuttom_radius'];?>px;
    -webkit-border-radius: <?php echo $smof_data['sellya_mainbbuttom_radius'];?>px;
    -moz-border-radius: <?php echo $smof_data['sellya_mainbbuttom_radius'];?>px;
    -khtml-border-radius: <?php echo $smof_data['sellya_mainbbuttom_radius'];?>px; <?php endif;?>
}
@media (min-width: 768px) and (max-width: 979px) {
#menu {
       <?php if ($smof_data['sellya_mainm_bg']!='') :?>
          background-image: url("<?php echo $smof_data['sellya_mainm_bg'];?>"); <?php else : ?>
          background-image: none; <?php endif;?>
       <?php if ($smof_data['sellya_mainmbg_repeat']!='') : ?>
      background-repeat: <?php echo $smof_data['sellya_mainmbg_repeat'];?>!important; <?php endif;?>
     
}
}
  

#menu_oc > ul > li > a, #menu-category-wall > ul > li > a, #menu > ul > li > span, #menu > ul > li > a, #menu_brands > ul > li > a, .menu_links a, #menu_informations > ul > li > a, #menu_your_account > ul > li > span, #menu_custom_block > ul > li > a, #menu_contacts > ul > li > a, #menu #homepage a, .navbar .brand { 
    <?php if ($smof_data['sellya_mmf_size']!='') :?>
        font-size: <?php echo $smof_data['sellya_mmf_size'];?>px!important; <?php endif;?> 
    <?php if ($smof_data['sellya_mmf_weight']!='') :?>
        font-weight: <?php echo $smof_data['sellya_mmf_weight'];?>!important; <?php endif;?> 
    
     <?php if ($smof_data['sellya_mmf_transform']!='') :?>
    text-transform: <?php echo $smof_data['sellya_mmf_transform'];?>; <?php endif;?> 
}


#menu ul.nav > li > a, #menu div.nav > ul > li > a{
	font-size: <?php echo $smof_data['sellya_mmf_size']?>px;
    font-weight: <?php echo $smof_data['sellya_mmf_weight']?> !important;
    <?php if($smof_data['sellya_mmf_transform']):?>    
    text-transform: uppercase;    
    <?php else:?>
	text-transform: none;    
    <?php endif;?>
    <?php if($smof_data['sellya_mm_fonts']!=''):?>    
    font-family: <?php echo urldecode($smof_data['sellya_mm_fonts'])?>,Arial,Helvetica,sans-serif !important;    
    <?php endif;?>
    
    <?php if($smof_data['sellya_mainmitembg_color']!=''):?>
    
    	background-color: <?php echo $smof_data['sellya_mainmitembg_color']?> !important;
    
    <?php endif;?>
   	color: <?php echo $smof_data['sellya_mainmitemtext_color']?> !important;
    
}

#menu ul.nav > li:hover > a{
	
    background-color: <?php echo ($smof_data['sellya_mainmitemhoverbg_color'] != '')?$smof_data['sellya_mainmitemhoverbg_color']:'transparent'?> !important;
    
    color: <?php echo $smof_data['sellya_mainmitemhovertext_color']?> !important;

}

#menu ul.nav li.current-menu-item > a{
	
    background-color: <?php echo $smof_data['sellya_mainmactiveitembg_color']?$smof_data['sellya_mainmactiveitembg_color']:'transparent'?>;
    
    color: <?php echo $smof_data['sellya_mainmactiveitemtext_color']?> !important;
    
}



/*  Sub-Menu  <?php echo gettype($smof_data['sellya_smenusep_shadow'])?>*/
#menu ul.sub-menu {
	background-color: <?php echo $smof_data['sellya_smenubg_color'];?>;
    <?php if($smof_data['sellya_smenusep_shadow'] != 0):?>    
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3) !important;    
    <?php endif;?>
    <?php if($smof_data['sellya_smenusep_color'] != ''):?>
    border-top: 2px <?php echo $smof_data['sellya_smenusep_style']?> <?php echo $smof_data['sellya_smenusep_color']?>;
    <?php endif;?>    
}
<?php if($smof_data['sellya_mmileftbor_status'] == 1):?>
#menu ul.nav li {
    border-left: <?php echo $smof_data['sellya_mmileftbor_size']?>px <?php echo $smof_data['sellya_mmileftbor_style']?> <?php echo $smof_data['sellya_mmileftbor_color']?>;
}
#menu ul.nav li:first-child,#menu ul.nav li ul.sub-menu li{
    border-left:none;
}
<?php endif;?>
#menu ul.nav li.salleyamega ul.sub-menu li > ul.sub-menu{
	background-color: transparent !important;
}

#menu ul.nav li ul.sub-menu li a {
	color: <?php echo $smof_data['sellya_smenulink_color'];?>!important;
}	
#menu ul.nav li ul.sub-menu li a:hover, 
#menu ul.nav li .menu-category-wall-sub-name a:hover {
	color: <?php echo $smof_data['sellya_smenulinko_color'];?>!important;
}
#menu ul.nav li ul.sub-menu li.current-menu-item a:hover,
#menu ul.nav li ul.sub-menu li a:hover,
div.menu-category-wall-sub-name,
div.menu-category-wall-sub-name + div > ul > li:hover{
    background:<?php echo $smof_data['sellya_smenulink_hover_bg_color'];?>;
}


#menu_brands > ul > li > div > div {
	border-left: 1px <?php echo $smof_data['sellya_smenusep_style'];?> <?php echo $smof_data['sellya_smenusep_color'];?>;
}
#menu-category-wall > ul > li > div > div.span-first-child,
#menu_brands > ul > li > div > div.span-first-child { 
    border-left: medium none;
}


<?php if ($smof_data['sellya_smenusep_shadow']==1) : ?>
#menu > ul > li > div, #menu-category-wall > ul > li > div, #menu > ul > li > div > ul > li > div, #menu_oc > ul > li > div, #menu_brands > ul > li > div, #menu_informations > ul > li > div, #menu_your_account > ul > li > div, #menu_custom_block > ul > li > div, #menu_contacts > ul > li > div {
	box-shadow: 0 5px 10px rgba(0,0,0,0.3)!important; -webkit-box-shadow: 0 5px 10px rgba(0,0,0,0.3)!important; -moz-box-shadow: 0 5px 10px rgba(0,0,0,0.3)!important;
} <?php endif;?>

/******************************************************/
/*  COLORS AND STYLES > Midsection
/******************************************************/

/*  Product Box  */

.woocommerce span.onsale, .woocommerce-page span.onsale{
/*<?php echo $smof_data['sellya_proboxicon_color']?>*/
	<?php if($smof_data['sellya_proboxicon_color'] != ''):?>
    
    background: <?php echo $smof_data['sellya_proboxicon_color']?>;
    
    <?php endif;?>
}



.products-slider ul li,
.product-grid > div > ul > li,
.box-product > .span3,
.es-carousel ul li,
.product-grid > div,
.product-grid ul li {
	background-color: <?php echo $smof_data['sellya_proboxbg_color'];?>!important;
}

.products-slider ul li:hover,.box-product > .span3:hover,
.es-carousel ul li:hover, 
.product-grid > div > ul > li:hover,
.product-grid > ul > li:hover,
.product-grid > div:hover {
	background-color: <?php echo $smof_data['sellya_proboxbgo_color'];?>!important;
}
.product-grid > div.woocommerce:hover{
    background:none !important;
}


.products-slider ul li div.pbox,
.box-product > .span3 > div.pbox,
.es-carousel ul li div.pbox,
.product-grid > div > div.pbox,
.product-grid > ul > li > div.pbox,
.product-grid > div > ul > li > div.pbox{
    border: 1px solid <?php echo $smof_data['sellya_proboxbor_color'];?>!important;
}

.products-slider ul li div.pbox:hover,
.box-product > .span3 > div.pbox:hover,
.es-carousel ul li div.pbox:hover,
.product-grid > div > ul > li > div.pbox:hover,
.product-grid > ul > li > div.pbox:hover {
    border: 1px solid <?php echo $smof_data['sellya_proboxboro_color'];?>!important;
}

.products-slider ul li,
.box-product > .span3, .es-carousel ul li, 
.product-grid > div, 
.box-product > .span3 > div.pbox,
.es-carousel ul li div.pbox,
.product-grid > ul > li > div.pbox,
.product-grid > div > ul > li > div.pbox{
	-webkit-border-radius: <?php echo $smof_data['sellya_probox_radius'];?>px;
	-moz-border-radius: <?php echo $smof_data['sellya_probox_radius'];?>px;
	-khtml-border-radius: <?php echo $smof_data['sellya_probox_radius'];?>px;
	border-radius: <?php echo $smof_data['sellya_probox_radius'];?>px;
}
span.sale-icon {
	background-color: <?php echo $smof_data['sellya_proboxicon_color'];?>!important;
}

/*  Product Page - Buy Section  */
.product-info .buy {
    background-color: <?php echo $smof_data['sellya_probuybg_color'];?>;
	-webkit-border-radius: <?php echo $smof_data['sellya_probuysep_radius'];?>px;
	-moz-border-radius: <?php echo $smof_data['sellya_probuysep_radius'];?>px;
	-khtml-border-radius: <?php echo $smof_data['sellya_probuysep_radius'];?>px;
	border-radius: <?php echo $smof_data['sellya_probuysep_radius'];?>px;
    border: <?php echo $smof_data['sellya_probuysep_size']?>px <?php echo $smof_data['sellya_probuysep_style']?> <?php echo $smof_data['sellya_probuysep_color']?>;  
}
.product-info .description, .product-info .options, .product-info .review {
	

    border-top: <?php echo $smof_data['sellya_probuysep_size'];?>px <?php echo $smof_data['sellya_probuysep_style'];?> <?php echo $smof_data['sellya_probuysep_color'];?>!important;	
}

/*  Product Page - Tabs  */

.woocommerce div.product .woocommerce-tabs ul.tabs li.active a, .woocommerce #content div.product .woocommerce-tabs ul.tabs li.active a, .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active a, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active a,.woocommerce-tabs div#tab-description, .woocommerce-tabs div#tab-reviews, .woocommerce-tabs div#tab-custom, .woocommerce-tabs div#tab-attributes, .woocommerce-tabs div#tab-additional_information{
	background: <?php echo $smof_data['sellya_ppagebg_color']?>;
}

.htabs { border-bottom: 10px solid <?php echo $smof_data['sellya_ppagebg_color'];?>;}
.htabs a {
	border-top: 1px solid <?php echo $smof_data['sellya_ppagebg_color'];?>;
	border-left: 1px solid <?php echo $smof_data['sellya_ppagebg_color'];?>;
	border-right: 1px solid <?php echo $smof_data['sellya_ppagebg_color'];?>;	
}
.htabs a.selected { background: <?php echo $smof_data['sellya_ppagebg_color'];?>;}
.tab-content {
	border-bottom: 10px solid <?php echo $smof_data['sellya_ppagebg_color'];?>;
	border-left: 10px solid <?php echo $smof_data['sellya_ppagebg_color'];?>;
	border-right: 10px solid <?php echo $smof_data['sellya_ppagebg_color'];?>;	
}

/*  Product Slider on Home Page  */
.ei-slider {
    
	background-color: <?php echo $smof_data['sellya_psliderbg_color'];?>;
	
}
@media screen and (max-width: 767px) {
.ei-slider{ background-image: none;background-color: #FFFFFF;}
}
.ei-title h2 a{ color: <?php echo $smof_data['sellya_proname_color'];?>;}
.ei-title h3 a{ color: <?php echo $smof_data['sellya_prodesc_color'];?>;}
.ei-title h4 .price, .ei-title h4 span.amount{ color: <?php echo $smof_data['sellya_proprice_color'];?>;}
.ei-title h2 a:hover, .ei-title h3 a:hover, .ei-title h4 a:hover, .ei-slider-thumbs li a:hover{ color:<?php echo $smof_data['sellya_prolinkso_color'];?>!important;}
.ei-slider-thumbs li a{ background: <?php echo $smof_data['sellya_probuttombg_color'];?>; color: <?php echo $smof_data['sellya_probottomlink_color'];?>;}
.ei-slider-thumbs li a:hover{ background: <?php echo $smof_data['sellya_probottombgo_color'];?>;}
.ei-slider-thumbs li.ei-slider-element{ background: <?php echo $smof_data['sellya_probottomsmall_color'];?>;}


/******************************************************/
/*  COLORS AND STYLES > Bottom Area
/******************************************************/

/*  Contact Us, Twitter, Custom Column  */
#footer_cnc {
     <?php if ($smof_data['sellya_f1bg_color'] ): ?>
	background-color: <?php echo $smof_data['sellya_f1bg_color'];?>; <?php endif;?>
     <?php if ($smof_data['sellya_show_bg_image_f1_thumb'] != 0):?>
    background-image: url("<?php echo $smof_data['sellya_bg_image_f1_thumb'];?>"); 
	<?php else : ?>
	background-image: url("<?php echo $smof_data['sellya_pattern_sellya_f1'];?>"); 
	<?php endif;?>
	background-position: <?php echo $smof_data['sellya_bg_image_f1_position'];?>;
	background-repeat: <?php echo $smof_data['sellya_bg_image_f1_repeat'];?>;
        
     <?php if (($smof_data['sellya_f1topbor_status'])!= '0'): ?>    
	border-top: <?php echo $smof_data['sellya_f1topborder_size'];?>px <?php echo $smof_data['sellya_f1topborder_style'];?> <?php echo $smof_data['sellya_f1topborder_color'];?>; 
	<?php endif;?>
}
#footer_cnc h3 { 
	color: <?php echo $smof_data['sellya_bottomatitle_color'];?>!important; 
	border-bottom: <?php echo $smof_data['sellya_f1btmborder_size'];?>px <?php echo $smof_data['sellya_f1btmborder_style'];?> <?php echo $smof_data['sellya_f1btmborder_color'];?>!important;
}
#footer_cnc_content, #footer_cnc_content span { color: <?php echo $smof_data['sellya_f1text_color'];?>!important;}
#footer_cnc a,#footer_cnc .span4 div.contacts span a { color:  <?php echo $smof_data['sellya_f1linkscolor'];?>!important;}
#footer_cnc a:hover, #footer_cnc .twitter a:hover { color: <?php echo $smof_data['sellya_f1linkso_color'];?>!important;}
#footer_cnc .twitter a { color: <?php echo $smof_data['sellya_f1light_color'];?>!important;}




/*  Information, Customer Service, Extras, My Account  */
#footer_info {
	<?php if ($smof_data['sellya_f2bg_color']!=''):?>
    background-color:  <?php echo $smof_data['sellya_f2bg_color'];?>;
	<?php endif;?>
    <?php if ($smof_data['sellya_show_bg_image_f2_thumb'] != 0):?>
    background-image: url("<?php echo $smof_data['sellya_bg_image_f2_thumb'];?>"); 
	<?php else : ?>
    background-image: url("<?php echo $smof_data['sellya_pattern_sellya_f2'];?>"); 
	<?php endif;?>
    background-position: <?php echo $smof_data['sellya_bg_image_f2_position'];?>;
    background-repeat: <?php echo $smof_data['sellya_bg_image_f2_repeat'];?>;
    <?php if ($smof_data['sellya_f2bg_status'] != '0') : ?>
    border-top: <?php echo $smof_data['sellya_f2border_size'];?>px <?php echo $smof_data['sellya_f2border_style'];?> <?php echo $smof_data['sellya_f2border_color'];?> 
    <?php endif;?>
}


#footer_info h3 { 
	color: <?php echo $smof_data['sellya_f2titles_color'];?>!important; 
	border-bottom: <?php echo $smof_data['sellya_f2_title_border_size']?>px <?php echo $smof_data['sellya_f2_title_border_style']?> <?php echo $smof_data['sellya_f2_title_border_color'];?>!important;
}
#footer_info a { color: <?php echo $smof_data['sellya_f2link_color'];?>!important;}
#footer_info a:hover { color: <?php echo $smof_data['sellya_f2linko_color'];?>!important;}

/*  Footer - Payment Images, Powered by, Follow Us  */
#footer_cr {
   
	<?php if ($smof_data['sellya_f4bg_color']!=''):?>
    background-color: <?php echo $smof_data['sellya_f4bg_color'];?>; 
	<?php endif;?>     
    <?php if ($smof_data['sellya_show_bg_image_f4_thumb'] != 0):?>
    background-image: url("<?php echo $smof_data['sellya_bg_image_f4_thumb'];?>"); 
    <?php else : ?>
    background-image: url("<?php echo $smof_data['sellya_pattern_sellya_f4'];?>");     
    <?php endif;?>
    
    background-position: <?php echo $smof_data['sellya_bg_image_f4_position'];?>;
    background-repeat: <?php echo $smof_data['sellya_bg_image_f4_repeat'];?>;
    color: <?php echo $smof_data['sellya_f4text_color'];?>!important;
    
    <?php if ($smof_data['sellya_f4border_status'] != '0') : ?>
    border-top: <?php echo $smof_data['sellya_f4border_size'];?>px <?php echo $smof_data['sellya_f4border_style'];?> <?php echo $smof_data['sellya_f4border_color'];?>; 
    <?php endif;?>
}
#footer_cr a { color: <?php echo $smof_data['sellya_f4link_color'];?>!important;}
#footer_cr a:hover { color: <?php echo $smof_data['sellya_f4linko_color'];?>!important;}
#footer_cr span { color: <?php echo $smof_data['sellya_f4text_color'];?>!important;}

/*  About Us  */
#footer_about {
	<?php if ($smof_data['sellya_f5bg_color']!=''):?>
    background-color: <?php echo $smof_data['sellya_f5bg_color'];?>; 
	<?php endif;?>
    <?php if ($smof_data['sellya_show_bg_image_f5_thumb'] != 0):?>
    background-image: url("<?php echo $smof_data['sellya_bg_image_f5_thumb'];?>"); 
	<?php else : ?>
    background-image: url("<?php echo $smof_data['sellya_pattern_sellya_f5'];?>");
	<?php endif;?>
    background-position: <?php echo $smof_data['sellya_bg_image_f5_position'];?>;
    background-repeat: <?php echo $smof_data['sellya_bg_image_f5_repeat'];?>;
    <?php if ($smof_data['sellya_f5border_status'] != 0) : ?>
    border-top: <?php echo $smof_data['sellya_f5border_size'];?>px <?php echo $smof_data['sellya_f5border_style'];?> <?php echo $smof_data['sellya_f5border_color'];?>; 
    <?php endif;?>
}
#footer_about { color: <?php echo $smof_data['sellya_f5title_color'];?>!important;}
#footer_about a { color: <?php echo $smof_data['sellya_f5link_color'];?>!important;}
#footer_about a:hover { color: <?php echo $smof_data['sellya_f5linko_color'];?>!important;}


/******************************************************/
/*  FONTS
/******************************************************/



<?php if ($smof_data['sellya_headings_fonts']!=''):?>
h1, h2, h3, h4, h5, h6, .welcome { 
    font-family: <?php echo urldecode($smof_data['sellya_headings_fonts'])?>,Arial,Helvetica,sans-serif !important; 
} 
<?php endif;?>


 <?php if ($smof_data['sellya_headings_wieight']!=''):?>
h1, h2, h3, h4, h5, h6, .welcome { 
    font-weight: <?php echo $smof_data['sellya_headings_wieight'];?>; 
} <?php endif;?>
 
h1, h2, h3, h4, h5, h6, .welcome { 
<?php if ($smof_data['sellya_headings_transform']==1) :?>
    text-transform: uppercase;
<?php else:?>
 	text-transform: none;
<?php endif;?>
 
}
.box .box-heading h2 {
    font-size: <?php echo $smof_data['sellya_heading_box_h1_f_size']?>px!important;
}
h1 {
    font-size: <?php echo $smof_data['sellya_heading_h1_f_size']?>px!important;
}
h2 {
    font-size:<?php echo $smof_data['sellya_heading_h2_f_size']?>px!important;
}
h3 {
    font-size: <?php echo $smof_data['sellya_heading_h3_f_size']?>px!important;
}
h4 {
    font-size: <?php echo $smof_data['sellya_heading_h4_f_size']?>px!important;
}
h5 {
    font-size: <?php echo $smof_data['sellya_heading_h5_f_size']?>px!important;
}
h6 {
    font-size: <?php echo $smof_data['sellya_heading_h6_f_size']?>px!important;
}
<?php if($smof_data['sellya_price_fonts']):?>
 
.price, .ei-title h4 a { 
    font-family: <?php echo urldecode($smof_data['sellya_price_fonts'])?>,Arial,Helvetica,sans-serif!important; 
}

<?php endif;?>

 <?php if ($smof_data['sellya_price_wieight']!=''):?>
.box-product .price, .box-product .price-new, .product-list .price, .product-grid .price, .product-info .price, .es-carousel .price { 
    font-weight: <?php echo $smof_data['sellya_price_wieight'];?>; 
} <?php endif;?>
.price del {
	<?php 	
	if($smof_data['sellya_oprice_color']):?>
    
    color: <?php echo $smof_data['sellya_oprice_color'];?> !important;
    
    <?php endif;?>
    font-size:12px;

}
.price ins {
	<?php 	
	if($smof_data['sellya_nprice_color']):?>
    
    color: <?php echo $smof_data['sellya_nprice_color'];?> !important;
    
    <?php endif;?>
    font-size:15px;
    text-decoration: none !important;

}
.product_list_widget li del {
	
    font-size:12px;

}
del span.amount{
	<?php 	
	if($smof_data['sellya_oprice_color']):?>
    
    	color: <?php echo $smof_data['sellya_oprice_color'];?>;
    
    <?php endif;?>
}
ins span.amount{
	<?php 	
	if($smof_data['sellya_nprice_color']):?>
    
    color: <?php echo $smof_data['sellya_nprice_color'];?>;
    
    <?php endif;?>
}
.product_list_widget li ins{
	
    font-size:12px;
    text-decoration: none !important;
}
#content div.product p.price, #content div.product p.price span.amount{
	font-size: <?php echo $smof_data['sellya_single_price_font_size'];?>px !important;
}

<?php if($smof_data['sellya_buttonf_fonts']):?>
a.button, input.button, a.button-exclusive, input.button-exclusive { 
    font-family: <?php echo urldecode($smof_data['sellya_buttonf_fonts'])?>,Arial,Helvetica,sans-serif !important; 
}
<?php endif;?>

 <?php if ($smof_data['sellya_buttonf_weight'] != ''):?>
a.button, input.button, a.button-exclusive, input.button-exclusive { 
    font-weight: <?php echo $smof_data['sellya_buttonf_weight'];?>; 
} <?php endif;?>
<?php if ($smof_data['sellya_buttonf_transform'] != 0):?>
a.button, input.button, a.button-exclusive, input.button-exclusive { 
    text-transform: uppercase;
} 
<?php endif;?>

<?php if($smof_data['sellya_search_fonts']):?>

#t-header #search input { 
    font-family: <?php echo urldecode($smof_data['sellya_search_fonts'])?>,Arial,Helvetica,sans-serif !important; 
}
   
<?php endif;?>

#menu_oc > ul > li > a, #menu-category-wall > ul > li > a, #menu > ul > li > span, #menu > ul > li > a, #menu_brands > ul > li > a, .menu_links a, #menu_informations > ul > li > a, #menu_your_account > ul > li > span, #menu_custom_block > ul > li > a, #menu_contacts > ul > li > a, #menu #homepage a, .navbar .brand { 
    font-family: Oswald,Arial,Helvetica,sans-serif!important; 
} 

<?php if($smof_data['sellya_cart_fonts']):?>

#t-header #cart .heading a span { 
    font-family: <?php echo urldecode($smof_data['sellya_cart_fonts'])?>,Arial,Helvetica,sans-serif !important; 
} 
<?php endif;?>


.box-product .name a, .es-carousel .name a, .product-grid .name a, .box-product .l_column .name a, .product-shortcode .name a { 
    font-weight: <?php echo $smof_data['sellya_productname_font_weight'];?>; 
	font-size: <?php echo $smof_data['sellya_productname_font_size'];?>px;
}
.product-list .name a  { 
    font-weight: <?php echo $smof_data['sellya_productname_font_weight'];?>; 
	font-size: <?php echo $smof_data['sellya_productname_list_font_size'];?>px;
} 

<?php if($smof_data['sellya_show_wishlist'] != 1):?>
.add_to_wishlist{
	display:none !important;
}
<?php endif;?>

.woocommerce .star-rating span:before, .woocommerce-page .star-rating span:before{

	color: <?php echo $smof_data['sellya_proboxrating_color'];?>;

}

 <?php if ($smof_data['sellya_custom_stylesheet']!=''):?>
 <?php echo $smof_data['sellya_custom_stylesheet'];?> <?php endif;?>
 
 
 