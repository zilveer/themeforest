<?php
/* Template Name: Portfolio 3 Columns*/
?>
<?php get_header(); ?>
<?php get_template_part(THEME_INCLUDES.'top'); ?>

<?php
	wp_reset_query();
	$paged = get_query_string_paged();
	$posts_per_page = get_option(THEME_NAME.'_portfolio_items');
	$subTitle = get_post_meta ($post->ID, THEME_NAME."_subtitle", true );
	
	if($posts_per_page == "") {
		$posts_per_page = get_option('posts_per_page');
	}
	
	$my_query = new WP_Query(array('post_type' => 'portfolio-item', 'posts_per_page' => $posts_per_page, 'paged'=>$paged));  
	$categories = get_terms( 'portfolio-cat', 'orderby=name&hide_empty=0' );

?>
    
	<div id="primary">
        <!-- Filters -->
        <div class="sixteen columns">
            <ul class="portfolio-filter">
                <li><a href="#" class="selected-portfolio-filter" data-filter="*"><?php _e('All', THEME_NAME); ?></a></li>
				<?php foreach ($categories as $category) { ?>
					<li><a href="#" data-filter=".<?php echo $category->slug;?>"><?php echo $category->name;?></a></li>
				<?php } ?>
            </ul>
        </div>
        <!-- Portfolios -->
        <div class="container portfolio-content clearfix">
		<?php 
			$args = array(
				'post_type'     	=> 'portfolio-item',
				'post_status'  	 	=> 'publish',
				'showposts' 		=> -1
			);

			$myposts = get_posts( $args );	
			$count_total = count($myposts);
			
				
		?>
		<?php if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
		<?php 
			$c=1;
			$src = get_post_thumb($post->ID,640,0);
			$srcSmall = get_post_thumb($post->ID,350,250);
			$term_list = wp_get_post_terms($post->ID, 'portfolio-cat');
					
		?>
				

            <div class="one-third column<?php foreach ($term_list as $term) { echo " ".$term->slug; } ?>">
                <div class="hover-image">
                    <a class="fancybox" href="<?php echo $src['src'];?>"><img src="<?php echo $srcSmall['src'];?>" alt="<?php the_title();?>"></a>
                </div>
                <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                <p><?php foreach ($term_list as $term) { if($c!=1) echo ", "; echo $term->name; $c++;} ?></p>
            </div>

		
		<?php 
			if ( $paged != 0 ) {
				$a = ($paged-1)*$posts_per_page;
			} else {		
				$a = 1;
			}
		?>
												
		<?php endwhile; ?>
		<?php else : ?>
			<h2 class="title"><?php _e( 'No items were found' , THEME_NAME );?></h2>
		<?php endif; ?>
        </div>
		<?php gallery_nav_btns($paged, $my_query->max_num_pages); ?>
    </div>
    </div>

<?php get_footer(); ?>