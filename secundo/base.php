<?php get_template_part('templates/header'); ?>
<body <?php body_class(function_exists('icl_object_id') ? (ICL_LANGUAGE_CODE . ' ') : ''); ?>>
<?php
get_template_part('templates/head-top-navbar');
?>
<?php include roots_template_path(); ?>
<div class="patStd nomrg">
	<div class="container">
		<div class="row-fluid">
			<div class="span12 doRight">
				<a href="#" class="arrowIcon vsmall toTop"><?php _e('BACK TO TOP', 'ct_theme');?><i class="arrow-toTop"></i></a>
			</div>
		</div>
	</div>
</div>
<?php get_template_part('templates/footer'); ?>
<?php wp_footer(); ?>

























</body>
</html>
