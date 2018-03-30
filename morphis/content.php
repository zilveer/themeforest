<?php
/**
 * The default template for displaying content 
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
	<?php $the_post_format = get_post_format(); ?>
	<?php if($the_post_format == '') $the_post_format = 'standard'; ?>
	
	<?php $selected_blog_layout = ''; ?>
	<?php $selected_blog_layout = $options_morphis['select_blog_layout']; ?>
	
	<?php // check blog layout if overriden ?>
	<?php global $wp_query; ?>
	<?php $page_id = $wp_query->get_queried_object_id(); ?>		
	<?php $unique_blog_layout = get_post_meta($page_id,'_cmb_page_layout_main',TRUE); ?>	
	<?php if($unique_blog_layout != '' && !is_search() && !is_category() && !is_tag() && !is_author() && !is_archive()): ?>
		<?php $selected_blog_layout = $unique_blog_layout; ?>
		
	<?php endif; ?>
	
	
	
	<?php if ( !is_search() ) : ?>
	
		<?php if($selected_blog_layout == '1') : // Default Layout ?>
		
			<?php get_template_part('inc/layouts/blog/' . $the_post_format); ?>			
			
		<?php elseif($selected_blog_layout == '2') : // Small Image Layout ?>
			
			<?php get_template_part('inc/layouts/blog2/' . $the_post_format); ?>
		
		<?php elseif($selected_blog_layout == '3') : // Full Content Layout ?>
		
			<?php get_template_part('inc/layouts/blog3/' . $the_post_format); ?>	
						
		<?php endif; ?>					
						
	<?php else : ?>		
		
		<?php get_template_part('inc/search-template'); ?>		
	
	<?php endif; ?>
	
	
