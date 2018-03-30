<?php 
/*
Template Name: Fullscreen Blog
*/
if ( !post_password_required() ) {
get_header('fullscreen');
the_post();
wp_enqueue_script('gt3_masonry_js', get_template_directory_uri() . '/js/masonry.min.js', array(), false, true);
wp_enqueue_script('gt3_nivo_js', get_template_directory_uri() . '/js/nivo.js', array(), false, true);			
wp_enqueue_script('gt3_cookie_js', get_template_directory_uri() . '/js/jquery.cookie.js', array(), false, true);

$gt3_theme_pagebuilder = gt3_get_theme_pagebuilder(get_the_ID());
$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
$pf = get_post_format();
?>
   <div class="fullscreen_block">
	    <div class="fs_blog_module is_masonry this_is_blog">
		<?php 
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
			$wp_query_in_shortcodes = new WP_Query();
			$args = array(
				'post_type' => 'post',
				'paged' => $paged,
				'cat' => $selected_categories,				
                'post_status' => 'publish',
				'posts_per_page' => gt3_get_theme_option('fw_posts_per_page')
			);			
	        $wp_query_in_shortcodes->query($args);
	        while ($wp_query_in_shortcodes->have_posts()) : $wp_query_in_shortcodes->the_post();
				$all_likes = gt3pb_get_option("likes");
				$gt3_theme_pagebuilder = get_post_meta(get_the_ID(), "pagebuilder", true);
	
				if(get_the_category()) $categories = get_the_category();
				$post_categ = '';
				$separator = ', ';
				if ($categories) {						
					foreach($categories as $category) {
						$post_categ = $post_categ .'<a href="'.get_category_link( $category->term_id ).'">'.$category->cat_name.'</a>'.$separator;
					}
				}
			
			?>
				<div <?php post_class("blogpost_preview_fw"); ?>>
					<div class="fw_preview_wrapper featured_items">
                        <div class="img_block wrapped_img">
	                    	<?php echo get_pf_type_output(array("pf" => get_post_format(), "gt3_theme_pagebuilder" => $gt3_theme_pagebuilder, "width" => '585', "height" => '', "fw_post" => true, 'link2post' => get_permalink())); ?>
                        </div>
                        <div class="bottom_box">
                            <div class="bc_content">
                                <h5 class="bc_title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h5>
                                <div class="featured_items_meta">
                                    <span class="preview_meta_data"><?php echo get_the_time("F d, Y") ?></span>
                                    <span class="middot">&middot;</span>
									<span><?php echo trim($post_categ, ', ') ?></span>
                                    <span class="middot">&middot;</span>
									<span><a href="<?php echo get_comments_link() ?>"><?php echo get_comments_number(get_the_ID()); _e('comments', 'theme_localization') ?></a></span>                                    
                                </div>									
                            </div>
                            <div class="bc_likes gallery_likes_add <?php echo (isset($_COOKIE['like_post'.get_the_ID()]) ? "already_liked" : ""); ?>" data-attachid="<?php echo get_the_ID(); ?>" data-modify="like_post">
                                <i class="stand_icon <?php echo (isset($_COOKIE['like_post'.get_the_ID()]) ? "icon-heart" : "icon-heart-o"); ?>"></i>
                                <span><?php echo ((isset($all_likes[get_the_ID()]) && $all_likes[get_the_ID()]>0) ? $all_likes[get_the_ID()] : 0); ?></span>
                            </div>
                        </div>                                                
					</div>
				</div>            
			<?php endwhile; wp_reset_query();?>
        </div>
	</div>
		<script>
        jQuery(window).resize(function () {
			jQuery('.is_masonry').masonry();
			iframe16x9(jQuery('.fs_blog_module'));
        });
        jQuery(window).load(function () {
			jQuery('.is_masonry').masonry();
			iframe16x9(jQuery('.fs_blog_module'));
        });
		jQuery(document).ready(function($){
			iframe16x9(jQuery('.fs_blog_module'));
			jQuery('.custom_bg').remove();
			jQuery('.is_masonry').masonry();
			setTimeout("jQuery('.is_masonry').masonry();",1000);
			setTimeout("jQuery('.is_masonry').masonry();",2000);			

            jQuery('.gallery_likes_add').bind('click',function(){
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
            jQuery('.nivoSlider').each(function(){
                jQuery(this).nivoSlider({
                    directionNav: false,
                    controlNav: true,
                    effect:'fade',
                    pauseTime:4000,
                    slices: 1
                });
            });			
		});
		function iframe16x9fb(container) {
			container.find('iframe').each(function(){
				jQuery(this).height((jQuery(this).width()/16)*9);
			});
		}		
    </script>
	<script>
        var posts_already_showed = <?php gt3_the_theme_option('fw_posts_per_page'); ?>,
			<?php if (isset($selected_categories) && strlen($selected_categories) > 0) {
				echo 'categories = "'. $selected_categories .'";';
			} else {
				echo 'categories = "";';
			}?>

        function get_works() {
            <?php if (gt3_get_theme_option("demo_server") == "true") { ?> if (posts_already_showed > 15) {posts_already_showed = 0;} <?php } ?>
            gt3_get_blog_posts("post", <?php gt3_the_theme_option('fw_posts_per_page'); ?>, posts_already_showed, "fw_blog_template", ".fs_blog_module", categories, '0px');
            posts_already_showed = posts_already_showed + <?php gt3_the_theme_option('fw_posts_per_page'); ?>;
        }

        jQuery(document).ready(function () {
            jQuery(window).on('scroll', scrolling);
        });
    </script>    
<?php get_footer('fullwidth'); 
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