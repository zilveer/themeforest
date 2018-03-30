<?php
/**
 Template Name: Fancybox Page
 **/
global $postParentPageID,$data;
$postParentPageID = $post->ID; //Page POSTID
$tpl_body_id = 'fancybox';
get_header(); 
update_option('current_page_template','body_portfolio body_fancybox body_gallery_2col_fb');

global $wp_query;
$template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );

$no_of_page_columns = get_post_meta( $wp_query->post->ID, 'kingsize_page_columns', true );
if(empty($no_of_page_columns))
	$no_of_page_columns = "2columns";


//comments enabled OR not checking
$comment_status = $postParentPageID->comment_status;

//comments enabled OR not checking
$CommentsEnabled = false;
if ( $data['wm_show_comments'] == 1  && $comment_status != "closed" ){
	$CommentsEnabled = true;
}elseif ( $data['wm_show_comments'] != 0   && $comment_status != "closed"  ) {
	$CommentsEnabled = true;
}

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
      					<!-- Gallery with fancybox plugin -->
      					<div class="row gallery-space pV0H10">							
							<?php 
								//getting the page Gallery attachments images
								$args = array('post_type' => 'attachment', 'post_parent' => $post->ID,  'orderby' => "menu_order ID", 'order' => ASC); 
								$attachments = get_children($args); 
								$url_post_img = "";								

								if ($attachments) { 
									foreach ($attachments as $attachment) { 

										########### TITLE AND ALT ###########
										$post_title = $attachment->post_title."<p>".strip_tags($attachment->post_content)."</p>";

										if(get_post_meta($attachment->ID, '_wp_attachment_image_alt', true) == "")
											$post_alt = $attachment->post_title;
										else
											$post_alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
										  
										 
										  ########### FIXING # OF COLUMN AND IMAGE URL ###########
											if($no_of_page_columns=="2columns"){
												$div_layout = "six columns mobile-three";
												/*Make it responsive V5*/
												$url_post_img = wm_image_resize('400','250', wp_get_attachment_url($attachment->ID));
												$relative_gal = 'data-fancybox-group="gallery_2col"';

												$class_gal = 'gallery_2col';
											}
											elseif($no_of_page_columns=="3columns"){
												$div_layout = "four columns mobile-four";
												$url_post_img = wm_image_resize('400','250', wp_get_attachment_url($attachment->ID));
												$relative_gal = 'data-fancybox-group="gallery_3col"';

												$class_gal = 'gallery_3col';
											}
											elseif($no_of_page_columns=="4columns"){
												$div_layout = "three columns mobile-one";
												$url_post_img = wm_image_resize('400','250', wp_get_attachment_url($attachment->ID));
												$relative_gal = 'data-fancybox-group="gallery_4col"';

												$class_gal = 'gallery_4col';
											}
											elseif($no_of_page_columns=="grid"){
												$div_layout = "six_col columns mobile-one";
												$url_post_img = wm_image_resize('500','500', wp_get_attachment_url($attachment->ID));
												$relative_gal = 'data-fancybox-group="gallery_grid"';

												$class_gal = 'gallery_2col';
											}

											

								?>
									
									<div class="<?php echo $div_layout;?> space-bottom mobile-fullwidth">
										<div class="row">
											<div class="twelve columns pV0H5  gallery_fancybox">
												<a class="<?php echo $class_gal;?> fancybox image" href="<?php echo wp_get_attachment_url($attachment->ID);?>"  <?php echo $relative_gal;?> title="<?php  if($data["wm_gallery_titles_fancybox"] == "Enable Fancybox Titles") echo $post_title."<p>".strip_tags($attachment->post_content)."</p>"; ?>">
												<?php //lazy loader
												if($data["wm_lazyloader_option"] == "Enable Lazyloader") : ?>
												<img  class="lazy" data-original="<?php echo $url_post_img?>" src="<?php echo get_template_directory_uri().'/images/loading.gif';?>" alt="<?php if($data["wm_gallery_titles_fancybox"] == "Enable Fancybox Titles") echo $post_alt;?>" title="<?php if($data["wm_gallery_titles_fancybox"] == "Enable Fancybox Titles") echo $attachment->post_title;?>">
												<?php else :?>
												<img  src="<?php echo $url_post_img;?>" alt="<?php if($data["wm_gallery_titles_fancybox"] == "Enable Fancybox Titles") echo $post_alt;?>" title="<?php if($data["wm_gallery_titles_fancybox"] == "Enable Fancybox Titles") echo $attachment->post_title;?>">
												<?php endif;?>
												</a>  
											</div>
										</div>
									</div>  
									
							<?php
								   }
								}
							?>								
						 </div>  
						<?php endif; //password protected check ?> 

						<?php endwhile; ?>
						<?php endif;?>
						<!-- Gallery ends here -->

						
						<?php if ( $CommentsEnabled == true) {?>
							<?php comments_template( '/comments.php' ); ?>
						<?php } else { ?>
							<!-- No Comments -->
						<?php } ?>

<?php get_footer(); ?>
