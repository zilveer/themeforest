<?php 

get_header();?>
<div id="sortable_2">
<?php
get_template_part('modules/module-header');
	echo '<div class="module module-page-title"><header class="postheader">';
	$posttitle = single_term_title('',false);
	echo '<h1>' . $posttitle  . '</h1>';
	echo epic_breadcrumbs('bcContent');	
	echo '</header></div>';
	
	//epic_article_alpha();
	echo '<div class="module module-page-content"><div class="module-content">';

	$order = get_option('epic_portfolio_order');
	$posttype = 'portfolio';
	$perpage = get_option('epic_portfolio_perpage');
	
	if ( get_query_var('paged') ) { $paged = get_query_var('paged');} 
	elseif ( get_query_var('page') ) {$paged = get_query_var('page');}
	else { $paged = 1;}
	
	$args = array( 'paged' => $paged, 'showposts' => $perpage, 'post_type' => $posttype);
    query_posts($args);
				
/* The loop */
	
if(have_posts()):

echo '<div class="blocked columns_3"><ul class="portfolio-items">';

while (have_posts()): the_post();

$i++;

$video = get_post_meta($post->ID,'epic_lightbox_video',true);
// Get post format for icon selection

$post_terms = get_the_terms($post->ID, $taxonomy); 

$count = count($post_terms);
 if ( $count > 0 ){
       foreach ( $post_terms as $term ) {
       	$post_term_list.= $term->slug.' ';
       }
    
 }

?>
<li <?php post_class();?> data-id="id-<?php echo ($i + 1);?>" data-type="<?php echo $post_term_list;?>">
	<?php echo epic_image($post->ID, 'Thumbnail-280', 'permalink');?>					
	<div class="post-info">
	<?php echo '<h5><a href="'.get_permalink().'">'.get_the_title().'</a></h5>';	
	
	echo get_the_term_list($post->ID, $taxonomy,'',', ','');
	
	$args = array(
	'page_id' 		=> $post->ID,
	'excerptlimit'	=> 40 
	);
	echo epic_post_excerpt($args); 
	?>
	</div>
	<?php echo '<a href="'.get_permalink().'" class="p-link"></a>';
		  echo '<a href="'.epic_image_src($post->ID, '').'" rel="prettyPhoto[gall]" class="p-enlarge"></a>';
	?>
</li><?php

$post_term_list = ''; // Reset the term list for each item

endwhile; 
echo '</ul></ul>';
endif;
echo epic_pagination();
wp_reset_query();

/* End loop */
echo '</div></div>';
	
get_template_part('modules/module-footer');?>
</div>
<?php get_footer();?>
