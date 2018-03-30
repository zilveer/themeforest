(function () {
    tinymce.PluginManager.add('shortcode_tinymce_button', function (editor, url) {
        editor.addButton('shortcode_tinymce_button', {
            title: 'Shortcode generator',
            type: 'menubutton',
            icon: 'icon pkb-shortcode-icon',
            menu: [
                {
                    text: 'Grid Layout',
                    value: 'Grid Layout',
                    menu: [
                        {
                            text: '2 Columns',
                            value: '2 Columns',
                            onclick: function (e) {
                                e.stopPropagation();
                                editor.insertContent("[one_half_alpha] Insert content here [/one_half_alpha] [one_half_omega] Insert content here[/one_half_omega]");
                            }
                        },
                        {
                            text: '3 Columns',
                            value: '3 Columns',
                            onclick: function (e) {
                                e.stopPropagation();
                                editor.insertContent("[one_third_alpha] Insert content here [/one_third_alpha] [one_third] Insert content here[/one_third] [one_third_omega] Insert content here[/one_third_omega]");
                            }
                        },
                        {
                            text: '4 Columns',
                            value: '4 Columns',
                            onclick: function (e) {
                                e.stopPropagation();
                                editor.insertContent("[one_fourth_alpha] Insert content here [/one_fourth_alpha] [one_fourth] Insert content here[/one_fourth] [one_fourth] Insert content here[/one_fourth] [one_fourth_omega] Insert content here[/one_fourth_omega]");
                            }
                        },
                        {
                            text: '1/3 & 2/3 Columns',
                            value: '1/3 & 2/3 Columns',
                            onclick: function (e) {
                                e.stopPropagation();
                                editor.insertContent("[one_third_alpha] Insert content here [/one_third_alpha] [large_8_omega] Insert content here[/large_8_omega]");
                            }
                        },
                        {
                            text: '2/3 & 1/3  Columns',
                            value: '2/3 & 1/3  Columns',
                            onclick: function (e) {
                                e.stopPropagation();
                                editor.insertContent("[large_8_alpha] Insert content here [/large_8_alpha] [one_third_omega] Insert content here[/one_third_omega]");
                            }
                        }
                    ]
                },
                {
                    text: 'Notification Box',
                    onclick: function () {
                        editor.windowManager.open({
                            title: 'Insert notification box',
                            body: [
                                {
                                    type: 'textbox',
                                    name: 'title',
                                    label: 'Notification text'
                                },
                                {
                                    type: 'listbox',
                                    name: 'type',
                                    label: 'Notification box type',
                                    'values': [
                                        {text: 'Standard', value: ''},
                                        {text: 'Success', value: 'success'},
                                        {text: 'Warning', value: 'alert'},
                                        {text: 'Secondary', value: 'secondary'}
                                    ]
                                },
                                {
                                    type: 'checkbox',
                                    name: 'close',
                                    checked: false,
                                    label: 'Add close button'
                                }
                            ],
                            onsubmit: function (e) {
                                var setType;
                                var setClose;
                                if (e.data.type) {
                                    setType = "type=\"" + e.data.type + "\""
                                } else {
                                    setType = ""
                                }

                                if (e.data.close) {
                                    setClose = ""
                                } else {
                                    setClose = "close=no"
                                }
                                editor.insertContent("[alert " + setType + setClose + "] " + e.data.title + " [/alert]");
                            }
                        })
                    }
                },
                {
                    text: 'UI',
                    value: 'UI',
                    menu: [
                        {
                            text: 'Accordion',
                            value: 'accordion',
                            onclick: function (e) {
                                e.stopPropagation();
                                editor.insertContent("[accs class=\"optionalclass\"][acc active=\"active\" title=\"Accordion 1\"]Accordion pane 1 content goes here.[/acc][acc title=\"Accordion 2\"]Accordion pane 2 content goes here.[/acc][acc title=\"Accordion 3\"]Accordion pane 3 content goes here.[/acc][acc title=\"Accordion 4\"]Accordion pane 4 content goes here.[/acc][/accs]")

                            }
                        },
                        {
                            text: 'Tabs',
                            value: 'tabs',
                            onclick: function (e) {
                                e.stopPropagation();
                                editor.insertContent("[tabs class=\"optionalclass\"][tab title=\"Tab 1\" active=\"active\"]Insert Tab 1 content here.[/tab][tab title=\"Tab 2\"]Insert Tab 2 content here.[/tab][tab title=\"Tab 3\"]Insert Tab 3 content here.[/tab][tab title=\"Tab 4\"]Insert Tab 4 content here.[/tab][/tabs]")
                            }
                        },
                        {
                            text: 'Vertical Tabs',
                            value: 'vertical tabs',
                            onclick: function (e) {
                                e.stopPropagation();
                                editor.insertContent("[vtabs class=\"optionalclass\"] [vtab title=\"Tab 1 Title\" active=\"active\"] Insert Tab 1 content here [/vtab] [vtab title=\"Tab 2 Title\"] Insert Tab 2 content here [/vtab] [vtab title=\"Tab 3 Title\"] Insert Tab 3 content here [/vtab] [/vtabs]")
                            }
                        }
                    ]
                },
                {
                    text: 'Foundation Elements',
                    value: 'foundation',
                    menu: [
                        {
                            text: 'Clearing',
                            value: 'clearing',
                            onclick: function (e) {
                                e.stopPropagation();
                                editor.insertContent("[clearing columns=3 size=medium]")
                            }
                        },
                        {
                            text: 'Grid Columns',
                            value: 'grid',
                            onclick: function (e) {
                                e.stopPropagation();
                                editor.insertContent("[column columns=12] Insert content here [/column]")
                            }
                        },
                        {
                            text: 'Orbit',
                            value: 'orbit',
                            onclick: function (e) {
                                e.stopPropagation();
                                editor.insertContent("[orbit]")
                            }
                        },
                        {
                            text: 'Tool Tip',
                            value: 'tooltip',
                            onclick: function (e) {
                                e.stopPropagation();
                                editor.insertContent("[tooltip position=\"top\" title=\"Insert Tooltip content here\" ]Insert text here[/tooltip]")
                            }
                        },
                        {
                            text: 'Reveal',
                            value: 'reveal',
                            onclick: function (e) {
                                e.stopPropagation();
                                editor.insertContent("[reveal link=\"Link text\" linkclass=\"button radius secondary\" class=\"medium\" ]Insert Reveal content here[/reveal]")
                            }
                        }
                    ]
                },
                {
                    text: 'Miscellaneous Elements',
                    value: 'miscellaneous',
                    menu: [
                        {
                            text: 'Check List 1',
                            value: 'checklist',
                            onclick: function (e) {
                                e.stopPropagation();
                                editor.insertContent("[checklist]<li>List item 1</li><li>List item 2</li><li>List item 3</li>[/checklist]")
                            }
                        },
                        {
                            text: 'Check List 2',
                            value: 'checklist2',
                            onclick: function (e) {
                                e.stopPropagation();
                                editor.insertContent("[checklist2]<li>List item 1</li><li>List item 2</li><li>List item 3</li>[/checklist2]")
                            }
                        },
                        {
                            text: 'Left Pull Quotes',
                            value: 'pullquote_left',
                            onclick: function (e) {
                                e.stopPropagation();
                                editor.insertContent("[pullquote_left] Insert content here [/pullquote_left]")
                            }
                        },
                        {
                            text: 'Right Pull Quotes',
                            value: 'pullquote_right',
                            onclick: function (e) {
                                e.stopPropagation();
                                editor.insertContent("[pullquote_right] Insert content here [/pullquote_right]")
                            }
                        },
                        {
                            text: 'Blockquote',
                            value: 'quote',
                            onclick: function (e) {
                                e.stopPropagation();
                                editor.insertContent("[quote] Insert content here [/quote]")
                            }
                        }
                    ]
                },
                {
                    text: 'Button',
                    onclick: function () {
                        editor.windowManager.open({
                            title: 'Insert button',
                            body: [
                                {
                                    type: 'textbox',
                                    name: 'title',
                                    label: 'Button text'
                                },
                                {
                                    type: 'textbox',
                                    name: 'url',
                                    label: 'URL'
                                },
                                {
                                    type: 'checkbox',
                                    name: 'target',
                                    checked: false,
                                    label: 'Open URL in a new window'
                                },
                                {
                                    type: 'checkbox',
                                    name: 'arrow',
                                    checked: false,
                                    label: 'Add arrow icon'
                                },
                                {
                                    type: 'listbox',
                                    name: 'position',
                                    label: 'Button position',
                                    'values': [
                                        {text: 'Left', value: 'left'},
                                        {text: 'Right', value: 'right'}
                                    ]
                                },
                                {
                                    type: 'listbox',
                                    name: 'color',
                                    label: 'Button color',
                                    'values': [
                                        {text: 'Red', value: 'red'},
                                        {text: 'Orange', value: 'orange'},
                                        {text: 'Yellow', value: 'yellow'},
                                        {text: 'Green', value: 'green'},
                                        {text: 'Teal', value: 'teal'},
                                        {text: 'Gray', value: 'gray'}
                                    ]
                                }
                            ],
                            onsubmit: function (e) {
                                var setTarget;
                                var setArrow;
                                if (e.data.target) {
                                    setTarget = "target=\"_blank\""
                                } else {
                                    setTarget = ""
                                }
                                ;
                                if (e.data.arrow) {
                                    setArrow = "arrow_"
                                } else {
                                    setArrow = ""
                                }
                                ;

                                editor.insertContent("[btn_" + setArrow + "" + e.data.color + " url=\"" + e.data.url + "\" " + setTarget + " position=\"" + e.data.position + "\"]  " + e.data.title + "  [/btn_" + setArrow + "" + e.data.color + "]");
                            }
                        });
                    }
                }

            ]
        });
    });
})();