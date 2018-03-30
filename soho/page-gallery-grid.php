<?php 
/*
Template Name: Gallery - Grid
*/
if ( !post_password_required() ) {
get_header('fullscreen');
the_post();

$gt3_theme_pagebuilder = gt3_get_theme_pagebuilder(get_the_ID());
$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
$pf = get_post_format();
wp_enqueue_script('gt3_cookie_js', get_template_directory_uri() . '/js/jquery.cookie.js', array(), false, true);
wp_enqueue_script('gt3_swipebox_js', get_template_directory_uri() . '/js/jquery.swipebox.js', array(), false, true);
if (isset($gt3_theme_pagebuilder['gallery']['interval'])) {
	$setPad = $gt3_theme_pagebuilder['gallery']['interval'];
} else {
	$setPad = '0px';
}
if ((int)$setPad > 0) {
	$hasPad = "with_padding";
} else {
	$hasPad = "without_padding";
}

?>
    <div class="fullscreen_block fullscreen_portfolio <?php echo $hasPad; ?>">
        <style>
			.fw-portPreview {
				padding:0 <?php echo $setPad; ?> <?php echo $setPad; ?> 0;
			}
		</style>  
        <div class="fs_blog_module fw_port_module2" style="padding-top:<?php echo $setPad; ?>; margin-left:<?php echo $setPad; ?>;">  
		<?php 
			if (isset($gt3_theme_pagebuilder['settings']['show_by']) && $gt3_theme_pagebuilder['settings']['show_by'] == 'by_category') {
				global $wp_query_in_shortcodes, $paged;
				
				if(empty($paged)){
					$paged = (get_query_var('page')) ? get_query_var('page') : 1;
				}			
				if (isset($gt3_theme_pagebuilder['settings']['cat_ids']) && (is_array($gt3_theme_pagebuilder['settings']['cat_ids']))) {
					$compile_cats = array();
					foreach ($gt3_theme_pagebuilder['settings']['cat_ids'] as $catkey => $catvalue) {
						array_push($compile_cats, $catkey);
					}
					$selected_categories = implode(",", $compile_cats);
				} else {
					$selected_categories = "";
				}
				$post_type_terms = array();
				if (isset($selected_categories) && strlen($selected_categories) > 0) {
					$post_type_terms = explode(",", $selected_categories);
				}
				
				$wp_query_in_shortcodes = new WP_Query();
				$args = array(
					'post_type' => 'gallery',
					'order' => 'DESC',
					'paged' => $paged,
					'posts_per_page' => -1
				);
	
				if (isset($_GET['slug']) && strlen($_GET['slug']) > 0) {
					$post_type_terms = $_GET['slug'];
				}
				if (count($post_type_terms) > 0) {
					$args['tax_query'] = array(
						array(
							'taxonomy' => 'gallerycat',
							'field' => 'id',
							'terms' => $post_type_terms
						)
					);
				}
		?>	    
		<?php 
	        $wp_query_in_shortcodes->query($args);			
	        while ($wp_query_in_shortcodes->have_posts()) : $wp_query_in_shortcodes->the_post();
				$all_likes = gt3pb_get_option("likes");
				$gt3_theme_post = get_plugin_pagebuilder(get_the_ID());
				$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
				$pf = get_post_format();
				$echoallterm = '';
				$new_term_list = get_the_terms(get_the_id(), "gallerycat");
				$sliderCompile = "";
				foreach ($gt3_theme_post['sliders']['fullscreen']['slides'] as $imageid => $image) { 
					if (isset($image['title']['value']) && strlen($image['title']['value'])>0) {$photoTitleOutput = $image['title']['value'];} else {$photoTitleOutput = "";}
					if (isset($image['caption']['value']) && strlen($image['caption']['value'])>0) {$photoCaption  = $image['caption']['value'];} else {$photoCaption = "";}				
				?>                
				<div <?php post_class("blogpost_preview_fw"); ?>>
					<div class="fw-portPreview">
                        <div class="img_block wrapped_img fs_port_item gallery_item_wrapper">
							<?php
                                if ($image['slide_type'] == "image") {
                                    echo '<a class="featured_ico_link swipebox" href="'. wp_get_attachment_url($image['attach_id']) .'" title="'.$photoTitleOutput.'">';
                                } else {
									$set_rel = '';
									$is_youtube = substr_count($image['src'], "youtu");	
									if ($is_youtube > 0) {
										$set_rel = 'youtube';
									}
									$is_vimeo = substr_count($image['src'], "vimeo");
									if ($is_vimeo > 0) {
										$set_rel = 'vimeo';
									}
									
                                    echo '<a href="'. $image['src'] .'" class="featured_ico_link swipebox" rel="'. $set_rel .'" title="'.$photoTitleOutput.'">';
                                }									
                            ?></a>
                            <img width="540" height="" src="<?php echo aq_resize(wp_get_attachment_url($image['attach_id']), "540", "440", true, true, true); ?>" alt="<?php echo $photoTitleOutput; ?>" />							
                            <div class="gallery_fadder"></div>
                            <span class="featured_items_ico"></span>                            
                        </div>                    
                    </div>
                </div>                                                
				<?php } ?>
            
			<?php endwhile; wp_reset_query();
			} else {
				if (!isset($gt3_theme_pagebuilder['gallery']['selected_gallery'])) {
					$tmp_query = null;
					$tmp_query = new WP_Query();
					$tmp_args = array(
						'post_type' => 'gallery',
						'posts_per_page' => -1,
					);
					$tmp_query->query($tmp_args);			        
					while ($tmp_query->have_posts()) : $tmp_query->the_post();
						$selected_gallery = get_the_ID();
						continue;
					endwhile;
				} else {
					$selected_gallery = $gt3_theme_pagebuilder['gallery']['selected_gallery'];
				}
				$galleryPageBuilder = get_plugin_pagebuilder($selected_gallery);
				?>
				<?php if (isset($galleryPageBuilder['sliders']['fullscreen']['slides']) && is_array($galleryPageBuilder['sliders']['fullscreen']['slides'])) {
					foreach ($galleryPageBuilder['sliders']['fullscreen']['slides'] as $imageid => $image) {
						$all_likes = gt3pb_get_option("likes");
						if (isset($image['title']['value']) && strlen($image['title']['value'])>0) {$photoTitleOutput = $image['title']['value'];} else {$photoTitleOutput = "";}
						if (isset($image['caption']['value']) && strlen($image['caption']['value'])>0) {$photoCaption  = $image['caption']['value'];} else {$photoCaption = "";}?>
                        <div <?php post_class("blogpost_preview_fw"); ?>>

					<div class="fw-portPreview">
                        <div class="img_block wrapped_img fs_port_item gallery_item_wrapper">
									<?php
										if ($image['slide_type'] == "image") {
											echo '<a class="featured_ico_link swipebox" href="'. wp_get_attachment_url($image['attach_id']) .'" title="'.$photoTitleOutput.'">';
										} else {
											$set_rel = '';
											$is_youtube = substr_count($image['src'], "youtu");	
											if ($is_youtube > 0) {
												$set_rel = 'youtube';
											}
											$is_vimeo = substr_count($image['src'], "vimeo");
											if ($is_vimeo > 0) {
												$set_rel = 'vimeo';
											}
											
											echo '<a href="'. $image['src'] .'" class="featured_ico_link swipebox" rel="'. $set_rel .'" title="'.$photoTitleOutput.'">';
										}									
                                    ?>
							</a>
                            <img width="540" height="" src="<?php echo aq_resize(wp_get_attachment_url($image['attach_id']), "540", "440", true, true, true); ?>" alt="<?php echo $photoTitleOutput; ?>" />
                            <div class="gallery_fadder"></div>
                            <span class="featured_items_ico"></span>
                        </div>                    
                    </div>
                </div>                                                
						<?php
					}
				}
				echo "</div>";
			}
			?>
            
            <div class="clear"></div>
        </div>
	</div>
    
    <script>
		jQuery(document).ready(function($){
			port_setup();
		});	
		jQuery(window).load(function($){
			port_setup();
		});	
		jQuery(window).resize(function($){
			port_setup();
		});
		function port_setup() {
			jQuery('.fw-portPreview-content').each(function(){
				jQuery(this).css('margin-top', -1*jQuery(this).height()/2+'px');
			});				
		}		
    </script>    
	<?php 
		$GLOBALS['showOnlyOneTimeJS']['gallery_likes'] = "
		<script>
			jQuery(document).ready(function($) {
				jQuery('.gallery_likes_add').click(function(){
				var gallery_likes_this = jQuery(this);
				if (!jQuery.cookie(gallery_likes_this.attr('data-modify')+gallery_likes_this.attr('data-attachid'))) {
					jQuery.post(gt3_ajaxurl, {
						action:'add_like_attachment',
						attach_id:jQuery(this).attr('data-attachid')
					}, function (response) {
						jQuery.cookie(gallery_likes_this.attr('data-modify')+gallery_likes_this.attr('data-attachid'), 'true', { expires: 7, path: '/' });
						gallery_likes_this.addClass('already_liked');
						gallery_likes_this.find('i').removeClass('icon-heart-o').addClass('icon-heart');
						gallery_likes_this.find('span').text(response);
					});
				}
				});
			});
		</script>
		";		
	?>
    
<?php get_footer('fullscreen'); 
} else {
	get_header('fullscreen');
?>
    <div class="pp_block">
        <h1 class="pp_title"><?php  _e('THIS CONTENT IS', 'theme_localization') ?> <span><?php  _e('PASSWORD PROTECTED', 'theme_localization') ?></span></h1>
        <div class="pp_wrapper">
            <?php the_content(); ?>
        </div>
    </div>
    <div class="global_center_trigger"></div>	
    <script>
		jQuery(document).ready(function(){
			jQuery('.post-password-form').find('label').find('input').attr('placeholder', 'Enter The Password...');
		});
	</script>
<?php 
	get_footer('fullscreen');
} ?>