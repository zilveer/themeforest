<?php
get_header(); ?>

	<div id="main" class="clearfix">

		<div id="primary" class="clearfix">
				<header class="entry-header">
					<h1 class="entry-title-lead"><?php echo the_title();?></h1>
				</header><!-- .entry-header -->
			
			<div id="content" role="main">
			
				<?php $portfolios_per_page = ot_get_option( 'portfolios_per_page' ); ?>
				
				<?php
				$portfolio_title_position = ot_get_option( 'portfolio_title_position' );
				if ( ! empty( $portfolio_title_position ) ) {
					$portfolio_title_position_class = 'title-visible';
				} else {
					$portfolio_title_position_class = 'title-hidden';
				}
				?>
				
				<?php
				$portfolio_columns = ot_get_option( 'portfolio_columns' );
				if ( $portfolio_columns == 'portfolio_four_columns' )
					$portfolio_columns_class = 'col4';
				else 
					$portfolio_columns_class = 'col3';
				?>
			
				<div id="block-portfolio-fixed-width" class="clearfix">
					
					<div id="portfolio-fixed-width" class="<?php echo sanitize_html_class( $portfolio_columns_class ); ?> <?php echo sanitize_html_class( $portfolio_title_position_class ); ?> clearfix">	
						<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>
						
						<?php $wp_query = new WP_Query(); ?>
						<?php $wp_query->query('post_type=portfolio&portfolio-category='.$term->slug.'&posts_per_page='.$portfolios_per_page.'&post_status=publish'.'&paged='.$paged); ?>

						<?php if ( $wp_query->have_posts() ) : ?>
						
							<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
						
								<?php $portfolio_terms = get_the_terms( get_the_ID(), 'portfolio-category' ); ?>
								<?php $portfolio_term = ''; ?>
								<?php if ( is_array( $portfolio_terms ) ){ ?>
									<?php foreach( $portfolio_terms as $term ) { ?>
										<?php $portfolio_term.= $term->slug.' '; ?>
									<?php } ?>
								<?php } ?>
									
								<?php if ( ! empty( $portfolio_title_position ) ) { ?>
									<?php get_template_part( 'content-portfolio-title-visible' ); ?>
								<?php } else { ?>
									<?php get_template_part( 'content-portfolio' ); ?>
								<?php } ?>
							
								<?php endwhile; ?>
							
							<?php else : ?>
									
								<div class="entry-content clearfix">
									<p class="no-found"><?php _e( 'No portfolios found, please add some portfolios.', 'mega' ); ?></p>
								</div><!-- .entry-content -->

							<?php endif; ?>
					</div><!-- #portfolio -->	
					
					<?php $portfolio_pagination = ot_get_option( 'portfolio_pagination' ); ?>
					<?php if ( ! empty( $portfolio_pagination ) ) { ?>
						<?php mega_pagination_content_nav( 'nav-pagination' ); ?>
					<?php } ?>
					
					<?php wp_reset_query(); ?>
					
				</div><!-- #block-portfolio-fixed-width -->
			
			</div><!-- #content -->
		</div><!-- #primary -->
		
<?php get_footer(); ?>