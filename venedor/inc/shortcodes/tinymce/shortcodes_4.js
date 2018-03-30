(function() {
	tinymce.PluginManager.add('shortcodes', function(editor, url) {
		editor.addButton('shortcodes_button', {
		    type: 'menubutton',
            icon: 'venedor',
            tooltip: 'Venedor Shortcode',
            menu: [
				{
                    text: 'Container',
                    value: 'container',
                    onclick: function() {
                        venedor_shortcode_open(this.text(), this.value());
                    }
                },

                {
                    text: 'Animation',
                    value: 'animate',
                    onclick: function() {
                        venedor_shortcode_open(this.text(), this.value());
                    }
                },

                {
                    text: 'Grid Container',
                    value: 'grid_container',
                    onclick: function() {
                        venedor_shortcode_open(this.text(), this.value());
                    }
                },

                {
                    text: 'Grid Item',
                    value: 'grid_item',
                    onclick: function() {
                        venedor_shortcode_open(this.text(), this.value());
                    }
                },

                {
                    text: 'Content Box',
                    value: 'content_box',
                    onclick: function() {
                        venedor_shortcode_open(this.text(), this.value());
                    }
                },

                {
                    text: 'Title',
                    value: 'title',
                    onclick: function() {
                        venedor_shortcode_open(this.text(), this.value());
                    }
                },

                {
                    text: 'Posts',
                    value: 'posts',
                    onclick: function() {
                        venedor_shortcode_open(this.text(), this.value());
                    }
                },

                {
                    text: 'Posts Slider',
                    value: 'posts_slider',
                    onclick: function() {
                        venedor_shortcode_open(this.text(), this.value());
                    }
                },
                  
                {
                    text: 'Background',
                    value: 'background',
                    onclick: function() {
                        venedor_shortcode_open(this.text(), this.value());
                    }
                },
                    
                {
                    text: 'Block',
                    value: 'block',
                    onclick: function() {
                        venedor_shortcode_open(this.text(), this.value());
                    }
                },
                    
                {
                    text: 'Brands',
                    value: 'brands',
                    onclick: function() {
                        venedor_shortcode_open(this.text(), this.value());
                    }
                },
                    
                {
                    text: 'Brand',
                    value: 'brand',
                    onclick: function() {
                        venedor_shortcode_open(this.text(), this.value());
                    }
                },
                    
                {
                    text: 'SW Slider',
                    value: 'sw_slider',
                    onclick: function() {
                        venedor_shortcode_open(this.text(), this.value());
                    }
                },
                    
                {
                    text: 'SW Slide',
                    value: 'sw_slide',
                    onclick: function() {
                        venedor_shortcode_open(this.text(), this.value());
                    }
                },
                    
                {
                    text: 'Quote',
                    value: 'quote',
                    onclick: function() {
                        venedor_shortcode_open(this.text(), this.value());
                    }
                },
                    
                {
                    text: 'Counter Circle',
                    value: 'counter_circle',
                    onclick: function() {
                        venedor_shortcode_open(this.text(), this.value());
                    }
                },
                    
                {
                    text: 'Counter Box',
                    value: 'counter_box',
                    onclick: function() {
                        venedor_shortcode_open(this.text(), this.value());
                    }
                },
                    
                {
                    text: 'Fontawesome Icon',
                    value: 'fontawesome',
                    onclick: function() {
                        venedor_shortcode_open(this.text(), this.value());
                    }
                },

                {
                    text: 'Feature Box Slider',
                    value: 'feature_box_slider',
                    onclick: function() {
                        venedor_shortcode_open(this.text(), this.value());
                    }
                },

                {
                    text: 'Feature Box',
                    value: 'feature_box',
                    onclick: function() {
                        venedor_shortcode_open(this.text(), this.value());
                    }
                },
                    
                {
                    text: 'Testimonials',
                    value: 'testimonials',
                    onclick: function() {
                        venedor_shortcode_open(this.text(), this.value());
                    }
                },
                    
                {
                    text: 'Testimonial',
                    value: 'testimonial',
                    onclick: function() {
                        venedor_shortcode_open(this.text(), this.value());
                    }
                },
                    
                {
                    text: 'Persons',
                    value: 'persons',
                    onclick: function() {
                        venedor_shortcode_open(this.text(), this.value());
                    }
                },
                    
                {
                    text: 'Person',
                    value: 'person',
                    onclick: function() {
                        venedor_shortcode_open(this.text(), this.value());
                    }
                },

                {
                    text: 'Person Boxs',
                    value: 'person_boxs',
                    onclick: function() {
                        venedor_shortcode_open(this.text(), this.value());
                    }
                },
                    
                {
                    text: 'Person Box',
                    value: 'person_box',
                    onclick: function() {
                        venedor_shortcode_open(this.text(), this.value());
                    }
                },

                {
                    text: 'Persons Slider',
                    value: 'persons_slider',
                    onclick: function() {
                        venedor_shortcode_open(this.text(), this.value());
                    }
                },
                    
                {
                    text: 'Persons Slide',
                    value: 'persons_slide',
                    onclick: function() {
                        venedor_shortcode_open(this.text(), this.value());
                    }
                },
                    
                {
                    text: 'Google Map',
                    value: 'map',
                    onclick: function() {
                        venedor_shortcode_open(this.text(), this.value());
                    }
                },
                    
                {
                    text: 'FAQ',
                    value: 'faq',
                    onclick: function() {
                        venedor_shortcode_open(this.text(), this.value());
                    }
                },

                {
                    text: 'Recent Posts',
                    value: 'recent_posts',
                    onclick: function() {
                        venedor_shortcode_open(this.text(), this.value());
                    }
                },

                {
                    text: 'Recent Portfolios',
                    value: 'recent_portfolios',
                    onclick: function() {
                        venedor_shortcode_open(this.text(), this.value());
                    }
                },

                {
                    text: 'SW Bestseller Products',
                    value: 'sw_bestseller_products',
                    onclick: function() {
                        venedor_shortcode_open(this.text(), this.value());
                    }
                },
                    
                {
                    text: 'SW Featured Products',
                    value: 'sw_featured_products',
                    onclick: function() {
                        venedor_shortcode_open(this.text(), this.value());
                    }
                },
                    
                {
                    text: 'SW Sale Products',
                    value: 'sw_sale_products',
                    onclick: function() {
                        venedor_shortcode_open(this.text(), this.value());
                    }
                },
                    
                {
                    text: 'SW Latest Products',
                    value: 'sw_latest_products',
                    onclick: function() {
                        venedor_shortcode_open(this.text(), this.value());
                    }
                },
                
                {
                    text: 'Pre',
                    value: 'pre',
                    onclick: function() {
                        venedor_shortcode_open(this.text(), this.value());
                    }
                }
		    ]
		});
	});

})();