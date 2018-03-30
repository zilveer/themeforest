
jQuery(document).ready(function(){

   	//ddsmoothmenu for top-bar navigation
    ddsmoothmenu.init({
        mainmenuid: "top-nav-id", //menu DIV id
        orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
        classname: 'top-nav slideMenu', //class added to menu's outer DIV
        contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
    });

    //ddsmoothmenu for primary navigation
    ddsmoothmenu.init({
        mainmenuid: "primary-nav-id", //menu DIV id
        orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
        classname: 'primary-nav slideMenu', //class added to menu's outer DIV
        contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
    });
    
    
    
    // Primary Navigation for mobile.
    var primary_nav_mobile_button = jQuery('#primary-nav-mobile');
    var primary_nav_cloned;
    var primary_nav = jQuery('#primary-nav-id > ul');

    primary_nav.clone().attr('id','primary-nav-mobile-id').removeClass().appendTo( primary_nav_mobile_button );
    primary_nav_cloned = primary_nav_mobile_button.find('> ul');
        jQuery('#primary-nav-mobile-a').click(function(){
            if(jQuery(this).hasClass('primary-nav-close')){
                jQuery(this).removeClass('primary-nav-close').addClass('primary-nav-opened');
                primary_nav_cloned.slideDown( 400 );
            } else {
                jQuery(this).removeClass('primary-nav-opened').addClass('primary-nav-close');
                primary_nav_cloned.slideUp( 400 );
            }
            return false;
        });
        primary_nav_mobile_button.find('a').click(function(event){
            event.stopPropagation();
        });
    

    
    // load video thumbnail 
    jQuery('.video-thumb').each(function(){
        var obj = jQuery(this);
        var v = obj.attr('video');
        var vi = obj.attr('video-id');
        if(typeof(v)!='undefined' && v !=''&& typeof(vi)!='undefined' && vi !=''){
            if(v=='youtube'){
                obj.html('<img src="http://img.youtube.com/vi/'+vi+'/3.jpg" alt="" />');
            }else{
                 jQuery.getJSON('http://vimeo.com/api/v2/video/'+vi+'.json?callback=?',{format:"json"},function(data,status){
                    var small_thumb=  data[0].thumbnail_small;
                    obj.html('<img src="'+small_thumb+'" alt="" />');
                });
            }
        }
    });
    
    // Call the reservation and contact form
    ST_Reservation_Form();
    ST_Contact_Form();

    //Select Box
    jQuery('.select-box select').fadeTo(0, 0);
    jQuery('.select-box').each(function() {
        if(jQuery(this).find('option:selected').length) {
            jQuery(this).find('span').text(jQuery(this).find('option:selected').text());
        }
    });
    jQuery('.select-box select').change(function() {
        jQuery(this).parent().find('span').text(jQuery(this).find('option:selected').text());
    });

    // Call The Calendar Plugin
    ST_Add_Calendar('#reservation_arrival');
    ST_Add_Calendar('#reservation_departure');


    // Fitvideos
    jQuery(".page-wrapper").fitVids();

    // Thumbnail Hover
    jQuery(".thumb-wrapper").hover(function(){
        jQuery(this).find(".thumb-control-wrapper").animate({ opacity: 1 }, 500).addClass('parent-hover');
		
    }, function(){
        jQuery(this).find(".thumb-control-wrapper").animate({ opacity: 0 }, 500).removeClass('parent-hover');
		
    });

    // PrettyPhoto
    jQuery("a[rel^='prettyPhoto']").prettyPhoto({
        theme: 'light_square' /* light_rounded / dark_rounded / light_square / dark_square / facebook */
    });

    // Hash Change
    jQuery(window).bind("hashchange", function(event){
        var hashSplit = jQuery.param.fragment().split("-");
        var hashOptions = jQuery.deparam.fragment();

        if(typeof(hashOptions.filter)!="undefined")
        {

            jQuery(".cpt-filters a").removeClass("selected");
            if(jQuery(".cpt-filters a[href='#filter="+hashOptions.filter+"']").length)
                jQuery(".cpt-filters a[href='#filter="+hashOptions.filter+"']").addClass("selected");
            else
                jQuery(".cpt-filters li:first a").addClass("selected");
            jQuery(".cpt-items").isotope(hashOptions);
        }

    }).trigger("hashchange");

     //isotope
    jQuery(".cpt-items").imagesLoaded(run_isotope);

    // Flexslider
    
    FS.pauseOnHover = (FS.pauseOnHover == 'true')? true: false;
    FS.pauseOnAction = (FS.pauseOnAction == 'true')? true: false;
    FS.controlNav = (FS.controlNav == 'true')? true: false;
    FS.directionNav = (FS.directionNav == 'true')? true: false;
    FS.randomize = (FS.randomize == 'true')? true: false;

    jQuery('.flexslider').each(function(){
        jQuery(this).flexslider( FS );
    });
    
    
    // for twitter
    /*
        jQuery('.twitter-update ul').each(function(){
            var  id = jQuery(this).attr('id');
            if(id!='' && typeof(window['twitter_'+id])!='undefined'){
                jQuery("#"+id).tweet(window['twitter_'+id]);
            }
        });
        
     */
         
    //  for jquery.carouFredSel
       
         // for testimonials
        jQuery('.testimonials-wrap').each(function(){
            var  p = jQuery(this);
             var id = jQuery('.carou',p).attr('id');
             var w = p.width();
             jQuery('.test-w',p).width(w);
             if(typeof(id)!='undefined'){
                jQuery('#'+id).carouFredSel({
					width: 'auto',
                  //  width: w,
					height: 'auto',
					prev: '#prev-'+id,
					next: '#next-'+id,
					auto: false,
                    scroll: 1,
                   	align: 'left',
                    items: 1,
                   
				});
                
                jQuery(window).resize(function(){
                        var w = p.width();
                        jQuery('.test-w',p).width(w);
                });
                
             }   	
        });
			
    // end for jquery.carouFredSel 
     
    
      // call ajax calendar  
     ST_event_calendar();   
     
     
     
      // back to top
    jQuery(window).scroll(function() {
		if(jQuery(this).scrollTop() != 0) {
			jQuery('#sttotop').fadeIn();	
		} else {
			jQuery('#sttotop').fadeOut();
		}
	});
 
	jQuery('#sttotop').click(function() {
		jQuery('body,html').animate({scrollTop:0},800);
	});	
     

}); // END Document Ready //


