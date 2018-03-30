<?php


function rocknrolla_custom_styles() {
global $smof_data, $post; 
?>

<!-- CUSTOM TYPOGRAPHY STYLES -->
	
<style type="text/css">

  
 <?php 

 	$args=array(
 	    'post_type' => 'page',
 	    'order' => 'ASC',
 	    'orderby' => 'menu_order',
 	    'posts_per_page' => '-1'
  	 );
 	$main_query = new WP_Query($args); 

 if( have_posts() ) :

     while ($main_query->have_posts()) : $main_query->the_post();
	    
	    $post_id = get_the_ID();
		 $post_name = $post->post_name;
		
			 
				if ( has_post_thumbnail()) { 
                   if (empty($slider_meta)) {                     
                     $att=get_post_thumbnail_id();
					 $image_src = wp_get_attachment_image_src( $att, 'full' );
					 $image_src = $image_src[0]; ?>
					 
              <?php if (get_post_meta($post_id, "rnr_assign_type", true) == "parallax-section") { ?>				
				#<?php echo $post_name; ?>.parallax {
				   background-image: url('<?php echo $image_src; ?>') !important;
				}	 
				
				<?php }
				
				 if (get_post_meta($post_id, "rnr_assign_type", true) == "home-section") { ?>				
				.home-parallax { 
				   background: url('<?php echo $image_src; ?>') center top;
				}
			<?php	
			
			 $u_agent = $_SERVER['HTTP_USER_AGENT'];
				$ub = '';
				if(preg_match('/MSIE/i',$u_agent)) {
					$ub = "ie";					
				} else {
				    $ub = "others";		
				}
				
				if($ub=="others") { ?>
				.rnr-video { 
				   background: url('<?php echo $image_src; ?>') center top;
				}
			<?php	}
			
			
			   } ?>				
					 
			<?php } 

                } 

     endwhile;
	 wp_reset_postdata();
 endif; ?>
 
 





body{ 
		
        <?php if($smof_data['rnr_body_text']['face']!='0') { ?>
		font-family: <?php echo $smof_data['rnr_body_text']['face']; ?>, Arial, Helvetica, sans-serif !important; 
		<?php } ?>
		font-size: <?php echo $smof_data['rnr_body_text']['size']; ?>; 
		
		<?php  if( $smof_data['rnr_body_text']['style'] == 'bold' )
		{?>
		font-weight: bold; 		  
		<?php } else if( $smof_data['rnr_body_text']['style'] == 'bold italic' )
		{?>
		font-weight: bold; 	
		font-style: italic;	  
		<?php } else { ?>
		font-style: <?php echo $smof_data['rnr_body_text']['style']; ?>; 		  
		<?php } ?>	   
	   
	   color: <?php echo $smof_data['rnr_body_text']['color']; ?>;
	   font-weight:  <?php echo $smof_data['rnr_body_font_weight']; ?>;
}

