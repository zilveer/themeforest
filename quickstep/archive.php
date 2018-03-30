<?php get_header(); ?>
<?php $page_id = get_the_ID(); // Get the ID for navigation permalinks ?> 

		<div id="container-<?php the_ID(); ?>" class="container first">
			
			<div id="content" class="clearfix">
			
            	<div class="row">
            
                
              		<?php $pageURL = $_SERVER["REQUEST_URI"]; ?>  
				
					<?php if (is_category()) { ?>
						<h1 class="archive-title">
							<span><?php _e("Posts in", "qs_framework"); ?></span> <?php single_cat_title(); ?>
						</h1>
					<?php } elseif (is_tag()) { ?> 
						<h1 class="archive-title">
							<span><?php _e("Posts tagged", "qs_framework"); ?></span> <?php single_tag_title(); ?>
						</h1>
					<?php } elseif (is_author()) { ?>
						<h1 class="archive-title">
							<span><?php _e("Posts written by", "qs_framework"); ?></span> <?php echo get_the_author_meta('display_name', get_query_var('author')); ?>
						</h1>
					<?php } elseif (is_day()) { ?>
						<h1 class="archive-title">
							<span><?php _e("Daily Archives:", "qs_framework"); ?></span> <?php the_time('l, F j, Y'); ?>
						</h1>
					<?php } elseif (is_month()) { ?>
					    <h1 class="archive-title">
					    	<span><?php _e("Monthly Archives:", "qs_framework"); ?></span> <?php the_time('F Y'); ?>
					    </h1>
					<?php } elseif (is_year()) { ?>
					    <h1 class="archive-title">
					    	<span><?php _e("Yearly Archives:", "qs_framework"); ?></span> <?php the_time('Y'); ?>
					    </h1>
					<?php }  elseif (taxonomy_exists('filter')) { ?>
					    <h1 class="archive-title">
					    	<span><?php _e("Portfolio:", "qs_framework"); $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );?></span> <?php echo $term->name; ?>
                            <?php $term_name = $term->name; ?>
					    </h1>
					<?php } ?>


				<section class="eight columns clearfix" role="main">
                
					<?php if (have_posts()) :
                                                while (have_posts()) : the_post();
                                                    if (!get_post_format()) {
                                                        get_template_part('format', 'standard');
                                                    } else {
                                                        get_template_part('format', get_post_format());
                                                    }
                                                endwhile;
					
					?>	
					
					<?php if (function_exists('page_navi')) { // if expirimental feature is active ?>
						
						<?php page_navi(); // use the page navi function ?>

					<?php } else { // if it is disabled, display regular wp prev & next links ?>
						<nav class="wp-prev-next">
							<ul class="clearfix">
								<li class="prev-link"><?php next_posts_link(_e('&laquo; Older Entries', "qs_framework")) ?></li>
								<li class="next-link"><?php previous_posts_link(_e('Newer Entries &raquo;', "qs_framework")) ?></li>
							</ul>
						</nav>
					<?php } ?>
								
					
					<?php else : ?>
					
					<article id="post-not-found">
					    <header>
					    	<h1><?php _e("No Posts Yet", "qs_framework"); ?></h1>
					    </header>
					    <section class="post_content">
					    	<p><?php _e("Sorry, What you were looking for is not here.", "qs_framework"); ?></p>
					    </section>
					    <footer>
					    </footer>
					</article>
					
					<?php endif; ?>
			
				</section> <!-- end #main -->

    			
                <div class="four columns last">
					<?php get_sidebar(); // sidebar 1 ?>
                </div>
    
    			</div><!-- end .row -->
			</div> <!-- end #content -->
            
       </div><!-- end .container -->

<?php get_footer(); ?>