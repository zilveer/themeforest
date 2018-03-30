(function() {
    tinymce.create('tinymce.plugins.galleriffic', {
        init : function(ed, url) {
			var t = this;			
            ed.addButton('galleriffic', {
                title : 'Add a Galleriffic slideshow',
                image : url+'/galleriffic-icon.png',
                onclick : function() {
					ed.windowManager.open({
						file : url + '/galleriffic-window.php',
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
			return co.replace(/\[dt-galleriffic([^\]]*)\]/g, function(a,b){
				return '<hr class="dt-galleriffic" title="dt-galleriffic'+tinymce.DOM.encode(b)+'" /><br /><br />';
			});
			
		},	
		_dt_reconstructor : function(co) {	
		
			function getAttr(s, n) {
				n = new RegExp(n + '=\"([^\"]+)\"', 'g').exec(s);
				return n ? tinymce.DOM.decode(n[1]) : '';
			};
			
			return co.replace(/(?:<p[^>]*>)*(<hr[^>]+>)(?:<\/p>)*/g, function(a,im) {
				var cls = getAttr(im, 'class');

				if ( cls.indexOf('dt-galleriffic') != -1 )
					return '<p>['+tinymce.trim(getAttr(im, 'title'))+']</p>';

				return a;
			});					
		},			
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('galleriffic', tinymce.plugins.galleriffic);
})();