/*-----------------------------------------------------------------------------------*/
/*  Add TinyMCE Credit Card
/*-----------------------------------------------------------------------------------*/
(function() {
    tinymce.create('tinymce.plugins.creditcard', {
        init : function(ed, url) {
            ed.addButton('creditcard', {
                title : 'Add Credit Card',
                image : url+'/creditcard.png',
                onclick : function() {
                     ed.selection.setContent('[credit cards="paypal,visa,mastercard,amex,cirrus"]');

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('creditcard', tinymce.plugins.creditcard);
})();

/*-----------------------------------------------------------------------------------*/
/*	Add TinyMCE Product Slider
/*-----------------------------------------------------------------------------------*/
(function() {
    tinymce.create('tinymce.plugins.product_slider', {
        init : function(ed, url) {
            ed.addButton('product_slider', {
                title : 'Add Product Slider',
                image : url+'/products.png',
                onclick : function() {
                     ed.selection.setContent('[product_slider title="Your Title" cat="product category slug" columns="12"]');

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('product_slider', tinymce.plugins.product_slider);
})();

/*-----------------------------------------------------------------------------------*/
/*	Add TinyMCE List Button
/*-----------------------------------------------------------------------------------*/
(function() {
    tinymce.create('tinymce.plugins.list', {
        init : function(ed, url) {
            ed.addButton('list', {
                title : 'Add List Icon',
                image : url+'/list.png',
                onclick : function() {
                     ed.selection.setContent('[list][list_item icon="ok"][/list] ');

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('list', tinymce.plugins.list);
})();

/*-----------------------------------------------------------------------------------*/
/*	Add TinyMCE Member Button
/*-----------------------------------------------------------------------------------*/
(function() {
    tinymce.create('tinymce.plugins.member', {
        init : function(ed, url) {
            ed.addButton('member', {
                title : 'Add Member',
                image : url+'/member.png',
                onclick : function() {
                     ed.selection.setContent('[member name="John Doe" role="Web Developer" url="http://example.com" img="" twitter="http://twitter.com" facebook="http://facebook.com" skype="http://skype.com" google="http://google.de" linkedin="http://linkedin.com" mail="user@user.com"]Description[/member]');

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('member', tinymce.plugins.member);
})();


/*-----------------------------------------------------------------------------------*/
/*  Add TinyMCE Recipe single
/*-----------------------------------------------------------------------------------*/
// (function() {
//     tinymce.create('tinymce.plugins.recipe_single', {
//         init : function(ed, url) {
//             ed.addButton('recipe_single', {
//                 title : 'Add Recipe single Item',
//                 image : url+'/recipe-single.png',
//                 onclick : function() {
//                      ed.selection.setContent('[recipe_single id="your ID of recipe post" style="list/grid"] ');

//                 }
//             });
//         },
//         createControl : function(n, cm) {
//             return null;
//         },
//     });
//     tinymce.PluginManager.add('recipe_single', tinymce.plugins.recipe_single);
// })();


/*-----------------------------------------------------------------------------------*/
/*	Add TinyMCE Recipe Grid
/*-----------------------------------------------------------------------------------*/
(function() {
    tinymce.create('tinymce.plugins.recipe_grid', {
        init : function(ed, url) {
            ed.addButton('recipe_grid', {
                title : 'Add Recipe Grid Item',
                image : url+'/recipe-grid.png',
                onclick : function() {
                     ed.selection.setContent('[recipe_grid ids="recipe id" post_page="1/2/3.." taxonomy="taxonomies name" categories="category name" orderby="date/name/comment_count" order="asc/desc"] ');

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('recipe_grid', tinymce.plugins.recipe_grid);
})();

/*-----------------------------------------------------------------------------------*/
/*	Add TinyMCE Recipe List
/*-----------------------------------------------------------------------------------*/
(function() {
    tinymce.create('tinymce.plugins.recipe_list', {
        init : function(ed, url) {
            ed.addButton('recipe_list', {
                title : 'Add Recipe List Item',
                image : url+'/recipe-list.png',
                onclick : function() {
                     ed.selection.setContent('[recipe_list ids="recipe id" post_page="1/2/3.." taxonomy="taxonomies name" categories="category name" orderby="date/name/comment_count" order="asc/desc"]');

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('recipe_list', tinymce.plugins.recipe_list);
})();

/*-----------------------------------------------------------------------------------*/
/*  Add TinyMCE Recipe Slider
/*-----------------------------------------------------------------------------------*/

(function() {
    tinymce.create('tinymce.plugins.recipe_slider', {
        init : function(ed, url) {
            ed.addButton('recipe_slider', {
                title : 'Add Recipe Slider Item',
                image : url+'/recipe-slider.png',
                onclick : function() {
                     ed.selection.setContent('[recipe_slider version="1/2" per_page="1/2/3.." taxonomy="taxonomies name" categories="category name" orderby="date/name/comment_count" order="asc/desc"]');

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('recipe_slider', tinymce.plugins.recipe_slider);
})();


/*-----------------------------------------------------------------------------------*/
/*	Add TinyMCE Toggle Button
/*-----------------------------------------------------------------------------------*/
(function() {
    tinymce.create('tinymce.plugins.toggles', {
        init : function(ed, url) {
            ed.addButton('toggles', {
                title : 'Add Toggle',
                image : url+'/toggles.png',
                onclick : function() {
                     ed.selection.setContent('[toggles title="Toggle Title" icon="star"]Your Content goes here...[/toggles]');

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('toggles', tinymce.plugins.toggles);
})();

/*-----------------------------------------------------------------------------------*/
/*	Add TinyMCE Linked More
/*-----------------------------------------------------------------------------------*/
(function() {
    tinymce.create('tinymce.plugins.linked_more', {
        init : function(ed, url) {
            ed.addButton('linked_more', {
                title : 'Add Linked More',
                image : url+'/linked.png',
                onclick : function() {
                     ed.selection.setContent('[linked_more title="Title" link="http://google.com/" color="#bf9764"]');

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('linked_more', tinymce.plugins.linked_more);
})();


/*-----------------------------------------------------------------------------------*/
/*	Add TinyMCE Google Font
/*-----------------------------------------------------------------------------------*/
(function() {
    tinymce.create('tinymce.plugins.googlefont', {
        init : function(ed, url) {
            ed.addButton('googlefont', {
                title : 'Add Googlefont Typo',
                image : url+'/googlefont.png',
                onclick : function() {
                     ed.selection.setContent('[googlefont font="Open Sans" float="none" line_height="1.2" size="36px" margin="10px 0 20px 0" color="" align="center/left/right"]Your Text...[/googlefont]');

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('googlefont', tinymce.plugins.googlefont);
})();

/*-----------------------------------------------------------------------------------*/
/*  Add TinyMCE Author Button
/*-----------------------------------------------------------------------------------*/
(function() {
    tinymce.create('tinymce.plugins.author', {
        init : function(ed, url) {
            ed.addButton('author', {
                title : 'Add author Typo',
                image : url+'/author.png',
                onclick : function() {
                     ed.selection.setContent('[author text="title" show_title="yes" num="2" role="administrator"]');

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('author', tinymce.plugins.author);
})();

/*-----------------------------------------------------------------------------------*/
/*	Add TinyMCE 1/2 Button
/*-----------------------------------------------------------------------------------*/
(function() {
    tinymce.create('tinymce.plugins.twocol_one', {
        init : function(ed, url) {
            ed.addButton('twocol_one', {
                title : 'Add 1/2 Columns',
                image : url+'/one_half.png',
                onclick : function() {
                     ed.selection.setContent('[twocol_one]Content here.[/twocol_one] [twocol_one_last]Content here.[/twocol_one_last]');

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('twocol_one', tinymce.plugins.twocol_one);
})();

/*-----------------------------------------------------------------------------------*/
/*	Add TinyMCE 1/3 Button
/*-----------------------------------------------------------------------------------*/
(function() {
    tinymce.create('tinymce.plugins.threecol_one', {
        init : function(ed, url) {
            ed.addButton('threecol_one', {
                title : 'Add 1/3 Columns',
                image : url+'/one_third.png',
                onclick : function() {
                     ed.selection.setContent('[threecol_one]Content here.[/threecol_one] [threecol_one]Content here.[/threecol_one] [threecol_one_last]Content here.[/threecol_one_last]');

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('threecol_one', tinymce.plugins.threecol_one);
})();

/*-----------------------------------------------------------------------------------*/
/*	Add TinyMCE 2/3 Button
/*-----------------------------------------------------------------------------------*/
(function() {
    tinymce.create('tinymce.plugins.threecol_two', {
        init : function(ed, url) {
            ed.addButton('threecol_two', {
                title : 'Add 2/3 Columns',
                image : url+'/two_third.png',
                onclick : function() {
                     ed.selection.setContent('[threecol_two]Content here.[/threecol_two] [threecol_one_last]Content here.[/threecol_one_last]');

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('threecol_two', tinymce.plugins.threecol_two);
})();

/*-----------------------------------------------------------------------------------*/
/*	Add TinyMCE 1/4 Button
/*-----------------------------------------------------------------------------------*/
(function() {
    tinymce.create('tinymce.plugins.fourcol_one', {
        init : function(ed, url) {
            ed.addButton('fourcol_one', {
                title : 'Add 1/4 Columns',
                image : url+'/one_fourth.png',
                onclick : function() {
                     ed.selection.setContent('[fourcol_one]Content here.[/fourcol_one] [fourcol_one]Content here.[/fourcol_one] [fourcol_one]Content here.[/fourcol_one] [fourcol_one_last]Content here.[/fourcol_one_last]');

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('fourcol_one', tinymce.plugins.fourcol_one);
})();

/*-----------------------------------------------------------------------------------*/
/*	Add TinyMCE 3/4 Button
/*-----------------------------------------------------------------------------------*/
(function() {
    tinymce.create('tinymce.plugins.fourcol_three', {
        init : function(ed, url) {
            ed.addButton('fourcol_three', {
                title : 'Add 3/4 Columns',
                image : url+'/three_fourth.png',
                onclick : function() {
                     ed.selection.setContent('[fourcol_three]content[/fourcol_three][fourcol_one_last]content[/fourcol_one_last]');

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('fourcol_three', tinymce.plugins.fourcol_three);
})();

/*-----------------------------------------------------------------------------------*/
/*	Add TinyMCE 1/5 Button
/*-----------------------------------------------------------------------------------*/
(function() {
    tinymce.create('tinymce.plugins.fivecol_one', {
        init : function(ed, url) {
            ed.addButton('fivecol_one', {
                title : 'Add 1/5 Columns',
                image : url+'/one_fifth.png',
                onclick : function() {
                     ed.selection.setContent('[fivecol_one]Content here.[/fivecol_one] [fivecol_one]Content here.[/fivecol_one] [fivecol_one]Content here.[/fivecol_one] [fivecol_one]Content here.[/fivecol_one] [fivecol_one_last]Content here.[/fivecol_one_last]');

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('fivecol_one', tinymce.plugins.fivecol_one);
})();

// /*-----------------------------------------------------------------------------------*/
// /*	Add TinyMCE Teaser Button
// /*-----------------------------------------------------------------------------------*/
(function() {
    tinymce.create('tinymce.plugins.teaser', {
        init : function(ed, url) {
            ed.addButton('teaser', {
                title : 'Add Teaser',
                image : url+'/teaser.png',
                onclick : function() {
                     ed.selection.setContent('[teaser img="your-image-url"]Your Content[/teaser]');


                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('teaser', tinymce.plugins.teaser);
})();


// -----------------------------------------------------------------------------------
// /*	Add TinyMCE Teaserbox Button
// /*-----------------------------------------------------------------------------------*/
(function() {
    tinymce.create('tinymce.plugins.teaserbox', {
        init : function(ed, url) {
            ed.addButton('teaserbox', {
                title : 'Add Teaserbox',
                image : url+'/teaserbox.png',
                onclick : function() {
                     ed.selection.setContent('[teaserbox title="" bgcolor="" bgimage="" button="" link="" buttonsize="" buttoncolor="" buttonbackground="" target="_blank"]Your Content[/teaserbox]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('teaserbox', tinymce.plugins.teaserbox);
})();


/*-----------------------------------------------------------------------------------*/
/*	Add TinyMCE Callout Button
// /*-----------------------------------------------------------------------------------*/
(function() {
    tinymce.create('tinymce.plugins.callout', {
        init : function(ed, url) {
            ed.addButton('callout', {
                title : 'Add Callout',
                image : url+'/callout.png',
                onclick : function() {
                     ed.selection.setContent('[callout title="" background="" button="" link="" buttoncolor="" buttonbackground="" target="_blank" buttonmargin="12px 0 0 0;"]Your Content[/callout] ');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('callout', tinymce.plugins.callout);
})();

/*-----------------------------------------------------------------------------------*/
/*	Add TinyMCE Box Button
// /*-----------------------------------------------------------------------------------*/
(function() {
    tinymce.create('tinymce.plugins.box', {
        init : function(ed, url) {
            ed.addButton('box', {
                title : 'Add Box Field',
                image : url+'/box.png',
                onclick : function() {
                     ed.selection.setContent('[box]Your Content...[/box]');

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('box', tinymce.plugins.box);
})();

/*-----------------------------------------------------------------------------------*/
/*	Add TinyMCE Blog Button
/*-----------------------------------------------------------------------------------*/
(function() {
    tinymce.create('tinymce.plugins.blog', {
        init : function(ed, url) {
            ed.addButton('blog', {
                title : 'Add Blog',
                image : url+'/bloggrid.png',
                onclick : function() {
                     ed.selection.setContent('[blog posts="4" title="Latest From The Blog" show_title="yes or no" categories="Category slugs or all"]');

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('blog', tinymce.plugins.blog);
})();

/*-----------------------------------------------------------------------------------*/
/*	Add TinyMCE Bloglist Button
/*-----------------------------------------------------------------------------------*/
(function() {
    tinymce.create('tinymce.plugins.bloglist', {
        init : function(ed, url) {
            ed.addButton('bloglist', {
                title : 'Add Bloglist',
                image : url+'/bloglist.png',
                onclick : function() {
                     ed.selection.setContent('[bloglist posts="4" title="Latest Blog Entries" show_title="yes or no" categories="Category slugs or all"]');

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('bloglist', tinymce.plugins.bloglist);
})();

/*-----------------------------------------------------------------------------------*/
/*	Add TinyMCE Testimonial Button
/*-----------------------------------------------------------------------------------*/
(function() {
    tinymce.create('tinymce.plugins.testimonial', {
        init : function(ed, url) {
            ed.addButton('testimonial', {
                title : 'Add Testimonial',
                image : url+'/testimonial.png',
                onclick : function() {
                     ed.selection.setContent('[testimonial img="" author="John Doe, Company Inc."]Your Text...[/testimonial]');

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('testimonial', tinymce.plugins.testimonial);
})();

/*-----------------------------------------------------------------------------------*/
/*  Add TinyMCE Parallax
/*-----------------------------------------------------------------------------------*/
(function() {
    tinymce.create('tinymce.plugins.parallax', {
        init : function(ed, url) {
            ed.addButton('parallax', {
                title : 'Add parallax',
                image : url+'/parallax.png',
                onclick : function() {
                     ed.selection.setContent('[parallax img_bg="" height="" padding="" img_pos="" speed="" class=""] your content [/parallax]');

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('parallax', tinymce.plugins.parallax);
})();


/*-----------------------------------------------------------------------------------*/
/*  Add TinyMCE Facebook Login Button
/*-----------------------------------------------------------------------------------*/
(function() {
    tinymce.create('tinymce.plugins.facebooklogin', {
        init : function(ed, url) {
            ed.addButton('facebooklogin', {
                title : 'Add facebook Login Button',
                image : url+'/fblogin.png',
                onclick : function() {
                     ed.selection.setContent('[facebook_login_button]');

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('facebooklogin', tinymce.plugins.facebooklogin);
})();

/*-----------------------------------------------------------------------------------*/
/*  Add TinyMCE Gap Button
/*-----------------------------------------------------------------------------------*/
(function() {
    tinymce.create('tinymce.plugins.gap', {
        init : function(ed, url) {
            ed.addButton('gap', {
                title : 'Add Gap',
                image : url+'/gap.png',
                onclick : function() {
                     ed.selection.setContent('[gap height="20"]');

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('gap', tinymce.plugins.gap);
})();