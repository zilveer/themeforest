
<?php get_header() ?>

<style type="text/css">
body{width:100%;}
</style>
		<div id="container" class="container first">
            
            <div class="clear-top"></div>
	
			<div id="content" class="content">
            	
                <?php the_post(); ?>
	
				<?php get_template_part( 'includes/default' ); ?>
               
	
			</div><!-- #content -->
			
                        
            
		</div><!-- #container -->
        
<?php get_footer(); ?>

