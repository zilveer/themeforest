/**
 * All Types Meta Box Class JS
 *
 * JS used for the custom metaboxes and other form items.
 *
 * Copyright 2011 - 2013 Ohad Raz (admin@bainternet.info)
 * @since 1.0
 */

var $ =jQuery.noConflict();

var e_d_count = 0;
var Ed_array = Array;

jQuery(document).ready(function($) {


  /* Display options on select */

  if($("select[name='vsc_port_header'] option:selected").val() == 'parallax-title') {
    $("#vsc_parallax_bg").show();
  }

    $('select[name="vsc_port_header"]').on("change", function(event){
      var str = '';
      str = $("select[name='vsc_port_header'] option:selected").val();

     if(str == 'parallax-title')
         $("#vsc_parallax_bg").fadeIn();
      else
          $("#vsc_parallax_bg").hide();
       
    });  

   /* link to custom link */
  if($("select[name='vsc_port_box'] option:selected").val() == 'link_to_link') {
    $("#vsc_port_link").show();
  }

    $('select[name="vsc_port_box"]').on("change", function(event){
      var str = '';
      str = $("select[name='vsc_port_box'] option:selected").val();

     if(str == 'link_to_link')
         $("#vsc_port_link").fadeIn();
      else
          $("#vsc_port_link").hide();
       
    }); 

    /* link to image gallery lightbox */
	
  if($("select[name='vsc_port_box'] option:selected").val() == 'lightbox_to_gallery') {
    $("#vsc_port_gallery").show();
  }
  

    $('select[name="vsc_port_box"]').on("change", function(event){
      var str = '';
      str = $("select[name='vsc_port_box'] option:selected").val();
	

     if(str == 'lightbox_to_gallery')
         $("#vsc_port_gallery").fadeIn();
      else
          $("#vsc_port_gallery").hide();
       
    });   
	

    /* link to video in lightbox */
  if($("select[name='vsc_port_box'] option:selected").val() == 'lightbox_to_video') {
    $("#vsc_port_video").show();
  }

    $('select[name="vsc_port_box"]').on("change", function(event){
      var str = '';
      str = $("select[name='vsc_port_box'] option:selected").val();

     if(str == 'lightbox_to_video')
         $("#vsc_port_video").fadeIn();
      else
          $("#vsc_port_video").fadeOut();
       
    });      


  if($("#vsc_portfolio_navigation input[value='no-filter']:checked").val() == 'no-filter') {
    $("#vsc_nav_number").show();
  }  

    $('input[name="vsc_portfolio_navigation"]').on("change", function(event){
      var str = '';
      str = $("#vsc_portfolio_navigation input[value='no-filter']:checked").val();

     if(str == 'no-filter')
         $("#vsc_nav_number").fadeIn();
      else
          $("#vsc_nav_number").fadeOut();
       
    });         


	/* subheader style select */
	jQuery.fn.extend({
	    ShowStyles: function () {
			  
			$this = jQuery(this);
			var theSelectedStyle  = $this.attr("value");



			var subheader_styles = {};
			subheader_styles['no-style'] = "";
			subheader_styles['style-1'] = "#vsc_bg_type, #vsc_subheader_img, #vsc_subheader_color";
			subheader_styles['style-2'] = "#vsc_bg_type, #vsc_subheader_img, #vsc_subheader_color";
			subheader_styles['style-3'] = "#vsc_bg_type, #vsc_subheader_img, #vsc_subheader_color";
	
				for (var key in subheader_styles) {
					jQuery(subheader_styles[key]).css({"display":"none"});
				}
	
			jQuery(subheader_styles[theSelectedStyle]).css({"display":"block"});
			
	    }
	});

	jQuery(".subheader-select option:selected").ShowStyles();
	
	jQuery(".subheader-select").on("change", function(event){
		jQuery(".subheader-select option:selected").ShowStyles();
	});	
			

	/* hide sidebar options */
	var a;
	a = jQuery('#page_template option:selected').val();	
	if ((a == ('template-portfolio.php')) || (a == ('template-gallery.php')) || (a == ('template-homepage.php')) || (a == ('template-onepage.php')) ) {
		jQuery('#page_sidebars').hide();
	}
	else if (a == ('template-blog.php')) {
		jQuery('#page_sidebars #vsc_sidebar_position').hide();
	}

	jQuery("#selected_posts").asmSelect({
		addItemTarget: 'bottom',
		animate: true,
		highlight: true,
		selectClass: 'asm-select-field',
		sortable: false,
		removeLabel: 'remove',

	}).after($("<a href='#'>Select All</a>").click(function() {
		jQuery("#selected_posts").children().attr("selected", "selected").end().change();
		return false;
	})); 


	/* metaboxes toggle if a post format is chosen */
	jQuery.fn.extend({
	    ShowPostFormats: function () {
			  
			$this = jQuery(this);
			var theSelectedFormat  = $this.attr("id");


			//post formats / option pairs
			var post_formats = {};
			post_formats['post-format-0'] = "#vsc_standard_post_custom_fields";
			post_formats['post-format-gallery'] = "#vsc_gallery_post_custom_fields";
			post_formats['post-format-link'] = "#vsc_link_post_custom_fields";
			post_formats['post-format-quote'] = "#vsc_quote_post_custom_fields";
			post_formats['post-format-audio'] = "#vsc_audio_post_custom_fields";
			post_formats['post-format-video'] = "#vsc_video_post_custom_fields";

	
				for (var key in post_formats) {
					jQuery(post_formats[key]).css({"display":"none"});
				}
	
			jQuery(post_formats[theSelectedFormat]).css({"display":"block"});
	
	 
	    }
	});

	jQuery("#post-formats-select input:checked").ShowPostFormats();
	
		jQuery("#post-formats-select").on("change", function(event){
			jQuery("#post-formats-select input:checked").ShowPostFormats();
		});



	/* metaboxes toggle if a page template is chosen */
	jQuery.fn.extend({
	    ShowPageFields: function () {
			  
			$this = jQuery(this);
			var theSelectedTemplate  = $this.attr("value");


			//page templates
			var page_templates = {};
			page_templates['template-blog.php'] = "#vsc_blog_options";
			page_templates['template-portfolio.php'] = "#vsc_portfolio_options";
			page_templates['template-contact.php'] = "#vsc_contact_options";
			page_templates['template-onepage.php'] = "#vsc_onepage_options";
	
				for (var key in page_templates) {
					jQuery(page_templates[key]).css({"display":"none"});
				}
	
			jQuery(page_templates[theSelectedTemplate]).css({"display":"block"});
			
	    }
	});

	jQuery("#page_template option:selected").ShowPageFields();
	
	jQuery("#page_template").on("change", function(event){
		jQuery("#page_template option:selected").ShowPageFields();
	});	
		
 
	/* portfolio item hook  */
  jQuery('#port_media .repeater-table').each(function(){
	if ( jQuery(this).find('.at-textarea').val() == '' ) {
		jQuery(this).find('.popuptextarea-field').hide();
	}
	else {
		jQuery(this).find('.popuptextarea-field').show();
		jQuery(this).find('.image-field').hide();
	}
  });
  
	/* Masked Inputs (images as radio buttons) */
	jQuery('.of-radio-img').click(function(){
		jQuery(this).parent().parent().find('.of-radio-img').removeClass('radio-img-selected');
		jQuery(this).addClass('radio-img-selected');
	});
	jQuery('.vsc-radio-label').hide();
	jQuery('.of-radio-img').show();
	jQuery('.img-radio').hide();  
	
	jQuery('.icon-font-img').click(function(){
		jQuery(this).parent().parent().find('.icon-font-img').removeClass('icon-selected');
		jQuery(this).addClass('icon-selected');
	});
	jQuery('.icon-font-img').show();  	
  
  
  /* editor rezise fix */
  $(window).resize(function() {
    $.each(Ed_array, function() {
      var ee = this;
      $(ee.getScrollerElement()).width(100); // set this low enough
      width = $(ee.getScrollerElement()).parent().width();
      $(ee.getScrollerElement()).width(width); // set it to
      ee.refresh();
    });
  });
});
function update_repeater_fields(){
    _metabox_fields.init();
}
/* metabox fields object */
var _metabox_fields = {
  oncefancySelect: false,
  init: function(){
    if (!this.oncefancySelect){
      this.fancySelect();
      this.oncefancySelect = true;
    }
    this.load_code_editor();
    this.load_conditinal();
    this.load_time_picker();
    this.load_date_picker();
    this.load_color_picker();

    /* repater Field */




    $('.repeater-sortable').sortable({
      opacity: 0.6,
      revert: true,
      cursor: 'move',
      handle: '.at_re_sort_handle',
      placeholder: 'at_re_sort_highlight'
    });

  },
  fancySelect: function(){
    if ($().select2){
      $(".at-select, .at-posts-select, .at-tax-select").each(function (){
        if(! $(this).hasClass('no-fancy'))
          $(this).select2();
      });
    }  
  },
  get_query_var: function(name){
    var match = RegExp('[?&]' + name + '=([^&#]*)').exec(location.href);
    return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
  },
  load_code_editor: function(){
    $(".code_text").each(function() {
      var lang = $(this).attr("data-lang");




      switch(lang){
        case 'php':
          lang = 'application/x-httpd-php';
          break;
        case 'css':
          lang = 'text/css';
          break;
        case 'html':
          lang = 'text/html';
          break;
        case 'javascript':
          lang = 'text/javascript';
          break;
        default:
          lang = 'application/x-httpd-php';
      }
      var theme  = $(this).attr("data-theme");
      switch(theme){
        case 'default':
          theme = 'default';
          break;
        case 'light':
          theme = 'solarizedLight';
          break;
        case 'dark':
          theme = 'solarizedDark';;
          break;
        default:
          theme = 'default';
      }
      
      var editor = CodeMirror.fromTextArea(document.getElementById($(this).attr('id')), {
        lineNumbers: true,
        matchBrackets: true,
        mode: lang,
        indentUnit: 4,
        indentWithTabs: true,
        enterMode: "keep",
        tabMode: "shift"
      });
      editor.setOption("theme", theme);
      $(editor.getScrollerElement()).width(100); // set this low enough
      width = $(editor.getScrollerElement()).parent().width();
      $(editor.getScrollerElement()).width(width); // set it to
      editor.refresh();
      Ed_array[e_d_count] = editor;
      e_d_count++;
    });
  },
  load_conditinal: function(){
    $(".conditinal_control").click(function(){
      if($(this).is(':checked')){
        $(this).next().show('fast');    
      }else{
        $(this).next().hide('fast');    
      }
    });
  },
  load_time_picker: function(){  
    $('.at-time').each( function() {
      
      var $this   = $(this),
            format   = $this.attr('rel'),
            aampm    = $this.attr('data-ampm');
        if ('true' == aampm)
          aampm = true;
        else
          aampm = false;

        $this.timepicker( { showSecond: true, timeFormat: format, ampm: aampm } );
      
    });
  },
  load_date_picker: function() {
    $('.at-date').each( function() {
      
      var $this  = $(this),
          format = $this.attr('rel');

      $this.datepicker( { showButtonPanel: true, dateFormat: format } );
      
    });
  },
  load_color_picker: function(){
    if ($('.at-color-iris').length>0)
      $('.at-color-iris').wpColorPicker(); 
  },
};
/* call object init in delay */
window.setTimeout('_metabox_fields.init();',2000);

