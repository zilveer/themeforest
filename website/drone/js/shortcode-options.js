/**
 * Shortcode options
 * 
 * @package    WordPress
 * @subpackage Drone
 * @since      5.0
 * @link       http://www.tinymce.com/wiki.php/api4%3anamespace.tinymce.ui
 * @link       https://github.com/tinymce/tinymce/blob/master/js/tinymce/plugins
 */

// -----------------------------------------------------------------------------

tinymce.PluginManager.add('drone_shortcode_options', function(editor) {

	// -------------------------------------------------------------------------
	
	RegExp.prototype.execAll = function(s) {
		var match = null;
		var matches = new Array();
		while (match = this.exec(s)) {
			var matchArray = [];
			for (i in match) {
				if (parseInt(i) == i) {
					matchArray.push(match[i]);
				}
			}
			matches.push(matchArray);
		}
		return matches;
	}

	// -------------------------------------------------------------------------
	
	function getMenu()
	{
		var menu = [];
		for (var i in editor.settings.drone_shortcodes_data) {
			if (!editor.settings.drone_shortcodes_data.hasOwnProperty(i)) {
				continue;
			}
			var shortcode = editor.settings.drone_shortcodes_data[i];
			menu.push({
				shortcode: shortcode,
				icon:      'drone-'+shortcode.tag.replace('_', '-'),
				text:      shortcode.label,
				onclick:   function() {
					showDialog(this.settings.shortcode);
				}
			});
		}
		return menu;
	}
	
	// -------------------------------------------------------------------------

	function showDialog(shortcode)
	{	

		// Edit
		if (typeof shortcode == 'undefined') {
			
			var instance = getShortcodeInstance();
			if (instance === null) {
				return false;
			}
			
			editor.windowManager.open({
				title:    instance.shortcode.label,
				body:     instance.shortcode.controls.length > 0 ? instance.shortcode.controls : [{type: 'label', label: editor.getLang('drone_shortcode_options.no_controls')}],
				data:     instance.atts,
				minWidth: 400,
				onsubmit: function(e) {
					insertShortcode(instance.shortcode, e.data, instance.range);
				}
			});
	
		}
		
		// New (without options)
		else if (shortcode.controls.length == 0) {
			insertShortcode(shortcode, []);
		}
		
		// New
		else {
			editor.windowManager.open({
				title:    shortcode.label,
				body:     shortcode.controls,
				minWidth: 400,
				onsubmit: function(e) {
					insertShortcode(shortcode, e.data);
				}
			});
		}
		
		var windows = editor.windowManager.getWindows();
		if (windows.length > 0) {
			//droneOptions.attach(jQuery('#'+windows[0]._id));
		}
		
		return true;
		
	}
	
	// -------------------------------------------------------------------------
	
	function serializeAtts(controls, atts)
	{
		var _atts = [];
		for (var i in controls) {
			if (!controls.hasOwnProperty(i)) {
				continue;
			}
			var control = controls[i];
			switch (control.type) {
				case 'textbox':
				case 'listbox':
					if (control.name in atts && atts[control.name] != control.value) {
						_atts.push(control.name+'="'+atts[control.name]+'"');
					}
					break;
				case 'checkbox':
					if (control.name in atts && atts[control.name] != control.checked) {
						_atts.push(control.name+'="'+atts[control.name]+'"');
					}
					break;
				case 'colorpicker':
					if (control.name in atts && atts[control.name] != control.color) {
						_atts.push(control.name+'="'+atts[control.name]+'"');
					}
					break;
				case 'fieldset':
				case 'container':
				case 'panel':
					var fs = serializeAtts(control.items, atts);
					if (fs !== '') {
						_atts = _atts.concat(fs);
					}
					break;
			}
		}
		return _atts.length > 0 ? _atts.join(' ') : '';
	}
	
	// -------------------------------------------------------------------------
	
	function insertShortcode(shortcode, atts, range)
	{

		// Attributes
		var _atts = serializeAtts(shortcode.controls, atts);
		if (_atts) {
			_atts = ' '+_atts;
		}

		// Edit
		if (typeof range == 'undefined') {
			range = false;
		}
		if (range !== false) {
			editor.selection.setRng(range);
		}

		// Mark
		var mark = '<!--b7530948d34bc784bb4c0406fb4684a1'+(new Date().getTime())+'-->';
		
		// Shortcode
		var content = editor.selection.getContent();
		var s = shortcode.self_closing || range !== false ? '['+shortcode.tag+_atts+']' : '['+shortcode.tag+_atts+']'+content+'[/'+shortcode.tag+']';
			
		// Insert into editor
		editor.selection.setContent(mark);
		
		var bm = editor.selection.getBookmark();
		editor.setContent(
			editor.getContent({format: 'raw'}).replace(new RegExp('(<p></p>)?'+mark+'(<p></p>)*', 'i'), s),
			{format: 'raw'}
		);
		editor.selection.moveToBookmark(bm);
		
	}
	
	// -------------------------------------------------------------------------
	
	function getShortcodeInstance()
	{

		// Selection range
		var range = editor.selection.getRng();

		// Selection text
		if (range.startContainer.nodeType != Node.TEXT_NODE) {
			return null;
		}
		var text = range.startContainer.nodeValue;
		
		// Finding opening tag
		var start = range.startOffset-1;
		if (start < 0) {
			return null;
		}
		while (start > 0) {
			if (text[start] == ']') {
				return null;
			} else if (text[start] == '[') {
				break;
			}
			start--;
		}
		var end = start;
		while (end < text.length) {
			if (text[end] == ']') {
				break;
			}
			end++;
		}
		end++;
		var s = text.substring(start, end);

		// Parsing shortcode tag
		var m = s.match(/^\[([a-z][_a-z0-9]*) ?([^\]]*)\]$/i);
		if (m === null) {
			return null;
		}
		
		var tag = m[1];	
		var atts = {};
		var _atts = (new RegExp('([_a-z0-9]+)="([^"]*)"', 'gi')).execAll(m[2]);
		for (var i in _atts) {
			if (!_atts.hasOwnProperty(i)) {
				continue;
			}
			var val;
			switch (_atts[i][2]) {
				case 'true':  val = true; break;
				case 'false': val = false; break;
				default:      val = _atts[i][2];
			}
			atts[_atts[i][1]] = val;
		}
		
		// Finding existing shortcode
		for (var i in editor.settings.drone_shortcodes_data) {
			if (!editor.settings.drone_shortcodes_data.hasOwnProperty(i)) {
				continue;
			}
			var shortcode = editor.settings.drone_shortcodes_data[i];
			if (shortcode.tag == tag) {						
				var _range = range.cloneRange();
				_range.setStart(range.startContainer, start);
				_range.setEnd(range.startContainer, end);
				return {
					shortcode: shortcode,
					atts:      atts,
					range:     _range
				};				
			}
		}
		
		return null;
		
	}
	
	// -------------------------------------------------------------------------
	
	function markShortcodes(s)
	{
		return unmarkShortcodes(s).replace(/\[\/?([a-z][_a-z0-9]*)( +[_a-z0-9]+="[^"\[\]]*")*\]/ig, function(shortcode, name) {
			if (['gallery', 'caption', 'video', 'audio'].indexOf(name.toLowerCase()) == -1) {
				return '<span class="drone-shortcode-mark" spellcheck="false">'+shortcode+'</span>';
			} else {
				return shortcode;
			}
		});
	}
	
	// -------------------------------------------------------------------------
	
	function unmarkShortcodes(s)
	{
		s = s.replace(/<span class="drone-shortcode-mark"[^>]*>(\[\/?[a-z][_a-z0-9]*( +[_a-z0-9]+="[^"\[\]]*")*\])<\/span>/ig, '\$1');
		s = s.replace(/<span class="drone-shortcode-mark"[^>]*>(.*?)<\/span>/ig, '\$1');
		return s;
/*		s = s.replace(/<p><div/g, '<!-- p_div: ');
		s = s.replace(/<\/div><\/p>/g, ' p_div -->');
		var div = document.createElement('div');
		div.innerHTML = s;
		jQuery(jQuery('span.drone-shortcode-mark', div).get().reverse()).each(function() {
			jQuery(this).after(this.innerHTML).remove();
		});
		s = div.innerHTML;
		s = s.replace(/<!-- p_div: /g, '<p><div');
		s = s.replace(/ p_div -->/g, '</div></p>');
		return s;*/
	}
	
	// -------------------------------------------------------------------------
	
	function isValidShortcodesMarks(s)
	{
		return s == markShortcodes(s);
	}

	// -------------------------------------------------------------------------

/*	editor.on('BeforeSetContent', function(e) {
		e.content = markShortcodes(e.content);
	});
		
	editor.on('PostProcess', function(e) {
		e.content = unmarkShortcodes(e.content);
	});

	var change_timer = null;
	editor.on('keyup', function(e) {	
		if (['Left', 'Right', 'Down', 'Up', 'Esc', 'Home', 'End', 'Shift', 'Control', 'Alt', 'F5'].indexOf(e.key) !== -1) {
			return;
		}
		if (change_timer !== null) {
			clearTimeout(change_timer);
		}
		change_timer = setTimeout(function() {
			if (!isValidShortcodesMarks(editor.getContent({format: 'raw'}))) {
				var bm = editor.selection.getBookmark();
				editor.setContent(editor.getContent({format: 'raw'}), {format: 'raw'});
				editor.selection.moveToBookmark(bm);
			}
		}, 1500);
	});*/

	editor.addButton('drone_shortcode_options', {
		type:    'splitbutton',
		icon:    'drone-shortcode',
		tooltip: editor.getLang('drone_shortcode_options.title'),
		menu:    getMenu(),
		onclick: function() {
			if (!showDialog()) {
				this.showMenu();
			}
		},
		onPostRender: function() {
			var _this = this;
			editor.on('nodechange', function(event) {
				_this.active(getShortcodeInstance() !== null);
			});
		}
	});

});