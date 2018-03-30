/* ----------------- Start Document ----------------- */
/*jshint -W065 */

(function($){
	"use strict";
	$(document).ready(function(){

		/* global cp */


		/*----------------------------------------------------*/
		/*	Isotope Portfolio Filter
		/*----------------------------------------------------*/

		$(window).load(function(){
			$('.grid').isotope({
				itemSelector : '.post',
        layoutMode: 'masonry',
        containerStyle: { overflow: 'visible', position: 'relative'}
			});

		});

		$('.flexslider').flexslider({
			smoothHeight: true,
			controlNav: false, 
			directionNav: true, 
		});

    $('ul.sf-menu').superfish({
      delay:       1000,                            // one second delay on mouseout
      animation:   {opacity:'show',height:'show'},  // fade-in and slide-down animation
      speed:       'fast',                          // faster animation speed
      autoArrows:  false                            // disable generation of arrow mark-up
    });

    $("select.selectnav").change(function() {
      window.location = $(this).find("option:selected").val();
    });

    $('.multiselect,.chosen').chosen({allow_single_deselect: true});


		//submit js
		function addIng() {
			var newElem = $('tr.ingridients-cont.ing:first').clone();
			newElem.find('input').val('');
			newElem.appendTo('table#ingridients-sort');
		}
          //sortable table
          var fixHelper = function(e, ui) {
            ui.children().each(function() {
              $(this).width($(this).width());
            });
            return ui;
          };
          if ($("table#ingridients-sort").is('*')) {
            $('.add_ingridient').click(function(e){
             e.preventDefault();
             addIng(); addIng(); addIng();
           })

            $('.add_separator').click(function(e){
             e.preventDefault();
             var newElem = $('<tr class="ingridients-cont separator"><td><i class="icon icon-arrows"></i></td><td><input name="cookingpressingridients_name[]" type="text" class="ingridient"  value="" /></td><td><input name="cookingpressingridients_note[]" type="text" class="notes"  value="separator" /></td><td class="action"><a title="Delete ingridient" href="#" class="delete"><i class="icon icon-trash-o"></i></a></td></tr>');
             newElem.appendTo('table#ingridients-sort');
           })

        // remove ingredient
        $('#ingridients-sort .delete').live('click',function(e){
        	e.preventDefault();
        	$(this).parent().parent().remove();
        });



        $('table#ingridients-sort tbody').sortable({
        	helper: fixHelper
        });

        var tags_json = foodiepress_vars.availabletags.replace(/&quot;/g, '"');
        // autocomplete tags
        $('#ingridients-sort input.ingridient').live('keyup.autocomplete', function(){
        	$(this).autocomplete({
        		source: jQuery.parseJSON(tags_json)
        	});
        });
      }

      $('.rsCPgallery').royalSlider({
        fullscreen: {
          enabled: true,
          nativeFS: true
        },
        controlNavigation: 'thumbnails',
        autoScaleSlider: true,
        autoScaleSliderWidth: 960,
        autoScaleSliderHeight: 850,
        loop: false,
        imageScaleMode: 'fit-if-smaller',
        navigateByClick: true,
        numImagesToPreload:2,
        arrowsNav:true,
        arrowsNavAutoHide: true,
        arrowsNavHideOnTouch: true,
        keyboardNavEnabled: true,
        fadeinLoadedSlide: true,
        globalCaption: true,
        globalCaptionInside: true,
        thumbs: {
          appendSpan: true,
          firstMargin: true,
          paddingBottom: 4
        }
      });

        $('body').magnificPopup({
        type: 'image',
        delegate: 'a.mfp-gallery',

        fixedContentPos: true,
        fixedBgPos: true,

        overflowY: 'auto',

        closeBtnInside: true,
        preloader: true,

        removalDelay: 0,
        mainClass: 'mfp-fade',

        gallery:{enabled:true},

        callbacks: {
          buildControls: function() {
            console.log('inside'); this.contentContainer.append(this.arrowLeft.add(this.arrowRight));
          }

        }
      });



      $('.wp-caption a').magnificPopup({
          type: 'image',
          mainClass: 'mfp-fade',
          closeOnContentClick: true,
          image: {
            verticalFit: true
          }
        });      



      /* ------------------ End Document ------------------ */
    });

})(this.jQuery);
