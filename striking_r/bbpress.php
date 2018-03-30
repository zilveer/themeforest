<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 */

if(is_blog()){
	return load_template(THEME_DIR . "/template_blog.php");
}elseif(is_front_page()){
	return load_template(THEME_DIR . "/front-page.php");
}

$post_id = theme_get_queried_object_id();
$layout = theme_get_inherit_option($post_id, '_layout', 'general','layout');
if ($post_id==0) {
		$layout = 'full';
		$layout=theme_get_option('advanced','bbpress_layout');
}
$content_width = ($layout === 'full')? 960: 630;
get_header(); 
echo theme_generator('introduce',$post_id);?>
<div id="page">
	<div class="inner <?php if($layout=='right'):?>right_sidebar<?php endif;?><?php if($layout=='left'):?>left_sidebar<?php endif;?>">
		<?php if (!theme_get_option('advanced','bbpress_breadcrumbs')) echo theme_generator('breadcrumbs',$post_id);?>
		<?php if ($post_id==0 || theme_get_option('advanced','bbpress_info_before_all')) {
		$contentbefore=theme_get_option('advanced','bbpress_info_before');	
		$contentbefore=stripslashes($contentbefore);
		echo '<div id="bbpress_intro_before">'.do_shortcode($contentbefore).'</div>';
		}?>
		<div class="clearboth"></div>
		<div id="main">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<?php get_template_part('content','page'); ?>
<?php endwhile; // end of the loop.?>
			<div class="clearboth"></div>
		</div>
		<?php if($layout != 'full') get_sidebar(); ?>
		<div class="clearboth"></div>
		<?php if ($post_id==0 || theme_get_option('advanced','bbpress_info_after_all')) {
		$contentafter=theme_get_option('advanced','bbpress_info_after');
		$contentafter=stripslashes($contentafter);
		echo '<div id="bbpress_intro_after">'.do_shortcode($contentafter).'</div>';
		}?>
		<div class="clearboth"></div>
	</div>
</div>
<?php get_footer(); ?>