// Page Load Event
jQuery(window).load(function(){
    jQuery('.thumb-control-wrapper').each(function(i,el){
         var new_overlay_w = jQuery(el).prev('img:first').width() - 20;
         var new_overlay_h = jQuery(el).prev('img:first').height() - 20;
         
         jQuery(el).css({'width':new_overlay_w,'height':new_overlay_h});
     });
});

// Browser Resize Event
jQuery(window).load(function(){
    jQuery(window).resize(function() {
        jQuery('.thumb-control-wrapper').each(function(i,el){
            
             var new_overlay_w = jQuery(el).prev('img:first').width() - 20;
             var new_overlay_h = jQuery(el).prev('img:first').height() - 20;
             
             jQuery(el).css({'width':new_overlay_w,'height':new_overlay_h});
         });
        
        //isotope
       // jQuery(".cpt-items").imagesLoaded(run_isotope);
        
    });
});

// Call isotope when all images are loaded
function run_isotope(){
    jQuery(".cpt-items").isotope();
}


// Reservation Form
function ST_Reservation_Form(){
    var error_report;
    jQuery('#reservation_form').submit(function(){
        var f= jQuery(this);
        
        jQuery("#reservation_form .notice_ok").hide();
        jQuery("#reservation_form .notice_error").hide();

        error_report = false;
        jQuery("input, textarea, radio, select",f).each(function(i){
            
            var form_element          = jQuery(this);
            var form_element_value    = jQuery(this).attr("value");
            var form_element_id       = jQuery(this).attr("id");
            var form_element_class    = jQuery(this).attr("class");
            var form_element_required = jQuery(this).hasClass("required");

            // Check email validation
            if(form_element_id == "reservation_email"){
                form_element.removeClass("error valid");
                if(!form_element_value.match(/^\w[\w|\.|\-]+@\w[\w|\.|\-]+\.[a-zA-Z]{2,4}$/)){
                    form_element.addClass("error");
                    error_report = true;
                } else {
                    form_element.addClass("valid");
                }
            }

            // Check input required validation
            if(form_element_required && form_element_id != "reservation_email"){
                form_element.removeClass("error valid");
                if(form_element_value == ""){
                    form_element.addClass("error");
                    error_report = true;
                } else {
                    form_element.addClass("valid");
                }
            }
        });
        
        if(error_report == false){
            jQuery(".loading",f).show();
            var string_data = "action=reservation_send&ajax=true&";
            string_data +=  f.serialize();

            jQuery.ajax({
                type: "POST",
                url: ajaxurl ,
                data: string_data,
                success: function(response){
                    jQuery(".loading",f).hide();
                    if(response == 'success'){
                        jQuery(".notice_ok",f).show();
                        jQuery(".field_submit",f).hide();
                    } else {
                        jQuery(".notice_error",f).show();
                        jQuery(".field_submit",f).show();
                    }
                }
            });
        }
         
        return false;
    });
}

