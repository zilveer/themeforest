<?php if ($view_params['meta_type'] == 'category') { ?>
	<div class="portfolio-categories"><?php echo implode(', ', mk_get_custom_tax(get_the_id(), 'portfolio', true)); ?></div>
<?php } else if($view_params['meta_type'] == 'date') { ?>
	<time class="portfolio-date" datetime="<?php the_date('Y-m-d'); ?>"><?php echo get_the_date(); ?></time>
<?php } ?>