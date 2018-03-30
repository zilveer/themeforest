(function($){
	"use strict";
	wp.customize("dt_layout", function( value ){

		if( "boxed" === value.get() ) {
			$("#customize-control-dt_boxed_layout_bg").show();
			$("#customize-control-dt_boxed_layout_bg_color").show();
			$("#customize-control-dt_boxed_layout_bg_opacity").show();

		} else {
			$("#customize-control-dt_boxed_layout_bg").hide();
			$("#customize-control-dt_boxed_layout_bg_color").hide();
			$("#customize-control-dt_boxed_layout_bg_opacity").hide();
		}

		//While changing the layout option bind() method will trigger
		value.bind(function(to){
			if( "boxed" === to ) {
				$("#customize-control-dt_boxed_layout_bg").show();
				$("#customize-control-dt_boxed_layout_bg_color").show();
				$("#customize-control-dt_boxed_layout_bg_opacity").show();

			} else {
				$("#customize-control-dt_boxed_layout_bg").hide();
				$("#customize-control-dt_boxed_layout_bg_color").hide();
				$("#customize-control-dt_boxed_layout_bg_opacity").hide();
			}	
		});
	});

	wp.customize("dt_menu_font_type", function( value ){

		if( "standard" === value.get() ) {
			$("#customize-control-dt_menu_standard_font").show();
			$("#customize-control-dt_menu_standard_font_style").show();
			$("#customize-control-dt_menu_font").hide();
		} else {
			$("#customize-control-dt_menu_standard_font_style").hide();
			$("#customize-control-dt_menu_standard_font").hide();
			$("#customize-control-dt_menu_font").show();
		}

		//While changing the menu font type bind() method will trigger
		value.bind(function(to){
			if( "standard" === to ) {
				$("#customize-control-dt_menu_standard_font").show();
				$("#customize-control-dt_menu_standard_font_style").show();
				$("#customize-control-dt_menu_font").hide();
			} else {
				$("#customize-control-dt_menu_standard_font_style").hide();
				$("#customize-control-dt_menu_standard_font").hide();
				$("#customize-control-dt_menu_font").show();
			}
		});
	});

	wp.customize("dt_body_font_type", function( value ){

		if( "standard" === value.get() ) {
			$("#customize-control-dt_body_standard_font").show();
			$("#customize-control-dt_body_standard_font_style").show();
			$("#customize-control-dt_body_font").hide();
		} else {
			$("#customize-control-dt_body_standard_font_style").hide();
			$("#customize-control-dt_body_standard_font").hide();
			$("#customize-control-dt_body_font").show();
		}

		//While changing the menu font type bind() method will trigger
		value.bind(function(to){
			if( "standard" === to ) {
				$("#customize-control-dt_body_standard_font").show();
				$("#customize-control-dt_body_standard_font_style").show();
				$("#customize-control-dt_body_font").hide();
			} else {
				$("#customize-control-dt_body_standard_font_style").hide();
				$("#customize-control-dt_body_standard_font").hide();
				$("#customize-control-dt_body_font").show();
			}
		});
	});

	wp.customize("dt_footer_title_font_type", function( value ){

		if( "standard" === value.get() ) {
			$("#customize-control-dt_footer_title_standard_font").show();
			$("#customize-control-dt_footer_title_standard_font_style").show();
			$("#customize-control-dt_footer_title_font").hide();
		} else {
			$("#customize-control-dt_footer_title_standard_font_style").hide();
			$("#customize-control-dt_footer_title_standard_font").hide();
			$("#customize-control-dt_footer_title_font").show();
		}

		//While changing the menu font type bind() method will trigger
		value.bind(function(to){
			if( "standard" === to ) {
				$("#customize-control-dt_footer_title_standard_font").show();
				$("#customize-control-dt_footer_title_standard_font_style").show();
				$("#customize-control-dt_footer_title_font").hide();
			} else {
				$("#customize-control-dt_footer_title_standard_font_style").hide();
				$("#customize-control-dt_footer_title_standard_font").hide();
				$("#customize-control-dt_footer_title_font").show();
			}
		});
	});

	wp.customize("dt_footer_content_font_type", function( value ){

		if( "standard" === value.get() ) {
			$("#customize-control-dt_footer_content_standard_font").show();
			$("#customize-control-dt_footer_content_standard_font_style").show();
			$("#customize-control-dt_footer_content_font").hide();
		} else {
			$("#customize-control-dt_footer_content_standard_font_style").hide();
			$("#customize-control-dt_footer_content_standard_font").hide();
			$("#customize-control-dt_footer_content_font").show();
		}

		//While changing the menu font type bind() method will trigger
		value.bind(function(to){
			if( "standard" === to ) {
				$("#customize-control-dt_footer_content_standard_font").show();
				$("#customize-control-dt_footer_content_standard_font_style").show();
				$("#customize-control-dt_footer_content_font").hide();
			} else {
				$("#customize-control-dt_footer_content_standard_font_style").hide();
				$("#customize-control-dt_footer_content_standard_font").hide();
				$("#customize-control-dt_footer_content_font").show();
			}
		});
	});	

	//For H1
	wp.customize("dt_h1_font_type",function( value ){

		if( "standard" === value.get() ){
			$("#customize-control-dt_h1_standard_font").show();
			$("#customize-control-dt_h1_standard_font_style").show();
			$("#customize-control-dt_h1_font").hide();
		} else {
			$("#customize-control-dt_h1_standard_font").hide();
			$("#customize-control-dt_h1_standard_font_style").hide();
			$("#customize-control-dt_h1_font").show();
		}

		//While changing the h1 font type bind() will trigger
		value.bind(function(to){
			if( "standard" === to ){
				$("#customize-control-dt_h1_standard_font").show();
				$("#customize-control-dt_h1_standard_font_style").show();
				$("#customize-control-dt_h1_font").hide();
			} else {
				$("#customize-control-dt_h1_standard_font").hide();
				$("#customize-control-dt_h1_standard_font_style").hide();
				$("#customize-control-dt_h1_font").show();
			}
		});
	}); // H1 End

	//For H2
	wp.customize("dt_h2_font_type",function( value ){

		if( "standard" === value.get() ){
			$("#customize-control-dt_h2_standard_font").show();
			$("#customize-control-dt_h2_standard_font_style").show();
			$("#customize-control-dt_h2_font").hide();
		} else {
			$("#customize-control-dt_h2_standard_font").hide();
			$("#customize-control-dt_h2_standard_font_style").hide();
			$("#customize-control-dt_h2_font").show();
		}

		//While changing the h2 font type bind() will trigger
		value.bind(function(to){
			if( "standard" === to ){
				$("#customize-control-dt_h2_standard_font").show();
				$("#customize-control-dt_h2_standard_font_style").show();
				$("#customize-control-dt_h2_font").hide();
			} else {
				$("#customize-control-dt_h2_standard_font").hide();
				$("#customize-control-dt_h2_standard_font_style").hide();
				$("#customize-control-dt_h2_font").show();
			}
		});
	}); // H2 End

	//For H3
	wp.customize("dt_h3_font_type",function( value ){

		if( "standard" === value.get() ){
			$("#customize-control-dt_h3_standard_font").show();
			$("#customize-control-dt_h3_standard_font_style").show();
			$("#customize-control-dt_h3_font").hide();
		} else {
			$("#customize-control-dt_h3_standard_font").hide();
			$("#customize-control-dt_h3_standard_font_style").hide();
			$("#customize-control-dt_h3_font").show();
		}

		//While changing the h3 font type bind() will trigger
		value.bind(function(to){
			if( "standard" === to ){
				$("#customize-control-dt_h3_standard_font").show();
				$("#customize-control-dt_h3_standard_font_style").show();
				$("#customize-control-dt_h3_font").hide();
			} else {
				$("#customize-control-dt_h3_standard_font").hide();
				$("#customize-control-dt_h3_standard_font_style").hide();
				$("#customize-control-dt_h3_font").show();
			}
		});
	}); // H3 End

	//For H4
	wp.customize("dt_h4_font_type",function( value ){

		if( "standard" === value.get() ){
			$("#customize-control-dt_h4_standard_font").show();
			$("#customize-control-dt_h4_standard_font_style").show();
			$("#customize-control-dt_h4_font").hide();
		} else {
			$("#customize-control-dt_h4_standard_font").hide();
			$("#customize-control-dt_h4_standard_font_style").hide();
			$("#customize-control-dt_h4_font").show();
		}

		//While changing the h4 font type bind() will trigger
		value.bind(function(to){
			if( "standard" === to ){
				$("#customize-control-dt_h4_standard_font").show();
				$("#customize-control-dt_h4_standard_font_style").show();
				$("#customize-control-dt_h4_font").hide();
			} else {
				$("#customize-control-dt_h4_standard_font").hide();
				$("#customize-control-dt_h4_standard_font_style").hide();
				$("#customize-control-dt_h4_font").show();
			}
		});
	}); // H4 End

	//For H5
	wp.customize("dt_h5_font_type",function( value ){

		if( "standard" === value.get() ){
			$("#customize-control-dt_h5_standard_font").show();
			$("#customize-control-dt_h5_standard_font_style").show();
			$("#customize-control-dt_h5_font").hide();
		} else {
			$("#customize-control-dt_h5_standard_font").hide();
			$("#customize-control-dt_h5_standard_font_style").hide();
			$("#customize-control-dt_h5_font").show();
		}

		//While changing the h5 font type bind() will trigger
		value.bind(function(to){
			if( "standard" === to ){
				$("#customize-control-dt_h5_standard_font").show();
				$("#customize-control-dt_h5_standard_font_style").show();
				$("#customize-control-dt_h5_font").hide();
			} else {
				$("#customize-control-dt_h5_standard_font").hide();
				$("#customize-control-dt_h5_standard_font_style").hide();
				$("#customize-control-dt_h5_font").show();
			}
		});
	}); // H5 End

	//For H6
	wp.customize("dt_h6_font_type",function( value ){

		if( "standard" === value.get() ){
			$("#customize-control-dt_h6_standard_font").show();
			$("#customize-control-dt_h6_standard_font_style").show();
			$("#customize-control-dt_h6_font").hide();
		} else {
			$("#customize-control-dt_h6_standard_font").hide();
			$("#customize-control-dt_h6_standard_font_style").hide();
			$("#customize-control-dt_h6_font").show();
		}

		//While changing the h6 font type bind() will trigger
		value.bind(function(to){
			if( "standard" === to ){
				$("#customize-control-dt_h6_standard_font").show();
				$("#customize-control-dt_h6_standard_font_style").show();
				$("#customize-control-dt_h6_font").hide();
			} else {
				$("#customize-control-dt_h6_standard_font").hide();
				$("#customize-control-dt_h6_standard_font_style").hide();
				$("#customize-control-dt_h6_font").show();
			}
		});
	}); // H6 End
	
}(jQuery));