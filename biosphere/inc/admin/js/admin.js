function ddHideShowOptions(){

	var currTemplate, blogLayout, galleryLayout, layout, postsPerPage, postWidth;

	currTemplate = jQuery('#page_template').val();
	layout = jQuery('#dd_biosphere_layout').closest('.format-settings');
	layoutVal = jQuery('#dd_biosphere_layout').val();
	postsPerPage = jQuery('#dd_biosphere_posts_per_page').closest('.format-settings');
	postWidth = jQuery('#dd_biosphere_post_width').closest('.format-settings');


	layout.hide();
	postsPerPage.hide();
	postWidth.hide();

	if ( currTemplate == 'template-blog.php' || currTemplate == 'template-dd_staff.php' || currTemplate == 'template-dd_gallery.php' || currTemplate == 'template-dd_events.php' || currTemplate == 'template-dd_causes.php' || currTemplate == 'template-dd_sponsors.php' ) {
		
		layout.show();
		postsPerPage.show();

		if ( layoutVal == 'fc' )
			postWidth.show();

	} else if ( currTemplate == undefined || currTemplate == 'default' ) { 

		layout.show();

	}

}

function ddHideShowSliderOptions(){

	var _this, titleSec, typeSec, imageSec, descriptionSec, linkSec, typeVal;
	var slider = jQuery('#section_dd_slider');

	jQuery('.list-list-item, .list-sub-setting', jQuery('div[id*=slider]')).each(function(){

		_this = jQuery(this);
		typeSec = jQuery('*[id*="slider_type"]', _this).closest('.format-settings');
		titleSec = jQuery('*[id*="slider_title"]', _this).closest('.format-settings');
		imageSec = jQuery('*[id*="slider_image"]', _this).closest('.format-settings');
		descriptionSec = jQuery('*[id*="slider_description"]', _this).closest('.format-settings');
		linkSec = jQuery('*[id*="slider_link"]', _this).closest('.format-settings');
		
		eventSec = jQuery('*[id*="slider_event"]', _this).closest('.format-settings');
		blogSec = jQuery('*[id*="slider_blog_post"]', _this).closest('.format-settings');
		causeSec = jQuery('*[id*="slider_cause"]', _this).closest('.format-settings');

		typeVal = jQuery('*[id*="slider_type"]', typeSec).val();

		jQuery('.format-settings', _this).hide();
		titleSec.show();
		typeSec.show();

		if ( 'custom' == typeVal ) {

			imageSec.show();
			descriptionSec.show();
			linkSec.show();

		} else if ( 'blog' == typeVal ) {

			blogSec.show();

		} else if ( 'event' == typeVal ) { 

			eventSec.show();

		} else if ( 'cause' == typeVal ) {

			causeSec.show();

		}

	});

}

function ddHideShowSliderTypeOptions() {

	var sliderType = jQuery('.format-settings#setting_dd_biosphere_slider_regrev');
	var sliderTypeVal = sliderType.find('select').val();
	var sliderRev = jQuery('.format-settings#setting_dd_biosphere_slider_revolution');
	var sliderSlides = jQuery('.format-settings#setting_dd_biosphere_slider');
	var sliderHeight = jQuery('.format-settings#setting_dd_biosphere_slider_height');
	var sliderAnimation = jQuery('.format-settings#setting_dd_biosphere_slider_animation');
	var sliderAutoplay = jQuery('.format-settings#setting_dd_biosphere_slider_autoplay');
	var sliderLoop = jQuery('.format-settings#setting_dd_biosphere_slider_loop');

	sliderRev.hide();
	sliderSlides.hide();
	sliderHeight.hide();
	sliderAnimation.hide();
	sliderAutoplay.hide();
	sliderLoop.hide();

	if ( sliderTypeVal == 'regular' ) {

		sliderSlides.show();
		sliderHeight.show();
		sliderAnimation.show();
		sliderAutoplay.show();
		sliderLoop.show();

	} else if ( sliderTypeVal == 'revolution' ) {

		sliderRev.show();

	}

}

jQuery(document).ready(function($){

	ddHideShowSliderTypeOptions();
	ddHideShowOptions();

	jQuery('#page_template, #dd_biosphere_layout').change(function(){
		ddHideShowOptions();
	});

	jQuery('.format-settings#setting_dd_biosphere_slider_regrev select').change(function(){
		ddHideShowSliderTypeOptions();
	});

	/* Theme Options - Slider */

	ddHideShowSliderOptions();

	jQuery(document).on('change', 'select[id*="slider_type"]', function(e){

		ddHideShowSliderOptions();

	});

	jQuery(document).ajaxComplete(function() {

		if ( jQuery('body').hasClass('appearance_page_ot-theme-options') ) {
			ddHideShowSliderOptions();
		}

	});

	jQuery('#dd_biosphere_cause_amount_current, #dd_biosphere_cause_amount_needed').keyup(function(){

		jQuery(this).val(jQuery(this).val().replace(/\D/g,''));

	});

});