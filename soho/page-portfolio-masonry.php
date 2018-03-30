<?php 
/*
Template Name: Portfolio - Masonry Style
*/
if ( !post_password_required() ) {
get_header('fullscreen');
the_post();

$gt3_theme_pagebuilder = gt3_get_theme_pagebuilder(get_the_ID());
$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
$pf = get_post_format();
wp_enqueue_script('gt3_cookie_js', get_template_directory_uri() . '/js/jquery.cookie.js', array(), false, true);

if (isset($gt3_theme_pagebuilder['portfolio']['port_type']) && $gt3_theme_pagebuilder['portfolio']['port_type'] == 'port_isotope') {
	wp_enqueue_script('gt3_isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), false, true);
	wp_enqueue_script('gt3_isotope_sorting', get_template_directory_uri() . '/js/sorting.js', array(), false, true);
} else {
	wp_enqueue_script('gt3_masonry_js', get_template_directory_uri() . '/js/masonry.min.js', array(), false, true);
	wp_enqueue_script('gt3_endlessScroll_js', get_template_directory_uri() . '/js/jquery.endless-scroll.js', array(), false, true);
}
if (isset($gt3_theme_pagebuilder['fs_portfolio']['interval'])) {
	$setPad = $gt3_theme_pagebuilder['fs_portfolio']['interval'];
} else {
	$setPad = '0px';
}
if ((int)$setPad > 0) {
	$hasPad = "with_padding";
} else {
	$hasPad = "without_padding";
}

?>
        <style>
			.optionset li a,
			.load_more_works {
				color:#<?php echo esc_attr($gt3_theme_pagebuilder['fs_portfolio']['filter_color']); ?>;
			}
			.load_more_works span:before,
			.load_more_works span:after {
				background:#<?php echo esc_attr($gt3_theme_pagebuilder['fs_portfolio']['filter_color']); ?>;
			}
			.optionset li:before {
				color:#<?php echo esc_attr($gt3_theme_pagebuilder['fs_portfolio']['filter_divider']); ?>;
			}
			.optionset li.selected a,
			.optionset li a:hover,
			.load_more_works:hover {
				color:#<?php echo esc_attr($gt3_theme_pagebuilder['fs_portfolio']['filter_selected']); ?>;
			}
			.load_more_works:hover span:before,
			.load_more_works:hover span:after {
				background:#<?php echo esc_attr($gt3_theme_pagebuilder['fs_portfolio']['filter_selected']); ?>;
			}
			.fw-portPreview {
				padding:0 <?php echo $setPad; ?> <?php echo $setPad; ?> 0;
			}
		</style>

    <div class="fullscreen_block fullscreen_portfolio <?php echo $hasPad; ?>">
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
			}
            $post_type_terms = array();
			if (isset($selected_categories) && strlen($selected_categories) > 0) {
				$post_type_terms = explode(",", $selected_categories);
				$post_type_filter = explode(",", $selected_categories);
				$post_type_field = "id";
			}
			
			$wp_query_in_shortcodes = new WP_Query();
            $args = array(
                'post_type' => 'port',
                'order' => 'DESC',
                'paged' => $paged,
                'posts_per_page' => gt3_get_theme_option('fw_port_per_page')
            );

            if (isset($_GET['slug']) && strlen($_GET['slug']) > 0) {
                $post_type_terms = $_GET['slug'];
				$selected_categories = $_GET['slug'];
				$post_type_field = "slug";
            }
            if (count($post_type_terms) > 0) {
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'portcat',
                        'field' => $post_type_field,
                        'terms' => $post_type_terms
                    )
                );
            }	
		if (!isset($gt3_theme_pagebuilder['fs_portfolio']['filter']) || $gt3_theme_pagebuilder['fs_portfolio']['filter'] == 'on') {
			$compile = '';
			$compile .= showAsidePortCats($post_type_filter);
			echo $compile;
		}							
		?>
        <div class="fs_blog_module is_masonry fs_filter" style="padding-top:<?php echo $setPad; ?>; margin-left:<?php echo $setPad; ?>;">
		<?php 
	        $wp_query_in_shortcodes->query($args);			
	        while ($wp_query_in_shortcodes->have_posts()) : $wp_query_in_shortcodes->the_post();
				$all_likes = gt3pb_get_option("likes");
				$gt3_theme_post = get_plugin_pagebuilder(get_the_ID());
				$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
				$featured_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
				$pf = get_post_format();
                $target = (isset($gt3_theme_post['settings']['new_window']) && $gt3_theme_post['settings']['new_window'] == "on" ? "target='_blank'" : "");
				if (isset($gt3_theme_post['page_settings']['portfolio']['work_link']) && strlen($gt3_theme_post['page_settings']['portfolio']['work_link']) > 0) {
					$linkToTheWork = esc_url($gt3_theme_post['page_settings']['portfolio']['work_link']);
				} else {
					$linkToTheWork = get_permalink();
				}
				$echoallterm = '';
				$echoallterm2 = '';
				$portCateg = '';
				$new_term_list = get_the_terms(get_the_id(), "portcat");
                if (is_array($new_term_list)) {
                    foreach ($new_term_list as $term) {
                        $tempname = strtr($term->name, array(
                            ' ' => '-',
                        ));
                        $echoallterm .= strtolower($tempname) . ", ";
						$echoallterm2 .= strtolower($tempname) . " ";
						$portCateg .= $tempname . ", ";
                        $echoterm = $term->name;
                    }
                } else {
                    $portCateg = 'Uncategorized  ';
                }
				$portCateg = substr($portCateg, 0, -2);
			?>
            <?php if (isset($gt3_theme_pagebuilder['portfolio']['port_type']) && $gt3_theme_pagebuilder['portfolio']['port_type'] == 'port_isotope') { ?>
				<div <?php post_class("blogpost_preview_fw element ". $echoallterm2); ?> data-category="<?php echo $echoallterm2 ?>">
            <?php } else { ?>
				<div <?php post_class("blogpost_preview_fw"); ?>>
			<?php } ?>
					<div class="fw-portPreview">
                        <div class="img_block wrapped_img fs_port_item">
                            <a class="featured_ico_link" href="<?php echo $linkToTheWork; ?>" <?php echo $target; ?>>
                            	<img alt="<?php echo $featured_alt; ?>" width="540" height="" src="<?php echo aq_resize($featured_image[0], "540", "", true, true, true); ?>" />
							</a>
                            <div class="bottom_box">
                                <div class="bc_content">
                                    <h5 class="bc_title"><a href="<?php echo $linkToTheWork; ?>" <?php echo $target; ?>><?php the_title(); ?></a></h5>
                                    <div class="featured_items_meta">
                                        
                                        <span><?php echo $portCateg; ?></span>
                                        <span class="middot">&middot;</span>
                                        <span class="preview_meta_comments"><a href="<?php echo get_comments_link(); ?>"><?php echo get_comments_number(get_the_ID()) . ' '. __('comments', 'theme_localization'); ?></a></span>
                                    </div>									
                                </div>
                                <div class="bc_likes gallery_likes_add <?php echo (isset($_COOKIE['like_port'.get_the_ID()]) ? "already_liked" : ""); ?>" data-attachid="<?php echo get_the_ID(); ?>" data-modify="like_port">
                                    <i class="stand_icon <?php echo (isset($_COOKIE['like_port'.get_the_ID()]) ? "icon-heart" : "icon-heart-o"); ?>"></i>
                                    <span><?php echo ((isset($all_likes[get_the_ID()]) && $all_likes[get_the_ID()]>0) ? $all_likes[get_the_ID()] : 0); ?></span>
                                </div>
                            </div>
                            <div class="portFadder"></div>
                        </div>                    
                    </div>
                </div>      
			<?php endwhile; wp_reset_query();?>
        </div>
		<?php if (isset($gt3_theme_pagebuilder['portfolio']['port_type']) && $gt3_theme_pagebuilder['portfolio']['port_type'] == 'port_isotope') { ?>
            <a href="<?php echo esc_js("javascript:void(0)");?>" class="load_more_works"><span class="load_more_plus"></span><?php _e('more', 'theme_localization') ?></a>
            
        <?php }?>        
	</div>

    <script>
		jQuery(document).ready(function() {
			jQuery('.fs_port_item').hover(function(){
				html.addClass('fadeMe');
				jQuery(this).addClass('unfadeMe');
			},function(){
				html.removeClass('fadeMe');
				jQuery(this).removeClass('unfadeMe');
			});
		});
		
        var posts_already_showed = <?php gt3_the_theme_option('fw_port_per_page'); ?>,
			<?php if (isset($selected_categories) && strlen($selected_categories) > 0) {
				echo 'categories = "'. $selected_categories .'"';
			} else {
				echo 'categories = ""';
			}?>

	<?php if (isset($gt3_theme_pagebuilder['portfolio']['port_type']) && $gt3_theme_pagebuilder['portfolio']['port_type'] == 'port_isotope') {?>
        function get_works() {
            gt3_get_isotope_posts("port", <?php gt3_the_theme_option('fw_port_per_page'); ?>, posts_already_showed, "port_masonry_isotope", ".fs_blog_module", categories, '<?php echo $setPad; ?>', '<?php echo $post_type_field; ?>');
            posts_already_showed = posts_already_showed + <?php gt3_the_theme_option('fw_port_per_page'); ?>;
        }
        jQuery(document).ready(function () {
            jQuery('.load_more_works').click(function(){
				get_works();
			});
        });
	<?php } else { ?>
        function get_works() {
            <?php if (gt3_get_theme_option("demo_server") == "true") { ?> if (posts_already_showed > 14) {posts_already_showed = 0;} <?php } ?>
            gt3_get_portfolio("port", <?php gt3_the_theme_option('fw_port_per_page'); ?>, posts_already_showed, "port_masonry_template", ".fs_blog_module", categories, '<?php echo $setPad; ?>', '<?php echo $post_type_field; ?>');
            posts_already_showed = posts_already_showed + <?php gt3_the_theme_option('fw_port_per_page'); ?>;
        }	

		jQuery(function() {
		  jQuery(document).endlessScroll({
			bottomPixels: 500,
			fireDelay: 10,
			callback: function() {
				get_works();
			}
		  });
		});
        jQuery(document).ready(function () {
			jQuery('.is_masonry').masonry();
			setTimeout("jQuery('.is_masonry').masonry();",1000);
        });
        jQuery(window).load(function () {
			jQuery('.is_masonry').masonry();
			setTimeout("jQuery('.is_masonry').masonry();",1000);
        });
        jQuery(window).resize(function () {
			jQuery('.is_masonry').masonry();
			setTimeout("jQuery('.is_masonry').masonry();",1000);
        });
	<?php } ?>

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