.service-description {
       color: <?php echo $smof_data['rnr_body_text']['color']; ?>;
}

	h1{
        <?php if($smof_data['rnr_heading_h1']['face']!='0') { ?>
		font-family: <?php echo $smof_data['rnr_heading_h1']['face']; ?>, Arial, Helvetica, sans-serif !important; 
		<?php } ?>
		font-size: <?php echo $smof_data['rnr_heading_h1']['size']; ?>; 

		<?php  if( $smof_data['rnr_heading_h1']['style'] == 'bold' )
		{?>
		font-weight: bold; 		  
		<?php } else if( $smof_data['rnr_heading_h1']['style'] == 'bold italic' )
		{?>
		font-weight: bold; 	
		font-style: italic;	  
		<?php } else { ?>
		font-style: <?php echo $smof_data['rnr_heading_h1']['style']; ?>; 		  
		<?php } ?>

		color: <?php echo $smof_data['rnr_heading_h1']['color']; ?>; 
	    font-weight:  <?php echo $smof_data['rnr_heading_h1_font_weight']; ?>; 
	    text-transform:  <?php echo $smof_data['rnr_heading_h1_text_transform']; ?>;	
	}
	
	.contact-details h1 {
		font-size: <?php echo $smof_data['rnr_heading_h1']['size']; ?> !important; 		
	}
		
	h2{ 
        <?php if($smof_data['rnr_heading_h2']['face']!='0') { ?>
		font-family: <?php echo $smof_data['rnr_heading_h2']['face']; ?>, Arial, Helvetica, sans-serif !important; 
		<?php } ?>
		font-size: <?php echo $smof_data['rnr_heading_h2']['size']; ?>; 

		<?php  if( $smof_data['rnr_heading_h2']['style'] == 'bold' )
		{?>
		font-weight: bold; 		  
		<?php } else if( $smof_data['rnr_heading_h2']['style'] == 'bold italic' )
		{?>
		font-weight: bold; 	
		font-style: italic;	  
		<?php } else { ?>
		font-style: <?php echo $smof_data['rnr_heading_h2']['style']; ?>; 		  
		<?php } ?>

		color: <?php echo $smof_data['rnr_heading_h2']['color']; ?>;  
	    font-weight:  <?php echo $smof_data['rnr_heading_h2_font_weight']; ?>; 
	    text-transform:  <?php echo $smof_data['rnr_heading_h2_text_transform']; ?>;	
	}

	
	h3{ 
        <?php if($smof_data['rnr_heading_h3']['face']!='0') { ?>
		font-family: <?php echo $smof_data['rnr_heading_h3']['face']; ?>, Arial, Helvetica, sans-serif !important; 
		<?php } ?>
		font-size: <?php echo $smof_data['rnr_heading_h3']['size']; ?>; 
		
		<?php  if( $smof_data['rnr_heading_h3']['style'] == 'bold' )
		{?>
		font-weight: bold; 		  
		<?php } else if( $smof_data['rnr_heading_h3']['style'] == 'bold italic' )
		{?>
		font-weight: bold; 	
		font-style: italic;	  
		<?php } else { ?>
		font-style: <?php echo $smof_data['rnr_heading_h3']['style']; ?>; 		  
		<?php } ?>

		color: <?php echo $smof_data['rnr_heading_h3']['color']; ?>;  
	    font-weight:  <?php echo $smof_data['rnr_heading_h3_font_weight']; ?>; 
	    text-transform:  <?php echo $smof_data['rnr_heading_h3_text_transform']; ?>;	
	}
	h4{ 
        <?php if($smof_data['rnr_heading_h4']['face']!='0') { ?>
		font-family: <?php echo $smof_data['rnr_heading_h4']['face']; ?>, Arial, Helvetica, sans-serif !important; 
		<?php } ?>
		font-size: <?php echo $smof_data['rnr_heading_h4']['size']; ?>; 

		<?php  if( $smof_data['rnr_heading_h4']['style'] == 'bold' )
		{?>
		font-weight: bold; 		  
		<?php } else if( $smof_data['rnr_heading_h4']['style'] == 'bold italic' )
		{?>
		font-weight: bold; 	
		font-style: italic;	  
		<?php } else { ?>
		font-style: <?php echo $smof_data['rnr_heading_h4']['style']; ?>;  
	    font-weight:  <?php echo $smof_data['rnr_heading_h4_font_weight']; ?>; 
	    text-transform:  <?php echo $smof_data['rnr_heading_h4_text_transform']; ?>;			  
		<?php } ?>

		color: <?php echo $smof_data['rnr_heading_h4']['color']; ?>; 
	}
	h5{ 
        <?php if($smof_data['rnr_heading_h5']['face']!='0') { ?>
		font-family: <?php echo $smof_data['rnr_heading_h5']['face']; ?>, Arial, Helvetica, sans-serif !important; 
		<?php } ?>
		font-size: <?php echo $smof_data['rnr_heading_h5']['size']; ?>; 

		<?php  if( $smof_data['rnr_heading_h5']['style'] == 'bold' )
		{?>
		font-weight: bold; 		  
		<?php } else if( $smof_data['rnr_heading_h5']['style'] == 'bold italic' )
		{?>
		font-weight: bold; 	
		font-style: italic;	  
		<?php } else { ?>
		font-style: <?php echo $smof_data['rnr_heading_h5']['style']; ?>; 		  
		<?php } ?>

		color: <?php echo $smof_data['rnr_heading_h5']['color']; ?>;  
	    font-weight:  <?php echo $smof_data['rnr_heading_h5_font_weight']; ?>; 
	    text-transform:  <?php echo $smof_data['rnr_heading_h5_text_transform']; ?>;	
	}
	h6{ 
	
        <?php if($smof_data['rnr_heading_h6']['face']!='0') { ?>
		font-family: <?php echo $smof_data['rnr_heading_h6']['face']; ?>, Arial, Helvetica, sans-serif !important; 
		<?php } ?>
			

		font-size: <?php echo $smof_data['rnr_heading_h6']['size']; ?>; 

		<?php  if( $smof_data['rnr_heading_h6']['style'] == 'bold' )
		{?>
		font-weight: bold; 		  
		<?php } else if( $smof_data['rnr_heading_h6']['style'] == 'bold italic' )
		{?>
		font-weight: bold; 	
		font-style: italic;	  
		<?php } else { ?>
		font-style: <?php echo $smof_data['rnr_heading_h6']['style']; ?>; 	 
	    font-weight:  <?php echo $smof_data['rnr_heading_h6_font_weight']; ?>; 
	    text-transform:  <?php echo $smof_data['rnr_heading_h6_text_transform']; ?>;	  
		<?php } ?>

		color: <?php echo $smof_data['rnr_heading_h6']['color']; ?>; 
	}
	
	.subtitle { 
	
        <?php if($smof_data['rnr_heading_subtitle']['face']!='0') { ?>
		font-family: <?php echo $smof_data['rnr_heading_subtitle']['face']; ?>, Arial, Helvetica, sans-serif !important; 
		<?php } ?>
		font-size: <?php echo $smof_data['rnr_heading_subtitle']['size']; ?>; 

		<?php  if( $smof_data['rnr_heading_subtitle']['style'] == 'bold' )
		{?>
		font-weight: bold; 		  
		<?php } else if( $smof_data['rnr_heading_subtitle']['style'] == 'bold italic' )
		{?>
		font-weight: bold; 	
		font-style: italic;	  
		<?php } else { ?>
		font-style: <?php echo $smof_data['rnr_heading_subtitle']['style']; ?>; 	 
	    font-weight:  <?php echo $smof_data['rnr_heading_subtitle_font_weight']; ?>; 
	    text-transform:  <?php echo $smof_data['rnr_heading_subtitle_text_transform']; ?>;	  
		<?php } ?>

		color: <?php echo $smof_data['rnr_heading_subtitle']['color']; ?>; 
	}
	
	
	.home-parallax h1,
	.home-parallax h2,
	.home-parallax h3,
	.home-parallax h4,
	.home-parallax h5,
	.home-parallax h6,
	.home-fullscreenslider h1,
	.home-fullscreenslider h2,
	.home-fullscreenslider h3,
	.home-fullscreenslider h4,
	.home-fullscreenslider h5,
	.home-fullscreenslider h6,
	.home-video h1,
	.home-video h2,
	.home-video h3,
	.home-video h4,
	.home-video h5,
	.home-video h6,	
	.parallax h1,
	.parallax h2,
	.parallax h3,
	.parallax h4,
	.parallax h5,
	.parallax h6,
	.parallax p.quote,
	.home-slide .home-slide-content,
	#slidecaption,
	.parallax .twitter-author a,
	.contact-details h2,
	.home3 h1 { 
	
        <?php if($smof_data['rnr_parallax_headings_font']['face']!='0') { ?>
		font-family: <?php echo $smof_data['rnr_parallax_headings_font']['face']; ?>, Arial, Helvetica, sans-serif !important; 
		<?php } ?>
		font-size: <?php echo $smof_data['rnr_parallax_headings_font']['size']; ?>; 

		<?php  if( $smof_data['rnr_parallax_headings_font']['style'] == 'bold' )
		{?>
		font-weight: bold; 		  
		<?php } else if( $smof_data['rnr_parallax_headings_font']['style'] == 'bold italic' )
		{?>
		font-weight: bold; 	
		font-style: italic;	  
		<?php } else { ?>
		font-style: <?php echo $smof_data['rnr_parallax_headings_font']['style']; ?>; 	 
	    font-weight:  <?php echo $smof_data['rnr_parallax_headings_font_weight']; ?>; 
	    text-transform:  <?php echo $smof_data['rnr_parallax_headings_text_transform']; ?>;	  
		<?php } ?>

		color: <?php echo $smof_data['rnr_parallax_headings_font']['color']; ?>; 
	}
	
	<?php if($smof_data['rnr_parallax_headings_font']['face']=='0') { ?>
		.home3 h1{
			width:420px;
			margin:0 40px;
			
		 } 
		 
		@media only screen and (max-width: 767px) {
	    .home3 h1 {
	        width: 380px;
	        margin:0 30px;
	     }
		}
		
		@media only screen and (max-width: 479px) {
	    .home3 h1 {
	        width: 220px;
	        margin:0 30px;
	     }
		}		
	<?php } ?>

	.home-logo-text a {
        <?php if($smof_data['rnr_parallax_headings_font']['face']!='0') { ?>
		font-family: <?php echo $smof_data['rnr_parallax_headings_font']['face']; ?>, Arial, Helvetica, sans-serif !important; 
		<?php } ?>	
	}

	.home-parallax,
	.home-video, 
	.parallax,
	.parallax #twitter-feed ul.slides > li,
	.parallax .testimonial-slide .client-testimonial,
	.slidedescription { 
	
        <?php if($smof_data['rnr_parallax_text_font']['face']!='0') { ?>
		font-family: <?php echo $smof_data['rnr_parallax_text_font']['face']; ?>, Arial, Helvetica, sans-serif !important; 
		<?php } ?>
		font-size: <?php echo $smof_data['rnr_parallax_text_font']['size']; ?>; 

		<?php  if( $smof_data['rnr_parallax_text_font']['style'] == 'bold' )
		{?>
		font-weight: bold; 		  
		<?php } else if( $smof_data['rnr_parallax_text_font']['style'] == 'bold italic' )
		{?>
		font-weight: bold; 	
		font-style: italic;	  
		<?php } else { ?>
		font-style: <?php echo $smof_data['rnr_parallax_text_font']['style']; ?>; 
		<?php } ?>

		color: <?php echo $smof_data['rnr_parallax_text_font']['color']; ?>; 
	}


