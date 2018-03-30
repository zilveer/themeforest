<?php get_header(); ?>

<?php 

$title = get_iron_option('404_page_title'); 
$content = get_iron_option('404_page_content'); 
	
	
?>
	<!-- container -->
	<div class="container">
	
		<div class="content__wrapper boxed">
			<!-- single-post -->
			<article class="single-post">
				<?php
					if(is_page_title_uppercase() == true){
						echo '<div class="page-title uppercase">';
					} else {
						echo '<div class="page-title">';
					};
				?>
					<span class="heading-t"></span>
					<h1><?php esc_attr_e($title, IRON_TEXT_DOMAIN); ?></h1>
					<?php
						iron_page_title_divider();
					?>
				</div>
				
				<?php _e($content, IRON_TEXT_DOMAIN); ?>
			</article>
		</div>
	
	</div>

<?php get_footer(); ?>