/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Visual Content Composer Scripts
 * Created by CMSMasters
 * 
 */


jQuery(document).ready(function () { 
	(function ($) { 
		// Build Composer
		if ($('#cmsms_composer_content').hasClass('deactivated')) {
			var columns = $('#cmsms_composer_content > div'), 
				cFolder = undefined, 
				cType = undefined, 
				cClass = undefined, 
				cClassArray = undefined, 
				cWidth = undefined, 
				cElement = undefined, 
				cElementContent = '', 
				cTitle = undefined, 
				composerPlusText = $('#cmsms_composer_plus_text').val(), 
				composerMinusText = $('#cmsms_composer_minus_text').val(), 
				composerDeleteText = $('#cmsms_composer_delete_text').val(), 
				composerEditText = $('#cmsms_composer_edit_text').val(), 
				composerCheckColumnText = $('#cmsms_composer_check_column_text').val(), 
				composerCheckDividerText = $('#cmsms_composer_check_divider_text').val(), 
				composerCopyText = $('#cmsms_composer_copy_text').val();
			
			
			for (var i = 0, ilength = columns.length; i < ilength; i += 1) {
				cFolder = (columns.eq(i).attr('data-folder')) ? columns.eq(i).attr('data-folder') : 'column';
				cType = (columns.eq(i).attr('data-type')) ? columns.eq(i).attr('data-type') : '';
				cClass = columns.eq(i).attr('class'), 
				cClassArray = cClass.split(' ');
				cElementContent = '';
				
				
				cTitle = setComposerSHcTitle(cFolder, cType);
				
				
				cWidth = setComposerSHcWidth(cClassArray[0]);
				
				
				if (cFolder !== 'divider' && columns.eq(i).html() !== '') {
					for (var j = 0, jlength = columns.eq(i).find('> div').length; j < jlength; j += 1) {
						var cElement = columns.eq(i).find('> div').eq(j), 
							cElementTitle = undefined;
						
						
						cElementTitle = setComposerSHcTitle(cElement.attr('data-folder'), cElement.attr('data-type'));
						
						
						if (cElement.attr('data-folder') === 'divider') {
							cElementContent += '<div class="one_first">' + 
								'<div class="cmsms_composer_column_head">' + 
									'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_delete" title="' + composerDeleteText + '">' + composerDeleteText + '</a>' + 
									'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_check' + ((cElement.attr('data-type') === 'divider') ? ' checked' : '') + '" title="' + composerCheckDividerText + '">' + composerCheckDividerText + '</a>' + 
									'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_copy" title="' + composerCopyText + '">' + composerCopyText + '</a>' + 
									'<span class="cmsms_composer_column_title">' + cElementTitle + '</span>' + 
								'</div>' + 
								'<div class="cmsms_composer_column_content" data-folder="' + cElement.attr('data-folder') + '" data-type="' + cElement.attr('data-type') + '">' + 
									((cElement.attr('data-folder') === 'divider') ? '<div class="' + ((cElement.attr('data-type') === 'divider') ? 'divider' : 'cl') + '"></div>' : '') + 
								'</div>' + 
							'</div>';
						} else {
							cElementContent += '<div class="one_first">' + 
								'<div class="cmsms_composer_column_head">' + 
									'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_delete" title="' + composerDeleteText + '">' + composerDeleteText + '</a>' + 
									'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_edit" title="' + composerEditText + '">' + composerEditText + '</a>' + 
									'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_copy" title="' + composerCopyText + '">' + composerCopyText + '</a>' + 
									'<span class="cmsms_composer_column_title">' + cElementTitle + '</span>' + 
								'</div>' + 
								'<div class="cmsms_composer_column_content" data-folder="' + cElement.attr('data-folder') + '" data-type="' + cElement.attr('data-type') + '">' + 
									((cElement.html() !== '') ? cElement.html() : '') + 
								'</div>' + 
							'</div>';
						}
					}
				}
				
				
				if (cFolder === 'divider') {
					columns.eq(i).before('<div class="' + cClass + '">' + 
						'<div class="cmsms_composer_column_head">' + 
							'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_delete" title="' + composerDeleteText + '">' + composerDeleteText + '</a>' + 
							'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_check' + ((cType === 'divider') ? ' checked' : '') + '" title="' + composerCheckDividerText + '">' + composerCheckDividerText + '</a>' + 
							'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_copy" title="' + composerCopyText + '">' + composerCopyText + '</a>' + 
							'<span class="cmsms_composer_column_title">' + cTitle + '</span>' + 
						'</div>' + 
						'<div class="cmsms_composer_column_elements" data-folder="' + cFolder + '" data-type="' + cType + '">' + 
							((cFolder === 'divider') ? '<div class="' + ((cType === 'divider') ? 'divider' : 'cl') + '"></div>' : '') + 
						'</div>' + 
					'</div>');
				} else {
					columns.eq(i).before('<div class="' + cClass + '">' + 
						'<div class="cmsms_composer_column_head">' + 
							'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_delete" title="' + composerDeleteText + '">' + composerDeleteText + '</a>' + 
							'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_arrow' + ((cClassArray.indexOf('right_column') !== -1) ? ' checked' : '') + '" title="' + composerCheckColumnText + '">' + composerCheckColumnText + '</a>' + 
							'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_copy" title="' + composerCopyText + '">' + composerCopyText + '</a>' + 
							'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_plus" title="' + composerPlusText + '">' + composerCopyText + '</a>' + 
							'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_minus" title="' + composerMinusText + '">' + composerCopyText + '</a>' + 
							'<span class="cmsms_composer_column_width">' + cWidth + '</span>' + 
							'<span class="cmsms_composer_column_title">' + cTitle + '</span>' + 
						'</div>' + 
						'<div class="cmsms_composer_column_elements" data-folder="' + cFolder + '" data-type="' + cType + '">' + cElementContent + '</div>' + 
					'</div>');
				}
				
				
				columns.eq(i).remove();
			}
			
			
			$('#cmsms_composer_content').removeClass('deactivated');
			
			
			$('.cmsms_composer_buttons_container > .cmsms_composer_buttons_container_wrap1 > a.button').draggable( { 
				opacity : 0.8, 
				cursor : 'move', 
				helper : 'clone', 
				delay : 150, 
				zIndex : 1000, 
				connectToSortable : '#cmsms_composer_content' 
			} );
			
			
			$('.cmsms_composer_buttons_container > .cmsms_composer_buttons_container_wrap2 > a.button').draggable( { 
				opacity : 0.8, 
				cursor : 'move', 
				helper : 'clone', 
				delay : 150, 
				zIndex : 1001, 
				connectToSortable : '#cmsms_composer_content > div > .cmsms_composer_column_elements' 
			} );
			
			
			$('#cmsms_composer_content').droppable( { 
				accept : ':not(.ui-sortable-helper)', 
				drop : function (event, ui) { 
					var dFolder = ui.draggable.attr('data-folder'), 
						dType = ui.draggable.attr('data-type'), 
						dTitle = ui.draggable.attr('title'), 
						dClass = ui.draggable.attr('data-width'), 
						dWidth = undefined, 
						composerPlusText = $('#cmsms_composer_plus_text').val(), 
						composerMinusText = $('#cmsms_composer_minus_text').val(), 
						composerDeleteText = $('#cmsms_composer_delete_text').val(), 
						composerCheckColumnText = $('#cmsms_composer_check_column_text').val(), 
						composerCheckDividerText = $('#cmsms_composer_check_divider_text').val(), 
						composerCopyText = $('#cmsms_composer_copy_text').val();
					
					
					dWidth = setComposerSHcWidth(dClass);
					
					
					if (dFolder === 'divider') {
						ui.draggable.html('<div class="' + dClass + '">' + 
							'<div class="cmsms_composer_column_head">' + 
								'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_delete" title="' + composerDeleteText + '">' + composerDeleteText + '</a>' + 
								'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_check' + ((dType === 'divider') ? ' checked' : '') + '" title="' + composerCheckDividerText + '">' + composerCheckDividerText + '</a>' + 
								'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_copy" title="' + composerCopyText + '">' + composerCopyText + '</a>' + 
								'<span class="cmsms_composer_column_title">' + dTitle + '</span>' + 
							'</div>' + 
							'<div class="cmsms_composer_column_elements" data-folder="' + dFolder + '" data-type="' + dType + '">' + 
								'<div class="' + ((dType === 'divider') ? 'divider' : 'cl') + '"></div>' + 
							'</div>' + 
						'</div>');
					} else {
						ui.draggable.html('<div class="' + dClass + '">' + 
							'<div class="cmsms_composer_column_head">' + 
								'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_delete" title="' + composerDeleteText + '">' + composerDeleteText + '</a>' + 
								'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_arrow" title="' + composerCheckColumnText + '">' + composerCheckColumnText + '</a>' + 
								'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_copy" title="' + composerCopyText + '">' + composerCopyText + '</a>' + 
								'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_plus" title="' + composerPlusText + '">' + composerCopyText + '</a>' + 
								'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_minus" title="' + composerMinusText + '">' + composerCopyText + '</a>' + 
								'<span class="cmsms_composer_column_width">' + dWidth + '</span>' + 
								'<span class="cmsms_composer_column_title">' + dTitle + '</span>' + 
							'</div>' + 
							'<div class="cmsms_composer_column_elements" data-folder="' + dFolder + '" data-type="' + dType + '"></div>' + 
						'</div>');
					}
					
					
					setTimeout(function () { 
						ui.draggable.find('.cmsms_composer_column_head').parent().unwrap('a.button');
						
						
						startComposerColumnsDroppable();
					}, 100);
				} 
			} ).sortable( { 
				cursor : 'move', 
				start : function () { 
					$('#cmsms_composer_content > div').removeClass('first_column');
				}, 
				stop : function () { 
					setComposerFirstColumnOfRow();
				}, 
				update : function () { 
					setTimeout(function () { 
						updateComposerContent();
					}, 150);
				} 
			} );
			
			
			startComposerColumnsDroppable();
			
			
			setComposerFirstColumnOfRow();
		}
		
		
		
		// Get Composer Shortcode Title
		function setComposerSHcWidth(cfClassArray) { 
			var cfWidth = undefined;
			
			
			if (cfClassArray === 'one_sixth') {
				cfWidth = '1/6';
			} else if (cfClassArray === 'one_fifth') {
				cfWidth = '1/5';
			} else if (cfClassArray === 'one_fourth') {
				cfWidth = '1/4';
			} else if (cfClassArray === 'one_third') {
				cfWidth = '1/3';
			} else if (cfClassArray === 'two_fifth') {
				cfWidth = '2/5';
			} else if (cfClassArray === 'one_half') {
				cfWidth = '1/2';
			} else if (cfClassArray === 'three_fifth') {
				cfWidth = '3/5';
			} else if (cfClassArray === 'two_third') {
				cfWidth = '2/3';
			} else if (cfClassArray === 'three_fourth') {
				cfWidth = '3/4';
			} else if (cfClassArray === 'four_fifth') {
				cfWidth = '4/5';
			} else if (cfClassArray === 'five_sixth') {
				cfWidth = '5/6';
			} else if (cfClassArray === 'one_first') {
				cfWidth = '1/1';
			}
			
			
			return cfWidth;
		}
		
		
		
		// Get Composer Shortcode Title
		function setComposerSHcTitle(cfFolder, cfType) { 
			var cfTitle = undefined, 
				tTitles = { 
					tColumn : $('#cmsms_composer_column14').attr('title'), 
					tDivider : $('#cmsms_composer_divider1').attr('title'), 
					tClear : $('#cmsms_composer_clear1').attr('title'), 
					tText : $('#cmsms_composer_text').attr('title'), 
					tBox : $('#cmsms_composer_box').attr('title'), 
					tBlock : $('#cmsms_composer_block').attr('title'), 
					tColor : $('#cmsms_composer_color').attr('title'), 
					tPerson : $('#cmsms_composer_person').attr('title'), 
					tTab : $('#cmsms_composer_tab').attr('title'), 
					tToggle : $('#cmsms_composer_toggle').attr('title'), 
					tTour : $('#cmsms_composer_tour').attr('title'), 
					tPrice : $('#cmsms_composer_price').attr('title'), 
					tStat : $('#cmsms_composer_stat').attr('title'), 
					tVEmbed : $('#cmsms_composer_video_embed').attr('title'), 
					tVHTML5 : $('#cmsms_composer_video_html5').attr('title'), 
					tVSingle : $('#cmsms_composer_video_single').attr('title'), 
					tVMulti : $('#cmsms_composer_video_multi').attr('title'), 
					tAHTML5 : $('#cmsms_composer_audio_html5').attr('title'), 
					tASingle : $('#cmsms_composer_audio_single').attr('title'), 
					tAMulti : $('#cmsms_composer_audio_multi').attr('title'), 
					tPost : $('#cmsms_composer_post').attr('title'), 
					tSlider : $('#cmsms_composer_slider').attr('title'), 
					tClients : $('#cmsms_composer_clients').attr('title'), 
					tMap : $('#cmsms_composer_map').attr('title'), 
					tEmail : $('#cmsms_composer_email').attr('title') 
				};
			
			
			if (cfFolder === 'divider' && cfType === 'clear') {
				cfTitle = tTitles.tClear;
			} else if (cfFolder === 'divider') {
				cfTitle = tTitles.tDivider;
			} else if (cfFolder === 'text') {
				cfTitle = tTitles.tText;
			} else if (cfFolder === 'box' && cfType === 'block') {
				cfTitle = tTitles.tBlock;
			} else if (cfFolder === 'box' && cfType === 'color') {
				cfTitle = tTitles.tColor;
			} else if (cfFolder === 'box') {
				cfTitle = tTitles.tBox;
			} else if (cfFolder === 'person') {
				cfTitle = tTitles.tPerson;
			} else if (cfFolder === 'tab' && cfType === 'toggle') {
				cfTitle = tTitles.tToggle;
			} else if (cfFolder === 'tab' && cfType === 'tour') {
				cfTitle = tTitles.tTour;
			} else if (cfFolder === 'tab') {
				cfTitle = tTitles.tTab;
			} else if (cfFolder === 'price') {
				cfTitle = tTitles.tPrice;
			} else if (cfFolder === 'stat') {
				cfTitle = tTitles.tStat;
			} else if (cfFolder === 'video' && cfType === 'embed') {
				cfTitle = tTitles.tVEmbed;
			} else if (cfFolder === 'video' && cfType === 'html5') {
				cfTitle = tTitles.tVHTML5;
			} else if (cfFolder === 'video' && cfType === 'single') {
				cfTitle = tTitles.tVSingle;
			} else if (cfFolder === 'video' && cfType === 'multiple') {
				cfTitle = tTitles.tVMulti;
			} else if (cfFolder === 'audio' && cfType === 'html5') {
				cfTitle = tTitles.tAHTML5;
			} else if (cfFolder === 'audio' && cfType === 'single') {
				cfTitle = tTitles.tASingle;
			} else if (cfFolder === 'audio' && cfType === 'multiple') {
				cfTitle = tTitles.tAMulti;
			} else if (cfFolder === 'post') {
				cfTitle = tTitles.tPost;
			} else if (cfFolder === 'slider') {
				cfTitle = tTitles.tSlider;
			} else if (cfFolder === 'clients') {
				cfTitle = tTitles.tClients;
			} else if (cfFolder === 'map') {
				cfTitle = tTitles.tMap;
			} else if (cfFolder === 'email') {
				cfTitle = tTitles.tEmail;
			} else {
				cfTitle = tTitles.tColumn;
			}
			
			
			return cfTitle;
		}
		
		
		
		// Set Composer First Column of Row
		function setComposerFirstColumnOfRow() { 
			var columns = $('#cmsms_composer_content > div'), 
				rowWidthNumb = 0;
			
			
			columns.removeClass('first_column');
			
			
			columns.each(function () { 
				var colWidthClass = $(this).attr('class').split(' ');
				
				
				if (colWidthClass[0] === 'one_first') {
					colWidthNumb = 1;
				} else if (colWidthClass[0] === 'five_sixth') {
					colWidthNumb = 0.84;
				} else if (colWidthClass[0] === 'four_fifth') {
					colWidthNumb = 0.8;
				} else if (colWidthClass[0] === 'three_fourth') {
					colWidthNumb = 0.75;
				} else if (colWidthClass[0] === 'two_third') {
					colWidthNumb = 0.66;
				} else if (colWidthClass[0] === 'three_fifth') {
					colWidthNumb = 0.6;
				} else if (colWidthClass[0] === 'one_half') {
					colWidthNumb = 0.5;
				} else if (colWidthClass[0] === 'two_fifth') {
					colWidthNumb = 0.4;
				} else if (colWidthClass[0] === 'one_third') {
					colWidthNumb = 0.33;
				} else if (colWidthClass[0] === 'one_fourth') {
					colWidthNumb = 0.25;
				} else if (colWidthClass[0] === 'one_fifth') {
					colWidthNumb = 0.2;
				} else if (colWidthClass[0] === 'one_sixth') {
					colWidthNumb = 0.16;
				}
				
				
				rowWidthNumb = rowWidthNumb + colWidthNumb;
				
				
				if (colWidthNumb === 1) {
					$(this).addClass('first_column');
					
					
					$(this).next().addClass('first_column');
					
					
					rowWidthNumb = 0;
				} else if (rowWidthNumb > 1) {
					$(this).addClass('first_column');
					
					
					rowWidthNumb = colWidthNumb;
				} else if (rowWidthNumb < 1 && (rowWidthNumb + 0.16) > 1) {
					$(this).next().addClass('first_column');
					
					
					rowWidthNumb = 0;
				}
			} );
			
			
			columns.first().addClass('first_column');
		}
		
		
		
		// Start Composer Columns Droppable & Sortable
		function startComposerColumnsDroppable() { 
			$('#cmsms_composer_content > div > .cmsms_composer_column_elements').droppable( { 
				accept : ':not(.ui-sortable-helper)', 
				drop : function (event, ui) { 
					var dFolder = ui.draggable.attr('data-folder'), 
						dType = ui.draggable.attr('data-type'), 
						dTitle = ui.draggable.attr('title'), 
						composerDeleteText = $('#cmsms_composer_delete_text').val(), 
						composerEditText = $('#cmsms_composer_edit_text').val(), 
						composerCheckDividerText = $('#cmsms_composer_check_divider_text').val(), 
						composerCopyText = $('#cmsms_composer_copy_text').val();
					
					
					if (dFolder === 'divider') {
						ui.draggable.html('<div class="one_first">' + 
							'<div class="cmsms_composer_column_head">' + 
								'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_delete" title="' + composerDeleteText + '">' + composerDeleteText + '</a>' + 
								'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_check' + ((dType === 'divider') ? ' checked' : '') + '" title="' + composerCheckDividerText + '">' + composerCheckDividerText + '</a>' + 
								'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_copy" title="' + composerCopyText + '">' + composerCopyText + '</a>' + 
								'<span class="cmsms_composer_column_title">' + dTitle + '</span>' + 
							'</div>' + 
							'<div class="cmsms_composer_column_content" data-folder="' + dFolder + '" data-type="' + dType + '">' + 
								'<div class="' + ((dType === 'divider') ? 'divider' : 'cl') + '"></div>' + 
							'</div>' + 
						'</div>');
					} else {
						ui.draggable.html('<div class="one_first">' + 
							'<div class="cmsms_composer_column_head">' + 
								'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_delete" title="' + composerDeleteText + '">' + composerDeleteText + '</a>' + 
								'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_edit" title="' + composerEditText + '">' + composerEditText + '</a>' + 
								'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_copy" title="' + composerCopyText + '">' + composerCopyText + '</a>' + 
								'<span class="cmsms_composer_column_title">' + dTitle + '</span>' + 
							'</div>' + 
							'<div class="cmsms_composer_column_content" data-folder="' + dFolder + '" data-type="' + dType + '"></div>' + 
						'</div>');
					}
					
					
					setTimeout(function () { 
						ui.draggable.find('.cmsms_composer_column_head').parent().unwrap('a.button');
					}, 100);
				} 
			} ).sortable( { 
				cursor : 'move', 
				connectWith : '.cmsms_composer_column_elements', 
				update : function () { 
					setTimeout(function () { 
						updateComposerContent();
					}, 150);
				} 
			} );
		}
		
		
		
		// Update Composer Content Area Function
		function updateComposerContent() { 
			var newValDivs = $('#cmsms_composer_content > div'), 
				newPostContent = '';
			
			
			for (var i = 0, ilength = newValDivs.length; i < ilength; i += 1) {
				var cClass = newValDivs.eq(i).attr('class'), 
					cFolder = (newValDivs.eq(i).find('> .cmsms_composer_column_elements').attr('data-folder')) ? newValDivs.eq(i).find('> .cmsms_composer_column_elements').attr('data-folder') : 'column', 
					cType = (newValDivs.eq(i).find('> .cmsms_composer_column_elements').attr('data-type')) ? newValDivs.eq(i).find('> .cmsms_composer_column_elements').attr('data-type') : '', 
					cElements = newValDivs.eq(i).find('> .cmsms_composer_column_elements > div'), 
					newPostElementContent = '';
				
				
				if (cFolder !== 'divider' && cElements.length > 0) {
					for (var j = 0, jlength = cElements.length; j < jlength; j += 1) {
						var ceFolder = (cElements.eq(j).find('> .cmsms_composer_column_content').attr('data-folder')) ? cElements.eq(j).find('> .cmsms_composer_column_content').attr('data-folder') : 'column', 
							ceType = (cElements.eq(j).find('> .cmsms_composer_column_content').attr('data-type')) ? cElements.eq(j).find('> .cmsms_composer_column_content').attr('data-type') : '', 
							ceContent = cElements.eq(j).find('> .cmsms_composer_column_content').html();
						
						
						newPostElementContent += '<div data-folder="' + ceFolder + '" data-type="' + ceType + '">' + ceContent + '</div>';
					}
				}
				
				
				if (cFolder !== 'divider') {
					newPostContent += '<div class="' + cClass + '" data-folder="' + cFolder + '" data-type="' + cType + '">' + newPostElementContent + '</div>';
				} else {
					newPostContent += '<div class="' + cClass + '" data-folder="' + cFolder + '" data-type="' + cType + '">' + '<div class="' + ((cType === 'divider') ? 'divider' : 'cl') + '"></div>' + '</div>';
				}
			}
			
			
			$('#cmsms_content_composer_text').text(encodeURIComponent(newPostContent));
		}
		
		
		
		// Add Column/Divider to Composer
		$('.cmsms_composer_buttons_container > .cmsms_composer_buttons_container_wrap1 > a.button').bind('click', function () { 
			var cClass = $(this).attr('data-width'), 
				cFolder = ($(this).attr('data-folder')) ? $(this).attr('data-folder') : 'column', 
				cType = ($(this).attr('data-type')) ? $(this).attr('data-type') : '', 
				cTitle = $(this).attr('title'), 
				cWidth = undefined, 
				composerPlusText = $('#cmsms_composer_plus_text').val(), 
				composerMinusText = $('#cmsms_composer_minus_text').val(), 
				composerDeleteText = $('#cmsms_composer_delete_text').val(), 
				composerCheckColumnText = $('#cmsms_composer_check_column_text').val(), 
				composerCheckDividerText = $('#cmsms_composer_check_divider_text').val(), 
				composerCopyText = $('#cmsms_composer_copy_text').val();
			
			
			cWidth = setComposerSHcWidth(cClass);
			
			
			if (cFolder === 'divider') {
				$('#cmsms_composer_content').append('<div class="one_first">' + 
					'<div class="cmsms_composer_column_head">' + 
						'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_delete" title="' + composerDeleteText + '">' + composerDeleteText + '</a>' + 
						'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_check' + ((cType === 'divider') ? ' checked' : '') + '" title="' + composerCheckDividerText + '">' + composerCheckDividerText + '</a>' + 
						'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_copy" title="' + composerCopyText + '">' + composerCopyText + '</a>' + 
						'<span class="cmsms_composer_column_title">' + cTitle + '</span>' + 
					'</div>' + 
					'<div class="cmsms_composer_column_elements" data-folder="' + cFolder + '" data-type="' + cType + '">' + 
						'<div class="' + ((cType === 'divider') ? 'divider' : 'cl') + '"></div>' + 
					'</div>' + 
				'</div>');
			} else {
				$('#cmsms_composer_content').append('<div class="' + cClass + '">' + 
					'<div class="cmsms_composer_column_head">' + 
						'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_delete" title="' + composerDeleteText + '">' + composerDeleteText + '</a>' + 
						'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_arrow" title="' + composerCheckColumnText + '">' + composerCheckColumnText + '</a>' + 
						'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_copy" title="' + composerCopyText + '">' + composerCopyText + '</a>' + 
						'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_plus" title="' + composerPlusText + '">' + composerCopyText + '</a>' + 
						'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_minus" title="' + composerMinusText + '">' + composerCopyText + '</a>' + 
						'<span class="cmsms_composer_column_width">' + cWidth + '</span>' + 
						'<span class="cmsms_composer_column_title">' + cTitle + '</span>' + 
					'</div>' + 
					'<div class="cmsms_composer_column_elements" data-folder="' + cFolder + '" data-type="' + cType + '"></div>' + 
				'</div>');
			}
			
			
			startComposerColumnsDroppable();
			
			
			setComposerFirstColumnOfRow();
			
			
			$('#cmsms_content_composer_text').append(escape('<div class="' + cClass + '" data-folder="' + cFolder + '" data-type="' + cType + '">' + 
				((cFolder === 'divider') ? '<div class="' + ((cType === 'divider') ? 'divider' : 'cl') + '"></div>' : '') + 
			'</div>'));
			
			
			return false;
		} );
		
		
		
		// Add Shortcode to Composer Columns
		$('.cmsms_composer_buttons_container > .cmsms_composer_buttons_container_wrap2 > a.button').bind('click', function () { 
			var cFolder = ($(this).attr('data-folder')) ? $(this).attr('data-folder') : 'divider', 
				cType = ($(this).attr('data-type')) ? $(this).attr('data-type') : '', 
				cTitle = $(this).attr('title'), 
				composerPlusText = $('#cmsms_composer_plus_text').val(), 
				composerMinusText = $('#cmsms_composer_minus_text').val(), 
				composerDeleteText = $('#cmsms_composer_delete_text').val(), 
				composerEditText = $('#cmsms_composer_edit_text').val(), 
				composerCheckColumnText = $('#cmsms_composer_check_column_text').val(), 
				composerCheckDividerText = $('#cmsms_composer_check_divider_text').val(), 
				composerCopyText = $('#cmsms_composer_copy_text').val(), 
				composerShortcode = undefined;
			
			
			if (cFolder === 'divider') {
				composerShortcode = '<div class="one_first">' + 
					'<div class="cmsms_composer_column_head">' + 
						'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_delete" title="' + composerDeleteText + '">' + composerDeleteText + '</a>' + 
						'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_check' + ((cType === 'divider') ? ' checked' : '') + '" title="' + composerCheckDividerText + '">' + composerCheckDividerText + '</a>' + 
						'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_copy" title="' + composerCopyText + '">' + composerCopyText + '</a>' + 
						'<span class="cmsms_composer_column_title">' + cTitle + '</span>' + 
					'</div>' + 
					'<div class="cmsms_composer_column_content" data-folder="' + cFolder + '" data-type="' + cType + '">' + 
						'<div class="' + ((cType === 'divider') ? 'divider' : 'cl') + '"></div>' + 
					'</div>' + 
				'</div>';
			} else {
				composerShortcode = '<div class="one_first">' + 
					'<div class="cmsms_composer_column_head">' + 
						'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_delete" title="' + composerDeleteText + '">' + composerDeleteText + '</a>' + 
						'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_edit" title="' + composerEditText + '">' + composerEditText + '</a>' + 
						'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_copy" title="' + composerCopyText + '">' + composerCopyText + '</a>' + 
						'<span class="cmsms_composer_column_title">' + cTitle + '</span>' + 
					'</div>' + 
					'<div class="cmsms_composer_column_content" data-folder="' + cFolder + '" data-type="' + cType + '"></div>' + 
				'</div>';
			}
			
			
			$('#cmsms_composer_content').append('<div class="one_first">' + 
				'<div class="cmsms_composer_column_head">' + 
					'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_delete" title="' + composerDeleteText + '">' + composerDeleteText + '</a>' + 
					'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_arrow" title="' + composerCheckColumnText + '">' + composerCheckColumnText + '</a>' + 
					'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_copy" title="' + composerCopyText + '">' + composerCopyText + '</a>' + 
					'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_plus" title="' + composerPlusText + '">' + composerCopyText + '</a>' + 
					'<a href="#" class="cmsms_composer_column_button cmsms_composer_column_minus" title="' + composerMinusText + '">' + composerCopyText + '</a>' + 
					'<span class="cmsms_composer_column_width">1/1</span>' + 
					'<span class="cmsms_composer_column_title">' + setComposerSHcTitle('column', '') + '</span>' + 
				'</div>' + 
				'<div class="cmsms_composer_column_elements" data-folder="column" data-type="">' + composerShortcode + '</div>' + 
			'</div>');
			
			
			startComposerColumnsDroppable();
			
			
			setComposerFirstColumnOfRow();
			
			
			$('#cmsms_content_composer_text').append(escape('<div class="one_first" data-folder="column" data-type="">' + 
				'<div class="one_first" data-folder="' + cFolder + '" data-type="' + cType + '">' + 
					((cFolder === 'divider') ? '<div class="' + ((cType === 'divider') ? 'divider' : 'cl') + '"></div>' : '') + 
				'</div>' + 
			'</div>'));
			
			
			return false;
		} );
		
		
		
		// Make Composer Column Wider
		$('#cmsms_composer_content').delegate('a.cmsms_composer_column_plus', 'click', function () { 
			var column = $(this).parent().parent(), 
				cClass = column.attr('class'), 
				cClassArray = cClass.split(' '), 
				newColumnClass = cClassArray[0], 
				cWidth = $(this).parent().find('.cmsms_composer_column_width').text();
			
			
			if (cClassArray[0] === 'one_sixth') {
				newColumnClass = 'one_fifth';
				
				cWidth = '1/5';
			} else if (cClassArray[0] === 'one_fifth') {
				newColumnClass = 'one_fourth';
				
				cWidth = '1/4';
			} else if (cClassArray[0] === 'one_fourth') {
				newColumnClass = 'one_third';
				
				cWidth = '1/3';
			} else if (cClassArray[0] === 'one_third') {
				newColumnClass = 'two_fifth';
				
				cWidth = '2/5';
			} else if (cClassArray[0] === 'two_fifth') {
				newColumnClass = 'one_half';
				
				cWidth = '1/2';
			} else if (cClassArray[0] === 'one_half') {
				newColumnClass = 'three_fifth';
				
				cWidth = '3/5';
			} else if (cClassArray[0] === 'three_fifth') {
				newColumnClass = 'two_third';
				
				cWidth = '2/3';
			} else if (cClassArray[0] === 'two_third') {
				newColumnClass = 'three_fourth';
				
				cWidth = '3/4';
			} else if (cClassArray[0] === 'three_fourth') {
				newColumnClass = 'four_fifth';
				
				cWidth = '4/5';
			} else if (cClassArray[0] === 'four_fifth') {
				newColumnClass = 'five_sixth';
				
				cWidth = '5/6';
			} else if (cClassArray[0] === 'five_sixth') {
				newColumnClass = 'one_first';
				
				cWidth = '1/1';
			}
			
			
			column.attr('class', newColumnClass + ((cClassArray[1] !== undefined) ? ' ' + cClassArray[1] : '') + ((cClassArray[2] !== undefined) ? ' ' + cClassArray[2] : ''));
			
			
			column.find('.cmsms_composer_column_width').text(cWidth);
			
			
			setComposerFirstColumnOfRow();
			
			
			updateComposerContent();
			
			
			return false;
		} );
		
		
		
		// Make Composer Column Narrower
		$('#cmsms_composer_content').delegate('a.cmsms_composer_column_minus', 'click', function () { 
			var column = $(this).parent().parent(), 
				cClass = column.attr('class'), 
				cClassArray = cClass.split(' '), 
				newColumnClass = cClassArray[0], 
				cWidth = $(this).parent().find('.cmsms_composer_column_width').text();
			
			
			if (cClassArray[0] === 'one_first') {
				newColumnClass = 'five_sixth';
				
				cWidth = '5/6';
			} else if (cClassArray[0] === 'five_sixth') {
				newColumnClass = 'four_fifth';
				
				cWidth = '4/5';
			} else if (cClassArray[0] === 'four_fifth') {
				newColumnClass = 'three_fourth';
				
				cWidth = '3/4';
			} else if (cClassArray[0] === 'three_fourth') {
				newColumnClass = 'two_third';
				
				cWidth = '2/3';
			} else if (cClassArray[0] === 'two_third') {
				newColumnClass = 'three_fifth';
				
				cWidth = '3/5';
			} else if (cClassArray[0] === 'three_fifth') {
				newColumnClass = 'one_half';
				
				cWidth = '1/2';
			} else if (cClassArray[0] === 'one_half') {
				newColumnClass = 'two_fifth';
				
				cWidth = '2/5';
			} else if (cClassArray[0] === 'two_fifth') {
				newColumnClass = 'one_third';
				
				cWidth = '1/3';
			} else if (cClassArray[0] === 'one_third') {
				newColumnClass = 'one_fourth';
				
				cWidth = '1/4';
			} else if (cClassArray[0] === 'one_fourth') {
				newColumnClass = 'one_fifth';
				
				cWidth = '1/5';
			} else if (cClassArray[0] === 'one_fifth') {
				newColumnClass = 'one_sixth';
				
				cWidth = '1/6';
			}
			
			
			column.attr('class', newColumnClass + ((cClassArray[1] !== undefined) ? ' ' + cClassArray[1] : '') + ((cClassArray[2] !== undefined) ? ' ' + cClassArray[2] : ''));
			
			
			column.find('.cmsms_composer_column_width').text(cWidth);
			
			
			setComposerFirstColumnOfRow();
			
			
			updateComposerContent();
			
			
			return false;
		} );
		
		
		
		// Delete Composer Element
		$('#cmsms_composer_content').delegate('a.cmsms_composer_column_delete', 'click', function () { 
			var column = $(this).parent().parent(), 
				questionText = $('#cmsms_composer_del_question').val(), 
				question = confirm(questionText);
			
			
			if (question) {
				column.remove();
				
				
				setComposerFirstColumnOfRow();
				
				
				updateComposerContent();
			}
			
			
			return false;
		} );
		
		
		
		// Edit Composer Shortcode
		$('#cmsms_composer_content').delegate('a.cmsms_composer_column_edit', 'click', function () { 
			var column = $(this).parent().parent(), 
				cIndex = column.parent().parent().index(), 
				shcIndex = column.index(), 
				cClass = column.attr('class'), 
				cFolder = (column.find('> div.cmsms_composer_column_content').attr('data-folder')) ? column.find('> div.cmsms_composer_column_content').attr('data-folder') : 'column', 
				cType = (column.find('> div.cmsms_composer_column_content').attr('data-type')) ? column.find('> div.cmsms_composer_column_content').attr('data-type') : '', 
				cContent = column.find('> div.cmsms_composer_column_content').html(), 
				cTitle = column.find('> div.cmsms_composer_column_head > span.cmsms_composer_column_title').text(), 
				composerSHCodeText = $('#cmsms_composer_shortcode_text').val(), 
				composerUrl = $('#cmsms_composer_url').val();
			
			
			tb_show(cTitle + ' ' + composerSHCodeText, '#TB_inline');
			
			
			jQuery('#TB_ajaxContent').load(composerUrl + '/framework/admin/composer/inc/' + cFolder + '/composer_popup.php', { 
				index : cIndex + '|' + shcIndex, 
				content : encodeURIComponent(cContent), 
				type : ((cType !== '') ? cType : '') 
			} );
			
			
			jQuery('#TB_ajaxContent').css( { 
				width : jQuery('#TB_ajaxContent').parent().width() - 30, 
				height : jQuery('#TB_ajaxContent').parent().height() - 47 
			} );
			
			
			return false;
		} );
		
		
		
		// Change Composer Column Align
		$('#cmsms_composer_content').delegate('a.cmsms_composer_column_arrow', 'click', function () { 
			var column = $(this).parent().parent(), 
				cClass = column.attr('class'), 
				cClassArray = cClass.split(' '), 
				composerDeleteText = $('#cmsms_composer_delete_text').val(), 
				composerCheckDividerText = $('#cmsms_composer_check_divider_text').val(), 
				composerCopyText = $('#cmsms_composer_copy_text').val();
			
			
			if (cClassArray.indexOf('right_column') !== -1) {
				column.removeClass('right_column').find('> div.cmsms_composer_column_head > a.cmsms_composer_column_arrow').removeClass('checked');
			} else {
				column.addClass('right_column').find('> div.cmsms_composer_column_head > a.cmsms_composer_column_arrow').addClass('checked');
			}
			
			
			updateComposerContent();
			
			
			return false;
		} );
		
		
		
		// Change Composer Divider Type
		$('#cmsms_composer_content').delegate('a.cmsms_composer_column_check', 'click', function () { 
			var column = $(this).parent().parent(), 
				cType = (column.find('> div:eq(1)').attr('data-type')) ? column.find('> div:eq(1)').attr('data-type') : '', 
				cElementTitle = undefined;
			
			
			if (cType === 'divider') {
				cElementTitle = setComposerSHcTitle('divider', 'clear');
				
				
				column.find('> div.cmsms_composer_column_head > a.cmsms_composer_column_check').removeClass('checked');
				
				
				column.find('> div:eq(1)').attr('data-type', 'clear').html('<div class="cl"></div>');
			} else {
				cElementTitle = setComposerSHcTitle('divider', 'divider');
				
				
				column.find('> div.cmsms_composer_column_head > a.cmsms_composer_column_check').addClass('checked');
				
				
				column.find('> div:eq(1)').attr('data-type', 'divider').html('<div class="divider"></div>');
			}
			
			
			column.find('> div.cmsms_composer_column_head > span.cmsms_composer_column_title').text(cElementTitle);
			
			
			updateComposerContent();
			
			
			return false;
		} );
		
		
		
		// Copy Composer Element
		$('#cmsms_composer_content').delegate('a.cmsms_composer_column_copy', 'click', function () { 
			var column = $(this).parent().parent(), 
				columnClone = column.clone();
			
			
			column.after(columnClone);
			
			
			setComposerFirstColumnOfRow();
			
			
			updateComposerContent();
			
			
			return false;
		} );
		
		
		
		// Clear Composer Content
		$('#cmsms_clear_content').bind('click', function () { 
			var questionText = $('#cmsms_composer_clear_question').val(), 
				question = confirm(questionText);
			
			
			if (question) {
				$('#cmsms_composer_content').empty();
				
				
				$('#cmsms_content_composer_text').text('');
			}
			
			
			return false;
		} );
		
		
		
		// Create New Content Template
		$('#cmsms_pattern_save').bind('click', function () { 
			var composerUrl = $('#cmsms_composer_url').val(), 
				newContent = $('#cmsms_composer_content').html(), 
				questionText = $('#cmsms_template_save_question').val(), 
				alertText = $('#cmsms_template_save_alert').val(), 
				newName = prompt(questionText);
			
			
			if (newName !== '' && newName !== ' ') {
				$.post(composerUrl + '/framework/admin/composer/inc/template_operator.php', { 
					type : 'add', 
					name : newName, 
					content : newContent 
				}, function (data) { 
					$('#cmsms_pattern_list').append(data);
					
					
					$('#cmsms_composer_message_saved').fadeIn(100).delay(1000).fadeOut(100);
				}, 'text');
			} else {
				alert(alertText);
			}
			
			
			return false;
		} );
		
		
		
		// Load Content Template
		$('#cmsms_pattern_load').bind('click', function () { 
			var composerUrl = $('#cmsms_composer_url').val(), 
				optionID = $('#cmsms_pattern_list').val(), 
				newID = optionID.replace('cmsms_template_', ''), 
				alertText = $('#cmsms_template_list_alert').val();
			
			
			if (newID !== '') {
				$.post(composerUrl + '/framework/admin/composer/inc/template_operator.php', { 
					type : 'load', 
					id : newID 
				}, function (data) { 
					$('#cmsms_composer_content').append(data);
					
					
					setComposerFirstColumnOfRow();
					
					
					updateComposerContent();
					
					
					startComposerColumnsDroppable();
					
					
					$('#cmsms_composer_message_added').fadeIn(100).delay(1000).fadeOut(100);
				}, 'text');
			} else {
				alert(alertText);
			}
			
			
			return false;
		} );
		
		
		
		// Delete Content Template
		$('#cmsms_pattern_delete').bind('click', function () { 
			var composerUrl = $('#cmsms_composer_url').val(), 
				optionID = $('#cmsms_pattern_list').val(), 
				newID = optionID.replace('cmsms_template_', ''), 
				questionText = $('#cmsms_template_del_question').val(), 
				question = confirm(questionText), 
				alertText = $('#cmsms_template_list_alert').val();
			
			
			if (question && newID !== '') {
				$.post(composerUrl + '/framework/admin/composer/inc/template_operator.php', { 
					type : 'del', 
					id : newID 
				}, function (id) { 
					$('#cmsms_pattern_list').find('> option[value="cmsms_template_' + id + '"]').remove();
					
					
					$('#cmsms_composer_message_deleted').fadeIn(100).delay(1000).fadeOut(100);
				}, 'text');
			} else {
				alert(alertText);
			}
			
			
			return false;
		} );
	} )(jQuery);
} );

