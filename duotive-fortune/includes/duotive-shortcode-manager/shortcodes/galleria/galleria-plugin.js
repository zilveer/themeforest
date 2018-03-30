(function() {
    tinymce.create('tinymce.plugins.galleria', {
        init : function(ed, url) {
			var t = this;			
            ed.addButton('galleria', {
                title : 'Add a Galleria slideshow',
                image : url+'/galleria-icon.png',
                onclick : function() {
					ed.windowManager.open({
						file : url + '/galleria-window.php',
						width : 510,
						height : 350,
						inline : 1
					});					 

                }
            });
			ed.onBeforeSetContent.add(function(ed, o) {
				o.content = t._dt_replacer(o.content);
			});			
			ed.onPostProcess.add(function(ed, o) {
				if (o.get)
					o.content = t._dt_reconstructor(o.content);
			});				
        },
		_dt_replacer : function(co) {
			return co.replace(/\[dt-galleria([^\]]*)\]/g, function(a,b){
				return '<hr class="dt-galleria" title="dt-galleria'+tinymce.DOM.encode(b)+'" /><br /><br />';
			});
			
		},	
		_dt_reconstructor : function(co) {	
		
			function getAttr(s, n) {
				n = new RegExp(n + '=\"([^\"]+)\"', 'g').exec(s);
				return n ? tinymce.DOM.decode(n[1]) : '';
			};
			
			return co.replace(/(?:<p[^>]*>)*(<hr[^>]+>)(?:<\/p>)*/g, function(a,im) {
				var cls = getAttr(im, 'class');

				if ( cls.indexOf('dt-galleria') != -1 )
					return '<p>['+tinymce.trim(getAttr(im, 'title'))+']</p>';

				return a;
			});					
		},			
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('galleria', tinymce.plugins.galleria);
})();