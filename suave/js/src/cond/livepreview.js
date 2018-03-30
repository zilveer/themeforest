var $j = jQuery.noConflict();

$j( document ).ready( function() {

    $j( "#live-preview.default a.open" ).click( function( e ) {
        e.preventDefault();
        var margin_left = $j( "#live-preview.default" ).css( "margin-left" );
        if ( margin_left == "-252px" ) {
            $j( "#live-preview.default" ).animate( { marginLeft: "0px" } );
            $j( "#live-preview.default" ).addClass( 'opened-panel' );
            $j( this ).addClass( 'opened' );
        }
        else {
            $j( "#live-preview.default" ).animate( { marginLeft: "-252px" } );
            $j( this ).removeClass( 'opened' );
            $j( "#live-preview.default" ).removeClass( 'opened-panel' );
        }
        return false;
    } );

    $j( ".accordion_toolbar" ).accordion( {
        animate: "swing",
        collapsible: true,
        active: 7,
        icons: "",
        heightStyle: "content"
    } );

    $j( 'ul#tootlbar_header_top_menu li' ).click( function() {
        if ( $j( this ).attr( "data-value" ) != "" ) {

            $j.post( root + 'livepreview.php', { cg_header_top: $j( this ).attr( "data-value" ) }, function( data ) {
                location.reload();
            } );
        }
    } );

    $j( 'ul#tootlbar_woocatalog li' ).click( function() {
        if ( $j( this ).attr( "data-value" ) != "" ) {

            $j.post( root + 'livepreview.php', { cg_catmode: $j( this ).attr( "data-value" ) }, function( data ) {
                location.reload();
            } );
        }
    } );

    $j( 'ul#tootlbar_woohideprices li' ).click( function() {
        if ( $j( this ).attr( "data-value" ) != "" ) {

            $j.post( root + 'livepreview.php', { cg_hideprices: $j( this ).attr( "data-value" ) }, function( data ) {
                location.reload();
            } );
        }
    } );
    
    $j( 'ul#tootlbar_boxed li' ).click( function() {

        $j( 'body' ).removeClass( 'boxed' );
        $j( 'body' ).addClass( $j( this ).attr( "data-value" ) );

        if ( $j( this ).attr( "data-value" ) != "boxed" ) {
    
            $j( '#tootlbar_pattern' ).getSetSSValue( 'no' );
            $j( '#tootlbar_background' ).getSetSSValue( 'no' );
        }
    } );

    $j( 'ul#tootlbar_pattern li' ).click( function() {

        if ( $j( this ).attr( "data-value" ) != "no" ) {
            $j( 'body' ).addClass( 'boxed' );
            newSkin = "body.boxed { \
									background-image: url('http://adrenalin.captivate.io/wp-content/uploads/2014/07/" + $j( this ).attr( "data-value" ) + ".png'); \
									background-position: 0px 0px; \
									background-repeat: repeat; \
                                    background-attachment: inherit; \
                                    background-size: inherit; \
								} \
							";
            jQuery( 'body' ).append( '<style id="tootlbar_pattern_css" type="text/css">' + newSkin + '</style>' );

        } else {
            newSkin = "body { \
									background-image: none; \
								} \
							";
            jQuery( 'body' ).append( '<style id="tootlbar_pattern_css" type="text/css">' + newSkin + '</style>' );
        }
    } );

    $j( 'ul#tootlbar_background li' ).click( function() {

        $j( 'body.boxed .wrapper' ).removeClass( 'toolbar_clicked' );
        jQuery( '#tootlbar_background_css' ).remove();
        if ( $j( this ).attr( "data-value" ) != "no" ) {
            $j( 'body' ).addClass( 'boxed' );
            newSkin = "body.boxed { \
									background-image: url('http://adrenalin.captivate.io/wp-content/uploads/2014/07/" + $j( this ).attr( "data-value" ) + ".jpg'); \
									background-position: 0px 0px; \
									background-repeat: repeat; \
									background-attachment: fixed; \
								} \
							";
            jQuery( 'body' ).append( '<style id="tootlbar_background_css" type="text/css">' + newSkin + '</style>' );

        } else {
            newSkin = "body { \
									background-image: none; \
								} \
							";
            jQuery( 'body' ).append( '<style id="tootlbar_background_css" type="text/css">' + newSkin + '</style>' );
        }
    } );


    $j( '#tootlbar_colors .color' ).each( function() {
        $j( this ).on( 'click', function() {
            $j( '#tootlbar_colors .color' ).removeClass( 'active' );
            $j( this ).addClass( 'active' );
			$j.post( root + 'livepreview.php', { cg_skin_color: $j( this ).attr( "data-color" ) }, function( data ) {
                location.reload();
            } );
        } );
    } );
} );

function hexToRgb( hex ) {
    // Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")
    var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
    hex = hex.replace( shorthandRegex, function( m, r, g, b ) {
        return r + r + g + g + b + b;
    } );

    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec( hex );
    return result ? {
        r: parseInt( result[1], 16 ),
        g: parseInt( result[2], 16 ),
        b: parseInt( result[3], 16 )
    } : null;
}

$j.fn.inlineStyle = function( prop ) {
    var styles = this.attr( "style" ),
            value;
    styles && styles.split( ";" ).forEach( function( e ) {
        var style = e.split( ":" );
        if ( $j.trim( style[0] ) === prop ) {
            value = style[1];
        }
    } );
    return value;
};