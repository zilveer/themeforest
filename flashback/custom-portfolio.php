<?php
/*

Template Name: Portfolio

*/

get_header();

$project_id = get_post_meta(get_the_ID(), 'si_page_project_id', true);
$project_slug = get_post_meta(get_the_ID(), 'si_page_project_slug', true);

$shape = of_get_option("portfolio_shape");

$portfolio_title = of_get_option("portfolio_title");
$portfolio_subtitle = of_get_option("portfolio_subtitle");
$portfolio_count = of_get_option("portfolio_count");

?>

<div class="inner">

	<div id="portfolio">
	
		<?php if ($portfolio_title) : ?><h1 id="portfolio_title"><?php echo $portfolio_title; ?></h1><?php endif; ?>
		<?php if ($portfolio_subtitle) : ?><h5 id="portfolio_subtitle"><?php echo $portfolio_subtitle; ?></h5><?php endif; ?>
	
		<nav id="project_sort">
		
			<ul class="filter">

				<?php 
				
				echo "<li><a class='active' href='#' data-filter='*'>".__("All", "shorti")."</a></li>"; 
				
				if ($project_id != "") {
				
					$cats = get_terms('projects', array('include' => explode(",", $project_id)));
				
				} else {
				
					$cats = get_terms('projects');
				
				}
				
				foreach ($cats as $cat) {
				
				echo "<li><a data-filter='.".$cat->slug."'>".$cat->name."</a></li>";
				
				} 
				
				echo "<li><a id='shuffle'>".__("Shuffle", "shorti")."</a></li>"; 
				
				?>
			
			</ul>
			
			<?php shorti_select_filter(); ?>
			
		</nav>
		
		<ul id="projects">
		
			<?php 
			
			$paged = 1;
			if ( get_query_var('paged') ) $paged = get_query_var('paged');
			if ( get_query_var('page') ) $paged = get_query_var('page');
	        query_posts("projects=".$project_slug."&posts_per_page=".$portfolio_count."&ignore_sticky_posts=1&paged=".$paged."&post_type=project");
			if (have_posts()) : while (have_posts()) : the_post();

            
            // Taxonomy
            $cats = get_the_terms($post->ID, 'projects');
            $count = count($cats);
            
            // Meta
            $url = get_post_meta(get_the_ID(), 'si_project_url', true);
            $popup = get_post_meta(get_the_ID(), 'si_project_popup', true);
            $external = get_post_meta(get_the_ID(), 'si_project_external', true);
            $video = get_post_meta(get_the_ID(), 'si_project_video', true);
            
            // Featured Image
            $img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'project_home');
            
			?>
			
			<li id="post-<?php the_ID(); ?>" class="project<?php if ( $count > 0 ) { foreach($cats as $category) { echo ' ' . $category->slug; } } ?><?php if ($shape == "circle") { ?> project_c<?php } elseif ($shape == "square") { ?> project_s<?php } ?>">
			
				<div class="project_overlay">
				
					<?php if ($external != "") : ?>
						<a href="<?php echo $external; ?>" target="_blank">
					<?php elseif ($popup == "yes" || $popup == "Yes") : ?>
						<a href="<?php echo $img[0]; ?>" class="pretty">
					<?php else : ?>
						<a href="<?php the_permalink(); ?>">
					<?php endif; ?>
						
						<h5 class="tl"><?php the_title(); ?></h5>
					
					</a>
				
				</div>
				
				<?php if ($img) : ?>
				
					<?php if ($external != "") : ?>
					
		                <a href="<?php echo $external; ?>" class="project_thumb" target="_blank"><img src="<?php echo $img[0]; ?>" alt="<?php the_title(); ?>" /></a>
		                
	                <?php elseif ($popup == "yes" || $popup == "Yes") : ?>
	                
		                <a href="<?php echo $img[0]; ?>" class="pretty project_thumb"><img src="<?php echo $img[0]; ?>" alt="<?php the_title(); ?>" /></a>
	                
	                <?php else : ?>
	                
		                <a href="<?php the_permalink(); ?>" class="project_thumb"><img src="<?php echo $img[0]; ?>" alt="<?php the_title(); ?>" /></a>
	                
	                <?php endif; ?>
	                
                <?php elseif ($video != "") : ?>
                
                	<div class="video_wrap"><?php echo stripslashes(htmlspecialchars_decode($video)); ?></div>
	                
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
        
        <?php endif; wp_reset_query(); ?>
	
	</div>

</div>

<?php get_footer(); ?>