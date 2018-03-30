<?php
/**
Single Portfolio Template
 */

global $mango_settings, $args, $mango_layout_columns, $post;
 $mango_layout_columns = mango_page_columns ();
 $mango_class_name = mango_class_name ();
$containerClass = mango_main_container_class();


get_header();




$tag_slug = array();

the_post();
$post_id = get_the_ID();
 $current_page_id = mango_current_page_id();
 
 $member = ( get_post_meta (  $current_page_id, 'mango_member_minfo', true ) ) ? get_post_meta (  $current_page_id, 'mango_member_minfo', true ) : '';
  
  $facebook = ( get_post_meta (  $current_page_id, 'mango_member_facebook', true ) ) ? get_post_meta (  $current_page_id, 'mango_member_facebook', true ) : '';
 
  $twitter = ( get_post_meta (  $current_page_id, 'mango_member_twitter', true ) ) ? get_post_meta (  $current_page_id, 'mango_member_twitter', true ) : '';
 
  $linkedIn = ( get_post_meta (  $current_page_id, 'mango_member_linkedIn', true ) ) ? get_post_meta (  $current_page_id, 'mango_member_linkedIn', true ) : '';
  
  $googleplus = ( get_post_meta (  $current_page_id, 'mango_member_googleplus', true ) ) ? get_post_meta (  $current_page_id, 'mango_member_googleplus', true ) : '';
  
  $pinterest = ( get_post_meta (  $current_page_id, 'mango_member_pinterest', true ) ) ? get_post_meta (  $current_page_id, 'mango_member_pinterest', true ) : '';
  
  $email = ( get_post_meta (  $current_page_id, 'mango_member_email', true ) ) ? get_post_meta (  $current_page_id, 'mango_member_email', true ) : '';
   
  $tumblr = ( get_post_meta (  $current_page_id, 'mango_member_tumblr', true ) ) ? get_post_meta (  $current_page_id, 'mango_member_tumblr', true ) : '';
  
  $firstname = ( get_post_meta (  $current_page_id, 'mango_member_fname', true ) ) ? get_post_meta (  $current_page_id, 'mango_member_fname', true ) : '';
  
   $lastname = ( get_post_meta (  $current_page_id, 'mango_member_lname', true ) ) ? get_post_meta (  $current_page_id, 'mango_member_lname', true ) : '';
   
   $role = ( get_post_meta (  $current_page_id, 'mango_member_role'
, true ) ) ? get_post_meta (  $current_page_id, 'mango_member_role', true ) : '';
  
?>
      <div class="<?php echo esc_attr($containerClass); ?> main">
              <div class="row">
                   <div class="<?php echo esc_attr($mango_class_name); ?>">
                        <div class="row">
                        <?php 
                             if(has_post_thumbnail($post_id)){
					 $img_src_full = wp_get_attachment_url( get_post_thumbnail_id( $post_id, 'full' ) );
				
					}else{
				
					$img_src_full = "images/dummy-img.jpg";
					
					}?>
								<div class="col-md-6">
                                    <div class="portfolio-media">
                                        <img src="<?php echo $img_src_full?>" alt="<?php the_title(); ?>">
                                    </div><!-- End .portfolio-media -->
                                </div><!-- End .col-md-8 -->
							
						
                                <div class="col-md-6">
                                    <div class="portfolio-details">
									<?php 
									if($firstname || $lastname){
									?>
                                        <h2 class="regular-title">
										<?php echo esc_attr($firstname); ?>
										<?php echo esc_attr($lastname);?>
										</h2>
									<?php } ?>
                                        <h3><?php _e("BIOGRAPHY","mango") ?></h3>
                                        <?php the_content(); ?>
                                        <ul class="portfolio-details-list">
                                           
                                            <?php $terms =  get_the_terms($post->ID,"member-category");
                                          ?>
										  <?php if($role){?>
                                             <li><span><?php _e("Role","mango")?>:</span> <?php echo esc_attr($role) ?>
											 </li>
											<?php } ?>
                                            
                                            
                                            <!-- social share icons -->
                                           <div class="social-icons">
										   <?php 
										   if($facebook || $twitter || $linkedIn || $googleplus || $pinterest || $email || $tumblr){
										   ?>
										      <li>
											  <span><?php _e("Social Icons ","mango")?>:</span>
											  <?php if($facebook ){?>
											  <a class="social-icon icon-facebook" href="<?php echo esc_url($facebook )?>" target="_blank">
											  <i class="fa fa-facebook"></i></a>
											  <?php } ?>
											  <?php if($twitter ){?>
											<a class="social-icon icon-twitter" href="<?php echo esc_url($twitter)?>" target="_blank">
											<i class="fa fa-twitter"></i></a> 
											  <?php } ?>
											    <?php if($linkedIn ){?>
											<a class="social-icon icon-linkedin" href="<?php echo esc_url($linkedIn)?>" target="_blank">
											<i class="fa fa-linkedin"></i></a> 
											  <?php } ?>
											  <?php if($googleplus){?>
											<a class="social-icon icon-google" href="<?php echo esc_url($googleplus)?>" target="_blank">
											<i class="fa fa-google-plus"></i></a> 
											<?php } ?>
											  <?php if($pinterest){?>
											<a class="social-icon icon-pinterest" href="<?php echo esc_url($pinterest)?>" target="_blank">
											<i class="fa fa-pinterest"></i></a> 
											<?php } ?>
											 <?php if($email){?>
											<a class="social-icon icon-mail" href="<?php echo esc_url($email)?>" target="_blank">
											<i class="fa fa-envelope"></i></a>
											<?php } ?>
											
											<?php if($tumblr){?>
											<a class="social-icon icon-tumblr" href="<?php echo esc_url($tumblr)?>" target="_blank">
											<i class="fa fa-tumblr"></i></a>
											<?php } ?>
											</li>
										   <?php } ?>
										   </div>
                                        </ul>
									<?php if($member){?>
									<a href="<?php echo esc_url($member); ?>" target="_blank" class="btn btn-custom2">More Info</a>
									<?php } ?>
                                    </div>
                                </div>
                    
                        </div>
                     
                       
                    </div><!-- End .col-md-* -->
                    <div class="md-margin2x clearfix visible-sm visible-xs"></div><!-- space -->
                 <?php  get_sidebar() ?>
                </div><!-- End .row -->
    </div><!-- End .container -->
        <div class="lg-margin hidden-xs hidden-sm"></div><!-- space -->
    </section><!-- End #content -->
<?php get_footer() ?>