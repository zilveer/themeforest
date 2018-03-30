<?php

$thb_portfolio = thb_get_module_url('core/portfolio');
thb_works_query();

$terms = get_terms("portfolio_categories");

if( have_posts() && count($terms) > 0 ) : ?>
	<div id="thb-portfolio-filter">
		<ul id="filterlist">
			<li class="current">
				<a href="<?php the_permalink(); ?>" data-term-slug="all"><?php echo __("All", 'thb_text_domain'); ?></a>
			</li>
			<?php
				foreach($terms as $term) :
				$link = esc_url( add_query_arg( 'filter', 'portfolio_categories:' . $term->term_id ) );
				// $link = get_term_link($term, 'portfolio_categories');
			?>
			<li>
				<a href="<?php echo $link; ?>" data-term-slug="<?php echo $term->slug; ?>">
					<?php echo $term->name; ?>
				</a>
			</li>
			<?php endforeach; ?>
		</ul>
		<span class="loader"><?php _e("Loading...", 'thb_text_domain'); ?></span>
	</div>
<?php endif; ?>