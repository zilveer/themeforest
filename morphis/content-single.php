<?php
/**
 * The template for displaying content in the single.php template
 *
 * @package WordPress
 * @subpackage Morphis
 * 
 */
?>
<?php 
global $NHP_Options; 
$options_morphis = $NHP_Options; 
?>

		<?php $selected_single_blog_layout = ''; ?>
		<?php $selected_single_blog_layout = $options_morphis['select_single_blog_layout']; ?>
		
		<?php // check single blog layout if overriden ?>
		<?php $unique_single_blog_layout = get_post_meta($post->ID,'_cmb_post_single_layout',TRUE); ?>			
		<?php if($unique_single_blog_layout != ''): ?>
			<?php $selected_single_blog_layout = $unique_single_blog_layout; ?>			
		<?php endif; ?>
	
<?php if($selected_single_blog_layout == '1') : ?>

	<?php get_template_part('inc/layouts/single-post'); ?>	

<?php elseif($selected_single_blog_layout == '2') : ?>

	<?php get_template_part('inc/layouts/single-post-2'); ?>	

<?php endif; ?>