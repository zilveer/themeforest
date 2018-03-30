jQuery(document).ready(function($){

    //toggle menu widget
    $( '.yit_toggle_menu ul.menu.open_first > li:first-child, .yit_toggle_menu ul.menu.open_all > li' ).addClass( 'opened' );
    $( '.yit_toggle_menu ul.menu.open_active li.current-menu-ancestor, .yit_toggle_menu ul.menu.open_active li.current-menu-parent' ).addClass( 'opened' );
    $( '.yit_toggle_menu ul li.dropdown > a' ).click( function( e ) {
        e.preventDefault();
        e.stopPropagation(); // Prevent issues on mobile.
        var dropdown = $( this ).next( 'ul' );
        var dropdown_parent = dropdown.parent( '.dropdown' );

        dropdown.width( dropdown_parent.width() );
        dropdown_parent.width( dropdown_parent.parent().width() );

        if( dropdown_parent.hasClass( 'opened' ) )
            { dropdown_parent.removeClass( 'opened' ); }
        else
            { dropdown_parent.addClass( 'opened' ); }

        dropdown.slideToggle();
    });


});