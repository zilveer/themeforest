<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Wish
 */
$redux_wish = wish_redux();

// footer level1
$footer_level_1 = $redux_wish['wish-hide-footer-level-1'];

// footer type 1
$wish_footer1_bgimage = $redux_wish['wish-footer1-bgimage'];
$wish_footer1_social_area = $redux_wish['wish-footer1-social-area'];
$wish_footer1_facebook = $redux_wish['wish-footer1-facebook'];
$wish_footer1_twitter = $redux_wish['wish-footer1-twitter'];
$wish_footer1_google = $redux_wish['wish-footer1-google'];
$wish_footer1_title = $redux_wish['wish-footer1-title'];
$wish_footer1_title_font = $redux_wish['wish-footer1-title-font'];
$wish_footer1_phone = $redux_wish['wish-footer1-phone'];
$wish_footer1_email = $redux_wish['wish-footer1-email'];
$wish_footer1_web = $redux_wish['wish-footer1-web'];
$wish_footer1_title_font = $redux_wish['wish-footer1-title-font'];
$wish_footer1_address = $redux_wish['wish-footer1-address'];
$wish_footer1_copyright = $redux_wish['wish-footer1-copyright'];
$wish_footer1_contact_shortcode = $redux_wish['wish-footer1-contact-shortcode'];

$wish_footer1_contact_text = $redux_wish['wish-footer1-contact-text'];
$wish_footer1_map_text = $redux_wish['wish-footer1-map-text'];

// footer type 2

$GetinTouch = $redux_wish['get-in-touch'];

$getintouch_title = $redux_wish['getintouch-title'];
$getintouch_subtitle = $redux_wish['getintouch-subtitle'];
$getintouch_button_text = $redux_wish['getintouch-button-text'];
$getintouch_button_link = $redux_wish['getintouch-button-link'];

$wish_footer2_getintouch_text = $redux_wish['wish-footer2-getintouch-text'];
$wish_footer2_phone_text = $redux_wish['wish-footer2-phone-text'];
$wish_footer2_time_text = $redux_wish['wish-footer2-time-text'];
$wish_footer2_fax_text = $redux_wish['wish-footer2-fax-text'];
$wish_footer2_address_text = $redux_wish['wish-footer2-address-text'];

$wish_footer2_followus_text = $redux_wish['wish-footer2-followus-text'];
$wish_footer2_followus_fb = $redux_wish['wish-footer2-followus-fb'];
$wish_footer2_followus_tw = $redux_wish['wish-footer2-followus-tw'];
$wish_footer2_followus_gp = $redux_wish['wish-footer2-followus-gp'];
$wish_footer2_followus_skype = $redux_wish['wish-footer2-followus-skype'];
$wish_footer2_followus_li = $redux_wish['wish-footer2-followus-li'];
$wish_footer2_contact_shortcode = $redux_wish['wish-footer2-contact-form'];
$wish_footer2_bottom_text = $redux_wish['wish-footer2-bottom-text'];



// Footer 3
$wish_footer3_left_text = $redux_wish['wish-footer3-left-text'];
$wish_footer3_social_text = $redux_wish['wish-footer3-social-text'];
$wish_footer3_social_fb = $redux_wish['wish-footer3-social-fb'];
$wish_footer3_social_tw = $redux_wish['wish-footer3-social-tw'];
$wish_footer3_social_gp = $redux_wish['wish-footer3-social-gp'];
// $wish_footer3_social_skype = $redux_wish['wish-footer3-social-skype'];
$wish_footer3_social_li = $redux_wish['wish-footer3-social-li'];

// footer 4
$wish_footer4_bottom_text = $redux_wish['wish-footer4-bottom-text'];


// footer 5
$wish_footer5_email = $redux_wish['wish-footer5-email'];
$wish_footer5_phone = $redux_wish['wish-footer5-phone'];
$wish_footer5_right_text = $redux_wish['wish-footer5-right-text'];