.navigation.colored li a,
nav.light .main-menu a,
nav.dark .main-menu a,
nav.transparent.scroll a,
.page-template-default nav.transparent .main-menu a, 
.blog nav.transparent .main-menu a, 
nav.transparent.scroll .main-menu a  {
        <?php if($smof_data['rnr_menu']['face']!='0') { ?>
		 font-family: <?php echo $smof_data['rnr_menu']['face']; ?>, Arial, Helvetica, sans-serif;
		<?php } ?> 
		
		font-size: <?php echo $smof_data['rnr_menu']['size']; ?>; 
		<?php  if( $smof_data['rnr_menu']['style'] == 'bold' )
		{?>
		font-weight: bold; 		  
		<?php } else if( $smof_data['rnr_menu']['style'] == 'bold italic' )
		{?>
		font-weight: bold; 	
		font-style: italic;	  
		<?php } else { ?>
		font-style: <?php echo $smof_data['rnr_menu']['style']; ?>; 		  
		<?php } ?>	   
	   
	   color: <?php echo $smof_data['rnr_menu']['color']; ?>;	
	   font-weight:  <?php echo $smof_data['rnr_menu_font_weight']; ?>; 
	   text-transform:  <?php echo $smof_data['rnr_menu_text_transform']; ?>;   	   	
}

