<?php 
global $mk_settings;

$post_id = global_get_post_id();

$layout = get_post_meta($post_id, '_layout', true );
$padding = get_post_meta($post_id, '_padding', true );

if(empty($layout)) {
	$layout = 'right';
}

$padding = ($padding == 'true') ? 'no-padding' : '';

get_header(); ?>
<div id="theme-page" class="page-master-holder" <?php echo get_schema_markup('main'); ?>>
  	<div class="background-img background-img--page"></div>
	<div class="mk-main-wrapper-holder">
		<div class="theme-page-wrapper mk-main-wrapper <?php echo $layout; ?>-layout <?php echo $padding; ?> mk-grid vc_row-fluid">
			<div class="theme-content <?php echo $padding; ?>" itemprop="mainContentOfPage">
			
			<?php 
				/* Hook to add content before content */	
				do_action('page_add_before_content');
			?>

				<?php if ( have_posts() ) while ( have_posts() ) : the_post();
				 ?>
						<?php the_content();?>
						<div class="clearboth"></div>
						<?php wp_link_pages('before=<div id="mk-page-links">'.__('Pages:', 'mk_framework').'&after=</div>'); ?>

						<?php
						if(isset($mk_settings['pages-comments']) && $mk_settings['pages-comments'] == 1) {
							comments_template( '', true ); 	
						}
						?>
				<?php endwhile; ?>

			<?php 
				/* Hook to add content after content */	
				do_action('page_add_after_content'); 
			?>

			</div>
		<?php if($layout != 'full') get_sidebar(); ?>	
		<div class="clearboth"></div>	
		</div>
		<div class="clearboth"></div>
	</div>
</div>
<?php get_footer(); ?>