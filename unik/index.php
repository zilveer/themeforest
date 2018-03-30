<?php
/**
 * The template for displaying blog posts
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
						<div class="page-title">
							<h1 class="entry-title"><?php echo $unik_data['blog_title'];  ?></h1>
						
							<?php if(!$unik_data['blog_secondary_title']==''):?>
								<h3 class="secondary-title"><?php echo $unik_data['blog_secondary_title'] ; ?></h3>
							<?php endif; ?>
						
						</div>
						
						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'content', get_post_format() ); ?>
						<?php endwhile;  ?>	
						
						<?php unik_pagination(); ?>
						
					</div>
				</div><!--Left column -->
				
				<?php if($layout!=='nosidebar'): ?>				
				<div class="col-lg-4 <?php echo $layout; ?> sidebar">					
					<?php get_sidebar(); ?>				
				</div>				
				<?php endif; ?><!--RIght column -->
				
			<?php endif; ?>
			</div><!-- row -->
		</div><!-- site-content -->
	</div><!-- #inside -->
</div><!-- #primary -->	
<?php get_footer(); ?>