nav.transparent a {
        <?php if($smof_data['rnr_menu']['face']!='0') { ?>
		 font-family: <?php echo $smof_data['rnr_menu']['face']; ?>, Arial, Helvetica, sans-serif;
		<?php } ?> 
		
		font-size: <?php echo $smof_data['rnr_menu']['size']; ?>; 
		<?php  if( $smof_data['rnr_menu']['style'] == 'bold' )
		{?>
		font-weight: bold; 		  
		<?php } else if( $smof_data['rnr_menu']['style'] == 'bold italic' )
		{?>
		font-weight: bold; 	
		font-style: italic;	  
		<?php } else { ?>
		font-style: <?php echo $smof_data['rnr_menu']['style']; ?>; 		  
		<?php } ?>	   
	   font-weight:  <?php echo $smof_data['rnr_menu_font_weight']; ?>; 
	   text-transform:  <?php echo $smof_data['rnr_menu_text_transform']; ?>;   
	   color :  <?php echo $smof_data['rnr_menu_transdefault_color']; ?>;   	
}

.navigation li a:hover, 
.navigation li.active a ,
.navigation.colored li a:hover, 
.navigation.colored li.active a, 
.navigation li.current-menu-item a,
.navigation li.current_page_parent > a{
	   color: <?php echo $smof_data['rnr_menu_link_hover_color']; ?> !important;	   
}

.navigation.transparent li.current-menu-item a,
.navigation.transparent li.active a {
	   color: <?php echo $smof_data['rnr_accent_color']; ?> !important;	   
}


