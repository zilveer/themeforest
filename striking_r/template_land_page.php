<?php 
/*
Template Name: Landing Page
*/ 
if(is_blog()){
	return load_template(THEME_DIR . "/template_blog.php");
}

get_header("landing"); 

$post_id = theme_get_queried_object_id();
$layout = theme_get_inherit_option($post_id, '_layout', 'general','layout');
$content_width = ($layout === 'full')? 960: 630;
echo theme_generator('introduce',$post_id);?>
<div id="page">
	<div class="inner <?php if($layout=='right'):?>right_sidebar<?php endif;?><?php if($layout=='left'):?>left_sidebar<?php endif;?>">
		<div id="main">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<?php get_template_part('content','page'); ?>
<?php endwhile; // end of the loop.?>
			<div class="clearboth"></div>
		</div>
		<?php if($layout != 'full') get_sidebar(); ?>
		<div class="clearboth"></div>
	</div>
</div>
<?php 
get_footer("landing"); 
?>