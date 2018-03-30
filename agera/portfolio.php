<?php
	/**
	* Porfolio
	*
	* Template Name: Porfolio
	* @package WordPress
	* @subpackage Agera
	*/

get_header();
global $page_id;
$port_categories = '';
$page_id = get_the_ID();

if(isset($mp_option['agera_portfolio']) && isset($mp_option['agera_portfolio']['category_portfolio_' .$page_id])) {
	foreach($mp_option['agera_portfolio']['category_portfolio_' .$page_id] as $key => $option) {
		$port_categories .= $key . ', ';
	}
}

$post_values = get_post_custom($page_id);
if( isset($post_values['big_portfolio'][0]) && $post_values['big_portfolio'][0] == 'on' )
	$page_data['big_portfolio'] = true;
else
	$page_data['big_portfolio'] = false;

if( isset($post_values['item_number'][0]) )
	$page_data['item_number'] = $post_values['item_number'][0];
else
	$page_data['item_number'] = '10';

?>
<div id="content" class="portfolio-cont" role="main">
	<div class="portfolio flip" data-item-number="<?php echo $page_data['item_number']; ?>">
<?php
	$categories = '';
	$categories .= '<div class="mpc-portfolio-categories"><ul>';
	$categories .= '<li data-link="all"><a href="#all" class="active" title="' . __('All', 'agera') . '" data-link="all">' . __('All', 'agera') . '</a></li>';

	if(isset($mp_option['agera_portfolio']['category_portfolio_' .$page_id])) {
		foreach($mp_option['agera_portfolio']['category_portfolio_' .$page_id] as $key => $option){
			$categories .= '<li data-link="'.$key.'">';
			$categories .= 	'<a href="#'.$key.'" title="'.$option.'" data-link="'.$key.'">'.$option.'</a>';
			$categories .= '</li>';
		}
	}

	$categories .= '</ul></div>';
?>
	<script type="text/javascript">
		var data = '<?php echo $categories; ?>';
		jQuery('#slogan').after(data);
	</script>
	<div class="portfolio-content<?php echo $page_data['big_portfolio'] ? ' big-portfolio' : ''; ?>">
		<?php
		wp_reset_query();
		if(get_query_var('page') != '')
			$paged = get_query_var('page');
		else
			$paged = get_query_var('paged');

		$paged = $paged > 1 ? $paged : 1;

		$my_query = $wp_query;
		$wp_query = null;
		$wp_query = new WP_Query();
		$wp_query->query(array(
			'post_type' => 'portfolio',
			'posts_per_page' => $page_data['item_number'],
			'portfolio_cat' => $port_categories,
			'paged' => $paged,
			'showposts' => ''
		));
		$counter = 0;

		while ($wp_query->have_posts()) {
			$wp_query->the_post();
			$counter++;
			$post_meta = get_post_custom($post->ID);
			$page_data = '';

			if(isset($post_meta['project_background'][0]))
				$page_data['background'] = $post_meta['project_background'][0];
			else
				$page_data['background'] = '#F9625B';

			if(isset($post_meta['lightbox_enable'][0]) && $post_meta['lightbox_enable'][0] == "on") {
				$page_data['lightbox'] = true;

				if(isset($post_meta['lightbox_src'][0]))
					$page_data['lightbox_src'] = $post_meta['lightbox_src'][0];
				else
					$page_data['lightbox_src'] = '';

				if(isset($post_meta['caption'][0]))
					$page_data['caption'] = $post_meta['caption'][0];
				else
					$page_data['caption'] = '';

				if(isset($post_meta['gallery'][0]))
					$page_data['gallery'] = $post_meta['gallery'][0];
				else
					$page_data['gallery'] = '';
			}

			$categories = get_the_terms($post->ID, 'portfolio_cat');
			$category_slug = '';
			if(isset($categories) && $categories != ''){
				foreach($categories as $category) {
					$category_slug .= $category->slug.' ';
				}
			}
			
            if( get_next_posts_link() ) {
                $load_more_url = explode('"', get_next_posts_link());

                if( is_array($load_more_url) && isset($load_more_url[1]))
                    $load_more_url = $load_more_url[1];
            } else {
                $load_more_url = '';
            }
			?>
			<div id="item_<?php echo $paged . '_' . $counter; ?>" data-type="<?php echo $category_slug; ?>" class="portfolio-item item-<?php echo $paged . '-' . $counter; ?> <?php echo $category_slug; ?>"><?php agera_portfolio_columns("portfolio-full", $page_data); ?></div>
			<?php
		} ?>
		<a href="#" id="mpc_load_more" data-loading="<?php _e('loading...', 'agera'); ?>"><?php _e('load more', 'agera'); ?></a>
	</div> <!-- end .portfolio-content -->
	<div class="clear"></div>
	<div id="mpcth_load_info" data-all-posts="<?php echo $wp_query->found_posts; ?>" data-max-pages="<?php echo $wp_query->max_num_pages; ?>" data-next-url="<?php echo $load_more_url; ?>"></div>
</div><!-- end #content -->
</div>
<?php get_footer(); ?>
</body>
</html>