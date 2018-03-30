/*-----------------------------------------------------------------------------------*/
/*	Uploader used by Massive Panel
/*-----------------------------------------------------------------------------------*/

(function ($) {

  mpMLU = {
  
/*-----------------------------------------------------------------------------------*/
/* Remove file when the "remove" button is clicked.
/*-----------------------------------------------------------------------------------*/
  
    removeFile: function () {
     
     // single image remove
     $('.mlu_remove').live('click', function(event) { 
        $(this).hide();
        $(this).parents().parents().children('.upload').attr('value', '');
        $(this).parents('.screenshot').slideUp();
        $(this).parents('.screenshot').siblings('.of-background-properties').hide(); //remove background properties
        return false;
      });
      
      // multi image remove
      $('.mlu_remove_multi').live('click', function(event) { 
        $(this).hide();
        
        var value = $(this).parents().parents().children('.upload').attr('value');
        var remove = $(this).parents().find('img').attr("src");
      
        if($(this).parent().find('div').hasClass('no-preview-small'))
        	remove = $(this).parent().find('div.no-preview-small').text();
        
        var tmpArray = value.split(remove);
        value = tmpArray[0] + tmpArray[1]; 
        $(this).parents().parents().children('.upload').attr('value', value);
        $(this).parents('.multi-screenshot').slideUp();
        return false;
      });
      
      // Hide the delete button on the first row 
      $('a.delete-inline', "#option-1").hide();
      
    }, // End removeFile
    
/*-----------------------------------------------------------------------------------*/
/* Replace the default file upload field with a customised version.
/*-----------------------------------------------------------------------------------*/

    recreateFileField: function () {
    
      $('input.file').each(function(){
        var uploadbutton = '<input class="upload_file_button" type="button" value="Upload" />';
        $(this).wrap('<div class="file_wrap" />');
        $(this).addClass('file').css('opacity', 0); //set to invisible
        $(this).parent().append($('<div class="fake_file" />').append($('<input type="text" class="upload" />').attr('id',$(this).attr('id')+'_file')).val( $(this).val() ).append(uploadbutton));
 
        $(this).bind('change', function() {
          $('#'+$(this).attr('id')+'_file').val($(this).val());
        });
        $(this).bind('mouseout', function() {
          $('#'+$(this).attr('id')+'_file').val($(this).val());
        });
      });
      
    }, // End recreateFileField
    
    recreateMultiFileField: function () {
    
      $('textarea.displayall-upload').each(function(){
      	//alert($this.parent().attr('id'));
        var uploadbutton = '<input class="upload_file_button" type="button" value="Upload" />';
        $(this).wrap('<div class="file_wrap" />');
        $(this).addClass('file').css('opacity', 0); //set to invisible
        $(this).parent().append($('<div class="fake_file" />'));//.append($('<input type="text" class="upload" />').attr('id',$(this).attr('id')+'_file')).val( $(this).val() ).append(uploadbutton));
        
        var taText = $(this).val();
		var urlArray = taText.split('http');
		taText = '';
		$.each(urlArray, function (i, val) {
			
			urlArray[i] = "http" + val;
		  
		  	//if (urlArray[i].match(image)) {
           		 btnContent = '<div class="multi-screenshot"><div class="mp-image-frame"></div><img src="'+urlArray[i]+'" alt="" /><a href="#" class="mlu_remove_multi button">Remove Image</a><div>';
           // }
           
        	$(this).parent().append(btnContent)
      		$(this).siblings('.multi-screenshot').slideDown();

        }); 
        
        
        $(this).bind('change', function() {
          $('#'+$(this).attr('id')+'_file').val($(this).val());
        });
        $(this).bind('mouseout', function() {
          $('#'+$(this).attr('id')+'_file').val($(this).val());
        });
      });
      
    },

/*-----------------------------------------------------------------------------------*/
/* Use a custom function when working with the Media Uploads popup.
/* Requires jQuery, Media Upload and Thickbox JavaScripts.
/*-----------------------------------------------------------------------------------*/

	mediaUpload: function () {
	
	jQuery.noConflict();
	
	$( 'input.upload_button' ).removeAttr('style');
	var custom_uploader = 'false';
	var formfield,
		formID,
		btnContent = true,
		tbframe_interval;
	// On Click
	$('input.upload_button').live("click", function () {
        formfield = $(this).prev('input').attr('id');
        formID = $(this).attr('rel');
		
	//	alert("KURWA KIEDY TO SIE WYWOLUJE");
		//Change "insert into post" to "Use this Button"
		tbframe_interval = setInterval(function() {
			jQuery('#TB_iframeContent').contents().find('.savesend .button').val('Use This File');
		}, 2000);
        custom_uploader = 'true';
        // Display a custom title for each Thickbox popup.
        var woo_title = '';
        
		if($(this).parents('.section').find('.heading')) {
			woo_title = $(this).parents('.section').find('.heading').text(); 
		} 
        
		tb_show( woo_title, 'media-upload.php?post_id='+formID+'&TB_iframe=1' );
		return false;
	});
		window.original_send_to_editor = window.send_to_editor;
		window.send_to_editor = function(html) {
        
		if (formfield) {
			
			//clear interval for "Use this Button" so button text resets
			clearInterval(tbframe_interval);
        	
			// itemurl = $(html).attr('href'); // Use the URL to the main image.
          
          if ( $(html).html(html).find('img').length > 0 ) {
          
          	itemurl = $(html).html(html).find('img').attr('src'); // Use the URL to the size selected.
          		
          } else {
          
          // It's not an image. Get the URL to the file instead.
          	
		  var htmlBits = html.split("'"); // jQuery seems to strip out XHTML when assigning the string to an object. Use alternate method.
          itemurl = htmlBits[1]; // Use the URL to the file.
          	
          	var itemtitle = htmlBits[2];
          	
          	itemtitle = itemtitle.replace( '>', '' );
          	itemtitle = itemtitle.replace( '</a>', '' );
          
          } // End IF Statement
                   
          var image = /.jpg|.jpeg|.png|.gif|.ico/;
          var document = /(^.*\.pdf|doc|docx|ppt|pptx|odt*)/gi;
          var audio = /(^.*\.mp3|m4a|ogg|wav*)/gi;
          var video = /(^.*\.mp4|m4v|mov|wmv|avi|mpg|ogv|3gp|3g2*)/gi;
         // alert(itemurl.match(image));
          if(itemurl.match(image)) {
            btnContent = '<div class="mp-image-frame"></div><img src="'+itemurl+'" alt="" /><a href="#" class="mlu_remove button">Remove Image</a>';
          } else {
          	
          	btnContent = '<div class="mp-image-frame"></div><div class="no-preview"></div><a href="#" class="mlu_remove button">Remove Image</a>';      
          }
          
          $('#' + formfield).val(itemurl);
          // $('#' + formfield).next().next('div').slideDown().html(btnContent);
          $('#' + formfield).siblings('.screenshot').slideDown().html(btnContent);
		  $('#' + formfield).siblings('.of-background-properties').show(); //show background properties
          tb_remove();
          
        } else {
          window.original_send_to_editor(html);
        }
        
        // Clear the formfield value so the other media library popups can work as they are meant to. - 2010-11-11.
        formfield = '';
      }
      
    }, // End mediaUpload
    
    /*-----------------------------------------------------------------------------------*/
	/*	Multi Media Upload
	/*-----------------------------------------------------------------------------------*/
	
    multiMediaUpload: function () {
	
	jQuery.noConflict();
	
	$( 'input.multi_upload_button' ).removeAttr('style');
	
	var formfield,
		formID,
		btnContent = true,
		tbframe_interval;
	
	// On Click multi upload
	$('input.multi_upload_button').live("click", function () {
        formfield = $(this).prev('textarea').attr('id');
        formID = $(this).attr('rel');
		
		//Change "insert into post" to "Use this Button"
		tbframe_interval = setInterval(function() {
			jQuery('#TB_iframeContent').contents().find('.savesend .button').val('Use This File');
		}, 2000);
        
        // Display a custom title for each Thickbox popup.
        var woo_title = '';
        
		if($(this).parents('.section').find('.heading')) { 
			woo_title = $(this).parents('.section').find('.heading').text(); 
		} 
        
		tb_show( woo_title, 'media-upload.php?post_id='+formID+'&TB_iframe=1' );
		return false;
	});
	
    
	window.original_send_to_editor = window.send_to_editor;
	window.send_to_editor = function(html) {
	
		if (formfield) {
			
			//clear interval for "Use this Button" so button text resets
			clearInterval(tbframe_interval);
        	
			// itemurl = $(html).attr('href'); // Use the URL to the main image.
          
          if ( $(html).html(html).find('img').length > 0 ) {
          
          	itemurl = $(html).html(html).find('img').attr('src'); // Use the URL to the size selected.
          	
          	
          } else {
          
          // It's not an image. Get the URL to the file instead.
          	
		  var htmlBits = html.split("'"); // jQuery seems to strip out XHTML when assigning the string to an object. Use alternate method.
          itemurl = htmlBits[1]; // Use the URL to the file.
          	
          	var itemtitle = htmlBits[2];
          	
          	itemtitle = itemtitle.replace( '>', '' );
          	itemtitle = itemtitle.replace( '</a>', '' );
          
          } // End IF Statement
                   
         var image = /.jpg|.jpeg|.png|.gif|.ico/;
          var document = /(^.*\.pdf|doc|docx|ppt|pptx|odt*)/gi;
          var audio = /(^.*\.mp3|m4a|ogg|wav*)/gi;
          var video = /(^.*\.mp4|m4v|mov|wmv|avi|mpg|ogv|3gp|3g2*)/gi;
       
		  itemurl = $('#' + formfield).val() + itemurl;
          $('#' + formfield).val(itemurl);
          var urlArray = itemurl.split('http');
				
		  $.each(urlArray,function (i, val) {
			 urlArray[i] = "http" + val;
		  	
		 	 if(i == 1){
		  			if (urlArray[i].match(image)) 
           				btnContent = '<div class="multi-screenshot firstshot"><div class="mp-image-frame"></div><img src="'+urlArray[i]+'" alt="" /><a href="#" class="mlu_remove_multi button">Remove Image</a><div>';
           			else
           				btnContent = '<div class="multi-screenshot firstshot"><div class="mp-image-frame"></div></div><div class="no-preview-small"></div><a href="#" class="mlu_remove_multi button">Remove Image</a><div>';
        	  } else if(i == 6 || i == 11 || i == 16) {
         	 		if (urlArray[i].match(image)) 
           				btnContent = '<div class="multi-screenshot columnshot-first"><div class="mp-image-frame"></div><img src="'+urlArray[i]+'" alt="" /><a href="#" class="mlu_remove_multi button">Remove Image</a><div>';
           			else
           				btnContent = '<div class="multi-screenshot columnshot-first"><div class="mp-image-frame"></div></div><div class="no-preview-small"></div><a href="#" class="mlu_remove_multi button">Remove Image</a><div>';
        	  } else if(i > 6){
          			if (urlArray[i].match(image)) 
           			 	btnContent = '<div class="multi-screenshot columnshot"><div class="mp-image-frame"></div></div><img src="'+urlArray[i]+'" alt="" /><a href="#" class="mlu_remove_multi button">Remove Image</a><div>';
           			 else
           			 	btnContent = '<div class="multi-screenshot columnshot"><div class="mp-image-frame"></div><div class="no-preview-small"></div><a href="#" class="mlu_remove_multi button">Remove Image</a><div>';
      	    } else {
          			if (urlArray[i].match(image)) 
           			 	btnContent = '<div class="multi-screenshot"><div class="mp-image-frame"></div><img src="'+urlArray[i]+'" alt="" /><a href="#" class="mlu_remove_multi button">Remove Image</a><div>';
           			 else 
           			 	btnContent = '<div class="multi-screenshot"><div class="mp-image-frame"></div></div><div class="no-preview-small"></div><a href="#" class="mlu_remove_multi button">Remove Image</a><div>';	
       		   }            
          
          }); 
          
          $('#' + formfield).parent().append(btnContent)
          $('#' + formfield).siblings('.multi-screenshot').slideDown();
		  $('#' + formfield).siblings('.of-background-properties').show(); //show background properties
          tb_remove();
          
        } else {
          
          window.original_send_to_editor(html);
        }
        
        // Clear the formfield value so the other media library popups can work as they are meant to. - 2010-11-11.
        formfield = '';
      }
      
    } // End multiMediaUpload

   
  }; // End mpMLU Object // Don't remove this, or the sky will fall on your head.

/*-----------------------------------------------------------------------------------*/
/* Execute the above methods in the mpMLU object.
/*-----------------------------------------------------------------------------------*/
  
	$(document).ready(function () {

		mpMLU.removeFile();
		mpMLU.recreateFileField();
		mpMLU.mediaUpload();
		mpMLU.multiMediaUpload();
	
	});
  
})(jQuery);