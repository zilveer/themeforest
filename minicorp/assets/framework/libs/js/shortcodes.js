(function() {

	tinymce.create('tinymce.plugins.ishyoboy_shortcodes_select', {

		init: function(d, e) {
			d.onNodeChange.add(function (a, c) {
				c.setDisabled("scn_button", a.selection.getContent().length > 0)
			})
		},

		createControl: function (d, e) {

            if (d == "ishyoboy_columns_shortcodes") {
                d = e.createMenuButton("ishyoboy_columns_shortcodes", {
                    title: "Columns Shortcode",
                    image: ishyoboy_globals.IYB_FRAMEWORK_URI + "/images/icon-columns.png",
                    icons: false
                });
                var a = this;

                d.onRenderMenu.add(function (c, b) {

	                // Row *********************************************************************************************
                    a.addPair(b, 'Row', 'row', {}, '<p>Enter your content here.</p>');



	                // Columns *****************************************************************************************
                    c = b.addMenu({
                        title: "Default"
                    });

                        a.addPair(c, 'One full', 'one_full');
                        a.addPair(c, 'One half', 'one_half');
                        a.addPair(c, 'One third', 'one_third');
                        a.addPair(c, 'One fourth', 'one_fourth');
                        a.addPair(c, 'One sixth', 'one_sixth');
                        a.addPair(c, 'Two thirds', 'two_thirds');
                        a.addPair(c, 'Three fourths', 'three_fourths');

                        c.addSeparator();

                        d = c.addMenu({
                            title: 'Nested 1'
                        });

                            a.addPair(d, 'One full', 'one_full_nested1');
                            a.addPair(d, 'One half', 'one_half_nested1');
                            a.addPair(d, 'One third', 'one_third_nested1');
                            a.addPair(d, 'One fourth', 'one_fourth_nested1');
                            a.addPair(d, 'One sixth', 'one_sixth_nested1');
                            a.addPair(d, 'Two thirds', 'two_thirds_nested1');
                            a.addPair(d, 'Three fourths', 'three_fourths_nested1');

                        d = c.addMenu({
                            title: 'Nested 2'
                        });

                            a.addPair(d, 'One full', 'one_full_nested2');
                            a.addPair(d, 'One half', 'one_half_nested2');
                            a.addPair(d, 'One third', 'one_third_nested2');
                            a.addPair(d, 'One fourth', 'one_fourth_nested2');
                            a.addPair(d, 'One sixth', 'one_sixth_nested2');
                            a.addPair(d, 'Two thirds', 'two_thirds_nested2');
                            a.addPair(d, 'Three fourths', 'three_fourths_nested2');

                        d = c.addMenu({
                            title: 'Nested 3'
                        });

                            a.addPair(d, 'One full', 'one_full_nested3');
                            a.addPair(d, 'One half', 'one_half_nested3');
                            a.addPair(d, 'One third', 'one_third_nested3');
                            a.addPair(d, 'One fourth', 'one_fourth_nested3');
                            a.addPair(d, 'One sixth', 'one_sixth_nested3');
                            a.addPair(d, 'Two thirds', 'two_thirds_nested3');
                            a.addPair(d, 'Three fourths', 'three_fourths_nested3');

                    c = b.addMenu({
                        title: "Advanced"
                    });

                        a.addPair(c, 'Grid 1', 'grid1');
                        a.addPair(c, 'Grid 2', 'grid2');
                        a.addPair(c, 'Grid 3', 'grid3');
                        a.addPair(c, 'Grid 4', 'grid4');
                        a.addPair(c, 'Grid 5', 'grid5');
                        a.addPair(c, 'Grid 6', 'grid6');
                        a.addPair(c, 'Grid 7', 'grid7');
                        a.addPair(c, 'Grid 8', 'grid8');
                        a.addPair(c, 'Grid 9', 'grid9');
                        a.addPair(c, 'Grid 10', 'grid10');
                        a.addPair(c, 'Grid 11', 'grid11');
                        a.addPair(c, 'Grid 12', 'grid12');

                    c = b.addMenu({
                        title: "Predefined Rows"
                    });

                        var ish_sc_content =
                            '<p>[row]</p>'+
                                '<p>[one_full]</p>'+
                                '<p>[/one_full]</p>'+
                            '<p>[/row]</p>';
                        a.addFree(c, 'Row full', ish_sc_content );

                        var ish_sc_content =
                            '<p>[row]</p>'+
                                '<p>[one_half]</p>'+
                                '<p>[/one_half]</p>'+
                                '<p>[one_half]</p>'+
                                '<p>[/one_half]</p>'+
                            '<p>[/row]</p>';
                        a.addFree(c, 'Row halfs', ish_sc_content );

                        var ish_sc_content =
                            '<p>[row]</p>'+
                                '<p>[one_third]</p>'+
                                '<p>[/one_third]</p>'+
                                '<p>[one_third]</p>'+
                                '<p>[/one_third]</p>'+
                                '<p>[one_third]</p>'+
                                '<p>[/one_third]</p>'+
                            '<p>[/row]</p>';
                        a.addFree(c, 'Row thirds', ish_sc_content );

                        var ish_sc_content =
                            '<p>[row]</p>'+
                                '<p>[one_fourth]</p>'+
                                '<p>[/one_fourth]</p>'+
                                '<p>[one_fourth]</p>'+
                                '<p>[/one_fourth]</p>'+
                                '<p>[one_fourth]</p>'+
                                '<p>[/one_fourth]</p>'+
                                '<p>[one_fourth]</p>'+
                                '<p>[/one_fourth]</p>'+
                            '<p>[/row]</p>';
                        a.addFree(c, 'Row fourths', ish_sc_content );

                        var ish_sc_content =
                            '<p>[row]</p>'+
                                '<p>[one_sixth]</p>'+
                                '<p>[/one_sixth]</p>'+
                                '<p>[one_sixth]</p>'+
                                '<p>[/one_sixth]</p>'+
                                '<p>[one_sixth]</p>'+
                                '<p>[/one_sixth]</p>'+
                                '<p>[one_sixth]</p>'+
                                '<p>[/one_sixth]</p>'+
                                '<p>[one_sixth]</p>'+
                                '<p>[/one_sixth]</p>'+
                                '<p>[one_sixth]</p>'+
                                '<p>[/one_sixth]</p>'+
                            '<p>[/row]</p>';
                        a.addFree(c, 'Row sixths', ish_sc_content );



	                b.addSeparator();



	                // Divider & Separator *****************************************************************************
	                a.addSingle(b, 'Divider', 'divider', {});
                    a.addSingle(b, 'Separator', 'separator');

                });

                return d
            }

            if (d == "ishyoboy_typography_shortcodes") {
                d = e.createMenuButton("ishyoboy_typography_shortcodes", {
                    title: "Typography Shortcodes",
                    image: ishyoboy_globals.IYB_FRAMEWORK_URI + "/images/icon-typography.png",
                    icons: false
                });
                var a = this;

                d.onRenderMenu.add(function (c, b) {

                    // Dropcaps ****************************************************************************************
                    c = b.addMenu({
                        title: "Dropcaps",
                        icon: 'dropcaps'
                    });

                        a.addPair(c, 'Default', 'dropcap', {'color': 'color1'});
                        a.addPair(c, 'Boxed', 'dropcap', {'color': 'color1', 'boxed': 'yes'});



                    // Headlines ***************************************************************************************
                    c = b.addMenu({
                        title: "Headlines",
                        icon: 'headlines'
                    });

	                    a.addPair(c, 'Default', 'headline', {'tag': "h4", 'color': 'color2'});
	                    a.addPair(c, 'Iconic', 'headline', {'tag': 'h4', 'color': 'color2', 'icon': 'icon-address'});
	                    a.addPair(c, 'Lined', 'headline', {'tag': 'h4', 'lined': 'yes', 'color': 'color2'});
	                    a.addPair(c, 'Section Headline', 'section_headline', {'tag': 'h4', 'lined': 'yes', 'color': 'color2'});
	                    a.addPair(c, 'Text as Headline', 'headline', {'tag': 'div', 'css_class': 'h1', 'color': 'color2'});



                    // Icons *******************************************************************************************
                    c = b.addMenu({
                        title: "Icons",
                        icon: 'icons'
                    });

	                    a.addSingle(c, 'Default', 'icon', {'icon': 'icon-download-cloud', 'size': '36', 'align': 'left', 'color': 'color2', 'url': '', 'new_window': 'no'});
	                    a.addSingle(c, 'Square', 'icon', {'type': 'square', 'icon': 'icon-pin', 'size': '22', 'align': 'left', 'color': 'color2', 'url': '', 'new_window': 'no'});
	                    a.addSingle(c, 'Circle', 'icon', {'type': 'circle', 'icon': 'icon-pin', 'size': '22', 'align': 'left', 'color': 'color2', 'url': '', 'new_window': 'no'});



                    // Lists *******************************************************************************************
                    c = b.addMenu({
                        title: "Lists",
                        icon: 'lists'
                    });

	                    var ish_sc_content = '<ul><li>Item 1</li><li>Item 2</li></ul>';
	                    a.addBlockPair(c, 'Plus', 'list', {'type': 'plus', 'color': 'color1'}, ish_sc_content, null, null, 'plus');
	                    a.addBlockPair(c, 'Minus', 'list', {'type': 'minus', 'color': 'color1'}, ish_sc_content, null, null, 'minus');
	                    a.addBlockPair(c, 'Tick', 'list', {'type': 'tick', 'color': 'color1'}, ish_sc_content, null, null, 'ok');
	                    a.addBlockPair(c, 'Cancel', 'list', {'type': 'cancel', 'color': 'color1'}, ish_sc_content, null, null, 'cancel');
	                    a.addBlockPair(c, 'Pointer', 'list', {'type': 'pointer', 'color': 'color1'}, ish_sc_content, null, null, 'pointer');
	                    a.addBlockPair(c, 'Square', 'list', {'type': 'square', 'color': 'color1'}, ish_sc_content, null, null, 'square');
	                    a.addBlockPair(c, 'Square empty', 'list', {'type': 'square-empty', 'color': 'color1'}, ish_sc_content, null, null, 'square-empty');
	                    a.addBlockPair(c, 'Circle', 'list', {'type': 'circle', 'color': 'color1'}, ish_sc_content, null, null, 'circle');
	                    a.addBlockPair(c, 'Circle empty', 'list', {'type': 'circle-empty', 'color': 'color1'}, ish_sc_content, null, null, 'circle-empty');



                    // Mark ********************************************************************************************
                    a.addPair(b, 'Mark', 'mark', {'color': ''}, null, null, null, 'mark');



                    // Quotes ******************************************************************************************
                    c = b.addMenu({
                        title: "Quote & Pullquote",
                        icon: 'quotes'
                    });

	                    d = c.addMenu({
	                        title: "Quotes"
	                    });

		                    a.addPair(d, 'Default', 'quote', {'color': ''}, null , null ,'[author]The Author[/author]');
		                    a.addPair(d, 'Boxed', 'quote', {'color': '', 'boxed': 'yes'}, null , null ,'[author]The Author[/author]');

	                    d = c.addMenu({
	                        title: "Pullquote"
	                    });

		                    a.addPair(d, 'Default', 'pullquote', {'color': '', 'align': 'left'}, null , null ,'[author]The Author[/author]');
		                    a.addPair(d, 'Boxed', 'pullquote', {'color': '', 'align': 'left', 'boxed': "yes"}, null , null ,'[author]The Author[/author]');

                });

                return d
            }

            if (d == "ishyoboy_block_shortcodes") {
				d = e.createMenuButton("ishyoboy_block_shortcodes", {
					title: "Block Shortcodes",
					image: ishyoboy_globals.IYB_FRAMEWORK_URI + "/images/icon-block.png",
					icons: false
				});
				var a = this;

				d.onRenderMenu.add(function (c, b) {

					// Accordion ***************************************************************************************
					c = b.addMenu({
						title: "Accordion & Toggle",
						icon: 'accordion'
					});

						d = c.addMenu({
							title: "Accordion"
						});

							var ish_sc_content =
								'<p>[accordion]</p>'+
									'<p>[acc_item title="Enter Title here." active="yes"]Enter your content here.[/acc_item]</p>'+
									'<p>[acc_item title="Enter Title here."]Enter your content here.[/acc_item]</p>'+
								'<p>[/accordion]</p>';

							a.addFree(d, 'Accordion', ish_sc_content );
							a.addPair(d, 'Accordion Item', 'acc_item', {'title': 'Enter Title here.', 'active': 'no'});

						d = c.addMenu({
							title: "Toggle"
						});

							var ish_sc_content =
								'<p>[toggle]</p>'+
									'<p>[tgg_item title="Enter Title here." active="yes"]Enter your content here.[/tgg_item]</p>'+
									'<p>[tgg_item title="Enter Title here."]Enter your content here.[/tgg_item]</p>'+
								'<p>[/toggle]</p>';
							a.addFree(d, 'Toggle', ish_sc_content );
							a.addPair(d, 'Toggle Item', 'tgg_item', {'title': 'Enter Title here.', 'active': 'no'});



					// Alerts ******************************************************************************************
					c = b.addMenu({
						title: "Alerts",
						icon: 'alerts'
					});

						d = c.addMenu({
							title: "Default"
						});

							a.addPair(d, 'Info',    'alert', {'type': 'info'}, 'Info');
							a.addPair(d, 'Warning', 'alert', {'type': 'warning'}, 'Warning');
							a.addPair(d, 'Success', 'alert', {'type': 'success'}, 'Success');
							a.addPair(d, 'Error',   'alert', {'type': 'error'}, 'Error');

						d = c.addMenu({
							title: "Closable"
						});

							a.addPair(d, 'Info',    'alert', {'type': 'info', 'closable': 'yes'}, 'Info');
							a.addPair(d, 'Warning', 'alert', {'type': 'warning', 'closable': 'yes'}, 'Warning');
							a.addPair(d, 'Success', 'alert', {'type': 'success', 'closable': 'yes'}, 'Success');
							a.addPair(d, 'Error',   'alert', {'type': 'error', 'closable': 'yes'}, 'Error');

						d = c.addMenu({
							title: "Iconic"
						});

							a.addPair(d, 'Info',    'alert', {'type': 'info', 'icon': 'icon-help-2'}, 'Info');
							a.addPair(d, 'Warning', 'alert', {'type': 'warning', 'icon': 'icon-attention-2'}, 'Warning');
							a.addPair(d, 'Success', 'alert', {'type': 'success', 'icon': 'icon-ok'}, 'Success');
							a.addPair(d, 'Error',   'alert', {'type': 'error', 'icon': 'icon-cancel-2'}, 'Error');



					// Boxes *******************************************************************************************
					c = b.addMenu({
						title: "Boxes",
						icon: 'boxes'
					});

						a.addPair(c, 'Default', 'box', {'color': '', 'icon': '', 'align': 'left'});
						a.addPair(c, 'Iconic', 'iconic_box', {'color': '', 'icon': 'icon-star', 'align': 'left'});
						a.addPair(c, 'Box Group', 'box_group');



					// Buttons *****************************************************************************************
					c = b.addMenu({
						title: "Buttons",
						icon: 'buttons'
					});

						a.addPair(c, 'Small', 'button', {'url': '#', 'size': 'small', 'color': 'color1', 'new_window': 'no', 'full_width': 'no', 'align': 'left'} );
						a.addPair(c, 'Medium', 'button', {'url': '#', 'size': 'medium', 'color': 'color1', 'new_window': 'no', 'full_width': 'no', 'align': 'left'} );
						a.addPair(c, 'Big', 'button', {'url': '#', 'size': 'big', 'color': 'color1', 'new_window': 'no', 'full_width': 'no', 'align': 'left'} );
						a.addPair(c, 'Advanced', 'button', {'url': '#', 'size': 'small', 'new_window': 'no', 'bg_color': 'red', 'text_color': '#fff', 'full_width': 'no', 'align': 'left'} );



                    // Menu ********************************************************************************************
                    a.addSingle(b, 'Menu', 'menu', {'menu': '', 'depth': '0', 'color': ''}, 'menu');



                    // Pre & Code **************************************************************************************
					c = b.addMenu({
						title: 'Pre & Code',
						icon: 'precode'
					});

						a.addPair(c, 'Pre', 'pre', {}, '...');
						a.addPair(c, 'Code', 'code', {}, '...');



                    // Skills ******************************************************************************************
                    c = b.addMenu({
                        title: "Skills",
                        icon: 'skills'
                    });

                        var ish_sc_content =
                            '<p>[skill percent="88" outside="no"]Design[/skill]</p>' +
                                '<p>[skill percent="41" outside="no"]HTML[/skill]</p>' +
                            '<p>[skill percent="65" outside="no"]jQuery[/skill]</p>';
                        a.addPair(c, 'Predefined', 'skills', {'color': 'color1'}, ish_sc_content);
                        a.addPair(c, 'Skills', 'skills', {'color': ''});
                        a.addPair(c, 'Skill', 'skill', {'percent': '', 'outside': 'no'});



					// Tables & pricings *******************************************************************************
					c = b.addMenu({
						title: "Tables & Pricings",
						icon: 'table'
					});

						d = c.addMenu({
							title: "Tables"
						});

                            var ish_sc_content =
								'<p>[table align="center"]</p>' +
                                    '<table>' +
                                    '<tbody>' +
                                        '<tr>' +
                                            '<th>Item 1</th>' +
                                            '<th>Item 2</th>' +
                                            '<th>Item 3</th>' +
                                            '<th>Item 4</th>' +
                                        '</tr>' +
                                        '<tr>' +
                                            '<td>Desc1</td>' +
                                            '<td>Desc2</td>' +
                                            '<td>Desc3</td>' +
                                            '<td>Desc4</td>' +
                                        '</tr>' +
                                        '<tr>' +
                                            '<td>Desc1</td>' +
                                            '<td>Desc2</td>' +
                                            '<td>Desc3</td>' +
                                            '<td>Desc4</td>' +
                                        '</tr>' +
                                    '</tbody>' +
                                    '</table>' +
                                    '<p>[/table]</p>';
                            a.addFree(d, 'Table', ish_sc_content );
							//a.addPair(d, 'Table', 'table', {});
                            var ish_sc_content =
								'<p>[table align="center" striped="yes"]</p>' +
                                    '<table>' +
                                    '<tbody>' +
                                        '<tr>' +
                                            '<th>Item 1</th>' +
                                            '<th>Item 2</th>' +
                                            '<th>Item 3</th>' +
                                            '<th>Item 4</th>' +
                                        '</tr>' +
                                        '<tr>' +
                                            '<td>Desc1</td>' +
                                            '<td>Desc2</td>' +
                                            '<td>Desc3</td>' +
                                            '<td>Desc4</td>' +
                                        '</tr>' +
                                        '<tr>' +
                                            '<td>Desc1</td>' +
                                            '<td>Desc2</td>' +
                                            '<td>Desc3</td>' +
                                            '<td>Desc4</td>' +
                                        '</tr>' +
                                    '</tbody>' +
                                    '</table>' +
                                    '<p>[/table]</p>';
                            a.addFree(d, 'Table - Striped', ish_sc_content );

                            var ish_sc_content =
								'<p>[table align="center" striped="yes"]</p>' +
                                    '<table>' +
                                    '<tbody>' +
                                        '<tr>' +
                                            '<th>Item 1</th>' +
                                            '<th class="highlight-col color1">Item 2</th>' +
                                            '<th>Item 3</th>' +
                                            '<th>Item 4</th>' +
                                        '</tr>' +
                                        '<tr>' +
                                            '<td>Desc1</td>' +
                                            '<td>Desc2</td>' +
                                            '<td>Desc3</td>' +
                                            '<td>Desc4</td>' +
                                        '</tr>' +
                                        '<tr>' +
                                            '<td>Desc1</td>' +
                                            '<td>Desc2</td>' +
                                            '<td>Desc3</td>' +
                                            '<td>Desc4</td>' +
                                        '</tr>' +
                                    '</tbody>' +
                                    '</table>' +
                                    '<p>[/table]</p>';
                            a.addFree(d, 'Table - Highlighted Column', ish_sc_content );

                            var ish_sc_content =
								'<p>[table align="center" striped="yes"]</p>' +
                                    '<table>' +
                                    '<tbody>' +
                                        '<tr>' +
                                            '<th>Item 1</th>' +
                                            '<th>Item 2</th>' +
                                            '<th>Item 3</th>' +
                                            '<th>Item 4</th>' +
                                        '</tr>' +
                                        '<tr class="highlight color2">' +
                                            '<td>Desc1</td>' +
                                            '<td>Desc2</td>' +
                                            '<td>Desc3</td>' +
                                            '<td>Desc4</td>' +
                                        '</tr>' +
                                        '<tr>' +
                                            '<td>Desc1</td>' +
                                            '<td>Desc2</td>' +
                                            '<td>Desc3</td>' +
                                            '<td>Desc4</td>' +
                                        '</tr>' +
                                    '</tbody>' +
                                    '</table>' +
                                    '<p>[/table]</p>';
                            a.addFree(d, 'Table - Highlighted Row', ish_sc_content );

                            var ish_sc_content =
								'<p>[table align="center" striped="yes"]</p>' +
                                    '<table>' +
                                    '<tbody>' +
                                        '<tr>' +
                                            '<th>Item 1</th>' +
                                            '<th class="highlight color1" >Item 2</th>' +
                                            '<th>Item 3</th>' +
                                            '<th>Item 4</th>' +
                                        '</tr>' +
                                        '<tr>' +
                                            '<td>Desc1</td>' +
                                            '<td>Desc2</td>' +
                                            '<td>Desc3</td>' +
                                            '<td class="highlight">Desc4</td>' +
                                        '</tr>' +
                                        '<tr>' +
                                            '<td class="highlight color2">Desc1</td>' +
                                            '<td>Desc2</td>' +
                                            '<td>Desc3</td>' +
                                            '<td>Desc4</td>' +
                                        '</tr>' +
                                    '</tbody>' +
                                    '</table>' +
                                    '<p>[/table]</p>';
                            a.addFree(d, 'Table - Highlighted Random', ish_sc_content );

						d = c.addMenu({
							title: "Pricing Tables"
						});

							var ish_sc_content =
								'<p>[pricing_table align="center" background="yes" striped="yes"]</p>'+
								'<p>[pricing_row headline="yes" color="color1" highlight="yes"]</p>'+
								'<p>[headline tag="h2" color="color2"]Demo[/headline]</p>'+
								'<p>[headline tag="h3"]Free for 60 days[/headline]</p>'+
								'<p>Great for personal</p>'+
								'<p>[/pricing_row]</p>'+
								'<p>[pricing_row]3 accounts[/pricing_row]</p>'+
								'<p>[pricing_row]6 Export formats[/pricing_row]</p>'+
								'<p>[pricing_row]Enhanced security[/pricing_row]</p>'+
								'<p>[pricing_row]Offline access[/pricing_row]</p>'+
								'<p>[pricing_row]-[/pricing_row]</p>'+
								'<p>[pricing_row]-[/pricing_row]</p>'+
								'<p>[pricing_row]-[/pricing_row]</p>'+
								'<p>[pricing_row][button url="#" size="medium" color="color2" new_window="no"]Sign Up[/button][/pricing_row]</p>'+
								'<p>[/pricing_table]</p>';
							a.addFree(d, 'Pricing Table - Color1', ish_sc_content );

                            var ish_sc_content =
								'<p>[pricing_table align="center" background="yes" striped="yes"]</p>'+
								'<p>[pricing_row headline="yes" color="color2" highlight="yes"]</p>'+
								'<p>[headline tag="h2" color="color1"]Demo[/headline]</p>'+
								'<p>[headline tag="h3"]Free for 60 days[/headline]</p>'+
								'<p>Great for personal</p>'+
								'<p>[/pricing_row]</p>'+
								'<p>[pricing_row]3 accounts[/pricing_row]</p>'+
								'<p>[pricing_row]6 Export formats[/pricing_row]</p>'+
								'<p>[pricing_row]Enhanced security[/pricing_row]</p>'+
								'<p>[pricing_row]Offline access[/pricing_row]</p>'+
								'<p>[pricing_row]-[/pricing_row]</p>'+
								'<p>[pricing_row]-[/pricing_row]</p>'+
								'<p>[pricing_row]-[/pricing_row]</p>'+
								'<p>[pricing_row][button url="#" size="medium" color="color1" new_window="no"]Sign Up[/button][/pricing_row]</p>'+
								'<p>[/pricing_table]</p>';
							a.addFree(d, 'Pricing Table - Color2', ish_sc_content );


                    var ish_sc_content =
								'<p>[pricing_table align="center" background="yes" striped="yes"]</p>'+
								'<p>[pricing_row headline="yes" color="color3" highlight="no"]</p>'+
								'<p>[headline tag="h2" color="color1"]Demo[/headline]</p>'+
								'<p>[headline tag="h3"]Free for 60 days[/headline]</p>'+
								'<p>Great for personal</p>'+
								'<p>[/pricing_row]</p>'+
								'<p>[pricing_row]3 accounts[/pricing_row]</p>'+
								'<p>[pricing_row]6 Export formats[/pricing_row]</p>'+
								'<p>[pricing_row]Enhanced security[/pricing_row]</p>'+
								'<p>[pricing_row]Offline access[/pricing_row]</p>'+
								'<p>[pricing_row]-[/pricing_row]</p>'+
								'<p>[pricing_row]-[/pricing_row]</p>'+
								'<p>[pricing_row]-[/pricing_row]</p>'+
								'<p>[pricing_row][button url="#" size="medium" new_window="no"]Sign Up[/button][/pricing_row]</p>'+
								'<p>[/pricing_table]</p>';
							a.addFree(d, 'Pricing Table - Color3', ish_sc_content );

                            /*/
                            var ish_sc_content =
								'<p>[pricing_table align="center" background="yes" striped="yes"]</p>'+
								'<p>[pricing_row headline="yes" color="color4" highlight="no"]</p>'+
								'<p>[headline tag="h2" color="color1"]Demo[/headline]</p>'+
								'<p>[headline tag="h3"]Free for 60 days[/headline]</p>'+
								'<p>Great for personal</p>'+
								'<p>[/pricing_row]</p>'+
								'<p>[pricing_row]3 accounts[/pricing_row]</p>'+
								'<p>[pricing_row]6 Export formats[/pricing_row]</p>'+
								'<p>[pricing_row]Enhanced security[/pricing_row]</p>'+
								'<p>[pricing_row]Offline access[/pricing_row]</p>'+
								'<p>[pricing_row]-[/pricing_row]</p>'+
								'<p>[pricing_row]-[/pricing_row]</p>'+
								'<p>[pricing_row]-[/pricing_row]</p>'+
								'<p>[pricing_row][button url="#" size="medium" new_window="no"]Sign Up[/button][/pricing_row]</p>'+
								'<p>[/pricing_table]</p>';
							a.addFree(d, 'Pricing Table - Color4', ish_sc_content );
							*/

                            d.addSeparator();
                            a.addPair(d, 'Pricing Row', 'pricing_row', {});
							a.addPair(d, 'Pricing Row headline', 'pricing_row', {'headline': 'yes', 'color': "color3", 'highlight': 'no'});
                            a.addPair(d, 'Pricing Table', 'pricing_table', {'align': 'center', 'background': 'yes', 'striped': 'yes'});




	                // Tabs, Toogle ************************************************************************************
	                c = b.addMenu({
		                title: "Tabs",
		                icon: 'tabs'
		            });

						var ish_sc_content =
							'<p>[tabs_navigation pair="tab_set_1"]</p>'+
								'<p>[tab_title pair="tab1" active="yes"]Tab 1 title[/tab_title]</p>'+
								'<p>[tab_title pair="tab2"]Tab 2 title[/tab_title]</p>'+
								'<p>[tab_title pair="tab3"]Tab 3 title[/tab_title]</p>'+
							'<p>[/tabs_navigation]</p>'+
							'<p>[tabs_content pair="tab_set_1"]</p>'+
								'<p>[tab_content pair="tab1"]Tab 1 content[/tab_content]</p>'+
								'<p>[tab_content pair="tab2"]Tab 2 content[/tab_content]</p>'+
								'<p>[tab_content pair="tab3"]Tab 3 content[/tab_content]</p>'+
							'<p>[/tabs_content]</p>';
						a.addFree(c, 'Tabs - Top', ish_sc_content );

                        var ish_sc_content =
							'<p>[tabs_content pair="tab_set_2"]</p>'+
								'<p>[tab_content pair="tab1"]Tab 1 content[/tab_content]</p>'+
								'<p>[tab_content pair="tab2"]Tab 2 content[/tab_content]</p>'+
								'<p>[tab_content pair="tab3"]Tab 3 content[/tab_content]</p>'+
							'<p>[/tabs_content]</p>'+
                            '<p>[tabs_navigation pair="tab_set_2"]</p>'+
								'<p>[tab_title pair="tab1" active="yes"]Tab 1 title[/tab_title]</p>'+
								'<p>[tab_title pair="tab2"]Tab 2 title[/tab_title]</p>'+
								'<p>[tab_title pair="tab3"]Tab 3 title[/tab_title]</p>'+
							'<p>[/tabs_navigation]</p>';
						a.addFree(c, 'Tabs - Bottom', ish_sc_content );

                        var ish_sc_content =
                            '<p>[row]</p>'+
                                '<p>[one_fourth]</p>'+
                                    '<p>[tabs_navigation pair="tab_set_3" vertical="yes"]</p>'+
                                        '<p>[tab_title pair="tab1" active="yes"]Tab 1 title[/tab_title]</p>'+
                                        '<p>[tab_title pair="tab2"]Tab 2 title[/tab_title]</p>'+
                                        '<p>[tab_title pair="tab3"]Tab 3 title[/tab_title]</p>'+
                                    '<p>[/tabs_navigation]</p>'+
                                '<p>[/one_fourth]</p>'+
                                '<p>[three_fourths]</p>'+
                                    '<p>[tabs_content pair="tab_set_3"]</p>'+
                                        '<p>[tab_content pair="tab1"]Tab 1 content[/tab_content]</p>'+
                                        '<p>[tab_content pair="tab2"]Tab 2 content[/tab_content]</p>'+
                                        '<p>[tab_content pair="tab3"]Tab 3 content[/tab_content]</p>'+
                                    '<p>[/tabs_content]</p>'+
                                '<p>[/three_fourths]</p>'+
                            '<p>[/row]</p>';
						a.addFree(c, 'Tabs - Left', ish_sc_content );

                        var ish_sc_content =
							'<p>[row]</p>'+
                                '<p>[three_fourths]</p>'+
                                    '<p>[tabs_content pair="tab_set_3"]</p>'+
                                        '<p>[tab_content pair="tab1"]Tab 1 content[/tab_content]</p>'+
                                        '<p>[tab_content pair="tab2"]Tab 2 content[/tab_content]</p>'+
                                        '<p>[tab_content pair="tab3"]Tab 3 content[/tab_content]</p>'+
                                    '<p>[/tabs_content]</p>'+
                                '<p>[/three_fourths]</p>'+
                                '<p>[one_fourth]</p>'+
                                    '<p>[tabs_navigation pair="tab_set_3" vertical="yes"]</p>'+
                                        '<p>[tab_title pair="tab1" active="yes"]Tab 1 title[/tab_title]</p>'+
                                        '<p>[tab_title pair="tab2"]Tab 2 title[/tab_title]</p>'+
                                        '<p>[tab_title pair="tab3"]Tab 3 title[/tab_title]</p>'+
                                    '<p>[/tabs_navigation]</p>'+
                                '<p>[/one_fourth]</p>'+
                            '<p>[/row]</p>';
                    a.addFree(c, 'Tabs - Right', ish_sc_content );

						var ish_sc_content =
							'<p>[tabs_navigation pair=""]</p>'+
								'<p>[tab_title pair="tab1" active="yes"]Tab 1 title[/tab_title]</p>'+
								'<p>[tab_title pair="tab2"]Tab 2 title[/tab_title]</p>'+
								'<p>[tab_title pair="tab3"]Tab 3 title[/tab_title]</p>'+
							'<p>[/tabs_navigation]</p>';
						a.addFree(c, 'Tabs Navigation', ish_sc_content);

						var ish_sc_content =
							'<p>[tabs_content pair=""]</p>'+
								'<p>[tab_content pair="tab1"]Tab 1 content[/tab_content]</p>'+
								'<p>[tab_content pair="tab2"]Tab 2 content[/tab_content]</p>'+
								'<p>[tab_content pair="tab3"]Tab 3 content[/tab_content]</p>'+
							'<p>[/tabs_content]</p>';
						a.addFree(c, 'Tabs Content', ish_sc_content);
						a.addPair(c, 'Tab Title', 'tab_title', {'pair': '', 'active': 'no'});
						a.addPair(c, 'Tab Content', 'tab_content', {'pair': '', 'active': 'no'});



					// Tooltip *****************************************************************************************
					a.addPair(b, 'Tooltip', 'tooltip', {'color': 'color1', 'tooltip': 'Tooltip text', 'tooltip_color': ''}, null, null, null, 'tooltip');

				});

                return d
            }

            if (d == "ishyoboy_special_shortcodes") {
                d = e.createMenuButton("ishyoboy_special_shortcodes", {
                    title: "Special Shortcodes",
                    image: ishyoboy_globals.IYB_FRAMEWORK_URI + "/images/icon-special.png",
                    icons: false
                });
                var a = this;

                d.onRenderMenu.add(function (c, b) {

                    // Breadcrumbs *************************************************************************************
                    a.addSingle(b, 'Breadcrumbs', 'breadcrumbs', {}, 'breadcrumbs');



                    // Charts ******************************************************************************************
                    c = b.addMenu({
                        title: 'Charts',
                        icon: 'charts'
                    });

	                    a.addPair(c, 'Default', 'chart', {
	                        'percent': '75',
	                        'align': 'center',
	                        'color': 'color1',
	                        'size': '150',
	                        'line_width': '10',
	                        'rounded': 'no',
	                        'animation_time': '2'
	                    }, '75%');
	                    a.addPair(c, 'Advanced', 'chart', {
	                        'percent': '75',
	                        'align': 'center',
	                        'size': '150',
	                        'line_width': '10',
	                        'rounded': 'no',
	                        'animation_time': '2',

	                        'icon': 'icon-chart-pie',
	                        'track_color': '#ccc',
	                        'bar_color': '#ff0000',
	                        'text_size': '30'
	                    }, ' 75%');



                    // Section *****************************************************************************************
                    c = b.addMenu({
                        title: "Content & Page break",
                        icon: 'break'
                    });

                        d = c.addMenu({
                            title: "Content break"
                        });

                            var ish_sc_content =
                                '<p>[content_break]</p>'+
                                    '<p>[section color="" full_width="no" pattern="yes" pattern_url=""]</p>'+
                                    '<p>[/section]</p>'+
                                    '<p>[/content_break]</p>';
                            a.addFree(d, 'Section', ish_sc_content );

                            ish_sc_content =
                                '<p>[content_break]</p>'+
                                    '<p>[section color="color1" full_width="no" pattern="yes" pattern_url=""]</p>'+
                                    '<p>[/section]</p>'+
                                    '<p>[/content_break]</p>';
                            a.addFree(d, 'Colored Section', ish_sc_content );

                            ish_sc_content =
                                '<p>[content_break]</p>'+
                                    '<p>[section color="" full_width="yes" pattern="yes" pattern_url=""]</p>'+
                                    '<p>[/section]</p>'+
                                    '<p>[/content_break]</p>';
                            a.addFree(d, 'Full-width Section', ish_sc_content );

                            ish_sc_content =
                                '<p>[content_break]</p>'+
                                    '<p>[section color="color1" full_width="yes" pattern="yes" pattern_url=""]</p>'+
                                    '<p>[/section]</p>'+
                                    '<p>[/content_break]</p>';
                            a.addFree(d, 'Full-width colored Section', ish_sc_content );

                            ish_sc_content =
                                '<p>[content_break]</p>'+
                                    '<p>[section color="" full_width="no" pattern="yes" pattern_url="" parallax_type="static"]</p>'+
                                    '<p>[/section]</p>'+
                                    '<p>[/content_break]</p>';
                            a.addFree(d, 'Parallax (Static) Section', ish_sc_content );

                            ish_sc_content =
                                '<p>[content_break]</p>'+
                                    '<p>[section color="" full_width="no" pattern="yes" pattern_url="" parallax_type="dynamic" parallax_scroll="" parallax_duration="" parallax_easing=""]</p>'+
                                    '<p>[/section]</p>'+
                                    '<p>[/content_break]</p>';
                            a.addFree(d, 'Parallax (Dynamic) Section', ish_sc_content );

                        d = c.addMenu({
                            title: "Page break"
                        });

                            var ish_sc_content =
                                '<p>[page_break]</p>'+
                                    '<p>[/page_break]</p>';
                            a.addFree(d, 'Page break', ish_sc_content );

                            var ish_sc_content =
                                '<p>[page_break full_width="yes"]</p>'+
                                    '<p>[/page_break]</p>';
                            a.addFree(d, 'Full-width Page break', ish_sc_content );

                    // Embed ***************************************************************************************
                    c = b.addMenu({
                        title: 'Embed & Multimedia',
                        icon: 'embed'
                    });

                    a.addPair(c, 'Default', 'embed', {}, 'Paste your third-party link here. See all embed options on <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">http://codex.wordpress.org/Embeds</a>');
                    a.addPair(c, 'Flickr', 'embed', {}, 'Paste your Flickr image\'s page link here. See all embed options on <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">http://codex.wordpress.org/Embeds</a>');
                    a.addPair(c, 'Instagram', 'embed', {}, 'Paste your Instagram image\'s page link here. See all embed options on <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">http://codex.wordpress.org/Embeds</a>');
                    a.addPair(c, 'SoundCloud', 'embed', {}, 'Paste your Soundcloud mix link here. See all embed options on <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">http://codex.wordpress.org/Embeds</a>');
                    a.addPair(c, 'Twitter', 'embed', {}, 'Paste your Twitter tweet\'s link here. See all embed options on <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">http://codex.wordpress.org/Embeds</a>');
                    a.addPair(c, 'Videos', 'embed', {}, 'Paste your Vimeo, YouTube, DailyMotion, Viddler, Hulu, Qik, Revision3 or WordPress.tv video link here. See all embed options on <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">http://codex.wordpress.org/Embeds</a>');

	                // Featured Image **********************************************************************************
	                a.addSingle(b, 'Featured Image', 'featured_image', {'align': '', 'size': 'theme-large', 'url': '', 'new_window': 'no', 'open_full_version': ''}, 'featured-image');

                    // Map ***************************************************************************************
                    c = b.addMenu({
                        title: 'Map',
                        icon: 'map'
                    });

	                    a.addSingle(c, 'Default', 'map', {
                            'lat_lng_1': '36.5099367, -4.8863523',
                            'zoom': '15',
                            'color': '',
	                        'invert_colors': 'no',
	                        'height': ''
	                    });
	                    a.addSingle(c, 'Advanced', 'map', {
                            'lat_lng_1': '36.5099367, -4.8863523',
                            'zoom': '15',
                            'color': 'color1',
                            'invert_colors': 'no',
                            'height': '400'
	                    });

                    // Portfolio ***************************************************************************************
                    c = b.addMenu({
                        title: 'Portfolio',
                        icon: 'portfolio'
                    });

	                    a.addSingle(c, 'Default', 'portfolio', {
	                        'category': '',
	                        'order': 'DESC',
	                        'navigation': 'yes',
	                        'pagination': 'yes',
	                        'view_all': 'no'
	                    });
	                    a.addSingle(c, 'Advanced', 'portfolio', {
	                        'category': '',
	                        'order': 'DESC',
	                        'navigation': 'yes',
	                        'pagination': 'yes',
	                        'view_all': 'no',
	                        'height': '',
	                        'per_page': '',
	                        'columns': '',
	                        'masonry': '',

                            'fluid_layout': 'yes',
                            'layout_style': '1',
                            'show_title': 'yes',
                            'show_categories': 'yes',
                            'show_link_button': 'yes',
                            'show_popup_button': 'yes',
                            'animate_filter': 'yes'
                        });

	                    d = c.addMenu({
	                        title: "Detail"
	                    });

		                    a.addSingle(d, 'Portfolio Gallery', 'portfolio_gallery', {'slideshow': 'yes', 'animation': 'slide', 'navigation': 'yes', 'autoslide': 'no', 'interval': '', 'thumbnail_size': ''});
		                    a.addSingle(d, 'Portfolio Prev / Next', 'portfolio_prev_next', {'prev_text': '', 'next_text': '', 'align': 'left'});
		                    a.addSingle(d, 'Portfolio Categories', 'portfolio_categories', {'separator': ', ', 'links': 'yes', 'align': 'left'});



                    // Recent Posts ************************************************************************************
                    a.addSingle(b, 'Recent Posts', 'recent_posts', {
                        'category': '',
                        'order': 'DESC',
                        'columns': '4',
                        'count': '4',
                        'show_title_icon': 'no',
                        'show_media': 'yes',
                        'show_date': 'yes',
                        'show_categories': 'yes',
                        'show_read_more': 'yes',

                        'show_author': 'no',
                        'show_tags': 'no',
                        'show_comments': 'no',

                        'slideshow': 'no',
                        'animation': '',
                        'navigation': '',
                        'autoslide': '',
                        'interval': ''
                    }, 'recent-posts');



                    // Rounded images **********************************************************************************
                    c = b.addMenu({
                        title: "Rounded image",
                        icon: 'rimage'
                    });

	                    a.addBlockPair(c, 'Rounded image', 'rounded_image', {'color': '', 'align': ''}, '<p>Insert your image here.</p>');
	                    a.addBlockPair(c, 'Rounded image with arrow', 'rounded_image', {'color': '', 'align': '', 'arrow': 'bottom'}, '<p>Insert your image here.</p>');
	                    a.addBlockPair(c, 'Rounded image advanced', 'rounded_image', {'color': '', 'align': '', 'arrow': 'bottom', 'width': '', 'border_width': ''}, '<p>Insert your image here.</p>');



                    // Slider ******************************************************************************************
                    c = b.addMenu({
                        title: "Sliders",
                        icon: 'sliders'
                    });

	                    a.addSingle(c, 'Ishyoboy Slider', 'slider', {'slider_name': "homepage", 'animation': 'slide', 'autoslide': "yes", 'interval': "7", 'navigation': "yes", 'height': ""});
	                    a.addBlockPair(c, 'Slidable Slide', 'slidable', { 'autoslide': 'no', 'animation': 'slide', 'interval': "7", 'navigation': "yes"}, '<p>[slide][/slide]</p><p>[slide][/slide]</p>');
	                    a.addBlockPair(c, 'Slidable Fade', 'slidable', { 'autoslide': 'no', 'animation': 'fade', 'interval': "7", 'navigation': "yes"}, '<p>[slide][/slide]</p><p>[slide][/slide]</p>');
                        c.addSeparator();
	                    a.addPair(c, 'Slidable container',    'slidable');
	                    a.addPair(c, 'Slidable slide', 'slide');



	                // Social Share ************************************************************************************
	                a.addSingle(b, 'Social Share', 'social_share', {}, 'soc-share');



	                // Social ******************************************************************************************
	                //a.addSingle(b, 'Social', 'social', {'icon': '', 'url': '', 'new_window': 'no', 'title': '', 'tooltip': '', 'text_color': ''}, 'soc-share');



					// The Title ***************************************************************************************
	                a.addSingle(b, 'The Title', 'the_title', {}, 'headlines');



					// Timeline ****************************************************************************************
					c = b.addMenu({
						title: "Timeline",
						icon: 'timeline'
					});

						d = c.addMenu({
							title: "Predefined"
						});

							var ish_sc_content =
								'<p>[timeline hover_effect="no"]</p>'+
									'<p>[timeline_item size="big"]</p>'+
										'<p>[timeline_content][headline tag="h2" color="color1"]Timeline title[/headline][/timeline_content]</p>'+
										'<p>[timeline_date]23. APR[/timeline_date]</p>'+
									'<p>[/timeline_item]</p>'+
									'<p>[timeline_item size="medium"]</p>'+
										'<p>[timeline_date]21. APR[/timeline_date]</p>'+
										'<p>[timeline_content border="no" color=""]Enter your medium sized item content here.[/timeline_content]</p>'+
									'<p>[/timeline_item]</p>'+
									'<p>[timeline_item size="small"]</p>'+
										'<p>[timeline_content border="no" color=""]Enter your small sized item content here.[/timeline_content]</p>'+
										'<p>[timeline_date]20. APR[/timeline_date]</p>'+
									'<p>[/timeline_item]</p>'+
									'<p>[timeline_item size="small"]</p>'+
										'<p>[timeline_date]20. APR[/timeline_date]</p>'+
										'<p>[timeline_content border="no" color=""]Enter your small sized item content here.[/timeline_content]</p>'+
									'<p>[/timeline_item]</p>'+
									'<p>[timeline_item size="medium"]</p>'+
										'<p>[timeline_content border="no" color=""]Enter your medium sized item content here.[/timeline_content]</p>'+
										'<p>[timeline_date]15. APR[/timeline_date]</p>'+
									'<p>[/timeline_item]</p>'+
									'<p>[timeline_item size="big"]</p>'+
										'<p>[timeline_date]15. APR[/timeline_date]</p>'+
										'<p>[timeline_content][headline tag="h2" color="color2"]Timeline footer[/headline][/timeline_content]</p>'+
									'<p>[/timeline_item]</p>'+
								'<p>[/timeline]</p>';
							a.addFree(d, 'Default', ish_sc_content);

							var ish_sc_content =
								'<p>[timeline hover_effect="no"]</p>'+
									'<p>[timeline_item size="big"]</p>'+
										'<p>[timeline_content][headline tag="h2" color="color1"]Timeline title[/headline][/timeline_content]</p>'+
										'<p>[timeline_date]23. APR[/timeline_date]</p>'+
									'<p>[/timeline_item]</p>'+
									'<p>[timeline_item size="medium"]</p>'+
										'<p>[timeline_date]21. APR[/timeline_date]</p>'+
										'<p>[timeline_content border="yes" color=""]Enter your medium sized item content here.[/timeline_content]</p>'+
									'<p>[/timeline_item]</p>'+
									'<p>[timeline_item size="small"]</p>'+
										'<p>[timeline_content border="yes" color=""]Enter your small sized item content here.[/timeline_content]</p>'+
										'<p>[timeline_date]20. APR[/timeline_date]</p>'+
									'<p>[/timeline_item]</p>'+
									'<p>[timeline_item size="small"]</p>'+
										'<p>[timeline_date]20. APR[/timeline_date]</p>'+
										'<p>[timeline_content border="yes" color=""]Enter your small sized item content here.[/timeline_content]</p>'+
									'<p>[/timeline_item]</p>'+
									'<p>[timeline_item size="medium"]</p>'+
										'<p>[timeline_content border="yes" color=""]Enter your medium sized item content here.[/timeline_content]</p>'+
										'<p>[timeline_date]15. APR[/timeline_date]</p>'+
									'<p>[/timeline_item]</p>'+
									'<p>[timeline_item size="big"]</p>'+
										'<p>[timeline_date]15. APR[/timeline_date]</p>'+
										'<p>[timeline_content][headline tag="h2" color="color2"]Timeline footer[/headline][/timeline_content]</p>'+
									'<p>[/timeline_item]</p>'+
								'<p>[/timeline]</p>';
							a.addFree(d, 'Bordered', ish_sc_content);

							var ish_sc_content =
								'<p>[timeline hover_effect="no"]</p>'+
									'<p>[timeline_item size="big"]</p>'+
										'<p>[timeline_content][headline tag="h2" color="color1"]Timeline title[/headline][/timeline_content]</p>'+
										'<p>[timeline_date]23. APR[/timeline_date]</p>'+
									'<p>[/timeline_item]</p>'+
									'<p>[timeline_item size="medium"]</p>'+
										'<p>[timeline_date]21. APR[/timeline_date]</p>'+
										'<p>[timeline_content border="yes" color="color2"]Enter your medium sized item content here.[/timeline_content]</p>'+
									'<p>[/timeline_item]</p>'+
									'<p>[timeline_item size="small"]</p>'+
										'<p>[timeline_content border="yes" color="color1"]Enter your small sized item content here.[/timeline_content]</p>'+
										'<p>[timeline_date]20. APR[/timeline_date]</p>'+
									'<p>[/timeline_item]</p>'+
									'<p>[timeline_item size="small"]</p>'+
										'<p>[timeline_date]20. APR[/timeline_date]</p>'+
										'<p>[timeline_content border="yes" color="color2"]Enter your small sized item content here.[/timeline_content]</p>'+
									'<p>[/timeline_item]</p>'+
									'<p>[timeline_item size="medium"]</p>'+
										'<p>[timeline_content border="yes" color="color1"]Enter your medium sized item content here.[/timeline_content]</p>'+
										'<p>[timeline_date]15. APR[/timeline_date]</p>'+
									'<p>[/timeline_item]</p>'+
									'<p>[timeline_item size="big"]</p>'+
										'<p>[timeline_date]15. APR[/timeline_date]</p>'+
										'<p>[timeline_content][headline tag="h2" color="color2"]Timeline footer[/headline][/timeline_content]</p>'+
									'<p>[/timeline_item]</p>'+
								'<p>[/timeline]</p>';
							a.addFree(d, 'Colored', ish_sc_content);

							a.addPair(c, 'Timeline item',   'timeline_item', {'size': 'small'});
							a.addPair(c, 'Timeline date',   'timeline_date', {});
							a.addPair(c, 'Timeline content',   'timeline_content', {'border': 'no', 'color': ''});

                });

                return d
            }

            return null
        },
        addSingle: function (d, e, a, atribs, icon) {

            var atts = '';
	        var icn = '';

            for (var key in atribs) {
                atts += ' '+ key + '="'+ atribs[key] + '"';
            }

	        if (icon ) {
		        icn = icon;
	        }

            d.add({
                title: e,
	            icon: icn,
                onclick: function () {
                    tinyMCE.activeEditor.execCommand("mceInsertContent", false, '['+ a + atts + ']') ;
                }
            })
        },
        addPair: function (d, e, a, atribs, message, cbefore, cafter, icon ) {

            var atts = '';
            var cb = '';
            var ca = '';
            var msg = 'Enter your content here.'
	        var icn = '';

            if (cbefore){
                cb = cbefore;
           }
            if (cafter){
                ca = cafter;
           }
            if (message){
                msg = message;
           }

            for (var key in atribs) {
                atts += ' '+ key + '="'+ atribs[key] + '"';
           }

	        if (icon ) {
		        icn = icon;
	        }

            d.add({
                title: e,
                icon: icn,
                onclick: function () {
                    if ( tinyMCE.activeEditor.selection.getContent() != ''){
                        tinyMCE.activeEditor.execCommand("mceInsertContent", false, '['+ a + atts + ']'+ tinyMCE.activeEditor.selection.getContent() + '[/'+ a + ']');
                   }
                    else{
                        tinyMCE.activeEditor.execCommand("mceInsertContent", false, '['+ a + atts + ']'+ cb + msg + ca + '[/'+ a + ']') ;
                   }
               }
           })
       },
        addBlockPair: function (d, e, a, atribs, message, cbefore, cafter, icon ) {

            var atts = '';
            var cb = '';
            var ca = '';
            var msg = 'Enter your content here.'
	        var icn = '';

            if (cbefore){
                cb = cbefore;
           }
            if (cafter){
                ca = cafter;
           }
            if (message){
                msg = message;
           }

            for (var key in atribs) {
                atts += ' '+ key + '="'+ atribs[key] + '"';
           }

	        if (icon) {
		        icn = icon;
	        }

            d.add({
                title: e,
	            icon: icn,
                //icon: 'icon-th-large',
                onclick: function () {
                    if ( tinyMCE.activeEditor.selection.getContent() != ''){
                        tinyMCE.activeEditor.execCommand("mceInsertContent", false, '<p>['+ a + atts + ']</p>'+ tinyMCE.activeEditor.selection.getContent() + '<p>[/'+ a + ']</p>');
                   }
                    else{
                        tinyMCE.activeEditor.execCommand("mceInsertContent", false, '<p>['+ a + atts + ']</p>'+ cb + msg + ca + '<p>[/'+ a + ']</p>') ;
                   }
               }
           })
       },
        addFree: function (d, e, content ) {
            d.add({
                title: e,
                onclick: function () {
                    if ( tinyMCE.activeEditor.selection.getContent() != ''){
                        //tinyMCE.activeEditor.execCommand("mceInsertContent", false, '['+ a + atts + ']'+ tinyMCE.activeEditor.selection.getContent() + '[/'+ a + ']');
                   }
                    else{
                        tinyMCE.activeEditor.execCommand("mceInsertContent", true, content) ;
                   }
               }
           })
       },
        getInfo: function() {
            return {
                longname: 'IshYoBoy Shortcode selector',
                author: 'IshYoBoy',
                authorurl: 'http://www.ishyoboy.com',
                infourl: 'http://www.ishyoboy.com',
                version: "1.0"
           };
       }
   });

    tinymce.PluginManager.add('ishyoboy_shortcodes_select', tinymce.plugins.ishyoboy_shortcodes_select);
})();