<?php 
global $theme_option;
get_header( );
?>

        <!-- Page Blog -->
        <section class="page-section with-sidebar sidebar-right">
            <div class="container">
                <div class="row">

                    <!-- Content -->
                    <section id="content" class="content col-sm-8 col-md-9">

						<?php if ( have_posts() ) : ?>

							<header class="page-header">
								<h3 class="page-title"><?php printf( __( 'Search Results for: %s', TEXT_DOMAIN ), get_search_query() ); ?></h3>
							</header><!-- .page-header -->

							<ul class="search">
							<?php
								// Start the Loop.
								while ( have_posts() ) : the_post(); ?>
								
									<li>
										<h4>
											<a href="<?php the_permalink(); ?>">
												<?php the_title( ); ?>
											</a>
										</h4>
										<div class="content">
											<?php the_excerpt(); ?>
										</div>										
									</li>
									<hr class="page-divider transparent visible-xs">
								<?php endwhile; ?>
							</ul>
								
								<?php 
								// Previous/next post navigation.
								ova_numeric_posts_nav();

							else : ?>
								 <!-- If no content, include the "No posts found" template. -->
								<h3 class="page-title"><?php printf( __( 'No posts found', TEXT_DOMAIN ), get_search_query() ); ?></h3>

						<?php	endif;
						?>
                    </section>
                    <!-- Content -->

                    <hr class="page-divider transparent visible-xs"/>

                    <!-- Sidebar -->
                    <aside id="sidebar" class="sidebar col-sm-4 col-md-3">
                        <?php dynamic_sidebar('sidebar-right' ); ?>
                    </aside>
                    <!-- Sidebar -->
                </div>
            </div>
        </section>
        <!-- /Page Blog -->
   
<?php get_footer(); ?>