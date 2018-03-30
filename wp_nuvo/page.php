<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package cshero
 */

get_header(); ?>
<?php global $post,$pagetitle; ?>
<?php $layout = cshero_generetor_layout();?>
	<div id="primary" class="content-area<?php if($pagetitle == '1'){ echo ' cs-page-title-active'; }; ?>">
        <div class="<?php if(get_post_meta($post->ID, 'cs_blog_layout', true) == "full"){ echo "no-container";} else { echo "container"; } ?>">
            <div class="row">
                <?php if($layout->left1_col):?>
            		<div class="left-wrap <?php echo esc_attr($layout->left1_col); ?>">
            		     <div id="secondary" class="widget-area" role="complementary">
							<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
								<?php
								foreach ($layout->left1_sidebar as $sidebar){
									dynamic_sidebar($sidebar);
								}
								?>
							</div>
						 </div>
            		</div>
            	<?php endif; ?>
            	<?php if($layout->left2_col):?>
            		<div class="left-wrap <?php echo esc_attr($layout->left2_col); ?>">
            		     <div id="secondary" class="widget-area" role="complementary">
							<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
								<?php
								foreach ($layout->left2_sidebar as $sidebar){
									dynamic_sidebar($sidebar);
								}
								?>
							</div>
						 </div>
            		</div>
            	<?php endif; ?>
                <div class="content-wrap <?php echo esc_attr($layout->blog); ?>">
                    <main id="main" class="site-main" role="main">
						<div class="sidebar-custom-button-wrap">
							<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Custom Button Action")):
							endif;
							?>
						</div>
                        <?php while ( have_posts() ) : the_post(); ?>

                            <?php get_template_part( 'framework/templates/page/page'); ?>

                            <?php
                                // If comments are open or we have at least one comment, load up the comment template
                                if (cshero_show_comments() == '1') :
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
								<?php
								foreach ($layout->right1_sidebar as $sidebar){
									dynamic_sidebar($sidebar);
								}
								?>
							</div>
						 </div>
            		</div>
            	<?php endif; ?>
            	<?php if($layout->right2_col):?>
            		<div class="right-wrap <?php echo esc_attr($layout->right2_col); ?>">
            		     <div id="secondary" class="widget-area" role="complementary">
							<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
								<?php
								foreach ($layout->right2_sidebar as $sidebar){
									dynamic_sidebar($sidebar);
								}
								?>
							</div>
						 </div>
            		</div>
            	<?php endif; ?>
            </div>
        </div>
	</div><!-- #primary -->

<?php get_footer(); ?>
