
		<div id="latest-blogs" class="row clearfix">
			<!-- CENTERED HEADING -->
			<?php 
			global $NHP_Options; 
			$options_morphis = $NHP_Options; 
			?>
			<h4 class="centered-heading"><span><?php echo $options_morphis['blogHeading']; ?></span><a href="<?php echo $options_morphis['blogSubHeadingLink']; ?>"><?php echo $options_morphis['blogSubHeadingLinkText']; ?></a></h4>				
			<!-- END CENTERED HEADING -->
			
<?php
	$postCount = 0;
	$posts_per_page = $options_morphis['blog_number_posts'];
	if($posts_per_page == '') {
		$posts_per_page = '-1';
	} 
	
	$category_filter = isset( $options_morphis['blog_cats_select'] ) ? $options_morphis['blog_cats_select'] : '';
	if( $category_filter == '' || $category_filter == null || empty( $category_filter ) ) {
		$_filter = 'posts_per_page='.$posts_per_page .'';		
	} else {
		$_filter = array( 'posts_per_page' => $posts_per_page, 'cat' => $options_morphis['blog_cats_select']);		
	}
	
	$query = new WP_Query( $_filter );

	if( $query->have_posts() ) {
	
	  while ($query->have_posts()) : $query->the_post(); 
		++$postCount;
		
		if ($postCount % 2 != 0) {
			 // FIRST POST
		echo '<section class="clearfix">';
?>	
			<article class="eight columns alpha clearfix">	
				<?php get_template_part('inc/post-format'); ?>								
			</article>
<?php
		
		} elseif( $postCount % 2 == 0 ) {
			 // LAST POST IN LOOP
?>
			<article class="eight columns omega clearfix">					
					<?php get_template_part('inc/post-format'); ?>				
			</article>
			
<?php
			echo '</section>';
		} 		
	  
	  endwhile;
	  
	}
?>
	
	
	
</div>		
<!-- END SERVICES SECTION -->