<?php
/**
 *  search result page template
 * 
 * @package Toranj
 * @author owwwlab (Alireza Jahandideh & Ehsan Dalvand @owwwlab)
 */
 get_header(); ?>

<!--Page main wrapper-->
<div id="main-content" class="regular-page"> 
	<div class="page-wrapper">
		<div class="container">

			<!-- page title -->	
			<h2 class="section-title double-title">
				<?php printf( __( 'Search Results for "%s"', 'toranj' ), get_search_query() ); ?>
			</h2>
            <h4 class="mb-xlarge"><?php _e('Displaying', 'toranj'); ?> <?php $num = $wp_query->post_count; if (have_posts()) : echo $num; endif;?> <?php _e('of', 'toranj'); ?> <?php $search_count = 0; $search = new WP_Query("s=$s & showposts=-1"); if($search->have_posts()) : while($search->have_posts()) : $search->the_post(); $search_count++; endwhile; endif; echo $search_count;?> <?php _e('results', 'toranj'); ?> </h4>
                    
			<!--/ page title -->

			<?php if ( have_posts() ) : ?>
                <?php while( have_posts() ) : the_post(); ?>
                    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    <p><?php the_excerpt(); ?></p>
                    <hr/> 
                <?php endwhile; ?>
                <?php wp_link_pages(); ?>
            <?php else : ?>
                <?php _e('Sorry, we could not find any results', 'toranj'); ?>
            <?php endif; ?>
			<hr/>
			<a class="back-to-top" href="#"></a>
			<div class="clearfix"></div>
		</div>
			
	</div>
</div>
<!--/Page main wrapper-->

<?php get_footer(); ?>