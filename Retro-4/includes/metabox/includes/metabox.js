jQuery( document ).ready( function( $ ) {
	
	// Gallery
	
	$(".retro-image-select")
	.each( function() {
		
		retro_image_select_status( $( this ) )
		
	} )
	.on( "click", function( e ) {
				
		trigger = $( this ),
		media = wp.media( { title: trigger.text(), multiple: "add", sortable: false } ),
		fill = trigger.parent().find("input:hidden"),
		images = []
				
		media
		.on( "open", function() {
			
			if ( ! ( set = fill.val() ) )
				return
			
			$.each( set.split( "," ), function( index, value ) {
												
				media
				.state()
				.get( "selection" )
				.add( wp.media.attachment( value ) )
				
			} )
			
		} )
		.open()
		.on( "select", function() {
						
			media
			.state()
			.get( "selection" )
			.map( function( attachment ) {
				images.push( attachment.id )
		    } )
		    
		    fill.val( images )
		    
		    retro_image_select_status( trigger )
			
		} )
		
		e.preventDefault()
		
	} )
	.next(".retro-image-select-reset")
	.on( "click", function( e ) {
		
		empty = $( this ),
		parent = empty.parent(),
		trigger = parent.find(".retro-image-select")
		
		parent.find("input:hidden").val( null )
		
		empty.addClass("hidden")
		
		trigger.toggleClass( "button-primary-disabled", "button-secondary" )
		
		e.preventDefault()
		
	} )
		
	function retro_image_select_status( trigger ) {
							
		if ( ! trigger.parent().find("input:hidden").val() )
			return
			
		trigger
		.next(".retro-image-select-reset")
		.removeClass("hidden")
				
		if ( ! trigger.hasClass( "button-primary-disabled" ) )
	    	trigger.toggleClass( "button-primary-disabled", "button-secondary" )
		
	}

	// Single image lightbox
	
	$(".retro-single-image-select")
	.each( function() {
		
		retro_single_image_select_status( $( this ) )
		
	} )
	.on( "click", function( e ) {
				
		trigger = $( this ),
		media = wp.media( { title: trigger.text(), multiple: false, sortable: false } ),
		fill = trigger.parent().find("input:hidden")
				
		media
		.on( "open", function() {
			
			if ( ! ( set = fill.val() ) )
				return
															
				media
				.state()
				.get( "selection" )
				.add( wp.media.attachment( set ) )
							
		} )
		.open()
		.on( "select", function() {

			fill.val( media.state().get("selection").first().id )
		    
		    retro_single_image_select_status( trigger )
			
		} )
		
		e.preventDefault()
		
	} )
	.next(".retro-single-image-select-reset")
	.on( "click", function( e ) {
		
		empty = $( this ),
		parent = empty.parent(),
		trigger = parent.find(".retro-single-image-select")
		
		parent.find("input:hidden").val( null )
		
		empty.addClass("hidden")
		
		trigger.toggleClass( "button-primary-disabled", "button-secondary" )
		
		e.preventDefault()
		
	} )
		
	function retro_single_image_select_status( trigger ) {
							
		if ( ! trigger.parent().find("input:hidden").val() )
			return
			
		trigger
		.next(".retro-single-image-select-reset")
		.removeClass("hidden")
				
		if ( ! trigger.hasClass( "button-primary-disabled" ) )
	    	trigger.toggleClass( "button-primary-disabled", "button-secondary" )
		
	}
	
	$(".radiopic").each( function() {
		
		var $this = $( this ),
			select = $this.find("select"),
			options = $this.find("option"),
			selector = $this.find(".radiopic-list"),
			index = select.find(":selected").index();

		if ( ! selector.hasClass("has-radiopic") ) {
		
			options.each( function() {
							
				selector.append('<li data-glyph="' + $( this ).val() + '"><span class="' + $( this ).val() + '"></span></li>');
			
			} );
				
			selector.find("li:eq(" + index + ")").addClass("selected");

			selector.find("li:eq(0)").addClass("no-icon");
			
			selector.addClass("has-radiopic");
		
		}
		
	} );

	$(".radiopic-list li").live( "click", function( e ) {
		
		e.preventDefault();
		
		var $this = $( this ),
			index = $this.index(),
			real_input = $this.parent().parent().find("select");
		
		$this.addClass("selected").siblings().removeClass("selected");
		
		real_input.find("option:selected").removeAttr("selected");
				
		real_input.find("option:eq(" + index + ")").attr("selected", "selected");
	
	} );

	/* Hide & Show Homepage Metaboxes */

    function hs_home_standard_mb() {

        $("#postdivrich").hide();

        if ( $(":radio#default").is(":checked") ||  $(":radio[value=contact]").is(":checked") || $("body").is(".post-type-page") ) {

            $("#postdivrich").show();

        }

    }

    function hs_slider_mb() {

        $("#slider_metabox, #banner_metabox, #welcome_metabox").hide();

        if ( $(":radio[value=slider]").is(":checked") ) {

            $("#slider_metabox, #banner_metabox, #welcome_metabox").show();
            $("#postdivrich").hide();

        }

    }

	function hs_about_mb() {

	    $("#about_metabox").hide();

	    if ( $(":radio[value=about]").is(":checked") ) {

	        $("#about_metabox").show();
	        $("#postdivrich").hide();

	    }

	}

	function hs_stream_mb() {

	    $("#fill-with").hide();

	    if ( $(":radio[value=stream]").is(":checked") ) {

	        $("#fill-with").show();
	        $("#postdivrich").hide();

	    }

	    /* Disable portfolio dropdown if Latest Articles is selected */

	    if ( !$(':radio[value=portfolio]').is(":checked") ) {
	    	$('select[name="stream[portfolio]"]').attr("disabled", true );
	    }

	    $(':radio[name="stream[fetch]"]').on( "change", function() {
	    	$( this ).val() == "portfolio" ? $('select[name="stream[portfolio]"]').attr("disabled", false ) : $('select[name="stream[portfolio]"]').attr("disabled", true )
	    });

	}

	hs_home_standard_mb();
	hs_slider_mb();
	hs_about_mb();
	hs_stream_mb();

	$(":radio[name='stream[kind]']").live("click", function() {

		hs_home_standard_mb();
		hs_slider_mb();
		hs_about_mb();
		hs_stream_mb();

	} );


	/* Hide & Show Post Type Metaboxes */

	function hs_post_standard_mb() {

        if ($(":radio#post-format-0").is(":checked") ) {

            $("#postdivrich").show();

        }

	}

    function hs_post_link_mb() {

        $("#link_metabox").hide();

        if ($(":radio#post-format-link").is(":checked") ) {

            $("#link_metabox").show();
            $("#postdivrich").hide();

        }

    }

    function hs_post_image_mb() {

        $("#image_metabox").hide();

        if ($(":radio#post-format-image").is(":checked") ) {

            $("#image_metabox").show();
            $("#postdivrich").hide();

        }

    } 

    function hs_post_gallery_mb() {

        $("#gallery_metabox").hide();

        if ($(":radio#post-format-gallery").is(":checked") ) {

            $("#gallery_metabox").show();
            $("#postdivrich").hide();

        }

    }  

    function hs_post_video_mb() {

        $("#video_metabox").hide();

        if ($(":radio#post-format-video").is(":checked") ) {

            $("#video_metabox").show();

            if ( $("body").is(".post-type-post") ) {

            	$("#postdivrich").show();

            } else {

            	$("#postdivrich").hide();

            }

        }

    }            

	hs_post_standard_mb();
    hs_post_link_mb();
    hs_post_image_mb();
    hs_post_gallery_mb();
    hs_post_video_mb();

	$(":radio[name=post_format]").live("click", function() {

		hs_post_standard_mb();
	    hs_post_link_mb();
	    hs_post_image_mb();
	    hs_post_gallery_mb();
	    hs_post_video_mb();

	} );
	

	/* Color Picker behaviour */
	
	$(".retro-iris-picker").iris( {
		hide: true,
		palettes: true
	} )
	.on( "focus", function() {
		$( this ).iris("show")		
	} );


	/* Disable some post formats on posts pages */

	$(".post-type-post").find("#post-format-link, #post-format-image, #post-format-gallery").attr("disabled", true );

} );