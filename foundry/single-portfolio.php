<?php
	get_header();
	the_post();
?>

<section id="portfolio-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="container">
    
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <?php the_title('<h1 class="uppercase large mb32">', '</h1><hr class="mb32">'); ?>
                
                <div class="post-content">
	                <?php
		       			the_content();
		       			wp_link_pages();
		       		?>
	       		</div>
	       		
       		</div>
       	</div>
        
        <?php get_template_part('inc/content-portfolio', 'sharing'); ?>
        
    </div>
</section>

<?php get_footer();