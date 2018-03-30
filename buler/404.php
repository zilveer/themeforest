<?php get_header(); ?>

<!-- top bar with breadcrumb -->
<div class = "outerpagewrap">
	<div class="pagewrap">
		<div class="pagecontent">
			<div class="pagecontentContent">
				<p><?php echo pmc_breadcrumb(); ?></p>
			</div>
		</div>

	</div>
</div> 
<!-- main content start -->			
<div id="mainwrap">
	<div id="main" class="clearfix">
		<div class="content fullwidth errorpage">
			<div class="postcontent">
				<h2><?php if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { echo pmc_stripText($pmc_data['errorpagetitle']); } else {  _e('OOOPS! 404','buler'); } ?></h2>
				<div class="posttext">
					<?php if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { echo pmc_stripText($pmc_data['errorpage']); } else {  _e('Sorry, but the page you are looking for has not been found.<br/>Try checking the URL for errors, then hit refresh.</br>Or you can simply click the icon below and go home:)','buler'); } ?>
				</div>
				<div class="homeIcon"><a href="<?php echo home_url(); ?>"></a></div>
			</div>							
		</div>
	</div>
	<!-- bottom quote -->
	<div class="infotextwrap">
		<div class="infotext">
			<div class="infotext-title">
				<h2><?php echo pmc_translation('quote_big','CHECK OUR LATEST WORDPRESS THEME THAT IMPLEMENTS PAGE BUILDER') ?></h2>
				<div class="infotext-title-small"><?php echo pmc_translation('quote_small','- learn how to build Wordpress Themes with ease with a premium Page Builder which allows you to add new Pages in seconds.') ?></div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
