/* *************************************************************** */
/* Featured Products */
/* *************************************************************** */
(function() {  
    tinymce.create('tinymce.plugins.et_featured', {  
        init : function(ed, url) {  
            ed.addButton('et_featured', {  
                title : 'Featured Products',  
                image : url+'/editor_images/et_featured.png',  
                onclick : function() {  
                     ed.selection.setContent('[etheme_featured title="Featured Products" limit="15"]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('et_featured', tinymce.plugins.et_featured);  
})();

/* *************************************************************** */
/* New Products */
/* *************************************************************** */
(function() {  
    tinymce.create('tinymce.plugins.et_new_products', {  
        init : function(ed, url) {  
            ed.addButton('et_new_products', {  
                title : 'New Products',  
                image : url+'/editor_images/et_new_products.png',  
                onclick : function() {  
                     ed.selection.setContent('[etheme_new title="Latest Products" limit="15"]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('et_new_products', tinymce.plugins.et_new_products);  
})();

/* *************************************************************** */
/* Contacts */
/* *************************************************************** */
(function() {  
    tinymce.create('tinymce.plugins.et_contacts', {  
        init : function(ed, url) {  
            ed.addButton('et_contacts', {  
                title : 'Contacts Page',  
                image : url+'/editor_images/et_contacts.png',  
                onclick : function() {  
                     ed.selection.setContent('[etheme_contacts gmap="1"]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('et_contacts', tinymce.plugins.et_contacts);  
})();

/* *************************************************************** */
/* Button */
/* *************************************************************** */
(function() {  
    tinymce.create('tinymce.plugins.et_button', {  
        init : function(ed, url) {  
            ed.addButton('et_button', {  
                title : 'Insert Button Shortcode',  
                image : url+'/editor_images/et_button.png',  
                onclick : function() {  
                     ed.selection.setContent('[button title="Simple Button" url="#" style="big filled"]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('et_button', tinymce.plugins.et_button);  
})();



/* *************************************************************** */
/* Block Quote */
/* *************************************************************** */
(function() {  
    tinymce.create('tinymce.plugins.et_blockquote', {  
        init : function(ed, url) {  
            ed.addButton('et_blockquote', {  
                title : 'Add a block quote',  
                image : url+'/editor_images/et_blockquote.png',  
                onclick : function() {  
                     ed.selection.setContent('[blockquote align=""][/blockquote]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('et_blockquote', tinymce.plugins.et_blockquote);  
})();


/* *************************************************************** */
/* List */
/* *************************************************************** */
(function() {  
    tinymce.create('tinymce.plugins.et_list', {  
        init : function(ed, url) {  
            ed.addButton('et_list', {  
                title : 'List',  
                image : url+'/editor_images/et_list.png',  
                onclick : function() {  
                     ed.selection.setContent('[checklist style="arrow"]\r<li>Item #1</li>\r<li>Item #2</li>\r<li>Item #3</li>\r[/checklist]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('et_list', tinymce.plugins.et_list);  
})();


/* *************************************************************** */
/* Drop Cap */
/* *************************************************************** */
(function() {  
    tinymce.create('tinymce.plugins.eth_dropcap', {  
        init : function(ed, url) {  
            ed.addButton('eth_dropcap', {  
                title : 'Drop Cap',  
                image : url+'/editor_images/et_dropcap.png',  
                onclick : function() {  
                     ed.selection.setContent('[dropcap]D[/dropcap]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('eth_dropcap', tinymce.plugins.eth_dropcap);  
})();

/* *************************************************************** */
/* Tooltip */
/* *************************************************************** */
(function() {  
    tinymce.create('tinymce.plugins.et_tooltip', {  
        init : function(ed, url) {  
            ed.addButton('et_tooltip', {  
                title : 'Tooltip',  
                image : url+'/editor_images/et_tooltip.png',  
                onclick : function() {  
                     ed.selection.setContent('[tooltip position="top" text="Tooltip Text" link=""]Tooltip word[/tooltip]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('et_tooltip', tinymce.plugins.et_tooltip);  
})();

/* *************************************************************** */
/* IBlock */
/* *************************************************************** */
(function() {  
    tinymce.create('tinymce.plugins.et_iblock', {  
        init : function(ed, url) {  
            ed.addButton('et_iblock', {  
                title : 'Information block',  
                image : url+'/editor_images/et_iblock.png',  
                onclick : function() {  
                     ed.selection.setContent('[iblock type="wide" btn="Button Text" link="#"]Text inside the block[/iblock]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('et_iblock', tinymce.plugins.et_iblock);  
})();


/* *************************************************************** */
/* Alert */
/* *************************************************************** */
(function() {  
    tinymce.create('tinymce.plugins.et_alert', {  
        init : function(ed, url) {  
            ed.addButton('et_alert', {  
                title : 'Alert',  
                image : url+'/editor_images/et_alert.png',  
                onclick : function() {  
                     ed.selection.setContent('[alert type="success info error notice"]Text inside the alert[/alert]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('et_alert', tinymce.plugins.et_alert);  
})();


/* *************************************************************** */
/* Row */
/* *************************************************************** */
(function() {  
    tinymce.create('tinymce.plugins.et_row', {  
        init : function(ed, url) {  
            ed.addButton('et_row', {  
                title : 'Insert row (container for columns)',  
                image : url+'/editor_images/et_row.png',  
                onclick : function() {  
                     ed.selection.setContent('[row]Columns here[/row]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('et_row', tinymce.plugins.et_row);  
})();

/* *************************************************************** */
/* Columns 1/2 */
/* *************************************************************** */
(function() {  
    tinymce.create('tinymce.plugins.et_column1_2', {  
        init : function(ed, url) {  
            ed.addButton('et_column1_2', {  
                title : 'Columns 1/2',  
                image : url+'/editor_images/et_column1_2.png',  
                onclick : function() {  
                     ed.selection.setContent('[column size="one-half"][/column]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('et_column1_2', tinymce.plugins.et_column1_2);  
})();

/* *************************************************************** */
/* Columns 1/3 */
/* *************************************************************** */
(function() {  
    tinymce.create('tinymce.plugins.et_column1_3', {  
        init : function(ed, url) {  
            ed.addButton('et_column1_3', {  
                title : 'Columns 1/3',  
                image : url+'/editor_images/et_column1_3.png',  
                onclick : function() {  
                     ed.selection.setContent('[column size="one-third"][/column]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('et_column1_3', tinymce.plugins.et_column1_3);  
})();

/* *************************************************************** */
/* Columns 2/3 */
/* *************************************************************** */
(function() {  
    tinymce.create('tinymce.plugins.et_column2_3', {  
        init : function(ed, url) {  
            ed.addButton('et_column2_3', {  
                title : 'Columns 2/3',  
                image : url+'/editor_images/et_column2_3.png',  
                onclick : function() {  
                     ed.selection.setContent('[column size="two-third"][/column]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('et_column2_3', tinymce.plugins.et_column2_3);  
})();

/* *************************************************************** */
/* Columns 1/4 */
/* *************************************************************** */
(function() {  
    tinymce.create('tinymce.plugins.et_column1_4', {  
        init : function(ed, url) {  
            ed.addButton('et_column1_4', {  
                title : 'Columns 1/4',  
                image : url+'/editor_images/et_column1_4.png',  
                onclick : function() {  
                     ed.selection.setContent('[column size="one-fourth"][/column]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('et_column1_4', tinymce.plugins.et_column1_4);  
})();

/* *************************************************************** */
/* Columns 3/4 */
/* *************************************************************** */
(function() {  
    tinymce.create('tinymce.plugins.et_column3_4', {  
        init : function(ed, url) {  
            ed.addButton('et_column3_4', {  
                title : 'Columns 3/4',  
                image : url+'/editor_images/et_column3_4.png',  
                onclick : function() {  
                     ed.selection.setContent('[column size="three-fourth"][/column]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('et_column3_4', tinymce.plugins.et_column3_4);  
})();


/* *************************************************************** */
/* Tabs */
/* *************************************************************** */
(function() {  
    tinymce.create('tinymce.plugins.et_tabs', {  
        init : function(ed, url) {  
            ed.addButton('et_tabs', {  
                title : 'Tabs',  
                image : url+'/editor_images/et_tabs.png',  
                onclick : function() {  
                     ed.selection.setContent('[tabs]\r[tab title="Tab 1"]Tab 1 text[/tab]\r[tab title="Tab 2"]Tab 2 text[/tab]\r[/tabs]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('et_tabs', tinymce.plugins.et_tabs);  
})();


/* *************************************************************** */
/* Vimeo */
/* *************************************************************** */
(function() {  
    tinymce.create('tinymce.plugins.et_vimeo', {  
        init : function(ed, url) {  
            ed.addButton('et_vimeo', {  
                title : 'Add Vimeo Video',  
                image : url+'/editor_images/et_vimeo.png',  
                onclick : function() {  
                     ed.selection.setContent('[vimeo src="http://player.vimeo.com/video/22439234" height="600" width="800"]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('et_vimeo', tinymce.plugins.et_vimeo);  
})();


/* *************************************************************** */
/* Youtube */
/* *************************************************************** */
(function() {  
    tinymce.create('tinymce.plugins.et_youtube', {  
        init : function(ed, url) {  
            ed.addButton('et_youtube', {  
                title : 'Add YouTube Video',  
                image : url+'/editor_images/et_youtube.png',  
                onclick : function() {  
                     ed.selection.setContent('[youtube src="http://www.youtube.com/embed/mcixldqDIEQ" height="600" width="800"]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('et_youtube', tinymce.plugins.et_youtube);  
})();


/* *************************************************************** */
/* GMap */
/* *************************************************************** */
(function() {  
    tinymce.create('tinymce.plugins.et_gmaps', {  
        init : function(ed, url) {  
            ed.addButton('et_gmaps', {  
                title : 'Add Google Map',  
                image : url+'/editor_images/et_gmaps.png',  
                onclick : function() {  
                     ed.selection.setContent('[gmaps title="Our Location" address="London" height="400" width="800" zoom="14"]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('et_gmaps', tinymce.plugins.et_gmaps);  
})();


/* *************************************************************** */
/* icon */
/* *************************************************************** */
(function() {  
    tinymce.create('tinymce.plugins.et_icon', {  
        init : function(ed, url) {  
            ed.addButton('et_icon', {  
                title : 'Add Icon',  
                image : url+'/editor_images/et_icon.png',  
                onclick : function() {  
                     ed.selection.setContent('[icon name="bolt" size="48" color="454545"]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('et_icon', tinymce.plugins.et_icon);  
})();


/* *************************************************************** */
/* Team member */
/* *************************************************************** */
(function() {  
    tinymce.create('tinymce.plugins.et_tm', {  
        init : function(ed, url) {  
            ed.addButton('et_tm', {  
                title : 'Team Member',  
                image : url+'/editor_images/et_tm.png',  
                onclick : function() {  
                     ed.selection.setContent('[team_member class="span4" name="John Doe" position="CEO" img_src="avatar.jpg"]Member description[/team_member]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('et_tm', tinymce.plugins.et_tm);  
})();


/* *************************************************************** */
/* Team member */
/* *************************************************************** */
(function() {  
    tinymce.create('tinymce.plugins.et_progress', {  
        init : function(ed, url) {  
            ed.addButton('et_progress', {  
                title : 'Progress Bar',  
                image : url+'/editor_images/et_progress.png',  
                onclick : function() {  
                     ed.selection.setContent('[progress complete="65" title="Skill Title"]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('et_progress', tinymce.plugins.et_progress);  
})();


/* *************************************************************** */
/* Price Table */
/* *************************************************************** */
(function() {  
    tinymce.create('tinymce.plugins.et_ptable', {  
        init : function(ed, url) {  
            ed.addButton('et_ptable', {  
                title : 'Price Table',  
                image : url+'/editor_images/et_ptable.png',  
                onclick : function() {  
                     ed.selection.setContent('[ptable class="style2"]<table class="table"><thead><tr><th>Free</th></tr></thead><tr><td class="plan-price"><sup class="currency">$</sup>19<sup>00</sup><sub>per month</sub></td></tr><tr><td>Illum, adipisci, quis</td></tr><tr><td>2gb</td></tr><tr><td>1.1GHz</td></tr><tfoot><tr><td><a href="#" class="button active">Purchase</a></td></tr></tfoot></table>[/ptable]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('et_ptable', tinymce.plugins.et_ptable);  
})();