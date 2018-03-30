<?php get_header(); ?>
<div id="sortable_2">
<?php get_template_part('modules/module-header');

echo '<div class="module module-page-title '.EPIC_DEFAULT_MODULESTYLE.' '.EPIC_DEFAULT_MODULEMARGIN.'"><div class="module-content"><header class="postheader">';

$output = '';
$output.= __('Searchresults for ', 'epic');
			$s = get_query_var('s');
			$allsearch = & new WP_Query("s=$s&showposts=-1");
			$key = esc_html($s, 1);
			$count = $allsearch->post_count;
			if($count == 1){
			$output.= '<em>'.$key.'</em> - '. $count . ' ' .__('article', 'epic');
			}
			else{
			$output.= '<em>'.$key.'</em> - '. $count . ' ' .__('articles', 'epic');
			}
			$posttitle = $output;
	


echo '<h1>'.$posttitle.'</h1>';

echo '</header></div></div>';
?>

<div class="module module-page-content clearfix <?php echo EPIC_DEFAULT_MODULESTYLE;?> <?php echo EPIC_DEFAULT_MODULEMARGIN;?>"><div class="module-content clearfix">	
<?php	

epic_article_alpha();	
		
		$s = get_query_var('s');
		query_posts("s=$s&showposts=-1");
		
		if (have_posts()): while (have_posts()) : the_post(); 
	?>

<div class="blog-post">
			<h3><?php the_title();?></h3>
			<?php 
			the_excerpt();
			echo '<p><a href="'.get_permalink().'">'.get_permalink(),'</a></p>';
			?>
			
</div>
<hr/>
<?php
endwhile; 

else:
echo '<div class="blog-post"><p>'.__('Sorry, but nothing matched your search criteria. Please try again with some different keywords.','epic').'</p></div>';
endif;

wp_reset_query();


epic_article_omega(); 

get_sidebar();
echo '</div></div><!-- end module -->';?>
<?php get_template_part('modules/module-footer');?>
</div>
<?php get_footer();?>
