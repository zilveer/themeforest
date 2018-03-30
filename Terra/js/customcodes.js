(function() {  
    tinymce.create('tinymce.plugins.boc_button', {  
        init : function(ed, url) {  
            ed.addButton('boc_button', {  
                title : 'Add a Button Link',  
                image : url+'/../images/shortcode_icons/button_link.png',  
                onclick : function() {  
                     ed.selection.setContent('[button href="" target="" css_classes="e.g. button_hilite button_pale sm_button"]' + ed.selection.getContent() + '[/button]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('boc_button', tinymce.plugins.boc_button);  
})();  

(function() {  
	tinymce.create('tinymce.plugins.checklist', {  
		init : function(ed, url) {  
		ed.addButton('checklist', {  
			title : 'Add a List',  
			image : url+'/../images/shortcode_icons/ul.png',  
			onclick : function() {
				ed.selection.setContent('[checklist type="eg. checked, dotted, arrowed" margin_bottom="no"]<ul class="checked">\r<li>List Item #1</li>\r<li>List Item #2</li>\r<li>List Item #3</li>\r</ul>[/checklist]');
			}
		});
	},
	createControl : function(n, cm) {
		return null;
	},
	});
	tinymce.PluginManager.add('checklist', tinymce.plugins.checklist);
})();

(function() {  
	tinymce.create('tinymce.plugins.border', {  
		init : function(ed, url) {  
		ed.addButton('border', {  
			title : 'Add a Border',  
			image : url+'/../images/shortcode_icons/border.png',  
			onclick : function() {
				ed.selection.setContent('[border margin="no"][/border]');
			}
		});
	},
	createControl : function(n, cm) {
		return null;
	},
	});
	tinymce.PluginManager.add('border', tinymce.plugins.border);
})();


(function() {  
	tinymce.create('tinymce.plugins.big_title', {  
		init : function(ed, url) {  
			ed.addButton('big_title', {  
				title : 'Add a Big Title Section',  
				image : url+'/../images/shortcode_icons/big_title.png',  
				onclick : function() {
					ed.selection.setContent('[big_title small_margin="no"]<h1>Some of <strong>Our work</strong> &amp; projects</h1><h2><span>We are a passionate about design bunch of fellas that take pride in their work</span></h2>[/big_title]');
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		},
	});
	tinymce.PluginManager.add('big_title', tinymce.plugins.big_title);
})();


(function() {  
	tinymce.create('tinymce.plugins.feat_text', {  
		init : function(ed, url) {  
			ed.addButton('feat_text', {  
				title : 'Add Big Icon Featured Text Section',  
				image : url+'/../images/shortcode_icons/feat_text.png',  
				onclick : function() {
					ed.selection.setContent('[feat_text title="Featured Title" icon="eg. screen, cog, profile, flag, bulb etc." href=""]Featured Text[/feat_text]');
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		},
	});
	tinymce.PluginManager.add('feat_text', tinymce.plugins.feat_text);
})();



(function() {  
	tinymce.create('tinymce.plugins.feat_text_aqua', {  
		init : function(ed, url) {  
			ed.addButton('feat_text_aqua', {  
				title : 'Add Iconed Featured Text Section - Aqua Style',  
				image : url+'/../images/shortcode_icons/feat_text_iconed.png',  
				onclick : function() {
					ed.selection.setContent('[feat_text_aqua title="Featured Title" icon="eg. icon-user, icon-heart" href=""]Featured Text[/feat_text_aqua]');
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		},
	});
	tinymce.PluginManager.add('feat_text_aqua', tinymce.plugins.feat_text_aqua);
})();



(function() {  
	tinymce.create('tinymce.plugins.table', {  
		init : function(ed, url) {  
			ed.addButton('table', {  
				title : 'Add a Table (Terra-style)',  
				image : url+'/../images/shortcode_icons/table.png',  
				onclick : function() {
					ed.selection.setContent('<table class="aqua_table"><tr><th>Header 1</th><th>Header 2</th><th>Header 3</th></tr><tr><td>Item 1</td><td>Description of Item 1</td><td>$200</td></tr><tr><td>Item 2</td><td>Description of Item 2</td><td>$300</td></tr></table>');
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		},
	});
	tinymce.PluginManager.add('table', tinymce.plugins.table);
})();


(function() {  
	tinymce.create('tinymce.plugins.highlight', {  
		init : function(ed, url) {  
		ed.addButton('highlight', {  
			title : 'Add a Text HighLight',  
			image : url+'/../images/shortcode_icons/highlight.png',  
			onclick : function() {
			ed.selection.setContent('[highlight dark="no"]' + ed.selection.getContent() + '[/highlight]');
		}
		});
	},
	createControl : function(n, cm) {
		return null;
	},
	});
	tinymce.PluginManager.add('highlight', tinymce.plugins.highlight);
})();


(function() {  
	tinymce.create('tinymce.plugins.boc_tooltip', {  
		init : function(ed, url) {  
			ed.addButton('boc_tooltip', {  
				title : 'Add a Text Tooltip',  
				image : url+'/../images/shortcode_icons/tooltip.png',  
				onclick : function() {
					ed.selection.setContent('[tooltip title="Tooltip Text"]' + ed.selection.getContent() + '[/tooltip]');
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		},
	});
	tinymce.PluginManager.add('boc_tooltip', tinymce.plugins.boc_tooltip);
})();


(function() {  
	tinymce.create('tinymce.plugins.big_heading', {  
		init : function(ed, url) {  
			ed.addButton('big_heading', {  
				title : 'Add a Terra Style Big Heading',  
				image : url+'/../images/shortcode_icons/heading_big.png',  
				onclick : function() {
					ed.selection.setContent('[big_heading centered="no"]' + ed.selection.getContent() + '[/big_heading]');
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		},
	});
	tinymce.PluginManager.add('big_heading', tinymce.plugins.big_heading);
})();


(function() {  
	tinymce.create('tinymce.plugins.heading', {  
		init : function(ed, url) {  
			ed.addButton('heading', {  
				title : 'Add a Terra Style Heading',  
				image : url+'/../images/shortcode_icons/heading.png',  
				onclick : function() {
					ed.selection.setContent('[heading centered="yes" margin_bottom="no"]' + ed.selection.getContent() + '[/heading]');
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		},
	});
	tinymce.PluginManager.add('heading', tinymce.plugins.heading);
})();


(function() {  
	tinymce.create('tinymce.plugins.message', {  
		init : function(ed, url) {  
			ed.addButton('message', {  
				title : 'Add a Message box',  
				image : url+'/../images/shortcode_icons/message.png',  
				onclick : function() {
					ed.selection.setContent('[message type="e.g. information, success, attention, warning"]Message Text...[/message]');
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		},
	});
	tinymce.PluginManager.add('message', tinymce.plugins.message);
})();


(function() {  
	tinymce.create('tinymce.plugins.accordion', {  
		init : function(ed, url) {  
		ed.addButton('accordion', {  
			title : 'Add an Accordion',  
			image : url+'/../images/shortcode_icons/accordion.png',  
			onclick : function() {
				ed.selection.setContent('[accordion title="" is_open="no"]...[/accordion]');
			}
		});
	},
	createControl : function(n, cm) {
		return null;
	},
	});
	tinymce.PluginManager.add('accordion', tinymce.plugins.accordion);
})();



(function() {  
	tinymce.create('tinymce.plugins.tabs', {  
		init : function(ed, url) {  
			ed.addButton('tabs', {  
				title : 'Add Tabs',  
				image : url+'/../images/shortcode_icons/tabs.png',  
				onclick : function() {
					ed.selection.setContent('[tabs tab1="Tab 1" tab2="Tab 2" tab3="Tab 3"][tab id=1]Tab content 1[/tab][tab id=2]Tab content 2[/tab][tab id=3]Tab content 3[/tab][/tabs]');
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		},
	});
	tinymce.PluginManager.add('tabs', tinymce.plugins.tabs);
})();


(function() {  
	tinymce.create('tinymce.plugins.clients_section', {  
		init : function(ed, url) {  
			ed.addButton('clients_section', {  
				title : 'Add "Clients & Partners" Section',  
				image : url+'/../images/shortcode_icons/clients_section.png',  
				onclick : function() {
					ed.selection.setContent('[clients_section heading="Partners & Clients" subheading="The jolly bunch we get to work with" text="Cleints Section Description Text"]<p>[logo img_url="" text="" href=""][/logo]</p><p>[logo img_url="" text="" href=""][/logo]</p><p>[logo img_url="" text="" href=""][/logo]</p>[/clients_section]');
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		},
	});
	tinymce.PluginManager.add('clients_section', tinymce.plugins.clients_section);
})();


(function() {  
	tinymce.create('tinymce.plugins.counters', {  
		init : function(ed, url) {  
			ed.addButton('counters', {  
				title : 'Add Animated Counters',  
				image : url+'/../images/shortcode_icons/counter.png',  
				onclick : function() {
					ed.selection.setContent('[counters]<p>[counter_item id=1 number="77" title="Counter Title 1"][/counter_item]</p><p>[counter_item id=2 number="88" title="Counter Title 2"][/counter_item]</p><p>[counter_item id=3 number="99" title="Counter Title 3"][/counter_item]</p>[/counters]');
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		},
	});
	tinymce.PluginManager.add('counters', tinymce.plugins.counters);
})();


(function() {  
	tinymce.create('tinymce.plugins.counter_circles', {  
		init : function(ed, url) {  
			ed.addButton('counter_circles', {  
				title : 'Add Animated Circular Counter Spinners',  
				image : url+'/../images/shortcode_icons/counter_circle.png',  
				onclick : function() {
					ed.selection.setContent('[counter_circles]<p>[counter_circle_item id=1 number="77" title="Counter Title 1"][/counter_circle_item]</p><p>[counter_circle_item id=2 number="88" title="Counter Title 2"][/counter_circle_item]</p><p>[counter_circle_item id=3 number="99" title="Counter Title 3"][/counter_circle_item]</p>[/counter_circles]');
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		},
	});
	tinymce.PluginManager.add('counter_circles', tinymce.plugins.counter_circles);
})();



(function() {  
	tinymce.create('tinymce.plugins.row_container', {  
		init : function(ed, url) {  
		ed.addButton('row_container', {  
			title : 'Add a Container Row',  
			image : url+'/../images/shortcode_icons/row.png',  
			onclick : function() {
				ed.selection.setContent('[row_container dark="no]<p>Full Width Column Text</p>[/row_container]');
			}
		});
	},
	createControl : function(n, cm) {
		return null;
	},
	});
	tinymce.PluginManager.add('row_container', tinymce.plugins.row_container);
})();


(function() {  
	tinymce.create('tinymce.plugins.column_row', {
		createControl: function(n, cm) {
			switch (n) {
			
			case 'column_row':
				var mlb = cm.createListBox('column_row', {
					title : 'Row Container',
					onselect : function(v) {
						tinyMCE.activeEditor.execCommand('mceInsertContent', false, v);
					}
				});
				// Add some values to the list box
				mlb.add('Full Width Column',	'[row_container dark="no"]<p>Full Width Column Text</p>[/row_container] ');
				mlb.add('1/2 + 1/2', 			'[row_container dark="no"]<p>[column width="eight" position="first" ]Column 1/2 Text[/column]</p><p>[column width="eight" position="last" ]Column 1/2 Text[/column]</p>[/row_container] ');
				mlb.add('1/3 + 1/3 + 1/3 ', 	'[row_container dark="no"]<p>[column width="1/3" position="first" ]Column 1/3 Text[/column]</p><p>[column width="1/3" position="" ]Column 1/3 Text[/column]</p><p>[column width="1/3" position="last" ]Column 1/3 Text[/column]</p>[/row_container]');
				mlb.add('1/4 + 1/4 + 1/4 + 1/4','[row_container dark="no"]<p>[column width="four" position="first" ]Column 1/4 Text[/column]</p><p>[column width="four" position="" ]Column 1/4 Text[/column]</p><p>[column width="four" position="" ]Column 1/4 Text[/column]</p><p>[column width="four" position="last" ]Column 1/4 Text[/column]</p>[/row_container]');
				mlb.add('1/3 + 2/3', 			'[row_container dark="no"]<p>[column width="1/3" position="first" ] Column 1/3 Text [/column]</p><p>[column width="2/3" position="last" ] Column 2/3 Text [/column]</p>[/row_container] ');
				mlb.add('1/4 + 3/4', 			'[row_container dark="no"]<p>[column width="four" position="first" ] Column 1/4 Text [/column]</p><p>[column width="twelve" position="last" ]Column 3/4 Text[/column]</p>[/row_container] ');
				
				// Return the new listbox instance
				return mlb;
			}
			return null;
		}
	});
	tinymce.PluginManager.add('column_row', tinymce.plugins.column_row);
})();





(function() { 
	tinymce.PluginManager.add( 'column_row_new' , function( editor ){
		editor.addButton('column_row_new', {
			type: 'listbox',
			text: 'Add Row',
			onselect: function(e) {
				editor.insertContent(this.value());
			},
			fixedWidth: true,
			values: [
				{text: 'Full Width Column', value: '[row_container dark="no"]<p>Full Width Column Text</p>[/row_container]'},
				{text: '1/2 + 1/2', value: '[row_container dark="no"]<p>[column width="eight" position="first"]Column 1/2 Text[/column]</p><p>[column width="eight" position="last" ]Column 1/2 Text[/column]</p>[/row_container]'},
				{text: '1/3 + 1/3 + 1/3', value: '[row_container dark="no"]<p>[column width="1/3" position="first"]Column 1/3 Text[/column]</p><p>[column width="1/3" position="" ]Column 1/3 Text[/column]</p><p>[column width="1/3" position="last" ]Column 1/3 Text[/column]</p>[/row_container]'},
				{text: '1/4 + 1/4 + 1/4 + 1/4', value: '[row_container dark="no"]<p>[column width="four" position="first"]Column 1/4 Text[/column]</p><p>[column width="four" position="" ]Column 1/4 Text[/column]</p><p>[column width="four" position="" ]Column 1/4 Text[/column]</p><p>[column width="four" position="last" ]Column 1/4 Text[/column]</p>[/row_container]'},
				{text: '1/3 + 2/3', value: '[row_container dark="no"]<p>[column width="1/3" position="first"] Column 1/3 Text [/column]</p><p>[column width="2/3" position="last" ] Column 2/3 Text [/column]</p>[/row_container]'},
				{text: '1/4 + 3/4', value: '[row_container dark="no"]<p>[column width="four" position="first"] Column 1/4 Text [/column]</p><p>[column width="twelve" position="last" ]Column 3/4 Text[/column]</p>[/row_container]'}
			]
		});
	});
})();






(function() {  
	tinymce.create('tinymce.plugins.column', {  
		init : function(ed, url) {  
		ed.addButton('column', {  
			title : 'Add a Column',  
			image : url+'/../images/shortcode_icons/column.png',  
			onclick : function() {
				ed.selection.setContent('[column width="" position=""]...[/column]');
			}
		});
	},
	createControl : function(n, cm) {
		return null;
	},
	});
	tinymce.PluginManager.add('column', tinymce.plugins.column);
})();


(function() {  
	tinymce.create('tinymce.plugins.testimonials', {  
		init : function(ed, url) {  
			ed.addButton('testimonials', {  
				title : 'Add Testimonials Carousel',  
				image : url+'/../images/shortcode_icons/testimonials.png',  
				onclick : function() {
					ed.selection.setContent('[testimonials heading="Testimonials" auto_scroll="yes"][testimonial width="1/2" author="Author Name #1" author_title="Author Title #1"]Testimonial Content #1[/testimonial][testimonial width="1/2" author="Author Name #2" author_title="Author Title #2"]Testimonial Content #2[/testimonial][/testimonials]');
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		},
	});
	tinymce.PluginManager.add('testimonials', tinymce.plugins.testimonials);
})();


(function() {  
 tinymce.create('tinymce.plugins.youtube', {  
     init : function(ed, url) {  
         ed.addButton('youtube', {  
             title : 'Add a Youtube video',  
			 image : url+'/../images/shortcode_icons/youtube.png', 
             onclick : function() {  
                  ed.selection.setContent('[youtube id="Enter video ID (eg. Wq4Y7ztznKc)" width="600" height="350"]');  

             }  
         });  
     },  
     createControl : function(n, cm) {  
         return null;  
     },  
 });  
 tinymce.PluginManager.add('youtube', tinymce.plugins.youtube);  
})();


(function() {  
 tinymce.create('tinymce.plugins.vimeo', {  
     init : function(ed, url) {  
         ed.addButton('vimeo', {  
             title : 'Add a Vimeo video',  
             image : url+'/../images/shortcode_icons/vimeo.png', 
             onclick : function() {  
                  ed.selection.setContent('[vimeo id="Enter video ID (eg. 10145153)" width="600" height="350"]');  

             }  
         });  
     },  
     createControl : function(n, cm) {  
         return null;  
     },  
 });  
 tinymce.PluginManager.add('vimeo', tinymce.plugins.vimeo);  
})();

(function() {  
    tinymce.create('tinymce.plugins.boc_slider', {  
        init : function(ed, url) {  
            ed.addButton('boc_slider', {  
                title : 'Add an Image Slider',  
                image : url+'/../images/shortcode_icons/slider.png',  
                onclick : function() {  
                     ed.selection.setContent('[slider][slide link="" title=""]image url[/slide][slide link="" title=""]image url[/slide][/slider]');
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('boc_slider', tinymce.plugins.boc_slider);  
})();


(function() {
	tinymce.create('tinymce.plugins.posts_carousel', {
		init : function(ed, url) {
			ed.addButton('posts_carousel', {
				title : 'Add a Post Items Carousel',  
				image : url+'/../images/shortcode_icons/carousel.png',  
				onclick : function() {
					ed.selection.setContent('[posts_carousel heading="Latest Posts" post_type="post" category_slug="" show_pic="yes" show_date="yes" centered_title="yes" order_by="date" order="DESC" limit="10" excerpt="yes" excerpt_char_limit="64" exclude_current="yes" width="four columns" scroll_by="4"][/posts_carousel]');
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		},
	});
	tinymce.PluginManager.add('posts_carousel', tinymce.plugins.posts_carousel);
})();

(function() {  
    tinymce.create('tinymce.plugins.person', {  
        init : function(ed, url) {  
            ed.addButton('person', {  
                title : 'Add a Person',  
                image : url+'/../images/shortcode_icons/person.png',  
                onclick : function() {  
                     ed.selection.setContent('[person name="John Doe" picture_url="" title="Manager" description="Description" twitter="" facebook="" googleplus="" linkedin="" pinterest=""][/person]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('person', tinymce.plugins.person);  
})();

(function() {  
	tinymce.create('tinymce.plugins.portfolio_carousel', {  
		init : function(ed, url) {  
		ed.addButton('portfolio_carousel', {  
			title : 'Add a Portfolio Items Carousel',  
			image : url+'/../images/shortcode_icons/portfolio.png',  
			onclick : function() {  
			ed.selection.setContent('[portfolio_carousel heading="" limit="10" order_by="rand" category_name="" centered_title="yes"][/portfolio_carousel]');  
			
		}  
		});  
	},  
	createControl : function(n, cm) {  
		return null;  
	},  
	});  
	tinymce.PluginManager.add('portfolio_carousel', tinymce.plugins.portfolio_carousel);  
})();

(function() {  
    tinymce.create('tinymce.plugins.price_table', {  
        init : function(ed, url) {  
            ed.addButton('price_table', {  
                title : 'Add a Price Table',  
                image : url+'/../images/shortcode_icons/price_table.png',  
                onclick : function() {  
                     ed.selection.setContent('[price_table columns="4"]<br /><br />[price_column title="Standard"][price_amount]$39[/price_amount][price_desc]Feature 1[/price_desc][price_desc]Feature 2[/price_desc][price_desc]Feature 3[/price_desc][price_footer][button href="" target="" css_classes="sm_button button_pale"]SignUp[/button][/price_footer][/price_column]<br /><br />[price_column title="Upgraded"][price_amount]$49[/price_amount][price_desc]Feature 1[/price_desc][price_desc]Feature 2[/price_desc][price_desc]Feature 3[/price_desc][price_footer][button href="" target="" css_classes="sm_button button_pale"]SignUp[/button][/price_footer][/price_column]<br /><br />[price_column type="featured" title="Premium"][price_amount]$69[/price_amount][price_desc]Feature 1[/price_desc][price_desc]Feature 2[/price_desc][price_desc]Feature 3[/price_desc][price_footer][button href="" target="" css_classes="sm_button button_hilite"]SignUp[/button][/price_footer][/price_column]<br /><br />[price_column type="" title="Professional"][price_amount]$99[/price_amount][price_desc]Feature 1[/price_desc][price_desc]Feature 2[/price_desc][price_desc]Feature 3[/price_desc][price_footer][button href="" target="" css_classes="sm_button button_pale"]SignUp[/button][/price_footer][/price_column]<br /><br />[/price_table]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('price_table', tinymce.plugins.price_table);  
})();

(function() {  
    tinymce.create('tinymce.plugins.icon', {  
        init : function(ed, url) {  
            ed.addButton('icon', {  
                title : 'Add an Icon',  
                image : url+'/../images/shortcode_icons/icon.png',  
                onclick : function() {  
                     ed.selection.setContent('[icon type="icon-star"][/icon]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('icon', tinymce.plugins.icon);  
})();