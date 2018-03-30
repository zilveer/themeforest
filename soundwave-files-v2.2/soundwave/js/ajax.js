//Version 1.5.1
(function (window, undefined) {

   // Prepare our Variables
   var
   History = window.History,
      $ = window.jQuery,
      document = window.document;

   // Check to see if History.js is enabled for our Browser
   if(!History.enabled) return false;

   // Wait for Document
   $(function () {
      // Prepare Variables
      var
      // Application Specific Variables 
         rootUrl = aws_data['rootUrl'],
		 rootTheme = aws_data['rootTheme'],
         contentSelector = '#wrcon',
         $content = $(contentSelector),
         contentNode = $content.get(0),
         // Application Generic Variables 
         $body = $(document.body),
         scrollOptions = {
            duration: 800,
            easing: 'swing'
         };

      // Ensure Content
      if($content.length === 0) $content = $body;

      // Internal Helper
      $.expr[':'].internal = function (obj, index, meta, stack) {
         // Prepare
         var
         $this = $(obj),
            url = $this.attr('href') || '',
            isInternalLink;

         // Check link
         isInternalLink = url.substring(0, rootUrl.length) ===
            rootUrl || url.indexOf(':') === -1;

         // Ignore or Keep
         return isInternalLink;
      };

      // HTML Helper
      var documentHtml = function (html) {
         // Prepare
         var result = String(html).replace(/<\!DOCTYPE[^>]*>/i,
            '')
            .replace(/<(html|head|body|title|script)([\s\>])/gi,
               '<div id="document-$1"$2')
            .replace(/<\/(html|head|body|title|script)\>/gi,
               '</div>');
         // Return
         return result;
      };

      // Ajaxify Helper
      $.fn.ajaxify = function () {
         // Prepare
         var $this = $(this);

         // Ajaxify
         $(this).find(
            'a:internal:not(.no-ajax,[href^="#"],[href*="wp-login"],[href*="wp-admin"],[data-rel^="prettyPhoto"],[rel^="prettyPhoto-cover"],[rel^="prettyPhoto-cover-widget"])'
         ).live('click', function (event) {
            // Prepare
            var
            $this = $(this),
               url = $this.attr('href'),
               title = $this.attr('title') || null;

            // Continue as normal for cmd clicks etc
            if(event.which == 2 || event.metaKey) return true;

            // Ajaxify this link
            History.pushState(null, title, url);
            event.preventDefault();
            return false;
         });
         // Chain
         return $this;
      };

      // Ajaxify our Internal Links
      $body.ajaxify();

      // Hook into State Changes
      $(window).bind('statechange', function () {
         // Prepare Variables
         var
         State = History.getState(),
            url = State.url,
            relativeUrl = url.replace(rootTheme, '');

         // Set Loading
         $body.addClass('loading');

         // Start Fade Out
         // Animating to opacity to 0 still keeps the element's height intact
         // Which prevents that annoying pop bang issue when loading in new content
         $content.animate({
            opacity: 0
         }, 2200);
  
         $content
            .html('<img src="'+ rootTheme +'images/loader.gif" />')  
            .css('text-align', 'center');
         
         // Ajax Request the Traditional Page
         $.ajax({
            url: url,
            success: function (data, textStatus, jqXHR) {
               // Prepare
               var
               $data = $(documentHtml(data)),
                  $dataBody = $data.find(
                     '#document-body:first ' +
                     contentSelector),
                  bodyClasses = $data.find(
                     '#document-body:first').attr('class'),
                  contentHtml, $scripts;



               //Add classes to body
               jQuery('body').attr('class', bodyClasses);

               // Fetch the scripts
               $scripts = $dataBody.find(
                  '#document-script');
               if($scripts.length) $scripts.detach();

               // Fetch the content
               contentHtml = $dataBody.html() || $data.html();

               if(!contentHtml) {
                  document.location.href = url;
                  return false;
               }

               // Update the content
               $content.stop(true, true);
               $content.html(contentHtml)
                  .ajaxify()
                  .css('text-align', '')
                  .animate({
                     opacity: 1,
                     visibility: "visible"
                  });

               $.getScript(''+ rootTheme +'js/script.js');
			   $.getScript(''+ rootTheme +'js/firstword.js');

               if(jQuery().prettyPhoto) {
                  jQuery("a[data-rel^='prettyPhoto']").prettyPhoto({
                     animation_speed: 'fast', // fast/slow/normal 
                     slideshow: 5000, // false OR interval time in ms 
                     autoplay_slideshow: false, // true/false 
                     opacity: 0.80, // Value between 0 and 1 
                     show_title: true, // true/false 
                     allow_resize: true, // Resize the photos bigger than viewport. true/false 
                     default_width: 540,
                     default_height: 344,
					 deeplinking : false,
                     counter_separator_label: '/', // The separator for the gallery counter 1 "of" 2
                     theme: 'pp_default', // light_rounded / dark_rounded / light_square / dark_square / facebook
                     horizontal_padding: 20, // The padding on each side of the picture 
                     autoplay: true, // Automatically start videos: True/False 					
                     ie6_fallback: true,
                  });
               }

               if(jQuery().prettyPhoto) {
                  jQuery("a[data-rel^='prettyPhoto-widget']").prettyPhoto({
                     animation_speed: 'fast', // fast/slow/normal 
                     slideshow: 5000, // false OR interval time in ms 
                     autoplay_slideshow: false, // true/false 
                     opacity: 0.80, // Value between 0 and 1 
                     show_title: true, // true/false 
                     allow_resize: true, // Resize the photos bigger than viewport. true/false 
                     default_width: 540,
                     default_height: 344,
					 deeplinking : false,
                     counter_separator_label: '/', // The separator for the gallery counter 1 "of" 2
                     theme: 'pp_default', // light_rounded / dark_rounded / light_square / dark_square / facebook
                     horizontal_padding: 20, // The padding on each side of the picture 
                     autoplay: true, // Automatically start videos: True/False 					
                     ie6_fallback: true,
                  });
               }

               if(jQuery().prettyPhoto) {
                  jQuery("a[data-rel^='prettyPhoto-cover']").prettyPhoto({
                     animation_speed: 'fast', // fast/slow/normal 
                     slideshow: 5000, // false OR interval time in ms 
                     autoplay_slideshow: false, // true/false 
                     opacity: 0.80, // Value between 0 and 1 
                     show_title: true, // true/false 
                     allow_resize: true, // Resize the photos bigger than viewport. true/false 
                     default_width: 540,
                     default_height: 344,
					 deeplinking : false,
                     counter_separator_label: '/', // The separator for the gallery counter 1 "of" 2
                     theme: 'pp_default', // light_rounded / dark_rounded / light_square / dark_square / facebook
                     horizontal_padding: 20, // The padding on each side of the picture 
                     autoplay: false, // Automatically start videos: True/False 					
                     ie6_fallback: true,
                  });
               }
			  			  
				$(".photo-preview img")
				  .fadeTo(1, 1);
				$(".photo-preview img")
				  .hover(

				function () {
				  $(this)
					.fadeTo("fast", 0.70);
				}, function () {
				  $(this)
					.fadeTo("slow", 1);
				});
						
				
               //Append new menu HTML to provided classs

			   	var request = $(data);
				$('#main').replaceWith($('#main', request));

               //Adding no-ajaxy class to a tags present under ids provided
               $(aws_data['ids']).each(function () {
                  jQuery(this).addClass('no-ajaxy');
               });

               // Update the title
               document.title = $data.find(
                  '#document-title:first').text();
               try {
                  document.getElementsByTagName('title')[
                     0].innerHTML = document.title.replace(
                     '<', '&lt;').replace('>', '&gt;').replace(
                     ' & ', ' &amp; ');
               }
               catch(Exception) {}

               // Add the scripts
               $scripts.each(function () {
                  var $script = $(this),
                     scriptText = $script.html(),
                     scriptNode = document.createElement(
                        'script');
                  try {
                     // doesn't work on ie...
                     scriptNode.appendChild(document.createTextNode(
                        scriptText));
                     contentNode.appendChild(
                        scriptNode);
                  }
                  catch(e) {
                     // IE has funky script nodes
                     scriptNode.text = scriptText;
                     contentNode.appendChild(
                        scriptNode);
                  }
                  if($(this).attr('src') != null) {
                     scriptNode.setAttribute('src', ($(
                        this).attr('src')));
                  }
               });

               $body.removeClass('loading');

               // Inform Google Analytics of the change
               if(typeof window.pageTracker !==
                  'undefined') window.pageTracker._trackPageview(
                  relativeUrl);

               // Inform ReInvigorate of a state change
               if(typeof window.reinvigorate !==
                  'undefined' && typeof window.reinvigorate
                  .ajax_track !== 'undefined')
                  reinvigorate.ajax_track(url); // ^ we use the full url here as that is what reinvigorate supports
            },
            error: function (jqXHR, textStatus,
               errorThrown) {
               document.location.href = url;
               return false;
            }

         }); // end ajax

      }); // end onStateChange

   }); // end onDomLoad

})(window); // end closure