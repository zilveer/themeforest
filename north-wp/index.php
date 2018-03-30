<?php get_header(); ?>
<?php 
	$blog_type = (isset($_GET['blog_type']) ? htmlspecialchars($_GET['blog_type']) : ot_get_option('blog_style', 'style1')); 
?>
<?php $blog_header = ot_get_option('blog_header'); ?>
<?php if ($blog_header) { ?>
	<div class="header_content"><?php echo do_shortcode($blog_header); ?></div>	
<?php } ?>
<?php get_template_part( 'inc/loop/'.$blog_type ); ?>
<?php get_footer(); ?>