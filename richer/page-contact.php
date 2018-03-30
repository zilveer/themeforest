<?php
/*
Template Name: Page: Contact
*/
?>

<?php get_header(); ?>

<?php get_template_part( 'framework/inc/titlebar' ); add_shortcode('map', 'richer_map');?>
<?php 
if(!isset($options_data['check_disablemap'])) $options_data['check_disablemap'] = "";
if($options_data['select_map_layout'] == 'Wide' && $options_data['check_disablemap'] != 1) echo '<section id="map">'.do_shortcode('[map address="'.$options_data['contact_map'].'" type="roadmap" width="100%" height="400px" zoom="'.$options_data['contact_map_zoom'].'" scrollwheel="false" scale="true" zoom_pancontrol="true"]').'</section>';?>

<div id="page-wrap" class="container">
	<?php if($options_data['select_map_layout'] == 'Boxed' && $options_data['check_disablemap'] != 1) echo do_shortcode('[map address="'.$options_data['contact_map'].'" type="roadmap" width="100%" height="400px" zoom="'.$options_data['contact_map_zoom'].'" scrollwheel="false" scale="true" zoom_pancontrol="true"]');?>
	<div id="content" class="span12">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry">
				<?php the_content(); ?>
				<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
			</div>
		</article>
		<?php if(!$options_data['check_disablecomments']) { ?>
			<?php comments_template(); ?>
		<?php } ?>

		<?php endwhile; endif; ?>
	</div> <!-- end content -->

</div> <!-- end page-wrap -->

<?php get_footer(); ?>
