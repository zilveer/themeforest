<?php
$limit = ct_get_option("portfolio_index_max_items", 100);
$filters = ct_get_option("portfolio_index_show_filters", 1) ? ' filters="true"' : '';
$title = ct_get_option("portfolio_index_show_title", 1) ? ' titles="yes"' : ' titles="no"';
$summary = ct_get_option("portfolio_index_show_summary", 1) ? ' summaries="yes"' : ' summaries="no"';
$columns = ct_get_option('portfolio_index_items_cols', 4);
?>
<?php $order = ct_get_option("portfolio_index_order", 0) ? ' orderby="menu_order" order="asc"' : '';?>

<section class="container">
		<?php echo do_shortcode('[works ' . $filters . ' limit="' . $limit . '" columns="' . $columns . '" ' . $title . $summary . $order . ']') ?>
</section>