var $j = jQuery.noConflict();


/* ------PARALAX PART START------- */

function setIdOnAddParallax(addButton,parallax_num){
	
	addButton.siblings('.parallax:last').find('input[type="text"]').each(function(){
		var name = $j(this).attr('name');
		var new_name= name.replace("_x", "[]");
		var new_id = name.replace("_x", "_"+parallax_num);
		$j(this).attr('name',new_name);
		$j(this).attr('id',new_id);
		$j(this).siblings('label').attr('for',new_id);
		
	});
	addButton.siblings('.parallax:last').find('textarea').each(function(){
		var name = $j(this).attr('name');
		var new_name= name.replace("_x", "[]");
		var new_id = name.replace("_x", "_"+parallax_num);
		$j(this).attr('name',new_name);
		$j(this).attr('id',new_id);
		$j(this).siblings('label').attr('for',new_id);
		
	});
	
	addButton.siblings('.parallax:last').find('.add_media').each(function(){
		var data_editor = $j(this).attr('data-editor');
		var new_data = data_editor.replace("_x", "_"+parallax_num);
		$j(this).attr('data-editor',new_data);
	});
	
}

function setIdOnRemoveParallax(parallax,parallax_num){
	
	if(parallax_num == undefined){
		var parallax_num = parallax.attr('rel');
	}else{
		var parallax_num = parallax_num;
	}
	
	parallax.find('input[type="text"]').each(function(){
		var name = $j(this).attr('name').split('[')[0];
		var new_name = name+"[]";
		var new_id = name+"_"+parallax_num;
		$j(this).attr('name',new_name);
		$j(this).attr('id',new_id);
		$j(this).siblings('label').attr('for',new_id);
		
	});
	parallax.find('textarea').each(function(){
		var name = $j(this).attr('name').split('[')[0];
		var new_name = name+"[]";
		var new_id = name+"_"+parallax_num;
		$j(this).attr('name',new_name);
		$j(this).attr('id',new_id);
		$j(this).siblings('label').attr('for',new_id);
	});
}

/* ------PARALAX PART END------- */

/* ------PORTFOLIO PART START------- */

function setIdOnAddPortfolio(addButton,portfolio_num){
	
	addButton.siblings('.portfolio:last,.portfolio_image:last').find('input[type="text"], select').each(function(){
		var name = $j(this).attr('name');
		var new_name= name.replace("_x", "[]");
		var new_id = name.replace("_x", "_"+portfolio_num);
		$j(this).attr('name',new_name);
		$j(this).attr('id',new_id);
		$j(this).siblings('label').attr('for',new_id);
		
	});
	
	addButton.siblings('.portfolio:last').find('textarea').each(function(){
		var name = $j(this).attr('name');
		var new_name= name.replace("_x", "[]");
		var new_id = name.replace("_x", "_"+portfolio_num);
		$j(this).attr('name',new_name);
		$j(this).attr('id',new_id);
		$j(this).siblings('label').attr('for',new_id);
		
	});
}

function setIdOnRemovePortfolio(portfolio,portfolio_num){
	
	if(portfolio_num == undefined){
		var portfolio_num = portfolio.attr('rel');
	}else{
		var portfolio_num = portfolio_num;
	}
	
	portfolio.find('input[type="text"], select').each(function(){
		var name = $j(this).attr('name').split('[')[0];
		var new_name = name+"[]";
		var new_id = name+"_"+portfolio_num;
		$j(this).attr('name',new_name);
		$j(this).attr('id',new_id);
		$j(this).siblings('label').attr('for',new_id);
		
	});
	
	portfolio.find('textarea').each(function(){
		var name = $j(this).attr('name').split('[')[0];
		var new_name = name+"[]";
		var new_id = name+"_"+portfolio_num;
		$j(this).attr('name',new_name);
		$j(this).attr('id',new_id);
		$j(this).siblings('label').attr('for',new_id);
	});

}

/* ------PORTFOLIO PART END------- */

