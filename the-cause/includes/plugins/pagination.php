<?php

// Kriesi pagination
function kriesi_pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2) + 1;  

     global $paged;
     if (empty($paged)) $paged = 1;

     if ($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }

     if (1 != $pages)
     {
         echo "<div class='pagination'>";
		 
		 $currentPage = 0;
		 
		 $paginationString = array();

         for ($i = 1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems ))
             {
                 ($paged == $i) ? $paginationString[] = "<span class='current roundButton'>" . $i . "</span>" : $paginationString[] = "<a href='" . get_pagenum_link($i) . "' class='inactive tinyButton roundButton' >" . $i . "</a>";
             }
         }
		 
		 $paginationStringEcho = implode('', $paginationString);
		 
		 echo $paginationStringEcho;


         echo "</div>\n";
     }
}

?>