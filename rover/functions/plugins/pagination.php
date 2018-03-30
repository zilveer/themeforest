<?php
/**
 * Pagination
 * @package by Theme Record
 * @auther: MattMao
*/

if ( !function_exists( 'theme_style_pagination' ) )
{
	function theme_style_pagination($pages = '')
	{
		global $paged;

		if(empty($paged))$paged = 1;

		$prev = $paged - 1;							
		$next = $paged + 1;	
		$range = 2; // only edit this if you want to show more page-links
		$showitems = ($range * 2)+1;

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
			echo "<div class='pagination'>";
			echo "<div class='clearfix col-width'>";
			echo ($paged > 2 && $paged > $range+1 && $showitems < $pages)? "<a href='".get_pagenum_link(1)."'>&laquo;</a>":"";
			echo ($paged > 1 && $showitems < $pages)? "<a href='".get_pagenum_link($prev)."'>&lsaquo;</a>":"";
		
			
			for ($i=1; $i <= $pages; $i++){
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
			echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>"; 
			}
			}
		
			echo ($paged < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($next)."'>&rsaquo;</a>" :"";
			echo ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($pages)."'>&raquo;</a>":"";
			echo "</div>\n";
			echo "</div>\n";
		}
	}
}

?>