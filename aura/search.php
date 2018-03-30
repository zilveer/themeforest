<?php get_header(); ?>
<!-- section -->
<section role="main">	
        <div class="wmffcontainer">
    	<div class="post-padding"></div>
        <div class="wmffrow">
        	<div class="col-12 wmffcol-xs-12 wmffcol-sm-12 wmffcol-md-12 wmffcol-lg-12">
                
                
                    <h3><?php echo sprintf( __( '%s Search Results for ', 'aurat2d' ), $wp_query->found_posts ); echo get_search_query(); ?></h3>
                    
                    <?php get_template_part('loop'); ?>
                    
                    <?php get_template_part('pagination'); ?>
                
                
	
		</div>
	</div>
</div>
</section>
<!-- /section -->
<?php get_footer(); ?>