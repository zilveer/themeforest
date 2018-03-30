
(function() {
	tinymce.create('tinymce.plugins.one_fourth', {
		init : function(ed, url) {
			var pb = '<div style="border:1px dashed #888;padding:2%;width:15%;margin-left:1%;float:left;" class="one_fourth mceItemNoResize"><p>'+ed.selection.getContent()+'</p></div>', cls = 'one_fourth', sep = ed.getParam('one_fourth', '[one_fourth][/one_fourth]'), pbRE;

			pbRE = new RegExp(sep.replace(/[\?\.\*\[\]\(\)\{\}\+\^\$\:]/g, function(a) {return '\\' + a;}), 'g');
			
			// Register commands
			ed.addCommand('one_fourth', function() {
				ed.execCommand('mceInsertContent', 0, pb);
			});

			ed.onInit.add(function() {
				//ed.dom.loadCSS(url + "/css/content.css");
				if (ed.theme.onResolveName) {
					ed.theme.onResolveName.add(function(th, o) {
						if (o.node.nodeName == 'DIV' && ed.dom.hasClass(o.node, cls))
							o.name = 'one_fourth';
					});
				}
			});

			ed.onClick.add(function(ed, e) {
				e = e.target;

				if (e.nodeName === 'DIV' && ed.dom.hasClass(e, cls))
					ed.selection.select(e);
			});

			ed.onNodeChange.add(function(ed, cm, n) {
				cm.setActive('one_fourth', n.nodeName === 'DIV' && ed.dom.hasClass(n, cls));
			});

			ed.onBeforeSetContent.add(function(ed, o) {
				o.content = o.content.replace(pbRE, pb);
			});

			ed.onPostProcess.add(function(ed, o) {
				if (o.get)
					o.content = o.content.replace(/<div[^>]+>/g, function(im) {
						if (im.indexOf('class="one_fourth') !== -1)
							im = sep;

						return im;
					});
			});
		},

		getInfo : function() {
			return {
				longname : 'Insert productspage Image',
				author : 'Instinct Entertainment',
				authorurl : 'http://instinct.co.nz',
				infourl : 'http://instinct.co.nz',
				version : tinymce.majorVersion + "." + tinymce.minorVersion
			};
		}
	});

	tinymce.PluginManager.add('one_fourth', tinymce.plugins.one_fourth_open);
})();
