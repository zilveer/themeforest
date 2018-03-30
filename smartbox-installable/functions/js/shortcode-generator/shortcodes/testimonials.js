desShortcodeMeta={
	attributes:[
		{
			label:"Title",
			id:"title"
		},
		{
			label:"Scroller",
			id:"testimonialsScroller",
			help:"If set to YES the testimonials will be displayed horizontally with a scroller.", 
			controlType:"select-control", 
			selectValues:['yes', 'no'],
			defaultValue: 'yes',
			defaultText: 'yes'
		},
		{
			label:"Autoplay ?",
			id:"autoplay_enabled",
			help:"The scroller will advance itself. <br/>", 
			controlType:"select-control", 
			selectValues:['yes', 'no'],
			defaultValue: 'no',
			defaultText: 'no'
		},
		{
			label: "Autoplay Speed",
			id: "autoplay_speed",
			help: "Set the autoplay interval (in ms).",
			defaultValue: '3000'
		},
		{
			label:"Testimonials Per Row",
			id:"testimonialsPerRow",
			help:"Set the number of partners to be displayed in each row.", 
			controlType:"select-control", 
			selectValues:['4', '3', '2','1'],
			defaultValue: '3', 
			defaultText: '3'
		},
		{
			label: "Testimonials Categories",
			id:"testimonialsCategories",
			help:"Select which Categories to display."
		},
		{
			label:"Number Testimonials to show",
			id:"nshow",
			help:"If 0 will show all testimonials.", 
		},
		{
			label:"Animation Effect",
			id:"a_fffect",
			controlType:"select-control", 
			selectValues:['','flip', 'flipInX', 'bounceIn', 'bounceInDown', 'bounceInUp', 'bounceInLeft', 'bounceInRight', 'fadeIn', 'fadeInUp', 'fadeInDown', 'fadeInLeft', 'fadeInRight', 'fadeInUpBig', 'fadeInDownBig', 'fadeInLeftBig', 'fadeInRightBig', 'rotateIn', 'rotateInDownLeft', 'rotateInDownRight', 'rotateInUpLeft', 'rotateInUpRight', 'lightSpeedIn', 'lightSpeedOut', 'hinge', 'rollIn', 'rollOut'],
			defaultValue: '', 
			defaultText: ''
		},
		{
			label:"Sequencial Delay ?",
			id:"seq",
			controlType:"select-control",
			selectValues:['Yes','No'],
			defaultValue: 'Yes', 
			defaultText: 'Yes'
		},
		{
			label:"Hide Author",
			id:"hide_author",
			controlType:"select-control",
			selectValues:['yes', 'no'],
			defaultValue: 'no', 
			defaultText: 'no'
		},
		{
			label:"Hide Company",
			id:"hide_company",
			controlType:"select-control", 
			selectValues:['yes', 'no'],
			defaultValue: 'no', 
			defaultText: 'no'
		}
		],
		disablePreview:true,
		customMakeShortcode: function(b){
		
			if (b.testimonialsScroller == "yes")
				return '[testimonials title="' + b.title + '" categories="'+b.testimonialsCategories+'" nshow="' + b.nshow + '" a_fffect="' + b.a_fffect + '" seq="'+b.seq+'" hideauthor="' + b.hide_author + '" hidecompany="' + b.hide_company + '" scroller="'+b.testimonialsScroller+'" autoplay="'+b.autoplay_enabled+'" autoplay_speed="'+b.autoplay_speed+'"]';
			else return '[testimonials title="' + b.title + '" categories="'+b.testimonialsCategories+'" nshow="' + b.nshow + '" a_fffect="' + b.a_fffect + '" seq="'+b.seq+'" hideauthor="' + b.hide_author + '" hidecompany="' + b.hide_company + '" tests_per_row="'+b.testimonialsPerRow+'" ]';
			
			
		}
		
};
