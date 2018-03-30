jQuery( document ).ready( function( $ ) {
	
	var media = wp.media( { title: retro_metabox_string.add } ),
		picks = $( "#retro-slides" ),
		mirror = $( "#retro-slides-mirror" ),
		create = $( "#retro-slides-create" ),
		select = create.find( "a[href='#select']" ),
		image = create.find( "[name='image']" ),
		add = create.find( "a[href='#add']" )
	
	if ( ! picks.val() )
		picks.val( JSON.stringify( [] ) )
		
	retro_picks_mirror_update( retro_picks_get() )
	
	select.on( "click", function( e ) {
		
		media.open()
			
		e.preventDefault()

	} )
	
	media.on( "select", function() {
		
		i = media.state().get( "selection" ).single()
		
		image.val( [ i.id, i.attributes.sizes.thumbnail.url, i.attributes.editLink ] )
	   	
	   	if ( ! select.hasClass( "button-primary-disabled" ) )
	   		select.toggleClass( "button-primary-disabled", "button-secondary" )
	   	  	
	} )
	
	add.on( "click", function( e ) {
		
		e.preventDefault()
				
		if ( ! image.val() )
			return
		
		list = retro_picks_get(),
		attachment = image.val().split( "," ),
		url = create.find( "[name='link-url']" ),
		caption = create.find( "[name='caption']" ),
		
		item = {
			id: retro_uniqid(),
			media: attachment[ 0 ],
			caption: caption.val(),
			url: url.val(),
			thumbnail: attachment[ 1 ],
			edit: attachment[ 2 ]
		}
				
		list.push( item )
		
		retro_picks_update( list )
		
		create
		.find( ":text" )
		.val( null )
				
		select.toggleClass( "button-primary-disabled", "button-secondary" )
		
	} )
	
	create
	.find( ":text" )
	.on( "keypress", function( e ) {
		
		if ( e.keyCode == 13 ) {
			
			add.trigger( "click" )
						
			e.preventDefault()
			
		}
				
	} )
	
	mirror
	.sortable( {
		opacity: .9,
		scrollSensitivity: 200,
		scrollSpeed: 15
	} )
	.on( "sortupdate", function() {
		
		list = []
				
		$.each( mirror.sortable( "toArray" ), function( index, id ) {
			list.push( $.grep( retro_picks_get(), function( item ) { return item.id == id } )[ 0 ] )						
		} )
				
		retro_picks_update( list )
		
	} )
	
	mirror
	.find( ".delete" )
	.live( "click", function( e ) {
		
		id = this.hash.substring( 1 )
				
		retro_picks_update( $.grep( retro_picks_get(), function( item ) { return item.id !== id } ) )
				
		e.preventDefault()
		
	} )
	
	mirror
	.find( ".caption" )
	.live( "change", function( e ) {

		list = retro_picks_get(),
		id = this.name
		
		$.grep( list, function( item ) { return item.id == id } )[ 0 ].caption = this.value
				
		retro_picks_update( list )
				
	} )

	mirror
	.find( ".url" )
	.live( "change", function( e ) {

		list = retro_picks_get(),
		id = this.name
		
		$.grep( list, function( item ) { return item.id == id } )[ 0 ].url = this.value
				
		retro_picks_update( list )
				
	} )	
	
	create
	.find( "a[href=#more]" )
	.on( "click", function( e ) {
		
		$( this )
		.parent()
		.addClass( "hidden" )
		.nextAll( ".hidden" )
		.removeClass( "hidden" )
		
		e.preventDefault()
		
	} )
	
	function retro_picks_update( list ) {
		
		picks.val( JSON.stringify( list ) )
		
		retro_picks_mirror_update( list )
		
	}
	
	function retro_picks_get() {
		
		return JSON.parse( picks.val() )
		
	}
	
	function retro_picks_mirror_update( list ) {
		
		mirror.empty()
		
		$.each( list, function( index, item ) {
			
			li = "<li id=" + item.id + ">"
			li += "<a class=\"thumbnail\" href=\"" + item.edit + "\"><img src=\"" + item.thumbnail + "\" /></a>"
			li += "<p><input class=\"caption\" type=\"text\" value=\"" + retro_escape( item.caption ) + "\" name=\"" + item.id + "\" placeholder=\"" + retro_metabox_string.caption + "\" /></p>"
			li += "<p><input class=\"url\" type=\"text\" value=\"" + retro_escape( item.url ) + "\" name=\"" + item.id + "\" placeholder=\"" + retro_metabox_string.url + "\" /></p>"
			li += "<p><a class=\"delete\" href=\"#" + item.id + "\">" + retro_metabox_string.remove + "</a></p>"
			li += "</li>"
			
			mirror.append( li )
			
		} )
				
	}
	
	function retro_uniqid() {
		return "p" + Math.round( Math.random() * 1000 )
	}
	
	function retro_escape( string ) {
		retro_entities = {
			"&": "&amp;",
			"<": "&lt;",
			">": "&gt;",
			'"': '&quot;',
			"'": '&#39;',
			"/": '&#x2F;'
		}
		return String( string ).replace( /[&<>"'\/]/g, function ( s ) { return retro_entities[ s ] } )
	}
	
} );