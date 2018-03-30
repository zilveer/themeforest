(function() {  
    tinymce.create('tinymce.plugins.button', {  
        init : function(ed, url) {  
            ed.addButton('button', {  
                title : 'Add a Button',  
                image : url+'/buttons/button.gif',  
                onclick : function() {  
                     ed.selection.setContent('[button link="#" size="small" target="self"]' + ed.selection.getContent() + '[/button]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('button', tinymce.plugins.button);  
    
    
    
    ////////////////////
    
    
    tinymce.create('tinymce.plugins.divider', {  
        init : function(ed, url) {  
            ed.addButton('divider', {  
                title : 'Add a Divider',  
                image : url+'/buttons/divider.gif',  
                onclick : function() {  
                     ed.selection.setContent('[divider]' + ed.selection.getContent() + ' [/divider]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('divider', tinymce.plugins.divider);
    
    
   ////////////////////
    
    
    tinymce.create('tinymce.plugins.featuredfulltabs', {  
        init : function(ed, url) {  
            ed.addButton('featuredfulltabs', {  
                title : 'Add a Tab Feature',  
                image : url+'/buttons/featuredfull.gif',  
                onclick : function() {  
                     ed.selection.setContent('[tabs tab1="Tab 1 Title" tab2="Tab 2 Title" tab3="Tab 3 Title"] <br />[tab]Tab 1 Content' + ed.selection.getContent() + '[/tab] <br />[tab]Tab 2 Content[/tab] <br />[tab]Tab 3 Content[/tab]<br />[/tabs]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('featuredfulltabs', tinymce.plugins.featuredfulltabs);
	
	////////////////////
    
    tinymce.create('tinymce.plugins.lightbox', {  
        init : function(ed, url) {  
            ed.addButton('lightbox', {  
                title : 'Add a lightbox',  
                image : url+'/buttons/lightbox.gif',  
                onclick : function() {  
                     ed.selection.setContent('[lightbox link="#"]' + ed.selection.getContent() + '[/lightbox]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('lightbox', tinymce.plugins.lightbox);
    
   ////////////////////
   
    tinymce.create('tinymce.plugins.onehalf', {  
        init : function(ed, url) {  
            ed.addButton('onehalf', {  
                title : 'One Half Column',  
                image : url+'/buttons/half.gif',  
                onclick : function() {  
                     ed.selection.setContent('[one_half]' + ed.selection.getContent() + '[/one_half]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('onehalf', tinymce.plugins.onehalf);  
    
	   ////////////////////
   
    tinymce.create('tinymce.plugins.onehalflast', {  
        init : function(ed, url) {  
            ed.addButton('onehalflast', {  
                title : 'One Half Last Column',  
                image : url+'/buttons/half-last.gif',  
                onclick : function() {  
                     ed.selection.setContent('[one_half_last]' + ed.selection.getContent() + '[/one_half_last]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('onehalflast', tinymce.plugins.onehalflast); 
   
   ////////////////////
   
    tinymce.create('tinymce.plugins.onethird', {  
        init : function(ed, url) {  
            ed.addButton('onethird', {  
                title : 'One Third Column',  
                image : url+'/buttons/onethird.gif',  
                onclick : function() {  
                     ed.selection.setContent('[one_third]' + ed.selection.getContent() + '[/one_third]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('onethird', tinymce.plugins.onethird);  
    
	   ////////////////////
   
    tinymce.create('tinymce.plugins.onethirdlast', {  
        init : function(ed, url) {  
            ed.addButton('onethirdlast', {  
                title : 'One Third Last Column',  
                image : url+'/buttons/onethird-last.gif',  
                onclick : function() {  
                     ed.selection.setContent('[one_third_last]' + ed.selection.getContent() + '[/one_third_last]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('onethirdlast', tinymce.plugins.onethirdlast); 
	
	////////////////////
   
    tinymce.create('tinymce.plugins.twothird', {  
        init : function(ed, url) {  
            ed.addButton('twothird', {  
                title : 'Two Thirds Column',  
                image : url+'/buttons/twothird.gif',  
                onclick : function() {  
                     ed.selection.setContent('[two_third]' + ed.selection.getContent() + '[/two_third]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('twothird', tinymce.plugins.twothird);  
    
	   ////////////////////
	   
   tinymce.create('tinymce.plugins.twothirdlast', {  
        init : function(ed, url) {  
            ed.addButton('twothirdlast', {  
                title : 'Two Thirds Column Last',  
                image : url+'/buttons/twothird-last.gif',  
                onclick : function() {  
                     ed.selection.setContent('[two_third_last]' + ed.selection.getContent() + '[/two_third_last]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('twothirdlast', tinymce.plugins.twothirdlast); 
	
	   ////////////////////
   
    tinymce.create('tinymce.plugins.onefourth', {  
        init : function(ed, url) {  
            ed.addButton('onefourth', {  
                title : 'One fourth Column',  
                image : url+'/buttons/onefourth.gif',  
                onclick : function() {  
                     ed.selection.setContent('[one_fourth]' + ed.selection.getContent() + '[/one_fourth]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('onefourth', tinymce.plugins.onefourth);  
    
	   ////////////////////
   
    tinymce.create('tinymce.plugins.onefourthlast', {  
        init : function(ed, url) {  
            ed.addButton('onefourthlast', {  
                title : 'One fourth Last Column',  
                image : url+'/buttons/onefourth-last.gif',  
                onclick : function() {  
                     ed.selection.setContent('[one_fourth_last]' + ed.selection.getContent() + '[/one_fourth_last]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('onefourthlast', tinymce.plugins.onefourthlast); 
	
   ////////////////////
   
    tinymce.create('tinymce.plugins.threefourth', {  
        init : function(ed, url) {  
            ed.addButton('threefourth', {  
                title : 'Three fourth Column',  
                image : url+'/buttons/threefourth.gif',  
                onclick : function() {  
                     ed.selection.setContent('[three_fourth]' + ed.selection.getContent() + '[/three_fourth]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('threefourth', tinymce.plugins.threefourth);  
    
	   ////////////////////
   
    tinymce.create('tinymce.plugins.threefourthlast', {  
        init : function(ed, url) {  
            ed.addButton('threefourthlast', {  
                title : 'Three fourth Last Column',  
                image : url+'/buttons/threefourth-last.gif',  
                onclick : function() {  
                     ed.selection.setContent('[three_fourth_last]' + ed.selection.getContent() + '[/three_fourth_last]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('threefourthlast', tinymce.plugins.threefourthlast); 
   
   	//////////////////// one fifth buttons
   
    tinymce.create('tinymce.plugins.onefifth', {  
        init : function(ed, url) {  
            ed.addButton('onefifth', {  
                title : 'One fifth Column',  
                image : url+'/buttons/onefifth.gif',  
                onclick : function() {  
                     ed.selection.setContent('[one_fifth]' + ed.selection.getContent() + '[/one_fifth]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('onefifth', tinymce.plugins.onefifth);  
    
	   //////////////////// one fifth buttons last
   
    tinymce.create('tinymce.plugins.onefifthlast', {  
        init : function(ed, url) {  
            ed.addButton('onefifthlast', {  
                title : 'One fifth Last Column',  
                image : url+'/buttons/onefifth-last.gif',  
                onclick : function() {  
                     ed.selection.setContent('[one_fifth_last]' + ed.selection.getContent() + '[/one_fifth_last]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('onefifthlast', tinymce.plugins.onefifthlast); 
	
	   	//////////////////// two fifth buttons
   
    tinymce.create('tinymce.plugins.twofifth', {  
        init : function(ed, url) {  
            ed.addButton('twofifth', {  
                title : 'two fifth Column',  
                image : url+'/buttons/twofifth.gif',  
                onclick : function() {  
                     ed.selection.setContent('[two_fifth]' + ed.selection.getContent() + '[/two_fifth]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('twofifth', tinymce.plugins.twofifth);  
    
	   //////////////////// two fifth buttons last
   
    tinymce.create('tinymce.plugins.twofifthlast', {  
        init : function(ed, url) {  
            ed.addButton('twofifthlast', {  
                title : 'two fifth Last Column',  
                image : url+'/buttons/twofifth-last.gif',  
                onclick : function() {  
                     ed.selection.setContent('[two_fifth_last]' + ed.selection.getContent() + '[/two_fifth_last]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('twofifthlast', tinymce.plugins.twofifthlast);
	
	   	//////////////////// three fifth buttons
   
    tinymce.create('tinymce.plugins.threefifth', {  
        init : function(ed, url) {  
            ed.addButton('threefifth', {  
                title : 'three fifth Column',  
                image : url+'/buttons/threefifth.gif',  
                onclick : function() {  
                     ed.selection.setContent('[three_fifth]' + ed.selection.getContent() + '[/three_fifth]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('threefifth', tinymce.plugins.threefifth);  
    
	   //////////////////// three fifth buttons last
   
    tinymce.create('tinymce.plugins.threefifthlast', {  
        init : function(ed, url) {  
            ed.addButton('threefifthlast', {  
                title : 'three fifth Last Column',  
                image : url+'/buttons/threefifth-last.gif',  
                onclick : function() {  
                     ed.selection.setContent('[three_fifth_last]' + ed.selection.getContent() + '[/three_fifth_last]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('threefifthlast', tinymce.plugins.threefifthlast);
	
	   	//////////////////// four fifth buttons
   
    tinymce.create('tinymce.plugins.fourfifth', {  
        init : function(ed, url) {  
            ed.addButton('fourfifth', {  
                title : 'four fifth Column',  
                image : url+'/buttons/fourfifth.gif',  
                onclick : function() {  
                     ed.selection.setContent('[four_fifth]' + ed.selection.getContent() + '[/four_fifth]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('fourfifth', tinymce.plugins.fourfifth);  
    
	   //////////////////// four fifth buttons last
   
    tinymce.create('tinymce.plugins.fourfifthlast', {  
        init : function(ed, url) {  
            ed.addButton('fourfifthlast', {  
                title : 'four fifth Last Column',  
                image : url+'/buttons/fourfifth-last.gif',  
                onclick : function() {  
                     ed.selection.setContent('[four_fifth_last]' + ed.selection.getContent() + '[/four_fifth_last]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('fourfifthlast', tinymce.plugins.fourfifthlast);
	
	   	//////////////////// one sixth buttons
   
    tinymce.create('tinymce.plugins.onesixth', {  
        init : function(ed, url) {  
            ed.addButton('onesixth', {  
                title : 'One sixth Column',  
                image : url+'/buttons/onesixth.gif',  
                onclick : function() {  
                     ed.selection.setContent('[one_sixth]' + ed.selection.getContent() + '[/one_sixth]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('onesixth', tinymce.plugins.onesixth);  
    
	   //////////////////// one sixth buttons last
   
    tinymce.create('tinymce.plugins.onesixthlast', {  
        init : function(ed, url) {  
            ed.addButton('onesixthlast', {  
                title : 'One sixth Last Column',  
                image : url+'/buttons/onesixth-last.gif',  
                onclick : function() {  
                     ed.selection.setContent('[one_sixth_last]' + ed.selection.getContent() + '[/one_sixth_last]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('onesixthlast', tinymce.plugins.onesixthlast); 
	
		   	//////////////////// five sixth buttons
   
    tinymce.create('tinymce.plugins.fivesixth', {  
        init : function(ed, url) {  
            ed.addButton('fivesixth', {  
                title : 'five sixth Column',  
                image : url+'/buttons/fivesixth.gif',  
                onclick : function() {  
                     ed.selection.setContent('[five_sixth]' + ed.selection.getContent() + '[/five_sixth]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('fivesixth', tinymce.plugins.fivesixth);  
    
	   //////////////////// five sixth buttons last
   
    tinymce.create('tinymce.plugins.fivesixthlast', {  
        init : function(ed, url) {  
            ed.addButton('fivesixthlast', {  
                title : 'five sixth Last Column',  
                image : url+'/buttons/fivesixth-last.gif',  
                onclick : function() {  
                     ed.selection.setContent('[five_sixth_last]' + ed.selection.getContent() + '[/five_sixth_last]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('fivesixthlast', tinymce.plugins.fivesixthlast); 
   

})();  

