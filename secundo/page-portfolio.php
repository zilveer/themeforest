<?php
/*
Template Name: Portfolio Template
*/
?>
<?php get_template_part('templates/page', 'head'); ?>
<?php if($pageTitle = ct_get_option('portfolio_index_page_title', '')):?>
	<div class="patBlue">
		<div class="container">
			<h1 class="twoLines"><span><?php echo $pageTitle; ?></span></h1>
		</div>
	</div>
<?php endif;?>
<?php get_template_part('templates/content', 'portfolio'); ?>