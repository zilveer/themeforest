<?php
/**
 Template Name: SlideViewer Page
 **/
 global $data,$postParentPageID;

$tpl_body_id = 'slideviewer';
get_header(); 
update_option('current_page_template','body_portfolio body_slideviewer');

global $wp_query;
$template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );


$postParentPageID = $post->ID; //Page POSTID

//sidebar enabled OR not checking
$sidebarEnabled = false;
if ( $data['wm_page_sidebar_enabled'] == "1"  && get_post_meta($postParentPageID, 'page_sidebar_hide', true ) == "" )
	$sidebarEnabled = true;
elseif ( ($data['wm_page_sidebar_enabled'] == "0" || $data['wm_page_sidebar_enabled'] == "")  && get_post_meta($postParentPageID, 'page_sidebar_hide', true ) == "" ) 
	$sidebarEnabled = true;
?>	
	
			 <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      			
				<!--Page title start-->
      			<?php if ( $data['wm_show_page_post_headers'] == "" || $data['wm_show_page_post_headers'] == "0" ) { ?>
					<div class="row header">
						<div class="<?php if ( $sidebarEnabled == true ) {?>eight<?php } else { ?>twelve<?php } ?> columns">
							<h2 class="title-page"><?php the_title(); ?></h2>
						</div>
					</div>
				<?php } else { ?>
					<div class="row header">
						<div class="<?php if ( $sidebarEnabled == true ) {?>eight<?php } else { ?>twelve<?php } ?> columns">
							<h2 class="title-page"></h2>
						</div>
					</div>
				<?php } ?>					
				<!-- Ends Page title --> 
				
				<!-- Begin Breadcrumbs -->
				<div class="row">
					<div class="twelve columns">
						<?php if ( function_exists('yoast_breadcrumb') ) {
							yoast_breadcrumb('<p id="breadcrumbs" class="yoast-bc">','</p>');
						} ?>
					</div>
				</div>
				<!-- End Breadcrumbs -->
					
					<?php if($content = $post->post_content) {  the_content();  } else { the_content(); } ?>
   				  
				   <?php	
						$checkPasswd = false;
					if (!empty($post->post_password)) { // if there's a password
					if(!post_password_required($post->ID)) {
						$checkPasswd = true;
					 }
					 else
						 $checkPasswd = false;
					}
					else{
						$checkPasswd = true;
					}


					if($checkPasswd == true) :
					?>
				
      				<!-- slideviewer - place you images here -->
					 <div class="row">
      				   <div id="gallerySlideviewer">	
						 <ul class="rslides" id="slider">
							<?php 
								//getting the page Gallery attachments images
								$args = array('post_type' => 'attachment', 'post_parent' => $post->ID,  'orderby' => "menu_order ID", 'order' => ASC); 
								$attachments = get_children($args); 
								$url_post_img = "";								

								if ($attachments) { 
									foreach ($attachments as $attachment) { 										
										$url_post_img = wm_image_resize('670','450', wp_get_attachment_url($attachment->ID));
										$post_title = $attachment->post_title;

										if(get_post_meta($attachment->ID, '_wp_attachment_image_alt', true) == "")
											$post_alt = $attachment->post_title;
										else
											$post_alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
								?>	
									<li>
									<img src="<?php echo $url_post_img;?>" alt="<?php 	if($data["wm_gallery_titles_slideviewer"] == "Enable SlideViewer Titles") { echo $post_alt; } ?>" title="<?php if($data["wm_gallery_titles_slideviewer"] == "Enable SlideViewer Titles") { echo $attachment->post_title; } ?>">
									</li> 
							<?php
								   }
								}
							?>	
							</ul>
						 </div>	
						</div>	
						<?php endif; //password protected check ?> 
					  <?php endwhile; ?>
					<?php endif;?>
					 <!-- slideviewer ends here -->

					 
						<?php if ( $data['wm_show_comments'] == "1" ) {?>
							<?php comments_template( '/comments.php' ); ?>
						<?php } else { ?>
							<!-- No Comments -->
						<?php } ?>
					 

<?php get_footer(); ?>