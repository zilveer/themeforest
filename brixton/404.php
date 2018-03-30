<?php get_header(); 
global $pmc_data;
?>
<!-- top bar with breadcrumb -->
<div class = "outerpagewrap">
	<div class="pagewrap">
		<div class="pagecontent">
			<div class="pagecontentContent">
				<p><?php  echo pmc_breadcrumb(); ?></p>
			</div>
		</div>
	</div>
</div> 
<!-- main content start -->			
<div id="mainwrap">
	<div id="main" class="clearfix">
		<div class="content fullwidth errorpage">
			<div class="postcontent">
				<h2><?php echo stripslashes($pmc_data['errorpagetitle']) ?></h2>
				<div class="posttext">
					<?php echo stripslashes($pmc_data['errorpage']) ?>
				</div>
				<div class="homeIcon"><a href="<?php echo home_url(); ?>"></a></div>
			</div>							
		</div>
	</div>
</div>
<?php get_footer(); ?>