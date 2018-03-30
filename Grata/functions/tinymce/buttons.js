/**
 * Rows with columns
 */
(function() {
	tinymce.create('tinymce.plugins.columns', {
		init : function(ed, url) {
            ed.addButton('columns', {
                title: 'Columns',
                icon: 'us_columns',
                type: 'menubutton',
                menu: [
                    {
                        text: '2 columns',
                        menu: [
                            {
                                text: '[____1/2____][____1/2____]',
                                value: '[cols]<br />[one_half] ... [/one_half]<br />[one_half] ... [/one_half]<br />[/cols]',
                                onclick: function() {
                                    ed.insertContent(this.value());
                                }
                            },
                            {
                                text: '[__1/3__][______2/3______]',
                                value: '[cols]<br />[one_third] ... [/one_third]<br />[two_third] ... [/two_third]<br />[/cols]',
                                onclick: function() {
                                    ed.insertContent(this.value());
                                }
                            },
                            {
                                text: '[______2/3______][__1/3__]',
                                value: '[cols]<br />[two_third] ... [/two_third]<br />[one_third] ... [/one_third]<br />[/cols]',
                                onclick: function() {
                                    ed.insertContent(this.value());
                                }
                            },
                            {
                                text: '[_1/4_][_______3/4_______]',
                                value: '[cols]<br />[one_quarter] ... [/one_quarter]<br />[three_quarter] ... [/three_quarter]<br />[/cols]',
                                onclick: function() {
                                    ed.insertContent(this.value());
                                }
                            },
                            {
                                text: '[_______3/4_______][_1/4_]',
                                value: '[cols]<br />[three_quarter] ... [/three_quarter]<br />[one_quarter] ... [/one_quarter]<br />[/cols]',
                                onclick: function() {
                                    ed.insertContent(this.value());
                                }
                            }
                        ]
                    },
                    {
                        text: '3 columns',
                        menu: [
                            {
                                text: '[__1/3__][__1/3__][__1/3__]',
                                value: '[cols]<br />[one_third] ... [/one_third]<br />[one_third] ... [/one_third]<br />[one_third] ... [/one_third]<br />[/cols]',
                                onclick: function() {
                                    ed.insertContent(this.value());
                                }
                            },
                            {
                                text: '[____1/2____][_1/4_][_1/4_]',
                                value: '[cols]<br />[one_half] ... [/one_half]<br />[one_quarter] ... [/one_quarter]<br />[one_quarter] ... [/one_quarter]<br />[/cols]',
                                onclick: function() {
                                    ed.insertContent(this.value());
                                }
                            },
                            {
                                text: '[_1/4_][_1/4_][____1/2____]',
                                value: '[cols]<br />[one_quarter] ... [/one_quarter]<br />[one_quarter] ... [/one_quarter]<br />[one_half] ... [/one_half]<br />[/cols]',
                                onclick: function() {
                                    ed.insertContent(this.value());
                                }
                            },
                            {
                                text: '[_1/4_][____1/2____][_1/4_]',
                                value: '[cols]<br />[one_quarter] ... [/one_quarter]<br />[one_half] ... [/one_half]<br />[one_quarter] ... [/one_quarter]<br />[/cols]',
                                onclick: function() {
                                    ed.insertContent(this.value());
                                }
                            }
                        ]
                    },
                    {
                        text: '4 columns',
                        value: '[cols]<br />[one_quarter] ... [/one_quarter]<br />[one_quarter] ... [/one_quarter]<br />[one_quarter] ... [/one_quarter]<br />[one_quarter] ... [/one_quarter]<br />[/cols]',
                        onclick: function() {
                            ed.insertContent(this.value());
                        }
                    },
                    {
                        text: '5 columns',
                        value: '[cols]<br />[one_fifth] ... [/one_fifth]<br />[one_fifth] ... [/one_fifth]<br />[one_fifth] ... [/one_fifth]<br />[one_fifth] ... [/one_fifth]<br />[one_fifth] ... [/one_fifth]<br />[/cols]',
                        onclick: function() {
                            ed.insertContent(this.value());
                        }
                    },
                    {
                        text: '6 columns',
                        value: '[cols]<br />[one_sixth] ... [/one_sixth]<br />[one_sixth] ... [/one_sixth]<br />[one_sixth] ... [/one_sixth]<br />[one_sixth] ... [/one_sixth]<br />[one_sixth] ... [/one_sixth]<br />[one_sixth] ... [/one_sixth]<br />[/cols]',
                        onclick: function() {
                            ed.insertContent(this.value());
                        }
                    }
                ]
            });
		}
	});


	tinymce.PluginManager.add('columns', tinymce.plugins.columns);
})();