// Contact Form
function ST_Contact_Form(){
    var error_report;
    jQuery("#contact_form").submit(function(){
        var f = jQuery(this);

        // Hide notice message when submit
        jQuery(".notice_ok",f).hide();
        jQuery(".notice_error",f).hide();
        error_report = false;

        jQuery("input, select, textarea", contact_form).each(function(i){

            var form_element          = jQuery(this);
            var form_element_value    = jQuery(this).attr("value");
            var form_element_id       = jQuery(this).attr("id");
            var form_element_class    = jQuery(this).attr("class");
            var form_element_required = jQuery(this).hasClass("required");

            // Check email validation
            if(form_element_id == "contact_email"){
                form_element.removeClass("error valid");
                if(!form_element_value.match(/^\w[\w|\.|\-]+@\w[\w|\.|\-]+\.[a-zA-Z]{2,4}$/)){
                    form_element.addClass("error");
                    error_report = true;
                } else {
                    form_element.addClass("valid");
                }
            }

            // Check input required validation
            if(form_element_required && form_element_id != "contact_email"){
                form_element.removeClass("error valid");
                if(form_element_value == ""){
                    form_element.addClass("error");
                    error_report = true;
                } else {
                    form_element.addClass("valid");
                }
            }

        });
        
        if(error_report == false){
            jQuery(".loading",f).show();

           jQuery(".loading",f).show();
            var string_data = "action=contact_send&ajax=true&";
            string_data +=  f.serialize();

            jQuery.ajax({
                type: "POST",
                url: ajaxurl,
                data: string_data,
                success: function(response){
                    jQuery(".loading",f).hide();
                    if(response == 'success'){
                        jQuery(".notice_ok",f).show();
                        jQuery(".field_submit",f).hide();
                    } else {
                        jQuery(".notice_error",f).show();
                        jQuery(".field_submit",f).show();
                    }
                }
            });
        }

    return false;
    });

}


// Add Calendar to ID
function ST_Add_Calendar(id){
    jQuery('<div class="calendar" />')
      .insertAfter( jQuery(id) )
      .datepicker({ 
        dateFormat: 'dd-mm-yy', 
        minDate: new Date(), 
        maxDate: '+1y', 
        altField: id, 
        firstDay: 1,
        showOtherMonths: true,
        dayNamesMin: ['S', 'M', 'T', 'W', 'T', 'F', 'S'],
        beforeShowDay: ST_Date_Available })
      .prev().hide();
}

// Date Available For Select
function ST_Date_Available(date){
    var dateAsString = date.getFullYear().toString() + "-" + (date.getMonth()+1).toString() + "-" + date.getDate();
    var result = jQuery.inArray( dateAsString ) ==-1 ? [true] : [false];
    return result
}


function ST_event_calendar(){
    
    jQuery('.st-events-calendar .header a').live('click',function(){
        var p = jQuery(this).parents('.st-events-calendar');
         var  q = jQuery(this).attr('data');
         
        
        jQuery(".loading",p).show();
        var string_data = "action=ajax_events_calendar&ajax=true&"+q;
      
        jQuery.ajax({
            type: "GET",
            url: ajaxurl,
            data: string_data,
            success: function(response){
                jQuery(".loading",p).hide();
                jQuery('.events-calendar-ajax',p).html(response);
            }
        });
        
        return false;
    });
      
}