.copyright {
	background: <?php echo $smof_data['rnr_footer_background']; ?> !important;
        <?php if($smof_data['rnr_footer']['face']!='0') { ?>	
	      font-family: <?php echo $smof_data['rnr_footer']['face']; ?>, Arial, Helvetica, sans-serif; 
	    <?php } ?>
	font-size: <?php echo $smof_data['rnr_footer']['size']; ?>; 
	
	<?php  if( $smof_data['rnr_footer']['style'] == 'bold' )
	{?>
	font-weight: bold; 		  
	<?php } else if( $smof_data['rnr_footer']['style'] == 'bold italic' )
	{?>
	font-weight: bold; 	
	font-style: italic;	  
	<?php } else { ?>
	font-style: <?php echo $smof_data['rnr_footer']['style']; ?>; 		  
	<?php } ?>	  
   
   color: <?php echo $smof_data['rnr_footer']['color']; ?>;		
}
.copyright a, .copyright .social-icons .social-icon {
	   color: <?php echo $smof_data['rnr_footer_link_color']; ?>;	   
}
.copyright a:hover {
	   color: <?php echo $smof_data['rnr_footer_link_hover_color']; ?>;	   
}

<?php if($smof_data['rnr_menu_style']=='top') { ?>
#undefined-sticky-wrapper {
     height: 0 !important;
}
div.home-slider {
    margin-top: 80px;
}
 @media only screen and (max-width: 767px) {
div.home-slider {
    margin-top: 60px;
}	 
 }
<?php } ?>

<?php if($smof_data['rnr_menu_style']=='top' || $smof_data['rnr_menu_type']=='transparent') { ?>
.page-template-default .title, .blog .title , .post-single .title, .archive .title, .woocommerce .post-single ,.woocommerce-page .post-single, .single-product .post-single{
	margin-top:80px;
}
<?php } ?>

<?php if($smof_data['rnr_disable_overlay']) { ?>
.home-text-wrapper, .parallax-overlay {
	background: none !important;
}

<?php } ?>


<?php

$parallax_overlay_bg = $smof_data['rnr_parallax_overlay_bgcolor'];
$parallax_overlay_opacity = $smof_data['rnr_parallax_overlay_opacity'];
$parallax_overlay_opacity = $parallax_overlay_opacity/100;
$parallax_overlay_bg_new = rnr_hex2rgba($parallax_overlay_bg, $parallax_overlay_opacity);

?>

.home-text-wrapper, .parallax-overlay {
<?php if($smof_data['rnr_parallax_overlay_url'] != "") { ?>	
	background: url(<?php echo $smof_data['rnr_parallax_overlay_url']; ?>);	
<?php } else if($smof_data['rnr_enable_color_pattern']) { ?>
	background: <?php echo $parallax_overlay_bg; ?>;
	background: <?php echo $parallax_overlay_bg_new; ?>;  
<?php } ?>	  
}


<?php if($smof_data['rnr_disable_animation'] == true) { ?>
  .rnr-animate {
	  visibility: visible;
  }
<?php }	 ?>

<?php if($smof_data['rnr_disable_mob_animation'] == true) { ?>
 @media only screen and (max-width: 767px) {
  .rnr-animate {
	  visibility: visible;
  }
 }
<?php }	 ?>



<?php if($smof_data['rnr_enable_classic_title']==true) { ?>
.title h1 {
	background: none !important;
	border: none !important;
	color: inherit !important;
	box-shadow: none !important;
}
<?php } ?>

<?php if($smof_data['rnr_video_mute']) { ?>
a.rnr-video-control {
	display:none !important;
}
<?php }?>

<?php if($smof_data['rnr_enable_wc_sidebar']) { ?>
.woocommerce ul.products li.product, .woocommerce-page ul.products li.product {
	float: left;
	margin: 0 2% 2.992em 0;
	padding: 0;
	position: relative;
	width: 32%;
	margin-left: 0;
}
<?php } ?>




/*========== B A C K G R O U N D    S K I N S =============*/

::-moz-selection {
 background: <?php echo $smof_data['rnr_accent_color']; ?>;
}
::selection {
	background:<?php echo $smof_data['rnr_accent_color']; ?>;
}

