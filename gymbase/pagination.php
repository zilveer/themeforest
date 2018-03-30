<?php
function kriesi_pagination($pages = '', $range = 2, $query_string = false)
{
	$showitems = ($range * 2)+1;  

	global $paged;
	if(empty($paged)) $paged = 1;

	if($pages == '')
	{
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if(!$pages)
		{
			$pages = 1;
		}
	}

	if(1 != $pages)
	{
		if($query_string)
			parse_str($_SERVER["QUERY_STRING"], $query_string_array);
		
		echo "<ul class='pagination'>";
		if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".($query_string ? "?" . http_build_query(array_merge($query_string_array,  array("paged"=>1))) : get_pagenum_link(1))."'>&laquo;</a></li>";
		if($paged > 1 && $showitems < $pages) echo "<li><a href='".($query_string ? "?" . http_build_query(array_merge($query_string_array,  array("paged"=>$paged-1))) :  get_pagenum_link($paged - 1))."'>&lsaquo;</a></li>";

		for ($i=1; $i <= $pages; $i++)
		{
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
			{
				echo "<li" . ($paged == $i ? " class='selected'" : "") . ">" . ($paged == $i ? "<span>".$i."</span>":"<a href='".($query_string ? "?" . http_build_query(array_merge($query_string_array,  array("paged"=>$i))) :  get_pagenum_link($i))."'>".$i."</a>") . "</li>";
			}
		}

		if ($paged < $pages && $showitems < $pages) echo "<li><a href='".($query_string ? "?" . http_build_query(array_merge($query_string_array,  array("paged"=>$paged + 1))) : get_pagenum_link($paged + 1))."'>&rsaquo;</a></li>";  
		if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".($query_string ? "?" . http_build_query(array_merge($query_string_array,  array("paged"=>$pages))) : get_pagenum_link($pages))."'>&raquo;</a></li>";
		echo "</ul>";
	}
}
?>