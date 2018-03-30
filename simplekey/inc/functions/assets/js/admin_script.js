/* Admin javascript */
jQuery(document).ready(function(){
	
	//Show custom Page background option
	jQuery('.cmb2-id-page-custom-bgcolor-value,.cmb2-id-page-custom-fontcolor-value,.cmb2-id-page-custom-img-value,.cmb2-id-page-bg-repeat-value,.cmb2-id-page-bg-fixed-value,.cmb2-id-page-full-embed-value').hide();
	var page_custom=jQuery('select[name="page_custom_value"]');
	function custom_page_bg(){
	    if(page_custom.val()=='Yes'){
		   jQuery('.cmb2-id-page-custom-bgcolor-value,.cmb2-id-page-custom-fontcolor-value,.cmb2-id-page-custom-img-value,.cmb2-id-page-bg-repeat-value,.cmb2-id-page-bg-fixed-value,.cmb2-id-page-full-embed-value').show();
		}else{
		   jQuery('.cmb2-id-page-custom-bgcolor-value,.cmb2-id-page-custom-fontcolor-value,.cmb2-id-page-custom-img-value,.cmb2-id-page-bg-repeat-value,.cmb2-id-page-bg-fixed-value,.cmb2-id-page-full-embed-value').hide();
		}
	}custom_page_bg();
	
	page_custom.change(function(){
	    custom_page_bg();
	});
	
	//Show portfolio options
	jQuery('.cmb2-id-portfolio-video-value').add('.cmb2-id-portfolio-audio-value').add('#imagesliees').add('.cmb2-id-portfolio-col-value').hide();
	var portfolio_type=jQuery('select[name="portfolio_type_value"]');
	function portfolio_types(){
	    if(portfolio_type.val()=='Image'){
             jQuery('.cmb2-id-portfolio-video-value').add('.cmb2-id-portfolio-audio-value').hide();
             jQuery('#imagesliees').fadeIn();
		}else if(portfolio_type.val()=='Video'){
             jQuery('.cmb2-id-portfolio-video-value').show();
			 jQuery('.cmb2-id-portfolio-audio-value').hide();
			 jQuery('#imagesliees').hide();
		}else if(portfolio_type.val()=='Audio'){
		     jQuery('.cmb2-id-portfolio-audio-value').show();
			 jQuery('.cmb2-id-portfolio-video-value').hide();
			 jQuery('#imagesliees').hide();
		}
	}portfolio_types();
	
	portfolio_type.change(function(){
	    portfolio_types();
	});
	
	var portfolio_layout=jQuery('select[name="portfolio_layout_value"]');
	function portfolio_col(){
	    if(portfolio_layout.val()=='Slider'){
             jQuery('.cmb2-id-portfolio-col-value').hide();
		}else{
		     jQuery('.cmb2-id-portfolio-col-value').show();
		}
	}portfolio_col();
	
	portfolio_layout.change(function(){
	    portfolio_col();
	});
	
});