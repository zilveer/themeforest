<?php
/**
 * @KingSize 2011 - This is the page.php
 *
 * @KingSize Template by Denoizzed and Our Web Media
 * Developed by: Our Web Media 2011
 * Developer URL: http://themeforest.net/user/OurWebMedia
 * Original design by: Denoizzed 2010
 * Author URL: http://themeforest.net/user/Denoizzed
 **/
$tpl_body_id = 'blog_overview';
global $data,$postParentPageID;

get_header(); ?>
			
			<!-- Begin Breadcrumbs -->
			<div class="row">
				<div class="twelve columns">
					<?php if ( function_exists('yoast_breadcrumb') ) {
						yoast_breadcrumb('<p id="breadcrumbs" class="yoast-bc">','</p>');
					} ?>
				</div>
			</div>
			<!-- End Breadcrumbs -->
    
			<!--Sample Page Start-->
            <div class="row">
            	<div class="twelve columns  mobile-twelve page_content fullwidth-page ks-woocommerce">

					<!-- Content here -->
					<?php woocommerce_content(); ?>

				</div> <!-- twelve columns/blog  -->
            </div> <!-- end row -->
        <!--Sample Page End-->

<?php get_footer(); ?>
