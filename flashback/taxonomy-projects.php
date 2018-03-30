<?php

get_header(); 

$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$slug = $term->slug;
$name = $term->name;

$shape = of_get_option("portfolio_shape");

?>

<div id="<?php the_ID(); ?>" class="inner">

<?php if ( have_posts() ) : ?>

	<h5 id="page_title" class="center"><?php printf( __( 'Projects Under "%s"', 'shorti' ), '<span>' . $name . '</span>' ); ?></h5>
	
	<div id="portfolio">
        
        <ul id="projects">
		
			<?php 
			
			$paged = 1;
			if ( get_query_var('paged') ) $paged = get_query_var('paged');
			if ( get_query_var('page') ) $paged = get_query_var('page');
	        query_posts("projects=$slug&posts_per_page=-1&ignore_sticky_posts=1&paged=".$paged."&post_type=project");
			while (have_posts()) : the_post();

            
            // Taxonomy
            $cats = get_the_terms($post->ID, 'projects');
            $count = count($cats);
            
            // Meta
            $url = get_post_meta(get_the_ID(), 'si_project_url', true);
            $info = get_post_meta(get_the_ID(), 'si_project_info', true);
            
            // Featured Image
            $img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'project_home');
            
			?>
			
			<li id="post-<?php the_ID(); ?>" class="project<?php if ( $count > 0 ) { foreach($cats as $category) { echo ' ' . $category->slug; } } ?><?php if ($shape == "circle") { ?> project_c<?php } elseif ($shape == "square") { ?> project_s<?php } ?>"> 
			
				<div class="project_overlay">
				
					<a href="<?php the_permalink(); ?>">
						
						<h5 class="tl"><?php the_title(); ?></h5>
					
					</a>
				
				</div>
				
				<?php if ($img) : ?>
					
	                <a href="<?php the_permalink(); ?>" class="project_thumb"><img src="<?php echo $img[0]; ?>" alt="<?php the_title(); ?>" /></a>
	                
	            <?php else : ?>
	            
	                <p class="center"><?php _e("- No Image Defined -", "shorti"); ?></p>
	                
	            <?php endif; ?>
                
            </li>    
            
            <?php endwhile; ?>
            
        </ul>
        
		<!--=== Begin Post Navigation ===-->
		<div id="project_nav">
			<div class="alignleft older pagenav"><?php next_posts_link( __("&laquo; Older Posts", "shorti"), 0 ) ?></div>
			<div class="alignright newer pagenav"><?php previous_posts_link( __("Newer Posts &raquo;", "shorti"), 0 ) ?></div>
			<?php wp_link_pages(); ?>
		</div>
		<!--=== End Post Navigation ===-->
	
	</div>
	
<?php else : ?>

	<h3 class="center"><?php _e("No posts here", "shorti"); ?></h3>

<?php endif; ?>

</div>

<?php get_footer(); ?>