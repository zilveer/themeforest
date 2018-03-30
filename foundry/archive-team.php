<?php 
	get_header();
	the_post();

	echo ebor_get_page_title( 
		get_option('team_title','Our team'), 
		$subtitle = get_option('team_subtitle', 'The team subtitle'), 
		$icon = false, 
		$thumbnail = ( get_option('foundry_team_header_image') ) ? '<img src="'. get_option('foundry_team_header_image') .'" alt="Team Header" class="background-image" />' : false, 
		$layout = get_option('foundry_team_header_layout', 'left-short-grey')
	);
?>

	<section>
		<div class="container">
		    <div class="row">
		        <div class="col-sm-12">
		        	<?php get_template_part('loop/loop-team', get_option('team_layout', 'box')); ?>
		        </div>
		    </div>
		</div>
	</section>
	
<?php get_footer();