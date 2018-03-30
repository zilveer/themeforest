<?php
	/**
	 * Single portfolio content template
	 * @package wpv
	 */
	
	$is_ajax = isset($_SERVER['HTTP_X_VAMTAM']) && $_SERVER['HTTP_X_VAMTAM'] == 'ajax-portfolio';

	$client = get_post_meta(get_the_id(), 'portfolio-client', true);
	$logo   = get_post_meta(get_the_id(), 'portfolio-logo',   true);
	
	$client = preg_replace('@</\s*([^>]+)\s*>@', '</$1>', $client);
	
	$content = get_the_content();

	$portfolio_options = wpv_get_portfolio_options('true', '');
	if($portfolio_options['type'] == 'gallery')
		list(, $content) = WpvPostFormats::get_first_gallery($content);

	$content = apply_filters('the_content',$content);

	$has_right_column = !empty($logo) || !empty($client);
	$left_column_width = $has_right_column ? 'grid-4-5' : 'grid-1-1 last';
?>

<div class="row portfolio-content">
	<div class="<?php echo $left_column_width ?>">
		<?php if($is_ajax): ?>
			<?php
				WpvTemplates::breadcrumbs();
				WpvTemplates::page_header(false, get_the_title());
			?>
		<?php endif ?>
		<?php echo $content ?>
		<?php WpvTemplates::share('portfolio') ?>
	</div>

	<?php if($has_right_column): ?>
		<div class="grid-1-5 last">
			
			<?php if(!empty($logo)): ?>
				<div class="cell">
					<img src="<?php echo $logo ?>" alt="<?php echo esc_attr(get_the_title()) ?>"/>
				</div>
			<?php endif ?>
			
			<div class="cell">
				<div  class="meta-title"><?php _e('Date', 'health-center') ?></div>
				<p class="meta"><?php the_date() ?></p>
			</div>
				
			<?php if(!empty($client)): ?>
				<div class="cell">	
					<div  class="meta-title"><?php _e('Client', 'health-center') ?></div>
					<p class="client-details"><?php echo $client ?></p>
				</div>
			<?php endif ?>
			
			<?php if(!empty($terms_name)): ?>
				<div class="cell">
					<div  class="meta-title"><?php _e('Category', 'health-center') ?></div>
					<p class="meta"><?php echo implode(', ', $terms_name); ?></p>
				</div>
			<?php endif ?>
		</div>
	<?php endif ?>
</div>
