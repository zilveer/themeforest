function ddHideShowOptions(){

	var currTemplate, blogLayout, galleryLayout, layout, postsPerPage;

	currTemplate = jQuery('#page_template').val();
	blogLayout = jQuery('#dd_waveblog_layout').closest('.format-settings');
	galleryLayout = jQuery('#dd_wavegallery_layout').closest('.format-settings');
	layout = jQuery('#dd_wavelayout').closest('.format-settings');
	postsPerPage = jQuery('#dd_waveposts_per_page').closest('.format-settings');

	layout.hide();
	blogLayout.hide();
	galleryLayout.hide();
	postsPerPage.hide();

	if ( currTemplate == 'template-blog.php' ) {
		blogLayout.show();
		postsPerPage.show();
	} else if ( currTemplate == 'template-dd_gallery.php' ) {
		galleryLayout.show();
		postsPerPage.show();
	} else {
		layout.show();
	}

}

jQuery(document).ready(function($){

	ddHideShowOptions();

	jQuery('#page_template').change(function(){
		ddHideShowOptions();
	});

});