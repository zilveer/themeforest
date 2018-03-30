<?php 
global $options_data;
if($options_data['check_folio_filter'] != 1) :
?>
<div id="filters" class="span12">
<?php	$portfolio_filters = get_terms('portfolio_filter');
		if($portfolio_filters): ?>
			<ul class="filters-list clearfix">
				<li><a href="#" data-filter="*" class="active"><?php _e('All', 'richer'); ?></a></li>	
				<?php foreach($portfolio_filters as $portfolio_filter): ?>
					<?php if(get_post_meta(get_the_ID(), 'richer_portfoliofilter', false)  && !in_array('0', get_post_meta(get_the_ID(), 'richer_portfoliofilter', false))): ?>
						<?php if(in_array($portfolio_filter->term_id, get_post_meta(get_the_ID(), 'richer_portfoliofilter', false))): ?>
							<li><a href="#" data-filter=".term-<?php echo $portfolio_filter->slug; ?>"><?php echo $portfolio_filter->name; ?></a></li>
						<?php endif; ?>
					<?php else: ?>
						<li><a href="#" data-filter=".term-<?php echo $portfolio_filter->slug; ?>"><?php echo $portfolio_filter->name; ?></a></li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
</div>
<?php endif; ?>