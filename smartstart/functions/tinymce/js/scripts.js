(function( $ ) {

	var shortcode = '',
		alertBoxShortcode,
		layoutShortcode;

	$('#shortcode-dropdown').live('change', function() {

		var $currentShortcode = $(this).val();

		// Reset everything
		$('#shortcode').empty();
		alertBoxShortcode = false;
		layoutShortcode   = false;

		/* -------------------------------------------------- */
		/*	Divider
		/* -------------------------------------------------- */

		if( $currentShortcode === 'divider' ) {

			ss_framework_show_option('.divider');
			shortcode = '[divider style=""]';

		/* -------------------------------------------------- */
		/*	Slogan
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'slogan' ) {

			ss_framework_show_option('.slogan');
			shortcode = '[slogan align=""] [/slogan]';

		/* -------------------------------------------------- */
		/*	Button
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'button-code' ) {

			ss_framework_show_option('.button-code');
			shortcode = '[button <span class="red">url=""</span> target="" size="" style="" arrow=""] [/button]';

		/* -------------------------------------------------- */
		/*	Dropcap
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'dropcap' ) {

			ss_framework_show_option('.dropcap');
			shortcode = '[dropcap style=""] [/dropcap]';

		/* -------------------------------------------------- */
		/*	Info box
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'info-box' ) {

			ss_framework_show_option('.info-box');
			shortcode = '[infobox] [/infobox]';

		/* -------------------------------------------------- */
		/*	Quote
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'quote' ) {

			ss_framework_show_option('.quote');
			shortcode = '[quote author="" type=""] [/quote]';

		/* -------------------------------------------------- */
		/*	List
		/* -------------------------------------------------- */
		} else if( $currentShortcode === 'list' ) {

			ss_framework_show_option('.list');
			shortcode = '[list icon="" style=""] [/list]';

		/* -------------------------------------------------- */
		/*	Lightbox
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'lightbox' ) {

			ss_framework_show_option('.lightbox');
			shortcode = '[lightbox type="" <span class="red">full=""</span> title="" group="" zoom_icon=""] [/lightbox]';

		/* -------------------------------------------------- */
		/*	Accordion Content
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'accordion-content' ) {

			ss_framework_show_option('.accordion-content');
			shortcode = '[accordion_content <span class="red">title=""</span> title_size="" mode=""] [/accordion_content]';

		/* -------------------------------------------------- */
		/*	Content Tabs
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'content-tabs' ) {

			ss_framework_show_option('.content-tabs');
			shortcode = '[tabgroup] [tab <span class="red">title=""</span>] [/tab] [/tabgroup]';

		/* -------------------------------------------------- */
		/*	Pricing tables
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'pricing-tables' ) {

			ss_framework_show_option('.pricing-tables');
			shortcode = '[pricing_table <span class="red">column_count="" type=""</span>] [pricing_column type="" <span class="red">title="" price="" period=""</span> description="" <span class="red">sign_up_title"=" sign_up_url=""</span> special=""] [/pricing_column] [/pricing_table]';

		/* -------------------------------------------------- */
		/*	Video Player
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'video-player' ) {

			ss_framework_show_option('.video-player');
			shortcode = '[video mp4="" webm="" ogg="" poster="" aspect_ratio=""]';

		/* -------------------------------------------------- */
		/*	Audio Player
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'audio-player' ) {

			ss_framework_show_option('.audio-player');
			shortcode = '[audio mp3="" ogg=""]';

		/* -------------------------------------------------- */
		/*	Alert Boxes: Success
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'alert-success' ) {

			ss_framework_show_option('.alert-boxes');
			shortcode = '[success] [/success]';
			alertBoxShortcode = true;

		/* -------------------------------------------------- */
		/*	Alert Boxes: Info
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'alert-info' ) {

			ss_framework_show_option('.alert-boxes');
			shortcode = '[info] [/info]';
			alertBoxShortcode = true;

		/* -------------------------------------------------- */
		/*	Alert Boxes: Notice
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'alert-notice' ) {

			ss_framework_show_option('.alert-boxes');
			shortcode = '[notice] [/notice]';
			alertBoxShortcode = true;

		/* -------------------------------------------------- */
		/*	Alert Boxes: Error
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'alert-error' ) {

			ss_framework_show_option('.alert-boxes');
			shortcode = '[error] [/error]';
			alertBoxShortcode = true;

		/* -------------------------------------------------- */
		/*	Layout: 1/2
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'one-half' ) {

			ss_framework_show_option('.layout');
			shortcode = '[one_half] [/one_half]';
			layoutShortcode = true;

		/* -------------------------------------------------- */
		/*	Layout: 1/2 last
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'one-half-last' ) {

			ss_framework_show_option('.layout');
			shortcode = '[one_half_last] [/one_half_last]';
			layoutShortcode = true;

		/* -------------------------------------------------- */
		/*	Layout: 1/3
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'one-third' ) {

			ss_framework_show_option('.layout');
			shortcode = '[one_third] [/one_third]';
			layoutShortcode = true;

		/* -------------------------------------------------- */
		/*	Layout: 1/3 last
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'one-third-last' ) {

			ss_framework_show_option('.layout');
			shortcode = '[one_third_last] [/one_third_last]';
			layoutShortcode = true;

		/* -------------------------------------------------- */
		/*	Layout: 1/4
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'one-fourth' ) {

			ss_framework_show_option('.layout');
			shortcode = '[one_fourth] [/one_fourth]';
			layoutShortcode = true;

		/* -------------------------------------------------- */
		/*	Layout: 1/4 last
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'one-fourth-last' ) {

			ss_framework_show_option('.layout');
			shortcode = '[one_fourth_last] [/one_fourth_last]';
			layoutShortcode = true;

		/* -------------------------------------------------- */
		/*	Layout: 2/3
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'two-third' ) {

			ss_framework_show_option('.layout');
			shortcode = '[two_third] [/two_third]';
			layoutShortcode = true;

		/* -------------------------------------------------- */
		/*	Layout: 2/3 last
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'two-third-last' ) {

			ss_framework_show_option('.layout');
			shortcode = '[two_third_last] [/two_third_last]';
			layoutShortcode = true;

		/* -------------------------------------------------- */
		/*	Layout: 3/4
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'three-fourth' ) {

			ss_framework_show_option('.layout');
			shortcode = '[three_fourth] [/three_fourth]';
			layoutShortcode = true;

		/* -------------------------------------------------- */
		/*	Layout: 3/4 last
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'three-fourth-last' ) {

			ss_framework_show_option('.layout');
			shortcode = '[three_fourth_last] [/three_fourth_last]';
			layoutShortcode = true;

		/* -------------------------------------------------- */
		/*	Post Carousel
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'post-carousel' ) {

			ss_framework_show_option('.post-carousel');
			shortcode = '[post_carousel title="" limit="" categories="" auto="" scroll_count=""]';

		/* -------------------------------------------------- */
		/*	Project Carousel
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'projects-carousel' ) {

			ss_framework_show_option('.projects-carousel');
			shortcode = '[projects_carousel title="" limit="" categories="" auto="" scroll_count=""]';

		/* -------------------------------------------------- */
		/*	Portfolio
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'portfolio' ) {

			ss_framework_show_option('.portfolio');
			shortcode = '[portfolio columns="" limit="" categories="" pagination=""]';

		/* -------------------------------------------------- */
		/*	Slider
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'slider' ) {

			ss_framework_show_option('.slider');
			shortcode = '[slider <span class="red">id=""</span>]';

		/* -------------------------------------------------- */
		/*	Team member
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'team-member' ) {

			ss_framework_show_option('.team-member');
			shortcode = '[team-member <span class="red">id=""</span> single_url="" single_target="" column="" last=""]';

		/* -------------------------------------------------- */
		/*	Fullwidth map
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'fullwidth-map' ) {

			ss_framework_show_option('.fullwidth-map');
			shortcode = '[fullwidth_map] [/fullwidth_map]';

		/* -------------------------------------------------- */
		/*	Raw
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'raw' ) {

			ss_framework_show_option('.raw');
			shortcode = '[raw] [/raw]';

		} else {

			$('.option').hide();
			shortcode = '';

		}

		$('#shortcode').html( shortcode );

	});

	$('#insert-shortcode').live('click', function() {

		var $currentShortcode = $('#shortcode-dropdown').val();

		/* -------------------------------------------------- */
		/*	Divider
		/* -------------------------------------------------- */

		if( $currentShortcode === 'divider' ) {

			if( $('#divider-style').is(':checked') ) {

				shortcode = '[divider style="dotted"]';
		
			} else {

				shortcode = '[divider]';
				
			}

		/* -------------------------------------------------- */
		/*	Slogan
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'slogan' ) {

			var sloganText  = $('#slogan-text').val(),
				sloganAlign = $('#slogan-align').val();

			shortcode = '[slogan';

			if( sloganAlign )
				shortcode += ' align="' + sloganAlign + '"';

			shortcode += ']' + sloganText + '[/slogan]';

		/* -------------------------------------------------- */
		/*	Button
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'button-code' ) {

			var buttonCodeUrl     = $('#button-code-url').val(),
				buttonCodeTarget  = $('#button-code-target'),
				buttonCodeSize    = $('#button-code-size').val(),
				buttonCodeStyle   = $('#button-code-style'),
				buttonCodeArrow   = $('#button-code-arrow').val(),
				buttonCodeContent = $('#button-code-content').val();

			shortcode = '[button';

			if( buttonCodeUrl )
				shortcode += ' url="' + buttonCodeUrl + '"';

			if( buttonCodeTarget.is(':checked') )
				shortcode += ' target="' + buttonCodeTarget.val() + '"';

			if( buttonCodeSize )
				shortcode += ' size="' + buttonCodeSize + '"';

			if( buttonCodeStyle.is(':checked') )
				shortcode += ' style="' + buttonCodeStyle.val() + '"';

			if( buttonCodeArrow )
				shortcode += ' arrow="' + buttonCodeArrow + '"';

			shortcode += ']' + buttonCodeContent + '[/button]';

		/* -------------------------------------------------- */
		/*	Dropcap
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'dropcap' ) {

			var dropcapStyle   = $('#dropcap-style').val(),
				dropcapContent = $('#dropcap-content').val();

			shortcode = '[dropcap';

			if( dropcapStyle )
				shortcode += ' style="' + dropcapStyle + '"';

			shortcode += ']' + dropcapContent + '[/dropcap]';

		/* -------------------------------------------------- */
		/*	Info box
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'info-box' ) {

			var infoBoxContent = $('#info-box-content').val();
			
			shortcode = '[infobox]' + infoBoxContent + '[/infobox]';

		/* -------------------------------------------------- */
		/*	Quote
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'quote' ) {

			var quoteAuthor  = $('#quote-author').val(),
				quoteType    = $('#quote-type').val(),
				quoteContent = $('#quote-content').val();

			shortcode = '[quote';

			if( quoteAuthor )
				shortcode += ' author="' + quoteAuthor + '"';

			if( quoteType )
				shortcode += ' type="' + quoteType + '"';

			shortcode += ']' + quoteContent + '[/quote]';

		/* -------------------------------------------------- */
		/*	List
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'list' ) {

			var listIcon 	= $('#list-icon').val(),
				listStyle   = $('#list-style'),
				listContent = $('#list-content').val();

			shortcode = '[list';

			if( listIcon )
				shortcode += ' icon="' + listIcon + '"';

			if( listStyle.is(':checked') )
				shortcode += ' style="' + listStyle.val() + '"';

			shortcode += ']' + listContent + '[/list]';

		/* -------------------------------------------------- */
		/*	Lightbox
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'lightbox' ) {

			var lightboxType     = $('#lightbox-type').val(),
				lightboxFull     = $('#lightbox-full').val(),
				lightboxTitle    = $('#lightbox-title').val(),
				lightboxGroup    = $('#lightbox-group').val(),
				lightboxZoomIcon = $('#lightbox-zoom-icon').val(),
				lightboxContent  = $('#lightbox-content').val();

			shortcode = '[lightbox';

			if( lightboxType )
				shortcode += ' type="' + lightboxType + '"';

			shortcode += ' full="' + lightboxFull + '"';

			if( lightboxTitle )
				shortcode += ' title="' + lightboxTitle + '"';

			if( lightboxGroup && lightboxType === 'image-gallery' )
				shortcode += ' group="' + lightboxGroup.toLowerCase().replace(/ /g, '-') + '"';

			if( lightboxZoomIcon )
				shortcode += ' zoom_icon="' + lightboxZoomIcon + '"';

			shortcode += ']' + lightboxContent + '[/lightbox]';

		/* -------------------------------------------------- */
		/*	Accordion Content
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'accordion-content' ) {

			var accordionContentTitle     = $('#accordion-content-title').val(),
				accordionContentTitleSize = $('#accordion-content-title-size').val(),
				accordionContentContent   = $('#accordion-content-content').val(),
				accordionContentMode = $('#accordion-content-mode').val();

			shortcode = '[accordion_content';

			shortcode += ' title="' + accordionContentTitle + '"';

			if(accordionContentTitleSize )
				shortcode += ' title_size="' + accordionContentTitleSize + '"';

			if(accordionContentMode )
				shortcode += ' mode="' + accordionContentMode + '"';

			shortcode += ']' + accordionContentContent + '[/accordion_content]';

		/* -------------------------------------------------- */
		/*	Content Tabs
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'content-tabs' ) {

			var contentTabsTitle   = $('#content-tabs-title').val(),
				contentTabsContent = $('#content-tabs-content').val(),
				contentTabsSingle  = $('#content-tabs-single').is(':checked');

			shortcode = ( !contentTabsSingle ? '[tabgroup] ' : '' );

			shortcode += '[tab';

			shortcode += ' title="' + contentTabsTitle + '"';

			shortcode += ']' + contentTabsContent + '[/tab]';

			if( !contentTabsSingle )
				shortcode += ' [/tabgroup]';

		/* -------------------------------------------------- */
		/*	Pricing tables
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'pricing-tables' ) {

		var pricingTablesColumnCount       = $('#pricing-tables-column-count').val(),
			pricingTablesType              = $('#pricing-tables-type').val(),
			pricingTablesColumnType        = $('#pricing-tables-column-type').val(),
			pricingTablesColumnTitle       = $('#pricing-tables-column-title').val(),
			pricingTablesColumnPrice       = $('#pricing-tables-column-price').val(),
			pricingTablesColumnPeriod      = $('#pricing-tables-column-period').val(),
			pricingTablesColumnDescription = $('#pricing-tables-column-description').val(),
			pricingTablesColumnSignupTitle = $('#pricing-tables-column-signup-title').val(),
			pricingTablesColumnSignupUrl   = $('#pricing-tables-column-signup-url').val(),
			pricingTablesColumnSpecial     = $('#pricing-tables-column-special').val(),
			pricingTablesColumnContent     = $.trim( $('#pricing-tables-column-content').val() ),
			pricingTablesColumnSingle      = $('#pricing-tables-column-single').is(':checked');

		shortcode = '['

		if( !pricingTablesColumnSingle ) {

			shortcode += 'pricing_table';

			shortcode += ' column_count="' + pricingTablesColumnCount + '"';

			shortcode += ' type="' + pricingTablesType + '"';

			shortcode += '] [';

		}

		shortcode += 'pricing_column';

		if( pricingTablesType === 'extended' && pricingTablesColumnType )
		shortcode += ' type="' + pricingTablesColumnType + '"';

		shortcode += ' title="' + pricingTablesColumnTitle + '"';

		shortcode += ' price="' + pricingTablesColumnPrice + '"';

		shortcode += ' period="' + pricingTablesColumnPeriod + '"';

		if( pricingTablesType === 'simple' && pricingTablesColumnDescription )
			shortcode += ' description="' + pricingTablesColumnDescription + '"';

		shortcode += ' sign_up_title="' + pricingTablesColumnSignupTitle + '"';

		shortcode += ' sign_up_url="' + pricingTablesColumnSignupUrl + '"';

		if( pricingTablesColumnSpecial )
			shortcode += ' special="' + pricingTablesColumnSpecial + '"';

		shortcode += ']' + pricingTablesColumnContent + '[/pricing_column]';

		if( !pricingTablesColumnSingle )
			shortcode += ' [/pricing_table]';

		/* -------------------------------------------------- */
		/*	Video Player
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'video-player' ) {

			var videoPlayerMp4	       = $('#video-player-mp4').val(),
				videoPlayerWebm	       = $('#video-player-webm').val(),
				videoPlayerOgg 	       = $('#video-player-ogg').val(),
				videoPlayerPoster      = $('#video-player-poster').val(),
				videoPlayerAspectRatio = $('#video-player-aspect-ratio').val();

			shortcode = '[video';

			if( videoPlayerMp4 )
				shortcode += ' mp4="' + videoPlayerMp4 + '"';

			if( videoPlayerWebm )
				shortcode += ' webm="' + videoPlayerWebm + '"';

			if( videoPlayerOgg )
				shortcode += ' ogg="' + videoPlayerOgg + '"';

			if( videoPlayerPoster )
				shortcode += ' poster="' + videoPlayerPoster + '"';

			if( videoPlayerAspectRatio )
				shortcode += ' aspect_ratio="' + videoPlayerAspectRatio + '"';

			shortcode += ']';

		/* -------------------------------------------------- */
		/*	Audio Player
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'audio-player' ) {

			var audioPlayerMp3 = $('#audio-player-mp3').val(),
				audioPlayerOgg = $('#audio-player-ogg').val();

			shortcode = '[audio';

			if(audioPlayerMp3) shortcode += ' mp3="' + audioPlayerMp3 + '"';

			if(audioPlayerOgg) shortcode += ' ogg="' + audioPlayerOgg + '"';

			shortcode += ']';

		/* -------------------------------------------------- */
		/*	Alert Boxes
		/* -------------------------------------------------- */

		} else if(alertBoxShortcode) {

			var alertBoxContent = $('#alert-boxes-content').val();

			if( $currentShortcode === 'alert-success' )
				shortcode = '[success]' + alertBoxContent + '[/success]';

			if( $currentShortcode === 'alert-info' )
				shortcode = '[info]' + alertBoxContent + '[/info]';

			if( $currentShortcode === 'alert-notice' )
				shortcode = '[notice]' + alertBoxContent + '[/notice]';

			if( $currentShortcode === 'alert-error' )
				shortcode = '[error]' + alertBoxContent + '[/error]';
		
		/* -------------------------------------------------- */
		/*	Layout
		/* -------------------------------------------------- */

		} else if(layoutShortcode) {

			var layoutContent = $('#layout-content').val();

			if( $currentShortcode === 'one-half' )
				shortcode = '[one_half]' + layoutContent + '[/one_half]';

			if( $currentShortcode === 'one-half-last' )
				shortcode = '[one_half_last]' + layoutContent + '[/one_half_last]';

			if( $currentShortcode === 'one-third' )
				shortcode = '[one_third]' + layoutContent + '[/one_third]';

			if( $currentShortcode === 'one-third-last' )
				shortcode = '[one_third_last]' + layoutContent + '[/one_third_last]';

			if( $currentShortcode === 'one-fourth' )
				shortcode = '[one_fourth]' + layoutContent + '[/one_fourth]';

			if( $currentShortcode === 'one-fourth-last' )
				shortcode = '[one_fourth_last]' + layoutContent + '[/one_fourth_last]';

			if( $currentShortcode === 'two-third' )
				shortcode = '[two_third]' + layoutContent + '[/two_third]';

			if( $currentShortcode === 'two-third-last' )
				shortcode = '[two_third_last]' + layoutContent + '[/two_third_last]';

			if( $currentShortcode === 'three-fourth' )
				shortcode = '[three_fourth]' + layoutContent + '[/three_fourth]';

			if( $currentShortcode === 'three-fourth-last' )
				shortcode = '[three_fourth_last]' + layoutContent + '[/three_fourth_last]';
			
		/* -------------------------------------------------- */
		/*	Post Carousel
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'post-carousel' ) {

			var postCarouselTitle       = $('#post-carousel-title').val(),
				postCarouselLimit       = parseInt( $('#post-carousel-limit').val() ),
				postCarouselAuto        = parseInt( $('#post-carousel-auto').val() ),
				postCarouselCategories  = $('#post-carousel-categories').val(),
				postCarouselScrollCount = parseInt( $('#post-carousel-scroll-count').val() );

			shortcode = '[post_carousel';

			if( postCarouselTitle )
				shortcode += ' title="' + postCarouselTitle + '"';

			if( postCarouselLimit )
				shortcode += ' limit="' + postCarouselLimit + '"';

			if(postCarouselCategories[0] !== '')
				shortcode += ' categories="' + postCarouselCategories + '"';

			if( postCarouselAuto )
				shortcode += ' auto="' + postCarouselAuto + '"';

			if( postCarouselScrollCount )
				shortcode += ' scroll_count="' + postCarouselScrollCount + '"';

			shortcode += ']';

		/* -------------------------------------------------- */
		/*	Project Carousel
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'projects-carousel' ) {

			var projectsCarouselTitle       = $('#projects-carousel-title').val(),
				projectsCarouselLimit       = parseInt( $('#projects-carousel-limit').val() ),
				projectsCarouselAuto        = parseInt( $('#projects-carousel-auto').val() ),
				projectsCarouselCategories  = $('#projects-carousel-categories').val(),
				projectsCarouselScrollCount = parseInt( $('#projects-carousel-scroll-count').val() );

			shortcode = '[projects_carousel';

			if( projectsCarouselTitle )
				shortcode += ' title="' + projectsCarouselTitle + '"';

			if( projectsCarouselLimit )
				shortcode += ' limit="' + projectsCarouselLimit + '"';

			if( projectsCarouselCategories[0] !== '' )
				shortcode += ' categories="' + projectsCarouselCategories + '"';

			if( projectsCarouselAuto )
				shortcode += ' auto="' + projectsCarouselAuto + '"';

			if( projectsCarouselScrollCount )
				shortcode += ' scroll_count="' + projectsCarouselScrollCount + '"';

			shortcode += ']';

		/* -------------------------------------------------- */
		/*	Portfolio
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'portfolio' ) {

			var portfolioColumns    = $('#portfolio-columns').val(),
				portfolioLimit      = parseInt( $('#portfolio-limit').val() ),
				portfolioCategories = $('#portfolio-categories').val(),				
				portfolioPagination = $('#portfolio-pagination').is(':checked');

			shortcode = '[portfolio';

			shortcode += ' columns="' + portfolioColumns + '"';

			if( portfolioLimit )
				shortcode += ' limit="' + portfolioLimit + '"';

			if( portfolioCategories[0] !== '' )
				shortcode += ' categories="' + portfolioCategories + '"';

			if( portfolioPagination )
				shortcode += ' pagination="no"';

			shortcode += ']';

		/* -------------------------------------------------- */
		/*	Slider
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'slider' ) {

			var sliderId = $('#slider-id').val();

			shortcode = '[slider';

			shortcode += ' id="' + sliderId + '"';

			shortcode += ']';

		/* -------------------------------------------------- */
		/*	Team member
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'team-member' ) {

			var teamMemberId           = $('#team-member-id').val(),
				teamMemberSingleUrl    = $('#team-member-single-url').val(),
				teamMemberSingleTarget = $('#team-member-single-target'),
				teamMemberColumn       = $('#team-member-column').val(),
				teamMemberLast         = $('#team-member-last').is(':checked');

			shortcode = '[team_member';

			shortcode += ' id="' + teamMemberId + '"';

			if( teamMemberSingleUrl )
				shortcode += ' single_url="' + teamMemberSingleUrl + '"';

			if( teamMemberSingleTarget.is(':checked') )
				shortcode += ' single_target="' + teamMemberSingleTarget.val() + '"';

			shortcode += ' column="' + teamMemberColumn + '"';

			if( teamMemberLast )
				shortcode += ' last="last"';

			shortcode += ']';

		/* -------------------------------------------------- */
		/*	Fullwidth map
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'fullwidth-map' ) {

			var mapContent = $('#fullwidth-map-content').val();

			shortcode = '[fullwidth_map]' + mapContent + '[/fullwidth_map]';

		/* -------------------------------------------------- */
		/*	Raw
		/* -------------------------------------------------- */

		} else if( $currentShortcode === 'raw' ) {

			var rawContent = $('#raw-content').val();

			shortcode = '[raw]' + rawContent + '[/raw]';

		}
		
		// Insert shortcode and remove popup
		tinyMCE.activeEditor.execCommand('mceInsertContent', false, shortcode);
		tb_remove();

	});

	// Show current shortcode
	function ss_framework_show_option( option ) {

		$('.option').hide();
		$( option ).show();

	}

})( jQuery );