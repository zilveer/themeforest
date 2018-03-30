jQuery(document).ready(function() {

	function hideAllMetaBox() {
		jQuery('#om-page-meta-box-sidebar, #om-page-meta-box-portfolio, #om-page-meta-box-homepage').hide();
	}
	hideAllMetaBox();
	
	jQuery('#page_template').change(function(){
		hideAllMetaBox();
		var val=jQuery(this).val();
		if(val != 'template-sitemap.php' && val != 'template-portfolio.php' && val != 'template-portfolio-m.php' && val != 'template-home.php' && val != 'template-full-width.php')
			jQuery('#om-page-meta-box-sidebar').show();
		if(val == 'template-portfolio.php' || val == 'template-portfolio-m.php')
			jQuery('#om-page-meta-box-portfolio').show();
		if(val == 'template-home.php')
			jQuery('#om-page-meta-box-homepage').show();

	}).change();
	
});