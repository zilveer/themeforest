<?php get_header(); ?>
	<!-- section -->
    <section role="main">
	<div class="wmffcontainer">
    	<div class="post-padding"></div>
        
             
            <?php get_template_part('loop'); ?>
            
            <?php get_template_part('pagination'); ?>
        
        
           
	</div>
	</section>
    <!-- /section -->

<?php get_footer(); ?>