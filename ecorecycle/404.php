<?php get_header(); 
global $pmc_data;
?>
<!-- main content start -->			
<div id="mainwrap">
	<div id="main" class="clearfix">
		<div class="content fullwidth errorpage">
			<div class="postcontent">
				<h2><?php echo pmc_security($pmc_data['errorpagetitle']) ?></h2>
				<div class="posttext">
					<?php echo pmc_security($pmc_data['errorpage']) ?>
				</div>
				<div class="homeIcon"><a href="<?php echo esc_url(home_url()); ?>"></a></div>
			</div>							
		</div>
	</div>
</div>
<?php get_footer(); ?>