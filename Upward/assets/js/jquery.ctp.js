/*

	1 - HOVERS: PROJECTS

		1.1 - Append a common hover
		1.2 - Template: Default
		1.3 - Template: 1 & 2
		1.4 - Template: 5
		1.5 - Template: 6

*/

/* jshint -W099 */
/* global jQuery:false, stData:false */

var t = jQuery.noConflict();

t(function(){

	'use strict';

/*

	stData[0] - Primary color
	stData[1] - Secondary color

*/

/*===============================================

	H O V E R S :   P R O J E C T S
	Animated hovers for projects

===============================================*/

	/*-------------------------------------------
		1.1 - Append a common hover
	-------------------------------------------*/

	t('.project-thumb')

		.hover(

			function(){

				if ( !t(this).hasClass('inProgress') ) {

					t(this).addClass('inProgress');
	
					var
						width = t(this).outerWidth(true),
						height = t(this).outerHeight(true),
						hover = '<div class="st-hover" style="width: ' + width + 'px; height: ' + height + 'px; margin-bottom: -' + height + 'px;"><div class="st-hover-bg" style="background: #' + stData[1] + ';"><!-- bg --></div><div class="st-hover-data div-as-table"><div><div><!-- data --></div></div></div></div>';
			
						t(this).html( hover );


							/*-------------------------------------------
								1.3 - Template: 1 & 2
							-------------------------------------------*/

							if ( t(this).parent().parent().hasClass('projects-t1-wrapper') || t(this).parent().parent().hasClass('projects-t2-wrapper') ) {

								var
									title = t(this).attr('title'),
									category = t(this).attr('data-category');

									t('.st-hover-data div div',this).html( '<i><!-- --></i><p>' + title + '</p>' + category );

									t(this).removeAttr('title');

							}


						t('.st-hover',this).stop(true, false).animate({ opacity: 1}, 200 );

				}

			},

			function(){

				if ( t(this).hasClass('inProgress') ) {

					var
						title = t('.st-hover-data p',this).html();

						t('.st-hover',this).stop(true, false).animate({ opacity: 0}, 200, function(){ t(this).parent().removeClass('inProgress'); t(this).remove(); } );

						t(this).attr('title', title);

				}

			}

		);


	/*-------------------------------------------
		1.2 - Template: Default
	-------------------------------------------*/

	/* no needed */


	/*-------------------------------------------
		1.4 - Template: 5
	-------------------------------------------*/

	/* no needed */


	/*-------------------------------------------
		1.5 - Template: 6
	-------------------------------------------*/

	/* no needed */


});