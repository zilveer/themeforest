<?php
/**
 * @KingSize 2011 - This is the page.php
 *
 * @KingSize Template by Denoizzed and Our Web Media
 * Developed by: Our Web Media 2011
 * Developer URL: http://themeforest.net/user/OurWebMedia
 * Original design by: Denoizzed 2010
 * Author URL: http://themeforest.net/user/Denoizzed
 **/
$tpl_body_id = 'blog_overview';
global $data,$postParentPageID;

get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php $postParentPageID = $post->ID; //Page POSTID for shortcodes 
$comment_status = $post->comment_status;


//comments enabled OR not checking
$CommentsEnabled = false;
if ( $data['wm_show_comments'] == 1  && $comment_status != "closed" ){
	$CommentsEnabled = true;
}elseif ( $data['wm_show_comments'] != 0   && $comment_status != "closed"  ) {
	$CommentsEnabled = true;
}
?>

  			<!--Page title start-->
  			<?php if ( $data['wm_show_page_post_headers'] == "" || $data['wm_show_page_post_headers'] == "0" ) { ?>
				<div class="row header">
					<div class="<?php if ( $data['wm_page_sidebar_enabled'] == "1" && get_post_meta($postParentPageID, 'page_sidebar_hide', true ) == "") {?>eight<?php } else { ?>twelve<?php } ?> columns">
						<h2 class="title-page"><?php the_title(); ?></h2>
					</div>
				</div>
			<?php } else { ?>
				<div class="row header">
					<div class="<?php if ( $data['wm_page_sidebar_enabled'] == "1" && get_post_meta($postParentPageID, 'page_sidebar_hide', true ) == "") {?>eight<?php } else { ?>twelve<?php } ?> columns">
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
    
			<!--Sample Page Start-->
            <div class="row">
            	<div class="<?php if ( $data['wm_page_sidebar_enabled'] == "1" && get_post_meta($postParentPageID, 'page_sidebar_hide', true ) == "") {?>blog page_content<?php }  else { ?>twelve columns  mobile-twelve page_content fullwidth-page<?php }?>">

					<?php if ( $data['wm_page_sidebar_enabled'] == "1" && get_post_meta($postParentPageID, 'page_sidebar_hide', true ) == "") {?>
					<div class="blog_block_left">
					<?php } ?>

					<!-- Content here -->
					<?php 
					///Enable the gallery with next previous of images
					if ( $data['wm_img_gallery_nxt_prev'] == "1" ) {	
						global $more_link_text,$stripteaser,$more_file;							
						$post_content = get_the_content($more_link_text, $stripteaser, $more_file);
						$post_content = apply_filters('the_content', $post_content);
						$post_content = str_replace(']]>', ']]&gt;', $post_content);
						
						//Gallery Shortcode is being used 
						global $tpl_body_id;
						if($tpl_body_id == "colorbox" ||  $tpl_body_id == "fancybox") {
							//$post_content = str_replace("<a ","<a rel='gallery' ",$post_content);
							echo $post_content;
						} 	
						else {
							//$post_content = str_replace("<a ","<a rel='prettyPhoto[gallery]' ",$post_content);
							echo $post_content;
						}
					}
					else {
						the_content();
					}
					?>
					<!-- End content  -->
				
					<?php if ( $CommentsEnabled == true) {?>
						<!-- Begin Post Comments -->
						<?php comments_template( '/comments.php' ); ?>
						<!-- End Post Comments -->
					<?php } ?>
					<!-- END blog_post comments_section -->
					
				<?php if ( $data['wm_page_sidebar_enabled'] == "1" && get_post_meta($postParentPageID, 'page_sidebar_hide', true ) == "") {?>
				</div><!-- end DIV .blog_block_left -->

				<div id="sidebar" class="blog_block_right"> <!-- Sidebar go here -->
					<?php if ( !function_exists('generated_dynamic_sidebar') || !generated_dynamic_sidebar("Pages Sidebar") ) : ?><?php endif; ?>
				</div>
				<?php } ?>

				</div> <!-- twelve columns/blog  -->
            </div> <!-- end row -->
        <!--Sample Page End-->

<?php endwhile; endif; ?>

<?php get_footer(); ?>
