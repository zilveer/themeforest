<?php
/*
Template Name: Portfolio
*/

// Portfolio functions
$portfolio_functions = locate_template('functions-portfolio.php');
require ( $portfolio_functions );
?>

<?php get_header(); ?>

<?php if ( !wpb_meta('_portfolio_disable_categories') ): ?>
<div id="subheader">
	<div class="container fix">	
		<ul id="portfolio-filter" class="<?php echo $isotope_class; ?> fix">				
			<?php if ( $meta_view ): ?>
				<?php wp_list_categories( 
					array(
						'taxonomy'	=> 'portfolio_category',
						'orderby'	=> 'name',
						'title_li'	=> '',
						'depth'		=> 2
					)
				); ?>					
			<?php else: ?>
				<li class="current"><a href="#" data-filter="*"><?php _e('All','feather'); ?></a></li>
				<?php air_portfolio::isotope_menu(wpb_meta('_portfolio_category')); ?>
			<?php endif; ?>
		</ul>		
	</div>	
</div><!--/#subheader-->
<?php endif; ?>

<div class="container fix portfolio">

	<div id="page-title">
		<h1><?php echo wpb_page_title(); ?></h1>

		<?php if ( !wpb_meta('_portfolio_disable_switcher') ): ?>
			<ul id="portfolio-size" class="fix" data-current="<?php echo wpb_meta('_portfolio_layout', 'grid one-third'); ?>">
				<li><a id="switch-small" href="#" data-layout="grid one-fourth"><i class="icon-size small"></i>Small</a></li>
				<li><a id="switch-medium" href="#" data-layout="grid one-third"><i class="icon-size medium"></i>Medium</a></li>
				<li><a id="switch-large" href="#" data-layout="grid one-half"><i class="icon-size large"></i>Large</a></li>
			</ul><!--/#portfolio-size-->
		<?php endif; ?>
	</div><!--/#page-title-->
	
	<div id="content">
		
		<?php while(have_posts()): the_post(); ?>
			<?php if ( $post->post_content ) : ?>
				<article id="entry-<?php the_ID(); ?>" <?php post_class('nobox fix'); ?>>
					<div class="text">
						<?php the_content(); ?>
						<div class="clear"></div>
					</div>
				</article>
			<?php endif; ?>
		<?php endwhile;?>
		
		<?php do_action('wpb_portfolio_javascript', wpb_meta('_portfolio_disable_categories'),
			wpb_meta('_portfolio_disable_switcher'), wpb_meta('_portfolio_lightbox')); ?>
	
		<section id="portfolio" class="isotope">
			<?php $item_rel = wpb_meta('_portfolio_lightbox_gallery')?'rel="gallery"':''; ?>
			<?php $lightbox = wpb_meta('_portfolio_lightbox'); ?>

			<?php while ( $loop->have_posts() ): $loop->the_post(); wpb_metadata(); ?>
			<?php $item_link = wpb_portfolio_link($lightbox); ?>

			<div class="isotope-item <?php echo wpb_portfolio_class($meta_layout); ?>">
				<article class="portfolio-item">
					<a class="portfolio-thumbnail" href="<?php echo $item_link; ?>" title="<?php the_title_attribute(); ?>" <?php echo $item_rel; ?>>	
						
						<?php if ( has_post_thumbnail() ): ?>
							<?php $img = wp_get_attachment_image_src(get_post_thumbnail_id(),'thumbnail-portfolio'); ?>
							<img src="<?php echo $img[0]; ?>" alt="<?php the_title() ;?>" />						
						<?php else: ?>
							<img src="<?php echo get_template_directory_uri(); ?>/img/placeholder.png" alt="<?php the_title() ;?>" />
						<?php endif; ?>
						
						<?php if ( wpb_meta('_portfolio_video') ): ?><span class="play"></span><?php endif; ?>
						<span class="glass"></span>
						
					</a>
					
					<?php if( !wpb_option('hide-meta-portfolio') ): ?>
					<a class="portfolio-meta" href="<?php echo wpb_meta('_link', get_permalink()); ?>">
						<h4 class="portfolio-title"><?php the_title(); ?></h4>
						<span class="portfolio-category"><?php echo air_portfolio::get_category_list(); ?></span>
					</a>
					<?php endif; ?>
					
				</article>
			</div><!--/.isotope-item-->
			
			<?php endwhile; ?>
			<?php wpb_reset_metadata(); ?>
			
			<div class="clear"></div>
		</section><!--/#portfolio-->
		
	</div><!--/#content-->
</div><!--/.container-->

<?php get_footer(); ?>