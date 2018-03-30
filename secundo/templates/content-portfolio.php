<?php $limit = ct_get_option("portfolio_index_max_items", 100);?>
<?php $filters = ct_get_option("portfolio_index_show_filters", 1) ? ' filters="true"' : '';?>
<?php $title = ct_get_option("portfolio_index_show_title", 1) ? ' titles="yes"' : ' titles="no"';?>
<?php $summary = ct_get_option("portfolio_index_show_summary", 1) ? ' summaries="yes"' : ' summaries="no"';?>
<?php $order = ct_get_option("portfolio_index_order", 0) ? ' orderby="menu_order" order="asc"' : '';?>
<?php echo do_shortcode('[row][full_column][works ' . $filters . ' limit="' . $limit . '" ' . $title . $summary . $order . '][/full_column][/row]')?>

