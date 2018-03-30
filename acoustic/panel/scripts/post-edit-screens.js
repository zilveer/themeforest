jQuery(document).ready(function($) {

	//
	// Metabox tabs
	//
	var wrap = $('.ci-cf-wrap');

	wrap.each(function(){

		var sectionsLen = $(this).find('.ci-cf-section').length;

		if(sectionsLen > 1) {

			var root = $(this);
			var sections = root.find('.ci-cf-section');
				sections.not(':first').hide();

			var tabs = $('<ul class="ci-cf-tabs"></ul>').prependTo(root);

			sections.each(function(){
				var sectionTitle = $(this).find('.ci-cf-title').text();
				var tab = $('<li class="ci-cf-tab"></li>').html(sectionTitle);
				var tabs = $('.ci-cf-tabs');
				tabs.append(tab);
			});

			var tab = $('.ci-cf-tab');
				tab.first().addClass('ci-cf-tab-active');

			tab.on('click', function(e){
				$(this).addClass('ci-cf-tab-active').siblings('.ci-cf-tab').removeClass('ci-cf-tab-active');
				var idx = $(this).index();
				var section = $(this).parents('.ci-cf-wrap').children('.ci-cf-section').get(idx);
				$(section).show().siblings('.ci-cf-section').hide();

				if ( typeof google === 'object' && typeof google.maps === 'object' ) {
					if ( $( section ).find( '.gllpLatlonPicker' ).length > 0 ) {
						google.maps.event.trigger( window, 'resize', {} );
					}
				}

				e.preventDefault();
			});
		}
	});

});
