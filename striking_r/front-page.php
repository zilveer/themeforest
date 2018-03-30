<?php 
if(is_blog()){
	return load_template(THEME_DIR . "/template_blog.php");
}

global $home_page_id;
$home_page_id = theme_get_option('homepage','home_page');
if($home_page_id) {
	$home_page_id = wpml_get_object_id($home_page_id,'page');
}
if($home_page_id && $template = get_page_template_slug($home_page_id)){
	global $wp_query;
	$wp_query->queried_object_id = $home_page_id;
	return load_template(THEME_DIR . '/' . $template);
}
get_header(); 

if($home_page_id){
	echo theme_generator('introduce',$home_page_id);
	$home_page_date = get_page($home_page_id);
	$content = $home_page_date->post_content;
	$layout = theme_get_inherit_option($home_page_id, '_layout', 'homepage','layout');
}else{
	if (!theme_get_option('homepage', 'disable_slideshow')) {
		$type = theme_get_option('homepage', 'slideshow_type');
		$category = theme_get_option('homepage', 'slideshow_category');
		$number = theme_get_option('homepage', 'slideshow_number');
		if($type == 'revslider'){
			$rev_id = theme_get_option('homepage', 'slideshow_rev');
			echo '<div id="feature" class="with_shadow">';
			if (function_exists('putRevSlider')) putRevSlider($rev_id,"homepage");
			echo '</div>';
		}else{
			echo theme_generator('slideshow',$type,$category,'',$number);
		}
	} else echo theme_generator('introduce');
	$content = theme_get_option('homepage','page_content');
	$layout=theme_get_option('homepage','layout');
}	
$content_width = ($layout === 'full')? 960: 630;
?>
<div id="page" class="home">
	<div class="inner <?php if($layout=='right'):?>right_sidebar<?php endif;?><?php if($layout=='left'):?>left_sidebar<?php endif;?>">
		<div id="main">
			<div class="content">
				<?php echo apply_filters('the_content', stripslashes( $content ));?>
				<div class="clearboth"></div>
			</div>
		</div>
		<?php if($layout != 'full') get_sidebar(); ?>
		<div class="clearboth"></div>
	</div>
</div>
<?php get_footer(); ?>