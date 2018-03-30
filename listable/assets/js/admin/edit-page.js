(function($){

	$(document).ready(function(){
		// classify the gallery number
		$('#pixgallery').on('html-change-post', function() {
			check_the_number_of_images( $(this) );
		});

		//determine if we should see the Featured Image box depending on the current page template
		if ( $('select#page_template').val() == 'page-templates/front_page.php' ) {
			//hide the Featured Image box
			$('#postimagediv').hide();
		}

		/**
		 * On page template change hide the Featured Image box since we show the Hero one
		 */
		$('#page_template').on('change', function () {
			if ( $('select#page_template').val() == 'page-templates/front_page.php' ) {
				//hide the Featured Image box
				$('#postimagediv').hide();
			} else {
				//show the Featured Image box otherwise
				$('#postimagediv').show();
			}
		});
	});

	var check_the_number_of_images = function( $this ) {
		//$this = $this.parent();
		var $gallery = $this.children('ul'),
			nr_of_images = $gallery.children('li').length,
			metabox_class = '',
			options_container = $('#listing_aside tr:not(.display_on.hidden):not(:first-child)');

		if ( nr_of_images == 0 ) {
			metabox_class = 'no-image';
		} else if ( nr_of_images == 1 ) {
			metabox_class = 'single-image';
		} else {
			metabox_class = 'multiple-images';
		}

		if ( metabox_class !== '' ) {
			$( '#listing_aside')
				.removeClass('no-image single-image multiple-images')
				.addClass(metabox_class);
		}

		toggleSliderOptions(nr_of_images, options_container);
	};

	// Show/Hide "Slideshow Options"
	var toggleSliderOptions = function(no, el) {
		if (no <= 1) {
			el.slideUp();
		} else {
			el.slideDown();
		}
	};

	// Redefines jQuery.fn.html() to add custom events that are triggered before and after a DOM element's innerHtml is changed
	// html-change-pre is triggered before the innerHtml is changed
	// html-change-post is triggered after the innerHtml is changed
	var eventName = 'html-change';
	// Save a reference to the original html function
	jQuery.fn.originalHtml = jQuery.fn.html;
	// Let's redefine the html function to include a custom event
	jQuery.fn.html = function() {
		var currentHtml = this.originalHtml();
		if(arguments.length) {
			this.trigger(eventName + '-pre', jQuery.merge([currentHtml], arguments));
			jQuery.fn.originalHtml.apply(this, arguments);
			this.trigger(eventName + '-post', jQuery.merge([currentHtml], arguments));
			return this;
		} else {
			return currentHtml;
		}
	};


})(jQuery);

