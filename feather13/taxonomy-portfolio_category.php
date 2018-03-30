<?php $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy')); ?>

<?php get_header(); ?>

<?php if (!air_portfolio::get_option('taxonomy_disable_category_menu')): ?>
<div id="subheader">
	<div class="container fix">	
		<ul id="portfolio-filter" class="fix">
			<?php wp_list_categories( 
				array(
					'taxonomy'	=> 'portfolio_category',
					'orderby'	=> 'name',
					'title_li'	=> '',
					'depth'		=> 2
				)
			); ?>
		</ul>			
	</div>	
</div><!--/#subheader-->
<?php endif; ?>

<div class="container fix portfolio">

	<div id="page-title">
		<h1>
			<?php echo $term->name; ?>.
			<?php if ($term->description): ?>
				<span><?php echo $term->description; ?></span>
			<?php endif; ?>
		</h1>

		<?php if ( !air_portfolio::get_option('taxonomy_disable_switcher') ): ?>
			<ul id="portfolio-size" class="fix" data-current="<?php echo air_portfolio::get_option('taxonomy_layout', 'grid one-third'); ?>">
				<li><a id="switch-small" href="#" data-layout="grid one-fourth"><i class="icon-size small"></i>Small</a></li>
				<li><a id="switch-medium" href="#" data-layout="grid one-third"><i class="icon-size medium"></i>Medium</a></li>
				<li><a id="switch-large" href="#" data-layout="grid one-half"><i class="icon-size large"></i>Large</a></li>
			</ul>
		<?php endif; ?>
	</div><!--/#page-title-->
	
	<div id="content">
		
		<?php do_action('wpb_portfolio_javascript', air_portfolio::get_option('taxonomy_disable_category_menu'),
			air_portfolio::get_option('taxonomy_disable_switcher'), air_portfolio::get_option('taxonomy_enable_lightbox')); ?>

		<?php $item_rel = air_portfolio::get_option('taxonomy_enable_lightbox_gallery')?'rel="gallery"':''; ?>
		
		<?php get_template_part('_loop-portfolio'); ?>
		<?php get_template_part('_nav-posts'); ?>
		
	</div><!--/#content-->
</div><!--/.container-->

<?php get_footer(); ?>