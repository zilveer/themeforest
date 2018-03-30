tinymce.PluginManager.add('yopress', function(editor, url) {
	// console.log('add plugin');
	editor.addButton( 'yopress', function() {
		var currentCat = "";
		var data = {
			title: 'Shortcodes',
			'text': 'Shortcodes',
			type: 'menubutton',
			onselect: function(e) {
				if (e.control.state.data.value) {
					editor.insertContent(e.control.state.data.value);
				}
			},
			menu: [
				{
					text:'Highlights', menu:[
						{ text:'Highlight Color Text', value:'[highlight color="highlight-color"][/highlight]' },
						{ text:'Highlight Color Background', value:'[highlight color="highlight-color-bg"][/highlight]' },
						{ text:'Highlight Dark Background', value:'[highlight color="highlight-txt"][/highlight]' },
						{ text:'Highlight Color Outline', value:'[highlight color="highlight-outline"][/highlight]' },
					]
				},
				{
					text:'Dropcap', value: '[dropcap][/dropcap]'
				},
				{
					text:'Badges', menu:[
						{ text:'Default Badge', value:'[badge][/badge]' },
						{ text:'Green Badge', value:'[badge color="badge-green"][/badge]' },
						{ text:'Yellow Badge', value:'[badge color="badge-yellow"][/badge]' },
						{ text:'Blue Badge', value:'[badge color="badge-blue"][/badge]' },
						{ text:'Red Badge', value:'[badge color="badge-red"][/badge]' }
					]
				},
				{
					text:'Alerts', menu:[
						{ text:'Success Alert', value:'[alert color="alert-success"][/alert]' },
						{ text:'Info Alert', value:'[alert color="alert-info"][/alert]' },
						{ text:'Warning Alert', value:'[alert color="alert-warning"][/alert]' },
						{ text:'Danger Alert', value:'[alert color="alert-danger"][/alert]' }
					]
				},
				{
					text:'Labels', menu:[
						{ text:'Default Label', value:'[label color="label-default"][/label]' },
						{ text:'Primary Label', value:'[label color="label-primary"][/label]' },
						{ text:'Success Label', value:'[label color="label-success"][/label]' },
						{ text:'Info Label', value:'[label color="label-info"][/label]' },
						{ text:'Warning Label', value:'[label color="label-warning"][/label]' },
						{ text:'Danger Label', value:'[label color="label-danger"][/label]' }
					]
				},
				{
					text:'Buttons', menu:[
						{ text:'Dark Outline Button', menu:[
							{ text:'Button Extra Small', value:'[btn href="" color="btn-dark-o" size="btn-xs" target=""][/btn]' },
							{ text:'Button Small', value:'[btn href="" color="btn-dark-o" size="btn-sm" target=""][/btn]' },
							{ text:'Button Normal', value:'[btn href="" color="btn-dark-o" size="btn-md" target=""][/btn]' },
							{ text:'Button Large', value:'[btn href="" color="btn-dark-o" size="btn-lg" target=""][/btn]' },
						]},
						{ text:'Light Outline Button', menu:[
							{ text:'Button Extra Small', value:'[btn href="" color="btn-light-o" size="btn-xs" target=""][/btn]' },
							{ text:'Button Small', value:'[btn href="" color="btn-light-o" size="btn-sm" target=""][/btn]' },
							{ text:'Button Normal', value:'[btn href="" color="btn-light-o" size="btn-md" target=""][/btn]' },
							{ text:'Button Large', value:'[btn href="" color="btn-light-o" size="btn-lg" target=""][/btn]' },
						]},
						{ text:'Highlight Outline Button', menu:[
							{ text:'Button Extra Small', value:'[btn href="" color="btn-color-o" size="btn-xs" target=""][/btn]' },
							{ text:'Button Small', value:'[btn href="" color="btn-color-o" size="btn-sm" target=""][/btn]' },
							{ text:'Button Normal', value:'[btn href="" color="btn-color-o" size="btn-md" target=""][/btn]' },
							{ text:'Button Large', value:'[btn href="" color="btn-color-o" size="btn-lg" target=""][/btn]' },
						]},
						{ text:'Dark Button', menu:[
							{ text:'Button Extra Small', value:'[btn href="" color="btn-dark" size="btn-xs" target=""][/btn]' },
							{ text:'Button Small', value:'[btn href="" color="btn-dark" size="btn-sm" target=""][/btn]' },
							{ text:'Button Normal', value:'[btn href="" color="btn-dark" size="btn-md" target=""][/btn]' },
							{ text:'Button Large', value:'[btn href="" color="btn-dark" size="btn-lg" target=""][/btn]' },
						]},
						{ text:'Light Button', menu:[
							{ text:'Button Extra Small', value:'[btn href="" color="btn-light" size="btn-xs" target=""][/btn]' },
							{ text:'Button Small', value:'[btn href="" color="btn-light" size="btn-sm" target=""][/btn]' },
							{ text:'Button Normal', value:'[btn href="" color="btn-light" size="btn-md" target=""][/btn]' },
							{ text:'Button Large', value:'[btn href="" color="btn-light" size="btn-lg" target=""][/btn]' },
						]},
						{ text:'Highlight Button', menu:[
							{ text:'Button Extra Small', value:'[btn href="" color="btn-color" size="btn-xs" target=""][/btn]' },
							{ text:'Button Small', value:'[btn href="" color="btn-color" size="btn-sm" target=""][/btn]' },
							{ text:'Button Normal', value:'[btn href="" color="btn-color" size="btn-md" target=""][/btn]' },
							{ text:'Button Large', value:'[btn href="" color="btn-color" size="btn-lg" target=""][/btn]' },
						]},
					]
				},
			]
		};

		return data;
	});
});