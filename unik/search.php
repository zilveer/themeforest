<?php
/**
 * The template for displaying search page. It shows search items
 *
 */
 
global $unik_data;
get_header();

$layout = $unik_data['blog_layout']; 

?>
<div id="primary" class="content-area">
	<div id="inside">
	
		<?php if($unik_data['breadcrumb']==1 && !is_front_page()) : ?><div class="breadcrumb bg-block-1"><?php unik_breadcrumbs(); ?></div><?php endif; ?>
		
		<div class="site-content" >
			<div class="row">
				
				<?php if ( have_posts() ) : ?>
				
				<div id="post-content" class=" <?php if($layout=='left'){echo 'right col-lg-8';} elseif($layout=='nosidebar'){echo 'full col-lg-12' ;} else{echo 'col-lg-8';} ?>">
					
					<div class="content-wrap bg-block-1">
					
						<header class="title">
							
							<h1><?php printf( __( 'Search Results for: %s', THEMENAME ), get_search_query() ); ?></h1>
							
						</header>
					
					<?php while ( have_posts() ) : the_post(); ?>
					
						<?php get_template_part( 'content', get_post_format() ); ?>
					
					<?php endwhile;  ?>	
					
					<?php unik_pagination(); ?>
					
					</div>
				</div><!--Left column -->
				
				<?php if($layout!=='nosidebar'): ?>
				
				<div class="col-lg-4 <?php echo $layout; ?> sidebar">
					
					<?php ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Blog Sidebar') ); ?>
				
				</div><!--Right column -->
				
				<?php endif; ?>
				
			<?php endif; ?>
			</div>
			
		</div><!-- .site-content -->
	</div><!-- #inside -->
</div><!-- #primary -->	
<?php get_footer(); ?>