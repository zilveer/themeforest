<?php get_header(); ?>
	<!-- Tab Menu Slide -->
    <div class="tabmenu-back-two"></div>
    <div class="grid_24 bigtitle">
    	<h1 class="tabmenu-bigtitle-two"><strong><?php echo get_search_query(); ?></strong></h1>
    </div>
    
    <div class="clear"></div>
		
    <?php if(get_option('im_theme_sidebar_category_lr', true) == 'LEFT')
	{
		echo '<div class="grid_6">';
			get_sidebar(); 
		echo '</div><!-- /.grid16 -->';
		
		echo '<div class="grid_17 prefix_1">'; 
	} 
	else 
	{
		echo '<div class="grid_17">';
	} 
	?>
    
		<?php get_template_part( 'loop', 'category' ); ?>

	</div><!-- Blog Post List .grid_18 -->
    
	
    <?php if(get_option('im_theme_sidebar_category_lr', true) == 'RIGHT')
	{
		echo '<div class="grid_6 prefix_1">';
			get_sidebar(); 
		echo '</div><!-- /.grid16 prefix_1 -->';
	}
	?>
	
    
    
    <div class="clear"></div> 
    
<?php get_footer(); ?>

