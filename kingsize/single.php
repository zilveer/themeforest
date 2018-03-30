<?php
/**
  *
  * @KingSize 2011 - 2016
  * WordPress Developed by: O.W.M Consulting
  * https://www.ourwebmedia.com
  *
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

//sidebar enabled OR not checking
$page_sidebar_hide = "";
$page_sidebar_hide = get_post_meta($postParentPageID, 'post_sidebar_hide', true );

//sidebar enabled OR not checking
$sidebarEnabled = false;
if ( $data['wm_sidebar_enabled'] == 1  && $page_sidebar_hide != 1 ){
	$sidebarEnabled = true;
}
elseif ( $data['wm_sidebar_enabled'] != 0   && $page_sidebar_hide != 1  ) {
	$sidebarEnabled = true;
}
?>
   			 	
<!--Page title start-->
<?php if ( $data['wm_show_page_post_headers'] == "" || $data['wm_show_page_post_headers'] == "0" ) { ?>
<div class="row header">
	<div class="<?php if ( $sidebarEnabled == true ) {?>eight<?php } else { ?>twelve<?php } ?> columns">
		<h2 class="title-page"><?php $category = get_the_category(); echo $category[0]->cat_name; ?></h2>
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

<!--Blog Main Start-->					
<div class="row">

    <?php if ( $sidebarEnabled == true ) { ?>
		<div class="blog">
		<!-- Begin Left Content -->
		 <div class="blog_block_left">	
	<?php } else { ?>
		  <div class="twelve columns">
	<?php } ?>
		
        	<div class="blog_post">
        	    <!-- Begin Post Title -->     
            	<h3><a href="<?php echo get_permalink( $post->ID );?>"><?php the_title(); ?></a></h3>
            	<!-- End Post Title -->
            	
            	<!-- Begin Post Date -->
				<?php 
				if( $data['wm_date_enabled'] == '1' ) { //data is enabled
				?>
                <div class="blog_date">                    	
                    <ul class="icon-list">
                        <li><i class="fa fa-calendar"></i></li>
                        <li> <?php the_time(get_option('date_format')); ?></li>
                    </ul>                                              
                </div>
                <?php
                 }
                ?>	
                <!-- End Post Date -->
			</div>

			    <!-- Begin Post Thumbnail -->	
				<?php
				 if ( $data['wm_show_featured_image'] == "0" || get_post_meta($post->ID, 'kingsize_post_featured_img_inside', true ) == 1) {

					################################################
					//show the image in lightbox									
						$show_image_lightbox = get_post_meta($post->ID, 'kingsize_featured_img_lightbox', true );

					//POST featured image height
						if(get_post_meta($post->ID, 'kingsize_post_featured_img_height', true ))
							$post_featured_img_height = get_post_meta($post->ID, 'kingsize_post_featured_img_height', true );
						else
							$post_featured_img_height = null;

					$post_featured_img_width = 680;//showing full width
					################################################
								
						if(has_post_thumbnail()): // POST has thumbnail
							echo '<div class="blog_post">';
							echo '<div class="blog_text marginT10">';


							$org_img_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
							$attachment_id =  get_post_thumbnail_id($post->ID);

							$url_post_img = aq_resize( wp_get_attachment_url($attachment_id), $post_featured_img_width, $post_featured_img_height, true, true, true );

							$image = aq_resize(wp_get_attachment_url(get_post_thumbnail_id(get_the_id())),  $post_featured_img_width, $post_featured_img_height, true, false, true); 
							
							if($show_image_lightbox=='enable')
								echo '<a href="'.$org_img_url.'" class="image lightbox_blog" title="'.get_the_title().'" rel="gallery"><img src="'.$url_post_img.'" title="'.get_the_title().'" class="blog_thumbnail"  width="'.$image[1].'" height="'.$image[2].'"/></a>';
							else 
								echo '<a href="'.get_permalink( $post->ID ).'" class="image lightbox_not" title="'.get_the_title().'"><img src="'.$url_post_img.'" title="'.get_the_title().'" class="blog_thumbnail"  width="'.$image[1].'" height="'.$image[2].'"/></a>';

							echo '</div>';	
							echo '</div>';	
						endif;

				 }
				?>
				<!-- End Post thubmnail -->

			<div class="blog_post page_content">
				<!-- Begin Post Content -->
				<?php 
				///Enable the gallery with next previous of images
				if ( $data['wm_img_gallery_nxt_prev'] == "1" ) {	
					global $more_link_text,$stripteaser,$more_file;									
					$post_content = get_the_content($more_link_text, $stripteaser, $more_file);
					$post_content = apply_filters('the_content', $post_content);
					$post_content = str_replace(']]>', ']]&gt;', $post_content);

					global $tpl_body_id;
					if($tpl_body_id == "colorbox" ||  $tpl_body_id == "fancybox") {
						echo $post_content;
					} 	
					else {
						echo $post_content;
					}
				}
				else {
					the_content();
				}
				?>
				<!-- End Post Content -->
				</div>
				
				<!-- Begin Next/Prev Pagination -->
				<?php 
				if( $data['wm_nextprev_pagi_enabled'] == '1' ) { //next-prev pagination
				?>
				<div class="row next-prev-pagi">
					<?php 
					$mam_global_stay_in_cat = false;
					if(isset($_GET['stayincat'])) {
						$mam_global_stay_in_cat = ($_GET['stayincat']) ? $_GET['stayincat'] : false;
					 }
					 if ( $mam_global_stay_in_cat ) { ?>
						<div class="six columns prev-post"><?php previous_post_link('Previous Post:<br /> &larr; %link','%title',true); ?></div>
						<div class="six columns next-post"><?php next_post_link('Next Post:<br /> %link &rarr;','%title',true); ?></div>
					<?php } else { ?>
						<div class="six columns prev-post"><?php previous_post_link('Previous Post:<br /> &larr; %link','%title',true); ?></div>
						<div class="six columns next-post"><?php next_post_link('Next Post:<br /> %link &rarr;'); ?></div>	
					<?php } ?>	 		
				</div>
				<?php
				 }
				?>
				<!-- /End Next/Prev Pagination -->

				<!-- Begin Post Tags -->
				<?php
				$tags = get_the_tags();
				
				if($tags) :
				?>
				<div class="blog_post">
					<div class="blog_date blog_tags">                    	
						<ul class="icon-list tags">                        	                       
						<li><i class="fa fa-tags"></i> <?php echo __('Tags: ', 'kslang');?></li>
						<?php
							$cnt = 0; 
							foreach ( $tags as $tag ) {
							$cnt++;

								$tag_link = get_tag_link( $tag->term_id );
								$html .= "<li><a href='{$tag_link}' title='{$tag->name} Tag' class='underline {$tag->slug}'>";
								if(count($tags) == $cnt) 
									$html .= "{$tag->name}</a></li>";
								else
									$html .= "{$tag->name},</a></li>";
							
							}
							echo $html;
						?>
						</ul>
					</div>
				</div>
				<?php endif; ?>
				<!-- End Post Tags -->
				
			<?php if ( $CommentsEnabled == true) {?>
				<!-- Begin Post Comments -->
				<?php comments_template( '/comments.php' ); ?>
				<!-- End Post Comments -->
			<?php } ?>
			<!-- END blog_post comments_section -->

        
        <!-- Begin Sidebar -->
		<?php if ( $sidebarEnabled == true ) { ?>
			</div><!-- End Left Content -->
			<div id="sidebar" class="blog_block_right">			        
				<?php if ( !function_exists('generated_dynamic_sidebar') || !generated_dynamic_sidebar("Main Blog Sidebar") ) : ?><?php endif; ?>
			</div> 
		<?php } ?>
		<!-- End Sidebar --> 
        
    </div><!-- END blog -->
</div>	<!-- END row  -->

<?php endwhile; endif; ?>
<?php get_footer(); ?>
