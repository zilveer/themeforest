<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package cshero
 */
get_header();
global $smof_data;
$type = $smof_data['404_type'];
/* Redirect Home */
if($type == 'Redirect Home'){
    wp_redirect( home_url() ); exit;
}
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<section class="error-404 not-found container">
			    <?php if($smof_data['404_heading'] == '1'): ?>
				<header class="page-header">
					<h1 class="page-title">404</h1>
				</header><!-- .page-header -->
				<?php endif; ?>
				<div class="page-content">
				<?php
				if($type == 'From Page'){
				    if($smof_data['404_page_id']){
                        $error_page = get_post($smof_data['404_page_id']);
				        if(!empty($error_page)){
				            $content = apply_filters("the_content", $error_page->post_content);
				            echo $content;
				        } else {
				            cshero_404_page_default();
				        }
				    } else {
				        cshero_404_page_default();
				    }
				} else {
				    cshero_404_page_default();
				}
				?>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
