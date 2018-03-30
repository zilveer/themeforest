<br>  <div id="content">
    <div id="multicol">

<?php

global $postgallery;
$show = $postgallery->get_post_option('show');
$arr = $postgallery->get_post_option('show_'.$show);
$arr = explode(",", $arr);
$arr = (array)$arr;

$myterms = get_terms('dt_gallery_cat');
//$myterms = apply_filters( 'taxonomy-images-get-terms', '', array('taxonomy'=> 'dt_gallery_cat'));
//print_r($myterms);

//global $term, $h;

$slugs = array(0);

foreach ($myterms as $term)
{
   if ($show == "all")
   {
   
   }
   elseif ($show == "only")
   {
      if ( !in_array( $term->term_id, $arr ) )
         continue;
   }
   elseif ($show == "except")
   {
      if ( in_array( $term->term_id, $arr ) )
         continue;
   }
   
   $slugs[] = $term->slug;
   
}

$paged = intval(get_query_var('paged'));

query_posts($q = "dt_gallery_cat=".implode(",", $slugs).'&paged='.$paged.'&orderby=menu_order&order=ASC');

get_template_part('gallery-one-level-photos-display');

?>

   </div>
   
<?php //if ( count($slugs)>1 ) : ?>
<?php if (function_exists('dt_pagenavi') ) { ?>
	<?php dt_pagenavi(); ?>
	<?php } else { ?>
        
    <ul class="paginator">
      <li class="larr"><?php next_posts_link( __( 'Older posts', 'dt' ) ); ?></div>
      <div class="rarr"><?php previous_posts_link( __( 'Newer posts', 'dt' ) ); ?></div>
    </ul>
    
	<?php }
	wp_reset_query();
	wp_reset_postdata();
?>
<?php //endif; ?>
   
  </div>
