<?php
/*
* Template Name: Homepage Shortcode
*
*/

global $smof_data;

get_header(); 

?>
<section id="midsection" class="container">
<div class="row"> 
<div id="content-home" class="span12">
	
	<div class="row-fluid">
		<div class="home_page_content">    
		<?php
	
		if(have_posts()):while(have_posts()):the_post();
		
			the_content();
			
		endwhile; endif;
		
		?>	
    	</div>
    </div><!--.row-fluid -->
    
</div><!--#content-home -->
</div><!--.row -->
</section><!--#midsection -->
<?php get_footer(); ?>