<?php
/**
 * The template for displaying author page
 *
 */
 
get_header();

global $unik_data;

?>
<div id="primary" class="content-area">
	<div id="inside">
		<?php if($unik_data['breadcrumb']==1): ?><div class="breadcrumb  bg-block-1"><?php unik_breadcrumbs(); ?></div><?php endif; ?>
		<div class="site-content" >
			<div class="row">
				<div class="col-lg-8">
					<div class="content-wrap bg-block-1">
					<?php if ( have_posts() ) : the_post(); ?>
						<div class="page-title">
							<h1 class="archive-title"><?php printf( __( 'All posts by %s', THEMENAME ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1><!-- .archive-header -->
						
							<?php if(!$unik_data['blog_secondary_title']==''):?>
								<h3 class="secondary-title"><?php echo $unik_data['blog_secondary_title'] ; ?></h3>
							<?php endif; ?>
						
						</div>
						
						<?php
							/*
							 * Since we called the_post() above, we need to
							 * rewind the loop back to the beginning that way
							 * we can run the loop properly, in full.
							 */
							rewind_posts();
						?>

						<?php if ( get_the_author_meta( 'description' ) ) : ?>
							<?php get_template_part( 'author-bio' ); ?>
						<?php endif; ?>

						<?php /* The loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'content', get_post_format() ); ?>
						<?php endwhile; ?>

						<?php unik_pagination(); ?>

					<?php else : ?>
						<?php get_template_part( 'content', 'none' ); ?>
					<?php endif; ?>
					
					</div>
				</div><!-- left column -->
							
				<div class="col-lg-4 sidebar">
					<?php ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Blog Sidebar') ); ?>
				</div><!-- right column -->
				
			</div>
		</div><!-- .site-content -->
	</div><!-- #inside -->
</div><!-- #primary -->	
<?php get_footer(); ?>