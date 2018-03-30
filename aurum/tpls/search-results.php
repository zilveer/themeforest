<?php
/**
 *	Aurum WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

global $wpdb, $wp_query, $s, $page;

$search_add_to_cart = get_data('search_add_to_cart');

$results_count_show = true;

# Copy query
$query = $wp_query->query;

# Allowed post types to search
$search_link = get_search_link($s);
$active_post_type = 'all';

$post_types = array();
$post_types_include = array();
$results_count_by_type = array();
$post_names = array(
	'post'         => __('Posts', 'aurum'),
	'page'         => __('Pages', 'aurum'),
	'product'      => __('Products', 'aurum'),
	'testimonial'  => __('Testimonials', 'aurum'),
);

foreach(get_data('search_post_types') as $post_type => $include)
{
	$post_types_include[] = $post_type;

	if($include)
	{
		$post_types[] = $post_type;
	}
}

# Add vars to the query
$query['posts_per_page'] = apply_filters('laborator_search_results_count', 10);
$query['post_type'] = $post_types;

if(in_array(lab_get('type'), $post_types))
{
	$active_post_type = lab_get('type');
	$query['post_type'] = $active_post_type;
}

	# Query Posts
	$query['s'] = $s;
	query_posts($query);

	$query['post_type'] = $post_types;
	$results_all = new WP_Query(array_merge($query, array('posts_per_page' => -1)));
	$found_posts = $results_all->found_posts;
	
	
	if($results_all->found_posts)
	{
		foreach($results_all->posts as $search_res)
		{
			$pt = $search_res->post_type;
			
			if( ! isset($results_count_by_type[$pt]))
			{
				$results_count_by_type[$pt] = 0;
			}
			
			$results_count_by_type[$pt]++;
		}
	}

# Pagination
$pagination_position	= 'center';
$max_num_pages          = $wp_query->max_num_pages;
$paged                  = get_query_var('paged');

if($page > $paged)
	$paged = $page;

if($max_num_pages > 1):

	$_from               = 1;
	$_to                 = $max_num_pages;
	$current_page        = $paged ? $paged : 1;
	$numbers_to_show     = 5;
	$pagination_position = strtolower($pagination_position);

	list($from, $to) = generate_from_to($_from, $_to, $current_page, $max_num_pages, $numbers_to_show);
endif;

$s = esc_html( $s );
?>
<section class="search-header">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h2>
					<?php if($found_posts): ?>
						<?php echo sprintf(_n('%s result found for <strong>&quot;%s&quot;</strong>', '%s results found for <strong>&quot;%s&quot;</strong>', $found_posts, 'aurum'), number_format_i18n($found_posts), $s); ?>
					<?php else: ?>
						<?php echo sprintf(__('No search results for <strong>&quot;%s&quot;</strong>', 'aurum'), $s); ?>
					<?php endif; ?>
				</h2>
				<a href="#" class="go-back"><?php _e('&laquo; Go back', 'aurum'); ?></a>

				<?php if($found_posts && count($post_types)): ?>
				<nav class="tabs">
					<a href="<?php echo $search_link; ?>"<?php echo $active_post_type == 'all' ? ' class="active"' : ''; ?>>
						<?php _e('All', 'aurum'); ?>
						<?php if($results_count_show): ?>
						<span><?php echo $found_posts; ?></span>
						<?php endif; ?>
					</a>
					<?php
					if($post_types):

						foreach($post_types as $post_type):
						
							$name        = $post_names[$post_type];							
							$amp_or_qm   = strpos( $search_link, '?' ) !== false ? '&' : '?';
							$href        = $search_link . $amp_or_qm . 'type=' . $post_type;
							
							if( ! isset($results_count_by_type[$post_type]) || $results_count_by_type[$post_type] == 0)
							{
								continue;
							}

						?>
						<a href="<?php echo $href; ?>"<?php echo $active_post_type == $post_type ? ' class="active"' : ''; ?>>
							<?php echo $name; ?>

							<?php if($results_count_show): ?>
							<span><?php echo $results_count_by_type[$post_type]; ?></span>
							<?php endif; ?>
						</a>
						<?php

						endforeach;
					endif;
					?>
				</nav>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>


<section class="search-results-list">
	<div class="container">
		<div class="col-sm-12">

			<ul class="search-results">
			<?php
			wp_reset_postdata();
			
			while(have_posts()): the_post();

				global $post;
				
				$post_cloned = clone $post;

				$has_thumbnail = has_post_thumbnail();
				$search_meta = get_the_time(get_option('date_format'));

				if($post->post_type == 'page')
				{
					$search_meta = laborator_page_path($post);
				}
				elseif($post->post_type == 'product')
				{
					if(function_exists('get_product'))
					{
						$product = get_product($post);
						$search_meta = $product->get_price_html();
					}
				}
				
				$post = $post_cloned;
				setup_postdata( $post );

				?>
				<li class="<?php echo $has_thumbnail ? 'has-thumbnail' : ''; ?>">
				<?php
				if($has_thumbnail)
				{
					echo '<div class="post-thumbnail">';
						echo '<a href="'.get_permalink().'">';
							the_post_thumbnail( apply_filters( 'aurum_search_thumb', 'thumbnail' ) );
						echo '</a>';
					echo '</div>';
				}
				?>
					<div class="post-details">
						<h3>
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>

						<div class="meta">
							<?php echo $search_meta; ?>

							<?php if($search_add_to_cart && $post->post_type == 'product' && isset($product)): ?>

								<?php if($product->product_type == 'simple'): ?>
								<br />
								<a href="<?php echo the_permalink() ?>" class="search-add-to-cart ajax-add-to-cart" data-product-id="<?php echo $product->id; ?>" data-placement="right" data-added-to-cart-title="<?php _e('Product added to cart!', 'aurum'); ?>">
									<span class="icon">
										<i class="entypo-plus"></i>
									</span>
									<?php _e('Add to cart', 'aurum'); ?>
								</a>
								<?php endif; ?>

								<?php if(in_array($product->product_type, array('variable', 'grouped'))): ?>
								<br />
								<a href="<?php echo the_permalink() ?>" class="search-add-to-cart select-opts">
									<span class="icon">
										<i class="entypo-list-add"></i>
									</span>
									<?php _e('Select options', 'aurum'); ?>
								</a>
								<?php endif; ?>

							<?php endif; ?>
						</div>
					</div>

				</li>
				<?php

			endwhile;
			?>
			</ul>

			<?php
			if($max_num_pages > 1):

				laborator_show_pagination($current_page, $max_num_pages, $from, $to, $pagination_position);

			endif;
			?>

		</div>
	</div>
</section>