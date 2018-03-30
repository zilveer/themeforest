<?php
/*
Template Name: Sitemap 2
*/
?>
<?php 
get_header(); 
get_template_part( 'theme-template-part-slider', 'childtheme' );

// retrieve values from site options panel
global $ttso;
$sitemap_column1 = $ttso->ka_sitemap2_column1;
$sitemap_column2 = $ttso->ka_sitemap2_column2;
$sitemap_column3 = $ttso->ka_sitemap2_column3;
?>
        
		<main role="main" id="content">
        	<div class="one_third">
            	<?php echo '<h3>'.$sitemap_column1.'</h3>';
					
					if (function_exists('wp_nav_menu')) {
						echo '<ul class="list sitemap-list list1">';
								wp_nav_menu( array(
								'container' =>false,
								'theme_location' => 'Primary Navigation',
								'sort_column' => 'menu_order',
								'menu_class' => '',
								'echo' => true,
								'before' => '',
								'after' => '',
								'link_before' => '',
								'link_after' => '',
								'depth' => 0));
								echo '</ul>';} ?>
            </div><!-- END one_third -->
            
			<div class="one_third">
				<?php echo '<h3>'.$sitemap_column2.'</h3>' ?>
                	<ul class="list list1">
						<?php 
						$neg_excluded = B_getExcludedCats();
						$neg_cats = $neg_excluded;
						wp_get_archives(apply_filters('widget_archives_args',
							array(
							'type'            => 'postbypost',
							'show_post_count' => '',
							'cat'             => $neg_cats
							     )
								)
							);
						?>
                   </ul>
			</div><!-- END one_third -->
    
			<div class="one_third_last sitemap-last">
				<?php echo stripslashes($sitemap_column3); ?>
			</div><!-- END one_third_last -->
		</main><!-- END main #content -->
        
        <aside role="complementary" id="sidebar" class="right_sidebar">
			<?php generated_dynamic_sidebar(); ?>
        </aside><!-- END sidebar -->
</div><!-- END main-area -->

<?php get_footer(); ?>