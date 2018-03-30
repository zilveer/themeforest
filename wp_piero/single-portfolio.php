<?php
/**
 * The Template for displaying all single portfolio.
 *
 * @package cshero
 */

global $smof_data,$breadcrumb;

$portfolio_category = get_post_meta(get_the_ID(),'cs_portfolio_category',true);
$portfolio_layout = get_post_meta(get_the_ID(),'cs_portfolio_layout',true);
if ($portfolio_layout==''){$portfolio_layout = $smof_data['details_portfolio_layout']; }

$portfolio_gallery = get_post_meta(get_the_ID(),'cs_portfolio_gallery',true);
$portfolio_about_project = get_post_meta(get_the_ID(),'cs_portfolio_about_project',true);
$portfolio_project_date = get_post_meta(get_the_ID(),'cs_portfolio_project_date',true);
$portfolio_project_client = get_post_meta(get_the_ID(),'cs_portfolio_project_client',true);
$link = get_post_meta(get_the_ID(), 'cs_portfolio_link', true);

$gallery_layout = get_post_meta(get_the_ID(),'cs_portfolio_gallery_layout',true);
if ($gallery_layout==''){$gallery_layout = $smof_data['details_portfolio_gallery_layout']; }

get_header(); ?>
	<section id="primary" class="content-area blog-masonry <?php if($breadcrumb == '0'){ echo ' no_breadcrumb'; }; ?>">
		<main id="main" class="site-main" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				
				<div id="cs-portfolio-content"  class="container cs-portfolio-wrap <?php echo esc_attr($portfolio_layout); ?>">
					<?php get_template_part( 'framework/templates/portfolio/single', $portfolio_layout); ?>
				</div>
			<?php endwhile; ?>

			<?php
                if($smof_data['show_navigation_post'] == '1'){
                   echo  '<div class="cshero-portfolio-item-nav"><div class="container">';
                   cshero_post_nav();
                   echo '</div></div>';
                }
            ?>
            <?php  
                get_template_part('framework/templates/portfolio/related');
            ?>
		</main><!-- #main -->
	</section><!-- #primary -->
<?php get_footer(); ?>