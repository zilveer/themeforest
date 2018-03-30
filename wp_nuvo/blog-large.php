<?php
/*
Template Name: Blog Large Image
*/
get_header(); ?>
<?php global $paged, $post, $pagetitle; ?>
<?php $layout = cshero_generetor_layout();?>
	<div id="primary" class="content-area<?php if($pagetitle == '1'){ echo ' cs-page-title-active'; }; ?>">
        <div class="<?php if(get_post_meta($post->ID, 'cs_blog_layout', true) == "full"){ echo "no-container";} else { echo "container"; } ?>">
            <div class="row">
                <?php if($layout->left1_col):?>
            		<div class="left-wrap <?php echo $layout->left1_col; ?>">
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
            		<div class="left-wrap <?php echo $layout->left2_col; ?>">
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
                <div class="content-wrap <?php echo $layout->blog; ?>">
                    <main id="main" class="site-main" role="main">
                        <?php
                        $temp = $wp_query;
                        $wp_query= null;
                        $wp_query = new WP_Query();
                        $wp_query->query('post_type=post&showposts='.get_option('posts_per_page').'&paged='.$paged);
                        if ( have_posts() ) :
                            while ( have_posts() ) : the_post();
                                get_template_part( 'framework/templates/blog/blog',get_post_format());
                            endwhile;
                            cshero_paging_nav();
                        else :
                            get_template_part( 'framework/templates/blog/blog', 'none' );
                        endif;
                        ?>
                    </main><!-- #main -->
                </div>
                <?php if($layout->right1_col):?>
            		<div class="right-wrap <?php echo $layout->right1_col; ?>">
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
            		<div class="right-wrap <?php echo $layout->right2_col; ?>">
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