nav.colored, nav.light.colored,
.twitter-feed-icon i,
.testimonial-icon i,
.home-gradient,
.home-parallax,
#project-navigation ul li#prevProject a:hover, 
#project-navigation ul li#nextProject a:hover,
#project-navigation ul li a:hover,
#closeProject a:hover,
.mc4wp-form input[type="submit"],
#respond input[type="submit"],
input[type="submit"],
.pagination a.previous:hover, 
.pagination a.next:hover,
.service-box:hover,
.button,
.skillbar .skill-percentage,
.flex-control-nav li a:hover,
.flex-control-nav li a.flex-active,
.testimonial-slider .flex-direction-nav li a i, 
.twitter-slider .flex-direction-nav li a i,
.project-media .flex-direction-nav li a i,
.color-block,
.home1 .slabtextdone .slabtext.second-child,
.home4 .slabtextdone .slabtext.second-child,
.caption,
.copyright,
.title h1,
.service-features .img-container,
.service-features .img-container,
.view-profile,
.team-member:hover .team-desc,
.service-box .service-icon,
.modal .close,
#nav .sub-menu li.current-menu-item a, 
#nav .sub-menu li.current-menu-item a:hover, 
#nav .sub-menu li.current_page_item a, 
#nav .sub-menu li.current_page_item a:hover, 
#nav .sub-menu li .sub-menu li.current-menu-item a, 
#nav .sub-menu li .sub-menu li.current-menu-item a:hover, 
#nav .sub-menu li .sub-menu li.current_page_item a, 
#nav .sub-menu li .sub-menu li.current_page_item a:hover, 
#nav .sub-menu li a.active, #nav .sub-menu li a.active:hover,
#port-pagination a:hover,
#respond input[type="submit"], 
.woocommerce #respond input#submit, 
.woocommerce ul.products li.product a.button, 
.woocommerce-page ul.products li.product a.button,
.woocommerce div.product form.cart .button,
.woocommerce-page .woocommerce-message .button,
.woocommerce .cart-collaterals .shipping_calculator .button, 
.woocommerce-page .cart-collaterals .shipping_calculator .button,
.woocommerce .login input.button,
 .woocommerce .checkout_coupon input.button,
 .woocommerce .cart input.button.alt,
.woocommerce .login input.button,
 .woocommerce .checkout_coupon input.button,
 .woocommerce #respond input#submit:hover,
.woocommerce-page .woocommerce-message .button:hover,
.woocommerce button.button.alt,
.woocommerce a.wc-backward,
.woocommerce a.wc-backward:hover,
.woocommerce #payment #place_order, 
.woocommerce-page #payment #place_order,
.woocommerce #payment #place_order:hover, 
.woocommerce-page #payment #place_order:hover,
.woocommerce .widget_price_filter .ui-slider .ui-slider-range, 
.woocommerce-page .widget_price_filter .ui-slider .ui-slider-range,
.latest-blog .blog-item .inner:hover .blog-item-description .desc.post-icon,
.blog .blog-overlay,
.latest-blog .blog-item .blog-item-description span.date,
div.wpcf7 div.stretch-submit input[type="submit"],
.plan.featured .plan-head ,
#port-infinite a:hover {
	background-color: <?php echo $smof_data['rnr_accent_color']; ?>;
}


/*========== B O X   S H A D O W    S K I N S =============*/

.title h1,
.service-box .service-icon {
	box-shadow:0px 0px 0px 3px <?php echo $smof_data['rnr_accent_color']; ?>;
}

.tab a.selected {
    box-shadow: 0px -3px 0px 0px <?php echo $smof_data['rnr_accent_color']; ?>;
}




/*========== C O L O R    S K I N S =============*/

a,
.highlight,
nav.light .main-menu a:hover, 
nav.dark .main-menu a:hover,
nav.light .main-menu li.active a,
nav.transparent .main-menu li.active a, 
nav.dark .main-menu li.active a,
.parallax .quote i,
#filters ul li a:hover h3, 
#filters ul li a.active h3,
.post-title a:hover,
.post-tags li a:hover,
.tags-list li a:hover,
.pages li a:hover,
.home3 .slabtextdone .slabtext.second-child,
.service-box:hover .service-icon,
span.amount,
#nav .sub-menu li a:hover, 
#nav .sub-menu li .sub-menu li a:hover, 
#nav .sub-menu li .sub-menu li .sub-menu li a:hover {
	color:<?php echo $smof_data['rnr_accent_color']; ?>;
}




/*========== B O R D E R    S K I N S =============*/

.pages li a.current,
.pages li a.current,
.service-features .img-container:after,
.service-box:hover .service-icon,
.callout,
blockquote p,
.pullquote.align-right,
.pullquote.align-left {
	border-color: <?php echo $smof_data['rnr_accent_color']; ?>;
}









<?php echo $smof_data['rnr_custom_css']; ?>
</style>

<?php }
add_action( 'wp_head', 'rocknrolla_custom_styles', 100 );

?>