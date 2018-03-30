<?php /* Template Name: Homepage (Regular) */ ?>

<?php get_header(); 

$alc_options = get_option('alc_general_settings'); 
$custom =  get_post_custom($post->ID);
$layout = isset ($custom['_page_layout']) ? $custom['_page_layout'][0] : '1';
?>
<div class="row">
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>		
		<?php if ($layout == '3'):?>
			<aside class="large-3 columns sidebar-left"><?php generated_dynamic_sidebar() ?></aside>
		<?php endif?>     
		<div class="<?php echo $layout == '1' ? 'large-12' : 'large-9'?> columns">
			<?php the_content(); ?>
		</div>
		<?php if ($layout == '2'):?>
			<aside class="large-3 columns sidebar-right"><?php generated_dynamic_sidebar() ?></aside>
		<?php endif?>
	<?php endwhile; ?>
</div>
<?php get_footer(); ?>