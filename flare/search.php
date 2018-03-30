<?php
/**
 * The Template for displaying Search Results pages.
 *
 * @package BTP_Flare_Theme
 */
?>
<?php get_header(); ?>

	<?php get_template_part( 'precontent' ); ?>

	<div id="content" class="<?php echo btp_content_get_class(); ?>">
		<div id="content-inner">					
			<?php if ( have_posts() ) : ?>
				<ul class="search-results">								
				<?php while( have_posts() ): the_post(); ?>
					<li>
						<p class="meta search-meta">
							<?php 
								$obj = get_post_type_object(get_post_type()); 
								echo $obj->labels->singular_name;
							?>
						</p>
						<h3 class="search-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr(__('Permalink to %s', 'btp_theme') ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
						<div class="search-summary">
							<?php the_excerpt(); ?>
						</div>
					</li>
				<?php endwhile; ?>
				</ul>
				<?php btp_pagination_render(); ?>
			<?php else: ?>
				<?php get_template_part( 'no_results', 'search' ); ?>	
			<?php endif; ?>				
	
		</div><!-- #content-inner -->
		<div class="background"><div></div></div>
	</div><!-- #content -->	

<?php get_footer(); ?>