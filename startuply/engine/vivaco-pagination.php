<?php
/*
Plugin Name: Vivaco Custom Post Types
Description: vivaco-custom-post-types
Version: 2.2.0
Author: Vivaco (Alexander)
Author URI: http://vivaco.com
*/

function vsc_pagination($range = 2) {
	$show_items = ($range * 2) + 1;

	global $paged;
	if (empty($paged)) {
		$paged = 1;
	}

	global $wp_query;
	$total_pages = $wp_query->max_num_pages;

	if (!$total_pages) {
		$total_pages = 1;
	}

	if ($total_pages != 1) {

		echo "<div class=\"pagination\">";

		if ($paged > 1 && $show_items < $total_pages) {
			echo "<a href='".get_pagenum_link($paged - 1)."' class=\"prev\">&laquo;&nbsp;</a>";
		}

		if ($paged > 2 && $paged > $range + 1 && $show_items < $total_pages) {
			echo "<a href='".get_pagenum_link(1)."'>1</a>";
			if ($paged > $range + 2) {
				echo "<span class=\"dots\">...</span>";
			}
		}


		for ($i = 1; $i < $total_pages; $i++) {
			if (1 != $total_pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $total_pages <= $show_items)) {
				echo ($paged == $i) ?
					"<span class=\"active\">".$i."</span>":
					"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
			}
		}

		if ($paged <= $total_pages - 1 && $paged + $range - 1 < $total_pages && $show_items < $total_pages) {
			if($paged < $total_pages - ($range + 1)) {
				echo "<span class=\"dots\">...</span>";
			}
		}

		echo ($paged == $total_pages) ?
			"<span class=\"active\">".$total_pages."</span>":
			"<a href='".get_pagenum_link($total_pages)."' class=\"inactive\">".$total_pages."</a>";

		if ($paged < $total_pages && $show_items < $total_pages) {
			echo "<a href=\"".get_pagenum_link($paged + 1)."\" class=\"next\">&nbsp;&raquo;</a>";
		}

		echo "</div>\n";
	}
}

?>
