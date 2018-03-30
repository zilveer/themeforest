<?php 
$blog_with_sidebar = "";
if ( (isset($mr_tailor_theme_options['sidebar_blog_listing'])) && ($mr_tailor_theme_options['sidebar_blog_listing'] == "1" ) ) $blog_with_sidebar = "yes";
if (isset($_GET["blog_with_sidebar"])) $blog_with_sidebar = $_GET["blog_with_sidebar"];    
?>

<?php get_header(); ?>

	<div id="primary" class="content-area archive">

		 <?php if ( have_posts() ) : ?>
            
			<div class="row">
				<div class="large-8 large-centered columns">
				
					<header class="page-header text-center archive">
						<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'mr_tailor' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
					</header><!-- .page-header -->
					
				</div><!-- .columns -->
			</div><!-- .row -->
			
		<?php endif; ?>
	
        <?php if ( $blog_with_sidebar == "yes" ) : ?>
            <div class="row"><div class="large-8 columns with-sidebar">
        <?php endif; ?>
        
                <div id="content" class="site-content" role="main">
                
                    <?php if ( have_posts() ) : ?>
            
                        <?php while ( have_posts() ) : the_post(); ?>
            
                            <?php
                                //get_template_part( 'content', 'search' );
								get_template_part( 'content', get_post_format() );
                            ?>
								<hr class="content_hr" />
                        <?php endwhile; ?>
            
                        <?php mr_tailor_content_nav( 'nav-below' ); ?>
            
                    <?php else : ?>
            
                        <?php get_template_part( 'content', 'none' ); ?>
            
                    <?php endif; ?>
                    
                </div><!-- #content --> 
                         
            <?php if ( $blog_with_sidebar == "yes" ) : ?>
        		</div><!-- .columns -->
            <?php endif; ?>
            
            <?php if ( $blog_with_sidebar == "yes" ) : ?>
				<div class="large-4 columns">        					
					<?php get_sidebar(); ?>			           
                </div><!-- .columns -->
            <?php endif; ?>
            
        <?php if ( $blog_with_sidebar == "yes" ) : ?>
        	</div><!-- .row -->
        <?php endif; ?>
                            
    </div><!-- #primary -->

<?php get_footer(); ?>
