<?php
/**
 Template Name: Galleria Page
 **/
global $postParentPageID,$data;
$postParentPageID = $post->ID; //Page POSTID
$tpl_body_id = 'galleria';
get_header(); 
update_option('current_page_template','body_portfolio body_galleria');

global $wp_query;

$template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );


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
      				<!-- Galleria - place you images here -->
      					<div class="row">
						 <div id="galleria">  					   					
							<?php 
								//getting the page Gallery attachments images
								$args = array('post_type' => 'attachment', 'post_parent' => $post->ID,  'orderby' => "menu_order ID", 'order' => ASC); 
								$attachments = get_children($args); 
								$url_post_img = "";					
								if ($attachments) { 
									foreach ($attachments as $attachment) { 										
										
										$url_post_img = wm_image_resize('680','450', wp_get_attachment_url($attachment->ID));
										$url_post_img_thumb = wm_image_resize('100','50', wp_get_attachment_url($attachment->ID));


											if(!empty($attachment->post_content))
												$post_title = $attachment->post_title."<p>".strip_tags($attachment->post_content)."</p>";
											elseif(get_post_meta($attachment->ID, '_wp_attachment_image_alt', true) == "")
												$post_title = $attachment->post_title;
											else
												$post_title = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
												
											if(get_post_meta($attachment->ID, '_wp_attachment_image_alt', true) == "")
												$post_alt = $attachment->post_title;
											else
												$post_alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
											
											if($data["wm_gallery_titles_galleria"] == "Enable Galleria Titles") {
												echo '<a href="'.$url_post_img.'" class="image">';
												
												echo '<img title="'.$post_title.'" data-title="'.$post_title.'"  src="'.$url_post_img_thumb.'"  data-big="'.wp_get_attachment_url($attachment->ID).'"  data-description="">';

												echo '</a>';
											} else {
												echo '<a href="'.$url_post_img.'" class="image">';
												
												echo '<img title="" data-title=""  src="'.$url_post_img_thumb.'"  data-big="'.wp_get_attachment_url($attachment->ID).'"  data-description="">';

												echo '</a>';
											}

										
								   }
								}
							?>	
						</div>	
						</div>
						<?php endif; //password protected check?> 
					  <?php endwhile; ?>
					<?php endif;?>
					 <!-- Galleria ends here -->

					 
						<?php if ( $CommentsEnabled == true) {?>
							<?php comments_template( '/comments.php' ); ?>
						<?php } else { ?>
							<!-- No Comments -->
						<?php } ?>
					 
<?php get_footer(); ?>
