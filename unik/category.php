<?php
/**
 * The template for displaying Category pages
 *
 */
 
global $unik_data;
get_header();

$layout = $unik_data['blog_layout']; 

?>
<div id="primary" class="content-area">
	<div id="inside">
		
	<?php if($unik_data['breadcrumb']==1): ?><div class="breadcrumb  bg-block-1"><?php unik_breadcrumbs(); ?></div><?php endif; ?>
		
		<div class="site-content" >
			<div class="row">
			
			<?php if ( have_posts() ) : ?>
				
				<div id="post-content" class="<?php if($layout=='left'){echo 'right col-lg-8';} elseif($layout=='nosidebar'){echo 'full col-lg-12' ;} else{echo 'col-lg-8';} ?>">
				
					<div class="content-wrap bg-block-1">
						<div class="page-title">
							<h1 class="archive-title"><?php printf( __( 'Category Archives: %s', THEMENAME ), single_cat_title( '', false ) ); ?></h1>

						<?php if ( category_description() ) : // Show an optional category description ?>
							<div class="archive-meta"><?php echo category_description(); ?></div>
						
						<?php else: ?>
							<?php if(!$unik_data['blog_secondary_title']==''):?>
								<h3 class="secondary-title"><?php echo $unik_data['blog_secondary_title'] ; ?></h3>
							<?php endif; ?>						
						
						<?php endif; ?>
						
						</div>
						
						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'content', get_post_format() ); ?>
						<?php endwhile;  ?>	
						
						<?php unik_pagination(); ?>
						
					</div>
				</div><!-- left column -->
				
				<?php if($layout!=='nosidebar'): ?>
					<div class="col-lg-4 <?php echo $layout; ?> sidebar">
						<?php ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Blog Sidebar') ); ?>
					</div><!-- right column -->	
				<?php endif; ?>
				
			<?php endif; ?>
			
			</div>
		</div><!-- site-content -->
	</div><!-- #inside -->
</div><!-- #primary -->	
<?php get_footer(); ?>