<?php

$colclass = 'col-9';

if ( op_theme_opt( 'hide-sidebar-blog-single' ) )
	$colclass = 'col-12';

?>

<main role="main">

	<!-- Start Single Post -->
	<section>

		<div class="section-inner section-post <?php esc_attr_e( retro_text_color( $post->ID ) ); ?>" style="background-color: <?php esc_attr_e( retro_get_background_color( $post->ID ) ); ?>">
			
			<hr class="top-dashed"> 
			
			<div class="container">
				
				<div class="row clear">

					<article class="col <?php echo $colclass; ?> tablet-full mobile-full">

						<h2 class="post-title"><?php the_title(); ?></h2>

						<hr class="single-hr">

						<h4 class="post-meta">
							<?php esc_attr_e( __( 'Posted on', 'openframe' ) ) ?>
							<span class="enbold">
								<time datetime="<?php esc_attr_e( get_the_time( DATE_W3C ) ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
							</span>
							//
							<?php esc_attr_e( __( 'By', 'openframe' ) ) ?>
							<span class="enbold"><?php the_author_link(); ?></span>
							//
							<?php esc_attr_e( __( 'In', 'openframe' ) ) ?>
							<?php the_category(', ') ?>
						</h4>

						<?php if ( has_post_thumbnail() ) : ?>

							<div class="post-pic">

								<?php get_template_part( 'featured', get_post_format() ); ?>

							</div>

						<?php endif; ?>

						<div class="hentry-content">

							<?php the_content(); ?>

						</div>

						<?php
						if ( comments_open() )
							comments_template();
						?>

					</article>  

					<?php if ( ! op_theme_opt( 'hide-sidebar-blog-single' ) ) : ?>

						<aside class="blog-sidebar col col-3 tablet-full mobile-full">

							<?php get_sidebar(); ?>
							             
						</aside>

					<?php endif; ?>

				</div><!-- row -->           

			</div><!-- container -->

			<hr class="bottom-dashed"> 

		</div>

	</section> 

	<!-- End Single Post -->

</main>