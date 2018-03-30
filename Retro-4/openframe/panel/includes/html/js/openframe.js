
/*
*	openframe
*	written by stefano giliberti (stfno@me.com),
*	opendept.net
*/

jQuery( document ).ready( function( $ ) {
	
	if ( typeof op_panel_ref == "undefined" )
		return
	
	var op_panel_menu = $("#op-panel-menu"),
		op_panel_tabs = $(".op-panel-section[data-tab]"),
		op_panel_content = $("#op-panel-content"),
		op_panel_save = $("#op-panel-save")
		
	op_panel_save.data( "text", op_panel_save.text() )
	
	op_panel_tabs.each( function() {

		op_panel_menu.append( "<a href=\"#\" class=\"nav-tab\" data-hash=\"" + $( this ).data( "hash" ) + "\">" + $( this ).data( "tab" ) + "</a>");
		
	} )

	op_panel_menu.children("a").on( "click", function( e ) {
				
		if ( $( this ).hasClass("nav-tab-active") )
			return;
										
		op_panel_tab_switch( $( this ).data( "hash" ) )
		
		e.preventDefault()
		
	} )
	
	function op_panel_tab_switch( name ) {
			
		tab = op_panel_tabs.filter( "[data-hash=" + name + "]" )
										
		tab.addClass("active").siblings(".op-panel-section").removeClass("active")
				
		op_panel_menu.find("[data-hash='" + name + "']").addClass("nav-tab-active").siblings().removeClass("nav-tab-active")
		
		op_panel_tab_put( name )
				
	}
		
	op_panel_tab_switch( op_panel_tab_get() ? op_panel_tab_get() : op_panel_tabs.eq( 0 ).data("hash") )
	
	$(".op-panel-picker").each( function() {
		
		$( this )
		.prev(".op-panel-picker-pal")
		.css( "background-color", this.value )	
		
	} )
	
	$(".op-panel-picker").iris( {
		hide: false,
		palettes: true,
		change: function( e, ui ) {
										
			$( this )
			.prev(".op-panel-picker-pal")
			.css( "background-color", ui.color.toString() )
			
        }
	} )
	
	$("[data-father] .op-panel-checkbox").on( "click", function() {
		
		group = $( this ).parents(".op-panel-opt-group"),
		father = group.data("father")
		
		group.nextAll("[data-child=" + father + "]").slideToggle( 200 )

	} )

	$(".op-panel-image-select")
	.each( function() {
		
		op_panel_image_select_status( $( this ) )
		
	} )
	.on( "click", function( e ) {
		
		trigger = $( this ),
		media = wp.media( { title: trigger.text(), multiple: false, sortable: false } ),
		fill = trigger.parent().find("input:hidden")
				
		media
		.on( "open", function() {
			
			if ( ! ( id = fill.val() ) )
				return
						
			media
			.state()
			.get("selection")
			.add( wp.media.attachment( id ) )
			
		} )
		.open()
		.on( "select", function() {
					
		    fill.val( media.state().get("selection").first().id )
		    
		    op_panel_image_select_status( trigger )
			
		} )
		
		e.preventDefault()
	
	} )
	.next(".op-panel-image-select-reset")
	.on( "click", function( e ) {
		
		empty = $( this ),
		parent = empty.parent(),
		trigger = parent.find(".op-panel-image-select")
		
		parent.find("input:hidden").val( null )
		
		empty.addClass("hidden")
		
		trigger.toggleClass( "button-primary-disabled", "button-secondary" )
		
		e.preventDefault()
		
	} )
	
	function op_panel_image_select_status( trigger ) {
							
		if ( ! trigger.parent().find("input:hidden").val() )
			return
			
		trigger
		.next(".op-panel-image-select-reset")
		.removeClass("hidden")
				
		if ( ! trigger.hasClass( "button-primary-disabled" ) )
	    	trigger.toggleClass( "button-primary-disabled", "button-secondary" )
		
	}
	
	op_panel_save.on( "click", function( e ) {
		
		e.preventDefault()
		
		if ( $( this ).hasClass("button-primary-disabled") )
			return
		
		anchor = $( this ),
		action = "action=op_panel_opt_store&referer=" + op_panel_ref + "&",
		post = action + op_panel_content.serialize()
				
		anchor.addClass( "button-primary-disabled" ).text( op_panel_save.data("str-saving") )
				
		$.post( ajaxurl, post, function( reply ) {
				
				if ( reply == ":(" )
					console.log( "openframe: Identical options already existing. Update failed." )
				
				anchor.text( op_panel_save.data("str-saved") )
						
				setTimeout( function() {
				
					anchor.removeClass( "button-primary-disabled" ).text( op_panel_save.data("text") )
					
				}, 1000 )
					
			}
			
		)
		
	} )
	
	function op_panel_tab_put( value ) {
        expire = new Date()
        expire.setTime( expire.getTime() + ( 1*24*60*60*1000 ) )
	    document.cookie = "op_panel = " + value + "; expires = " + expire.toGMTString() + "; path = /";
	}
	
	function op_panel_tab_get( name ) {
	    cookie = document.cookie.split( ";" )
	    for ( var i = 0; i < cookie.length; i++ ) {
	        item = cookie[ i ];
	        while ( item.charAt( 0 ) == " " )
	        	item = item.substring( 1, item.length )
	        if ( item.indexOf( "op_panel=" ) == 0 )
	        	return item.substring( 9, item.length )
	    }
	    return null
	}
	
} );