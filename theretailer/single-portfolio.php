<?php get_header(); ?>

<div class="global_content_wrapper">

<div class="container_12" itemscope itemtype="http://schema.org/CreativeWork">

    <div class="grid_4 push_8">
    
		<div class="aside_portfolio">
			
			<div class="entry-content-aside">
				<?php while ( have_posts() ) : the_post(); ?>
                
                <h1 class="entry-title portfolio_item_title" itemprop="name"><?php the_title(); ?></h1>
                
                <div class="portfolio_details_sep"></div>
                
                <div class="portfolio_details_item_cat" itemprop="genre">                    
                    <?php 
                    echo get_the_term_list( get_the_ID(), 'portfolio_filter', "","&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;" );
                    ?>
                </div>
                
				<div itemprop="text">
				<?php
				if ( !empty( $post->post_excerpt ) ) :
					the_excerpt();
				else :
					false;
				endif;
				?>
                </div>
    
                <?php endwhile; // end of the loop. ?>
            </div>
        </div>
        
    </div>
    
    <div class="grid_8 pull_4">

		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">

			<div class="entry-content entry-content-portfolio">
				<?php while ( have_posts() ) : the_post(); ?>
                	<?php the_content(); ?>
                <?php endwhile; // end of the loop. ?>
            </div>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

	</div>
    
    <div class="clr"></div>
    
</div>

</div>

<div class="container_12 portfolio_content_nav">
    <div class="grid_12">
    	<?php theretailer_content_nav( 'nav-below' ); ?>
    </div>
</div>

<?php

$terms = get_the_terms( $post->ID, 'portfolio_filter');

if ($terms) {

	$terms_array = array();
	
	foreach ($terms as $term) {
		$terms_array[] = $term->slug;
	}
	
	$args = array(
		'posts_per_page' => 4,
		'order_by' => 'rand',
		'post_type' => 'portfolio',
		'post_status' => 'publish',
		'exclude' => $post->ID,
		'tax_query' => array(
							array('taxonomy' => 'portfolio_filter',
									'field' => 'slug',
									'terms' => $terms_array
							))
	);
	
	$related = get_posts($args);

}

?>


<?php if ($related) { ?>
	<div class="container_12 portfolio_related">
	
		<?php foreach( $related as $related_post ) { ?>
        <div class="grid_3">            
            
            <?php
			
			$related_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($related_post->ID), 'full' );
			
			?>
            
            <div class="portfolio_item">
                <div class="portfolio_item_img_container">
					<a href="<?php echo get_permalink($related_post->ID); ?>">
						<img src="<?php echo $related_thumb[0]; ?>" alt="" />
					</a>
				</div>
                <a class="portfolio-title" href="<?php echo get_permalink($related_post->ID); ?>"><h3><?php echo $related_post->post_title; ?></h3></a>
                <div class="portfolio_sep"></div>
                <div class="portfolio_item_cat">

                <?php 
                echo strip_tags (
                    get_the_term_list( $related_post->ID, 'portfolio_filter', "",", " )
                );
                ?>
                
                </div>
            </div>  
            
        </div>   
        <?php } ?>
    
    </div>
<?php } ?>
           

<!--Mobile trigger footer widgets-->
<?php global $theretailer_theme_options; ?>

<?php if ( 	(!$theretailer_theme_options['dark_footer_all_site']) ||
			($theretailer_theme_options['dark_footer_all_site'] == 0) ) : ?>
				<div class="trigger-footer-widget-area">
					<i class="getbowtied-icon-more-retailer"></i>
				</div>
<?php endif; ?>

<div class="gbtr_widgets_footer_wrapper">

<?php get_template_part("dark_footer"); ?>

<?php get_footer(); ?>