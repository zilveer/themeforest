<?php get_header(); ?>
<div id="sortable_2">
<?php get_template_part('modules/module-header');
echo '<div id="module-page-title" class="module module-page-title "><div class="module-content clearfix">';
		global $author;
		
		$output = '';
		
		// For category pages
		if(is_category()){
			$output .= __('Posts in category ', 'epic');
			$output .=  single_cat_title('',false);
			$posttitle = $output;
		}
		
		elseif(is_author()){
		
 			$posttitle = __('Archive for author', 'epic').' '. get_the_author();
		}

		// For Tag archives
		elseif(is_tag()){
			$output .= __('Archive for tag ', 'epic');
			$output .= single_tag_title('',false);
			$posttitle = $output;
		}
		
		// For monthly archives
		elseif(is_archive()){
			$posttitle =__('Archive for ', 'epic') .' '. single_month_title(' ',false);
		}
		

		// For Search archives
		elseif(is_search()){
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
		}
		
		

		// For 404 page template
		elseif(is_404()){
 			$posttitle = __('Sorry, this page does not seem to exist', 'epic');
		}
		
		
		echo '<h1>'.$posttitle.'</h1>';
		

	echo '</div></div>';

?>


<div class="module module-page-content clearfix" id="bloglist">
	<div class="module-content clearfix">
<?php 
	
if ( get_query_var('paged') ) { $paged = get_query_var('paged');} 
elseif ( get_query_var('page') ) {$paged = get_query_var('page');}
else { $paged = 1;}
		
$perpage = get_option('epic_blog_perpage');
query_posts( $query_string . "&paged=$paged&posts_per_page=$perpage" );
        
/* The loop */



/* Start loop */
if(have_posts()):
epic_blog_alpha();

?>

<ul class="blog clearfix" >

<?php

while (have_posts()): the_post();

$format = get_post_format();

$excerpt_args = array(
		'page_id' 		=> $post->ID,
		'link' 			=> 'text',
		'string'		=> __('Continue reading','epic')
		);


?>

	
<li class="<?php echo 'format_'.$format; ?>">

	<div class="post-info">
	
<?php 


if ($format == 'image'){ 
	if(has_post_thumbnail($post->ID)){		
		echo epic_image($post->ID,'Thumbnail-590', 'permalink'); 
		}?>
	<h2><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h2>
	<?php  epic_post_meta();  	
	
	
	echo epic_post_excerpt($excerpt_args);

}


else if ($format == 'gallery'){ ?>
	<?php 
	$mediasize = 'regular'; 
	include(locate_template('gallery.php'));
	?>
	<h2><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h2>
	<?php  epic_post_meta();  ?>
	<?php
	
	
	echo epic_post_excerpt($excerpt_args);


}



else if ($format == 'video'){ ?>

	<?php get_template_part('video');?>
	<h2><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h2>
	<?php  epic_post_meta();  ?>
	<?php echo epic_post_excerpt($excerpt_args);
	}
	


	
else { ?>
	<h2><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h2>
	
	<?php  epic_post_meta();  ?>
	
	<?php
	echo epic_post_excerpt($excerpt_args);

}
?>

		
	</div>	

</li>	

<?php
endwhile; 

?>
</ul>
<?php endif;
/* End loop */
echo epic_pagination();
wp_reset_query();



epic_blog_omega();

?>

<?php get_sidebar();?>

	</div>
</div><!-- end module -->

<?php get_template_part('modules/module-footer');?>
</div>
<?php get_footer();?>


