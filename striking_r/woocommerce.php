<?php
/**
 * The template for displaying woocommerce pages.
 */

if(is_blog()){
	return load_template(THEME_DIR . "/template_blog.php");
}
$post_id = theme_get_queried_object_id();

if(is_product()){
	$layout = theme_get_inherit_option($post_id, '_layout', 'advanced','woocommerce_product_layout');
}else{
	$layout = theme_get_inherit_option($post_id, '_layout', 'advanced','woocommerce_layout');
}
$content_width = ($layout === 'full')? 960: 630;

get_header('shop'); 
echo theme_generator('introduce',$post_id);?>
<div id="page">
	<div class="inner <?php if($layout=='right'):?>right_sidebar<?php endif;?><?php if($layout=='left'):?>left_sidebar<?php endif;?>">
		<?php echo theme_generator('breadcrumbs',$post_id);?>
		<div id="main">
			<div <?php post_class('content'); ?>>
				<?php woocommerce_content();?>
				<?php if(is_shop() || is_product()) {edit_post_link(__('Edit', 'striking-r'),'<footer><p class="entry_edit">','</p></footer>',$post_id); }?>
				<div class="clearboth"></div>
			</div>
			<div class="clearboth"></div>
		</div>
		<?php if($layout != 'full') get_sidebar(); ?>
		<div class="clearboth"></div>
	</div>
</div>
<?php get_footer('shop'); ?>
