<?php 
$post_id = theme_get_queried_object_id();
if(is_blog()){
	return load_template(THEME_DIR . "/template_blog.php");
}elseif(empty($post_id) || $post_id != get_option( 'page_for_posts' )){
	return load_template(THEME_DIR . "/front-page.php");
}
$layout=theme_get_option('blog','layout');
$content_width = ($layout === 'full')? 960: 630;
$blog_page_date = &get_page($post_id);
$content = $blog_page_date->post_content;

get_header(); 
echo theme_generator('introduce',$post_id);?>
<div id="page">
	<div class="inner <?php if($layout=='right'):?>right_sidebar<?php endif;?><?php if($layout=='left'):?>left_sidebar<?php endif;?>">
		<?php echo theme_generator('breadcrumbs',$post_id);?>
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
