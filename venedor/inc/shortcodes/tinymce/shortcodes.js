(function() {    
    
    tinymce.create('tinymce.plugins.ShortcodeMce', {
        init : function(ed, url){
            tinymce.plugins.ShortcodeMce.theurl = url;
        },
        createControl : function(btn, e) {
            if ( btn == "shortcodes_button" ) {
                var a = this;    
                var btn = e.createSplitButton('button', {
                    title: "Venedor Shortcode",
                    image: tinymce.plugins.ShortcodeMce.theurl +"/shortcodes.png",
                    icons: false,
                });
                btn.onRenderMenu.add(function (c, b) {
                    
                    a.render( b, "Container", "container" );
                    a.render( b, "Animation", "animate" );
                    a.render( b, "Content Box", "content_box" );
                    a.render( b, "Grid Container", "grid_container" );
                    a.render( b, "Grid Item", "grid_item" );
                    a.render( b, "Title", "title" );
                    a.render( b, "Posts", "posts" );
                    a.render( b, "Posts Slider", "posts_slider" );
                    a.render( b, "Background", "background" );
                    a.render( b, "Brands", "brands" );
                    a.render( b, "Brand", "brand" );
                    a.render( b, "Quote", "quote" );
                    a.render( b, "Counter Circle", "counter_circle" );
                    a.render( b, "Counter Box", "counter_box" );
                    a.render( b, "FontAwesome Icon", "fontawesome" );
                    a.render( b, "Slider", "sw_slider" );
                    a.render( b, "Slide", "sw_slide" );
                    a.render( b, "Feature Box Slider", "feature_box_slider" );
                    a.render( b, "Feature Box", "feature_box" );
                    a.render( b, "Testimonials", "testimonials" );
                    a.render( b, "Testimonial", "testimonial" );
                    a.render( b, "Persons", "persons" );
                    a.render( b, "Person", "person" );
                    a.render( b, "Person Boxs", "person_boxs" );
                    a.render( b, "Person Box", "person_box" );
                    a.render( b, "Persons Slider", "persons_slider" );
                    a.render( b, "Persons Slide", "persons_slide" );
                    a.render( b, "Block", "block" );
                    a.render( b, "Google Map", "map" );
                    a.render( b, "FAQ", "faq" );
                    a.render( b, "Recent Posts", 'recent_posts');
                    a.render( b, "Recent Portfolios", 'recent_portfolios');
                    a.render( b, "SW Bestseller Products", "sw_bestseller_products" );
                    a.render( b, "SW Featured Products", "sw_featured_products");
                    a.render( b, "SW Sale Products", "sw_sale_products");
                    a.render( b, "SW Latest Products", "sw_latest_products");
                    a.render( b, "Pre", "pre" );
                });
                
              return btn;
            }
            return null;               
        },
        render : function(ed, title, id) {
            ed.add({
                title: title,
                onclick: function () {
                    venedor_shortcode_open(title, id);
                    return false;
                }
            })
        }
    
    });
    tinymce.PluginManager.add("shortcodes", tinymce.plugins.ShortcodeMce);
    
})();  