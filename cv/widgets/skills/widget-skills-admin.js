			function initSkills() {
				var added = false;
				jQuery('#widgets-right .widget_skills .color input').each(function() {
					var obj = jQuery(this);
					if (!obj.hasClass('colored') && obj.attr('id').indexOf('__i__') < 0) {
						obj.addClass('colored');
						setColorPicker(jQuery(this).attr('id'));
						if (!added) {
							obj.parents('.widget_skills').find('.add_skills').click(addSkills);
							added = true;
						}
					}
				});
			}
			function addSkills(e) {
				var skills_data = jQuery(this).parents('.widget_skills').find('.skills_data').eq(0);
				var title_1 = skills_data.find('.skills_row .title input').eq(0);
				var id_title_1 = title_1.attr('id');
				var name_title_1 = title_1.attr('name');
				var level_1 = skills_data.find('.skills_row .level input').eq(0);
				var id_level_1 = level_1.attr('id');
				var name_level_1 = level_1.attr('name');
				var color_1 = skills_data.find('.skills_row .color input').eq(0);
				var id_color_1 = color_1.attr('id');
				var name_color_1 = color_1.attr('name');
				var skills_cnt = skills_data.find('.skills_row').length + 1;
				var pos = id_title_1.indexOf('title_1');
				var id_t = id_title_1.substring(0, pos) + 'title_' + skills_cnt + id_title_1.substring(pos+7);
				pos = name_title_1.indexOf('title_1');
				var name_t = name_title_1.substring(0, pos) + 'title_' + skills_cnt + name_title_1.substring(pos+7);
				pos = id_level_1.indexOf('level_1');
				var id_l = id_level_1.substring(0, pos) + 'level_' + skills_cnt + id_level_1.substring(pos+7);
				pos = name_level_1.indexOf('level_1');
				var name_l = name_level_1.substring(0, pos) + 'level_' + skills_cnt + name_level_1.substring(pos+7);
				pos = id_color_1.indexOf('color_1');
				var id_c = id_color_1.substring(0, pos) + 'color_' + skills_cnt + id_color_1.substring(pos+7);
				pos = name_color_1.indexOf('color_1');
				var name_c = name_color_1.substring(0, pos) + 'color_' + skills_cnt + name_color_1.substring(pos+7);
				skills_data.append(
					'<div class="skills_row">'
					+ '<p class="title">'
					+ (skills_cnt == 1 ? '<label for="' + id_t + '">Skill Title:</label>' : '')
					+ '<input id="' + id_t + '" name="' + name_t + '" value="" />'
					+ '</p>'
					+ '<p class="level">'
					+ (skills_cnt == 1 ? '<label for="' + id_l + '">Level:</label>' : '')
					+ '<input id="' + id_l + '" name="' + name_l + '" value="" />%'
					+ '</p>'
					+ '<p class="color">'
					+ (skills_cnt == 1 ? '<label>Color:</label>' : '')
					+ '<input id="' + id_c + '" name="' + name_c + '" value="" class="iColorPicker colored" />'
					+ '</p>'
					+ '<div>'
				);
				setColorPicker(id_c);
				e.preventDefault();
				return false;			
			}
			
			function setColorPicker(id) {
				jQuery('#'+id).ColorPicker({
					color: jQuery('#'+id).val(),
					onShow: function (colpkr) {
						jQuery(colpkr).fadeIn(500);
						return false;
					},
					onHide: function (colpkr) {
						jQuery(colpkr).fadeOut(500);
						return false;
					},
					onChange: function (hsb, hex, rgb) {
						jQuery('#'+id).css('backgroundColor', '#' + hex).val('#' + hex);
					}
				});
			}
