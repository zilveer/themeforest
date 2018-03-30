<?php
/**
 * The Template for displaying all single posts.
 * @author Fox
 * @package cshero
 */
get_header(); ?>
<?php global $smof_data,$breadcrumb; $layout = cshero_generetor_layout(); ?>

	<section id="primary" class="single-post content-area<?php if($breadcrumb == '0'){ echo ' no_breadcrumb'; }; ?><?php echo esc_attr($layout->class); ?>">
        <div class="container">
            <div class="row">
            	<?php if($layout->left1_col):?>
            		<div class="left-wrap <?php echo esc_attr($layout->left1_col); ?>">
            		     <div id="secondary" class="widget-area" role="complementary">
							<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
								<?php dynamic_sidebar($layout->left1_sidebar); ?>
							</div>
						 </div>
            		</div>
            	<?php endif; ?>
                <div class="content-wrap <?php echo esc_attr($layout->blog); ?>">
                    <main id="main" class="site-main" role="main">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php get_template_part( 'framework/templates/single/single',get_post_format()); ?>
                            
                            <?php
                                if($smof_data['show_navigation_post'] == '1'){
                                    cshero_post_nav();
                                }
                            ?>
                            <?php  
                                get_template_part('framework/templates/single/related');
                            ?>
                            
                            <?php
                            // If comments are open or we have at least one comment, load up the comment template
                            if (cshero_show_comments('post') == '1') :
                                comments_template();
                            endif;
                            ?>
                        <?php endwhile; // end of the loop. ?> 
                    </main><!-- #main -->
                </div>
                <?php if($layout->right1_col):?>
            		<div class="right-wrap <?php echo esc_attr($layout->right1_col); ?>">
            		     <div id="secondary" class="widget-area" role="complementary">
							<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
								<?php dynamic_sidebar($layout->right1_sidebar); ?>
							</div>
						 </div>
            		</div>
            	<?php endif; ?>
            </div>
        </div>
	</section><!-- #primary -->
<?php get_footer(); ?>