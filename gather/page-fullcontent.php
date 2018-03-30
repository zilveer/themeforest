<?php

/**
 * Template Name: Page No Sidebar
 *
 * @package Gather - Event Landing Page Wordpress Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 10-8-2015
 *
 * @copyright  Copyright ( C ) 2014 - 2015 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

global $wp_query,$cththemes_options;
$single_header_subtitle = get_post_meta(get_the_ID(), '_cmb_single_header_subtitle', true);

get_header();

?>
<!-- 
 Sub Header - for inner pages
 ====================================== -->

<header id="top" class="sub-header">
    <div class="container">
        <h3 class="page-title wow fadeInDown"><?php single_post_title( ) ;?><small><?php echo esc_attr($single_header_subtitle );?></small></h3>
        <?php gather_breadcrumbs();?>
    </div>
    <!-- end .container -->
</header>
	<!-- end .sub-header -->
<section>

	<div class="container">

        <?php if(have_posts()) : ?>
			<?php while(have_posts()) : the_post(); ?>
				
				<?php get_template_part( 'content', 'page'); ?>

				<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
				?>
			
			<?php endwhile; ?>

		<?php endif; ?> 
	</div>
</section>
<?php
get_footer(); 
?>