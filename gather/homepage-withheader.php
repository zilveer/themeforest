 <?php

/**
 * Template Name: Home Page with Header
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
<?php while(have_posts()) : the_post(); ?>

	<?php the_content(); ?>
	<?php wp_link_pages(); ?>

<?php endwhile; ?>
<?php get_footer(); ?>