/* upload fields handler */
var simplePanelmedia;
jQuery(document).ready(function($){
  var simplePanelupload =(function(){
    var inited;
    var file_id;
    var file_url;
    var file_type;
    function init (){
      return {
        image_frame: new Array(),
        file_frame: new Array(),
        hooks:function(){
          $(document).on('click','.simplePanelimageUpload,.simplePanelfileUpload', function( event ){
            event.preventDefault();
            if ($(this).hasClass('simplePanelfileUpload'))
              inited.upload($(this),'file');
            else
              inited.upload($(this),'image');
          });

          $('.simplePanelimageUploadclear,.simplePanelfileUploadclear').live('click', function( event ){
            event.preventDefault();
            inited.set_fields($(this));
            $(inited.file_url).val("");
            $(inited.file_id).val("");
            if ($(this).hasClass('simplePanelimageUploadclear')){
              inited.set_preview('image',false);
              inited.replaceImageUploadClass($(this));
            }else{
              inited.set_preview('file',false);
              inited.replaceFileUploadClass($(this));
            }
          });     
        },
        set_fields: function (el){
          inited.file_url = $(el).prev();
          inited.file_id = $(inited.file_url).prev();
        },
        upload:function(el,utype){
          inited.set_fields(el)
          if (utype == 'image')
            inited.upload_Image($(el));
          else
            inited.upload_File($(el));
        },
        upload_File: function(el){
          /* If the media frame already exists, reopen it. */
          var mime = $(el).attr('data-mime_type') || '';
          var ext = $(el).attr("data-ext") || false;
          var name = $(el).attr('id');
          var multi = ($(el).hasClass("multiFile")? true: false);
          
          if ( typeof inited.file_frame[name] !== "undefined")  {
            if (ext){
              inited.file_frame[name].uploader.uploader.param( 'uploadeType', ext);
              inited.file_frame[name].uploader.uploader.param( 'uploadeTypecaller', 'my_meta_box' );
            }
            inited.file_frame[name].open();
            return;
          }
          /* Create the media frame. */

          inited.file_frame[name] = wp.media({
            library: {
                type: mime
            },
            title: jQuery( this ).data( 'uploader_title' ),
            button: {
            text: jQuery( this ).data( 'uploader_button_text' ),
            },
            multiple: multi  // Set to true to allow multiple files to be selected
          });


          /* When an image is selected, run a callback. */
          inited.file_frame[name].on( 'select', function() {
            /* We set multiple to false so only get one image from the uploader */
            attachment = inited.file_frame[name].state().get('selection').first().toJSON();
            /* Do something with attachment.id and/or attachment.url here */
            $(inited.file_id).val(attachment.id);
            $(inited.file_url).val(attachment.url);
            inited.replaceFileUploadClass(el);
            inited.set_preview('file',true);
          });
          /* Finally, open the modal */

          inited.file_frame[name].open();
          if (ext){
            inited.file_frame[name].uploader.uploader.param( 'uploadeType', ext);
            inited.file_frame[name].uploader.uploader.param( 'uploadeTypecaller', 'my_meta_box' );
          }
        },
        upload_Image:function(el){
          var name = $(el).attr('id');
          var multi = ($(el).hasClass("multiFile")? true: false);
          /* If the media frame already exists, reopen it. */
          if ( typeof inited.image_frame[name] !== "undefined")  {
                  inited.image_frame[name].open();
                  return;
          }
          /* Create the media frame. */
          inited.image_frame[name] =  wp.media({
            library: {
              type: 'image'
            },
            title: jQuery( this ).data( 'uploader_title' ),
            button: {
            text: jQuery( this ).data( 'uploader_button_text' ),
            },
            multiple: multi  // Set to true to allow multiple files to be selected
          });
          /* When an image is selected, run a callback. */
          inited.image_frame[name].on( 'select', function() {
            /* We set multiple to false so only get one image from the uploader */
            attachment = inited.image_frame[name].state().get('selection').first().toJSON();
            /* Do something with attachment.id and/or attachment.url here */
            $(inited.file_id).val(attachment.id);
            $(inited.file_url).val(attachment.url);
            inited.replaceImageUploadClass(el);
            inited.set_preview('image',true);
          });
          /* Finally, open the modal */
          inited.image_frame[name].open();
        },
        replaceImageUploadClass: function(el){
          if ($(el).hasClass("simplePanelimageUpload")){
            $(el).removeClass("simplePanelimageUpload").addClass('simplePanelimageUploadclear').val('Remove Image');
          }else{
            $(el).removeClass("simplePanelimageUploadclear").addClass('simplePanelimageUpload').val('Upload Image');
          }
        },
        replaceFileUploadClass: function(el){
          if ($(el).hasClass("simplePanelfileUpload")){
            $(el).removeClass("simplePanelfileUpload").addClass('simplePanelfileUploadclear').val('Remove File');
          }else{
            $(el).removeClass("simplePanelfileUploadclear").addClass('simplePanelfileUpload').val('Upload File');
          }
        },
        set_preview: function(stype,ShowFlag){
          ShowFlag = ShowFlag || false;
          var fileuri = $(inited.file_url).val();
          if (stype == 'image'){
            if (ShowFlag)
              $(inited.file_id).prev().find('img').attr('src',fileuri).show();
            else
              $(inited.file_id).prev().find('img').attr('src','').hide();
          }else{
            if (ShowFlag)
              $(inited.file_id).prev().find('ul').append('<li><a href="' + fileuri + '" target="_blank">'+fileuri+'</a></li>');
            else
              $(inited.file_id).prev().find('ul').children().remove();
          }
        }
      }
    }
    return {
      getInstance :function(){
        if (!inited){
          inited = init();
        }
        return inited; 
      }
    }
  })()
  simplePanelmedia = simplePanelupload.getInstance();
  simplePanelmedia.hooks();
});