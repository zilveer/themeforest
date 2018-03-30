/**
 * Small utilities, not
 */
define(['jquery', 'underscore', 'enquire'], function ($, _) {
  /**
   * Search mode with the transparent overlay over the whole site
   * @return {void}
   */
  (function () {
    $('.js--toggle-search-mode').on('click', function (ev) {
      ev.preventDefault();
      $( 'body' ).toggleClass( 'search-mode' );

      if ( $( 'body' ).hasClass( 'search-mode' ) ) {
        // set focus to the text field
        setTimeout(function () {
          $('.js--search-panel-text').focus();
        }, 200);

        // on escape key leave the search mode
        $( document ).on( 'keyup.searchMode', function( ev ) {
          ev.preventDefault();
          if ( ev.keyCode === 27 ){
            $( 'body' ).toggleClass( 'search-mode' );
            $( document ).off( 'keyup.searchMode' );
          }
        } );
      } else {
        $( document ).off( 'keyup.searchMode' );
      }
    });
  })();

  /**
   * Close the responsive menu when resizing window
   */
  (function () {
    enquire.register('screen and (min-width: 992px)', {
      match: function() {
        $('.navbar-toggle').not('.collapsed').trigger('click');
      }
    });
  })();

  /**
   * Special helpers when we have a touch events
   */
  (function () {
    if ( 'ontouchstart' in document.documentElement ) {
      // add .touch to the <html>
      $( 'html' )
        .removeClass( 'no-touch' );

      // mobile dropdowns
      $('.js--mobile-dropdown').on('click', function (ev) {
        ev.preventDefault();

        // remove all exiting visible dropdowns
        $(this)
          .siblings('.js--mobile-dropdown')
          .find('.show-menu')
          .removeClass('show-menu');


        // show the current dropdown
        $(this)
          .find('.dropdown-menu')
          .toggleClass('show-menu');
      });
    }
  })();


  /**
   * Thumbnail selector for the product
   */
  (function () {
    $( '.js--preview-thumbs a' ).click( function( ev ) {
      ev.preventDefault();
      $( $( this ).attr( 'href' ) ).attr( 'src', $( this ).data( 'src' ) );
      $( this ).parent().addClass( 'active' ).siblings( '.active' ).removeClass( 'active' );
    } );
  })();

  /**
   * When click on +/- the number should change
   */
  (function () {
    $( '.js--quantity > .js--clickable' ).click( function( ev ) {
      ev.preventDefault();
      var $input = $(this).siblings( 'input[type="text"]' );
      var number = parseInt( $input.val(), 10 );
      if ( isNaN( number ) ) {
        number = 1;
      }
      if ( $( this ).hasClass( 'js--plus-one' ) ) {
        $input.val( number + 1 );
      } else {
        number = number < 2 ? 2 : number;
        $input.val( number - 1 );
      }
    } );
  })();

  //  ==========
  //  = Highlight current date =
  //  ==========
  (function() {
    var
      timeTable = $('.js--timetable'),
      date = new Date();
    if( timeTable.length > 0 ) {
      date = date.getDay();
      timeTable.children('[data-day="'+date+'"]').addClass('today');
    }
  })();


  /**
   * Add the gradient to the jumbotron after the page is loaded
   */
  (function () {
    $( '.js--add-gradient' ).addClass( 'jumbotron--gradient' );
  })();



});