function colorPicker(){
	$j('.colorSelector').each(function(){
		var Othis = this; //cache a copy of the this variable for use inside nested function
		var initialColor = $j(Othis).next('input').attr('value');
		$j(this).ColorPicker({
			color: initialColor,
			onShow: function (colpkr) {
				$j(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$j(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$j(Othis).children('div').css('backgroundColor', '#' + hex);
				$j(Othis).next('input').attr('value','#' + hex);
			}
		});
	});
}

$j(document).ready(function() {
	
	//Qode options accordion
	
	
	$j('.sections').accordion({
		collapsible: true,
		active: 0
	});
	$j('.sections > div').css('height','auto');
	
	
	var formfield;
	$j(document).on('click', '.slide_image,.parallax_image,.portfolioimg,.logo_image,.favicon_image,.background_image,.pattern_background_image,.title_image,.google_maps_pin_image,.facebook_icon,.twitter_icon,.google_plus_icon', function(event) {
			event.preventDefault();
	    formfield = $j(this).attr('id');

	    tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
			
			
			if(formfield != undefined){
				// used for all of the above to insert the uploaded image url into the proper text field
				window.send_to_editor = function(html) {
					imgurl = $j('img',html).attr('src');
					$j('#'+ formfield).val(imgurl);
					tb_remove();
				}
			} 
	});
	
	$j(document).on('click', '.upload_button', function(event) {
		$j(this).siblings('input').click();
	});
	
	
	/* ------PARALAX PART START------- */
	
	$j(".parallax").each(function(){
		$j(this).accordion({
			collapsible: true,
			active: false
    });

	});
	$j('.parallax_inner').css('height','auto');
	
	var remove_parallax_button = '<a class="remove_parallax" onclick="javascript: return false;" href="/" >Remove parallax section</a>';
	var default_parallax = $j('.hidden_parallax').clone().html();
	
	/* Add parallax section */
	$j(document).on('click', 'a.add_parallax', function(event) {
		$parallax = '<div class="parallax" rel=""><h3>Parallax section</h3><div class="parallax_inner">'+ default_parallax + remove_parallax_button +'</div></div>';
		$j(this).before($j($parallax).hide().fadeIn(500));
		
		//add new rel number for new parallax section and set new id/name according to this number
		var parallax_num = $j(this).siblings('.parallax').length;
		$j(this).siblings('.parallax:last').attr('rel',parallax_num);
		setIdOnAddParallax($j(this),parallax_num);
		
		$j(this).siblings('.parallax:last').accordion({
			collapsible: true,
			active: 0
		});
		
		setUniqueImageOnAdd($j(this),parallax_num);
		colorPicker();
	});
	
	/* Remove parallax section */
	$j(document).on('click', 'a.remove_parallax', function(event) {
		
		$j(this).closest('.parallax').fadeOut(500,function(){
			$j(this).remove();
			
			//after removing parallax section, set new rel numbers and set new ids/names
			$j('.parallax').each(function(i){	
				$j(this).attr('rel',i+1);
				setIdOnRemoveParallax($j(this),i+1);
			});
		});
	});

	/* ------PARALAX PART END------- */
	
	/* ------PORTFOLIO PART START------- */

	$j(".add_portfolio_images").each(function(){
    $j(this).accordion({
			collapsible: true,
			active: false
    });
	});
	$j('.add_portfolio_images_inner').css('height','auto');
	
	var remove_portfolio_button = '<a class="remove_option" onclick="javascript: return false;" href="/" >Remove portfolio option</a>';
	var default_portfolio = $j('.hidden_portfolio').clone().html();
	
	/* Add portfolio option */
	$j(document).on('click', 'a.add_option', function(event) {
		$portfolio = '<div class="portfolio" rel="">'+ default_portfolio + remove_portfolio_button +'</div>';
		$j(this).before($j($portfolio).hide().fadeIn(500));
		
		//add new rel number for new portfolio option and set new id/name according to this number
		var portfolio_num = $j(this).siblings('.portfolio').length;
		$j(this).siblings('.portfolio:last').attr('rel',portfolio_num);
		setIdOnAddPortfolio($j(this),portfolio_num);
		
	});
	
	/* Remove portfolio option */
	$j(document).on('click', 'a.remove_option', function(event) {
		
		$j(this).closest('.portfolio').fadeOut(500,function(){
			$j(this).remove();
			
			//after removing portfolio option, set new rel numbers and set new ids/names
			$j('.portfolio').each(function(i){	
				$j(this).attr('rel',i+1);
				setIdOnRemovePortfolio($j(this),i+1);
			});
		});
	});
	
	$j(".add_portfolios").each(function(){
    $j(this).accordion({
			collapsible: true,
			active: false
    });
		
	});
	$j('.add_portfolios_inner').css('height','auto');
	
	var remove_portfolio_image_button = '<a class="remove_image" onclick="javascript: return false;" href="/" >Remove portfolio image</a>';
	var default_portfolio_image = $j('.hidden_portfolio_images').clone().html();
	
	/* Add portfolio image */
	$j(document).on('click', 'a.add_image', function(event) {
		$portfolio_image = '<div class="portfolio_image" rel="">'+ default_portfolio_image + remove_portfolio_image_button +'</div>';
		$j(this).before($j($portfolio_image).hide().fadeIn(500));
		
		//add new rel number for new portfolio image and set new id/name according to this number
		var portfolio_num = $j(this).siblings('.portfolio_image').length;
		$j(this).siblings('.portfolio_image:last').attr('rel',portfolio_num);
		setIdOnAddPortfolio($j(this),portfolio_num);
		
	});
	
	/* Remove portfolio image */
	$j(document).on('click', 'a.remove_image', function(event) {
		
		$j(this).closest('.portfolio_image').fadeOut(500,function(){
			$j(this).remove();
			
			//after removing portfolio image, set new rel numbers and set new ids/names
			$j('.portfolio_image').each(function(i){	
				$j(this).attr('rel',i+1);
				setIdOnRemovePortfolio($j(this),i+1);
			});
		});
	});

	/* ------PORTFOLIO PART END------- */
	
	
	colorPicker();
	
  $j( ".datepicker" ).datepicker( { dateFormat: "MM dd, yy" });

});