if ( !is_page_template( 'blank.php' ) ) {

if ($footer_level_1 == 0) {
?>
<!-- =============================== Footer level 1 starts ==================================-->
<footer class="footer_level_1">
			<div class="container">
				<div class="row">
						
							<!-- Column 1 Starts -->
							<div class="col-lg-3 col-md-3 col-xs-6">
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("f-w-5") ) : ?>
								<?php endif; ?>	
								
							</div>
							<!-- Column 1 Ends -->
							<!-- Column 2 Starts -->
							<div class="col-lg-3 col-md-3 col-xs-6">
								<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("f-w-6") ) : ?>
								<?php endif; ?>
							</div>
							
							<!-- Column 2 Ends -->
							<!-- Column 3 Starts -->
							<div class="col-lg-3 col-md-3 col-xs-6">
							
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("f-w-7") ) : ?>
								<?php endif; ?>
								

							</div>
							<!-- Column 3 Ends -->
							<!-- Column 4 Starts -->
							<div class="col-lg-3 col-md-3 col-xs-6">
								
								<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("f-w-8") ) : ?>
								<?php endif; ?>
							</div>
							<!-- Column 4 Ends -->
						
					
				</div>
			</div>
			
		</footer>
		<!--==================================== Footer level 1 ends here ============================-->


<?php
}
$footer_pattern = $redux_wish['wish-footer-pattern'];


//check if forced a different footer
    if( function_exists('rwmb_meta') && isset($post) ){
        $force_footer = rwmb_meta('wish_force_footer', $post->ID);
    }else{
        $force_footer = false; 
    }

     if($force_footer != "0" && $force_footer != false){
     	$footer_pattern  = $force_footer;
     } 




