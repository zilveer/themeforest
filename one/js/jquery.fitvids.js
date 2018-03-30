( function( $ ) {

  "use strict";

  $.fn.fitVids = function( options ) {

    var settings = {
      customSelector: null,
      callback: function() {}
    };

    if( ! document.getElementById( 'fit-vids-style' ) ) {
      var div = document.createElement('div'),
      ref = document.getElementsByTagName('base')[0] || document.getElementsByTagName('script')[0],
      cssStyles = '&shy;<style>.fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}</style>';

      div.className = 'fit-vids-style';
      div.id = 'fit-vids-style';
      div.style.display = 'none';
      div.innerHTML = cssStyles;

      ref.parentNode.insertBefore( div, ref );
    }

    if ( options ) {
      $.extend( settings, options );
    }

    return this.each( function() {
      var selectors = [
        "iframe[src*='player.vimeo.com']",
        "iframe[src*='youtube.com']",
        "iframe[src*='youtube-nocookie.com']",
        "iframe[src*='kickstarter.com'][src*='video.html']",
        "object",
        "embed"
      ];

      if ( settings.customSelector ) {
        selectors.push( settings.customSelector );
      }

      var $allVideos = $( this ).find( selectors.join( "," ) );
      $allVideos = $allVideos.not( "object object" ); // SwfObj conflict patch

      $allVideos.each( function() {
        var $this = $( this ),
          $holder = $this.parent(),
          isShortcodeUltimateVideo = $holder.hasClass('su-vimeo') || $holder.hasClass('su-youtube') || $holder.hasClass('su-screenr');

        if ( isShortcodeUltimateVideo ) {
          return;
        }

        if ( this.tagName.toLowerCase() === "embed" && $this.parent( "object" ).length || $this.parent( ".fluid-width-video-wrapper" ).length ) {
          return;
        }

        var height = 9,
          width = 16;

        if ( $this.attr( "height" ) !== undefined ) {
          height = parseInt( $this.attr( "height" ), 10 );
        }
        else if ( $holder.attr( "data-ratio-y" ) !== undefined ) {
          height = parseInt( $holder.attr( "data-ratio-y" ), 10 );
        }

        if ( $this.attr( "width" ) !== undefined ) {
          width = parseInt( $this.attr( "width" ), 10 );
        }
        else if ( $holder.attr( "data-ratio-x" ) !== undefined ) {
          width = parseInt( $holder.attr( "data-ratio-x" ), 10 );
        }

        var aspectRatio = height / width;

        $this.wrap( '<div class="fluid-width-video-wrapper"></div>' );
        var $wrapper = $this.parent('.fluid-width-video-wrapper');
        $wrapper.css('padding-top', (aspectRatio * 100)+"%");
        $this.removeAttr('height').removeAttr('width');

        setTimeout(function() {
          settings.callback( $wrapper );
        }, 5);
      } );
    } );
  };

} )( jQuery );