(function() {
	tinymce.create('tinymce.plugins.typography', {
		init : function(ed, url) {
            ed.addButton('typography', {
                    title: 'Typography',
                    icon: 'us_typography',
                    type: 'menubutton',
                    menu: [
                        {
                            text: 'Mega Heading',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
                                    title: 'Mega Heading',
                                    identifier: 'mega_heading'
                                });
                            }
                        },
                        {
                            text: 'Big Paragraph',
                            value: '[paragraph_big] ... [/paragraph_big]',
                            onclick: function() {
                                ed.insertContent(this.value());
                            }
                        },
                        {
                            text: 'Highlight',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
                                    title: 'Highlight',
                                    identifier: 'highlight'
                                });
                            }
                        }
                    ]
            });
		}
	});


	tinymce.PluginManager.add('typography', tinymce.plugins.typography);
})();

/**
 * Team
 */
(function() {
	tinymce.create('tinymce.plugins.team_member', {
		init : function(ed, url) {
			ed.addButton('team_member', {
				title : 'Add Team Member',
				image : url+'/team.png',
				onclick : function() {
					tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
						title: 'Team Member',
						identifier: 'team_member'
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('team_member', tinymce.plugins.team_member);
})();

/**
 * Button
 */
(function() {
	tinymce.create('tinymce.plugins.us_button', {
		init : function(ed, url) {
			ed.addButton('us_button', {
				title : 'Add Button',
				image : url+'/button.png',
				onclick : function() {
					tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
						title: 'Button',
						identifier: 'button'
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('us_button', tinymce.plugins.us_button);
})();

/**
 * Separator
 */
(function() {
	tinymce.create('tinymce.plugins.separator_btn', {
		init : function(ed, url) {
			ed.addButton('separator_btn', {
				title : 'Add Separator',
				image : url+'/separator.png',
				onclick : function() {
					tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
						title: 'Separator',
						identifier: 'separator'
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('separator_btn', tinymce.plugins.separator_btn);
})();

/**
 * Icon
 */
(function() {
	tinymce.create('tinymce.plugins.icon', {
		init : function(ed, url) {
			ed.addButton('icon', {
				title : 'Add Single Icon',
				image : url+'/icon.png',
				onclick : function() {
					tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
						title: 'Icon',
						identifier: 'icon'
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('icon', tinymce.plugins.icon);
})();

/**
 * Iconbox
 */
(function() {
	tinymce.create('tinymce.plugins.iconbox', {
		init : function(ed, url) {
			ed.addButton('iconbox', {
				title : 'Add IconBox',
				image : url+'/iconbox.png',
				onclick : function() {
					tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
						title: 'IconBox',
						identifier: 'iconbox'
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('iconbox', tinymce.plugins.iconbox);
})();

/**
 * Testimonial
 */
(function() {
	tinymce.create('tinymce.plugins.testimonial', {
		init : function(ed, url) {
			ed.addButton('testimonial', {
				title : 'Add Testimonial',
				image : url+'/testimonial.png',
				onclick : function() {
					tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
						title: 'Testimonial',
						identifier: 'testimonial'
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('testimonial', tinymce.plugins.testimonial);
})();

/**
 * Portfolio
 */
(function() {
	tinymce.create('tinymce.plugins.portfolio', {
		init : function(ed, url) {
			ed.addButton('portfolio', {
				title : 'Add Portfolio',
				image : url+'/gallery.png',
				onclick : function() {
					tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
						title: 'Portfolio',
						identifier: 'portfolio'
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('portfolio', tinymce.plugins.portfolio);
})();

/**
 * Blog
 */
(function() {
	tinymce.create('tinymce.plugins.blog', {
		init : function(ed, url) {
			ed.addButton('blog', {
				title : 'Add Blog',
				image : url+'/blogs.png',
				onclick : function() {
					tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
						title: 'Blog',
						identifier: 'blog'
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('blog', tinymce.plugins.blog);
})();

/**
 * Simple Slider
 */
(function() {
	tinymce.create('tinymce.plugins.simple_slider', {
		init : function(ed, url) {
			ed.addButton('simple_slider', {
				title : 'Add Simple Slider',
				image : url+'/slider.png',
				onclick : function () {
					tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
						title: 'Simple Slider',
						identifier: 'simple_slider'
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('simple_slider', tinymce.plugins.simple_slider);
})();

/**
 * Contact Form
 */
(function() {
	tinymce.create('tinymce.plugins.contact_form', {
		init : function(ed, url) {
			ed.addButton('contact_form', {
				title : 'Add Contact Form',
				image : url+'/form.png',
				onclick : function() {
					ed.selection.setContent('[contact_form]');

				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('contact_form', tinymce.plugins.contact_form);
})();

/**
* Pricing Table
*/
(function() {
	tinymce.create('tinymce.plugins.pricing_table', {
		init : function(ed, url) {
			ed.addButton('pricing_table', {
				title : 'Add Pricing Table',
				image : url+'/pricing.png',
				onclick : function() {
					ed.selection.setContent('[pricing_table]<br><br>[pricing_column title="Standard" type="" price="$10" time="per month"]<br>[pricing_row]Feature 1[/pricing_row]<br>[pricing_row]Feature 2[/pricing_row]<br>[pricing_footer url="" color="text" size="" outlined="1"]Signup[/pricing_footer]<br>[/pricing_column]<br><br>[pricing_column title="Business" type="featured" price="$20" time="per month"]<br>[pricing_row]Feature 1[/pricing_row]<br>[pricing_row]Feature 2[/pricing_row]<br>[pricing_footer url="" color="primary" size="" outlined="1"]Signup[/pricing_footer]<br>[/pricing_column]<br><br>[/pricing_table]');

				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('pricing_table', tinymce.plugins.pricing_table);
})();

/**
 * Tabs
 */
(function() {
	tinymce.create('tinymce.plugins.tabs', {
		init : function(ed, url) {
			ed.addButton('tabs', {
				title : 'Add Tabs',
				image : url+'/tabs.png',
				onclick :  function () {
					tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
						title: 'Tabs',
						identifier: 'tabs'
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('tabs', tinymce.plugins.tabs);
})();

/**
 * Accordion
 */
(function() {
	tinymce.create('tinymce.plugins.accordion', {
		init : function(ed, url) {
			ed.addButton('accordion', {
				title : 'Add Accordion',
				image : url+'/accordion.png',
				onclick : function () {
					tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
						title: 'Accordion',
						identifier: 'accordion'
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('accordion', tinymce.plugins.accordion);
})();

/**
 * Toggle
 */
(function() {
	tinymce.create('tinymce.plugins.toggle', {
		init : function(ed, url) {
			ed.addButton('toggle', {
				title : 'Add Toggles',
				image : url+'/toggle.png',
				onclick : function() {
					tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
						title: 'Toggle',
						identifier: 'toggle'
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('toggle', tinymce.plugins.toggle);
})();

/**
 * Video
 */
(function() {
	tinymce.create('tinymce.plugins.responsive_video', {
		init : function(ed, url) {
			ed.addButton('responsive_video', {
				title : 'Add Video',
				image : url+'/video.png',
				onclick : function() {
					tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
						title: 'Video',
						identifier: 'responsive_video'
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('responsive_video', tinymce.plugins.responsive_video);
})();

/**
 * Google Maps
 */
(function() {
	tinymce.create('tinymce.plugins.gmaps', {
		init : function(ed, url) {
			ed.addButton('gmaps', {
				title : 'Add Google Maps',
				image : url+'/map.png',
				onclick : function () {
					tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
						title: 'Google Maps',
						identifier: 'gmaps'
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('gmaps', tinymce.plugins.gmaps);
})();

/**
 * Social Links
 */
(function() {
	tinymce.create('tinymce.plugins.social_links', {
		init : function(ed, url) {
			ed.addButton('social_links', {
				title : 'Social Links',
				image : url+'/social.png',
				onclick : function() {
					tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
						title: 'Social Links',
						identifier: 'social_links'
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('social_links', tinymce.plugins.social_links);
})();

/**
 * Actionbox
 */
(function() {
	tinymce.create('tinymce.plugins.actionbox', {
		init : function(ed, url) {
			ed.addButton('actionbox', {
				title : 'Add ActionBox',
				image : url+'/actionbox.png',
				onclick : function() {
					tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
						title: 'ActionBox',
						identifier: 'actionbox'
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('actionbox', tinymce.plugins.actionbox);
})();


/**
 * Counter
 */
(function() {
	tinymce.create('tinymce.plugins.counter', {
		init : function(ed, url) {
			ed.addButton('counter', {
				title : 'Add Counter',
				image : url+'/counter.png',
				onclick : function() {
					tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
						title: 'Counter',
						identifier: 'counter'
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('counter', tinymce.plugins.counter);
})();

/**
 * Message Box
 */
(function() {
	tinymce.create('tinymce.plugins.message_box', {
		init : function(ed, url) {
			ed.addButton('message_box', {
				title : 'Add Message Box',
				image : url+'/alert.png',
				onclick : function () {
					tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
						title: 'Message Box',
						identifier: 'message_box'
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('message_box', tinymce.plugins.message_box);
})();

/**
 * Clients
 */
(function() {
	tinymce.create('tinymce.plugins.clients', {
		init : function(ed, url) {
			ed.addButton('clients', {
				title : 'Add Client Logos',
				image : url+'/clients.png',
				onclick : function() {
                    tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
                        title: 'Client Logos',
                        identifier: 'clients'
                    });

				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('clients', tinymce.plugins.clients);
})();