$wish_footer = $footer_pattern; 
// $GetinTouch = 1; 
if($wish_footer==1){ 
wish_enq_footer1();
?>
<?php  if($GetinTouch == 1){ ?>
<!-- GET INTOUCH STARTS
			========================================================================= -->  
		<div class="orange-bg">
			<div class="container getintouch">
				<div class="row">
					<div class="col-lg-6">
						<h1 class="animated" data-animation="fadeInRight" data-animation-delay="100"><?php echo esc_attr($getintouch_title); ?></h1>
						<div class="description animated" data-animation="fadeInRight" data-animation-delay="500"><?php echo esc_attr($getintouch_subtitle); ?></div>
					</div>
					<div class="col-lg-6">
						<div class="buttons pull-right animated" data-animation="fadeInLeft" data-animation-delay="800"><a href="<?php echo esc_attr($getintouch_button_link); ?>" class="nofill"><?php echo esc_attr($getintouch_button_text); ?></a></div>
					</div>
				</div>
			</div>
		</div>
		<!-- /. GET INTOUCH ENDS
			========================================================================= --> 
			<?php } ?>
	<!-- FOOTER STARTS
			========================================================================= -->
			
		<footer id="contact" class="grey-bg map" style="background-image: url(<?php echo esc_url($wish_footer1_bgimage["url"]); ?>);">
			<div class="container">
				<!-- Share on Starts -->
				<?php 
				if ($wish_footer1_facebook != '' || $wish_footer1_twitter != '' || $wish_footer1_google != ''): ?>
				<div class="row shareon">
					<div class="col-lg-12">
						<h3 class="animated" data-animation="fadeInUp" data-animation-delay="100"><?php echo esc_attr($wish_footer1_social_area); ?></h3>
					</div>
					<?php if ($wish_footer1_facebook != ''): ?>
					<div class="col-lg-4">
						<div class="buttons animated" data-animation="flipInY" data-animation-delay="300"><a href="<?php echo esc_url($wish_footer1_facebook); ?>" class="facebook"><i class="fa fa-facebook"></i> Facebook</a></div>
					</div>
					<?php endif ?>
					<?php if ($wish_footer1_twitter != ''): ?>
					<div class="col-lg-4">
						<div class="buttons animated" data-animation="flipInX" data-animation-delay="500"><a href="<?php echo esc_url($wish_footer1_twitter); ?>" class="twitter"><i class="fa fa-twitter"></i> TWITTER</a></div>
					</div>
					<?php endif ?>
					<?php if ($wish_footer1_google != ''): ?>
					<div class="col-lg-4">
						<div class="buttons animated" data-animation="flipInY" data-animation-delay="700"><a href="<?php echo esc_url($wish_footer1_google); ?>" class="google-plus"><i class="fa fa-google-plus"></i> GOOGLE +</a></div>
					</div>
					<?php endif ?>
				</div>
				<!-- Share on Ends -->
				<?php endif ?>
				<!-- Lets Make Starts -->        
				<div class="row letsmake">
					<div class="col-lg-12">
						<h3 class="animated" data-animation="fadeInUp" data-animation-delay="100"><?php echo esc_attr($wish_footer1_title); ?></h3>
					</div>
					<div class="col-lg-4 animated" data-animation="fadeInLeft" data-animation-delay="300">
						<div class="icon"><i class="fa fa-phone"></i></div>
						<h4><span>Phone:</span> <?php echo esc_attr($wish_footer1_phone); ?></h4>
					</div>
					<div class="col-lg-4 animated" data-animation="fadeInUp" data-animation-delay="500">
						<div class="icon"><i class="fa fa-envelope"></i></div>
						<h4><span>Email:</span> <a href="mailto:<?php echo esc_attr($wish_footer1_email); ?>"><?php echo esc_attr($wish_footer1_email); ?></a></h4>
					</div>
					<div class="col-lg-4 animated" data-animation="fadeInRight" data-animation-delay="300">
						<div class="icon"><i class="fa fa-globe"></i></div>
						<h4><span>Web:</span> <a href="<?php echo esc_attr($wish_footer1_web); ?>"><?php echo esc_attr($wish_footer1_web); ?></a></h4>
					</div>
				</div>
				<!-- Lets Make Ends -->
			</div>
			<div class="container-fluid">
				<!-- Address Starts -->
				<div class="row no-gutter-12 address">
					<div class="col-lg-12 animated" data-animation="fadeInDown" data-animation-delay="100"><i class="fa fa-map-marker"></i></div>
					<div class="col-lg-12">
						<h3 class="animated" data-animation="fadeInUp" data-animation-delay="200"><?php echo esc_attr($wish_footer1_address); ?></h3>
					</div>
					<div class="col-lg-12">
						<div class="links animated" data-animation="fadeInDown" data-animation-delay="300">
							<?php if($wish_footer1_map_text != ""){ ?>
							<a href="" id="see-map"><?php echo esc_attr($wish_footer1_map_text); ?></a> 
							<?php } ?>


							<?php if($wish_footer1_contact_text != ""){ ?>
							<a class="popup-with-form" href="#ContactForm"><?php echo esc_attr($wish_footer1_contact_text); ?></a>
							<?php } ?>

						</div>
					</div>
					<!-- Google Map -->
					<div class="col-lg-12 google-map">
						<div data-address="<?php echo esc_attr($wish_footer1_address); ?>" data-color="#000000" id="map-canvas"></div>
					</div>
					<!-- End Google Map -->
					<!-- Contact Form Starts -->
					<div class="col-lg-12">
						<form action='process.php' method='post' name='ContactForm' id="ContactForm" class="white-popup-block mfp-hide animated footer1-contact-form" data-animation="flipInX" data-animation-delay="100">


						<?php echo do_shortcode($wish_footer1_contact_shortcode); ?>


						<div class="clearfix"></div>
						</form>
					</div>
					<!-- Contact Form Ends -->
				</div>
			</div>
			<!-- Address Ends -->
			<div class="row2">
				<div class="container">
					<div class="row">
						<div class="col-lg-12"><?php echo esc_attr($wish_footer1_copyright); ?></div>
					</div>
				</div>
			</div>
		</footer>
		<?php }elseif($wish_footer==2){ ?>
			<footer id="contact" class="grey-bg">
			<div class="container">
			<?php if($GetinTouch == 1){ ?>
				<div class="row">
				
					<!-- Get in Touch Starts -->
					<div class="col-lg-8 getintouch-footer">
						<div class="row">
							<div class="col-lg-12">
								<h3 class="animated" data-animation="fadeInUp" data-animation-delay="100"><?php echo esc_attr($wish_footer2_getintouch_text); ?></h3>
							</div>
							<div class="col-lg-5">
								<ul>
									<li class="animated" data-animation="fadeInUp" data-animation-delay="300"><i class="fa fa-phone"></i><?php echo esc_attr($wish_footer2_phone_text); ?></li>
									<li class="animated" data-animation="fadeInUp" data-animation-delay="600"><i class="fa fa-print"></i><?php echo esc_attr($wish_footer2_fax_text); ?></li>
								</ul>
							</div>
							<div class="col-lg-7">
								<ul>
									<li class="animated" data-animation="fadeInUp" data-animation-delay="300"><i class="fa fa-clock-o"></i><?php echo esc_attr($wish_footer2_time_text); ?></li>
									<li class="animated" data-animation="fadeInUp" data-animation-delay="600"><i class="fa fa-home"></i><?php echo esc_attr($wish_footer2_address_text); ?></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- Get in Touch Ends -->
					
					<!-- Follow Us Starts -->
					<div class="col-lg-4 followus">
						<div class="row">
							<div class="col-lg-12">
								<h3 class="animated" data-animation="fadeInUp" data-animation-delay="100"><?php echo esc_attr($wish_footer2_followus_text); ?></h3>
							</div>
							<div class="col-lg-12 animated" data-animation="fadeInUp" data-animation-delay="300">
								<ul>
									<?php if($wish_footer2_followus_fb != "") { ?><li><a href="<?php echo esc_attr($wish_footer2_followus_fb); ?>"><i class="fa fa-facebook"></i></a></li><?php }?>
									<?php if($wish_footer2_followus_tw != "") { ?><li><a href="<?php echo esc_attr($wish_footer2_followus_tw); ?>"><i class="fa fa-twitter"></i></a></li><?php }?>
									<?php if($wish_footer2_followus_gp != "") { ?><li><a href="<?php echo esc_attr($wish_footer2_followus_gp); ?>"><i class="fa fa-google-plus"></i></a></li><?php }?>
									<?php if($wish_footer2_followus_skype != "") { ?><li><a href="<?php echo esc_attr($wish_footer2_followus_skype); ?>"><i class="fa fa-skype"></i></a></li><?php }?>
									<?php if($wish_footer2_followus_li != "") { ?><li><a href="<?php echo esc_attr($wish_footer2_followus_li); ?>"><i class="fa fa-linkedin"></i></a></li><?php }?>
								</ul>
							</div>
						</div>
					</div>
					<!-- Follow Us Ends -->
				</div>
				<?php } ?>
				<!-- Contact Form Starts -->
				<div class="row contact-form contact-form-footer2">

					<?php echo do_shortcode($wish_footer2_contact_shortcode); ?>

				</div>
				<!-- Contact Form Ends -->
			</div>
			<div class="row2">
				<div class="container">
					<div class="row">
						<div class="col-lg-12"><?php echo esc_attr($wish_footer2_bottom_text); ?></div>
					</div>
				</div>
			</div>
		</footer>
		<?php }elseif($wish_footer==3){ ?>
		<footer class="contact footer3">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 animated footer3-title" data-animation="fadeInUp" data-animation-delay="100"><?php echo esc_attr($wish_footer3_left_text); ?></div>
					<div class="col-lg-6">
						<div class="s-icons animated" data-animation="fadeInUp" data-animation-delay="400">
							<span><?php echo esc_attr($wish_footer3_social_text); ?></span>
							<ul>
								<?php if($wish_footer3_social_fb != "") { ?><li><a href="<?php echo esc_attr($wish_footer3_social_fb); ?>"><i class="fa fa-facebook"></i></a></li><?php }?>
								<?php if($wish_footer3_social_tw != "") { ?><li><a href="<?php echo esc_attr($wish_footer3_social_tw); ?>"><i class="fa fa-twitter"></i></a></li><?php }?>
								<?php if($wish_footer3_social_gp != "") { ?><li><a href="<?php echo esc_attr($wish_footer3_social_gp); ?>"><i class="fa fa-google-plus"></i></a></li><?php }?>
								<?php if($wish_footer3_social_li != "") { ?><li><a href="<?php echo esc_attr($wish_footer3_social_li); ?>"><i class="fa fa-linkedin"></i></a></li><?php }?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<?php }elseif($wish_footer==4){ ?>
			<footer id="contact" class="footer4">
			<div class="container">
				<div class="row footer4-inner">
						
							<!-- Column 1 Starts -->
							<div class="col-lg-3 col-md-3  col-xs-12">
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("f-w-1") ) : ?>
								<?php endif; ?>	
								
							</div>
							<!-- Column 1 Ends -->
							<!-- Column 2 Starts -->
							<div class="col-lg-3 col-md-3  col-xs-12">
								<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("f-w-2") ) : ?>
								<?php endif; ?>
							</div>
							
							<!-- Column 2 Ends -->
							<!-- Column 3 Starts -->
							<div class="col-lg-3 col-md-3  col-xs-12">
							
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("f-w-3") ) : ?>
								<?php endif; ?>
								

							</div>
							<!-- Column 3 Ends -->
							<!-- Column 4 Starts -->
							<div class="col-lg-3 col-md-3  col-xs-12">
								
								
								
								<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("f-w-4") ) : ?>
								<?php endif; ?>
							</div>
							<!-- Column 4 Ends -->
						
					
				</div>
			</div>


			<div class="row2">
				<div class="container">
					<div class="row">
						<div class="col-lg-12"><?php echo esc_attr($wish_footer4_bottom_text); ?></div>
					</div>
				</div>
			</div>


		</footer>
		<?php }elseif($wish_footer==5){ ?>
		<footer class="contact grey-bg footer5">
			<div class="container">
				<div class="row">
					<div class="col-lg-6"><span><a href=""><i class="fa fa-envelope"></i><?php echo esc_attr($wish_footer5_email); ?></a></span><span><i class="fa fa-phone"></i><?php echo esc_attr($wish_footer5_phone); ?></span></div>
					<div class="col-lg-6"><?php echo esc_attr($wish_footer5_right_text); ?></div>
				</div>
			</div>
		</footer>
		<?php }elseif($wish_footer==6){ ?>
		<?php  
			//footer 6
			$wish_footer6_title = $redux_wish['wish-footer6-title'];

			$wish_footer6_fb = $redux_wish['wish-footer6-fb'];
			$wish_footer6_tw = $redux_wish['wish-footer6-tw'];
			$wish_footer6_gp = $redux_wish['wish-footer6-gp'];
			$wish_footer6_ins = $redux_wish['wish-footer6-ins'];

			
			$wish_footer6_contact_phone_title = $redux_wish['wish-footer6-phone-title'];
			$wish_footer6_contact_phone = $redux_wish['wish-footer6-phone'];

			$wish_footer6_contact_address_title = $redux_wish['wish-footer6-address-title'];
			$wish_footer6_contact_address = $redux_wish['wish-footer6-address'];

			$wish_footer6_contact_email_title = $redux_wish['wish-footer6-email-title'];
			$wish_footer6_contact_email = $redux_wish['wish-footer6-email'];	
		?>

			<footer class="contact dark-grey-bg footer6" id="contact">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<h1 class="animated" data-animation="fadeInUp" data-animation-delay="100"><?php echo esc_attr($wish_footer6_title); ?></h1>
						<ul class="animated" data-animation="fadeInUp" data-animation-delay="300">
							<li><a href="<?php echo esc_url($wish_footer6_fb); ?>"><i class="fa fa-facebook"></i></a></li>
							<li><a href="<?php echo esc_url($wish_footer6_tw); ?>"><i class="fa fa-twitter"></i></a></li>
							<li><a href="<?php echo esc_url($wish_footer6_gp); ?>"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="<?php echo esc_url($wish_footer6_ins); ?>"><i class="fa fa-instagram"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<!-- Column 1 starts -->
					<div class="col-lg-4 animated" data-animation="fadeInUp" data-animation-delay="600">
						<div class="icon"><i class="fa fa-phone"></i></div>
						<div class="caption"><?php echo esc_attr($wish_footer6_contact_phone_title); ?></div>
						<div class="description"><?php echo esc_attr($wish_footer6_contact_phone); ?></div>
					</div>
					<!-- Column 1 Ends -->
					<!-- Column 2 starts -->
					<div class="col-lg-4 animated" data-animation="fadeInUp" data-animation-delay="1000">
						<div class="icon"><i class="fa fa-map-marker"></i></div>
						<div class="caption"><?php echo esc_attr($wish_footer6_contact_address_title); ?></div>
						<div class="description"><?php echo esc_attr($wish_footer6_contact_address); ?></div>
					</div>
					<!-- Column 2 Ends -->
					<!-- Column 3 starts -->
					<div class="col-lg-4 animated" data-animation="fadeInUp" data-animation-delay="1400">
						<div class="icon"><i class="fa fa-envelope-o"></i></div>
						<div class="caption"><?php echo esc_attr($wish_footer6_contact_email_title); ?></div>
						<div class="description"><a href="mailto:<?php echo esc_attr($wish_footer6_contact_email); ?>"><?php echo esc_attr($wish_footer6_contact_email); ?></a></div>
					</div>
					<!-- Column 3 Ends -->
				</div>
			</div>
		</footer>
		<?php } ?>
		<!-- /. FOOTER ON ENDS
			========================================================================= -->
		<!-- TO TOP STARTS
			========================================================================= -->
		<a href="#" class="scrollup">Scroll</a>      
		<!-- /. TO TOP ENDS
			========================================================================= -->

<?php } ?>
<?php wp_footer(); ?>

</body>
</html>
