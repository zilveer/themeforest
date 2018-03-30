<?php get_header(); ?>


<!-- BEGIN CONTENT -->

<div id="content">


	<!-- BEGIN BREADCRUMBS -->

	<?php if($gp_settings['breadcrumbs'] == "Show") { ?><div id="breadcrumb"><?php echo gp_breadcrumbs(); ?></div><?php } ?>
	
	<!-- END BREADCRUMBS -->


	<!-- BEGIN TITLE -->
	
	<h1 class="page-title"><?php the_title(); ?></h1>

	<!-- END TITLE -->
	
		
	<!-- BEGIN IMAGE -->
		
	<?php the_attachment_link(get_the_ID(), true) ?>
	
	<!-- END IMAGE -->
	
	
	<!-- BEGIN POST CONTENT -->
	
	<div id="post-content">
	
		<?php the_content('&raquo;'); ?>
		
	</div>
	
	<!-- END POST CONTET-->
	
			
</div>

<!-- END CONTENT -->


<?php get_footer(); ?>